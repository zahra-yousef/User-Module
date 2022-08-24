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
        <title>NewTech - Profile</title>
    </head>
    <body>
        <?php include 'header.php';?>
        
        <header>
            <h1 class="section2Header">Hello, <?php echo $_SESSION['user_name'];?></h1>
        </header>
        
        <div class="container">
            <form action="javascript:void(0);" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-0" id="formCenter">
                        <div class="loginForm">
                            <div class="icon">
                                <?php
                                    if($_SESSION['image'] == ''){
                                       echo '<img src="images/user.png">';
                                    }else{
                                       echo '<img src="uploaded_img/'.$_SESSION['image'].'">';
                                    }
                                ?>
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
                            <input  id="bdatePicker"
                                    class="profilebox"
                                    type="date" 
                                    name="dob" 
                                    value="<?php echo $_SESSION['dob'];?>"
                                    disabled><br><br>
                            
                            <label>Choose image:</label>
                            <input id="imgTxt"
                                class="profilebox0"
                                name="profile_image"
                                type="file"
                                accept="image/jpg, image/jpeg, image/png"
                                disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button id="saveButton" 
                                class="learnMore" 
                                name="saveButton"
                                type="submit"
                                formaction="profile.php">
                            Save Changes
                        </button>
                        <button id="editButton" 
                                class="learnMore" 
                                name="editButton">
                                Edit User
                        </button>
                        <button id="deleteButton" 
                                class="learnMore" 
                                name="deleteButton"
                                type="submit"
                                formaction="delete_form.php">
                            Delete Account
                        </button>
                    </div>
                </div>
             </form> 
        </div>
        
        <script>
            document.getElementById("saveButton").style.display = "none";
            
//            https://www.techiedelight.com/disable-enable-input-text-box-javascript/
            document.getElementById('editButton').onclick = function(){
                document.getElementById("editButton").style.display = "none";
                document.getElementById("saveButton").style.display = "block";
                const ids = ["nameTxt", "emailTxt", "phoneTxt", "bdatePicker", "imgTxt"];
                for (let i = 0; i < ids.length; i++) {
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

