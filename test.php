<?php
echo 'test';
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('app/Mage.php'); //Path to Magento
umask(0);
Mage::app();
/*
$_token = 'avtgf3qt4oojBeUcDshKbcv4QppxGh';
$_userkey = 'uFA7URo9ZZnj8s2ojvFFwU3XFAswVU';

try {
$push = new Pushover_Api(); 
$push->setToken($_token); 
$push->setUser($_userkey);   
$push->setMessage('test'); 
$push->setDebug(true);   
$go = $push->send();
var_dump($push->validateUser());

Mage::log('Token :'.$_token, null, 'a.log');
Mage::log('User Key '.$_userkey, null, 'a.log');
var_dump($go);
echo 'done';
} catch(Exception $e) {
	var_dump($e->getMessage());
}*/

$defaultAmout = Mage::helper('oye_pushover')->getOrderAmount();
echo $defaultAmout;

