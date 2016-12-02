@extends('layout')
@section('content')
<div mc-messages></div>
<section class="container" ng-controller="gameCtrl">
	<div class="col-xs-2 no-margin" ng-repeat="tool in tools track by $index" id="<% tool %>">
		<button disabled="true"><img src="../img/game/<% tool %>.png" class="icon"/></button>
	</div>
	<div class="col-xs-2 text-center">
		<p>Com1 VS Com2</p>
		<div ng-show="isPlayed"><a id="play-again" href='#' ng-click="resetCVSCGame()">Play Again</a></div>
		<div ng-hide="isPlayed"><button type="button" class="btn btn-primary" ng-click="playCVSC()">Play</button></div>
	</div>
	<div class="col-xs-2 no-margin" ng-repeat="tool in tools track by $index" id="c<% tool %>">
		<button disabled="true"><img src="../img/game/<% tool %>.png" class="icon"/></button>
	</div>
</section>
@stop