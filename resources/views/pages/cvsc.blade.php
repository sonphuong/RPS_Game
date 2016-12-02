@extends('layout')
@section('content')

<div mc-messages></div>
<section class="container" ng-controller="gameCtrl">
	
	<span ng-repeat="tool in tools track by $index" id="<% tool %>">
		<button disabled="true"><img src="../img/game/<% tool %>.png" class="icon"/></button>
	</span>
	<span ng-show="isPlayed"><a id="play-again" href='#' ng-click="resetCVSCGame()">Play Again</a></span>
	<span ng-hide="isPlayed"><button type="button" class="btn btn-primary" ng-click="playCVSC()">Play</button></span>
	<span ng-repeat="tool in tools track by $index" id="c<% tool %>">
		<button disabled="true"><img src="../img/game/<% tool %>.png" class="icon"/></button>
	</span>
</section>

@stop