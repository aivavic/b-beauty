<?
	if($act=="delusercoment")
	{
	    if(isset($_SESSION['loguserid']))
	    {
		$sql = "SELECT * FROM $par->userscomentstable WHERE id=$id AND parentid=$userid";
		$res = mysql_query($sql);
		if($line = mysql_fetch_array($res,MYSQL_ASSOC))
		{
		    DelUserComent($id);
		    
		    $sql = "SELECT COUNT(id) AS ccc FROM $par->userscomentstable WHERE parentid=$userid";
		    $res = mysql_query($sql);
		    $line = mysql_fetch_array($res,MYSQL_ASSOC);
		    
		    $sql = "UPDATE $par->userstable SET `numcoments`=".$line['ccc']." WHERE id=$userid ";
		    mysql_query($sql);
		}
	    }
	    echo '<script> document.location.href = "'.$_SERVER['HTTP_REFERER'].'"; </script>';
	    exit();
	}

	if($act=="addblogcoment")
	{
        if(count($_POST)>0)
        {
			$ur = $_SERVER['HTTP_REFERER'];
			$backurl = $ur;

			$id2 = (int)$_REQUEST['parentcomid'];
			
			if(isset($_SESSION['loguserid']) || (isset($_SESSION['captcha_keystring'.$id.'_'.$id2]) && $_SESSION['captcha_keystring'.$id.'_'.$id2] == $_POST['keystring']))
			{
				//echo $subact.'<BR>';
				//if($subact=="none")
				{
					$tablename = $par->comentstable;
					//$backurl = '/testcom.php?id='.$id;
				}
				
				
				if(isset($_SESSION['loguserid'])) { $uid = (int)$_SESSION['loguserid']; $hide=0;}
				else { $uid=0; $hide=0; }

				$name = myaddslashes($_REQUEST['name']);
				$text = myaddslashes($_REQUEST['text']);
				$parentcomid = (int)$_REQUEST['parentcomid'];
				$ip = $_SERVER['REMOTE_ADDR'];
				$email = '';
				$title = '';
				$currtime = time();
				$comentstype = (int)$_REQUEST['comentstype'];
				
				

				$sql = "INSERT INTO $tablename SET `title`='$title', `name`='$name', `text`='$text',`email`='$email',`parentid`=$id,`date`=$currtime, `ip`='$ip',
				`userid`=$uid,`hide` = $hide,`parentcomid`=$parentcomid, `comentstype`=$comentstype ";
				mysql_query($sql);
				$lastid = mysql_insert_id();
				
				$sql = "UPDATE $tablename SET `prior`=$lastid WHERE id=$lastid";
				mysql_query($sql);

				$okcode = 2;

				//echo htmlspecialchars($sql).'<BR>';
				//exit();

				echo '<script> document.location.href = "'.$backurl.'"; </script>';
				
				//if(isset($_SESSION['loguserid'])) echo '<script> document.location.href = "'.$backurl.'"; </script>';
				//else echo '<script> document.location.href = "'.$backurl.'/moder"; </script>';

	//                    echo '<script> document.location.href = "'.$ur.'"; </script>';
						exit();
					}
					else
					{
						$_SESSION['badcode']=1;
						echo '<script> document.location.href = "'.$backurl.'"; </script>';
						exit();
					}
		}
			
		echo '<script> document.location.href = "'.$ur.'"; </script>';
		exit();
	    
	}

?>