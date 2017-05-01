<?


	$catarr = $_logic['catarr'];
	$catline = $catarr['catline'];
?>		

<h1>
<?
include($_SERVER['DOCUMENT_ROOT'].'/public/seo/tdz.php');

if (strlen($_hone)){
  echo $_hone;
}else{
  echo htmlspecialchars($catline['title']);
}
?>
</h1>


<?
	PrintProductBlocks($catarr['products']);
	
	$pagerarr = $catarr['pagerarr'];
	include "modules/indexmodules/pager.php";
?>				
				<?= $catline['text']; ?>

