<!-- slider -->
<?

?>
<div class="slider-w">
	<ul id="slider">
        <?
        foreach ($_logic['sliderarr'] AS $key => $value)
        {
        ?>
            <li>
                <div class="slider-item"><a href="<?= $value['title']?>" class="slider-item-link"><img src="<?= $value['fname']?>" <?= $value['addstr']?> alt="" /></a>
<!--                    --><?//
//                    if ($value['title']!='')
//                    {
//                    ?>
<!--                        <a href="#" style="position: absolute; top: 169px; left: 828px;" class="button-orange-small">--><?//= $value['title']?><!--</a>-->
<!--                    --><?//
//                    }
//                    ?>


                </div>
            </li>
        <?
        }
        ?>

	</ul>
</div>
<!-- end slider-->