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

    $pass = validate($_POST["password"]);
    $email = validate($_POST["email"]);
    $id = $_SESSION['id'];

    if(empty($email)){
        header("Location: delete_form.php?error=Email is required!");
        exit();
    }else if (empty($pass)) {
        header("Location: delete_form.php?error=Password is required!");
        exit();
    }else{
        $pass = md5($pass); 
        $sql = "SELECT * FROM users WHERE id = '$id' "
               . "AND password = '$pass' AND email = '$email'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) === 1){
            $sql = "DELETE FROM users WHERE id='$id'";
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
