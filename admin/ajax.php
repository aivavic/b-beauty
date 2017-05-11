<?
@session_start();
error_reporting(E_ERROR);
if (!isset($_SESSION['logadmin']) || $_SESSION['logadmin'] != 1) {
    exit(0);
}
include_once "../classes.php";

//file_put_contents('11.txt',print_r($_REQUEST,true)."\n", FILE_APPEND); 

$act = $_REQUEST['act'];
$id = (int)$_REQUEST['id'];
if (isset($_REQUEST['fname']) && $_REQUEST['fname'] != '') $fname = "/" . $_REQUEST['fname'];
$folder = '';

if (isset($_REQUEST['json_gallerypics'])) $gallerypics = $_REQUEST['json_gallerypics'];

$table = $_REQUEST['table'];


////////////////////////////////////////////////////////////////////////////////////////////////////////	
function Utf8Win($str, $type = "w")
{
    if ($type == 'w') {
        for ($i = 0, $m = strlen($str); $i < $m; $i++) {
            $c = ord($str[$i]);
            if ($c <= 127) {
                $t .= chr($c);
                continue;
            }
            if ($c >= 192 && $c <= 207) {
                $t .= chr(208) . chr($c - 48);
                continue;
            }
            if ($c >= 208 && $c <= 239) {
                $t .= chr(208) . chr($c - 48);
                continue;
            }
            if ($c >= 240 && $c <= 255) {
                $t .= chr(209) . chr($c - 112);
                continue;
            }
            if ($c == 184) {
                $t .= chr(209) . chr(209);
                continue;
            };
            if ($c == 168) {
                $t .= chr(208) . chr(129);
                continue;
            };
            if ($c == 184) {
                $t .= chr(209) . chr(145);
                continue;
            }; #ё
            if ($c == 168) {
                $t .= chr(208) . chr(129);
                continue;
            }; #Ё
            if ($c == 179) {
                $t .= chr(209) . chr(150);
                continue;
            }; #і
            if ($c == 178) {
                $t .= chr(208) . chr(134);
                continue;
            }; #І
            if ($c == 191) {
                $t .= chr(209) . chr(151);
                continue;
            }; #ї
            if ($c == 175) {
                $t .= chr(208) . chr(135);
                continue;
            }; #ї
            if ($c == 186) {
                $t .= chr(209) . chr(148);
                continue;
            }; #є
            if ($c == 170) {
                $t .= chr(208) . chr(132);
                continue;
            }; #Є
            if ($c == 180) {
                $t .= chr(210) . chr(145);
                continue;
            }; #ґ
            if ($c == 165) {
                $t .= chr(210) . chr(144);
                continue;
            }; #Ґ
            if ($c == 184) {
                $t .= chr(209) . chr(145);
                continue;
            }; #Ґ
        }
        return $t;
    } else {
        $out = $c1 = '';
        $byte2 = false;
        for ($c = 0; $c < strlen($str); $c++) {
            $i = ord($str[$c]);
            if ($i <= 127) {
                $out .= $str[$c];
            }
            if ($byte2) {
                $new_c2 = ($c1 & 3) * 64 + ($i & 63);
                $new_c1 = ($c1 >> 2) & 5;
                $new_i = $new_c1 * 256 + $new_c2;
                if ($new_i == 1025) {
                    $out_i = 168;
                } else {
                    if ($new_i == 1105) {
                        $out_i = 184;
                    } else {
                        $out_i = $new_i - 848;
                    }
                }
// UKRAINIAN fix
                switch ($out_i) {
                    case 262:
                        $out_i = 179;
                        break;// і
                    case 182:
                        $out_i = 178;
                        break;// І
                    case 260:
                        $out_i = 186;
                        break;// є
                    case 180:
                        $out_i = 170;
                        break;// Є
                    case 263:
                        $out_i = 191;
                        break;// ї
                    case 183:
                        $out_i = 175;
                        break;// Ї
                    case 321:
                        $out_i = 180;
                        break;// ґ
                    case 320:
                        $out_i = 165;
                        break;// Ґ
                }
                $out .= chr($out_i);
                $byte2 = false;
            }
            if (($i >> 5) == 6) {
                $c1 = $i;
                $byte2 = true;
            }
        }
        return $out;
    }
}

////////////////////////////////////////////////////////////////////////////////////////////////////////	

if ($act == "showgal") {
    ?>
    <div class="items">
        <?
        $sql = "SELECT * FROM $table WHERE `hide`=0 AND `reportid`=$id ORDER BY `prior` ASC";
        $res = mysql_query($sql);
        while ($line = mysql_fetch_array($res, MYSQL_ASSOC)) {
            if ($line['hide'] == 0) $vpic = "on.gif"; else $vpic = "off.gif";

            $imgname = $fname . $line['id'] . '.jpg';
            if ('`' . $table . '`' == $par->fotorobjtable) $imgname = '/fotos/' . $line['filename'] . '_sm.jpg';
            echo '<div class="item" id="' . $line['id'] . '_' . $line['prior'] . '"><span class="controls"><input type="text" name="name" id="' . $line['id'] . '" value="' . $line['title'] . '"><span class="del" onclick="if(confirm(\'Удалить???\')) del(this,' . $line['id'] . ')"></span></span><div class="img"><img src="' . $imgname . '" alt="" /></div></div>';
            /*
                        echo '<div class="item" id="'.$line['id'].'_'.$line['prior'].'"><span class="tarea"><span class="del" onclick="$(this).parent().fadeOut();"></span><textarea name="name" rows="3" cols="100" id="'.$line['id'].'" >'.$line['title'].'</textarea></span><span class="controls"><span class="edit" onclick="$(\'.tearea\').hide();$(\'.tarea\',$(this).parent().parent()).show();"></span><span class="del" onclick="if(confirm(\'Действительно удалить???\')) del(this,'.$line['id'].')"></span></span><div class="img"><img src="/fotos/'.$fname.$line['id'].'.jpg" alt="" /></div>
                        </div>';
            */
        }
        ?>
        <script>
            var imgOrder = '';
            var titles = new Array();
            $(document).ready(function () {
                $(".items").sortable();
                imgFirst = $(".items").sortable('toArray').toString();
//	$(".items").disableSelection();
                busy = 0;
                $(".updategal").click(function (event, ui) {
                    if (busy == 1) return false;
                    busy = 1;
                    imgOrder = $(".items").sortable('toArray').toString();
                    i = 0;
                    $('.items input').each(function () {
                        titles[i] = $(this).val();
                        i++;
                    });
                    $.post(
                        "ajax.php", {
                            act: "updategal",
                            o: imgFirst,
                            c: imgOrder,
                            t: titles,
                            table: "<?= $table?>"
                        },
                        function (data) {
                            busy = 0;
                            if (data != '') alert(data);
                        }
                    );
                });
            });
        </script>
    </div>
    <?
}
if ($act == 'updategal') {
    $old = explode(',', $_POST['o']);
    $new = explode(',', $_POST['c']);
    $tit = $_POST['t'];
    foreach ($old as $key => $item) {
        $item = explode('_', $item);
        $item = $item[1];
        $n = explode('_', $new[$key]);
        $n = $n[0];
        $sql = "UPDATE $table SET `prior`=$item,`title`='" . $tit[$key] . "' WHERE `id`=" . $n;
//			$sql="UPDATE $table SET `prior`=$item,`title`='".Utf8Win($tit[$key],'u')."' WHERE `id`=".$n;
//			$sql="UPDATE $table SET `prior`=$item,`title`='' WHERE `id`=".$n;
        mysql_query($sql);
    }

    echo 'Сохранено';
}
if ($act == 'delgal') {
    $sql = "DELETE FROM $table WHERE `id`=$id";
    mysql_query($sql);

    foreach ($gallerypics AS $key2 => $value2) {
        $picprefix = $value2['picprefix'];
        $ext = $value2['ext'];
        $newname = $picprefix . $id . '.' . $ext;
        if (is_file($newname)) unlink($newname);
    }

    //if(is_file('../fotos'.$folder.'/fotor'.$id.'.jpg')) unlink('../fotos/fotor'.$id.'.jpg');
    //if(is_file('../fotos'.$folder.'/smfotor'.$id.'.jpg')) unlink('../fotos/smfotor'.$id.'.jpg');
}
?>