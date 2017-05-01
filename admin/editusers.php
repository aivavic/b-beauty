<?
    //защита от прямого вызова
    if ( !defined('_we_are_from_admin_') )
    {
        exit();
    }

	class UsersAdminModule Extends FullAdminModule
	{
		var $moduleact = "editusers";  //act для модуля
		var $tablename = ""; //таблицу переопределить в конструкторе
		
		var $fields_str = 'hide, email, password, firstname, phone, address, code, lastvisitdate ';
		var $fields_list_str = 'email, firstname';
		
		var $pagestr = ''; //префикс url для модуля
		var $maxlevel = 1;
		
		function __construct()
		{
			global $par;
			$this->tablename  = $par->userstable;

			$this->fields['email'] = Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'E-mail', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'E-mail', 'insertmode'=>true, );
			$this->fields['firstname'] = Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Имя', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Имя', 'insertmode'=>true, );
			$this->fields['password'] = Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Пароль', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Пароль', 'insertmode'=>true, );
			$this->fields['address'] = Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Адрес', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Адрес', 'insertmode'=>true, );
			$this->fields['phone'] = Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Телефон', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Телефон', 'insertmode'=>true, );
			$this->fields['code'] = Array('fieldtype'=>'text', 'visualtype'=>'none', 'fieldhint'=>'Код регистрации', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Код регистрации', 'disabled'=>true);
			$this->fields['lastvisitdate'] = Array('fieldtype'=>'int', 'visualtype'=>'date', 'needtime'=>true, 'fieldhint'=>'Последний визит', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Последний визит', 'disabled'=>true);

			parent::__construct();
		}
	}
	
    ////////////////////////////////////////////////////////////////////////////////    
    if($act=="editusers")
    {
		$module = new UsersAdminModule;
		$module->DoModule();
    }	
	
?>