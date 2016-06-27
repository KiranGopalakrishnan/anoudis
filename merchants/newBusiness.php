<?php
include 'core/AuthenticateUser.php';
include 'core/initiateBusiness.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> Add Business </title>
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
                <div class="center_content_wrapper" style="width: 100% !important;">
                    <div class="CreatorBoard">
                        <?php
                            if($_GET["action"]=="new"){
                                    $htm="<div class=\"sr\">
                                            <h1 style=\"font-family: 'Roboto', sans-serif;text-align: center;font-weight: 300;margin-top: 10%;\">You have successfully signed up !</h1>
                                            <h4 style=\"font-family: 'Roboto', sans-serif;text-align: center;font-weight: 300;\">Add Your Business using the form below !</h4>
                                           </div>";
                                    echo $htm;
                                }else if($_GET["action"]=="add"){
                                $htm="<h1 style=\"font-family: 'Roboto', sans-serif;text-align: center;font-weight: 300;margin-top: 10%;float:left;width: 100%;\">Business has been added to your account successfully !</h1>
                                        <input type=\"button\" value=\"Click here to continue\" style=\"background:#2ecc71;font-family: 'Roboto', sans-serif;margin-top:3%;text-align: center;font-weight: 300;float:left;width:20%;padding:2% !important;color:#FFF;margin-left: 40%;\" onclick=\"location.href=home.php;\"/>";
                                $htm2="<h1 style=\"font-family: 'Roboto', sans-serif;text-align: center;font-weight: 500;font-size: 25px;width:100%;float:left;\">OR</h1><h1 style=\"font-family: 'Roboto', sans-serif;text-align: center;font-weight: 300;margin-top: 3%;float: left;width: 100%;\">Add another business !</h1>
                                        <input type=\"button\" id='smb2' value=\"Add another business\" style=\"background:#2ecc71;font-family: 'Roboto', sans-serif;margin-top:3%;text-align: center;font-weight: 300;float:left;width:20%;padding:2% !important;color:#FFF;margin-left: 40%;\" />";
                                echo $htm.$htm2;
                            }
                        ?>
                        <form id="newBusiness" action="core/addBusiness.php" method="post">
                            <div class="formTitle">Add new business</div>
                            <div class="first">
                                <input type="text" id="businessName" name="businessName" placeholder="Name Of the Business" />
                                <input type="text" id="buildingNumber" name="buildingNumber" placeholder="Address" />
                                <input type="text" id="streetName" name="streetName" class="address" placeholder="Street" />
                                <input type="text" id="postalCode" name="postalCode" class="address" placeholder="Postal Code" maxlength="6" />
                                <select name="category" id="category">
                                    <option>Category</option>
                                </select>
                            </div>
                            <div class="second">
                                <select name="cityName"  id="cityName">
                                    <option>City</option>
                                </select>
                                <select name="provinceName" id="provinceName">
                                    <option>Province/Territory</option>
                                </select>
                                <select name="countryName" id="countryName">
                                    <option>Country</option>
                                </select>
                                <textarea name="description" placeholder="A Short Description Of Your Business"></textarea>
                                <input type="submit" class="submit"  value="Add" />
                           </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
         <div class="footer">
            
        </div>
        <script src="Chartist/chartist.min.js"></script>
        <?php
        if($_GET["action"]=="add"){
           echo  "<script>$(document).ready(function(){

                $(\"#newBusiness\").hide();
                $(\"#smb2\").click(function(){
                $(\"#newBusiness\").slideToggle(1000);
                $('html, body').animate({
        scrollTop: $(\"#newBusiness\").offset().top
    }, 1000);
                });
            });</script>";
        }
        ?>
    <script>

    </script>
    </body>
</html>
