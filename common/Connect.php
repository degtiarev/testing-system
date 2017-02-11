<?php
class ConnectToBD
{
    private $adress;
    private $user;
    private $password;
    private $bdname;
    
    public function Connect($x, $y, $z, $a) {
        $this->adress = $x;
        $this->user = $y;
        $this->password = $z;
        $this->bdname = $a;
        
        //mysql_set_charset("utf8");
        $connect = mysql_connect($this->adress, $this->user, $this->password) or die(mysql_error());
        mysql_select_db($this->bdname);
    }
}
?>