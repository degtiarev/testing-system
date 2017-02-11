<?php
include '../common/my.php';

session_start();
if ($_SESSION['adminname'] == null) header('Location: ../index.php');

$Question = new Question();
$Question->Add();

header('Location: AdditionPage.php');
?>
