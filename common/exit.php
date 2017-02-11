<?php
session_start();
if ($_SESSION['username'] == null) header('Location: ../index.php');
if ($_SESSION['adminname'] == null) header('Location: ../index.php');

session_start();
unset($_SESSION['username']);
unset($_SESSION['adminname']);
session_destroy();
header('Location: ../index.php');
?>