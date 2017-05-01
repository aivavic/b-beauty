<?
//debug($activearr);
//echo $activecat;exit;
$bread = array();

$sql = "SELECT * FROM $par->categorytable WHERE hide=0 ORDER BY prior";
$res = mysql_query($sql);
while($line = mysql_fetch_array($res,MYSQL_ASSOC))
{
    foreach ($activearr AS $key=>$val)
    {
        if ($line['id'] == $val)
        {
            $url = GetSeoUrl('cat',$line['id'],$line);
            $a = $line['title'];
            $b = strtolower($a);
           // echo $b;exit;
            $bread[]= array('url'=>$url,'title'=>$line['title']);
        }

    }

}
if ($act == 'tovar')
{
    $sql = "SELECT * FROM $par->objectstable WHERE id=$id AND hide=0";
    $res = mysql_query($sql);
    if($tovarline = mysql_fetch_array($res,MYSQL_ASSOC))
    {
        $productinfo = LangProcess(GetProductInfo($tovarline['id'],$tovarline,Array('allfotos'=>true)));
        //debug($productinfo);exit;
        $bread[] = array('url'=>$productinfo['url'], 'title'=>$productinfo['title']);
    }
}
$_logic['bread'] = $bread;
?>