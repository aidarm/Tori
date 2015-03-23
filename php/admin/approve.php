<?php

require_once ('../db.php');

$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);
   
$sql = "UPDATE items SET approved = 1 WHERE ID = '" . $request['id'] . "' AND category='" . $request['category'] . "';";
    
$STH = $DBH->prepare($sql);
$STH->execute();

        
?>