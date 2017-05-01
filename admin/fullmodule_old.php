<?
    //v4.0
    if(!isset($loggedok) || $loggedok!=1) exit(); //защита от прямого вызова
	
	class FullAdminModule
	{
		var $id = 0;
		var $start = 0;
		var $subact = "none";
		var $act = "none";

		////////////////////////////////////////////////////////////////////////////////
		//module settings
		var $moduleact = "editfullmodule";  //act для модуля
		var $tablename = "fullmodule"; //$par->fullmoduletable; //таблица для модуля
		
		var $brendtablename = ""; //    $par->brendstable; //таблица для брендов

		
		var $pagestr = 'full'; //префикс url для модуля
		var $itemsorder = "prior ASC"; //ASC or DESC порядок сортировки пунктов в админке
		
		var $itemsinpage = 20; //количество записей на страницу

		var $maxadmlangs = 3; //количество языков

		var $urllangsaddarr = Array('','','/lang/ru','/lang/en'); //суффиксы url для языков. нулевой параметр не используется
		var $admlangstitle = Array(1=>'(укр)',2=>'(рус)',3=>'(eng)');
		var $admlangssuffix = Array(1=>'',2=>'_ru',3=>'_en');
		var $admlangs = Array(1=>true,2=>false,3=>true);
		
		
		var $maxlevel = 1; // Максимальное количество уровней вложености

		var $needbrend = false;
		
		
		/////////IMAGES//////////////
		var $picsextarr = Array('jpg','gif','png'); //Допустимые разрешения для режима same

		//Массив с описанием картинок. Оставить пустым если картинок не нужно: var $pics = Array()
		var $pics = Array(
		1 => Array( 
				'title' => 'Тест-картинка1',
				'params' => Array(
					Array('picprefix'=>'../fotos/full_sm_', 'w'=>300, 'h'=>200, 'mode'=>'bigsize','ext'=>'jpg'),
					Array('picprefix'=>'../fotos/full_bg_', 'w'=>600, 'h'=>400, 'mode'=>'bigsize','ext'=>'jpg','watermarkfile'=>'../images/water.png','watermarkpos'=>'center')
				)
			),

		2 => Array( 
				'title' => 'Тест-картинка2',
				'params' => Array(
					Array('picprefix'=>'../fotos/full_t2_sm_', 'w'=>300, 'h'=>200, 'mode'=>'bigsize','ext'=>'jpg'),
					Array('picprefix'=>'../fotos/full_t2_bg_', 'w'=>600, 'h'=>400, 'mode'=>'bigsize','ext'=>'jpg')
				)
			)			
		);
		

		//для uploadify
		var $isgallery = false;
		var $gallerypics_tablename = '';
		var $gallerypics = Array();
/*
		var $gallerypics_tablename = 'fotor';
		var $gallerypics = Array(
					Array('picprefix'=>'../fotos/smfotor', 'w'=>300, 'h'=>200, 'mode'=>'bigsize','ext'=>'jpg'),
					Array('picprefix'=>'../fotos/fotor', 'w'=>600, 'h'=>400, 'mode'=>'bigsize','ext'=>'jpg','watermarkfile'=>'../images/water.png','watermarkpos'=>'center')
		);		
*/		
		///////////////////////

		var $inputtextwidth = 200;
		var $textareawidth = 400;

		var $defaulthide = 1; //0 - show, 1 - hide вновь созданная запись будет по умолчанию видима/невидима
		
		var $neednewparentid = false; //не трогать :)
		var $needhide = true; //отображать галочку НЕ ПОКАЗЫВЫТЬ
		var $needdate = false; //отображать редактирование даты

		var $needdatetime = false; //отображать редактирование времени в дате
		//var $needtitle = true; //unused

		var $needtitleh1 = false;
		
		var $needartikul = false;

		
		var $needtext = false; var $text_type = 'fck'; //fck, textarea, input - отображать редактирование поля text
		var $needshorttext = true; var $shorttext_type = 'fck'; //fck, textarea, input - shorttext
		var $needtext2 = false; var $text2_type = 'fck'; //fck, textarea, input - text2
		
		var $needurl = false;
		var $needseo = true;
		var $needkeywords = true;
		var $needpic = true;

		var $needspec1 = false; 
		var $needspec2 = false; 
		var $needspec3 = false; 
		
		//Массив с описанием файлов. Оставить пустым если файлов не нужно: var $files = Array()
		var $files = Array();
/*
 		var $files = Array(
		1 => Array( 
				'title' => 'Тест-файл1',
				'fileprefix' => '../files/fullfile',
			),
		2 => Array( 
				'title' => 'Тест-файл1',
				'fileprefix' => '../files/fullfile',
			),
		);
*/		

		var $iscatalog = false;
		var $objectsmodulefile = ""; // var $objectsmodulefile = "editobjects.php"; путь к файлу с класом объектов категории
		var $objectstable = ""; // таблица объектов категории
		
		//в базе данных в таблице объектов есть поля для этого блока. Для других таблиц при надобности добавить поля
		var $paramnumber = 0; //0 - если не используется
		
		
		
		
		var $hints = Array(
		'brend'=>'Бренд:',
		'newparentid'=>'Родительская категория:',
		'needhide'=>'Не показывать пункт:',
		'needtitle'=>'Редактировать пункт:',
		'needtitleh1'=>'Альтернативный заголовок (H1):',
		'needartikul'=>'Арт:', 
		'needdate'=>'Дата:', 
		'needurl'=>'Ссылка (если нужно):',
		'needseo'=>'SEO (если нужно):',
		'editgallery'=>'Фото:',
		'needshorttext'=>'Короткое описание ',
		'needtext'=>'Описание ',
		'needtext2'=>'Описание-2 ',
		'addparams'=>'Дополнительные параметры:',
		'spec1'=>'Галочка-1',
		'spec2'=>'Галочка-2',
		'spec3'=>'Галочка-3',
		'needkeywords'=>'Блок для продвижения',
		'objects'=>'ОБЪЕКТЫ',
		'addnewitem'=>'Добавить новый пункт:',
		'title'=>'Название',
		'submitadd'=>'Добавить',
		'download'=>'Скачать:',
		'maincategories'=>'Главные категории',
		'edit'=>'Редактировать',
		'confirmdelete'=>'Вы действительно хотите удалить???',
		
		);

		
		var $par;
		var $adm;
		
		function __construct()
		{
			$this->id = $GLOBALS['id'];
			$this->start = $GLOBALS['start'];
			$this->act = $GLOBALS['act'];
			$this->subact = $GLOBALS['subact'];
			
			$registry = & Registry::getInstance();
			$this->par = $registry->get('par');
			$this->adm = $registry->get('adm');
		}

		
		function MakeRes($r1,$m1,$r2,$m2)
		{
			$resarr = Array(
					'type'=>'line', 
					'value'=> Array(  Array('type'=>$m1, 'value'=>$r1) ,
									  Array('type'=>$m2, 'value'=>$r2) ) 
			);
			return $resarr;
		}
		
		function CreateAdminPicMethod($mode,$tmpname,$newname,$w,$h)
		{
			CreateAdminPic($mode,$tmpname,$newname,$w,$h);
		}
		

		
		function DelOneFoto($itemid, $delfoto)
		{
			$tempextarr = $this->picsextarr;

			$value1 = $this->pics[$delfoto];
			foreach($value1['params'] AS $key2=>$value2)
			{
				$picprefix = $value2['picprefix'];

				for($i=0;$i<count($tempextarr);$i++)
				{
					if(trim($tempextarr[$i])!='')
					{
						$ext = $tempextarr[$i];
						if(is_file($picprefix.$itemid.'.'.$ext)) @unlink($picprefix.$itemid.'.'.$ext);
					}
				}
			}
		}
		
		function DelAllFotos($itemid)
		{
			foreach($this->pics AS $key1=>$value1)
			{
				$this->DelOneFoto($itemid,$key1);
			}
			
			if($this->isgallery==true)
			{
				$sql = "SELECT * FROM ".$this->gallerypics_tablename." WHERE `reportid`=".$itemid;
				$res = mysql_query($sql);
				while($line = mysql_fetch_array($res,MYSQL_ASSOC))
				{
					$tid = $line['id'];
					
					foreach($this->gallerypics AS $galleryitem)
					{
						$fname = $galleryitem['picprefix'].$tid.'.'.$galleryitem['ext'];
						if(is_file($fname)) @unlink($fname);
					}
					
					$sql = "DELETE FROM ".$this->gallerypics_tablename." WHERE id=$tid";
					mysql_query($sql);
					
				}
			}
		}
		
		
		function DelOneFile($itemid,$delfile)
		{
			$fileparams = $this->files[$delfile];
			if(is_file($fileparams['fileprefix'].$itemid.'_'.$delfile.'.tmp')) @unlink($fileparams['fileprefix'].$itemid.'_'.$delfile.'.tmp');
		}
		
		function DelAllFiles($itemid)
		{
			foreach($this->files AS $key1=>$value1)
			{
				$this->DelOneFile($itemid,$key1);
			}
		}

		///////////////Methods for NeedEditDeepMenu method//////////////////////////////////////
		
		function NeedEditArtikul()
		{
			if($this->needartikul)
			{
                if(isset($_REQUEST['artikul'])) $artikul = myaddslashes($_REQUEST['artikul']); else $artikul = '';
                $sql = "UPDATE $this->tablename SET `artikul`='$artikul' WHERE id=$this->id";
                mysql_query($sql);
			}
		}
		
		function NeedEditBrend()
		{
			if($this->needbrend)
			{
				if(isset($_REQUEST['brendid'])) $brendid = (double)$_REQUEST['brendid']; else $brendid = 0;
				$sql = "UPDATE $this->tablename SET `brendid`=$brendid WHERE id=$this->id";
				mysql_query($sql);
			}
		}
		
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
		
		function NeedEditSpec()
		{
			if($this->needspec1)
			{
					if(isset($_REQUEST['spec1'])) $this->spec = (int)$_REQUEST['spec1']; else $this->spec = 0;
					$sql = "UPDATE $this->tablename SET `spec1`=$this->spec WHERE id=".$this->id."";
					mysql_query($sql);
			}

			if($this->needspec2)
			{
					if(isset($_REQUEST['spec2'])) $this->spec = (int)$_REQUEST['spec2']; else $this->spec = 0;
					$sql = "UPDATE $this->tablename SET `spec2`=$this->spec WHERE id=".$this->id."";
					mysql_query($sql);
			}

			if($this->needspec3)
			{
					if(isset($_REQUEST['spec3'])) $this->spec = (int)$_REQUEST['spec3']; else $this->spec = 0;
					$sql = "UPDATE $this->tablename SET `spec3`=$this->spec WHERE id=".$this->id."";
					mysql_query($sql);
			}
		}
		
		function NeedEditNewParentId()
		{
			if(isset($_REQUEST['newparentid']))
			{
				$newparentid = (int)$_REQUEST['newparentid'];
				if($newparentid!=$this->id)
				{
					$sql = "UPDATE $this->tablename SET `parentid`=$newparentid WHERE id=".$this->id."";
					mysql_query($sql);
				}
			}		
		}
		
		function NeedEditHide()
		{
			if(isset($_REQUEST['hide'])) $hide = (int)$_REQUEST['hide']; else $hide = 0;
			$sql = "UPDATE $this->tablename SET `hide`=$hide WHERE id=".$this->id."";
			mysql_query($sql);
		}
		
		function NeedEditDate()
		{
			$currtime = time();
			$sql = "UPDATE $this->tablename SET `modifydate`=$currtime WHERE id=".$this->id."";
			mysql_query($sql);
			
			if($this->needdate)
			{
				if(isset($_REQUEST['hours'])) $hours = (int)$_REQUEST['hours']; else $hours = 0;
				if(isset($_REQUEST['minutes'])) $minutes = (int)$_REQUEST['minutes']; else $minutes = 0;
				
				$day = (int)$_REQUEST['day'];
				$month = (int)$_REQUEST['month'];
				$year = (int)$_REQUEST['year'];
	
				$currdate = mktime($hours,$minutes,0,$month,$day,$year);
				$sql = "UPDATE $this->tablename SET `date`=$currdate WHERE id=".$this->id."";
				mysql_query($sql);
			}
		}
		
		function NeedEditFiles()
		{
			//Обработка загруженных файлов
			foreach($this->files AS $key=>$fileparams)
			{  
				$ii = $key;
				if(isset($_FILES['menufile'.$ii]['tmp_name']) && $_FILES['menufile'.$ii]['tmp_name']!="")
				{
					$filename = $_FILES['menufile'.$ii]['name'];

					$tmpname = $_FILES['menufile'.$ii]['tmp_name'];
					$newname = $fileparams['fileprefix'].$this->id.'_'.$ii.'.tmp';
					if(is_file($newname)) @unlink($newname);

					copy($tmpname,$newname);
					
					$sql = "UPDATE $this->tablename SET `filename$ii` = '".addslashes($filename)."' WHERE id=".$this->id."";
					mysql_query($sql);
				}
			}
		}
		
		function NeedEditImages()
		{
			//Обработка загруженных картинок
			
			$lastid = $this->id;

			foreach($this->pics AS $key1=>$value1)
			{
				$ii = $key1;
				if(isset($_FILES['userfile'.$ii]['tmp_name']) && $_FILES['userfile'.$ii]['tmp_name']!="")
				{
					$tmpname = $_FILES['userfile'.$ii]['tmp_name'];
					
					foreach($value1['params'] AS $key2=>$value2)
					{
						$picprefix = $value2['picprefix'];

						$tempextarr = $this->picsextarr;
						for($tt=0;$tt<count($tempextarr);$tt++)
						{
							if(trim($tempextarr[$tt])!='')
							{
								$tempext = $tempextarr[$tt];
								if(is_file($picprefix.$lastid.'.'.$tempext)) @unlink($picprefix.$lastid.'.'.$tempext);
							}
						}
						
					}

					foreach($value1['params'] AS $key2=>$value2)
					{
						$picprefix = $value2['picprefix'];
						$ext = $value2['ext'];
						$newname = $picprefix.$lastid.'.'.$ext;
						
						//винести в метод
						$this->CreateAdminPicMethod($value2['mode'],$tmpname,$newname,$value2['w'],$value2['h']);
						
						if(isset($value2['watermarkfile']))
						{
							put_watermark($newname,$newname,$value2['watermarkpos'],100,$value2['watermarkfile']);
						}
						
					}				
				}			
			}
		}
		
		function NeedEditParams()
		{
			if($this->paramnumber>0)
			{
				for($i=1;$i<=$this->maxadmlangs;$i++)
				{
					if($this->admlangs[$i])
					{
					$suffix = $this->admlangssuffix[$i];
					if($this->admlangs[$i])
					{
						for($j=1;$j<=$this->paramnumber;$j++)
						{
							$paramname = myaddslashes($_REQUEST['paramname'.$j.$suffix]);
							$paramvalue = myaddslashes($_REQUEST['paramvalue'.$j.$suffix]);
							$sql = "UPDATE $this->tablename SET `paramname".$j.$suffix."`='$paramname', `paramvalue".$j.$suffix."`='$paramvalue' WHERE id=$this->id";
							mysql_query($sql);
						}
					}
					}
				}
			}
		}
		
		///////////////End of Methods for NeedEditDeepMenu method//////////////////////////////////////
		
		
		function NeedEditDeepMenu()
		{
			$this->NeedEditArtikul();
			$this->NeedEditBrend();
			$this->NeedEditTextFields();
			$this->NeedEditSpec();
			$this->NeedEditNewParentid();
			$this->NeedEditHide();
			$this->NeedEditDate();
/*
			$sql = "SELECT * FROM $this->tablename WHERE id=".$this->id."";
			$res = mysql_query($sql);
			$menuline = mysql_fetch_array($res,MYSQL_ASSOC);

			$lastid = $this->id;
*/
			$this->NeedEditFiles();
			$this->NeedEditImages();
			$this->NeedEditParams();
			
			echo '<script> document.location.href = "'.$_REQUEST['backurl'].'";</script>';
			exit();
							
		}
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			
			
		///////////////Methods for EditDeepMenu method///////////////////////////////////////////////////////
		
		function EditArtikul($line)
		{
			$ret = Array();
			
            if($this->needartikul)
            {
				$r1 = $this->hints['needartikul'];
                $r2 = '<input type="text" name="artikul" value="'.htmlspecialchars($line['artikul']).'"style="width:'.$this->inputtextwidth.'px;">';
				
				$ret = Array(
								'type'=>'line', 
								'value'=> Array(  Array('type'=>'text', 'value'=>$r1) ,
												  Array('type'=>'html', 'value'=>$r2) ) 
							);
				
            }
			return $ret;
		}
		
		
		function EditBrend($line)
		{
			$ret = Array();

            if($this->needbrend)
            {
				$r1 = $this->hints['brend'];
				$r2 = '<select name="brendid"><option value="0">--------------</option>';
                $r2.= PrintDeepSelectAdmin($this->brendtablename,0,0,$line['brendid']);
                $r2.= '</select>';
				$ret = $this->MakeRes($r1,'text',$r2,'html');
            }
			return $ret;
		}

		function EditNewParentId($line)
		{
			if($this->neednewparentid)
			{
				$r1 = $this->hints['newparentid'];
				$r2 = '<select name="newparentid"><option value="0">--------------</option>';
				$r2.= PrintDeepSelectAdmin($this->tablename,0,0,$line['parentid']);
				$r2.= '</select>';
				
				return $this->MakeRes($r1,'text',$r2,'html');
			}
		}
		
		function EditNeedHide($line)
		{
			if($this->needhide)
			{
				$r1 = $this->hints['needhide'];
				$r2 = '<input type="checkbox" name="hide" id="hide" '.TrueStr($line['hide']==1,' checked ').' value="1">';
				return $this->MakeRes($r1,'text',$r2,'html');
			}            
		}
		
		function EditTitle($line)
		{
		
			$r1 = $this->hints['needtitle'];
			$r2 = '';
			for($i=1;$i<=$this->maxadmlangs;$i++)
			{
				if($this->admlangs[$i])
				{
					$suffix = $this->admlangssuffix[$i];
					$r2.= '<b>'.$this->admlangstitle[$i].'</b><input type="text" name="title'.$suffix.'" value="'.htmlspecialchars($line['title'.$suffix]).'"style="width:'.$this->inputtextwidth.'px;"> ';
				}
			}

			return $this->MakeRes($r1,'text',$r2,'html');
		}
		
		function EditTitleh1($line)
		{
			if($this->needtitleh1)
			{
				$r1 = $this->hints['needtitleh1'];
				$r2 = '';
				for($i=1;$i<=$this->maxadmlangs;$i++)
				{
					if($this->admlangs[$i])
					{
						$suffix = $this->admlangssuffix[$i];
						$r2.= '<b>'.$this->admlangstitle[$i].'</b><input type="text" name="titleh1'.$suffix.'" value="'.htmlspecialchars($line['titleh1'.$suffix]).'"style="width:'.$this->inputtextwidth.'px;"> ';
					}
				}
				return $this->MakeRes($r1,'text',$r2,'html');
			}
		}
		
		function EditDate($line)
		{
			if($this->needdate)
			{
				$r1 = $this->hints['needdate'];
				$r2 = '';

				$currh = date("H",$line['date']);
				$currmin = date("i",$line['date']);
				$currd = date("d",$line['date']);
				$currm = date("m",$line['date']);
				$curry = date("Y",$line['date']);

				if($this->needdatetime)
				{
					$r2.= '<select name="hours">';
					for($i=0;$i<=23;$i++)
					  if($i==$currh) $r2.= '<option selected>'.$i.'</option>';
					  else $r2.= '<option>'.$i.'</option>';
					$r2.= '</select>:';
	
					$r2.= '<select name="minutes">';
					for($i=0;$i<=59;$i++)
					  if($i==$currmin) $r2.= '<option selected>'.$i.'</option>';
					  else $r2.= '<option>'.$i.'</option>';
					$r2.= '</select>&nbsp;&nbsp;&nbsp;';
				}

				$r2.=  '<select name="day">';
				for($i=1;$i<=31;$i++)
				  if($i==$currd) $r2.= '<option selected>'.$i.'</option>';
				  else $r2.= '<option>'.$i.'</option>';
				$r2.= '</select>';
	
				$r2.= '<select name="month">';
				for($i=1;$i<=12;$i++)
				  if($i==$currm) $r2.= '<option selected>'.$i.'</option>';
				  else $r2.= '<option>'.$i.'</option>';
				$r2.= '</select>';
	
				$r2.= '<select name="year">';
				for($i=2007;$i<=2050;$i++)
				  if($i==$curry) $r2.= '<option selected>'.$i.'</option>';
				  else $r2.= '<option>'.$i.'</option>';
				$r2.= '</select>';
	
				return $this->MakeRes($r1,'text',$r2,'html');	
			}
		}
		
		function EditUrl($line)
		{
			if($this->needurl)
			{
				$r1 = $this->hints['needurl'];
				$r2 = '';
				for($i=1;$i<=$this->maxadmlangs;$i++)
				{
					if($this->admlangs[$i])
					{
						$suffix = $this->admlangssuffix[$i];
						$r2.= '<b>'.$this->admlangstitle[$i].'</b><input type="text" name="url'.$suffix.'" value="'.htmlspecialchars($line['url'.$suffix]).'"style="width:'.$this->inputtextwidth.'px;"> ';
					}
				}

				return $this->MakeRes($r1,'text',$r2,'html');
			}
		}
		
		function EditSeo($line)
		{
			if($this->needseo)
			{
				$r1 = $this->hints['needseo'];
				$r2 = '';
				for($i=1;$i<=$this->maxadmlangs;$i++)
				{
					if($this->admlangs[$i])
					{
						$suffix = $this->admlangssuffix[$i];
						$r2.= '<b>'.$this->admlangstitle[$i].'</b><input type="text" name="seo'.$suffix.'" value="'.htmlspecialchars($line['seo'.$suffix]).'"style="width:'.$this->inputtextwidth.'px;"> ';
					}
				}

				return $this->MakeRes($r1,'text',$r2,'html');
			}
		}
		
		function EditGallery($line)
		{
			$ret = Array();
			
			if($this->isgallery)
			{
				$r1 = $this->hints['editgallery'];
//				$r2 = uploadify($this->id,'smfotor',1);
				$r2 = uploadify($this->id,$this->gallerypics,$this->gallerypics_tablename);
				$ret = $this->MakeRes($r1,'text',$r2,'html');
			}
			
			return $ret;
		}

		function EditImages($line)
		{
			$resarr = Array();
			
			if($this->needpic)
			{
				//print_r($this->pics);
				
				foreach($this->pics AS $key1=>$value1)
				{
					$ar = $value1['params'];
					
					$r1 = $value1['title'];
					$r2 = '';
					

					//echo '<tr valign="top"><td width="200"><b>'.($value1['title']).':</b></td><td><input type="file" name="userfile'.$key1.'"><br>';

					$r2.= '<input type="file" name="userfile'.$key1.'"><br>';
					$fname = '';

					$picprefix = $ar[0]['picprefix'];
					//echo $picprefix;

					if(is_file($picprefix.$this->id.'.jpg')) $fname = $picprefix.$this->id.'.jpg';
					if(is_file($picprefix.$this->id.'.gif')) $fname = $picprefix.$this->id.'.gif';
					if(is_file($picprefix.$this->id.'.png')) $fname = $picprefix.$this->id.'.png';
		
					if($fname!='') $r2.= '<a href="admin.php?act='.$this->moduleact.'&subact=editdeepmenu&id='.$this->id.'&delfoto='.$key1.'">'.$this->adm->DrawIcon('del').'</a><br><img src="'.$fname.'">';
					
					$resarr[] =  $this->MakeRes($r1,'text',$r2,'html');
				}
				
				return Array('type'=>'multiline', 'value'=>$resarr);
			}
		}
		
		function EditFiles($line)
		{
			//отображение форм загрузки файлов

			$resarr = Array();
			
			foreach($this->files AS $key=>$fileparams)
			{
				$r1 = $fileparams['title'];
				$r2 = '';
			
				$ii = $key;
				
				$r2.= '<input type="file" name="menufile'.$ii.'"><br>';
				$fname = '';
				if(is_file($fileparams['fileprefix'].$this->id.'_'.$ii.'.tmp')) $fname = $fileparams['fileprefix'].$this->id.'_'.$ii.'.tmp';

				if($fname!='') $r2.= '<a href="admin.php?act='.$this->moduleact.'&subact=editdeepmenu&id='.$this->id.'&delfile='.$ii.'">'.$this->adm->DrawIcon('del').'</a><br><br><a href="admingetfile.php?filename='.$fname.'&tablename='.$this->tablename.'&id='.$this->id.'&filenumber='.$ii.'">'.$this->hints[''].' '.htmlspecialchars($line['filename'.$ii]).'</a>';
				
				$resarr[] = $this->MakeRes($r1,'text',$r2,'html'); 
			}

			return Array('type'=>'multiline', 'value'=>$resarr);
		}

		function EditShortText($line)
		{
			$resarr = Array();
			if($this->needshorttext)
			{
				for($i=1;$i<=$this->maxadmlangs;$i++)
				{
					if($this->admlangs[$i])
					{
						$suffix = $this->admlangssuffix[$i];

						$r1 = $this->hints['needshorttext'].$this->admlangstitle[$i].':';
					   
					    $r2 = '';
						
						if($this->shorttext_type=='fck')
						{
							$r2.= ShowFCK('shorttext'.$suffix , $line['shorttext'.$suffix]);
						}
						else if($this->shorttext_type=='textarea')
						{
							$r2.= '<textarea name="shorttext'.$suffix.'" rows="8" style="width:'.$this->textareawidth.'px;">'.htmlspecialchars($line['shorttext'.$suffix]).'</textarea>';
						}
						else if($this->shorttext_type=='input')
						{
							$r2.= '<input type="text" name="shorttext'.$suffix.'" style="width:'.$this->inputtextwidth.'px;" value="'.htmlspecialchars($line['shorttext'.$suffix]).'" >';
						}

						$resarr[] =  $this->MakeRes($r1,'text',$r2,'html');
					}
				}
				
			}
			return Array('type'=>'multiline', 'value'=>$resarr);
		}
		
		function EditText($line)
		{
			$resarr = Array();
			if($this->needtext)
			{
				for($i=1;$i<=$this->maxadmlangs;$i++)
				{
					if($this->admlangs[$i])
					{
						$suffix = $this->admlangssuffix[$i];

						$r1 = $this->hints['needtext'].$this->admlangstitle[$i].':';
					    $r2 = '';
						
						
						if($this->text_type=='fck')
						{
							$r2.= ShowFCK('text'.$suffix , $line['text'.$suffix]);
						}
						else if($this->text_type=='textarea')
						{
							$r2.= '<textarea name="text'.$suffix.'" rows="8" style="width:'.$this->textareawidth.'px;">'.htmlspecialchars($line['text'.$suffix]).'</textarea>';
						}
						else if($this->text_type=='input')
						{
							$r2.= '<input type="text" name="text'.$suffix.'" style="width:'.$this->inputtextwidth.'px;" value="'.htmlspecialchars($line['text'.$suffix]).'" >';
						}
						
						$resarr[] =  $this->MakeRes($r1,'text',$r2,'html');
					}
				}
			}
			return Array('type'=>'multiline', 'value'=>$resarr);
		}
		
		function EditText2($line)
		{
			$resarr = Array();
			if($this->needtext2)
			{
				for($i=1;$i<=$this->maxadmlangs;$i++)
				{
					if($this->admlangs[$i])
					{
						$suffix = $this->admlangssuffix[$i];

						$r1 = $this->hints['needtext2'].$this->admlangstitle[$i].':';
					    $r2 = '';
						
						if($this->text2_type=='fck')
						{
							$r2.= ShowFCK('text2'.$suffix , $line['text2'.$suffix]);
						}
						else if($this->text2_type=='textarea')
						{
							$r2.=  '<textarea name="text2'.$suffix.'" rows="8" style="width:'.$this->textareawidth.'px;">'.htmlspecialchars($line['text2'.$suffix]).'</textarea>';
						}
						else if($this->text2_type=='input')
						{
							$r2.=  '<input type="text" name="text2'.$suffix.'" style="width:'.$this->inputtextwidth.'px;" value="'.htmlspecialchars($line['text2'.$suffix]).'" >';
						}
						
						$resarr[] = $this->MakeRes($r1,'text',$r2,'html'); 
					}
				}
			}
			return Array('type'=>'multiline', 'value'=>$resarr);
			
		}
		
		function EditParams($line)
		{
			$resarr = Array();
			if($this->paramnumber>0)
			{
				$r1 = $this->hints['addparams'];
				$r2 = '';
				
				for($j=1;$j<=$this->paramnumber;$j++)
				{
					for($i=1;$i<=$this->maxadmlangs;$i++)
					{
						if($this->admlangs[$i])
						{
							$suffix = $this->admlangssuffix[$i];
							
							$r2 .= $this->admlangstitle[$i].'
							<input type="text" name="paramname'.$j.$suffix.'" value="'.htmlspecialchars($line['paramname'.$j.$suffix]).'"style="width:'.$this->inputtextwidth.'px;">
							<input type="text" name="paramvalue'.$j.$suffix.'" value="'.htmlspecialchars($line['paramvalue'.$j.$suffix]).'"style="width:'.$this->inputtextwidth.'px;">
							<br/>
							';
						}
					}
					$r2.='<br/>';
				}

				$resarr = $this->MakeRes($r1,'text',$r2,'html');
			}
			return $resarr;
		}

		function EditSpec($line)
		{
			$resarr = Array();
			if($this->needspec1)
			{
				$r1 = $this->hints['spec1'];
				$r2 = '<input type="checkbox" name="spec1" id="spec1"'; if($line['spec1']==1) $r2.=' checked '; $r2.= ' value="1">';
				
				$resarr[] = $this->MakeRes($r1,'text',$r2,'html');
			}

			if($this->needspec2)
			{
				$r1 = $this->hints['spec2'];
				$r2 = '<input type="checkbox" name="spec2" id="spec2"'; if($line['spec2']==1) $r2.=' checked '; $r2.= ' value="1">';

				$resarr[] = $this->MakeRes($r1,'text',$r2,'html');
			}

			if($this->needspec3)
			{
				$r1 = $this->hints['spec3'];
				$r2 = '<input type="checkbox" name="spec3" id="spec3"'; if($line['spec3']==1) $r2.=' checked '; $r2.= ' value="1">';

				$resarr[] = $this->MakeRes($r1,'text',$r2,'html');
			}
			
			return Array('type'=>'multiline', 'value'=>$resarr);
			
		}

		function EditKeywords($line)
		{
		
			$resarr = Array();
			
			if($this->needkeywords)
			{
				for($i=1;$i<=$this->maxadmlangs;$i++)
				{
					if($this->admlangs[$i])
					{
						$suffix = $this->admlangssuffix[$i];

						$r1 = $this->hints['needkeywords'].$this->admlangstitle[$i];
						$r2 = '';
						$resarr[] = $this->MakeRes($r1,'text',$r2,'html');

						$r1 = 'TITLE:';
						$r2 = '<input type="text" size="100" name="titletitle'.$suffix.'" value="'.htmlspecialchars($line['titletitle'.$suffix]).'">';
						$resarr[] = $this->MakeRes($r1,'text',$r2,'html');

						$r1 = 'DESCRIPTION:';
						$r2 = '<input type="text" size="100" name="titledescription'.$suffix.'" value="'.htmlspecialchars($line['titledescription'.$suffix]).'">';
						$resarr[] = $this->MakeRes($r1,'text',$r2,'html');
						
						$r1 = 'KEYWORDS:';
						$r2 = '<input type="text" size="100" name="titlekeywords'.$suffix.'" value="'.htmlspecialchars($line['titlekeywords'.$suffix]).'">';
						$resarr[] = $this->MakeRes($r1,'text',$r2,'html');

						$r1 = 'META:';
						$r2 = '<textarea name="metatags'.$suffix.'" rows="5" cols="100">'.htmlspecialchars($line['metatags'.$suffix]).'</textarea>';
						$resarr[] = $this->MakeRes($r1,'text',$r2,'html');
					}
				}
				
			}
			
			return Array('type'=>'multiline', 'value'=>$resarr);
		}

		

		function EditDeepMenu()
		{
			$navstr = MakeNavString($this->tablename,$this->id,$this->moduleact,$this->hints['maincategories']);
			echo $navstr;

			$sql = "SELECT * FROM $this->tablename WHERE id=".$this->id."";
			$res= mysql_query($sql);
			$line = mysql_fetch_array($res,MYSQL_ASSOC);

			echo '
			<form method="post" action="admin.php" enctype="multipart/form-data">
			<input type="hidden" name="MAX_FILE_SIZE" value="80000000">';
			
			echo $this->adm->DrawTableLine('table_begin','editform');
			
			echo $this->adm->DrawItem($this->EditNewParentid($line));
			echo $this->adm->DrawItem($this->EditNeedHide($line));
			echo $this->adm->DrawItem($this->EditArtikul($line));
			echo $this->adm->DrawItem($this->EditBrend($line));
			echo $this->adm->DrawItem($this->EditTitle($line));
			echo $this->adm->DrawItem($this->EditTitleh1($line));
			echo $this->adm->DrawItem($this->EditDate($line));
			echo $this->adm->DrawItem($this->EditUrl($line));
			echo $this->adm->DrawItem($this->EditSeo($line));

			echo $this->adm->DrawItem($this->EditImages($line));
			echo $this->adm->DrawItem($this->EditFiles($line));
			echo $this->adm->DrawItem($this->EditShortText($line));

			echo $this->adm->DrawItem($this->EditText($line));
			echo $this->adm->DrawItem($this->EditText2($line));

			echo $this->adm->DrawItem($this->EditParams($line));
			
			echo $this->adm->DrawItem($this->EditSpec($line));
			
			echo $this->adm->DrawItem($this->EditGallery($line));
			
			echo $this->adm->DrawItem($this->EditKeywords($line));
			
			$r1 = '';
			$r2 = '<input type="submit" value="Изменить">';
			echo $this->adm->DrawItem($this->MakeRes($r1,'html',$r2,'html'));
			
			echo $this->adm->DrawTableLine('table_end','editform');


			//$ref = '.htmlspecialchars($_SERVER['HTTP_REFERER']).'
			$ref = 'admin.php?act='.$this->moduleact.'&id='.$line['parentid'];

			echo '<input type="hidden" name="act" value="'.$this->moduleact.'">
			<input type="hidden" name="subact" value="neededitdeepmenu">
			<input type="hidden" name="id" value="'.$this->id.'">&nbsp;
			<input type="hidden" name="backurl" value="'.$ref.'">
			</form>';		
			
		}
		/////////////////////////////////////////////////////////////////////////////////

		
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
		
		function DoNone()
		{
			$navstr = MakeNavString($this->tablename,$this->id,$this->moduleact,$this->hints['maincategories']);
			echo $navstr;
			
			echo '<b>'.$this->hints['addnewitem'].'&nbsp;&nbsp;<form action="admin.php" method="post">';
			
			if($this->needartikul==true)
			{
				echo '<br/>'.$this->hints['needartikul'].'<br/><input type="text" name="artikul" style="width:'.$this->inputtextwidth.'px;"><br/><br/>'.$this->hints['title'].'<br/>';
			}
			
			
			for($i=1;$i<=$this->maxadmlangs;$i++)
			{
				if($this->admlangs[$i])
				{
					$suffix = $this->admlangssuffix[$i];
					echo $this->admlangstitle[$i].'<input type="text" name="title'.$suffix.'" style="width:'.$this->inputtextwidth.'px;"> ';
				}
			}
			
			echo '
			<input type="hidden" name="act" value="'.$this->moduleact.'">
			<input type="hidden" name="subact" value="newmenu">
			<input type="hidden" name="id" value="'.$this->id.'">&nbsp;<input type="submit" value="'.$this->hints['submitadd'].'"></form></b>';
			
			$sql = "SELECT * FROM $this->tablename WHERE parentid=".$this->id." ORDER BY $this->itemsorder LIMIT ".$this->start.",$this->itemsinpage";
			$res = mysql_query($sql);
			$nrows = mysql_num_rows($res);

			echo '<center><b>'.$this->hints['edit'].'</b></center><br>';
			
			$sqlpager = "SELECT COUNT(id) AS ccc FROM $this->tablename WHERE parentid=".$this->id."";
			PrintPagerAdmin($sqlpager,'admin.php?act='.$this->moduleact.'&id='.$this->id,$this->itemsinpage);
			
			echo '<br>';
			echo $this->adm->DrawTableLine('table_begin','noneform');
			
			$k=0;
			$level = GetDeepLevel($this->tablename,$this->id);


			while($line = mysql_fetch_array($res,MYSQL_ASSOC))
			{
				$temparr = Array();
				
					$sqltmp = "SELECT COUNT(id) AS ccc FROM $this->tablename WHERE parentid=".$this->id;
					$restmp = mysql_query($sqltmp);
					$linetmp = mysql_fetch_array($restmp,MYSQL_ASSOC);
					$ccc = $linetmp['ccc'];

					$k++;

                    if($this->needartikul==true)
                    {
                        $temparr[] = Array('type'=>'td_22', 'value'=>$this->hints['needartikul']);
						$temparr[] = Array('type'=>'td_22', 'value'=>htmlspecialchars($line['artikul']));
                    }
					
					for($i=1;$i<=$this->maxadmlangs;$i++)
					{
						if($this->admlangs[$i])
						{
							$temparr[] = Array('type'=>'td', 'value'=>htmlspecialchars($line['title'.$this->admlangssuffix[$i]]));
						
							if(trim($this->pagestr)!='')
							{
								if(trim($line['url'.$this->admlangssuffix[$i]])!='') $tempurl = trim($line['url'.$this->admlangssuffix[$i]]);
								else if(trim($line['seo'.$this->admlangssuffix[$i]])=='') $tempurl = '/'.$this->pagestr.'/'.$line['id'].$this->urllangsaddarr[$i];
								else $tempurl = '/'.$this->pagestr.'/'.$line['seo'.$this->admlangssuffix[$i]];
								
								$temparr[] = Array('type'=>'td','value'=>$tempurl);
							}
						}
					}
					
					if($line['hide']==0) $temparr[] = Array('type'=>'td_22', 'value'=>'<a href="admin.php?act='.$this->moduleact.'&id='.$this->id.'&start='.$this->start.'&makehide='.$line['id'].'">'.$this->adm->DrawIcon('on').'</a>');
					else $temparr[] = Array('type'=>'td_22', 'value'=>'<a href="admin.php?act='.$this->moduleact.'&id='.$this->id.'&start='.$this->start.'&makeshow='.$line['id'].'">'.$this->adm->DrawIcon('off').'</a>');

					
	
			
				   if($this->itemsorder=="prior DESC")
					{
						$upmove = 'movedown';
						$downmove = 'moveup';
					}
					else
					{
						$upmove = 'moveup';
						$downmove = 'movedown';
					}
					
					
					$t = '';
					if($k+$this->start==1) $t.= '&nbsp;&nbsp;&nbsp;';
					else $t.= '<A href="admin.php?act='.$this->moduleact.'&id='.$this->id.'&'.$upmove.'='.$line['prior'].'&start='.$this->start.'">'.$this->adm->DrawIcon('up').'</A>';

					$t.= '&nbsp;';

					if($k+$this->start!=$ccc) $t.= '<A  href="admin.php?act='.$this->moduleact.'&id='.$this->id.'&'.$downmove.'='.$line['prior'].'&start='.$this->start.'">'.$this->adm->DrawIcon('down').'</A>';
					$temparr[] = Array('type'=>'td_22', 'value'=>$t);
					


					if($level<$this->maxlevel) $temparr[] = Array('type'=>'td_22', 'value'=>'<A href="admin.php?act='.$this->moduleact.'&id='.$line['id'].'">'.$this->adm->DrawIcon('add').'</A>');

					$temparr[] = Array('type'=>'td_22', 'value'=>'<A  href="admin.php?act='.$this->moduleact.'&subact=editdeepmenu&id='.$line['id'].'">'.$this->adm->DrawIcon('edit').'</A>');

					if($this->iscatalog)
					{
						$temparr[] = Array('type'=>'td_22', 'value'=>'<A hideFocus href="admin.php?act=editobjects&categid='.$line['id'].'">'.$this->hints['objects'].'</A>');
					}

				$temparr[] = Array('type'=>'td_22', 'value'=>'<A href="admin.php?act='.$this->moduleact.'&id='.$this->id.'&delitem='.$line['id'].'" onclick="return confirm(\''.$this->hints['confirmdelete'].'\');">'.$this->adm->DrawIcon('del').'</A>');
			  
				$buf = $this->adm->DrawTableLine($temparr);
				echo $buf;
			  
			}

			echo $this->adm->DrawTableLine('table_end','noneform');


			$sqlpager = "SELECT COUNT(id) AS ccc FROM $this->tablename WHERE parentid=".$this->id."";
			PrintPagerAdmin($sqlpager,'admin.php?act='.$this->moduleact.'&id='.$this->id,$this->itemsinpage);
		}

		//////////////////////////////////////////////////////////////////////////////////////////////
		
		
		
		
		function DelFile()
		{
			if(isset($_REQUEST['delfile']))
			{
				$delfile = (int)$_REQUEST['delfile'];
				
				$this->DelOneFile($this->id, $delfile);
				
				$ret = $_SERVER['HTTP_REFERER'];
				echo '<script> document.location.href = "'.$ret.'"; </script>';
				exit();
				
			}
		}

		
		
		function DelFoto()
		{
			if(isset($_REQUEST['delfoto']))
			{
				$delfoto = (int)$_REQUEST['delfoto'];
				
				$this->DelOneFoto($this->id,$delfoto);

				$ret = $_SERVER['HTTP_REFERER'];
				echo '<script> document.location.href = "'.$ret.'"; </script>';
				exit();
			}
		}

		function MoveDown()
		{
			if(isset($_REQUEST['movedown']))
			{
				$movedown = (int)$_REQUEST['movedown'];
				$sql = "SELECT * FROM $this->tablename WHERE parentid=".$this->id." AND prior>=$movedown  ORDER BY prior ASC LIMIT 0,2";
				$res = mysql_query($sql);
				if(mysql_num_rows($res)==2)
				{
						$line1 = mysql_fetch_array($res,MYSQL_ASSOC);
						$line2 = mysql_fetch_array($res,MYSQL_ASSOC);
						$sql = "UPDATE $this->tablename SET `prior`=".$line1['prior']." WHERE `id`=".$line2['id'];
						mysql_query($sql);
						$sql = "UPDATE $this->tablename SET `prior`=".$line2['prior']." WHERE `id`=".$line1['id'];
						mysql_query($sql);
				}
			}
		}
		
		function MoveUp()
		{
			if(isset($_REQUEST['moveup']))
			{
				$moveup = (int)$_REQUEST['moveup'];
				$sql = "SELECT * FROM $this->tablename WHERE parentid=".$this->id." AND prior<=$moveup  ORDER BY prior DESC LIMIT 0,2";

				$res = mysql_query($sql);
				if(mysql_num_rows($res)==2)
				{
						$line1 = mysql_fetch_array($res,MYSQL_ASSOC);
						$line2 = mysql_fetch_array($res,MYSQL_ASSOC);
						$sql = "UPDATE $this->tablename SET `prior`=".$line1['prior']." WHERE `id`=".$line2['id'];
						mysql_query($sql);
						$sql = "UPDATE $this->tablename SET `prior`=".$line2['prior']." WHERE `id`=".$line1['id'];
						mysql_query($sql);
				}
			}
		}
		
		function DelItem($delitemid)
		{
			$sql = "SELECT * FROM $this->tablename WHERE parentid=$delitemid";
			$res = mysql_query($sql);
			while($line = mysql_fetch_array($res,MYSQL_ASSOC))
			{
					    $this->DelItem($line['id']);
			}


			$this->DelAllFotos($delitemid);
			$this->DelAllFiles($delitemid);
			
			if($this->iscatalog)
			{
				include_once $this->objectsmodulefile;
				
				$objmodule = new ObjectsAdminModule;
				
			
				$sql = "SELECT * FROM ".$this->objectstable." WHERE `categid`=$delitemid";
				$res = mysql_query($sql);
				while($line = mysql_fetch_array($res,MYSQL_ASSOC))
				{
					$objmodule->DelItem($line['id']);
				}
			}

			$sql = "DELETE FROM $this->tablename WHERE id=$delitemid";
			mysql_query($sql);
			
			//дописать удаление объектов каталога и фотографий галерей
		}

		function MakeShow()
		{
			if(isset($_REQUEST['makeshow']))
			{
				$sql = "UPDATE $this->tablename SET `hide`=0 WHERE id=".(int)$_REQUEST['makeshow'];
				mysql_query($sql);
			}
		}

		function MakeHide()
		{
			if(isset($_REQUEST['makehide']))
			{
				$sql = "UPDATE $this->tablename SET `hide`=1 WHERE id=".(int)$_REQUEST['makehide'];
				mysql_query($sql);
			}
		}
		////////////////////////
		
		function DoModule()
		{
			global $act,$subact,$id,$start;
			
			$this->DelFile();
			$this->DelFoto();
			$this->MoveDown();
			$this->MoveUp();
			$this->MakeShow();
			$this->MakeHide();

			if(isset($_REQUEST['delitem']))
			{
				$this->DelItem((int)$_REQUEST['delitem']);
			}
			

			if($subact=="neededitdeepmenu")
			{
				$this->NeedEditDeepMenu();
			}

			if($subact=="editdeepmenu")
			{
				$this->EditDeepMenu();

			}

			if($subact=="newmenu")
			{
				$this->NewMenu();
			}
						
			if($subact=="none")
			{
				$this->DoNone();
			}		
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