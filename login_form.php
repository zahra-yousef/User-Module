<?php 
    session_start();
    if(!isset($_SESSION['user_name']) && !isset($_SESSION['user_type'])){ 
        $title = "Login"; 
        include 'header.php';
?><body>
    <?php include 'navbar.php';?>
    <script>
        document.getElementById("logout-tab").style.display = 'none';
        document.getElementById("profile-tab").style.display = 'none';
    </script>
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
                        <input class="inputbox" name="username" type="text" placeholder="Enter username">
                        <br><br>

                        <h2>Password</h2>
                        <input class="inputbox" name="password" type="password" placeholder="Enter password">
                        <br><br>

                        <button class="loginButton">Let's Go!</button>
                    </div>
                </form>
                <a href="signup_form.php" class="loginLink">Create an account</a>
            </div>
        </div>
    </div>

     <?php include 'footer.php';?>
</body>
<?php 
    }else{
        if($_SESSION['user_type'] == 'User'){
            header("Location: index.php");
            exit(); 
        }else if($_SESSION['user_type'] == 'Admin'){
            header("Location: admin_form.php");
            exit(); 
        }
        
}