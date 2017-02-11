<?php
include '../common/my.php';

session_start();
$Myconnect1 = new ConnectToBD();

// $Myconnect->Connect("localhost", "root", "", "a9646121_1" );
$Myconnect1->Connect("mysql4.000webhost.com", "a9646121_1", "1q1q1q", "a9646121_1");

$name = $_SESSION['username'];

//echo $name;
$query = mysql_query("SELECT * FROM user WHERE login='$name'");
$user_data = mysql_fetch_array($query);
$idadmin = $user_data['id_admin'];
$iduser = $user_data['id'];

//echo $idadmin;

$query = mysql_query("SELECT * FROM admin WHERE id='$idadmin'");
$user_data = mysql_fetch_array($query);
$adminname = $user_data['login'];

$f = fopen("../common/question" . $adminname . ".txt", "r");

// Читать строку их текстового файла и записать содержимое клиенту
$question = fgets($f);
fclose($f);

$query = mysql_query("SELECT * FROM results WHERE id_user='$iduser' and id_question='$question'");
$user_data = mysql_fetch_array($query);
$answer = $user_data['answer'];
echo $answer;

if (!empty($answer)) {
    echo ('Вы уже отвечали на этот вопрос!');
    header('Location: MyPage.php');
}
if (!file_exists("../common/seconds" . $adminname . ".txt")) header('Location: MyPage.php');
?>
<html>
<head>
<meta charset="utf-8">
 <link rel="stylesheet" type="text/css" href="../style.css" />
<title>Страница пользователя</title>

</head>

<body class="cbody">

	<div id="container">
	<div id="header">
<div align=left>
<?php
session_start();
if ($_SESSION['username'] == null) header('Location: ../index.php');
echo $_SESSION['username'] . ', добро пожаловать на свою личную страничку.';
?>

</div>
	<div align=right><a href="../common/exit.php" >Выйти</a></div>
	
	</div>
	<div id="sidebar1">
	<p><a href="MyPage.php">Моя страница</a></p>
	<p><a href="AnswerPage.php">Начать тест</a></p>
	</div>
	
	<div id="mainContent">
      <p><strong>Ответы:</strong></p>
      <p>
	  <?php

if (isset($_POST['submit'])) {
    $answer1 = $_POST['answer'];
    
    $answer = new Answer();
    $answer->MakeAnswer($answer1);
    
    header('Location: MyPage.php');
} else {
    
    $answer = new Answer();
    $answer->ShowToAnswer();
}
?>
	  </p>
    </div>
 
  </div>
  
</body>

</html>
