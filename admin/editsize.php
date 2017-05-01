<?
    //защита от прямого вызова
    if ( !defined('_we_are_from_admin_') )
    {
        exit();
    }

	class SizeAdminModule Extends FullAdminModule
	{
		var $moduleact = "editsize";  //act для модуля
		var $tablename = ""; //таблицу переопределить в конструкторе
		
		var $fields_str = 'razmer';
		var $fields_list_str = 'razmer';
		
		//var $pagestr = 'menu'; //префикс url для модуля
		var $maxlevel = 1;

		var $maxadmlangs = 1;
		var $defaulthide = 0;
		
		function __construct()
		{
			global $par;
			$this->tablename  = $par->razmertable;
			
			$this->fields['razmer'] = Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Размер:', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'insertmode'=>true , 'tdname'=>'Резмер:');


			parent::__construct();
		}
	}
	
    ////////////////////////////////////////////////////////////////////////////////    
    if($act=="editsize")
    {
		$module = new SizeAdminModule;
		$module->DoModule();
    }	
	
?>