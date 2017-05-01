<?
    function PrintProductBlock($product)
    {
        $addstr = GetAddStr(231,231,$product['fname']);

        ?> <div class="cat-product">
            <div class="cat-product-image"><a href="<?= $product['url']?>"><span class="vfix"></span><img src="<?=$product['fname']?>" alt="" /></a></div>
            <div class="cat-product-name"><a href="<?= $product['url']?>"><?=$product['title']?></a></div>
            <div class="cat-product-brand"><?=$product['brand_name']?></div>
            <div class="cat-product-priceline"><span class="actual-price"><?= $product['pricestr'].' '.$product['price_valuta'];?></span><span class="old-price">
                    <?
                    if ($product['priceold']>0)
                    {
                    ?>
                        <del>
                            <?= $product['priceoldstr'].' '.$product['price_valuta'];?>
                        </del>
                    <?
                    }
                    ?>

                </span>
            </div>
        </div>
        
        <?
                
    }
    
    function PrintProductBlocks($products)
    {
        ?>
       
        <?
                foreach($products AS $key=>$product)
                {
                    PrintProductBlock($product);
                }
        ?>
        
        <?
    }
?>