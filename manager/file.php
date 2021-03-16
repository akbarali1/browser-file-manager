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
if (isset($_POST['faylyoli'])) {
    $faylyoli = $_POST['faylyoli'];
    $file = file_get_contents($faylyoli);
    $faylturi = pathinfo($faylyoli);
    if ($faylturi['extension'] == 'zip') {
        $falext = 'zip';
    } elseif ($faylturi['extension'] == 'ico') {
        $falext = 'ico';
    } elseif ($faylturi['extension'] == 'jpg') {
        $falext = 'jpg';
    } elseif ($faylturi['extension'] == 'png') {
        $falext = 'png';
    } elseif ($faylturi['extension'] == 'gif') {
        $falext = 'gif';
    }
    if (isset($falext)) {
        echo json_encode(array('boshqacha' => 'boshqacha', 'fayl_yoli' => $faylyoli));
        die;
    }
    if ($faylturi['extension'] == 'html') {
        $falext = 'html';
    } elseif ($faylturi['extension'] == 'css') {
        $falext = 'css';
    } elseif ($faylturi['extension'] == 'js') {
        $falext = 'javascript';
    } elseif ($faylturi['extension'] == 'json') {
        $falext = 'json';
    } elseif ($faylturi['extension'] == 'sass') {
        $falext = 'sass';
    } elseif ($faylturi['extension'] == 'xml') {
        $falext = 'xml';
    } elseif ($faylturi['extension'] == 'php') {
        $falext = 'php';
    } elseif ($faylturi['extension'] == 'phtml') {
        $falext = 'php';
    } else {
        $falext = 'text';
    }
    echo json_encode(array('file' => $file, 'fayl_yoli' => $faylyoli, 'faylturi' => $falext));
}
if (isset($_POST['save'])) {
    if (!empty($_POST['contents'])) {
    if (DEMO_VERSION === true) {
        echo json_encode(array('error' => DEMO));
        die;
    }
    $fayl_yoli = $_POST['fayl_yoli'];
    $contents = $_POST['contents'];
    @file_put_contents($fayl_yoli, $contents);
    echo json_encode(array('success' => 'success'));
    }else {
        echo json_encode(array('error' => 'Saqlash uchun fayl ochilmagan'));
}
}
if (isset($_POST['backup'])) {
    if (!empty($_POST['contents'])) {
        if (DEMO_VERSION === true) {
            echo json_encode(array('error' => DEMO));
            die;
        }
        $fayl_yoli = $_POST['fayl_yoli'];
        $faylturi = pathinfo($fayl_yoli);
        $contents = $_POST['contents'];
        $yangifayl = $faylturi['dirname'] . '/' . date("G-i-s_d-m-y") . '-' . $faylturi['filename'] . '.' . $faylturi['extension'];
        $fp = fopen($yangifayl, 'wb');
        fwrite($fp, $contents);
        fclose($fp);
        echo json_encode(array('success' => 'success'));
    }else {
        echo json_encode(array('error' => 'Saqlash uchun fayl ochilmagan'));
    }
}
