<?php
session_start();
require 'connection.php';

$id = $_REQUEST['id'];
$status = $_REQUEST['status'];

if($status == -1){ //delete
    $query = "DELETE FROM users WHERE id='$id'";
    
    if (mysqli_query($conn, $query)) {
        header("Location: admin_form.php?success=Account deleted succesfully");
        exit();
    } else {
        header("Location: admin_form.php?error=Error deleting account");
        exit();
    }
}else{
    if($status == 1){ //block
        $status = 0;
    }else if($status == 0){ //unblock
        $status = 1;  
    }
    $sql = "UPDATE users SET status='$status' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: admin_form.php?success=Account blocked succesfully");
        exit();
    }
}




