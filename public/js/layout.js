var app = angular.module('gameApp', ["ngRoute",'MessageCenterModule'], function($interpolateProvider,$locationProvider){
    //angularjs and laravel using the same symbol {{}} for display variable so need to change one of them to avoid conflict
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
    $locationProvider.html5Mode({
    	enabled: true,
  		requireBase: false //if dont have this -> $location in HTML5 mode requires a <base> tag to be present
    });//if dont set this $location.path() will return nothing
});


app.controller('layoutCtrl', ['$scope','$location', function($scope,$location){
    //set menu active
    
    $scope.path = $location.path();
    $scope.$watch('path',function($path){
	    $scope.isHomePage = ($path.indexOf("/")==1)?true:false;
	    $scope.isGamePage = ($path.indexOf("game")==1)?true:false;
	    $scope.isCVSCPage = ($path.indexOf("cvsc")==1)?true:false;
	    console.log('location: '+$path);
    });


}]);