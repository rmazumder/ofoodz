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
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
    <section id="order_form" >
        <div id="order" class="container">
			<div class="section-heading ">
		 
			</div>    
			<div class="panel panel-success">
				<div class="panel-heading">   Order review  </div>
				<div class="panel-body">  
					<div id="orderform">
						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">
						  <div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headinglogin">
							  <h4 class="panel-title">
								<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseLogin" aria-expanded="false" aria-controls="collapseLogin">
								  1. Login as <span ng-show="logedin_user !=null" > <span ng-cloak>{{logedin_user}} ({{logedin_user_email}}) </span></span>
								  <span ng-show="logedin_user ==null"> Guest </span>
								</a>
							  </h4>
							</div>
							<div id="collapseLogin" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headinglogin">
							  <div class="panel-body">
								<div class"row">
								 
								 <div class="col-md-4" ng-hide="logedin_user != null">
								  <p>Want to order as guest login

									<form  role="form" method="post" name="registration" novalidate>
										  <div class="form-group" ng-class="{'has-error': registration.phone.$error.number}">
												<input type="email" class="form-control" ng-model="logedin_user_email" placeholder="Enter email">
												<input type="number" class="form-control" ng-minlength="10" ng-maxlength="10"  id="inputPhone" name="phone" placeholder="Phone" ng-model="mobile" ng-required="true">
												<span class="help-block" ng-show="registration.phone.$error.required || registration.phone.$error.number">Valid phone number is required</span>
												<span class="help-block" ng-show="((registration.phone.$error.minlength || registration.phone.$error.maxlength) && registration.phone.$dirty) ">Phone number should be 10 digits</span>
										 
										</div>  
									  </form>  
									   <button type="button"  ng-disabled ="registration.phone.$invalid" class="btn btn-primary" ng-click="continueOrder('login')">Continue Order</button>    

								  </p>  
								 </span>

								
								 </div> 
								
								  <div  class="col-md-4" ng-show="logedin_user != null">
									   <span  ng-show="logedin_user!=null">
										Logged in as {{logedin_user}}. 
										<a href="login_page.php?redirect={{redirectURL |urlencode}}" style="margin-left:20px;" type="button" class="btn   btn-primary " pl>Change Login</a>

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
							</div>
							</div>
						  </div>
						  <div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingorder">
							  <h4 class="panel-title">
								<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOrder" aria-expanded="false" aria-controls="collapseOrder">
								  2. Order Details  <span class="pull-right"> <input type="text" size="4" id ="price" disabled> </price>
								</a>
							  </h4>
							</div>
							<div id="collapseOrder" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingorder">              
							 <div class="panel-body" >
							   <div class="row ">
								  <div class="col-md-2">
									  <?php if(!empty($_GET['scheme'])  ) { ?>
									   <input type ="hidden" id="schemeholder" ng-model="selectedScheme" value="<?=$_GET['scheme']?>"/>
									  <?php } ?>
									   <select id="schemeselect"  class="form-control" ng-model="selectedScheme" ng-click="schemeChange()"/>  
										  <option value=" {{selectedScheme}}" selected>  {{selectedScheme}} </option>
										  <option ng-repeat="scheme in mealschemes" value="{{scheme['name']}}" > {{scheme['name']}}</option>
									   </select>
								  </div>     
								  <div class="col-md-3">
									  <!--  <input type="text"  name="daterange" ng-model="selecteddate" id="startdate"  class="form-control"  /> -->

									   <div id="test12" class="input-group date">
											  <input id="datetextbox" type="text" class="form-control"  ng-model="selecteddate" ><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
											</div>
								  </div>

								  <div class="col-md-3" ng-show="selectedScheme=='Daily'">
											 <select id="mealtype" class="form-control" ng-model="mealtype" ng-change="mealtypeUpdate()">
									</select>

									   
								  </div>
								  <!--  <div class="col-md-2" >
									   <input type="text" ng-disabled="true" ng-model="selectedenddate" id="enddate"  class="form-control"  />
								  </div> -->
								  <div class="col-md-2">
									   <select  class="form-control" ng-model="deliverytime" id="deliverytime" placeholder="Select delivery time">
										  <option ng-repeat="timming in deliverytimmings" value="{{timming.time}}"> {{timming.time}}</option>
									  </select>
								  </div>
								   <div class="col-md-3 ">
									 <button type="button"  class="btn btn-primary" ng-click="continueOrder('order')">Continue with order</button>
								  </div>


								</div> 
							  </div>
							</div>
						  </div>
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingdelivery">
							  <h4 class="panel-title">
								<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsedelivery" aria-expanded="false" aria-controls="collapseTwo">
								   3. Delivery Address
								</a>
							  </h4>
							</div>
							<div id="collapsedelivery" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingdelivery">
							  <div class="panel-body">
								  <div class="row "> 
								  <div class="col-md-2" ng-repeat= "address in useraddress">
									 <div class="panel panel-default">
										  <div class="panel-body">
										   {{address}}
										  </div>
										  <div class="panel-footer"> <button type="button"  class="btn btn-primary" ng-click="selectAddress(address)">Deliver here</button>
										   </div>   

											</div>                                         
																					   
									  
								  </div>     
									<div class="col-md-2" >
									<div class="form-group">
										  
										  <textarea class="form-control" rows="5" id="address" ng-model="address" placeholder="Please type your address to deliver your order here."></textarea>
									</div>                                          
																					   
									 <button type="button"  class="btn btn-primary" ng-click="continueOrder('delivery')">Deliver here</button>    
								  </div>     
								  
								</div> 
							  </div>
							</div>
						  </div>
						<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingSummary">
						  <h4 class="panel-title">
							<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSummary" aria-expanded="false" aria-controls="collapseThree">
							  4. Order Summary
							</a>
						  </h4>
						</div>
						<div id="collapseSummary" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSummary">
						  <div class="panel-body">

							<ul class="list-group">
								<li class="list-group-item">You have selected {{selectedScheme}} {{mealtype}} meal. Price  : <i class="fa fa-inr">{{price}}</i> 
								  <span class="text-muted">  (For the first time order we will be charging Rs 200 towards security deposite )</span>
								</li>
								 <li class="list-group-item"> Your order start date is  {{selecteddate}} </li>
								<li class="list-group-item">Your prefered delivery time is {{deliverytime}} </li>
								<li class="list-group-item">To the address : {{address}} </li>
								<li class="list-group-item">
								  As of now we support only Cash on delivery (COD). Once confirmed we will give you a call and confirm the order
									
								</li>
								<li class="list-group-item">    

								<form  role="form" method="post" name="registration" novalidate>
										  <div class="form-group" ng-class="{'has-error': registration.phone.$error.number}">
												<input type="number" class="form-control" ng-minlength="10" ng-maxlength="10"  id="inputPhone" name="phone" placeholder="Phone" ng-model="mobile" ng-required="true">
												<span class="help-block" ng-show="registration.phone.$error.required || registration.phone.$error.number">Valid phone number is required</span>
												<span class="help-block" ng-show="((registration.phone.$error.minlength || registration.phone.$error.maxlength) && registration.phone.$dirty) ">Phone number should be 10 digits</span>
										 
										</div>  
								 </form>  
								
								   <button type="button" ng-disabled ="registration.phone.$invalid" id="confirmorder" class="btn btn-primary" ng-click="confirmOrder()">Confirm Order</button>                                                    
								</li>
								  <div class="messagecontainer"></div>

	  
						  </div>
						</div>
					  </div>

					
					</div>

							
					</div>
                                                  
                </div>

            </div> 
                    
        </div>
    </section>         

       
    <!-- end order mocdal -->

    

        

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
