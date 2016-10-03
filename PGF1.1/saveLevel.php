<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	include 'connection.php';
	
	$data = json_decode(file_get_contents("php://input"));
	$level = $data->level;
        $mID = $data->id;

	$arr = array('response' => 'true');
	
	try{
		$stmt = $conn->prepare("UPDATE memberdata SET level = '$level' WHERE MemberID LIKE '$mID'");
		$stmt->execute();
	} catch(PDOException $e){
		$arr = array('response' => 'false');
		echo json_encode($arr);
		exit;
	}
	
	echo json_encode($arr);
?>