<?
    //защита от прямого вызова
    if ( !defined('_we_are_from_admin_') )
    {
        exit();
    }

	class ModulesAdminModule Extends FullAdminModule
	{
		var $moduleact = "editmodules";  //act для модуля
		var $tablename = ""; //таблицу переопределить в конструкторе
		
		var $fields_str = 'title,filename';
		var $fields_list_str = 'title,filename';
		
		var $pagestr = ''; //префикс url для модуля
		var $maxlevel = 2;

		var $maxadmlangs = 1;
		var $defaulthide = 0;
		
		function __construct()
		{
			global $par;
			$this->tablename  = $par->modulestable;
			
			$this->fields['title']['fieldhint'] = 'Название модуля';
			
			$this->fields = array_merge($this->fields,
							Array(
							    'filename' =>Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Имя файла', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'insertmode'=>true ),
							)
						   );
			

			parent::__construct();
		}
	}
	
    ////////////////////////////////////////////////////////////////////////////////    
    if($act=="editmodules")
    {
		$module = new ModulesAdminModule;
		$module->DoModule();
    }	
	
?>