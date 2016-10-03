<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include 'connection.php';
	
    session_start();
    $memberID = $_SESSION["id"];
	
    $data = json_decode(file_get_contents("php://input"));
    $fID = $data->friendID;
	
	try{
	    $stmt = $conn->prepare("INSERT INTO friendlist(FriendOne, FriendTwo) VALUES(:FO, :FT)");
	    $stmt->execute(array(':FO' => $memberID, ':FT' => $fID));
	    $arr = array('response' => 'true');
	} catch(PDOException $e){
	    $arr = array('response' => 'false');
	    echo json_encode($arr);
	    exit;
	}
	
	try{
	    $stmt = $conn->prepare("DELETE FROM friendrequests WHERE FriendTo LIKE '$memberID' AND FriendFrom LIKE '$fID'");
	    $stmt->execute();
	} catch(PDOException $e){
	    $arr = array('response' => 'false');
	    echo json_encode($arr);
	    exit;
	}
	
    echo json_encode($arr);
?>