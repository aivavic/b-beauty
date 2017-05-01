<?
	$_logic['lang_url_default'] = GetSeoUrl($act,$id,null,'ru');
	$_logic['lang_url_en'] = GetSeoUrl($act,$id,null,'en');



        //Считаем сколько товаров и на какую сумму в корзине
        $allinbasket = 0; $allsuminbasket = 0;
        if(isset($_SESSION['basket']))
        {
                foreach ($_SESSION['basket'] AS $key=>$value)
                {
                        $kid = (int)$value['id'];
                        $sql = "SELECT * FROM $par->objectstable WHERE id=$kid";
                        $res = mysql_query($sql);
                        if($line = mysql_fetch_array($res,MYSQL_ASSOC))
                        {
                                $allinbasket+=$value['count'];
                                $allsuminbasket+= $value['count'] * $line['price'];
                        }
                }
        }
		
	$headerarr['basket_valuta'] = 'руб.';
	$headerarr['basket_num'] = $allinbasket;
	$headerarr['basket_sum'] = $allsuminbasket;
	$headerarr['basket_tovarov'] = GetTovarov($allinbasket);
	
	$headerarr['titletitle'] = $titletitle;
	$headerarr['titlekeywords'] = $titlekeywords;
	
	if(is_file('fotos/favicon.jpg')) $headerarr['favicon'] = '/fotos/favicon.jpg';
	
	$_logic['headerarr'] = $headerarr;
?>