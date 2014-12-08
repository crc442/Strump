'use strict';

/**
 * @ngdoc function
 * @name strumpApp.controller:ConcertCtrl
 * @description
 * # ConcertCtrl
 * Controller of the strumpApp
 */

angular.module('strumpApp')
    .controller('ConcertCtrl', function($scope, $http, $location, $routeParams) {

        $scope.concertid = $routeParams.concertId;

        $scope.rate = 1;
        $scope.max = 5;
        $scope.isReadonly = false;

        $http.post('backend/getpostlist.php', {
            'concertId': $scope.concertid
        }).
        success(function(data, status) {
            console.log(status);
            console.log(data);
            if (status === 200) {
                $scope.postlist = data;
                console.log(data);
            }
        }).
        error(function(data, status) {
            $scope.data = data || 'Request failed';
            $scope.status = status;
            console.log(status);
            $scope.result = JSON.parse('{"error": "error"}');
        });


        $scope.getpostlisting = function() {

            $http.post('backend/getpostlist.php', {
                'concertId': $scope.concertid
            }).
            success(function(data, status) {
                console.log(status);
                console.log(data);
                if (status === 200) {
                    $scope.postlist = data;
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

        $http.post('backend/getvenue.php', {}).
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



        $http.get('backend/getmusiccategory.php', {}).
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

        $http.post('backend/concertdetails.php', {
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


        $scope.artistcreateConcert = function() {

            console.log($scope.concertName);

            $http.post('backend/createConcertByArtist.php', {
                'concertName': $scope.concertName,
                'venueId': $scope.venue,
                'date': $scope.concertDate,
                'catType': $scope.musiccategory,
                'price': $scope.ticketprice,
                'capacity': $scope.capacity,
                'tlink': $scope.ticketlink
            }).
            success(function(data, status) {
                console.log(status);
                console.log(data);
                console.log(data.username);

                if (data.valid) {
                    $location.path('/artist/' + data.username);
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

        $scope.rsvpConcert = function() {

            $http.post('backend/rsvpForConcert.php', {
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


        $scope.postcomment = function() {

            $http.post('backend/addPost.php', {
                'concertId': $scope.concertid,
                'commentData': $scope.postcontent
            }).
            success(function(data, status) {
                console.log(status);
                console.log(data);

                $scope.getpostlisting();
                $scope.postcontent = '';
            }).
            error(function(data, status) {
                $scope.data = data || 'Request failed';
                $scope.status = status;
                console.log(status);
                $scope.result = JSON.parse('{"error": "error"}');
            });
        };

        $scope.addToMylist = function() {

            $http.post('backend/addsyscontowishlist.php', {
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

        $scope.$watch('rate', function(value) {
            console.log(value);


            $http.post('backend/rateConcert.php', {
                'concertId': $scope.concertid,
                'rate' : value

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

        });






    });
