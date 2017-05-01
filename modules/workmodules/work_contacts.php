<?
	if($act=="contacts")
	{
		if(isset($_SESSION['captcha_keystring0']) && $_SESSION['captcha_keystring0'] == $_POST['keystring'])
		{
			$name = myaddslashes($_REQUEST['name']);
			$phone = myaddslashes($_REQUEST['phone']);
			$email = myaddslashes($_REQUEST['email']);
			$mess = myaddslashes($_REQUEST['mess']);

			$title = myaddslashes($_REQUEST['subj']);
			//$title = "ИМЯ: $name ТЕЛ: $phone EMAIL: $email";
			
			$currtime = time();

			$sql = "INSERT INTO $par->contactstable SET `title`='$title', `date`=$currtime, `text`='$mess', `name`='$name', `email`='$email', `phone`='$phone'";
			mysql_query($sql);
			
			$lastid = mysql_insert_id();
			$sql = "UPDATE $par->contactstable SET `prior`=$lastid WHERE id=$lastid";
			mysql_query($sql);

			$name = $_REQUEST['name'];
			$phone = $_REQUEST['phone'];
			$email = $_REQUEST['email'];
			$mess = $_REQUEST['mess'];
			
			$body = "ФИО: $name\nТелефон: $phone";
			mailer($par->adminemail,$par->adminemail,$par->server." novoe soobshenie",$body);
			
			
			$name = $_REQUEST['name'];
			$email = $_REQUEST['email'];
			$phone = $_REQUEST['phone'];
			$mess = $_REQUEST['mess'];
			
			$body = "ФИО: $name\nE-mail: $email\nТелефон: $phone\n\n$mess";
			mailer($par->adminemail,$par->adminemail,'Contacts',$body);

			$_SESSION['sent'] = 1;
			echo '<script> document.location.href = "/contacts"; </script>';
			exit();
		}
		$_SESSION['notsent'] = 1;
		echo '
		<script>
		    document.location.href = "/contacts";
		</script>
		';
	}
?>