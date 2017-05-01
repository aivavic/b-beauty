<?
    //защита от прямого вызова
    if ( !defined('_we_are_from_admin_') )
    {
        exit();
    }

	class SliderAdminModule Extends FullAdminModule
	{
		var $moduleact = "editvars_slider";  //act для модуля
		var $tablename = ""; //таблицу переопределить в конструкторе
		
		var $fields_str = 'atitle,galmain,delay';
		var $fields_list_str = 'atitle';
		
		var $pagestr = ''; //префикс url для модуля
		var $maxlevel = 1;
                var $candelete = false;
		
	
		
		function __construct()
		{
			global $par;
			$this->tablename  = $par->varstable;

            $this->fields['delay'] =Array('fieldtype'=>'int', 'visualtype'=>'input', 'fieldhint'=>'Задержка слайдера(мс)', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListTitle', 'insertmode'=>false);
            $this->fields['atitle'] =Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Название', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListTitle', 'insertmode'=>false);
            $this->fields['galmain'] = Array('fieldtype'=>'text', 'visualtype'=>'gallery',  'fieldhint'=>'Фото', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Фото',
            'gallerypics_tablename' => 'mainfotor',
            'gallerypics' => Array(
                Array('picprefix'=>'fotos/mainslider', 'w'=>300, 'h'=>200, 'mode'=>'same','ext'=>'jpg'),
                Array('picprefix'=>'fotos/mainslider_big', 'w'=>600, 'h'=>400, 'mode'=>'same','ext'=>'jpg','watermarkfile'=>'images/water.png','watermarkpos'=>'center')
            ),

        );

			parent::__construct();
		}
	}
	
    ////////////////////////////////////////////////////////////////////////////////    
    if($act=="editvars_slider")
    {
		$module = new SliderAdminModule;
		$module->DoModule();
    }	
	
?>