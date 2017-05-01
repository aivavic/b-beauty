<?   
    if($subact=="orders")
    {
            ?>
            <style>
                .caborder1 { border:0px solid #4A8303; width:90%; border-bottom:0px;}
                .caborder2 { border:2px solid #4A8303; width:90%; }
            </style>
            <?
            
            $sql = "SELECT * FROM $par->orderstable WHERE userid=".(int)$_SESSION['loguserid']." ORDER BY id DESC";
            $res = mysql_query($sql);
            if(mysql_num_rows($res)==0)
            {
                echo '<p>У вас еще не было заказов.</p>';
            }
            else
            {
                $k=0;
                
                echo '<center>';
                
                while($line = mysql_fetch_array($res,MYSQL_ASSOC))
                {
                    $k++;
                    echo '<table cellSpacing="1" cellPadding="3" width="99%"  border="0" class="caborder1" >
                    <tr>
                    <td align="center" ><b>Номер заказа</b></td>
                    <td align="center" ><b>Дата</b></td>
                    <td align="center" ><b>Сумма</b></td>
                    <td align="center" width="80"><b>Статус</b></td>
                    </tr>
                    ';

                    echo '<TR>
                    <TD vAlign=center align="center" width="90"><A>'.htmlspecialchars($line['id']).'</A></TD>
                    <TD vAlign=center align="center" width="90"><A>'.date("d.m.Y",$line['date']).'</A></TD>
                    <TD vAlign=center align="center" width="50"><A>'.htmlspecialchars($line['allsum']).' руб.</A></TD>
                    ';

		    $status = GetStatusName($line['orderstatus']);

                    echo '<td title="Статус" align="center" >'.$status.'</td>';

                    echo '
                    </tr>
                    ';
                    
                    echo '</table>';



		    echo '
                    <div class="m_korzina">
                        <table width="100%" cellpadding="0" cellspacing="0" class="caborder2" >
                        <tr>
				<td colspan="4" height="20">
				&nbsp;
				</td>
			</tr>
                        ';

                    $kk=0;
                    $orderstr = $line['orderstr'];
                    $oarr = explode(':',$orderstr);
                    for($i=1;$i<count($oarr)-1;$i++)
                    {
                        $s = $oarr[$i];
                        $sarr = explode(';',$s);
                        $key = $sarr[0];
                        $value = $sarr[1];
			$oldprice = $sarr[2];
                        
                        if($value>0)
                        {
							$kk++;

                            $fname = 'utils/images_z/nofoto.png'; $addstr = '';
                            $sql1 = "SELECT * FROM $par->objectstable WHERE id=$key";
                            $res1 = mysql_query($sql1);
                            $line1 = mysql_fetch_array($res1,MYSQL_ASSOC);
                            
                            if($line1['parentid']==0) $parentline = $line1;
                            else
                            {
                                    $sqltmp = "SELECT * FROM $par->objectstable WHERE id=".$line1['parentid'];
                                    $restmp = mysql_query($sqltmp);
                                    $parentline = mysql_fetch_array($restmp,MYSQL_ASSOC);
                            }
                            
                            
                            $sqltmp = "SELECT * FROM $par->fotorobjtable WHERE reportid=".$parentline['id']."  AND hide=0 ORDER BY prior LIMIT 0,1";
                            $restmp = mysql_query($sqltmp);
                            if($linetmp = mysql_fetch_array($restmp,MYSQL_ASSOC))
                            {
                                if(is_file('fotos/object_sm'.$linetmp['id'].'.jpg'))
                                {
                                    $fname = 'fotos/object_sm'.$linetmp['id'].'.jpg';
                                }
                                    
                            }
							
							$product = GetProductInfo($key);
							$fname = $product['fname'];

                            if($fname!='')
                            {
				$addstr = GetAddStr(74,68,$fname);
				$fname = '/'.$fname;
                            }
			    
			    $myurl = GetSeoUrl('tovar',$line1['id'],$line1);

				if($kk!=1) echo '
				<tr>
					<td colspan="4" height="20" valign="middle">
					<div style="height:1px;font-size:1px;background:#ededed;overflow:hidden;"></div>
					</td>
				</tr>';

                        echo '
                        <tr>
                                <td align="center"><a href="'.$myurl.'"><img src="'.$fname.'" '.$addstr.' alt=""></a></td>
                                <td><a href="'.$myurl.'">'.htmlspecialchars($line1['title']).'</a></td>
                                <td class="cena">Цена: '.$oldprice.' руб<br></td>
                                <td><nobr>Кол-во: '.$value.'</nobr></td>
                        </tr>';
                        }
                        
                    }
                    echo '
                    <tr>
<td colspan="4" height="20" align="right">';

//if(trim($line['track'])!='') echo '<b>Трек-код: '.htmlspecialchars($line['track']).'</b>';

echo '
&nbsp;
</td>
</tr>';


            echo '
            <tr>
            <td colspan="4" height="20" align="center">';
            
            //$sql = "SELECT * FROM $par->orderstable WHERE id=$order_id";
            //$res = mysql_query($sql);
            //if($line = mysql_fetch_array($res,MYSQL_ASSOC))
            {
/*			
                    if($line['payed']>0)
                    {
                        echo 'Ваш заказ уже оплачен';
                    }
                    else
*/					
                    {
/*			
			$out_amount = $line['allsum'];
			$order_id = $line['id'];
			$hash = md5("$fk_merchant_id:$out_amount:$fk_merchant_key:$order_id");
			$url = "http://www.free-kassa.ru/merchant/cash.php?m=$fk_merchant_id&oa=$out_amount&s=$hash&o=$order_id";
			echo '<a href="'.$url.'" style="font-size:20px;">Оплатить</a><br>';
*/			
                    }
            }

            echo '
            &nbsp;
            </td>
            </tr>
            ';

            echo '

                    </table>
                    </div><br>';
                }
                echo '</center>';
            }
 
    }
?>