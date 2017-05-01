<?
	if($act=="remind")
	{
	    $email = myaddslashes($_REQUEST['email']);
	    $sql = "SELECT * FROM $par->userstable WHERE email='$email'";
	    $res = mysql_query($sql);
	    if($line = mysql_fetch_array($res,MYSQL_ASSOC))
	    {
		$from = $par->adminemail;
		$to = $email;
		$subj = "http://".$_SERVER['SERVER_NAME']." - napominanie parolia";
		$body = "На сайте http://".$_SERVER['SERVER_NAME']." ваш пароль: ".$line['password'];
		mailer($from,$to,$subj,$body);
		echo '<script> document.location.href = \'/cabinet/subact/remind/subact2/ok\'; </script>';
		exit();
	    }
	    else
	    {
		echo '<script> document.location.href = \'/cabinet/subact/remind/subact2/badcode\'; </script>';
		exit();
	    }
	}

	if($act=="register")
	{
		$_SESSION['regform']['address'] = myaddslashes($_POST['address']);
		$_SESSION['regform']['email'] = myaddslashes($_POST['email']);
		$_SESSION['regform']['name'] = myaddslashes($_POST['firstname']);
		$_SESSION['regform']['phone'] = myaddslashes($_POST['phone']);

	    if(isset($_SESSION['captcha_keystring0']) && $_SESSION['captcha_keystring0'] == $_POST['keystring'])
	    {
			$email = myaddslashes($_POST['email']);
			$password = myaddslashes($_POST['password']);
			$repassword = myaddslashes($_POST['repassword']);
			$firstname = myaddslashes($_POST['firstname']);
			$phone = myaddslashes($_POST['phone']);
			$address= myaddslashes($_POST['address']);
		
			$currtime = time();
		
			$sql = "SELECT * FROM $par->userstable WHERE `email`='$email'";
			$res = mysql_query($sql);
			if(mysql_num_rows($res)>0)
			{
				$_SESSION['register_result'] = 'alreadyexistemail';

				echo '<script> document.location.href="/cabinet/subact/register"; </script>';
				exit();
			}
		
			$code = '';
			for($i=1;$i<=10;$i++)
			{
				$r = rand(0,25);
				$c = chr(ord('a')+$r);
				$code.=$c;
			}
		
			$sql = "INSERT INTO $par->userstable (`email`) VALUES ('$email')";
			mysql_query($sql);
			$lastid = mysql_insert_id();
		
			$sql = "UPDATE $par->userstable SET `prior`=$lastid, `phone`='$phone', `date`=$currtime, `modifydate`=$currtime, `hide`=1, `code`='$code', `firstname`='$firstname', `email`='$email', `password`='$password',`address`='$address' WHERE id=$lastid";
			mysql_query($sql);
			//echo $sql.'<BR>';
		
		//	    $_SESSION['loguserid'] = $lastid;
		
			$from = $varsline['adminemail'];
			$to = $email;
			$subj = "http://".$_SERVER['SERVER_NAME']." - registration";
			$body = "\n\nДля подтверждения регистрации перейдите по ссылке: http://".$_SERVER['SERVER_NAME']."/work.php?act=submitregistration&code=".$code;
		
			
			$_SESSION['register_result'] = 'submit';

			mailer($from,$to,$subj,$body);
			echo '<script> document.location.href="/cabinet/subact/register"; </script>';
			exit();
	    }
	    else
	    {
			$_SESSION['register_result'] = 'badcode';

			echo '<script> document.location.href="/cabinet/subact/register"; </script>';
			exit();
	    }
	}
	else if($act=="editprofile")
	{
	    if(!isset($_SESSION['loguserid']))
	    {
		echo '<script> document.location.href="/cabinet"; </script>';
		exit();
	    }

	    $id = (int)($_SESSION['loguserid']);

	    $password = myaddslashes($_POST['password']);
	    $firstname = myaddslashes($_POST['firstname']);
	    $phone = myaddslashes($_POST['phone']);

	    $lastid = $id;

	    $sql = "UPDATE $par->userstable SET `phone`='$phone', `firstname`='$firstname' WHERE id=$lastid";
	    mysql_query($sql);

	    if($password!='')
	    {
		$sql = "UPDATE $par->userstable SET `password`='$password' WHERE id=$lastid";
		mysql_query($sql);
	    }

	    echo '<script> document.location.href="/cabinet"; </script>';
	    exit();
	}
	else if($act=="login")
	{
	    $email = myaddslashes($_REQUEST['loginemail']);
	    $password = myaddslashes($_REQUEST['loginpassword']);
	    $sql = "SELECT * FROM $par->userstable WHERE `email`='$email' AND `password`='$password' AND `hide`=0";
	   // echo $sql.'<BR>';
	    $res = mysql_query($sql);
	    if($line = mysql_fetch_array($res,MYSQL_ASSOC))
	    {
			$_SESSION['loguserid'] = $line['id'];
			
			$hash = md5(md5($line['code']));
			
			setcookie("uid", $line['id'], time()+60*60*24*30,'/');
			setcookie("hash", $hash, time()+60*60*24*30,'/');
			
			echo '<script> document.location.href = "/cabinet"; </script>';
			exit();
	    }
	    echo '<script> document.location.href = "/cabinet/subact/badlogin"; </script>';
	    exit();
	}

	if($act=="logout")
	{
		if(isset($_SESSION['loguserid']))
		{
			$uid = (int)$_SESSION['loguserid'];
			setcookie("uid", $line['id'], time()-60*60*24*30,'/');
		}
		
		unset($_SESSION['loguserid']);

		echo '<script> document.location.href = "/"; </script>';
		exit();
	}
	
	if($act=="submitregistration")
	{
	    if(isset($_REQUEST['code'])) $code = myaddslashes($_REQUEST['code']); else $code = 'x';
	
	    $sql = "SELECT * FROM $par->userstable WHERE `code`='$code'";
	    $res = mysql_query($sql);
	    if($line = mysql_fetch_array($res,MYSQL_ASSOC))
	    {
			$sql = "UPDATE $par->userstable SET `hide`=0 WHERE code='$code'";
			mysql_query($sql);
			$_SESSION['register_result'] = 'submitok';
			
			$_SESSION['loguserid'] = $line['id'];
			
			$hash = md5(md5($line['code']));
			
			setcookie("uid", $line['id'], time()+60*60*24*30,'/');
			setcookie("hash", $hash, time()+60*60*24*30,'/');

			echo '<script> document.location.href="/cabinet"; </script>';
			exit();
	    }
	    echo '<script> document.location.href="/"; </script>';
	    exit();
	    
	}
?>
