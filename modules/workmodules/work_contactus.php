<?
if($act=="contactus")
{
	

		$name		 = myaddslashes($_REQUEST['name']);
		$email		 = myaddslashes($_REQUEST['email']);
		$phone		 = myaddslashes($_REQUEST['phone']);
		$message	 = myaddslashes($_REQUEST['message']);		
		$currtime 	 = time();
		
		$_SESSION['sent'] = 1;		
			
		$sql = "INSERT INTO $par->contactustable SET
                                `date`=$currtime,
								`modifydate`=$currtime,
								`text`='$message',
								`phone`='$phone',
								`name`='$name',
								`email`='$email',
								`hide`=0";
		mysql_query($sql);
		
		$lastid = mysql_insert_id();
		$sql = "UPDATE $par->contactustable SET `prior`=$lastid WHERE id=$lastid";
		mysql_query($sql);


	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit();
}

?>
