<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> Campaigns </title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/home.css" rel="stylesheet" type="text/css" />
        <link href="css/timeBlock.css" rel="stylesheet" type="text/css" />
        <link href="css/creatorBoard.css" rel="stylesheet" type="text/css" />
        <link href="css/campaigns.css" rel="stylesheet" type="text/css" />
        <link href="css/invoices.css" rel="stylesheet" type="text/css" />
        <link href="css/graph.css" rel="stylesheet" type="text/css" />
        <script src="jquery/jquery-1.9.1.js"></script>
        <script src="js/jquery.bpopup.min.js"></script>
        <script src="js/jquery.flot.min.js"></script>
        <script src="js/Chart.js"></script>
                
    </head>
    <script type="text/javascript">

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

	// Graph Data ##############################################
	var graphData = [{
			// Visits
			data: [ [6, 1300], [7, 1600], [8, 1900], [9, 2100], [10, 2500], [11, 2200], [12, 2000], [13, 1950], [14, 1900], [15, 2000] ],
			color: '#26A65B',
			points: { radius: 4, fillColor: '#26A65B' }
		}, {
			// Returning Visits
			data: [ [6, 500], [7, 600], [8, 550], [9, 600], [10, 800], [11, 900], [12, 800], [13, 850], [14, 830], [15, 1000] ],
			color: 'transparent',
			points: { radius: 0, fillColor: '#000000' }
		}
	];




$.plot($('#graph-lines'), graphData, {
    series: {
        points: {
            show: true,
            radius: 5
        },
        lines: {
            show: true
        },
        shadowSize: 0
    },
    grid: {
        color: '#646464',
        borderColor: 'transparent',
        borderWidth: 20,
        hoverable: true
    },
    xaxis: {
        tickColor: 'transparent',
        tickDecimals: 2
    },
    yaxis: {
        tickSize: 1000
    }
});
	// Bars Graph ##############################################
	$.plot($('#graph-bars'), graphData, {
		series: {
			bars: {
				show: true,
				barWidth: .4,
				align: 'center'
			},
			shadowSize: 0
		},
		grid: {
			color: '#000000',
			borderColor: 'transparent',
			borderWidth: 20,
			hoverable: true
		},
		xaxis: {
			tickColor: 'transparent',
			tickDecimals: 5
		},
		yaxis: {
			tickSize: 1000
		}
	});

	// Graph Toggle ############################################
	$('#graph-bars').hide();

	$('#lines').on('click', function (e) {
		$('#bars').removeClass('active');
		$('#graph-bars').fadeOut();
		$(this).addClass('active');
		///$('#graph-lines').fadeIn();
		e.preventDefault();
	});

	// Tooltip #################################################
	function showTooltip(x, y, contents) {
		$('<div id="tooltip">' + contents + '</div>').css({
			top: y - 16,
			left: x + 20
		}).appendTo('body').fadeIn();
	}

	var previousPoint = null;

	$('#graph-lines, #graph-bars').bind('plothover', function (event, pos, item) {
		if (item) {
			if (previousPoint != item.dataIndex) {
				previousPoint = item.dataIndex;
				$('#tooltip').remove();
				var x = item.datapoint[0],
					y = item.datapoint[1];
					showTooltip(item.pageX, item.pageY, y + ' visitors at ' + x + '.00h');
			}
		} else {
			$('#tooltip').remove();
			previousPoint = null;
		}
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
        </div>
        <div class="main_wrapper">
            <div class="left_side_menu">
                <div class="menu_item" style="background: #2c3e50;">
                	<div class="menu_item_image"><img src="images/icons/profile_red.png" height="24"></div>
                    <div class="menu_item_text profile_name">Kiran Gopalakrishnan</div>
                </div>
                <div class="menu_item">
                	<div class="menu_item_image"><img src="images/icons/doller_red.png" height="24"></div>
                    <div class="menu_item_text">Home</div>
                    <div class="menu_item_count yellow_color">1000</div>
                </div>
                <div class="menu_item">
                	<div class="menu_item_image"><img src="images/icons/brands_red.png" height="24"></div>
                    <div class="menu_item_text">Customers</div>
                    <div class="menu_item_count red_color">1000</div>
                </div>
                <div class="menu_item">
                	<div class="menu_item_image"><img src="images/icons/insights_red.png" height="24"></div>
                    <div class="menu_item_text">Campaigns</div>
                    <div class="menu_item_count green_color">1000</div>
                </div>
                <div class="menu_item">
                	<div class="menu_item_image"><img src="images/icons/coupons_red.png" height="24"></div>
                    <div class="menu_item_text">Coupons</div>
                    <div class="menu_item_count darkblue_color">1000</div>
                </div>
                <div class="menu_item">
                    <div class="menu_item_image"><img src="images/icons/coupons_red.png" height="24"></div>
                    <div class="menu_item_text">Social</div>
                    <div class="menu_item_count darkblue_color">1000</div>
                </div>
                <div class="menu_item">
                    <div class="menu_item_image"><img src="images/icons/settings_red.png" height="24"></div>
                    <div class="menu_item_text">Rewards</div>
                </div>
                 <div class="menu_item">
                	<div class="menu_item_image"><img src="images/icons/developers_red.png" height="24"></div>
                    <div class="menu_item_text">Developers</div>
                    <div class="menu_item_count black_color">+3 New</div>
                </div>
              <div class="menu_item">
                	<div class="menu_item_image"><img src="images/icons/settings_red.png" height="24"></div>
                    <div class="menu_item_text">Settings</div>
                </div>
                 <div class="menu_item">
                	<div class="menu_item_image"><img src="images/icons/logout_red.png" height="24"></div>
                    <div class="menu_item_text">Logout</div>
                </div>
            </div>
            <div class="center_content_wrapper">
                
                <div class="CreatorBoard">
                    <div class="cMenu">
                        <div class="newCamp"> + New Campaign </div>
                        <div class="manCamp"> Manage Campaigns </div>
                        <div class="selectCamp"><p> View Campaigns From </p> <input type="date" class="startDate" /> <p>To</p> <input type="date" class="endDate" />  </div>
                    </div>
                          <div id="graph-wrapper">
                          <div class="graph-container">
                            <div id="graph-lines"></div>
		<div id="graph-bars"></div>
	</div>
                              <div class="chartConvTable">
                                    <div class="campReach">100k  <br><div class="ChartreachCount">Reach</div></div>
                                    <div class="campReach">100k  <br><div class="ChartreachCount">Engagement</div></div>
                                    <div class="campConversions">50k  <br><div class="ChartconvCount">Conversions</div></div>
                              </div>
                    </div>
                    <div class="listCampaigns">
                        <div class="listSingleItem">
                            <img src="images/icons/camp.png" />
                            <div class="listItemName">Campaign #1</div><br/>
                            <div class="listItemStartDate">23 Dec 2015</div>
                            <div class="listItemDateText"> to </div>
                            <div class="listItemEndDate">13 Dec 2016</div>
                            <div class="campActionButtons">
                                <div class="view">View</div>
                                <div class="edit">Edit</div>
                                <div class="delete">Delete</div>
                            </div>
                        </div>

                        
                    </div>
                    <div class="start_new_camp">
                        <div class="campForm">
                            <div class="formTitle">Create A New Campaign</div>
                        <input type="text" placeholder="Campaign Name" />
                       <br /><br /><br />
                        <input type="date" name="endDate"  />
                        <br /><br />
                        <br><br>
                        <span>Targets</span><br>
                        <div class="couponTitle" contenteditable="true">
                            <span>Eg : Electronics,Online Shopping<span>
                        </div>
                        <br /><br />
                        <input type="submit" class="startC" name="submit" value="Start"/>
                        </div>
                        <div class="campProjections">
                            <div class="campReach">100k  <br><div class="reachCount">Reach</div></div>
                            <div class="campConversions">50k  <br><div class="convCount">Conversions</div></div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
         <div class="footer">
            
        </div>
    </body>
</html>
