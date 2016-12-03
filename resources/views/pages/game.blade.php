@extends('layout')
@section('content')
<div mc-messages></div>
<h4>To play: click to choose a tool</h4>
<section class="container-fluid game" ng-controller="gameCtrl">

	<div class="col-xs-3 no-margin" ng-repeat="tool in tools track by $index" id="<% tool %>">
		<button ng-disabled="isPlayed" ng-click="play($index)" class="no-style"><img src="../img/game/<% tool %>.png" class="icon"/></button>
	</div>
	<div class="col-xs-2 text-center" ng-show="isPlayed">
		<p>You VS Com</p>
		<div id="rs"></div>
		<div><a id="play-again" href='#' ng-click="resetGame()">Play Again</a></div>	
	</div>
	<div class="col-xs-3 no-margin" ng-repeat="tool in tools track by $index" ng-show="isPlayed" id="c<% tool %>">
		<button disabled="true" class="no-style"><img src="../img/game/<% tool %>.png" class="icon"/></button>
	</div>
</section>
@stop