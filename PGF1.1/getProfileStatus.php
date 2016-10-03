<?php	
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	include 'connection.php';
	
	session_start();
	$memberID = $_SESSION["id"];
	
	$data = json_decode(file_get_contents("php://input"));
	$urlID = $data->u;
	
	
	if($memberID == $urlID){
	    if( $memberID == $urlID ){
		$arr = array('response' => 'true');
	    }
	    echo json_encode($arr);
	}
	
	if($memberID != $urlID){
		
	    try{
		$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$conn->query('SET NAMES gbk');
			
		    $stmt = $conn->prepare("SELECT FriendOne, FriendTwo FROM friendlist WHERE FriendTwo LIKE '$memberID' AND FriendOne LIKE '$urlID'");
		    $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	    } catch(PDOException $e){
		echo 'ERROR: ' . $e->getMessage();
		exit;
	    }
		
	    try{
		$stmt = $conn->prepare("SELECT FriendOne, FriendTwo FROM friendlist WHERE FriendTwo LIKE '$urlID' AND FriendOne LIKE '$memberID'");
		$stmt->execute();
		$result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
	    } catch(PDOException $e){
		echo 'ERROR: ' . $e->getMessage();
		exit;
	    }
		
	    if(!$result && !$result2){
		$arr = array('response' => 'notFriend');
		echo json_encode($arr);
	    }

	    if($result || $result2){
		$arr = array('response' => 'false');
		echo json_encode($arr);
	    }
		
	}
?>