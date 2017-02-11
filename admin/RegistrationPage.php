<html>
<head>
<meta charset="utf-8">
 <link rel="stylesheet" type="text/css" href="../style.css" />
<title>Регистрация</title>

</head>

<body>

<?php
include '../common/my.php';

session_start();
if ($_SESSION['adminname'] != null) header('Location: MyPage.php');

$admin = new admin();
$admin->ShowRegistration();
?>


</body>

</html>