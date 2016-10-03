<?php	
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	include 'connection.php';
	
	$data = json_decode(file_get_contents("php://input"));
	$memberID = $data->id;
	
	try{
		$stmt = $conn->prepare("SELECT * FROM friendlist WHERE FriendTwo LIKE '$memberID' OR FriendOne LIKE '$memberID'");
		$stmt->execute();
		$result = $stmt->rowCount();
	} catch(PDOException $e){
		echo 'ERROR: ' . $e->getMessage();
		exit;
	}
		
	echo json_encode($result);
?>