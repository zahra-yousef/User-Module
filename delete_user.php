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

    $pass = validate($_POST["password"]);
    $email = validate($_POST["email"]);
    $uname = $_SESSION['user_name'];
            
    $user_data = 'uname='. $uname
                .'&email='. $email
                .'&password='.$pass;

    if(empty($email)){
        header("Location: delete_form.php?error=Email is required!&$user_data");
        exit();
    }else if (empty($pass)) {
        header("Location: delete_form.php?error=Password is required!");
        exit();
    }else{
        $pass = md5($pass); 
        $sql = "SELECT * FROM users WHERE user_name = '$uname' "
               . "AND password = '$pass' AND email = '$email'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) === 1){
            $sql = "DELETE FROM users WHERE user_name='$uname'";
            if (mysqli_query($conn, $sql)) {
                header("Location: delete_form.php?success=Account deleted succesfully");
                exit();
            } else {
                header("Location: delete_form.php?error=Error deleting account");
                exit();
            }
        }else{
            header("Location: delete_form.php?error=Your information are invalid!");
            exit();
        }
    }        
}
