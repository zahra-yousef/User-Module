<?php
    /*#1 - Set Connection*/
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "user_module";
    
    // Create connection
    $conn= new mysqli($server, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    