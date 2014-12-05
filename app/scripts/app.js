'use strict';

/**
 * @ngdoc overview
 * @name strumpApp
 * @description
 * # strumpApp
 *
 * Main module of the application.
 */
angular
  .module('strumpApp', [
    'ngAnimate',
    'ngCookies',
    'ngResource',
    'ngRoute',
    'ngSanitize',
    'ngTouch'
  ])
  .config(function ($routeProvider) {
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
        controller: 'AboutCtrl'
      })
      .when('/user', {
        templateUrl: 'views/userregistration.html',
        controller: 'AboutCtrl'
      })
      .when('/artist', {
        templateUrl: 'views/artistregistration.html',
        controller: 'AboutCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });
  });
