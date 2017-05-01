<? $item = $_logic['product']; ?>
				<h1><?= htmlspecialchars($item['title']); ?></h1>
				<div class="main-product">
					<div class="photo-block">
						<div class="main-img">
							<ul>
							<?
								foreach($item['objfotos'] AS $key=>$fotoitem)
								{
									$fnamebig = $fotoitem['fnamebig'];
									$addstr = GetAddStr(244,242,$fnamebig);
									$fnamebig = '/'.$fnamebig;
									
									?><li><span><a class="fancybox" rel="1" title="text 01" href="<?= $fnamebig; ?>"><img src="<?= $fnamebig; ?>" <?= $addstr; ?> alt="image description" /></a></span></li><?
								}
							?>
							</ul>
						</div>
						<ul class="thumbs">
<?						
								foreach($item['objfotos'] AS $key=>$fotoitem)
								{
									$fname = $fotoitem['fname'];
									$addstr = GetAddStr(57,58,$fname);
									$fname = '/'.$fname;
									
									?>
									<li>
										<a href="#">
											<img src="<?= $fname?>" <?= $addstr; ?> alt="<?= htmlspecialchars($item['image_alt']);?>" />
											<span class="mask"></span>
										</a>
									</li>
									<?
									
								}
?>						
						</ul>
					</div>
					<div class="description">
						<div class="content">
							<?= $item['text'];?>
						</div>
							<input type="text" style="width:30px;" id="numtovar" name="numtovar" value="1">
						<div class="price-block">
							<strong class="price"><?= $item['pricestr'];?> <?= $item['price_valuta']; ?></strong>
							<a href="#" <?= ' onclick="d = document.getElementById(\'numtovar\').value; AddToBasket('.$item['id'].','.$item['price'].',d); return false;" '; ?> class="add-to-card">добавить</a>
						</div>
						<p class="note">Доставка по всей России</p>
					</div>
				</div>
				
				<h2>Похожие товары</h2>
				
				<?
					PrintProductBlocks($_logic['product_similar']);
				?>
