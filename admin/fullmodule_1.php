<?
    //v5.0
    if(!isset($loggedok) || $loggedok!=1) exit(); //защита от прямого вызова
	
	class FullAdminModule
	{
		var $id = 0;
		var $categid = 0;
		var $start = 0;
		var $subact = "none";
		var $act = "none";
		var $moduletype = 'standarttype'; //тип модуля standarttype, categorytype, objectstype

		//visualtype: none, input, textarea, fck, checkbox. radio, select, multiselect, image, gallery, file, date, 
	
		var $fields = Array(
			'hide' =>Array('fieldtype'=>'int', 'visualtype'=>'checkbox', 'fieldhint'=>'Не отображать пункт', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Выкл', 'disabled'=>true, ),
			'radiotest' =>Array('fieldtype'=>'int', 'visualtype'=>'radio', 'radiovalues'=>Array('4'=>'val4', '1'=>'val1', '3'=>'val3'), 'fieldhint'=>'Не отображать пункт', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Выкл', 'disabled'=>false, ),
			'artikul' =>Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Артикул', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Арт:', 'insertmode'=>true, 'width'=>'80'),

			'title' =>Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Название', 'multilang'=>true, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListTitle', 'insertmode'=>true),
			'titleh1' =>Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Заголовок H1 (Если отличается от названия)', 'multilang'=>true, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart'),
			'date' =>Array('fieldtype'=>'text', 'visualtype'=>'date', 'needtime'=>true,/*Нужно ли в выборе даты выводить выбор времени*/ 'fieldhint'=>'Дата', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Дата'),
/*
			'gallery1' =>Array('fieldtype'=>'text', 'visualtype'=>'gallery',  'fieldhint'=>'Фото', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Фото',
					'gallerypics_tablename' => 'fotor',
					'gallerypics' => Array(
								Array('picprefix'=>'../fotos/smfotor', 'w'=>300, 'h'=>200, 'mode'=>'bigsize','ext'=>'jpg'),
								Array('picprefix'=>'../fotos/fotor', 'w'=>600, 'h'=>400, 'mode'=>'bigsize','ext'=>'jpg','watermarkfile'=>'../images/water.png','watermarkpos'=>'center')
							),	

					),
*/
			'gallery1' =>Array('fieldtype'=>'text', 'visualtype'=>'gallery',  'fieldhint'=>'Фото', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Фото',
					'gallerypics_tablename' => 'fotor',
					'gallerypics' => Array(
								Array('picprefix'=>'fotos/smfotor', 'w'=>300, 'h'=>200, 'mode'=>'bigsize','ext'=>'jpg'),
								Array('picprefix'=>'fotos/fotor', 'w'=>600, 'h'=>400, 'mode'=>'bigsize','ext'=>'jpg','watermarkfile'=>'images/water.png','watermarkpos'=>'center')
							),	

					),
			
			'url' =>Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Ссылка', 'multilang'=>true, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart'),

			'file1' =>Array('fieldtype'=>'text', 'visualtype'=>'file', 'fileprefix' => '../files/fullfile',/*Префикс пути для загружаемого файла*/   'fieldhint'=>'Файл1', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Файл1'),
			'file2' =>Array('fieldtype'=>'text', 'visualtype'=>'file', 'fileprefix' => '../files/fullfile_',/*Префикс пути для загружаемого файла*/   'fieldhint'=>'Файл2', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Файл2'),
			
			'pic1' =>Array('fieldtype'=>'text', 'visualtype'=>'image', 'fieldhint'=>'Картинка-1', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Карт-1' ,
					'pics' => Array( 
							'params' => Array(
								Array('picprefix'=>'../fotos/full_sm_', 'w'=>300, 'h'=>200, 'mode'=>'bigsize','ext'=>'jpg'),
								Array('picprefix'=>'../fotos/full_bg_', 'w'=>600, 'h'=>400, 'mode'=>'bigsize','ext'=>'jpg','watermarkfile'=>'../images/water.png','watermarkpos'=>'center')
							)
						),
				      ),
			
			'pic2' =>Array('fieldtype'=>'text', 'visualtype'=>'image', 'fieldhint'=>'Картинка-2', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Карт-1' ,
					'pics' => Array( 
							'params' => Array(
								Array('picprefix'=>'../fotos/full2_sm_', 'w'=>300, 'h'=>200, 'mode'=>'bigsize','ext'=>'jpg'),
								Array('picprefix'=>'../fotos/full2_bg_', 'w'=>600, 'h'=>400, 'mode'=>'bigsize','ext'=>'jpg','watermarkfile'=>'../images/water.png','watermarkpos'=>'center')
							)
						),
				      ),
			
			'spec1' =>Array('fieldtype'=>'int', 'visualtype'=>'checkbox', 'fieldhint'=>'Спец-1', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Сп'),

			'brendid' =>Array('fieldtype'=>'int',   /*для select*/ 'visualtype'=>'select',  'selecttable'=>'topmenu', 'selecttablefield'=>'title', 'selectorderfield'=>'id ASC', 'selectmaxlevel'=>2,/*end - для select*/          'fieldhint'=>'Brend', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Категория'),
			'brendid2' =>Array('fieldtype'=>'text',   /*для select*/ 'visualtype'=>'multiselect',  'selecttable'=>'topmenu', 'selecttablefield'=>'title', 'selectorderfield'=>'id ASC', 'selectmaxlevel'=>1 ,/*end - для select*/          'fieldhint'=>'MBrend', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'МультиКатегория'),
			
			'url' =>Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Ссылка', 'multilang'=>true, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart'),
			'seo' =>Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'SEO', 'multilang'=>true, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart'),
			'price' =>Array('fieldtype'=>'double', 'visualtype'=>'input', 'fieldhint'=>'Цена', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Цена', 'width'=>'50'),
			'priceold' =>Array('fieldtype'=>'double', 'visualtype'=>'input', 'fieldhint'=>'Старая цена', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Ст. Цена', 'width'=>'50'),
			'text' =>Array('fieldtype'=>'text', 'visualtype'=>'fck', 'fieldhint'=>'Текст', 'multilang'=>true, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'sortable'=>false,/*Если не нужна сортировка по этому полю в списке*/ 'tdname'=>'Описание'),

			/*поля для продвижения*/
			'titletitle' =>Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'TITLE:', 'multilang'=>true, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart'),
			'titledescription' =>Array('fieldtype'=>'text', 'visualtype'=>'textarea', 'fieldhint'=>'DESCRIPTION:', 'multilang'=>true, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart'),
			'titlekeywords' =>Array('fieldtype'=>'text', 'visualtype'=>'textarea', 'fieldhint'=>'KEYWORDS:', 'multilang'=>true, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart'),
		);
		
		var $fields_str = 'hide, artikul,  title, radiotest, date, gallery1, file1, file2, pic1, brendid, pic2, brendid2, spec1, url, seo, price, text, titletitle, titledescription, titlekeywords';
		//var $fields_list_str = 'pic1, artikul, title, date, file1,  brendid, brendid2, text, price, spec1';
		var $fields_list_str = 'pic1, artikul, radiotest, gallery1, title, date, file1';

		////////////////////////////////////////////////////////////////////////////////
		//module settings
		var $moduleact = "editfullmodule";  //act для модуля
		var $tablename = "fullmodule"; //$par->fullmoduletable; //таблица для модуля
		

		var $pagestr = 'full'; //префикс url для модуля
		var $itemsorder = "prior ASC"; //ASC or DESC порядок сортировки пунктов в админке
		
		var $itemsinpage = 20; //количество записей на страницу

		var $maxadmlangs = 3; //количество языков

		var $urllangsaddarr = Array('','','/lang/ru','/lang/en'); //суффиксы url для языков. нулевой параметр не используется
		var $admlangstitle = Array(1=>'',2=>'(рус)',3=>'(eng)');
		var $admlangssuffix = Array(1=>'',2=>'_ru',3=>'_en');
		var $admlangs = Array(1=>true,2=>false,3=>false);
		
		
		var $maxlevel = 3; // Максимальное количество уровней вложености
		var $candelete = true; //Может ли администратор удалять пункты модуля
	
		
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
		//var $isgallery = false;
		//var $gallerypics_tablename = '';
		//var $gallerypics = Array();
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

		
		//Массив с описанием файлов. Оставить пустым если файлов не нужно: var $files = Array()
		//var $files = Array();
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


		//?????????????????????????????????????????????????????
		var $iscatalog = false;
		var $objectsmodulefile = ""; // var $objectsmodulefile = "editobjects.php"; путь к файлу с класом объектов категории
		var $objectstable = ""; // таблица объектов категории
		
		//в базе данных в таблице объектов есть поля для этого блока. Для других таблиц при надобности добавить поля
		var $paramnumber = 0; //0 - если не используется
		
		
		
		
		var $hints = Array(
		'editgallery'=>'Фото:',
		'needshorttext'=>'Короткое описание ',
		'addparams'=>'Дополнительные параметры:',
		'objects'=>'ОБЪЕКТЫ',
		'addnewitem'=>'Добавить новый пункт:',
		'title'=>'Название',
		'submitadd'=>'Добавить',
		'download'=>'Скачать:',
		'maincategories'=>'Главные категории',
		'edit'=>'Редактировать',
		'confirmdelete'=>'Вы действительно хотите удалить???',
		
		);
		//?????????????????????????????????????????????????????

		
		var $par;
		var $adm;
				

		function AlterDBField($fieldname,$fieldtype)
		{
			$sqltmp = "SHOW COLUMNS FROM $this->tablename WHERE `Field` = '$fieldname'";
			$restmp = mysql_query($sqltmp);
			if(mysql_num_rows($restmp)==0)
			{
				$sqltmp = "ALTER TABLE $this->tablename ADD `$fieldname` $fieldtype NOT NULL ;";
				//echo $sqltmp.'<BR>';
				mysql_query($sqltmp);
			}
		}
		
		function AlterDBFields($fstr)
		{
			$a = explode(',' , $fstr);
			for($p=0;$p<count($a);$p++)
			{
				$field_key = trim($a[$p]);
				if($field_key!='')
				{
					$field_value = $this->fields[$field_key];
					$fieldtype = $field_value['fieldtype'];
					//echo "F=$field_key<BR>";
						
					if($field_value['multilang']==true)
					{
						for($i=1;$i<=$this->maxadmlangs;$i++)
						{
							if($this->admlangs[$i])
							{
								$suffix = $this->admlangssuffix[$i];
								$this->AlterDBField($field_key.$suffix,$fieldtype);
							}
						}
					}
					else
					{
						$this->AlterDBField($field_key,$fieldtype);
					}
				}
			}
		}
		
		function ReturnOptions($tablename,$tablefield,$sortorder,$parentid,$currarr,$maxlevel,$level=0)
		{
			$s = '';
			$shift = ''; for($i=1;$i<=$level*3;$i++) $shift.='&nbsp;';

			$sqltmp = "SELECT * FROM $tablename WHERE parentid=$parentid ORDER BY $sortorder ";
			$restmp = mysql_query($sqltmp);
			while($linetmp = mysql_fetch_array($restmp,MYSQL_ASSOC))
			{
				$s.='<option value="'.$linetmp['id'].'" '.(in_array($linetmp['id'],$currarr)?' selected ':'').'>'.$shift.htmlspecialchars($linetmp[$tablefield]).'</option>';
				if($level<$maxlevel-1) $s.=$this->ReturnOptions($tablename,$tablefield,$sortorder,$linetmp['id'],$currarr,$maxlevel,$level+1);
			}
			return $s;
		}
		
		function MakeNavString($tablename,$id,$categid,$moduleact,$navtitle='Главные категории',$reclevel=0)
		{
			if($reclevel>10) return;
			//echo "S=$tablename,$id,$categid,$moduleact,$navtitle<BR>";
			//echo "RL=$reclevel<BR>";
			//echo "T=$this->cattablename<BR>";
			
			$navstr = '';
			
/*			if($tablename=='`objects`' && $id==0)
			{
				$navstr = $this->MakeNavString($this->cattablename, $categid, 0, $this->catmoduleact,$navtitle,$reclevel+1);
			}
			else
*/			
			{
				$pid = $id;
				$k = 0;
				$navstr = '';
				while($pid != 0)
				{
					$k++; if($k>10) break; //против зацикливаний при сбоях структуры базы
		    
					$sql = "SELECT * FROM $tablename WHERE id=$pid";
					//echo $sql.'<BR>';
					$res = mysql_query($sql);
					if($line = mysql_fetch_array($res,MYSQL_ASSOC))
					{
						if($reclevel+$k==1) $url = '';
						else $url = ' href="admin.php?act='.$moduleact.'&id='.$pid.'&categid='.$categid.'" ';
						
						if($reclevel==1 && $k==1) $url = ' href="admin.php?act='.$this->moduleact.'&id=0&categid='.$pid.' "';
						
						if(isset($line['title'])) $navstr = ' -> <a '.$url.'>'.htmlspecialchars($line['title']).'</a> '. $navstr;
						$pid = $line['parentid'];
					}
				}
				
				//$navstr = '<a href="admin.php?act='.$moduleact.'">'.htmlspecialchars($navtitle).'</a> '.$navstr;
				
				if($this->moduletype=='objectstype' && $reclevel==0)
				{
					$navstr = $this->MakeNavString($this->cattablename, $categid, 0, $this->catmoduleact,$navtitle,$reclevel+1).$navstr;
				}
				else
				{
					$navstr = '<a href="admin.php?act='.$moduleact.'">'.htmlspecialchars($navtitle).'</a> '.$navstr;
				}

				//$navstr = '<center><h2>'.$navstr.'</h2></center>';
			}
			return $navstr;
		}

		
		//Метод вывода кнопки "включить/выключить" в таблице записей
		function CommandButtonHide($line,$ccc,$k,$level)
		{
			$temparr = Array();
			if($line['hide']==0) $temparr[] = Array('type'=>'td_22', 'value'=>'<a href="admin.php?act='.$this->moduleact.'&id='.$this->id.'&categid='.$this->categid.'&start='.$this->start.'&makehide='.$line['id'].'">'.$this->adm->DrawIcon('on').'</a>');
			else $temparr[] = Array('type'=>'td_22', 'value'=>'<a href="admin.php?act='.$this->moduleact.'&id='.$this->id.'&categid='.$this->categid.'&start='.$this->start.'&makeshow='.$line['id'].'">'.$this->adm->DrawIcon('off').'</a>');
			return $temparr;
		}

		//Метод вывода стрелок смены приоритета в таблице записей
		function CommandButtonMove($line,$ccc,$k,$level)
		{
			$temparr = Array();
			
			if(!isset($_SESSION['sortorder:'.$this->moduleact]) ) $sortable = true;
			else if(trim($_SESSION['sortorder:'.$this->moduleact])=='') $sortable = true;
			else $sortable = false;
			

			if($sortable)
			{
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
				else $t.= '<A href="admin.php?act='.$this->moduleact.'&id='.$this->id.'&categid='.$this->categid.'&'.$upmove.'='.$line['prior'].'&start='.$this->start.'">'.$this->adm->DrawIcon('up').'</A>';
	
				$t.= '&nbsp;';
	
				if($k+$this->start!=$ccc) $t.= '<A  href="admin.php?act='.$this->moduleact.'&id='.$this->id.'&categid='.$this->categid.'&'.$downmove.'='.$line['prior'].'&start='.$this->start.'">'.$this->adm->DrawIcon('down').'</A>';
				$temparr[] = Array('type'=>'td_22', 'value'=>$t);
			}
			return $temparr;
		}
		
		//Метод вывода кнопки "редактировать подпункты" в таблице записей
		function CommandButtonAdd($line,$ccc,$k,$level)
		{
			$temparr = Array();
			if($level<$this->maxlevel) $temparr[] = Array('type'=>'td_22', 'value'=>'<A href="admin.php?act='.$this->moduleact.'&id='.$line['id'].'&categid='.$this->categid.'">'.$this->adm->DrawIcon('add').'</A>');
			return $temparr;
		}

		//Метод вывода кнопки "редактировать подпункты" в таблице записей
		function CommandButtonEdit($line,$ccc,$k,$level)
		{
			$temparr = Array();
			$temparr[] = Array('type'=>'td_22', 'value'=>'<A  href="admin.php?act='.$this->moduleact.'&subact=editdeepmenu&id='.$line['id'].'&categid='.$this->categid.'">'.$this->adm->DrawIcon('edit').'</A>');
			return $temparr;
		}

		//Метод вывода кнопки "ОБЪЕКТЫ" в таблице записей
		function CommandButtonCatalog($line,$ccc,$k,$level)
		{
			$temparr = Array();
			if($this->moduletype=='catalogtype')
			{
				$temparr[] = Array('type'=>'td_22', 'value'=>'<A hideFocus href="admin.php?act='.$this->editobjectsact.'&categid='.$line['id'].'">'.$this->hints['objects'].'</A>');
			}
			return $temparr;
		}

		//Метод вывода кнопки "удалить" в таблице записей
		function CommandButtonDel($line,$ccc,$k,$level)
		{
			$temparr = Array();
			if($this->candelete)
			{
				$temparr[] = Array('type'=>'td_22', 'value'=>'<A href="admin.php?act='.$this->moduleact.'&id='.$this->id.'&categid='.$this->categid.'&delitem='.$line['id'].'" onclick="return confirm(\''.$this->hints['confirmdelete'].'\');">'.$this->adm->DrawIcon('del').'</A>');
			}
			return $temparr;
		}


		
		//Метод вывода управляющих кнопок в таблице пунктов: удаление, редактировани...
		function CommandButtons($line,$ccc,$k,$level)
		{
			$temparr = Array();
			
			$temparr = array_merge($temparr, $this->CommandButtonHide($line,$ccc,$k,$level));
			$temparr = array_merge($temparr, $this->CommandButtonMove($line,$ccc,$k,$level));
			$temparr = array_merge($temparr, $this->CommandButtonAdd($line,$ccc,$k,$level));
			$temparr = array_merge($temparr, $this->CommandButtonEdit($line,$ccc,$k,$level));
			$temparr = array_merge($temparr, $this->CommandButtonCatalog($line,$ccc,$k,$level));
			$temparr = array_merge($temparr, $this->CommandButtonDel($line,$ccc,$k,$level));
				
			return $temparr;
		}
		
		function GetFieldValue($line,$fieldname,$fieldtype)
		{
			//echo "F=$fieldname<BR>";
			//echo '<pre>'.print_r($line,true).'</pre>';
			if($line==null) return '';
			if(isset($line[$fieldname])) return $line[$fieldname];
			else
			{
				$sql = "ALTER TABLE $this->tablename ADD `$fieldname` $fieldtype NOT NULL ;";
				//echo $sql.'<BR>';
				mysql_query($sql);
				return '';
			}
		}

		function Block1($obj, $line, $field_key, $field_value,$suffix,$langname)
		{
			$width = $this->inputtextwidth;
			if(isset($field_value['width'])) $width = $field_value['width'];
			
			$fieldname = $field_key.$suffix;
			
			if(isset($field_value['disabled']) && $field_value['disabled']==true) $disstr = ' disabled="true" '; else $disstr = '';
			
			$r1 = $field_value['fieldhint'].$langname.':';
			$r2 = '';

			if($field_value['visualtype']=='none')
			{
					return Array();
			}
			else if($field_value['visualtype']=='fck')
			{
				$r2.= ShowFCK($fieldname , $obj->GetFieldValue($line,$fieldname,$field_value['fieldtype']));
			}
			else if($field_value['visualtype']=='textarea')
			{
				$r2.= '<textarea '.$disstr.' name="'.$fieldname.'" rows="8" style="width:'.$width.'px;">'.htmlspecialchars($obj->GetFieldValue($line,$fieldname,$field_value['fieldtype'])).'</textarea>';
			}
			else if($field_value['visualtype']=='input')
			{
				$r2.= '<input type="text" name="'.$fieldname.'" style="width:'.$width.'px;" value="'.htmlspecialchars($obj->GetFieldValue($line,$fieldname,$field_value['fieldtype'])).'" '.$disstr.'>';
				
				if(isset($field_value['disabled']) && $field_value['disabled']==true)
				{
					$r2 = htmlspecialchars($obj->GetFieldValue($line,$fieldname,$field_value['fieldtype']));
				}
				
			}
			else if($field_value['visualtype']=='checkbox')
			{
				$c = $obj->GetFieldValue($line,$fieldname,$field_value['fieldtype']);
				$s = $c==1?' checked ':'';
				$r2.= '<input type="checkbox" name="'.$fieldname.'" value="1" '.$s.' '.$disstr.' >';
			}
			else if($field_value['visualtype']=='radio')
			{
				$radiovalues = $field_value['radiovalues'];
				$c = $obj->GetFieldValue($line,$fieldname,$field_value['fieldtype']);
				foreach($radiovalues AS $key=>$value)
				{
					$r2.='<input type="radio" name="'.$fieldname.'" value="'.$key.'" '.($c==$key?' checked ':'').'> '.$value.'<br/>';
				}
			}
			else if($field_value['visualtype']=='select')
			{
				$currarr = Array();
				$currarr[] = $obj->GetFieldValue($line,$fieldname,$field_value['fieldtype']);
				$r2 = '<select name="'.$fieldname.'" style="width:'.$width.'px;" '.$disstr.' ><option value="0"></option>';
				$r2.=$this->ReturnOptions($field_value['selecttable'], $field_value['selecttablefield'], $field_value['selectorderfield'], 0, $currarr,$field_value['selectmaxlevel'], 0);
				$r2.= '</select>';
			}
			else if($field_value['visualtype']=='multiselect')
			{
				$currarr = explode(':',$obj->GetFieldValue($line,$fieldname,$field_value['fieldtype']));
				$r2 = '<select multiple name="'.$fieldname.'[]" '.$disstr.' style="width:'.$width.'px;">';
				$r2.=$this->ReturnOptions($field_value['selecttable'], $field_value['selecttablefield'], $field_value['selectorderfield'], 0, $currarr,$field_value['selectmaxlevel'], 0);
/*				
				$sqltmp = "SELECT * FROM ".$field_value['selecttable']." ORDER BY ".$field_value['selectorderfield'];
				$restmp = mysql_query($sqltmp);
				while($linetmp = mysql_fetch_array($restmp,MYSQL_ASSOC))
				{
					$r2.='<option value="'.$linetmp['id'].'" '.(in_array($linetmp['id'],$currarr)?' selected ':'').'>'.htmlspecialchars($linetmp[$field_value['selecttablefield']]).'</option>';
				}
*/
				$r2.= '</select>';
			}
			else if($field_value['visualtype']=='date')
			{
				$r2 = '';

				$currh = date("H",$line['date']);
				$currmin = date("i",$line['date']);
				$currd = date("d",$line['date']);
				$currm = date("m",$line['date']);
				$curry = date("Y",$line['date']);

				if(isset($field_value['needtime']) && $field_value['needtime']==true)
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
				
				if(isset($field_value['disabled']) && $field_value['disabled']==true)
				{
					$r2 = date("d.m.Y");
					if(isset($field_value['needtime']) && $field_value['needtime']==true)
					{
						$r2 .= date(" H:i");
					}
				}
			}
			else if($field_value['visualtype']=='image')
			{
				$key1 = $field_key;
				$value1 = $field_value['pics'];
				//foreach($this->pics AS $key1=>$value1)
				{
					$ar = $value1['params'];
					
					$r1 = $field_value['fieldhint'];
					$r2 = '';
					
					$r2.= '<input type="file" name="userfile'.$key1.'"><br>';
					$fname = '';

					$picprefix = $ar[0]['picprefix'];
					//echo $picprefix;
					
					if(isset($ar[0]['idmode']) && $ar[0]['idmode']=='withoutid')
					{
					}
					else
					{
						$picprefix.=$this->id;
					}
					
					if(is_file($picprefix.'.jpg')) $fname = $picprefix.'.jpg';
					if(is_file($picprefix.'.gif')) $fname = $picprefix.'.gif';
					if(is_file($picprefix.'.png')) $fname = $picprefix.'.png';
		
					//////////////////////////////////!!!!!!!!!!!!!!!!!!1
					if($fname!='') $r2.= '<a href="admin.php?act='.$this->moduleact.'&subact=editdeepmenu&id='.$this->id.'&categid='.$this->categid.'&delfoto='.$key1.'">'.$this->adm->DrawIcon('del').'</a><br><img src="'.$fname.'?rand='.rand(1,1000).'">';
					
				}
			}
			else if($field_value['visualtype']=='file')
			{
				$r1 = $field_value['fieldhint'];
				$r2 = '';
				
				$ii = $field_key;
					
				$r2.= '<input type="file" name="menufile'.$ii.'"><br>';
				$fname = '';
				if(is_file($field_value['fileprefix'].$this->id.'.tmp')) $fname = $field_value['fileprefix'].$this->id.'.tmp';
	
				if($fname!='') $r2.= '<a href="admin.php?act='.$this->moduleact.'&subact=editdeepmenu&id='.$this->id.'&categid='.$this->categid.'&delfile='.$ii.'">'.$this->adm->DrawIcon('del').'</a><br><br><a href="admingetfile.php?filename='.$fname.'&tablename='.$this->tablename.'&id='.$this->id.'&filefield='.$ii.'">'.$field_value['fieldhint'].' '.htmlspecialchars($line[$field_key]).'</a>';
			}
			else if($field_value['visualtype']=='gallery')
			{
				$r1 = $field_value['fieldhint'];
//				$r2 = uploadify($this->id,'smfotor',1);

				$r2 = uploadify($this->id,
						$field_value['gallerypics'],
						$field_value['gallerypics_tablename']);
			}			
			
			
			//$resarr[] =  $obj->MakeRes($r1,'text',$r2,'html');
			return $obj->MakeRes($r1,'text',$r2,'html');
			
		}
			
		function MetodFormStandart($field_key,$field_value,$line)
		{
			//echo '<pre>'.print_r($field_key,true).'</pre>';
			//echo '<pre>'.print_r($field_value,true).'</pre>';
			
			
			$fieldtype = $field_value['fieldtype'];
			
			$resarr = Array();
			

			
			if($field_value['multilang']==true)
			{
				for($i=1;$i<=$this->maxadmlangs;$i++)
				{
					if($this->admlangs[$i])
					{
						$suffix = $this->admlangssuffix[$i];
						$langname = $this->admlangstitle[$i];
						$resarr[] = $this->Block1($this,$line, $field_key, $field_value,$suffix,$langname);
					}
				}
			}
			else
			{
				$resarr[] = $this->Block1($this,$line, $field_key, $field_value,'','');
			}
			
			return Array('type'=>'multiline', 'value'=>$resarr);
		}
		
		
		function GetLangByValue($needle,$searchmode,$mode='')
		{
			//$searchmode  по чому шукати, суфікс, урл...
			$key = array_search($needle,$this->admlangssuffix);
			$a = Array(
				'urllangsadd'=>$this->urllangsaddarr[$key],
				'admlangstitle'=>$this->admlangstitle[$key],
				'admlangssuffix'=>$this->admlangssuffix[$key],
				'admlangs'=>$key,
			);
			
			if($mode=='') return $a;
			if($mode=='urllangsadd') return $a['urllangsadd'];
			if($mode=='admlangstitle') return $a['admlangstitle'];
			if($mode=='admlangssuffix') return $a['admlangssuffix'];
			if($mode=='admlangs') return $a['admlangs'];
			return '';
		}
		

		function __construct()
		{
			$this->id = $GLOBALS['id'];
			$this->categid = $GLOBALS['categid'];
			$this->start = $GLOBALS['start'];
			$this->act = $GLOBALS['act'];
			$this->subact = $GLOBALS['subact'];
			
			$registry = & Registry::getInstance();
			$this->par = $registry->get('par');
			$this->adm = $registry->get('adm');
			
			if(isset($_SESSION['sortorder:'.$this->moduleact])) $this->itemsorder = addslashes($_SESSION['sortorder:'.$this->moduleact]); 
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

			$value1 = $this->fields[$delfoto];
			foreach($value1['pics']['params'] AS $key2=>$value2)
			{
				$picprefix = $value2['picprefix'];
				
				if(isset($value2['idmode']) && $value2['idmode']=='withoutid')
				{
				}
				else
				{
					$picprefix.=$itemid;
				}

				for($i=0;$i<count($tempextarr);$i++)
				{
					if(trim($tempextarr[$i])!='')
					{
						$ext = $tempextarr[$i];
						if(is_file($picprefix.'.'.$ext)) @unlink($picprefix.'.'.$ext);
					}
				}
			}
		}
		
		function DelOneGallery($itemid, $delfoto)
		{
			$value1 = $this->fields[$delfoto];
			$gallerypics_tablename = $value1['gallerypics_tablename'];
			
			$sql = "SELECT * FROM ".$gallerypics_tablename." WHERE `reportid`=".$itemid;
			$res = mysql_query($sql);
			while($line = mysql_fetch_array($res,MYSQL_ASSOC))
			{
				$tid = $line['id'];
				
				foreach($value1['gallerypics'] AS $galleryitem)
				{
					$fname = $galleryitem['picprefix'].$tid.'.'.$galleryitem['ext'];
					if(is_file($fname)) @unlink($fname);
				}
				
				$sql = "DELETE FROM ".$gallerypics_tablename." WHERE id=$tid";
				mysql_query($sql);
				
			}
		}
		
		function DelAllFotos($itemid)
		{
			foreach($this->fields AS $key1=>$value1)
			{
				if($value1['visualtype']=='image') $this->DelOneFoto($itemid,$key1);
			}
		}
		
		
		function DelAllGallery($itemid)
		{
			foreach($this->fields AS $key1=>$value1)
			{
				if($value1['visualtype']=='gallery') $this->DelOneGallery($itemid,$key1);
			}
		}
		
		
		function DelOneFile($itemid,$delfile)
		{
			$fileprefix = $this->fields[$delfile]['fileprefix'];
			if(is_file($fileprefix.$itemid.'.tmp')) @unlink($fileprefix.$itemid.'.tmp');
			
			$sql = "UPDATE $this->tablename SET `$delfile`='' WHERE id=$itemid";
			mysql_query($sql);
		}
		
		function DelAllFiles($itemid)
		{
			foreach($this->fields AS $key1=>$value1)
			{
				if($value1['visualtype']=='file') $this->DelOneFile($itemid,$key1);
			}
		}

		///////////////metods for NeedEditDeepMenu metod//////////////////////////////////////

		///////////////End of metods for NeedEditDeepMenu metod//////////////////////////////////////
		
		
		function MetodEditStandart($field_key)
		{
			$t = '';
			
			if(isset($this->fields[$field_key]['disabled']) && $this->fields[$field_key]['disabled']==true)
			{
				return;
			}
			
			if(isset($this->fields[$field_key]['visualtype']) && $this->fields[$field_key]['visualtype']=='none')
			{
				return;
			}
			else if(isset($this->fields[$field_key]['visualtype']) && $this->fields[$field_key]['visualtype']=='date')
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
			else if(isset($this->fields[$field_key]['visualtype']) && $this->fields[$field_key]['visualtype']=='multiselect')
			{
				$t = '';
				if(isset($_REQUEST[$field_key]))
				{
					foreach($_REQUEST[$field_key] AS $key=>$value)
					{
						if($t=='') $t.=$value;
						else $t.=':'.$value;
					}
				}
				$sql = "UPDATE $this->tablename SET `$field_key`='$t' WHERE id=$this->id";
				mysql_query($sql);
			}
			else if(isset($this->fields[$field_key]['visualtype']) && $this->fields[$field_key]['visualtype']=='image')
			{
				$lastid = $this->id;
	
				$key1 = $field_key;
				$value1 = $this->fields[$field_key]['pics'];
				//foreach($this->pics AS $key1=>$value1)
				{
					$ii = $key1;
					if(isset($_FILES['userfile'.$ii]['tmp_name']) && $_FILES['userfile'.$ii]['tmp_name']!="")
					{
						$tmpname = $_FILES['userfile'.$ii]['tmp_name'];
						$t = addslashes($_FILES['userfile'.$ii]['name']);
						
						foreach($value1['params'] AS $key2=>$value2)
						{
							$picprefix = $value2['picprefix'];
							
							if(isset($value2['idmode']) && $value2['idmode']=='withoutid')
							{
								
							}
							else
							{
								$picprefix.=$lastid;
								
							}
	
							$tempextarr = $this->picsextarr;
							for($tt=0;$tt<count($tempextarr);$tt++)
							{
								if(trim($tempextarr[$tt])!='')
								{
									$tempext = $tempextarr[$tt];
									//if(is_file($picprefix.$lastid.'.'.$tempext)) @unlink($picprefix.$lastid.'.'.$tempext);
									if(is_file($picprefix.'.'.$tempext)) @unlink($picprefix.'.'.$tempext);
								}
							}
							
						}
	
						foreach($value1['params'] AS $key2=>$value2)
						{
							$picprefix = $value2['picprefix'];
							if(isset($value2['idmode']) && $value2['idmode']=='withoutid')
							{
								
							}
							else
							{
								$picprefix.=$lastid;
								
							}							
							$ext = $value2['ext'];
							//$newname = $picprefix.$lastid.'.'.$ext;
							$newname = $picprefix.'.'.$ext;
							
							
							//винести в метод
							$this->CreateAdminPicMethod($value2['mode'],$tmpname,$newname,$value2['w'],$value2['h']);
							
							if(isset($value2['watermarkfile']))
							{
								put_watermark($newname,$newname,$value2['watermarkpos'],100,$value2['watermarkfile']);
							}
							
						}
						$sql = "UPDATE $this->tablename SET `$field_key`='$t' WHERE id=$this->id";
						mysql_query($sql);
						
					}			
				}				
			}
			else if(isset($this->fields[$field_key]['visualtype']) && $this->fields[$field_key]['visualtype']=='file')
			{
				$ii = $field_key;
				if(isset($_FILES['menufile'.$ii]['tmp_name']) && $_FILES['menufile'.$ii]['tmp_name']!="")
				{
					$filename = $_FILES['menufile'.$ii]['name'];

					$tmpname = $_FILES['menufile'.$ii]['tmp_name'];
					$newname = $this->fields[$field_key]['fileprefix'].$this->id.'.tmp';
					if(is_file($newname)) @unlink($newname);

					copy($tmpname,$newname);
					
					$sql = "UPDATE $this->tablename SET `$field_key` = '".addslashes($filename)."' WHERE id=".$this->id."";
					mysql_query($sql);
				}
			}
			else
			{
				if(isset($_REQUEST[$field_key])) $t = myaddslashes($_REQUEST[$field_key]); else $t = '';
				$sql = "UPDATE $this->tablename SET `$field_key`='$t' WHERE id=$this->id";
				mysql_query($sql);
			}
		}
		
		function NeedEditDeepMenu()
		{
			//echo '<pre>'.print_r($_REQUEST,true).'</pre>';
			
			$currtime = time();
			$sqltmp = "UPDATE $this->tablename SET `modifydate`=$currtime WHERE id=$this->id";
			mysql_query($sqltmp);
			
			$a = explode(',' , $this->fields_str );
			for($p=0;$p<count($a);$p++)
			{
				$field_key = trim($a[$p]);
				//echo "F=$field_key<BR>";
				if($field_key!='')
				{
					$field_value = $this->fields[$field_key];
					$field_metod = $field_value['metodedit'];
					//$field_metod = 'UpdateField';
					//echo $this->adm->DrawItem($this->MetodFormStandart($field_key,$field_value,$line));
					
					if($field_value['multilang']==true)
					{
						for($i=1;$i<=$this->maxadmlangs;$i++)
						{
							if($this->admlangs[$i])
							{
								$suffix = $this->admlangssuffix[$i];
								$this->$field_metod($field_key.$suffix);
							}
						}
					}
					else
					{
						$this->$field_metod($field_key);
					}
				}
			}
			
			
			echo '<script> document.location.href = "'.$_REQUEST['backurl'].'";</script>';
			exit();
							
		}
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			
			
		///////////////metods for EditDeepMenu metod///////////////////////////////////////////////////////
		

		function EditDeepMenu()
		{
			//дописать для модуля объекты!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! вывод навигационной строки
			$navstr = $this->MakeNavString($this->tablename,$this->id,$this->categid,$this->moduleact,$this->hints['maincategories']);
			echo "<center><h2>".$navstr."</h2></center>";

			$sql = "SELECT * FROM $this->tablename WHERE id=".$this->id."";
			$res= mysql_query($sql);
			$line = mysql_fetch_array($res,MYSQL_ASSOC);

			echo '
			<form method="post" action="admin.php" enctype="multipart/form-data">
			<input type="hidden" name="MAX_FILE_SIZE" value="80000000">';
			
			echo $this->adm->DrawTableLine('table_begin','editform');
			
			$a = explode(',' , $this->fields_str );
			for($i=0;$i<count($a);$i++)
			{
				$field_key = trim($a[$i]);
				if($field_key!='')
				{
					$field_value = $this->fields[$field_key];
					$field_metod = $field_value['metod'];
					//echo $this->adm->DrawItem($this->MetodFormStandart($field_key,$field_value,$line));
					echo $this->adm->DrawItem($this->$field_metod($field_key,$field_value,$line));
				}
			}
			

			$r1 = '';
			$r2 = '<input type="submit" value="Изменить">';
			echo $this->adm->DrawItem($this->MakeRes($r1,'html',$r2,'html'));
			
			echo $this->adm->DrawTableLine('table_end','editform');


			//$ref = htmlspecialchars($_SERVER['HTTP_REFERER']);
			$ref = 'admin.php?act='.$this->moduleact.'&id='.$line['parentid'].'&categid='.$this->categid.'&start='.$this->start;

			echo '<input type="hidden" name="act" value="'.$this->moduleact.'">
			<input type="hidden" name="subact" value="neededitdeepmenu">
			<input type="hidden" name="id" value="'.$this->id.'">
			<input type="hidden" name="categid" value="'.$this->categid.'">
			<input type="hidden" name="backurl" value="'.$ref.'">
			</form>';		
			
		}
		/////////////////////////////////////////////////////////////////////////////////

		
		function NewMenu()
		{
			$categid = $this->categid;
			
			$currtime = time();
//			$sql = "INSERT INTO $this->tablename SET `date`=$currtime, `hide`=".$this->defaulthide.", `title`='$title', `title_ru`='$title_ru', `title_en`='$title_en', `parentid`=".$this->id."";
			$sql = "INSERT INTO $this->tablename SET `date`=$currtime, `modifydate`=$currtime, `hide`=".$this->defaulthide.", `categid`=".$categid.", `parentid`=".$this->id."";
			mysql_query($sql);

			$lastid = mysql_insert_id();
			$this->id = $lastid;

			$sql = "UPDATE $this->tablename SET `prior`=$lastid WHERE `id`=$lastid";
			mysql_query($sql);

			$a = explode(',' , $this->fields_str );
			for($p=0;$p<count($a);$p++)
			{
				$field_key = trim($a[$p]);
				if($field_key!='')
				{
					$field_value = $this->fields[$field_key];
					if(isset($field_value['insertmode']) && $field_value['insertmode']==true)
					{
						//echo "F=$field_key<BR>";
						$field_metod = $field_value['metodedit'];
						
						if($field_value['multilang']==true)
						{
							for($i=1;$i<=$this->maxadmlangs;$i++)
							{
								if($this->admlangs[$i])
								{
									$suffix = $this->admlangssuffix[$i];
									$this->$field_metod($field_key.$suffix);
								}
							}
						}
						else
						{
							$this->$field_metod($field_key);
						}
					}
				}
			}

			$ret = $_SERVER['HTTP_REFERER'];
			//echo '<script> document.location.href = "admin.php?act='.$this->moduleact.'&id='.$this->id.'";</script>';
			echo '<script> document.location.href = "'.$ret.'";</script>';
			exit();
		}
		
		function MetodListStandart($field_key,$field_value,$suffix,$line)
		{
			$width = $this->inputtextwidth;
			if(isset($field_value['width'])) $width = $field_value['width'];
			
			$lang = '';
			if($field_value['multilang']==true) $lang = ' '.$this->GetLangByValue($suffix,'suffix',$mode='admlangstitle');
			
			$tdname = '';
			if(isset($field_value['tdname'])) $tdname = $field_value['tdname'].$lang;
			
			$sorturl = '';
			if(!isset($field_value['sortable']) || $field_value['sortable']==true) $sorturl = 'work.php?act=changesortorder&moduleact='.$this->moduleact.'&sortfield='.$field_key.$suffix;
			
			$ascdesc = '';
			if(isset($_SESSION['sortorder:'.$this->moduleact]) && $_SESSION['sortorder:'.$this->moduleact]==$field_key) $ascdesc = 'asc';
			if(isset($_SESSION['sortorder:'.$this->moduleact]) && $_SESSION['sortorder:'.$this->moduleact]==$field_key." DESC ") $ascdesc = 'desc';
			
			$value = '';
			if($field_value['visualtype']=='none')
			{
			}
			else if($field_value['visualtype']=='radio')
			{
				$radiovalues = $field_value['radiovalues'];
				$c = $this->GetFieldValue($line,$field_key,$field_value['fieldtype']);
				if(isset($radiovalues[$c])) $value = $radiovalues[$c];
			}
			else if($field_value['visualtype']=='checkbox')
			{
				//$value = $line[$field_key.$suffix];
				$value = $this->GetFieldValue($line,$field_key.$suffix,$field_value['fieldtype']);
			}
			else if($field_value['visualtype']=='date')
			{
				if($field_value['needtime']==true) $value = date("d.m.Y H:i",$this->GetFieldValue($line,$field_key.$suffix,$field_value['fieldtype']));
				else $value = date("d.m.Y",$this->GetFieldValue($line,$field_key.$suffix,$field_value['fieldtype']));
			}
			else if($field_value['visualtype']=='select')
			{
				$tid = (int)$line[$field_key.$suffix];
				
				
				//***********************************
				if(isset($field_value['listeditable']) && $field_value['listeditable']==true)
				{
					global $__tabindex__;
					if(isset($__tabindex__)) $tabindex++;
					else $tabindex = 1;
					$t = str_replace('`','',$this->tablename);
					$t2 = '__edit__::' .$t.'::'. $field_key . '::' . $line['id'];
					
					$currarr = Array( );
					$currarr[] = $this->GetFieldValue($line,$field_key,$field_value['fieldtype']);
					$value .= '<select class="listeditablefield" name="'.$t2.'" style="width:'.$width.'px;" id="'.$t2.'"  style="width:'.$width.'px; "><option value="0"></option>';
					$value .=$this->ReturnOptions($field_value['selecttable'], $field_value['selecttablefield'], $field_value['selectorderfield'], 0, $currarr,$field_value['selectmaxlevel'], 0);
					$value .= '</select>';
				}
				else
				{
					$sqltmp = "SELECT * FROM ".$field_value['selecttable']." WHERE id=".$tid;
					$restmp = mysql_query($sqltmp);
					if($linetmp = mysql_fetch_array($restmp,MYSQL_ASSOC))
					{
						$value = htmlspecialchars($linetmp[$field_value['selecttablefield']]);
					}
				}
			}
			else if($field_value['visualtype']=='multiselect')
			{
				$t = '';
				$tid = str_replace(':',',',$line[$field_key.$suffix]);
				if(trim($tid)!='')
				{
					$sqltmp = "SELECT * FROM ".$field_value['selecttable']." WHERE id IN (".$tid.")";
					$restmp = mysql_query($sqltmp);
					while($linetmp = mysql_fetch_array($restmp,MYSQL_ASSOC))
					{
						$value .= htmlspecialchars($linetmp[$field_value['selecttablefield']]).' ';
					}
				}
			}
			else if($field_value['visualtype']=='image')
			{
				$key1 = $field_key;
				$value1 = $field_value['pics'];
				$ar = $value1['params'];
				
				$value = '';
				
				$fname = '';

				$picprefix = $ar[0]['picprefix'];
				//echo $picprefix;

				if(is_file($picprefix.$line['id'].'.jpg')) $fname = $picprefix.$line['id'].'.jpg';
				if(is_file($picprefix.$line['id'].'.gif')) $fname = $picprefix.$line['id'].'.gif';
				if(is_file($picprefix.$line['id'].'.png')) $fname = $picprefix.$line['id'].'.png';
	
				//////////////////////////////////!!!!!!!!!!!!!!!!!!1
				if($fname!='') $value.= '<img src="'.$fname.'?rand='.rand(1,1000).'" style="max-width:100px; max-height:100px;">';
			}
			else if($field_value['visualtype']=='gallery')
			{
				$key1 = $field_key;
				//$value1 = $field_value['gallery'];
				$t = $field_value['gallerypics_tablename'];

				$sqltmp = "SELECT * FROM $t WHERE `reportid`=".$line['id']." ORDER BY prior DESC LIMIT 0,1";
				$restmp = mysql_query($sqltmp);
				if($linetmp = mysql_fetch_array($restmp,MYSQL_ASSOC))
				{
					$ar = $field_value['gallerypics'];
					
					$value = '';
					
					$fname = '';
	
					$picprefix = $ar[0]['picprefix'];
					//echo $picprefix;
	
					if(is_file($picprefix.$linetmp['id'].'.jpg')) $fname = $picprefix.$linetmp['id'].'.jpg';
					if(is_file($picprefix.$linetmp['id'].'.gif')) $fname = $picprefix.$linetmp['id'].'.gif';
					if(is_file($picprefix.$linetmp['id'].'.png')) $fname = $picprefix.$linetmp['id'].'.png';
					
					if($fname!='') $value.= '<center><img src="'.$fname.'?rand='.rand(1,1000).'" style="max-width:75px; max-height:75px; "></center>';
				}

			}
			else if($field_value['visualtype']=='file')
			{
				$ii = $field_key;
					
				$fname = '';
				if(is_file($field_value['fileprefix'].$line['id'].'.tmp')) $fname = $field_value['fileprefix'].$line['id'].'.tmp';
	
				if($fname!='') $value.= '<a href="admingetfile.php?filename='.$fname.'&tablename='.$this->tablename.'&id='.$line['id'].'&filefield='.$ii.'">'.htmlspecialchars($line[$field_key]).'</a>';
			}
			else if($field_value['visualtype']=='input')
			{
				if(isset($field_value['listeditable']) && $field_value['listeditable']==true)
				{
					global $__tabindex__;
					if(isset($__tabindex__)) $tabindex++;
					else $tabindex = 1;
					$t = str_replace('`','',$this->tablename);
					$t2 = '__edit__::' .$t.'::'. $field_key . '::' . $line['id'];
					$value = '<input class="listeditablefield" tabindex="'.$line['id'].'" type="text" id="'.$t2.'"  name="'.$t2.'" value="' . htmlspecialchars($this->GetFieldValue($line,$field_key.$suffix,$field_value['fieldtype'])) . '" style="width:'.$width.'px;">';
				}
				else
				{
					$value = htmlspecialchars($this->GetFieldValue($line,$field_key.$suffix,$field_value['fieldtype']));
				}
			}
			else
			{
				//$value = htmlspecialchars($line[$field_key.$suffix]);
				
				$value = htmlspecialchars($this->GetFieldValue($line,$field_key.$suffix,$field_value['fieldtype']));
			}

			$a = Array('type'=>'td', 'value'=>$value, 'tdname'=>$tdname, 'sorturl'=>$sorturl, 'ascdesc'=>$ascdesc);
			//asdfsdasdfdf
			if(isset($field_value['listeditable']) && $field_value['listeditable']==true)
			{
				$a['listeditable'] = 'true';
			}
			return Array($a);

		}
		
		function MetodListTitle($field_key,$field_value,$suffix,$line)
		{
			$lang = '';
			if($field_value['multilang']==true) $lang = ' '.$this->GetLangByValue($suffix,'suffix',$mode='admlangstitle');
			
			$tdname = '';
			if(isset($field_value['tdname'])) $tdname = $field_value['tdname'].$lang;

			$tdname = 'Название'.$lang;
			if(isset($field_value['tdname'])) $tdname = $field_value['tdname'].$lang;
			
			$sorturl = '';
			if(!isset($field_value['sortable']) || $field_value['sortable']==true) $sorturl = 'work.php?act=changesortorder&moduleact='.$this->moduleact.'&sortfield='.$field_key.$suffix;
			
			$ascdesc = '';
			if(isset($_SESSION['sortorder:'.$this->moduleact]) && $_SESSION['sortorder:'.$this->moduleact]==$field_key) $ascdesc = 'asc';
			if(isset($_SESSION['sortorder:'.$this->moduleact]) && $_SESSION['sortorder:'.$this->moduleact]==$field_key." DESC ") $ascdesc = 'desc';
			

			$t = Array(
				Array('type'=>'td', 'value'=>htmlspecialchars($line[$field_key.$suffix]), 'tdname'=>$tdname, 'sorturl'=>$sorturl, 'ascdesc'=>$ascdesc),
				//Array('type'=>'td', 'value'=>htmlspecialchars($line['url'.$suffix])),
			);

			//$tdname = 'Ссылка'.$lang;
			$tdname = '';
			if(isset($this->pagestr) && trim($this->pagestr)!='')
			{
				if(trim($line['url'.$suffix])!='') $tempurl = trim($line['url'.$suffix]);
				else if( isset($line['seo'.$suffix]) && trim($line['seo'.$suffix])=='') $tempurl = '/'.$this->pagestr.'/'.$line['id'].$this->GetLangByValue($suffix,'suffix','urllangsadd');
				else
				{
					if($line['seo'.$suffix][0]=='/') $tempurl = $line['seo'.$suffix];
					else $tempurl = '/'.$this->pagestr.'/'.$line['seo'.$suffix];
				}
				
				if($tempurl!='') $tempurl = '<a href="'.$tempurl.'" target="_blank">'.$tempurl.'</a>';
				
				$t = array_merge( $t, Array( Array('type'=>'td','value'=>$tempurl, 'tdname'=>$tdname), ) );
				//echo '<pre>'.htmlspecialchars(print_r($t,true)).'</pre>';
			}
			return $t;
		}

		function DoNone()
		{
			//Дописати для editobjects рядок навігації!!!!!!!!!!!!!!!!!
			$navstr = $this->MakeNavString($this->tablename,$this->id,$this->categid,$this->moduleact,$this->hints['maincategories']);
			echo "<center><h2>".$navstr."</h2></center>";



			echo '
			<form method="post" action="admin.php" enctype="multipart/form-data">
			<input type="hidden" name="MAX_FILE_SIZE" value="80000000">';
			
			echo $this->adm->DrawTableLine('table_begin','editform');
			
			$needbuttonadd = false; //нужно ли кнопку "добавить"

			$a = explode(',' , $this->fields_str );
			for($i=0;$i<count($a);$i++)
			{
				$field_key = trim($a[$i]);
				if($field_key!='')
				{
					$field_value = $this->fields[$field_key];
					if(isset($field_value['insertmode']) && $field_value['insertmode']==true)
					{
						$needbuttonadd = true;
						$field_metod = $field_value['metod'];
						//echo $this->adm->DrawItem($this->MetodFormStandart($field_key,$field_value,$line));
						echo $this->adm->DrawItem($this->$field_metod($field_key,$field_value,null));
					}
				}
			}
			
			$r1 = '';
			$r2 = '
			<input type="hidden" name="act" value="'.$this->moduleact.'">
			<input type="hidden" name="subact" value="newmenu">

			<input type="hidden" name="id" value="'.$this->id.'">
			<input type="hidden" name="categid" value="'.$this->categid.'">&nbsp;';
			
			///
			if($needbuttonadd) $r2.= '<input type="submit" value="'.$this->hints['submitadd'].'">';

			echo $this->adm->DrawItem($this->MakeRes($r1,'html',$r2,'html'));

			echo $this->adm->DrawTableLine('table_end','editform');

			if(isset($_SESSION['sortorder:'.$this->moduleact])) echo '<a href="work.php?act=changesortorder&moduleact='.$this->moduleact.'&sortfield=">Сбросить сортировку</a><br>';
			
			//дописати щоб можна було вибрати всі незалежно від parentdi , categid
			$sql = "SELECT * FROM $this->tablename WHERE parentid=".$this->id." AND categid=".$this->categid." ORDER BY $this->itemsorder LIMIT ".$this->start.",$this->itemsinpage";
			//echo $sql.'<BR>';
			$res = mysql_query($sql);
			$nrows = mysql_num_rows($res);

			echo '<center><b>'.$this->hints['edit'].'</b></center><br>';
			
			$sqlpager = "SELECT COUNT(id) AS ccc FROM $this->tablename WHERE parentid=".$this->id." AND categid=".$this->categid;
			PrintPagerAdmin($sqlpager,'admin.php?act='.$this->moduleact.'&id='.$this->id.'&categid='.$this->categid,$this->itemsinpage);
			
			echo '<br>';
			echo $this->adm->DrawTableLine('table_begin','noneform');
			
			$k=0;
			$level = GetDeepLevel($this->tablename,$this->id);


			unset($temparr); $buf = '';
			$temparr = Array();

			while($line = mysql_fetch_array($res,MYSQL_ASSOC))
			{
				$temparr = Array();
				
				$sqltmp = "SELECT COUNT(id) AS ccc FROM $this->tablename WHERE parentid=".$this->id." AND categid=".$this->categid;
				$restmp = mysql_query($sqltmp);
				$linetmp = mysql_fetch_array($restmp,MYSQL_ASSOC);
				$ccc = $linetmp['ccc'];

				$k++;

				$a = explode(',' , $this->fields_list_str );
				for($p=0;$p<count($a);$p++)
				{
					$field_key = trim($a[$p]);
					if($field_key!='')
					{
						$field_value = $this->fields[$field_key];
						$field_metod = $field_value['metodlist'];
						//echo $this->adm->DrawItem($this->DoStandart1($field_key,$field_value,$line));
						
						if($field_value['multilang']==true)
						{
							for($i=1;$i<=$this->maxadmlangs;$i++)
							{
								if($this->admlangs[$i])
								{
									$suffix = $this->admlangssuffix[$i];
									$temparr = array_merge($temparr, $this->$field_metod($field_key,$field_value,$suffix,$line) );
								}
							}
						}
						else
						{
							$temparr = array_merge($temparr, $this->$field_metod($field_key,$field_value,'',$line) );
						}
					}
				}
				$temparr = array_merge($temparr, $this->CommandButtons($line,$ccc,$k,$level) );

				$buf .= $this->adm->DrawTableLine($temparr);
			}

			$buf_header = $this->adm->DrawTableHeader($temparr);

			echo $buf_header;
			echo $buf;
			echo $buf_header;
			

			echo $this->adm->DrawTableLine('table_end','noneform');


			$sqlpager = "SELECT COUNT(id) AS ccc FROM $this->tablename WHERE parentid=".$this->id." AND categid=".$this->categid;
			PrintPagerAdmin($sqlpager,'admin.php?act='.$this->moduleact.'&id='.$this->id.'&categid='.$this->categid,$this->itemsinpage);
		}

		//////////////////////////////////////////////////////////////////////////////////////////////
		
		
		
		
		function DelFile()
		{
			if(isset($_REQUEST['delfile']))
			{
				$delfile = addslashes($_REQUEST['delfile']);
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
				$delfoto = $_REQUEST['delfoto'];
				
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
				$sql = "SELECT * FROM $this->tablename WHERE parentid=".$this->id." AND categid=".$this->categid." AND prior>=$movedown  ORDER BY prior ASC LIMIT 0,2";

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
				$sql = "SELECT * FROM $this->tablename WHERE parentid=".$this->id." AND categid=".$this->categid." AND prior<=$moveup  ORDER BY prior DESC LIMIT 0,2";

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
			$this->DelAllGallery($delitemid);
			$this->DelAllFiles($delitemid);
			
			if($this->moduletype=='catalogtype')
			{
				include_once $this->objectsmodulefile;
				
				$objmodule = new $this->objectsclassname;
				
			
				$sql = "SELECT * FROM ".$this->objectstable." WHERE `categid`=$delitemid";
				$res = mysql_query($sql);
				while($line = mysql_fetch_array($res,MYSQL_ASSOC))
				{
					$objmodule->DelItem($line['id']);
				}
			}

			$sql = "DELETE FROM $this->tablename WHERE id=$delitemid";
			mysql_query($sql);
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
			
			//Если в базе нет каких либо новых полей - добавляем их автоматически
			$this->AlterDBFields($this->fields_str);
			$this->AlterDBFields($this->fields_list_str);
			
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