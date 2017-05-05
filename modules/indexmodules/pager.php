<?	
	if(count($pagerarr>0))
	{
		?>
		
		<?

		foreach($pagerarr AS $key=>$pageritem)
		{
			if($pageritem['url']==null && $pageritem['value']==null) echo '<li><a>...</a></li>';
			else if($pageritem['url']==null) echo '<li><a class="active" href="'.$pageritem['url'].'">'.$pageritem['value'].'</a></li>';
			else echo '<li><a href="'.$pageritem['url'].'">'.$pageritem['value'].'</a></li>';
			
		}
		?>
		
		<?
	}
?>	
