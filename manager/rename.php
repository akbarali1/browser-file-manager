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
if (DEMO_VERSION === true) {
    echo json_encode(array('error' => DEMO));
    die;
}
$newname = $_POST['newname'];
if (isset($_POST['oldname'])) {
    $oldname = $_POST['oldname'];
    if (is_dir($oldname)) {
        rename($oldname, $newname);
        echo json_encode(array('success' => 'success'));
    } else {
        echo json_encode(array('error' => 'Bunday nomdagi papka yo`q'));
    }
    die;
}
$oldfilename = $_POST['oldfilename'];
if (isset($oldfilename)) {
    if (file_exists($oldfilename)) {
        rename($oldfilename, $newname);
        echo json_encode(array('success' => 'success'));
    } else {
        echo json_encode(array('error' => 'Bunday nomdagi fayl yo`q'));
    }
}
?>
