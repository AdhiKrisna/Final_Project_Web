<?php  
    session_start();
    include 'functions.php';
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        if($username != 'admin' && !(isset($_GET['profile']))){
            header("location:login.php?login=user");
        }
    }
    else 
        header("location:login.php?login=user");
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
    <title>Edit Page</title>
</head>

<body class="">
    <header>
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
                        <li class="nav-item">
                            <a class="nav-link mx-3" href="add.php?destination">
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
                        $query = mysqli_query($conn, "SELECT * FROM account WHERE username = '$username'");
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
                                style="background-color: #019bda;">Edit Profile</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <center>
        <img src="img/logo.png" alt="logo" style="width: 20rem;">

        <?php if(isset($_GET['profile'])): ?>
        <div class="card w-50  mb-5 shadow-lg">
            <div class="card-body">
                <h1 class="mb-4">Edit Profile</h1>
                <?php 
                    if(isset($_GET['fail'])){
                        if($_GET['fail'] == 'username'){
                            echo" <p class='error-message'>Username already used. Try another username</p>";
                        }
                        else if($_GET['fail'] == "password"){
                            echo" <p class='error-message'>Different password confirm. Are you kidding?</p>";
                        }
                    }
                ?>
                <form action="process.php" method="POST" enctype="multipart/form-data">
                    <div class="form-floating mb-3 w-75 shadow-lg">
                        <input type="text" class="form-control" id="username" placeholder="Username" name="username"
                            value="<?=$data['username']?>">
                        <label for="username">Username</label>
                    </div>
                    <div class="form-floating mb-3 w-75 shadow-lg">
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password"
                            value="<?=$data['password']?>">
                        <label for="password">Password</label>
                    </div>
                    <div class="form-floating mb-3 w-75 shadow-lg">
                        <input type="password" class="form-control" id="password2" placeholder="Password Confirm"
                            name="password2" value="<?=$data['password']?>">
                        <label for="password2">Password Confirm</label>
                    </div>
                    <div class="form-group mb-3 w-75 shadow-lg">
                        <label for="image">Profile Picture</label>
                        <input type="file" class="form-control" id="image" placeholder="Profile Picture" name="image">
                    </div>
                    <button type="submit" class="btn my-3" name="edit" value="profile"
                        style="background-color: #019bda; color:white;">Save</button>
                </form>
            </div>
        </div>
    </center>
  <footer class="mt-5 d-flex justify-content-center align-items-center fixed-bottom" style="height:3rem">
        <span>
            Copyright © <img src="img/logoFooter.png" alt="logo" style="width:100px;" class="mb-1"> 2023
        </span>
    </footer>
    <?php elseif(isset($_GET['place'])):
            $name = $_GET['place'];
            $query = mysqli_query($conn, "SELECT * FROM tourism WHERE name = '$name'");
            $data = mysqli_fetch_array($query);
        ?>

    <div class="card w-50 mb-5 shadow-lg">
        <div class="card-body">
            <h1 class="mb-4">Edit Place</h1>
            <form action="process.php" method="POST" enctype="multipart/form-data">
                <div class="form-floating shadow-lg mb-3">
                    <input type="hidden" name="id" value="<?=$data['id']?>">
                    <input value="<?=$data['name']?>" class="form-control-lg form-control" id="name" name="name"
                    required>
                    <label for="name" class="form-label">Name</label>
                </div>
                <div class="form-floating shadow-lg mb-3 ">
                    <select style="font-size:18px" class="form-select form-select-lg" id="province" name="province"
                    onchange="change(this.value)"></select>
                    <label for="province" class="form-label">Province</label>
                </div>
                <div class="form-floating shadow-lg mb-3">
                    <select style="font-size:18px" class="form-select form-select-lg" id="city" name="city"></select>
                    <label for="city" class="form-label">City/Regency</label>
                </div>
                <div class="form-floating shadow-lg mb-3">
                    <input type="number" class="form-control-lg form-control" value="<?=$data['price']?>" id="price" name="price" min="0" required>
                    <label for="price" class="form-label">Price</label>
                </div>
                <div class="form-floating shadow-lg mb-3">
                    <input type="file" class="form-control" id="image" placeholder="Profile Picture" name="image">
                    <label for="image" class="form-label">Image</label>
                </div>
                <div class="shadow-lg mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control form-control-lg" rows="5" id="description" rows="2" name="description"
                    required> <?=$data['description']?> </textarea>
                </div>
                <button type="submit" class="btn my-3" name="edit" value="place"
                    style="background-color: #019bda; color:white;">Save</button>
            </form>
        </div>
    </div>
    
      <footer class="mt-5 d-flex justify-content-center align-items-center" style="height:3rem">
        <span>
            Copyright © <img src="img/logoFooter.png" alt="logo" style="width:100px;" class="mb-1"> 2023
        </span>
    </footer>
    <?php endif; ?>

  


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

                if (province.name === "<?=$data['province']?>") {
                    option.selected = true;
                }

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