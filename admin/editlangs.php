<?
    //защита от прямого вызова
    if ( !defined('_we_are_from_admin_') )
    {
        exit();
    }

	class LangsAdminModule Extends FullAdminModule
	{
		var $moduleact = "editlangs";  //act для модуля
		var $tablename = ""; //таблицу переопределить в конструкторе
		
		var $fields_str = 'key, title';
		var $fields_list_str = 'key, title';
		
		var $pagestr = ''; //префикс url для модуля
		var $maxlevel = 1;
		var $defaulthide = 0;
		
	
		
		function __construct()
		{
			global $par;
			$this->tablename  = $par->langstable;
			
			$this->fields['title']['fieldhint'] = 'Значение';
			
			
			$this->fields = array_merge($this->fields,
							Array(
							    'key' =>Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'key', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'insertmode'=>true),
							)
						   );


			parent::__construct();
		}
	}
	
    ////////////////////////////////////////////////////////////////////////////////    
    if($act=="editlangs")
    {
		$module = new LangsAdminModule;
		$module->DoModule();
    }	
	
?>