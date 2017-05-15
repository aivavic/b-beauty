<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$search = '<div class="page-caption">'; //��� �����

function scan_dir($dirname)
{

    GLOBAL $search, $replace, $log;

    $dir = opendir($dirname);

    while (($file = readdir($dir)) !== false) {

        if ($file != "." && $file != "..") {

            if (is_file($dirname . "/" . $file) && filesize($dirname . "/" . $file) < 1000000) {

                $content_original = file_get_contents($dirname . "/" . $file);

                $content_replaced = $content_original;


                if (strstr($content_original, $search)) {
                    if (is_writable($dirname . "/" . $file)) {
                        $handle = fopen($dirname . "/" . $file, "w");
                        fwrite($handle, $content_replaced);
                        fclose($handle);
                    }
                    $log[] = $dirname . "/" . $file;
                } else {

                }
            }
            if (is_dir($dirname . "/" . $file)) {
                scan_dir($dirname . "/" . $file);
            }
        }
    }

    closedir($dir);

}
?>

<div class="container">
    <?php
    scan_dir($_SERVER['DOCUMENT_ROOT']);
    if ($log) {
        echo '������ <b>' . htmlspecialchars($search) . '</b> ���� ������� � ��������� ������<br />';

        $i = 0;

        foreach ($log as $s) {
            $i++;
            echo '# ' . $i . ' -> ' . $s . '<br />';
        }
    } else {
        echo '������ �� ���� ������� �� � ����� �����<br />';
    }
    ?>
</div>
<!-- /.container -->