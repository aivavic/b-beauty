<div class="container all-products-wrapper">
    <h1><?
        include($_SERVER['DOCUMENT_ROOT'] . '/public/seo/tdz.php');
        if (strlen($_hone)) {
            echo $_hone;
        } else {
            echo 'Интернет магазин детской одежды Be Beauty';
        }
        ?>
    </h1>

    <div class="product-list">
        <?
        $newsarr = $_logic['newprod'];
        ?>
        <?
        PrintProductBlocks($newsarr['products']);
        ?>
    </div>

    <!-- paginator -->
    <ul class="paginator">
        <?

        $pagerarr = $newsarr['pagerarr'];
        include "modules/indexmodules/pager.php";
        ?>
    </ul>
    <!-- /paginator -->

</div>
<!-- /.all-products-wrapper -->
<div id="seotext" class="container">
    <?
    include($_SERVER['DOCUMENT_ROOT'] . '/public/seo/st.php');

    if (strlen($_st)) {
        echo $_st;
    }
    ?>
</div>