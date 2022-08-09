<?php
    session_start();

    include "connection.php";

    $uname = $name = $email = $dob = $pass = $cpass = $phone = "";

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
        
        $user_data = 'uname='. $uname. '&name='.$name
                     .'&email='. $email. '&dob='.$dob
                     .'&phone='.$phone;
        
        if(empty($name)){
            header("Location: signup_form.php?error=Name is required!&$user_data");
            exit();  
        }else if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) { // check if name only contains letters and whitespace
            header("Location: signup_form.php?error=Only letters and white space allowed!&$user_data");
            exit();
        }else if (empty($uname)) {
            header("Location: signup_form.php?error=Username is required!&$user_data");
            exit();
        }else if(empty($email)){
            header("Location: signup_form.php?error=Email is required!&$user_data");
            exit();
        }else if(preg_match('/^[0-9]{11}+$/', $phone)){ 
            //https://www.delftstack.com/howto/php/php-validate-phone-number/
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
            echo $phone. '  '. $dob;
            //hashing the password
            $pass = md5($pass); 
            $sql = "SELECT * FROM users WHERE user_name = '$uname'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0){
                header("Location: signup_form.php?error=The username is taken try another "
                    . "&$user_data");
                exit();
            }else{
                $sql2 = "INSERT INTO users(user_name, email, password, dob, first_name, phone) "
                        . "VALUES('$uname', '$email', '$pass', '$dob', '$name', '$phone')";
                $result2 = mysqli_query($conn, $sql2);

                if ($result2) {
                    header("Location: home_form.php");
                    exit();
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