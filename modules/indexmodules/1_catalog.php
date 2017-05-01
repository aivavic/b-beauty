<?
	$catarr = $_logic['catarr'];
	$catline = $catarr['catline'];

?>
<? //Debug($_SESSION); ?>
		<section class="content_w">
			<div class="content">
				
				<!-- catalog -->
				<div class="catalog">
					<!-- breadcrumbs -->
                    <?
                    if ($act == "cat")
                    {
                    ?>
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
                            {

                            ?>
                                <span class="br-sep">&gt;</span>
                            <?
                            }
                        }
                        ?>

					</div>

				
				
					<!-- small slider -->
                        <?
                        if (!empty($_logic['sliderarr1']))
                        {
                        ?>
                        <div class="slider-small-w">
                            <ul id="slider-small">
                                <?
                                foreach ($_logic['sliderarr1'] AS $key=>$slide)
                                {
								?>
                                    <li class="slider-small-item"><a href="<?= $slide['title']?>" class="overall"></a><img src="<?= $slide['fname']?>" <?= $slide['addstr']?> alt="" /></li>
                                <?
                                }                           
                                ?>
                         
                            </ul>
                        </div>
                        <?
                        }
                        ?>


                    <!-- brand list -->


                            <div class="brand-list">
                                <?
                                foreach ($_logic['brands'] AS $key=>$brands)
                                {
                                    ?>
                                    <a href="<?= $brands['url']?>" class="brand-list-item"><span class="vfix"></span><img src="<?= $brands['fname']?>" alt="" /></a>
                                    <?
                                }
                                ?>
                                <span class="juster"></span>
                            </div>

                    <!-- end brand list -->
                    <?
                    }
                    ?>
					
					<!-- catalog heading -->
					<div class="catalog-heading"><?= htmlspecialchars($catline['title']); ?></div>

                    <?
//                        $instr = GetInStr($id,$par->categorytable);
//                        $sql = "SELECT `razmer` FROM $par->objectstable WHERE `hide`=0 AND `categid` IN (-1 $instr) AND `razmer`!=''";
//                        echo $sql.'<BR>';
//                        $res = mysql_query($sql);
//
//                        $sizes = Array();
//                        while($line = mysql_fetch_array($res,MYSQL_ASSOC))
//                        {
//                            echo $line['razmer'].'<BR>';
//                            $a = explode(';',$line['razmer']);
//                            $sizes = array_merge($sizes,$a);
//                        }
//                        $sizes = array_unique($sizes);
//
                       // Debug($_logic['sizes']);
                    ?>
					<!-- catalog filter -->
                    <?
                    if ($act=='cat')
                    {
                    ?>
					<div class="catalog-filter">					
						<div class="size-select">
							<div class="size-select-desc">Размер:</div>
							<div class="jNice size-select-input">
								<select OnChange="document.location='/work.php?act=changesize&size='+this.value">
                                    <option> -- </option>
                                    <?
                                    foreach ($_logic['sizes'] AS $key => $size)
                                    {
                                    ?>
                                        <option <? if (isset($_SESSION['size']) && $_SESSION['size']== $size) echo "selected" ?>><?= $size?></option>
                                    <?
                                    }
                                    ?>
<!--									<option>D</option>-->
<!--									<option>XXL</option>-->
<!--									<option>M</option>-->
<!--									<option>XXI</option>-->
								</select>
							</div>
							<div class="clear"></div>
						</div>
						
						<div class="catalog-sort">
							<div class="sort-method">
                                <?
                                if (!isset($_SESSION['ordercat']) || $_SESSION['ordercat']==1)
                                {
                                ?>
                                    <span class="sort-down active"><a href="/work.php?act=changeorder&val=0" class="dashed">по убыванию цены </a>&nbsp;&darr;</span>
                                <?
                                }
                                else
                                {
                                ?>
                                    <span class="sort-up active"><a href="/work.php?act=changeorder&val=1" class="dashed">по возрастанию цены </a>&nbsp;&uarr;</span>
                                <?
                                }
                                ?>


							</div>
						</div>
					</div>
					<div class="clear"></div>
                    <?
                    }
                    ?>
					<!-- products 3inline -->					
					<div class="cat-product-linethree">
						<?
						PrintProductBlocks($catarr['products']);						
						?>
						
					</div>
					<!-- end products 3inline -->
					
					<!-- paginator -->
					<div class="paginator">
						<?
						$pagerarr = $catarr['pagerarr'];
						include "modules/indexmodules/pager.php";
						?>

					</div>
				</div>	
				<!-- end catalog-->
			</div>
		</section>


		<div class="clear"></div>	
		
		
		
	