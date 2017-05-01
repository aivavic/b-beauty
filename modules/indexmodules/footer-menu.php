		<!-- main footer -->
		<div class="main-footer">
			
			<div class="bottom-menu">
				
					<?
					//debug($_logic['mainmenuarr']);exit;
                $x=2;
					foreach ($_logic['mainmenuarr'] AS $key => $menu)
					{
                        $x++;
                        if ($x%3==0)
                        {
                        ?>
                            <div class="clear"></div>
                        <?
                        }
					?>	<div class="menu-box">
							<div class="menu-box-caption"><?= $menu['title']?></div>
							<?
							if (count($menu['submenu'])>0 && !empty($menu['submenu'][$key]['submenu']))
							{
							?>
								
								<?
								foreach ($menu['submenu'] AS $k=>$submenu)
								{
								?>
								<div class="submenu-box">
									<div class="submenu-box-caption"><?= $submenu['title']?></div>
									<div class="submenu-box-col">
										<ul>
											<?
											if (count($submenu['submenu'])>0)
											{
												foreach ($submenu['submenu'] AS $k2=>$submenu2)
												{
												?>
													<li><a href="<?= $submenu2['url']?>"><?= $submenu2['title']?></a></li>
												<?	
												}	
											}
											?>
										</ul>
									</div>
								</div>
							
								<?
								}
								?>
								
							<?
							}
							else if (count($menu['submenu'])>0 && empty($menu['submenu'][$key]['submenu']))
							{
							?>
								<ul>
							<?
									foreach ($menu['submenu'] AS $k=>$submenu)
									{
									?>
										<li><a href="<?= $submenu['url']?>"><?= $submenu['title']?></a></li>
									<?
									}
									?>
								</ul>
							<?
							}
							?>
						</div>
					<?	
					}
					?>
					<!--<div class="menu-box-caption">ЖЕНСКАЯ ОДЕЖДА</div>
					
						<ul>
							<li><a href="#">Блузы и футболки</a></li>
							<li><a href="#">Брюки</a></li>
							<li><a href="#">Жакеты и блейзеры</a></li>
							<li><a href="#">Жилетки</a></li>
							<li><a href="#">Костюмы/Комплекты</a></li>
							<li><a href="#">Купальные костюмы</a></li>
							<li><a href="#">Толстовки</a></li>
							<li><a href="#">Куртки/Плащи</a></li>
							<li><a href="#">Платья</a></li>
							<li><a href="#">Свитера</a></li>
							<li><a href="#">Сорочки</a></li>
							<li><a href="#">Топы</a></li>
							<li><a href="#">Туники</a></li>
							<li><a href="#">Юбки</a></li>
						</ul>
						
				</div>
				
				<div class="menu-box">
					<div class="menu-box-caption">ДЕТСКАЯ ОДЕЖДА</div>
					
					<div class="submenu-box">
						<div class="submenu-box-caption">Девочки</div>
						<div class="submenu-box-col">
							<ul>
								<li><a href="#">Блузки</a></li>
								<li><a href="#">Блузы</a></li>
								<li><a href="#">Жилеты</a></li>
								<li><a href="#">Комплекты</a></li>
								<li><a href="#">Куртки/Плащи</a></li>
								<li><a href="#">Брюки</a></li>
								<li><a href="#">Юбки</a></li>
								<li><a href="#">Купальники</a></li>
								<li><a href="#">Платья</a></li>
								<li><a href="#">Свитера</a></li>
								<li><a href="#">Топы</a></li>
							</ul>
						</div>
					</div>
					
					<div class="submenu-box">
						<div class="submenu-box-caption">Мальчики</div>			
						<div class="submenu-box-col">			
							<ul>
								<li><a href="#">Блузы</a></li>
								<li><a href="#">Комплекты</a></li>
								<li><a href="#">Футболки</a></li>
								<li><a href="#">Куртки/Плащи</a></li>
								<li><a href="#">Брюки</a></li>
								<li><a href="#">Свитера</a></li>
							</ul>
						</div>
					</div>
				</div>
				
				<div class="menu-box">
					<div class="menu-box-caption">АКСЕССУАРЫ</div>
						<ul>
							<li><a href="#">Детские аксессуары</a></li>
							<li><a href="#">Мужские аксессуары</a></li>
							<li><a href="#">Бижутерия</a></li>
							<li><a href="#">Шапки/Перчатки</a></li>
							<li><a href="#">Ремни</a></li>
							<li><a href="#">Шали/Платки</a></li>
							<li><a href="#">Сумки</a></li>
							<li><a href="#">Часы</a></li>
						</ul>
				</div>-->
			</div>
			
			<div class="main-footer-extra">
				<?
				foreach ($_logic['mainrightarr'] AS $k => $rmenu)
				{
					if ($rmenu['show2']!=0)// && $rmenu['url']!="/")
					{
					?>
						<a href="<?= $rmenu['url']?>" class="extra-item"><?=$rmenu['title']?></a>
					<?
					}
				}
				?>
			</div>

			<div class="short-contacts">
				<header><div class="short-contacts-new"><?= $varsline['title']?></div></header>
				<div class="ctext">
					<?= $varsline['text']?>
					<p>

<a href="https://www.facebook.com/%D0%98%D0%BD%D1%82%D0%B5%D1%80%D0%BD%D0%B5%D1%82-%D0%BC%D0%B0%D0%B3%D0%B0%D0%B7%D0%B8%D0%BD-B-Beauty-280873952252649/">
<img src="/images/fb.png"></a>

<a href="https://vk.com/id371006770">
<img src="/images/vk.png"></a>
  
				</div>
			</div>
		</div>
		<!-- end main footer  -->
