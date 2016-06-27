<?php
include 'core/AuthenticateUser.php';
include 'core/initiateBusiness.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> Rewards </title>
        <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/home.css" rel="stylesheet" type="text/css" />
        <link href="css/timeBlock.css" rel="stylesheet" type="text/css" />
        <link href="css/creatorBoard.css" rel="stylesheet" type="text/css" />
        <link href="css/campaigns.css" rel="stylesheet" type="text/css" />
        <link href="css/rewards.css" rel="stylesheet" type="text/css" />
        <link href="css/graph.css" rel="stylesheet" type="text/css" />
        <link href="css/customers.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="Chartist/chartist.min.css">
        <script src="jquery/jquery-1.9.1.js"></script>

        <script src="js/sideMenuHandler.js"></script>
        <script src="Handlers/FrontEnd-Handler.js"></script>
        <script src="js/jquery.flot.min.js"></script>
        <script src="js/jquery.bpopup.min.js"></script>
        <script src="js/Chart.js"></script>
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
            <div class="account_settings">
                <span class="settingsSpan"><img src="images/icons/settings.png" class="settingsImg" height="20"><span class="settingTitle">Blue Wonder<img src="images/icons/down.png" class="arrowDown" height="10" > </span></span>
                <div class="dropDown">
                    <div class="singleItemDropdown">+ Add New Business</div>
                </div>
            </div>
            </div>
        <div class="main_wrapper">
            <div class="left_side_menu">
                <div class="menu_item" style="background: #2c3e50;">
                    <div class="menu_item_image"><img src="images/icons/profile_red.png" height="24"></div>
                    <div class="menu_item_text profile_name" style="color:#FFF !important;">Kiran Gopalakrishnan</div>
                </div>
                <div class="menu_item" onclick="location.href=$(this).find('a').attr('href');">
                    <div class="menu_item_image"><img src="images/icons/doller_red.png" height="24"></div>
                    <div class="menu_item_text"><a href="home.php">Home</a></div>
                    <div class="menu_item_count yellow_color">0</div>
                </div>
                <div class="menu_item" onclick="location.href=$(this).find('a').attr('href');">
                    <div class="menu_item_image"><img src="images/icons/insights_red.png" height="24"></div>
                    <div class="menu_item_text"><a href="insights.php">Insights</a></div>
                    <div class="menu_item_count red_color">0</div>
                </div>
                <div class="menu_item" onclick="location.href=$(this).find('a').attr('href');">
                    <div class="menu_item_image"><img src="images/icons/settings_red.png" height="24"></div>
                    <div class="menu_item_text"><a href="rewards.php">Rewards</a></div>
                    <div class="menu_item_count blue_color">0</div>
                </div>
                <div class="menu_item" onclick="location.href=$(this).find('a').attr('href');">
                    <div class="menu_item_image"><img src="images/icons/developers_red.png" height="24"></div>
                    <div class="menu_item_text"><a href="home.php">Developers</a></div>
                    <div class="menu_item_count black_color">+3 New</div>
                </div>
                <div class="menu_item" onclick="location.href=$(this).find('a').attr('href');">
                    <div class="menu_item_image"><img src="images/icons/logout_red.png" height="24"></div>
                    <div class="menu_item_text"><a href="login.php">Logout</a></div>
                </div>
            </div>
            <div class="center_content_wrapper">
                
                <div class="CreatorBoard">
                    <div class="graphOfCustomers">
                        <canvas class="graphCanvas" id="graphCanvas"></canvas>
                    </div>

                    <!--
                    <div class="waiting">
                        <img src="images/loading/loading.gif" height="50" />
                        <br>
                        Processing...
                    </div>
                    <div class="notSubscribed">
                        <div class="subscribeToRewards">
                            <img src="images/rewards/rewards.png" height="100" />
                            <div class="atText">Build a Loyal Customer Base with Anoudis Rewards</div>
                            <div class="startButton">Start</div>
                        </div>
                    </div>-->

                    <div class="pointsRemaining">
                        <div class="atText">Set how your points will be distributed</div>
                        <div class="rightSideRem">
                            <div class="remPoints" id="remPoints"></div>
                            <div class="remPoints" id="spendPoints">3000<span>Spend</span></div>
                        </div>
                        <div class="setDist" id="setDist1">
                            <input type="submit" class="saveUpdate" value="Update" >
                        </div>
                    <div class="setDist" id="setDist2">
                    <input type="submit" class="saveUpdate" value="Update" >
                </div>
                    </div>




                    <div class="nextBlockHeading">Points Register</div>
                        <div class="pointRegister">
                               </div>

                    </div>

                </div>

                
            </div>
        </div>
         <div class="footer">
            
        </div>
        <script src="https://checkout.stripe.com/checkout.js"></script>
        <script src="Chartist/chartist.min.js"></script>
    <script>
        $(document).ready(function(){
            $(document).getPointModals();
            $(document).getPointRegister();

            $(document).getRewardsInsights({
                action:"CR"
            });
        })
    </script>
    </body>
</html>
