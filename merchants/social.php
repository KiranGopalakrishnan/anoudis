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
        <link href="css/social.css" rel="stylesheet" type="text/css" />
        <link href="css/magnific-popup.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="Chartist/chartist.min.css">
        <script src="jquery/jquery-1.9.1.js"></script>
        <script src="js/jquery.bpopup.min.js"></script>
        <script src="js/jquery.flot.min.js"></script>
        <script src="js/Chart.js"></script>
        <script src="js/dist/jquery.magnific-popup.js"></script>
                
    </head>
    <script>
$(document).ready(function () {
    var data = {
        labels: ['Bananas', 'Apples', 'Grapes'],
        series: [20, 45, 40]
    };

    var options = {
        labelInterpolationFnc: function(value) {
            return value[0]
        }
    };

    var responsiveOptions = [
        ['screen and (min-width: 640px)', {
            chartPadding: 30,
            labelOffset: 100,
            labelDirection: 'explode',
            labelInterpolationFnc: function(value) {
                return value;
            }
        }],
        ['screen and (min-width: 1024px)', {
            labelOffset: 80,
            chartPadding: 20
        }]
    ];

    new Chartist.Pie('.ct-chart', data, options, responsiveOptions);

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
        </div>
        <div class="main_wrapper">

            <div class="center_content_wrapper">
                
                <div class="CreatorBoard">

                    <div class="nextBlockHeading">Hold on a minute , You have not synced you business's Facebook page with us !</div>
                    <div class="socialNotSynced">
                        <div class="fbSync">
                            <img src="images/social/facebook.png" height="150" class="fbImg" />
                            <div class="fbText">Sync Your Business's Facebook Page For Better Reach  </div>
                            <div class="syncButton fb" href="#popupPages">Sync Now</div>
                        </div>
                       <!-- <div class="twitterSync">
                            <img src="images/social/twitter.png" height="150" class="fbImg" />
                            <div class="fbText">Sync Your Business's Twitter Account For Better Reach  </div>
                            <div class="syncButton twitter">Sync Now</div>
                        </div>-->
                        <div class="whyTwitter">
                            <div class="whyTitle">Why Sync Twitter ?</div>
                            <span>
                                <li>Boosts your customer engagement on Anoudis.</li>
                                <li>Better exposure for your business</li>
                                <li>The More Social ,The better the Results</li>
                                <li>Anoudis will automatically publish your offers to twitter</li>
                                <li class="last">Allows Anoudis to analyse your business's social performance</li>
                            </span>
                        </div>
                    </div>

                    <div class="pageSelecter mfp-hide" id="popupPages">
                        <div class="title">Select Your Business's Page</div>
                        <div class="pageHolder"></div>
                    </div>
                    <div class="metricGraph">

                    </div>
                </div>
                
            </div>
        </div>
         <div class="footer">
            
        </div>
        <script src="Chartist/chartist.min.js"></script>
        <script src="Handlers/FrontEnd-Handler.js"></script>
    	<script src="Handlers/fb.js"></script>
    </body>
</html>
