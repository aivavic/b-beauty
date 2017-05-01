<?	
	///////////////////////////////
	function myaddslashes($s)
	{
		if (get_magic_quotes_gpc()) 
		{	
			return $s;
		}
		else
		{
			return addslashes($s);
		}
	}
	
	function GetAddStr($w,$h,$fname,$size=null)
	{
		global $par;
		
		if($size==null)
		{
			$size = @getimagesize($par->document_root.'/'.$fname);
		}

		$addstr='';
		if($size[0]>$w || $size[1]>$h)
		{
			if($size[0]*$h > $size[1]*$w)
			{
				$addstr = ' width="'.$w.'" ';
			}
			else $addstr = ' height="'.$h.'"';
		}
		return $addstr;
	}

	function GetAddStrH($h,$fname,$size=null)
{
    global $par;

    if($size==null)
    {
        $size = @getimagesize($par->document_root.'/'.$fname);
    }

    $addstr='';
    if($size[1]>$h)
    {
         $addstr = ' height="'.$h.'"';
    }
    return $addstr;
}
	
	
	function IsChecked($a,$b)
	{
		if($a==$b) return ' checked ';
		else return '';
	}
	
	function MakeSelect($selarr,$active=0)
	{
		$s = '<select name="'.$selarr[0].'" id="'.$selarr[0].'"><option value="0">-----------------------------</option>';
		for($i=1;$i<count($selarr);$i++)
		{
			if($i==$active) $s.= '<option value="'.$i.'" selected>'.htmlspecialchars($selarr[$i]).'</option>';
			else $s.= '<option value="'.$i.'">'.htmlspecialchars($selarr[$i]).'</option>';
		}
		$s.= '</select>';
		return $s;
	}



	
	function Tys($p)
	{
		if($p<10) return "00".$p;
		else if($p<100) return "0".$p;
		else return $p;
	}
	
	function PriceToStr($pr)
	{
		$fr = (floor($pr*10) % 10);
		if($fr==0) $frs = ''; else $frs = '.'.$fr;
		
		if($pr<1000) return $pr;
		else if($pr<1000000) return "".(floor($pr / 1000))." ".Tys($pr % 1000).$frs;
		else 
		{
			$s = "".Tys($pr % 1000);
			$pr = floor($pr / 1000);
			$s = Tys($pr % 1000)." ".$s;
			$pr = floor($pr / 1000);
			$s = $pr." ".$s.$frs;
			return $s;
		}
	}
	
	function DaNet($k)
	{
		if($k==0) return 'нет'; else return 'да';
	}
	
	function ReplaceUriStart($uri,$oldstart,$newstart)
	{
		$p = strpos($uri,'start=');
		$uri = substr($uri,0,$p+6);
		$uri.= $newstart;
		return $uri;
	}
	
	function WithoutZero($p)
	{
		if($p==0) return '';
		else return (float)$p;
	}

	function GetPager($sql,$linkstr,$objperpage=0,$addstr='',$startmode=0)
	{
		global $par,$varsline,$start;
		$res = mysql_query($sql);
		$line = mysql_fetch_array($res,MYSQL_ASSOC);
		$all = $line['ccc'];
		
		$pagerarr = Array();

		if($objperpage==0) $tovarsinpage = (int)$varsline['tovarsinpage'];
		else $tovarsinpage = $objperpage;

		$allpages = floor(($all-1)/$tovarsinpage)+1;
		$currpage = floor($start/$tovarsinpage)+1;

		if($startmode==0) $linkstr.= '/start/';
		else $linkstr.= '&start=';

		if($allpages>1)
		{
			if($currpage>1) $pagerarr[] = Array('url'=>$linkstr.(($currpage-2)*$tovarsinpage).$addstr , 'value'=>'&lt;&lt;');
			
	
			if($currpage<=4) for($i=1;$i<$currpage;$i++) $pagerarr[] = Array('url'=>$linkstr.(($i-1)*$tovarsinpage).$addstr , 'value'=>$i);
			else 
			{
				$pagerarr[] = Array('url'=>$linkstr.(0).$addstr,'value'=>1);
				$pagerarr[] = Array('url'=>null,'value'=>null);
				for($i=$currpage-2;$i<$currpage;$i++) $pagerarr[] = Array('url'=>$linkstr.(($i-1)*$tovarsinpage).$addstr , 'value'=>$i);
			}
	
			$pagerarr[] = Array('url'=>null, 'value'=>$currpage);

			if($currpage>=$allpages-3)  for($i=$currpage+1;$i<=$allpages;$i++) $pagerarr[] = Array('url'=>$linkstr.(($i-1)*$tovarsinpage).$addstr , 'value'=>$i);
			else
			{
				for($i=$currpage+1;$i<$currpage+3;$i++) $pagerarr[] = Array('url'=>$linkstr.(($i-1)*$tovarsinpage).$addstr , 'value'=>$i);
				$pagerarr[] = Array('url'=>null, 'value'=>null);
				$pagerarr[] = Array('url'=>$linkstr.(($allpages-1)*$tovarsinpage).$addstr , 'value'=>$allpages);
			}
	
			if($currpage<$allpages) $pagerarr[] = Array('url'=>$linkstr.(($currpage)*$tovarsinpage).$addstr , 'value'=>'&gt;&gt;');
		}
		return $pagerarr;
	}
	
	function PrintPager($sql,$linkstr,$objperpage=0,$addstr='',$startmode=0)
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
			echo '<div class="pagenavi">';
	
			if($currpage>1) echo '<a href="'.$linkstr.(($currpage-2)*$tovarsinpage).$addstr.'"> &lt;&lt;</a>&nbsp;&nbsp;';
	
			if($currpage<=4) for($i=1;$i<$currpage;$i++) echo '<a href="'.$linkstr.(($i-1)*$tovarsinpage).$addstr.'">'.$i.'</a>&nbsp;&nbsp;';
			else 
			{
				echo '<a href="'.$linkstr.(0).$addstr.'">1</a>&nbsp;&nbsp;<span>...</span>&nbsp;&nbsp;';
				for($i=$currpage-2;$i<$currpage;$i++) echo '<a href="'.$linkstr.(($i-1)*$tovarsinpage).$addstr.'">'.$i.'</a>&nbsp;&nbsp;';
			}
	
			//echo '<a href="" class="on">'.$currpage.'</a>&nbsp;&nbsp;';
			echo '<span>'.$currpage.'</span>&nbsp;&nbsp;';
			
			if($currpage>=$allpages-3)  for($i=$currpage+1;$i<=$allpages;$i++) echo '<a href="'.$linkstr.(($i-1)*$tovarsinpage).$addstr.'">'.$i.'</a>&nbsp;&nbsp;';
			else
			{
				for($i=$currpage+1;$i<$currpage+3;$i++) echo '<a href="'.$linkstr.(($i-1)*$tovarsinpage).$addstr.'">'.$i.'</a>&nbsp;&nbsp;';
				echo '<span>...</span>&nbsp;&nbsp;<a href="'.$linkstr.(($allpages-1)*$tovarsinpage).$addstr.'">'.$allpages.'</a>&nbsp;&nbsp;';
			}
	
			if($currpage<$allpages) echo '<a href="'.$linkstr.(($currpage)*$tovarsinpage).$addstr.'">&gt;&gt;</a>&nbsp;&nbsp;';
	
			echo '</div>';
		}
	}
	

	
	function TrueStr($b,$s1,$s2='')
	{
		if($b) return $s1; else return $s2;
	}

	function newuri($olduri,$currorder,$needorder)
	{
		if(strpos($olduri,'sortorder=')!==false)
		{
			if(abs($currorder)==$needorder) return str_replace('sortorder='.$currorder,'sortorder='.(-$currorder),$olduri);
			else return str_replace('sortorder='.$currorder,'sortorder='.$needorder,$olduri);
		}
		
		if(strpos($olduri,'&sortorder=')==false)
		{
			return $olduri.'&sortorder='.$needorder;
		}
		else
		{
			if(abs($currorder)==$needorder) return str_replace('&sortorder='.$currorder,'&sortorder='.(-$currorder),$olduri);
			else return str_replace('&sortorder='.$currorder,'&sortorder='.$needorder,$olduri);
		}
	}
	
	function MakeNav($id)
	{
		global $par;
		$s = '';

		$k=0;
		while($id!=0)
		{
			$k++; if($k>10) break;
			$sql = "SELECT * FROM $par->deepmenu2itemstable WHERE id=$id";
			$res = mysql_query($sql);
			$line = mysql_fetch_array($res,MYSQL_ASSOC);

			if($k==1) $s = '<a href="/cat/'.$line['id'].'">'.htmlspecialchars($line['title']).'</a>'.$s;
			else $s = '<a href="/cat/'.$line['id'].'">'.htmlspecialchars($line['title']).'</a> &gt; '.$s;

			$id = $line['parentid'];
		}
		return $s;
	}


	function GetInStr($id,$tablename='category')
	{
		global $par;
		$s = ','.$id;
		$sql = "SELECT * FROM $tablename WHERE parentid=$id";
		$res = mysql_query($sql);
		while($line = mysql_fetch_array($res,MYSQL_ASSOC))
		{
			$s.=GetInStr($line['id']);
		}
		return $s;
	}
	
	function GetTovarov($d)
	{
		if($d%100>=11 && $d%100<=19) return 'товаров';
		if($d%10==0) return 'товаров';
		if($d%10==1) return 'товар';
		if($d%10==2) return 'товара';
		if($d%10==3) return 'товара';
		if($d%10==4) return 'товара';
		return 'товаров';
	}
	
	function uploadify($gid, $gallerypics, $table=1)
	{
		$json_gallerypics = json_encode($gallerypics);  //переводим массив в json строку
		
		foreach($gallerypics AS $key=>$value)
		{
			$fname = $value['picprefix'];
			break;
		}
	
		$retstr = '';
		
			$retstr.=
			'<link href="/utils/uploadify/uploadify.css" type="text/css" rel="stylesheet" />
			<link href="/utils/uploadify/gallery.css" type="text/css" rel="stylesheet" />
			<script type="text/javascript" src="/utils/uploadify/jquery-1.4.2.min.js"></script>
			<script type="text/javascript" src="/utils/uploadify/swfobject.js"></script>
			<script type="text/javascript" src="/utils/uploadify/jquery.uploadify.v2.1.4.min.js"></script>
			<script class="jsbin" src="/utils/uploadify/jquery-ui.min.js"></script>';

		
		$retstr.='
		<script type="text/javascript">
		function del(myObj,myObjId){
		
			$.post
				(
					"/admin/ajax.php",
					{
						act : "delgal",
						table : "'.$table.'",
						id : myObjId,
						json_gallerypics:'.$json_gallerypics.'
					},
					function(data) {
					   $par=$(myObj).parent().parent();
					   $par.remove();
						imgFirst = $(".items").sortable("toArray").toString();
					}
				);
		}

		$(document).ready(function() {
			$.post
				(
					"/admin/ajax.php",
					{
						act : "showgal",
						id : '.$gid.',
						fname: "'.$fname.'",
						table: "'.$table.'",
						test: "test1",
						json_gallerypics:'.$json_gallerypics.'
					},
					function(data) {
					   $("#gallery").html(data);
					}
				);
			$("#file_upload").uploadify({
				"uploader"  : "/utils/uploadify/uploadify.swf",
				"script"    : "/utils/uploadify/uploadify.php?",
				"cancelImg" : "/utils/uploadify/cancel.png",
				"scriptData" : {id : '.$gid.', table : "'.$table.'" , test: "test4", json_gallerypics:"'.addslashes($json_gallerypics).'"},
				"folder"    : "/fotos",
				"multi"          : true,
				"auto"      : true,
				"buttonImg" : "/utils/uploadify/upload.gif",
				"fileExt"        : "*.jpg;*.gif;*.png;",
				"fileDesc"       : "Image Files (.JPG, .GIF, .PNG)",
				"onAllComplete" : function(event,data) {

					$.post(
						"/admin/ajax.php",
						{
							act : "showgal",
							id : '.$gid.',
							fname: "'.$fname.'",
							table: "'.$table.'",
							test: "test2"
						},
						function(data) {
							 $("#gallery").html(data);
						}
					);
				}
			});
		});
		</script>
		';
		
		$retstr .= '
		<div id="gallery">
			
		</div>
			<div class="uploadbut"><input id="file_upload" name="file_upload" type="file" /></div>
			<div class="updategal"></div>';
			
		return $retstr;
	}
	
	function GetSeoUrl($act,$id,$line=null,$needlang=null,$subact="", $withstart=false)
	{
		global $par, $start, $langadd,$urllangadd;
		
		
		$returnurl = '';
		
		if($needlang)
		{
			$t = array_search($needlang,$par->langsarr['plangsarr']);
			$t_langadd = $par->langsarr['admlangssuffix'][$t];
			$t_urllangadd = $par->langsarr['urllangsaddarr'][$t];
		}
		else
		{
			$t_langadd = $langadd;
			$t_urllangadd = $urllangadd;
		}
		
		foreach($par->params AS $param)
		{
			$needact = $param['actname'];
			$tablename = $param['tablename'];
			$urlprefix = $param['urlprefix'];
			
			//для главной страницы
			if($act=="none")
			{
				$sql = "SELECT * FROM $par->topmenutable WHERE `url`='/'";
				$res = mysql_query($sql);
				if($line = mysql_fetch_array($res,MYSQL_ASSOC))
				{
					$returnurl = $line['url'.$t_langadd];
				}
			}
			
			if($needact==$act)
			{
				if($id==0)
				{
					$sql = "SELECT * FROM $par->topmenutable WHERE `url`='/$needact'";
					//echo $sql.'<BR>';
					$res = mysql_query($sql);
					if($line = mysql_fetch_array($res,MYSQL_ASSOC))
					{
						$returnurl = $line['url'.$t_langadd];
					}
				}
				else
				{
					if(!$line)
					{
						$sql = "SELECT * FROM $tablename WHERE id=$id";
						$res = mysql_query($sql);
						$line = mysql_fetch_array($res,MYSQL_ASSOC);
					}
					
					if($line)
					{
						
						if(!isset($line['url'.$t_langadd]) || trim($line['url'.$t_langadd])=='')
						{
							if(!isset($line['seo'.$t_langadd]) || trim($line['seo'.$t_langadd])=='') $returnurl = '/'.$urlprefix.'/'.$line['id'].$t_urllangadd;
							else
							{
								if($line['seo'.$t_langadd][0]=='/') $returnurl = $line['seo'.$t_langadd];
								else $returnurl = '/'.$urlprefix.'/'.$line['seo'.$t_langadd];
							}
						}
						else $returnurl = $line['url'.$t_langadd];
					}
				}
			}
		}
		
		if($withstart && isset($start) && $start!=0) $returnurl.='/start/'.$start;
		
		return $returnurl;
	}
	
	function ShowAlert($text,$text2='')
	{
		return '<script> alert(\''.$text.'\');</script>';
	}
	


    function GetActiveArr($act,$tablename,$activecatid)
    {
        global $par;
        $activearr = Array();
        $pid = $activecatid;
        $k = 0;
        while($pid!=0)
        {
          $k++;
          if($k>10) break; //глубина вложенности не больше 10
          $activearr[$k] = $pid;
          $sql = "SELECT * FROM $tablename WHERE id=$pid";
          $res = mysql_query($sql);
          if($line = mysql_fetch_array($res,MYSQL_ASSOC))
          {
              $pid = $line['parentid'];
          }
        }
        return $activearr;
    }

    function PrintDeepMenu($act,$tablename,$parentid,$maxlevel,$level,$activearr)
    {
        global $par,$langadd;

        //делаем выборку всех видимых пунктов меню уровня
        $sql1 = "SELECT * FROM $tablename WHERE parentid=$parentid AND hide=0 ORDER BY prior";
        $res1 = mysql_query($sql1);
        $nrows1 = mysql_num_rows($res1);
        if($nrows1>0)
        {
            echo '<ul>';
            while($line1 = mysql_fetch_array($res1,MYSQL_ASSOC))
            {
                $url1 = GetSeoUrl($act,$line1['id'],$line1);
      
                echo '<li '.TrueStr(in_array($line1['id'],$activearr),' class="active" ').' ><a href="'.$url1.'">'.htmlspecialchars($line1['title'.$langadd]).'</a>';
    
                //если пункт активный - раскрываем подкатегории
                if(in_array($line1['id'],$activearr))
                {
                    PrintDeepMenu($act,$tablename,$line1['id'],$maxlevel,$level+1,$activearr);
                }
                echo '</li>';
            }
            echo '</ul>';
        }
    }

	/* Возвращает массив категорий каталога для меню*/
	function GetDeepMenuArr($act,$tablename,$parentid,$maxlevel,$level,$activearr,$showallsubitems=false/* Выбирать все подпункты или только у активного пункта*/)
	{
	    global $par,$langadd;
	    
	    $resarr = Array();
	
	    //делаем выборку всех видимых пунктов меню уровня
	    $sql1 = "SELECT * FROM $tablename WHERE parentid=$parentid AND hide=0 ORDER BY prior";
	    $res1 = mysql_query($sql1);
	    $nrows1 = mysql_num_rows($res1);
	    if($nrows1>0)
	    {
		while($line1 = mysql_fetch_array($res1,MYSQL_ASSOC))
		{
		    $t = Array();
		    
		    $url1 = GetSeoUrl($act,$line1['id'],$line1);
	  
//		    echo '<li '.TrueStr(in_array($line1['id'],$activearr),' class="active" ').' ><a href="'.$url1.'">'.htmlspecialchars($line1['title'.$langadd]).'</a>';

		    $t['id'] = $line1['id'];
		    $t['url'] = $url1;
		    $t['title'] = $line1['title'.$langadd];
		    
		    if(in_array($line1['id'],$activearr)) $t['isactive'] = true;
	
		    //если опция покаpывать все подпункты, или если пункт активный - то раскрываем подкатегории
		    if($showallsubitems || in_array($line1['id'],$activearr))
		    {
			$t['subarr'] = GetDeepMenuArr($act,$tablename,$line1['id'],$maxlevel,$level+1,$activearr);
		    }
		    
		    $resarr[] = $t; 
		}
	    }
	    return $resarr;
	}
    
	function GetProductInfo($id,$line=null,$paramfunc = null)
	{
		global $par,$langadd,$urllangadd;
		
		$productitem = Array();

		if($line==null)
		{
			$sql = "SELECT * FROM $par->objectstable WHERE id=$id";
			$res = mysql_query($sql);
			$line = mysql_fetch_array($res,MYSQL_ASSOC);
		}
		//debug($line);exit;
		$brandname="";
		if (isset($line['brendid']) && $line['brendid']!=0)
		{
			$brandid = $line['brendid'];
			$sqlbrand = "SELECT * FROM $par->brandstable WHERE id=$brandid";
			$resbrand = mysql_query($sqlbrand);
			$linebrand = mysql_fetch_array($resbrand,MYSQL_ASSOC);
			$brandname = $linebrand['name'];
			
		}
		if($line==null)
		{
			$productitem['isdeleted'] = true;
			return $productitem;
		}
		
		if(isset($line['klonid']) && $line['klonid']!=0)
		{
			$sql = "SELECT * FROM $par->objectstable WHERE id=".$line['klonid'];
			$res = mysql_query($sql);
			$line = mysql_fetch_array($res,MYSQL_ASSOC);
		}

		$myurl = GetSeoUrl('tovar',$line['id'],$line);

/*		
		//определяем заглавное фото товара
		$fname = 'utils/images_z/nofoto.png';
		$sqltmp = "SELECT * FROM $par->fotorobjtable WHERE reportid=".$line['id']." AND hide=0 ORDER BY prior LIMIT 0,1";
		$restmp = mysql_query($sqltmp);
		if($linetmp = mysql_fetch_array($restmp,MYSQL_ASSOC))
		{
			if(is_file('fotos/object_sm'.$linetmp['id'].'.jpg'))
			{
				$fname = 'fotos/object_sm'.$linetmp['id'].'.jpg';
			}
		}
		
		$addstr = '';
		if($fname!='')
		{
			$addstr = GetAddStr(200,150,$fname);
			$fname = '/'.$fname;
		}
*/		
		//формируем массив фотографий товара
		$objfotos = Array(); $objc = 0;

		$sqltmp = "SELECT * FROM $par->fotorobjtable WHERE reportid=".$line['id']." AND hide=0 ORDER BY prior DESC";
		
		//если не надо все фотографии
		if(! (isset($paramfunc['allfotos']) && $paramfunc['allfotos']==true))
		{
				$sqltmp.=" LIMIT 0,1";
		}
		$restmp = mysql_query($sqltmp);
		while($linetmp = mysql_fetch_array($restmp,MYSQL_ASSOC))
		{
            $t = 'fotos/'.$linetmp['filename'].'_sm.jpg';
			if(is_file($par->document_root.'/'.$t))
			{
				//$fname = '/fotos/object_sm_'.$linetmp['id'].'.jpg';
                $fname = '/'.$t;
			}
			else $fname = '';

            $t = 'fotos/'.$linetmp['filename'].'.jpg';
			if(is_file($par->document_root.'/'.$t))
			{
				//$fnamebig = '/fotos/object_bg_'.$linetmp['id'].'.jpg';
                $fnamebig = '/'.$t;
			}
			else $fnamebig='';
			$objfotos[$objc++] = Array('fname'=>$fname, 'fnamebig'=>$fnamebig);
		}
/*
		$addstr = '';
		if($objc>0 && $objfotos[0]['fname']!='')
		{
			$addstr = GetAddStr(180,200,$objfotos[0]['fname']);
			$fname = '/'.$objfotos[0]['fname'];
			$fnamebig = '/'.$objfotos[0]['fnamebig'];
		}
		else
		{
				$fname = 'utils/images_z/nofoto.png';
				$fnamebig = '';
				$addstr = GetAddStr(180,200,$fname);
				$fname = '/'.$fname;
		}
*/

		
		$productitem['url'] = $myurl;
		$productitem['fname'] = $fname; //адрес миниатюры товара
		$productitem['fnamebig'] = $fnamebig; //адрес фотки товара
		//$productitem['addstr'] = $addstr; //параметры размеров		// width="xxx" height="xxx"
		$productitem['objfotos'] = $objfotos; //массив всех фото товара
		$productitem['title'] = $line['title'.$langadd];

		if(isset($line['shorttext'.$langadd])) $productitem['shorttext'] = $line['shorttext'.$langadd];
		if(isset($line['text'.$langadd])) $productitem['text'] = $line['text'.$langadd];
		$productitem['image_alt'] = $productitem['title'];
		$productitem['price'] = $line['price'];
		$productitem['pricestr'] = PriceToStr($line['price']);
		$productitem['brand_name'] = $brandname;
		
		if(isset($line['priceold']))
		{
			$productitem['priceold'] = $line['priceold'];
			$productitem['priceoldstr'] = PriceToStr($line['priceold']);
		}
		$productitem['price_valuta'] = 'грн';

		$productitem['id'] = $line['id'];
		$productitem['artikul'] = $line['artikul'];
		$productitem['line'] = $line;

		
		return $productitem;
	}



/*
	function ProductBlock($id,$line=null,$k=0)
      {
	global $par,$langadd,$urllangadd;
	
	if($line==null)
	{
		$sql = "SELECT * FROM $par->objectstable WHERE id=$id";
		$res = mysql_query($sql);
		$line = mysql_fetch_array($res,MYSQL_ASSOC);
	}
	
	if($line['klonid']!=0)
	{
		$sql = "SELECT * FROM $par->objectstable WHERE id=".$line['klonid'];
		$res = mysql_query($sql);
		$line = mysql_fetch_array($res,MYSQL_ASSOC);
	}

	$myurl = GetSeoUrl('tovar',$line['id'],$line);

	//определяем заглавное фото товара
	$fname = 'utils/images_z/nofoto.png';
	$sqltmp = "SELECT * FROM $par->fotorobjtable WHERE reportid=".$line['id']." AND hide=0 ORDER BY prior LIMIT 0,1";
	$restmp = mysql_query($sqltmp);
	if($linetmp = mysql_fetch_array($restmp,MYSQL_ASSOC))
	{
	    if(is_file('fotos/object_sm'.$linetmp['id'].'.jpg'))
	    {
		$fname = 'fotos/object_sm'.$linetmp['id'].'.jpg';
	    }
	}

	$addstr = '';
	if($fname!='')
	{
	    $addstr = GetAddStr(200,150,$fname);
	    $fname = '/'.$fname;
	}
	

	echo '
          <div class="product">
            <div class="image"><a href="'.$myurl.'"><img src="'.$fname.'" '.$addstr.' alt="'.htmlspecialchars($line['title'.$langadd]).'" /></a></div>
            <h2><a href="'.$myurl.'">'.htmlspecialchars($line['title'.$langadd]).'</a></h2>
            <p class="price">'.PriceToStr($line['price']).' <span>руб.</span> <a href="#" onclick="AddToBasket('.$line['id'].','.$line['price'].'); return false;">В корзину</a></p>
          </div>
	  ';
      }
*/      
      function NStr($n,$s)
      {
	$ss = '';
	for($i=1;$i<=$n;$i++) $ss.=$s;
	return $ss;
      }
      
	function GetTitle($line)
	{
		global $langadd, $varsline;
		if(trim($line['titletitle'.$langadd])!='') $titletitle = htmlspecialchars($line['titletitle'.$langadd]);
		else $titletitle = htmlspecialchars($line['title'.$langadd]);
		return htmlspecialchars($varsline['titleprefix'.$langadd]).$titletitle.htmlspecialchars($varsline['titlesuffix'.$langadd]);
	}
      
	function GetKeywords($line)
	{
		global $langadd;

		$addmeta = '';
		$t = htmlspecialchars($line['title'.$langadd]);

		if(trim($line['titlekeywords'.$langadd])!='') $addmeta .= '<meta name="keywords" content="'.htmlspecialchars($line['titlekeywords'.$langadd]).'" />';
		else $addmeta .= '<meta name="keywords" lang="ru" content="'.$t.'" />';

		if(trim($line['titledescription'.$langadd])!='') $addmeta .= '<meta name="description" content="'.htmlspecialchars($line['titledescription'.$langadd]).'" />';
		else $addmeta .= '<meta name="description" content="'.$t.'" />';

		if(isset($line['metatags'.$langadd]) && trim($line['metatags'.$langadd])!='') $addmeta .= $line['metatags'.$langadd];

		return $addmeta;
	}
      

	
	
	
	// присвативает всем мультиязычным полям значение поля текущего языка title <- title.$langadd;
	function LangProcess($line)
	{
		global $langadd;
		if($langadd!='')
		{
			foreach($line AS $key=>$value)
			{
				if(isset($line[$key.$langadd])) $line[$key] = $line[$key.$langadd];
			}
		}
		return $line;
	}
	
	
	function GenSiteMapXml($sitemapfile)
	{
		global $par;
		
		$path = 'http://'.$_SERVER['HTTP_HOST'];
		
		$buf = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
		$buf.="<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
		
		foreach($par->params AS $param)
		{
			$actname = $param['actname'];
			$tablename = $param['tablename'];
			$urlprefix = $param['urlprefix'];
			
			if($tablename!='')
			{
				$sql = "SELECT * FROM $tablename";
				$res = mysql_query($sql);
				//echo $sql.'<BR>';
				while($line = @mysql_fetch_array($res,MYSQL_ASSOC))
				{
					foreach($par->langsarr['admlangs'] AS $key=>$value)
					{
						if($value==true)
						{
							//$suffix = $this->langsarr['admlangssuffix'][$key];
							$url = GetSeoUrl($actname,$line['id'],$line,$par->langsarr['plangsarr'][$key]);
							//$buf. = $path.$url;
							$buf.="  <url>\n";
							$buf.="    <loc>".$path.$url."</loc>\n";
							$buf.="    <lastmod>".date("Y-m-d",$line['modifydate'])."</lastmod>\n";
							$buf.="    <changefreq>always</changefreq>\n";
							$buf.="    <priority>1</priority>\n";
							$buf.="  </url>\n";
						}
					}
					
				}
			}
		}
		$buf.="</urlset>\n";
		
		file_put_contents($sitemapfile,$buf);
	}
	
	function Make404()
	{
		header('HTTP/1.1 404 Not Found');
		echo '404 page';
		exit();
	}
?>