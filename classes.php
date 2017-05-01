<?
	include "db.php";

	class Parametres
	{
		var $dbhost = '';
		var $dbname = '';
		var $dblogin = 'root';
		var $dbpassword = '';

		var $server = '';
		


		var $fullmoduletable = '`fullmodule`';
		var $commentstable = '`comments`';
        var $contactustable = '`contactus`';
        var $mainfotortable = '`mainfotor`';


		//таблица главного меню сайта
		var $topmenutable = '`topmenu`';
		var $brandstable = '`brands`';
		var $managerstable = '`managers`';
		var $modulestable = '`modules`';
		var $langstable = '`langs`';
		var $categorytable = '`category`';
        var $razmertable = '`razmer`';

		var $userstable = '`users`';
		var $varstable = '`vars`';
		var $orderstable = '`orders`';
		var $fotorobjtable = '`fotorobj`';
		var $objectstable = '`objects`';
		var $orderstatusestable = '`orderstatuses`';

		var $seolinkstable = '`seolinks`';
		
		
		var $brendstable = '`brends`';
		var $gallerytable = '`gallery`';
		var $news1table = '`news1`';
		var $news2table = '`news2`';
		var $contactstable = '`contacts`';

		var $pagestable = '`pages`';
		var $gallery = '`gallery`';
		var $fotortable = '`fotor`';

		var $comentstable = '`coments`';

		var $homeurl = "";

		var $adminemail = "";

		var $objectsinpage = 10; ////////////////////////////////////

		var $params = Array();

		var $langs = Array();
		
		var $langsarr = Array(
			'maxadmlangs' => 3, //количество языков
			'urllangsaddarr' => Array('','','/lang/ru','/lang/en'), //суффиксы url для языков. нулевой параметр не используется
			'admlangssuffix' => Array(1=>'',2=>'_ru',3=>'_en'),
			'plangsarr' => Array(1=>'ru',2=>'de',3=>'en'),
			'admlangs' => Array(1=>true,2=>false,3=>false),
		);
				
		
	}

	$par = new Parametres;
	
	$par->dbhost = $mydbhost;
	$par->dbname = $mydbname;
	$par->dblogin = $mydblogin;
	$par->dbpassword = $mydbpassword;

	$par->server = $server;

    $db = new MyDBClass();
    $link = $db->connect($par->dbhost,$par->dbname,$par->dblogin,$par->dbpassword);

	function GetVars()
	{
		global $par;
/*		
		$varsline = Array();
		$sql = "SELECT * FROM $par->varstable";
		$res = mysql_query($sql);
		while($line = mysql_fetch_array($res,MYSQL_ASSOC))
		{
			$varsline[$line['fieldname']] = $line['fieldvalue'];
		}
*/		
		$sql = "SELECT * FROM $par->varstable";
		$res = mysql_query($sql);
		$varsline = mysql_fetch_array($res,MYSQL_ASSOC);

		return $varsline;
	}
	
	reinit();

    function reinit()
    {
    	global $par;
	
	$par->document_root = $_SERVER['DOCUMENT_ROOT'];


		$varsline = GetVars();

		$par->adminemail=$varsline['adminemail'];

		$par->params = Array(

			//actname - для какого act определяем url
			//tablename - табличка в которой храняться данные модуля actname
			//urlprefix - какой префикс имеет url данного actname

			//основное меню
			Array(
			'actname' => 'menu',
			'tablename' => $par->topmenutable,
			'urlprefix' => 'menu'		
			),
			
			Array(
			'actname' => 'contacts',
			'tablename' => $par->topmenutable,
			'urlprefix' => 'contacts'		
			),
			
			Array(
			'actname' => 'comments',
			'tablename' => $par->commentstable,
			'urlprefix' => 'comments'		
			),
			
			Array(
			'actname' => 'brands',
			'tablename' => $par->brandstable,
			'urlprefix' => 'brands'
			),
			
			//дополнительные страницы
			Array(
			'actname' => 'pages',
			'tablename' => $par->pagestable,
			'urlprefix' => 'pages'		
			),
			
			//новости
			Array(
			'actname' => 'news',
			'tablename' => $par->news1table,
			'urlprefix' => 'news'
			),
			
			//категории
			Array(
			'actname' => 'cat',
			'tablename' => $par->categorytable,
			'urlprefix' => 'cat'
			),

			//объекты
			Array(
			'actname' => 'tovar',
			'tablename' => $par->objectstable,
			'urlprefix' => 'tovar'
			),

			//статьи
			Array(
			'actname' => 'articles',
			'tablename' => $par->news2table,
			'urlprefix' => 'articles'
			),
			
			//галерея
			Array(
			'actname' => 'gallery',
			'tablename' => $par->gallerytable,
			'urlprefix' => 'gallery'
			),
			
			//контакты
			/*Array(
			'actname' => 'contacts',
			'tablename' => '',
			'urlprefix' => 'contacts'
			),*/
			
			//корзина шаг-2
			Array(
			'actname' => 'basket2',
			'tablename' => '',
			'urlprefix' => 'basket2'
			),

			//корзина шаг-1
			Array(
			'actname' => 'basket',
			'tablename' => '',
			'urlprefix' => 'basket'
			),
			
			//кабинет
			Array(
			'actname' => 'cabinet',
			'tablename' => '',
			'urlprefix' => 'cabinet'
			),

			//новинки
			Array(
			'actname' => 'novinki',
			'tablename' => '',
			'urlprefix' => 'novinki'
			),
			
			//хиты продаж
			Array(
			'actname' => 'bestsellers',
			'tablename' => '',
			'urlprefix' => 'bestsellers'
			),
			
			//акции, скидки
			Array(
			'actname' => 'akcii',
			'tablename' => '',
			'urlprefix' => 'akcii'
			),

			//кабинет
			Array(
			'actname' => 'search',
			'tablename' => '',
			'urlprefix' => 'search'
			),
		);			
				
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	class MyDBClass
	{
		function MyDBClass()
		{
		}

		function connect($dbhost, $dbname, $login, $password)
		{
			$link = mysql_connect($dbhost, $login, $password);
			if($link === false)
			 return false;

			$rrr  = mysql_select_db($dbname, $link);
			//mysql_query("set names cp1251");
			mysql_query("set names utf8");
			return $rrr;
		}	


		function query($sql)
		{
			return mysql_query($sql);
		}
	}
	

	
	class Registry
	{
		var $_objects = Array();
		
		function set($name, &$object)
		{
			//echo "SET: $name<BR>";
			$this->_objects[$name] = & $object;
		}
		
		function &get($name)
		{
			//echo "GET: $name<BR>";
			return $this->_objects[$name];
		}
		
		function &getInstance()
		{
			static $me;
			
			if(is_object($me) == true)
			{
				return $me;
			}
			
			$me = new Registry();
			return $me;
		}
	}
	
	$registry = & Registry::getInstance();
	$registry->set('par',$par);
	$registry->set('db',$db);

	
	function t_($key)
	{
		global $plang,$par;
		return $par->langs[$plang][$key];
	}


	include "modules/classesmodules/classes_other.php";
	include "modules/classesmodules/classes_images.php";
	include "modules/classesmodules/classes_mail.php";
	include "modules/classesmodules/classes_coments.php";
	include "modules/classesmodules/classes_orders.php";

	function Debug($s,$mode='pre')
	{
		if($mode = 'pre') $s = '<pre>'.print_r($s,true).'</pre>';
		if(isset($_SESSION['logdebug']) && $_SESSION['logdebug']==1) echo $s;
	}
	
?>