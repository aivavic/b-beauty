<?php

    $uploaddir = '../../../../../userfiles';
    $file_Name = $_FILES['upload']["name"];
    $file_TmpName = $_FILES['upload']["tmp_name"];
    $uploadfile = $uploaddir .'/'. $_FILES['upload']["name"];
	$k = 0;
	while(is_file($uploadfile))
	{
		$k++;
		$ext = pathinfo($file_Name, PATHINFO_EXTENSION);
		$uploadfile = $uploaddir .'/'.substr($file_Name, 0, strlen($file_Name)-strlen($ext)-1).'('.$k.').'.$ext;
	}

    move_uploaded_file($file_TmpName, $uploadfile);
     
    $callback = $_REQUEST['CKEditorFuncNum'];
     
    $full_path = '/userfiles/'.$file_Name;
	
    echo '<script>window.parent.CKEDITOR.tools.callFunction("'.$callback.'", "'.$full_path.'","Файл загружен" );</script>';
?>