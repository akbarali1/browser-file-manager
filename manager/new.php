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

if (isset($_POST['fayladd'])) {
$fayladd = $_POST['fayladd'];
$foldername = $_POST['foldername'];
$faylyoli = $foldername."/".$fayladd;

if (!file_exists($faylyoli)) {
    $fp = fopen($faylyoli, 'wb');
    fwrite($fp,"Akbarali");
    fclose($fp);
    $filetext = file_get_contents($faylyoli);
    echo json_encode(array('success' => $filetext, 'faylyoli' => $faylyoli));
  }else{
    echo json_encode(array('error'=> 'There is a file with this name'));
  }
  }

if (isset($_POST['folder'])) {
  $foldernamenew = $_POST['folder'];
  $foldername = $_POST['foldername'];
  $papkayoli =$foldername."/".$foldernamenew;

if(!is_dir($papkayoli)){
			mkdir($papkayoli, 0755);
    echo json_encode(array('success' => 'The folder was created successfully'));
		}else {
    echo json_encode(array('error' => 'There is a folder with this name'));
    }
}