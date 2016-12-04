@extends('layout')
@section('content')
<div mc-messages></div>

<section class="container-fluid game" ng-controller="gameCtrl">
	<div class="row">
		<div class="center-block" ng-cloak>
			<div ng-cloak class="col-md-3" ng-repeat="tool in tools track by $index" id="<% tool %>" ng-class="{'col-md-offset-2':$first}">
				<button ng-disabled="isPlayed" ng-click="play($index)" class="no-style"><img ng-src="../img/game/<% tool %>.png" class="icon img-responsive"/></button>
			</div>
			<div ng-cloak class="col-md-2 center-block" ng-show="isPlayed" >
				<p>You VS Com</p>
				<p id="rs"></p>
				<p><a id="play-again" href='' ng-click="resetGame()">Play Again</a></p>	
			</div>
			<div ng-cloak class="col-md-3" ng-repeat="tool in tools track by $index" ng-show="isPlayed" id="c<% tool %>">
				<button disabled="true" class="no-style"><img ng-src="../img/game/<% tool %>.png" class="icon img-responsive"/></button>
			</div>
		</div>
	</div>
</section>
@stop