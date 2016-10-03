<!DOCTYPE html>
<html lang= "en" ng-app="myApp">
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
		
	    <div class="row bannerFontColor c">
		<div class="col-xs-6 pokemonFill pokemon3D c" style="font-size: 50px; padding: 2px; min-width: 275px">
		    Pokemon Go Fellowship
		</div>
                
		<div class="col-xs-6">
		    <div class="row rMargin">
			<form name="LoginForm" ng-controller="Login" ng-submit="myLogin()" autocomplete="off" novalidate>
			    <div class="col-xs-3" style="padding: 2px; min-width: 164px">
				Email
				<input type="email" class="form-control" ng-model="liemail" required>
			    </div>
			    <div class="col-xs-3 col-sm-offset-1" style="padding: 2px; min-width: 164px">
				Password
				<input type="password" class="form-control" ng-model="lipassword" ng-minlength="6" 
				    ng-maxlength="35" ng-pattern="/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{2,}$/" required>
			    </div>
			    <div class="col-xs-4" style="height: 54px; min-width: 100px; color: black">
				<input type="submit" value="Log In" style="position: absolute; left: 2; bottom: 0" ng-disabled="LoginForm.$invalid">
			    </div>
			</form>
		    </div>
		    <div class="row" style="padding: 2px">
			<div class="col-xs-3">
			    Forgot Password?
			</div>
		    </div>
		</div>
	    </div>
					
	    <div class="row" style="padding-top: 40px">
		
		<div class="col-xs-6 c signupMinWidth" style="font-size: 25px"> 
		    <div class="row rMargin pokemonFill pokemon3D siteAboutPadding">
			 Welcome to Pokemon Go Fellowship!
		    </div>
			
		    <div class="row rMargin pokemonFill pokemon3D siteAboutPadding">
		        Sign up to start interacting with other Pokemon Go Trainers!
		    </div>
			
		    <div class="row rMargin threeDText siteAboutPadding">
			<div class="col-xs-11 col-sm-offset-1" style="font-size: 25px; text-align: left">
			    <span class="glyphicon glyphiconHome glyphicon-user"></span>
				Make Friends with other Pokemon Go Players!
			</div>
		    </div>
			
		    <div class="row rMargin threeDText siteAboutPadding">
			<div class="col-xs-11 col-sm-offset-1" style="font-size: 25px; text-align: left">
			    <span class="glyphicon glyphiconHome glyphicon-pencil"></span>
				Show which Pokemon you have!
			</div>
		    </div>
			
		    <div class="row rMargin threeDText siteAboutPadding">
			<div class="col-xs-11 col-sm-offset-1" style="font-size: 25px; text-align: left">
			    <span class="glyphicon glyphiconHome glyphicon-search"></span>
				View other Players Pokemon collection!
			</div>
		    </div>
			
		    <div class="row rMargin threeDText siteAboutPadding">
			<div class="col-xs-11 col-sm-offset-1" style="font-size: 25px; text-align: left">
			    <span class="glyphicon glyphiconHome glyphicon-road hover"></span>
				Join groups to meet and search for Pokemon!
			</div>
		    </div>
			
		    <div class="row rMargin threeDText siteAboutPadding">
			<div class="col-xs-11 col-sm-offset-1" style="font-size: 25px; text-align: left">
			    <span class="glyphicon glyphiconHome glyphicon-map-marker"></span>
				Share Pokemon, PokeStop, and Gym Information!
			</div>
		    </div>
			
		    <div class="row rMargin threeDText siteAboutPadding">
			<div class="col-xs-11 col-sm-offset-1" style="font-size: 25px; text-align: left">
			    <span class="glyphicon glyphiconHome glyphicon-pushpin"></span>
				Post Tips for other Pokemon Go Players!
			</div>
		    </div>
			
		    <div class="row rMargin pokemonFill pokemon3D siteAboutPadding">
			Have not played Pokemon Go yet?
		    </div>
			
		    <div class="row rMargin pokemonFill pokemon3D siteAboutPadding">
			Go ahead and sign up!
		    </div>
			
		    <div class="row rMargin pokemonFill pokemon3D siteAboutPadding">
			Learn about Pokemon Go and make new friends!
		    </div>
		    
		</div>
				
		<div class="col-xs-6 c signupMinWidth" style="font-size: 25px">
		    <div class="row rMargin signupMinWidth">
			<div class="col-xs-12" style="font-size: 25px">
			    Sign up!
			</div>
		    </div>
		    
		    <form name="SignupForm" ng-controller="Signup" ng-submit="mySignup()" autocomplete="off" novalidate>		
			<div class="row rMargin siteAboutPadding signupMinWidth">
			    <div class="col-xs-6 col-sm-offset-3 c">
				<input type="text" class="form-control signupMinWidth" 
				    placeholder="First Name" ng-model="suFirstNameInput" 
				    ng-minlength="2" ng-maxlength="20" ng-pattern="/^[A-Za-z]+$/"
				    required name="suFirst">
			    </div>
			</div>
			    
			<div class="row c" ng-show="SignupForm.suFirst.$dirty && SignupForm.suFirst.$invalid">
			    <p ng-show="SignupForm.suFirst.$error.minlength">Requires at least 2 characters.</p>
			    <p ng-show="SignupForm.suFirst.$error.maxlength">Name can not exceed 20 characters.</p>
			    <p ng-show="SignupForm.suFirst.$error.pattern">Name can not contain any special characters.</p>
			    <p ng-show="SignupForm.suFirst.$error.required">Must fill out First Name field.</p>
			</div>
						
			<div class="row rMargin siteAboutPadding signupMinWidth">
			    <div class="col-xs-6 col-sm-offset-3 c">
				<input type="text" class="form-control signupMinWidth" 
				    placeholder="Last Name" ng-model="suLastNameInput"
				    ng-minlength="2" ng-maxlength="20" ng-pattern="/^[A-Za-z-]+$/"
				    required name="suLast">
			    </div>
			</div>
			    
			<div class="row c" ng-show="SignupForm.suLast.$dirty && SignupForm.suLast.$invalid">
			    <p ng-show="SignupForm.suLast.$error.minlength">Requires at least 2 characters.</p>
			    <p ng-show="SignupForm.suLast.$error.maxlength">Name can not exceed 20 characters.</p>
			    <p ng-show="SignupForm.suLast.$error.pattern">Name can not contain any special characters.</p>
			    <p ng-show="SignupForm.suLast.$error.required">Must fill out Last Name field.</p>
			</div>
						
			<div class="row rMargin siteAboutPadding signupMinWidth">
			    <div class="col-xs-6 col-sm-offset-3 c">
				<input type="email" class="form-control signupMinWidth" 
				    placeholder="Email" ng-model="suEmailInput"
				    ng-minlength="8" ng-maxlength="35" 
				    ng-pattern="/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/"
				    required name="suEmail">
			    </div>
			</div>
			    
			<div class="row c" ng-show="SignupForm.suEmail.$dirty && SignupForm.suEmail.$invalid">
			    <p ng-show="SignupForm.suEmail.$error.minlength">Requires at least 8 characters.</p>
			    <p ng-show="SignupFormsuEmail.$error.maxlength">Email can not exceed 35 characters.</p>
			    <p ng-show="SignupForm.suEmail.$error.pattern">Must be full email address.</p>
			    <p ng-show="SignupForm.suEmail.$error.required">Must fill out Email field.</p>
			</div>
						
			<div class="row rMargin siteAboutPadding signupMinWidth">
			    <div class="col-xs-6 col-sm-offset-3 c">
				<input type="email" class="form-control signupMinWidth" 
				    placeholder="Confirm Email" ng-model="suReEmailInput"
				    ng-minlength="8" ng-maxlength="35"
				    ng-pattern="/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/"
				    email-matches="suEmailInput" required name="suReEmail">
			    </div>
			</div>
			    
			<div class="row c" ng-show="SignupForm.suReEmail.$dirty && SignupForm.suReEmail.$invalid">
			    <p ng-show="SignupForm.suReEmail.$error.minlength">Requires at least 8 characters.</p>
			    <p ng-show="SignupForm.suReEmail.$error.maxlength">Email can not exceed 35 characters.</p>
			    <p ng-show="SignupForm.suReEmail.$error.pattern">Must be full email address.</p>
			    <p ng-show="SignupForm.suReEmail.$error.required">Must fill out Confirm Email field.</p>
			    <p ng-show="SignupForm.suReEmail.$error">Emails do not match</p>
			</div>
						
			<div class="row rMargin siteAboutPadding signupMinWidth">
			    <div class="col-xs-6 col-sm-offset-3 c">
				<input type="password" class="form-control signupMinWidth" 
				    placeholder="Password" ng-model="suPasswordInput"
				    ng-minlength="6" ng-maxlength="35" 
				    ng-pattern="/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{2,}$/"
				    required name="suPassword">
			    </div>
			</div>
			    
			<div class="row c" ng-show="SignupForm.suPassword.$dirty && SignupForm.suPassword.$invalid">
			    <p ng-show="SignupForm.suPassword.$error.minlength">Requires at least 6 characters.</p>
			    <p ng-show="SignupForm.suPassword.$error.maxlength">Password can not exceed 35 characters.</p>
			    <p ng-show="SignupForm.suPassword.$error.pattern">Must contain at least 1 special character and digit.</p>
			    <p ng-show="SignupForm.suPassword.$error.required">Must fill out Password field.</p>
			</div>
						
			<div class="row rMargin siteAboutPadding signupMinWidth">
			    <div class="col-xs-6 col-sm-offset-3 c">
				<input type="password" class="form-control signupMinWidth" 
				    placeholder="Confirm Password" ng-model="suRePasswordInput"
				    ng-minlength="6" ng-maxlength="35"
				    ng-pattern="/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{2,}$/"
				    password-matches="suPasswordInput" required name="suRePassword">
			    </div>
			</div>
			    
			<div class="row c" ng-show="SignupForm.suRePassword.$dirty && SignupForm.suRePassword.$invalid">
			    <p ng-show="SignupForm.suRePassword.$error.minlength">Requires at least 6 characters.</p>
			    <p ng-show="SignupForm.suRePassword.$error.maxlength">Password can not exceed 35 characters.</p>
			    <p ng-show="SignupForm.suPassword.$error.pattern">Must contain at least 1 special character and digit.</p>
			    <p ng-show="SignupForm.suPassword.$error.required">Must fill out Confirm Password field.</p>
			    <p ng-show="SignupForm.suRePassword.$error">Passwords do not match.</p>
			</div>
						
			<div class="row rMargin signupMinWidth">
			    Birthday
			</div>
						
			<div class="row rMargin siteAboutPadding signupMinWidth">
			    <div class="col-xs-6 col-sm-offset-3">
				<input type="date" class="form-control signupMinWidth"
				    ng-model="suBirthdayInput" max="2000-01-01" 
				    min="1920-01-01" required name="suBirthday">
			    </div>
			</div>
			    
			<div class="row c" ng-show="SignupForm.suBirthday.$dirty && SignupForm.suBirthday.$invalid">
			    <p ng-show="SignupForm.suBirthday.$error.min">Age over accepted limit.</p>
			    <p ng-show="SignupForm.suBirthday.$error.max">Age under accepted limit.</p>
			    <p ng-show="SignupForm.suBirthday.$error.required">Must fill out Birthday field.</p>
			</div>
						
			<div class="row rMargin siteAboutPadding signupMinWidth" style="font-size: 14px" ng-init="suGender=Male">
			    <div class="col-xs-4 col-sm-offset-2">
				<input type="radio" ng-model="suGender" value="Male" ng-checked="true"> Male<br>
			    </div>
			    <div class="col-xs-4">
				<input type="radio" ng-model="suGender" value="Female"> Female<br>
			    </div>
			</div>
			
			<div class="row rMargin siteAboutPadding signupMinWidth" style="font-size: 14px">
			    <div class="col-xs-6 col-sm-offset-3">
				<input type="text" class="form-control signupMinWidth" placeholder="Site Password"
				    ng-model="suSitePasswordInput" required name="suSitePassword">
			    </div>
			</div>
						
			<div class="row rMargin siteAboutPadding signupMinWidth">
			    <div class="col-xs-6 col-sm-offset-3 c" style="font-size: 15px">
				<input type="submit" value="Create Profile" ng-disabled="SignupForm.$invalid">
			    </div>
			</div>
		    </form>
		</div>
		
	    </div>
		
	    <div class="row c">
		Note Pok&#233mon Go Fellowship is currently in BETA and not accessable at this time.
	    </div>
	    <div class="row c">
		Pok&#233mon Copyright &#169 1995 - 2016 Nintendo/Creatures Inc./GAME FREAK Inc.
	    </div>
	    <div class="row c">
		Pok&#233mon Go FellowShip is a fan website that is not affiliated with &#169 1995-2016 Nintendo, Creatures Inc. and GAME FREAK Inc.
	    </div>
	    <div class="row c">
		Pok&#233mon Go FellowShip is not a official website endorsed or sponsored by &#169 1995-2016 Nintendo, Creatures Inc. and GAME FREAK Inc.
	    </div>
	    <div class="row c">
		Pok&#233mon and all respective names, images, are trademarks of &#169 1995-2016 Nintendo, Creatures Inc. and GAME FREAK Inc.
	    </div>
			
	</div>
    </body>
    
    <script>
	var app = angular.module('myApp', []);
		
	    app.controller('Login', function($scope, $http, $window) {
		$scope.myLogin = function(){
		    $http.post('login.php', {'email' : $scope.liemail, 'password' : $scope.lipassword}).success(function(data){
			if(data.response == 'false'){
			    swal("Not Logged In!", "Email/Password not Matched!", "error")
			}
			if(data.response != 'false'){
			    window.location.replace("profile.php?id="+data.response);
			}
		    });
		}	
	    });

	    app.controller('Signup', function($scope, $http, $window){ 
		$scope.mySignup = function(){
		    if(!$scope.suGender){
			$scope.suGender = "Male";
		    }
		    $http.post('createProfile.php', {'firstName' : $scope.suFirstNameInput,
				'lastName' : $scope.suLastNameInput,
				'email' : $scope.suEmailInput,
				'password' : $scope.suRePasswordInput,
				'birthday' : $scope.suBirthdayInput,
				'sitepassword' : $scope.suSitePasswordInput,
				'gender' : $scope.suGender}).success(function(data){
			if(data.response == 'true'){
			    swal("Profile Created!", "Sign in to view your Profile!", "success")
			}
			if(data.response == 'false'){
			    swal("Profile not created.", "Email is already being used.", "error")
			}
			if(data.response == 'wrongSitePass'){
			    swal("Profile not created.", "Incorrect Site Password.", "error")
			}
			if(data.response != 'false' && data.response != 'true' && data.response != 'wrongSitePass'){
			    swal("Profile not created.", "Database Error, plese try again later.", "error")
			}
		    });
		}
	    });

	    (function () {
		"use strict";
		app.directive('emailMatches', ['$parse', function ($parse) {
		    return {
		    	require: 'ngModel',
		    	link: function (scope, elm, attrs, ngModel) {
		    	    var originalModel = $parse(attrs.emailMatches),
		   		secondModel = $parse(attrs.ngModel);
		   				
		    		scope.$watch(attrs.ngModel, function (newValue) {
		    		    ngModel.$setValidity(attrs.name, newValue === originalModel(scope));
		    		});
		    			
		    		scope.$watch(attrs.emailMatches, function (newValue) {
		    		    ngModel.$setValidity(attrs.name, newValue === secondModel(scope));
				});
			}
		    };
		}]);   
	    }());

	    (function () {
		"use strict";
		app.directive('passwordMatches', ['$parse', function ($parse) {
		    return {
		    	require: 'ngModel',
		        link: function (scope, elm, attrs, ngModel) {
		            var originalModel = $parse(attrs.passwordMatches),
		           	 secondModel = $parse(attrs.ngModel);
		            
		           	scope.$watch(attrs.ngModel, function (newValue) {
		            	    ngModel.$setValidity(attrs.name, newValue === originalModel(scope));
		          	});
		          	
		          	scope.$watch(attrs.passwordMatches, function (newValue) {
		            	    ngModel.$setValidity(attrs.name, newValue === secondModel(scope));
		          	});
		    	}
		    };
		}]);   
	    }());
    
    </script>
</html>