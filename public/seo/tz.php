<?




// Редиректим по домену
//==================================================================================================
if ($_SERVER['HTTP_HOST']=='bebeauty.km.ua'){
$rurl=$_SERVER['REQUEST_URI'];
$nhost = 'b-beauty.com.ua';
if (empty($_POST)){
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: http://".$nhost.$rurl);
    exit();
  }
}
//==================================================================================================






// Делаем редиректы на страницы брендов
//==================================================================================================
$rurl=$_SERVER['REQUEST_URI'];

if (isset($_GET['changebrendmain']) && isset($_GET['currbrendmain']) && !isset($_GET['zozo']) ){
  $b1 = intval($_GET['changebrendmain']);
  $b2 = intval($_GET['currbrendmain']);
  if ((strpos($rurl,'/?changebrendmain=')!==false) && (strpos($rurl,'/?changebrendmain=')==0)){
      header("HTTP/1.1 301 Moved Permanently");
      header("Location: /brand-".$b1."/brand-".$b2);
      exit();
    }
}
//==================================================================================================


?>
