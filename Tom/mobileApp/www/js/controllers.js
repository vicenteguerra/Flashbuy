angular.module('starter.controllers', [])

.controller('IndexCtrl', function($scope) {
  var tab = angular.element(document.querySelector('.tab-nav'));
  tab.remove();
})

.controller('RegisterCtrl', function($scope, $htttp) {
  $scope.envia = function(){
    $http.post('route',{
      "email" : this.email,
      "password" : this.pass 
    }).success(data){
      console.log(data);
    }
  }

  var tab = angular.element(document.querySelector('.tab-nav'));
  tab.remove();
})

.controller('ChatDetailCtrl', function($scope, $stateParams, Chats) {
  $scope.chat = Chats.get($stateParams.chatId);
})

.controller('AccountCtrl', function($scope) {
  $scope.settings = {
    enableFriends: true
  };
});
