<?php 
    session_start();
    if(isset($_SESSION['user_name']) 
      && isset($_SESSION['emai'])){
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
         <title>NewTech - Delete Account</title>
        <link rel="stylesheet" href="styleSheets/styles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php include 'header.php';?>
        
        <header>
            <h1 class="section2Header">Hello, <?php echo $_SESSION['user_name'];?></h1>
        </header>
        
        <div class="container">
            <form action="delete_user.php" method="post">
                <div class="row">
                    <div class="col-7" id="formCenter">
                        <div class="box">
                            <div class="icon">
                                <img src="images/user.png">
                            </div>

                            <?php if(isset($_GET['error'])) { ?> 
                                <p class="error"><?php echo $_GET['error'];?></p>
                            <?php } ?>  
                                
                            <?php if(isset($_GET['success'])) { ?> 
                                <p class="success"><?php echo $_GET['success'];?></p>
                            <?php } ?> 
                            <label>Your Email: </label><br>
                            <input
                                   class="profilebox" 
                                   name="email" 
                                   type="text" 
                                   placeholder="Enter your email"
                                   ><br><br>
                            
                            <label>Your Password: </label><br>
                            <input 
                                   class="profilebox" 
                                   name="password" 
                                   type="password" 
                                   placeholder="Enter your password"
                                    ><br><br>
                        </div>              
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <button id="saveButton" class="learnMore" name="saveButton">Confirm</button>
                    </div>
                </div>
             </form> 
        </div>
        <?php include 'footer.php';?>
    </body>
</html>
<?php 
    }else{
        header("Location: login_form.php");
        exit();
    }
