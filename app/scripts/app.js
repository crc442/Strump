'use strict';

/**
 * @ngdoc overview
 * @name strumpApp
 * @description
 * # strumpApp
 *
 * Main module of the application.
 */
var app = angular
    .module('strumpApp', [
        'ngAnimate',
        'ngCookies',
        'ngResource',
        'ngRoute',
        'ngSanitize',
        'ngTouch'
    ]);


app.config(function($routeProvider, $httpProvider) {

        $httpProvider.responseInterceptors.push('httpInterceptor');

        $routeProvider
            .when('/', {
                templateUrl: 'views/index.html',
                controller: 'MainCtrl'
            })
            .when('/about', {
                templateUrl: 'views/about.html',
                controller: 'AboutCtrl'
            })
            .when('/login', {
                templateUrl: 'views/login.html',
                controller: 'AuthCtrl'
            })
            .when('/user', {
                templateUrl: 'views/userregistration.html',
                controller: 'AuthCtrl'
            })
            .when('/artist', {
                templateUrl: 'views/artistregistration.html',
                controller: 'AuthCtrl'
            })
            .when('/userprofile', {
                templateUrl: 'views/userprofile.html',
                controller: 'UserProfileCtrl'
            })
            .when('/user/:username', {
                templateUrl: 'views/userprofile.html',
                controller: 'UserProfileCtrl'
            })
            .otherwise({
                redirectTo: '/'
            });

        // $locationProvider.html5Mode(true);
    });

app.run(function (api) {
  api.init();
});


app.factory('api', function ($http, $cookies) {
  return {
      init: function (token) {
          $http.defaults.headers.common['X-Access-Token'] = token || $cookies.token;
      }
  };
});

app.factory('httpInterceptor', function httpInterceptor ($q, $window, $location) {
  return function (promise) {
      var success = function (response) {
          return response;
      };

      var error = function (response) {
          if (response.status === 401) {
              $location.url('/login');
          }

          return $q.reject(response);
      };

      return promise.then(success, error);
  };
});
