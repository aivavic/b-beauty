<?
	if(isset($_REQUEST['id'])) $id = (int)$_REQUEST['id'];
	else exit();
	
	include "../classes.php";
	
	require_once $par->document_root.'/utils/phpexcel/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");

							 
$orderarr = GetOrderInfo($id);

$currrow = 1;

$objPHPExcel->setActiveSheetIndex(0);

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);

$currrow = 0;

$currrow++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,$currrow, '(ID) Заказа');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,$currrow, $orderarr['orderid']);

$currrow++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,$currrow, 'Дата');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,$currrow, date("d.m.Y h:i",$orderarr['date']));

$currrow++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,$currrow, 'Сумма');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,$currrow, $orderarr['allsum']);

$currrow++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,$currrow, 'Статус заказа');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,$currrow, GetStatusName($orderarr['orderstatus']));

$currrow++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,$currrow, 'Пользователь (ID)');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,$currrow, $orderarr['userid']);

$currrow++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,$currrow, 'Пользователь');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,$currrow, $orderarr['name']);

$currrow++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,$currrow, 'Email');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,$currrow, $orderarr['email']);

$currrow++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,$currrow, 'Телефон');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,$currrow, $orderarr['phone']);

$currrow++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,$currrow, 'Адрес');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,$currrow, $orderarr['address']);


$objPHPExcel->getActiveSheet()->getStyle('A1:A9')->applyFromArray( Array('font'=>Array('bold'=>true) ) );

//        $orderarr['text'] = $line['text'];


$currrow++;

$currrow++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,$currrow, 'Товары:');

$currrow++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,$currrow, '(ID)');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,$currrow, 'Арт');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,$currrow, 'Товар');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,$currrow, 'Цена');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,$currrow, 'К-во');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5,$currrow, 'Сумма');

foreach($orderarr['products'] AS $key=>$oneproduct)
{
	$currrow++;
	if(isset($oneproduct['isdeleted']))
	{
	    $oneproduct['id'] = ' ';
	    $oneproduct['artikul'] = ' ';
	    $oneproduct['fname'] = '';
	    $oneproduct['url'] = '';
	    $oneproduct['title'] = 'Товар удален из базы';				
	    $oneproduct['id'] = '';
	}
	
	$resprice = $oneproduct['_order_value'] * $oneproduct['_order_price'];
	
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,$currrow, $oneproduct['id']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,$currrow, $oneproduct['artikul']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,$currrow, $oneproduct['title']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,$currrow, $oneproduct['_order_price']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,$currrow, $oneproduct['_order_value']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5,$currrow, $resprice);
	
}




// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="01simple.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

///

	function XLSHeader($filename)
	{
		header('Content-Type: text/html; charset=windows-1251');
		header('P3P: CP="NOI ADM DEV PSAi COM NAV OUR OTRo STP IND DEM"');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Cache-Control: post-check=0, pre-check=0', FALSE);
		header('Pragma: no-cache');
		header('Content-transfer-encoding: binary');
		header('Content-Disposition: attachment; filename='.$filename.'.xls');
		header('Content-Type: application/x-unknown');
	}


	@session_start();
	if(!isset($_SESSION['logadmin'])) exit();
	
	if(isset($_REQUEST['id'])) $id = (int)$_REQUEST['id']; else $id=0;
	
	include "../classes.php";
	
	$resarr = Array();
	$resarrc = 0;
	
	$widtharr = Array(400,50,50);
	
	function generateHTML($ar)
	{
		global $widtharr;

		$s = '<table>';
		for($i=0;$i<=100;$i++)
		{
			$s.='<tr>';
			for($j=0;$j<=100;$j++)
			{
				if(isset($ar[$i][$j])) $s.='<td width="'.$widtharr[$j].'">'.$ar[$i][$j].'</td>';
				else $s.='<td></td>';
			}
			$s.='</tr>';
		}
		$s.='</table>';
		return $s;
	}
	
	
	function AddXlsOrderLine($title,$num,$price,$sum)
	{
		global $resarr,$resarrc;
		
		$resarr[$resarrc][0] = $title;
		$resarr[$resarrc][1] = $num;
		$resarr[$resarrc][2] = $price;
		$resarr[$resarrc][4] = $sum;
		$resarrc++;
	}

	$sql = "SELECT * FROM $par->orderstable WHERE id=$id";
	$res = mysql_query($sql);
	if($orderline = mysql_fetch_array($res,MYSQL_ASSOC))
	{
		$resarr[0][0] = 'Дата: '.date("d.m.Y H:i",$orderline['date']);
		$resarr[1][0] = $orderline['name'];
		$resarr[2][0] = $orderline['email'];
		$resarr[3][0] = 'Тел. '.$orderline['phone'];
		$resarr[4][0] = $orderline['address'];
		$resarr[5][0] = ' ';
		
		$resarr[7][0] = 'Товар';
		$resarr[7][1] = 'Кол-во';
		$resarr[7][2] = 'Цена';
		$resarr[7][3] = 'Сумма';
		$resarrc = 8;

		$orderstr = $orderline['orderstr'];
		$sum = 0;
		
		$a1 = explode(':',$orderstr);
		for($i=1;$i<count($a1)-1;$i++)
		{
			$a2 = explode(';',$a1[$i]);
			$tid = $a2[0]; $num = $a2[1];
			
//			echo "T=$tid N=$num<BR>";
			
			$sql1 = "SELECT * FROM $par->objectstable WHERE id=$tid";
			$res1 = mysql_query($sql1);
			if($line1 = mysql_fetch_array($res1,MYSQL_ASSOC))
			{
				$sum1 = (int)$num * (int)$line1['price'];
				$sum+=$sum1;
				AddXlsOrderLine($line1['title'],$num,$line1['price'],$sum1);
			}
		}
		
		$resarr[$resarrc++][3] = $sum;
		
	}

	//print_r($resarr);

	$s = generateHTML($resarr);
	
	//XLSHeader("testfile");
	echo $s;	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		
?>