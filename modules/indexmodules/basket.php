	<?
    if($subact=="topay")
    {
    ?>
        <div class="finish-block">
            <div class="finish-mess"><p>Спасибо за Ваш заказ. Наш менеджер свяжется с Вами</p></div>
            <div class="finish-button"><a href="/" class="button-green">НА ГЛАВНУЮ</a></div>
        </div>
    <?
    }
    else
    {
    if($act=="basket")
    {
        ?>
        <h1 class="page-caption">Корзина</h1>
        <div id="cart">
            <form method="post" action="/work.php" id="basketform" name="basketform" class="jNice">
                <input type="hidden" name="act" value="changebasket" >
                <div class="cart-heading">
                    <span style="margin-left:230px;">Название</span>
                    <span style="margin-left:260px;">Размер</span>
                    <span style="margin-left:87px;">Количество</span>
                    <span style="margin-left:80px;">Цена</span>
                </div>
                <div class="cart-products">
                    <?
                    debug($_SESSION['basket']);
                    $allsum = 0; $k=0;
                    if(isset($_SESSION['basket']))
                    {
                        foreach ($_SESSION['basket'] AS $key=>$value)
                        {
                            if($value['count']>0)
                            {
                                $k++;
                                $kid 	= $value['id'];
                                $sql 	= "SELECT * FROM $par->objectstable WHERE id=$kid";
                                $res 	= mysql_query($sql);
                                $line	= mysql_fetch_array($res,MYSQL_ASSOC);
                                $fname 	= 'utils/images_z/nofoto.png';
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
                                $brand = htmlspecialchars($product['brand_name']);
                                $artikul = $product['artikul'];
                                $addstr = '';
                                if($fname!='')
                                {
                                    $addstr = GetAddStr(138,138,$fname);
                                }
                                ?>
                                <div class="cart-product-item">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td class="cart-product-cancel"><a href="/work.php?act=changebasket&deltov[<?= $key?>]=1&dt" class="close-gray"></a></td>
                                            <td class="cart-product-image"><a href="<?= GetSeoUrl('tovar',$line['id'],$line)?>"><img src="<?= $fname;?>" <?= $addstr?> alt="<?=htmlspecialchars($line['title'])?>"/></a></td>
                                            <td class="cart-product-desc">
                                                <div><a href="<?= GetSeoUrl('tovar',$line['id'],$line)?>" class="cart-product-name"><?=htmlspecialchars($line['title']);?><?= " ".$brand;?></a>
                                                    <p class="cart-product-article">Артикул: <?= htmlspecialchars($artikul)?></p> </div>
                                            </td>
                                            <td class="cart-product-size"><div class="mysize_<?=$key?>"><?= $value['size']?></div></td>
                                            <td class="cart-product-amount"><div class="cart-product-amount-input"><input  <?= ' oninput= "var size = $(\'.mysize_'.$key.'\').html();count = $(\'.mycount_'.$key.'\').val(); changebasket(size,'.$value['count'].','.$line['id'].','.$line['price'].',count); return false;" '; ?> type="text" name="tov[<?=$key?>]" value="<?= $value['count']?>" class="mycount_<?=$key?>" id="int_count"/></div></td>
                                            <td class="cart-product-price"><div><?= PriceToStr($line['price'])?></div></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <?
                                $allsum+= $line['price']*$value['count'];
                                $_SESSION['allsum'] = $allsum;
                            }
                        }
                    }

                    ?>
            </form>
        </div>
        <div class="cart-summ-line">Всего к оплате <span class="cart-summ"><?= PriceToStr($allsum)?></span><span class="cart-summ-currency">грн</span></div>
        <?
        if(isset($_REQUEST['sentcode']) && $_REQUEST['sentcode']==1)
            echo '<script> jAlert(\'Ваш заказ отправлен.\', \'Уважаемый покупатель\'); </script>';
    }

    ?>
    <div class="cart-privatinfo">
        <form action="/work.php" method="post" name="form1" id="form1" class="jNice">
            <input type="hidden" name="act" value="order">
            <div class="cart-privatinfo-heading">Личная информация</div>
            <div class="cart-privatinfo-rows">
                <div class="cart-privatinfo-row required">
                    <input type="text" name="name" id="name"  required="required"  placeholder="Ваше имя" />
                </div>
                <div class="cart-privatinfo-row required">
                    <input type="text" name="phone" id="phone"  required="required"  placeholder="Телефон" />
                </div>
                <div class="cart-privatinfo-row">
                    <input type="text" name="email" id="email"  placeholder="E-mail" />
                </div>
            </div>
            <p class="cart-privatinfo-text">
                Поля помеченые <span style="color: #660080;">*</span> обязательны для заполнения
            </p>

            <div class="cart-submit-order"><a href="#" class="button-orange"><input type="submit" value="" name=""/><span class="button-orange-title">Оформить заказ</span></a></div>
        </form>
    </div>
<?
    }
?>
