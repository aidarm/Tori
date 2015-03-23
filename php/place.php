<?php

require_once 'db.php';
require_once "_WindowsAzure/WindowsAzure.php";
//require_once "imageResize.php";

use WindowsAzure\Common\ServicesBuilder;
use WindowsAzure\Common\ServiceException;
//use Eventviva\ImageResize;

$errors = array();

if(!empty($_FILES['file'])){
    $extension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
    
    //$thumbnail = new ImageResize();
    //$thumbnail->resizeToWidth(175);
    //$content_thumbnail = $image->output();
    
    $connectionString = "DefaultEndpointsProtocol=https;AccountName=tori;AccountKey=u8xcPrU0fGIivBKM+LDEb75fKGaZVDuxXbL3lHnLQk4jayFY93rqyKQS8fcM2gFSPLZocvjTVOhYMQg9G11KSg==";
    $blobRestProxy = ServicesBuilder::getInstance()->createBlobService($connectionString);
    $content_image = file_get_contents($_FILES['file']['tmp_name']);
    $blob = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 50) . $extension;

    try {
        $blobRestProxy->createBlockBlob("images", $blob, $content_image);
        //$blobRestProxy->createBlockBlob("thumbnails", $blob, $content_thumbnail);
    } catch(ServiceException $e){
        $code = $e->getCode();
        $error_message = $e->getMessage();
        echo $code.": ".$error_message."<br />";
    }
}

$data['category'] = $_POST['category'];
$data['title'] = $_POST['title'];
$data['description'] = $_POST['description'];
$data['city'] = $_POST['city'];
$data['date'] = date('Y-m-d');
$data['price'] = $_POST['price'];
$data['name'] = $_POST['name'];
$data['email'] = $_POST['email'];
$data['phone'] = $_POST['phone'];
$data['image'] = "https://tori.blob.core.windows.net/images/" . $blob;
$data['approved'] = 0;

$STH = $DBH->prepare("INSERT INTO items VALUES (:category, :title, :description, :image, :date, :price, :city, :name, :email, :phone, :approved);");
$STH->execute($data);
        
?>