<?
    @session_start();
    
    if(isset($_SESSION['logdebug']) && $_SESSION['logdebug']==1)
    {
            error_reporting(E_ALL);
    }
    else
    {
            error_reporting(E_ERROR);
    }
    
    include_once "classes.php";
    ini_set('upload_max_filesize',8000000);

    if(isset($_REQUEST['act'])) $act = $_REQUEST['act'];
    if(isset($_REQUEST['subact'])) $subact = $_REQUEST['subact'];
    if(isset($_REQUEST['id'])) $id = (int)$_REQUEST['id']; else $id = 0;
    if(isset($_REQUEST['start'])) $start = (int)$_REQUEST['start']; else $start = 0;

    if(!isset($act)) $act="none";
    if(!isset($subact)) $subact="none";

    $varsline = GetVars();

	//include "modules/workmodules/work_coments.php";
	
	include "modules/workmodules/work_comments.php";

	include "modules/workmodules/work_contacts.php";

	include "modules/workmodules/work_basket.php";

	include "modules/workmodules/work_cabinet.php";

    include "modules/workmodules/work_contactus.php";

    if($act=="changebrend")
    {
        $id = (int)$_REQUEST['id'];
		$return = $_REQUEST['return'];
        $categid = (int)$_REQUEST['categid'];
        $_SESSION['currbrend'][$categid] = $id;

        ?>
            <script> document.location.href = '<?= $return;?>'; </script>
        <?
        exit();
    }

    if($act=="changebrendmain")
    {
        $id = (int)$_REQUEST['id'];
		$return = $_REQUEST['return'];
        $_SESSION['currbrendmain'] = $id;
        //debug($_SESSION['currbrendmain']);exit;
        ?>
        <script> document.location.href = '<?= $return;?>'; </script>
        <?
        exit();
    }

    if ($act== 'changeorder')
    {
        $val = $_REQUEST['val'];
        $_SESSION['ordercat']=$val;
        //echo $_SESSION['ordercat'];
        ?>
        <script> document.location.href = '<?= $_SERVER['HTTP_REFERER']; ?>'; </script>
        <?
        exit();
    }

    if ($act == 'changesize')
    {
        $size = $_REQUEST['size'];
        if ($size !='--')
        {
            $_SESSION['size'] = $size;
        }
        else
        {
            unset ($_SESSION['size']);
        }

    ?>
    <script> document.location.href = '<?= $_SERVER['HTTP_REFERER']; ?>'; </script>
    <?
    exit();
    }

	
?>