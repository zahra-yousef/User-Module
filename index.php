<?php 
    session_start();
    if(isset($_SESSION['id'])){
        
        include "query_user.php";
        
        if ($_SESSION['user_type'] == "User" && $_SESSION['status'] == 1){  
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>NewTech - Home</title>      
    </head>
    <body>
        <?php include 'header.php';?>
        
        <header>
            <h1 class="section2Header">The Services of New Tech</h1>
        </header>
        
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <div class="box">
                        <div class="icon">
                            <img src="images/code.png">
                        </div>
                         <label>Programming Courses</label>
                        
<!--                        https://www.lipsum.com/-->
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                            when an unknown printer took a galley of type 
                            and scrambled it to make a type specimen book.</p>
                    </div>
                </div>
                
                <div class="col-4">
                    <div class="box">
                        <div class="icon">
                            <img src="images/code.png">
                        </div>
                         <label>Programming Challenges</label>
                        
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                            when an unknown printer took a galley of type 
                            and scrambled it to make a type specimen book.</p>
                    </div>
                </div>
            
                <div class="col-4">
                    <div class="box">
                        <div class="icon">
                            <img src="images/code.png">
                        </div>
                         <label>Programming Community</label>
                        
                        <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                            when an unknown printer took a galley of type 
                            and scrambled it to make a type specimen book.</p>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <button class="learnMore">Learn More</button>
                </div>
            </div>
        </div>
        
        <?php include 'footer.php';?>
    </body>
</html>
<?php
        }else{
            if ($_SESSION['user_type'] == "Admin" && $_SESSION['status'] == 1){
                header("Location: logout.php");
                exit();
            }else if($_SESSION['status'] == 0){
                $e_msg = "User forbidden from accessing this webpage.";
                echo "<script type='text/javascript'>alert('$e_msg');</script>";
            } 
        }
    }else{
        header("Location: login_form.php");
        exit();
    }