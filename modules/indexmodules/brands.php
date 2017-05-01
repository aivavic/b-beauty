<!-- brand list -->
	<div class="brand-list-w">
		<div class="mbox">
			<div class="brand-list">
                <?

                foreach ($_logic['brands'] AS $key=>$brand)
                {
                
                $brand['url'] = str_replace('?changebrendmain=','brand-',$brand['url']);
                $brand['url'] = str_replace('&currbrendmain=','/brand-',$brand['url']);
                
                    ?>
                    <a href="/<?= $brand['url']?>" class="brand-list-item"><span class="vfix"></span><img src="<?= $brand['fname']?>" alt="" /></a>
                    <?
                }
                ?>
				<span class="juster"></span>
			</div>
		</div>
	</div>
<!-- end brand list -->	
