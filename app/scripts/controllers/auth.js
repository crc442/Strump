'use strict';

/**
 * @ngdoc function
 * @name strumpApp.controller:AuthCtrl
 * @description
 * # AuthCtrl
 * Controller of the strumpApp
 */
angular.module('strumpApp')
  .controller('AuthCtrl', function ($scope, $http, $location, $cookieStore, api) {

        $scope.login = function() {

            console.log($scope.type);
            $http.post('backend/login.php', {
                'name': $scope.name,
                'password': $scope.password,
                'type': $scope.type
            }).
            success(function(data, status) {
                var token = data.token;
                api.init(token);
                // $cookieStore.put('token', token);
                if(data.valid)
                {
                  console.log($scope.type);
                  if($scope.type === 'users')
                  {
                    $location.path('/user/'+$scope.name);
                  }
                }
                else{
                  $scope.loginerr = true;
                }
                console.log(status);
                console.log(data);
            }).
            error(function(data, status) {
                $scope.data = data || 'Request failed';
                $scope.status = status;
                console.log('sffssdfsd');
                console.log(status);
            });
        };

        $scope.userRegister = function() {
            $http.post('backend/registeruser.php', {
                'name': 'user.name',
                'password': 'user.password',
                'type': 'user.type'
            }).
            success(function(data, status) {
                console.log(data);
                $location.path('/home');
                console.log(status);
            }).
            error(function(data, status) {
                $scope.data = data || 'Request failed';
                $scope.status = status;
                console.log(status);
            });
        };


        $scope.artistRegister = function() {
            $http.post('backend/registerartist.php', {
                'name': 'user.name',
                'password': 'user.password',
                'type': 'user.type'
            }).
            success(function(data, status) {
                console.log(data);
                $location.path('/home');
                console.log(status);
            }).
            error(function(data, status) {
                $scope.data = data || 'Request failed';
                $scope.status = status;
                console.log(status);
            });

        };

    });
