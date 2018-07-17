<?php
ob_start();
session_start();
//Include las clases
require_once 'class/categorias.php';
require_once 'class/foros.php';
require_once 'class/subforos.php';
require_once 'class/temas.php';
require_once 'class/comentarios.php';
require_once 'class/sesion.php';
require_once 'class/usuarios.php';
require_once 'PHPMailer/PHPMailerAutoload.php';
include 'constants.php';
include 'translations.php';

//Incluimos la vista y el modelo
require_once 'view.php';
require_once 'model.php';

date_default_timezone_set('Europe/Madrid');

//El idioma lo primero de todo, antes del head por si el usuario cambia
if(!isset($_SESSION['lang'])) {
	if(isset($_GET['lang'])) {
		if(in_array($_GET['lang'], $translations['allowedLanguages'])) {
			$_SESSION['lang']=$translations[$_GET['lang']];
			$_SESSION['langst']=$_GET['lang'];
		}
		else {
			$_SESSION['lang']=$translations['es'];
			$_SESSION['langst']='es';
		}
	}
	else {
		$_SESSION['lang']=$translations['es'];
		$_SESSION['langst']='es';
	}
}
else if(isset($_SESSION['lang']) && isset($_GET['lang']) && $_GET['lang'] && in_array($_GET['lang'], $translations['allowedLanguages'])) {
	$_SESSION['lang']=$translations[$_GET['lang']];
	$_SESSION['langst']=$_GET['lang'];
}

head(); //Cabecera de la página

//Creacion de objetos cada uno de cada clase para llamarlos más tarde en caso de ser necesario
$objCategorias = new Categorias();
$objForos = new Foros();
$objSubForos = new Subforos();
$objTemas = new Temas();
$objComentarios = new Comentarios();
$objUsuarios = new Usuarios();
$objSesion = new Sesion();

if(isset($_GET['cat']) && $_GET['cat']) {
	if(!$objCategorias->checkCat($_GET['cat'])) {
		$_SESSION['error']=true;
		header("Location: index.php");
	}
}

if(isset($_GET['foro']) && $_GET['foro']) {
	if(!$objForos->checkForo($_GET['foro'])) {
		$_SESSION['error']=true;
		header("Location: index.php");
	}
}

if(isset($_GET['sub']) && $_GET['sub']) {
	if(!$objSubForos->checkSubForo($_GET['sub'])) {
		$_SESSION['error']=true;
		header("Location: index.php");
	}
}

if(isset($_GET['temaid']) && $_GET['temaid']) {
	if(!$objTemas->checkTema($_GET['temaid'])) {
		$_SESSION['error']=true;
		header("Location: index.php");
	}
}

if(isset($_GET['comentarioid']) && $_GET['comentarioid']) {
	if(!$objComentarios->checkComentario($_GET['comentarioid'])) {
		$_SESSION['error']=true;
		header("Location: index.php");
	}
}

if(isset($_GET['userid']) && $_GET['userid']) {
	if(!$objUsuarios->checkUser($_GET['userid'])) {
		$_SESSION['error']=true;
		header("Location: index.php");
	}
}

if(isset($_SESSION['id']) && isset($_SESSION['nombre']) && isset($_GET['logout']) && $_GET['logout'] == 'true') {
	$lang = $_SESSION['langst'];
	session_destroy();
	header("Location: index.php?lang=$lang");
}

if(isset($_SESSION['error']) && $_SESSION['error']==true){
	unset($_SESSION['error']);
	error(); //Vista de error.
	foot();
	die();
}
//Función de búsqueda
if(isset($_POST['search']) && $_POST['search']) {
	$busqueda = htmlentities($_POST["busqueda"]); 
	$resultado = $objTemas->buscar($busqueda);
	
	viewbusqueda($resultado);
}
//Confirmación registro mail
else if(isset($_GET['action']) && $_GET['action']=='enableaccount' && isset($_GET['token']) && $_GET['token']) {
	if($objUsuarios->checkToken($_GET['token'])) {
		$objUsuarios->activarUser($_GET['token']);
		cuentaactivada();
	}
	else {
		$_SESSION['error']=true;
		header("Location: index.php");
	}
}
//Enviamos el correo necesario para activar la cuenta de usuario
else if(isset($_GET['action']) && $_GET['action']=='aceptaemail' && isset($_SESSION['redirect']) && $_SESSION['redirect']==true) {
	$correo = $_SESSION['correo'];
	$token = $_SESSION['token'];
	
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 0;
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = EMAIL;
	$mail->Password = PX_555923_XD;

	$mail->SMTPSecure = 'tls';
	$mail->Port = 587;

	$mail->setFrom('portfoliomessageservice@gmail.com', 'ForoVirtualPlanes');
	$mail->addAddress($correo, 'ForoVirtualPlanes');
	$mail->Subject  = $_SESSION['lang']['mail_sub'];
	$mail->Body     = '<table cellspacing="0" cellpadding="10" border="0" style="width: 700px; margin: 0 auto;"><tr><td style="background-color:#FFFFFF;"><table cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td width="700" height="250" style=""><img width="700" height="250" src="http://www.nicolasmeseguer.com/ForoVirtualPlanes/img/slide1.jpg" alt="IESJosePlanes"/></td></tr></table><table cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td width="700" height="80" style="padding-top:8px;padding-bottom:8px;background-color:#FFFFFF;"><h1 style="font-family:verdana;font-size:26px;color:#187aa7;text-align:center;margin:0px;margin-right:10px;margin-top:15px;padding:0px;">Foro Virtual Planes</h1></td></tr></table><table cellspacing="0" cellpadding="0" border="0"><tr><td width="50" style="background-color:#FFFFFF;"></td><td width="600" style="background-color:#FFFFFF;padding-top:15px;"><p style="font-family:verdana;font-size:16px;text-align:justify;color:#21374f;margin:0px;margin-left:25px;margin-right:25px;margin-top:8px;margin-bottom:20px;padding:0px">'.$_SESSION['lang']['mail_body'].'</p></td><td width="50" style="background-color:#FFFFFF;"></td></tr></table><table cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td width="700" height="15" style="background-color:#FFFFFF;"></td></tr></table><table cellpadding="0" cellspacing="0" align="center"><tr><td width="300" align="center" style="background: #88de0f; font-family: arial,sans-serif; font-weight: bold; font-size: 24px; text-transform: uppercase;"><a href="http://www.nicolasmeseguer.com/ForoVirtualPlanes/index.php?action=enableaccount&token='.$token.'" style="text-decoration: none; color: #fff; display: inline-block; border-top: 14px solid #88de0f; border-bottom: 15px solid #88de0f; text-align:center; border-right: 20px solid #88de0f; border-left: 20px solid #88de0f; border-radius: 7px;">'. $_SESSION['lang']['mail_accept'] .'</a></td></tr></table><table cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td width="700" height="15" style="background-color:#FFFFFF;"></td></tr></table><table cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td width="700" height="175" style=""><img src="http://www.nicolasmeseguer.com/ForoVirtualPlanes/img/slide4.jpg" alt="game" width="700" height="175"/></td></tr></table><table cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td width="700" height="15" style="background-color:#FFFFFF;"></td></tr></table><table cellspacing="0" cellpadding="0" border="0"><tr><td width="235" height="90" style="background-color:#FFFFFF;"></td><td width="235" height="90" style="background-color:#FFFFFF;"></td></tr></table><table cellspacing="0" cellpadding="0" border="0" width="700"><tr><td width="700" height="10" style="background-color:#FFFFFF;"></td></tr></table><table cellspacing="0" cellpadding="0" border="0"><tr><td width="80" style="background-color:#FFFFFF;"></td><td width="510" style="background-color:#FFFFFF;padding-top:15px;"><p style="font-family:verdana;color:#21374f;font-size:12px;text-align:center;margin:0px;margin-left:25px;margin-right:25px;margin-top:12px;margin-bottom:20px;padding:0px">Foro Virtual Planes, Nicolás Meseguer, Tobias Bachmann, Antonio Paredes</p><td width="110" style="background-color:#FFFFFF;"></td></tr></table><table cellspacing="0" cellpadding="0" border="0" width="700"><tr><td width="700" height="30" style="background-color:#FFFFFF;text-align: center;padding: 5px 0px 5px 0px;"><a href="https://www.facebook.com/forovirtualplanes" target="_blank"><img src="https://plopx.s3.amazonaws.com/eMails/2015_Email_Campaign/KNB/GeneralImg/FB_Logo.png" width="25" height="25" alt="" style="margin: 0px 5px 0px 5px;"/></a><a href="https://twitter.com/forovirtualplanes" target="_blank"><img src="https://plopx.s3.amazonaws.com/eMails/2015_Email_Campaign/KNB/GeneralImg/Twitter_logo_blue.png" width="31" height="25" alt="" style="margin: 0px 5px 0px 5px;"/></a><a href="https://www.google.es" target="_blank"><img src="https://plopx.s3.amazonaws.com/eMails/2015_Email_Campaign/KNB/GeneralImg/GooglePlus.png" width="25" height="25" alt="" style="margin: 0px 5px 0px 5px;"/></a></td></tr></table></td></tr></table>';
	$mail->IsHTML(true);
	$mail->send();
	
	emailview($correo);
	unset($_SESSION['correo']);
	unset($_SESSION['redirect']);
	unset($_SESSION['token']);
}
//Enviar un correo de recuperación de contraseña
else if(isset($_GET['action']) && $_GET['action']=='forgot' && !isset($_SESSION['id'])) {
	if(isset($_POST['enviar'])) {
		if($objUsuarios->checkEmail($_POST['email']) && $objUsuarios->checkActive($_POST['email'])) {
			$usersignature = $objUsuarios->getSignature($_POST['email']);
			
			$nick = $usersignature['nick'];
			$signature = $usersignature['signature'];
			$now = time();
			
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPDebug = 0;
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->Username = EMAIL;
			$mail->Password = PX_555923_XD;

			$mail->SMTPSecure = 'tls';
			$mail->Port = 587;

			$mail->setFrom('portfoliomessageservice@gmail.com', 'ForoVirtualPlanes');
			$mail->addAddress($_POST['email'], 'ForoVirtualPlanes');
			$mail->Subject  = $_SESSION['lang']['mail_password']." ".$nick;
			$mail->Body     = $_SESSION['lang']['mail_password_body']." http://www.nicolasmeseguer.com/ForoVirtualPlanes/index.php?action=recoverpassword&signature=".$signature."&timestamp=".$now;
			$mail->send();
		}
		emailenviado();
	}
	else {
		loginview();
	}
}
//Mostramos el formulario para cambiar la contraseña y le actualizamos la contraseña al usuario
else if(isset($_GET['action']) && $_GET['action']=='recoverpassword' && !isset($_SESSION['id']) && isset($_GET['signature']) && isset($_GET['timestamp']) && $_GET['signature'] && $_GET['timestamp']) {
	if($objUsuarios->checkSignature($_GET['signature']) && !(time() - 86400 > $_GET['timestamp'])) {
		if(isset($_POST['enviar'])) {
			if($_POST['password'] != $_POST['password-repeat']) {
				passwordresetview($_SESSION['lang']['password_notequal']);
			}
			else {
				$nuevasignature = $salt;
				$newpassword = md5($_POST["password"].$salt);
				$objUsuarios->updatePassword($nuevasignature, $newpassword, $_GET['signature']);
				loginview();
			}
		}
		else
			passwordresetview();
	}
	else {
		errormailview();
		foot();
		die();
	}
}
//Modificamos los niveles de usuario
else if(isset($_GET['action']) && $_GET['action']=='downgradeadmin' && isset($_GET['userid']) && $_GET['userid'] && isset($_SESSION['id']) && $_SESSION['privileges']=='master') {
	if($_SESSION['id'] != $_GET['userid']) {
		$usuario = $objUsuarios->usuariosid($_GET['userid']);
		if($usuario[0]["privileges"]=="admin") {
			if(isset($_POST['guardar'])) {
				$objUsuarios->downgradeuser($_GET['userid']);
			}
			downgradeview($usuario);
		}
		else
			echo "Este usuario no es un administrador. </br>";
	}
	else
		echo "No puedes revocarte privilegios a tí mismo.</br>";
}
else if(isset($_GET['action']) && $_GET['action']=='upgradeadmin' && isset($_GET['userid']) && $_GET['userid'] && isset($_SESSION['id']) && ( $_SESSION['privileges']=='master' || $_SESSION['privileges']=='admin' )) {
	if($_SESSION['id'] != $_GET['userid']) {
		$usuario = $objUsuarios->usuariosid($_GET['userid']);
		if($usuario[0]["privileges"]!="admin") {
			if(isset($_POST['guardar'])) {
				$objUsuarios->upgradeuser($_GET['userid']);
			}
			upgradeview($usuario);
		}
		else
			echo "Este usuario ya es un administrador. </br>";
	}
	else
		echo "No puedes concederte beneficios a tí mismo cuando ya lo eres.</br>";
}
//Damos permisos de borrar temas comentarios etc si posees el rango necesario
else if(isset($_GET['action']) && $_GET['action']=='deletecoment' && isset($_SESSION['id'])) {
	if($_GET['userid']==$_SESSION['id'] || ($_SESSION["privileges"]=='admin' || $_SESSION["privileges"]=='master')) {
		$objComentarios->del($_GET["comentarioid"], $_GET["tema"], $_GET["foro"], $_GET["sub"]);
	}
	else {
		echo "Lo siento pero no vas a conseguir eso.";
	}
}
else if(isset($_GET['action']) && $_GET['action']=='deletetema' && isset($_GET["temaid"]) && isset($_GET["foro"]) && isset($_GET["sub"]) && isset($_SESSION['id'])) {
	$temaid = $_GET['temaid'];
	$tema = $objTemas->temaporid($temaid);
	if(( $_SESSION['privileges']=='master' || $_SESSION['privileges']=='admin' ) || ($_SESSION['id']==$tema[0]["id_usuario"])) {
		if(isset($_POST["guardar"])) {
			$objTemas->del($_GET['temaid'], $_GET["foro"], $_GET["sub"]);
		}
		deletetemaview($tema);
	}
}
else if(isset($_GET['action']) && $_GET['action']=='deletesubforo' && isset($_GET["foro"]) && isset($_GET["sub"]) && isset($_SESSION['id']) && isset($_SESSION["privileges"]) && $_SESSION["privileges"]=="master") {
	if(isset($_POST["guardar"])) {
		$objSubForos->del($_GET["sub"], $_GET["foro"]);
	}
	$sforo = $objSubForos->subforoporid($_GET["sub"]);
	deletesubforoview($sforo);
}
else if(isset($_GET['action']) && $_GET['action']=='eliminarforo' && isset($_GET["foro"]) && isset($_GET["cat"]) && isset($_SESSION['id']) && isset($_SESSION["privileges"]) && $_SESSION["privileges"]=="master") {
	if(isset($_POST["guardar"])){
		$objForos->del($_GET['foro']);
	}
	$foro = $objForos->foroporid($_GET["foro"]);
	deleteforoview($foro);
}
else if(isset($_GET['action']) && $_GET['action']=='eliminarcategoria' && isset($_GET["cat"]) && isset($_SESSION['id']) && isset($_SESSION["privileges"]) && $_SESSION["privileges"]=="master") {
	if(isset($_POST["guardar"])) {
		$objCategorias->del($_GET['cat'], $objForos);
	}
	$categoria = $objCategorias->categoriaporid($_GET["cat"]);
	deletecategoriaview($categoria);
}
//Permiso de borrar usuario, excepto tu mismo !!
else if(isset($_GET['action']) && $_GET['action']=='eliminaruser' && isset($_GET['userid']) && $_GET['userid'] && isset($_SESSION['id']) && $_SESSION['privileges']=='master') {
	if($_SESSION['id'] != $_GET['userid']) {
		$usuario = $objUsuarios->usuariosid($_GET['userid']);
		if (isset($_POST['guardar'])) {
			$objUsuarios->del($_GET['userid']);
		}
		eliminaruser($usuario);
	}
	else
		echo "No puedes borrar tu propio usuario.<br/>";
}
else if(isset($_GET['action']) && $_GET['action']=='eliminarcuenta' && isset($_GET['userid']) && $_GET['userid'] && isset($_SESSION['id']) && $_GET['userid']==$_SESSION['id']) {
		$usuario = $objUsuarios->usuariosid($_GET['userid']);
		if (isset($_POST['guardar'])) {
			$objUsuarios->del($_GET['userid']);
			$lang = $_SESSION['langst'];
			session_destroy();
			header("Location: index.php?lang=$lang");
		}
		eliminaracc($usuario);
}
//Mostramos los posts de un usuario siendo admin o master
else if(isset($_GET['action']) && $_GET['action']=='vertemasusuario' && isset($_SESSION['id']) && ( $_SESSION['privileges']=='admin' || $_SESSION['privileges']=='master') && isset($_GET['userid'])) {
	$usuarios = $objUsuarios->usuariotemas($_GET["userid"]);
	
	temasusuarioview($usuarios);
}
else if(isset($_GET['action']) && $_GET['action']=='usuarios' && isset($_SESSION['id']) && ( $_SESSION['privileges']=='admin' || $_SESSION['privileges']=='master')) {
	
	$usuarios = $objUsuarios->usuarios();
	
	usuariosview($usuarios, $objTemas, $objComentarios);
}
//Mostramos el panel
else if(isset($_GET['action']) && $_GET['action']=='panel' && isset($_SESSION['id']) && ( $_SESSION['privileges']=='admin' || $_SESSION['privileges']=='master')) {
	
	if (isset($_POST['categorianueva'])) {
        $objCategorias->add();
    }
	
    if (isset($_POST['foronuevo'])) {
        $objForos->add();
    }
	
	$categorias = $objCategorias->getCategorias();
	
	panelview($categorias, $objForos, $objSubForos);
}
// Creamos temas, subforos etc
else if(isset($_GET['action']) && $_GET['action']=='createtema' && isset($_GET['foro']) && isset($_GET['sub']) && isset($_SESSION['id']) && isset($_SESSION['nombre'])) {
	$foroid = $_GET['foro'];
	$subid = $_GET['sub'];
	
	if(isset($_POST['guardar']) && strlen($_POST['titulo'])<100 && strlen($_POST['titulo'])>0 && strlen(strip_tags ($_POST['contenido']))>16 && strlen(strip_tags($_POST['contenido']))<2500)  {
		$objTemas->addtema($foroid, $subid);
	}

	$foro = $objForos->foroporid($foroid);
	$subforo = $objSubForos->subforoporid($subid);
	
	creartemaview($foroid, $subid, $foro, $subforo);
}
else if(isset($_GET['action']) && $_GET['action']=='createsubforo' && isset($_GET['foro']) && isset($_SESSION['id']) && isset($_SESSION['nombre']) && ( $_SESSION['privileges']=='admin' || $_SESSION['privileges']=='master')) {
	$foroid = $_GET['foro'];
	if(isset($_POST['guardar'])) {
		if($_POST['foroid'] != $foroid) {
			$_SESSION['error']=true;
			header("Location: index.php");
		}
		else
			$objTemas->add($foroid);
	}
	
	$foro = $objForos->foroporid($foroid);
	
	newsuboforoview($foro);
}
//Pantalla para editar nuestro perfil
else if(isset($_GET['userid']) && $_GET['userid']) {
	$uid = $_GET['userid'];
	if(isset($_SESSION['id']) && isset($_SESSION['nombre']) && $_SESSION['id'] == $uid) {
		if(isset($_POST['guardar']) && checkprofile($_POST['nombre'],$_POST['correo'],$_POST['facebook'],$_POST['twitter'], $_POST['firma'])) {
			$objUsuarios->update($_SESSION["id"]);
		}
		$u = $objUsuarios->usuariosid($_SESSION['id']);
		editperfilview($u);
	}
	else {
		$u = $objUsuarios->usuariosid($uid);
		perfilview($u);
	}
}
//Modificamos nuestro avatar
else if(isset($_GET['change']) && $_GET['change']=='foto' && isset($_SESSION['id']) && isset($_SESSION['nombre'])) {
	$uid = $_SESSION['id'];
	if(isset($_POST['guardar']) && isset($_FILES['foto']['type']) && ($_FILES['foto']['type'] == "image/jpeg") || isset($_FILES['foto']['type']) && ($_FILES['foto']['type'] == "image/png" )) {
		$objUsuarios->updateavatar($_SESSION["id"]);
	}
	$u = $objUsuarios->usuariosid($uid);
	fotoview($u);
}
//Control de estadisticas
else if(isset($_GET["temaid"]) && isset($_GET["foro"]) && isset($_GET["sub"])) {
	$temaid = $_GET["temaid"];
	$foroid = $_GET["foro"];
	$subid = $_GET["sub"];
	
	if(isset($_POST['guardar']) && strlen(strip_tags($_POST['comentario']))>16 && strlen(strip_tags($_POST['comentario']))<2500) {
		$objComentarios->add($temaid, $foroid, $subid);
	}
	
	$objTemas->hits($temaid);
	
	$tema = $objTemas->tema($temaid);
	
	$foro = $objForos->foroporid($foroid);
	$sub = $objSubForos->subforoporid($subid);
	$comentarios = $objComentarios->comentarios($temaid);
	
	temaview($temaid, $foroid, $subid, $tema, $foro, $sub, $comentarios);
}
//Mostramos los subforos dentro de un foro con sus temas correspondientes
else if(isset($_GET['foro'])) {
	if(isset($_GET['sub'])) {
		
		$foroid = $_GET['foro'];
		$subforoid = $_GET['sub'];
		
		$foro = $objForos->foroporid($foroid);
		$subforo = $objSubForos->subforoporid($subforoid);
		
		if (isset($_GET["pos"]))
            $inicio = $_GET["pos"];
        else
            $inicio = 0;
		
		$proxima = $inicio + $cantTemas;
        $datos = $objTemas->getsubTemas($subforoid, $inicio, $cantTemas);
        $total = (int)$objTemas->TotalsubTemas($subforoid);
        $cantPag = $total / $cantTemas;
		
		if (isset($_GET["pos"]) and $_GET["pos"] > 0)
            $actual = $_GET["pos"] / $cantTemas + 1;
        else
            $actual = 1;
		
		subforoview($foro, $subforo, $inicio, $proxima, $total, $datos, $subforoid, $foroid, $objComentarios, $actual, $cantPag, $cantTemas);
	}
	else {
		if(isset($_GET['sub']))
			$subforoid = $_GET['sub'];
		else
			$subforoid = null;
		
		$foroid = $_GET['foro'];
		$titulo = $objForos->foroporid($foroid);

		if (isset($_GET["pos"]))
			$inicio = $_GET["pos"];
		else
			$inicio = 0;

		$proxima = $inicio + $cantTemas; //defecto = 5
		$datos = $objSubForos->getSubforos($foroid, $inicio, $cantTemas);

		$total = (int)$objSubForos->TotalSubForos($foroid)[0]['count(*)'];
		
		$cantPag = $total / $cantTemas;

		if (isset($_GET["pos"]) and $_GET["pos"] > 0)
			$actual = $_GET["pos"] / $cantTemas + 1;
		else
			$actual = 1;
		foroview($titulo, $foroid, $inicio, $cantTemas, $proxima, $total, $datos, $objComentarios, $subforoid, $actual, $cantPag, $objTemas);
	}
}
//Control de registro y login de usuarios
else if( isset($_GET['action']) && !isset($_SESSION['id']) && ($_GET['action']=='register' || $_GET['action']=='login') ) {
	if($_GET['action']=='register') {
		if(isset($_POST['submit']) && !checkform($_POST['nombre'],$_POST['usuario'],$_POST['clave']))
			errorregisterview();
		elseif(isset($_POST['submit']) && checkform($_POST['nombre'],$_POST['usuario'],$_POST['clave'])) {
			$objUsuarios->nuevousuario($salt);
		}
		else
			registerview();	
	}
	else {
		if(isset($_POST['submit']))
			$objSesion->logueo();
		else
			loginview();	
	}
}
//Enlaces a vistas del footer
else if(isset($_GET['action']) && ($_GET['action']=='policy')){
	policyview();
}
else if(isset($_GET['action']) && ($_GET['action']=='licencias')){
	licenciasview();
}
else if(isset($_GET['action']) && ($_GET['action']=='contacto')){
	contactoview();
}
//Default index
else {
	$categorias = $objCategorias->getCategorias();
	index($categorias, $objForos, $objSubForos, $objTemas, $objComentarios, $objUsuarios);
}

foot();
ob_end_flush();
?>