<div class="container product-page">
    <aside>
        <?php
        $p = 0;
        foreach ($_logic['mainmenuarr'] AS $kk => $active):
            if ($active['isactive'] == 1)
                $p++;
        endforeach;
        if ($p == 0)
            $_logic['mainmenuarr'][0]['isactive'] = 1;
        foreach ($_logic['mainmenuarr'] AS $key => $aside):
            if (isset($aside['isactive']) && $aside['isactive'] == 1): ?>
                <ul>
                    <li class="title-sub-menu"><?= $aside['title'] ?></li>
                    <?php if (count($aside['submenu']) > 0 && !empty($aside['submenu'][$key]['submenu'])): ?>
                        <?php foreach ($aside['submenu'] AS $k => $asubmenu1): ?>
                            <li class="sub-menu">
                                <?php if (count($asubmenu1['submenu']) > 0): ?>
                                    <ul>
                                        <?php foreach ($asubmenu1['submenu'] AS $k => $asubmenu2): ?>
                                            <li class="<? if ($asubmenu2['id'] == $id) echo 'active' ?>">
                                                <a href="<?= $asubmenu2['url'] ?>"><?= $asubmenu2['title'] ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php endforeach;
                    elseif (count($aside['submenu']) > 0 && empty($aside['submenu'][$key]['submenu'])): ?>
                        <li class="sub-menu">
                            <ul>
                                <?php foreach ($aside['submenu'] AS $k => $asubmenu2): ?>
                                    <?php if (empty($asubmenu2['submenu'])): ?>
                                        <li class="<? if ($asubmenu2['id'] == $activecatid) echo 'active' ?>"><a
                                                    href="<?= $asubmenu2['url'] ?>"><?= $asubmenu2['title'] ?></a></li>

                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            <?php endif; ?>
        <?php endforeach; ?>
    </aside>
		
		
		
		
