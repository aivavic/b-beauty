<?
if($act=="none" || $act=="novinki")
{
    $newprod = Array();
    $objectsinpage = $varsline['objectsinpage'];
    $addlinkstr = '';
    $startmode = 0;
    //debug($_SESSION['currbrendmain']);
    if (isset($_SESSION['currbrendmain'])) $addsql = " AND `brendid`=".(int)$_SESSION['currbrendmain']; else $addsql = '';

    $sql = "SELECT * FROM $par->objectstable WHERE  hide=0 $addsql ORDER BY spec1 DESC, prior DESC LIMIT $start,$objectsinpage";
    $sql2 = "SELECT COUNT(id) AS ccc FROM $par->objectstable WHERE hide=0 $addsql";
    $linkstr = '/novinki';

    $products = Array();
    $res = mysql_query($sql);
    while($line = mysql_fetch_array($res,MYSQL_ASSOC))
    {
        $products[] = LangProcess(GetProductInfo($line['id'],$line));
    }
    //debug($products);exit;

//    $sql3 = "SELECT * FROM $par->objectstable WHERE spec1=1 AND hide=0 ORDER BY prior LIMIT $start,$objectsinpage";
//    $res3 = mysql_query($sql3);
//    while($line3 = mysql_fetch_array($res3,MYSQL_ASSOC))
//    {
//        $products[] = LangProcess(GetProductInfo($line3['id'],$line3));
//    }


    $newprod['objectsinpage']=$objectsinpage;
    $newprod['products']=$products;
    $newprod['pagerarr']=GetPager($sql2,$linkstr,$objectsinpage,$addlinkstr,$startmode);
    $_logic['newprod'] = $newprod;
    //unset($_SESSION['currbrendmain']);
}
?>
