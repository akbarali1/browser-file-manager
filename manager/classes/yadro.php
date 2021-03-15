<?php
define('V', '0.2');
define('PASSWORD', '46b5639b77d20cec83527b46611b1758');
//46b5639b77d20cec83527b46611b1758
//7b00f8fc9bd0b49025a4c5e09b8ebed3 johncms
 ob_start();
 session_start();
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
