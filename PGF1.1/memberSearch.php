<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
	
    session_start();
    $memberID = $_SESSION["id"];
	
    $data = json_decode(file_get_contents("php://input"));
    $st = $data->searchTerm;
	
    $arr = array('response' => 'false');
	
    if( !empty($st) ){
	include 'connection.php';
		
	try{
	    $stmt = $conn->prepare("SELECT FirstName, LastName, MemberID, Gender FROM memberdata WHERE
				    (MATCH(FirstName, LastName) AGAINST ('$st*' IN BOOLEAN MODE)) AND
				    MemberID NOT LIKE '$memberID' AND MemberID NOT IN
                                    (SELECT FriendTwo FROM friendlist WHERE FriendOne LIKE '$memberID') AND MemberID NOT IN
				    (SELECT FriendOne FROM friendlist WHERE FriendTwo LIKE '$memberID')");
	    $stmt->execute();
	    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	    echo json_encode($result);
	    exit;
	} catch(PDOException $e){
	    $arr = array('response' => 'false');
	    echo json_encode($arr);
	    exit;
	}	
    }
    echo json_encode($arr);
?>