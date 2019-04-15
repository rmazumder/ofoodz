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

		<link rel="stylesheet" href="css/bootstrap.css">
		
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/berry.css"> 
		


		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body ng-app="dabbaApp" ng-controller="loginController">
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
							 <li><a href="index.html">Home Page</a>
                            </li>
                            <li><a href="index.html#service">Order Now</a>
                            </li>
                            <li><a href="index.html#features">Why us ?</a>
                            </li>
                           
                            <li><a href="index.html#deliveryarea">Delivery Area</a>
                            </li>
                            
                            
                           
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-->
        </nav>
    </header>
    <br>
    <br>
    <br>
    <br>
    <br>
    <section id="order_form" >
        <div id="order" class="container">
			<div class="section-heading ">		 
			</div>    
            <div class="row">
                <div class="col-md-4">
                    
                 </div>
              
                <div class="col-md-4">                   
                    <form  name="loginform" novalidate>
                        <div class="messagecontainer"></div>
                        <p class="signin signup forgotpwd">Email:<br>
							<input type="email" name="email" class="form-control" ng-model="email" required>
							<span style="color:red" ng-show="loginform.email.$dirty && loginform.email.$invalid">
								<span ng-show="loginform.email.$error.required">Email is required.</span>
								<span ng-show="loginform.email.$error.email">Invalid email address.</span>
							</span>
						</p>

                        <p class="signin signup">Password:<br>
							<input type="password" name="password" class="form-control" id="exampleInputPassword1" ng-model="password" required>
							<span style="color:red" ng-show="loginform.password.$dirty && loginform.password.$invalid">
								<span ng-show="loginform.password.$error.required">Password is required.</span>
							</span>
						</p>

                        <p class="signup " style="display:none;">Confirm Password:<br>
							<input type="password" name="confirm_password" class="form-control" ng-model="confirm_password" required>
							<span style="color:red" ng-show="loginform.confirm_password.$dirty && loginform.confirm_password.$invalid">
								<span ng-show="loginform.confirm_password.$error.required">Password is required.</span>
							</span>
						</p>

                        <p class="signup" style="display:none;">Name:<br>
							<input type="text" name="name" class="form-control" id="exampleInputPassword1" ng-model="name" required>
							<span style="color:red" ng-show="loginform.name.$dirty && loginform.name.$invalid">
								<span ng-show="loginform.name.$error.required">Name is required.</span>
							</span>
						</p>

                        <p  class="signup" style="display:none;">Mobile:<br>
							<input type="text" name="mobile" class="form-control" id="exampleInputPassword1" ng-model="mobile" required>
							<span style="color:red" ng-show="loginform.mobile.$dirty && loginform.mobile.$invalid">
							<span ng-show="loginform.mobile.$error.required">Mobile  is required.</span>
							</span>
						</p>

                        <p  class="signup" style="display:none;">
							<button ng-disabled="loginform.password.$invalid ||
								  loginform.email.$invalid" ng-click="login('registration')" class="btn pull-center btn-primary" >Sign up</button>
						</p>

                        <p  class="forgotpwd" style="display:none;">
							<button ng-disabled="loginform.email.$invalid" 
							  ng-click="login('forgotpassword')" class="btn pull-center btn-primary">
							  Forgot Password</button>
						</p>                                

                        <p class="signin">
                                       <button ng-disabled="loginform.password.$invalid ||
                                      loginform.email.$invalid" ng-click="login('login')" class="btn pull-center btn-primary" >Sign In</button>
                                    </p>

                        <hr>
                        <a href ng-click="logindialog('forgotpwd')" class="text-muted">Forgot Password </a> | <a href ="" ng-click="logindialog('signup')" class="toggle text-muted">Create a new account </a> 
                    </form>
				</div>
             </div>
        </div> 
    </section>         
    
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/angular.min.js"></script>
    <script src="js/tiffinwaaleapp.js"></script>

   
</body>

</html>
