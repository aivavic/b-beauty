<!DOCTYPE html>
<?php //die('header');?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title><?
        include($_SERVER['DOCUMENT_ROOT'] . '/public/seo/tdz.php');

        if (strlen($_title)) {
            echo $_title;
        } else {
            echo $_logic['headerarr']['titletitle'];
        }
        ?></title>


    <?
    include($_SERVER['DOCUMENT_ROOT'] . '/public/seo/tdz.php');

    if (strlen($_description)) {
        echo '<meta name="description" content="' . $_description . '" />	';
    }
    ?>





    <? //= $_logic['headerarr']['titlekeywords']?>

    <?


    $robonic = 'index, follow';
    $rurl = $_SERVER['REQUEST_URI'];

    $rurles = array(
        '/start/',
        'changesize=',
        'size=',
        'changeorder=',
        'search',
        'currbrendmain=',
        'changebrendmain=',
        'brendid=',
        '/comments/',);

    foreach ($rurles as $item) {
        $pos = strpos($rurl, $item);
        if ($pos !== false) {
            $robonic = 'noindex, follow';
            break;
        }
    }


    if (($rurl == '/basket') || ($rurl == '/basket/subact/topay')) {
        $robonic = 'noindex, follow';

    } ?>

    <meta name="robots" content="<? echo $robonic; ?>">


    <? // if(isset($_logic['headerarr']['favicon'])): ?>
    <link rel="icon" href="<?= $_logic['headerarr']['favicon']; ?>" type="image/x-icon"/>
    <link rel="shortcut icon" href="<?= $_logic['headerarr']['favicon']; ?>" type="image/x-icon"/>
    <? //endif; ?>

    <!--    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic&subset=latin,cyrillic'-->
    <!--          rel='stylesheet' type='text/css'>-->
    <link rel="stylesheet" type="text/css" href="/css/jnice.css" media="all"/>

    <link rel="stylesheet" href="/build/css/main.css" media="all"/>
    <script src="/js/jquery-1.10.0.min.js"></script>

    <link rel="stylesheet" type="text/css" href="/css/jcarousel.basic.css" media="all"/>
    <script src="/js/jquery.jcarousel.js" type="text/javascript"></script>
    <script src="/js/jcarousel.basic.js" type="text/javascript"></script>

    <link rel="stylesheet" type="text/css" href="/css/anythingslider.css" media="all"/>
    <script src="/js/jquery.anythingslider.js" type="text/javascript"></script>

    <link rel="stylesheet" type="text/css" href="/fancybox/jquery.fancybox.css" media="all"/>
    <script src="/fancybox/jquery.fancybox.js" type="text/javascript"></script>

    <script src="/js/selectivizr-min.js" type="text/javascript"></script>
    <script src="/js/jquery.watermark.js" type="text/javascript"></script>

    <script src="/js/jquery.jnice.js" type="text/javascript"></script>

    <script src="/js/scr.js" type="text/javascript"></script>
    <? //Подключаем файл с полезными функциями ?>
    <script type="text/javascript" src="/utils/jsz/utils/zendoutils.js"></script>

    <? //Подключаем jAlert для вывода сообщений ?>
    <script src="/utils/jsz/jalerts/jquery.ui.draggable.js" type="text/javascript"></script>
    <script src="/utils/jsz/jalerts/jquery.alerts.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
    <link href="/utils/jsz/jalerts/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen"/>
    <!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->
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
    <script src="/js/pie.js" type="text/javascript"></script>
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
    <script type="text/javascript" src="//vk.com/js/api/openapi.js?101"></script>

    <script type="text/javascript">
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
            <? $h_phones = explode(";", $varsline['phones']); ?>
            <div class="phones">
                <?
                $c_phones = 0;
                foreach ($h_phones AS $value) {
                    $c_phones++;
                    ?>
                    <span><?= $value ?></span>
                <? } ?>
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
                                    <li>
                                        <a href="<?= $submenu["url"] ?>"><?= $submenu["title"] ?></a>
                                    </li>
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
    <?
    if ($act == "none" || $act == "novinki") {
        include "slider.php";
        include "brands.php";
    }
    ?>
</header>
