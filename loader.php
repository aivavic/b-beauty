<?
if (isset($_GET['changebrendmain']) && isset($_GET['currbrendmain'])){
  $b1 = intval($_GET['changebrendmain']);
  $b2 = intval($_GET['currbrendmain']);
  
  echo file_get_contents('http://'.$_SERVER['HTTP_HOST'].'/?changebrendmain='.$b1.'&currbrendmain='.$b2.'&zozo=1');
  exit;
}
?>
