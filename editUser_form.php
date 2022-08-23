<?php 
    session_start();
    if(isset($_SESSION['id'])){

        include "query_user.php";
        
        if ($_SESSION['user_type'] == "Admin" && $_SESSION['status'] == 1){
            if(isset($_REQUEST['id'])){
                $id = $_REQUEST['id'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>NewTech - Update User</title>
    </head>
    <body>
        <?php include 'header.php';?>
        <header>
            <h1 class="section2Header">User Info</h1>
        </header>
        
         <div class="container">
            <div class="row">
                <div class="col-0" id="formCenter">
                    <form action="javascript:void(0);" method="post" enctype="multipart/form-data">
                        <div class="loginForm">
                             <div class="icon">
                                <?php
                                    $select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$id'") 
                                            or die('query failed');
                                    if(mysqli_num_rows($select) > 0){
                                       $row = mysqli_fetch_assoc($select);
                                    }
                                    if($row['image'] == ''){
                                       echo '<img src="images/user.png">';
                                    }else{
                                       echo '<img src="uploaded_img/'.$row['image'].'">';
                                    }
                                ?>
                            </div>
                            <?php if(isset($_GET['error'])) { ?> 
                                <p class="error"><?php echo $_GET['error'];?></p>
                            <?php } ?>
                                
                            <?php if(isset($_GET['success'])) { ?> 
                                <p class="success"><?php echo $_GET['success'];?></p>
                            <?php } 

                            $sel_query="Select * from users WHERE id = '$id'";
                            $result = mysqli_query($conn,$sel_query);
                            $row = mysqli_fetch_assoc($result) ?>
                                
                            <label>Username: </label><br>
                            <input id="unameTxt" 
                                   class="profilebox" 
                                   name="uname" 
                                   type="text" 
                                   value="<?php echo $row['user_name'];?>"
                                   disabled ><br><br>

                            <label>User Email: </label><br>
                            <input id="emailTxt" 
                                   class="profilebox" 
                                   name="email" 
                                   type="text" 
                                   value="<?php echo $row['email'];?>"
                                   disabled><br><br>
                            
                            <label>User Name: </label><br>
                            <input id="nameTxt" 
                                   class="profilebox" 
                                   name="name" 
                                   type="text" 
                                   value="<?php echo $row['first_name'];?>"
                                   disabled ><br><br>

                            <label>User Phone: </label><br>
                             <input id="phoneTxt" 
                                    class="profilebox" 
                                    name="phone" 
                                    type="text" 
                                    value="<?php echo $row['phone'];?>"
                                    disabled><br><br>
                             
                             <label>Choose image:</label>
                            <input id="imgTxt"
                                class="profilebox0"
                                name="profile_image"
                                type="file"
                                accept="image/jpg, image/jpeg, image/png"
                                disabled><br><br>
                             
                            <label>User Type: </label><br>
                            <select id="usersSelect"
                                    class="profilebox" 
                                    name="utype"
                                    disabled>
                                <option value="User" <?php if ($row['user_type'] == 'User') echo ' selected="selected"'; ?>>Normal User</option>
                                <option value="Admin" <?php if ($row['user_type'] == 'Admin') echo ' selected="selected"'; ?>>Admin</option>
                            </select><br><br>

                            <button id="saveButton" 
                                class="learnMore" 
                                name="saveButton"
                                type="submit"
                                formaction="edit_user.php?uid=<?php echo $id; ?>">
                                Save Changes
                            </button>
                            <button id="editButton" 
                                    class="learnMore" 
                                    name="editButton">
                                    Edit User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <script>
            document.getElementById("saveButton").style.display = "none";
            
            document.getElementById('editButton').onclick = function(){
                document.getElementById("editButton").style.display = "none";
                document.getElementById("saveButton").style.display = "block";
                const ids = ["unameTxt", "emailTxt", "nameTxt", "phoneTxt", "usersSelect","imgTxt"];
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
                header("Location: admin_form.php");
                exit();
            }
        }else{
            if ($_SESSION['user_type'] == "User" && $_SESSION['status'] == 1){
                header("Location: login_form.php");
                exit();
            }else{
                header("Location: admin_form.php");
                exit();
            } 
        }
    }else{
        header("Location: login_form.php");
        exit();
    }