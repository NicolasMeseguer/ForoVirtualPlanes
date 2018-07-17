<?php

require_once 'conexion.php';

class Comentarios extends Conexion {

    public $mysqli;
    public $data;
    private $tComentarios;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }
    
    //*****************************************************************
    // ULTIMO COMENTARIO
    //*****************************************************************
    public function ultimo_comentario($id) {
		$this->data = array();
		$id = mysqli_real_escape_string($this->mysqli, $id);
        $resultado = $this->mysqli->query("SELECT
            comentario_foro.id_comentario,
            comentario_foro.id_tema,
            comentario_foro.comentario,
            comentario_foro.fecha,
            comentario_foro.activo,
            foro_temas.titulo,
            foro_foro.id_foro,
            usuarios.nick,
			usuarios.id,
			foro_subforos.id_subforo,
			foro_subforos.subforo
            FROM
            comentario_foro
            INNER JOIN foro_temas ON foro_temas.id_tema = comentario_foro.id_tema
            INNER JOIN foro_foro ON foro_foro.id_foro = foro_temas.id_foro
            INNER JOIN usuarios ON comentario_foro.id_usuario = usuarios.id
			INNER JOIN foro_subforos ON foro_temas.id_subforo = foro_subforos.id_subforo
            WHERE
            foro_foro.id_foro = $id
            ORDER BY
            comentario_foro.id_comentario DESC
            limit 1");

        while ( $fila = $resultado->fetch_assoc() ) {
            $this->data[] = $fila;
        }
        
        return $this->data;
    }
	//*****************************************************************
    // COMPROBAMOS SI EL COMENTARIO EXISTE
    //*****************************************************************
    public function checkComentario($id) {
		$id = mysqli_real_escape_string($this->mysqli, $id);
        $resultado = $this->mysqli->query("select * from comentario_foro WHERE id_comentario = $id");
		$registros = $resultado->num_rows;
		
		if($registros != 0) {
			return true;
		}
		else {
			return false;
		}
    }
	//*****************************************************************
    // ULTIMO COMENTARIO SUBFORO
    //*****************************************************************
    public function ultimo_comentario_subforo($id) {
		$id = mysqli_real_escape_string($this->mysqli, $id);
		$this->data = array();

        $resultado = $this->mysqli->query("SELECT
            comentario_foro.id_comentario,
            comentario_foro.id_tema,
            comentario_foro.comentario,
            comentario_foro.fecha,
            comentario_foro.activo,
            foro_temas.titulo,
            foro_foro.id_foro,
            usuarios.nick,
			usuarios.id
            FROM
            comentario_foro
            INNER JOIN foro_temas ON foro_temas.id_tema = comentario_foro.id_tema
            INNER JOIN foro_foro ON foro_foro.id_foro = foro_temas.id_foro
            INNER JOIN usuarios ON comentario_foro.id_usuario = usuarios.id
            WHERE
            foro_temas.id_subforo = $id
            ORDER BY
            comentario_foro.id_comentario DESC
            limit 1");

        while ( $fila = $resultado->fetch_assoc() ) {
            $this->data[] = $fila;
        }
        
        return $this->data;
    }

    //*****************************************************************
    // LISTA LOS COMENTARIOS
    //*****************************************************************
    public function comentarios($id) {
		$id = mysqli_real_escape_string($this->mysqli, $id);
        $resultado = $this->mysqli->query("SELECT
            comentario_foro.id_comentario,
            comentario_foro.id_tema,
            comentario_foro.id_usuario,
            comentario_foro.comentario,
            comentario_foro.fecha,
            comentario_foro.activo,
            usuarios.nick,
            usuarios.avatar,
            usuarios.fechaderegistro,
            usuarios.firma
            FROM
            comentario_foro
            INNER JOIN usuarios ON comentario_foro.id_usuario = usuarios.id 
            WHERE id_tema = $id");

        while ( $fila = $resultado->fetch_assoc() ) {
            $this->data[] = $fila;
        }
        
        return $this->data;
    }

    //*****************************************************************
    // TOTAL DE COMENTARIOS POR TEMA
    //*****************************************************************
    public function TotalComentarios($tema) {
		$tema = mysqli_real_escape_string($this->mysqli, $tema);
        $resultado = $this->mysqli->query("select count(*) as total from comentario_foro where id_tema = '$tema'"); 

        if ($reg = $resultado->fetch_array()) {
            $this->tComentarios = $reg["total"];
        }

        return $this->tComentarios;
    }
    //*****************************************************************
    // TOTAL DE COMENTARIOS POR TEMA
    //*****************************************************************
    public function TotalComentariosUsuario($id) {
		$id = mysqli_real_escape_string($this->mysqli, $id);
        $resultado = $this->mysqli->query("select count(*) as total from comentario_foro where id_usuario = '$id'"); 

        if ($reg = $resultado->fetch_array()) {
            $this->tComentarios = $reg["total"];
        }

        return $this->tComentarios;
    }
    //*****************************************************************
    // TOTAL DE COMENTARIOS POR FORO
    //*****************************************************************
    public function TotalComentariosForo($foro) {
		$foro = mysqli_real_escape_string($this->mysqli, $foro);
        $resultado = $this->mysqli->query("SELECT count(*) as total
            FROM
            comentario_foro
            INNER JOIN foro_temas ON comentario_foro.id_tema = foro_temas.id_tema
            INNER JOIN foro_foro ON foro_temas.id_foro = foro_foro.id_foro
            WHERE
            foro_foro.id_foro = '$foro'"); 

        if ($reg = $resultado->fetch_array()) {
            $this->tComentarios = $reg["total"];
        }

        return $this->tComentarios;
    }
    //*****************************************************************
    // AGREGAR COMENTARIO
    //*****************************************************************
    public function add($id, $foro, $sub) {
		$id = mysqli_real_escape_string($this->mysqli, $id);
		$foro = mysqli_real_escape_string($this->mysqli, $foro);
		$sub = mysqli_real_escape_string($this->mysqli, $sub);
        $comentario = $_POST['comentario'];
        $activo = 0;
        $usuario = $_SESSION["id"];

        $resultado = $this->mysqli->query("INSERT INTO comentario_foro(id_tema, id_usuario, comentario, fecha, activo) 
            VALUES($id, $usuario, '$comentario', now(), $activo)");
			
		$resultado = $this->mysqli->query("UPDATE foro_temas SET updated_at = now() WHERE id_tema = $id");
        
		echo "<script type='text/javascript'>window.location='index.php?temaid=$id&foro=$foro&sub=$sub';</script>";
    }

    //*****************************************************************
    // ULTIMO COMENTARIO
    //*****************************************************************
    public function ultmoComentario($id) {
		$id = mysqli_real_escape_string($this->mysqli, $id);
		$this->data = array();
        $resultado = $this->mysqli->query("SELECT
            comentario_foro.id_comentario,
            comentario_foro.id_tema,
            comentario_foro.comentario,
            comentario_foro.fecha,
            comentario_foro.activo,
            usuarios.nick,
            usuarios.avatar,
            usuarios.fechaderegistro,
            usuarios.firma,
			usuarios.id
            FROM
            comentario_foro
            INNER JOIN usuarios ON comentario_foro.id_usuario = usuarios.id
            where id_tema = $id
            ORDER BY
            comentario_foro.id_comentario DESC
            limit 1");

        while ( $fila = $resultado->fetch_assoc() ) {
            $this->data[] = $fila;
        }
        
        return $this->data;
    }

    //*****************************************************************
    // ELIMINA COMENTARIO
    //*****************************************************************
    public function del($id, $tema, $foro, $sub) {
		$id = mysqli_real_escape_string($this->mysqli, $id);
        $resultado = $this->mysqli->query("DELETE FROM comentario_foro WHERE id_comentario = $id");

		header("Location: index.php?temaid=$tema&foro=$foro&sub=$sub");
        
    }
}
?>