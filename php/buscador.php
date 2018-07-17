<?php
require_once '../class/buscador.php';
if(isset($_GET['patron'])) {
	$patron = htmlentities($_GET['patron']);
	$objBuscador = new Buscador();
	echo json_encode($objBuscador->temas($patron));
}
else
	echo "No has pasado los parámetros correctos. Debes pasar 'patron'";
?>