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
    $email = validate($_POST["email"]);
    $phone = validate($_POST["phone"]);
    $uname = $_SESSION['user_name'];
            
    $user_data = 'uname='. $uname
                .'&name='. $name
                .'&email='. $email
                .'&phone='.$phone;

    if(empty($name)){
        header("Location: profile_form.php?error=Name is required!&$user_data");
        exit();
    }else if(empty($email)){
        header("Location: profile_form.php?error=Email is required!&$user_data");
        exit();
    }else if (empty($phone)) {
        header("Location: profile_form.php?error=Phone is required!&$user_data");
        exit();
    }else{
        $sql = "SELECT * FROM users WHERE user_name = '$uname'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) === 1){
            $sql = "UPDATE users SET email='$email', first_name ='$name', phone='$phone' WHERE user_name='$uname'";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['first_name'] = $name;
                $_SESSION['email'] = $email;
                $_SESSION['phone'] = $phone;
                header("Location: profile_form.php?success=Account information updated succesfully.&$user_data");
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
