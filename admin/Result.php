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
      <p><strong>Результат</strong></p>
      <p>
      <?php
include '../common/my.php';

if (isset($_POST['submit'])) {
    $number = $_POST['number'];
    echo 'Вывод результатов на вопрос номер ' . $number;
    session_start();
    $currentadmin = $_SESSION['adminname'];
    
    $Myconnect = new ConnectToBD();
    $Myconnect->Connect("mysql4.000webhost.com", "a9646121_1", "1q1q1q", "a9646121_1");
    
    // $Myconnect->Connect("localhost", "root", "", "a9646121_1" );
    
    $query = mysql_query("SELECT * FROM admin WHERE login='$currentadmin'");
    $user_data = mysql_fetch_array($query);
    
    $currentidadm = $user_data['id'];
    
    $query = mysql_query("SELECT * FROM questions WHERE id_admin='$currentidadm'");
    $user_data = mysql_fetch_array($query);
    
    $r_answer = $user_data['r_answer'];
    $questtext = $user_data['question'];
    $idadm = $user_data['id_admin'];
    
    if ($idadm == $currentidadm && !empty($questtext)) {
        
        // сколько человек должный были ответить
        $query = mysql_query("SELECT count(*) as totalStudShouldAnswer FROM user WHERE id_admin='$idadm'");
        $user_data = mysql_fetch_array($query);
        $totalStudShouldAnswer = $user_data['totalStudShouldAnswer'];
        
        // сколько человек ответили
        $query = mysql_query("SELECT count(*) as totalStudanswered FROM user, results WHERE id_admin='$idadm' and user.id=results.id_user and results.id_question='$number'");
        $user_data = mysql_fetch_array($query);
        $totalStudanswered = $user_data['totalStudanswered'];
        
        //сколько человек правильно ответили
        $query = mysql_query("SELECT count(*) as totalRightStudanswered FROM user, results WHERE id_admin='$idadm' and user.id=results.id_user and results.id_question='$number' and results.answer='$r_answer'");
        $user_data = mysql_fetch_array($query);
        $totalRightStudanswered = $user_data['totalRightStudanswered'];
        
        // неправильно ответили
        $query = mysql_query("SELECT count(*) as wrongAnswered FROM user, results WHERE id_admin='$idadm' and user.id=results.id_user and results.id_question='$number' and results.answer<>'$r_answer' and results.answer IS NOT NULL");
        $user_data = mysql_fetch_array($query);
        $wrongAnswered = $user_data['wrongAnswered'];
        
        $notAnswered = $totalStudShouldAnswer - $totalStudanswered;
        $rightAnswered = $totalRightStudanswered;
        
        // echo $wrongAnswered;
        // echo '<br>';
        // echo $notAnswered;
        // echo '<br>';
        // echo $rightAnswered;
        
        if ($notAnswered > 100 || $wrongAnswered > 100 || $rightAnswered > 100) while ($notAnswered < 100 && $wrongAnswered < 100 && $rightAnswered < 100):
            $notAnswered = $notAnswered / 2;
            $wrongAnswered = $wrongAnswered / 2;
            $rightAnswered = $rightAnswered / 2;
        endwhile;
        
        // Значения столбцов от 0 до 100
        $rows = array($notAnswered, $wrongAnswered, $rightAnswered);
        
        // Нормируем значения массива $rows
        // таким образом, чтобы их сумма
        // составляла 360 градусов
        $summ = array_sum($rows);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i] = intval($rows[$i] * 360 / $summ);
        }
        
        // Создаем пустое изображение,
        // размером 201x201 пикселей
        $img = imagecreatetruecolor(201, 201);
        
        // Определение белого цвет на изображении
        $white = imagecolorallocate($img, 255, 255, 255);
        imagefill($img, 0, 0, $white);
        
        // Переменные $cy и $cy определяют
        // центр круговой диаграммы
        $cx = $cy = 100;
        
        // Переменные $w и $h определяют
        // ширину и высоту диаграммы
        $w = $h = 200;
        
        $iterator = 0;
        $start = 0;
        foreach ($rows as $value) {
            $color = imagecolorallocate($img, rand(0, 255), rand(0, 255), rand(0, 255));
            
            if ($iterator == 0) $color1 = $color;
            if ($iterator == 1) $color2 = $color;
            if ($iterator == 2) $color3 = $color;
            
            $iterator++;
            
            // Формируем случайный цвет
            // для каждого сектора
            
            // Определяем конечный угол сектора
            $angle_sector = $start + $value;
            
            // Отрисовываем сектор
            imagefilledarc($img, $cx, $cy, $w, $h, $start, $angle_sector, $color, "IMG_ARC_PIE || IMG_ARC_EDGED");
            
            // Увеличиваем значение начального угла сектора
            $start+= $value;
        }
        
        // Вывод изображения в окно браузера
        
        imagegif($img, 'result.gif');
        
        $im = imagecreatetruecolor(30, 30);
        
        // Закрашенный прямоугольник
        imagefilledrectangle($im, 0, 0, 30, 30, $color1);
        imagepng($im, 'color1.png');
        imagedestroy($im);
        
        $im = imagecreatetruecolor(30, 30);
        
        // Закрашенный прямоугольник
        imagefilledrectangle($im, 0, 0, 30, 30, $color2);
        imagepng($im, 'color2.png');
        imagedestroy($im);
        
        $im = imagecreatetruecolor(30, 30);
        
        // Закрашенный прямоугольник
        imagefilledrectangle($im, 0, 0, 30, 30, $color3);
        imagepng($im, 'color3.png');
        imagedestroy($im);
        
        echo ('<p><img src="result.gif" alt="result"></p>
                        <p><img src="color1.png" alt="result"> - не ответили</p>
                        <p><img src="color2.png" alt="result"> - неправильно ответили</p>
                        <p><img src="color3.png" alt="result"> - правильно ответили</p>');
        
        // unlink('result.gif');
        // unlink('color1.png');
        // unlink('color2.png');
        // unlink('color3.png');
        
        
    } else echo ('<br>Данный вопрос не найден в базе данных.');
} else {
    echo "<form action='Result.php' method='post'>
                    <table>
                    <tr>
                    <td>Номер вопроса: </td><td><input type='text' name='number' /><br></td>
                    </tr>
                    </table>
                    <center><input type='submit' value='Показать' name='submit' /></center>
                    </form>";
}
?>




      </p>
    </div>
 
  </div>
  
</body>

</html>