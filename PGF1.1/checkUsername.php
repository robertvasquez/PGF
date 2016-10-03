<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include 'connection.php';
    
    $data = json_decode(file_get_contents("php://input"));
    $memberID = $data->id;
    $username = $data->username;
    
    if($username == ""){
        $arr = array('response' => 'false');
        echo json_encode($arr);
        exit;
    }
    
    try{
        $stmt = $conn->prepare("SELECT * FROM memberdata WHERE username LIKE '$username' AND MemberID NOT LIKE '$memberID'");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        $arr = array('response' => 'false');
        echo json_encode($arr);
        exit;
    }
    
    if($result){
        $arr = array('response' => 'false');
        echo json_encode($arr);
        exit;
    } else {
        $arr = array('response' => 'true');
        echo json_encode($arr);
        exit;
    }

?>