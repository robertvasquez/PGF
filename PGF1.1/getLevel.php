<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	include 'connection.php';
	
	$data = json_decode(file_get_contents("php://input"));
	$memberID = $data->id;
	
	try{
	    $stmt = $conn->prepare("SELECT level FROM memberdata WHERE MemberID LIKE '$memberID'");
	    $stmt->execute();
	} catch(PDOException $e){
	    echo 'ERROR: ' . $e->getMessage();
	    exit;
	}
	
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$json = json_encode($result);
	
	echo($json);
?>