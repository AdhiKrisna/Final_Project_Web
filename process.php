<?php 
    session_start();
    include 'functions.php';

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = mysqli_query($conn, "SELECT * FROM account WHERE username = '$username' AND password = '$password'");
        $data = mysqli_num_rows($query);
        if($data > 0){
            $_SESSION['username'] = $username;
            header("location:index.php");
        }
        else{
            header("location:login.php?login=fail");
        }
    }

    if(isset($_POST['register'])){
        $username = strtolower(stripslashes( $_POST["username"]));
        $password =  $_POST["password"];//tanda kutip masuk database
        $password2 =  $_POST["password2"]; //tanda kutip masuk database
        $query = mysqli_query($conn, "SELECT * FROM account WHERE username = '$username'");
        $data = mysqli_num_rows($query);    
        if($data > 0){
            echo"
                <script>
                    alert('Username already used, try again!');
                    document.location.href = 'register.php?fail=username';
                </script>
            ";
        }
        else{
            if($password == $password2){
                $image = uploadImage();

                if($error === 4){
                    echo"
                        <script>
                            alert('Account created without profile picture');
                            document.location.href = 'login.php?login=register';
                        </script>
                    ";
                }
                echo"
                    <script>
                        document.location.href = 'login.php?login=register';
                    </script>
                ";
                mysqli_query($conn, "INSERT INTO account VALUES ('$username', '$password', '$image')");
            }
            else{
                header("location:register.php?fail=password");
            }
        }
    }
    if(isset($_POST['edit'])){
        if($_POST['edit'] == 'profile'){
            $username = $_POST['username'];
            $oldUsername = $_SESSION['username'];
            $password = $_POST['password'];
            $password2 = $_POST['password2'];
            $query = mysqli_query($conn, "SELECT * FROM account WHERE username = '$oldUsername'");
            $check = mysqli_num_rows($query);    
            $data = mysqli_fetch_array($query);
            if($check > 0 && $data['username'] != $oldUsername){
                echo"
                    <script>
                        alert('Username already used, try again!');
                        document.location.href = 'edit.php?fail=username';
                    </script>
                ";
            }
            else{
                if($password == $password2){
                    if(isset($_FILES['image'])){
                        if($_FILES['image']['size'] != 0){
                            $query = mysqli_query($conn, "SELECT image FROM account WHERE username = '$username'");
                            $image = mysqli_fetch_array($query);
                            unlink('img/profile/'.$image['image']); // hapus file
                            $newImage = uploadImage(); //upload
                            $query = mysqli_query($conn, "UPDATE account SET username = '$username' , password = '$password', image = '$newImage' WHERE username = '$oldUsername'");
    
                            echo"
                                <script>
                                    alert('Edit Profile Success!');
                                    document.location.href = 'login.php?login=edit';
                                </script>
                                ";
                        }else{
                            $query = mysqli_query($conn, "UPDATE account SET username = '$username', password = '$password' WHERE username = '$oldUsername'");
                            echo"
                                <script>
                                    alert('Edit Success. Not updating picture!');
                                    document.location.href = 'login.php?login=edit';
                                </script>
                            ";
                        }
                    }
                }
                else{
                    header("location:edit.php?profile&fail=password");
                }
            }
        }
        else if($_POST['edit'] == 'place'){
            $id = $_POST['id'];
            $name = $_POST['name'];
            $province = $_POST['province'];
            $city = $_POST['city'];
            $price  = $_POST['price'];
            $description = $_POST['description'];
            if(isset($_FILES['image'])){
                if($_FILES['image']['size'] != 0){
                    $query = mysqli_query($conn, "SELECT image FROM tourism WHERE id = '$id'");
                    $image = mysqli_fetch_array($query);
                    unlink('img/profile/'.$image['image']); // hapus file
                    $image = uploadImagePlace();
                    $query = mysqli_query($conn, "UPDATE tourism SET name = '$name', province = '$province', regency = '$city', image = '$image', description = '$description', price = $price WHERE id = $id");
                    echo"
                        <script>
                            alert('Edit Place Success!');
                            document.location.href = 'index.php?#forYou';
                        </script>
                        ";
                }else{
                    echo"
                        <script>
                            alert('Edit Success. Not updating picture!');
                            document.location.href = 'index.php?#forYou';
                        </script>
                    ";
                    $query = mysqli_query($conn, "UPDATE tourism SET name = '$name', province = '$province', regency = '$city', description = '$description', price = $price WHERE id = $id");
                }
            }
        }
    }
    if(isset($_POST['new'])){
        $name = $_POST['name'];
        $province = $_POST['province'];
        $city = $_POST['city'];
        $price  = $_POST['price'];
        $description = $_POST['description'];
        $image = uploadImagePlace();
        $rating = 0;
        if($_POST['new'] == 'admin'){
            $query = mysqli_query($conn, "INSERT INTO tourism (name, province, regency, image, description, price, rating) VALUES ('$name', '$province', '$city', '$image', '$description', $price, $rating)");
            echo"
                <script>
                    alert('Add New Place Success!');
                    document.location.href = 'index.php?#forYou';
                </script>
            ";
        }
        else{
            $username = $_POST['username'];
            $query = mysqli_query($conn, "INSERT INTO req_tourism (name, province, regency, image, description, username, price) VALUES ('$name', '$province', '$city', '$image', '$description', '$username', $price)");
            echo"
                <script>
                    alert('Requesting New Place Success!');
                    document.location.href = 'index.php?#forYou';
                </script>
            ";
        }
    }
    if(isset($_GET['new'])){
        $query = mysqli_query($conn, "SELECT * FROM req_tourism WHERE id = ".$_GET['new']);
        $data = mysqli_fetch_array($query);
        $name = $data['name'];
        $province = $data['province'];
        $city = $data['regency'];
        $image = $data['image'];
        $description = $data['description'];
        $price = $data['price'];
        $rating = 0;
        $query = mysqli_query($conn, "INSERT INTO tourism (name, province, regency, image, description, price, rating) VALUES ('$name', '$province', '$city', '$image', '$description', $price, $rating)");
        $query = mysqli_query($conn, "DELETE FROM req_tourism WHERE id = ".$_GET['new']);
        echo"
            <script>
                alert('New Place Added!');
                document.location.href = 'index.php?#forYou';
            </script>
        ";
    }
    if(isset($_POST['feedback'])){
        $place_id = $_POST['place_id'];
        $username = $_POST['username'];
        $rate = $_POST['rate'];
        $comment = $_POST['comment'];
        if(empty($username)){
             echo"
                <script>
                    alert('Login First Before Give a Rating!');
                    document.location.href = 'login.php?login=false';
                </script>
            ";
        }

        if($rate == ""){
            $query = mysqli_query($conn, "SELECT * FROM tourism where id = $place_id");
            $data = mysqli_fetch_array($query);
            $place = $data['name'];
            echo"
                <script>
                    alert('Please rate the place while you give a comment!');
                    document.location.href = 'view.php?place=$place&?#info';
                </script>
            ";
        }
        else{
            $query = mysqli_query($conn, "SELECT a.username, f.username from account a inner join feedback f on a.username = f.username where a.username = '$username' and f.place_id = $place_id");
            $amount = mysqli_num_rows($query);
            if($amount > 0){
                $query = mysqli_query($conn, "UPDATE feedback SET rating = $rate, comment = '$comment' WHERE username = '$username' and place_id = $place_id");
                $query = mysqli_query($conn, "select t.id as id, t.name as name, t.province as province, t.regency as regency, t.image as image, t.description as description, t.price as price, t.rating as rating, f.rating as rates from tourism t inner join feedback f on t.id = f.place_id where t.id= $place_id");
                $rateTemp = 0;
                $amount = mysqli_num_rows($query);
                while($data = mysqli_fetch_array($query)){
                    $rateTemp += $data['rates'];
                    $place = $data['name'];
                }
                $rating = ($rateTemp/$amount);
                $insertRating = mysqli_query($conn, "UPDATE tourism SET rating = $rating WHERE name = '$place'");
                echo"
                    <script>
                        alert('Will replace your before rating!');
                        document.location.href = 'view.php?place=$place&?#info';
                    </script>
                ";
            }
            else{
                $query = mysqli_query($conn, "INSERT INTO feedback ( place_id, username, comment, rating) VALUES ($place_id ,'$username',  '$comment', $rate)");
                $query = mysqli_query($conn, "select t.id as id, t.name as name, t.province as province, t.regency as regency, t.image as image, t.description as description, t.price as price, t.rating as rating, f.rating as rates from tourism t inner join feedback f on t.id = f.place_id where t.id= $place_id");
                $rateTemp = 0;
                $amount = mysqli_num_rows($query);
                while($data = mysqli_fetch_array($query)){
                    $rateTemp += $data['rates'];
                    $place = $data['name'];
                }
                $rating = ($rateTemp/$amount);
                $insertRating = mysqli_query($conn, "UPDATE tourism SET rating = $rating WHERE name = '$place'");
                echo"
                    <script>
                        alert('Thank you for your rating!');
                        document.location.href = 'view.php?place=$place&?#info';
                    </script>
                ";
            }
        }
    }
    if(isset($_GET['decline'])){
        $query = mysqli_query($conn, "DELETE FROM req_tourism WHERE id = ".$_GET['decline']);
            echo"
                <script>
                    alert('Request place declined!');
                    document.location.href = 'add.php?destination';
                </script>
            ";
    }
    if(isset($_GET['delete'])){
        $name = $_GET['delete'];
        $query = mysqli_query($conn, "DELETE FROM tourism WHERE name = '$name'");
            echo"
                <script>
                    alert('Place deleted successfully!');
                    document.location.href = 'index.php?#forYou';
                </script>
            ";
    }
?>