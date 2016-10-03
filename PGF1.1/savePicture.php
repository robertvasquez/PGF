<?php
	session_start();
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	include 'connection.php';
	
	$memberID = $_SESSION["id"];
	$targetpath = "profile/";
	$newPath = $targetpath.$memberID.'.jpg';
	$cap = "Profile Image";
	
	try{
		$stmt = $conn->prepare("SELECT ImagePath FROM profileimage WHERE MemberID LIKE '$memberID' AND Saved LIKE '0'"); 
		$stmt->execute();
		$pathFrom = $stmt->fetchColumn();
	} catch(PDOException $e){
		$arr = array('response' => 'false');
		echo json_encode($arr);
		exit;
	}
	
	if (!copy($pathFrom, $newPath)) {
		$arr = array('response' => 'false');
		echo json_encode($arr);
		exit;
	}
	unlink($pathFrom);
	
	try{
		$stmt = $conn->prepare("SELECT MemberID FROM profileimage WHERE MemberID LIKE '$memberID' AND Saved LIKE '1'");
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	} catch(PDOException $e){
		$arr = array('response' => 'false');
		echo json_encode($arr);
		exit;
	}
	
	if(!$result){
		try{
			$stmt = $conn->prepare("INSERT INTO profileimage(ImagePath, MemberID, Caption, Saved)
									VALUES(:IP, :MID, :C, :S)");
			$stmt->execute(array(':IP' => $newPath, ':MID' => $memberID, ':C' => $cap, ':S' => "1"));
		} catch(PDOException $e){
			$arr = array('response' => 'false');
			echo json_encode($arr);
			exit;
		}
	}
	
	try{
		$stmt = $conn->prepare("DELETE FROM profileimage WHERE MemberID LIKE '$memberID' AND Saved LIKE '0'");
		$stmt->execute();
	} catch(PDOException $e){
		$arr = array('response' => 'false');
		echo json_encode($arr);
		exit;
	}
	
	$arr = array('response' => 'true');
	echo json_encode($arr);
?>