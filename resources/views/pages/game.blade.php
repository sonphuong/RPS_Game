@extends('layout')
@section('content')
<div mc-messages></div>

<section class="container-fluid" ng-controller="gameCtrl">
	<div class="row" id="congra" ng-show="isCongra">
		<div class="center-block">
			<h4>Congratulation! level up</h4>
			<div><img src="../img/game/golden-star-icon.png"></div>
		</div>
	</div>
	<h3>Your score: <%score%></h3>
	<div class="row v-center">
		<div class="center-block" ng-cloak>
			<div ng-cloak class="col-md-3" ng-repeat="tool in tools track by $index" id="<% tool %>" ng-class="{'col-md-offset-2':$first}">
				<button ng-disabled="isPlayed" ng-click="play($index)" class="no-style"><img ng-src="../img/game/<% tool %>.png" class="icon img-responsive"/></button>
			</div>
			<div ng-cloak class="col-md-2 center-block top-bottom-5" ng-show="isPlayed" >
				<div>You VS Com</div>
				
				<div id="rs"></div>
				<div><a id="play-again" href='' ng-click="resetGame()">Play Again</a></div>	
			</div>
			<div ng-cloak class="col-md-3" ng-repeat="tool in tools track by $index" ng-show="isPlayed" id="c<% tool %>">
				<button disabled="true" class="no-style"><img ng-src="../img/game/<% tool %>.png" class="icon img-responsive"/></button>
			</div>
		</div>
	</div>
</section>
@stop