<?php
include '../common/my.php';

session_start();
if ($_SESSION['adminname'] != null) header('Location: MyPage.php');

$admin = new admin();
$admin->Authorize();
?>
