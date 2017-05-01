<?
    if ($act=='cat')
    {
	if ($catarr['catline']['text']!='')
	{
	?>
	<!-- textbox-->
	<div class="textbox ctext">
		
		<?=$catarr['catline']['text'];?>
	</div>
	<!-- end textbox -->		

	<?	
	}
    }
    
    
    if ($act=='none')
    {
	if ($_logic['pageitem']['text']!='')
	{
	?>
	<!-- textbox-->
	<div class="textbox ctext">
		
		<?=$_logic['pageitem']['text'];?>
	</div>
	<!-- end textbox -->
	<?
        }
    }
    
    
?>