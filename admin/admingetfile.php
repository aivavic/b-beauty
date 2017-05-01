<?
//дописать защиту от вызова вне админки с левым файлом
    error_reporting(E_ALL);

    @session_start();

    include_once "../classes.php";

    $varsline = GetVars();
    
    if(!isset($_SESSION['logadmin'])) exit();
    
    if(isset($_REQUEST['tablename'])) $tablename = addslashes($_REQUEST['tablename']); else $tablename = "";
    if(isset($_REQUEST['filename'])) $filename = $_REQUEST['filename']; else $filename = "";
    if(isset($_REQUEST['id'])) $id = (int)$_REQUEST['id']; else $id = 0;
    if(isset($_REQUEST['filefield'])) $filefield = addslashes($_REQUEST['filefield']); else $filefield = '';

    $sql = "SELECT * FROM $tablename WHERE id=$id";
    $res = mysql_query($sql);
    if($line = mysql_fetch_array($res,MYSQL_ASSOC))
    {
//        if(is_file('../files/'.$filename))
        if(is_file($filename))
        {
                header("Content-type: file/file");
                header('Content-Disposition: attachment; filename="'.$line[$filefield].'"');
                readfile($filename);
        }
    }
?>