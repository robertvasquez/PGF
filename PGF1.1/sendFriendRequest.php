<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
	
    session_start();
    $memberID = $_SESSION["id"];
	
    $data = json_decode(file_get_contents("php://input"));
    $rt = $data->requestTo;

    $arr = array('response' => 'false');
	
    if( !empty($rt) ){
	include 'connection.php';
	try{
	    $stmt = $conn->prepare("INSERT INTO friendrequests(FriendFrom, FriendTo, Notification, AcceptStatus, DeleteFrom, DeleteTo)
				    VALUES(:FF, :FT, :N, :AS, :DF, :DT)");
	    $stmt->execute(array(':FF' => $memberID, ':FT' => $rt, ':N' => "0", ':AS' => "0", ':DF' => "0", ':DT' => "0"));
	} catch(PDOException $e){
	    $arr = array('response' => 'false');
	    echo json_encode($arr);
	    exit;
	}	
	$arr = array('response' => 'true');	
    }
    echo json_encode($arr);
?>