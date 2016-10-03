<?php
    $db_user = 'robertv';
    $db_pass = 'EDITPASSWORDHERE';
    $db_name = 'pokemongo';
    $db_host = 'localhost';
    
    try{
        $conn = new PDO("mysql:host={$db_host}; dbname={$db_name}", $db_user, $db_pass);
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
        echo 'ERROR: ' . $e->getMessage();
    }
?>