<?
    //защита от прямого вызова
    if ( !defined('_we_are_from_admin_') )
    {
        exit();
    }

	class ManagersAdminModule Extends FullAdminModule
	{
		var $moduleact = "editmanagers";  //act для модуля
		var $tablename = ""; //таблицу переопределить в конструкторе
		
		var $fields_str = 'name, login, password, access';
		var $fields_list_str = 'name, login, password, access';
		
		var $pagestr = 'menu'; //префикс url для модуля
		var $maxlevel = 1;

		var $maxadmlangs = 1;
		var $defaulthide = 0;
		
		function __construct()
		{
			global $par;
			$this->tablename  = $par->managerstable;
			
			$this->fields = array_merge($this->fields,
							Array(
							    'name' =>Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Имя', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'insertmode'=>true , 'tdname'=>'Имя'),
							    'login' =>Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Логин', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'insertmode'=>true , 'tdname'=>'Логин'),
							    'password' =>Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Пароль', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'insertmode'=>true , 'tdname'=>'Пароль'),
							    'access' =>Array('fieldtype'=>'text',   /*для select*/ 'visualtype'=>'multiselect',  'selecttable'=>$par->modulestable, 'selecttablefield'=>'title', 'selectorderfield'=>'id ASC', 'selectmaxlevel'=>2 ,/*end - для select*/          'fieldhint'=>'Доступы', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Доступы','height'=>240,),
							)
							
							
						   );
			

			parent::__construct();
		}
	}
	
    ////////////////////////////////////////////////////////////////////////////////    
    if($act=="editmanagers")
    {
		$module = new ManagersAdminModule;
		$module->DoModule();
    }	
	
?>