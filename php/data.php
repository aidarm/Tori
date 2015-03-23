<?php

require_once('db.php');

$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);

$sql = "SELECT * FROM items";

if ($_GET['appr']) {
    $sql .= " WHERE approved=0";
} else {
    $sql .= " WHERE approved=1";
}

if ($_GET['id']) {
  $sql .= " AND ID=" . $_GET['id'] . " AND category=" . "'" . $_GET['category'] . "'";
} elseif (!$_GET['id'] && $_GET['category']) {
  $sql .= " AND category=" . "'" . $_GET['category'] . "'";
}

$STH = $DBH->query($sql);	
$STH->setFetchMode(PDO::FETCH_OBJ);

$data = array();

while ($item = $STH->fetch()){
	$data[] = $item;
};

echo json_encode($data, JSON_NUMERIC_CHECK);

?>