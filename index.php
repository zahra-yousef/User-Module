<?php 
    session_start();
    if(isset($_SESSION['user_name']) && isset($_SESSION['first_name'])
        && isset($_SESSION['email']) && isset($_SESSION['dob'])
        && isset($_SESSION['phone']) ){
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>NewTech - Home</title>
        <link rel="stylesheet" href="styleSheets/styles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
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
        header("Location: login_form.php");
        exit();
    }
