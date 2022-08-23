<?php 
    session_start();
    if(!isset($_SESSION['user_name']) && !isset($_SESSION['user_type'])){
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>NewTech - Signup</title>
    <body>
        <?php include 'header.php';?>
        <script>
            document.getElementById("logout-tab").style.display = 'none';
            document.getElementById("profile-tab").style.display = 'none';
        </script>
        
        <header>
            <h1 class="section2Header">Create a new account..</h1>
        </header>
        
         <div class="container">
            <div class="row">
                <div class="col-0" id="formCenter">
                    <form action="signup.php" method="post">
                        <div class="loginForm">
                            <?php if(isset($_GET['error'])) { ?> 
                                <p class="error"><?php echo $_GET['error'];?></p>
                            <?php } ?>

                            <h2>Name</h2>
                            <?php if(isset($_GET['name'])) { ?> 
                                <input class="inputbox" 
                                       name="name" 
                                       type="text" 
                                       placeholder="Enter name" 
                                       value="<?php echo $_GET['name'];?>">
                                <br><br>
                            <?php } else {?>
                                <input class="inputbox" 
                                       name="name" 
                                       type="text" 
                                       placeholder="Enter name">
                                <br><br>
                            <?php  } ?>
                                
                            <h2>Username</h2>
                            <?php if(isset($_GET['uname'])) { ?> 
                                <input class="inputbox" 
                                       name="username" 
                                       type="text" 
                                       placeholder="Enter username"
                                       value="<?php echo $_GET['uname'];?>">
                                <br><br>
                            <?php } else {?>
                                <input class="inputbox" 
                                       name="username" 
                                       type="text" 
                                       placeholder="Enter username">
                                <br><br>
                            <?php  } ?>
                                
                            <h2>Email</h2>
                            <?php if(isset($_GET['email'])) { ?>
                                <input class="inputbox" 
                                       name="email" 
                                       type="text" 
                                       placeholder="Enter email"
                                       value ="<?php echo $_GET['email'];?>">
                                <br><br>
                            <?php } else {?>
                                <input class="inputbox" 
                                       name="email" 
                                       type="text" 
                                       placeholder="Enter email">
                                <br><br>
                            <?php  } ?>   
                                
                            <h2>Birth Date</h2>
                            <input  type="date" name="dob" value="0000-00-00">
                            
                            <h2>Phone</h2>
                            <input class="inputbox" 
                                   name="phone" 
                                   type="text" 
                                   placeholder="Enter phone number">
                            <br><br>
                            
                            <h2>Password</h2>
                            <input class="inputbox" 
                                   name="password" 
                                   type="password" 
                                   placeholder="Enter password">
                            <br><br>
                            
                            <h2>Confirm Password</h2>
                            <input class="inputbox" 
                                   name="cpassword" 
                                   type="password" 
                                   placeholder="Re-Enter password">
                            <br><br>
                            
                            <h2>User Type: </h2>
                            <select id="usersSelect" 
                                    name="utype">
                                <option value="User">Normal User</option>
                                <option value="Admin">Admin</option>
                            </select><br><br>
                            <button type="submit" class="loginButton">Submit</button>
                        </div>
                    </form>
                    <a href="login_form.php" class="loginLink">Already have an account?</a>
                </div>
            </div>
        </div>
        
        <?php include 'footer.php';?>
    </body>
</html>
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