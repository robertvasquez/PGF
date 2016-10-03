<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	include 'connection.php';

	$data = json_decode(file_get_contents("php://input"));
	$fn = $data->firstName;
	$ln = $data->lastName;
	$em = $data->email;
	$pw = $data->password;
	$bd = $data->birthday;
        $sp = $data->sitepassword;
	$g =  $data->gender;

        $sitePassword = 'rjV8933Gp!16';
        
        if( strcasecmp($sp, $sitePassword) != 0 ){
            $arr = array('response' => 'wrongSitePass');
            echo json_encode($arr);
            exit;
        }
        
	try{
	    $stmt = $conn->prepare("SELECT Email FROM memberdata WHERE Email LIKE '$em'");
	    $stmt->execute();
	    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	} catch(PDOException $e){
	    echo 'ERROR: ' . $e->getMessage();
	    exit;
	}

	if( !$result ){
	    $options = [
		'cost' => 11,
		'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
	    ];
            
	    $p = password_hash($pw, PASSWORD_BCRYPT, $options);
		
	    try{
		$stmt = $conn->prepare("INSERT INTO memberdata(FirstName, LastName, Email, Password, Gender, Birthday)
					VALUES(:First, :Last, :Email, :Password, :Gender, :Birthday)");
		$stmt->execute(array(':First' => $fn, ':Last' => $ln, ':Email' => $em, ':Password' => $p,
				    ':Gender' => $g, ':Birthday' => $bd));
		$arr = array('response' => 'true');
	    } catch(PDOException $e){
		echo 'ERROR: ' . $e->getMessage();
		exit;
	    }
	}

	if( $result ){
	    $arr = array('response' => 'false');
	}

	echo json_encode($arr);
?>