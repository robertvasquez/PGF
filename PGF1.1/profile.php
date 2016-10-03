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
	<div class="container-fluid">
			
	    <div ng-controller="User">
	    </div>
			
	    <div class="row bannerFontColor pokemon3D">
			
		<div ng-controller="BannerName">
		    <div ng-if="p == '1'">
			<div class="col-xs-4 c" style="font-size: 40px; padding: 15px">
			    {{ fName }}  {{ lName }}
			</div>
		    </div>
		</div>
				
		<div ng-controller="VisitorHeader">
		    <div ng-if="p == '2' || p == '3'">
			<div class="col-xs-12 c b" style="font-size: 40px; padding: 15px">
			    {{ fName }}  {{ lName }}
			</div>
		    </div>
		</div>
				
		<div ng-controller="FriendButton">
		    <div ng-if="p == '1'">
			<div class="col-xs-1 col-sm-offset-3 c" style="padding-top: 25px; min-height: 76px; min-width: 125px; max-width: 125px" style="position:relative">
                            
			    <div ng-if="friendNotificationNumber == '0'" title="Friend Requests">
				<a href="#" ng-click='iconClick()'>
    				    <span class="glyphicon glyphiconProfile glyphicon-user"></span>
    				</a>
                            </div>
                            
			    <div ng-if="friendNotificationNumber != '0'" title="Friend Requests">
				<a href="#" ng-click='iconClick()' action="resetFriendNotification.php">
    				    <span class="glyphicon glyphiconProfile glyphicon-user" style="color:#FF8F45"></span>
    				    <span class="n">{{ friendNotificationNumber }}</span>
    				</a>
    			    </div>
                            
    			</div>
		    </div>
		</div>
                
                <div ng-controller="MessageButton">
		    <div ng-if="p == '1'">
			<div class="col-xs-1 c" style="padding-top: 25px; min-height: 76px; min-width: 125px; max-width: 125px" style="position:relative">
                            
			    <div ng-if="messageNotificationNumber == '0'" title="Messages">
				<a href="#" ng-click='iconClick()'>
    				    <span class="glyphicon glyphiconProfile glyphicon-comment"></span>
    				</a>
                            </div>
                            
			    <div ng-if="messageNotificationNumber != '0'" title="Messages">
				<a href="#" ng-click='iconClick()' action="resetMessageNotification.php">
    				    <span class="glyphicon glyphicon-comment" style="color:#FF8F45"></span>
    				    <span class="n">{{ MessageNotificationNumber }}</span>
    				</a>
    			    </div>
                            
    			</div>
		    </div>
		</div>
                
                <div ng-controller="SettingButton">
		    <div ng-if="p == '1'">
			<div class="col-xs-1 c" style="padding-top: 25px; min-height: 76px; min-width: 125px; max-width: 125px" title="Settings">  
			    <span class="glyphicon glyphiconProfile glyphicon-wrench"></span>
    			</div>
		    </div>
		</div>
                
                <div ng-controller="Logout">
		    <div ng-if="p == '1'">
			<div class="col-xs-1 c" style="padding-top: 25px; min-height: 76px; min-width: 125px; max-width: 125px">
			    <form action="logout.php" style="min-width: 74px">
				<input type="submit" value="Log Out" style="color: black">
			    </form>
			</div>
		    </div>
		</div>
                
            </div>
				
	    <div class="row rMargin">
		 <div class="col-xs-4 col-sm-offset-7 displayParent" style="min-width: 460px">
                    
		    <div ng-controller="FriendDisplay">
                        <div class="col-xs-12 friendContainer" id="friendRequestsReceivedContainer" style="z-index: 1100">
                            <div class="row rMargin" style="padding: 5px">
                                <div class="col-xs-6 col-sm-offset-3 roundEdge c">
       				    Friend Requests
       				</div>
                            </div>
                            <div class="row rMargin" style="padding: 5px">
                                <div class="col-xs-6 col-sm-offset-3 c">
                                    <div ng-if="myOrderByFR == '-FriendIDR'">
       					Currently Sorted by: Newest
       				    </div>
       				    <div ng-if="myOrderByFR == 'FriendIDR'">
       					Currently Sorted by: Oldest
       				    </div>
       				    <div ng-if="myOrderByFR == 'FirstNameR'">
       					Currently Sorted by: First Name
       				    </div>
       				    <div ng-if="myOrderByFR == 'LastNameR'">
       					Currently Sorted by: Last Name
       				    </div>
                                </div>
                            </div>
                            <div class="row rMargin" style="padding: 5px">
                                <div class="col-xs-6 c" style="min-width: 187px">
       				    <div class="dropdown">
       					<button onclick="showReceivedFriendDropdown()" class="dropbtn" style="width: 160px">
       					    Sort Friend Requests
       					</button>
  					<div id="receivedFriendDropdown" class="dropdown-content" style="z-index: 1100">
    					    <a href="" ng-click="orderByMeFR('-FriendIDR')">Sort by Newest</a>
    					    <a href="" ng-click="orderByMeFR('FriendIDR')">Sort by Oldest</a>
    					    <a href="" ng-click="orderByMeFR('FirstNameR')">First Name</a>
    					    <a href="" ng-click="orderByMeFR('LastNameR')">Last Name</a>
  					</div>
       				    </div>
       				</div>
       				<div class="col-xs-6 c" style="min-width: 187px">
       				    <div class="dropdown">
       					<button ng-click="showSentFriend()" class="dropbtn" >
       					    View Sent Friend Requests
       					</button>
       				    </div>
       				</div>
                            </div>
                            <div ng-if="dispalyNoFriendReceived == 'True'">
       				<div class="row" style="padding-top: 15px"></div>
       				<div class="row rMargin displayEdge displayColor c">
				    No Friend Requests Avaliable
				</div>
       			    </div>
                            <div class="row rMargin rFriendContainer" style="padding-top: 15px">
       				<div class="col-xs-12" style="max-height: 400px; overflow-y: scroll">
       				    <div ng-repeat="friendR in fr | orderBy:myOrderByFR">
       					<div class="row rMargin displayEdge displayColor">
       					    <div class="col-xs-2 c" style="max-width: 140px; min-width: 140px">
       						<div ng-if="friendR.ImagePathR != 'false'">		
    						    <img ng-src="{{friendR.ImagePathR}}" class="profilePictureDisplay">				
    						</div>
    						<div ng-if="friendR.ImagePathR == 'false'">		
    						    <div class="blankProfilePictureDisplay">
       							No Profile<br>Picture
       						    </div>		
    						</div>
       					    </div>
       					    <div class="col-xs-7 col-sm-offset-1 c" style="max-width: 220px; min-width: 220px">
                                                <div class="row rMargin roundEdge c">
						    {{friendR.FirstNameR + " " + friendR.LastNameR}}
						</div>
						<div class="row" style="padding-top: 5px"></div>
						<div class="row rMargin roundEdge c">
						    Gender: {{friendR.GenderR}}
						</div>
						<div class="row" style="padding-top: 5px"></div>
						<div class="row rMargin roundEdge c">
						    Birthday: {{friendR.BirthdayR}}
						</div>
					    </div>
       					</div>
       					<div class="row rMargin">
       					    <div class="col-xs-4">
						<button type="button" ng-click="acceptFriend(friendR.FriendFromR)">
                                                    Accept Request
						</button>
					    </div>
					    <div class="col-xs-4">
						<button type="button" ng-click="ignoreFriend(friendR.FriendFromR)">
						    Ignore Request
						</button>
					    </div>
					    <div class="col-xs-4">
						<button type="button">View Profile</button>
					    </div>
       					</div>
       					<div class="row" style="padding-top: 15px"></div>
       				    </div>
                                    <div class="row" style="padding-top: 5px"></div>
                                    <div class="row" style="margin-right: 0px; margin-left:0px">
       					<div class="col-sm-5 col-sm-offset-4">
					    <button type="button" ng-click = "closeReceivedFriend()">Close Friend Requests</button>
					</div>
                                    </div>
       				</div>
       			    </div>
                        </div>
                        
                        <div class="col-xs-12 friendContainer" id="friendRequestsSentContainer" style="z-index: 1100">
                            <div class="row rMargin" style="padding: 5px">
                                <div class="col-xs-6 col-sm-offset-3 roundEdge c">
       				    Sent Friend Requests
       				</div>
                            </div>
                            <div class="row rMargin" style="padding: 5px">
                                <div class="col-xs-6 col-sm-offset-3 c">
                                    <div ng-if="myOrderByFS == '-FriendIDS'">
       					Currently Sorted by: Newest
       				    </div>
       				    <div ng-if="myOrderByFS == 'FriendIDS'">
       					Currently Sorted by: Oldest
       				    </div>
       				    <div ng-if="myOrderByFS == 'FirstNameS'">
       					Currently Sorted by: First Name
       				    </div>
       				    <div ng-if="myOrderByFS == 'LastNameS'">
       					Currently Sorted by: Last Name
       				    </div>
                                </div>
                            </div>
                            <div class="row rMargin" style="padding: 5px">
                                <div class="col-xs-6 c" style="min-width: 187px">
       				    <div class="dropdown">
       					<button onclick="showSentFriendDropdown()" class="dropbtn" style="width: 160px">
       					    Sort Friend Requests
       					</button>
  					<div id="sentFriendDropdown" class="dropdown-content" style="z-index: 1100">
    					    <a href="" ng-click="orderByMeFS('-FriendIDS')">Sort by Newest</a>
    					    <a href="" ng-click="orderByMeFS('FriendIDS')">Sort by Oldest</a>
    					    <a href="" ng-click="orderByMeFS('FirstNameS')">First Name</a>
    					    <a href="" ng-click="orderByMeFS('LastNameS')">Last Name</a>
  					</div>
       				    </div>
       				</div>
       				<div class="col-xs-6 c" style="min-width: 187px">
       				    <div class="dropdown">
       					<button ng-click="showReceivedFriend()" class="dropbtn" >
       					    View Received Friend Requests
       					</button>
       				    </div>
       				</div>
                            </div>
                            <div ng-if="dispalyNoFriendSent == 'True'">
       				<div class="row" style="padding-top: 15px"></div>
       				<div class="row rMargin displayEdge displayColor c">
				    No Sent Friend Requests Avaliable
				</div>
       			    </div>
                            <div class="row rMargin rFriendContainer" style="padding-top: 15px">
       				<div class="col-xs-12" style="max-height: 400px; overflow-y: scroll">
       				    <div ng-repeat="friendS in fs | orderBy:myOrderByFS">
       					<div class="row rMargin displayEdge displayColor">
       					    <div class="col-xs-2 c" style="max-width: 140px; min-width: 140px">
       						<div ng-if="friendS.ImagePathS != 'false'">		
    						    <img ng-src="{{friendS.ImagePathS}}" class="profilePictureDisplay">				
    						</div>
    						<div ng-if="friendS.ImagePathS == 'false'">		
    						    <div class="blankProfilePictureDisplay">
       							No Profile<br>Picture
       						    </div>		
    						</div>
       					    </div>
       					    <div class="col-xs-7 col-sm-offset-1 c" style="max-width: 220px; min-width: 220px">
                                                <div class="row rMargin roundEdge c">
						    {{friendS.FirstNameS + " " + friendS.LastNameS}}
						</div>
						<div class="row" style="padding-top: 5px"></div>
						<div class="row rMargin roundEdge c">
						    Gender: {{friendS.GenderS}}
						</div>
						<div class="row" style="padding-top: 5px"></div>
						<div class="row rMargin roundEdge c">
						    Birthday: {{friendS.BirthdayS}}
						</div>
					    </div>
       					</div>
                                        
       					<div class="row rMargin">
       					    <div class="col-xs-4">
						<button type="button" ng-click="removeFriend(friendS.FriendToS)">
						    Remove Request
						</button>
                                            </div>
       					</div>
       					<div class="row" style="padding-top: 15px"></div>
       				    </div>
                                    <div class="row" style="padding-top: 5px"></div>
                                    <div class="row" style="margin-right: 0px; margin-left:0px">
       					<div class="col-sm-5 col-sm-offset-4">
					    <button type="button" ng-click = "closeSentFriend()">Close Friend Requests</button>
					</div>
                                    </div>
       				</div>
       			    </div>
                        </div>
                        
		    </div>
                    
		</div>
            </div>
            
            <div class="row rMargin" style="padding-top: 20px; z-index: 300" ng-init="p={}">
                <div ng-controller="ProfilePicture">
                    
                    <div ng-if="p =='1'">
                        <div class="col-xs-3 col-sm-offset-1" style="min-width: 340px">
                            <div ng-if="imagesrc == 'Default'">
                                <div class="profilePictureZone">
                                 No Picture Choosen
                             </div>	
                            </div>
                            <div ng-if="imagesrc != 'Default'">
                                <img ng-src="{{imageSrc}}?" + new Date.now(); id="imageSrc" ng-model="imageSrc" class="rcorners">
                            </div>
                            <div class="row c">
                                <form ng-submit="pp()" style="padding-top: 5px">
                                    <input type="submit" id = "pp" value="Upload/Change Picture">
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div ng-if="p == '2' || p == '3'">
                        <div class="col-xs-6 col-sm-offset-3 c" style="min-width: 340px">
                            <div ng-if="imagesrc == 'Default'">
                                <div class="profilePictureZone">
                                 No Picture Choosen
                             </div>	
                            </div>
                            <div ng-if="imagesrc != 'Default'">
                                <img ng-src="{{imageSrc}}?" + new Date.now(); id="imageSrc" ng-model="imageSrc" class="rcorners">
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-xs-3 col-sm-offset-1 threeDText c" ng-controller="PokemonGoInfo" style="min-width: 340px; font-size: 20px">
                    <div ng-if="p =='1'">
                        <div class="row rMargin">
                            Pok&#233monGo Username: {{ username }}
                        </div>
                         <div class="row rMargin">
                            Pok&#233monGo Team: {{ team }}
                        </div>
                         <div class="row rMargin">
                            Pok&#233monGo Level: {{ level }}
                        </div>
                         <div class="row rMargin">
                            Pok&#233monGo Pok&#233mon Caught: {{ pokemon }}
                        </div>
                        <div class="row rMargin c" style="min-width: 340px; font-size: 15px" >
                            <form ng-submit="submit()">
                                <input type="submit" id = "submit" value="Edit PokemonGo Information">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                      
            <div class="row" style="padding-top: 5px">
		<div class="col-xs-12 c">
		    <div ng-controller = "AboutStatement">
			<div ng-if="ap != ''">
			    <div class="row rMargin">
				<div class="col-xs-6 col-sm-offset-3 roundEdge c">
				    Introduction
				</div>
			    </div>
			    <div class="row" style="padding-top: 5px"></div>
			    <div class="row rMargin">
				<div class="col-xs-6 col-sm-offset-3 intro c">
				    {{ ap }}
				</div>
			    </div>
			</div>
						
			<div ng-if="ap == '' && p == 1">
			    <div class="row" style="padding-top: 5px"></div>
			    <div class="row rMargin">
				<div class="col-xs-6 col-sm-offset-3 c">
				    Want to say a little bit about yourself for a brief introduction to the PokemonGoFellowShip
				    community? Just click the Edit Introduction button below! What you write will
				    appear right here so others can read about you when they visit your profile!
				</div>
			    </div>
			</div>
						
			<div ng-if = "p == 1 && te == 0">
			    <div class="row" style="padding-top: 5px"></div>
			    <div class="row rMargin">
				<div class="col-xs-6 col-sm-offset-3 c">
				    <button type="button" ng-click="editIntro()">Edit Introduction</button>
				</div>
                            </div>
                            <div class="row" style="padding-top: 5px"></div>
			</div>
			<div ng-if = "p == 1 && te == 1">
			    <div class="row" style="padding-top: 5px"></div>
			    <div class="row rMargin">
				<div class="col-xs-6 col-sm-offset-3">
				    <form name="UpdateIntro" ng-controller="AboutStatement" ng-submit="myIntro()" autocomplete="off" novalidate>
					<textarea class="form-control" ng-model="introInput"
					    rows="6" maxlength="1500" required>
					</textarea>
					<div class="row" style="padding-top: 5px"></div>
					<div class="row rMargin">
					    <div class="col-xs-6 col-sm-offset-3 c">
						<input type="submit" value="Save Introduction" ng-disabled="UpdateIntro.$invalid">
					    </div>
					</div>
				    </form>
				</div>
			    </div>
							
			    <div class="row" style="padding-top: 5px"></div>
			    <div class="row rMargin">
				<div class="col-xs-6 col-sm-offset-3 c">
				    <button type="button" ng-click="deleteIntro()">Delete Introduction</button>
				</div>
			    </div>
							
			    <div class="row" style="padding-top: 5px"></div>
			    <div class="row rMargin">
				<div class="col-xs-6 col-sm-offset-3 c">
				    <button type="button" ng-click="cancelIntro()">Cancel Edit</button>
				</div>
			    </div>
			</div>
		    </div>
		</div>
	    </div>
            
            <div class="col-xs-12" ng-controller="FriendList">
                <div ng-if="p == 1 || p ==2">
                    <div class="row rMargin c">
                        <div class="col-xs-4 col-sm-offset-4 roundEdge">
                            Number of Friends: {{ friendNumber }}
                        </div>
		    </div>
                    <div class="row rMargin c">
			<div ng-repeat="friendList in fl | orderBy:myOrderByMS">
			    <div class="col-xs-4" style="padding: 5px">
				<div class="row" style="margin-right: 0px; margin-left:0px">
				    <div ng-if="friendList.ImagePath != 'false'">
					<a ng-href="profile.php?id={{friendList.FriendID}}">		
    					    <img ng-src="{{friendList.ImagePath}}" class="flPicture">
    					</a>				
    				    </div>
    				    <div ng-if="friendList.ImagePath == 'false'">
    					<a ng-href="profile.php?id={{friendList.FriendID}}">		
    					    <div class="blankProfilePictureFL">
       						No Profile<br>Picture
       					    </div>
       					</a>
       				    </div>			
                                </div>
    				<div class="row" style="margin-right: 0px; margin-left:0px; padding: 5px">
    				    <div class="col-xs-4 col-sm-offset-4 roundEdge" ng-controller="FriendList" style="min-width: 142px">
    					{{friendList.FirstName + " " + friendList.LastName}}
    				    </div>
    				</div>
			    </div>
			</div>
		    </div>
                    <div ng-if="friendNumber != '0' && p == 1">
			<div class="row c">
			    <div class="col-xs-6" style="min-width:170px">
				<button type="button">View/Edit Friend List</button>
			    </div>
			    <div class="col-xs-6" style="min-width:170px">
				<button type="button" ng-click="findFriend()">Find Friends</button>
			    </div>
			</div>
		    </div>
                    <div ng-if="friendNumber == '0' && p == 1">
			<div class="row" style="padding-top: 5px"></div>
			    <div class="row rMargin c">
				<div class="col-xs-12" style="min-width:170px">
				    No Friends Available.
				</div>
			    </div>
			    <div class="row" style="padding-top: 5px"></div>
			    <div class="row rMargin c">
				<div class="col-xs-12" style="min-width:170px">
				    Click the Find Friends Button Below to Start Making Frinds!
				</div>
			    </div>
			    <div class="row" style="padding-top: 5px"></div>
			    <div class="row rMargin c">
				<div class="col-xs-12" style="min-width:170px">
				    <button type="button" ng-click="findFriend()">Find Friends</button>
				</div>
			    </div>
		    </div>
                    <div ng-if="p == 3">
			<div class="row rMargin c" style="font-size: 20px">
			    Must be friends to view friend list!
                        </div>
		    </div>
                </div>
            </div>

	</div>
    </body>
	
    <script>
	
	var app = angular.module('myApp', []);
		
	//PROFILE USER OBJECT
	app.factory('User', function(){
	    return {
		data: {
		    profileStatus: 0,
		    memberID: 0,
		    firstName: 0,
		    lastName: 0,
		    email: 0,
		    gender: 0,
		    birthday: 0,
                    about: 0,
                    userName: 0,
                    team: 0,
                    level: 0,
                    caught: 0
		},
		updateStatus: function(status){
		    this.data.profileStatus = status;
		},
		updateID: function(id){
		    this.data.memberID = id;
		},
		updateFirst: function(first){
		    this.data.firstName = first;
		},
		updateLast: function(last){
		    this.data.lastName = last;
		},
		updateEmail: function(e){
		    this.data.email = e;
		},
		updateGender: function(g){
		    this.data.gender = g;
		},
		updateBirthday: function(b){
		    this.data.birthday = b;
		},
                updateAbout: function(a){
                    this.data.about = a;
                },
                updateUser: function(u){
                    this.data.username = u;
                },
                updateTeam: function(t){
                    this.data.team = t;
                },
                updateLevel: function(l){
                    this.data.level = l;
                },
                updateCaught: function(c){
                    this.data.caught = c;
                }
	    }
	});
		
	//CONTROLLER TO GET USER INFO
	app.controller('User', function($scope, $http, $rootScope, User){
					
            var url = window.location.search;
            var temp = url.split('=');
            var id = temp[temp.length-1];
			
            $http.post("getProfileStatus.php",{'u' : id}).success(function(data){
		if(data.response=='true'){
		    User.updateStatus(1);
		    $rootScope.$emit("RefreshProfileStatus", {});
		}
		if(data.response=='false'){
		    User.updateStatus(2);
		    $rootScope.$emit("RefreshProfileStatus", {});
		}
		if(data.response=='notFriend'){
		    User.updateStatus(3);
		    $rootScope.$emit("RefreshProfileStatus", {});
		}
            });

	    User.updateID(id);

	    $http.post("getMemberInfo.php",{'id' : id}).success(function(data){
		var birthday = data[0].Birthday;
		var d = birthday.split('-'), format = ['year', 'month', 'day'];
		var date = d[1] + "-" + d[2] + "-" + d[0];
				
		User.updateBirthday(date);
		User.updateFirst(data[0].FirstName);
                User.updateLast(data[0].LastName);
		User.updateEmail(data[0].Email);
		User.updateGender(data[0].Gender);
                User.updateAbout(data[0].About);
                User.updateUser(data[0].username);
                User.updateTeam(data[0].team);
                User.updateLevel(data[0].level);
                User.updateCaught(data[0].caught);
				
		$rootScope.$emit("RefreshInfo", {});
	    });		
	});

	app.controller('BannerName', function($scope, $http, $rootScope, User){
			
	    $scope.p = User.data.profileStatus;
			
	    $rootScope.$on("RefreshProfileStatus", function(){
		$scope.p = User.data.profileStatus;
    	    });
    		
	    $rootScope.$on("RefreshInfo", function(){
		$scope.fName = User.data.firstName;
		$scope.lName = User.data.lastName;
    	    });
    		
	});

	app.controller('VisitorHeader', function($scope, $http, $rootScope, User) {
			
	    $scope.p = User.data.profileStatus;
			
	    $rootScope.$on("RefreshProfileStatus", function(){
		$scope.p = User.data.profileStatus;
    	    });
			
	    $rootScope.$on("RefreshInfo", function(){
		$scope.fName = User.data.firstName;
		$scope.lName = User.data.lastName;
    	    });
			
	});

	app.controller('FriendButton', function($scope, $http, $interval, $rootScope, User) {
			
	    $scope.p = User.data.profileStatus;
			
	    $rootScope.$on("RefreshProfileStatus", function(){
                $scope.p = User.data.profileStatus;
            });
    		
	    $http.post("getFriendNotification.php").success(function(data){
    		$scope.friendNotificationNumber=data;
    		if( 0 != $scope.friendNotificationNumber ){
    		}
	    });
						
	    $scope.iconClick = function() {
		$http.post("resetFriendNotification.php").success(function(data){
        	    if(data.response == 'true'){
        		$scope.friendNotificationNumber="0";
        	    } 
                });
                
                if(  $("#messageReceivedContainer").is(":visible") == true ){  
                    $('#messageReceivedContainer').toggle();        
                }
            
                if(  $("#messageSentContainer").is(":visible") == true ){  
                    $('#messageSentContainer').toggle();        
                }
                if( $("#friendRequestsReceivedContainer").is(":visible") == true && $("#friendRequestsSentContainer").is(":visible") == false ){
                    $('#friendRequestsReceivedContainer').toggle();
                } else
                if( $("#friendRequestsSentContainer").is(":visible") == true && $("#friendRequestsReceivedContainer").is(":visible") == false){
                    $('#friendRequestsSentContainer').toggle();
                } else
                if( $("#friendRequestsSentContainer").is(":visible") == false && $("#friendRequestsReceivedContainer").is(":visible") == false){
                    $('#friendRequestsReceivedContainer').toggle();
                }
	    }
			
	    $interval(checkFriendNotificationNumber, 1000 * 60);
			
	    function checkFriendNotificationNumber(){
		$scope.previousNotification = $scope.friendNotificationNumber;
		$http.post("getFriendNotification.php").success(function(data){
        	    $scope.friendNotificationNumber=data;
        	    if( $scope.friendNotificationNumber != "0" && $scope.friendNotificationNumber != $scope.previousNotification){
			$rootScope.$emit("RefreshReceivedFriend", {});
        	    }
    		});
	    }
			
    	});
        
        app.controller('MessageButton', function($scope, $http, $interval, $rootScope, User) {
			
	    $scope.p = User.data.profileStatus;
			
	    $rootScope.$on("RefreshProfileStatus", function(){
                $scope.p = User.data.profileStatus;
            });
            
            $http.post("getMessageNotification.php").success(function(data){
        	$scope.messageNotificationNumber=data;
    	    });
			
    	});
        
        app.controller('SettingButton', function($scope, $http, $interval, $rootScope, User) {
			
	    $scope.p = User.data.profileStatus;
			
	    $rootScope.$on("RefreshProfileStatus", function(){
                $scope.p = User.data.profileStatus;
            });
			
    	});
        
        app.controller('Logout', function($scope, $http, $interval, $rootScope, User) {
            
    	    $scope.p = User.data.profileStatus;
			
	    $rootScope.$on("RefreshProfileStatus", function(){
                $scope.p = User.data.profileStatus;
            });
    	});

        app.controller('FriendDisplay', function($scope, $http, $q, $interval, $rootScope, User) {
			
	    $scope.p = User.data.profileStatus;
			
	    $rootScope.$on("RefreshProfileStatus", function(){
                $scope.p = User.data.profileStatus;
            });
			
	    $rootScope.$on("RefreshInfo", function(){
		$scope.fName = User.data.firstName;
		$scope.lName = User.data.lastName;
    	    });
            
            $scope.showSentFriend = function(){
        	$('#friendRequestsReceivedContainer').toggle();
        	$('#friendRequestsSentContainer').toggle();
            }
            $scope.showReceivedFriend = function(){
        	$('#friendRequestsSentContainer').toggle();
        	$('#friendRequestsReceivedContainer').toggle();
            }
            $scope.closeSentFriend = function(){
        	$('#friendRequestsSentContainer').toggle();
            }
            $scope.closeReceivedFriend = function(){
        	$('#friendRequestsReceivedContainer').toggle();
            }
            
            function fillFriendReceived(){
                $scope.fr = [];
                $http.post("getReceivedFriendRequests.php").then(function(data){
                    $scope.friendInfo = data;
    		    if(!data.data[0]){
    			$scope.dispalyNoFriendReceived = "True";
    		    }
    		    if(data.data[0]){
    			$scope.dispalyNoFriendReceived = "False";
    		    }
                    angular.forEach($scope.friendInfo.data, function(value, key){
    			var promise1 = getMemberData(value);
    			var promise2 = getProfilePicture(value);
    			$q.all([promise1, promise2]).then(function(data){
    			    var birthday = data[0].data[0].Birthday;
    			    var d = birthday.split('-'), format = ['year', 'month', 'day'];
    			    var date = d[1] + "-" + d[2] + "-" + d[0];
    			    $scope.fr.push({FirstNameR: data[0].data[0].FirstName,
    					    LastNameR: data[0].data[0].LastName,
    					    GenderR: data[0].data[0].Gender,
    					    BirthdayR: date,
    					    ImagePathR: data[1].data,
    					    FriendIDR: value.FriendID,
    					    FriendFromR: value.FriendFrom});
    			});
                        function getMemberData(value){
    			    var defer1 = $q.defer();
    			    var n= $http.post("getMemberInfo.php",{'id' : value.FriendFrom});
    			    defer1.resolve(n);
    			    return defer1.promise;
    			}
    			function getProfilePicture(value){
    			    var defer2 = $q.defer();
    			    var p= $http.post("getProfilePicture2.php",{'id' : value.FriendFrom});
    			    defer2.resolve(p);
    			    return defer2.promise;
    			}
    		    });
                });
            }
            
            
            function fillFriendSent(){
        	$scope.fs = [];
        	    $http.post("getSentFriendRequests.php").then(function(data){
    			$scope.friendInfo = data;
    			if(!data.data[0]){
    			    $scope.dispalyNoFriendSent = "True";
    			}
    			if(data.data[0]){
    			    $scope.dispalyNoFriendSent = "False";
    			}
    			angular.forEach($scope.friendInfo.data, function(value, key){
    			    var promise1 = getMemberData(value);
    			    var promise2 = getProfilePicture(value);
    			    $q.all([promise1, promise2]).then(function(data){
    				var birthday = data[0].data[0].Birthday;
    				var d = birthday.split('-'), format = ['year', 'month', 'day'];
    				var date = d[1] + "-" + d[2] + "-" + d[0];
    				$scope.fs.push({FirstNameS: data[0].data[0].FirstName,
    								   	    LastNameS: data[0].data[0].LastName,
                                                                            GenderS: data[0].data[0].Gender,
    								   	    BirthdayS: date,
    								   	    ImagePathS: data[1].data,
    								   	    FriendIDS: value.FriendID,
    								   	    FriendToS: value.FriendTo});
    			    });	
    			});
    			function getMemberData(value){
    			    var defer1 = $q.defer();
    			    var n= $http.post("getMemberInfo.php",{'id' : value.FriendTo});
    			    defer1.resolve(n);
    			    return defer1.promise;
    			}
    			function getProfilePicture(value){
    			    var defer2 = $q.defer();
    			    var p= $http.post("getProfilePicture2.php",{'id' : value.FriendTo});
    			    defer2.resolve(p);
                            return defer2.promise;
    			}	
    		    });
            }
        		
	    $scope.acceptFriend = function(data){
		$http.post("acceptFriendRequest.php", {'friendID' : data}).success(function(data){
		    if(data.response != 'false'){
                        fillFriendReceived();
			$rootScope.$emit("RefreshFriendList", {});
			swal("Accepted!", "Friend Request Accepted!", "success")
		    }
		    if(data.response == 'false'){
			swal("Friend Request Error!", "Sorry unable to Accept Request.", "error")
		    }
		});
	    }
				
	    $scope.ignoreFriend = function(data){
		$http.post("ignoreFriendRequest.php", {'friendID' : data}).success(function(data){
		    if(data.response != 'false'){
			fillFriendReceived();
			swal("Ignored!", "Friend Request Ignored!", "success")
		    }
		    if(data.response == 'false'){
			swal("Friend Request Error!", "Sorry unable to Ignore Request.", "error")
		    }
		});
	    }
				
	    $scope.removeFriend = function(data){
		$http.post("removeFriendRequest.php", {'friendID' : data}).success(function(data){
		    if(data.response != 'false'){
			fillFriendSent();
			swal("Removed!", "Friend Request Taken Back!", "success")
		    }
		    if(data.response == 'false'){
			swal("Friend Request Error!", "Sorry unable to Ignore Remove Request.", "error")
		    }
		});
	    }
              
            $scope.acceptFriend = function(data){
		$http.post("acceptFriendRequest.php", {'friendID' : data}).success(function(data){
		    if(data.response != 'false'){
			fillFriendReceived();
			$rootScope.$emit("RefreshFriendList", {});
			swal("Accepted!", "Friend Request Accepted!", "success")
		    }
		    if(data.response == 'false'){
			swal("Friend Request Error!", "Sorry unable to Accept Request.", "error")
		    }
		});
	    }
				
	    $scope.ignoreFriend = function(data){
		$http.post("ignoreFriendRequest.php", {'friendID' : data}).success(function(data){
		    if(data.response != 'false'){
			fillFriendReceived();
			swal("Ignored!", "Friend Request Ignored!", "success")
		    }
		    if(data.response == 'false'){
			swal("Friend Request Error!", "Sorry unable to Ignore Request.", "error")
		    }
		});
	    }
				
	    $scope.removeFriend = function(data){
		$http.post("removeFriendRequest.php", {'friendID' : data}).success(function(data){
		    if(data.response != 'false'){
			fillFriendSent();
			swal("Removed!", "Friend Request Taken Back!", "success")
		    }
		    if(data.response == 'false'){
			swal("Friend Request Error!", "Sorry unable to Ignore Remove Request.", "error")
		    }
		});
	    }
				
	    $rootScope.$on("RefreshReceivedFriend", function(){
        	fillFriendReceived();
            });
        		
            $scope.orderByMeFR = function(x){
		$scope.myOrderByFR = x;
	    }
	            
            $scope.orderByMeFS = function(x){
		$scope.myOrderByFS = x;
	    }
	            
            fillFriendReceived();
            fillFriendSent();
        		
            $scope.myOrderByFR = "-FriendIDR";
            $scope.myOrderByFS = "-FriendIDS";
            
	});
        
        app.controller('ProfilePicture', function($scope, $http, $rootScope, User){
            
            $scope.p = User.data.profileStatus;
            $rootScope.$on("RefreshProfileStatus", function(){
                $scope.p = User.data.profileStatus;
            });
            
            var url = window.location.search;
            var temp = url.split('=');
            var id = temp[temp.length-1];
            
            $http.post("getProfilePicture2.php", {'id': id}).success(function(data){
		if(data != 'false'){
		    $scope.imageSrc = data;
		    $scope.imagesrc="True";
		}
		if(data == 'false'){
		    $scope.imageSrc = "";
		    $scope.imagesrc="Default";
		}
    	    });

    	    $scope.pp = function(){
    		var url = window.location.search;
    		var temp = url.split('=');
    		var id = temp[temp.length-1];
    		window.location.replace("profilePicture.php?id="+id);
    	    }    
	});
        
        app.controller('PokemonGoInfo', function($scope, $http, $rootScope, User) {
			
	    $scope.p = User.data.profileStatus;
            
            var url = window.location.search;
            var temp = url.split('=');
            var id = temp[temp.length-1];
            
            $scope.uid = id;
            
            $scope.submit = function(){
		window.location.replace("editPokemonGoInfo.php?id="+$scope.uid);	
            }
	    $rootScope.$on("RefreshProfileStatus", function(){
		$scope.p = User.data.profileStatus;
    	    });
			
	    $rootScope.$on("RefreshInfo", function(){
		$scope.username = User.data.username;
                $scope.level = User.data.level;
                $scope.team = User.data.team;
                $scope.pokemon = User.data.caught;
                if ($scope.username == "") {
                    $scope.username = "Unavailable";
                }
                if ($scope.level == "") {
                    $scope.level = "0";
                }
                if ($scope.team == "") {
                    $scope.team = "Unavailable";
                }
                if ($scope.pokemon == "") {
                    $scope.pokemon = "0";
                }
    	    });
			
	});
        
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
  		var dropdowns = document.getElementsByClassName("dropdown-content");
  		var i;
  		for (i = 0; i < dropdowns.length; i++) {
  		    var openDropdown = dropdowns[i];
  		    if (openDropdown.classList.contains('show')) {
  			openDropdown.classList.remove('show');
  		    }
  		}
  	    }
  	}
        
        app.controller('FriendList', function($scope, $http, $q, $rootScope, User){

	    $scope.p = User.data.profileStatus;
    			
    	    $rootScope.$on("RefreshProfileStatus", function(){
    		$scope.p = User.data.profileStatus;
                $scope.mi = User.data.memberID;
            });

    	    var url = window.location.search;
	    var temp = url.split('=');
	    var idid = temp[temp.length-1];
	    $scope.id3 = idid;
				
            function friendNumber(){	
		$http.post("getNumberOfFriends.php", {'id': idid}).success(function(data){
		    $scope.friendNumber = data;
		});
            }
        		
	    function fillFriendList(){
		$scope.fl = [];
		    $http.post("getFriendList.php", {'id': idid}).success(function(data){
			angular.forEach(data, function(value, key){
			    var id;
			    if(value.FriendOne == $scope.id3){
				$scope.fid = value.FriendTwo;
				id=value.FriendTwo;
			    }
			    if(value.FriendTwo == $scope.id3){
				$scope.fid = value.FriendOne;
				id=value.FriendOne;
			    }
			    var promise1 = getMemberData($scope.fid);
    			    var promise2 = getProfilePicture($scope.fid);
    			    $q.all([promise1, promise2]).then(function(data){
    				$scope.fl.push({FirstName: data[0].data[0].FirstName,
    						LastName: data[0].data[0].LastName,
    						ImagePath: data[1].data,
    						FriendID: id});
    			    });	
			});
			function getMemberData(value){
	    		    var defer1 = $q.defer();
	    		    var n= $http.post("getMessageFullName.php",{'id' : value});
	    		    defer1.resolve(n);
	    		    return defer1.promise;
	    		}
	    		function getProfilePicture(value){
	    		    var defer2 = $q.defer();
	    		    var p= $http.post("getProfilePicture2.php",{'id' : value});
	    		    defer2.resolve(p);
	    		    return defer2.promise;
	    		}
		    });
	    }
				
	    $rootScope.$on("RefreshFriendList", function(){
		friendNumber();
		fillFriendList();
            });
            
            $scope.findFriend = function(){
        	var url = window.location.search;
    		var temp = url.split('=');
    		var id = temp[temp.length-1];
        	window.location.replace("findFriend.php?id="+id);
            }
        		
	    friendNumber();
	    fillFriendList();			
	});
        
        
        
        app.controller('AboutStatement', function($scope, $http, $q, $rootScope, User){

	    $scope.p = User.data.profileStatus;
    			
    	    $rootScope.$on("RefreshProfileStatus", function(){
    		$scope.p = User.data.profileStatus;
            });

            var url = window.location.search;
	    var temp = url.split('=');
	    var id = temp[temp.length-1];

	    $scope.te = "0";
				
	    $http.post('getAbout.php', {'id': id}).success(function(data){
		$scope.ap = data[0].About;
	    });

	    $scope.deleteIntro = function(){
		$http.post('saveAbout.php', {'info': ""}).success(function(data){
		    window.location.replace("profile.php?id="+id);
		});
	    }

	    $scope.editIntro = function(){
		$scope.te = "1";
	    }

	    $scope.cancelIntro = function(){
		$scope.te = "0";
	    }

	    $scope.myIntro = function(){
		$http.post('saveAbout.php', {'info': $scope.introInput}).success(function(data){
		    window.location.replace("profile.php?id="+id);
		});	
	    }
				
	});
        
  	function showReceivedFriendDropdown() {
	    document.getElementById("receivedFriendDropdown").classList.toggle("show");
	}
  	function showSentFriendDropdown() {
	    document.getElementById("sentFriendDropdown").classList.toggle("show");
	}
  	function showReceivedMessageDropdown() {
	    document.getElementById("receivedMessageDropdown").classList.toggle("show");
	}
  	function showSentMessageDropdown() {
	    document.getElementById("sentMessageDropdown").classList.toggle("show");
	}
		

    </script>
	
</html>