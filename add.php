<?php  
    session_start();
    include 'functions.php';
    if(!isset($_SESSION['username']))
        header("Location: login.php?login=false");
    else
        $username = $_SESSION['username'];

    if(isset($_POST['new'])){
        $name = $_POST['name'];
        $province = $_POST['province'];
        $city = $_POST['city'];
        $description = $_POST['description'];
        echo $name."<br>";
        echo $province. "<br>";
        echo $city. "<br>";
        echo $description. "<br>";
        // $query = mysqli_query($conn, "INSERT INTO destination VALUES ('', '$name', '$province', '$city', '$description')");
        // if($query){
        //     header("Location: index.php");
        // }
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
    <title>Request  Place</title>
</head>

<body class="">
    <header class="fixed-top">
        <nav class="scrolled navbar navbar-expand-lg mb-4">
            <div class="container-fluid p-3">
                <a class="navbar-brand mx-5" href="index.php?#forYou"><img src="img/logo.png" style="width:120px;" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">

                    <ul class="navbar-nav gap-2 mb-2" id="navbarSupportedContent">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <?php if(isset($_SESSION['username'])): ?>
                        <li class="nav-item mx-3">
                            <a class="nav-link rounded" href="add.php?destination" style="background-color: #019bda;">
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
                            <a class="nav-link dropdown-toggle rounded" href="" role="button" data-bs-toggle="dropdown"
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
                                style="background-color: #019bda;">Login</a>
                        </li>
                        <?php endif; ?>
                    </ul>

                </div>
            </div>
        </nav>
    </header>

    <br>
    <center class="mt-5">
        <img class="mt-5" src="img/logo.png" alt="logo" style="width: 20rem;">
        <?php if(isset($_SESSION['username'])): ?>
        <?php if($_SESSION['username'] != 'admin'): ?>
        <h1 class="enroll">Enroll Your Hidden Gem</h1>
        <?php endif; ?>
        <?php endif; ?>
    </center>

    <?php if(isset($_SESSION['username'])): ?>
    <?php if($_SESSION['username'] == 'admin'): ?>
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="card w-100 shadow-lg">
                    <div class="card-body d-flex justify-content-center ">
                        <?php if(isset($_GET['destination'])) : ?>
                        <form class="w-75" action="process.php" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input class="form-control-lg form-control" id="name" name="name" required>
                                <input class="form-control-lg form-control" name="username" type="hidden"
                                    value="<?=$username?>">
                            </div>
                            <div class="mb-3">
                                <label for="province" class="form-label">Province</label>
                                <select class="form-select form-select-lg" id="province" name="province"
                                    onchange="change(this.value)"></select>
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">City/Regency</label>
                                <select class="form-select form-select-lg" id="city" name="city"></select>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control-lg form-control" id="price" name="price" min="0" required>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" placeholder="Profile Picture"
                                    name="image" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control form-control-lg" id="description" rows="2"
                                    name="description" required></textarea>
                            </div>
                            <center>
                                <button type="submit" name="new" value="<?=$username?>"
                                    class="btn btn-outline-success">Submit</button>
                            </center>
                        </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card w-100 shadow-lg">
                    <center>
                        <h1>Request List</h1>
                    </center>
                    <div class="card-body">
                        <table class="table table-striped-columns ">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Place Name</th>
                                    <th scope="col">Province</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                        $query = mysqli_query($conn, "SELECT id, username, name, province FROM req_tourism");
                                        $i = 1;
                                        while($request = mysqli_fetch_array($query)) :
                                        $id = $request['id'];
                                    ?>
                                <tr>
                                    <th><?= $i ?></th>
                                    <td><?= $request['username'] ?></td>
                                    <td><a href="inspect.php?place=<?=$request['name']?>"><?= $request['name'] ?></a>
                                    </td>
                                    <td><?= $request['province'] ?></td>
                                    <td class="d-flex gap-3">
                                        <button type="submit" class="btn btn-success"><a
                                                href="process.php?new=<?=$id?>"><i
                                                    class="bi bi-check-lg"></i></a></button>
                                        <button type="submit" class="btn btn-danger"><a
                                                href="process.php?decline=<?=$id?>"><i
                                                    class="bi bi-x-circle"></i></a></button>
                                    </td>
                                </tr>
                                <?php 
                                        $i++;
                                        endwhile; 
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="container">
        <div class="row">
            <div class="col-">
                <div class="card w-100 shadow-lg">
                    <div class="card-body d-flex justify-content-center ">
                        <?php if(isset($_GET['destination'])) : ?>
                        <form class="w-75" action="process.php" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input class="form-control-lg form-control" id="name" name="name" required>
                                <input class="form-control-lg form-control" name="username" type="hidden"
                                    value="<?=$username?>">
                            </div>
                            <div class="mb-3">
                                <label for="province" class="form-label">Province</label>
                                <select class="form-select form-select-lg" id="province" name="province"
                                    onchange="change(this.value)"></select>
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">City/Regency</label>
                                <select class="form-select form-select-lg" id="city" name="city"></select>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control-lg form-control" id="price" name="price" min="0" required>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" placeholder="Profile Picture"
                                    name="image" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control form-control-lg" id="description" rows="2"
                                    name="description" required></textarea>
                            </div>
                            <center>
                                <?php if($username == 'admin'): ?>
                                <button type="submit" name="new" value="<?=$username?>"
                                    class="btn btn-outline-success">Submit</button>
                                <?php else: ?>
                                <button type="submit" name="new" value="<?=$username?>"
                                    class="btn btn-outline-success">Request</button>
                                <?php endif; ?>
                            </center>
                        </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php endif; ?>
    <?php endif; ?>



    <footer class="mt-5 d-flex justify-content-center align-items-center" style="height:3rem">
        <span>
            Copyright © <img src="img/logoFooter.png" alt="logo" style="width:100px;" class="mb-1"> 2023
        </span>
    </footer>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">

    </script>

    <script>
 
    let selectProvince = document.getElementById('province');
    let provincesList;
    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json`)
        .then(response => response.json())
        .then(provinces => {
            // Loop through the provinces
            provincesList = provinces;
            provinces.forEach(province => {
                // Create a new option element
                let option = document.createElement('option');

                // Set the value and text content of the option
                option.value = province.name; // or whatever property you want to use
                option.textContent = province.name; // or whatever property you want to use

                // Append the option to the selectProvince element
                selectProvince.appendChild(option);
            });
            change(document.getElementById('province').value);
        });

    let selectCity = document.getElementById('city');

    function change(name) {
        let id;
        provincesList.forEach(province => {
            if (province.name == name) {
                id = province.id;
            }
        });
        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${id}.json`)
            .then(response => response.json())
            .then(cities => {
                // Loop through the cities
                selectCity.innerHTML = '';
                // Loop through the cities
                cities.forEach(city => {
                    // Create a new option element
                    let option = document.createElement('option');

                    // Set the value and text content of the option
                    option.value = city.name; // or whatever property you want to use
                    option.textContent = city.name; // or whatever property you want to use

                    // Append the option to the selectCity element
                    selectCity.appendChild(option);
                });
            });
    }
    </script>
</body>

</html>