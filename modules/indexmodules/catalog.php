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
    <div class="breadcrumbs">
        <?
        $cbr = 0;
        foreach ($_logic['bread'] AS $k => $val) {
            $cbr++;
            ?>
            <a href="<?= $val['url'] ?>" <? if ($cbr == count($_logic['bread'])) echo "class='active'"; ?>> <?= $val['title'] ?></a>
            <?
            if ($cbr != count($_logic['bread'])) {

                ?>
<!--                <span class="br-sep">&gt;</span>-->
                <?
            }
        }
        ?>

    </div>

    <div class="product-description">
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
                                    src="<?= $slide['fname'] ?>" <?= $slide['addstr'] ?> alt=""/></li>
                        <?
                    }
                    ?>

                </ul>
            </div>
            <?
        }
        ?>


        <!-- brand list -->


<!--        <div class="brand-list">-->
<!--            --><?//
//            $curl = GetSeoUrl('cat', $id);
//
//            foreach ($_logic['brands'] AS $key => $brands) {
//
//                ?>
<!--                <a href="--><?//= $curl ?><!--/--><?//= $brands['url'] ?><!--" class="brand-list-item"><span-->
<!--                            class="vfix"></span><img src="--><?//= $brands['fname'] ?><!--" alt=""/></a>-->
<!--                --><?//
//            }
//            ?>
<!--            <span class="juster"></span>-->
<!--        </div>-->

        <!-- end brand list -->
        <?
        }
        ?>
    </div>
    <!-- /.product-description -->
    <!-- catalog heading -->

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

    <?
    //                        $instr = GetInStr($id,$par->categorytable);
    //                        $sql = "SELECT `razmer` FROM $par->objectstable WHERE `hide`=0 AND `categid` IN (-1 $instr) AND `razmer`!=''";
    //                        echo $sql.'<BR>';
    //                        $res = mysql_query($sql);
    //
    //                        $sizes = Array();
    //                        while($line = mysql_fetch_array($res,MYSQL_ASSOC))
    //                        {
    //                            echo $line['razmer'].'<BR>';
    //                            $a = explode(';',$line['razmer']);
    //                            $sizes = array_merge($sizes,$a);
    //                        }
    //                        $sizes = array_unique($sizes);
    //
    // Debug($_logic['sizes']);
    ?>
    <!-- catalog filter -->
    <?
    if ($act == 'cat') {
        ?>
        <div class="catalog-filter">
            <div class="size-select">
                <div class="size-select-desc">Размер:</div>
                <div class="jNice size-select-input">
                    <?
                    $currurl = GetSeoUrl('cat', $id);
                    $sizeurl = "?changesize=1&size=";

                    $queryurl = '';
                    $addurl = '';
                    $queryurl = $_SERVER['QUERY_STRING'];

                    //                                if ($queryurl=='')
                    //                                {
                    //                                    $sizeurl = "?".$sizeurl;
                    //                                }
                    if ($queryurl != '') {
//                                    $sizeurl = "?".$sizeurl;

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
                        <!--									<option>D</option>-->
                        <!--									<option>XXL</option>-->
                        <!--									<option>M</option>-->
                        <!--									<option>XXI</option>-->
                    </select>
                </div>
                <div class="clear"></div>
            </div>

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
                        <span class="sort-down active"><a href="<?= $currenturl ?>/<?= $url ?>" class="dashed">по убыванию цены </a>&nbsp;&darr;</span>
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
                        <span class="sort-up active"><a href="<?= $currenturl ?>/<?= $url ?>" class="dashed">по возрастанию цены </a>&nbsp;&uarr;</span>
                        <?
                    }
                    ?>


                </div>
            </div>
        </div>
        <div class="clear"></div>
        <?
    }
    ?>
    <!-- products 3inline -->
    <div class="cat-product-linethree">
        <?
        PrintProductBlocks($catarr['products']);
        ?>

    </div>
    <!-- end products 3inline -->

    <!-- paginator -->
    <div class="paginator">
        <?
        $pagerarr = $catarr['pagerarr'];
        include "modules/indexmodules/pager.php";
        ?>

    </div>


    <div id="seotext">
        <?
        include($_SERVER['DOCUMENT_ROOT'] . '/public/seo/st.php');

        if (strlen($_st)) {
            echo $_st;
        }
        ?>
    </div>


</div>
<!-- end catalog-->
<!--</section>-->
</div>
<!-- /.container -->






		
		
	
