<?php
require_once 'conexion.php';
class Subforos extends Conexion{
	public $mysqli;
	public $data;

	public function __construct() {
		$this->mysqli = parent::conectar();
		$this->data = array();
	}
	//*****************************************************************
	// LISTAMOS EL SUBFORO POR FORO
	//*****************************************************************
	public function getSubforo($foro){
		$foro = mysqli_real_escape_string($this->mysqli, $foro);
		$this->data = array(); //Arregla un bug que se producia en el index
		$resultado = $this->mysqli->query("SELECT
			id_subforo,
			id_foro,
			subforo,
			descripcion
			FROM
			foro_subforos
			WHERE
			id_foro = $foro");

        while ( $fila = $resultado->fetch_assoc() ) {
            $this->data[] = $fila;
        }
        
        return $this->data;
	}
	//*****************************************************************
    // COMPROBAMOS SI EL SUBFORO EXISTE
    //*****************************************************************
    public function checkSubForo($id) {
		$id = mysqli_real_escape_string($this->mysqli, $id);
        $resultado = $this->mysqli->query("select * from foro_subforos WHERE id_subforo = $id");
		$registros = $resultado->num_rows;
		
		if($registros != 0) {
			return true;
		}
		else {
			return false;
		}
    }
	//*****************************************************************
	// LISTAMOS LOS SUBFOROS POR FORO
	//*****************************************************************
	public function getSubforos($foro, $inicio, $cantTemas){
		$foro = mysqli_real_escape_string($this->mysqli, $foro);
		$this->data = array(); //Arregla un bug que se producia en el index
		$resultado = $this->mysqli->query("SELECT
			id_subforo,
			id_foro,
			subforo,
			descripcion
			FROM
			foro_subforos
			WHERE
			id_foro = $foro
			limit $inicio, $cantTemas");

        while ( $fila = $resultado->fetch_assoc() ) {
            $this->data[] = $fila;
        }
        
        return $this->data;
	}
	//*****************************************************************
	// LISTAMOS TODOS LOS SUBFOROS POR FORO
	//*****************************************************************
	public function TotalSubForos($id){
		$id = mysqli_real_escape_string($this->mysqli, $id);
		$resultado = $this->mysqli->query("SELECT count(*) FROM foro_subforos INNER JOIN foro_foro ON foro_foro.id_foro=foro_subforos.id_foro WHERE foro_subforos.id_foro = $id");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        return $data;
	}
    //*****************************************************************
	// LISTAMOS LOS SUBFOROS POR ID
	//*****************************************************************
	public function subforoporid($id){
		$id = mysqli_real_escape_string($this->mysqli, $id);
		$resultado = $this->mysqli->query("SELECT * FROM foro_subforos WHERE id_subforo = $id");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        return $data;
	}

    //*****************************************************************
    // AGREGAR SUBFOROS
    //*****************************************************************
	public function add() {
		$foro = htmlentities($_POST['foro']);
		$titulo = htmlentities($_POST['titulo']);
		$foro = mysqli_real_escape_string($this->mysqli, $foro);
		$titulo = mysqli_real_escape_string($this->mysqli, $titulo);
        $resultado = $this->mysqli->query("INSERT INTO foro_subforos(id_foro, subforo, descripcion) VALUES($foro, '$titulo', '$titulo')"); 
        echo "<script type='text/javascript'>window.location='panel.php';</script>";
	}

    //*****************************************************************
    // ELIMINAMOS UN SUBFORO
    //*****************************************************************
	public function del($id, $foroid) {
		$id = mysqli_real_escape_string($this->mysqli, $id);
		$foroid = mysqli_real_escape_string($this->mysqli, $foroid);
		$resultado = $this->mysqli->query("SELECT * FROM foro_temas WHERE id_subforo = $id");
		
		while( $fila = $resultado->fetch_assoc() ){
            $tema = $fila["id_tema"];
			$r = $this->mysqli->query("DELETE FROM comentario_foro WHERE id_tema = $tema");
        }
		
		$resultado = $this->mysqli->query("DELETE FROM foro_temas WHERE id_subforo = $id");
		
		$resultado = $this->mysqli->query("DELETE FROM foro_subforos WHERE id_subforo = $id");
        header("Location: index.php?foro=$foroid");
	}
}
?>