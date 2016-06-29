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
                       <div class="checkoutButton">
                       Checkout
                       </div>
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
             var term = $(".plan").attr('term');
            $(".submit").attr('data-key',encrypted);
            var price ="";
                 var pln=$(".plan").attr('plan');
                 var id=$(".plan").attr('plan');
                 var handler = StripeCheckout.configure({
                 key: 'pk_test_QTw0opvzku52xDEXZh05jznU',
                 image: 'https://anoudis.com/img/logo.png',
                 locale: 'auto',
                 token: function(token) {
                             $.ajax({type:"POST",url: "core/addUserToPlan.php",data:{stripeToken:token.id,plan:pln,planId:id,term:term}, success: function(response) {
                            console.log(response);
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
                         //alert(price);
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