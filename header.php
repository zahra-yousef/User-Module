<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>NewTech - Header</title>
        <link rel="stylesheet" href="styleSheets/styles.css">
    </head>
    <body>
        <nav>
            <ul class="top-nav" id="dropDownClick">
                <li><a href="home_form.php">Home</a></li>
                <li><a href="#news">Techno</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="#about">About</a></li>
                <li id="profile-tab" class="top-nav-right"><a href="profile_form.php">Profile</a></li>                
                <li id="logout-tab" class="top-nav-right"><a href="logout.php">Logout</a></li>
                <li class="dropdownIcon"><a href="javascript:void(0);" onclick="dropdownMenu()">&#9776;</a></li>
            </ul>
        </nav>
        
        <div class="container" id="section-1-gradient">
            <div class="row">
                <div class="col-6" >
                    <div class="leftSide-col">
                        <h1 class="large">New Tech</h1>
                        <h1 class="large">Developers Needs..</h1>
                    </div>
                </div>                
                <div class="col-6" >
                    <div class="rightSide-col">
                        <div class="videoContainer">
                            <iframe width="560" height="315" 
                                src="https://www.youtube.com/embed/EGQh5SZctaE" 
                                title="YouTube video player" frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            function dropdownMenu(){
                var x = document.getElementById("dropDownClick");
                if(x.className === "top-nav"){
                    x.className += " responsive";
                    /*change top-nav to top-nav.responsive*/
                }else{
                    x.className = "top-nav";
                }
            }
        </script>
    </body>
</html>
