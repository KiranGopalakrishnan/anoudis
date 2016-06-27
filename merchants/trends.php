<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> Trends </title>
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
        <link rel="stylesheet" href="Chartist/chartist.min.css">
        <script src="jquery/jquery-1.9.1.js"></script>
        <script src="js/sideMenuHandler.js"></script>
        <script src="js/jquery.flot.min.js"></script>
        <script src="js/Chart.js"></script>
                
    </head>
    <script type="text/javascript">
        var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
        var barChartData = {
            labels : ["January","February","March","April"],
            datasets : [
                {
                    fillColor : "rgba(151,187,205,0)",
                    strokeColor : "#e74c3c",
                    highlightFill: "rgba(220,220,220,0.75)",
                    highlightStroke: "rgba(220,220,220,1)",
                    data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
                },
                {
                    fillColor : "rgba(151,187,205,0)",
                    strokeColor : "#2ecc71",
                    highlightFill : "rgba(151,187,205,0.8)",
                    highlightStroke : "rgba(151,187,205,1)",
                    data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
                }
            ]
        }
        window.onload = function(){
            var ctx = document.getElementById("graphCanvas").getContext("2d");
            window.myBar = new Chart(ctx).Line(barChartData, {
                responsive : true,
                bezierCurveTension : 0,
                scaleShowGridLines : false,
            });
        }

        $(document).ready(function(){
            var totalHeight=screen.height;
            var headerHeight=$(".header").height();
            var calcHeight = totalHeight - headerHeight;
            //alert(totalHeight+"/"+headerHeight);
            $(".CreatorBoard").css({'height':calcHeight});
            $(window).resize(function(e){
                var totalHeight=screen.height;
                var headerHeight=$(".header").height();
                var calcHeight = totalHeight - headerHeight;
                //alert(totalHeight+"/"+headerHeight);
                $(".CreatorBoard").css({'height':calcHeight});
            })
            $(".listCampaigns").hide();
            $(".start_new_camp").hide();
            $(".newCamp").click(function(){
                $("#graph-wrapper").hide();
                $(".listCampaigns").hide();
                $(".start_new_camp").show();
            });
            $(".manCamp").click(function(){
                $("#graph-wrapper").hide();
                $(".start_new_camp").hide();
                $(".listCampaigns").show();
            });
            $(".listSingleItem").hover(function(e){
                $(this).find(".campActionButtons").show();
            });
        });
        </script>
    <script>
$(document).ready(function () {
    var data = [
        {
            value: 300,
            color:"#F7464A",
            highlight: "#FF5A5E",
            label: "Red"
        },
        {
            value: 50,
            color: "#46BFBD",
            highlight: "#5AD3D1",
            label: "Green"
        },
        {
            value: 100,
            color: "#FDB45C",
            highlight: "#FFC870",
            label: "Yellow"
        }
    ]
    // For a pie chart
    var ctx = document.getElementById("insightCanvas1").getContext("2d");
    var myPieChart = new Chart(ctx).Pie(data,{
        responsive : true
    });
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
                <span class="settingsSpan"><img src="images/icons/settings.png" class="settingsImg" height="20"><span class="settingTitle">Blue Wonder<img src="images/icons/down.png" class="arrowDown" height="10" > </span></span>
                <div class="dropDown">
                    <div class="singleItemDropdown">Bottega</div>
                    <div class="singleItemDropdown">+ Add New Business</div>
                </div>
            </div>
            </div>
        <div class="main_wrapper">
            <div class="left_side_menu">
                <div class="menu_item" style="background: #2c3e50;"  onclick="location.href=$(this).find('a').attr('href');">
                	<div class="menu_item_image"><img src="images/icons/profile_red.png" height="24"></div>
                    <div class="menu_item_text profile_name">Kiran Gopalakrishnan</div>
                </div>
                <div class="menu_item" onclick="location.href=$(this).find('a').attr('href');">
                	<div class="menu_item_image"><img src="images/icons/doller_red.png" height="24"></div>
                    <div class="menu_item_text"><a href="home.php">Home</a></div>
                    <div class="menu_item_count yellow_color">1000</div>
                </div>
                <div class="menu_item" onclick="location.href=$(this).find('a').attr('href');">
                	<div class="menu_item_image"><img src="images/icons/insights_red.png" height="24"></div>
                    <div class="menu_item_text"><a href="insights.php">Insights</a></div>
                    <div class="menu_item_count red_color">1000</div>
                </div>
                <div class="menu_item" onclick="location.href=$(this).find('a').attr('href');">
                	<div class="menu_item_image"><img src="images/icons/insights_red.png" height="24"></div>
                    <div class="menu_item_text">Messagebox</div>
                    <div class="menu_item_count green_color">1000</div>
                </div>
                <div class="menu_item" onclick="location.href=$(this).find('a').attr('href');">
                    <div class="menu_item_image"><img src="images/icons/insights_red.png" height="24"></div>
                    <div class="menu_item_text">Trends</div>
                    <div class="menu_item_count green_color">1000</div>
                </div>
                <div class="menu_item" onclick="location.href=$(this).find('a').attr('href');">
                    <div class="menu_item_image"><img src="images/icons/brands_red.png" height="24"></div>
                    <div class="menu_item_text">Social</div>
                    <div class="menu_item_count darkblue_color">1000</div>
                </div>
                <div class="menu_item" onclick="location.href=$(this).find('a').attr('href');">
                    <div class="menu_item_image"><img src="images/icons/settings_red.png" height="24"></div>
                    <div class="menu_item_text"><a href="rewards.php">Rewards</a></div>
                    <div class="menu_item_count blue_color">20</div>
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
                                               <div class="businessReachCount">6559</div>
                                               <div class="engCustomersTitle">Businesses</div>
                                           </div>
                                       </div>
                                  </div>
                            <div class="customerMetrics">
                                <div class="checkinCustomers">
                                    <div class="widgetInnerWrap">
                                        <div class="checkinCount">
                                            <span class="count">432K</span>
                                        </div>
                                        <div class="engCustomersTitle">Customers</div>
                                    </div>
                                    <div class="attributeProgress increase"><img src="images/customers/increase.png" height="30" />56%</div>
                                </div>
                            </div>
                            <div class="customerMetrics">
                                <div class="dealCustomers">
                                    <div class="widgetInnerWrap">
                                        <div class="dealCount">958</div>
                                        <div class="engCustomersTitle">Market Share</div>
                                    </div>
                                    <div class="attributeProgress increase"><img src="images/customers/increase.png" height="30" />56%</div>
                                </div>
                            </div>
                        </div>


                    <div class="nextBlockHeading">Whats Trending ?</div>
                    <div class="detailedInsights">
                        <div class="singleTrending">
                            <img src="images/paylet_logo.png" height="75">
                            <div class="profileName">Blue Wonder</div>
                        </div>
                    </div>
                    <div class="nextBlockHeading">Your Market</div>
                    <div class="detailedInsights">
                        <div class="single_insight_item">
                            <canvas id="insightCanvas1"></canvas>
                        </div>
                        <div class="single_insight_item">
                            <div class="facts">
                                <div class="factSingle">
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
                            <canvas id="insightCanvas1"></canvas>
                        </div>
                        <div class="single_insight_item">
                            <div class="facts">
                                <div class="factSingle">
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
