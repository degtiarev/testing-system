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
      <p><strong>Статус:</strong></p>
      <p>
	  <?php
include '../common/my.php';

$Myconnect = new ConnectToBD();

// $Myconnect->Connect("localhost", "root", "", "a9646121_1" );
$Myconnect->Connect("mysql4.000webhost.com", "a9646121_1", "1q1q1q", "a9646121_1");

session_start();
$username = $_SESSION['username'];
$query = mysql_query("SELECT * FROM user WHERE login='$username'");
$user_data = mysql_fetch_array($query);
$id_user = $user_data['id'];

$query = mysql_query("SELECT count(*) as totalanswers FROM results WHERE id_user='$id_user'");
$data = mysql_fetch_assoc($query);
$totalanswers = $data['totalanswers'];

$query = mysql_query("SELECT count(*) as totalRightAnswers FROM  questions, results WHERE id_user='$id_user' and questions.id=results.id_question and results.answer=questions.r_answer");
$data = mysql_fetch_assoc($query);
$totalRightAnswers = $data['totalRightAnswers'];

echo "Всего пользователь дал ответов: ", $totalanswers, "<br>\n";
echo "Из них правильных: ", $totalRightAnswers, "<br>\n";
?>
	  </p>
    </div>
 
  </div>
  
</body>

</html>
