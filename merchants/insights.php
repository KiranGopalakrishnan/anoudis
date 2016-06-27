<?php
include 'core/AuthenticateUser.php';
include 'core/initiateBusiness.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> Customers </title>
        <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/home.css" rel="stylesheet" type="text/css" />
        <link href="css/timeBlock.css" rel="stylesheet" type="text/css" />
        <link href="css/creatorBoard.css" rel="stylesheet" type="text/css" />
        <link href="css/campaigns.css" rel="stylesheet" type="text/css" />
        <link href="css/invoices.css" rel="stylesheet" type="text/css" />
        <link href="css/graph.css" rel="stylesheet" type="text/css" />
        <link href="css/customers.css" rel="stylesheet" type="text/css" />
        <script src="jquery/jquery-1.9.1.js"></script>
        <script src="js/sideMenuHandler.js"></script>
        <script src="Handlers/FrontEnd-Handler.js"></script>
        <script src="js/jquery.flot.min.js"></script>
        <script src="js/Chart.js"></script>
                
    </head>
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).getAllBusiness();
        });
        </script>
    <script>
$(document).ready(function () {

});
</script>
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
                <span class="settingsSpan"><img src="images/icons/settings.png" class="settingsImg" height="20"><span class="settingTitle"><img src="images/icons/down.png" class="arrowDown" height="10" > </span></span>
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
                 <div class="menu_item">
                	<div class="menu_item_image"><img src="images/icons/logout_red.png" height="24"></div>
                    <div class="menu_item_text">Logout</div>
                </div>
            </div>
            <div class="center_content_wrapper">
                
                <div class="CreatorBoard">

                    <div class="graphOfCustomers">
                        <canvas class="graphCanvas" id="graphCanvas"></canvas>
                    </div>
                        <div class="topEngInsightWrapper">
                                  <div class="customerMetrics">
                                       <div class="reachCustomers">
                                           <div class="widgetInnerWrap">
                                               <div class="businessReachCount">655</div>
                                               <div class="engCustomersTitle">Customers Reached</div>
                                           </div>
                                        <div class="attributeProgress decrease"><img src="images/customers/decrease.png" height="30" />56%</div>
                                    </div>
                                  </div>
                            <div class="customerMetrics">
                                <div class="checkinCustomers">
                                    <div class="widgetInnerWrap">
                                        <div class="checkinCount">
                                            <span class="count">432</span>
                                        </div>
                                        <div class="engCustomersTitle">Checkins Counted</div>
                                    </div>
                                    <div class="attributeProgress increase"><img src="images/customers/increase.png" height="30" />56%</div>
                                </div>
                            </div>
                            <div class="customerMetrics">
                                <div class="dealCustomers">
                                    <div class="widgetInnerWrap">
                                        <div class="dealCount">958</div>
                                        <div class="engCustomersTitle">Deals Purchased</div>
                                    </div>
                                    <div class="attributeProgress increase"><img src="images/customers/increase.png" height="30" />56%</div>
                                </div>
                            </div>
                        </div>



                    <div class="nextBlockHeading">Demographics</div>
                    <div class="detailedInsights">
                        <div class="single_insight_item">
                            <canvas id="insightCanvas1"></canvas>
                        </div>
                        <div class="single_insight_item">
                            <div class="facts">
                                <div class="factSingle audience">
                                    <div class="title">Largest Audience</div>
                                    <div class="factContent">MEN 18-24</div>
                                </div>
                            </div>
                            <div class="facts">
                                <div class="factSingle">
                                    <div class="title">Audience Price Range</div>
                                    <div class="factContent">$25-50</div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="nextBlockHeading">Audience Location</div>
                    <div class="detailedInsights">
                        <div class="single_insight_item">
                            <div id="insightCanvas1"></div>
                        </div>
                        <div class="single_insight_item">
                            <div class="facts">
                                <div class="factSingle">
                                    <div class="title">Largest Audience</div>
                                    <div class="factContent">Montreal,QC</div>
                                </div>
                            </div>
                            <div class="facts">
                                <div class="factSingle">
                                    <div class="title">Business Reach Range</div>
                                    <div class="factContent">50KM</div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                
            </div>
        </div>
         <div class="footer">
            
        </div>
    <script>
    $(document).ready(function(){
        $(document).getDashboardMetrics();
        $(document).getInsights();
    });
    </script>
    </body>
</html>
