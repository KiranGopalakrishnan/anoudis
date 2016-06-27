<?php
include 'core/AuthenticateUser.php';
include 'core/initiateBusiness.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> Home </title>
        <link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/home.css" rel="stylesheet" type="text/css" />
        <link href="css/timeBlock.css" rel="stylesheet" type="text/css" />
        <link href="css/creatorBoard.css" rel="stylesheet" type="text/css" />
        <link href="css/newsfeed.css" rel="stylesheet" type="text/css" />
        <link href="css/post_design.css" rel="stylesheet" type="text/css" />
        <script src="jquery/jquery-1.9.1.js"></script>
        <script src="js/sideMenuHandler.js"></script>
        <script src="js/jquery.flot.min.js"></script>
        <script src="Handlers/FrontEnd-Handler.js"></script>
                
    </head>
    <script>
$(document).ready(function () {

    $(".offerOption").click(function(e){
        $(".offerPost").slideDown(1000);
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

                    <div class="postColumn">
                        <div class="postBox">
                            <form id="posting_content"  method="post" enctype="multipart/form-data">
                            <div class="postBoxCenter offerPost">
                                <div class="postboxTitle">Publish a deal</div>
                                    <input type="text" class="offerInput" id="OfferTitle" name="dealName" placeholder="Offer Title" />
                                    <input type="text" class="offerInput" onfocus="if($(this).val()==''){$(this).attr('type','date');}" onblur="if($(this).val()==''){$(this).attr('type','text');}" id="OfferStart" name="vFrom" placeholder="Starting Date"/>
                                    <input type="text" class="offerInput" onfocus="if($(this).val()==''){$(this).attr('type','date');}" onblur="if($(this).val()==''){$(this).attr('type','text');}" id="OfferEnd" name="vTill" placeholder="Ending Date"/>
                                    <div style="width:90%;float:left;padding:1px;"></div>
                                    <input type="text" class="offerInput" id="OfferInline" name="aPrice" placeholder="Actual Price"/>
                                    <input type="text" class="offerInput" id="OfferInline" name="dPrice" placeholder="Offered Price"/>
                                    <textarea class="offerInput" id="OfferDesc" name="Description" placeholder="Describe Your Deal in 200 letters Or Less"></textarea>
                                   <div class="singleImageSelecter">
                                    <input type="file" name="file" id="file" class="imageUpload1" />
                                    <!--<label for="file">+</label>-->
                                </div>
                            </div>
                            <div class="postFooter">
                                <input type="submit" id="new_postsubmit" name="new_postsubmit" value="PUBLISH" />

                            </div>
                            </form>
                        </div>
                        <div class="rightSideFacts">
                            <div class="factSingle">
                                <img src="images/profile/signals.png" height="60" class="factImage" />
                                <div class="factBox">
                                    <span class="factTitle">

                                    </span>
                                    <span class="facts purchases">
                                        <ul>
                                            <li>Purchases
                                            <br />
                                            <span class="count1"></span>
                                            </li>
                                            <li>New<br />
                                                <span class="count2"></span></li>
                                        </ul>
                                    </span>
                                </div>
                            </div>
                            <div class="factSingle  factSpacer">
                                <img src="images/profile/default2.png" height="60" class="factImage" />
                                <div class="factBox">
                                    <span class="factTitle">

                                    </span>
                                    <span class="facts engagements">
                                        <ul>
                                            <li>Engagement<br>
                                            <span class="count1"></span></li>
                                            <li>Improvement<br>
                                            <span class="count2"></span></li>
                                        </ul>
                                    </span>
                                </div>
                            </div>
                            <div class="factSingle  factSpacer">
                                <img src="images/profile/rating.png" height="60" class="factImage" />
                                <div class="factBox">
                                    <span class="factTitle">

                                    </span>
                                    <span class="facts customers">
                                        <ul>
                                            <li>Customers<br>
                                                <span class="count1"></span></li>
                                            <li>Improvement<br>
                                                <span class="count2"></span></li>
                                        </ul>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="publishedDeals">
                        <?php
                        require_once 'core/class.businessManager.php';
                        $dt=new businessManager();
                        $rdt=$dt->getDeals($_SESSION["BusinessId"]);
                        if(count($rdt)>0) {
                            for ($i = 0; $i < count($rdt); $i++) {
                                echo "<div class=\"dealSingle\">
                            <span class=\"dealTitle\">" . $rdt[$i]["DealName"] . "</span>
                            <span class=\"postedDate\">" . $rdt[$i]["ValidFrom"] . "</span>
                            <span class=\"expiryDate\">" . $rdt[$i]["ValidTill"] . "</span>
                            <span class=\"viewMore\"><a href=\"#\">View More</a></span>
                            </div>";
                            }
                        }
                        else{
                            echo "<div class=\"dealSingle\">
                            <span class=\"dealTitle\" style='width: 90% !important;text-align: center !important;'>No Deals To Show</span>
                            </div>";
                        }
                        ?>


                    </div>
                </div>
            </div>
        </div>
         <div class="footer">
            
        </div>
            <script>
                $(document).ready(function(){
                    $(".account_settings").getAllBusiness();
                    $("#posting_content").on('submit',(function(e) {
                        e.preventDefault();
                        $.ajax({
                            url: "core/addDeal.php", // Url to which the request is send
                            type: "POST",             // Type of request to be send, called as method
                            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                            contentType: false,       // The content type used when sending data to the server.
                            cache: false,             // To unable request pages to be cached
                            processData: false,        // To send DOMDocument or non processed data file it is set to false
                            success: function (data)   // A function to be called if request succeeds
                            {
                                alert("Published");
                            }
                        });
                    }));

                    var adTop;
                    $(document).ready(function(){
                        $(document).getDashboardMetrics({
                            for:"home"
                        });

                    });
// get initial position of the element


                });
            </script>
    </body>
</html>