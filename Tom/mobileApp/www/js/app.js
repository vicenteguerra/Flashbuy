// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
// 'starter.services' is found in services.js
// 'starter.controllers' is found in controllers.js
angular.module('starter', ['ionic','ngCordova', 'starter.controllers', 'starter.services'])

.run(function($ionicPlatform) {
  $ionicPlatform.ready(function() {
    // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
    // for form inputs)
    if (window.cordova && window.cordova.plugins && window.cordova.plugins.Keyboard) {
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
      cordova.plugins.Keyboard.disableScroll(true);

    }
    if (window.StatusBar) {
      // org.apache.cordova.statusbar required
      StatusBar.styleLightContent();
    }
  });
})

.config(function($stateProvider, $urlRouterProvider, $httpProvider) {

  // Ionic uses AngularUI Router which uses the concept of states
  // Learn more here: https://github.com/angular-ui/ui-router
  // Set up the various states which the app can be in.
  // Each state's controller can be found in controllers.js
  $stateProvider

  // setup an abstract state for the tabs directive
    .state('tab', {
    url: '/tab',
    abstract: true,
    templateUrl: 'templates/tabs.html'
  })

  // Each tab has its own nav history stack:

  .state('tab.index', {
    url: '/index',
    views: {
      'tab-index': {
        templateUrl: 'templates/Index.html',
        controller: 'IndexCtrl'
      }
    }
  })

  .state('tab.login', {
      url: '/index/login',
      views: {
        'tab-register': {
          templateUrl: 'templates/login.html',
          controller: 'LoginCtrl'
        }
      }
    })

  .state('tab.register', {
      url: '/index/login/register',
      views: {
        'tab-register': {
          templateUrl: 'templates/register.html',
          controller: 'RegisterCtrl'
        }
      }
    })
    .state('tab.choose', {
      url: '/index/choose',
      views: {
        'tab-register': {
          templateUrl: 'templates/choose.html',
          controller: 'ChooseCtrl'
        }
      }
    })

    .state('tab.registerPerson', {
    url: '/register/person',
    views: {
      'tab-register': {
        templateUrl: 'templates/registerPerson.html',
        controller: 'registerPersonCtrl'
      }
    }
  })

    .state('tab.registerBusiness', {
    url: '/register/business',
    views: {
      'tab-register': {
        templateUrl: 'templates/registerBusiness.html',
        controller: 'registerBusinessCtrl'
      }
    }
  })

   .state('tab.businessInformation', {
    url: '/register/business/information',
    views: {
      'tab-register': {
        templateUrl: 'templates/businessInformation.html',
        controller: 'businessInformationCtrl'
      }
    }
  })

   .state('tab.paymentsPayNow', {
    url: '/payments/paynow',
    views: {
      'tab-payments': {
        templateUrl: 'templates/payNow.html',
        controller: 'payNowCtrl'
      }
    }
  })

     .state('tab.paymentsCharge', {
    url: '/payments/charge',
    views: {
      'tab-payments': {
        templateUrl: 'templates/charge.html',
        controller: 'scannerController'
      }
    }
  })

  .state('tab.account', {
    url: '/account',
    views: {
      'tab-account': {
        templateUrl: 'templates/tab-account.html',
        controller: 'AccountCtrl'
      }
    }
  });

  // if none of the above states are matched, use this as the fallback
  $urlRouterProvider.otherwise('/tab/index');

});
