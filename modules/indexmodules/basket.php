<div class="container cart-page">
    <?
    if ($subact == "topay") {
        ?>
        <p class="thank-you-message">Спасибо за Ваш заказ! Наш менеджер свяжется с Вами <i class="fa fa-smile-o fa-5x"
                                                                                           aria-hidden="true"></i></p>
        <?
    } else {
        if ($act == "basket") {
            ?>
            <h1 class="page-caption">Корзина</h1>
            <div id="cart">
                <form method="post" action="/work.php" id="basketform" name="basketform">
                    <input type="hidden" name="act" value="changebasket">
                    <div class="cart-products">
                        <?
                        debug($_SESSION['basket']);
                        $allsum = 0;
                        $k = 0;
                        if (isset($_SESSION['basket'])) {
                            foreach ($_SESSION['basket'] AS $key => $value) {
                                if ($value['count'] > 0) {
                                    $k++;
                                    $kid = $value['id'];
                                    $sql = "SELECT * FROM $par->objectstable WHERE id=$kid";
                                    $res = mysql_query($sql);
                                    $line = mysql_fetch_array($res, MYSQL_ASSOC);
                                    $fname = 'utils/images_z/nofoto.png';
                                    $sqltmp = "SELECT * FROM $par->fotorobjtable WHERE reportid=" . $line['id'] . " AND hide=0 ORDER BY prior LIMIT 0,1";
                                    $restmp = mysql_query($sqltmp);

                                    if ($linetmp = mysql_fetch_array($restmp, MYSQL_ASSOC)) {
                                        if (is_file('fotos/object_sm' . $linetmp['id'] . '.jpg')) {
                                            $fname = 'fotos/object_sm' . $linetmp['id'] . '.jpg';
                                        }
                                    }

                                    $product = GetProductInfo($value['id']);

                                    $fname = $product['fname'];
                                    $brand = htmlspecialchars($product['brand_name']);
                                    $artikul = $product['artikul'];
                                    $addstr = '';
                                    if ($fname != '') {
                                        $addstr = GetAddStr(138, 138, $fname);
                                    }
                                    ?>
                                    <div class="cart-product-item">
                                        <table>
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th>Назавние</th>
                                                <th>Размер</th>
                                                <th>Количество</th>
                                                <th>Цена</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="close">
                                                    <a href="/work.php?act=changebasket&deltov[<?= $key ?>]=1&dt">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="<?= GetSeoUrl('tovar', $line['id'], $line) ?>">
                                                        <img src="<?= $fname; ?>" <?= $addstr ?>
                                                             alt="<?= htmlspecialchars($line['title']) ?>"/>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="<?= GetSeoUrl('tovar', $line['id'], $line) ?>"
                                                       class="cart-product-name"><?= htmlspecialchars($line['title']); ?><?= " " . $brand; ?></a>
                                                    <p class="cart-product-article">
                                                        Артикул: <?= htmlspecialchars($artikul) ?></p>
                                                </td>
                                                <td>
                                                    <p class="mysize_<?= $key ?>"><?= $value['size'] ?></p>
                                                </td>
                                                <td>
                                                    <input id="int_count" class="product-count" type="text"
                                                           name="tov[<?= $key ?>]" value="<?= $value['count'] ?>"/>
                                                </td>
                                                <td>
                                                    <p class="product-price"><?= PriceToStr($line['price']) ?></p>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?
                                    $allsum += $line['price'] * $value['count'];
                                    $_SESSION['allsum'] = $allsum;
                                }
                            }
                        }

                        ?>
                    </div>
                </form>
            </div>
            <p class="product-total-count">Всего к оплате: <span><?= PriceToStr($allsum) ?> грн</span></p>
            <?
            if (isset($_REQUEST['sentcode']) && $_REQUEST['sentcode'] == 1)
                echo '<script> jAlert(\'Ваш заказ отправлен.\', \'Уважаемый покупатель\'); </script>';
        } ?>

        <form id="form1" class="cart-privatinfo" action="/work.php" method="post" name="form1">
            <input type="hidden" name="act" value="order">
            <div class="cart-privatinfo-rows">
                <p class="title">Обратная связь: </p>
                <div class="cart-privatinfo-row required">
                    <input type="text" name="name" id="name" required="required" placeholder="Ваше имя"/>
                </div>
                <div class="cart-privatinfo-row required">
                    <input type="text" name="phone" id="phone" required="required" placeholder="Телефон"/>
                </div>
                <div class="cart-privatinfo-row">
                    <input type="text" name="email" id="email" placeholder="E-mail"/>
                </div>
            </div>
            <p>Поля помеченые <span style="color: #ff0000;">*</span> обязательны для заполнения</p>

            <input class="button-link-pull" type="submit" value="Оформить заказ" name="order"/>
        </form>
    <?php } ?>
</div>
<!-- /.container -->