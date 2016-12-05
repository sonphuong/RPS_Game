@extends('layout')
@section('content')
<div mc-messages></div>
<section class="container-fluid" ng-controller="gameCtrl">
	<div class="row v-center">
		<div class="center-block" ng-cloak>
			<div class="col-md-5 center-block">
				<div class="col-md-4" ng-repeat="tool in tools track by $index" id="<% tool %>">
					<button disabled="true" class="no-style"><img ng-src="../img/game/<% tool %>.png" class="icon-c img-responsive"/></button>
				</div>
			</div>
			<div class="col-md-2 center-block top-bottom-5">
				<div>Com1 VS Com2</div>
				<div id="rs" ng-show="isPlayed"></div>
				<div ng-show="isPlayed"><a id="play-again" href='' ng-click="resetCVSCGame()">Play Again</a></div>
				<div ng-hide="isPlayed"><button type="button" class="btn btn-primary" ng-click="playCVSC()">Play</button></div>
			</div>
			<div class="col-md-5">
				<div class="col-md-4" ng-repeat="tool in tools track by $index" id="c<% tool %>">
					<button disabled="true" class="no-style"><img ng-src="../img/game/<% tool %>.png" class="icon-c img-responsive"/></button>
				</div>
			</div>
		</div>
	</div>
</section>
@stop