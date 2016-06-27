/**
 * Created by Kiran on 08-03-2016.
 */

var fixmeTop;
var adTop;
$(document).ready(function(){
        var headerHeight = $(".header").outerHeight();
        fixmeTop = headerHeight;
        var screenHeight = screen.height;
        $(".left_side_menu").css({
            height: screenHeight + headerHeight
        });
        $(".account_settings").click(function (e) {
            $(".dropDown").slideToggle(2000);
        });
});
// get initial position of the element

$(window).scroll(function() {

        var currentScroll = $(window).scrollTop(); // get current position


        if (currentScroll >= fixmeTop) {
            $('.left_side_menu').css({                      // scroll to that element or below it
                position: 'fixed',
                top: '0',
                left: '0',
                height: '100%'
            });
            $('.CreatorBoard').css({
                marginLeft: '21.9%'
            });
        } else {
            var headerHeight = $(".header").height();
            var screenHeight = $(window).height();
            $(".left_side_menu").css({
                height: screenHeight - headerHeight
            });// apply position: static
            $('.left_side_menu').css({                      // if you scroll above it
                position: 'static'
            });

            $('.CreatorBoard').css({
                marginLeft: '0%'
            });
        }

});
$(document).ready(function(){

$("body").on("click",".account_settings .dropDown .singleItemDropdown.item",function(e) {
        //alert("click");
        var preHtml=$(".account_settings .settingsSpan .settingTitle").attr("data-key");
        var preName=$(".account_settings .settingsSpan .settingTitle span").html();
        var id = $(this).attr("data-key");
        var dm=$(this);
        //alert(id);
        var name=$(this).html();
        $.ajax({
            type: "GET", url: "core/setNewBusiness.php?id="+id, success: function (response) {
                //console.log(response);
                //var result = JSON.parse(response);
                $(".settingsSpan").html("<img src=images/icons/settings.png class=settingsImg height=20><span class=settingTitle><span>"+name+"</span><img src=images/icons/down.png class=arrowDown height=10 > </span>");
                dm.html(preName);
                dm.attr("data-key",preHtml);
                $(".account_settings .settingsSpan .settingTitle").attr("data-key",id);
                location.reload();
            }
        });
    });
});