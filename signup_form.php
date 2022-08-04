<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>NewTech - Signup</title>
        <link rel="stylesheet" href="styleSheets/styles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php include 'header.php';?>
        
        <header>
            <h1 class="section2Header">Create a new account..</h1>
        </header>
        
         <div class="container">
            <div class="row">
                <div class="col-0" id="formCenter">
                    <form action="index.php" method="index.php">
                        <div class="loginForm">
                            <?php if(isset($_GET['error'])) { ?> 
                                <p class="error"><?php echo $_GET['error'];?></p>
                            <?php } ?>
                            
                            <h2>Name</h2>
                            <input class="inputbox" name="name" type="text" placeholder="Enter name">
                            <br><br>
                                
                            <h2>Username</h2>
                            <input class="inputbox" name="username" type="text" placeholder="Enter username">
                            <br><br>
                            
                            <h2>Email</h2>
                            <input class="inputbox" name="email" type="text" placeholder="Enter email">
                            <br><br>
                            
                            <h2>Birth Date</h2>
                            <input class="inputbox" name="DOB" type="text" placeholder="Enter date of birth">
                            <br><br>
                            
                            <h2>Phone</h2>
                            <input class="inputbox" name="phone" type="text" placeholder="Enter phone number">
                            <br><br>
                            
                            <h2>Password</h2>
                            <input class="inputbox" name="password" type="text" placeholder="Enter password">
                            <br><br>
                            
                            <h2>Confirm Password</h2>
                            <input class="inputbox" name="cpassword" type="text" placeholder="Re-Enter password">
                            <br><br>
                            
                            <button type="submit" class="loginButton">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <?php include 'footer.php';?>
    </body>
</html>
