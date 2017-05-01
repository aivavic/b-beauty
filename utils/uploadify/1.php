<?

	echo $_SERVER['DOCUMENT_ROOT'];
	$r = file_put_contents($_SERVER['DOCUMENT_ROOT']."/log.txt","testetstetst111111111",FILE_APPEND);
	if($r === false) echo "FALSE<BR>";
	else echo "R=$r<BR>";
    echo file_get_contents($_SERVER['DOCUMENT_ROOT']."/log.txt");
?>