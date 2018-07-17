<?php

require_once 'conexion.php';

class Temas extends Conexion {

    public $mysqli;
    public $data;
    private $tTemas;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }

    //*****************************************************************
    // LISTAMOS LOS TEMAS PAGINADOS DEL FORO
    //*****************************************************************
    public function getTemas($foro, $inicio, $cantTemas) {

        $resultado = $this->mysqli->query("SELECT
            foro_temas.id_tema,
            foro_temas.id_foro,
            foro_temas.id_subforo,
            foro_temas.titulo,
            foro_temas.contenido,
            foro_temas.fecha,
            foro_temas.activo,
            foro_temas.hits,
            usuarios.nick,
            foro_temas.id_usuario
            FROM
            foro_temas
            INNER JOIN usuarios ON foro_temas.id_usuario = usuarios.id
            where id_foro = $foro
            order by id_tema desc
            limit $inicio, $cantTemas");

        while ( $fila = $resultado->fetch_assoc() ) {
            $this->data[] = $fila;
        }
        
        return $this->data;
    }
	//*****************************************************************
    // COMPROBAMOS SI EL TEMA EXISTE
    //*****************************************************************
    public function checkTema($id) {
		$id = mysqli_real_escape_string($this->mysqli, $id);
        $resultado = $this->mysqli->query("select * from foro_temas WHERE id_tema = $id");
		$registros = $resultado->num_rows;
		
		if($registros != 0) {
			return true;
		}
		else {
			return false;
		}
    }
    //*****************************************************************
    // TOTAL DE TEMAS DEL FORO
    //*****************************************************************
    public function TotalTemas($foro) {
		$foro = mysqli_real_escape_string($this->mysqli, $foro);
        $resultado = $this->mysqli->query("select count(*) as total from foro_temas where id_foro = '$foro'"); 

        if ($reg = $resultado->fetch_array()) {
            $this->tTemas = $reg["total"];
        }

        return $this->tTemas;
    }
    //*****************************************************************
    // TOTAL TEMAS POR USUARIO
    //*****************************************************************
    public function TotalTemasUsuarios($id) {
		$id = mysqli_real_escape_string($this->mysqli, $id);
        $resultado = $this->mysqli->query("select count(*) as total from foro_temas where id_usuario = '$id'"); 

        if ($reg = $resultado->fetch_array()) {
            $this->tTemas = $reg["total"];
        }

        return $this->tTemas;
    }

    //*****************************************************************
    // LISTAMOS LOS TEMAS PAGINADOS DEL SUBFORO
    //*****************************************************************
    public function getsubTemas($sub, $inicio, $cantTemas) {
			$resultado = $this->mysqli->query("SELECT * 
			FROM foro_temas
			INNER JOIN usuarios ON foro_temas.id_usuario=usuarios.id
			WHERE foro_temas.id_subforo = $sub
			ORDER BY foro_temas.updated_at DESC
			LIMIT $inicio, $cantTemas");

        while ( $fila = $resultado->fetch_assoc() ) {
            $this->data[] = $fila;
        }
        
        return $this->data;
    }

    //*****************************************************************
    // TOTAL DE TEMAS DEL SUBFORO
    //*****************************************************************
    public function TotalsubTemas($sub) {
		$sub = mysqli_real_escape_string($this->mysqli, $sub);
        $resultado = $this->mysqli->query("select count(*) as total from foro_temas where id_subforo = '$sub'"); 

        if ($reg = $resultado->fetch_array()) {
            $this->tTemas = $reg["total"];
        }

        return $this->tTemas;
    }

    //*****************************************************************
    // LISTAMOS LOS SUBFOROS POR FORO
    //*****************************************************************
    public function tema($id) {
		$id = mysqli_real_escape_string($this->mysqli, $id);
        $resultado = $this->mysqli->query("SELECT
            foro_temas.id_tema,
            foro_temas.id_foro,
            foro_temas.id_subforo,
            foro_temas.titulo,
            foro_temas.contenido,
            foro_temas.fecha,
            foro_temas.activo,
            foro_temas.hits,
            usuarios.nick,
            foro_temas.id_usuario,
            usuarios.facebook,
            usuarios.twitter,
            usuarios.fechaderegistro,
            usuarios.avatar,
            usuarios.firma
            FROM
            foro_temas
            INNER JOIN usuarios ON foro_temas.id_usuario = usuarios.id
            where id_tema = $id");

        while ( $fila = $resultado->fetch_assoc() ) {
            $this->data[] = $fila;
        }
        
        return $this->data;
    }

    //*****************************************************************
    // SUMA LAS VISITAS
    //*****************************************************************
    public function hits($id) {
		$id = mysqli_real_escape_string($this->mysqli, $id);
        $resultado = $this->mysqli->query("UPDATE foro_temas SET hits = hits+1 WHERE id_tema = $id");
    }
    
    //*****************************************************************
    // LISTAMOS LOS SUBFOROS POR FORO
    //*****************************************************************
    public function buscar($buscar) {
		$buscar = mysqli_real_escape_string($this->mysqli, $buscar);
        $resultado = $this->mysqli->query("SELECT
            foro_temas.id_tema,
            foro_temas.id_foro,
            foro_temas.id_subforo,
            foro_temas.titulo,
            foro_temas.contenido,
            foro_temas.fecha,
            foro_temas.id_usuario,
            foro_temas.activo,
            foro_temas.hits,
            usuarios.nick
            FROM
            foro_temas
            INNER JOIN usuarios ON foro_temas.id_usuario = usuarios.id where titulo LIKE '%$buscar%'");

        while ( $fila = $resultado->fetch_assoc() ) {
            $this->data[] = $fila;
        }
        
        return $this->data;
    }
    
    //*****************************************************************
    // LISTAMOS LOS SUBFOROS POR FORO
    //*****************************************************************
    public function add($foro) {

        $tema = htmlentities($_POST['titulo']);
        $contenido = $_POST['contenido'];
        $usuario = $_SESSION["id"];
        $activo = 1;
        $hit = 0;
        $resultado = $this->mysqli->query("INSERT INTO foro_subforos(id_foro, subforo, descripcion) 
            VALUES($foro, '$tema', '$contenido')"); 
        
		echo "<script type='text/javascript'>window.location='index.php?foro=$foro';</script>";
    }
	
	//*****************************************************************
    // LISTAMOS LOS SUBFOROS POR FORO
    //*****************************************************************
    public function addtema($foro, $sub) {
		$tema = htmlentities($_POST['titulo']);
        $contenido = $_POST['contenido'];
        $usuario = $_SESSION["id"];
        $activo = 1;
        $hit = 0;
        $resultado = $this->mysqli->query("INSERT INTO foro_temas(id_foro, id_subforo, titulo, contenido, fecha, id_usuario, activo, hits, created_at, updated_at) 
            VALUES($foro, $sub, '$tema', '$contenido', now(), $usuario, $activo, $hit, now(), now())"); 
		
		echo "<script type='text/javascript'>window.location='index.php?foro=$foro&sub=$sub';</script>";
    }
    //*****************************************************************
    // LISTAMOS LOS SUBFOROS POR FORO
    //*****************************************************************
    public function del($id, $foro, $sub) {
		$id = mysqli_real_escape_string($this->mysqli, $id);
		$resultado = $this->mysqli->query("DELETE FROM comentario_foro WHERE id_tema = $id");
        $resultado = $this->mysqli->query("DELETE FROM foro_temas WHERE id_tema = $id");
		
		echo "<script type='text/javascript'>window.location='index.php?foro=$foro&sub=$sub';</script>";
    }
	//*****************************************************************
    // OBTENEMOS EL TEMA A PARTIR DE LA ID
    //*****************************************************************
    public function temaporid($id) {
		$id = mysqli_real_escape_string($this->mysqli, $id);
		$this->data = array();
		
        $resultado = $this->mysqli->query("SELECT *
            FROM foro_temas
            WHERE id_tema = $id");

        while ( $fila = $resultado->fetch_assoc() ) {
            $this->data[] = $fila;
        }
		
		return $this->data;
    }
}
?>