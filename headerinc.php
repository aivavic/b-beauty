<?


//    session_register("basket[]");
	include_once "classes.php";
	ini_set('upload_max_filesize',8000000);

	$varsline = GetVars();
	
	if($varsline['hidesite']==1 && !isset($_SESSION['logadmin']))
	{
		echo $varsline['comingsoon'];
		exit();
	}
	
	
	if(isset($_COOKIE['uid']) && isset($_COOKIE['hash']))
	{
		$uid = (int)$_COOKIE['uid'];
		$hash = addslashes($_COOKIE['hash']);
		$sql = "SELECT * FROM $par->userstable WHERE `id`=$uid AND `hide`=7";
		$res = mysql_query($sql);
		if($line = mysql_fetch_array($res,MYSQL_ASSOC))
		{
			if($hash==md5(md5($line['code'])))
			{
				$_SESSION['loguserid'] = $line['id'];
			}
		}
		else
		{
			setcookie("uid", $uid, time()-60*60*24*30,'/');
			setcookie("hash", $hash, time()-60*60*24*30,'/');
		}
	}

	$lang = ''; $langadd = ''; $urllangadd = ''; $plang = 'ru';

	$ur = $_SERVER['REQUEST_URI'];
	$ur_query = $_SERVER['QUERY_STRING'];
	$ur = str_replace('?'.$ur_query,'',$ur);
	
	$act = "none"; $subact = "none"; $id = 0; $start = 0;


	
	$ur.="/";
	$myarr = explode('/',$ur);
	for($i=1;$i<count($myarr);$i=$i+1)
	{
		if($myarr[$i]=='lang') 
		{
			$plang = $myarr[$i+1];
			$t = array_search($plang,$par->langsarr['plangsarr']);
			$langadd = $par->langsarr['admlangssuffix'][$t];
			$urllangadd = $par->langsarr['urllangsaddarr'][$t];
			break;
		}					
	}	

	//по умолчанию определяем титл главной
	$sqltmp = "SELECT * FROM $par->topmenutable WHERE url='/'";
	$restmp = mysql_query($sqltmp);
	$linetmp = mysql_fetch_array($restmp,MYSQL_ASSOC);
	$titletitle = GetTitle($linetmp);
	$titlekeywords = GetKeywords($linetmp);

	foreach($par->params AS $param)
	{
		$actname = $param['actname'];
		$tablename = $param['tablename'];
		$urlprefix = $param['urlprefix'];
		
		$successflag = false;
		
		if(isset($linetmp)) unset($linetmp);
		
		foreach($par->langsarr['admlangssuffix'] AS $key=>$value)
		{
			$sql = "SELECT * FROM $tablename WHERE `seo$value`='/".addslashes(urldecode($myarr[1]))."' ";
			$res = mysql_query($sql);
			if($linetmp = @mysql_fetch_array($res,MYSQL_ASSOC))
			{
				$act = $actname;
				$id = $linetmp['id'];
				$plang = $par->langsarr['plangsarr'][$key];				
				$successflag = true;
	
			}
		}
		
		if(substr($ur,0,strlen($urlprefix)+1)=='/'.$urlprefix)
		{

		    $successflag = true;
			
		    $act=$actname;
		    $id = (int)$myarr[2];
		    if(isset($myarr[2]))
		    {
				if(trim($myarr[2])!='' && $tablename!='')
				{
					for($ii=1;$ii<=$par->langsarr['maxadmlangs'];$ii++)
						if($par->langsarr['admlangs'][$ii])
						{
							$sql = "SELECT * FROM $tablename WHERE `seo".$par->langsarr['admlangssuffix'][$ii]."`='".addslashes(urldecode($myarr[2]))."'";
							$res = mysql_query($sql);
							if($line = mysql_fetch_array($res,MYSQL_ASSOC))
							{
								$id = $line['id'];
								$plang = $par->langsarr['plangsarr'][$ii];
							}
						}
				}
		    }
		}
		
		if($successflag)
		{
			
			for($i=1;$i<count($myarr);$i=$i+1)
			{
				if($myarr[$i]=='start') $start = (int)$myarr[$i+1];
				if($myarr[$i]=='subact') $subact = $myarr[$i+1];
				if($myarr[$i]=='subact2') $subact2 = $myarr[$i+1];
				if($myarr[$i]=='lang') 
				{
					$plang = $myarr[$i+1];
				}					
			}
	
			/////////////////////автоматизувати
			if($plang=='ru') { $lang = ''; $langadd = ''; $urllangadd = ''; }
			if($plang=='en') { $lang = ''; $langadd = '_en'; $urllangadd = '/lang/en'; }
			
			//універсалізувати
			if($id==0 && ($act=="news" || $act=="cat" || $act=="gallery" || $act=="contacts" || $act=="novinki"))
			{
			    $sqltmp = "SELECT * FROM $par->topmenutable WHERE url='/$act'";
			}
			
			if($id!=0)
			{
			    $sqltmp = "SELECT * FROM $tablename WHERE id=$id";
			}
			
			$restmp = mysql_query($sqltmp);
			if($linetmp = mysql_fetch_array($restmp,MYSQL_ASSOC))
			{
			    $titletitle = GetTitle($linetmp);
			    $titlekeywords = GetKeywords($linetmp);
			}
		}

		//после первого совпадения прекращаем цикл
		if($successflag) break;
	}
	
	if($act=="none")
	{
		$flag = 0;
		if($myarr[1]=='') $flag = 1;
		else if($myarr[1]=='lang')
		{
			foreach($par->langsarr['urllangsaddarr'] AS $key=>$value)
			{
				if($value!='' && $value=='/'.$myarr[1].'/'.$myarr[2]) $flag = 1;
			}
		}
		
		if($flag==0)
		{
			//Make404();
            $nopage=1;
		}
	}
	
	
	
	if(isset($_SESSION['loguserid']))
	{
	    $sql = "SELECT * FROM $par->userstable WHERE id=".(int)$_SESSION['loguserid'];
	    $res = mysql_query($sql);
	    $userline = mysql_fetch_array($res,MYSQL_ASSOC);
	}



	

?>