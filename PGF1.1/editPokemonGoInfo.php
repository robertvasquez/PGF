<?php 
    session_start();
    if(!isset($_SESSION["id"]) || empty($_SESSION["id"])){
	header("location: loginform.php");
	exit;
    }
?>

<!DOCTYPE html>
<html lang = "en" ng-app="myApp">

    <head>
	<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
            
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>	
	<script src="sweetalert-master/dist/sweetalert.min.js"></script>
		
	<link href="bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css">
	<link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="pokemongo.css">
    </head>
	
    <body class="siteFontColor">
	
	<div class="container-fluid">
            
            <div ng-controller="User">
	    </div>
		
	    <div class="row bannerFontColor pokemon3D c" style="font-size: 50px">
		Edit Pok&#233monGo Information
	    </div>
            
	    <div class="row threeDText c" style="padding-top: 40px">
		<div class="col-xs-12" style="min-width: 320px">
                    <form name="InfoForm" ng-controller="EditInfo" ng-submit="myInfo()" autocomplete="off" novalidate>
			<div class="row rMargin c">
                            <div class="col-xs-2 col-sm-offset-5">
                                UserName: {{username}}
                                <input type="text" class="form-control" placeholder="UserName" maxlength="20"
                                    ng-model="userNameInput" required name="userNameInput">
                            </div>
			</div>
                        <div class="row rMargin c">
                            <div class="col-xs-2 col-sm-offset-5">
                                <div ng-if="usernameMessage =='1'">
                                    UserName taken, please enter a new UserName.
                                </div>
                            </div>
                        </div>
			<div class="row rMargin c">
                            <div class="col-xs-2 col-sm-offset-5" ng-init="teamInput=Unavailable">
                                Team: {{team}}
                                <div class="col-xs-12" ng-init="teamInput=Unavailable">
                                    <input type="radio" ng-model="teamInput" value="Unavailable" ng-checked="true"> Unavailable<br>
                                    <input type="radio" ng-model="teamInput" value="Mystic"> Mystic<br>
                                    <input type="radio" ng-model="teamInput" value="Instinct"> Instinct<br>
                                    <input type="radio" ng-model="teamInput" value="Valor"> Valor<br>
                                </div>
                            </div>
			 </div>
                        <div class="row rMargin c">
                            <div class="col-xs-2 col-sm-offset-5">
                                <div ng-if="teamMessage =='1'">
                                    Level must be 5 or above to choose Team Mystic, Instinct, or Valor.
                                    Level must be 4 or below to choose Unavailable.
                                </div>
                            </div>
                        </div>
			<div class="row rMargin c">
                            <div class="col-xs-2 col-sm-offset-5">
                                Level: {{level}}
                                <input type="number" class="form-control" placeholder="Level" min="0" max="40"
                                    ng-model="levelInput" required name="levelInput">
                            </div>
			</div>
                        <div class="row rMargin c">
                            <div class="col-xs-2 col-sm-offset-5">
                                <div ng-if="levelMessage =='1'">
                                    Level must be 0 or above, and below 41.
                                </div>
                            </div>
                        </div>
			<div class="row rMargin c">
                            <div class="col-xs-2 col-sm-offset-5">
                                Number of Pok&#233mon Caught: {{caught}}
                                <input type="number" class="form-control" placeholder="Caught Number" min="0" max="151"
                                    ng-model="caughtInput" required name="caughtInput">
                            </div>
			</div>
                        <div class="row rMargin c">
                            <div class="col-xs-2 col-sm-offset-5">
                                <div ng-if="caughtMessage =='1'">
                                    Level must be 0 or above, and below 41.
                                </div>
                            </div>
                        </div>
                        <div class="row rMargin c">
                            <input type="submit" id = "myInfo" value="Update PokemonGo Information">
                        </div>
		    </form>            
                </div>			
            </div>
                
            <div class="row threeDText c" style="padding-top: 40px">
                <div class="col-xs-12" style="min-width: 320px">
                    <form name="InfoForm" ng-controller="HomeLink" ng-submit="home()" autocomplete="off" novalidate>
                        <div class="row rMargin c">
                            <input type="submit" id = "home" value="Back to Profile">
                        </div>
                    </form>
                </div>
            </div>
            
        </div>

    	<script>
 	    var app = angular.module('myApp', []);
            
            app.controller('User', function($scope, $http){
                var url = window.location.search;
                var temp = url.split('=');
                var id = temp[temp.length-1];
			
                $http.post("getProfileStatus.php",{'u' : id}).success(function(data){
                    if(data.response=='false' || data.response=='notFriend'){
                        window.location.replace("profile.php?id="+id);
                    }
                });
            });    
            
            app.controller('EditInfo', function($scope, $http, $window) {
                
                var url = window.location.search;
                var temp = url.split('=');
                var id = temp[temp.length-1];
                
                $scope.username;
                $scope.team;
                $scope.level;
                $scope.caught;
                
                $scope.usernameMessage = "0";
                $scope.teamMessage = "0";
                $scope.levelMessage = "0";
                $scope.caughtMessage = "0";
                
                $scope.myInfo = function(){
                        
                    if ($scope.userNameInput == undefined) {
                        $scope.userNameInput = "";
                    }
                    
                    if ($scope.teamInput == undefined) {
                        $scope.teamInput = "Unavailable";
                    }
                    
                    if ($scope.userNameInput == "") {
                        $scope.usernameMessage = "0";
                    }
                        
                    $http.post("checkUsername.php",{'id' : id, 'username' : $scope.userNameInput}).success(function(data){
                        if (data.response == 'false') {
                            if ($scope.userNameInput != "") {
                                $scope.usernameMessage = "1";
                            }
                        }
                        if (data.response == 'true') {
                            $http.post("saveUsername.php",{'id' : id, 'username' : $scope.userNameInput}).success(function(data){
                                if (data.response == 'true') {
                                    $scope.usernameMessage = "0";
                                    $scope.username = $scope.userNameInput;
                                }
                            });
                                
                        }
                    });
                    
                    if ($scope.teamInput != undefined) {
                        
                        if ( $scope.level < 5 && $scope.teamInput != "Unavailable") {
                            $scope.teamMessage = "1";
                        }
                        if ( $scope.level >= 5 && $scope.teamInput == "Unavailable") {
                            $scope.teamMessage = "1";
                        }
                        if ( ( ($scope.level >= 5 && $scope.teamInput != "Unavailable") || ($scope.teamInput != "Unavailable" && ($scope.levelInput != undefined && $scope.levelInput >= 5)) )||
                             ( ($scope.level < 5 && $scope.teamInput == "Unavailable") || ($scope.teamInput == "Unavailable" && ($scope.levelInput != undefined && $scope.levelInput < 5)) ) ){
                            $scope.teamMessage = "0";
                            
                            $http.post("saveTeam.php",{'id' : id, 'team' : $scope.teamInput}).success(function(data){
                                if (data.response == 'true') {
                                    $scope.team = $scope.teamInput;
                                }
                            });
                        }
                    }
                    
                    if ($scope.levelInput != undefined) {
                        if ($scope.levelInput < 41 && $scope.levelInput >= 0) {
                            $scope.levelMessage = "0";
                            $http.post("saveLevel.php",{'id' : id, 'level' : $scope.levelInput}).success(function(data){
                                if (data.response == 'true') {
                                    $scope.level = $scope.levelInput;
                                }
                            });
                        }
                        if ($scope.levelInput > 40 || $scope.levelInput < 0) {
                            $scope.levelMessage = "1";
                        }
                    }
                    
                    if ($scope.caughtInput != undefined) {
                        if ($scope.caughtInput < 152 && $scope.caughtInput >= 0) {
                            $scope.caughtMessage = "0";
                            $http.post("saveCaught.php",{'id' : id, 'caught' : $scope.caughtInput}).success(function(data){
                                if (data.response == 'true') {
                                    $scope.caught = $scope.caughtInput;
                                }
                            });
                        }
                        if ($scope.caughtInput > 151 || $scope.caughtInput < 0) {
                            $scope.caughtMessage = "1";
                        }
                    }
                    
                }
                
                $http.post("getMemberInfo.php",{'id' : id}).success(function(data){
                    
                    $scope.username = data[0].username;
                    $scope.team = data[0].team;
                    $scope.level = data[0].level;
                    $scope.caught = data[0].caught;
                    
                    console.log(data[0].team);
                    
                    if ($scope.username == undefined) {
                        $scope.username = "Unavailable";
                    }
                    if ($scope.level == undefined) {
                        $scope.level = "0";
                    }
                    if ($scope.team == "") {
                        $scope.team = "Unavailable";
                    }
                    if ($scope.caught == undefined) {
                        $scope.caught = "0";
                    }
                });
            });
            
            app.controller('HomeLink', function($scope, $http, $window) {
                var url = window.location.search;
                var temp = url.split('=');
                var id = temp[temp.length-1];
                
                $scope.home = function(){
                    window.location.replace("profile.php?id="+id);
                }
            });
        </script>
 
    </body>
</html>