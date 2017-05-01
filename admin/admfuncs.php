<?
/*
        function DelDeepmenuCat($id,$tablename,$picprefix,$iscatalog=0,$isgallery=0)
        {
            global $par;

            if($iscatalog)
            {
                $sql1 = "SELECT * FROM $par->objectstable WHERE categid=$id";
                $res1 = mysql_query($sql1);
                while($line1 = mysql_fetch_array($res1,MYSQL_ASSOC))
                {
                    DelObject($line1['id']);
                }
            }

            if($isgallery)
            {
                $sql1 = "SELECT * FROM $par->fotortable WHERE reportid=$id";
                $res1 = mysql_query($sql1);
                while($line1 = mysql_fetch_array($res1,MYSQL_ASSOC))
                {
                    DelFotor($line1['id']);
                }

                $sql1 = "DELETE FROM $par->fotortable WHERE reportid=$id";
                mysql_query($sql1);
            }

            $sql = "SELECT * FROM $tablename WHERE parentid=$id";
            $res = mysql_query($sql);
            while($line = mysql_fetch_array($res,MYSQL_ASSOC))
            {
		DelDeepmenuCat($line['id'],$tablename,$picprefix,$iscatalog);
            }


            $sql = "DELETE FROM $tablename WHERE id=$id";
            mysql_query($sql);
            
            if(is_file($picprefix.$id.'.jpg')) @unlink($picprefix.$id.'.jpg');
            if(is_file($picprefix.$id.'.gif')) @unlink($picprefix.$id.'.gif');
            if(is_file($picprefix.$id.'.png')) @unlink($picprefix.$id.'.png');
        }
*/        
	//Функция удаления товара(объекта каталога)
	function DelObject($id)
	{
		global $par;


		//делаем выборку всех фото товара	
		$sql = "SELECT * FROM $par->fotorobjtable WHERE reportid=$id";
		$res = mysql_query($sql);
		while($line = mysql_fetch_array($res,MYSQL_ASSOC))
		{
			//если есть соответствующие фотки - удаляем файлы
			if(is_file('../fotos/object'.$line['id'].'.jpg')) @unlink('../fotos/object'.$line['id'].'.jpg');
			if(is_file('../fotos/object_sm'.$line['id'].'.jpg')) @unlink('../fotos/object_sm'.$line['id'].'.jpg');
			if(is_file('../fotos/object_md'.$line['id'].'.jpg')) @unlink('../fotos/object_md'.$line['id'].'.jpg');
		}

		//удаляем их базы информацию о фотках товара
		$sql = "DELETE FROM $par->fotorobjtable WHERE reportid=$id";
		mysql_query($sql);
		
		//удаляем товар из базы
		$sql = "DELETE FROM $par->objectstable WHERE id=$id";
		mysql_query($sql);
	}
	
	function DelFotor($id)
	{
		global $par;

		if(is_file('../fotos/fotor'.$id.'.jpg')) @unlink('../fotos/fotor'.$id.'.jpg');
		if(is_file('../fotos/smfotor'.$id.'.jpg')) @unlink('../fotos/smfotor'.$id.'.jpg');
	}

	
        
        function GetDeepLevel($tablename,$id)
        {
            $level = 1;
            $pid = $id;
            while($pid!=0 && $level<100)
            {
                $sql = "SELECT * FROM $tablename WHERE id=$pid";
                $res = mysql_query($sql);
                if($line = mysql_fetch_array($res,MYSQL_ASSOC))
                {
                    $level++;
                    $pid = $line['parentid'];
                }
                else break;
            }
            return $level;
        }
        
	function PrintDeepSelectAdmin($tablename,$parentid,$level,$active=0)
	{
		$shift = 5;
		
		$s = '';

		$sql = "SELECT * FROM $tablename WHERE parentid=$parentid ORDER BY prior ASC";
		$res = mysql_query($sql);
		while($line = mysql_fetch_array($res,MYSQL_ASSOC))
		{
			$s.= '<option value="'.$line['id'].'" '.TrueStr($active==$line['id'],' selected ').'>';
			for($i=1;$i<=$level*$shift;$i++) $s.= '&nbsp;';
			$s.= htmlspecialchars($line['title']).'</option>';
			$s.= PrintDeepSelectAdmin($tablename,$line['id'],$level+1,$active);
		}
		
		return $s;
	}
	
	function PrintPagerAdmin($sql,$linkstr,$objperpage=0,$addstr='',$startmode=1)
	{
		global $par,$varsline,$start;
		$res = mysql_query($sql);
		$line = mysql_fetch_array($res,MYSQL_ASSOC);
		$all = $line['ccc'];
		
		if($objperpage==0) $tovarsinpage = (int)$varsline['tovarsinpage'];
		else $tovarsinpage = $objperpage;

		$allpages = floor(($all-1)/$tovarsinpage)+1;
		$currpage = floor($start/$tovarsinpage)+1;

		if($startmode==0) $linkstr.= '/start/';
		else $linkstr.= '&start=';

		if($allpages>1)
		{
			echo '<div class="adminpager">';
	
			if($currpage>1) echo '<a href="'.$linkstr.(($currpage-2)*$tovarsinpage).$addstr.'"> &lt;&lt;</a>&nbsp;&nbsp;';
	
			if($currpage<=4) for($i=1;$i<$currpage;$i++) echo '<a href="'.$linkstr.(($i-1)*$tovarsinpage).$addstr.'">'.$i.'</a>&nbsp;&nbsp;';
			else 
			{
				echo '<a href="'.$linkstr.(0).$addstr.'">1</a>&nbsp;&nbsp;<span>...&nbsp;&nbsp;';
				for($i=$currpage-3;$i<$currpage;$i++) echo '<a href="'.$linkstr.(($i-1)*$tovarsinpage).$addstr.'">'.$i.'</a>&nbsp;&nbsp;';
			}
	
			echo '<a href="" class="on">'.$currpage.'</a>&nbsp;&nbsp;';
			
			if($currpage>=$allpages-3)  for($i=$currpage+1;$i<=$allpages;$i++) echo '<a href="'.$linkstr.(($i-1)*$tovarsinpage).$addstr.'">'.$i.'</a>&nbsp;&nbsp;';
			else
			{
				for($i=$currpage+1;$i<$currpage+3;$i++) echo '<a href="'.$linkstr.(($i-1)*$tovarsinpage).$addstr.'">'.$i.'</a>&nbsp;&nbsp;';
				echo '<span>...&nbsp;&nbsp;<a href="'.$linkstr.(($allpages-1)*$tovarsinpage).$addstr.'">'.$allpages.'</a>&nbsp;&nbsp;';
			}
	
			if($currpage<$allpages) echo '<a href="'.$linkstr.(($currpage)*$tovarsinpage).$addstr.'">&gt;&gt;</a>&nbsp;&nbsp;';
	
			echo '</div>';
		}
	}
	
	//убрать в модуль
	function MakeNavString($tablename,$id,$moduleact,$navtitle='Главные категории')
	{
            $pid = $id;
            $k = 0;
            $navstr = '';
            while($pid != 0)
            {
                    $k++; if($k>10) break; //против зацикливаний при сбоях структуры базы

                    $sql = "SELECT * FROM $tablename WHERE id=$pid";
                    $res = mysql_query($sql);
                    if($line = mysql_fetch_array($res,MYSQL_ASSOC))
                    {
                            $navstr = ' -> <a href="admin.php?act='.$moduleact.'&id='.$pid.'">'.htmlspecialchars($line['title']).'</a> '. $navstr;
                            $pid = $line['parentid'];
                    }
            }
            $navstr = '<a href="admin.php?act='.$moduleact.'">'.htmlspecialchars($navtitle).'</a> '.$navstr;

            $navstr = '<center><h2>'.$navstr.'</h2></center>';
	    
	    return $navstr;
	}
	
	function ShowFCK($fieldname,$fieldvalue)
	{
	
		return '
		<textarea name="'.$fieldname.'">'.$fieldvalue.'</textarea>
		
		<script>
				CKEDITOR.replace(\''.$fieldname.'\' );
		</script>
		';

/*
		//$sBasePath = $_SERVER['PHP_SELF'];
		$sBasePath = '/admin/plugins/fckeditor/';
//		$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
		$oFCKeditor = new FCKeditor($fieldname) ;
		$oFCKeditor->BasePath	= $sBasePath ;
		$oFCKeditor->Value = $fieldvalue;
		$oFCKeditor->Height = 300 ;
		$oFCKeditor->Create() ;
*/		
	}
	
	function CreateAdminPic($picmode,$tmpname,$newname,$picw,$pich,$quality=100)
	{
		if($picmode=="none")
		{
		    
		}

		if($picmode=="same")
		{
		    copy($tmpname,$newname);
		}
		
		if($picmode=="byh")
		{
		    CreateSmallPicByH($tmpname,$newname,$pich,$quality);
		}
		
		if($picmode=="byw")
		{
		    CreateSmallPicByW($tmpname,$newname,$picw,$quality);
		}

		if($picmode=="bywh")
		{
		    CreateSmallPicByWH($tmpname,$newname,$picw,$pich,$quality);
		}
		
		if($picmode=="bywhcenterh")
		{
		    CreateSmallPicByWHCenterH($tmpname,$newname,$picw,$pich,$quality);
		}

		if($picmode=="bywhcenterw")
		{
		    CreateSmallPicByWHCenterW($tmpname,$newname,$picw,$pich,$quality);
		}

		if($picmode=="bigsize")
		{
		    CreateSmallPicByBigSize($tmpname,$newname,$picw,$pich,$quality);
		}
		
	}

	//Доступные темы админки
	function GetDrawerSelect()
	{
		if(isset($_SESSION['current_admin_drawer'])) $drawer = $_SESSION['current_admin_drawer'];
		else $drawer = '';
		
		$drawers = Array();
		$d = dir("drawer");
		while (false !== ($entry = $d->read()))
		{
			if($entry!='.' && $entry!='..' && is_dir('drawer/'.$entry))
			{
				include "drawer/".$entry."/drawerinfo.php";
				$drawers[] = Array('name'=>$drawer_name, 'dir'=>$entry);
			}
		}
		$d->close();

		$drawerselect = 
		$ret = '<select onchange="document.location.href=\'/admin/work.php?act=changedrawer&d=\'+this.value;">';
		foreach($drawers AS $key=>$value)
		{
			$ret.= '<option value="'.$value['dir'].'"'.($drawer==$value['dir'] ? ' selected ' : '' ).' >'.$value['name'].'</option>';
			
		}
		$ret.= '</select>';
		
		return $ret;
	}

?>