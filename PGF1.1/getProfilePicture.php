<?php
	session_start();
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	include 'connection.php';
	
	$memberID = $_SESSION["id"];
	
	try{
		$stmt = $conn->prepare("SELECT ImagePath FROM profileimage WHERE MemberID LIKE '$memberID' AND Saved LIKE '1'");
		$stmt->execute();
		$pathFrom = $stmt->fetchColumn();
	} catch(PDOException $e){
		$arr = array('response' => 'false');
		echo json_encode($arr);
		exit;
	}
	
	if($pathFrom){
		echo json_encode($pathFrom);
	}
	if(!$pathFrom){
		echo json_encode('false');
	}
?>