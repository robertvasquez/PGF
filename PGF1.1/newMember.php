<?php	
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include 'connection.php';
	
    session_start();
    $memberID = $_SESSION["id"];
	
    $data = json_decode(file_get_contents("php://input"));
    $startRow = $data->startFrom;
	
	try{
	    $stmt = $conn->prepare("SELECT MemberID, FirstName, LastName, Gender FROM memberdata WHERE MemberID  NOT LIKE '$memberID' AND MemberID NOT IN
				    (SELECT FriendTwo FROM friendlist WHERE FriendOne LIKE '$memberID') AND MemberID NOT IN
				    (SELECT FriendOne FROM friendlist WHERE FriendTwo LIKE '$memberID') AND MemberID NOT IN
				    (SELECT FriendFrom FROM friendrequests WHERE FriendTo LIKE '$memberID') AND MemberID NOT IN
				    (SELECT FriendTo FROM friendrequests WHERE FriendFrom LIKE '$memberID')
				    ORDER BY MemberID DESC LIMIT $startRow");
	    $stmt->execute();
	} catch(PDOException $e){
	    echo 'ERROR: ' . $e->getMessage();
	    exit;
	}
	
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
?>