<?php
/*This script used to query user info and update them based in db*/
include "connection.php";
$id = $_SESSION['id'];

$select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$id'") 
        or die('query failed');

if(mysqli_num_rows($select) > 0){
    $row = mysqli_fetch_assoc($select);
    
    $_SESSION['id'] = $row['id'];
    $_SESSION['user_name'] = $row['user_name'];
    $_SESSION['first_name'] = $row['first_name'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['dob'] = $row['dob'];
    $_SESSION['phone'] = $row['phone'];
    $_SESSION['user_type'] = $row['user_type'];
    $_SESSION['status'] = $row['status'];
    $_SESSION['image'] = $row['image'];
} else {
    header("Location: logout.php");
    exit();
}


