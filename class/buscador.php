<?php 
require_once 'conexion.php';

class Buscador extends Conexion {
	
	public $mysqli;

    public function __construct() {
        $this->mysqli = parent::conectar();
    }
	
	public function temas($patron) {
		$patron = mysqli_real_escape_string($this->mysqli, $patron);
		$resultado = $this->mysqli->query("SELECT id_tema, id_foro, id_subforo, titulo FROM foro_temas WHERE titulo LIKE '$patron%'");
		
		$registros = $resultado->num_rows;
		if($registros >= 1 ) {
			while( $fila = $resultado->fetch_assoc() ){
				$data[] = $fila;
			}
		}
		else
			$data = array();
		
        return $data;
	}
}

?>