<?php 
session_start();
require 'query_user.php';

if ($_SESSION['user_type'] == "User" && $_SESSION['status'] == 1){
    $title = "Delete User"; 
    include 'header.php';
?><body>
    <?php include 'navbar.php';?>
    <header>
        <h1 class="section2Header">Hello, <?php echo $_SESSION['user_name'];?></h1>
    </header>
    <div class="container">
        <form action="delete_user.php" method="post">
            <div class="row">
                <div class="col-0" id="formCenter">
                    <div class="loginForm">
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
<?php 
}else{
    require 'auth_check.php';
}
