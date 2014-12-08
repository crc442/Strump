'use strict';

/**
 * @ngdoc function
 * @name strumpApp.controller:HomeCtrl
 * @description
 * # HomeCtrl
 * Controller of the strumpApp
 */
angular.module('strumpApp')
    .controller('HomeCtrl', function($scope, $http) {

        $scope.Math = window.Math;

        $scope.slangs = ['You should too.', '', 'What are you waiting for?', 'Check it out!'];

        $http.get('backend/allsearch.php', {}).
        success(function(data, status) {
            console.log(status);
            console.log(data);
            if (status === 200) {
                $scope.searchlist = data;
                console.log(data);
            }
        }).
        error(function(data, status) {
            $scope.data = data || 'Request failed';
            $scope.status = status;
            console.log(status);
            $scope.result = JSON.parse('{"error": "error"}');
        });

        $http.get('backend/homedetails.php', {}).
        success(function(data, status) {
            console.log(status);
            console.log(data);
            if (status === 200) {
                $scope.details = data;
                console.log(data);
            }
        }).
        error(function(data, status) {
            $scope.data = data || 'Request failed';
            $scope.status = status;
            console.log(status);
            $scope.result = JSON.parse('{"error": "error"}');
        });

        $http.get('backend/getre.php', {}).
        success(function(data, status) {
            console.log(status);
            console.log(data);
            if (status === 200) {
                $scope.relist = data;
                console.log(data);
            }
        }).
        error(function(data, status) {
            $scope.data = data || 'Request failed';
            $scope.status = status;
            console.log(status);
            $scope.result = JSON.parse('{"error": "error"}');
        });

        $http.get('backend/getfollowersfollower.php', {}).
        success(function(data, status) {
            console.log(status);
            console.log(data);
            if (status === 200) {
                // data.follow_date = data.follow_date.map(function(d) { return new Date(d * 1000); });
                $scope.ffollowers = data;
                console.log($scope.ffollowers.length);
            }
        }).
        error(function(data, status) {
            $scope.data = data || 'Request failed';
            $scope.status = status;
            console.log(status);
            $scope.result = JSON.parse('{"error": "error"}');
        });


        $scope.onSelect = function($item, $model, $label) {
            console.log($model);
            console.log($label);
            var path = '#/home';
            if ($item.category === 'user') {
                path = '#/user/' + $item.keyword;
            } else if ($item.category === 'artist') {
                path = '#/artist/' + $item.keyword;
            } else if ($item.category === 'system') {
                path = '#/concert/system/' + $item.concert_id;
            } else {
                path = '#/concert/other/' + $item.concert_id;
            }
            window.location.href = path;
        };

    });
