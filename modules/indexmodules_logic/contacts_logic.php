<?
    $resarr = Array();

	$_logic['pagetitle'] = ''; $_logic['pagetext'] = '';

	$sql = "SELECT * FROM $par->topmenutable WHERE hide=0 AND url='/contacts'";
	$res = mysql_query($sql);
	if($line = mysql_fetch_array($res,MYSQL_ASSOC))
	{
	    if(isset($line['titleh1']) && $line['titleh1']!='') $line['title'] = $line['titleh1'];
	    $_logic['contactstitle'] = $line['title'];
	    $_logic['contactstext']  = $line['text'];
	  //  $_logic['pagemap']    = $line['map'];
            
	}
?>