<?php
abstract class Conexion {
   public function conectar(){
      $mysqli = new mysqli('e87160-phpmyadmin.services.easyname.eu','u137048db1','HolaMundo1','u137048db1',3306);

      if ($mysqli->connect_errno) {
		  $_SESSION['error']=true;
		  return false;
	  }

      $mysqli->set_charset('utf8');
      
      return $mysqli;
   }
}
?>
