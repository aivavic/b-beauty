<!-- brand list -->
<div class="container">
    <ul class="brand-list">
        <?
        foreach ($_logic['brands'] AS $key => $brand) {

            $brand['url'] = str_replace('?changebrendmain=', 'brand-', $brand['url']);
            $brand['url'] = str_replace('&currbrendmain=', '/brand-', $brand['url']);
            ?>
            <li><a href="/<?= $brand['url'] ?>" class="brand-list-item"><img src="<?= $brand['fname'] ?>"
                                                                             alt="img"/></a></li>
            <?
        }
        ?>
    </ul>
    <!-- end brand list -->
