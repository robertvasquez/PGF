<?php	
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include 'connection.php';
	
    $data = json_decode(file_get_contents("php://input"));
    $memberID = $data->id;
	
	try{
	    $stmt = $conn->prepare("SELECT FriendOne, FriendTwo, FriendID FROM friendlist 
				    WHERE FriendTwo LIKE '$memberID' OR FriendOne LIKE '$memberID'
				    ORDER BY FriendID DESC LIMIT 6");
	    $stmt->execute();
	    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	} catch(PDOException $e){
	    echo 'ERROR: ' . $e->getMessage();
	    exit;
	}
		
    echo json_encode($result);
?>