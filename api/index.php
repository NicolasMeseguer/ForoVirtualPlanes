<?php 
include 'api.php';
include 'keys.php';
$api = new api();

$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

if($request_uri[0] != '/ForoVirtualPlanes/api/index.php' && $request_uri[0] != '/ForoVirtualPlanes/api/') {
	echo $api->error();
	die();
}

if(!isset($request_uri[1])) {
	$action = 'index';
}
else {
	switch ($request_uri[1]) {
		case (preg_match('/action=checkuser.*/', $request_uri[1]) ? true : false): //Comprueba si un usuario existe, en dicho caso, deuvelve la informacion en un JSON
			$action = 'checkuser';
			break;
		case (preg_match('/action=getcategorias.*/', $request_uri[1]) ? true : false): //Devuelve todas las categorías creadas
			$action = 'getcategorias';
			break;
		case (preg_match('/action=getforos.*/', $request_uri[1]) ? true : false): //Deuvelve todos los foros creados
			$action = 'getforos';
			break;
		case (preg_match('/action=getsubforos.*/', $request_uri[1]) ? true : false): //Devuelve todos los subforos creados
			$action = 'getsubforos';
			break;
		case (preg_match('/action=topposters.*/', $request_uri[1]) ? true : false): //Devuelve los 3 usuarios que más temas han creado
			$action = 'topposters';
			break;
		case (preg_match('/action=topcomments.*/', $request_uri[1]) ? true : false): //Devuelve los 3 usuarios que más han comentado
			$action = 'topcomments';
			break;
		default:
			$action = 'index';
			break;
	}
}

if(isset($_GET['partnerid']) && $_GET['partnerid']) {
	switch ($_GET['partnerid']) {
		case 1:
			$backendsignature = $iesjoseplanesSecretKey;
			break;
		case 2:
			$backendsignature = $ieslopezdevegaSecretKey;
			break;
		//Future partners will be added here
		default:
			$backendsignature = null;
			break;
	}
} else
	$backendsignature = null;


if($action == 'index') {
	echo $api->index();
}
else if($action == 'checkuser') {
	if(!isset($_GET['partnerid']) || !isset($_GET['signature']) || !isset($_GET['timestamp']) || !isset($_GET['userid']) ) {
		echo $api->errorparams();
		die();
	}
	echo $api->checkuser($backendsignature, $_GET['signature'], $_GET['timestamp'], $_GET['userid']);
}
else if($action == 'getcategorias') {
	if(!isset($_GET['partnerid']) || !isset($_GET['signature']) || !isset($_GET['timestamp'])) {
		echo $api->errorparams();
		die();
	}
	echo $api->getcategorias($backendsignature, $_GET['signature'], $_GET['timestamp']);
}
else if($action == 'getforos') {
	if(!isset($_GET['partnerid']) || !isset($_GET['signature']) || !isset($_GET['timestamp'])) {
		echo $api->errorparams();
		die();
	}
	echo $api->getforos($backendsignature, $_GET['signature'], $_GET['timestamp']);
}
else if($action == 'getsubforos') {
	if(!isset($_GET['partnerid']) || !isset($_GET['signature']) || !isset($_GET['timestamp'])) {
		echo $api->errorparams();
		die();
	}
	echo $api->getsubforos($backendsignature, $_GET['signature'], $_GET['timestamp']);
}
else if($action == 'topposters') {
	if(!isset($_GET['partnerid']) || !isset($_GET['signature']) || !isset($_GET['timestamp'])) {
		echo $api->errorparams();
		die();
	}
	echo $api->topposters($backendsignature, $_GET['signature'], $_GET['timestamp']);
}
else if($action == 'topcomments') {
	if(!isset($_GET['partnerid']) || !isset($_GET['signature']) || !isset($_GET['timestamp'])) {
		echo $api->errorparams();
		die();
	}
	echo $api->topcomments($backendsignature, $_GET['signature'], $_GET['timestamp']);
}
?>