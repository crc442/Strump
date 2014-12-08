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


      $http.get('backend/getmusiccategory.php', {
      }).
      success(function(data, status) {
        console.log(status);
        console.log(data);
          if (status === 200) {
              $scope.musiccat = data;
              console.log(data);
          }
      }).
      error(function(data, status) {
          $scope.data = data || 'Request failed';
          $scope.status = status;
          console.log(status);
          $scope.result = JSON.parse('{"error": "error"}');
      });

      $http.get('backend/getcompanylist.php', {
      }).
      success(function(data, status) {
        console.log(status);
        console.log(data);
          if (status === 200) {
              $scope.companylist = data;
              console.log(data);
          }
      }).
      error(function(data, status) {
          $scope.data = data || 'Request failed';
          $scope.status = status;
          console.log(status);
          $scope.result = JSON.parse('{"error": "error"}');
      });



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
                  if($scope.type === 'artists')
                  {
                    $location.path('/artist/'+$scope.name);
                  }
                  else
                  {
                    $scope.loginerr = true;
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


          console.log($scope.musicCategory);
            $http.post('backend/registeruser.php', {
                'userNameid': $scope.userNameid,
                'fNameId': $scope.fNameId,
                'lNameId': $scope.lNameId,
                'userCity' : $scope.userCity,
                'inputEmailID' : $scope.inputEmailID,
                'password' : $scope.password,
                'musiccat' : $scope.musicCategory
            }).
            success(function(data, status) {
                console.log(status);
                console.log(data);
                if(data.valid)
                {
                    console.log($scope.type);
                    $location.path('/user/'+$scope.userNameid);
                }
                else{
                  $scope.loginerr = true;
                  $scope.usererror = data.error;
                }
            }).
            error(function(data, status) {
                $scope.data = data || 'Request failed';
                $scope.status = status;
                console.log(status);
            });
        };


        $scope.artistRegister = function() {
            $http.post('backend/registerartist.php', {
                'artistusername': $scope.artistusername,
                'artistname': $scope.artistname,
                'website' : $scope.artistwebsite,
                'artistcompany' : $scope.artistcompany,
                'password' : $scope.apassword,
                'company' : $scope.company,
                'musiccat' : $scope.selectedCat
            }).
            success(function(data, status) {
                console.log(status);
                console.log(data);
                if(data.valid)
                {
                    console.log($scope.type);
                    $location.path('/artist/'+$scope.artistusername);
                }
                else{
                  $scope.loginerr = true;
                  $scope.usererror = data.error;
                }
            }).
            error(function(data, status) {
                $scope.data = data || 'Request failed';
                $scope.status = status;
                console.log(status);
            });

        };

    });
