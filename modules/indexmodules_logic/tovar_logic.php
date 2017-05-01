<?
    if($act=="tovar" && $id!=0)
    {
        $sql = "SELECT * FROM $par->objectstable WHERE id=$id AND hide=0";
        $res = mysql_query($sql);
        if($tovarline = mysql_fetch_array($res,MYSQL_ASSOC))
        {
            $_logic['product']  = LangProcess(GetProductInfo($tovarline['id'],$tovarline,Array('allfotos'=>true)));
            $_logic['product']['line']['razmer'] = explode(";",$_logic['product']['line']['razmer']);
	    //debug($_logic['product']);
            
            $similarproducts_number = 3; //количество похожих товаров на странице
            $products = Array();
            $sql = "SELECT * FROM $par->objectstable WHERE categid=".$tovarline['categid']." AND hide=0 ORDER BY RAND() LIMIT 0,$similarproducts_number ";
            $res = mysql_query($sql);
            while($line = mysql_fetch_array($res,MYSQL_ASSOC))
            {
                    $products[] = LangProcess(GetProductInfo($line['id'],$line));
            }
	    
            $_logic['product_similar'] = $products;
			//debug($products);exit;
        }
    }
?>
