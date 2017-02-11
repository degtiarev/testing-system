<?php
include '../common/my.php';

session_start();
if ($_SESSION['adminname'] != null) header('Location: MyPage.php');

if($_SESSION['secpic']!=strtolower($_POST['capcha'])) 
	{
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['email'] = $_POST['email'];
?>
		<script type="text/javascript" charset="windows-1251">
		alert('Не правильные символы CAPCHA!');
		window.location.href = "RegistrationPage.php";
		</script>
<?php
	}


else if ($_POST['name'] == null || $_POST['password']==null || $_POST['password2']==null || $_POST['email']==null   ) 
	{
		session_start();
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['email'] = $_POST['email'];
?>
		<script type="text/javascript" charset="windows-1251">
		alert('Не все поля введены!');
		window.location.href = "RegistrationPage.php";
		</script>
<?php
	}

else if ($_POST['password']!= $_POST['password2']) 
	{
		session_start();
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['email'] = $_POST['email'];
?>
		<script type="text/javascript" charset="windows-1251">
		alert('Пароли не совпадают!');
		window.location.href = "RegistrationPage.php";
		</script>
<?php
	}



else 
{
	 $Myconnect = new ConnectToBD();
        
        // $Myconnect->Connect("localhost", "root", "", "a9646121_1" );
        $Myconnect->Connect("mysql4.000webhost.com", "a9646121_1", "1q1q1q", "a9646121_1");
            
        $name = $_POST['name'];
        $password = md5($_POST['password']);
        $query = mysql_query("SELECT * FROM admin WHERE login='$name'");
        $user_data = mysql_fetch_array($query);
           
            if (!empty ($user_data['password']) ) 
            {
              session_start();
      		  $_SESSION['name'] = $_POST['name'];
       		  $_SESSION['email'] = $_POST['email'];
?>
		<script type="text/javascript" charset="windows-1251">
		alert('Учетная запись с таким именем уже имеется в бд!');
		window.location.href = "RegistrationPage.php";
		</script>
<?php
            }

     else
     {
		$admin = new admin();
		$admin->Registration();

		 $_SESSION['name'] = '';
        $_SESSION['email'] = '';
		?>
		<script type="text/javascript" charset="windows-1251">
		alert('Вы успешно зарегистрировались! Пожалуйста, подтвердите почту, перейдя по ссылке из письма');
		window.location.href = "../index.php";
		</script>
<?php
		
	}
}
?>
