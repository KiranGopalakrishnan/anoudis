<?php
include 'core/AuthenticateUser.php';
include 'core/initiateBusiness.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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

    <body style="float : none !important;">

        <div class="main_wrapper">

            <div class="center_content_wrapper">
                
                <div class="CreatorBoard">


                    <div class="newsFeed">
                    </div>

                
            </div>
        </div>
         <div class="footer">
            
        </div>
            <script>
                $(document).ready(function(){
                    $("#posting_content").on('submit',(function(e) {
                        e.preventDefault();
                        $.ajax({
                            url: "core/addPhotos.php", // Url to which the request is send
                            type: "POST",             // Type of request to be send, called as method
                            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                            contentType: false,       // The content type used when sending data to the server.
                            cache: false,             // To unable request pages to be cached
                            processData: false,        // To send DOMDocument or non processed data file it is set to false
                            success: function (data)   // A function to be called if request succeeds
                            {
                                alert(data);
                            }
                        });
                    }));
                    $(".postColumn").getBusinessPosts({
                        businessId: '1'
                    });
                    var adTop;
                    $(document).ready(function(){
                        adTop=$(".rightSideAds").position().top+70;

                    });
// get initial position of the element

                    $(window).scroll(function() {                  // assign scroll event listener

                        var currentScroll = $(window).scrollTop(); // get current position

                        if (currentScroll >= adTop) {           // apply position: fixed if you
                            $('.rightSideAds,.paidAds').css({                      // scroll to that element or below it
                                position: 'fixed',
                                top: '0',
                                left: '0'
                            });
                            $(".paidAds").css({
                                'width': '24%',
                                'margin-left': '74.3%'
                            });
                            $(".rightSideAds").css({
                                'width': '19%',
                                'margin-left': '19.5%'
                            });
                            $('.postColumn').css({
                                marginLeft: '27%'
                            });
                        } else {

                            $(".rightSideAds,.paidAds,.postColumn").removeAttr('style');

                        }
                    });
                });
            </script>
    </body>
</html>
