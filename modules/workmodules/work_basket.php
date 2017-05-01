<?

    if($act=="order")
    {
        $name = myaddslashes($_REQUEST['name']);
        $email = myaddslashes($_REQUEST['email']);
        //$text = myaddslashes($_REQUEST['mess']);
        //$address = myaddslashes($_REQUEST['address']);
        $phone = myaddslashes($_REQUEST['phone']);

	if(isset($_SESSION['loguserid'])) $userid = (int)$_SESSION['loguserid']; else $userid = 0;

        $allsum = 0;
        $bodytext = '';

        $bodytext .= 'Имя: '.$_REQUEST['name']."\n";
        $bodytext .= 'E-mail: '.$_REQUEST['email']."\n";
        $bodytext .= 'Тел. : '.$_REQUEST['phone']."\n";
        //$bodytext .= 'Адрес. : '.$_REQUEST['address']."\n";
       // $bodytext .= "Коментарий:\n".$_REQUEST['mess']."\n\n================================\n\n";

        $ordertext = '';

	$orderstr = ':';

        foreach ($_SESSION['basket'] AS $key=>$value)
        {
                if($value['count']>0)
                {
                    $kid = $value['id'];

                    $sql = "SELECT * FROM $par->objectstable WHERE id=$kid";
                    $res = mysql_query($sql);
                    $line = mysql_fetch_array($res,MYSQL_ASSOC);

                    $ordid = $value['id'];
                    $ordsize = $value['size'];
                    $ordcount = $value['count'];

                    $orderstr.= "$ordid;$ordcount;$ordsize;".$line['price'].":";

                    $ordertext .= 'КОД: '.$line['id'].' '.htmlspecialchars($line['title']).' - '.$line['price'].' грн. '.$value['count'].' шт '.$value['size'].' размер. | Вместе: '.$line['price']*$value['count']." грн.\n\n";
                    $allsum+= $line['price']*$value['count'];

                    //$sql1 = "UPDATE $par->objectstable SET `added`=`added`+$value WHERE id=$key";
                    //$res1 = mysql_query($sql1);
                    $del = $_SESSION['basket'][$key]['id'];
                    $_SESSION['basket'][$key] = 0;

        		}
        }
        $ordertext .= "Итого: $allsum";

        $currtime = time();

        $sql = "INSERT INTO $par->orderstable (`date`,`name`,`email`,`phone`,`text`,`address`,`ordertext`,`allsum`,`userid`,`orderstr`) VALUES ($currtime,'$name','$email','$phone','$text','$address','$ordertext',$allsum,$userid,'$orderstr')";
//        $sql = "INSERT INTO $par->orderstable SET
//                                                `date`      = $currtime,
//                                                `name`      = '$name',
//                                                `email`     = '$email',
//                                                `phone`     = '$phone',
//                                                `text`      = '$text',
//                                                `address`   = '$address',
//                                                `ordertext` = '$ordertext',
//                                                `allsum`    = '$allsum',
//                                                `userid`    = '$userid',
//                                                `orderstr`  = '$orderstr',";
        mysql_query($sql);

        //mailer($email, $par->adminemail, 'Заказ',$bodytext.$ordertext);
        mailer($email, $varsline['adminemail'], 'Заказ',$bodytext.$ordertext);

        echo '
        <script>
                document.location.href=\'/basket/subact/topay\';
        </script>
        ';
        exit();
        
    }

    if($act=="changebasket")
    {
	
        if(isset($_REQUEST['tov']))
        {
            foreach ($_REQUEST['tov'] AS $key=>$value)
            {
                $_SESSION['basket'][$key]['count'] = (int)$value;
            }
        }

		//if(isset($_REQUEST['deltov'])) $_SESSION['basket'][(int)$_REQUEST['deltov']] = 0;

        if(isset($_REQUEST['deltov']))
        {
            foreach ($_REQUEST['deltov'] AS $key=>$value)
            {
                $del = $_SESSION['basket'][$key]['id'];
		        $_SESSION['basket'][$key] = 0;
            }
        }


        echo '<script> document.location.href = "/basket"; </script>';
        exit();
    }

    if($act=="changebasket2")
    {
        if(isset($_REQUEST['deltov']))
        {
            foreach ($_REQUEST['deltov'] AS $key=>$value)
            {
                $_SESSION['basket'][$key]['count'] = $_SESSION['basket'][$key]['count']-1;
            }
        }


        ?>
        <script> document.location.href = '<?= $_SERVER['HTTP_REFERER']; ?>'; </script>
        <?
        exit();
    }


    if($act=="addtobasket")
    {
	if(isset($_REQUEST['product_id'])) $pid = (int)$_REQUEST['product_id']; else $pid=0;
        
        if($subact=="addtobasket")
        {
                if(isset($_SESSION['basket'][$pid])) $_SESSION['basket'][$pid] += (int)$_REQUEST['quantity'];
                else $_SESSION['basket'][$pid] = (int)$_REQUEST['quantity'];
        }
    
        echo '<script> document.location.href = "/basket"; </script>';
        exit();
    }
?>