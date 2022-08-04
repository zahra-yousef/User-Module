<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>NewTech - Login</title>
        <link rel="stylesheet" href="styleSheets/styles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php include 'header.php';?>
        
        <header>
            <h1 class="section2Header">Login to your account..</h1>
        </header>
        
         <div class="container">
            <div class="row">
                <div class="col-0" id="formCenter">
                    <form action="login.php" method="post">
                        <div class="loginForm">
                            <?php if(isset($_GET['error'])) { ?> 
                                <p class="error"><?php echo $_GET['error'];?></p>
                            <?php } ?>
                            
                            <h2>Username</h2>
                            <input class="inputbox" name="username" type="text" placeholder="Enter username or email">
                            <br><br>
                            
                            <h2>Password</h2>
                            <input class="inputbox" name="password" type="text" placeholder="Enter password">
                            <br><br>
                            
                            <button class="loginButton">Let's Go!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
         <?php include 'footer.php';?>
    </body>
</html>
