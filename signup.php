<?php
    /*#2 - Get Data from the Form*/
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
        $dob = validate($_POST["dob"]);
        $pass = validate($_POST["password"]);
        $cpass = validate($_POST["cpassword"]);
        $phone = validate($_POST["phone"]);
        
        if (empty($_POST["username"])) {
            header("Location: signup_form.php?error=Username is required!");
            exit();
        } else if(empty($_POST["name"])){
            
            
            
        } else if (!preg_match("/^[a-zA-Z-' ]*$/",$uname)) { // check if name only contains letters and whitespace
              $unameErr = "Only letters and white space allowed";
        }
      
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            // Remove all illegal characters from email
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);

            // Validate e-mail
            if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
              echo("$email is a valid email address");
            } else {
              echo("$email is not a valid email address");
            }
        }
        
        if (empty($_POST["DOB"])) {
            $dobErr = "Birth date is required";
        } else {
            $dob = test_input($_POST["DOB"]);
        }
        
        if (empty($_POST["password"])) {
            $passErr = "Password is required";
        } else {
            $pass = test_input($_POST["password"]);
        }
        
        if (empty($_POST["cpassword"])) {
            $cpassErr = "Confirming Password is required";
        } else {
            $cpass = test_input($_POST["cpassword"]);
        }
    } else {
        header("Location: signup_form.php");
        exit();
    }

    

    
    /*#3 - Insert data into DB*/
    $sql = "INSERT INTO test1 (id, name)
            VALUES ('$id', '$fname')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
