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

switch($_POST['action']){
    case 'open-file':
        if (isset($_POST['faylyoli'])) {
            $faylyoli = $_POST['faylyoli'];
            if (file_exists($faylyoli)) {
                $file = file_get_contents($faylyoli);
            } else {
                die(json_error('Bunday fayl yo`q'));
            }
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
                die(json_success('OK', ['data' => array('boshqacha' => 'boshqacha', 'fayl_yoli' => $faylyoli), ]));
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
            die(json_success('OK', ['data' => array('file' => $file, 'fayl_yoli' => $faylyoli, 'faylturi' => $falext), ]));
        }
    break;
}
//Demo versiyada ishlamaydigan narsalar
if (DEMO_VERSION === true) {
     die(json_error(DEMO_TEXT_ERROR));
}
switch ($_POST['action']) {
    case 'dellete-file':
        if (isset($_POST['fayl'])) {
            $fl = $_POST['fayl'];
            if (file_exists($fl)) {
                unlink($fl);
                die(json_success('OK'));
            } else {
                die(json_error('Bunday fayl yo`q'));
            }
        }
    break;
    case 'dellete-folder':
        if (isset($_POST['folder'])) {
            $folder = $_POST['folder'];
            if (is_dir($folder)) {
                array_map('unlink', glob("$folder/*.*"));
                deleteDirectory($folder);
                die(json_success('OK'));
            } else {
                die(json_error('Bunday nomda papka mavjud emas'));
            }
        }
    break;
    case 'rename-folder':
        if (isset($_POST['oldname'])) {
            $newname = $_POST['newname'];
            $oldname = $_POST['oldname'];
            if (is_dir($oldname)) {
                rename($oldname, $newname);
                die(json_success('OK'));
            } else {
                die(json_error('Bunday nomda papka mavjud emas'));
            }
        }
    break;
    case 'rename-file':
        $oldfilename = $_POST['oldfilename'];
        if (isset($oldfilename)) {
            if (file_exists($oldfilename)) {
                rename($oldfilename, $newname);
                die(json_success('OK'));
            } else {
                die(json_error('Bunday nomdagi fayl yo`q'));
            }
        }
    break;
    case 'new-file':
        if (isset($_POST['filename'])) {
            $filename = $_POST['filename'];
            $foldername = $_POST['foldername'];
            $faylyoli = $foldername . "/" . $filename;
            if (!file_exists($faylyoli)) {
                $fp = fopen($faylyoli, 'wb');
                fwrite($fp, "Akbarali");
                fclose($fp);
                $filetext = file_get_contents($faylyoli);
                die(json_success('OK', ['data' => array('fileopen' => $filetext, 'faylyoli' => $faylyoli) ]));
            } else {
                die(json_error('There is a file with this name'));
            }
        }
    break;
    case 'new-folder':
        if (isset($_POST['folder'])) {
            $foldernamenew = $_POST['folder'];
            $foldername = $_POST['foldername'];
            $papkayoli = $foldername . "/" . $foldernamenew;
            if (!is_dir($papkayoli)) {
                mkdir($papkayoli, 0755);
                die(json_success('The folder was created successfully'));
            } else {
                die(json_error('There is a folder with this name'));
            }
        }
    break;
    case 'backup':
        if (!empty($_POST['contents'])) {
            $fayl_yoli = $_POST['fayl_yoli'];
            $faylturi = pathinfo($fayl_yoli);
            $contents = $_POST['contents'];
            $yangifayl = $faylturi['dirname'] . '/' . date("G-i-s_d-m-y") . '-' . $faylturi['filename'] . '.' . $faylturi['extension'];
            $fp = fopen($yangifayl, 'wb');
            fwrite($fp, $contents);
            fclose($fp);
            die(json_success('OK'));
        } else {
            die(json_error('Saqlash uchun fayl ochilmagan'));
        }
    break;
    case 'save-file':
        if (!empty($_POST['contents'])) {
            $fayl_yoli = $_POST['fayl_yoli'];
            $contents = $_POST['contents'];
            file_put_contents($fayl_yoli, $contents);
            die(json_success('File saved successfully'));
        } else {
            die(json_error('Saqlash uchun fayl ochilmagan'));
        }
    break;
    case 'newpassword':
        if (!empty($_POST['newpassword'])) {
            echo passwordchange($_POST['newpassword']);
        }
        break;
}
