<?php
    session_start();
    include "connection.php";

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
        $user_type = validate($_POST["utype"]);
        
//        if(!empty($_POST["adminChbx"])){
//            $user_type = validate($_POST["adminChbx"]);
//            echo $user_type;
//        } else {
//            $user_type = "User";
//        }

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
            if($dob == '1970-01-01'){
                $dob = '';
            }
            if(empty ($phone)){
                $phone = '';
            }
            $image = '';
            
            //hashing the password
            $pass = md5($pass); 
            $sql = "SELECT * FROM users WHERE user_name = '$uname'";
            $result = mysqli_query($conn, $sql);
            
            if(mysqli_num_rows($result) > 0){
                header("Location: signup_form.php?error=The username is taken try another "
                    . "&$user_data");
                exit();
            }else{
                $status = 1;
                $sql2 = "INSERT INTO `users` (`user_name`, `email`, `password`, `dob`, `first_name`, `phone`, `image`, `user_type`, `status`) 
                         VALUES ('$uname', '$email', '$pass', NULLIF('$dob', ''), '$name', NULLIF('$phone', ''), NULLIF('$image', ''), NULLIF('$user_type', ''), '$status')";

                $result2 = mysqli_query($conn, $sql2);
                
                if ($result2) {
                    $sql3 = "SELECT * FROM users WHERE user_name = '$uname'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $_SESSION['id'] = $row['id'];
                    
                    $_SESSION['user_name'] = $uname;
                    $_SESSION['first_name'] = $name;
                    $_SESSION['email'] = $email;
                    $_SESSION['dob'] = $dob;
                    $_SESSION['phone'] = $phone;
                    $_SESSION['status'] = $status;
                    
                    if($user_type == "user"){
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