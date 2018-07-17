<?php
require_once 'conexion.php';

class Categorias extends Conexion {

    public $mysqli;

    public function __construct() {
        $this->mysqli = parent::conectar();
    }
	
    //*****************************************************************
    // LISTAMOS TODAS LAS CATEGORIAS
    //*****************************************************************
    public function getCategorias() {
        $resultado = $this->mysqli->query("select id_forocategoria, categoria from foro_categoria");
        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }
        return $data;
    }
	
	//*****************************************************************
    // LISTAMOS TODAS LAS CATEGORIAS
    //*****************************************************************
    public function checkCat($id) {
		$id = mysqli_real_escape_string($this->mysqli, $id);
        $resultado = $this->mysqli->query("select * from foro_categoria WHERE id_forocategoria = $id");
		$registros = $resultado->num_rows;
		
		if($registros != 0) {
			return true;
		}
		else {
			return false;
		}
    }

    //*****************************************************************
    // AGREGAMOS UNA CATEGORIA
    //*****************************************************************
    public function add() {
        $categoria = htmlentities($_POST['titulo']);
		$categoria = mysqli_real_escape_string($this->mysqli, $categoria);
        $resultado = $this->mysqli->query("INSERT INTO foro_categoria(categoria) VALUES('$categoria')"); 
        echo "<script type='text/javascript'>window.location='index.php?action=panel';</script>";
    }
    
    //*****************************************************************
    // ELIMINAMOS UNA CATEGORIA
    //*****************************************************************
    public function del($id, $foros) {
		$id = mysqli_real_escape_string($this->mysqli, $id);
		$resultado = $this->mysqli->query("SELECT * FROM foro_foro WHERE id_forocategoria = $id");
		
		while( $fila = $resultado->fetch_assoc() ){
            $foroid = $fila["id_foro"];
			$foros->del2($foroid);
        }
		
        $this->mysqli->query("DELETE FROM foro_categoria WHERE id_forocategoria = $id");
        header("Location: index.php?action=panel");
    }
	
	//*****************************************************************
    // GET CATEGORIA POR ID
    //*****************************************************************
    public function categoriaporid($id) {
		$id = mysqli_real_escape_string($this->mysqli, $id);
        $resultado = $this->mysqli->query("SELECT * FROM foro_categoria WHERE id_forocategoria = $id");
		
        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }
        return $data;
    }

}