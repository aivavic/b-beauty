<?
	session_start();

	include "../classes.php";

	$refer = $_SERVER['HTTP_REFERER'];
	
	if(isset($_REQUEST['act'])) $act=$_REQUEST['act']; else $act="none";
	if(isset($_REQUEST['subact'])) $subact=$_REQUEST['subact']; else $subact="none";
	if(isset($_REQUEST['id'])) $id=(int)$_REQUEST['id']; else $id=0;
	if(isset($_REQUEST['categid'])) $categid=(int)$_REQUEST['categid']; else $categid=0;
	if(isset($_REQUEST['sortorder'])) $sortorder=(int)$_REQUEST['sortorder']; else $sortorder=0;

	if($act=="changesortorder")
	{
		$refer = $_SERVER['HTTP_REFERER'];
		if(isset($_REQUEST['moduleact']) && isset($_REQUEST['sortfield']))
		{
			$moduleact = $_REQUEST['moduleact'];
			$sortfield = $_REQUEST['sortfield'];
			if(isset($_SESSION['sortorder:'.$moduleact]) && $_SESSION['sortorder:'.$moduleact] == $sortfield)
			{
				$_SESSION['sortorder:'.$moduleact] = $sortfield." DESC ";
			}
			else $_SESSION['sortorder:'.$moduleact] = $sortfield;
			if($sortfield=='') unset($_SESSION['sortorder:'.$moduleact]);
			
		}
		
		header('Location: '.$refer);
		exit();
	}

	if($act=="changeorderstatus")
	{
		$sql = "UPDATE $par->orderstable SET `orderstatus`=".(int)$_REQUEST['orderstatus']." WHERE id=$id";
		$res = mysql_query($sql);
		echo '<script> document.location.href = "admin.php?act=editorders&sortorder='.(int)$_REQUEST['sortorder'].'&start='.(int)$_REQUEST['start'].'"; </script>';
		exit();
	}
	
	if($act=="changedrawer")
	{
		$d = $_REQUEST['d'];
		$_SESSION['current_admin_drawer'] = $d;
		
		$sql = "UPDATE $par->varstable SET `fieldvalue`='".addslashes($d)."' WHERE `fieldname`='currentdrawer'";
		mysql_query($sql);

		header('Location: '.$refer);
		exit();
	}


	$refer = $_SERVER['HTTP_REFERER'];
	if(strpos($refer,'added='))
	{
		$p = strpos($refer,'added=');
		$refer = substr($refer,0,$p+6).$added;
	}
	else $refer.='&added='.$added;
	
	header('Location: '.$refer);
	exit();
?>