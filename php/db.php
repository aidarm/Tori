<?php

$server = 'tcp:irzw419f86.database.windows.net,1433';
$dbname = 'tori';
$user = 'Aidar@irzw419f86';
$pass = 'ulRZ1522!';

try {
	$DBH = new PDO("sqlsrv:Server=$server;Database=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}

catch(PDOException $e) {
	echo "Could not connect to database.";
}

?>