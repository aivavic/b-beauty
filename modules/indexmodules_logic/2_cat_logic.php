<?
	if($act=="cat" || $act=="akcii" || $act=="novinki" || $act=="bestsellers" || $act=="search")
	{
		$catarr = Array();
		$objectsinpage = $varsline['objectsinpage'];
		
		$addlinkstr = '';
        $addlinkstr = $_SERVER['QUERY_STRING'];
        if ($addlinkstr!='') $addlinkstr = "?".$_SERVER['QUERY_STRING'];
		$startmode = 0;

        if (isset($_REQUEST['changebrend']) && $_REQUEST['changebrend']==1) $addsql = " AND `brendid`=".myaddslashes($_REQUEST['brendid']); else $addsql = '';
        if (isset($_REQUEST['changesize']) && $_REQUEST['size']!='--') $addsize = " AND CONCAT(';',`razmer`,';') LIKE '%;".myaddslashes($_REQUEST['size']).";%'"; else $addsize='';
        if (!isset($_SESSION['ordercat']) || $_SESSION['ordercat']==1) $ord = "DESC"; else $ord="ASC";
        //echo $_SESSION['ordercat'];exit;
		//если конкретная категория
		if($act=="cat"&&$id!=0)
		{


			$sql = "SELECT * FROM $par->categorytable WHERE hide=0 AND id=$id";
			$res = mysql_query($sql);
			$catline = mysql_fetch_array($res,MYSQL_ASSOC);

			//GetInStr - возвращает набор всех подкатегорий ,3,7,5,9
			//формируем строку (-1,3,7,5,9) где -1 просто техническое число для удобства GetInStr
			$instr = '(-1'.GetInStr($id,$par->categorytable).')';
            //$ord = "DESC";
			$sql = "SELECT * FROM $par->objectstable WHERE categid IN $instr AND hide=0 $addsql $addsize ORDER BY price $ord,prior LIMIT $start,$objectsinpage";
			$sql2 = "SELECT COUNT(id) AS ccc FROM $par->objectstable WHERE categid IN $instr AND hide=0 $addsql $addsize ";
			$linkstr = GetSeoUrl('cat',$id,$catline);

         //   unset ($_SESSION['currbrend']);
         //   unset ($_SESSION['size']);

         //    echo $sql.'<BR>';
		}

		//если главная страница каталога
		if($act=="cat"&&$id==0)
		{
			$sql = "SELECT * FROM $par->topmenutable WHERE url='/cat' ";
			$res = mysql_query($sql);
			$catline = mysql_fetch_array($res,MYSQL_ASSOC);

			$sql = "SELECT * FROM $par->objectstable WHERE  hide=0 ORDER BY prior LIMIT $start,$objectsinpage";
			$sql2 = "SELECT COUNT(id) AS ccc FROM $par->objectstable WHERE hide=0";
			$linkstr = '/cat';
		}

		// spec1=1
//		if($act=="novinki")
//		{
//			$catline['title'] = 'Новинки';
//			$catline['text'] = '';
//
//			$sql = "SELECT * FROM $par->objectstable WHERE spec1=1 AND hide=0 ORDER BY id LIMIT $start,$objectsinpage";
//			$sql2 = "SELECT COUNT(id) AS ccc FROM $par->objectstable WHERE spec1=1 AND hide=0";
//			$linkstr = '/novinki';
//		}

		// spec2=1
		if($act=="bestsellers")
		{
			$catline['title'] = 'Хиты продаж';
			$catline['text'] = '';

			$sql = "SELECT * FROM $par->objectstable WHERE spec2=1 AND hide=0 ORDER BY id LIMIT $start,$objectsinpage";
			$sql2 = "SELECT COUNT(id) AS ccc FROM $par->objectstable WHERE spec2=1 AND hide=0";
			$linkstr = '/bestsellers';
		}

		// spec3=1
		if($act=="akcii")
		{
			$catline['title'] = 'Акции';
			$catline['text'] = '';

			$sql = "SELECT * FROM $par->objectstable WHERE spec3=1 AND hide=0 ORDER BY id LIMIT $start,$objectsinpage";
			$sql2 = "SELECT COUNT(id) AS ccc FROM $par->objectstable WHERE spec3=1 AND hide=0";
			$linkstr = '/akcii';
		}

		// поиск товаров по слову
		if($act=="search")
		{
			$q = addslashes($_REQUEST['q']);

			$catline['title'] = 'Поиск: '.htmlspecialchars($_REQUEST['q']);
			$catline['text'] = '';

			$start=0;
			@$start=(int)htmlspecialchars($_REQUEST['start']);
			$sql = "SELECT * FROM $par->objectstable WHERE (`title` LIKE '%$q%' OR `text` LIKE '%$q%' OR `artikul` LIKE '%$q%') AND `hide`=0 ORDER BY id LIMIT $start,$objectsinpage";
			$sql2 = "SELECT COUNT(id) AS ccc FROM $par->objectstable WHERE (`title` LIKE '%$q%' OR `text` LIKE '%$q%'  OR `artikul` LIKE '%q%') AND `hide`=0";
			$linkstr = '/search/?p=0';
			$addlinkstr = '&q='.$_REQUEST['q'];
			$startmode = 1;
		}	
		
		$products = Array();
		$res = mysql_query($sql);
		while($line = mysql_fetch_array($res,MYSQL_ASSOC))
		{
			$products[] = LangProcess(GetProductInfo($line['id'],$line));
		}
		//debug($products);exit;
		if(isset($catline['titleh1']) && $catline['titleh1']!='') $catline['title'] = $catline['titleh1'];


       foreach ($products AS $k=>$val)
       {
           $products[$k]['line']['razmer'] = explode(";", $products[$k]['line']['razmer']);
       }


		$catarr['objectsinpage']=$objectsinpage;
		$catarr['catline']=LangProcess($catline);
		$catarr['products']=$products;		
		$catarr['pagerarr']=GetPager($sql2,$linkstr,$objectsinpage,$addlinkstr,$startmode);

        //$catarr['products']['line']['razmer'] = explode(";",$catarr['products']['line']['razmer']);
		$_logic['catarr'] = $catarr;
		//debug($catarr);

        if ($act == 'cat' && $id!=0)
        {
            $instr = GetInStr($id,$par->categorytable);
            $sql = "SELECT `razmer` FROM $par->objectstable WHERE `hide`=0 AND `categid` IN (-1 $instr) AND `razmer`!=''";
            //echo $sql.'<BR>';
            $res = mysql_query($sql);

            $sizes = Array();
            while($line = mysql_fetch_array($res,MYSQL_ASSOC))
            {
             //   echo $line['razmer'].'<BR>';
                $a = explode(';',$line['razmer']);
                $sizes = array_merge($sizes,$a);
            }
            //debug($sizes);
            foreach ($sizes AS $value)
            {
                $_logic['sizes'][] = trim($value);
            }
			if (!empty($_logic['sizes']))
			{
				$_logic['sizes'] = array_unique($_logic['sizes']);
				sort($_logic['sizes']);
			}
            //debug($_logic['sizes']);
//            $sizes = array_unique($sizes);
//            $_logic['sizes'] = $sizes;

                        //Debug($sizes);
        }


		
	}
?>	