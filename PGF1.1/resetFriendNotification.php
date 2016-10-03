<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	include 'connection.php';
	
	session_start();
	$memberID = $_SESSION["id"];
	
	$arr = array('response' => 'false');
	try{
	    $stmt = $conn->prepare("UPDATE friendrequests SET Notification = '1' WHERE FriendTo LIKE '$memberID' AND Notification LIKE '0'");
	    $stmt->execute();
	    $arr = array('response' => 'true');
	    echo json_encode($arr);
	    exit;
	} catch(PDOException $e){
	    $arr = array('response' => 'false');
	    echo json_encode($arr);
	    exit;
	}
	echo json_encode($arr);
?>