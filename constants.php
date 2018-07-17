<?php
//Cantidad de temas:
$cantTemas = 5;

//Clave de cifrado para la firma
$salt = md5(time().'ForoVirtualPlanesNicolasAntonioTobias'.rand(0, 100000));

define('PX_555923_XD','emailpassword');
define('EMAIL','email@email.com');


function checkform($nombre,$usuario,$pass){
	if(strlen($nombre) <3 || strlen($nombre > 15) || strlen($usuario)<3 || strlen($usuario)>15 || strlen($pass)<5 || strlen($pass)>20)
		$resultado = 0;
	else 
		$resultado = 1;
	return $resultado;
}
function checkprofile($nombre,$correo,$facebook,$twitter,$firma){
	if(strlen($nombre) > 20 || strlen($correo) > 40 || strlen($facebook) > 40 || strlen($twitter) > 40 || strlen($firma) > 40 || strlen($nombre) < 2 || strlen($correo) < 5 )
		$resultado = 0;
	else
		$resultado = 1;
	return $resultado;
}
?>