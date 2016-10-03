<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	session_start();
	
	$data = json_decode(file_get_contents("php://input"));
	$email = $data->email;
	$password = $data->password;
	
	$arr = array('response' => 'false');
	
	if(   !empty($email) && !empty($password)  ){
	    include 'connection.php';
		
	    try{
		$stmt = $conn->prepare("SELECT Password FROM memberdata WHERE Email LIKE '$email'");
		$stmt->execute();
		$pass = $stmt->fetchColumn();
	    } catch(PDOException $e){
		echo 'ERROR: ' . $e->getMessage();
		exit;
            }
		
	    try{
		$stmt = $conn->prepare("SELECT Email FROM memberdata WHERE Email LIKE '$email'");
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	    } catch(PDOException $e){
		echo 'ERROR: ' . $e->getMessage();
		exit;
	    }
		
	    if(!$result){
		$arr = array('response' => 'false');
	    }
		
	    if($result){
			
		if(password_verify($password, $pass)){
		    try{
			$stmt = $conn->prepare("SELECT MemberID FROM memberdata WHERE Email LIKE '$email' AND Password LIKE '$pass'");
			$stmt->execute();
			$id = $stmt->fetchColumn();
		    } catch(PDOException $e){
			echo 'ERROR: ' . $e->getMessage();
			exit;
		    }
					
		    $_SESSION["id"] = $id;
		    $arr = array('response' => $id);
		} else {
		    $arr = array('response' => 'false');
                    echo json_encode($arr);
		    exit;
		}
			
		try{
		    $stmt = $conn->prepare("SELECT MemberID FROM memberdata WHERE Email LIKE '$email' AND Password LIKE '$password'");
		    $stmt->execute();
		    $id = $stmt->fetchColumn();
		} catch(PDOException $e){
		    echo 'ERROR: ' . $e->getMessage();
		    exit;
		}
			
	    }	
	}
        echo json_encode($arr);
?>