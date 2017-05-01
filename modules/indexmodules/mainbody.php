
<h1 class="page-caption">
<?
include($_SERVER['DOCUMENT_ROOT'].'/public/seo/tdz.php');

if (strlen($_hone)){
  echo $_hone;
}else{
  echo 'НОВИНКИ';
}
?>
</h1>
		

		<div class="new-product">	
			<!--  4 product in line -->
            <div class="cat-product-linefour">
                <?
                $newsarr = $_logic['newprod'];
                ?>


                <?
                PrintProductBlocks($newsarr['products']);

                ?>

			</div>
		</div>
		
		<!-- paginator -->
    	<div class="paginator">
        <?

            $pagerarr = $newsarr['pagerarr'];
            include "modules/indexmodules/pager.php";
        ?>
<!--			<a href="#">предыдущая</a>-->
<!--			<a href="#">...</a>-->
<!--			<a href="#">11</a>-->
<!--			<a href="#">12</a>-->
<!--			<a href="#">13</a>-->
<!--			<a class="active" href="#">14</a>-->
<!--			<a href="#">15</a>-->
<!--			<a href="#">16</a>-->
<!--			<a href="#">17</a>-->
<!--			<a href="#">18</a>-->
<!--			<a href="#">19</a>-->
<!--			<a href="#">...</a>-->
<!--			<a href="#">следующая</a>-->
		</div>


<div id="seotext">
<?
include($_SERVER['DOCUMENT_ROOT'].'/public/seo/st.php');

if (strlen($_st)){
  echo $_st;
}
?>
</div>
		
