<?php 

$conn = mysqli_connect("localhost", "root", "", "cocomelon");

function uploadImage(){
    $name = $_FILES['image']['name'];
    $size = $_FILES['image']['size'];
    $error = $_FILES['image']['error'];
    $tempName = $_FILES['image']['tmp_name']; 
    $success = true;
    if($error === 4){
        $success = false;
        echo"
            <script>
                alert('Account created without profile picture');
            </script>
        ";
    }
    $validFileExtension = ['jpg', 'jpeg', 'png', 'svg', 'webp']; //list ekstensi yg valid
    $FileExtension = explode('.', $name); //memecah nama file  menjadi array setiap ada karakter '.'
    $FileExtension = strtolower(end($FileExtension)); //to lower semua nama file agar masuk ke file ekstensi yang VALID
    if($success){
        if(!in_array($FileExtension, $validFileExtension)){
            echo"
                <script>
                    alert('Not valid file extension!');
                </script>
            ";
            return false;
        }
        if($size > 1000000000){
            echo"
                <script>
                    alert('Too big size image!');
                </script>
            ";
            return false;
        }
    }
    move_uploaded_file($tempName, 'img/profile/'.$name); //memindahkan file ke folder img/profile
    return $name;
}
// function editImage(){
//     $name = $_FILES['image']['name'];
//     $size = $_FILES['image']['size'];
//     $error = $_FILES['image']['error'];
//     $tempName = $_FILES['image']['tmp_name']; 
//     $success = true;
//     if($error === 4){
//         $success = false;
//         echo"
//             <script>
//                 alert('Account created without profile picture');
//             </script>
//         ";
//     }
//     $validFileExtension = ['jpg', 'jpeg', 'png', 'svg']; //list ekstensi yg valid
//     $FileExtension = explode('.', $name); //memecah nama file  menjadi array setiap ada karakter '.'
//     $FileExtension = strtolower(end($FileExtension)); //to lower semua nama file agar masuk ke file ekstensi yang VALID
//     if($success){
//         if(!in_array($FileExtension, $validFileExtension)){
//             echo"
//                 <script>
//                     alert('Not valid file extension!');
//                 </script>
//             ";
//             return false;
//         }
//         if($size > 1000000000){
//             echo"
//                 <script>
//                     alert('Too big size image!');
//                 </script>
//             ";
//             return false;
//         }
//     }
//     move_uploaded_file($tempName, 'img/profile/'.$name); //memindahkan file ke folder img/profile
//     return $name;
// }
function uploadImagePlace(){
    $name = $_FILES['image']['name'];
    $size = $_FILES['image']['size'];
    $error = $_FILES['image']['error'];
    $tempName = $_FILES['image']['tmp_name']; 
    $success = true;
    if($error === 4){
        $success = false;
        echo"
            <script>
                alert('Account created without profile picture');
            </script>
        ";
    }
    $validFileExtension = ['jpg', 'jpeg', 'png', 'svg', 'webp']; //list ekstensi yg valid
    $FileExtension = explode('.', $name); //memecah nama file  menjadi array setiap ada karakter '.'
    $FileExtension = strtolower(end($FileExtension)); //to lower semua nama file agar masuk ke file ekstensi yang VALID
    if($success){
        if(!in_array($FileExtension, $validFileExtension)){
            echo"
                <script>
                    alert('Not valid file extension!');
                </script>
            ";
            return false;
        }
        if($size > 1000000000){
            echo"
                <script>
                    alert('Too big size image!');
                </script>
            ";
            return false;
        }
    }
    move_uploaded_file($tempName, 'img/place/'.$name); //memindahkan file ke folder img/place
    return $name;
}
?>
