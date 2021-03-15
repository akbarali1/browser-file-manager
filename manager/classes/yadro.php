<?php
define('V', '0.2');
 ob_start();
 session_start();

if (empty($_SESSION['loginmanager'])) {
    if (!$loginpage) {
        header('Location: ./login.php');
        exit;
    }
}