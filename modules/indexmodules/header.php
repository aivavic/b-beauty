<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/public/seo/tdz.php'); ?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?= strlen($_title) ? $_title : $_logic['headerarr']['titletitle'] ?></title>
    <?php if (strlen($_description)) {
        echo '<meta name="description" content="' . $_description . '" />	';
    } ?>
    <?php
    $robonic = 'index, follow';
    $rurl = $_SERVER['REQUEST_URI'];
    $rurles = [
        '/start/',
        'changesize=',
        'size=',
        'changeorder=',
        'search',
        'currbrendmain=',
        'changebrendmain=',
        'brendid=',
        '/comments/'
    ];

    foreach ($rurles as $item) {
        $pos = strpos($rurl, $item);
        if ($pos !== false) {
            $robonic = 'noindex, follow';
            break;
        }
    }
    if (($rurl == '/basket') || ($rurl == '/basket/subact/topay')) {
        $robonic = 'noindex, follow';
    }
    ?>

    <meta name="robots" content="<?= $robonic; ?>">
    <link rel="icon" href="<?= $_logic['headerarr']['favicon']; ?>" type="image/x-icon"/>
    <link rel="shortcut icon" href="<?= $_logic['headerarr']['favicon']; ?>" type="image/x-icon"/>

    <link rel="stylesheet" type="text/css" href="/css/jnice.css" media="all"/>
    <link rel="stylesheet" href="/build/css/main.css" media="all"/>
    <link rel="stylesheet" type="text/css" href="/css/jcarousel.basic.css" media="all"/>
    <link rel="stylesheet" type="text/css" href="/css/anythingslider.css" media="all"/>
    <link rel="stylesheet" type="text/css" href="/fancybox/jquery.fancybox.css" media="all"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
    <link href="/utils/jsz/jalerts/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen"/>

    <script src="/js/jquery-1.10.0.min.js"></script>
    <script src="/js/jquery.jcarousel.js" ></script>
    <script src="/js/jcarousel.basic.js" ></script>
    <script src="/js/jquery.anythingslider.js" ></script>
    <script src="/fancybox/jquery.fancybox.js" ></script>
    <script src="/js/selectivizr-min.js" ></script>
    <script src="/js/jquery.watermark.js" ></script>
    <script src="/js/jquery.jnice.js" ></script>
    <script src="/js/scr.js"></script>
    <script src="/utils/jsz/utils/zendoutils.js"></script>
    <script src="/utils/jsz/jalerts/jquery.ui.draggable.js" ></script>
    <script src="/utils/jsz/jalerts/jquery.alerts.js" ></script>
    <script src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
    <!--[if lt IE 9]>
    <script>
        document.createElement('header');
        document.createElement('nav');
        document.createElement('section');
        document.createElement('article');
        document.createElement('aside');
        document.createElement('footer');
        document.createElement('time');
    </script>
    <script src="/js/pie.js"></script>
    <![endif]-->

    <!--[if lt IE 7]>
    <script src="/js/oldie/warning.js"></script>
    <script>window.onload = function () {
        e("/js/oldie/")
    }</script><![endif]-->
    <script>
        var sdelay =<?= $varsline['delay']?>
    </script>
    <!-- Put this script tag to the <head> of your page -->
    <script src="//vk.com/js/api/openapi.js?101"></script>
    <script>
        VK.init({apiId: 4394229, onlyWidgets: true});
    </script>
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-53711912-1', 'auto');
        ga('send', 'pageview');

    </script>
</head>
<body>
<header>
    <div class="container top-header">
        <div class="contact-phones">
            <div class="icon">
                <i class="fa fa-phone" aria-hidden="true"></i>
            </div>
            <!-- /.icon -->
            <div class="phones">
                <?php
                foreach (explode(";", $varsline['phones']) AS $value):
                    echo "<span>{$value}</span>";
                endforeach; ?>
            </div>
            <!-- /.phones -->
        </div>
        <a class="logo" href="/"><img src="/images/logo.png" alt="img"></a>
        <div class="basket">
            <div class="count-orders">
                <span><?= $_logic['headerarr']['basket_num'] ?></span>
            </div>
            <!-- /.count-orders -->
            <a class="basket-link" href="/basket">оформить заказ <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
        </div>
    </div>
    <!-- /.top-header -->
    <div class="nav-wrapper">
        <nav class="container">
            <ul class="nav-list">
                <?php foreach ($_logic['mainmenuarr'] AS $menu): ?>
                    <li><a class="title-sub-menu" href="<?= $menu['url'] ?>"><?= $menu['title'] ?></a>
                        <?php if (array_key_exists('submenu', $menu) && !empty($menu['submenu'])): ?>
                            <ul class="sub-menu">
                                <?php foreach ($menu['submenu'] as $submenu): ?>
                                    <?= "<li><a href='{$submenu["url"]}'>{$submenu["title"]}</a></li>"?>
                                <?php endforeach; ?>
                            </ul>
                            <!-- /.sub-menu -->
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <!-- /.nav-list -->
            <div class="search">
                <form action="/search" method="post">
                    <div class="search-input">
                        <input name="q" type="text" placeholder="Поиск..."/>
                        <div class="search-submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                            <input type="submit" value=" "/>
                        </div>
                    </div>
                </form>
            </div>
        </nav>
    </div>
    <!-- /.nav-wrapper -->
    <? if ($act == "none" || $act == "novinki") {
        include "slider.php";
        include "brands.php";
    } ?>
</header>
