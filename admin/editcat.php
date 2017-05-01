<?
    //защита от прямого вызова
    if ( !defined('_we_are_from_admin_') )
    {
        exit();
    }

	class CatAdminModule Extends FullAdminModule
	{

		var $moduleact = "editcat";  //act для модуля
		var $tablename = ""; //таблицу переопределить в конструкторе
		//var $catobjtable = ""; //таблица объектов данного каталога - переопределить в конструкторе

        var $moduletype = "catalogtype"; //тип модуля каталог (у него будут объекты)
		var $objectsmodulefile = "editobjects.php"; // var $objectsmodulefile = "editobjects.php"; путь к файлу с класом объектов категории
		var $objectstable = ""; // аблица объектов данного каталога - переопределить в конструкторе
        var $editobjectsact = 'editobjects';
		var $objectsclassname = 'ObjectsAdminModule'; //название класса модуля объектов (в editobjects.php или аналоге)

                
		var $fields_str = 'title, titleh1, url, seo, text,galcat, titletitle, titlekeywords, titledescription';
		var $fields_list_str = 'title';
		
		var $pagestr = 'cat'; //префикс url для модуля
		var $maxlevel = 3;
		
		function __construct()
		{
			global $par;
			$this->tablename  = $par->categorytable;
			$this->objectstable = $par->objectstable;

            $this->fields['galcat'] = Array('fieldtype'=>'text', 'visualtype'=>'gallery',  'fieldhint'=>'Фото', 'multilang'=>false, 'metod'=>'MetodFormStandart', 'metodedit'=>'MetodEditStandart', 'metodlist'=>'MetodListStandart', 'tdname'=>'Фото',
            'gallerypics_tablename' => 'fotor',
            'gallerypics' => Array(
                Array('picprefix'=>'fotos/catslide', 'w'=>730, 'h'=>139, 'mode'=>'bigsize','ext'=>'jpg'),
                Array('picprefix'=>'fotos/catslide_big', 'w'=>600, 'h'=>400, 'mode'=>'bigsize','ext'=>'jpg','watermarkfile'=>'images/water.png','watermarkpos'=>'center')
            ),

        );

			parent::__construct();
		}
	}
	
    ////////////////////////////////////////////////////////////////////////////////    
    if($act=="editcat")
    {
		$module = new CatAdminModule;
		$module->DoModule();
    }	
	
?>