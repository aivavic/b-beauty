<!-- end textbox -->		
	</div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ru_RU/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	
	
	<div class="footer_placeholder">
</div>
	<div class="footer">



		<div class="mbox"><span class="vfix"></span> 

<div id="jtext">
Одежда - это способ самовыражения как взрослых так и детей. Если вы хотите, чтобы ваш ребенок выглядел самым стильным и модным, 
тогда - добро пожаловать в наш интернет-магазин детской одежды b-beauty.com.ua.
Детская одежда от известных производителей Kiko, RM, Donilo - это качество, уют и комфорт вашего самого близкого человечка.<br> 
Одежда Kiko и Donilo представлена широким ассортиментом моделей для девочек и мальчиков от 6 месяцев до 16 лет.  
У нас Вы всегда сможете подобрать одежду на зиму, на весну и осень. В одежде от Kiko, RM, Donilo сочетается удобный крой одежды, 
использование качественных, современных материалов и ярких трендовых цветов. 
Мы с радостью поможем вам в выборе удобной и модной одежды для вашего ребенка.
</div>
<div class="mbox"><span class="vfix"></span> 

			<span class="copyright"><?= $varsline['f_text']?></span>
			<span class="social-likes">

				<!--<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fbebeauty.km.ua&amp;layout=button_count&amp;show_faces=false&amp;width=200&amp;action=like&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:21px;" allowTransparency="true"></iframe>-->
				<!--<span class="social-likes-item"><img src="/images/t_vk-like.png" alt="" /></span>-->
				<!--<span class="social-likes-item"><img src="/images/t_tw-like.png" alt="" /></span>-->
				<table>
					<tr>
						
						<td>
							<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fbebeauty.km.ua&amp;width=120&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;share=false&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:120px; height:21px;" allowTransparency="true"></iframe>
						</td>
						<td>
							<!-- Put this div tag to the place, where the Like block will be -->
							<div id="vk_like"></div>
							<script type="text/javascript">
							VK.Widgets.Like("vk_like", {type: "mini", height: 24});
							</script>
						</td>
						<td>
							<a href="https://bebeauty.km.ua" class="twitter-share-button" data-url="https://bebeauty.km.ua" data-via="Bebeauty.km.ua" data-lang="en">Tweet</a>
							<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
						</td>
					</tr>
				</table>

			</span>

			<span class="design">Разработка сайта — Студия братьев Самойленко</span>
		</div>

	</div>
	
		
<!-- fancybox wrappers -->	
	<div class="fancybox-wrapper">
		
		<!-- size table -->
		<div id="size-table">
			<div class="ctext">
				<?= $varsline['sizetable']?>
			</div>
		</div>
		<!-- end size table -->
		
		
		<!-- product add -->
		<div id="product-add">

			<div class="product-add-heading">У вас в корзине <span class="basketnum"> <?= $_logic['headerarr']['basket_num']?> </span> <span class="baskettovarov"><?= $_logic['headerarr']['basket_tovarov']?></span>.</div>
		<div id="product-add2">	
			<div class="cart-product-item">
				<table>
					<tr>
						<td class="cart-product-cancel"><a href="#" class="close-gray"></a></td>
						<td class="cart-product-image"><a href="#"><img src="/images/t_product-mainimg1.png" alt="" /></a></td>
						<td class="cart-product-desc">
							<div><a href="#" class="cart-product-name">Джинсы-стретч John Baner JEANSWEAR</a>
							<p class="cart-product-article">Артикул: 0256938</p> </div>
						</td>
						<td class="cart-product-size"><div>XL</div></td>
						<td class="cart-product-price"><div>129 грн</div></td>
						
					</tr>
				</table>	
			</div>
			
			<div class="cart-product-item">
				<table>
					<tr>
						<td class="cart-product-cancel"><a href="#" class="close-gray"></a></td>
						<td class="cart-product-image"><a href="#"><img src="/images/t_product-mainimg1.png" alt="" /></a></td>
						<td class="cart-product-desc">
							<div><a href="#" class="cart-product-name">Джинсы-стретч John Baner JEANSWEAR</a>
							<p class="cart-product-article">Артикул: 0256938</p> </div>
						</td>
						<td class="cart-product-size"><div>XL</div></td>
						<td class="cart-product-price"><div>129 грн</div></td>
						
					</tr>
				</table>
			</div>
		</div>
			<div class="product-add-footer">
				<div class="product-add-exit">
					<a href="#" class="arrow-left">продолжить покупки</a> 
				</div>
				
				<div class="product-add-orderbutton">
					<a href="/basket" class="button-orange"><span class="button-orange-title">ОФОРмить заказ</span></a>
				</div>
			</div>
		</div>
		<!-- end product add -->
	</div>
</body>
</html>