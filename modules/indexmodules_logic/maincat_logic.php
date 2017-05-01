<?
  $activecatid = 0;

  if($act=="cat") $activecatid = $id;
  
  if($act=="tovar")
  {
    $sql = "SELECT * FROM $par->objectstable WHERE id=$id";
    $res = mysql_query($sql);
    if($line = mysql_fetch_array($res,MYSQL_ASSOC)) $activecatid = $line['categid'];
  }
  
?>
        
<?
    $activearr = GetActiveArr('cat',$par->categorytable,$activecatid);
//    PrintDeepMenu('cat',$par->categorytable,0,3,1,$activearr);


    //$_logic['activearr'] = $activearr;
    $_logic['maincatarr'] = GetDeepMenuArr('cat',$par->categorytable,0,3,1,$activearr,true);
  //  debug($_logic['maincatarr']);exit;
    //Debug('<pre>'.print_r($a,true).'</pre>');
    //debug($activearr);exit;
?>