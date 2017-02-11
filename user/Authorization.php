<?php
include '../common/my.php';

session_start();
if ($_SESSION['username'] != null) header('Location: MyPage.php');

$user = new user();
$user->Authorize();
?>