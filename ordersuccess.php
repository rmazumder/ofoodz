<!doctype html>
<!--[if lt IE 7]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->

<head>
    <meta charset="UTF-8">
    <title>OfoodZ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="shortcut icon" href="favicon.png">

    <link rel="stylesheet" href="css/bootstrap.css">
    
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="js/rs-plugin/css/settings.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker3.min.css"> 
    <link rel="stylesheet" href="css/berry.css">
	<style>
			@import url(http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700); /* written by riliwan balogun http://www.facebook.com/riliwan.rabo*/ .board{ width: 75%; margin: 60px auto; height: 600px; background: #fff; /*box-shadow: 10px 10px #ccc,-10px 20px #ddd;*/ } .board .nav-tabs { position: relative; /* border-bottom: 0; */ /* width: 80%; */ margin: 40px auto; margin-bottom: 0; box-sizing: border-box; } .board > div.board-inner{ background: #fafafa url(http://subtlepatterns.com/patterns/geometry2.png); background-size: 30%; } p.narrow{ width: 60%; margin: 10px auto; } .liner{ height: 2px; background: #ddd; position: absolute; width: 80%; margin: 0 auto; left: 0; right: 0; top: 50%; z-index: 1; } .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus { color: #555555; cursor: default; /* background-color: #ffffff; */ border: 0; border-bottom-color: transparent; } span.round-tabs{ width: 70px; height: 70px; line-height: 70px; display: inline-block; border-radius: 100px; background: white; z-index: 2; position: absolute; left: 0; text-align: center; font-size: 25px; } span.round-tabs.one{ color: rgb(34, 194, 34);border: 2px solid rgb(34, 194, 34); } li.active span.round-tabs.one{ background: #fff !important; border: 2px solid #ddd; color: rgb(34, 194, 34); } span.round-tabs.two{ color: #febe29;border: 2px solid #febe29; } li.active span.round-tabs.two{ background: #fff !important; border: 2px solid #ddd; color: #febe29; } span.round-tabs.three{ color: #3e5e9a;border: 2px solid #3e5e9a; } li.active span.round-tabs.three{ background: #fff !important; border: 2px solid #ddd; color: #3e5e9a; } span.round-tabs.four{ color: #f1685e;border: 2px solid #f1685e; } li.active span.round-tabs.four{ background: #fff !important; border: 2px solid #ddd; color: #f1685e; } span.round-tabs.five{ color: #999;border: 2px solid #999; } li.active span.round-tabs.five{ background: #fff !important; border: 2px solid #ddd; color: #999; } .nav-tabs > li.active > a span.round-tabs{ background: #fafafa; } .nav-tabs > li { width: 20%; } /*li.active:before { content: " "; position: absolute; left: 45%; opacity:0; margin: 0 auto; bottom: -2px; border: 10px solid transparent; border-bottom-color: #fff; z-index: 1; transition:0.2s ease-in-out; }*/ li:after { content: " "; position: absolute; left: 45%; opacity:0; margin: 0 auto; bottom: 0px; border: 5px solid transparent; border-bottom-color: #ddd; transition:0.1s ease-in-out; } li.active:after { content: " "; position: absolute; left: 45%; opacity:1; margin: 0 auto; bottom: 0px; border: 10px solid transparent; border-bottom-color: #ddd; } .nav-tabs > li a{ width: 70px; height: 70px; margin: 20px auto; border-radius: 100%; padding: 0; } .nav-tabs > li a:hover{ background: transparent; } .tab-content{ } .tab-pane{ position: relative; padding-top: 50px; } .tab-content .head{ font-family: 'Roboto Condensed', sans-serif; font-size: 25px; text-transform: uppercase; padding-bottom: 10px; } .btn-outline-rounded{ padding: 10px 40px; margin: 20px 0; border: 2px solid transparent; border-radius: 25px; } .btn.green{ background-color:#5cb85c; /*border: 2px solid #5cb85c;*/ color: #ffffff; } @media( max-width : 585px ){ .board { width: 90%; height:auto !important; } span.round-tabs { font-size:16px; width: 50px; height: 50px; line-height: 50px; } .tab-content .head{ font-size:20px; } .nav-tabs > li a { width: 50px; height: 50px; line-height:50px; } li.active:after { content: " "; position: absolute; left: 35%; } .btn-outline-rounded { padding:12px 20px; } }
			.date-body{
			  background-color: #0072bc;padding-bottom: 1px;
			}
			.date-body .date-title{
			   color: white;
			   font-size: 10px;
			}

			.date-body .date-content{
			  background-color: white;margin-left: 1px;margin-right: 1px;
			}
			.date-body .date-content p.dia{
			  margin: 0; font-size: 10px; font-weight: bold;
			}
			.nomargin{
			 font-size: 12px; margin: 0;
			}
			
	</style>
	 <script type="text/javascript">

	 </script>

    <script type="text/javascript" src="js/modernizr.custom.32033.js"></script>
	<script src="js/angular.min.js"></script>
	
   
</head>

<body ng-app="dabbaApp" ng-controller="orderController" data-ng-init="init()">
	<div id="spinner" style="display:none;" ><img id="spinnerimg" src="img/spinner.gif" > </div>
  
   
    <header>
        
        <nav class="navbar navbar-default navbar-fixed-top scrolled" role="navigation">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="fa fa-bars fa-lg"></span>
                        </button>
                        <a class="navbar-brand" href="index.html">
                            <img src="img/berry/logo.png" alt="" class="logo">
                        </a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                        <ul class="nav navbar-nav navbar-right">
                           
                            <li><a href="index.html#features">Why us ?</a>
                            </li>
                           
                            <li><a href="index.html#deliveryarea">Delivery Area</a>
                            </li>
                          
                            
							<li> <!-- <a href="#loginmodal"  data-toggle="modal" >Login</a> -->
                                <a href="login_page.php" type="button" ng-hide="logedin_user != null " class="btn inverse  btn-primary headerbtn" pl>Login</a>
                            </li>

                             <li> 
                                <a ng-show="logedin_user != null " type="button" href="php/rest/auth/getUser.php?logout=true" class="btn inverse btn-primary headerbtn" ><b>Logout {{logedin_user}} </b>
                            </li></a>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-->
        </nav>

        
        <!--RevSlider-->
        
  
    </header>
	<br>
	<br>

   	<section style="background:#efefe9;">
    <div class="container"> 
        <div class="row"> 
        <div class="board"> <!-- <h2>Welcome to IGHALO!<sup>™</sup></h2>--> 
            <div class="board-inner"> 
                <ul class="nav nav-tabs" id="myTab">
                    <div class="liner"></div>
                    <li class="disabled"> <a href="#home" data-toggle="tab" title="Login Detials"> <span class="round-tabs one"> <i class="fa fa-sign-in" aria-hidden="true"></i> </span> </a></li>
                    <li class="disabled"><a href="#profile" data-toggle="tab" title="Order Details"> <span class="round-tabs two"><i class="fa fa-shopping-cart" aria-hidden="true"></i> </span> </a> </li>
                    <li class="disabled"><a href="#messages" data-toggle="tab" title="Delivery Address"> <span class="round-tabs three"> <i class="fa fa-truck" aria-hidden="true"></i></i> </span> </a> 
                    </li> <li class="disabled"><a href="#settings" data-toggle="tab" title="Review and Payment"> <span class="round-tabs four"> <i class="fa fa-credit-card" aria-hidden="true"></i> <i class="fa fa-inr" aria-hidden="true"></i></span> </a>
                    </li> <li class="active"><a href="#doner" data-toggle="tab" title="Completed"> <span class="round-tabs five"> <i class="fa fa-check" aria-hidden="true"></i> </span> </a> </li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade" id="home">
                    
					
                </div>
                <div class="tab-pane fade" id="profile">
						
                </div>
                <div class="tab-pane fade" id="messages">
                   
                </div> 
                <div class="tab-pane fade " id="settings"> 
					
								
				
				</div> 
				<div class="tab-pane fade in active" id="doner"> 
					<div class="text-center"> <i class="img-intro icon-checkmark-circle"></i> </div> 
					<h3 class=" text-center"> <div class="messagecontainer">
					<?php
								include 'user.php';
								include 'DBclass.php';
								error_reporting(E_ERROR);
								$config = require '../../config.php';

								session_start();

								$userObj = new Cl_User();
								
								$status=$_POST["status"];
								$firstname=$_POST["firstname"];
								$amount=$_POST["amount"];
								$txnid=$_POST["txnid"];
								$posted_hash=$_POST["hash"];
								$key=$_POST["key"];
								$productinfo=$_POST["productinfo"];
								$email=$_POST["email"];
								$salt="aIKW0kL3YX";
								$retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
								$hash = hash("sha512", $retHashSeq);
								   if ($hash != $posted_hash) {
									   echo "<div class='alert alert-danger'>Oops. Invalid Transaction. Something went wrong. Please contact foodz.com support.</div>";
									   echo "<h4>Your order status is ". $status .".</h4>";
									   echo "<h4>Your Transaction ID for this transaction is <span class=\"label label-warning\">".$txnid."</span>.</h4>";
								       echo "<h4>We have received a payment of Rs. " . $amount . ".</h4>";
							           echo "<h4>Please contact our support with your email ID and the transaction ID.</h4>";
								   } else {
									   echo "<h4>Thank You. Your order status is <span class=\"label label-success\">". $status ."</span>.</h4>";
									   echo "<h4>Your Transaction ID for this transaction is <span class=\"label label-info\">".$txnid."</span>.</h4>";
								       echo "<h4>We have received a payment of <strong><span class=\"label label-info fa fa-inr\"> " . $amount . "</span>.</strong> Your order will soon be shipped.</h4>";
							           echo "<h4><a  href=\"index.html\">Continue with Ofoodz.com </a>.</h4>";
								   }
								
								?>	
					
					</div></h3> 
				</div> 
					
				<div class="clearfix"></div> </div> </div> </div> </div> </section>
                            
                            
                     

       
    <!-- end order mocdal -->

    

        

    </div>
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/slick.min.js"></script>

    <script src="js/waypoints.min.js"></script>
    <script src="js/moment.min.js"></script>
	<script src="js/tiffinwaaleapp.js"></script>
   
</body>

</html>
