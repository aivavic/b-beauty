<?
        @session_start();
	
	if(isset($_SESSION['logdebug']) && $_SESSION['logdebug']==1)
	{
		error_reporting(E_ALL);
	}
	else
	{
		//error_reporting(E_ERROR);
	}
	
		error_reporting(0);

	define('_we_are_from_admin_', true);
	
/*        session_register("logadmin");
*/
        include_once "../classes.php";

	$varsline = GetVars();
		
	$drawer = 'drawer_oc';
	if(isset($varsline['currentdrawer'])) $drawer = $varsline['currentdrawer'];
	//if(isset($_SESSION['current_admin_drawer'])) $drawer = $_SESSION['current_admin_drawer'];
		
        //include_once "drawer/drawer_basic/drawer_basic.php";
        //include_once "drawer/drawer_oc/drawer_oc.php";
	
	if(!is_file("drawer/".$drawer."/".$drawer.".php")) $drawer = 'drawer_basic';

        include_once "drawer/".$drawer."/".$drawer.".php";

		$adm = new AdminFunc();
		$registry = & Registry::getInstance();
		$registry->set('adm',$adm);

	
			
	include_once "admfuncs.php";
        ini_set('upload_max_filesize',80000000);
	ini_set("max_execution_time", "300");

	if(isset($_REQUEST['act'])) $act=$_REQUEST['act']; else $act = "none";
	if(isset($_REQUEST['subact'])) $subact=$_REQUEST['subact']; else $subact = "none";
	if(isset($_REQUEST['start'])) $start=(int)$_REQUEST['start']; else $start = 0;
	if(isset($_REQUEST['id'])) $id=(int)$_REQUEST['id']; else $id=0;

        if(isset($_REQUEST['moveup'])) $moveup=(int)$_REQUEST['moveup'];
        if(isset($_REQUEST['movedown'])) $movedown=(int)$_REQUEST['movedown'];

        if(isset($_REQUEST['submoveup'])) $submoveup=(int)$_REQUEST['submoveup']; 
        if(isset($_REQUEST['submovedown'])) $submovedown=(int)$_REQUEST['submovedown']; 
        if(isset($_REQUEST['categid'])) $categid = (int)$_REQUEST['categid']; else $categid = 0;

		if(!isset($act)) $act="none";
		if(!isset($subact)) $subact="none";
	
	$access_str = ';';
	
	if($act=="login")
        {
                if(
		   (($_REQUEST['login']=='admin') || ($_REQUEST['login']=='debug'))
			&& $_REQUEST['password']==$varsline['password'])
		{
			$_SESSION['logadmin']=1;
			$_SESSION['logadmin_manager'] = 0;
			
			if($_REQUEST['login']=='debug') $_SESSION['logdebug'] = 1;
		}
		else
		{
			$login = myaddslashes($_REQUEST['login']);
			$password = myaddslashes($_REQUEST['password']);
			$sql = "SELECT * FROM $par->managerstable WHERE `login`='$login' AND `password`='$password'";
			$res = mysql_query($sql);
			if(mysql_num_rows($res)==1)
			{
				
				$line = mysql_fetch_array($res,MYSQL_ASSOC);
				$_SESSION['logadmin']=1;
				$_SESSION['logadmin_manager'] = $line['id'];
			}
		}
		
        }

        if($act=="logout")
        {
                if(isset($_SESSION['logadmin']))
                {
                     if(isset($_SESSION['logadmin'])) unset($_SESSION['logadmin']);
                     if(isset($_SESSION['logdebug'])) unset($_SESSION['logdebug']);
                     if(isset($_SESSION['logadmin_manager'])) unset($_SESSION['logadmin_manager']);
                     //session_destroy();
                };
        }

        $loggedok=0;
        if(isset($_SESSION['logadmin']) && $_SESSION['logadmin']==1)
        {
                $loggedok = 1;
        }
        else
        {
		include "admin.html";
		exit();
        }

	
	$sql = "SELECT * FROM $par->managerstable WHERE `id`=".(int)$_SESSION['logadmin_manager'];
	$res = mysql_query($sql);
	if(mysql_num_rows($res)==1)
	{
		
		$line = mysql_fetch_array($res,MYSQL_ASSOC);
		$s = explode(':',$line['access']);
		for($i=0;$i<count($s);$i++)
		{
			$moduleid = (int)$s[$i];
			$sql2 = "SELECT * FROM $par->modulestable WHERE id=$moduleid";
			$res2 = mysql_query($sql2);
			if($line2 = mysql_fetch_array($res2,MYSQL_ASSOC))
			{
				$access_str .= $line2['filename'].';';
			}
		}
	}	

		echo $adm->DrawAdminHeader();

?>
		

                <?
				
				
				$adminmodules = Array(
					Array('act'=>'editfullmodule', 'title'=>'!!!','file'=>'fullmodule.php'),
				
					Array('act'=>'edittopmenu', 'title'=>'Меню','file'=>'edittopmenu.php'),
                    Array('act'=>'editcat', 'title'=>'Категории','file'=>'editcat.php'),
                    Array('act'=>'editbrands', 'title'=>'Бренды','file'=>'editbrands.php'),
                    Array('act'=>'editorders', 'title'=>'Заказы','file'=>'editorders.php',),
                    Array('act'=>'editcontactus', 'title'=>'Сообщения','file'=>'editcontactus.php'),
                    Array('act'=>'editcomments', 'title'=>'Комментарии','file'=>'editcomments.php'),
                    //Array('act'=>'editusers', 'title'=>'Пользователи','file'=>'editusers.php'),

                    //Array('act'=>'editobjects', 'title'=>'Объекты','file'=>'editobjects.php'),

					//Array('act'=>'editbrands', 'title'=>'Бренды','file'=>'editbrands.php'),
                    //Array('act'=>'editsize', 'title'=>'Размеры','file'=>'editsize.php'),





					/*Array('act'=>'', 'title'=>'Разное','file'=>'#other',
						'subitems' =>Array(
									Array('act'=>'editseolinks', 'title'=>'SEOLINKS','file'=>'editseolinks.php'),
									//Array('act'=>'editseolinks2', 'title'=>'SEOLINKS2','file'=>'editseolinks2.php'),
								   
								   ),
					      
					      ),*/

					Array('act'=>'', 'title'=>'Настройки','file'=>'#varscommon',
						'subitems' =>Array(
								Array('act'=>'editvars', 'title'=>'Общие настройки','file'=>'editvars.php'),
								Array('act'=>'editvars_shop', 'title'=>'Настройки магазина','file'=>'editvars_shop.php'),
                                Array('act'=>'editvars_header', 'title'=>'Шапка,подвал сайта','file'=>'editvars_header.php'),
                                Array('act'=>'editvars_slider', 'title'=>'Слайдер на главной','file'=>'editvars_slider.php'),
								Array('act'=>'editvars_contacts', 'title'=>'Настройка контактов','file'=>'editvars_contacts.php'),
								Array('act'=>'editvars_fcontacts', 'title'=>'Контакты (подвал)','file'=>'editvars_fcontacts.php'),
								//Array('act'=>'editlangs', 'title'=>'Языки','file'=>'editlangs.php'),
                                Array('act'=>'editorderstatuses', 'title'=>'Статусы заказа','file'=>'editorderstatuses.php'),
								Array('act'=>'editmanagers', 'title'=>'Доступы','file'=>'editmanagers.php'),

								   
								),
					      ),

					//Array('act'=>'editseolinks', 'title'=>'SEOLINKS','file'=>'editseolinks.php'),

					//Array('act'=>'editvars', 'title'=>'Настройки','file'=>'editvars.php'),
					//Array('act'=>'editlangs', 'title'=>'Языки','file'=>'editlangs.php'),
//					Array('act'=>'editlangs', 'title'=>'Языки','file'=>'editlangs.php'),
					
//					Array('act'=>'edittemp', 'title'=>'Temp','file'=>'edittemp.php'),
//					Array('act'=>'edittest', 'title'=>'Test','file'=>'testmodule.php'),
//					Array('act'=>'editbrends', 'title'=>'Бренды','file'=>'editbrends.php'),

//					Array('act'=>'editpages', 'title'=>'Доп. страницы','file'=>'editpages.php'),
//					Array('act'=>'editnews1', 'title'=>'Новости','file'=>'editnews1.php'),
//					Array('act'=>'editnews2', 'title'=>'Статьи','file'=>'editnews2.php'),

//					Array('act'=>'editgallery', 'title'=>'Галерея','file'=>'editgallery.php'),

					
					//Array('act'=>'editcategory', 'title'=>'Категории','file'=>'editcategory.php'),
					//Array('act'=>'editpages', 'title'=>'Доп. страницы','file'=>'editpages.php'),
					//Array('act'=>'editnews1', 'title'=>'Новости','file'=>'editnews1.php'),
					//Array('act'=>'editnews2', 'title'=>'Статьи','file'=>'editnews2.php'),
					//Array('act'=>'editbrends', 'title'=>'Бренды','file'=>'editbrends.php'),
					//Array('act'=>'editgallery', 'title'=>'Фотогалерея','file'=>'editgallery.php'),
					//Array('act'=>'editcoments', 'title'=>'Комментарии','file'=>'editcoments.php'),
					//Array('act'=>'editcontacts', 'title'=>'Сообщения','file'=>'editcontacts.php'),

				);
				
				$badkeysarr = Array();
				
				foreach($adminmodules AS $key=>$value)
				{
					if(isset($value['subitems']))
					{
						foreach($value['subitems'] AS $key2=>$value2)
						{
							$temp2_file = $value2['file'];
							
							//Если залогиненый главный админ, или у мененеджера есть допуск к данному файлу
							if($_SESSION['logadmin_manager']==0 || strpos($access_str,$temp2_file))
							{
							}
							else
							{
								unset($adminmodules[$key]['subitems'][$key2]);
							}
						}						
					}
					
					$temp1_file = $value['file'];
					
					//Если залогиненый главный админ, или у мененеджера есть допуск к данному файлу
					if($_SESSION['logadmin_manager']==0 || strpos($access_str,$temp1_file))
					{
					}
					else
					{
						unset($adminmodules[$key]);
					}
				}
					
				
				if(isset($_SESSION['logadmin']) && $_SESSION['logadmin']==1)
				{
					//$adminmodules[] = Array('act'=>'editmanagers', 'title'=>'Менеджеры','file'=>'editmanagers.php');
				}
				
				if(isset($_SESSION['logdebug']) && $_SESSION['logdebug']==1)
				{
					$adminmodules[] = Array('act'=>'editmodules', 'title'=>'Модули','file'=>'editmodules.php');
				}
				
				
				
                        if($loggedok==1)
                        {
						
							foreach($adminmodules AS $key=>$value)
							{
								$temp1_act = $value['act'];
								$temp1_title = $value['title'];
								$temp1_file = $value['file'];
								if(trim($temp1_act)!='') $temp1_url = 'admin.php?act='.$temp1_act; else $temp1_url = '';
								if(isset($value['subitems'])) $temp1_subitems = $value['subitems']; else $temp1_subitems = null;
								if ($temp1_act!='editfullmodule' && $temp1_act!='editcomments')
                                {
                                    $adm->DrawHeadCategory($act,$temp1_act,$temp1_title,$temp1_file,$temp1_url,$temp1_subitems);
                                }

							}
						}
				

		$adm->DrawAdminHeaderEnd();

				
		$adm->DrawAdminHeadRow2Start();
				if($act=="editcoments")
				{
						$s = '<a href="admin.php?act=editcoments&comentstype=1">Коментарии-1</a> ';
						$s.= '<a href="admin.php?act=editcoments&comentstype=2">Коментарии-2</a> ';
						$adm->DrawAdminHeadRow2Item($s);
				}
		$adm->DrawAdminHeadRow2End();
				
				
		$adm->DrawAdminContentBegin();
				
				include_once "fullmodule.php";
				include_once "editobjects.php";

				if($loggedok==1)
				{
					foreach($adminmodules AS $key=>$value)
					{
						$temp1_file = $value['file'];
						$temp1_act = $value['act'];
						if(trim($temp1_act)!='') include_once $temp1_file;
						
						if(isset($value['subitems']))
						{
							foreach($value['subitems'] AS $key2=>$subitem)
							{
								$temp2_file = $subitem['file'];
								$temp2_act = $subitem['act'];
								if(trim($temp2_act)!='') include_once $temp2_file;
							}
						}
					}
				}

		$adm->DrawAdminContentEnd();
		
		$adm->DrawAdminFooter();
		
		//Генерация sitemap.xml при каждом заходе в админку. При проектах с большой базой заменить логику генерации
		GenSiteMapXml($_SERVER['DOCUMENT_ROOT'].'/sitemap.xml');

?>

