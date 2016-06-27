<?php
session_start();
$_SESSION["userid"]="1";
$userid=$_SESSION["userid"];
$date_from=date("Y-m-d",strtotime("-30 days"));
include'classes/db.php';
$db = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8', ''.$user.'',''.$pass.'');
	$stmt = $db->prepare("SELECT * FROM trackers where userid = :uid");
         $stmt->bindValue(':uid', $userid, PDO::PARAM_STR);
				$stmt->execute();
				$trackers = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                
         $stmt = $db->prepare("SELECT * FROM visiters where tracker = :tid AND time >= :dt");
         $stmt->bindValue(':tid', $trackers[0]["trackid"], PDO::PARAM_STR);
         $stmt->bindValue(':dt', $date_from, PDO::PARAM_STR);
		$stmt->execute();
		$tracks = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $counts=array();
                $dates=array();
                $unique=0;
                //var_dump($tracks);
                for($i=0;$i<30;$i++)
                {
                    $counts[$i]["count"]=0;
                    $counts[$i]["unique"]=0;
                }
                for($i=0;$i<30;$i++)
                {
                    $date=date("Y-m-d",strtotime("-".$i." days"));
                    
                    $dates[$i]["date"]=$date;
                    for($j=0;$j<count($tracks);$j++)
                    {
                        $trackdate=date("Y-m-d",strtotime($tracks[$j]["time"])); 
                        $dt=date("Y-m-d");
			$m = date("m",strtotime($dt.'+'.$i.' month'));
			$d=DateTime::createFromFormat('!m',$m);
			//echo "'".$d->format('F')."',";
                        $supporting_count=0;
                        if($trackdate==$date)
                        {
                            $counts[$i]["count"]++;  
                            if($tracks[$j]["unique_visitor"]=="1")
                            {
                                $counts[$i]["unique"]++;
                            }
                     //   $supporting_count=1;
                        }
                       /* if($supporting_count!=1)
                        {
                            $counts[$i]["count"]=0;
                        }*/
                       // }
                      //  echo $counts[$i]["count"]."<br>";
                        
                    }
                  //echo $date."=".$trackdate;
                }
               // var_dump($counts);
              $stmt = $db->prepare("SELECT os,COUNT(os) AS occurrences FROM visiters GROUP BY os ORDER BY occurrences DESC LIMIT 5");
         			$stmt->execute();
				$os = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt = $db->prepare("SELECT browser,COUNT(browser) AS occurrences FROM visiters GROUP BY browser ORDER BY occurrences DESC LIMIT 5");
         			$stmt->execute();
				$browser = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                //var_dump($browser);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> Invoices </title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/home.css" rel="stylesheet" type="text/css" />
        <link href="css/timeBlock.css" rel="stylesheet" type="text/css" />
        <link href="css/creatorBoard.css" rel="stylesheet" type="text/css" />
        <link href="css/invoices.css" rel="stylesheet" type="text/css" />
        <script src="jquery/jquery-1.9.1.js"></script>
                
    </head>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".singleInvoice").hover(function(e){
				//alert("dasd");
				this.animate({borderLeft:'#C0392B'},1000);
            }); 
        });
    </script>
    <body>
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
                <div class="menu_title">
                    Account
                </div>
                <div class="menu_item">
                	<div class="menu_item_image"><img src="images/icons/profile_red.png" height="24"></div>
                    <div class="menu_item_text profile_name">Kiran Gopalakrishnan</div>
                </div>
                <div class="menu_item">
                	<div class="menu_item_image"><img src="images/icons/doller_red.png" height="24"></div>
                    <div class="menu_item_text">Balance</div>
                    <div class="menu_item_count green_color">1000</div>
                </div>
                <div class="menu_item">
                	<div class="menu_item_image"><img src="images/icons/cart_red.png" height="24"></div>
                    <div class="menu_item_text">Shoppings</div>
                    <div class="menu_item_count yellow_color">10</div>
                </div>
                <div class="menu_item">
                	<div class="menu_item_image"><img src="images/icons/discounts_red.png" height="24"></div>
                    <div class="menu_item_text">Discounts</div>
                    <div class="menu_item_count orange_color">1000</div>
                </div>
                <div class="menu_item">
                	<div class="menu_item_image"><img src="images/icons/invoices_red.png" height="24"></div>
                    <div class="menu_item_text">Invoices</div>
                    <div class="menu_item_count red_color">1000000</div>
                </div>
                <div class="menu_item">
                	<div class="menu_item_image"><img src="images/icons/brands_red.png" height="24"></div>
                    <div class="menu_item_text">Brands</div>
                    <div class="menu_item_count blue_color">1000</div>
                </div>
                <div class="menu_item">
                	<div class="menu_item_image"><img src="images/icons/insights_red.png" height="24"></div>
                    <div class="menu_item_text">Insights</div>
                    <div class="menu_item_count violet_color">1000</div>
                </div>
                <div class="menu_item">
                	<div class="menu_item_image"><img src="images/icons/coupons_red.png" height="24"></div>
                    <div class="menu_item_text">Coupons</div>
                    <div class="menu_item_count darkblue_color">1000</div>
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
                    <div class="optionBoardItemColumn">
                        <div class="InvoiceList">
                            <div class="invoiceTitle">
                                Invoices
                            </div>
                            <div class="singleInvoice">
                                <div class="paymentStatus"></div>
                                <div class="InvoiceNumber">#1632883467-Invoiced List</div>

                                <div class="paidAmountDetails">
                                    <div class="paidAmountContent">$500</div>
                                    <div class="InvoiceDate">05 Jun 2015</div>
                                </div>
                            </div>
                            
                            <div class="singleInvoice">
                                <div class="paymentStatus"></div>
                                <div class="InvoiceNumber">#1632883467-Invoiced List</div>

                                <div class="paidAmountDetails">
                                    <div class="paidAmountContent">$500</div>
                                    <div class="InvoiceDate">05 Jun 2015</div>
                                </div>
                            </div>
                            
                            <div class="singleInvoice">
                                <div class="paymentStatus"></div>
                                <div class="InvoiceNumber">#1632883467-Invoiced List</div>

                                <div class="paidAmountDetails">
                                    <div class="paidAmountContent">$500</div>
                                    <div class="InvoiceDate">05 Jun 2015</div>
                                </div>
                            </div>
                            
                            <div class="singleInvoice">
                                <div class="paymentStatus"></div>
                                <div class="InvoiceNumber">#1632883467-Invoiced List</div>

                                <div class="paidAmountDetails">
                                    <div class="paidAmountContent">$500</div>
                                    <div class="InvoiceDate">05 Jun 2015</div>
                                </div>
                            </div>
                            
                            <div class="singleInvoice">
                                <div class="paymentStatus"></div>
                                <div class="InvoiceNumber">#1632883467-Invoiced List</div>

                                <div class="paidAmountDetails">
                                    <div class="paidAmountContent">$500</div>
                                    <div class="InvoiceDate">05 Jun 2015</div>
                                </div>
                            </div>
                            
                            <div class="singleInvoice">
                                <div class="paymentStatus"></div>
                                <div class="InvoiceNumber">#1632883467-Invoiced List</div>

                                <div class="paidAmountDetails">
                                    <div class="paidAmountContent">$500</div>
                                    <div class="InvoiceDate">05 Jun 2015</div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                    
                    
                    
                    <div class="optionBoardItemColumn2">
                        <div class="InvoiceDetailed">
                            <div class="detailedTitle"> #1632883467-Invoiced List - Detailed</div>
                            <div class="detailSingleItem">
                                <div class="detailItemName"><img src="images/icons/pro_icon.png" height="50" /></div>
                                <div class="detailItemFrom"> Relaince Fresh</div>
                                <div class="detailItemFromAddress">Thrissur</div>
                                    <div class="BrandRatingInInvoice"">
                        <span>4.3</span>
                        <br/>
                        <img src="images/rating/10.png" width="15" />
                        <img src="images/rating/10.png" width="15"/>
                        <img src="images/rating/10.png" width="15"/>
                        <img src="images/rating/10.png" width="15"/>
                        <img src="images/rating/3.png" width="15"/>
                    </div>
                           </div>
                            <div class="detailSingleItem">
                                <div class="detailItemName">Laptop-Lenovo</div>
                                <div class="detailItemPrice">25000/-</div>
                                <div class="detailItemCross">x</div>
                                <div class="detailItemAmount">5</div>
                                <div class="detailItemEqualSign">=</div>
                                <div class="detailItemSum">1,25000/-</div>
                            </div>
                              <div class="detailSingleItem">
                                <div class="detailItemName">Laptop-Lenovo</div>
                                <div class="detailItemPrice">5000/-</div>
                                <div class="detailItemCross">x</div>
                                <div class="detailItemAmount">5</div>
                                <div class="detailItemEqualSign">=</div>
                                <div class="detailItemSum">25000/-</div>
                            </div>
                              <div class="detailSingleItem">
                                <div class="detailItemName">Laptop-Lenovo</div>
                                <div class="detailItemPrice">25000/-</div>
                                <div class="detailItemCross">x</div>
                                <div class="detailItemAmount">5</div>
                                <div class="detailItemEqualSign">=</div>
                                <div class="detailItemSum">1,25000/-</div>
                            </div>
                              <div class="detailSingleItem">
                                <div class="detailItemName">Laptop-Lenovo</div>
                                <div class="detailItemPrice">25000/-</div>
                                <div class="detailItemCross">x</div>
                                <div class="detailItemAmount">5</div>
                                <div class="detailItemEqualSign">=</div>
                                <div class="detailItemSum">1,25000/-</div>
                            </div>
                              <div class="detailSingleItem InvvoiceDouble">
                                <div class="detailItemName InvoiceTotal"></div>
                                <div class="detailItemPrice InvoiceTotal">Total</div>
                                <div class="detailItemCross InvoiceTotal">x</div>
                                <div class="detailItemAmount InvoiceTotal">5</div>
                                <div class="detailItemEqualSign InvoiceTotal">=</div>
                                <div class="detailItemSum InvoiceTotal">1,25000/-</div>
                            </div>
                            <img src="images/stamps/paidStamp.png" class="paidStamp" height="130" />
                        </div>
                    </div>
                </div>
                </div>
                
                
            </div>
        </div>
         <div class="footer">
            
        </div>
    </body>
</html>
