angular.module('starter.controllers', [])


/*Controlador para hacer la funcionalidad a Index*/
.controller('IndexCtrl', function($scope, $timeout, $state) {
  var tab = angular.element(document.querySelector('.tab-nav'));
  var header = angular.element(document.querySelector('.bar-stable'));
  header.remove();
  tab.remove();

  $timeout(function() {
      $state.go('tab.login');
  }, 3000);

})

/*Controlador para hacer la funcionalidad a login*/
.controller('LoginCtrl', function($scope, $http) {
  $scope.envia = function(){
    $http.post('http://mastersofcode.com/api/customer',{
      "email" : this.email,
      "password" : this.pass,
      "customer_type_id" : 1
    }).success(function(data){
      console.log(data.password);

    })
  }
  /*
  var tab = angular.element(document.querySelector('.tab-nav'));
  tab.remove();*/
})

/*Controlador para hacer la funcionalidad a el registro*/
.controller('RegisterCtrl', function($scope, $http){
  console.log("HolaMundo");
  var tab = angular.element(document.querySelector('.tab-nav'));
  var header = angular.element(document.querySelector('.bar-stable'));
  header.remove();
  tab.remove();

  $scope.enviar = function(){
    console.log(this.first_name, this.last_name, this.birth_date,this.gender,this.email,this.pass);
    $http.post('http://mastersofcode.com/api/customer',{
      "firsname": this.first_name,
      "lastname" : this.last_name,
      "birthdate":this.birth_date,
      "gender":this.gender,
      "email":this.email,
      "password" : this.pass,
      "customer_type_id" : 1
    }).success(function(data){
      console.log(data);
    })
  }
})


.controller('ChooseCtrl', function($scope, $stateParams, Chats) {
  console.log("HOla");
  var tab = angular.element(document.querySelector('.tab-nav'));
  var header = angular.element(document.querySelector('.bar-stable'));
  header.remove();
  tab.remove();
});
