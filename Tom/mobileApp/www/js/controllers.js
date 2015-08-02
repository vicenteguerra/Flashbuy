angular.module('starter.controllers', ['ngCookies'])


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
    $http.post('http://mastersofcode.com/auth/login',{
      "email" : this.email,
      "password" : this.pass
    }).success(function(data, status, xtr){
      console.log("Login");
      $scope.usuario = $cookies.get('user');
      $cookies.put('user', true);
    }).error(function(data){
      console.log("No: " + data.error);
    })
  }
  /*
  var tab = angular.element(document.querySelector('.tab-nav'));
  tab.remove();*/
})

/*Controlador para hacer la funcionalidad a el registro*/
.controller('RegisterCtrl', function($scope, $http){
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

.controller('registerPersonCtrl', function($scope, $http){
  var tab = angular.element(document.querySelector('.tab-nav'));
  var header = angular.element(document.querySelector('.bar-stable'));
  header.remove();
  tab.remove();
})

.controller('registerBusinessCtrl', function($scope, $http){
  var tab = angular.element(document.querySelector('.tab-nav'));
  var header = angular.element(document.querySelector('.bar-stable'));
  header.remove();
  tab.remove();
})

.controller('businessInformationCtrl', function($scope, $http){

})


.controller('ChooseCtrl', function($scope, $stateParams, $state) {
  var tab = angular.element(document.querySelector('.tab-nav'));
  var header = angular.element(document.querySelector('.bar-stable'));
  header.remove();
  tab.remove();
  $scope.flag1 = true; //Persons
  $scope.flag2 = true; //Business
  $scope.changeColor = function(flag){
    if(flag == "flag1"){
      $scope.flag1 = false;
       $scope.flag2 = true;
    }else{
      $scope.flag2 = false;
       $scope.flag1 = true;
    }
  }
  $scope.next = function(){
    if(!$scope.flag1){
      $state.go('tab.registerPerson');
    }
    if(!$scope.flag2){
      $state.go('tab.registerBusiness');
    }
  }

})

.controller('AccountCtrl', function($scope) {
  $scope.settings = {
    enableFriends: true
  };
});
