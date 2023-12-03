<?php 
    session_start();
    include 'functions.php';
    if(isset($_SESSION['username'])){
        if($_SESSION['username'] == 'admin'){
            $username = $_SESSION['username'];
        }
        else
            header("Location: login.php?login=false");
    }
    else
        header("Location: login.php?login=false");
    if(isset($_POST['province'])){
        var_dump($_POST['province']);
    }   

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' href='css/style.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Cocomelon</title>
</head>

<body class="">
    <header class="fixed-top">
        <nav class="navbar navbar-expand-lg bg-transparent">
            <div class="container-fluid p-3">
                <a class="navbar-brand mx-5" href="index.php?#forYou"><img src="img/logo.png" style="width:120px;" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">

                <ul class="navbar-nav gap-2 mb-2" id="navbarSupportedContent">
                    <?php if(isset($_SESSION['username'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link rounded active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="add.php?destination">
                            New Place
                            <?php if($_SESSION['username'] == 'admin'): ?>
                            <?php 
                                    $query = mysqli_query($conn, "SELECT COUNT(id) AS amount_request FROM req_tourism");
                                    $amount_request = mysqli_fetch_array($query);    
                                ?>
                            <span class="position-absolute translate-middle badge rounded-pill bg-danger">
                                <?= $amount_request['amount_request'] ?>
                            </span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle rounded" href="#" role="button" data-bs-toggle="dropdown"
                            style="background-color: #019bda;" aria-expanded="false">
                            Profile
                        </a>
                        <ul class="dropdown-menu p-3">
                            <li><a class="dropdown-item mx-3" href="edit.php?profile">Edit Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item mx-3" href="login.php?login=logout">Logout</a></li>
                        </ul>
                    </li>
                    <?php 
                        $query = mysqli_query($conn, "SELECT image FROM account WHERE username = '$username' ");
                        $data = mysqli_fetch_array($query);
                        if($data['image']):
                    ?>
                    <img class="rounded-circle mx-5" alt="PP" src="img/profile/<?=$data['image']?>"
                        style="width:50px; height: 50px;">
                    <?php else: ?>
                    <img class="rounded-circle mx-5" alt="PP" src="img/profile.png" style="width:50px">
                    <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </div>
            </div>
        </nav>
    </header>

    <?php if(isset($_GET['place'])): 
        $place = $_GET['place'];
        $query = mysqli_query($conn, "SELECT * from req_tourism where name = '$place'");
        $data = mysqli_fetch_array($query);
        $rating = "No Rating";
        $price = $data['price'];
        $place_id = $data['id'];
    ?>
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="home-img w-100 d-block w-100" src="img/place/<?=$data['image']?>" alt="home">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <?php endif; ?>


    <center>
        <div class="my-5 card w-50 mb-5 shadow-lg" id="info">
            <div class="card-body">
                <h1><?= $data['name'] ?></h1>
            </div>
        </div>
    </center>
    <div class="container">
        <div class="row">
            <div class="col-md-4">

                <p>
                <div class="gap-3" style="color: grey;  font-size:24px;"><i
                        class="bi bi-geo-alt-fill"><?= $data['province'].", ".$data['regency'] ?></i></div>
                </p>
                <div class="gap-3" style="font-size:24px;">
                    <div class="info-view">
                        Rating
                    </div>
                    <p>
                        <i class="bi bi-star-fill" style="color:#ffc107;"></i>
                        <?= $rating ?>
                    </p>
                </div>
                <div class="gap-3" style="font-size:24px;">
                    <div class="info-view">
                        Price
                    </div>
                    <p>
                        <?php if(isset($noPrice)): ?>
                        <?= $price ?>
                        <?php else: ?>
                        IDR. 0 - <?= number_format($price,'2',',','.') ?>
                        <?php endif; ?>
                    </p>
                </div>
                <div class="gap-3" style="font-size:24px;">
                    <div class="info-view">
                        Description
                    </div>
                    <p>
                        <?= $data['description'] ?>
                    </p>
                </div>
                <div class="gap-3" style="font-size:24px;">
                    <div class="info-view">
                        Action
                    </div>
                    <p class="d-flex gap-3">
                        <button type="submit" class="btn btn-success"><a
                                href="process.php?new=<?=$data['id']?>"><i
                                    class="bi bi-check-lg"></i></a></button>
                        <button type="submit" class="btn btn-danger"><a href="process.php?decline=<?=$data['id']?>"><i
                                    class="bi bi-x-circle"></i></a></button>
                    </p>
                </div>


            </div>
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header" style="background-color: #019bda;">
                        <form action="process.php" method="post">
                            <center>
                                <div class="rating-label" style="color: white;">
                                    Rating
                                </div>
                                <div class="ratings-wrapper mb-1">
                                    <input type="hidden" name="rate" id="rate">
                                    <input type="hidden" name="place_id" id="place_id" value="<?=$data['id']?>">
                                    <input type="hidden" name="username" value="<?=$username?>" id="username"
                                        value="<?=$username?>">
                                    <div class="ratings d-flex gap-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                </div>
                            </center>
                            <div class=" mb-3  input-group">
                                <div class="form-floating d-flex align-items-center">
                                    <input type="text" class="form-control" id="comment" name="comment"
                                        placeholder="Your comment here..." required>
                                    <label for="comment">Your comment here...</label>
                                </div>
                                <button type="submit" class="btn btn-light btn-lg d-flex align-items-center"
                                    name="feedback"><i class="bi bi-send-fill"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="overflow-auto">
                        <div class="card-body">
                            <h3>Comments</h3>
                            <div class="card mb-3 ">
                                
                                <div class="card-body">
                                    <p class="card-text"></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="mt-5 d-flex justify-content-center align-items-center" style="height:3rem">
        <span>
            Copyright © <img src="img/logoFooter.png" alt="logo" style="width:100px;" class="mb-1"> 2023
        </span>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script>
    document.addEventListener('scroll', () => {
        const header = document.querySelector('header');
        if (window.scrollY > 0) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    })
    let stars = document.querySelectorAll(".ratings i");
    let rate = document.getElementById("rate");
    let ratings = [];
    let beforeIndex = 0;
    stars.forEach((star, index) => {
        star.addEventListener("click", function() {
            rate.value = 5 - index;
            console.log(rate.value);
            while (index > beforeIndex) {
                stars[beforeIndex].removeAttribute("data-clicked");
                beforeIndex++;
            }
            star.setAttribute("data-clicked", "true");
            beforeIndex = index;
        });
    });

    </script>


</body>

</html>