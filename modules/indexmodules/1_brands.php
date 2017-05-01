<!-- brand list -->
	<div class="brand-list-w">
		<div class="mbox">
			<div class="brand-list">
                <?

                foreach ($_logic['brands'] AS $key=>$brand)
                {
                    ?>
                    <a href="<?= $brand['url']?>" class="brand-list-item"><span class="vfix"></span><img src="<?= $brand['fname']?>" alt="" /></a>
                    <?
                }
                ?>
<!--				<a href="#" class="brand-list-item"><span class="vfix"></span><img src="/images/t_firma1.png" alt="" /></a>-->
<!--				<a href="#" class="brand-list-item"><span class="vfix"></span><img src="/images/t_firma2.png" alt="" /></a>-->
<!--				<a href="#" class="brand-list-item"><span class="vfix"></span><img src="/images/t_firma3.png" alt="" /></a>-->
<!--				<a href="#" class="brand-list-item"><span class="vfix"></span><img src="/images/t_firma4.png" alt="" /></a>-->
<!--				<a href="#" class="brand-list-item"><span class="vfix"></span><img src="/images/t_firma5.png" alt="" /></a>-->
<!--				<a href="#" class="brand-list-item"><span class="vfix"></span><img src="/images/t_firma6.png" alt="" /></a>-->
<!--				<a href="#" class="brand-list-item"><span class="vfix"></span><img src="/images/t_firma7.png" alt="" /></a>-->
				<span class="juster"></span>
			</div>
		</div>
	</div>
<!-- end brand list -->	