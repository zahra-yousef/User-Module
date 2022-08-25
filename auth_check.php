<?php
if(empty($_SESSION['id'])){
    header("Location: login_form.php");
    exit();
}else{
    if($_SESSION['status'] == 0){
        $e_msg = "User forbidden from accessing this webpage.";
        echo "<script type='text/javascript'>alert('$e_msg');</script>";
    }else{
        if($_SESSION['user_type'] == "Admin"){
            header("Location: admin_form.php");
            exit();
        }else{
            header("Location: index.php");
            exit();
        }
    }
}
