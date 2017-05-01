<?
    //защита от прямого вызова
    if ( !defined('_we_are_from_admin_') )
    {
        exit();
    }

	class VarsAdminModule Extends FullAdminModule
	{
		var $moduleact = "editvars";  //act для модуля
		var $tablename = ""; //таблицу переопределить в конструкторе
		
		var $fields_str = 'adminemail, password, newsinpage, objectsinpage, favicon, countercode, hidesite, comingsoon, titleprefix, titlesuffix';
		var $fields_list_str = 'adminemail';
		
		var $pagestr = ''; //префикс url для модуля
		var $maxlevel = 1;
		var $candelete = false;
		
	
		
		function __construct()
		{
			global $par;
			$this->tablename  = $par->varstable;
			
			
			$this->fields['adminemail'] = Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'E-mail менеджера', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', );
			$this->fields['password'] = Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Пароль администратора', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', );
			$this->fields['newsinpage'] = Array('fieldtype'=>'int', 'visualtype'=>'input', 'fieldhint'=>'Новостей на страницу', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', );
			$this->fields['objectsinpage'] = Array('fieldtype'=>'int', 'visualtype'=>'input', 'fieldhint'=>'Товаров на страницу', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', );
			$this->fields['hidesite'] = Array('fieldtype'=>'int', 'visualtype'=>'checkbox', 'fieldhint'=>'Отключить сайт<br>(сайт будут видеть только администраторы)', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', );
			$this->fields['comingsoon'] = Array('fieldtype'=>'text', 'visualtype'=>'fck', 'fieldhint'=>'Заставка (отображается когда сайт отключен)', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', );
			$this->fields['countercode'] = Array('fieldtype'=>'text', 'visualtype'=>'textarea', 'fieldhint'=>'Коды счетчиков', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', );

			$this->fields['titleprefix'] = Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Префикс-TITLE', 'multilang'=>true, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', );
			$this->fields['titlesuffix'] = Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'TITLE-суффикс', 'multilang'=>true, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', );

			$this->fields['favicon'] = Array('fieldtype'=>'text', 'visualtype'=>'image', 'fieldhint'=>'Favicon', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Fav' ,
					'pics' => Array( 
							'params' => Array(
								Array('picprefix'=>'fotos/favicon', 'w'=>32, 'h'=>32, 'mode'=>'same','ext'=>'jpg', 'idmode'=>'withoutid'),
							)
						),
				      );


			parent::__construct();
		}
	}
	
    ////////////////////////////////////////////////////////////////////////////////    
    if($act=="editvars")
    {
		$module = new VarsAdminModule;
		$module->DoModule();
    }	
	
?>