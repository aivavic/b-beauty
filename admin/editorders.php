<?
    //защита от прямого вызова
    if ( !defined('_we_are_from_admin_') )
    {
        exit();
    }

	class OrdersAdminModule Extends FullAdminModule
	{
		var $moduleact = "editorders";  //act для модуля
		var $tablename = ""; //таблицу переопределить в конструкторе
		
		var $fields_str = 'email, name, address, phone, allsum, orderstatus, text, ordertext, ';
		var $fields_list_str = 'email, name, allsum, phone,text, orderstr, orderstatus';
		
		var $pagestr = ''; //префикс url для модуля
		var $maxlevel = 1;
		
		function __construct()
		{
			global $par;
			$this->tablename  = $par->orderstable;

			$this->fields['userid'] = Array('fieldtype'=>'int', 'visualtype'=>'input', 'fieldhint'=>'userid', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'userid', );
			
			$this->fields['email'] = Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'E-mail', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'E-mail', 'insertmode'=>true, );
			$this->fields['name'] = Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Имя', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Имя', 'insertmode'=>true, );
			$this->fields['address'] = Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Адрес', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Адрес', 'insertmode'=>true, );
			$this->fields['phone'] = Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Телефон', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Телефон', 'insertmode'=>true, );

			$this->fields['text'] = Array('fieldtype'=>'text', 'visualtype'=>'textarea', 'fieldhint'=>'Текст', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Текст',  );
			$this->fields['ordertext'] = Array('fieldtype'=>'text', 'visualtype'=>'none', 'fieldhint'=>'Описание заказа', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Заказ', );

			$this->fields['orderstr'] = Array('fieldtype'=>'text', 'visualtype'=>'none', 'fieldhint'=>'Описание заказа', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListOrderStr', 'tdname'=>'Заказ', );

			$this->fields['allsum'] = Array('fieldtype'=>'double', 'visualtype'=>'input', 'fieldhint'=>'Сумма', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Сумма', );
			//$this->fields['orderstatus'] = Array('fieldtype'=>'int', 'visualtype'=>'input', 'fieldhint'=>'Статус', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Статус', );
			$this->fields['orderstatus'] = Array('fieldtype'=>'int', 'visualtype'=>'select', 'selecttable'=>'orderstatuses', 'selecttablefield'=>'title', 'selectorderfield'=>'id ASC', 'selectmaxlevel'=>1, 'fieldhint'=>'Статус', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStatus', 'tdname'=>'Статус', 'listeditable'=>true, 'width'=>150, 'list_td_width'=>150, );
			
			parent::__construct();
		}
		
		function MetodListStatus($field_key,$field_value,$suffix,$line)
		{
		    global $par;
		    
		    $width = $this->inputtextwidth;
		    if(isset($field_value['width'])) $width = $field_value['width'];
		    
		    $lang = '';
		    if($field_value['multilang']==true) $lang = ' '.$this->GetLangByValue($suffix,'suffix',$mode='admlangstitle');
		    
		    $tdname = '';
		    if(isset($field_value['tdname'])) $tdname = $field_value['tdname'].$lang;
		    
		    $sorturl = '';
		    if(!isset($field_value['sortable']) || $field_value['sortable']==true) $sorturl = 'workadmin.php?act=changesortorder&moduleact='.$this->moduleact.'&sortfield='.$field_key.$suffix;
		    
		    $ascdesc = '';
		    if(isset($_SESSION['sortorder:'.$this->moduleact]) && $_SESSION['sortorder:'.$this->moduleact]==$field_key) $ascdesc = 'asc';
		    if(isset($_SESSION['sortorder:'.$this->moduleact]) && $_SESSION['sortorder:'.$this->moduleact]==$field_key." DESC ") $ascdesc = 'desc';
		    
		    $value = '';
		    
			if($field_value['visualtype']=='select')
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

		    $a = Array('type'=>'td', 'value'=>$value, 'tdname'=>$tdname, 'sorturl'=>$sorturl, 'ascdesc'=>$ascdesc, );
		    //asdfsdasdfdf
		    if(isset($field_value['list_td_width']))
		    {
			    $a['list_td_width'] = $field_value['list_td_width'];
		    }
		    
		    $a['td_color'] = GetStatusColor($line[$field_key]);
		    if(isset($field_value['listeditable']) && $field_value['listeditable']==true)
		    {
			    $a['listeditable'] = 'true';
		    }
		    return Array($a);
		    
		
		}
			
		function MetodListOrderStr($field_key,$field_value,$suffix,$line)
		{
//			$a = Array('type'=>'td', 'value'=>$value, 'tdname'=>$tdname, 'sorturl'=>$sorturl, 'ascdesc'=>$ascdesc);
			
			$tdname = '';
			if(isset($field_value['tdname'])) $tdname = $field_value['tdname'];
			
			$sorturl = '';

			$value = '';
			//$value .= htmlspecialchars($this->GetFieldValue($line,$field_key.$suffix,$field_value['fieldtype']));
			$orderarr = GetOrderInfo($line['id'],$line);
			
			
			$value.= '<a href="ordertoxls.php?id='.$line['id'].'" title="Импорт в Excel">'.$this->adm->DrawIcon('xls',' width="32" ').'</a>';

			$value.= '
			<style>
			    .admin_order_table .admin_order_table th, .admin_order_table td { border:1px solid #c7c7c7; border-collapse:collapse; padding:0px; }
			</style>
			';
			
			$value.='<table class="admin_order_table">';
			$value.='<tr><td>Фото</td><td>(ID)</td><td>АРТ</td><td>Товар</td><td>Размер</td><td>Цена</td><td>К-во</td><td>Сумма</td></tr>';
			foreach($orderarr['products'] AS $key=>$oneproduct)
			{
			    if(isset($oneproduct['isdeleted']))
			    {
                    $oneproduct['id'] = ' ';
                    $oneproduct['artikul'] = ' ';
                    $oneproduct['fname'] = '';
                    $oneproduct['url'] = '';
                    $oneproduct['title'] = 'Товар удален из базы';
                    $oneproduct['id'] = '';
			    }
			    else
			    {
				$addstr = GetAddStr(100,75,$oneproduct['fname']);
			    }
			    
			    $resprice = $oneproduct['_order_value'] * $oneproduct['_order_price'];
			    
			    $value.='
			    <tr>
				<td>'.($oneproduct['fname']=='' ? ' ' : '<a href="'.$oneproduct['url'].'"><img src="'.$oneproduct['fname'].'" '.$addstr.'></a>').'</td>
				<td>'.$oneproduct['id'].'</td>
				<td>'.htmlspecialchars($oneproduct['artikul']).'</td>
				<td><a '.($oneproduct['url']=='' ? ' ' : ' href="'.$oneproduct['url'].'"').'>'.$oneproduct['title'].'</a></td>
                <td>'.$oneproduct['_order_size'].'</td>
				<td>'.$oneproduct['_order_price'].'</td>
				<td>'.$oneproduct['_order_value'].'</td>
				<td>'.PriceToStr($resprice).'</td>
			    </tr>
			    ';
			}
			$value.='</table>';
			$a = Array('type'=>'td', 'value'=>$value, 'tdname'=>$tdname, 'sorturl'=>$sorturl, );
			return Array($a);
		    
		}
	}
	
    ////////////////////////////////////////////////////////////////////////////////    
    if($act=="editorders")
    {
		$module = new OrdersAdminModule;
		$module->DoModule();
    }	
	
?>