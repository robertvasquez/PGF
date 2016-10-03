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
	
        <body class="siteFontColor" ng-cloak>
            
	    <div class="container-fluid">
                
                <div ng-controller="User">
                </div>
			
		<div class="row bannerFontColor pokemon3D c">
		    <div class="col-xs-6 col-sm-offset-1 c" style="font-size: 35px; min-width: 289px; padding-top: 15px">
			Upload/Change Your Profile Picture Below!
		    </div>
                    
		    <div class="col-xs-1 c" style="min-width: 140px; padding-top: 20px" ng-controller="profileLink">
			<form ng-submit="profile()">
    			    <input type="submit" id = "profile" value="Back to Profile" style="color: black">
			</form>
		    </div>
                    
		    <div class="col-xs-1 c" style="min-width: 140px; padding-top: 20px">
			<form action="logout.php">
			    <input type="submit" value="Log Out" style="color: black">
			</form>
		    </div>
		</div>			
			
		<div ng-controller="profilePicture">
                    
		    <div class="row" style="padding-top: 30px">
			<div class="col-xs-3 col-sm-offset-4 c">
			    <div ng-if="imgShow != 'True'">
				<div class="profilePictureZone c">
       				    Picture Preview
                                </div>
       			    </div>
       			</div>
       			<div ng-if="imgShow == 'True'">
                            <div class="col-xs-3 col-sm-offset-4 c">
			    <img ng-src="{{imageSrc}}"  id="imageSrc" ng-model="imageSrc" height="300" width="300" >
			    <form ng-submit="sp()" name="upload" id="upload" enctype="multipart/form-data" method="POST" style="padding-top: 20px">
				<input type="submit" value="Save/Upload Picture">
			    </form>
                            </div>
			</div>
		    </div>
		    <div class="row" style="padding-top: 30px">
			<div class="col-xs-3 col-sm-offset-4 c">
			    <form name="myform" id="myform" action="uploadTmpPicture.php" enctype="multipart/form-data" method="POST'">
				<input type="file" name="userFile" ng-model="imageInput" 
				    onchange="angular.element(this).scope().readURL(this)" accept=".jpg,.jpeg"
				    style="font-family: 'Kaushan Script', cursive"> 
			    </form>
			</div>
		    </div>
                    
		</div>
			
	    </div>
        </body>
    	
    	<script>
    	    $(document).ready(function(){
    		document.forms["myform"].reset();
    	    });
            
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
            
            app.controller('profileLink', function($scope,$http){
                var url = window.location.search;
                var temp = url.split('=');
                var id = temp[temp.length-1];
                
                $scope.profile = function(){
                    window.location.replace("profile.php?id="+id);	
                }
            });

	    app.controller('profilePicture', function($scope,$http){
                var url = window.location.search;
                var temp = url.split('=');
                var id = temp[temp.length-1];
                
		$scope.imageSrc = "";
		$scope.imgShow = "False";
				
		$scope.readURL = function(event) {		
		    $scope.$apply(function(){
			var formData = new FormData($("form#myform")[0]);
			$.ajax({
			    url : "uploadTmpPicture.php",
			    type: 'POST',
			    datatype : "JSON",
			    data: formData,
			    cache: false,
			    contentType: false,
			    processData: false,
			    success: function (returndata) {
				if(returndata.response != "false"){
				    $scope.imgShow = "True";
				    $scope.imageSrc = returndata;
				    $scope.$apply(function() {
					var d = new Date();
					var image = returndata+'?'+d.getMilliseconds(); 
					$scope.imageSrc = image;
				    });
				}
				if(returndata.response == "false"){
				    $scope.$apply(function() {
					$scope.imgShow = "False";
					$scope.imageSrc = "";
				    });
				}	
			    }
			});
		    });	
		    return false;
		};
		$scope.sp = function(){
		    $http.post("savePicture.php").success(function(data){
	    		if( data.response == 'true' ){
	    		    window.location.replace("profile.php?id="+id);
	    		}
	    		if( data.response == 'false' ){
	    		    swal("Picture Not Saved.", "Error, please try again.", "error")
	    		}
		    });
		}
	    });
	</script>
</html>