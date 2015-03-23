<?php

require_once('../db.php');

$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);

$STH = $DBH->prepare("DELETE FROM items WHERE id='" . $request['id'] . "' AND category='" . $request['category'] . "';");
$STH->execute($data);   

?>