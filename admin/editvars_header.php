<?
    //защита от прямого вызова
    if ( !defined('_we_are_from_admin_') )
    {
        exit();
    }

	class xHeaderAdminModule Extends FullAdminModule
	{
		var $moduleact = "editvars_header";  //act для модуля
		var $tablename = ""; //таблицу переопределить в конструкторе
		
		var $fields_str = 'logo,phones,f_text';
		var $fields_list_str = 'logo';
		
		var $pagestr = ''; //префикс url для модуля
		var $maxlevel = 1;
        var $candelete = false;
		
	
		
		function __construct()
		{
			global $par;
			$this->tablename  = $par->varstable;

            $this->fields['logo'] =Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Текст над логотипом', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListTitle', 'insertmode'=>false);
            $this->fields['phones'] =Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Телефоны в шапке(через ";")', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListTitle', 'insertmode'=>false);

            $this->fields['f_text'] =Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Текст в подвале', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListTitle', 'insertmode'=>false);


			parent::__construct();
		}
	}
	
    ////////////////////////////////////////////////////////////////////////////////    
    if($act=="editvars_header")
    {
		$module = new xHeaderAdminModule;
		$module->DoModule();
    }	
	
?>