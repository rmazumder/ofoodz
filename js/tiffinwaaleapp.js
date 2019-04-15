var data = "test";

var app = angular.module('dabbaApp', [], ['$httpProvider', function($httpProvider) {
    $httpProvider.interceptors.push('myHttpInterceptor');
    var spinnerFunction = function spinnerFunction(data, headersGetter) {
        $("#spinner").show();
        return data;
    };

    $httpProvider.defaults.transformRequest.push(spinnerFunction);
}]);


app.factory('myHttpInterceptor', function($q, $window) {
    return {
        // optional method
        'request': function(config) {
            $("#spinner").hide();
            return config;
        },

        // optional method
        'requestError': function(rejection) {
            $("#spinner").hide();
            if (canRecover(rejection)) {
                return responseOrNewPromise
            }
            return $q.reject(rejection);
        },



        // optional method
        'response': function(response) {
            $("#spinner").hide();
            return response;
        },

        // optional method
        'responseError': function(rejection) {
            $("#spinner").hide();
            if (canRecover(rejection)) {
                return responseOrNewPromise
            }
            return $q.reject(rejection);
        }
    };
});


app.filter('urlencode', function() {
    return function(input) {
        return window.encodeURIComponent(input);
    }
});


app.filter('month_filter', function() {

  return function(date) {
		var momentobj = moment(date); 
		return momentobj.format("MMM")+'/'+momentobj.format("YYYY");
  }
});

app.filter('day_filter', function() {

  return function(date) {
		var momentobj = moment(date); 
		return momentobj.format("D");
  }
});

app.filter('week_day_filter', function() {

  return function(date) {
		var momentobj = moment(date); 
		return momentobj.format("dddd");
  }
});

app.filter('isMenuActive', function() {

  return function(day) {
		var today = moment().format('dddd');
		//console.log(day + " "+ today );
		if(day.toUpperCase() == today.toUpperCase()){
			return "active";
		} else {
			return '';
		}
  }
});



app.controller('orderController', function($scope, $http, $location) {

    $scope.appname = "OfoodZ";
    $scope.website = "www.ofoodz.com";
	$scope.weekdaysNameIndex = ['Sunday','Monday','Tuesday', 'Wednesday','Thrusday','Friday','Saturday'];
    $scope.selecteddate = moment().format('MM/DD/YYYY');
    $scope.menu = {};
	$scope.price ="";
	$scope.orderunit = 1;
	$scope.shippingcost = 0;
	$scope.islunch=true;
	$scope.paymentmode='cod';
    var queries = {};
    $.each(document.location.search.substr(1).split('&'), function(c, q) {
        if (q != "") {
            var i = q.split('=');
            queries[i[0].toString()] = i[1].toString();
        }
    });


    $scope.selectedScheme = queries['scheme'];
	$scope.mealtype = decodeURIComponent(queries['menu']);
	$scope.weekday = queries['weekday'];

    $scope.redirectURL = encodeURI("order.php?scheme=" + $scope.selectedScheme);

    var loadSession = function() {
        $http.get('php/rest/auth/getUser.php').success(function(data) {
            $scope.logedin_user = data.user;
            $scope.logedin_user_email = data.email;
            $scope.mobile = data.mobile;
            $scope.useraddress = data.address;   
        });
    }

    loadSession();

    $scope.mealschemes = [];
    $scope.deliverytimmings = [];
    var loadScheme = function() {
        $http.get('json/scheme.json').success(function(data) {
            $scope.mealschemes = data.scheme;
            $scope.lunchdeliverytimmings = data.lunchdeliverytimmings;
			$scope.dinnerdeliverytimmings = data.dinnerdeliverytimmings;
			$scope.lunchtime=$scope.lunchdeliverytimmings[0]['time'];
			$scope.dinnertime=$scope.dinnerdeliverytimmings[0]['time'];
			$scope.onetimeshippingcost=data.onetimeShippingCost;
			if($scope.selectedScheme == "Daily"){
				$("#schemeselect").hide();				
				populateDate4Dialy($scope.selectedScheme, $scope.weekday);
			} else {
				 populateDate($scope.selectedScheme);
				  angular.forEach($scope.mealschemes, function( value, index) {
					  var vname = $scope.mealschemes[index]['name'];
					  if(value['name'] == "Daily"){		
						return;
					  }
					  if(value['name'] == $scope.selectedScheme){						  
						  $("#schemeselect").append("<option value="+vname+" selected>"+vname+" </option>");
					  } else {
						    $("#schemeselect").append("<option value="+vname+">"+vname+" </option>");
					  }
					  
				  });
				// $scope.selectedScheme = $scope.mealschemes[2]['name'];

			}
        });
    }

    var loadMenu = function() {
        $http.get('json/menu.json').success(function(data) {
            $scope.menu = data;
            if($scope.selectedScheme == "Daily"){
                
				//var date = new Date();
				//var hours = moment(date).format('HH');
				//if(hours > 18){
				//  date = moment(date).add(1, 'days')._d;
				//}
				//var day = moment(date).format('dddd');
				var day = $scope.weekdaysNameIndex[$scope.weekday];
                $scope.price = $scope.menu[day][0].price;
				$("#price").text($scope.price);
				$scope.setSelectedDay(day);
            }

        });
    }

    var loaddeliveryAddress = function() {
        $http.get('php/rest/auth/getUser.php?address='+$scope.logedin_user_email).success(function(data) {     
           /*var uniqueNames = [];
            $.each(data, function(i, el){
                if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
            });   */
           $scope.useraddress = data;

        });
    }

    loadMenu();
    loadScheme();
  
 
    $scope.continueOrder = function(status) {
        if (status == "order") {
            if($scope.selectedScheme =='Daily'){
                 $scope.mealtype = $("#mealtype").val();
				 $scope.selecteddate = $("#datetextbox").val();
            }
			if(!$.isArray($scope.selecteddate))	{		
				$scope.selecteddate = $scope.selecteddate.split(",");
			}
            loaddeliveryAddress();
        } else if (status == "delivery") {
			
           $scope.subtotal =  0;
		   if($scope.selectedScheme =='Daily'){
			   $scope.shippingcost = parseInt($scope.onetimeshippingcost);
			   if(typeof $scope.shippingcost === 'undefined' )
				   $scope.shippingcost = 15;
		   }
		   if($scope.islunch){
			    $scope.subtotal =  parseInt($scope.subtotal) +  parseInt($scope.price);		
				$scope.deliverytime = "lunch="+ $scope.lunchtime+"#";
		   }
		   if($scope.isdinner){
			    $scope.subtotal =  parseInt($scope.subtotal) +  parseInt($scope.price);	
				$scope.deliverytime = $scope.deliverytime+ "dinner="+ $scope.dinnertime;		
		   }
		   
        } else if (status == "summary") {
           
        }
    };
   // $scope.mealtype ="";
    $scope.confirmOrder = function() {
        $(".messagecontainer").empty();
        var req = {
            method: 'POST',
            url: 'php/rest/auth/placeorder.php',
            data: {
                scheme: $scope.selectedScheme + " "+$scope.mealtype,
                address: $scope.address,
                selecteddate: $scope.selecteddate,
                deliverytime: $scope.deliverytime,
                email: $scope.logedin_user_email,
				price: parseInt($scope.price),
                mobile: $scope.mobile,
				paymentmode: $scope.paymentmode,
				shippingcost: $scope.shippingcost,
				orderunit: parseInt($scope.orderunit),
				islunch: $scope.islunch,
				isDinner: $scope.isdinner,
				totalamount: parseInt($scope.subtotal) * parseInt($scope.orderunit) + parseInt($scope.shippingcost)
				
            }
        }

        $http(req).then(function(response) {

            if (response.data.status == "success") {
                 $(".messagecontainer").prepend("<div class='alert alert-info'> <strong>Information! </strong> " + response.data.message + ".</div>");
				 
				 if($scope.paymentmode=='payumoney'){
						 $( "#target" ).attr("action", response.data.action);
						 $('<input>').attr('type','hidden').attr('name','hash').attr('value',response.data.hash).appendTo($("#target" ));
						 $('<input>').attr('type','hidden').attr('name','surl').attr('value',response.data.surl).appendTo($("#target" ));
						 $('<input>').attr('type','hidden').attr('name','furl').attr('value',response.data.furl).appendTo($("#target" ));
						 $('<input>').attr('type','hidden').attr('name','txnid').attr('value',response.data.txnid).appendTo($("#target" ));
						 $('<input>').attr('type','hidden').attr('name','amount').attr('value',response.data.amount).appendTo($("#target" ));
						 $('<input>').attr('type','hidden').attr('name','firstname').attr('value',response.data.firstname).appendTo($("#target" ));
						 $('<input>').attr('type','hidden').attr('name','email').attr('value',response.data.email).appendTo($("#target" ));
						 $('<input>').attr('type','hidden').attr('name','productinfo').attr('value',response.data.productinfo).appendTo($("#target" ));
						
						 $('<input>').attr('type','hidden').attr('name','service_provider').attr('value',response.data.service_provider).appendTo($("#target" ));
						 $('<input>').attr('type','hidden').attr('name','phone').attr('value',response.data.phone).appendTo($("#target" ));
						 $('<input>').attr('type','hidden').attr('name','key').attr('value',response.data.key).appendTo($("#target"));
						$( "#target" ).submit();
				 } else {
					  $(".messagecontainer").append("<hr><a  href=\"index.html\">Continue with Ofoodz.com </a><hr>");
				 }

            } else {
                 $(".messagecontainer").prepend("<div class='alert alert-danger'> <strong>Error! </strong> " + response.data.message + ".</div>");
            }
        }, function(response) {

        });
    };

    $scope.selectAddress = function(address) {
        $scope.address = address;
        $scope.continueOrder('delivery');
    }

    $scope.schemeChange = function() {      
        data = $scope.selectedScheme;
    }

    $scope.getSchemeData = function(scheme) {    
        for (var i = 0; i < $scope.mealschemes.length; i++) {
            if($scope.mealschemes[i].name == scheme.trim()){
               return $scope.mealschemes[i];
            }
        }

    }

    $scope.setSelectedDay = function(selectedday){
        $("#mealtype").empty();
        $scope.selectedDay = selectedday;
        var items = $scope.menu[selectedday];
        angular.forEach($scope.menu[selectedday], function( value, index) {
			if(value.name == $scope.mealtype){
				 $("#mealtype").append("<option name="+value.name+" selected>"+ value.name +"</option>");
				var menuprice =  items[index].price;
				$("#price").text(menuprice);
				 $scope.price = menuprice;
		}else{
			$("#mealtype").append("<option name="+value.name+">"+ value.name +"</option>");
		}
				
        });
		
		
        $("#target").val($("#mealtype option:first").val());
       // var menuprice =  items[0].price;
       
        //$("#price").text(menuprice);
    };

    $scope.mealtypeUpdate = function(){
        angular.forEach($scope.menu[$scope.selectedDay], function(value) {
            if(value.name == $scope.mealtype){
                 $scope.price = value.price;
                 $("#price").text(value.price);
            }
        });

    }

    $scope.setPrice = function(scheme, date) {  
        if(scheme.trim() == "Daily"){
               return;
        } else {
           // console.log("set price" + date );

            for (var i = 0; i < $scope.mealschemes.length; i++) {
                if($scope.mealschemes[i].name == scheme.trim()){
                    $scope.price =  $scope.mealschemes[i]['price'];
                }
            }
        }  
		$("#price").text($scope.price);
		return  $scope.price;
			
 }


});


app.controller('loginController', function($scope, $http) {

    $scope.appname = "ofoodz";
    $scope.website = "www.ofoodz.com";
    $scope.address = "some address";
    $scope.contact_number = "911121212";
    $scope.logedin_user = "guest";
    $scope.logedin_user_email = "ruhul@rsa.com";
    $scope.logedin_user_address = ["Address1", "Address2"];
    $scope.selectedScheme = "Weekly";
    $scope.data = data;


    $("form[name ='loginform']")[0].reset();
    $(".messagecontainer").empty();
   

    $scope.logindialog = function(dialog) {
        if (dialog == "signup") {
            $(".signin").hide();
            $(".forgotpwd").hide();
            $(".signup").show();
        } else if (dialog == "forgotpwd") {
            $(".signup").hide();
            $(".signin").hide();
            $(".forgotpwd").show();
        }
    }


    var queries = {};
    $.each(document.location.search.substr(1).split('&'), function(c, q) {
        if (q != "") {
            var i = q.split('=');
            queries[i[0].toString()] = i[1].toString();
        }
    });
    $scope.requestPage = queries['redirect'];
    $scope.fb_requesturl = 'php/rest/auth/fb-login.php';
    if ($scope.requestPage !== "undefined") {

        $scope.fb_requesturl = 'php/rest/auth/fb-login.php?redirect=' + $scope.requestPage;
    }

    var getFBLogin = function() {
        $http.get($scope.fb_requesturl).success(function(data) {
            $scope.fbredirectionUrl = data;

        });
    }

    $scope.google_requesturl = 'php/rest/auth/fb-login.php';
    if ($scope.requestPage !== "undefined") {

        $scope.google_requesturl = 'php/rest/auth/google-login.php?redirect=' + $scope.requestPage;
    }

    var getGmailLogin = function() {
        $http.get($scope.google_requesturl).success(function(data) {
            $scope.googleredirectionUrl = data;

        });
    }

   // getFBLogin();
  //  getGmailLogin();

    $scope.login = function(mode) {

        $(".messagecontainer").empty();
        var req = {
            method: 'POST',
            url: 'php/rest/auth/login.php',
            data: {
                mode: mode,
                email: $scope.email,
                password: $scope.password,
                name: $scope.name,
                confirm_password: $scope.confirm_password,
                mobile: $scope.mobile,
                redirect: $scope.requestPage
            }
        }

        $http(req).then(function(response) {

            if (response.data.status == "success") {
                $(".messagecontainer").prepend("<div class='alert alert-info'> <strong>Information! </strong> " + response.data.message + ".</div>");

                if (response.data.action == "loggedin") {

                    var redirect = response.data.redirect;
                    redirect = window.decodeURIComponent(redirect);
                    window.location.href = redirect;
                }

            } else {

                $(".messagecontainer").prepend("<div class='alert alert-danger'> <strong>Error! </strong> " + response.data.message + ".</div>");
            }
        }, function(response) {

        });




    }




});

app.controller('dabbaCtrl', function($scope, $http) {
    $scope.appname = "TiffinWaale";
    $scope.website = "www.TiffinWaale.com";
    $scope.address = "some address";
    $scope.selectedScheme = "";

    var loadMenu = function() {
        $http.get('json/menu.json').success(function(data) {
            $scope.weekdays = data;



        });
    }

    var loadSession = function() {
        $http.get('php/rest/auth/getUser.php').success(function(data) {
            $scope.logedin_user = data.user;
            $scope.logedin_user_email = data.email;
            $scope.userlocation = data.userlocation;


        });
    }

    loadMenu();
    loadSession();

    $scope.selectScheme = function(scheme) {
        $scope.selectedScheme = scheme;
    }

    $scope.mealschemes = [];
    $scope.deliverytimmings = [];
    var loadScheme = function() {
        $http.get('json/scheme.json').success(function(data) {
            $scope.mealschemes = data.scheme ;
            $scope.deliverytimmings = data.deliverytimmings;
            $scope.delivery_locations = data.deliveryAreas;
            $scope.address = data.address;
            $scope.contact_number = data.contact_number;
           // alert($scope.contact_number);
        });
    }

    loadScheme();

    $scope.locationSelect = function(){

         $http.get('php/rest/auth/setSession.php?userlocation='+ $scope.deliverylocation).success(function(data) {
             window.location.href = "order.php?scheme="+$scope.selectedScheme;
        });
    }


    $scope.referafriend = function(){
		$(".refermessagecontainer").empty();
		$(".refermessagecontainer").append("<img src='img/spinner.gif'/>");
         var req = {
            method: 'POST',
            url: 'php/rest/auth/refer.php',
            data: {
                data: $scope.refer
            }
        }

        $http(req).then(function(response) {
	      $(".refermessagecontainer").empty();
          $(".refermessagecontainer").append("<div class='alert alert-info'> <strong>Greetings! </strong> Thank you for refering us to a friend.</div>");

        }, function(response) {

        });
    }
   
    /*$scope.mealschemes= [ {'name':'Daily', 'mealcount': 1,'price':0,  'packname':'Weekly', 'savings':100},
                        {'name':'Weekly', 'mealcount': 6,'price':380, 'days':'Mon-Sat', 'packname':'Weekly', 'savings':100},
                        {'name':'2Weeks', 'mealcount':12,'price':750, 'days':'Mon-Sat-Mon-Sat', 'packname':'2Week', 'savings':200},
                        {'name':'Monthly', 'mealcount':24,'price':1500, 'days':'Whole Month', 'packname':'Monthly', 'savings':300}];*/


});