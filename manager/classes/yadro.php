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
define('V', '2 | Akbarali');
define('DEMO_VERSION', false);
define('PASSWORD', '7b00f8fc9bd0b49025a4c5e09b8ebed3');
define('DEMO_TEXT_ERROR', 'This action cannot be performed in the demo version');
define('MAIN_DIR', '..');
define('ACCESS_IP', '');
//7b00f8fc9bd0b49025a4c5e09b8ebed3 johncms

function getClientIP()
{
    if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
        return  $_SERVER["HTTP_X_FORWARDED_FOR"];
    } else if (array_key_exists('REMOTE_ADDR', $_SERVER)) {
        return $_SERVER["REMOTE_ADDR"];
    } else if (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) {
        return $_SERVER["HTTP_CLIENT_IP"];
    }
    return '';
}

if (empty(ACCESS_IP) === false && ACCESS_IP != getClientIP()) {
    die('Your IP address is not allowed to access this page.');
}

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

function json_error($message, $params = [])
{
    return json_encode(array_merge([
        'error' => true,
        'message' => $message,
    ], $params), JSON_UNESCAPED_UNICODE);
}

function json_success($message, $params = [])
{
    return json_encode(array_merge([
        'success' => true,
        'message' => $message,
    ], $params), JSON_UNESCAPED_UNICODE);
}

function deleteDirectory($dir)
{
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

function passwordchange($password)
{
    if (isset($password) && empty($password) === false) {
        $contents = file(__FILE__);
        foreach ($contents as $key => $line) {
            if (strpos($line, 'define(\'PASSWORD\'') !== false) {
                $contents[$key] = "define('PASSWORD', '" . md5(md5($password)) . "');\n";
                break;
            }
        }
        if (is_writable(__FILE__) === false) {
            die(json_error('File is not writable'));
        }
        file_put_contents(__FILE__, implode($contents));
        return json_success('Password changed successfully');
    }
}
