<html>
<head>
<meta charset="utf-8">
 <link rel="stylesheet" type="text/css" href="../style.css" />
 
<title>Администратор</title>

</head>

<body class="cbody">

	<div id="container">
	<div id="header">
<div align=left>
<?php
session_start();
if ($_SESSION['adminname'] == null) header('Location: ../index.php');
echo $_SESSION['adminname'] . ', добро пожаловать на свою личную страничку.';
?>
</div>
	<div align=right><a href="../common/exit.php" >Выйти</a></div>
	
	</div>
	<div id="sidebar1">
	<p><a href="MyPage.php">Моя страница</a></p>
	<p><a href="SeeAllQuestions.php">Просмотреть вопросы</a></p>
	<p><a href="SeeAllUsers.php">Просмотреть студентов</a></p>
	<p><a href="AdditionPage.php">Добавить вопросы</a></p>
	<p><a href="AddUser.php">Добавить студентов</a></p>
	<p><a href="DeleteQuestion.php">Удалить вопросы</a></p>
	<p><a href="Timer.php">Начать тестирование</a></p>
	<p><a href="Result.php">Просмотреть результат</a></p>
	</div>
	
	<div id="mainContent">
      <p><strong>Просмотр вопросов</strong></p>
      <p>
	  <?php
include '../common/my.php';
$Question = new Question();
$Question->ShowAll();
?>
	  </p>
    </div>
 
  </div>
  
</body>

</html>