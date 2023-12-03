<?php 
    session_start();
    include 'functions.php';
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
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
                <a class="navbar-brand mx-5" href="#"><img src="img/logo.png" style="width:120px;" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav gap-2 mb-2" id="navbarSupportedContent">
                        <?php if(isset($_SESSION['username'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link rounded active" aria-current="page" href="#"
                                style="background-color: #019bda;">Home</a>
                        </li>
                        <li class="nav-item mx-3">

                            <a class="nav-link" href="add.php?destination">
                                New Place
                                <?php if($_SESSION['username'] == 'admin'): ?>
                                <?php 
                                    $query = mysqli_query($conn, "SELECT COUNT(id) AS amount_request FROM req_tourism");
                                    $amount_request = mysqli_fetch_array($query);    
                                ?>
                                <?php if($amount_request['amount_request'] > 0): ?>
                                <span class="position-absolute translate-middle badge rounded-pill bg-danger">
                                    <?= $amount_request['amount_request'] ?>
                                </span>
                                <?php endif; ?>
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
                        <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link rounded active" aria-current="page" href="#"
                                style="background-color: #019bda;">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#">New Place</a>
                        </li>
                        <li class="nav-item me-5">
                            <a class="nav-link active" aria-current="page" href="login.php">Login</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>




    <div class="d-flex slider overflow-x-hidden">
        <input class="radioInput" type="radio" name="radio-btn" id="radio1" checked>
        <input class="radioInput" type="radio" name="radio-btn" id="radio2">
        <input class="radioInput" type="radio" name="radio-btn" id="radio3">
        <input class="radioInput" type="radio" name="radio-btn" id="radio4">
        <div class="home-img home-img1 mb-5 min-vw-100 first"></div>
        <div class="home-img home-img2 mb-5 min-vw-100"></div>
        <div class="home-img home-img3 mb-5 min-vw-100"></div>
        <div class="home-img home-img4 mb-5 min-vw-100"></div>
        <div class="navigation-auto d-flex">
            <div class="auto-btn1"></div>
            <div class="auto-btn2"></div>
            <div class="auto-btn3"></div>
            <div class="auto-btn4"></div>
        </div>

        <!-- <div class="navigation-manual d-none">
                <label for="radio1" class="manual-btn"></label>
                <label for="radio2" class="manual-btn"></label>
                <label for="radio3" class="manual-btn"></label>
                <label for="radio4" class="manual-btn"></label>
            </div> -->

        <!-- <img src="img/logo.png" alt="" class="position-absolute"> -->
        <h1 class="position-absolute">Find Your Best Natural Tourism</h1>
        <form action="" method="post">
            <div class="search position-absolute input-group w-25">
                <div class="form-floating d-flex align-items-center">
                    <input type="search" id="search" class="form-control" placeholder="Search. . ." autofocus autocomplete="off">
                    <label for="search" class="fw-bold">Search</label>
                </div>
                <a href="#forYou" class="btn btn-light btn-lg d-flex align-items-center" id="searchBtn"><i class="bi bi-search"></i></a>
            </div>
        </form>
    </div>



    <center>
        <div class="card w-50 mb-5 shadow-lg" id="forYou">
            <div class="card-body">
                <h1>For You</h1>
            </div>
        </div>
    </center>

    <div class="container" id="containerPlace">
        <div class="row">
            <?php 
                $query = mysqli_query($conn, "SELECT name, province, TRIM(LEADING 'KABUPATEN ' FROM UPPER(regency)) as regency, image, description, rating FROM tourism;");
                while($data = mysqli_fetch_array($query)):
            ?>
            <div class="col-md-2 mx-3 mt-4">
                <div class="card shadow-lg mb-4 d-flex align-items-stretch" style="width: 15rem; height:100%">
                    <img src="img/place/<?= $data['image'] ?>" class="card-img-top" alt="..."
                        style="width:238.4px; height:135.74px;">
                    <div class="card-body d-flex d-flex justify-content-between flex-column">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title"><?= $data['name'] ?></h5>
                                <div class="d-block">
                                    <?php if($data['rating'] != 0): ?>
                                    <i class="bi bi-star-fill" style="color:#ffc107;"></i>
                                    <p><?= number_format($data['rating'], '1',',') ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <p class="card-text"
                                style="max-height:72px; overflow: hidden; text-overflow: ellipsis; display:-webkit-box; -webkit-line-clamp:3;-webkit-box-orient:vertical;">
                                <?= $data['description'] ?></p>
                        </div>
                        <div>
                            <div class="gap-3" style="color: grey;  font-size:12px;"><i
                                    class="bi bi-geo-alt-fill"><?= $data['province'].",".$data['regency'] ?></i></div>
                            <?php if(isset($_SESSION['username'])): ?>
                                <?php if($_SESSION['username'] == 'admin'): ?>
                                    <div class="d-flex justify-content-between mt-3">
                                        <a href="edit.php?place=<?=$data['name']?>" class="btn btn-success"
                                            style=" color:white;"><i class="bi bi-pencil-square"></i></a>
                                        <a href="view.php?place=<?=$data['name']?>&?#info" class="btn"
                                            style="background-color: #019bda; color:white; width: 100px;">Visit</a>
                                        <a href="process.php?delete=<?=$data['name']?>" class="btn btn-danger"
                                            style=" color:white;"><i class="bi bi-trash3-fill"></i></a>
                                    </div>
                                <?php else:  ?>
                                    <div class="d-flex justify-content-center mt-3">
                                        <a href="view.php?place=<?=$data['name']?>&?#info" class="btn" style="background-color: #019bda; color:white; width: 100px;">Visit</a>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="d-flex justify-content-center mt-3">
                                    <a href="view.php?place=<?=$data['name']?>&?#info" class="btn" style="background-color: #019bda; color:white; width: 100px;">Visit</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
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
        var counter = 2;
        setInterval(function() {
            document.getElementById('radio' + counter).checked = true;
            counter++;
            if (counter > 4) {
                counter = 1;
            }
        }, 3000);
        document.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (window.scrollY > 0) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        })
    </script>

    <script src="script/script.js">
    
    </script>

</body>

</html>