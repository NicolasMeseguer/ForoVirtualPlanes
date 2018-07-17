<?php
require_once 'conexion.php';

class Usuarios extends Conexion {

    public $mysqli;
    public $data;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }

    //*****************************************************************
    // LISTAMOS USUARIOS
    //*****************************************************************
    public function usuarios() {

        $resultado = $this->mysqli->query("SELECT * FROM usuarios");

        while ( $fila = $resultado->fetch_assoc() ) {
            $this->data[] = $fila;
        }
        
        return $this->data;
    }
	//*****************************************************************
    // COMPROBAMOS SI EL COMENTARIO EXISTE
    //*****************************************************************
    public function checkUser($id) {
		$id = mysqli_real_escape_string($this->mysqli, $id);
        $resultado = $this->mysqli->query("select * from usuarios WHERE id = $id");
		$registros = $resultado->num_rows;
		
		if($registros != 0) {
			return true;
		}
		else {
			return false;
		}
    }
    //*****************************************************************
    // TEMAS POR USUARIO USUARIOS
    //*****************************************************************
    public function usuariotemas($id) {
		$id = mysqli_real_escape_string($this->mysqli, $id);
        $resultado = $this->mysqli->query("SELECT
            foro_temas.id_tema,
            foro_temas.id_foro,
            foro_temas.id_subforo,
            foro_temas.titulo,
            foro_temas.contenido,
            foro_temas.fecha,
            foro_temas.id_usuario,
            foro_temas.activo,
            foro_temas.hits
            FROM
            foro_temas
            WHERE
            foro_temas.id_usuario = $id");

        while ( $fila = $resultado->fetch_assoc() ) {
            $this->data[] = $fila;
        }
        
        return $this->data;
    }

    //*****************************************************************
    // USUARIO POR ID
    //*****************************************************************
    public function usuariosid($id) {
		$id = mysqli_real_escape_string($this->mysqli, $id);
		$this->data = array();
        $resultado = $this->mysqli->query("select * from usuarios where id = $id");

        while ( $fila = $resultado->fetch_assoc() ) {
            $this->data[] = $fila;
        }
        
        return $this->data;
    }

    //*****************************************************************
    // NUEVO USUARIO
    //*****************************************************************
    public function nuevousuario($salt) {
        parent::Conectar();

        $pass = md5($_POST["clave"].$salt);
        $facebook = "";
        $twitter = "";
        $activo = 0;
        $avatar = "default.jpg";
        $firma = "Me encanta FVP";
        $privileges = "user";

        $nick = $_POST['usuario'];
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
		$nick = mysqli_real_escape_string($this->mysqli, $nick);
		$nombre = mysqli_real_escape_string($this->mysqli, $nombre);
		$correo = mysqli_real_escape_string($this->mysqli, $correo);
		
		$token = md5($salt.time().rand(1, 99999));
		$signature = $salt;
		
        // VALIDAMOS SI EXISTE EL NICK
        $resultado = $this->mysqli->query("select nick from usuarios where nick = '$nick'"); 
        $registros = $resultado->num_rows;
		
		if($registros!=0) { //SI EXISTE AL INDEX
			header("Location: index.php?action=register&m=1");
		}
		else {
			// VALIDAMOS SI EXISTE EL CORREO
			if($registros==0) {
				$resultado = $this->mysqli->query("select correo from usuarios where correo = '$correo'"); 
				$registros = $resultado->num_rows;
			}

			if ($registros == 0) {
				$resultado = $this->mysqli->query("INSERT INTO usuarios(nick, password, nombre, correo, facebook, twitter, fechaderegistro, ultimoacceso, activo, avatar, firma, privileges, signature, token) 
					VALUES('$nick','$pass', '$nombre', '$correo', '$facebook', '$twitter', now(), now(), $activo, '$avatar', '$firma', '$privileges', '$signature', '$token')"); 
				// OBTENEMOS EL ULTIMO ID
				$id = $this->mysqli->insert_id;
				
				$_SESSION['token'] = $token;
				$_SESSION['redirect'] = true;
				$_SESSION['correo'] = $_POST['correo'];
				header("Location: index.php?action=aceptaemail");
			} else {
				header("Location: index.php?action=register&m=2");
			}
		}
    }

    //*****************************************************************
    // LISTAMOS LOS TEMAS PAGINADOS DEL FORO
    //*****************************************************************
    public function update($id) {

        $nombre = htmlentities($_POST['nombre']);
        $correo = htmlentities($_POST['correo']);
        $facebook = htmlentities($_POST['facebook']);
        $twitter = htmlentities($_POST['twitter']);
        $firma= htmlentities($_POST['firma']);
		$nombre = mysqli_real_escape_string($this->mysqli, $nombre);
		$correo = mysqli_real_escape_string($this->mysqli, $correo);
		$facebook = mysqli_real_escape_string($this->mysqli, $facebook);
		$twitter = mysqli_real_escape_string($this->mysqli, $twitter);
		$firma = mysqli_real_escape_string($this->mysqli, $firma);
		
		
		$_SESSION['nombre']=$nombre;

        $resultado = $this->mysqli->query("UPDATE usuarios SET nombre = '$nombre', correo = '$correo', facebook = '$facebook', twitter = '$twitter', firma = '$firma' WHERE id = $id");
        echo "<script type='text/javascript'>
			window.location='". Conexion::ruta() ."?userid=$id';
			</script>";
    }
	//*****************************************************************
    // ELIMINAR - DE UN USUARIO DESTRUYE TODA LA SESSION AL ELIMINARSE
    //*****************************************************************
	public function del($id) {
		$id = mysqli_real_escape_string($this->mysqli, $id);
		$this->data = array();
        $resultado = $this->mysqli->query("SELECT * FROM foro_temas WHERE id_usuario = $id");
		
		while ( $fila = $resultado->fetch_assoc() ) {
            $idtema = $fila["id_tema"];
			$r = $this->mysqli->query("DELETE FROM comentario_foro WHERE id_tema = $idtema");
        }
		
		//DELETE
		$resultado = $this->mysqli->query("DELETE FROM usuarios WHERE id = $id");
        $resultado = $this->mysqli->query("DELETE FROM foro_temas WHERE id_usuario = $id");
        $resultado = $this->mysqli->query("DELETE FROM comentario_foro WHERE id_usuario = $id");
		
		echo "<script type='text/javascript'>
			window.location='". Conexion::ruta() ."?action=usuarios';
			</script>";
    }
    //*****************************************************************
    // LISTAMOS LOS TEMAS PAGINADOS DEL FORO
    //*****************************************************************
    public function updateavatar($id) {
        parent::Conectar();
		$id = mysqli_real_escape_string($this->mysqli, $id);
        $foto = str_replace(" ", "_", $_FILES["foto"]["name"]);
        copy($_FILES["foto"]["tmp_name"], "upload/" . $id . '_' . $foto);
        $imagen = $id . '_' . $foto;
        
        $resultado = $this->mysqli->query("UPDATE usuarios SET avatar = '$imagen' WHERE id = $id");
        // Cambaimos el tamañao de todos los avatares subidos
        include_once('class/thumb.php');
        $mythumb = new thumb();
        $mythumb->loadImage('upload/'.$imagen);
        $mythumb->resize(70, 'width');
        $mythumb->save('upload/'.$imagen, 100);
        
        
        echo "<script type='text/javascript'>
			window.location='". Conexion::ruta() ."?userid=$id';
			</script>";
    }
	//*****************************************************************
    // ACTUALZIAR USUARIO A ADMINISTRADOR
    //*****************************************************************
    public function upgradeuser($id) {
		$id = mysqli_real_escape_string($this->mysqli, $id);
        $resultado = $this->mysqli->query("UPDATE usuarios SET privileges = 'admin' WHERE id = $id");
        
        echo "<script type='text/javascript'>
			window.location='". Conexion::ruta() ."?action=usuarios';
			</script>";
    }
	//*****************************************************************
    // ACTUALZIAR USUARIO A USER NORMAL
    //*****************************************************************
    public function downgradeuser($id) {
		$id = mysqli_real_escape_string($this->mysqli, $id);
        $resultado = $this->mysqli->query("UPDATE usuarios SET privileges = 'user' WHERE id = $id");
        
        echo "<script type='text/javascript'>
			window.location='". Conexion::ruta() ."?action=usuarios';
			</script>";
    }
	
	public function checkToken($token) {
		$token = mysqli_real_escape_string($this->mysqli, $token);
        $resultado = $this->mysqli->query("SELECT * FROM usuarios WHERE token LIKE '$token'");
        $registros = $resultado->num_rows;
		
		if($registros >= 1)
			return true;
		else
			return false;
    }
	
	public function activarUser($token) {
		$token = mysqli_real_escape_string($this->mysqli, $token);
		$resultado = $this->mysqli->query("UPDATE usuarios SET activo = 1, token = NULL WHERE token = '$token'");
	}
	
	public function checkEmail($mail) {
		$mail = mysqli_real_escape_string($this->mysqli, $mail);
		$resultado = $this->mysqli->query("SELECT * FROM usuarios WHERE correo LIKE '$mail'");
        $registros = $resultado->num_rows;
		
		if($registros >= 1)
			return true;
		else
			return false;
	}
	
	public function getSignature($mail) {
		$mail = mysqli_real_escape_string($this->mysqli, $mail);
		$resultado = $this->mysqli->query("SELECT signature, nick FROM usuarios WHERE correo LIKE '$mail'");
		
		while ( $fila = $resultado->fetch_assoc() ) {
            $data = $fila;
        }
		
        return $data;
	}
	
	public function checkSignature($signature) {
		$resultado = $this->mysqli->query("SELECT * FROM usuarios WHERE signature LIKE '$signature'");
		
		$registros = $resultado->num_rows;
		
		if($registros >= 1)
			return true;
		else
			return false;
	}
	
	public function updatePassword($nuevasignature, $newpassword, $oldsignature) {
		$newpassword = mysqli_real_escape_string($this->mysqli, $newpassword);
		$resultado = $this->mysqli->query("UPDATE usuarios SET password = '$newpassword', signature = '$nuevasignature' WHERE signature = '$oldsignature'");
	}
	
	public function checkActive($email) {
		$email = mysqli_real_escape_string($this->mysqli, $email);
		$resultado = $this->mysqli->query("SELECT activo FROM usuarios WHERE correo LIKE '$email'");
		
		while ( $fila = $resultado->fetch_assoc() ) {
            $data = $fila;
        }
		
		if($data['activo'] == 1)
			return true;
		else
			return false;
	}
}