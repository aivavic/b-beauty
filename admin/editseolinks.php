<?
    //защита от прямого вызова
    if ( !defined('_we_are_from_admin_') )
    {
        exit();
    }

	class SeolinksAdminModule Extends FullAdminModule
	{
		var $moduleact = "editseolinks";  //act для модуля
		var $tablename = ""; //таблицу переопределить в конструкторе
		
		var $fields_str = 'title, seourl, ';
		var $fields_list_str = 'title, seourl';
		
		var $pagestr = ''; //префикс url для модуля
		var $maxlevel = 2;
		
		function __construct()
		{
			global $par;
			$this->tablename  = $par->seolinkstable;
			$this->defaulthide = 0;
			
			$this->fields['title']['multilang'] = false;
			$this->fields['seourl'] = Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'SEO-ссылка', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'insertmode'=>true);
			

			parent::__construct();
		}
	}
	
    ////////////////////////////////////////////////////////////////////////////////    
    if($act=="editseolinks")
    {
		$module = new SeolinksAdminModule;
		$module->DoModule();
    }	
	
?>