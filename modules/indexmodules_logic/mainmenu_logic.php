<?
  $activemenuid = 0;

  if($act=="menu") $activemenuid = $id;
	
  if($act=="cat") $activemenuid = $id;
  
  if($act=="tovar") $activemenuid = $activecatid;//end($activearr);
  
  if($act=="search") $activemenuid = 0;

  if($act=="none")
  {
    $sql = "SELECT * FROM $par->topmenutable WHERE url='/'";
    $res = mysql_query($sql);
    if($line = mysql_fetch_array($res,MYSQL_ASSOC)) $activemenuid = $line['id'];
  }

  
  /*if($act=="news" || $act=="gallery" || $act=="contacts" || $act=="cat" || $act=="articles")
  {
    $sql = "SELECT * FROM $par->topmenutable WHERE url='/$act'";
    $res = mysql_query($sql);
    if($line = mysql_fetch_array($res,MYSQL_ASSOC)) $activemenuid = $line['id'];
  }*/
  
	$k=0;
	while($activemenuid!=0)
	{
		$k++;
		$sql = "SELECT * FROM $par->categorytable WHERE id=$activemenuid";
		$res = mysql_query($sql);
		if($line = mysql_fetch_array($res,MYSQL_ASSOC))
		{
			if($line['parentid']==0) break;
			else $activemenuid = $line['parentid'];
		}
		if($k>10) break; //от бесконечного цикла
	}
  
  $mainmenuarr = Array();
?>
      <?
          //делаем выборку всех видимых пунктов меню первого уровня
          $sql1 = "SELECT * FROM $par->categorytable WHERE parentid=0 AND hide=0 ORDER BY prior";
          $res1 = mysql_query($sql1);
          $nrows1 = mysql_num_rows($res1);
          $k = 0;
          while($line1 = mysql_fetch_array($res1,MYSQL_ASSOC))
          {
            $k++;
			

            //определяем какой класс будет у пункта (first,last,active...) так в верстке было
            $addclass = '';
            if($k==1) $addclass = 'first ';
            if($k==$nrows1) $addclass = 'last ';
            if($line1['id']==$activemenuid) $addclass.=' active ';
            if($addclass!='') $addclass = ' class="'.$addclass.'" ';

            if($line1['id']==$activemenuid) $isactive = true;
			else $isactive = false;
            
            $url1 = GetSeoUrl('cat',$line1['id'],$line1);

			
            //echo '<li '.$addclass.' ><a href="'.$url1.'"><span>'.htmlspecialchars($line1['title'.$langadd]).'</span></a>';

			$submenu1 = Array();

            //делаем выборку второго уровня, для заданного пункта
            $sql2 = "SELECT * FROM $par->categorytable WHERE parentid=".$line1['id']." AND hide=0 ORDER BY prior";
            $res2 = mysql_query($sql2);
            $nrows2 = mysql_num_rows($res2);
            if($nrows2>0) //если есть пункты второго уровня
            {
	      $k2=0;
              while($line2 = mysql_fetch_array($res2,MYSQL_ASSOC))
		{
		  $k2++;
		  $url2 = GetSeoUrl('cat',$line2['id'],$line2);
      
      
		/*  $fname2 = ''; $addstr2 = '';
		  //определяем картинку
		  if(is_file('fotos/service_sm_'.$line2['id'].'.jpg')) $fname2 = 'fotos/slider_sm_'.$line2['id'].'.jpg';
	      
		  
		  //если картинка больше нужных размеров приводим ее к нужным
		  if($fname2!='')
		  {
		      $addstr2 = GetAddStr(134,134,$fname2);
		      $fname2 = '/'.$fname2;
		  }*/

		  //echo '<li><a href="'.$url2.'">'.htmlspecialchars($line2['title'.$langadd]).'</a></li>';
		  
		  $sql3 = "SELECT * FROM $par->categorytable WHERE parentid=".$line2['id']." AND hide=0 ORDER BY prior";
		  
		  $res3 	= mysql_query($sql3);
		  $nrows3 	= mysql_numrows($res3);
		  $submenu2 	= array();
		  if ($nrows3>0)
		  {
		      $k3 = 0;
		      while ($line3 = mysql_fetch_array($res3,MYSQLI_ASSOC))
		      {
			  $k3++;
			  $url3 = GetSeoUrl('cat',$line3['id'],$line3);
			  
			  /*$fname3 = ''; $addstr3 = '';
			  //определяем картинку
			  if(is_file('fotos/service_sm_'.$line3['id'].'.jpg')) $fname3 = 'fotos/slider_sm_'.$line3['id'].'.jpg';
		      
			  
			  //если картинка больше нужных размеров приводим ее к нужным
			  if($fname3!='')
			  {
			      $addstr3 = GetAddStr(134,134,$fname3);
			      $fname3 = '/'.$fname3;
			  }*/

			  
			  $submenu2[] = Array('id'=>$line3['id'],'url'=>$url3,'title'=>$line3['title']);
		      }
		  }
		  //print_r($submenu2);exit;
		  $submenu1[] = Array('id'=>$line2['id'], 'url'=>$url2,'title'=>$line2['title'.$langadd],'isfirst'=>($k2==1),'islast'=>($k2==$nrows2),'submenu'=>$submenu2);
              }
            }
			
			$mainmenuarr[] = Array('id'=>$line1['id'],'url'=>$url1,'title'=>$line1['title'.$langadd],'isactive'=>$isactive,'isfirst'=>($k==1),'islast'=>($k==$nrows1),'submenu'=>$submenu1);
			
            
          }
    
  $_logic['mainmenuarr'] = $mainmenuarr;
    
    
    
    
  $mainrightarr = Array(); 
  
  $sqlright = "SELECT * FROM $par->topmenutable WHERE hide=0 ORDER BY prior";
  
  $resright 	= mysql_query($sqlright);
  $nrowsright 	= mysql_numrows($resright);
  $submenu2 	= array();
  if ($nrowsright>0)
  {
    while ($lineright = mysql_fetch_array($resright,MYSQLI_ASSOC))
    {
      $urlright 	= GetSeoUrl('menu',$lineright['id'],$lineright);
      $mainrightarr[] 	= Array('id'=>$lineright['id'],'url'=>$urlright,'title'=>$lineright['title'], 'show'=>$lineright['spec1'],'show2'=>$lineright['spec2']);
    }
  }
  $_logic['mainrightarr'] = $mainrightarr;
  //debug ($mainrightarr);exit;
    
   

?>
