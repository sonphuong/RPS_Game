var app = angular.module('gameApp', ["ngRoute",'MessageCenterModule'], function($interpolateProvider){
    //angularjs and laravel using the same symbol {{}} for display variable so need to change one of them to avoid conflict
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});
app.controller('layoutCtrl', ['$scope', function($scope){
    //set menu active
    $scope.isHomePage = (window.location.pathname=="/")?true:false;
    $scope.isGamePage = (window.location.pathname.indexOf("game")==1)?true:false;
    $scope.isCVSCPage = (window.location.pathname.indexOf("cvsc")==1)?true:false;

}]);