<?php

//error_reporting (E_ALL);
error_reporting (E_ERROR);

include('kcaptcha.php');

if(isset($_REQUEST[session_name()])){
	session_start();
}

$id = (int)$_REQUEST['id'];
$id2 = (int)$_REQUEST['id2'];

$captcha = new KCAPTCHA();

if($_REQUEST[session_name()]){
	$_SESSION['captcha_keystring'.$id.'_'.$id2] = $captcha->getKeyString();
}

?>