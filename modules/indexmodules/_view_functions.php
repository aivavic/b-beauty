<?
function PrintProductBlock($product)
{
    $addstr = GetAddStr(231, 231, $product['fname']);
    ?>
    <div class="product">
        <a class="product-image" href="<?= $product['url'] ?>"><img src="<?= $product['fname'] ?>" alt="img"/></a>
        <a class="product-name" href="<?= $product['url'] ?>"><?= $product['title'] ?></a>
        <p class="product-brand">Производитель: <?= $product['brand_name'] ?></p>
        <p class="price">
<span class="old-price">

<? if ($product['priceold'] > 0) { ?>
    <?= $product['priceoldstr'] . ' ' . $product['price_valuta']; ?>
<? } ?>

</span>
            <span class="actual-price"><?= $product['pricestr'] . ' ' . $product['price_valuta']; ?></span>
        </p>
        <a href="<?= $product['url'] ?>" class="button-link">Купить</a>
        <!-- /.button-link -->
    </div>

<? }

function PrintProductBlocks($products)
{
    foreach ($products AS $key => $product) {
        PrintProductBlock($product);
    }
} ?>