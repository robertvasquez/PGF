<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include 'connection.php';
    session_start();

    $data = json_decode(file_get_contents("php://input"));
    $about = $data->info;
    $memberID = $_SESSION["id"];
	
    try{
	$stmt = $conn->prepare("UPDATE memberdata SET About = '$about' WHERE MemberID LIKE '$memberID'");
	$stmt->execute();
    } catch(PDOException $e){
	echo 'ERROR: ' . $e->getMessage();
	exit;
    }
	
    $arr = array('response' => 'true');
    echo json_encode($arr);
?>