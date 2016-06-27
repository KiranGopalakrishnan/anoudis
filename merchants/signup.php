<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> Sign Up </title>
        <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/creatorBoard.css" rel="stylesheet" type="text/css" />
        <link href="css/newBusiness.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="Chartist/chartist.min.css">
        <script src="jquery/jquery-1.9.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
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
                        <form id="newBusiness" action="core/signupProcess.php" method="post" style="width:auto !important;" class="signupForm">
                            <div class="formTitle">Sign up</div>
                            <input type="text" id="name" name="name" placeholder="Firstname Lastname" />
                            <input type="email" id="email" name="email" placeholder="Your E-Mail Address" />
                            <input type="password" id="password" name="password" placeholder="Choose a password" />
                            <input type="password" id="cnfrmpassword" name="cnfrmpassword" placeholder="Confirm your password" />
                            <select name="sex"  id="sex">
                                <option>Sex</option>
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                            <input type="text" id="dob" onfocus="$(this).attr('type','date');" onblur="$(this).attr('type','text');" name="dob" placeholder="Date Of Birth" />
                            <select name="countryName" id="countryName">
                                <option>Country</option>
                            </select>
                            
                            <!--Php starts here-->
                            //,ncsacs
                            
                            <?php
                             if($_GET["planId"]!="trial"){
                                require_once 'core/class.subscriptionManager.php';
                                $dt=new subscriptionManager(" ");
                                $rdt=$dt->getSubscriptionData($_GET["planId"]);
                                $term=$_GET["term"];
                                $plan="";
                                $price="";
                                 $data="";
                                switch($term){
                                    case "M":
                                        $plan = $rdt[0]["subName"]." - Monthly";
                                        $price= "$ ".$rdt[0]["monthly"]." / Month";
                                        $data=$rdt[0]["monthly"];
                                        break;
                                    case "Y":
                                        $plan = $rdt[0]["subName"]." - Yearly";
                                        $price= "$ ".$rdt[0]["yearly"]." / Year";
                                        $data=$rdt[0]["yearly"];
                                        break;
                                }
                            }else{
                                $plan="TRIAL-1 Month";
                                $price= "$ 0 For 1 Month";
                                 $data="trial";
                            }
                            echo"<div class=plan data=".$data." style='float:left;font-size: 16px;margin-top: 5%; width: 100%;border: solid 1px #f39c12;font-family:Roboto, sans-serif;'>
                                <div class=iconDiv style='float: left;padding: 3%; background:#f39c12;color:#FFF;'>Selected Plan</div>
                                <span class=planName  style='float: left;padding: 3%;'>".$plan."</span>
                                <span class=planAmount  style='float: left;padding: 3%;color:#000;font-weight: bold;'>".$price."</span>
                                <span class=changePlan style='float: left;padding: 3%;'><a href=../index.php#pricing>Change</a></span>
                            </div>";
                            ?>
                            <!--PHP ends here-->
                            <input type="submit" class="submit" value="Sign up" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
         <div class="footer">
            
        </div>
        <script src="https://checkout.stripe.com/checkout.js"></script>

        <script>
             var k = "anoudisEncrypt";
            var encrypted = CryptoJS.AES.encrypt($(".plan").attr('data'), k);
            $(".submit").attr('data-key',encrypted);
            var price ="";
                 var pln="";
                 var id="";
                 var handler = StripeCheckout.configure({
                 key: 'pk_test_QTw0opvzku52xDEXZh05jznU',
                 image: 'https://anoudis.com/img/logo.png',
                 locale: 'auto',
                 token: function(token) {
                             $.ajax({type:"POST",url: "core/addUserToPlan.php",data:{stripeToken:token.id,plan:pln,planId:id}, success: function(response) {
                            }
                        });
                    }
                 });
                 $('.signupForm').on('submit', function(e) {
                     e.preventDefault();
                     // Open Checkout with further options:
                     var decryptedKey = CryptoJS.AES.decrypt($(".submit").attr("data-key"), k);
                     var price = decryptedKey;
                     if(price.toString(CryptoJS.enc.Utf8)!="trial") {
                         alert(price);
                         handler.open({
                             name: 'Anoudis.com',
                             description: '2 widgets',
                             currency: "cad",
                             amount: parseInt(price.toString(CryptoJS.enc.Utf8) + "00")
                         });
                     }
                 });

                 // Close Checkout on page navigation:
                 $(window).on('popstate', function() {
                     handler.close();
                 });
    </script>
    </body>
</html>