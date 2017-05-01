<?
    //защита от прямого вызова
    if ( !defined('_we_are_from_admin_') )
    {
        exit();
    }

	class ContactusAdminModule Extends FullAdminModule
	{
		var $moduleact = "editcontactus";  //act для модуля
		var $tablename = ""; //таблицу переопределить в конструкторе
		
		var $fields_str = 'name,email,phone,text';
		var $fields_list_str = 'name,email,phone,text';
		
		var $pagestr = ''; //префикс url для модуля
		var $maxlevel = 1;
		
		function __construct()
		{
			global $par;
			$this->tablename  = $par->contactustable;
			
                        $this->fields['name'] = Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Имя', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'insertmode'=>false , 'tdname'=>'Имя');
                        $this->fields['email'] = Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'E-mail', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'insertmode'=>false , 'tdname'=>'email');
						$this->fields['phone'] = Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Телефон', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'insertmode'=>false , 'tdname'=>'Телефон');
                        $this->fields['text'] = Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Текст', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'insertmode'=>false , 'tdname'=>'Текст');

                        
			parent::__construct();
			
		}
	}
	
    ////////////////////////////////////////////////////////////////////////////////    
    if($act=="editcontactus")
    {
		$module = new ContactusAdminModule;
		$module->DoModule();
    }	
	
?>