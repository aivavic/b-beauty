<?
    //защита от прямого вызова
    if ( !defined('_we_are_from_admin_') )
    {
        exit();
    }

	class TopmenuAdminModule Extends FullAdminModule
	{
		var $moduleact = "edittopmenu";  //act для модуля
		var $tablename = ""; //таблицу переопределить в конструкторе
		
		var $fields_str = 'spec1,spec2,title, titleh1, url, seo, text, titletitle, titledescription, titlekeywords';
		var $fields_list_str = 'title';
		
		var $pagestr = 'menu'; //префикс url для модуля
		var $maxlevel = 1;
		
		function __construct()
		{
			global $par;
			$this->tablename  = $par->topmenutable;

			$this->fields['spec1'] = Array('fieldtype'=>'int', 'visualtype'=>'checkbox', 'fieldhint'=>'Выводить в правый край меню(в шапке)', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Сп');
			$this->fields['spec2'] = Array('fieldtype'=>'int', 'visualtype'=>'checkbox', 'fieldhint'=>'Выводить в правый край меню(в подвале)', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Сп');
			
			parent::__construct();
		}
	}
	
    ////////////////////////////////////////////////////////////////////////////////    
    if($act=="edittopmenu")
    {
		$module = new TopmenuAdminModule;
		$module->DoModule();
    }	
	
?>