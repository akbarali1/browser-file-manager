<?php
/*
 * Fayl menjr Akbarali tomonidan yozildi.
 * Yozilgan sana: 15-mart 2021 yil
 * E-mail: Akbarali@uzhackersw.uz
 * Telegram: @kbarali
 * Those who want to sponsor: Webmoney WMR: R853215959425, Webmoney WMZ: Z401474330355, Webmoney WMY: Y194307290426
 * If you want to sponsor and do not have a Webmoney wallet, write to my e-mail or Telegram
 * Github repository: https://github.com/akbarali1/file-menjr
 * Johncms theme link: https://johncms.com/forum/?type=topic&id=12302
 * Johncms Profile Link: https://johncms.com/profile/?user=38217
 * Uzfor theme link: https://uzfor.uz/view.php?id=90892&page=1
 * Uzfor Profile link: https://uzfor.uz/profile.php?user=87
*/
require 'classes/yadro.php';
header('Content-type: application/json');
if (DEMO_VERSION === true) {
    echo json_encode(array('error'=> DEMO));
    die;
}
function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }
    if (!is_dir($dir)) {
        return unlink($dir);
    }
    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }
        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }
    }
    return rmdir($dir);
}
if (isset($_POST['fayl'])) {
    $fl = $_POST['fayl'];
    if (file_exists($fl)) {
        unlink($fl);
        echo json_encode(array('success' => 'success'));
    } else {
        echo json_encode(array('error' => 'Bunday fayl yo`q'));
    }
    die;
}
$folder = $_POST['folder'];
if (isset($folder)) {
    if (is_dir($folder)) {
        array_map('unlink', glob("$folder/*.*"));
        deleteDirectory($folder);
        echo json_encode(array('success' => 'success'));
    } else {
        echo json_encode(array('error' => 'Bunday nomda papka mavjud emas'));
    }
}
