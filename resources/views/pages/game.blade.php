@extends('layout')
@section('content')

<div mc-messages></div>
<section class="container" ng-controller="gameCtrl">
	
	<span ng-repeat="tool in tools track by $index" >
		<button ng-disabled="isPlayed" ng-click="play($index)" id="<% tool %>"><img src="../img/game/<% tool %>.png" class="icon"/></button>
	</span>
	<span ng-show="isPlayed"><a id="play-again" href='#' ng-click="resetGame()">Play Again</a></span>
	<span ng-repeat="tool in tools track by $index" ng-show="isPlayed" id="c<% tool %>">
		<button><img src="../img/game/<% tool %>.png" class="icon"/></button>
	</span>
</section>

@stop