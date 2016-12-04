@extends('layout')
@section('content')
<div mc-messages></div>
<section class="container game" ng-controller="gameCtrl">
	<div class="row">
		<div class="center-block" ng-cloak>
			<div class="col-xs-2 no-margin" ng-repeat="tool in tools track by $index" id="<% tool %>">
				<button disabled="true" class="no-style"><img ng-src="../img/game/<% tool %>.png" class="icon-c img-responsive"/></button>
			</div>
			<div class="col-xs-2 text-center">
				<p>Com1 VS Com2</p>
				<div id="rs" ng-show="isPlayed"></div>
				<div ng-show="isPlayed"><a id="play-again" href='' ng-click="resetCVSCGame()">Play Again</a></div>
				<div ng-hide="isPlayed"><button type="button" class="btn btn-primary" ng-click="playCVSC()">Play</button></div>
			</div>
			<div class="col-xs-2 no-margin" ng-repeat="tool in tools track by $index" id="c<% tool %>">
				<button disabled="true" class="no-style"><img ng-src="../img/game/<% tool %>.png" class="icon-c img-responsive"/></button>
			</div>
		</div>
	</div>
</section>
@stop