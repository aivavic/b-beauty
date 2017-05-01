<?
	//В этом массиве будут храниться все данные для отображения
	$_logic = Array();
				
	$activemenuid = 0;

  if($act=="menu") $activemenuid = $id;
  
  if($act=="none")
  {
    $sql = "SELECT * FROM $par->topmenutable WHERE   url='/'";
    $res = mysql_query($sql);
    if($line = mysql_fetch_array($res,MYSQL_ASSOC)) $activemenuid = $line['id'];
  }
  
  if( $act=="contacts" || $act=="news"  || $act=="abonent")
  {
    $sql = "SELECT * FROM $par->topmenutable WHERE url='/$act'";
    $res = mysql_query($sql);
    if($line = mysql_fetch_array($res,MYSQL_ASSOC)) $activemenuid = $line['id'];
  }
  
   if( $act=="cat" && $id!=0)
  {
    $sql = "SELECT * FROM $par->topmenutable WHERE url='/$act/$id'";
    $res = mysql_query($sql);
    if($line = mysql_fetch_array($res,MYSQL_ASSOC)) $activemenuid = $line['id'];
  }
  
	$activearr = Array(); $a = 0; $pid=$activemenuid;
	while($pid!=0)
	{
	  if($a>10) break; //якщо десь зациклилось про всяк випадок
	  
	  $activearr[$a++] = $pid;

	  $sql = "SELECT * FROM $par->topmenutable WHERE id=$pid";
	  $res = mysql_query($sql);
	  if($line = mysql_fetch_array($res,MYSQL_ASSOC))
	  {
		$pid = $line['parentid'];
	  }
	 
	}
	
	//генерация пунктов категорий каталога
	include "modules/indexmodules_logic/maincat_logic.php";
	
	include "modules/indexmodules_logic/header_logic.php";

	//генерация пунктов основного меню
	include "modules/indexmodules_logic/mainmenu_logic.php";
	
	
	
	

	
	//////////////////////////////////LANGS
	$sql = "SELECT * FROM $par->langstable";
	$res = mysql_query($sql);
	while($line = mysql_fetch_array($res,MYSQL_ASSOC))
	{
		$t = $line['key'];
		$par->langs['ru'][$t] = $line['title'];
		$par->langs['en'][$t] = $line['title_en'];
	}
/*
	//////////////////////////////////
		
	//генерация содержимого пункта меню
	include "modules/indexmodules/menu_logic.php";
	
	//генерация содержимого дополнительной страницы
	include "modules/indexmodules/pages_logic.php";
	
	//генерация содержимого пункта меню
	include "modules/indexmodules/cat_logic.php";
	
	//генерация содержимого страницы товара
	include "modules/indexmodules/tovar_logic.php";

	//генерация содержимого страницы галлереи
	include "modules/indexmodules/gallery_logic.php";
*/	
?>  