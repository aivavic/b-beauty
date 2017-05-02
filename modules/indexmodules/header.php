
<!DOCTYPE html>
<?php //die('header');?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title><?
include($_SERVER['DOCUMENT_ROOT'].'/public/seo/tdz.php');

if (strlen($_title)){
  echo $_title;
}else{
  echo $_logic['headerarr']['titletitle'];
}
?></title>







<?
include($_SERVER['DOCUMENT_ROOT'].'/public/seo/tdz.php');

if (strlen($_description)){
  echo '<meta name="description" content="'.$_description.'" />	';
}
?>





<?//= $_logic['headerarr']['titlekeywords']?>
	
	<?
	
	
	$robonic='index, follow';
$rurl = $_SERVER['REQUEST_URI'];

  $rurles=array(
'/start/',
'changesize=',
'size=',
'changeorder=',
'search',
'currbrendmain=',
'changebrendmain=',
'brendid=',
'/comments/',);

  foreach($rurles as $item){
    $pos=strpos($rurl,$item);
    if ($pos!==false){
    $robonic='noindex, follow';
     break;
      }
}


if (($rurl=='/basket') || ($rurl=='/basket/subact/topay')){
 $robonic='noindex, follow';

}?>

<meta name="robots" content="<? echo $robonic; ?>">
	
	
	
	
	
	
	
	
	
	
	
	
    <?// if(isset($_logic['headerarr']['favicon'])): ?>
        <link rel="icon" href="<?= $_logic['headerarr']['favicon']; ?>" type="image/x-icon" />
        <link rel="shortcut icon" href="<?= $_logic['headerarr']['favicon']; ?>" type="image/x-icon" />
    <? //endif; ?>
	<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="/css/style.css" media="all" />
	<link rel="stylesheet" type="text/css" href="/css/gradients.css" media="all" />
	<script src="/js/jquery-1.10.0.min.js" type="text/javascript"></script>

	<link rel="stylesheet" type="text/css" href="/css/jcarousel.basic.css" media="all" />
	<script src="/js/jquery.jcarousel.js" type="text/javascript"></script>
	<script src="/js/jcarousel.basic.js" type="text/javascript"></script>

	<link rel="stylesheet" type="text/css" href="/css/anythingslider.css" media="all" />
	<script src="/js/jquery.anythingslider.js" type="text/javascript"></script>	
	
	<link rel="stylesheet" type="text/css" href="/fancybox/jquery.fancybox.css" media="all" />
	<script src="/fancybox/jquery.fancybox.js" type="text/javascript"></script>
	
	<script src="/js/selectivizr-min.js" type="text/javascript"></script>
	<script src="/js/jquery.watermark.js" type="text/javascript"></script>

	<link rel="stylesheet" type="text/css" href="/css/jnice.css" media="all" />
	<script src="/js/jquery.jnice.js" type="text/javascript"></script>

	<script src="/js/scr.js" type="text/javascript"></script>
		<? //Подключаем файл с полезными функциями ?>
	<script type="text/javascript" src="/utils/jsz/utils/zendoutils.js"></script>
	
	<? //Подключаем jAlert для вывода сообщений ?>
	<script src="/utils/jsz/jalerts/jquery.ui.draggable.js" type="text/javascript"></script>
	<script src="/utils/jsz/jalerts/jquery.alerts.js" type="text/javascript"></script>
	<link href="/utils/jsz/jalerts/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />

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

	<!--[if lt IE 7]><script src="/js/oldie/warning.js"></script><script>window.onload=function(){e("/js/oldie/")}</script><![endif]-->
    <script>
        var sdelay=<?= $varsline['delay']?>
    </script>
<!-- Put this script tag to the <head> of your page -->
<script type="text/javascript" src="//vk.com/js/api/openapi.js?101"></script>

<script type="text/javascript">
  VK.init({apiId: 4394229, onlyWidgets: true});
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53711912-1', 'auto');
  ga('send', 'pageview');

</script>


</head>
<body>
	<header class="header">
		<div class="mbox">
			<div class="header-left">
				<div class="logo"><a href="/" class="overall"></a><span class="logo-heading"><?= $varsline['logo']?></span></div>
			</div>
			
			<div class="header-center">
                <?$h_phones = explode(";",$varsline['phones']);?>
				<div class="phone-line">
                    <?
                    $c_phones=0;
                    foreach ($h_phones AS $value)
                    {
                        $c_phones++;
                    ?>
                        <span class="phone-line-item"><?= $value?></span>
                        <?
                        if ($c_phones!=count($h_phones))
                        {
                        ?>
                            <span class="phone-line-sep">&nbsp;</span>
                        <?
                        }
                    }
                    ?>
<!--					<span class="phone-line-item">044 452 69 31</span>-->
<!--					<span class="phone-line-sep">&nbsp;</span>-->
<!--					<span class="phone-line-item">044 452 69 31</span>					-->
<!--					<span class="phone-line-sep">&nbsp;</span>-->
<!--					<span class="phone-line-item">044 452 69 31</span>-->
				</div>
				
				<div class="search">
					<form action="/search" method="post" class="jNice">
						<div class="search-input">
							<input name="q" type="text" name="" placeholder="поиск по сайту" />
							<div class="search-submit"><input type="submit" value="" /></div>
						</div>
					</form>
				</div>
			</div>
			
			<div class="header-right">
				<div class="basket-info">
					<a href="#" class="basket-info-link"></a>
					<div class="basket-info-caption">КОРЗИНА</div>
					<div class="basket-info-text">У Вас в корзине <span class="basketnum"> <?= $_logic['headerarr']['basket_num']?> </span> <span class="baskettovarov"><?= $_logic['headerarr']['basket_tovarov']?></span></div>
					<a href="/basket" class="button-green">ОФОРМИТЬ ЗАКАЗ</a>
				</div>
			</div>
			
		</div>	
	</header>

	<nav class="top-menu-w ">
		<div class="mbox">
			<ul class="top-menu">
				<?
				//debug($_logic['mainmenuarr']);exit;
				foreach ($_logic['mainmenuarr'] AS $key => $menu)
				{
					//if ($menu['url']!="/" && $menu['spec1']==0)
					//{
					?>
						<li><a href="<?=$menu['url']?>"><?=$menu['title']?></a>
							<?
							if (count($menu['submenu'])>0 && !empty($menu['submenu'][$key]['submenu']))
							{
								//echo $key;
								
							?>
								<div class="sub-menu-w">
									<?
									foreach ($menu['submenu'] AS $k=>$submenu)
									{
									?>
										
											<div class="submenu-box">
												<div class="submenu-box-caption">
												  <a href="<?=$submenu['url']?>">
												    <?=$submenu['title']?>
												  </a>  
												</div>
												<?
												if (count($submenu['submenu'])>0)
												{
													
													?>
													<!--<div class="submenu-box-col">-->
														<ul>
															<?
															foreach ($submenu['submenu'] AS $k2=>$submenu2)
															{
															?>														
																<li><a href="<?=$submenu2['url']?>"><?=$submenu2['title']?></a></li>															
															<?													
															}
															?>
														</ul>
													<!--</div>-->
													
													
												
													
												<?
												}
												?>
											</div>
									<?
									}
									?>
								</div>
								<div class="clear"></div>
							<?	
							}
							
							else if (count($menu['submenu'])>0 && empty($menu['submenu'][$key]['submenu']))
							{
								//echo $key;
							?>
								<div class="sub-menu-w">
									<div class="submenu-box">
										<!--<div class="submenu-box-col">-->
											<ul>
											<?
											foreach ($menu['submenu'] AS $k11 => $submenu11)
											{
												if (empty($submenu11['submenu']))
												{
												?>
													<li><a href="<?= $submenu11['url'];?>"><?= $submenu11['title'];?></a></li>
												<?
												}
												
											}
											?>
											</ul>
										<!--</div>-->
									</div>
								</div>
								<div class="clear"></div>
							<?	
							}
							?>
						</li>
					<?
					//}
					//echo $key;
				}
				?>				
			</ul>
			
			<div class="top-menu-extra">
				<?
				foreach ($_logic['mainrightarr'] AS $k => $rmenu)
				{
					if ($rmenu['show']!=0)// && $rmenu['url']!="/")
					{
					?>
						<a href="<?= $rmenu['url']?>" class="extra-item"><?=$rmenu['title']?></a>
					<?
					}
				}
				?>
				
			</div>
		</div>
	</nav>
	<?
	if ($act=="none" || $act =="novinki")
	{
        include "slider.php";
        include "brands.php";
	}
	?>
		
	<div class="main mbox">
