angular.module('starter.controllers', [])

.controller('IndexCtrl', function($scope) {
  /*var tab = angular.element(document.querySelector('.tab-nav'));
  tab.remove();*/
})

.controller('RegisterCtrl', function($scope, $http) {
  $scope.envia = function(){
    $http.post('http://mastersofcode.com/api/customer',{
      "email" : this.email,
      "password" : this.pass,
      headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
      headers: {"Acces-Control-Allow-Origin" : '*'}
    }).success(function(data){
      console.log(data);
    })
  }
  /*
  var tab = angular.element(document.querySelector('.tab-nav'));
  tab.remove();*/
})

.controller('ChatDetailCtrl', function($scope, $stateParams, Chats) {
  $scope.chat = Chats.get($stateParams.chatId);
})

.controller('AccountCtrl', function($scope) {
  $scope.settings = {
    enableFriends: true
  };
});
