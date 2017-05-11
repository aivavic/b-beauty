<?
//debug( $_logic['product']);
$product_info = $_logic['product'];
//debug($product_info);
//echo $id;
?>
<div class="product-information">
    <!-- breadcrumbs -->
    <ul class="breadcrumbs">
        <li><a href="/">Главная</a></li>
        <?
        $cbr = 0;
        foreach ($_logic['bread'] AS $k => $val) {
            $cbr++;
            ?>
            <li>
                <a href="<?= $val['url'] ?>" <? if ($cbr == count($_logic['bread'])) echo "class='active'"; ?>> <?= $val['title'] ?></a>
            </li>
            <?
            if ($cbr != count($_logic['bread'])) { //echo strtolower($val['title']);
                //phpinfo();
            }
        }
        ?>

    </ul>

    <div class="product-properties">
        <h1><?= $product_info['title'] ?></h1>
        <div class="product-images-describe">
            <div class="product-images">
                <div class="product-image-large">
                    <?
                    $k = 0;
                    foreach ($product_info['objfotos'] AS $key => $foto) {
                        $k++;
                        ?>
                        <a href="<?= $foto['fnamebig'] ?>"
                           class="product-image <? if ($k == 1) echo 'active' ?> fancybox" data-imageId="<?= $key ?>"
                           style="opacity:<? if ($k == 1) {
                               echo "1";
                           } else {
                               echo "0";
                           } ?>" data-fancybox-group="1"><img src="<?= $foto['fnamebig'] ?>"
                                                              alt="img"></a>
                        <?
                    }
                    ?>
                </div>

                <div class="product-tiny-images">
                    <?
                    foreach ($product_info['objfotos'] AS $k => $foto) {
                        ?>
                        <div><a href="#" class="product-tiny-image" data-imageId="<?= $k ?>"><img
                                        src="<?= $foto['fname'] ?>" alt="img"/></a></div>
                        <?
                    }
                    ?>
                </div>
            </div>

            <div class="product-details">
                <p class="price">
                    <span class="product-price"><?= $product_info['pricestr'] ?></span>
                    <span class="product-price-currency"><?= $product_info['price_valuta'] ?></span>
                    <span class="product-old-price">
                    <? if ($product_info['priceold'] > 0) { ?>
                        <del>
                            <?= $product_info['priceoldstr'] . " " . $product_info['price_valuta'] ?>
                        </del>
                    <? } ?>

                    </span>
                </p>
                <!-- /.price -->
                <p class="product-article">Артикул: <?= $product_info['artikul'] ?></p>

                <div class="product-size">
                    <div class="size-select">
                        <span class="size-select-desc">Размер:</span>
                        <div class="jNice select-wrapper">
                            <?
                            if (isset($product_info['line']['razmer']) && $product_info['line']['razmer'] != '') {
                                ?>
                                <select id="size" name="size">
                                    <?
                                    foreach ($product_info['line']['razmer'] AS $k => $param1) {
                                        ?>
                                        <? if ($param1 != '') {
                                            ?>
                                            <option><?= $param1 ?></option>
                                            <?
                                        }
                                    }
                                    ?>
                                </select>
                                <?
                            }
                            ?>
                        </div>
                        <!-- /.select-wrapper -->
                    </div>

                    <div class="size-table-w">
                        <a href="#size-table" class="size-table-link fancybox">Таблицы размеров <i
                                    class="fa fa-info-circle" aria-hidden="true"></i></a>
                    </div>
                </div>

                <!-- add hidden class here when null (product-incart-button) -->
                <?
                if ($product_info['line']['spec2'] == 1) {
                    ?>
                    <a <?= 'onclick= "size = document.getElementById(\'size\').value; AddToBasket(' . $product_info['id'] . ',' . $product_info['price'] . ',size); return false;" '; ?>
                            href="#product-add" class="cart-button fancybox">Добавить в корзину</a>
                    <?
                }
                ?>

                <?
                if ($varsline['subtext1'] != '') {
                    ?>
                    <p class="product-details-text">
                        <?
                        $dosty = $varsline['subtext1'];
                        $dosty = str_replace('http://bebeauty.km.ua', '', $dosty);
                        $dosty = str_replace('href="/dostavka"', 'href="/paydeliver"', $dosty);
                        echo $dosty;
                        ?>
                    </p>
                    <?
                }
                ?>
            </div>
            <!-- /.product-details -->
        </div>
        <!-- /.product-images-describe -->
        <div class="product-description">
            <h2>Описание товара</h2>

            <?= $product_info['text'] ?>
        </div>
    </div>

    <?
    if (!empty($_logic['product_similar'])) {
        ?>
        <div class="similar">
            <h3>Похожие товары</h3>

            <div class="products-wrapper">
                <?
                foreach ($_logic['product_similar'] AS $key => $item) {
                    ?>
                    <div class="product">
                        <a class="product-image" href="<?= $item['url'] ?>"><img src="<?= $item['fname'] ?>" alt="img"/></a>
                        <a class="product-name" href="<?= $item['url'] ?>"><?= $item['title'] ?></a>
                        <p class="product-brand">Производитель: <?= $item['brand_name'] ?></p>
                        <p class="price">
                            <span class="old-price">
                                        <?

                                        if ($item['priceold'] > 0) {
                                            ?>
                                            <?= $item['priceoldstr'] ?> <?= $item['price_valuta'] ?>
                                            <?
                                        }
                                        ?>
                                    </span>
                            <span class="actual-price"><?= $item['pricestr'] ?> <?= $item['price_valuta'] ?></span>
                        </p>
                        <a href="<?= $product['url'] ?>" class="button-link">Купить</a>
                        <!-- /.button-link -->
                    </div>
                    <?
                }
                ?>


            </div>
        </div>
        <?
    }
    ?>
    <!--    </div>-->
    <!--</section>-->
</div>
<!-- /.product-information -->
</div>
<!-- /.container -->
