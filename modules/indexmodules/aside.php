<div class="container product-page">
<aside>
    <?

    //if ($_logic['mainmenuarr'][])
    //debug($_logic['maincatarr']);exit;
    //debug($_logic['mainmenuarr']);exit;
    $p = 0;
    foreach ($_logic['mainmenuarr'] AS $kk => $active) {

        if ($active['isactive'] == 1) {
            $p++;
        }

    }
    if ($p == 0) {
        $_logic['mainmenuarr'][0]['isactive'] = 1;
    }
    //debug($_logic['mainmenuarr']);
    foreach ($_logic['mainmenuarr'] AS $key => $aside) {
        //echo $key;
        //echo $aside['isactive'];exit;

        if (isset($aside['isactive']) && $aside['isactive'] == 1) {
            ?>
            <? if (1 == 2) { ?>    <h1 class="page-caption"><?= $aside['title'] ?></h1> <?
            } ?>
<ul>
            <li class="title-sub-menu"><?= $aside['title'] ?></li>
            <?
            if (count($aside['submenu']) > 0 && !empty($aside['submenu'][$key]['submenu'])) {    //debug($aside['subarr']);
                //if (isset($aside['subarr'][$key]['subarr'])) echo "asd";

                ?>

                <?
                foreach ($aside['submenu'] AS $k => $asubmenu1) {
                    ?>
                    <li class="sub-menu">
<!--                        <div class="submenu-box-caption">--><?//= $asubmenu1['title'] ?><!--</div>-->
                        <?
                        if (count($asubmenu1['submenu']) > 0) {
                            ?>
<!--                            <div class="submenu-box-col">-->
                                <ul>
                                    <?
                                    foreach ($asubmenu1['submenu'] AS $k => $asubmenu2) {
                                        //debug ($asubmenu1);exit;
                                        ?>

                                        <li class="<? if ($asubmenu2['id'] == $id) echo 'active' ?>"><a
                                                    href="<?= $asubmenu2['url'] ?>"><?= $asubmenu2['title'] ?></a></li>
                                        <?
                                    }
                                    ?>
                                </ul>
<!--                            </div>-->
                            <?
                        }
                        ?>
                    </li>
                    <?
                }

            } else if (count($aside['submenu']) > 0 && empty($aside['submenu'][$key]['submenu'])) {
                ?>
                <li class="sub-menu">
<!--                    <div class="submenu-box-col">-->
                        <ul>
                            <?
                            foreach ($aside['submenu'] AS $k => $asubmenu2) {

                                ?>

                                <?
                                if (empty($asubmenu2['submenu'])) {
                                    ?>


                                    <?
                                    //foreach($asubmenu1['submenu'] AS $key=>$asubmenu2)
                                    //{

                                    ?>

                                    <li class="<? if ($asubmenu2['id'] == $activecatid) echo 'active' ?>"><a
                                                href="<?= $asubmenu2['url'] ?>"><?= $asubmenu2['title'] ?></a></li>
                                    <?
                                    //}
                                    ?>


                                    <?
                                }
                                ?>

                                <?
                            }
                            ?>
                        </ul>
<!--                    </div>-->
                </li>
                <?
            }
        }
        //echo $key;
    }
    ?>
</ul>
</aside>
		
		
		
		
