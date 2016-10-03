<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include 'connection.php';
	
    $data = json_decode(file_get_contents("php://input"));
    $id = $data->id;
	
    try{
	$stmt = $conn->prepare("SELECT FirstName, LastName FROM memberdata WHERE MemberID LIKE '$id'");
	$stmt->execute();
    } catch(PDOException $e){
	echo 'ERROR: ' . $e->getMessage();
	exit;
    }
		
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
?>