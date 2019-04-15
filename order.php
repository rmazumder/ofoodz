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
	 <script type="text/javascript">
        window.$zopim||(function(d,s){var z=$zopim=function(c){
        z._.push(c)},$=z.s=
        d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
        _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
        $.src='//v2.zopim.com/?3wWDIHiH9UxrVt3EKlEedXKrwvWi9Elh';z.t=+new Date;$.
        type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
    </script>
   
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
                    <li class="active"> <a href="#home" data-toggle="tab" title="Login Detials"> <span class="round-tabs one"> <i class="fa fa-sign-in" aria-hidden="true"></i> </span> </a></li>
                    <li class="disabled"><a href="#profile" data-toggle="tab" title="Order Details"> <span class="round-tabs two"><i class="fa fa-shopping-cart" aria-hidden="true"></i> </span> </a> </li>
                    <li class="disabled"><a href="#messages" data-toggle="tab" title="Delivery Address"> <span class="round-tabs three"> <i class="fa fa-truck" aria-hidden="true"></i></i> </span> </a> 
                    </li> <li class="disabled"><a href="#settings" data-toggle="tab" title="Review and Payment"> <span class="round-tabs four"> <i class="fa fa-credit-card" aria-hidden="true"></i> <i class="fa fa-inr" aria-hidden="true"></i></span> </a>
                    </li> <li class="disabled"><a href="#doner" data-toggle="tab" title="Completed"> <span class="round-tabs five"> <i class="fa fa-check" aria-hidden="true"></i> </span> </a> </li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="home">
                    <div class"row">
								  <div class="col-md-1">
								 </div>
								 <div class="col-md-4" >
								  <p><span ng-hide="logedin_user != null">Order as Guest</span>

									<form  role="form" method="post" name="registration" novalidate>
										  <div class="form-group" ng-class="{'has-error': registration.phone.$error.number}">
												<input type="email" class="form-control" ng-model="logedin_user_email" name="email" placeholder="Enter email" required>
												<input type="number" class="form-control" ng-minlength="10" ng-maxlength="10"  id="inputPhone" name="phone" placeholder="Phone" ng-model="mobile" ng-required="true">
												<span class="help-block" ng-show="registration.phone.$error.required || registration.phone.$error.number">Valid phone number is required</span>
												<span class="help-block" ng-show="((registration.phone.$error.minlength || registration.phone.$error.maxlength) && registration.phone.$dirty) ">Phone number should be 10 digits</span>
										 
										</div>  
									  </form>  
										
								  </p>  
								 </span>

								
								 </div> 
								
								  <div  class="col-md-4" ng-show="logedin_user != null">
									   <span  ng-show="logedin_user!=null">
										Logged in as {{logedin_user}}. 
										<a href="login_page.php?redirect={{redirectURL |urlencode}}" style="margin-left:20px;" type="button" class="btn   btn-primary " >Change Login</a>

									</span> 
								  </div>
								  
								 <div class="col-md-1">
								 </div>
								  
								 <div class="col-md-4" ng-hide="logedin_user != null">
								   <span >
								   <p>Login to speed up the ordering process. </p>
									<a href="login_page.php?redirect={{redirectURL |urlencode}}" type="button" class="btn   btn-primary " pl>Login</a>
								</div>

					</div>
					<div class"row">
					<div class="col-md-12">
						<form class="form-horizontal text-center" id="home_form" name="home_form" role="form">
							<fieldset>
								<button type="submit" href="#profile" name="home_form" class="btn-submit btn btn-success btn-outline-rounded green"  ng-disabled ="registration.phone.$invalid || registration.email.$invalid" class="btn btn-primary"> Continue <span style="margin-left:10px;" class="glyphicon glyphicon-send"></span></button>
							</fieldset>
						</form>
					</div>
					</div>
					
                </div>
                <div class="tab-pane fade" id="profile">
						  <div class="row">
							<div class="col-md-12">
								<p class="narrow1 text-center">
									You have selected <span ng-show="selectedScheme=='Daily'">{{weekdaysNameIndex[weekday]}}, {{mealtype}}</span> 
									<span ng-show="selectedScheme!='Daily'">subscription, {{selectedScheme}}</span> 
									meal and the price is 
									<i class="fa fa-inr" aria-hidden="true"></i>
									<span ng-show="islunch && !isdinner">{{price}} for lunch.</span>
									<span ng-show="!islunch && isdinner">{{price}} for dinner.</span>
									<span ng-show="islunch && isdinner">{{price * 2 }} for lunch and dinner.</span>
								</p> 
							</div>
						

						  </div>
                    	   <div class="row ">
								  <div class="col-md-2"></div>
								  <div class="col-md-3" ng-hide="selectedScheme=='Daily'">		
									   <label > Subscription Type </label>
									   <select id="schemeselect"  class="form-control" ng-model="selectedScheme" ng-click="schemeChange()"/>  
										  <!--<option value=" {{selectedScheme}}" selected>  {{selectedScheme}} </option>-->
										<!-- <option ng-repeat="scheme in mealschemes" value="{{scheme['name']}}"> {{scheme['name']}}</option> -->
									   </select>
								  </div>     
								  <div class="col-md-2">
									  <label > Delivery date(s) </label>
									   <div id="test12" class="input-group date" ng-form name="selecteddateform">											  
											  <input id="datetextbox" type="text" class="form-control" name="selecteddate"  ng-model="selecteddate"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
										</div>
								  </div>

								  <div class="col-md-2" ng-show="selectedScheme=='Daily'">
											 <label for="deliverytime">Meal type</label>
											 <select id="mealtype" class="form-control" ng-model="mealtype" ng-change="mealtypeUpdate()">
											</select>

									   
								  </div>
							
								  <div class="col-md-2">
									   <div class="checkbox">
										  <label><input type="checkbox" ng-disabled="!isdinner" ng-model="islunch" value="" checked>Lunch</label>
										</div>
										  <div class="checkbox">
										  <label><input type="checkbox" ng-disabled="!islunch" ng-model="isdinner" value="">Dinner</label>
										</div>
								  </div>							  
								  
							</div> 
							
                    <form class="form-horizontal text-center" id="profile_form" name="profile_form" role="form">
                        <fieldset>
                            <button type="submit" href="#messages" id="orderbtn" name="profile_form" class="btn-submit btn btn-success btn-outline-rounded green" ng-click="continueOrder('order')"> Continue <span style="margin-left:10px;" class="glyphicon glyphicon-send"></span></button> 
							<span id="ordererror"></span>
                        </fieldset> 
                    </form>
						<p class="narrow text-center"> <a href="/ofoodz/#service">Click here to change onetime meal selection</a> </p> 
						<p class="narrow text-center"> <a href="/ofoodz/#order">Click here to select meal subscription</a> </p> 
                </div>
                <div class="tab-pane fade" id="messages">
                    <div class="row "> 
								 <div class="col-md-2">
								 </div>
								  <div class="col-md-2" ng-repeat= "address in useraddress">
									 <div class="panel panel-default">
										  <div class="panel-body">
										   {{address}}
										  </div>
										  <div class="panel-footer"> <button type="button"  class="btn btn-primary" ng-click="selectAddress(address)"><i class="fa fa-check-square-o" aria-hidden="true"></i></button>
										   </div>   

											</div>						   
									  
								  </div>     
									<div class="col-md-4" >
									<div class="form-group" ng-form name="addressform">
										  
										  <textarea class="form-control" rows="5" id="address" name= "address" ng-model="address"  placeholder="Please type your address to deliver your order here." required></textarea>
									</div>                                          
																					   
								  </div>     
								  
					</div> 
					<div  class="row ">
							 <div class="col-md-2" >
							 </div>
							 <div class="col-md-8" ng-show="islunch">
												
										<div class="form-group">
											<div class='input-group date' class='datetimepicker'>
												<span class="input-group-addon">Prefered Lunch Delivery Time</span>
												<select id="lunchtime" class="form-control" ng-model="lunchtime">
													<option ng-repeat="time in lunchdeliverytimmings">{{time['time']}}</option>													
												</select>
											</div>
										</div>
											
								</div>
																						
							</div>
							<div  class="row ">
								 <div class="col-md-2" >
								 </div>
								 <div class="col-md-8" ng-show="isdinner">
									
									<div class="form-group">
											<div class='input-group date' class='datetimepicker'>
												<span class="input-group-addon">Prefered Dinner Delivery Time</span>
												<select id="dinnertime" class="form-control" ng-model="dinnertime">
													<option ng-repeat="time in dinnerdeliverytimmings" >{{time['time']}}</option>	
												</select>
											</div>
									</div>
								 </div>
							 </div>
                    <form class="form-horizontal text-center" id="messages_form" name="messages_form" role="form">
                        <fieldset>
                            <button type="submit" href="#settings" name="messages_form" ng-disabled="addressform.address.$invalid" class="btn-submit btn btn-success btn-outline-rounded green" ng-click="continueOrder('delivery')"> Continue <span style="margin-left:10px;" class="glyphicon glyphicon-send"></span></button>
                        </fieldset>
                    </form>
                </div> 
                <div class="tab-pane fade" id="settings"> 
								
								
				<div class="row">
					<div class="col-md-6">						
						<div class="row">
							<div class="col-md-12">
							<span class="fa-stack fa-lg">
								  <i class="fa fa-square-o fa-stack-2x"></i>
								  <i class="fa fa-cutlery fa-stack-1x"></i>												  
							</span>
							<strong><span ng-show="selectedScheme=='Daily'">{{weekdaysNameIndex[weekday]}}, {{mealtype}} (One time)</span>
							<span ng-show="selectedScheme!='Daily'">{{selectedScheme}} Meal Plan</span> </strong>
							
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<table width="100%" class="table">
									<tr>
										<th width="20%"></th>
										<th width="30%" class="text-left">Unit Price</th>
										<th width="20%">Unit</th>
										<th width="30%" class="text-right">Sub Total</th>
									</tr>
									<tr>
										<td ></td>
										<td class="text-left">
											<span ng-show="islunch"><i class="fa fa-inr" aria-hidden="true"></i> {{price}} <span class="label label-success">Lunch</span>
											</span>
											<br>
											<span ng-show="isdinner"><i class="fa fa-inr" aria-hidden="true"></i> {{price}} <span class="label label-primary">Dinner</span></span>
											</td>
										<td> 
											<input type="text" class="form-control" ng-model="orderunit" maxlength="4" size="4" />
										</td>
										<td class="text-right"><i class="fa fa-inr" aria-hidden="true"></i> {{subtotal * orderunit}}</td>
									
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td class="text-right"> Shipping </td>
										<td class="text-right"><i class="fa fa-inr" aria-hidden="true"></i> {{shippingcost}}</td>
									
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td class="text-right"> Total </td>
										<td class="text-right"><i class="fa fa-inr" aria-hidden="true"></i> {{subtotal * orderunit + shippingcost}}</td>
									
									</tr>
									
								</table>
							</div>
						</div>
						<!--<div class="row">
							<div class="col-md-12"><strong>Delivery Time  {{deliverytime}}</strong></div>	
						</div>-->
						<div class="row">
							<div class="col-md-12"><strong><i class="fa fa-map-marker" aria-hidden="true"></i> Delivery Address  {{address}}</strong></div>
						</div>					
											
					</div>
					
					
					
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-12">
								<i class="fa fa-calendar" aria-hidden="true"></i>  Selected Date(s)
							</div>
						</div>
						<div class="row">
							
							<div class="col-md-12">
								<span ng-repeat= "date in selecteddate" style="display: inline;float: left; margin-left:5px;margin-top:5px;">
						
										<div class="text-center date-body" style="width:70px">
										  <label for="" class="date-title">{{ date | month_filter }}</label>
										  <div class="date-content">
											<p class="dia">{{ date | day_filter }}</p>
											<hr class="nomargin"/>
											<p class="nomargin"><strong>{{ date | week_day_filter }}</strong></p>
										  </div>
										</div>
									</span>
							</div>
						</div>
					</div>
					
				</div>	
					
					
				<hr>
				
					
				<div class="row">
					<div class="col-md-4 col-md-offset-2">
						<label >Payment Mode</label>
						<select  class="form-control" ng-model="paymentmode" id="paymentmode" >
							<option value="cod"> Cash on delivery</option>
							<option value="payumoney"> Payumoney</option>
						</select>
					</div>
					<div class="col-md-4">
						<form class="form-horizontal text-center" id="settings_form" name="settings_form" role="form">					
							<fieldset> 
								<button type="submit" href="#doner" name="settings_form" class="btn-submit btn btn-success btn-outline-rounded green" ng-disabled ="registration.phone.$invalid" id="confirmorder"  ng-click="confirmOrder()"> Confirm 
								<i class="fa fa-check-square" style="margin-left:5px; aria-hidden="true"></i></button> 
							</fieldset> 
						</form> 
					</div>
				</div>
				
				</div> 
				<div class="tab-pane fade" id="doner"> 
					<div class="text-center"> <i class="img-intro icon-checkmark-circle"></i> </div> 
					<h5 class="head1 text-center"> <div class="messagecontainer"></div></h5> 
				</div> 
					
				<div class="clearfix"></div> </div> </div> </div> </div> </section>
                            
                            
                     

       
    <!-- end order mocdal -->

		<div style="display:none">
			<form id="target" method="post" name="payuForm">
			</form>
		</div
        

    </div>
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/slick.min.js"></script>

    <script src="js/waypoints.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/tiffinwaaleapp.js"></script>
    <script src="js/order.js"></script>

   
</body>

</html>
