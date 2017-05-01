<?
    @session_start();
    
    print_r($_SESSION);
    if(!isset($_SESSION['logadmin']) || $_SESSION['logadmin']!=1) exit(); //защита от прямого вызова

    include "../classes.php";
    
    $act = "none";
    if(isset($_REQUEST['act'])) $act = $_REQUEST['act'];
    
    if($act="changefields")
    {
        $s = print_r($_REQUEST,true);
        $s.=print_r(unserialize($_REQUEST['msg']),true);
        //file_put_contents("log.txt",$s);
        
        foreach($_REQUEST AS $key=>$value)
        {
            if(substr($key,0,strlen('__edit__'))=='__edit__')
            {
                $a = explode('::',$key);
                //print_r($a);
                $table = $a[1];
                $field = $a[2];
                $id = $a[3];
                $value = myaddslashes($value);
                $sql = "UPDATE `$table` SET `$field`='$value' WHERE id=$id";
                mysql_query($sql);
                echo $sql.'<BR>';
            }
        }
        
    }
    echo 'ok';
    
?>