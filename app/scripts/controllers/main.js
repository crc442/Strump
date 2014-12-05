'use strict';

/**
 * @ngdoc function
 * @name strumpApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the strumpApp
 */
angular.module('strumpApp')
  .controller('MainCtrl', function ($scope) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
  });
