<?
    //защита от прямого вызова
    if ( !defined('_we_are_from_admin_') )
    {
        exit();
    }

	class BrandsAdminModule Extends FullAdminModule
	{
		var $moduleact = "editbrands";  //act для модуля
		var $tablename = ""; //таблицу переопределить в конструкторе
		
		var $fields_str = 'name,pic';
		var $fields_list_str = 'name';
		
		//var $pagestr = 'menu'; //префикс url для модуля
		var $maxlevel = 1;

		var $maxadmlangs = 1;
		var $defaulthide = 0;
		
		function __construct()
		{
			global $par;
			$this->tablename  = $par->brandstable;
			
			$this->fields['name'] = Array('fieldtype'=>'text', 'visualtype'=>'input', 'fieldhint'=>'Название:', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'insertmode'=>true , 'tdname'=>'Название');
            $this->fields['pic'] = Array('fieldtype'=>'text', 'visualtype'=>'image', 'fieldhint'=>'Картинка-1', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Карт-1' ,
            'pics' => Array(
                'params' => Array(
                    Array('picprefix'=>'fotos/brand_sm_', 'w'=>200, 'h'=>43, 'mode'=>'bigsize','ext'=>'jpg'),
                    Array('picprefix'=>'fotos/brand_bg_', 'w'=>600, 'h'=>400, 'mode'=>'bigsize','ext'=>'jpg','watermarkfile'=>'images/water.png','watermarkpos'=>'center')
                )
            ),
        );
			

			parent::__construct();
		}
	}
	
    ////////////////////////////////////////////////////////////////////////////////    
    if($act=="editbrands")
    {
		$module = new BrandsAdminModule;
		$module->DoModule();
    }	
	
?>