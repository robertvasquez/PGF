<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	include 'connection.php';
	
	session_start();
	$memberID = $_SESSION["id"];
	
	try{
		$stmt = $conn->prepare("SELECT FriendTo, FriendID
								FROM friendrequests WHERE FriendFrom LIKE '$memberID' AND DeleteTo LIKE '0'");
		$stmt->execute();
	} catch(PDOException $e){
		echo 'ERROR: ' . $e->getMessage();
		exit;
	}
	
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$json = json_encode($result);
	
	echo($json);
?>