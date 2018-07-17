<?php
abstract class Conexion {
   public function conectar(){
      $mysqli = new mysqli('databaseurl','username','password','username',3306);

      if ($mysqli->connect_errno) {
		  $_SESSION['error']=true;
		  return false;
	  }

      $mysqli->set_charset('utf8');
      
      return $mysqli;
   }
   
   public static function ruta() {
      return "http://www.nicolasmeseguer.com/ForoVirtualPlanes/index.php";
	  
   }
}
?>
