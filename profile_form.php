<?php 
    session_start();
    if(isset($_SESSION['user_name']) && isset($_SESSION['first_name'])
      && isset($_SESSION['email']) && isset($_SESSION['dob'])
      && isset($_SESSION['phone'])  ){
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>NewTech - Profile</title>
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
            <form action="#" method="post">
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
                                
                            <label>Your Name: </label><br>
                            <input id="nameTxt" 
                                   class="profilebox" 
                                   name="name" 
                                   type="text" 
                                   value="<?php echo $_SESSION['first_name'];?>"
                                   disabled ><br><br>

                            <label>Your Email: </label><br>
                            <input id="emailTxt" 
                                   class="profilebox" 
                                   name="email" 
                                   type="text" 
                                   value="<?php echo $_SESSION['email'];?>"
                                   disabled><br><br>

                            <label>Your Phone: </label><br>
                             <input id="phoneTxt" 
                                    class="profilebox" 
                                    name="phone" 
                                    type="text" 
                                    value="<?php echo $_SESSION['phone'];?>"
                                    disabled><br><br>

                            <label>Your Birth Date: </label><br>
                            <input id="bdateTxt" 
                                   class="profilebox"
                                   name="dob" 
                                   type="text" 
                                   value="<?php echo $_SESSION['dob'];?>"
                                   disabled><br><br> 
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <button id="deleteButton" 
                                class="learnMore" 
                                name="deleteButton"
                                type="submit"
                                formaction="delete_form.php">
                            Delete Account
                        </button>
                        <button id="saveButton" 
                                class="learnMore" 
                                name="saveButton"
                                type="submit"
                                formaction="profile.php">
                            Save Changes
                        </button>
                    </div>
                </div>
             </form> 
                <button id="editButton" 
                        class="learnMore" name="editButton">Edit User</button>
        </div>
        
        <script>
            document.getElementById("saveButton").style.display = "none";
            
//            https://www.techiedelight.com/disable-enable-input-text-box-javascript/
            document.getElementById('editButton').onclick = function(){
                document.getElementById("editButton").style.display = "none";
                document.getElementById("saveButton").style.display = "block";
                const ids = ["nameTxt", "emailTxt", "phoneTxt", "bdateTxt"];
                for (let i = 0; i < 3; i++) {
                    var disabled = document.getElementById(ids[i]).disabled;

                    if (disabled) {
                        document.getElementById(ids[i]).disabled = false;
                    }
                    else {
                        document.getElementById(ids[i]).disabled = true;
                    }
                }
            };
        </script>
        
        <?php include 'footer.php';?>
    </body>
</html>
<?php 
    }else{
        header("Location: login_form.php");
        exit();
    }

