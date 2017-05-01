<?
    //защита от прямого вызова
    if ( !defined('_we_are_from_admin_') )
    {
        exit();
    }

	class ObjectsAdminModule Extends FullAdminModule
	{
		var $moduletype = 'objectstype'; //тип модуля товары - он относится к каталогу
		
		var $moduleact = "editobjects";  //act для модуля
		var $tablename = ""; //таблицу переопределить в конструкторе

		var $cattablename = ""; //таблица для категорий - определить в конструкторе
		var $catmoduleact = "editcat"; //act для модуля категорий
		
		var $fields_str = 'categid,otzivlink,spec1,artikul, title, titleh1, seo, spec2,brendid, price, priceold,razmer, gallery1, text, titletitle, titlekeywords, titledescription ';
		var $fields_list_str = 'artikul, gallery1, title, price';
		
		var $pagestr = 'tovar'; //префикс url для модуля
		var $maxlevel = 1;
		
		function MetodFormLinkOtziv($field_key,$field_value,$line)
		{
		    $r1 = 'Отзывы объекта';
		    $r2 = '<a href="admin.php?act=editcomments&categid='.$this->id.'">смотреть</a>';
		    
		    $resarr = Array();
		    $resarr[] = $this->MakeRes($r1,'text',$r2,'html');
		    return Array('type'=>'multiline', 'value'=>$resarr);
		}
        function MetodListSpecial($field_key,$field_value,$suffix,$line)
        {
            global $par;

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
            if($field_value['visualtype']=='gallery')
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
                    //echo $picprefix."<br>";

                    if(is_file($par->document_root.'/fotos/'.$linetmp['filename'].'.jpg')) $fname = 'fotos/'.$linetmp['filename'].'.jpg';
                    if(is_file($par->document_root.'/fotos'.$linetmp['filename'].'.gif')) $fname = 'fotos/'.$linetmp['filename'].'.gif';
                    if(is_file($par->document_root.'/fotos'.$linetmp['filename'].'.png')) $fname = 'fotos/'.$linetmp['filename'].'.png';

                    if($fname!='') $value.= '<center><img src="/'.$fname.'?rand='.rand(1,1000).'" style="max-width:75px; max-height:75px; "></center>';
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
		
		function __construct()
		{
			global $par;
			$this->tablename  = $par->objectstable;
			$this->cattablename  = $par->categorytable;

			$this->fields['gallery1'] = Array('fieldtype'=>'text', 'visualtype'=>'gallery',  'fieldhint'=>'Фото', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListSpecial', 'tdname'=>'Фото',
					'gallerypics_tablename' => 'fotorobj',
					'gallerypics' => Array(
								Array('picprefix'=>'fotos/object_sm_', 'w'=>231, 'h'=>231, 'mode'=>'bigsize','ext'=>'jpg'),								
								Array('picprefix'=>'fotos/object_bg_', 'w'=>600, 'h'=>600, 'mode'=>'bigsize','ext'=>'jpg',/*'watermarkfile'=>'../images/water.png','watermarkpos'=>'center'*/)
							),	
					);
            $this->fields['razmer'] = Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Резмеры(через ";")', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListTitle', 'insertmode'=>false);
			$this->fields['spec1'] = Array('fieldtype'=>'int', 'visualtype'=>'checkbox', 'fieldhint'=>'В начало на главной', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Нов');
			$this->fields['spec2'] = Array('fieldtype'=>'int', 'visualtype'=>'checkbox', 'fieldhint'=>'В наличии', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'В наличии');
			$this->fields['spec3'] = Array('fieldtype'=>'int', 'visualtype'=>'checkbox', 'fieldhint'=>'Акция', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Акц');
			
			$this->fields['otzivlink'] = Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Артикул', 'multilang'=>false, 'metod'=>'MetodFormLinkOtziv', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Арт:', 'insertmode'=>false);

			//$this->fields['artikul']['listeditable'] = true;
			$this->fields['price']['listeditable'] = true;

            $this->fields['categid'] = Array('fieldtype'=>'text',   /*для select*/ 'visualtype'=>'select',  'selecttable'=>$par->categorytable, 'selecttablefield'=>'title', 'selectorderfield'=>'prior ASC', 'selectmaxlevel'=>3 ,/*end - для select*/          'fieldhint'=>'Категория', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Категория');
			$this->fields['brendid'] = Array('fieldtype'=>'text',   /*для select*/ 'visualtype'=>'select',  'selecttable'=>$par->brandstable, 'selecttablefield'=>'name', 'selectorderfield'=>'name ASC', 'selectmaxlevel'=>2 ,/*end - для select*/          'fieldhint'=>'Бренд', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Бренд');
//            $this->fields['razmer2'] = Array('fieldtype'=>'text',   /*для select*/ 'visualtype'=>'multiselect',  'selecttable'=>$par->razmertable, 'selecttablefield'=>'razmer', 'selectorderfield'=>'razmer ASC', 'selectmaxlevel'=>2 ,/*end - для select*/          'fieldhint'=>'Размеры', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Размеры:');
					

			$this->itemsorder = "prior DESC"; //ASC or DESC порядок сортировки пунктов в админке

			parent::__construct();
		}
	}



    ////////////////////////////////////////////////////////////////////////////////    
    if($act=="editobjects")
    {
		$module = new ObjectsAdminModule;
		$module->DoModule();
    }	
	
?>