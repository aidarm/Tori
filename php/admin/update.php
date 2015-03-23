<?php

require_once ('../db.php');
require_once "../_WindowsAzure/WindowsAzure.php";

use WindowsAzure\Common\ServicesBuilder;
use WindowsAzure\Common\ServiceException;

if(!empty($_FILES['file'])){
    $extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    
    $connectionString = "DefaultEndpointsProtocol=https;AccountName=tori;AccountKey=u8xcPrU0fGIivBKM+LDEb75fKGaZVDuxXbL3lHnLQk4jayFY93rqyKQS8fcM2gFSPLZocvjTVOhYMQg9G11KSg==";
    $blobRestProxy = ServicesBuilder::getInstance()->createBlobService($connectionString);
    $content_image = file_get_contents($_FILES['file']['tmp_name']);
    $blob = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 50) . $extension;

    try {
        $blobRestProxy->createBlockBlob("images", $blob, $content_image);
    }
    catch(ServiceException $e){
        $code = $e->getCode();
        $error_message = $e->getMessage();
        echo $code.": ".$error_message."<br />";
    }
    
    $image = "https://tori.blob.core.windows.net/images/" . $blob;
    
    echo $image;
    
    $STH = $DBH->prepare("UPDATE items SET image = '" . $image . "' WHERE ID = '" . $_POST['id'] . "' AND category='" . $_POST['category_p'] . "';");
    $STH->execute();
}

$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);

$sql = "UPDATE items SET title = '" . $request['title'] . "',
    category = '" . $request['category'] . "',
    description = '" . $request['description'] . "',
    city = '" . $request['city'] . "',
    price = '" . $request['price'] . "',
    name = '" . $request['name'] . "',
    email = '" . $request['email'] . "',
    phone = '" . $request['phone'] . "' WHERE ID = '" . $request['id'] . "' AND category='" . $request['category_p'] . "';";
    
$STH = $DBH->prepare($sql);
$STH->execute();

        
?>