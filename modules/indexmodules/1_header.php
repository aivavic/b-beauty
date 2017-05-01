<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?
	$titletitle = $_logic['headerarr']['titletitle'];
	$titlekeywords = $_logic['headerarr']['titlekeywords'];
	?>
	<title><?= htmlspecialchars($titletitle); ?></title>
	<?= $titlekeywords; ?>
	
	<? if(isset($_logic['headerarr']['favicon'])): ?>
		<link rel="icon" href="<?= $_logic['headerarr']['favicon']; ?>" type="image/x-icon" />
		<link rel="shortcut icon" href="<?= $_logic['headerarr']['favicon']; ?>" type="image/x-icon" />
	<? endif; ?>
	
	<link media="all" rel="stylesheet" type="text/css" href="/css/all.css" />
	<script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="/js/jquery.main.js"></script>
	<!--[if lt IE 8]><link rel="stylesheet" type="text/css" href="/css/ie.css" media="screen"/><![endif]-->
	<!--[if lt IE 9]><script type="text/javascript" src="/js/PIE.js"></script><![endif]-->
	
<?
/*
	<link rel="stylesheet" type="text/css" href="/utils/jsz/fancybox/jquery.fancybox.css" media="screen" />
	<script type="text/javascript" src="/utils/jsz/fancybox/jquery.fancybox-1.2.1.pack.js"></script>
*/	
?>
	<? //Подключаем файл с полезными функциями ?>
	<script type="text/javascript" src="/utils/jsz/utils/zendoutils.js"></script>
	
	<? //Подключаем jAlert для вывода сообщений ?>
	<script src="/utils/jsz/jalerts/jquery.ui.draggable.js" type="text/javascript"></script>
	<script src="/utils/jsz/jalerts/jquery.alerts.js" type="text/javascript"></script>
	<link href="/utils/jsz/jalerts/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />
	
</head>
<body>
			<span ><a href="<?= $_logic['lang_url_default'];?>">RU</a></span> 
			<span ><a href="<?= $_logic['lang_url_en'];?>">EN</a></span> 
	
	<div id="wrapper">
		<div id="header">
			<div class="box">
				<strong class="logo"><a href="#">уточка72 интернет гипермаркет</a></strong>
				<a href="#" class="feedback">Обратная связь</a>
				<strong class="skype">utochka72</strong>
				<div class="contact">
					<strong class="heading">Звоните нам!</strong>
					<div class="tel"><span>(3143)</span><strong>333-445</strong></div>
				</div>
			</div>
<?
//    Debug('<pre>'.print_r($_logic,true).'</pre>');
?>                        
			<div class="panel">
				<div class="holder">
					<ul id="nav">
                                            <?
                                                foreach($_logic['mainmenuarr'] AS $key=>$item)
                                                {
                                                    ?><li <?= $item['isactive']?' class="active" ':' class="kuku" '; ?>><a href="<?= htmlspecialchars($item['url']); ?>"><?= htmlspecialchars($item['title']); ?></a></li><?
                                                    
                                                }
                                            ?>                                            
					</ul>
					<form action="/search" method="get" class="search-form">
						<fieldset>
							<input type="text" name="q" value="Поиск по каталогу" />
							<input class="btn-search" type="submit" value="search" />
						</fieldset>
					</form>
				</div>
			</div>
			<div class="profile">
				<div class="holder">
				<?
					if(isset($_SESSION['loguserid']) && $_SESSION['loguserid']!=0)
					{
						?>
						<ul class="settings">
							<li><a href="/cabinet">Личный кабинет</a></li>
							<li><a href="/work.php?act=logout">Выход</a></li>
						</ul>
						<?
						
					}
					else
					{
						?>
						<ul class="settings">
							<li><a href="/cabinet/subact/register">Регистрация</a></li>
							<li><a href="/cabinet/subact/login">Вход</a></li>
						</ul>
						<?
					}
				?>
					<a href="/basket">В корзине</a> <span id="basketnum"><?= $_logic['headerarr']['basket_num']; ?></span> <span id="baskettovarov"><?= $_logic['headerarr']['basket_tovarov']; ?></span> на сумму <span id="basketsum"><?= $_logic['headerarr']['basket_sum']; ?></span> <?= $_logic['headerarr']['basket_valuta']; ?>
				</div>
			</div>
		</div>
		<div id="main">
			<div id="sidebar">
				<div class="title">
					<a href="#">Смотреть все</a>
					<h2>Каталог</h2>
				</div>

				<ul class="nav-bar">
				<?
					foreach($_logic['maincatarr'] AS $key=>$item)
					{
						?>
						<li>
							<a href="<?= $item['url']; ?>"><?= htmlspecialchars($item['title']); ?></a>
						<?
							if(isset($item['subarr']))
							{
								?><ul><?
								foreach($item['subarr'] AS $key2=>$item2)
								{
									?><li <?= isset($item2['isactive']) ? ' class="active" ' : ''; ?> ><a href="<?= $item2['url']; ?>"><?= htmlspecialchars($item2['title']); ?></a></li><?
								}
								?></ul><?
							}
						?>
						</li>
						<?
						
					}
				?>
				</ul>
				<a href="/novinki">Новинки</a><br>
				<a href="/bestsellers">Хиты продаж</a><br>
				<a href="/akcii">Акции</a><br>

				<div class="title">
					<a href="#"><?= t_('arhiv');?></a>
					<h2>Новости</h2>
				</div>
				<ul class="news-block">
					<li>
						<em class="date">20 марта</em>
						<a href="#">Новые поступления на нашем складе</a>
					</li>
					<li>
						<em class="date">19 марта</em>
						<a href="#">Мы принимаем карты VISA, Mastercard, Maestro</a>
					</li>
					<li>
						<em class="date">19 марта</em>
						<a href="#">Открыт раздел помощи выбора</a>
					</li>
					<li>
						<em class="date">18 марта</em>
						<a href="#">Возоблена работа сервиса SMS- рассылки</a>
					</li>
					<li>
						<em class="date">18 марта</em>
						<a href="#">Мы добавили раздел “Ножи”</a>
					</li>
				</ul>
				<div class="title">
					<h2>Случайный товар</h2>
				</div>
				<div class="random-block">
					<div class="item-holder">
						<div class="img-holder">
							<span><a href="#"><img src="images/img.jpg" width="207" height="133" alt="image description" /></a></span>
						</div>
						<strong class="price">599 рублей</strong>
					</div>
					<div class="description">
						<a href="#">Нож охотничий</a>
						<dl>
							<dt>Код:</dt>
							<dd>134999</dd>
							<dt>На складе:</dt>
							<dd>есть</dd>
						</dl>
					</div>
					<a href="#" class="order-now">Купить</a>
				</div>
			</div>
			<div id="content">
			
			
