'use strict';

/**
 * @ngdoc function
 * @name strumpApp.controller:SearchCtrl
 * @description
 * # SearchCtrl
 * Controller of the strumpApp
 */
angular.module('strumpApp')
  .controller('SearchCtrl', function ($scope, $http) {

    $http.get('backend/allsearch.php', {
    }).
    success(function(data, status) {
      console.log(status);
      console.log(data);
        if (status === 200) {
            $scope.searchresult = data;
            console.log(data);
        }
    }).
    error(function(data, status) {
        $scope.data = data || 'Request failed';
        $scope.status = status;
        console.log(status);
        $scope.result = JSON.parse('{"error": "error"}');
    });

  });
