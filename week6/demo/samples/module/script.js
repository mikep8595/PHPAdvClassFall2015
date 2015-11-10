'use strict';
//use strict means that certain things must be coded a certain way so that sloppy JS code wont work when it isn't suppose to.

// declare a module
var myAppModule = angular.module('myApp', []);

// configure the module.
// in this example we will create a greeting filter
myAppModule.filter('greet', function() {
 return function(name) {
    return 'Hello, ' + name + '!';
  };
});
