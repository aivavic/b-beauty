<?php

error_reporting (E_ERROR);

include('kcaptcha.php');
if(isset($_REQUEST[session_name()])){
	session_start();
}

$id = (int)$_REQUEST['id'];

$captcha = new KCAPTCHA();

if($_REQUEST[session_name()]){
	$_SESSION['captcha_keystring'.$id] = $captcha->getKeyString();
}

?>