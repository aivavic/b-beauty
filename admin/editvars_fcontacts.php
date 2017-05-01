<?
    //защита от прямого вызова
    if ( !defined('_we_are_from_admin_') )
    {
        exit();
    }

	class fcontactsAdminModule Extends FullAdminModule
	{
		var $moduleact = "editvars_fcontacts";  //act для модуля
		var $tablename = ""; //таблицу переопределить в конструкторе
		
		var $fields_str = 'title,text';
		var $fields_list_str = 'title';
		
		var $pagestr = ''; //префикс url для модуля
		var $maxlevel = 1;
		var $candelete = false;
		
	
		
		function __construct()
		{
			global $par;
			$this->tablename  = $par->varstable;
			
			
			$this->fields['title'] = Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Заголовок', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', );
		
		
			parent::__construct();
		}
	}
	
    ////////////////////////////////////////////////////////////////////////////////    
    if($act=="editvars_fcontacts")
    {
		$module = new fcontactsAdminModule;
		$module->DoModule();
    }	
	
?>