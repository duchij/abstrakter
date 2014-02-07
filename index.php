<?php 
require_once('app/main.class.php');
$app = new abstracter();
$data = array();
$data = $_REQUEST;
$app->start($data);

?>