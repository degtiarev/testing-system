<html>
<head>
<meta charset="utf-8">
 <link rel="stylesheet" type="text/css" href="style.css" />
<title>Авторизация</title>
</head>

<body>

<?php
include 'common/my.php';

session_start();
if ($_SESSION['username'] != null) header('Location: user/MyPage.php');
else if ($_SESSION['adminname'] != null) header('Location: admin/MyPage.php');

$user = new user();
$user->ShowAuthorize();
?>

<p><a href="admin/AuthorizationPage.php">Вход для администраторов</a></p>

</body>

</html>