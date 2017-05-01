<?
    //защита от прямого вызова
    if ( !defined('_we_are_from_admin_') )
    {
        exit();
    }

	class Vars_ContactsAdminModule Extends FullAdminModule
	{
		var $moduleact = "editvars_contacts";  //act для модуля
		var $tablename = ""; //таблицу переопределить в конструкторе
		
		var $fields_str = 'formtitle,formcaption,map';
		var $fields_list_str = 'formtitle';
		
		var $pagestr = ''; //префикс url для модуля
		var $maxlevel = 1;
                var $candelete = false;
		
	
		
		function __construct()
		{
			global $par;
			$this->tablename  = $par->varstable;
			
			
			$this->fields['formtitle'] = Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Заголовок формы', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', );
			$this->fields['formcaption'] = Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Текст под формой', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', );
			$this->fields['map'] = Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Ссылка на карту', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', );

			parent::__construct();
		}
	}
	
    ////////////////////////////////////////////////////////////////////////////////    
    if($act=="editvars_contacts")
    {
		$module = new Vars_ContactsAdminModule;
		$module->DoModule();
    }	
	
?>