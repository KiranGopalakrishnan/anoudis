<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> Sign In </title>
        <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/creatorBoard.css" rel="stylesheet" type="text/css" />
        <link href="css/newBusiness.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="Chartist/chartist.min.css">
        <script src="jquery/jquery-1.9.1.js"></script>
    </head>

    <body style="float : none !important;">
        <div class="header">
        <span class="logoname">
        	<img src="images/paylet_logo.png" height="60"><img src="images/paylet_name.png" height="50" >
        </span>
            <div class="account_nav">
            	<span class="navItem">Home</span>
                <span class="navItem">Merchants</span>
                <span class="navItem">Brands</span>
                <span class="navItem">Faq</span>
                <span class="navItem">Developers</span>
                <span class="navItem">Careers</span>
                <span class="navItem">Queries</span>
            </div>
            </div>
        <div class="main_wrapper">
                <div class="center_content_wrapper">
                    <div class="CreatorBoard">
                        <form id="newBusiness" action="core/login.php" method="post" class="loginForm" style="width:auto !important;">
                            <div class="formTitle">Sign In</div>
                            <input type="email" id="email" name="username" placeholder="E-Mail" />
                            <input type="password" id="password" name="password" placeholder="Password" />
                            <input type="submit" class="submit" value="Sign In" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
         <div class="footer">
        </div>
        <script src="Chartist/chartist.min.js"></script>
    <script>
    </script>
    </body>
</html>
