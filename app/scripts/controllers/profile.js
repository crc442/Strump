'use strict';

/**
 * @ngdoc function
 * @name strumpApp.controller:UserProfileCtrl
 * @description
 * # UserProfileCtrl
 * Controller of the strumpApp
 */
var app = angular.module('strumpApp');

app.controller('UserProfileCtrl', function($scope, $http, $routeParams) {
    $scope.username = $routeParams.username;

    $http.post('backend/userprofile.php', {
        'username': $routeParams.username
    }).
    success(function(data, status) {
      console.log(status);
      console.log(data);
        if (status === 200) {
            $scope.result = data;
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
