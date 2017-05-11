<div class="container">
<?
$menuitem = $_logic['pageitem'];
?>
	
<h1 class="page-caption"><?= $menuitem['title']?></h1>
		
<div class="plain-textpage ctext">
<?=$menuitem['text']?>
</div>
</div>
<!-- /.container -->






<table>
    <tbody>
    <tr>
        <td>
        <a onclick="delbacket(<?= $key; ?>)" href="#" class="close"><i class="fa fa-trash"aria-hidden="true"></i></a>
        </td>
        <td><a href="<?= GetSeoUrl('tovar', $line['id'], $line) ?>"><img
                        src="<?= $fname; ?>" <?= $addstr ?>
                        alt="<?= htmlspecialchars($line['title']) ?>"/></a></td>
        <td>
            <a href="<?= GetSeoUrl('tovar', $line['id'], $line) ?>"
               class="cart-product-name"><?= htmlspecialchars($line['title']) ?> <?= htmlspecialchars($product['brand_name']) ?></a>
            <p>Артикул: <?= $line['artikul'] ?></p>
        </td>
        <td>
            <p><?= $value['size'] ?></p>
        </td>
        <td>
            <p class="product-price"><?= PriceToStr($line['price']) ?></p>
        </td>
    </tr>
    </tbody>
</table>







