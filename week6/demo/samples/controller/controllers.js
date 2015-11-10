'use strict';

var appControllers = angular.module('appControllers', []);
//uses angular built in instead of JS

appControllers.controller('MyController', ['$scope', function($scope) {
    $scope.customSpice = "wasabi";
    $scope.spice = 'very';

    $scope.spicy = function(spice) {
        $scope.spice = spice;
    };
}]);



