		<?
		//debug( $_logic['product']);
		$product_info = $_logic['product'];
		//debug($product_info);
		//echo $id;
		?>
<section class="content_w">
	<div class="content">
		<!-- breadcrumbs -->
        <div class="breadcrumbs">
            <?
            $cbr=0;
            foreach ($_logic['bread'] AS $k=>$val)
            {
                $cbr++;
                ?>
                <a href="<?= $val['url']?>" <? if ($cbr == count($_logic['bread'])) echo "class='active'";?>> <?= $val['title']?></a>
                <?
                if ($cbr != count($_logic['bread']))
                { //echo strtolower($val['title']);
                    //phpinfo();
                    ?>
                    <span class="br-sep">&gt;</span>
                <?
                }
            }
            ?>

        </div>
		<div class="product">
			<div class="product-title">
				<h1 class="product-name-new"><?= $product_info['title']?></h1>
<!--				<span class="product-brand">--><?//= $product_info['brand_name']?><!--</span>-->
			</div>
			
			<div class="product-article">Артикул: <?= $product_info['artikul']?></div>
			<div class="product-maincontent">
				<div class="product-images-w">
					<div class="product-image-w">
						<?
						$k=0;
						foreach ($product_info['objfotos'] AS $key=>$foto)
						{
                            $k++;
						?>
							<a href="<?= $foto['fnamebig']?>" class="product-image <? if ($k==1) echo 'active'?> fancybox" data-imageId="<?= $key?>" style="opacity:<? if ($k==1){echo "1";}else {echo "0";}?>" data-fancybox-group="1"><span class="vfix"></span><img src="<?= $foto['fnamebig']?>" alt=""></a>
						<?
						}
						?>
					</div>
					
					<div class="product-tiny-images">
						<?
						foreach ($product_info['objfotos'] AS $k=>$foto)
						{
						?>
							<a href="#" class="product-tiny-image" data-imageId="<?=$k?>"><img src="<?= $foto['fname']?>" alt="" /></a>
						<?
						}
						?>
					</div>
				</div>
				
				<div class="product-details">
					<div class="product-priceline">
						<span class="product-price"><?= $product_info['pricestr']?></span><span class="product-price-currency"><?= $product_info['price_valuta']?></span><span class="product-old-price">
                            <?
                            if ($product_info['priceold']>0)
                            {
                            ?>
                                <del>
                                    <?= $product_info['priceoldstr']." ".$product_info['price_valuta']?>
                                </del>
                            <?
                            }
                            ?>

                        </span> <!-- toggle hidden class onhand/null -->
						<?
                        if ($product_info['line']['spec2']==1)
						{
						?>
							<span class="product-onhand ">есть в наличии</span>
						<?
						}
						else
						{
						?>
							<div class="product-null "><strong>НЕТ В НАЛИЧИИ</strong></div>
						<?	
						}
						?>
						
						
					</div>
			
					<!-- add hidden class here when null (product-incart-button) -->
                    <?
                    if ($product_info['line']['spec2']==1)
                    {
                    ?>
                        <div class="product-incart-button">
                            <a <?= ' onclick= "size = document.getElementById(\'size\').value; AddToBasket('.$product_info['id'].','.$product_info['price'].',size); return false;" '; ?> href="#product-add"  class="button-orange icon-incart fancybox" >
                                <span class="button-orange-title">Добавить в корзину</span>
                            </a>

                        </div>
                    <?
                    }
                    ?>
                        <div class="product-size">
                            <div class="size-select">
                                <div class="size-select-desc">Размер:</div>
                                <div class="jNice size-select-input">
                                    <?
                                    if (isset($product_info['line']['razmer']) && $product_info['line']['razmer']!='')
                                    {
                                    ?>
                                        <select id="size" name="size">
                                            <?
                                            foreach ($product_info['line']['razmer'] AS $k=>$param1)
                                            {
                                            ?>
                                               <?if ($param1!='')
                                                {
                                                ?>
                                                    <option><?= $param1?></option>
                                                <?
                                                }

                                            }
                                            ?>
                                        </select>
                                    <?
                                    }
                                    ?>

                                </div>
                                <div class="clear"></div>
                            </div>

                            <div class="size-table-w">
                                <a href="#size-table" class="size-table-link dashed fancybox">Таблицы размеров</a>
                            </div>
                        </div>

                    <?
                    if ($varsline['subtext1']!='')
                    {
                    ?>
					<div class="product-details-text">
						<?
						
						
						
						$dosty=$varsline['subtext1'];
						$dosty=str_replace('http://bebeauty.km.ua', '', $dosty);
						$dosty=str_replace('href="/dostavka"', 'href="/paydeliver"', $dosty);
						echo $dosty;
						
						?>
					</div>
                    <?
                    }
                    ?>
				</div>
			</div>
			
			<!-- tabs -->
			<div class="product-tabs">
				<div class="product-tabs-captions">
					<div class="product-tab-caption active" data-yTabsId='1'>Описание товара</div>
					<div class="product-tab-caption " data-yTabsId='2'>Отзывы</div>
				</div>
		
				<div class="product-tab " data-yTabsId='1'> 
					<?=$product_info['text']?>
				</div>
				
				<div class="product-tab active" data-yTabsId='2'> 
					<div class="responds">
						<?
						foreach ($_logic['comments'] AS $item => $comment)
						{
						?>
							<div class="respond-item">
								<div class="respond-item-info">
									<div class="respond-item-author"><?= htmlspecialchars($comment['name'])?></div>
									<div class="respond-item-date"><?= htmlspecialchars($comment['date'])?></div>
								</div>
								
								<div class="respond-item-text">
									<p><?=htmlspecialchars($comment['text'])?></p>
								</div>
							</div>
						<?
						}
						?>
					
					</div>
					
					<div class="respond-form">
						<div class="respond-form-caption">Напишите нам</div>
						<script>
							/*function checkform()
							{
								d = document.getElementById('name').value; if(d=='') { alert('Введите имя'); return false; }
								d = document.getElementById('email').value; if(d=='') { alert('Введите E-mail'); return false; }
								d = document.getElementById('message').value; if(d=='') { alert('Введите текст сообщения'); return false; }
								d = document.getElementById('keystring').value; if(d=='') { alert('Введите цифровой код'); return false; }
								return true;
							}*/
						</script>
						<form id="comment_submit" action="/work.php" method="post">
							<div class="respond-form-row">
								<div class="respond-form-input required">
									<input id="name" name="name" type="text"  required="required" placeholder="Ваше имя" />
								</div>
								<div class="respond-form-input required">
									<input id="email" name="email" type="text" required="required"   placeholder="E-mail" />
								</div>
							</div>
		
							<div class="respond-form-textarea">
								<textarea id="message" name="message" rows="7" placeholder="Сообщение" name=""></textarea>
							</div>
							
							<div class="respond-form-row">
								<div class="captcha-desc">Введите цифры с картинки:</div>
								<div class="captcha">
									<? echo '<img src="/utils/kaptcha/iii.php/?id=0&'.session_name().'=.'.session_id().'">'; ?>
								</div>
								<div class="captcha-input"><input type="text" required="required" name="keystring" id="keystring" value="" /></div>
								<div class="respond-form-submit">
									<input type="hidden" name="act" value="comment">
									<input type="hidden" name="categid" value="<?= $id?>">
									<a href="#" class="button-orange"><input id="subm" type="submit" value="" name=""/><span class="button-orange-title">ОТПРАВИТЬ</span></a>
								</div>
							</div>
						</form>
						
						<? if(isset($_SESSION['sent']) && $_SESSION['sent']==1) echo '<script>$(document).ready(function() {alert(\'Ваше сообщение отправлено\');  });</script>'; ?>
						<? if(isset($_SESSION['sent']) && $_SESSION['sent']==2) echo '<script>$( document ).ready(function() {alert(\'Вы не верно ввели код с картинки\');});</script>'; ?>
						<? $_SESSION['sent'] = 0; ?>
					</div>
				</div>
			</div>
			<?
            if (!empty($_logic['product_similar']))
            {
            ?>
                <div class="similar">
                    <div class="similar-caption">ПОХОЖИЕ ТОВАРЫ</div>

                    <div class="cat-product-linethree">
                        <?
                        foreach ( $_logic['product_similar'] AS $key => $item)
                        {
                        ?>
                            <div class="cat-product">
                                <div class="cat-product-image"><a href="<?= $item['url']?>"><span class="vfix"></span><img src="<?= $item['fname']?>" alt="" /></a></div>
                                <div class="cat-product-name"><a href="<?= $item['url']?>"><?= $item['title']?></a></div>
                                <div class="cat-product-brand"><?= $item['brand_name']?></div>
                                <div class="cat-product-priceline"><span class="actual-price"><?= $item['pricestr']?> <?= $item['price_valuta']?></span><span class="old-price">
                                        <?

                                        if ($item['priceold']>0)
                                        {
                                        ?>
                                            <del>
                                                <?= $item['priceoldstr']?> <?= $item['price_valuta']?>
                                            </del>
                                        <?
                                        }
                                        ?>

                                    </span>
                                </div>
                            </div>
                        <?
                        }
                        ?>

 
                    </div>
                </div>
            <?
            }
            ?>
		</div>
	</div>
</section>
<div class="clear"></div>	
