'use strict';

/**
 * @ngdoc function
 * @name strumpApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the strumpApp
 */
angular.module('strumpApp')
  .controller('AboutCtrl', function ($scope) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
  });
