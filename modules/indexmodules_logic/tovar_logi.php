<?
    $sql = "SELECT * FROM $par->objectstable WHERE id=$id";
    $res = mysql_query($sql);
    if($tovarline = mysql_fetch_array($res,MYSQL_ASSOC))
    {
        //получаем информацию о товаре с параметром - все фотографии
        $tovararr = GetProductInfo($id,$tovarline,Array('allfotos'=>true));
        
        
        //получаем похожие товары
        $similarproducts_number = 3; //количество похожих товаров на странице
        $products = Array();
        $sql = "SELECT * FROM $par->objectstable WHERE categid=".$tovarline['categid']." AND hide=0 ORDER BY RAND() LIMIT 0,$similarproducts_number ";
        $res = mysql_query($sql);
        while($line = mysql_fetch_array($res,MYSQL_ASSOC))
        {
        	$products[] = GetProductInfo($line['id'],$line);
        }

        $tovararr['similarproducts'] = $products;
    }
?>