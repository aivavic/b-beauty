<?
@session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/public/seo/tz.php');
error_reporting(E_ALL);
if (isset($_SESSION['logdebug']) && $_SESSION['logdebug'] == 1) {
    error_reporting(E_ALL);
} else {
    error_reporting(E_ERROR);
}

include "headerinc.php";
include "_logic.php";

if ($act == 'none' || $act == 'search' || $act == 'novinki') {
    include "modules/indexmodules_logic/brand_logic.php";
    include "modules/indexmodules_logic/slider_logic.php";
}
if (isset($nopage) && $nopage == 1) {
    include "modules/indexmodules_logic/brand_logic.php";
    include "modules/indexmodules_logic/slider_logic.php";
    include "modules/indexmodules/header.php";
    include "modules/indexmodules/404.php";
    include "modules/indexmodules/footer-menu.php";
    include "modules/indexmodules/footer.php";
    exit;
}
include "modules/indexmodules/header.php";
include "modules/indexmodules/_view_functions.php";
if ($act == "none" || $act == "novinki") {
    include "modules/indexmodules_logic/mainbody_logic.php";
    include "modules/indexmodules/mainbody.php";
    include "modules/indexmodules_logic/menu_logic.php";
}
if ($act == "menu") {
    include "modules/indexmodules_logic/menu_logic.php";
    include "modules/indexmodules/simple-textpage.php";
}
if ($act == "cat" || $act == "bestsellers" || $act == "akcii") {
    include "modules/indexmodules_logic/slider_logic.php";
    include "modules/indexmodules_logic/bread_logic.php";
    include "modules/indexmodules_logic/brand_logic.php";
    include "modules/indexmodules_logic/cat_logic.php";
    include "modules/indexmodules/aside.php";
    include "modules/indexmodules/catalog.php";
}
if ($act == "search") {
    include "modules/indexmodules_logic/bread_logic.php";
    include "modules/indexmodules_logic/cat_logic.php";
    include "modules/indexmodules/catalog.php";
}

if ($act == "tovar") {
    include "modules/indexmodules_logic/bread_logic.php";
    include "modules/indexmodules_logic/tovar_logic.php";
    include "modules/indexmodules_logic/comments_logic.php";
    include "modules/indexmodules/aside.php";
    include "modules/indexmodules/product.php";

}

if ($act == "contacts") {
    include "modules/indexmodules_logic/contacts_logic.php";
    include "modules/indexmodules/contacts.php";

}

if ($act == "basket") {
    include "modules/indexmodules/basket.php";
}
if ($act == "basket2") {
    include "modules/indexmodules/basket2.php";
}

if ($act == "cabinet") {
    include "modules/cabinetmodules/cabinet_logic.php";
    if (isset($_SESSION['loguserid'])) {
        include "modules/cabinetmodules/cabinet_header.php";
        include "modules/cabinetmodules/cabinet_other.php";
        include "modules/cabinetmodules/cabinet_orders.php";
    }
    if ($subact == "register") {
        include "modules/cabinetmodules/cabinet_register.php";
    }
    if ($subact == "login") {
        include "modules/cabinetmodules/cabinet_login.php";
    }
    if ($subact == "remind") {
        include "modules/cabinetmodules/cabinet_remind.php";
    }
}
include "modules/indexmodules/footer-menu.php";
if ($act == "cat" || $act == "none") {
    include "modules/indexmodules/textblock.php";
}
include "modules/indexmodules/footer.php";
?>
<!-- Yandex.Metrika counter -->
<script>
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function () {
            try {
                w.yaCounter28154346 = new Ya.Metrika({
                    id: 28154346,
                    webvisor: true,
                    clickmap: true,
                    trackLinks: true,
                    accurateTrackBounce: true
                });
            } catch (e) {
            }
        });
        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () {
                n.parentNode.insertBefore(s, n);
            };
        s.type = "text/javascript";
        s.async = true;
        s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";
        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else {
            f();
        }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript>
    <div><img src="//mc.yandex.ru/watch/28154346" style="position:absolute; left:-9999px;" alt=""/></div>
</noscript>
<!-- /Yandex.Metrika counter -->
