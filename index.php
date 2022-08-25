<?php 
session_start();
require 'query_user.php';
if ($_SESSION['user_type'] == "User" && $_SESSION['status'] == 1){  
    $title = "Home"; 
    include 'header.php';
?>
<body>
    <?php include 'navbar.php';?>
    <header>
        <h1 class="section2Header">The Services of New Tech</h1>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="box">
                    <div class="icon">
                        <img src="images/code.png">
                    </div>
                    <label>Programming Courses</label>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                        when an unknown printer took a galley of type 
                        and scrambled it to make a type specimen book.</p>
                </div>
            </div>
            <div class="col-4">
                <div class="box">
                    <div class="icon">
                        <img src="images/code.png">
                    </div>
                    <label>Programming Challenges</label>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                        when an unknown printer took a galley of type 
                        and scrambled it to make a type specimen book.</p>
                </div>
            </div>
            <div class="col-4">
                <div class="box">
                    <div class="icon">
                        <img src="images/code.png">
                    </div>
                    <label>Programming Community</label>

                    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                        when an unknown printer took a galley of type 
                        and scrambled it to make a type specimen book.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button class="learnMore">Learn More</button>
            </div>
        </div>
    </div>
    <?php include 'footer.php';?>
</body>
<?php  }else{
        require 'auth_check.php';
    }