<?php 
    session_start();
    include "connection.php";
    if(isset($_SESSION['user_name']) && isset($_SESSION['first_name'])
      && isset($_SESSION['email']) && isset($_SESSION['dob'])
      && isset($_SESSION['phone']) && isset($_SESSION['id'])){
        
        $user_id = $_SESSION['id'];
        
        if ($_SESSION['user_type'] == "admin"){
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="form">
            <h2>View Records</h2>
            <table width="100%" border="1" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <th><strong>ID</strong></th>
                        <th><strong>Username</strong></th>
                        <th><strong>Email</strong></th>
                        <th><strong>Name</strong></th>
                        <th><strong>Phone</strong></th>
                        <th><strong>User type</strong></th>
                        <th><strong>Edit</strong></th>
                        <th><strong>Delete</strong></th>
                        <th><strong>Block</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sel_query="Select * from users ORDER BY id ASC;";
                        $result = mysqli_query($conn,$sel_query);
                        while($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td align="center"><?php echo $row["id"]; ?></td>
                                <td align="center"><?php echo $row["user_name"]; ?></td>
                                <td align="center"><?php echo $row["email"]; ?></td>
                                <td align="center"><?php echo $row["first_name"]; ?></td>
                                <td align="center"><?php echo $row["phone"]; ?></td>
                                <td align="center"><?php echo $row["user_type"]; ?></td>

                                <td align="center">
                                    <a href="login.php?id=<?php echo $row["id"]; ?>">Edit</a>
                                </td>
                                <td align="center">
                                    <a href="test.php?id=<?php echo $row["id"]; ?>&status=-1">Delete</a>
                                </td>
                                <td align="center">
                                    <a href="test.php?id=<?php echo $row["id"]; ?>&status=<?php echo $row["status"]; ?>">Block</a>
                                </td>
                            </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
<?php 
        }else{
            header("Location: login_form.php");
            exit();
        }
    }else{
        header("Location: login_form.php");
        exit();
    }