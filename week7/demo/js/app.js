 'use strict';

var myApp = angular.module('myApp', [
  'ngRoute',
  'appControllers',
  'appServices'
]);

myApp.constant('config', { //for each page we want this data to be shown for this view.
    "endpoints": {
       "address" : 'http://localhost:81/PHPAdvClassFall2015-2/week5/demo/api/v1/address', 
       // these are the different type of services we want to hit
    },
    "models" : {
        "address" : {
           "fullname": '',
           "email": '',
           "addressline1": '',
           "city": '',
           "state": '',
           "zip": '',
           "birthday": ''
        } 
    }
    //a constant can not be changed when the page is run
            
});


myApp.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
        when('/', {
            templateUrl: 'partials/addresses.html',
            controller: 'AddressCtrl'
        }).
        when('/address/:addressId', {
            templateUrl: 'partials/address-detail.html',
            controller: 'AddressDetailCtrl'
        }).
        otherwise({
          redirectTo: '/'
        });
  }]);
  
  /*
  myApp.config(['$httpProvider',
  function($httpProvider) {
    // Use x-www-form-urlencoded Content-Type
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
    
    $httpProvider.defaults.transformRequest = function(data){
        if (data === undefined) {
            return data;
        }
        var str = [];
        for(var key in data) {
          if (data.hasOwnProperty(key)) {
            var val = data[key];
            str.push(encodeURIComponent(key) + "=" + encodeURIComponent(val));
          }
        }
        return str.join("&");
    }; 
    
}]); */