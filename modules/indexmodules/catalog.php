<?
$catarr = $_logic['catarr'];
$catline = $catarr['catline'];

?>
<!--<section class="content_w">-->
<!--    <div class="content">-->

<!-- catalog -->
<div class="product-information">
    <!-- breadcrumbs -->
    <?
    if ($act == "cat") {
        ?>
        <ul class="breadcrumbs">
            <?
            $cbr = 0;
            foreach ($_logic['bread'] AS $k => $val) {
                $cbr++;
                ?>
                <li>
                    <a href="<?= $val['url'] ?>" <? if ($cbr == count($_logic['bread'])) echo "class='active'"; ?>> <?= $val['title'] ?></a>
                </li>
                <?
                if ($cbr != count($_logic['bread'])) {

                    ?>
                    <?
                }
            }
            ?>
        </ul>
        <!-- small slider -->
        <?
        if (!empty($_logic['sliderarr1'])) {
            ?>
            <div class="slider-small-w">
                <ul id="slider-small">
                    <?
                    foreach ($_logic['sliderarr1'] AS $key => $slide) {
                        ?>
                        <li class="slider-small-item"><a href="<?= $slide['title'] ?>" class="overall"></a><img
                                    src="<?= $slide['fname'] ?>" <?= $slide['addstr'] ?> alt="img"/></li>
                        <?
                    }
                    ?>

                </ul>
            </div>
            <?
        }
        ?>


        <!--         brand list-->


        <ul class="brand-list">
            <?
            $curl = GetSeoUrl('cat', $id);

            foreach ($_logic['brands'] AS $key => $brands) {

                ?>
                <li><a href="<?= $curl ?>/<?= $brands['url'] ?>" class="brand-list-item"><span
                                class="vfix"></span><img src="<?= $brands['fname'] ?>" alt="img"/></a></li>
                <?
            }
            ?>
        </ul>

        <?
    }
    ?>

    <h1 class="catalog-heading-new">
        <?
        include($_SERVER['DOCUMENT_ROOT'] . '/public/seo/tdz.php');

        if (strlen($_hone)) {
            echo $_hone;
        } else {
            echo htmlspecialchars($catline['title']);
        }
        ?>
    </h1>
    <!-- catalog filter -->
    <?
    if ($act == 'cat') {
        ?>
        <div class="catalog-filter">
            <div class="catalog-sort">
                <div class="sort-method">
                    <?
                    $currenturl = GetSeoUrl('cat', $id);
                    if (!isset($_REQUEST['changeorder']) || $_REQUEST['changeorder'] == 0) {
                        $url = '?changeorder=1';
                        $checkurl = '';
                        $checkurl = $_SERVER['QUERY_STRING'];
                        if ($checkurl != '') {
                            if (isset($_REQUEST['changesize']) && isset($_REQUEST['size'])) {
                                $changesize = $_REQUEST['changesize'];
                                $size = $_REQUEST['size'];
                                $url = $url . "&changesize=" . $changesize . "&size=" . $size;
                            }

                            if (isset($_REQUEST['changebrend']) && isset($_REQUEST['brendid'])) {
                                $changebrend = $_REQUEST['changebrend'];
                                $brendid = $_REQUEST['brendid'];
                                $url = $url . "&changebrend=" . $changebrend . "&brendid=" . $brendid;
                            }

                        }
                        ?>
                        <span class="sort-down active"><a href="<?= $currenturl ?>/<?= $url ?>" class="dashed">Цены по убыванию <i
                                        class="fa fa-long-arrow-down" aria-hidden="true"></i></a></span>
                        <?
                    } else {
                        $url = '?changeorder=0';
                        $checkurl = '';
                        $checkurl = $_SERVER['QUERY_STRING'];
                        if ($checkurl != '') {
                            if (isset($_REQUEST['changesize']) && isset($_REQUEST['size'])) {
                                $changesize = $_REQUEST['changesize'];
                                $size = $_REQUEST['size'];
                                $url = $url . "&changesize=" . $changesize . "&size=" . $size;
                            }

                            if (isset($_REQUEST['changebrend']) && isset($_REQUEST['brendid'])) {
                                $changebrend = $_REQUEST['changebrend'];
                                $brendid = $_REQUEST['brendid'];
                                $url = $url . "&changebrend=" . $changebrend . "&brendid=" . $brendid;
                            }

                        }
                        ?>
                        <span class="sort-up active"><a href="<?= $currenturl ?>/<?= $url ?>" class="dashed">Цены по возрастанию <i
                                        class="fa fa-long-arrow-up" aria-hidden="true"></i></a></span>
                        <?
                    }
                    ?>


                </div>
            </div>

            <div class="size-select">
                <p class="size-select-desc">Размер:</p>
                <div class="jNice size-select-input">

                    <?
                    $currurl = GetSeoUrl('cat', $id);
                    $sizeurl = "?changesize=1&size=";

                    $queryurl = '';
                    $addurl = '';
                    $queryurl = $_SERVER['QUERY_STRING'];

                    if ($queryurl != '') {

                        if (isset($_REQUEST['changebrend']) && isset($_REQUEST['brendid'])) {

                            $changebrend = $_REQUEST['changebrend'];
                            $brendid = $_REQUEST['brendid'];
                            $addurl = $addurl . "&changebrend=" . $changebrend . "&brendid=" . $brendid;
                        }

                        if (isset($_REQUEST['changeorder'])) {
                            $changeorder = $_REQUEST['changeorder'];
                            $url = $url . "&changeorder=" . $changeorder;
                        }
                    }
                    ?>
                    <select OnChange="document.location='<?= $currurl ?>/<?= $sizeurl ?>'+this.value+'<?= $addurl ?>'">
                        <option> --</option>
                        <?
                        foreach ($_logic['sizes'] AS $key => $size) {
                            ?>
                            <option <? if (isset($_REQUEST['size']) && $_REQUEST['size'] == $size) echo "selected" ?>><?= $size ?></option>
                            <?
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <?
    }
    ?>
    <!-- product-list -->
    <div class="product-list">
        <?
        PrintProductBlocks($catarr['products']);
        ?>

    </div>
    <!-- end product-list -->

    <!-- paginator -->
    <ul class="paginator">
        <?
        $pagerarr = $catarr['pagerarr'];
        include "modules/indexmodules/pager.php";
        ?>
    </ul>
    <div id="seotext">
        <?
        include($_SERVER['DOCUMENT_ROOT'] . '/public/seo/st.php');

        if (strlen($_st)) {
            echo $_st;
        }
        ?>
    </div>

</div>
</div>
<!-- /.container -->






		
		
	
