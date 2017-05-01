<?
	@session_start();

	include "classes.php";
	
	$act = "none";
	if(isset($_REQUEST['act'])) $act = $_REQUEST['act'];

    if ($act == 'changebasket')
    {

    }

	if($act=="addtobasket")
	{
		/*if(isset($_REQUEST['id'])) $pid = (int)$_REQUEST['id']; else $pid=0;
		if(isset($_REQUEST['num'])) $num = (int)$_REQUEST['num']; else $num=0;
		$quantity = $num;

		if(isset($_SESSION['basket'][$pid])) $_SESSION['basket'][$pid] += (int)$quantity;
		else $_SESSION['basket'][$pid] = (int)$quantity;*/
		
		if(isset($_REQUEST['id'])) $pid = (int)$_REQUEST['id']; else $pid=0;
		if(isset($_REQUEST['num'])) $num = (int)$_REQUEST['num']; else $num=0;
		if(isset($_REQUEST['size'])) $size = $_REQUEST['size']; else $size="none";
		
		
		
		if (isset($_SESSION['basket']))
		{
			$flag = 0;
			foreach($_SESSION['basket'] AS $key=>$value)
			{
				
				if ($value['size'] == $size && $value['id'] == $pid)
				{
					$flag=1;
					$count = (int)$num + (int)$value['count'];
					
					$_SESSION['basket'][$key] = array('id'=>$pid,'count'=>$count,'size'=>$size);	
				}
			}
			if($flag==0)
			{
				$_SESSION['basket'][] = array('id'=>$pid,'count'=>$num,'size'=>$size);
			}
				
			
		}
		else
		{
			$_SESSION['basket'][] = array('id'=>$pid,'count'=>$num,'size'=>$size);
		}


		if(isset($_SESSION['basket']))
		{
			foreach ($_SESSION['basket'] AS $key=>$value)
			{
                $x = $value['count'];

                while ($x>0)
                {
                    $k++;
                    $kid = $value['id'];
                    $sql = "SELECT * FROM $par->objectstable WHERE id=$kid";
                    $res = mysql_query($sql);
                    $line = mysql_fetch_array($res,MYSQL_ASSOC);

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

                    $product = GetProductInfo($value['id']);
                    $fname = $product['fname'];

                    $addstr = '';
                    if($fname!='')
                    {
                        $addstr = GetAddStr(100,100,$fname);
                        //$fname = '/'.$fname;
                    }
                    $x--;
				    ?>
					    <div class="cart-product-item">
						    <table>
							    <tbody>
								    <tr>

									    <td class="cart-product-cancel"><a onclick="delbacket(<?= $key;?>)" href="#" class="close-gray"></a></td>
									    <td class="cart-product-image"><a href="<?= GetSeoUrl('tovar',$line['id'],$line)?>"><img src="<?= $fname;?>" <?= $addstr?> alt="<?=htmlspecialchars($line['title'])?>"/></a></td>
									    <td class="cart-product-desc">
										    <div><a href="<?= GetSeoUrl('tovar',$line['id'],$line)?>" class="cart-product-name"><?=htmlspecialchars($line['title'])?> <?= htmlspecialchars($product['brand_name'])?></a>
										    <p class="cart-product-article">Артикул: <?= $line['artikul']?></p> </div>
									    </td>
									    <td class="cart-product-size"><div><?= $value['size']?></div></td>
									    
									    <td class="cart-product-price"><div><?= PriceToStr($line['price'])?></div></td>
								    </tr>
							    </tbody>
						    </table>	
					    </div>
				    <?
				    
				    $allsum+= $line['price']*$value['count'];
				}
			}
			
		}
	}

    if ($act == "changebasket")
    {
        $pid 		= myaddslashes($_REQUEST['id']);
        $count		= myaddslashes($_REQUEST['count']);
        $price 		= myaddslashes($_REQUEST['price']);
        $size 		= myaddslashes($_REQUEST['size']);
        $oldcount 	= 0;
        $summ 		= 0;
        $_SESSION['inbasket']=0;

        //$_SESSION['allsum'] = 0;
        foreach ($_SESSION['basket'] AS $key => $value)
        {
            if ($value['id'] == $pid && $value['size'] == $size)
            {
                $oldcount = $_SESSION['basket'][$key]['count'];
                $_SESSION['basket'][$key]['count'] = $count;

            }
//            $_SESSION['inbasket'] += $value['count'];
        }
        foreach ($_SESSION['basket'] AS $key => $value)
        {
            $_SESSION['inbasket'] += $value['count'];
        }
        $_SESSION['allsum'] = $_SESSION['allsum'] - $price*$oldcount + $price*$count;
        $_SESSION['allsumstr'] = PriceToStr($_SESSION['allsum']);
        echo json_encode($_SESSION);
        //echo  PriceToStr($_SESSION['allsum']);
    }
	
	
        
        echo ' ';

//
if($act=="delbacket")
{
    $deltov = $_REQUEST['deltov'];
    $_SESSION['basket'][$deltov]['count'] = $_SESSION['basket'][$deltov]['count']-1;

    foreach ($_SESSION['basket'] AS $key=>$value)
    {
        $x = $value['count'];

        while ($x>0)
        {
            $k++;
            $kid = $value['id'];
            $sql = "SELECT * FROM $par->objectstable WHERE id=$kid";
            $res = mysql_query($sql);
            $line = mysql_fetch_array($res,MYSQL_ASSOC);

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

            $product = GetProductInfo($value['id']);
            $fname = $product['fname'];

            $addstr = '';
            if($fname!='')
            {
                $addstr = GetAddStr(100,100,$fname);
                //$fname = '/'.$fname;
            }
            $x--;
            ?>
            <div class="cart-product-item">
                <table>
                    <tbody>
                    <tr>

                        <td class="cart-product-cancel"><a onclick="delbacket(<?=$key;?>)" href="#" class="close-gray"></a></td>
                        <td class="cart-product-image"><a href="<?= GetSeoUrl('tovar',$line['id'],$line)?>"><img src="<?= $fname;?>" <?= $addstr?> alt="<?=htmlspecialchars($line['title'])?>"/></a></td>
                        <td class="cart-product-desc">
                            <div><a href="<?= GetSeoUrl('tovar',$line['id'],$line)?>" class="cart-product-name"><?=htmlspecialchars($line['title'])?> <?= htmlspecialchars($product['brand_name'])?></a>
                                <p class="cart-product-article">Артикул: <?= $line['artikul']?></p> </div>
                        </td>
                        <td class="cart-product-size"><div><?= $value['size']?></div></td>

                        <td class="cart-product-price"><div><?= PriceToStr($line['price'])?></div></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <?
        }
    }
}
//

?>