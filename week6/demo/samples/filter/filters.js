'use strict';

var appFilters = angular.module('appFilters', []);

appFilters.filter('reverse', function() {
    return function(input, uppercase) {
      input = input || ''; // means input or nothing
      var out = "";
      for (var i = 0; i < input.length; i++) {
        out = input.charAt(i) + out;
      }
      // conditional based on optional argument
      if (uppercase) {
        out = out.toUpperCase();
      }
      return out;
    };
});