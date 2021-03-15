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
ob_start();
session_start();
define('V', '0.5 | Akbarali');
define('DEMO_VERSION', false);
define('PASSWORD', '7b00f8fc9bd0b49025a4c5e09b8ebed3');
define('DEMO', 'This action cannot be performed in the demo version');

//46b5639b77d20cec83527b46611b1758
//7b00f8fc9bd0b49025a4c5e09b8ebed3 johncms

if (empty($_SESSION['loginmanager'])) {
    if (!$loginpage) {
        header('Location: ./login.php');
        exit;
    }
}
if (isset($_SESSION['loginmanager'])) {
if ($_SESSION['loginmanager'] != PASSWORD) {
    if (!$loginpage) {
        header('Location: ./login.php');
        exit;
    }
}
}
