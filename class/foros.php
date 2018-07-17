<?php
require_once 'conexion.php';

class Foros extends Conexion{
	public $mysqli;

    public function __construct() {
        $this->mysqli = parent::conectar();
    }
    //*****************************************************************
	// LISTAMOS LOS FOROS POR CATEGORIAS
	//*****************************************************************
	public function getForo($categoria){
		$categoria = mysqli_real_escape_string($this->mysqli, $categoria);
		$resultado = $this->mysqli->query("SELECT
			id_foro,
			id_forocategoria,
			foro,
			descripcion
			FROM
			foro_foro
			WHERE
			id_forocategoria = $categoria");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

       if(isset($data)){
        	return $data;
        }
	}
	//*****************************************************************
    // COMPROBAMOS SI EL FORO EXISTE
    //*****************************************************************
    public function checkForo($id) {
		$id = mysqli_real_escape_string($this->mysqli, $id);
        $resultado = $this->mysqli->query("select * from foro_foro WHERE id_foro = $id");
		$registros = $resultado->num_rows;
		
		if($registros != 0) {
			return true;
		}
		else {
			return false;
		}
    }
    //*****************************************************************
    // LISTAMOS LOS FOROS POR ID
    //*****************************************************************
	public function foroporid($id){
		$id = mysqli_real_escape_string($this->mysqli, $id);
		$resultado = $this->mysqli->query("SELECT
			foro_foro.id_foro,
			foro_foro.foro,
			foro_foro.descripcion,
			foro_categoria.categoria,
			foro_foro.id_forocategoria
			FROM
			foro_foro
			INNER JOIN foro_categoria ON foro_foro.id_forocategoria = foro_categoria.id_forocategoria
			WHERE
			foro_foro.id_foro = $id");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        return $data;
	}
    //*****************************************************************
    // AGREGAMOS UN NUEVO FORO
    //*****************************************************************
	public function add() {
		$categoria = htmlentities($_POST['categoria']);
		$titulo = htmlentities($_POST['titulo']);
		$descripcion = htmlentities($_POST['descripcion']);
		// las cadenas llevan comillas simples y los numeros no :) y no se porque jeje
        $resultado = $this->mysqli->query("INSERT INTO foro_foro(id_forocategoria, foro, descripcion) VALUES($categoria, '$titulo', '$descripcion')"); 
        echo "<script type='text/javascript'>window.location='index.php?action=panel';</script>";
	}
    //*****************************************************************
    // ELIMINA UN FORO
    //*****************************************************************
	public function del($id) {
		$id = mysqli_real_escape_string($this->mysqli, $id);
		$resultado = $this->mysqli->query("SELECT * FROM foro_subforos WHERE id_foro = $id");
		
		while( $fila = $resultado->fetch_assoc() ){
            $subforoid = $fila["id_subforo"];
			$r2 = $this->mysqli->query("SELECT * FROM foro_temas WHERE id_subforo = $subforoid");
			
			while( $fila2 = $r2->fetch_assoc() ) {
				$temaid = $fila2["id_tema"];
				
				$this->mysqli->query("DELETE FROM comentario_foro WHERE id_tema = $temaid");
			}
			$this->mysqli->query("DELETE FROM foro_temas WHERE id_subforo = $subforoid");
        }
		
		$this->mysqli->query("DELETE FROM foro_subforos WHERE id_foro = $id");
		
		$this->mysqli->query("DELETE FROM foro_foro WHERE id_foro = $id");
        header("Location: index.php?action=panel");
	}
	//*****************************************************************
    // FUNCION HERMANA QUE LA LLAMAMOS DESDEL LA CLASE CATEGORIAS
    //*****************************************************************
	public function del2($id) {
		$id = mysqli_real_escape_string($this->mysqli, $id);
		$resultado = $this->mysqli->query("SELECT * FROM foro_subforos WHERE id_foro = $id");
		
		while( $fila = $resultado->fetch_assoc() ){
            $subforoid = $fila["id_subforo"];
			$r2 = $this->mysqli->query("SELECT * FROM foro_temas WHERE id_subforo = $subforoid");
			
			while( $fila2 = $r2->fetch_assoc() ) {
				$temaid = $fila2["id_tema"];
				
				$this->mysqli->query("DELETE FROM comentario_foro WHERE id_tema = $temaid");
			}
			$this->mysqli->query("DELETE FROM foro_temas WHERE id_subforo = $subforoid");
        }
		
		$this->mysqli->query("DELETE FROM foro_subforos WHERE id_foro = $id");
		
		$this->mysqli->query("DELETE FROM foro_foro WHERE id_foro = $id");
	}
}
?>