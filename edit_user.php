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
    
    $uid = $_REQUEST['uid'];
    $uname = validate($_POST["uname"]);  
    $email = validate($_POST["email"]);
    $name = validate($_POST["name"]);
    $phone = validate($_POST["phone"]);
    $utype = validate($_POST["utype"]);
    
    $update_image = $_FILES['profile_image']['name'];
    $update_image_size = $_FILES['profile_image']['size'];
    $update_image_tmp_name = $_FILES['profile_image']['tmp_name'];
    $update_image_folder = 'uploaded_img/'.$update_image;
    
    //Check image type
    $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG);
    $detectedType = exif_imagetype($update_image_tmp_name);
    $error = !in_array($detectedType, $allowedTypes);
    
    if(empty($uname)){
        header("Location: editUser_form.php?id=$uid&error=Name is empty!");
        exit();
    }else if(empty($email)){
        header("Location: editUser_form.php?id=$uid&error=Email is empty!");
        exit();
    }else if(empty($name)){
        header("Location: editUser_form.php?id=$uid&error=Name is empty!");
        exit();
    }else if (empty($phone)) {
        header("Location: editUser_form.php?id=$uid&error=Phone is empty!");
        exit();
    }else if (empty($utype)) {
        header("Location: editUser_form.php?id=$uid&error=User type is empty!");
        exit();
    }else{
        $sql = "SELECT * FROM users WHERE id = '$uid'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) === 1){
            $sql2 = "UPDATE users SET "
                     . "user_name='$uname', "
                     . "email='$email', "
                     . "first_name ='$name', "
                     . "phone='$phone', "
                     . "user_type='$utype' "
                     . "WHERE id='$uid'";

            if (mysqli_query($conn, $sql2)) {
                if(!empty($update_image)){
                    $error = !in_array($detectedType, $allowedTypes);
                    if($update_image_size > 2000000){
                        header("Location: editUser_form.php?error=Image is too large.");
                        exit();
                    }else if($error == 1) {
                        header("Location: editUser_form.php?error=Sorry, only JPG, JPEG and PNG files are allowed.");
                        exit();
                    }else{
                        $image_update_query = mysqli_query($conn, "UPDATE `users` SET image = '$update_image' WHERE user_name = '$uname'") 
                                or die('query failed');
                        if($image_update_query){
                            move_uploaded_file($update_image_tmp_name, $update_image_folder);
                        }
                        header("Location: editUser_form.php?id=$uid&success=Account information updated succesfully.");
                        exit();
                    }
                }
                header("Location: editUser_form.php?id=$uid&success=User information updated succesfully.");
                exit();
            }else{
                header("Location: editUser_form.php?id=$uid&error=User information are not updated succesfully.");
                exit();
            }
        }else{
            header("Location: editUser_form.php?id=$uid&error=User does not exist.");
            exit();
        }
    }
}