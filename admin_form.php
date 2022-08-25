<?php 
session_start();
require 'query_user.php';

if ($_SESSION['user_type'] == "Admin" && $_SESSION['status'] == 1){
    $title = "Admin Panel"; 
    include 'header.php';
?><body>
    <?php include 'navbar.php';?>
    <div class="container">
        <div class="row">
            <div class="col-6" id="formCenter">
                <div class="form">
                    <?php if(isset($_GET['success'])) { ?> 
                            <p id="adminMsg" class="success"><?php echo $_GET['success'];?></p>
                    <?php } ?> 
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
                                            <a href="editUser_form.php?
                                               id=<?php echo rawurlencode($row["id"]); ?>">
                                                Edit
                                            </a>
                                        </td>
                                        <td align="center">
                                            <a href="admin.php?
                                               id=<?php echo rawurlencode($row["id"]); ?>
                                               &status=-1">
                                                Delete
                                            </a>
                                        </td>
                                        <?php if($row["status"] == 1) {?>
                                            <td id="block<?php echo $row["id"]; ?>" 
                                                align="center">
                                                <a href="admin.php?
                                                   id=<?php echo rawurlencode($row["id"]); ?>
                                                   &status=<?php echo $row["status"]; ?>">
                                                    Block
                                                </a>
                                            </td>
                                        <?php } else if($row["status"] == 0){?>
                                            <td id="unblock<?php echo $row["id"]; ?>" 
                                                align="center">
                                                <a href="admin.php?
                                                   id=<?php echo rawurlencode($row["id"]); ?>
                                                   &status=<?php echo $row["status"]; ?>">
                                                    Unblock
                                                </a>
                                            </td>
                                        <?php  } ?>
                                    </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <a class="btnLink" href="addUser_form.php">
                    <button 
                        id ="addUserBtn"
                        type="submit" 
                        class="loginButton">
                        Add New User
                     </button>
                </a> 
            </div>                
        </div> 
    </div>
    <?php include 'footer.php';?>
</body>
<?php 
}else{
    require 'auth_check.php';
}