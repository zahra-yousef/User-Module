<?php
session_start();
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $name = validate($_POST["name"]);
    $uname = validate($_POST["username"]);
    $email = validate($_POST["email"]);
    $dob = date('Y-m-d', strtotime($_POST['dob']));
    $pass = validate($_POST["password"]);
    $cpass = validate($_POST["cpassword"]);
    $phone = validate($_POST["phone"]);
    $utype = validate($_POST["utype"]);

    $user_data = 'uname='. $uname. '&name='.$name
                 .'&email='. $email. '&dob='.$dob
                 .'&phone='.$phone;    


    if(empty($name)){
        header("Location: signup_form.php?error=Name is required!&$user_data");
        exit();  
    }else if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) { 
        header("Location: signup_form.php?error=Only letters and white space allowed!&$user_data");
        exit();
    }else if (empty($uname)) {
        header("Location: signup_form.php?error=Username is required!&$user_data");
        exit();
    }else if(empty($email)){
        header("Location: signup_form.php?error=Email is required!&$user_data");
        exit();
    }else if(preg_match('/^[0-9]{11}+$/', $phone)){ 
        header("Location: signup_form.php?error=Phone is invalid!&$user_data");
        exit();
    }else if (empty($pass)) {
        header("Location: signup_form.php?error=Password is required!&$user_data");
        exit();
    }else if ($pass !== $cpass) {
        header("Location: signup_form.php?error=The confirmation password does not "
            . "match&$user_data");
        exit();
    }else{
        if($dob == '1970-01-01'){
            $dob = '';
        }
        if(empty ($phone)){
            $phone = '';
        }
        $image = '';

        //hashing the password
        $pass = md5($pass); 
        $sql = "SELECT * FROM `users` WHERE user_name = '$uname' OR email = '$email'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
            header("Location: signup_form.php?error=The username or email are taken try another "
                . "&$user_data");
            exit();
        }else{
            $status = 1;
            $sql2 = "INSERT INTO `users` (`user_name`, `email`, `password`, `dob`, `first_name`, `phone`, `image`, `user_type`, `status`) 
                     VALUES ('$uname', '$email', '$pass', NULLIF('$dob', ''), '$name', NULLIF('$phone', ''), NULLIF('$image', ''), NULLIF('$utype', ''), '$status')";

            $result2 = mysqli_query($conn, $sql2);

            if ($result2) {
                $sql3 = "SELECT * FROM `users` WHERE user_name = '$uname'";
                $result3 = mysqli_query($conn, $sql3);
                $row = mysqli_fetch_assoc($result3);
                $_SESSION['id'] = $row['id'];

                $_SESSION['user_name'] = $uname;
                $_SESSION['first_name'] = $name;
                $_SESSION['email'] = $email;
                $_SESSION['dob'] = $dob;
                $_SESSION['phone'] = $phone;
                $_SESSION['status'] = $status;
                $_SESSION['user_type'] = $utype;

                if($utype  == "User"){
                    header("Location: index.php");
                    exit();
                } else {
                    header("Location: admin_form.php");
                    exit();
                } 
            }else {
                header("Location: signup_form.php?error=unknown error occurred&$user_data");
                exit();
            }
        }
    }
} else {
    header("Location: signup_form.php");
    exit();
}