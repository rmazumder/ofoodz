$(document).ready(function(){
	

  $(".nav-tabs").on("click", "a", function(e){
              e.preventDefault();
              $(this).tab('show');
            })
            .on("click", "span", function () {
                var anchor = $(this).siblings('a');
                $(anchor.attr('href')).remove();
                $(this).parent().remove();
                $(".nav-tabs li").children('a').first().click();
            });

            $('.add-contact').click(function(e) {
            alert("as");
                e.preventDefault();
                var id = $(".nav-tabs").children().length; //think about it ;)
                $(this).closest('li').before('<li><a href="#contact_'+id+'">New Tab</a><span>x</span></li>');         
                $('.tab-content').append('<div class="tab-pane" id="contact_'+id+'">Contact Form: New Contact '+id+'</div>');
        });
});



var app = angular.module('dabbaApp', [], ['$httpProvider', function($httpProvider) {
    $httpProvider.interceptors.push('myHttpInterceptor');
    var spinnerFunction = function spinnerFunction(data, headersGetter) {
        $("#spinner").show();
        return data;
    };

    $httpProvider.defaults.transformRequest.push(spinnerFunction);
}]);

app.filter('sumOfValue', function() {
     return function(data, key) {
        if (angular.isUndefined(data) && angular.isUndefined(key))
            return 0;        
        var sum = 0;
        
        angular.forEach(data,function(v,k){
            sum = sum + parseInt(v[key]);
        });        
        return sum;
     };
 });

app.filter('num', function() {
    return function(input) {
      return parseInt(input, 10);
    };
});


app.factory('myHttpInterceptor', function($q, $window) {
    return {
        // optional method
        'request': function(config) {
           // $("#spinner").hide();
            return config;
        },

        // optional method
        'requestError': function(rejection) {
           // $("#spinner").hide();
            if (canRecover(rejection)) {
                return responseOrNewPromise
            }
            return $q.reject(rejection);
        },



        // optional method
        'response': function(response) {
          //  $("#spinner").hide();
            return response;
        },

        // optional method
        'responseError': function(rejection) {
          //  $("#spinner").hide();
            if (canRecover(rejection)) {
                return responseOrNewPromise
            }
            return $q.reject(rejection);
        }
    };
});

app.controller('dabbaCtrl', function($scope, $http,  $filter) {
    $scope.appname = "TiffinWaale";
    $scope.website = "www.TiffinWaale.com";
    $scope.showpage="menuview";
    $scope.userrole ="";
    $scope.redirectURL = encodeURI("/admin.html");

    var loadSession = function () {
      $http.get('php/rest/auth/getUser.php').success(function (data) {
       $scope.logedin_user = data.user;
       $scope.logedin_user_email = data.email;
       $scope.userrole = data.usertype;     
       
     });
    }

  loadSession();

    var loadMenu = function () {
        $http.get('json/menu.json').success(function (data) {
            $scope.weekdays = data;
            console.log( $scope.weekdays);
        });
    }

    var loadScheme = function () {
        $http.get('json/scheme.json').success(function (data) {
            $scope.mealschemes = data.scheme;
            $scope.lunchdeliverytimmings = data.lunchdeliverytimmings;
			$scope.dinnerdeliverytimmings = data.dinnerdeliverytimmings;
            $scope.deliveryAreas  = data.deliveryAreas;
			$scope.address = data.address;
            $scope.contact_number = data.contact_number;
			$scope.onetimeShippingCost = data.onetimeShippingCost;
        });
    }

    
    loadMenu();
    loadScheme();
   
    $scope.savemenu = function () {
       $http.post('php/rest/saveMenu.php',  $scope.weekdays).
          then(function(response) {
            glitterAlert("Information !" , "Menu updated sucessfully");
          }, function(response) {
            glitterAlert("Error  !" , "Error in updating the menu.");
          });
     }

    $scope.addnewItem = function (record) {
       
       var newItem = {'name':'', 'Serving':'', 'image': ''};
       $scope.weekdays[$scope.selectedDay][record]['items'].push(newItem);

     }

     $scope.removeItem = function (parentIndex, recordindex) {
         $scope.weekdays[$scope.selectedDay][parentIndex]['items'].splice(recordindex, 1);
     }

     $scope.addMenuType = function () {
         var menuType = {"name" : "", "price": 0,
                                    "items": [{"name":"", "Serving":"", "image": ""}
                                              ]
                                   };
         $scope.weekdays[$scope.selectedDay].push(menuType);
     }
     

     $scope.removeMenuType = function (record) {
        
         $scope.weekdays[$scope.selectedDay].splice(record,1);
     }

    $scope.select = function (record) {
    
       $scope.selectedDay = record;
      
    };  

    $scope.changeview = function (view) {
    
       $scope.showpage = view;
       $("#menuview").removeClass("active");
       $("#schemeview").removeClass("active");
       $("#adminview").removeClass("active");

       $("#"+view).addClass("active");
   
    };  

     $scope.addScheme = function () {
       
      var  scheme = {"name":"", "mealcount":0,"price":0, "packname":"", "savings":0};
      $scope.mealschemes.push(scheme);

     }

    $scope.removeScheme = function (record) {
       
        $scope.mealschemes.splice(record, 1);

     }

      
     
     //$scope.deliveryAreas = ['Kundalahalli Gate','Spice Garden','Munnekolala','Marathalli Bridge','SGR Dental College (Munnekolala)']

      $scope.saveSchemes = function () {
          $scope.twdata = {};
          $scope.twdata['scheme'] = $scope.mealschemes;
          $scope.twdata['lunchdeliverytimmings'] = $scope.lunchdeliverytimmings;   
		  $scope.twdata['dinnerdeliverytimmings'] = $scope.dinnerdeliverytimmings;   
          $scope.twdata['deliveryAreas'] = $scope.deliveryAreas;    
		  $scope.twdata['address']=$scope.address;
          $scope.twdata['contact_number']=$scope.contact_number;
		  $scope.twdata['onetimeShippingCost']=$scope.onetimeShippingCost;
         $http.post('php/rest/saveScheme.php',  $scope.twdata).
          then(function(response) {
            glitterAlert("Information !" , "Scheme updated sucessfully");
          }, function(response) {
             glitterAlert("Error !" , "Scheme update failed");
          });

     }

     $scope.addTimmings = function(type){
        var timming = {"time" :""};
		if(type == 'lunch')
			$scope.lunchdeliverytimmings.push(timming);
		if(type == 'dinner')
			$scope.dinnerdeliverytimmings.push(timming);
     }
 

      $scope.removetimings = function(type,record){
		if(type == 'lunch')
			$scope.lunchdeliverytimmings.splice(record,1);
	 
		if(type == 'dinner')
		  $scope.dinnerdeliverytimmings.splice(record,1);
	 
      }

       $scope.addDeliveryArea = function(){
        var deliveryArea = {"name":""};
        $scope.deliveryAreas.push(deliveryArea);
     }
 

      $scope.removeDeliveryArea = function(record){
         $scope.deliveryAreas.splice(record,1);
      }



      $scope.deleteOrder = function(orderid, index){
        
         $http.delete('php/rest/auth/loadorder.php?deactivate='+orderid).success(function (data) {
             $scope.orders.splice(index, 1);
             glitterAlert("Success !" , "Order number "+orderid+" is now deactivated");

         });
      }

      $scope.getOrder = function(){
        var url = "php/rest/auth/loadorder.php"
         if(!angular.isUndefined($scope.searchkey)){
            url =url + "?id="+$scope.searchkey;
         }
         $http.get(url).success(function (data) {
          $scope.orders = data;

         // $scope.totalAmount = $filter('sumOfValue')($scope.orders, "totalamount");
         // $scope.totalAmountPaid = $filter('sumOfValue')($scope.orders, "amountpaid");
         
         
        
        });
      }

      $scope.selectOrder = function(ordervalue){
         
          angular.forEach($scope.orders, function(order) {
             if(order.order_id == ordervalue){
                 $scope.selectedOrder = order;
             }
            });
      };

      $scope.saveOrder = function(){
          $http.post('php/rest/auth/saveorder.php',  $scope.selectedOrder).
          then(function(response) {
            glitterAlert("Information !" , "Order has been updated sucessfully");
            $("#orderModal").modal('hide');
          }, function(response) {
             glitterAlert("Error !" , "Order update failed");
          });
      }

     

});

function glitterAlert(title, message){
	$.gritter.add({
		// (string | mandatory) the heading of the notification
		title: title,
		// (string | mandatory) the text inside the notification
		text: message
		//sticky: false

		
	});

	return false;



}