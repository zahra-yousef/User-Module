<?php 
    session_start();
    if(isset($_SESSION['id'])){

        include "query_user.php";
        
        if ($_SESSION['user_type'] == "Admin" && $_SESSION['status'] == 1){
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>NewTech - Admin Panel</title>
    </head>
    <body>
        <?php include 'header.php';?>
        <div class="container">
            <div class="row">
                <div class="col-6" id="formCenter">
                    <div class="form">
                        <h2>View Records</h2>
                        <table width="100%" border="1" style="border-collapse:collapse;">
                            <thead>
                                <tr>
                                    <th><strong>ID</strong></th>
                                    <th><strong>Username</strong></th>
                                    <th><strong>User type</strong></th>
                                    <th><strong>Status</strong></th>
                                    <th><strong>Edit</strong></th>
                                    <th><strong>Delete</strong></th>
                                    <th><strong>Block</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query="Select * from users ORDER BY id ASC;";
                                    $result = mysqli_query($conn,$query);
                                    while($row = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                            <td align="center"><?php echo $row["id"]; ?></td>
                                            <td align="center"><?php echo $row["user_name"]; ?></td>
                                            <td align="center"><?php echo $row["user_type"]; ?></td>
                                            <td align="center"><?php echo $row["status"]; ?></td>

                                            <td align="center">
                                                <a href="editUser_form.php?id=<?php echo rawurlencode($row["id"]); ?>">Edit</a>
                                            </td>
                                            <td align="center">
                                                <a href="admin.php?id=<?php echo rawurlencode($row["id"]); ?>&status=-1">Delete</a>
                                            </td>
                                            <td id="block<?php echo $row["id"]; ?>" align="center">
                                                <a href="admin.php?id=<?php echo rawurlencode($row["id"]); ?>&status=<?php echo $row["status"]; ?>">Block</a>
                                            </td>
                                        </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>                
            </div> 
        </div>

        <script>
            document.getElementById("block<?php echo $row["id"]; ?>").style.display = "none";
            
            document.getElementById('editButton').onclick = function(){
                document.getElementById("editButton").style.display = "none";
                document.getElementById("saveButton").style.display = "block";
                const ids = ["nameTxt", "emailTxt", "phoneTxt", "bdateTxt", "imgTxt"];
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
            if ($_SESSION['user_type'] == "User" && $_SESSION['status'] == 1){
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