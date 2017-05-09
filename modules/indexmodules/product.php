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
                </p>
                <!-- /.price -->
                <p class="product-article">Артикул: <?= $product_info['artikul'] ?></p>
                <p class="product-old-price">
                    <? if ($product_info['priceold'] > 0) { ?>
                        <del>
                            <?= $product_info['priceoldstr'] . " " . $product_info['price_valuta'] ?>
                        </del>
                    <? } ?>

                </p>
                <div class="product-size">
                    <div class="size-select">
                        <div class="size-select-desc">Размер:</div>
                        <div class="jNice size-select-input">
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
                        <div class="clear"></div>
                    </div>

                    <div class="size-table-w">
                        <a href="#size-table" class="size-table-link dashed fancybox">Таблицы размеров</a>
                    </div>
                </div>

                <!-- add hidden class here when null (product-incart-button) -->
                <?
                if ($product_info['line']['spec2'] == 1) {
                    ?>
                    <div class="product-incart-button">
                        <a <?= 'onclick= "size = document.getElementById(\'size\').value; AddToBasket(' . $product_info['id'] . ',' . $product_info['price'] . ',size); return false;" '; ?>
                                href="#product-add" class="button-orange icon-incart fancybox">
                            <span class="button-orange-title">Добавить в корзину</span>
                        </a>
                    </div>
                    <?
                }
                ?>

                <?
                if ($varsline['subtext1'] != '') {
                    ?>
                    <div class="product-details-text">
                        <?


                        $dosty = $varsline['subtext1'];
                        $dosty = str_replace('http://bebeauty.km.ua', '', $dosty);
                        $dosty = str_replace('href="/dostavka"', 'href="/paydeliver"', $dosty);
                        echo $dosty;

                        ?>
                    </div>
                    <?
                }
                ?>
            </div>
            <!-- /.product-details -->
        </div>
        <!-- /.product-images-describe -->
        <div class="product-description">
            <h2>Описание товара</h2>

            <p><?= $product_info['text'] ?></p>
        </div>
    </div>

    <?
    if (!empty($_logic['product_similar'])) {
        ?>
        <div class="similar">
            <div class="similar-caption">ПОХОЖИЕ ТОВАРЫ</div>

            <div class="cat-product-linethree">
                <?
                foreach ($_logic['product_similar'] AS $key => $item) {
                    ?>
                    <div class="cat-product">
                        <div class="cat-product-image"><a href="<?= $item['url'] ?>"><span
                                        class="vfix"></span><img src="<?= $item['fname'] ?>" alt=""/></a></div>
                        <div class="cat-product-name"><a href="<?= $item['url'] ?>"><?= $item['title'] ?></a>
                        </div>
                        <div class="cat-product-brand"><?= $item['brand_name'] ?></div>
                        <div class="cat-product-priceline"><span
                                    class="actual-price"><?= $item['pricestr'] ?> <?= $item['price_valuta'] ?></span><span
                                    class="old-price">
                                        <?

                                        if ($item['priceold'] > 0) {
                                            ?>
                                            <del>
                                                <?= $item['priceoldstr'] ?> <?= $item['price_valuta'] ?>
                                            </del>
                                            <?
                                        }
                                        ?>

                                    </span>
                        </div>
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
