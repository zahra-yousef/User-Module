<?php
session_start();
require 'connection.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $name = validate($_POST["name"]);
    $email = validate($_POST["email"]);
    $phone = validate($_POST["phone"]);
    $dob = validate($_POST["dob"]);
    $uname = $_SESSION['user_name'];

    $update_image = $_FILES['profile_image']['name'];
    $update_image_size = $_FILES['profile_image']['size'];
    $update_image_tmp_name = $_FILES['profile_image']['tmp_name'];
    $update_image_folder = 'uploaded_img/'.$update_image;
    
    //Check image type
    $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG);
    $detectedType = exif_imagetype($update_image_tmp_name);
    $error = !in_array($detectedType, $allowedTypes);

    if(empty($name)){
        header("Location: profile_form.php?error=Name is required!");
        exit();
    }else if(empty($email)){
        header("Location: profile_form.php?error=Email is required!");
        exit();
    }else if (empty($phone)) {
        header("Location: profile_form.php?error=Phone is required!");
        exit();
    }else if ($dob == '1970-01-01') {
        header("Location: profile_form.php?error=Date of Birth is required!");
        exit();
    }else{
        $sql = "SELECT * FROM users WHERE user_name = '$uname'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) === 1){
            $sql = "UPDATE `users` SET email='$email', first_name ='$name', phone='$phone', dob='$dob' WHERE user_name='$uname'";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['first_name'] = $name;
                $_SESSION['email'] = $email;
                $_SESSION['phone'] = $phone;
                $_SESSION['dob'] = $dob;
                
                 if(!empty($update_image)){
                    $error = !in_array($detectedType, $allowedTypes);
                    if($update_image_size > 2000000){
                        header("Location: profile_form.php?error=Image is too large.");
                        exit();
                    }else if($error == 1) {
                        header("Location: profile_form.php?error=Sorry, only JPG, JPEG and PNG files are allowed.");
                        exit();
                    }else{
                        $image_update_query = mysqli_query($conn, "UPDATE `users` SET image = '$update_image' WHERE user_name = '$uname'") 
                                or die('query failed');
                        if($image_update_query){
                            move_uploaded_file($update_image_tmp_name, $update_image_folder);
                        }
                        header("Location: profile_form.php?success=Account information updated succesfully.");
                        exit();
                    }
                }
                header("Location: profile_form.php?success=Account information updated succesfully.");
                exit();
            } else {
                header("Location: profile_form.php?error=Error updating account info.");
                exit();
            }
        }else{
            header("Location: profile_form.php?error=Your information are invalid!");
            exit();
        }
    }
}
