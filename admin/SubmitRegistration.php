<?php
include '../common/my.php';

 $Myconnect = new ConnectToBD();
        
        // $Myconnect->Connect("localhost", "root", "", "a9646121_1" );
        $Myconnect->Connect("mysql4.000webhost.com", "a9646121_1", "1q1q1q", "a9646121_1");
            
        $name = $_GET['name'];
        $key = $_GET['check1'];
        $query = mysql_query("SELECT * FROM admin WHERE login='$name'");
        $user_data = mysql_fetch_array($query);
           
            if ( $user_data['check1']==$key)  
            {
            	

				mysql_query("UPDATE admin SET check1=NULL WHERE login='$name'");
	
				?>
					<script type="text/javascript" charset="windows-1251">
					alert('Учетная запись активирована. Перенаправравляем на страницу авторизации.');
					window.location.href = "AuthorizationPage.php";
					</script>
				<?php
			}

		
		else 
		{
			?>
					<script type="text/javascript" charset="windows-1251">
					alert('Ошибка активации! Перенаправравляем на страницу авторизации.');
					window.location.href = "AuthorizationPage.php";
					</script>
				<?php


		}
		echo $_GET['name'];
		echo $_GET['check1'];
?>