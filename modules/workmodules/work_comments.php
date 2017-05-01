<?
if($act=="comment")
{
	
	if(isset($_SESSION['captcha_keystring0']) && $_SESSION['captcha_keystring0'] == $_REQUEST['keystring'])
	{
		$name		 = myaddslashes($_REQUEST['name']);
		$email		 = myaddslashes($_REQUEST['email']);
		$message	 = myaddslashes($_REQUEST['message']);
		$categid	 = myaddslashes($_REQUEST['categid']);
		$currtime 	 = time();
		
		$_SESSION['sent'] = 1;		
			
		$sql = "INSERT INTO $par->commentstable SET 	`date`=$currtime,
								`modifydate`=$currtime,
								`text`='$message',
								`categid`='$categid',
								`name`='$name',
								`email`='$email',
								`hide`=0";
		mysql_query($sql);
		
		$lastid = mysql_insert_id();
		$sql = "UPDATE $par->commentstable SET `prior`=$lastid WHERE id=$lastid";
		mysql_query($sql);
	}
	else $_SESSION['sent'] = 2;
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit();
}

?>
