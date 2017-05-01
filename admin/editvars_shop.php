<?
    //защита от прямого вызова
    if ( !defined('_we_are_from_admin_') )
    {
        exit();
    }

	class Vars_ShopAdminModule Extends FullAdminModule
	{
		var $moduleact = "editvars_shop";  //act для модуля
		var $tablename = ""; //таблицу переопределить в конструкторе
		
		var $fields_str = 'objectsinpage,newsinpage,sizetable,subtext1';
		var $fields_list_str = 'objectsinpage';
		
		var $pagestr = ''; //префикс url для модуля
		var $maxlevel = 1;
                var $candelete = false;
		
	
		
		function __construct()
		{
			global $par;
			$this->tablename  = $par->varstable;
			
			
			$this->fields['objectsinpage'] = Array('fieldtype'=>'int', 'visualtype'=>'input', 'fieldhint'=>'Товаров на страницу', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', );
            $this->fields['sizetable'] = Array('fieldtype'=>'text', 'visualtype'=>'fck', 'fieldhint'=>'Таблицы размеров', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'sortable'=>false,/*Если не нужна сортировка по этому полю в списке*/ 'tdname'=>'Описание');
            $this->fields['subtext1'] = Array('fieldtype'=>'text', 'visualtype'=>'fck', 'fieldhint'=>'Текст в товарах', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'sortable'=>false,/*Если не нужна сортировка по этому полю в списке*/ 'tdname'=>'Описание');
            $this->fields['newsinpage'] = Array('fieldtype'=>'int', 'visualtype'=>'input', 'fieldhint'=>'Комментариев в товарах', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', );

			parent::__construct();
		}
	}
	
    ////////////////////////////////////////////////////////////////////////////////    
    if($act=="editvars_shop")
    {
		$module = new Vars_ShopAdminModule;
		$module->DoModule();
    }	
	
?>