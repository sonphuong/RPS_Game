app.controller('gameCtrl', ['$scope','$cookies','$http','messageCenterService','$q','$location','$controller', function($scope,$cookies,$http,messageCenterService,$q,$location,$controller){
    
    $scope.tools = ["rock","paper","scissors"];
    $scope.isPlayed = false;
    $scope.isShowResponse = false;
    //$cookies.score = 0;
    if(!$cookies.score || $cookies.score == "NaN"){
        $cookies.score = 0;
    }
    $scope.isCongra = false;//init not display congras
    $scope.$watch(function(){return $cookies.score;},function($score){
        $scope.score = $score;
        if($score % 2 == 0 && $score > 0){
            $scope.isCongra = true;
        }
        else{
            $scope.isCongra = false;
        }
    });
    /**
     * when game over only the selected tools are shown this function to make all tools show up again
     * @return {void}
     */
    $scope.showAll = function(){
        for (var i = 0; i <=  $scope.tools.length; i++) {
            $("#"+$scope.tools[i]).show();
            if(i != 0){
                $("#"+$scope.tools[i]).removeClass("col-md-offset-2");
            }
        }
    }


    /**
     * similar to showAll function but it is for option computer vs computer
     * @return {void}
     */
    $scope.showCVSCAll = function(){
        for (var i = 0; i <=  $scope.tools.length; i++) {
            $("#"+$scope.tools[i]).show();
            $("#c"+$scope.tools[i]).show();
            $("#"+$scope.tools[i]).removeClass("col-md-offset-8");
        }
    }


    /**
     * show play again button
     * @return {void}
     */
    $scope.showPlayAgain = function(){
        $scope.isPlayed = true;
    }


    /**
     * show the selected tools from user or computer and hide the others options
     * @param  {int} selected1
     * @param  {int} selected2
     * @param  {int} isComVsCom
     * @return {void}
     */
    $scope.showSelected = function(selected1, selected2, isComVsCom){
        for (var i = 0; i <  $scope.tools.length; i++) {
            if(selected1!=i){
                $("#"+$scope.tools[i]).hide();
            }
            else{
                if(isComVsCom){
                    $("#"+$scope.tools[i]).addClass("col-md-offset-8");
                }
                else{
                    $("#"+$scope.tools[i]).addClass("col-md-offset-2");
                }
                 
            }
            if(selected2==i){
                $("#c"+$scope.tools[i]).show();
            }
            else{
                $("#c"+$scope.tools[i]).hide();   
            }
        }
    }


    /**
     * user click to choose a tool to play
     * @param  {int} intToolIdx
     * @return {void}
     */
    $scope.play = function (intToolIdx) {
        var req = {
                    method: 'POST',
                    url: '/game/play',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {"intToolIdx": intToolIdx}
            };
        $http(req)
        .success(function (rtData) {
            if (rtData.rs == 1) {
                $scope.showRS("You win",rtData.rs);
                $cookies.score = parseInt($cookies.score) + 1;
            }
            else if(rtData.rs == 0) {
                $scope.showRS("Draw",rtData.rs);
            }
            else {
                $cookies.score = parseInt($cookies.score) - 1;
                $scope.showRS("You loose",rtData.rs);
            }
            $scope.showSelected(intToolIdx, rtData.rp);
            $scope.showPlayAgain();
        })
        .error(function(){
            messageCenterService.add('danger', "Error", {timeout: 5000});
            $scope.showPlayAgain();
        });
    };


    /**
     * show result win/loose/draw
     * @param  {String} msg Win/Loose/Draw
     * @param  {Int} rs
     * @return {void}
     */
    $scope.showRS = function(msg,rs){
        switch(rs) {
            case 1:
                cl = "win";
                break;
            case -1:
                cl = "loose";
                break;            
            case 0:
                cl = "draw";
                break;
            default:
                cl = "";
        }
        $("#rs").html(""+msg+"");
        $("#rs").removeAttr('class');
        $("#rs").addClass(cl);
    }


    /**
     * when user click Play button for computer vs computer option
     * @return {void}
     */
    $scope.playCVSC = function () {
        var req = {
                    method: 'POST',
                    url: '/game/playCVSC',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            };
        $http(req)
        .success(function (rtData) {
            if (rtData.rs == 1) {
                $scope.showRS("Com1 win",rtData.rs);
            }
            else if(rtData.rs == 0) {
                $scope.showRS("Draw",rtData.rs);
            }
            else {
                $scope.showRS("Com2 win",1);
            }
            $scope.showSelected(rtData.com1, rtData.com2, 1);
            $scope.showPlayAgain();
        })
        .error(function(){
            messageCenterService.add('danger', "Error", {timeout: 5000});
            $scope.showPlayAgain();
        });
    };


    /**
     * user click Play Again button (player vs computer screen)
     * @return {void}
     */
    $scope.resetGame = function(){
        $scope.isPlayed = false;
        $scope.showAll();
        messageCenterService.remove();
    }


    /**
     * user click Play Again button () computer vs computer option
     * @return {void}
     */
    $scope.resetCVSCGame = function(){
        $scope.isPlayed = false;
        $scope.showCVSCAll();
        messageCenterService.remove();
    }
}]);