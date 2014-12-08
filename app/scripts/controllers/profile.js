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

    $http.post('backend/getuserconcertlist.php', {
        'username': $routeParams.username
    }).
    success(function(data, status) {
        console.log(status);
        console.log(data);
        if (status === 200) {
            $scope.concertlist = data;
            console.log(data);
        }
    }).
    error(function(data, status) {
        $scope.data = data || 'Request failed';
        $scope.status = status;
        console.log(status);
        $scope.result = JSON.parse('{"error": "error"}');
    });


    $scope.followuser = function() {

        $http.post('backend/followUser.php', {
            'otherUserId': $routeParams.username,
        }).
        success(function(data, status) {
            console.log(status);
            console.log(data);
            if (status === 200) {
                console.log(data);
            }
        }).
        error(function(data, status) {
            $scope.data = data || 'Request failed';
            $scope.status = status;
            console.log(status);
            $scope.result = JSON.parse('{"error": "error"}');
        });
    };
});



app.controller('ArtistProfileCtrl', function($scope, $http, $routeParams) {
    $scope.username = $routeParams.ausername;

    $http.get('backend/getloggedinuser.php', {}).
    success(function(data, status) {
        console.log(status);
        console.log(data);
        if (status === 200) {
            $scope.loggedinuser = data;
            console.log(data);
        }
    }).
    error(function(data, status) {
        $scope.data = data || 'Request failed';
        $scope.status = status;
        console.log(status);
        $scope.result = JSON.parse('{"error": "error"}');
    });

    $http.get('backend/getloggedinusertype.php', {}).
    success(function(data, status) {
        console.log(status);
        console.log(data);
        if (status === 200) {
            $scope.loggedinusertype = data;
            console.log(data);
        }
    }).
    error(function(data, status) {
        $scope.data = data || 'Request failed';
        $scope.status = status;
        console.log(status);
        $scope.result = JSON.parse('{"error": "error"}');
    });


    $http.post('backend/artistprofile.php', {
        'username': $routeParams.ausername
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


    $http.post('backend/artisteventlist.php', {
        'artistId': $routeParams.ausername
    }).
    success(function(data, status) {
        console.log(status);
        console.log(data);
        if (status === 200) {
            $scope.listresult = data;
            console.log(data);
        }
    }).
    error(function(data, status) {
        $scope.data = data || 'Request failed';
        $scope.status = status;
        console.log(status);
        $scope.result = JSON.parse('{"error": "error"}');
    });


    $scope.followartist = function() {
        $http.post('backend/followArtist.php', {
            'otherUserId': $routeParams.ausername
        }).
        success(function(data, status) {
            console.log(status);
            console.log(data);
            if (status === 200) {
                console.log(data);
            }
        }).
        error(function(data, status) {
            $scope.data = data || 'Request failed';
            $scope.status = status;
            console.log(status);
            $scope.result = JSON.parse('{"error": "error"}');
        });
    };
});
