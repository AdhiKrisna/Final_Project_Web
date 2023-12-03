<?php  
    session_start();
    include 'functions.php';
    if(isset($_GET['login'])){
        if($_GET['login'] == 'logout'){
            session_destroy();
            session_start();
        }
        else if($_GET['login'] == 'edit'){
            session_destroy();
            session_start();
        }
        else if($_GET['login'] == 'true'){
            session_destroy();
            session_start();
        }
        else if($_GET['login'] == 'user'){
            session_destroy();
            session_start();
        }
    }
    if(isset($_SESSION['username'])){
        header("location:login.php?login=true");
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
    <title>Login Page</title>
</head>

<body class="">
    <header>
        <nav class="scrolled navbar navbar-expand mb-4">
            <div class="container-fluid p-3">
                <a class="navbar-brand mx-5" href="#"><img src="img/logo.png" style="width:120px;" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">

                <ul class="navbar-nav gap-2 mb-2 me-4 " id="navbarSupportedContent">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded active" aria-current="page" href="#"
                            style="background-color: #019bda;">Login</a>
                    </li>
                </ul>
            </div>
            </div>
        </nav>
    </header>

    <center>
        <img src="img/logo.png" alt="logo" style="width: 20rem;">
        <div class="card w-50 mt-5 my-5 shadow-lg">
            <div class="card-body">
                <h1 class="mb-4">Login Form</h1>
                <?php 
                if(isset($_GET['login'])){
                    if($_GET['login'] == 'logout'){
                        echo"<p class='error-message'>Logout Success!</p>";
                    }
                    else if($_GET['login'] == "fail"){
                        echo" <p class='error-message'>Login Failed. Invalid username or password. Try again!</p>";
                    }
                    else if($_GET['login'] == 'false')
                        echo" <p class='error-message'>Not Login Yet. Login First!</p>";
                    else if($_GET['login'] == 'true'){
                        echo" <p class='error-message'>Login Already. Logout first!</p>";
                    }
                    else if($_GET['login'] == 'edit'){
                        echo "<p class='error-message'>Profile has been changed. Login again!</p>";
                        session_destroy();
                    }
                    else if($_GET['login'] == 'user')
                        echo "<p class='error-message'>You are not admin. Login to admin first! </p>";
                    else if($_GET['login'] == 'register')
                        echo "<p style='color: green;'>Created an account success. Let's login</p>";
                }
                ?>
                <form action="process.php" method="POST">
                    <div class="form-floating mb-3 w-75 shadow-lg">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Username"
                            name="username" required>
                        <label for="floatingInput">Username</label>
                    </div>
                    <div class="form-floating mb-3 w-75 shadow-lg">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                            name="password" required>
                        <label for="floatingPassword">Password</label>
                    </div>
                    <button type="submit" class="btn my-3" name="login"
                        style="background-color: #019bda; color:white;">Login</button>
                    <p>Don't have an account yet? <a href="register.php">Register</a></p>
                </form>
            </div>
        </div>
    </center>

    <footer class="mt-5 d-flex justify-content-center align-items-center fixed-bottom" style="height:3rem">
        <span>
        Copyright © <img src="img/logoFooter.png" alt="logo" style="width:100px;" class="mb-1"> 2023
        </span>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>