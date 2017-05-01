<?
    //если список новостей
    if($act=="tovar" && $id!=0)
    {
	$commentsarr = Array();
	$commentsinpage = $varsline['newsinpage'];
	$sqlcomments = "SELECT * FROM $par->commentstable WHERE hide=0 AND `categid`=$id ORDER BY prior DESC LIMIT $commentsinpage";
	$rescomments = mysql_query($sqlcomments);
	while($linecomments = mysql_fetch_array($rescomments,MYSQL_ASSOC))
	{
	    //$url = GetSeoUrl('catalog',$line['id'],$line);
	    $commentsarr[] = Array('name'=>$linecomments['name'], 'email'=>$linecomments['email'],'text'=>$linecomments['text'],'date'=>date("d.m.Y",$linecomments['date']));
	}
	$_logic['comments'] = $commentsarr;
	
    }
?>