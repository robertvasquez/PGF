<?php
	session_start();
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	include 'connection.php';
	
	$file = $_FILES['userFile'];
	$target_Path = "tmpProfile/";
	$info = pathinfo($_FILES['userFile']['name']);

	$ext = "";
	if(isset($info['extension'])){
		$ext = $info['extension'];
	}
	
	$newFileName = $_SESSION["id"].'.'.$ext;
	
	if(move_uploaded_file( $_FILES['userFile']['tmp_name'], $target_Path.$newFileName )){
		$name = $target_Path.$newFileName;
		$memberID = $_SESSION["id"];
		$cap = "Profile Image";
		
		try{
			$stmt = $conn->prepare("SELECT MemberID FROM profileimage WHERE MemberID LIKE '$memberID' AND Saved LIKE '0'");
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch(PDOException $e){
			$arr = array('response' => 'false');
			echo json_encode($arr);
			exit;
		}
		
		if($result){
			$arr = array('response' => 'true');
			echo json_encode($name);
			exit;
		}
		
		if(!$result){
			try{
				$stmt = $conn->prepare("INSERT INTO profileimage(ImagePath, MemberID, Caption, Saved)
								VALUES(:IP, :MID, :C, :S)");
				$stmt->execute(array(':IP' => $name, ':MID' => $memberID, ':C' => $cap, ':S' => "0"));
				echo json_encode($name);
			} catch(PDOException $e){
				$arr = array('response' => 'false');
				echo json_encode($arr);
				exit;
			}
		}
		
	} else {
		$arr = array('response' => 'false');
		echo json_encode($arr);
	}
?>