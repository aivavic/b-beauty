<?
	@session_start();

	if(isset($_SESSION['logdebug']) && $_SESSION['logdebug']==1)
	{
		error_reporting(E_ALL);
	}
	else
	{
		error_reporting(E_ERROR);
	}

	
	include "headerinc.php";

Debug("ACT=".$act."<BR>ID=".$id);

	include "_logic.php";
        
	include "modules/indexmodules/header.php";
	
	
	//подключаем полезные функции которые используем для вывода верстки
	include "modules/indexmodules/_view_functions.php";
	
	if($act=="none") include "modules/indexmodules/mainbody.php";

	if($act=="menu")
	{
	    include "modules/indexmodules_logic/menu_logic.php";
	    include "modules/indexmodules/menu.php";
	}

	if($act=="cat" || $act=="novinki" || $act=="bestsellers" || $act=="akcii" || $act=="search")
	{
	    include "modules/indexmodules_logic/cat_logic.php";
	    include "modules/indexmodules/cat.php";
	}

	if($act=="tovar")
	{
	    include "modules/indexmodules_logic/tovar_logic.php";
	    include "modules/indexmodules/tovar.php";
	}
	
	if($act=="basket") include "modules/indexmodules/basket.php";

	if($act=="basket2") include "modules/indexmodules/basket2.php";
	
	if($act=="cabinet")
	{
		include "modules/cabinetmodules/cabinet_logic.php";

		if(isset($_SESSION['loguserid']))
		{
			include "modules/cabinetmodules/cabinet_header.php";
			include "modules/cabinetmodules/cabinet_other.php";
			include "modules/cabinetmodules/cabinet_orders.php";
		}

		if($subact=="register") include "modules/cabinetmodules/cabinet_register.php";
		if($subact=="login") include "modules/cabinetmodules/cabinet_login.php";
		if($subact=="remind") include "modules/cabinetmodules/cabinet_remind.php";
	}
	
/*
	if($act=="pages" )include "modules/indexmodules/pages.php";
             
	if($act=="news") include "modules/indexmodules/news.php";
	
	if($act=="articles") include "modules/indexmodules/articles.php";
	
	if($act=="contacts") include "modules/indexmodules/contacts.php";	
	
	if($act=="gallery") include "modules/indexmodules/gallery.php";	


	if($act=="tovar") include "modules/indexmodules/tovar.php";






	
	if($act=="search") include "modules/indexmodules/search.php";	
*/
	include "modules/indexmodules/footer.php";
?>