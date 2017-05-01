<?php
	error_reporting(E_ERROR);
	
	@session_start();

/*	if(!isset($_SESSION['logadmin']) || $_SESSION['logadmin']!=1)
	{
			echo 'fail';
			exit(0);
	}*/
	include_once "../../classes.php";
	include_once "../../admin/admfuncs.php";
	
    $varsline = GetVars();


if (!empty($_FILES)) {

$gallerypics = json_decode(stripslashes($_REQUEST['json_gallerypics']));

	$item = $_FILES['Filedata']['tmp_name'];
	$id=(int)$_REQUEST['id'];
	$table=$_REQUEST['table'];
	
	$currtime = time();

	$sql = "INSERT INTO $table (`reportid`,`hide`,`newstype`,`date`) VALUES ($id,0,7,$currtime)";
    $s = "\nSQL=$sql\n";
    file_put_contents($_SERVER['DOCUMENT_ROOT']."/log.txt",$s, FILE_APPEND);	mysql_query($sql);
	$lastid = mysql_insert_id();
	$sql = "UPDATE $table SET `prior`=$lastid WHERE id=$lastid";
	mysql_query($sql);

    $s = "ITEM=$item\n";
    file_put_contents($_SERVER['DOCUMENT_ROOT']."/log.txt",$s, FILE_APPEND);
	$size = getimagesize($item);

    $s = "SIZE=$size\n";
    file_put_contents($_SERVER['DOCUMENT_ROOT']."/log.txt",$s, FILE_APPEND);


    $s = "G=".print_r($gallerypics,true)."\n";
    file_put_contents($_SERVER['DOCUMENT_ROOT']."/log.txt",$s, FILE_APPEND);

    $s = "RG=".print_r($_REQUEST['json_gallerypics'],true)."\n";
    file_put_contents($_SERVER['DOCUMENT_ROOT']."/log.txt",$s, FILE_APPEND);

	
	foreach($gallerypics AS $key2=>$value2)
	{
        $s = "OK\n";
        file_put_contents($_SERVER['DOCUMENT_ROOT']."/log.txt",$s, FILE_APPEND);
			$picprefix = $value2->picprefix;
			$ext = $value2->ext;
			$newname = $picprefix.$lastid.'.'.$ext;
			
			$newname = $par->document_root .'/'. $newname;

        $s = "NEWNAME=$newname";
        file_put_contents($_SERVER['DOCUMENT_ROOT']."/log.txt",$s, FILE_APPEND);
        //echo $_SERVER['DOCUMENT_ROOT']."/log.txt<BR>";

			$mode = $value2->mode;
			$w = $value2->w;
			$h = $value2->h;
			
			CreateAdminPic($mode,$item,$newname,$w,$h);
			
			if(isset($value2->watermarkfile))
			{
				put_watermark($newname,$newname,$value2->watermarkpos,100,$par->document_root.'/'.$value2->watermarkfile);
			}
	}
	
	
	
	unlink($item);
	echo ' ';
}
?>