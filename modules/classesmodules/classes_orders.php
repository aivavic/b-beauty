<?
    function GetOrderInfo($orderid,$line=null)
    {
        global $par;
        
        $orderarr = Array();
        
        if($line==null)
        {
            $sql = "SELECT * FROM $par->orderstable WHERE `id`=$orderid";
            $res = mysql_query($sql);
            $line = mysql_fetch_array($res,MYSQL_ASSOC);
        }
        $orderarr['orderid'] = $line['id'];
        $orderarr['date'] = $line['date'];
        $orderarr['allsum'] = $line['allsum'];
	$orderarr['orderstatus'] = GetStatusName($line['orderstatus']);
        $orderarr['products'] = Array();
        $orderarr['userid'] = $line['userid'];
        $orderarr['email'] = $line['email'];
        $orderarr['phone'] = $line['phone'];
        $orderarr['name'] = $line['name'];
        $orderarr['address'] = $line['address'];
        $orderarr['text'] = $line['text'];
        
        
                    $kk=0;
                    $orderstr = $line['orderstr'];
                    $oarr = explode(':',$orderstr);
                    //Debug($oarr);
                    for($i=1;$i<count($oarr)-1;$i++)
                    {
                        $s = $oarr[$i];
                        $sarr = explode(';',$s);
                        $key = $sarr[0];
                        $value = $sarr[1];
                        $size = $sarr[2];
			$oldprice = $sarr[3];
                        
                        if($value>0)
                        {
                            $oneproduct = Array();

			    $kk++;

			    $product = GetProductInfo($key);
			    $product['_order_price'] = $oldprice;
			    $product['_order_value'] = $value;
                $product['_order_size'] = $size;
                            //Debug($product);
/*                            
                            $fname = $product['fname'];

                            if($fname!='')
                            {
				$addstr = GetAddStr(74,68,$fname);
				$fname = '/'.$fname;
                            }
			    
			    $myurl = GetSeoUrl('tovar',$line1['id'],$line1);
*/

			    $orderarr['products'][] = $product;
                        }
                        
                    }
	//Debug($orderarr);
	return $orderarr;
    }
    
    function GetOrders()
    {
        
    }
    
    function GetStatusArr()
    {
	global $par;
	
	$ar = Array();
	$sql = "SELECT * FROM $par->orderstatusestable";
	$res = mysql_query($sql);
	while($line = mysql_fetch_array($res,MYSQL_ASSOC))
	{
	    $ar[$line['id']] = Array($line['title'],'#'.$line['color']);
/*	    
            $ar = Array(
                    0 => Array('в обработке','red'),
                    1 => Array('Не оплачен, отправлен','blue'),
                    2 => Array('Оплачен, отправлен','yellow'),
                    3 => Array('Оплачен, получен','green'),
                    4 => Array('Отменен','gray'),
            );
*/            
	}
            return $ar;
    }

    function GetStatusName($statusid)
    {
            $statusname = '';

            $ar = GetStatusArr();

            if(isset($ar[$statusid][0])) $statusname = $ar[$statusid][0];

            return $statusname;
    }

    function GetStatusColor($statusid)
    {
            $statuscolor = '';

            $ar = GetStatusArr();

            if(isset($ar[$statusid][1])) $statuscolor = $ar[$statusid][1];

            return $statuscolor;
    }
    
        
?>