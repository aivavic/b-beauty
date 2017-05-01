<?
if($act=="cat") $cid = $id;
else $cid = 0;


if ($act=='cat')
{

    $brands = Array();
    $instr = '(-1'.GetInStr($id,$par->categorytable).')';

    $sql = "SELECT DISTINCT(`brendid`) FROM $par->objectstable WHERE hide=0 AND categid IN $instr";
    $res = mysql_query($sql);
    while($line = mysql_fetch_array($res,MYSQL_ASSOC))
    {
		if ($line['brendid']!='' && $line['brendid']!=0)
		{
			$sql1 = "SELECT * FROM $par->categorytable WHERE hide=0 AND id=$id";
			$res1 = mysql_query($sql1);
			if ($line1 = mysql_fetch_array($res1,MYSQL_ASSOC))
			{
				$return = GetSeoUrl($act,$line1['id'],$line1); 
			}			
			$url         = '?changebrend=1&brendid='.$line['brendid'];
            $checkurl = '';
            //if ($_REQUEST['changebrend'])
            $checkurl = $_SERVER['QUERY_STRING'];
//            if($checkurl=='')
//            {
//                $url = '?'.$url;
//            }
            if ($checkurl!='')
            {
//                $url = '?'.$url;
                if (isset($_REQUEST['changesize']) && isset($_REQUEST['size']))
                {
                    $changesize = $_REQUEST['changesize'];
                    $size       = $_REQUEST['size'];
                    $url = $url."&changesize=".$changesize."&size=".$size;
                }
            }
            //echo $url."<br>";

			$fname       = '';
			$brandid     = $line['brendid'];
			$sql2        = "SELECT * FROM $par->brandstable WHERE hide=0 AND id=$brandid ORDER BY prior DESC";
			$res2        = mysql_query($sql2);
			$brandline   = mysql_fetch_array($res2,MYSQL_ASSOC);
			//debug ($brandline);exit;
			$bid = $brandline['id'];

			if(is_file('fotos/brand_sm_'.$bid.'.jpg'))
			{
				$fname = 'fotos/brand_sm_'.$bid.'.jpg';
				//$fname="asd";
			}

			if($fname!='')
			{
				// $addstr = GetAddStr(200,150,$fname);
				$fname = '/'.$fname;
			}
			$brands[]      = Array('url' => $url, 'fname'=>$fname);

		}
        
    }
    $_logic['brands'] = $brands;

}

    if ($act=='none' || $act=="novinki")
    {
        //unset($_SESSION['currbrendmain']);
        $brands = Array();

        $sql = "SELECT DISTINCT(`brendid`) FROM $par->objectstable WHERE hide=0";
        $res = mysql_query($sql);
        while($line = mysql_fetch_array($res,MYSQL_ASSOC))
        {
            if ($line['brendid']!=0)
            {
                $url         = '?changebrendmain=1&currbrendmain='.$line['brendid'];
                $fname       = '';
                $brandid     = $line['brendid'];
                $sql2        = "SELECT * FROM $par->brandstable WHERE hide=0 AND id=$brandid  ORDER BY prior DESC";
                $res2        = mysql_query($sql2);
                $brandline   = mysql_fetch_array($res2,MYSQL_ASSOC);
                //debug ($brandline);exit;
                $bid = $brandline['id'];

                if(is_file('fotos/brand_sm_'.$bid.'.jpg'))
                {
                    $fname = 'fotos/brand_sm_'.$bid.'.jpg';
                    //$fname="asd";
                }

                if($fname!='')
                {
                    // $addstr = GetAddStr(200,150,$fname);
                    $fname = '/'.$fname;
                }
                $brands[]      = Array('url' => $url, 'fname'=>$fname);
            }


        }

        $_logic['brands'] = $brands;
    }

    //debug($brands);


?>