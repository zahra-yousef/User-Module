<?php
    session_start();
    
    include "connection.php";
    
    $uname = $pass = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
        $uname = validate($_POST["username"]);
        $pass = validate($_POST["password"]);

        if (empty($uname)) {
            header("Location: login_form.php?error=Username is required!");
            exit();
        }else if (empty($pass)) {
            header("Location: login_form.php?error=Password is required!");
            exit();
        }else {
            $pass = md5($pass); 
            $sql = "SELECT * FROM users WHERE user_name = '$uname' AND password = '$pass'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) === 1){
                $row = mysqli_fetch_assoc($result);

                 if ($row['user_name'] === $uname && $row['password'] === $pass) {
                    $_SESSION['user_name'] = $row['user_name'];
                    $_SESSION['first_name'] = $row['first_name'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['dob'] = $row['dob'];
                    $_SESSION['phone'] = $row['phone'];

                    header("Location: index.php");
                    exit();
                 } else {
                    header("Location: login_form.php?error=Incorect User name or password");
                    exit();
                }
            } else {
                header("Location: login_form.php?error=Incorect User name or password");
                exit();
            }
        }
    } else {
        header("Location: login_form.php");
        exit();
    }