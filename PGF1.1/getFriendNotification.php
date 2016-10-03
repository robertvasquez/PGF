<?php	
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	include 'connection.php';
	
	session_start();
	$memberID = $_SESSION["id"];
	
	try{
	    $stmt = $conn->prepare("SELECT * FROM friendrequests WHERE Notification LIKE '0' AND FriendTo LIKE '$memberID'");
	    $stmt->execute();
	    $result = $stmt->rowCount();
	} catch(PDOException $e){
	    echo 'ERROR: ' . $e->getMessage();
	    exit;
	}
		
	echo json_encode($result);
?>