<?
    //защита от прямого вызова
    if ( !defined('_we_are_from_admin_') )
    {
        exit();
    }

	class OrderStatusesAdminModule Extends FullAdminModule
	{
		var $moduleact = "editorderstatuses";  //act для модуля
		var $tablename = ""; //таблицу переопределить в конструкторе
		
		var $fields_str = 'title, color';
		var $fields_list_str = 'title, color';
		
		var $pagestr = ''; //префикс url для модуля
		var $maxlevel = 1;
		
		function __construct()
		{
			global $par;
			$this->tablename  = $par->orderstatusestable;

			parent::__construct();
		}
	}
	
    ////////////////////////////////////////////////////////////////////////////////    
    if($act=="editorderstatuses")
    {
		$module = new OrderStatusesAdminModule;
		$module->DoModule();
    }	
	
?>