<?php
include 'Connect.php';

class User
{
    
    private $name;
    private $password;
    private $email;
    
    public function Authorize() {
        $Myconnect = new ConnectToBD();
        
        // $Myconnect->Connect("localhost", "root", "", "a9646121_1" );
        $Myconnect->Connect("mysql4.000webhost.com", "a9646121_1", "1q1q1q", "a9646121_1");
        if (isset($_POST['submit'])) {
            
            $name = $_POST['name'];
            $password = $_POST['password'];
            $query = mysql_query("SELECT * FROM user WHERE login='$name'");
            $user_data = mysql_fetch_array($query);
            
            if ($user_data['password'] == $password) {
                echo "OK";
                session_start();
                $_SESSION['username'] = $name;
                header('Location: ../user/MyPage.php');
            } else {
                echo "Error";
                header('Location: index.php');
            }
        }
    }
    public function Registration() {
        $Myconnect = new ConnectToBD();
        $Myconnect->Connect("mysql4.000webhost.com", "a9646121_1", "1q1q1q", "a9646121_1");
        
        // $Myconnect->Connect("localhost", "root", "", "a9646121_1" );
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            
            session_start();
            $adminname = $_SESSION['adminname'];
            $query = mysql_query("SELECT * FROM admin WHERE login='$adminname'");
            $user_data = mysql_fetch_array($query);
            $id_admin = $user_data['id'];
            
            $query = mysql_query("INSERT INTO user (login, password, email, id_admin) VALUES ('$name', '$password', '$email', '$id_admin')") or die(mysql_error());
        }
    }
    
    public function ShowAuthorize() {
        echo "<form action='../user/Authorization.php' method='post'>
                    <table>
                    <tr>
                    <td>Логин: </td><td><input type='text' name='name' /><br></td>
                    </tr>
                    <tr>
                    <td>Пароль:</td><td><input type='password' name='password' /><br></td>
                    </tr>
                    </table>
                    <center><input type='submit' value='Войти' name='submit' /></center>
                    </form>";
    }
    
    public function ShowRegistration() {
        echo "<form action='../admin/UserRegistration.php' method='post'> 
                    <table>
                    <tr>
                    <td>Логин:</td><td><input type='text' name='name' /> <br></td>
                    </tr>
                    <tr>
                    <td>Пароль:</td><td><input type='password' name='password' /><br></td>
                    <tr>
                    <td>Email:</td><td><input type='email' name='email' /><br></td>
                    </tr>
                    </table>
                    <center> <input type='submit' value='Зарегистрироваться' name='submit' /></center>
                    </form>";
    }
    
    public function ShowAll() {
        
        $Myconnect = new ConnectToBD();
        
        // $Myconnect->Connect("localhost", "root", "", "a9646121_1" );
        $Myconnect->Connect("mysql4.000webhost.com", "a9646121_1", "1q1q1q", "a9646121_1");
        
        session_start();
        $adminname = $_SESSION['adminname'];
        $query = mysql_query("SELECT * FROM admin WHERE login='$adminname'");
        $user_data = mysql_fetch_array($query);
        $id_admin = $user_data['id'];
        
        $query = mysql_query("SELECT * FROM user WHERE id_admin='$id_admin'");
        
        while ($row = mysql_fetch_array($query)) {
            echo "Login: " . $row['login'] . "<br>\n";
            echo "Пароль: " . $row['password'] . "<br>\n";
            echo "Email: " . $row['email'] . "<br><hr>\n";
        }
    }
}

class admin
{
    
    private $name;
    private $password;
    private $email;
    
    public function Authorize() {
        $Myconnect = new ConnectToBD();
        
        // $Myconnect->Connect("localhost", "root", "", "a9646121_1" );
        $Myconnect->Connect("mysql4.000webhost.com", "a9646121_1", "1q1q1q", "a9646121_1");
        if (isset($_POST['submit'])) {
            
            $name = $_POST['name'];
            $password = md5($_POST['password']);
            $query = mysql_query("SELECT * FROM admin WHERE login='$name'");
            $user_data = mysql_fetch_array($query);
            echo $user_data['password'];
            
            if ($user_data['password'] == $password &&  empty($user_data['check1']) ) {
                echo "OK";
                session_start();
                $_SESSION['adminname'] = $name;
                header('Location: MyPage.php');
            } else {
                echo "Error";
                header('Location: AuthorizationPage.php');
            }
        }
    }
    public function Registration() {
        $Myconnect = new ConnectToBD();
        $Myconnect->Connect("mysql4.000webhost.com", "a9646121_1", "1q1q1q", "a9646121_1");
        
        // $Myconnect->Connect("localhost", "root", "", "a9646121_1" );
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $password = md5($_POST['password']);
            $email = $_POST['email'];
            $key =md5($_POST['name']);
            
            $query = mysql_query("INSERT INTO admin (login, password, email, check1) VALUES ('$name', '$password', '$email', '$key')") or die(mysql_error());


            // trim() - убираем все лишние пробелы и переносы строк, 
            // htmlspecialchars() - преобразует специальные символы в HTML сущности
            // substr($_POST['title'], 0, 1000) - урезаем текст до 1000 символов.
            // Для переменной $_POST['mess'] все аналогично 

            $title1='Подтвердение регистрации администратора на сайте delexa.site90.com';
            $mess1='
        <html>
        <head>
         <title>Подтверждение регистрации</title>
        </head>
        <body>
        Сообщение сформировано роботом, пожадуйста не отвечайте. 
        Для завершения регистрации пожалуйста перейдите по ссылке ниже
        <p><a href="delexa.site90.com/admin/SubmitRegistration.php?name='.$name.'&check1='.$key.'">Подтвердить</a></p>
        </body>
        </html>';

          //  'Сообщение сформировано роботом, пожадуйста не отвечайте. 
        //Для завершения регистрации пожалуйста перейдите по ссылке ниже
        //delexa.site90.com/admin/SubmitRegistration.php?name='.$name.'&check1='.$key;

            $title = substr(htmlspecialchars(trim($title1)), 0, 1000); 
            $mess = $mess1;// substr(htmlspecialchars(trim($mess1)), 0, 1000000); 
            // $to - кому отправляем 
            $to = $email; 
            // $from - от кого 
            $from='delexa@site90.com'; 
            // функция, которая отправляет наше письмо. 
            mail($to, $title, $mess, "Content-type: text/html; \r\n".'From:'.$from); 
            echo 'Спасибо! Ваше письмо отправлено.'; 
        }

    }
    
    public function ShowAuthorize() {
        echo "<form action='../admin/Authorization.php' method='post'>
                    <table>
                    <tr>
                    <td>Логин: </td><td><input type='text' name='name' /><br></td>
                    </tr>
                    <tr>
                    <td>Пароль:</td><td><input type='password' name='password' /><br></td>
                    </tr>
                    </table>
                    <center><input type='submit' value='Войти' name='submit' /></center>
                    </form>";
    }
    
    public function ShowRegistration() {
                    session_start();
                    $first =$_SESSION['name'];
                    $second=$_SESSION['email'];

                    echo "<form action='../admin/Registration.php' method='post'> 
                    <table>
                    <tr>
                    <td>Логин:</td><td><input type='text' name='name' value='$first' /> <br></td>
                    </tr>
                    <tr>
                    <td>Пароль:</td><td><input type='password'  name='password' /><br></td>
                    </tr>
                    <tr>
                    <td>Подтверждение пароля: </td><td><input type='password' name='password2' /><br></td>
                    </tr>
                    <tr>
                    <td>Email:</td><td><input type='email' name='email' value='$second' /><br></td>
                    </tr>
                    <tr>
                    <td><img src='../admin/secpic.php' alt='защитный код' /> </td><td><input type='text' name='capcha' /><br></td>
                    </tr>

                    </table>
                    

                    <center> <input type='submit' value='Зарегистрироваться' name='submit' /></center>
                    </form>";
    }
}

class Question
{
    
    private $text;
    private $answer;
    
    public function Add() {
        $Myconnect = new ConnectToBD();
        
        // $Myconnect->Connect("localhost", "root", "", "a9646121_1" );
        $Myconnect->Connect("mysql4.000webhost.com", "a9646121_1", "1q1q1q", "a9646121_1");
        
        if (isset($_POST['submit'])) {
            $text = $_POST['text'];
            $answer = $_POST['answer'];
            $date = date("Y-m-d H:i:s");
            session_start();
            $adminname = $_SESSION['adminname'];
            
            $query = mysql_query("SELECT * FROM admin WHERE login='$adminname'");
            $user_data = mysql_fetch_array($query);
            $id_admin = $user_data['id'];
            
            $query = mysql_query("INSERT INTO questions (date, question, id_admin, r_answer) VALUES ('$date', '$text', '$id_admin', '$answer')") or die(mysql_error());
        }
    }
    
    public function ShowAdd() {
        echo "<form action='../admin/Addition.php' method='post'>
                    <table>
                    <tr>
                    <td>Вопрос:  </td><td><input type='text' name='text' /><br></td>
                    </tr>
                    <tr>
                    <td>Ответ:  </td><td><input type='text'  name='answer' /><br></td>
                    </tr>
                    </table>
                    <center><input type='submit' value='Добавить' name='submit' /></center>
                    </form>";
    }
    
    public function ShowAll() {
        
        $Myconnect = new ConnectToBD();
        
        // $Myconnect->Connect("localhost", "root", "", "a9646121_1" );
        $Myconnect->Connect("mysql4.000webhost.com", "a9646121_1", "1q1q1q", "a9646121_1");
        
        session_start();
        $adminname = $_SESSION['adminname'];
        $query = mysql_query("SELECT * FROM admin WHERE login='$adminname'");
        $user_data = mysql_fetch_array($query);
        $id_admin = $user_data['id'];
        
        $query = mysql_query("SELECT * FROM questions WHERE id_admin='$id_admin'");
        while ($row = mysql_fetch_array($query)) {
            echo "ID: " . $row['id'] . "<br>\n";
            echo "Вопрос: " . $row['question'] . "<br>\n";
            echo "Ответ: " . $row['r_answer'] . "<br>\n";
            echo "Дата создания: " . $row['date'] . "<br><hr>\n";
        }
    }
    
    public function ShowInfo() {
        $Myconnect = new ConnectToBD();
        
        // $Myconnect->Connect("localhost", "root", "", "a9646121_1" );
        $Myconnect->Connect("mysql4.000webhost.com", "a9646121_1", "1q1q1q", "a9646121_1");
        
        session_start();
        $adminname = $_SESSION['adminname'];
        $query = mysql_query("SELECT * FROM admin WHERE login='$adminname'");
        $user_data = mysql_fetch_array($query);
        $id_admin = $user_data['id'];
        
        $query = mysql_query("SELECT count(*) as totalQuest FROM questions WHERE id_admin='$id_admin'");
        $data = mysql_fetch_assoc($query);
        echo "Всего вопросов: ", $data['totalQuest'], "<br>\n";
        
        $query = mysql_query("SELECT count(*) as totalStud FROM user WHERE id_admin='$id_admin'");
        $data1 = mysql_fetch_assoc($query);
        echo "Всего студентов: ", $data1['totalStud'], "<br>\n";
    }
    public function ShowDelete() {
        echo "<form action='../admin/DeleteQuestion.php' method='post'>
                    <table>
                    <tr>
                    <td>Номер вопроса для удаления:  </td><td><input type='text' name='number' /><br></td>
                    </tr>
                    </table>
                    <center><input type='submit' value='Удалить' name='submit' /></center>
                    </form>";
    }
    
    public function delete($number) {
        $Myconnect = new ConnectToBD();
        
        // $Myconnect->Connect("localhost", "root", "", "a9646121_1" );
        $Myconnect->Connect("mysql4.000webhost.com", "a9646121_1", "1q1q1q", "a9646121_1");
        
        session_start();
        $adminname = $_SESSION['adminname'];
        $query = mysql_query("SELECT * FROM admin WHERE login='$adminname'");
        $user_data = mysql_fetch_array($query);
        $id_admin = $user_data['id'];
        
        $query = mysql_query("SELECT * FROM questions WHERE id_admin='$id_admin' and id='$number'");
        $user_data = mysql_fetch_array($query);
        $id_quest = $user_data['id'];
        
        if (!empty($id_quest)) {
            mysql_query("DELETE FROM questions WHERE id_admin='$id_admin' and id='$number'");
            mysql_query("DELETE FROM results WHERE  id_question='$number'");
            echo ('Вопрос успешно удален.');
        } else echo ('Не найден такой вопрос! ');
    }
}

class Timer
{
    
    public function ShowFormToStart() {
        
        $bukvi = array();
        $massivCvetov = array();
        session_start();
        if (!empty($_SESSION['sec'])) {
            
            $sec = $_SESSION['sec'];
            $num = $_SESSION['id'] + 1;
            
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
                
                if ($notAnswered > 100 || $wrongAnswered > 100 || $rightAnswered > 100) while ($notAnswered < 100 && $wrongAnswered < 100 && $rightAnswered < 100):
                    $notAnswered = $notAnswered / 2;
                    $wrongAnswered = $wrongAnswered / 2;
                    $rightAnswered = $rightAnswered / 2;
                endwhile;
                
                $idquest = $_SESSION['id'];
                $query = mysql_query("SELECT answer FROM results WHERE id_question='$idquest'");
                $case = false;
                
                $chastota = array();
                
                if ($query) {
                    $massiv = array();
                    
                    //echo "запрос правильный";
                    $case = true;
                    $i = 1;
                    while ($row = mysql_fetch_array($query)) {
                        if (strlen($row['answer']) != 1) $case = false;
                        $massiv[$i] = $row['answer'];
                        
                        //echo $row['answer'] . " ";
                        $i++;
                    }
                    
                    $bukvit = array_unique($massiv);
                    
                    $j = 1;
                    for ($i = 0; $i <= count($massiv); $i++) {
                        if (!empty($bukvit[$i])) {
                            $bukvi[$j] = $bukvit[$i];
                            $j++;
                        }
                    }
                    
                    for ($i = 1; $i < count($bukvi); $i++) {
                        
                        $chastota[$i] = 0;
                        
                        // echo $bukvi[$i];
                        // echo "-";
                        
                        
                    }
                    
                    for ($i = 1; $i <= count($bukvi); $i++) {
                        
                        for ($j = 1; $j <= count($massiv); $j++) {
                            if ($bukvi[$i] == $massiv[$j]) $chastota[$i]++;
                        }
                    }
                }
                
                for ($i = 1; $i <= count($bukvi); $i++) {
                    
                    // echo $chastota[$i] . "    " . $bukvi[$i] . "      ";
                    // echo ('<br>');
                    
                    
                }
                
                // if ($case) echo "case=true";
                
                // Значения столбцов от 0 до 100
                $rows = array($notAnswered, $wrongAnswered, $rightAnswered);
                if ($case) $rows = $chastota;
                
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
                $it = 1;
                $start = 0;
                foreach ($rows as $value) {
                    $color = imagecolorallocate($img, rand(0, 255), rand(0, 255), rand(0, 255));
                    
                    if ($iterator == 0) $color1 = $color;
                    if ($iterator == 1) $color2 = $color;
                    if ($iterator == 2) $color3 = $color;
                    $massivCvetov[$it] = $color;
                    $iterator++;
                    $it++;
                    
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
                
                if (!$case) {
                    echo ('<p>Результаты за предыдущее тестирование: </p>
                    <p><img src="result.gif" alt="result"></p>
                        <p><img src="color1.png" alt="result"> - не ответили</p>
                        <p><img src="color2.png" alt="result"> - неправильно ответили</p>
                        <p><img src="color3.png" alt="result"> - правильно ответили</p>');
                } else {
                    
                    echo ('<p>Результаты за предыдущее тестирование: </p>
                    <p><img src="result.gif" alt="result"></p>');
                    
                    for ($i = 1; $i <= count($bukvi); $i++) {
                        
                        $im = imagecreatetruecolor(30, 30);
                        
                        // Закрашенный прямоугольник
                        imagefilledrectangle($im, 0, 0, 30, 30, $massivCvetov[$i]);
                        imagepng($im, 'color' . $i . '.png');
                        imagedestroy($im);
                        $path = 'color' . strval($i) . '.png';
                        $letter = $bukvi[$i];
                        
                        echo ('<p><img src="');
                        echo $path;
                        echo ('" alt="result"> -');
                        echo $letter;
                        echo ('</p>');
                    }
                }
            }
            
            // unlink('result.gif');
            // unlink('color1.png');
            // unlink('color2.png');
            // unlink('color3.png');
            
            
        } else {
            
            $sec = 60;
            $num = '';
        }
        
        echo "<form  action='../admin/Timer.php' method='post'>
                        <table>
                    <tr>
                    <td>Секунд: </td><td><input type='text' value='$sec' name='seconds' /><br></td></tr>
                    <tr>
                    <td>Номер вопроса: </td><td><input type='text' value='$num' name='number' /><br></td>
                    </tr>
                    </table>
                    <center><input type='submit' value='Запустить' name='submit' /></center> </div>
                    </form>";
    }
    
    public function Run($seconds, $number) {
        $start_from = $seconds;
        
        //число, с которого начинается отсчет
        $id = $number;
        session_start();
        $_SESSION['sec'] = $seconds;
        $_SESSION['id'] = $id;
        
        // Открыть текстовый файл
        $f = fopen("../common/seconds" . $_SESSION['adminname'] . ".txt", "w");
        
        // Записать строку текста
        fwrite($f, $seconds);
        
        // Закрыть текстовый файл
        fclose($f);
        
        $adminname = $_SESSION['adminname'];
        
        // Открыть текстовый файл
        $f = fopen("../common/question" . $_SESSION['adminname'] . ".txt", "w");
        
        // Записать строку текста
        fwrite($f, $id);
        
        // Закрыть текстовый файл
        fclose($f);
        
        print '<script language="javascript">
             
             
        function getAjax()
        {
            if (window.ActiveXObject) // для IE
            return new ActiveXObject("Microsoft.XMLHTTP");
        else if (window.XMLHttpRequest) 
            return new XMLHttpRequest();
        else 
            {
                alert("Browser does not support AJAX.");
                return null;
            }
        }    
        
             
              function ajaxFunction(sec)
        {
            ajax=getAjax();
            var param;
            if (ajax != null) 
                {   
                    // метод POST, указываем просто имя файла
                    ajax.open("GET","../common/write.php?in="+sec+"&admin="+' . $adminname . ',true);
                //alert ("../common/write.php?in="+sec+"&admin="+' . $adminname . ');
                    // добавляем стандартный заголовок http
                    // посылаемый через ajax
        /*          ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
       
                    // вроде эти могут тормозить      
                    ajax.setRequestHeader("Content-length", param.length);
                    ajax.setRequestHeader("Connection", "close");               
       */
                  ajax.send(sec);  
                }
                
        }
            
             
        (function () {
        var writeTo = document.getElementById("mainContent");
        var sec = ' . $start_from . ';
        var a=setInterval(function() {
        sec--;
        
        var ajax=null;
        ajaxFunction(sec);
        
        if (sec==0) { writeTo.innerHTML = "Время вышло";



        clearInterval(a);
        location.reload(true)
}
        else writeTo.innerHTML = sec;},1000)})();
    
       </script>';
        
        echo " Отсчет начинается...";
    }
}

class Answer
{
    
    private $text;
    
    public function MakeAnswer($answer) {
        $Myconnect = new ConnectToBD();
        
        //$Myconnect->Connect("localhost", "root", "", "a9646121_1" );
        $Myconnect->Connect("mysql4.000webhost.com", "a9646121_1", "1q1q1q", "a9646121_1");
        
        if (isset($_POST['submit'])) {
            $text = $answer;
            
            session_start();
            $username = $_SESSION['username'];
            
            $query = mysql_query("SELECT * FROM user WHERE login='$username'");
            $user_data = mysql_fetch_array($query);
            $id = $user_data['id'];
            
            $name = $_SESSION['username'];
            
            //echo $name;
            $query = mysql_query("SELECT * FROM user WHERE login='$name'");
            $user_data = mysql_fetch_array($query);
            $idadmin = $user_data['id_admin'];
            
            //echo $idadmin;
            
            $query = mysql_query("SELECT * FROM admin WHERE id='$idadmin'");
            $user_data = mysql_fetch_array($query);
            $adminname = $user_data['login'];
            
            $f = fopen("../common/question" . $adminname . ".txt", "r");
            
            // Читать строку их текстового файла и записать содержимое клиенту
            $question = fgets($f);
            fclose($f);
            
            $query = mysql_query("INSERT INTO results (id_user, id_question, answer) VALUES ('$id', '$question', '$answer')") or die(mysql_error());
        }
    }
    
    public function ShowToAnswer() {
        $Myconnect = new ConnectToBD();
        
        //$Myconnect->Connect("localhost", "root", "", "a9646121_1" );
        $Myconnect->Connect("mysql4.000webhost.com", "a9646121_1", "1q1q1q", "a9646121_1");
        
        $name = $_SESSION['username'];
        
        //echo $name;
        $query = mysql_query("SELECT * FROM user WHERE login='$name'");
        $user_data = mysql_fetch_array($query);
        $idadmin = $user_data['id_admin'];
        
        //echo $idadmin;
        
        $query = mysql_query("SELECT * FROM admin WHERE id='$idadmin'");
        $user_data = mysql_fetch_array($query);
        $adminname = $user_data['login'];
        
        $f = fopen("../common/question" . $adminname . ".txt", "r");
        
        // Читать строку их текстового файла и записать содержимое клиенту
        $question = fgets($f);
        fclose($f);
        
        $query = mysql_query("SELECT * FROM questions WHERE id='$question'");
        $user_data = mysql_fetch_array($query);
        $text = $user_data['question'];
        
        echo $text;
        
        echo "<form action='../user/AnswerPage.php' method='post'>
                    <table>
                    <tr>
                    <td>Ответ:  </td><td><input type='text'  name='answer' /><br></td>
                    </tr>
                    </table>
                    <center><input type='submit' value='Отправить' name='submit' /></center>
                    </form>";
    }
}
?>

