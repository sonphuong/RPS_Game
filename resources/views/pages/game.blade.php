@extends('layout')
@section('content')
<div mc-messages></div>

<section class="container-fluid game" ng-controller="gameCtrl">
	<div class="row">
		<div class="center-block col-center" ng-cloak>
			<div ng-cloak class="col-xs-3" ng-repeat="tool in tools track by $index" id="<% tool %>" ng-class="{'col-xs-offset-2':$first}">
				<button ng-disabled="isPlayed" ng-click="play($index)" class="no-style"><img ng-src="../img/game/<% tool %>.png" class="icon img-responsive"/></button>
			</div>
			<div ng-cloak class="col-xs-2 text-center" ng-show="isPlayed" >
				<p>You VS Com</p>
				<div id="rs"></div>
				<div><a id="play-again" href='' ng-click="resetGame()">Play Again</a></div>	
			</div>
			<div ng-cloak class="col-xs-3" ng-repeat="tool in tools track by $index" ng-show="isPlayed" id="c<% tool %>">
				<button disabled="true" class="no-style"><img ng-src="../img/game/<% tool %>.png" class="icon img-responsive"/></button>
			</div>
		</div>
	</div>
</section>
@stop