<?
	if ($act=='menu'  && $id!=0)
	{
		$_logic['pageitem']=Array();
		$sql="SELECT * FROM $par->topmenutable WHERE id=$id";
		$res = mysql_query($sql);
		$line = mysql_fetch_array($res,MYSQL_ASSOC);
		$line = LangProcess($line);
		
		if(isset($line['titleh1']) && $line['titleh1']!='') $line['title']=$line['titleh1']; else $line['title']=$line['title'];
		
		$_logic['pageitem'] = $line;
		

	}
	
	if ($act=='none')
	{
		$_logic['pageitem']=Array();
		$sql="SELECT * FROM $par->topmenutable WHERE url= '/'";
		$res = mysql_query($sql);
		$line = mysql_fetch_array($res,MYSQL_ASSOC);
		$line = LangProcess($line);
		
		if(isset($line['titleh1']) && $line['titleh1']!='') $line['title']=$line['titleh1']; else $line['title']=$line['title'];
		
		$_logic['pageitem'] = $line;
		

	}
?>	