'use strict';

/**
 * @ngdoc function
 * @name strumpApp.controller:OtherConcertCtrl
 * @description
 * # OtherConcertCtrl
 * Controller of the strumpApp
 */
angular.module('strumpApp')
    .controller('OtherConcertCtrl', function($scope, $http, $location, $routeParams) {

      $scope.concertid = $routeParams.concertId;


      $http.get('backend/getartistlist.php', {
      }).
      success(function(data, status) {
      console.log(status);
      console.log(data);
        if (status === 200) {
            $scope.artistlist = data;
            console.log(data);
        }
      }).
      error(function(data, status) {
          $scope.data = data || 'Request failed';
          $scope.status = status;
          console.log(status);
          $scope.result = JSON.parse('{"error": "error"}');
      });


      $http.get('backend/getvenue.php', {
      }).
      success(function(data, status) {
      console.log(status);
      console.log(data);
        if (status === 200) {
            $scope.venuelist = data;
            console.log(data);
        }
      }).
      error(function(data, status) {
          $scope.data = data || 'Request failed';
          $scope.status = status;
          console.log(status);
          $scope.result = JSON.parse('{"error": "error"}');
      });

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

      $http.post('backend/otherconcertdetails.php', {
          'concertId': $scope.concertid
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


        $scope.usercreateConcert = function() {

            console.log($scope.artistn);

            $http.post('backend/addOtherConcertByUser.php', {
                'concertName': $scope.concertName,
                'venueId': $scope.venue,
                'date': $scope.concertDate,
                'catType': $scope.cat,
                'artistId' : $scope.artistn
            }).
            success(function(data, status) {
                console.log(status);
                console.log(data);
                console.log(data.username);

                if (data.valid) {
                    $location.path('/user/' + data.username);
                } else {
                    $scope.loginerr = true;
                }

            }).
            error(function(data, status) {
                $scope.data = data || 'Request failed';
                $scope.status = status;
                console.log(status);
                $scope.result = JSON.parse('{"error": "error"}');
            });


        };

        $scope.addToMylist = function() {

            $http.post('backend/addOtherConToWishList.php', {
                'concertId': $scope.concertid
            }).
            success(function(data, status) {
                console.log(status);
                console.log(data);
            }).
            error(function(data, status) {
                $scope.data = data || 'Request failed';
                $scope.status = status;
                console.log(status);
                $scope.result = JSON.parse('{"error": "error"}');
            });


        };

    });
