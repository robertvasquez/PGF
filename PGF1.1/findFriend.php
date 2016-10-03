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
		
	<!-- <link rel="icon" href="PGFlogo1.png"> -->	
    </head>
	
    <body class="siteFontColor" ng-cloak>
	<div class="container-fluid" ng-controller="SearchShowMember">
			
	    <div class="row bannerFontColor pokemon3D">
		<div class="col-xs-4 c" style="font-size: 40px; padding-top: 15px; min-width: 320px">
		    Find Friends
		</div>
		<div class="col-xs-1 c" style="min-width: 140px; padding-top: 20px">
                    <form ng-submit="profile()">
    			<input type="submit" id = "profile" value="Back to Profile" style="color: black">
		    </form>
                </div>
		<div class="col-xs-2 c" style="padding-top: 20px">
		    <input type="text" class="form-control" placeholder="Search Members"
			ng-model="searchInput" ng-change="searchM()">
		</div>
	    </div>
	    <div ng-if="showSearch == '1'">
		<div class="row c" style="font-size: 40px">
		    Search Results
		</div>
	    </div>
	    <div class="row">
		<div ng-repeat="result in sr">
		    <div class="col-xs-4 c" style="font-size: 25px; padding: 5px">
			<div ng-if="result.Profile != 'false'">		
                            <img ng-src="{{result.Profile}}" style="height:130px; width:130px" class="rcorners2">				
    			</div>
    			<div ng-if="result.Profile == 'false'">		
    			    <div class="blankProfilePictureFL">
       				No Profile<br>Picture
       			    </div>
       			</div>
			<div class="row" style="margin-right: 0px; margin-left:0px">
			    <div class="col-xs-12 c">
				{{ result.FirstName + " " + result.LastName}}
			    </div>
			</div>
			<div class="row" style="margin-right: 0px; margin-left:0px">
			    <div class="col-xs-12 c">
				{{ result.Gender }}
			    </div>
			</div>
			<div class="row" style="margin-right: 0px; margin-left:0px">
			    <div class="col-xs-12 c" style="font-size: 14px">
				<button type="button" ng-click="sendRequest(result.MemberID)">Send Friend Request</button>
			    </div>
			</div>
		    </div>
		</div>
	    </div>
			
	    <div class="row c">
		<div class="col-xs-6 col-sm-offset-3 c" style="font-size: 40px">
		    Newest Members
		</div>
	    </div>
			
	    <div class="row c" style="max-height: 400px; overflow-y: scroll" id="ff">
		<div ng-repeat="member in members | orderBy:myOrderByF">
		    <div class="col-xs-4 c" style="font-size: 40px; padding: 5px">
			<div class="row" style="margin-right: 0px; margin-left:0px">
			    <div ng-if="member.Profile != 'false'">		
    				<img ng-src="{{member.Profile}}" style="height:130px; width:130px" class="rcorners2">				
    			    </div>
    			    <div ng-if="member.Profile == 'false'">		
    				<div class="blankProfilePictureFL">
       				    No Profile<br>Picture
       				</div>
       			    </div>
			</div>
			<div class="row" style="margin-right: 0px; margin-left:0px; font-size: 25px">
			    {{ member.FirstName + " " + member.LastName }}
			</div>
			<div class="row" style="margin-right: 0px; margin-left:0px; font-size: 25px">
                            {{ member.Gender }}
			</div>
			<div class="row" style="margin-right: 0px; margin-left:0px">
			    <div class="col-xs-12 c" style="font-size: 14px">
				<button type="button" ng-click="sendRequest(member.MemberID)">Send Friend Request</button>
			    </div>
			</div>
		    </div>
		</div>
            </div>
	    <div ng-if="showMoreFriendButton == '1'">
		<div class="row" style="padding: 10px">
		    <div class="col-xs-12 c">
			<button type="button" ng-click="moreMembers()">See More Members</button>
		    </div>				
		</div>
	    </div>
	    <div ng-if="showMoreFriendButton == '0'">
		<div class="row" style="padding: 10px">
		    <div class="col-xs-12 c">
			No More Members to Show!
		    </div>				
		</div>
	    </div>
			
	</div>
    	
    	<script>
    	    var app = angular.module('myApp', []);

    	    app.controller('SearchShowMember', function($scope,$http,$q){
    		$startRow = 3;
        	$previousRow = 3;
        	$showMoreFriendButton = 0;

        	$scope.previous = 0;
    		$scope.sr1 = [];
    		$scope.sr = [];
    		$scope.showSearch = 0;
    		$scope.resultNumber = 0;
                
                var url = window.location.search;
                var temp = url.split('=');
                var id = temp[temp.length-1];
                
                $scope.profile = function(){
                    window.location.replace("profile.php?id="+id);	
                }

        	function getMembers(){
    		    $http.post("newMember.php", {'startFrom': $startRow}).success(function(data){
        		$scope.members = [];
        		$scope.m = data;
        		if((data.length >= 3) && (data.length % 3 == 0)){
        		    $scope.showMoreFriendButton = 1;
        		    $previousRow = $startRow;
        		    $startRow = $startRow + 3;	
        		}
        		if(!(data.length % 3 == 0)){
                            $scope.showMoreFriendButton = 0;
        		}
        		if((data.length > 3) && (data.length != $previousRow)){
			    $scope.showMoreFriendButton = 0;
        		}
        		angular.forEach($scope.m, function(value, key){
			    var promise1 = getProfilePicture(value);
			    $q.all([promise1]).then(function(data){
				$scope.members.push({FirstName: value.FirstName,
						    LastName: value.LastName,
						    MemberID: parseFloat(value.MemberID),
						    Profile: data[0].data,
						    Gender: value.Gender}); 
			    });	
        		});
        		function getProfilePicture(value){
                            var defer2 = $q.defer();
    			    var p= $http.post("getProfilePicture2.php",{'id' : value.MemberID});
    			    defer2.resolve(p);
    			    return defer2.promise;
    			}
    		    });
        	}
        	function updateScroll(){
        	    $("#ff").animate({ scrollTop: $("#ff")[0].scrollHeight}, 500);
        	}
        		
        	$scope.moreMembers = function(){
		    getMembers();
		    updateScroll();
        	}
        	$scope.sendRequest = function(data){
                    var index;
            	    var index2;
        	    for (var i = 0; i < $scope.members.length ; i++) {
        		if ($scope.members[i].MemberID == data) {
        		    index = i;
        		}
        	    }
        	    for (var i = 0; i < $scope.sr.length ; i++) {
        		if ($scope.sr[i].MemberID == data) {
        		    index2 = i;
        		}
        	    }
        	    console.log(index);
        	    $http.post("sendFriendRequest.php", {'requestTo': data}).success(function(data){
            		if(data.response == 'true'){
            		    $scope.members.splice(index,1);
            		    $scope.sr.splice(index2,1); 
			    swal("Request Sent!", "Friend Request was Delivered!", "success")
            		}
            		if(data.response == 'false'){
			    swal("Request Not Sent.", "Friend Request was Unable to Send", "success")
            		}
        	    });
        	}

                $scope.searchM = function(){
        	    $http.post("memberSearch.php", {'searchTerm': $scope.searchInput}).success(function(data){
                        if( data.length > 0 ){
            		    $scope.resultNumber = data.length;
            		    $scope.showSearch = 1;
            		}
            		if( data.response == "false" ){
            		    $scope.resultNumber = 0;
            		    $scope.previous = 0;
            		    $scope.showSearch = 0;
            		    $scope.sr = [];
            		}
            		if( $scope.resultNumber != $scope.previous ){
			    $scope.sr1 = data;
			    $scope.previous = data.length;
			    $scope.sr = [];
			    angular.forEach($scope.sr1, function(value, key){
				var promise1 = getProfilePicture(value);
				    $q.all([promise1]).then(function(data){
				    console.log(value.MemberID);
				    $scope.sr.push({FirstName: value.FirstName,
						    LastName: value.LastName,
						    MemberID: parseFloat(value.MemberID),
						    Profile: data[0].data,
						    Gender: value.Gender}); 
				});	
	        	    });
	        	    function getProfilePicture(value){
	    			var defer2 = $q.defer();
	    			var p= $http.post("getProfilePicture2.php",{'id' : value.MemberID});
	    			defer2.resolve(p);
	    			return defer2.promise;
	    		    }
            		}
        	    });
        	}
        		
        	getMembers();
        	updateScroll();
        	$scope.myOrderByF = "-MemberID";
    	    });
    	</script>
    	
    </body>
</html>