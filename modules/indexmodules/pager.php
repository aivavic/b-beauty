<?	
	if(count($pagerarr>0))
	{
		?>
		
		<?
		foreach($pagerarr AS $key=>$pageritem)
		{
			if($pageritem['url']==null && $pageritem['value']==null) echo '<span><a>...</a></span>&nbsp;&nbsp;';
			else if($pageritem['url']==null) echo '<a class="active" href="'.$pageritem['url'].'">'.$pageritem['value'].'</a>&nbsp;&nbsp;';
			else echo '<a href="'.$pageritem['url'].'">'.$pageritem['value'].'</a>&nbsp;&nbsp;';
			
		}
		?>
		
		<?
	}
?>	
