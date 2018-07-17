<?php

require_once 'conexion.php';

class Sesion extends Conexion {

    private $login;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->login = array();
    }
    //****************************************
    // loguea al usuario
    //****************************************
    public function logueo() {
        $usuario = $_POST["usuario"];
		$usuario = mysqli_real_escape_string($this->mysqli, $usuario);
		$resultado = $this->mysqli->query("SELECT password, signature, activo from usuarios where nick = '$usuario'");

		while ( $fila = $resultado->fetch_assoc() ) {
            $data[] = $fila;
        }
		if(empty($data) || !isset($data)) {
			header("Location: index.php?action=login&m=1");
			die();
		}
		if($data[0]['activo'] == 1) {
			$pass = md5($_POST['password'].$data[0]['signature']);
			if($pass === $data[0]['password']) {
				$resultado = $this->mysqli->query("SELECT id, nombre, privileges, nick, signature from usuarios where nick = '$usuario' and password = '$pass'");

				while ( $fila = $resultado->fetch_assoc() ) {
					$this->login[] = $fila;
				}

				foreach ($this->login as $key) {
					$_SESSION["id"] = $key["id"];
					$_SESSION["nombre"] = $key["nombre"];
					$_SESSION["privileges"] = $key["privileges"];
					$_SESSION["nick"] = $key["nick"];
				}
				
				$id = $_SESSION["id"];
				$now = date("Y-m-d H:i:s", time());
				$resultado = $this->mysqli->query("UPDATE usuarios SET ultimoacceso = '$now' WHERE id = '$id'");
				
				header("Location: index.php");
			}
			else {
				header("Location: index.php?action=login&m=1");
				die();
			}
		}
		else {
			header("Location: index.php?action=login&m=3");
			die();
		}
    }

}