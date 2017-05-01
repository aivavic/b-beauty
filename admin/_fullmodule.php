<?
    //v4.0
    if(!isset($loggedok) || $loggedok!=1) exit(); //защита от прямого вызова
	
	class FullAdminModule
	{
		var $fields = Array(
			'text'=>Array('fieldtype'=>'text', 'fieldname'=>'text', 'visualtype'=>'input','used'=>false,'method'=>'DoStandart1'),
			'text2'=>Array('fieldtype'=>'text', 'fieldname'=>'text', 'visualtype'=>'textarea','used'=>false,'method'=>'DoStandart1'),
		);
		
		function DoStandart1()
		{
		}
		
		function NewMenu()
		{
			if(isset($_REQUEST['title'])) $title = myaddslashes($_REQUEST['title']); else $title = '';
			if(isset($_REQUEST['title_ru'])) $title_ru = myaddslashes($_REQUEST['title_ru']); else $title_ru = '';
			if(isset($_REQUEST['title_en'])) $title_en = myaddslashes($_REQUEST['title_en']); else $title_en = '';

			$currtime = time();
			$sql = "INSERT INTO $this->tablename SET `date`=$currtime, `hide`=".$this->defaulthide.", `title`='$title', `title_ru`='$title_ru', `title_en`='$title_en', `parentid`=".$this->id."";
			mysql_query($sql);

			$lastid = mysql_insert_id();
			
			$sql = "UPDATE $this->tablename SET `prior`=$lastid WHERE `id`=$lastid";
			mysql_query($sql);

			$currtime = time();
			$sql = "UPDATE $this->tablename SET `modifydate`=$currtime WHERE id=".$lastid."";
			mysql_query($sql);
			
			if($this->needartikul==true)
			{
				$artikul = myaddslashes($_REQUEST['artikul']);
				$sql = "UPDATE $this->tablename SET `artikul`='$artikul' WHERE `id`=$lastid";
				mysql_query($sql);
			}
			

			echo '<script> document.location.href = "admin.php?act='.$this->moduleact.'&id='.$this->id.'";</script>';
			exit();
		}
				
	
	}
	
    ////////////////////////////////////////////////////////////////////////////////    
    if($act=="editfullmodule")
    {
		$module = new FullAdminModule;
		$result = $module->DoModule();
		echo $result;
    }
?>	
<?
/*
		function NeedEditTextFields()
		{
			for($i=1;$i<=$this->maxadmlangs;$i++)
			{
				if($this->admlangs[$i])
				{
					$suffix = $this->admlangssuffix[$i];
					if($this->admlangs[$i])
					{
						if(isset($_REQUEST['title'.$suffix])) $title = myaddslashes($_REQUEST['title'.$suffix]); else $title = '';
						if(isset($_REQUEST['titleh1'.$suffix])) $titleh1 = myaddslashes($_REQUEST['titleh1'.$suffix]); else $titleh1 = '';
						if(isset($_REQUEST['text'.$suffix])) $text = myaddslashes($_REQUEST['text'.$suffix]); else $text = '';
						if(isset($_REQUEST['shorttext'.$suffix])) $shorttext = myaddslashes($_REQUEST['shorttext'.$suffix]); else $shorttext = '';
						if(isset($_REQUEST['text2'.$suffix])) $text2 = myaddslashes($_REQUEST['text2'.$suffix]); else $text2 = '';
						if(isset($_REQUEST['url'.$suffix])) $url = myaddslashes($_REQUEST['url'.$suffix]); else $url = '';
						if(isset($_REQUEST['seo'.$suffix])) $seo = myaddslashes($_REQUEST['seo'.$suffix]); else $seo = '';
						if(isset($_REQUEST['titletitle'.$suffix])) $titletitle = myaddslashes($_REQUEST['titletitle'.$suffix]); else $titletitle = '';
						if(isset($_REQUEST['titlekeywords'.$suffix])) $titlekeywords = myaddslashes($_REQUEST['titlekeywords'.$suffix]); else $titlekeywords = '';
						if(isset($_REQUEST['titledescription'.$suffix])) $titledescription = myaddslashes($_REQUEST['titledescription'.$suffix]); else $titledescription = '';
						if(isset($_REQUEST['metatags'.$suffix])) $metatags = myaddslashes($_REQUEST['metatags'.$suffix]); else $metatags = '';
		
						$sql = "UPDATE $this->tablename SET `url$suffix`='$url', `seo$suffix`='$seo', `text$suffix`='$text', `shorttext$suffix`='$shorttext', `text2$suffix`='$text2', `title$suffix`='$title' , `titleh1$suffix`='$titleh1' WHERE id=".$this->id."";
						mysql_query($sql);
						
						$sql = "UPDATE $this->tablename SET `titletitle$suffix`='$titletitle', `titlekeywords$suffix`='$titlekeywords', `titledescription$suffix`='$titledescription', `metatags$suffix`='$metatags' WHERE id=$this->id";
						mysql_query($sql);
					}
				}
			}		
		}
*/
?>	