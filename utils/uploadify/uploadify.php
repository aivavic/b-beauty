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

$gallerypics = $_REQUEST['json_gallerypics'];
$gallerypics = stripslashes($gallerypics);
$gallerypics = json_decode($gallerypics);

	$item = $_FILES['Filedata']['tmp_name'];
	$id=(int)$_REQUEST['id'];
	$table=$_REQUEST['table'];
	
	$currtime = time();

	$sql = "INSERT INTO $table (`reportid`,`hide`,`newstype`,`date`) VALUES ($id,0,7,$currtime)";
	mysql_query($sql);
	$lastid = mysql_insert_id();
	$sql = "UPDATE $table SET `prior`=$lastid WHERE id=$lastid";
	mysql_query($sql);
	$size = getimagesize($item);
	
	foreach($gallerypics AS $key2=>$value2)
	{
            if('`'.$table.'`' == $par->fotorobjtable)
            {
                $partname = pathinfo($_FILES['Filedata']['name'], PATHINFO_FILENAME);

                if($value2->picprefix=='fotos/object_bg_') $newname = 'fotos/'.$partname.'.jpg';
                else if($value2->picprefix=='fotos/object_sm_') $newname = 'fotos/'.$partname.'_sm.jpg';

                $newname = $par->document_root .'/'. $newname;

                $sql = "UPDATE $table SET `filename`='$partname' WHERE id=$lastid";
                mysql_query($sql);
            }
            else
            {
                $picprefix = $value2->picprefix;
                $ext = $value2->ext;
                $newname = $picprefix.$lastid.'.'.$ext;

                $newname = $par->document_root .'/'. $newname;
            }

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