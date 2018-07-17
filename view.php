	<?php

function head() {
	?>
		<!DOCTYPE html>
		<html lang="es">
			<head>
				<title>Foro Virtual Planes</title>
				<meta charset="UTF-8">
				<meta name="viewport" content="width=device-width">


				<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
				<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">


				<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
				<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
				<link href="css/estilo.css" rel="stylesheet" type="text/css" title="Estilo 1">
				<link href="css/estilo2.css" rel="stylesheet" type="text/css" title="Estilo 2">
				<link href="css/estilo3.css" rel="stylesheet" type="text/css" title="Estilo 3">
				<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=4g7tzopsi1ptf0xwzztwheh5rb2pjhgvamgfkxxqkkcq4uim"></script>
				<script>
				
				var puginList = ""
				var toolbarList = "";
				
				if(!(screen.width <= 576))
				{
					var puginList = "fullpage powerpaste emoticons searchreplace autolink directionality  visualblocks visualchars fullscreen image link media   table charmap hr insertdatetime advlist lists textcolor wordcount tinymcespellchecker a11ychecker imagetools mediaembed  linkchecker contextmenu colorpicker textpattern help"
					var toolbarList = "formatselect | emoticons bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat";
				}
				tinymce.init({
					  selector: 'textarea',
					  theme: 'modern',
					  plugins: puginList,
					  toolbar1: toolbarList,
					  image_dimensions: false,
					  content_css: [
						'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
						'//www.tinymce.com/css/codepen.min.css'
						]
						});
						
		 </script>
		 <noscript>
		  <h4><?php echo $_SESSION['lang']['jsenable'] ?></h4>
		</noscript>
			</head>
			<body>
				<div id="CajaPrincipal" <?php echo (isset($_GET['action']) && ($_GET['action'] == 'panel' || $_GET['action'] == 'usuarios'))? "": 'class="container-fluid"'; ?>>
				<div <?php echo (isset($_GET['action']) && ($_GET['action'] == 'panel' || $_GET['action'] == 'usuarios'))? "style='width:1000px;margin:auto'": 'class="row justify-content-xs-center justify-content-md-center justify-content-lg-center"'; ?>>
				<div <?php echo (isset($_GET['action']) && ($_GET['action'] == 'panel' || $_GET['action'] == 'usuarios'))? "": 'class="col-12 col-sm-12 col-lg-8"'; ?>>
					<div class="cajaHeader row">
						<div class="cajaBuscar col-12 col-lg-6">
							<form class="row" action='index.php' autocomplete="off" method='post'>
								<input class="form-control col-6" type='text' id="buscador" placeholder="<?php echo $_SESSION['lang']['search_placeholder'] ?>" name='busqueda' required="required">&nbsp;
								<input  class="btn btn-success"type='submit' name='search' value='<?php echo $_SESSION['lang']['search_button'] ?>' class="btn">
							</form>
							<div id="buscador-resultados" class="col-6" style="position:absolute;top:39px;left:0px;background-color:white;z-index:99">
								
							</div>
						</div>
						<div class="cajaRegistro col-12 col-lg-6">
							<?php echo $_SESSION['lang']['welcome'] ?>: 
							<?php
							if (isset($_SESSION["id"])) {
								?>
								<a href="<?php echo Conexion::ruta(); ?>?userid=<?php echo $_SESSION['id'] ?>"><?php echo $_SESSION["nombre"]; ?></a> | 
								<?php
								if ($_SESSION["privileges"] == "admin" || $_SESSION["privileges"] == "master") {
									?>
									<a href="<?php echo Conexion::ruta(); ?>?action=panel"><?php echo $_SESSION['lang']['panel'] ?></a> | <a href="<?php echo Conexion::ruta(); ?>?action=usuarios"><?php echo $_SESSION['lang']['list_users'] ?></a> | 
									<?php
								}
								?>
								<a href="<?php echo Conexion::ruta(); ?>?logout=true"><?php echo $_SESSION['lang']['logout'] ?></a>
								<?php
							} else {
								?><a href="<?php echo Conexion::ruta(); ?>?action=register"><?php echo $_SESSION['lang']['register'] ?></a> | <a href="<?php echo Conexion::ruta(); ?>?action=login"><?php echo $_SESSION['lang']['login'] ?></a><?php
							}
							?>
						</div>

						<div style="clear:both; height:1px;font-size:0px; line-height: 0px;"></div>
						
					</div>
					
					<div id="lang_selector" class="language-dropdown">
					  <label for="toggle" class="lang-flag lang-<?php echo $_SESSION['langst']; ?>">
						<span class="flag"></span>
					  </label>
					  <ul class="lang-list">
						<li class="lang lang-es <?php if($_SESSION['langst']=='es') echo 'selected'; ?>" title="ES">
						  <span class="flag"></span>
						</li>
						<li class="lang lang-de <?php if($_SESSION['langst']=='de') echo 'selected'; ?>" title="DE">
						  <span class="flag"></span>
						</li>
						<li class="lang lang-en <?php if($_SESSION['langst']=='en') echo 'selected'; ?>" title="EN">
						  <span class="flag"></span>
						</li>
						<li class="lang lang-fr <?php if($_SESSION['langst']=='fr') echo 'selected'; ?>" title="FR">
						  <span class="flag"></span>
						</li>
					  </ul>
					</div>
					
					<div class="cajaBanner col-12">

					</div>



					<div class="cajaTitulo col-12">


						<h4><a href="<?php echo Conexion::ruta(); ?>"><?php echo $_SESSION['lang']['welcome_foro'] ?></a></h4>

					</div>
	<?php
}

function foot() {
	?>
	</div>
	</div>
	<div class="clear"></div><!--El citado div para evitar problemas con "flotaciones"-->
				</div>
				
				<div class="footer col-12 d-flex justify-content-center">
					
						<div class="row justify-content-xs-center justify-content-md-center justify-content-lg-center align-self-center">
							<div class="col-12 text-center">
								<label><i class="fab fa-instagram" style="font-size:3rem;color:#0096a1"></i></label>
								<a href="https://es-es.facebook.com/IesJosePlanes/"><label><i class="fab fa-facebook"  style="font-size:3rem;color:#0096a1"></i></label></a>
								<a href="https://twitter.com/iesjoseplanes"><label><i class="fab fa-twitter" style="font-size:3rem;color:#0096a1"></i></label></a>
								<label><i class="fab fa-youtube" style="font-size:3rem;color:#0096a1"></i></label>
							</div>
							<div class="col-12 text-center "> 
								<p>Foro Virtual Planes CC 2018</p>
								<p class="linkfooter"><a href="index.php?action=policy"><?php echo $_SESSION['lang']['privacidad']?></a> | <a href="index.php?action=licencias"><?php echo $_SESSION['lang']['licenciaslink']?></a> |	<a href="index.php?action=contacto"><?php echo $_SESSION['lang']['contactolink']?></a></p>
							</div>
						</div>	
				</div>

				</div>
				</div>
				<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
				<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
				<script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
				<script src="js/scripts.js"></script>
				<script>
					$(document).ready(function(){
						
						var val = null;
						
						$(".lang-flag").click(function(){
							$(".language-dropdown").toggleClass("open");
						});
					  
						$("ul.lang-list li").click(function(){
							$("ul.lang-list li").removeClass("selected");
							$(this).addClass("selected");
							
							if(window.location.href.indexOf("?")==-1)
								val = 2;
							else
								val = 1;
							
							
							if($(this).hasClass('lang-en')){
								$(".language-dropdown").find(".lang-flag").addClass("lang-en").removeClass("lang-es").removeClass("lang-de").removeClass("lang-fr");
								if(val == 1)
									window.location=window.location.href+'&lang=en';
								else
									window.location=window.location.href+'?lang=en';
							}else if($(this).hasClass('lang-de')){
								$(".language-dropdown").find(".lang-flag").addClass("lang-de").removeClass("lang-de").removeClass("lang-de").removeClass("lang-fr");
								if(val == 1)
									window.location=window.location.href+'&lang=de';
								else
									window.location=window.location.href+'?lang=de';
							}else if($(this).hasClass('lang-es')){
								$(".language-dropdown").find(".lang-flag").addClass("lang-es").removeClass("lang-en").removeClass("lang-de").removeClass("lang-fr");
								if(val == 1)
									window.location=window.location.href+'&lang=es';
								else
									window.location=window.location.href+'?lang=es';
							}else {
								$(".language-dropdown").find(".lang-flag").addClass("lang-fr").removeClass("lang-es").removeClass("lang-de").removeClass("lang-en");
								if(val == 1)
									window.location=window.location.href+'&lang=fr';
								else
									window.location=window.location.href+'?lang=fr';
							}
							$(".language-dropdown").removeClass("open");
						});
					});
				</script>
			</body>
		</html>
	<?php
}

function index($categorias, $objForos, $objSubForos, $objTemas, $objComentarios, $objUsuarios) {
	?>
	<?php
	foreach ($categorias as $cat) {
		?>
		<div class="caja" id="<?php echo $cat["categoria"]; ?>">
			<div class="categorias row">
				<div class="col-12">
				<a href="#" name="<?php echo $cat["categoria"]; ?>"></a><?php echo $cat["categoria"]; ?>
				</div>
			</div>
			<?php
			$foros = $objForos->getForo($cat["id_forocategoria"]);
			if(sizeof($foros)>0){
				foreach ($foros as $foro) {
					?>
					<div class="row foro" name="<?php echo $foro["foro"]; ?>">
						<div class="foro_icono col-1 col-sm-1 col-lg-1">
							<i class="fa fa-comments" style="font-size:1.5rem;color:blue"></i>
						</div>
						<div class="foro_titulo col-11 col-sm-7 col-lg-6">
							
							<ul>
								<li><a href="<?php echo Conexion::ruta(); ?>?foro=<?php echo $foro["id_foro"]; ?>"><i style="color:rgba(0, 204, 102,0.8)">&#10148;</i>&nbsp;<?php echo $foro["foro"]; ?></a></li>
								<?php
								$subforos = $objSubForos->getSubforo($foro["id_foro"]);
								foreach ($subforos as $sforo) {
									?>
									<li><a href="<?php echo Conexion::ruta(); ?>?foro=<?php echo $sforo["id_foro"]; ?>&sub=<?php echo $sforo["id_subforo"]; ?>">
											<i style="color:rgba(0, 204, 102,0.4)">&#10149;</i>&nbsp;<?php echo $sforo["subforo"]; ?></a>
									</li>
									<?php
								}
								?>
							</ul>
						</div>
						<div class="temas_mensajes col-lg-2 d-none d-lg-block">
							<?php
								$total = $objTemas->TotalTemas($foro["id_foro"]);
							?>
							<?php echo $_SESSION['lang']['index_posts'] ?>: <strong><?php echo $total; ?></strong><br>

							<?php
								$totalcom = $objComentarios->TotalComentariosForo($foro["id_foro"]);
							?>
							<?php echo $_SESSION['lang']['index_messages'] ?>: <strong><?php echo $totalcom; ?></strong><br>
						</div>
						<div class="ultimocomentario col-sm-3 col-lg-3 d-none d-sm-block">
							<?php
								$mensaje = $objComentarios->ultimo_comentario($foro["id_foro"]);
								if (sizeof($mensaje) > 0) {
									echo $_SESSION['lang']['index_post']." - <strong><a href='". Conexion::ruta() ."?temaid=".$mensaje[0]["id_tema"]."&foro=".$foro["id_foro"]."&sub=".$mensaje[0]["id_subforo"]."' >" . $mensaje[0]["titulo"] . "</a></strong><br/>";
									echo $_SESSION['lang']['index_category']." - <strong><a href='". Conexion::ruta() ."?foro=".$mensaje[0]["id_foro"]."&sub=".$mensaje[0]["id_subforo"]."' >". $mensaje[0]["subforo"] ."</a></strong><br/>";
									echo $_SESSION['lang']['index_created_by']." - <strong><a href='".Conexion::ruta()."?userid=".$mensaje[0]['id']."'>" . $mensaje[0]["nick"] . "</a></strong><br/>";
									echo $_SESSION['lang']['index_date']." - <strong>" . $mensaje[0]["fecha"]."</strong>";
								} else {
									echo $_SESSION['lang']['index_noposts'];
								}
							?>
						</div>
						<div class="col-12" style="clear:both; height:1px;font-size:0px; line-height: 0px;"></div>
					</div>
					<?php
				}
			}
			?>
		</div>

		<?php
	}
	?>
	<div class="caja">
		<div class="categorias row"><?php echo $_SESSION['lang']['index_users'] ?></div>
		<div class="col-12">
		<div class="foro">
			<?php
			$usuarios = $objUsuarios->usuarios();
			foreach ($usuarios as $u) {
				if ((time() - 3600) < strtotime($u["ultimoacceso"])) {
					if($u['privileges']== "master"){
						?>
					<a class="masteronline" href="<?php echo Conexion::ruta(); ?>?userid=<?php echo $u["id"]; ?>"><?php echo $u["nick"]; ?>[Master]</a>&nbsp;
					<?php }
					if($u['privileges']=="admin"){
					?><a class="adminonline" href="<?php echo Conexion::ruta(); ?>?userid=<?php echo $u["id"]; ?>"><?php echo $u["nick"]; ?>[Mod]</a>&nbsp;
					<?php }
					if($u['privileges']=="user"){
						?>
					<a class="usersonline" href="<?php echo Conexion::ruta(); ?>?userid=<?php echo $u["id"]; ?>"><?php echo $u["nick"]; ?></a>&nbsp;
					<?php }
				}
			}
			?>
		</div>
		</div>
	</div>
	<?php
}

function error() {
	?>
		<h2><?php echo $_SESSION['lang']['error']; ?></h2>
	<?php
}

function registerview() {
	?>
		<div class="caja">
			<div class="categorias">
				<?php echo $_SESSION['lang']['register_index']; ?>
			</div>
			
			<?php 
				if(isset($_GET["m"])){
					switch ($_GET["m"]) {
						case 1:
							echo "<div class='error'>".$_SESSION['lang']['register_wrong_user']."</div>";
							break;
						case 2:
							echo "<div class='error'>".$_SESSION['lang']['register_wrong_email']."</div>";
							break;
					}
				}
			?>
		<div class="modal-dialog text-center">
		 <div class="col-sm-8 main-section">
		  <div class="modal-content">
		   <div class="col-12 user-img">
			<img src="img/loginimage.png" alt="Imagen logo">
		   </div>
		   <form class="col-12" action="index.php?action=register" autocomplete="off" method="post" class="formulario">
			<div class="form-group">
				<label>
					<?php echo $_SESSION['lang']['register_name']; ?>
				</label>
				<label class="verify" style="display:none">
					<i class="fas fa-check-circle"></i>
				</label>
				<label style="position:absolute;right:0px" title="entre 2 y 15 caracteres">&nbsp;&nbsp;
					<i class="fa fa-question-circle" style="color:rgb(51, 204, 255);font-size:0.8rem"></i>
				</label>
					<input id="formulario_nombre" type="text" name="nombre" pattern=".{2,15}" title="entre 2 y 15 caracteres" placeholder="<?php echo $_SESSION['lang']['register_name']; ?>" required="required" autofocus="autofocus">
			</div>
			<div class="form-group">
				<label>
					<?php echo $_SESSION['lang']['register_email']; ?>
				</label>
				<label class="verify" style="display:none">
					<i class="fas fa-check-circle"></i>
				</label>
				<label style="position:absolute;right:0px" title="e-mail válido">&nbsp;&nbsp;
					<i class="fa fa-question-circle" style="color:rgb(51, 204, 255);font-size:0.8rem"></i>
				</label>
				<input id="formulario_correo" type="email" name="correo" title="e-mail válido" placeholder="<?php echo $_SESSION['lang']['register_email']; ?>" required="required">
			</div>
			<div class="form-group">
				<label>
					<?php echo $_SESSION['lang']['register_user']; ?>
				</label>
				<label class="verify" style="display:none">
					<i class="fas fa-check-circle"></i>
				</label>
				<label style="position:absolute;right:0px" title="entre 2 y 15 caracteres">&nbsp;&nbsp;
					<i class="fa fa-question-circle" style="color:rgb(51, 204, 255);font-size:0.8rem"></i>
				</label>
				<input id="formulario_nombre_usuario" type="text" name="usuario" pattern=".{2,15}" title="entre 2 y 15 caracteres" placeholder="<?php echo $_SESSION['lang']['register_user']; ?>" required="required">
			</div>
			<div class="form-group">
			<label>
				<?php echo $_SESSION['lang']['register_password']; ?>
			</label>
			<label class="verify" style="display:none">
					<i class="fas fa-check-circle"></i>
				</label>
			<label style="position:absolute;right:0px" title="mínimo 5 caracteres">&nbsp;&nbsp;
				<i class="fa fa-question-circle" style="color:rgb(51, 204, 255);font-size:0.8rem"></i>
			</label>
				<input id="formulario_password" type="password" name="clave" pattern=".{5,}" title="mínimo 5 caracteres" placeholder="<?php echo $_SESSION['lang']['register_password']; ?>" required="required">
			</div>
					<br/>
					<button type="submit" name="submit" class="btn-login"><?php echo $_SESSION['lang']['register_submit']; ?></button>
				</form>
		  </div>
		 </div>
		</div>

		</div>
	<?php
}

function errorregisterview() {
	?>
		<div class="caja">
			<div class="categorias">
				<?php echo $_SESSION['lang']['register_index']; ?>
			</div>
			
			<?php 
				if(isset($_GET["m"])){
					switch ($_GET["m"]) {
						case 1:
							echo "<div class='error'>".$_SESSION['lang']['register_wrong_user']."</div>";
							break;
						case 2:
							echo "<div class='error'>".$_SESSION['lang']['register_wrong_email']."</div>";
							break;
					}
				}
			?>
			<div class="alert alert-danger" role="alert"><p style="text-align:center;color:red;font-size:1rem">*Elije un nombre y usuario entre 2 y 15 caracteres, una contraseña minima de 5 caracteres.</p></div>
			<div class="modal-dialog text-center">
		 <div class="col-sm-8 main-section">
		  <div class="modal-content">
		   <div class="col-12 user-img">
			<img src="img/loginimage.png" alt="Imagen logo">
		   </div>
		   <form class="col-12" action="index.php?action=register" autocomplete="off" method="post" class="formulario">
			<div class="form-group">
				<label>
					<?php echo $_SESSION['lang']['register_name']; ?>
				</label>
				<label class="verify" style="display:none">
					<i class="fas fa-check-circle"></i>
				</label>
				<label style="position:absolute;right:0px" title="entre 2 y 15 caracteres">&nbsp;&nbsp;
					<i class="fa fa-question-circle" style="color:rgb(51, 204, 255);font-size:0.8rem"></i>
				</label>
					<input id="formulario_nombre" type="text" name="nombre" pattern=".{2,15}" title="entre 2 y 15 caracteres" placeholder="<?php echo $_SESSION['lang']['register_name']; ?>" required="required" autofocus="autofocus">
			</div>
			<div class="form-group">
				<label>
					<?php echo $_SESSION['lang']['register_email']; ?>
				</label>
				<label class="verify" style="display:none">
					<i class="fas fa-check-circle"></i>
				</label>
				<label style="position:absolute;right:0px" title="e-mail válido">&nbsp;&nbsp;
					<i class="fa fa-question-circle" style="color:rgb(51, 204, 255);font-size:0.8rem"></i>
				</label>
				<input id="formulario_correo" type="email" name="correo" title="e-mail válido" placeholder="<?php echo $_SESSION['lang']['register_email']; ?>" required="required">
			</div>
			<div class="form-group">
				<label>
					<?php echo $_SESSION['lang']['register_user']; ?>
				</label>
				<label class="verify" style="display:none">
					<i class="fas fa-check-circle"></i>
				</label>
				<label style="position:absolute;right:0px" title="entre 2 y 15 caracteres">&nbsp;&nbsp;
					<i class="fa fa-question-circle" style="color:rgb(51, 204, 255);font-size:0.8rem"></i>
				</label>
				<input id="formulario_nombre_usuario" type="text" name="usuario" pattern=".{2,15}" title="entre 2 y 15 caracteres" placeholder="<?php echo $_SESSION['lang']['register_user']; ?>" required="required">
			</div>
			<div class="form-group">
			<label>
				<?php echo $_SESSION['lang']['register_password']; ?>
			</label>
			<label class="verify" style="display:none">
					<i class="fas fa-check-circle"></i>
				</label>
			<label style="position:absolute;right:0px" title="mínimo 5 caracteres">&nbsp;&nbsp;
				<i class="fa fa-question-circle" style="color:rgb(51, 204, 255);font-size:0.8rem"></i>
			</label>
				<input id="formulario_password" type="password" name="clave" pattern=".{5,}" title="mínimo 5 caracteres" placeholder="<?php echo $_SESSION['lang']['register_password']; ?>" required="required">
			</div>
					<br/>
					<button type="submit" name="submit" class="btn-login"><?php echo $_SESSION['lang']['register_submit']; ?></button>
				</form>
		  </div>
		 </div>
		</div>

		</div>
	<?php
}

function loginview() {
	?>
		<div class="caja">
			<div class="categorias">
				<?php echo $_SESSION['lang']['login_index'] ?>
			</div>
			
			<?php
			if (isset($_GET["m"])) {
				switch ($_GET["m"]) {
					case 1:
						echo "<div class='error'>".$_SESSION['lang']['login_error_cred']."</div>";
						break;
					case 2:
						echo "<div class='error'>".$_SESSION['lang']['login_error_sign']."</div>";
						break;
					case 3:
						echo "<div class='error'>".$_SESSION['lang']['new_confirm_email']."</div>";
						break;
				}
			}
			?>
		</div>
			
		<div class="modal-dialog text-center">
		 <div class="col-sm-8 main-section">
		  <div class="modal-content">
		   <div class="col-12 user-img">
			<img src="img/loginimage.png" alt="Imagen logo">
		   </div>
		   <form class="col-12" method="post" autocomplete="off" action="index.php?action=login">
			<div class="form-group">
			 <input type="text" class="form-control" name="usuario" placeholder="<?php echo $_SESSION['lang']['login_user_placeholder'] ?>" required>
			</div>
			<div class="form-group">
			 <input type="password" class="form-control" name="password" placeholder="<?php echo $_SESSION['lang']['login_password_label'] ?>" required>
			</div>
			<button type="submit" name="submit" class="btn-login"><i class="fas fa-sign-in-alt"></i><?php echo $_SESSION['lang']['login_submit'] ?></button>
		   </form>
		   <br>
		   <div class="col-12 forgot">
			<a id="forgotpassoword" href="#"><?= strtoupper($_SESSION['lang']['account_forgot']); ?></a>
		   </div>
		   <div class="col-12 forgot">
			<a href="index.php?action=register"><?php echo $_SESSION['lang']['register']; ?></a>
		   </div>
		  </div>
		 </div>
		</div>
		
		<div id="overlay">
			<div id="overlay-body">
				<div class="modal-dialog text-center">
					<div class="col-sm-8 main-section" style="width: 500px;">
						<div class="modal-content">
							<span id="close-modal" data-dismiss="modal"><a id="close-overlay" style="color: white;" href="#"><i class="far fa-times-circle fa-3x"></i></a></span>
							
							<form class="col-12" method="post" autocomplete="off" action="index.php?action=forgot" style="margin-top: 30px;">
								<div class="form-group password-recover">
									<input type="email" class="form-control" name="email" placeholder="<?php echo $_SESSION['lang']['register_email'] ?>" required>
								</div>
								<button type="submit" name="enviar" class="btn-login"><i class="fas fa-sign-in-alt"></i><?php echo $_SESSION['lang']['account_sendmail'] ?></button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
}

function subforoview($foro, $subforo, $inicio, $proxima, $total, $datos, $subforoid, $foroid, $objComentarios, $actual, $cantPag, $cantTemas) {
	?>
	<div class="row migas">
		<div class="col-12">
			<h5><?php echo $_SESSION['lang']['foro']; ?>: <?php echo $foro[0]["foro"]; ?> | <?php echo $_SESSION['lang']['subforo']; ?>: <?php echo $subforo[0]["subforo"]; ?></h5>
		</div>
		<div class="col-12 col-sm-12 col-lg-6">
			<p><?= $subforo[0]["descripcion"] ?></p>
		</div>
		<div class="col-12 col-sm-12 col-lg-6 text-right">
		<h6>
			<small><a href="<?php echo Conexion::ruta(); ?>"><?php echo $_SESSION['lang']['foros']; ?></a></small> &rarr;
			<small><a href="<?php echo Conexion::ruta(); ?>#<?php echo $foro[0]["categoria"]; ?>"><?php echo $foro[0]["categoria"]; ?></a></small> &rarr;
			<small><a href="<?php echo Conexion::ruta(); ?>?foro=<?php echo $foro[0]["id_foro"]; ?>"><?php echo $foro[0]["foro"]; ?></a></small> &rarr;
			<?php echo $subforo[0]["subforo"]; ?>
		</h6>
		</div>	
	</div>
		
		<?php
			 if (isset($_SESSION["id"])) {
			?>
				<div class="nuevotema">
					<a href="<?php echo Conexion::ruta(); ?>?action=createtema&foro=<?php echo $foro[0]["id_foro"]; ?>&sub=<?php echo $subforo[0]["id_subforo"]; ?>"> 
						<i class="fas fa-plus-circle"></i> <?php echo $_SESSION['lang']['subforo_newtema']; ?>
					</a>
				</div>
			<?php
			}
			?>
		<div><?php echo $_SESSION['lang']['subforo_themes']; ?> <?php echo $i = $inicio + 1; ?> <?php echo $_SESSION['lang']['foroview_temas_to'] ?> <?php echo $proxima; ?> <?php echo $_SESSION['lang']['foroview_temas_of'] ?> <?php echo $total; ?></div>
		<div class="caja">
            <div class="categorias row">
                <div class="temas_titulo col"><?php echo $_SESSION['lang']['subforo_title_author']; ?></div>
                <div class="temas_respuestas col-2 d-none d-sm-block text-center"><?php echo $_SESSION['lang']['subforo_answers_views']; ?></div>
                <div class="temas_ultimo col d-none d-sm-block text-center"><?php echo $_SESSION['lang']['foroview_lastmessage']; ?></div>
                <div style="clear:both; height:1px;font-size:0px; line-height: 0px;"></div>
            </div>
			<?php
            if (sizeof($datos) == 0) {
                echo $_SESSION['lang']['subforo_noposts'];
            } else {
            //****************
                foreach ($datos as $temas) {
                    ?>
                    <div class="foro row">
                        <div class="foro_icono col-1">
                            <i class="fa fa-comments" style="color:blue; font-size:1.3rem"></i>
                        </div>
                        <div class="foro_titulo col">
                            <a href="<?php echo Conexion::ruta(); ?>?temaid=<?php echo $temas["id_tema"]; ?>&foro=<?php echo $foroid; ?>&sub=<?php echo $subforoid; ?>"><?php echo $temas["titulo"]; ?></a>
                            <?php
							// validamos primero si es el admin puede eliminar lo que sea
							// validados si el tema fue creado por el usuario logueado activa la opcion de eliminar
                            if(isset($_SESSION["nombre"]) && isset($_SESSION['id'])){
								if (($_SESSION["privileges"] == "admin" || $_SESSION["privileges"] == "master") or $temas["id_usuario"] == $_SESSION["id"]) {
									?>
                                        <a class="btn btn-danger" href="<?php echo Conexion::ruta(); ?>?action=deletetema&temaid=<?php echo $temas["id_tema"]; ?>&foro=<?php echo $foroid; ?>&sub=<?php echo $subforoid ?>"><?php echo $_SESSION['lang']['subforo_delete']; ?></a>
									<?php
								}
							}
							?>
							<br>
							<?php echo $_SESSION['lang']['subforo_started']; ?><a href="<?php echo Conexion::ruta(); ?>?userid=<?php echo $temas["id_usuario"]; ?>"><?php echo $temas["nick"]; ?></a>,<strong> <?php echo $temas["created_at"]; ?></strong>
						</div>
                                <div class="temas_mensajes col-2 d-none d-sm-block">
                                    <?php echo $_SESSION['lang']['subforo_answers']; ?>:
                                    <?php
                        // total de comentarios
                                    $com = $objComentarios->TotalComentarios($temas["id_tema"]);
                                    echo "<strong>".$com."</strong>";
                                    ?>
                                    <br>
                                    <?php echo $_SESSION['lang']['subforo_views']; ?>: <strong><?php echo $temas["hits"]; ?></strong>
                                </div>
                                <div class="ultimocomentario col-12 col-sm col-lg">
                                    <?php
                                    $mensaje = $objComentarios->ultmoComentario($temas["id_tema"]);
                                    if (sizeof($mensaje) > 0) {
                                        echo $_SESSION['lang']['login_user_label'].": <strong><a href='". Conexion::ruta() ."?userid=".$mensaje[0]["id"]."'>" . $mensaje[0]["nick"] . "</a></strong><br/>";
                                        echo $_SESSION['lang']['index_date'].": <strong>" . $mensaje[0]["fecha"]."</strong>";
                                    } else {
                                        echo $_SESSION['lang']['subforo_nocomments'];
                                    }
                                    ?>
                                </div>
                                <div style="clear:both; height:1px;font-size:0px; line-height: 0px;"></div>
                            </div>
					<?php
				}
			}
		?>
		</div>
		<div id="paginacion">
		<ul class="pagination">
		<?php
		if ($inicio == 0) {
			?>
			<li class="page-item"><a class="page-link"><?php echo $_SESSION['lang']['foroview_previous']; ?></a></li>
			<?php
		} else {
			?>
			<li class="page-item"><a class="page-link" href="?foro=<?php echo $foroid; ?>&sub=<?php echo $subforoid ?>&pos=<?php echo $inicio - $cantTemas; ?>"><?php echo $_SESSION['lang']['foroview_previous']; ?></a></li>
			<?php
		}
		?>

		<?php
		$a = 0;
		$ultimaPag = 0;

		if ($actual > 6) {
			echo "<li class='page-item'><a class='page-link'>...</a></li>";
		}

		for ($i = 1; $i <= $cantPag; $i++) {
			if ($i >= $actual - 5 && $i <= $actual + 5) {
				if ($i == $actual) {
					?>	
					<li class="page-item"> <a class="page-link"><?php echo $i; ?> </a></li>
					<?php
				} else {
					?>
					<li class="page-item"><a class="page-link" href="?foro=<?php echo $foroid; ?>&sub=<?php echo $subforoid ?>&pos=<?php echo $a; ?>"> <?php echo $i . " "; ?> </a></li>
					<?php
				}
			}
			$a+=$cantTemas;
			$ultimaPag++;
		}

		$final = $ultimaPag * $cantTemas;
		$resto = $total - $final;

		if ($final < $total) {
			$ultimaPag++;

			if ($actual == $ultimaPag) {
				?>
				<li class="page-item"><a class="page-link"><?php echo $ultimaPag; ?></a></li>
				<?php
			} else {
				?>
				<li class="page-item"><a class="page-link" href="?foro=<?php echo $foroid; ?>&sub=<?php echo $subforoid ?>&pos=<?php echo $final; ?>"><?php echo $ultimaPag; ?></a></li>
				<?php
			}
		}

		if ($ultimaPag - $actual > 5) {
			echo "<li class='page-item'><a class='page-link'>...</a></li>";
		}
		?>

		<?php
		if ($ultimaPag == $actual) {
			?>
			<li class="page-item"><a class="page-link"><?php echo $_SESSION['lang']['foroview_next']; ?></a></li>
			<?php
		} else {
			?>
			<li class="page-item"><a class="page-link" href="?foro=<?php echo $foroid; ?>&sub=<?php echo $subforoid ?>&pos=<?php echo $inicio + $cantTemas; ?>"><?php echo $_SESSION['lang']['foroview_next']; ?></a></li>
			<?php
		}
		?>
	</ul>
	</div>
	<!-- Fin #paginacion -->
	<?php
}

function foroview($titulo, $foroid, $inicio, $cantTemas, $proxima, $total, $datos, $objComentarios, $subforoid, $actual, $cantPag, $objTemas) {
	?>
	<div class="row migas">
		<div class="col-12">
			<h5><?php echo $_SESSION['lang']['foro'] ?>: <?php echo $titulo[0]["foro"]; ?></h5>
		</div>
		<div class="col-12 col-lg-6">
			<p><?= $titulo[0]["descripcion"] ?></p>
		</div>
		<div class="col-12 col-lg-6 text-right">
		<h6>
			<small><a href="<?php echo Conexion::ruta(); ?>"><?php echo $_SESSION['lang']['foros']; ?></a></small> &rarr;
			<small><a href="<?php echo Conexion::ruta(); ?>#<?php echo $titulo[0]["categoria"]; ?>"><?php echo $titulo[0]["categoria"]; ?></a></small> &rarr;
			<?php echo $titulo[0]["foro"]; ?>
		</h6>
		</div>	
	</div>
	<?php
	if (isset($_SESSION["id"]) && ( $_SESSION["privileges"]=='admin' || $_SESSION["privileges"]=='master' )) {
		?>
		<div class="nuevotema">
		<a href="<?php echo Conexion::ruta(); ?>?action=createsubforo&foro=<?php echo $foroid; ?>"> 
			<i class="fa fa-plus-circle"></i><?php echo $_SESSION['lang']['foroview_new'] ?></a>
		</div>
		<?php
	}
	?>
	<div>
		<?php echo $_SESSION['lang']['foroview_temas_themes'] ?> <?php echo $i = $inicio + 1; ?> <?php echo $_SESSION['lang']['foroview_temas_to'] ?> <?php echo $proxima; ?> <?php echo $_SESSION['lang']['foroview_temas_of'] ?> <?php echo $total; ?>
	</div>
	<div class="caja">
		<div class="categorias row">
			<div class="foroview_temas_titulo col-4 col-sm-7 col-lg-7"><?php echo $_SESSION['lang']['foroview_suboros'] ?></div>
			<div class="foroview_temas_descripcion col-4 col-sm-3 col-lg-3 d-none"><?php echo $_SESSION['lang']['foroview_description'] ?></div>
			<div class="foroview_temas_respuestas col-4 col-sm-2 col-lg-2 d-none d-sm-block"><?php echo $_SESSION['lang']['foroview_temas'] ?></div>
			<div class="foroview_temas_ultimo col-4 col-sm-3 col-lg-3 d-none d-sm-block"><?php echo $_SESSION['lang']['foroview_lastmessage'] ?></div>
			<div style="clear:both; height:1px;font-size:0px; line-height: 0px;"></div>
		</div>
	<?php
	if (sizeof($datos) == 0) {
		echo $_SESSION['lang']['foroview_empty'];
	} else {
		//****************
		foreach ($datos as $subforo) {
			?>
			<div class="foro row">
				<div class="foroview_foro_icono col-1 col-sm-1 col-lg-1">
					<i class="fa fa-comments" style="color:blue;font-size:1.5rem"></i>
				</div>
				<div class="foroview_foro_titulo col-11 col-sm-6 col-lg-6">
					<a href="<?php echo Conexion::ruta(); ?>?foro=<?php echo $foroid; ?>&sub=<?php echo $subforo['id_subforo']; ?>"><?php echo $subforo["subforo"]; ?></a> 
					<?php
	// validamos primero si es el admin puede eliminar lo que sea
	// validados si el tema fue creado por el usuario logueado activa la opcion de eliminar
					if(isset($_SESSION["nombre"]) && isset($_SESSION['id'])){
						if ($_SESSION["privileges"] == "master") {
							?>
							<a style="cursor:pointer;" class="btn btn-danger" href="<?php echo Conexion::ruta(); ?>?action=deletesubforo&foro=<?php echo $foroid; ?>&sub=<?php echo $subforo['id_subforo']; ?>">
								<?php echo $_SESSION['lang']['foroview_delete'] ?></a>
							<?php
							}
					}
							?>
							<br>
						</div>
						<div class="foroview_temas_desc col-4 col-sm-3 col-lg-3 d-none ">
						<?= $subforo['descripcion'] ?>
						</div>
						<div class="foroview_temas_mensajes col-sm-2 col-lg-2 d-none d-sm-block">
							<?php echo $_SESSION['lang']['foroview_temas'] ?>:
							<?php
							$com = $objTemas->TotalsubTemas($subforo["id_subforo"]);
							echo "<strong>".$com."</strong>";
							?>
						</div>
						<div class="foroview_ultimocomentario col-12 col-sm-3 col-lg-3">
							<?php
								$mensaje = $objComentarios->ultimo_comentario_subforo($subforo["id_subforo"]);
								if (sizeof($mensaje) > 0) {
									echo $_SESSION['lang']['index_post']." - <strong><a href='".Conexion::ruta()."?temaid=".$mensaje[0]["id_tema"]."&foro=".$foroid."&sub=".$subforo["id_subforo"]."'>" . $mensaje[0]["titulo"] . "</a></strong><br/>";
									echo $_SESSION['lang']['index_created_by']." - <strong><a href='".Conexion::ruta()."?userid=".$mensaje[0]["id"]."'>" . $mensaje[0]["nick"] . "</a></strong><br/>";
									echo $_SESSION['lang']['index_date']." - <strong>" . $mensaje[0]["fecha"]."</strong>";
								} else {
									echo $_SESSION['lang']['index_noposts'];
								}
							?>
						</div>
						<div style="clear:both; height:1px;font-size:0px; line-height: 0px;"></div>
			</div>
					<?php
				}
			}
			?>
		</div>
		<div id="paginacion">
		<ul class="pagination">
		<?php
		if ($inicio == 0) {
			?>
			<li class="page-item"><a class="page-link"><?php echo $_SESSION['lang']['foroview_previous'] ?></a></li>
			<?php
		} else {
			?>
			<li class="page-item"><a class="page-link" href="?foro=<?php echo $foroid; ?>&pos=<?php echo $inicio - $cantTemas; ?>"><?php echo $_SESSION['lang']['foroview_previous'] ?></a></li>
			<?php
		}
		?>

		<?php
		$a = 0;
		$ultimaPag = 0;

		if ($actual > 6) {
			echo "<li class='page-item'><a class='page-link'>...</a></li>";
		}

		for ($i = 1; $i <= $cantPag; $i++) {
			if ($i >= $actual - 5 && $i <= $actual + 5) {
				if ($i == $actual) {
					?>	
					<li class="page-item"> <a class="page-link"><?php echo $i; ?> </a></li>
					<?php
				} else {
					?>
					<li class="page-item"><a class="page-link" href="?foro=<?php echo $foroid; ?>&pos=<?php echo $a; ?>"> <?php echo $i . " "; ?> </a></li>
					<?php
				}
			}
			$a+=$cantTemas;
			$ultimaPag++;
		}

		$final = $ultimaPag * $cantTemas;
		$resto = $total - $final;

		if ($final < $total) {
			$ultimaPag++;

			if ($actual == $ultimaPag) {
				?>
				<li class="page-item"><a class="page-link"><?php echo $ultimaPag; ?></li></a>
				<?php
			} else {
				?>
				<li class="page-item"><a class="page-link" href="?foro=<?php echo $foroid; ?>&pos=<?php echo $final; ?>"><?php echo $ultimaPag; ?></a></li>
				<?php
			}
		}

		if ($ultimaPag - $actual > 5) {
			echo "<li class='page-item'><a class='page-link'>...</a></li>";
		}
		?>

		<?php
		if ($ultimaPag == $actual) {
			?>
			<li class="page-item"><a class="page-link"><?php echo $_SESSION['lang']['foroview_next'] ?></a></li>
			<?php
		} else {
			?>
			<li class="page-item"><a class="page-link" href="?foro=<?php echo $foroid; ?>&pos=<?php echo $inicio + $cantTemas; ?>"><?php echo $_SESSION['lang']['foroview_next'] ?></a></li>
			<?php
		}
		?>
	</ul>
	</div>
	<!-- Fin #paginacion -->
	<?php
}

function viewbusqueda($resultado) {
	if (sizeof($resultado) > 0) {
		?>
		<div class="caja row">
			<div class="categorias">
				<div class="temas_titulo">Titulo / Autor</div>
				<div class="temas_respuestas">Respuestas / Visitas</div>
				<div class="temas_ultimo">Último mensaje</div>
				<div style="clear:both; height:1px;font-size:0px; line-height: 0px;"></div>
			</div>
			<?php
			foreach ($resultado as $temas) {
				?>
				<div class="foro">
					<div class="foro_icono col-1">
						<img src="img/note.png" alt="Icono de foro">
					</div>
					<div class="foro_titulo col-12 col-lg-4">
						<?php
						// validamos si el subforo es cero para que concatene la ruta correcta
							if($temas["id_subforo"] == 0){
								$rsub = "";
							}else{
								$rsub = "&sub=".$temas["id_subforo"];
							}
								
						?>
						<a href="<?php echo Conexion::ruta(); ?>?temaid=<?php echo $temas["id_tema"]; ?>&foro=<?php echo $temas["id_foro"].$rsub; ?>"><?php echo $temas["titulo"]; ?></a><br>
						Iniciado por <a href="<?php echo Conexion::ruta(); ?>?userid=<?php echo $temas["id_usuario"]; ?>"><?php echo $temas["nick"]; ?></a>, <?php echo $temas["fecha"]; ?>
					</div>
					<div class="temas_mensajes col-12 col-lg-4">
						Respuestas:
								<?php
								$objCom = new Comentarios();
								$com = $objCom->TotalComentarios($temas["id_tema"]);
								echo $com;
								?>
								<br>
								Visitas: <?php echo $temas["hits"]; ?>
					</div>
					<div class="ultimocomentario col-12 col-lg-4">
						<?php
								$objMensajes = new Comentarios();
								$mensaje = $objMensajes->ultmoComentario($temas["id_tema"]);
								if (sizeof($mensaje) > 0) {
									echo "Usuario: <a href='". Conexion::ruta() ."?userid=". $mensaje[0]['id'] ."'>" . $mensaje[0]["nick"] . "</a><br/>";
									echo "Fecha: " . $mensaje[0]["fecha"];
								} else {
									echo 'No hay comentarios';
								}
								?>
					</div>
					<div style="clear:both; height:1px;font-size:0px; line-height: 0px;"></div>
				</div>

				<?php
			}
			?>
		</div>
		<?php
	} else {
		echo $_SESSION['lang']['errorbuscador'];
	}
}

function temaview($temaid, $foroid, $subid, $tema, $foro, $sub, $comentarios) {
	?>
		<div class="row migas">
			<div class="col-12">
				<h5><?php echo$_SESSION['lang']['foro']; ?>: <?php echo $foro[0]["foro"]; ?> | <?php echo$_SESSION['lang']['subforo']; ?>: <?php echo $sub[0]["subforo"]; ?></h5>
			</div>
			<div class="col-12 text-right">
			<h6>
				<small><a href="<?php echo Conexion::ruta(); ?>"><?php echo$_SESSION['lang']['foros']; ?></a></small> &rarr;
				<small><a href="<?php echo Conexion::ruta(); ?>#<?php echo $foro[0]["categoria"]; ?>"><?php echo $foro[0]["categoria"]; ?></a></small> &rarr;
				<small><a href="<?php echo Conexion::ruta(); ?>?foro=<?php echo $foro[0]["id_foro"]; ?>"><?php echo $foro[0]["foro"]; ?></a></small> &rarr;
				<small><a href="<?php echo Conexion::ruta(); ?>?foro=<?php echo $foro[0]["id_foro"]; ?>&sub=<?php echo $subid; ?> "><?php echo $sub[0]["subforo"]; ?></a></small> &rarr;
				<?php echo $tema[0]["titulo"]; ?>
			</h6>
			</div>	
		</div>
		<div class="categorias row">
				<div class="col-12">
					<?php echo$_SESSION['lang']['index_post']; ?>: <?php echo $tema[0]["titulo"]; ?>
				</div>	
		</div>
		<div class="caja row">
			
			<div class="temausuario col-3 col-sm-2 col-lg-2 ">
				<div class="row align-self-start">
					<div class="avatar col-12 text-center">
						<a href="<?php echo Conexion::ruta(); ?>?userid=<?php echo $tema[0]["id_usuario"]; ?>"><img src="upload/<?php echo $tema[0]["avatar"]; ?>" alt="Imagen subida usuario" width="70px" /></a>
					</div>
					<div class="usuario col-12 text-center">
						<a href="<?php echo Conexion::ruta(); ?>?userid=<?php echo $tema[0]["id_usuario"]; ?>"><?php echo $tema[0]["nick"]; ?></a>
					</div>
					<div class="datos col-12 text-center ">
						<?php echo$_SESSION['lang']['tema_fecha']; ?>:<br> <?php echo $tema[0]["fechaderegistro"]; ?><br/>
					</div>
					<div style="clear:both; height:1px;font-size:0px; line-height: 0px;"></div>
				</div>
			</div>

			<div class="foro col-9" style="border-bottom:0px">   
				<div class="tema">
					<?php echo $tema[0]["contenido"]; ?>
				</div>

			</div>

			<div class="firma col-12" style="border-top: rgba(0, 204, 102,0.5) solid 1px;">
				<?php echo $tema[0]["firma"]; ?>
			</div>
		</div>
		
		<h2><?php echo$_SESSION['lang']['tema_comments']; ?></h2>
		
		<?php
		foreach ($comentarios as $temas) {
		?>	
			<div class="row">
				
					<div class="categorias col-12">
					<?php echo$_SESSION['lang']['index_date']; ?>: <?php echo $temas["fecha"]; ?>  
					<?php
					// validamos primero si es el admin puede eliminar lo que sea
					// validados si el comentario fue creado por el usuario logueado activa la opcion de eliminar
					if(isset($_SESSION["nombre"]) && isset($_SESSION['id'])){
						if (( $_SESSION["privileges"] == "admin" || $_SESSION["privileges"] == "master" ) or $temas["id_usuario"] == $_SESSION["id"]) {
							?>
							| <a class="btn btn-link" href="<?php echo Conexion::ruta(); ?>?action=deletecoment&comentarioid=<?php echo $temas["id_comentario"]; ?>&tema=<?php echo $temaid; ?>&foro=<?php echo $foroid; ?>&sub=<?php echo $subid; ?>&userid=<?php echo $temas["id_usuario"];?>">
								<?php echo$_SESSION['lang']['tema_deletecomment']; ?></a>
							<?php
						}
					}
					?>
				
				</div>
			</div>
			<div class="caja row">
				<div class="temausuario col-3 col-sm-2 col-lg-2">
					<div class="row align-self-start">
						<div class="avatar col-12 text-center">
							<a href="<?php echo Conexion::ruta(); ?>?userid=<?php echo $temas["id_usuario"]; ?>"><img src="upload/<?php echo $temas["avatar"]; ?>" alt="Imagen subida usuario" width="70px" /></a>
						</div>
						<div class="usuario col-12 text-center">
							<a href="<?php echo Conexion::ruta(); ?>?userid=<?php echo $temas["id_usuario"]; ?>"><?php echo $temas["nick"]; ?></a>
						</div>
						<div class="datos col-12 text-center">
							<?php echo$_SESSION['lang']['tema_fecha']; ?>: <br><?php echo $temas["fechaderegistro"]; ?><br/>
						</div>
						<div style="clear:both; height:1px;font-size:0px; line-height: 0px;"></div>
					</div>
				</div>

				<div class="foro col-9" style="border-bottom:0px">   
					<div class="tema col-12">
						<?php echo $temas["comentario"]; ?>
					</div>
				</div>

				<div class="firma col-12"  style="border-top: rgba(0, 204, 102,0.5) solid 1px;">
					<?php echo $temas["firma"]; ?>
				</div>
			</div>
		<?php
		}
		?>
		
		<!-- editor -->


		<div class="caja row">
			<div class="categorias col-12">
				<?php echo $_SESSION['lang']['tema_newcomment']; ?>
			</div>

			<?php
			if (isset($_SESSION["nombre"]) && isset($_SESSION['id'])) {
			?>
			<div class="foro col-12">  
				
				<div class="tema">
					<form action="index.php?temaid=<?php echo $temaid; ?>&foro=<?php echo $foroid; ?>&sub=<?php echo $subid; ?>" method="post">
						<textarea name="comentario" class="text"  cols="40" rows="20"></textarea>
						<button type="submit" name="guardar"  class="btn btn-primary"><?php echo $_SESSION['lang']['tema_submit']; ?></button>
					</form>
				</div>
			</div>
			<?php
			}else{
			?>
				<p><?php echo $_SESSION['lang']['tema_post']; ?><a href="<?php echo Conexion::ruta(); ?>?action=login"> <?php echo $_SESSION['lang']['login']; ?> </a> | <a href="<?php echo Conexion::ruta(); ?>?action=register"> <?php echo $_SESSION['lang']['register']; ?> </a></p>
			<?php
			}
			?>
			
		</div>

	<?php
}

function perfilview($user) {
	?>
		<div class="caja">
			<div class="categorias"><?php echo $_SESSION['lang']['user_index']; ?></div>
			<div class="foro_perfil">
				<img src="upload/<?php echo $user[0]["avatar"]; ?>" alt="Imagen subida usuario" width="70px" /><br/>
				Nick: <?php echo $user[0]["nick"]; ?> <br/>
				<?php echo $_SESSION['lang']['user_name']; ?>: <?php echo $user[0]["nombre"]; ?> <br/>
				Facebook: <?php echo $user[0]["facebook"]; ?> <br/>
				Twitter: <?php echo $user[0]["twitter"]; ?> <br/>
				<?php echo $_SESSION['lang']['user_signature']; ?>: <?php echo $user[0]["firma"]; ?> <br/>
			</div>
		</div>
	<?php
}

function editperfilview($u) {
	?>
    <div class="caja row">
	<div class="col-12">
        <div class="categorias row"><div class="col-12"><?php echo $_SESSION['lang']['user_index']; ?></div></div>
        <div class="foro row">
		<div class="col-12">
            <form action="<?php echo Conexion::ruta(); ?>?userid=<?php echo $u[0]['id'] ?>" method="post"  class="formulario" id="editar_perfil_formulario">
			<div class="row">
                <div class="col-12 col-sm-4 col-lg-4 text-center"><img src="upload/<?php echo $u[0]["avatar"]; ?>" alt="Imagen subida usuario" width="70px" />
				<br><br><a class="btn btn-success" href="<?php echo Conexion::ruta(); ?>?change=foto"> - <?php echo $_SESSION['lang']['user_photo']; ?> -</a></div>
				<div class="col-12 col-sm-8 col-lg-8">
                <label>Nick:</label>
                <input class="form-control" type="text" value="<?php echo $u[0]["nick"]; ?>" disabled/><br>
                <label><?php echo $_SESSION['lang']['user_name']; ?>:</label>
                <input class="form-control" type="text" name="nombre" value="<?php echo $u[0]["nombre"]; ?>" /> <br/>
                <label>Email:</label>
                <input class="form-control" type="text" name="correo" value="<?php echo $u[0]["correo"]; ?>" /> <br/>
                <label>Facebook:</label>
                <input class="form-control" type="text" name="facebook" value="<?php echo $u[0]["facebook"]; ?>" /> <br/>
                <label>Twitter:</label>
                <input class="form-control" type="text" name="twitter" value="<?php echo $u[0]["twitter"]; ?>" /> <br/>
                <label><?php echo $_SESSION['lang']['user_signature']; ?>:</label>
                <input class="form-control" type="text" name="firma" value="<?php echo $u[0]["firma"]; ?>" /> <br/>

                <button type="submit" name="guardar" class="btn btn-primary"><?php echo $_SESSION['lang']['user_update']; ?></button>
				</div>
				<div class="col-12 text-right"><a class="btn btn-danger" href="<?php echo Conexion::ruta(); ?>?action=eliminarcuenta&userid=<?php echo $_SESSION["id"]; ?>"><?php echo $_SESSION['lang']['user_delete']; ?></a></div>
				</div>
            </form>
			</div>
        </div>
	</div>
    </div>
    <?php
}

function fotoview($u) {
	?>
    <div class="caja">
        <div class="categorias">Usuarios</div>
        <div class="foro">
            <form action="<?php echo Conexion::ruta(); ?>?change=foto" method="post" enctype="multipart/form-data"  class="formulario">
                <img src="upload/<?php echo $u[0]["avatar"]; ?>" alt="Imagen subida usuario" width="70px" /><br/>
            <label>Nick:</label>
            <?php echo $u[0]["nick"]; ?> <br/>
            <label>Nombre:</label>
            <input type="file"  name="foto" value="" /><br/>
            
            <button type="submit" name="guardar" class="btn btn-default">Actualizar avatar</button>
            </form>
        </div>
    </div>
    <?php
}

function creartemaview($foroid, $subid, $foro, $subforo) {
	?>
		
		<h4>
			<a href="<?php echo Conexion::ruta(); ?>"><?php echo$_SESSION['lang']['foros']; ?></a> &rarr;
			<a href="<?php echo Conexion::ruta(); ?>#<?php echo $foro[0]["categoria"]; ?>"><?php echo $foro[0]["categoria"]; ?></a> &rarr;
			<a href="<?php echo Conexion::ruta(); ?>?foro=<?php echo $foro[0]["id_foro"]; ?>"><?php echo $foro[0]["foro"]; ?></a> &rarr;
			<a href="<?php echo Conexion::ruta(); ?>?foro=<?php echo $foro[0]["id_foro"]; ?>&sub=<?php echo $subforo[0]["id_subforo"]; ?>"><?php echo $subforo[0]["subforo"]; ?></a>
		</h4>
		
		<div class="caja">
			<div class="categorias">
				<?php echo$_SESSION['lang']['newtema_add']; ?> <span style="text-decoration: underline;"><?php echo $subforo[0]["subforo"]; ?></span>, <?php echo$_SESSION['lang']['newtema_add_2']; ?> <span style="text-decoration: underline;"><?php echo $foro[0]["foro"]; ?></span>
			</div>
			<div class="foro">   
				<div class="tema">
					<form action="<?php echo Conexion::ruta(); ?>?action=createtema&foro=<?php echo $foroid; ?>&sub=<?php echo $subid; ?>" method="post">
						<label><?php echo$_SESSION['lang']['newtema_title']; ?></label>
						<input type='text' name='titulo' required="required">
						<br/><br/>
						<label><?php echo$_SESSION['lang']['newtema_content']; ?></label>
						<textarea name="contenido" class="tex"></textarea>
						<button type="submit" name="guardar"  class="btn btn-default"><?php echo$_SESSION['lang']['newtema_send']; ?></button>
					</form>
				</div>
			</div>
		</div>
	<?php
}

function newsuboforoview($foro) {
	?>
	<h4>
		<a href="<?php echo Conexion::ruta(); ?>">Foros</a> &rarr;
		<a href="<?php echo Conexion::ruta(); ?>#<?php echo $foro[0]["categoria"]; ?>"><?php echo $foro[0]["categoria"]; ?></a> &rarr;
		<a href="<?php echo Conexion::ruta(); ?>?foro=<?php echo $foro[0]["id_foro"]; ?>"><?php echo $foro[0]["foro"]; ?></a>
	</h4>
	
	<div class="caja row">
		<div class="categorias col-12">
			Agregar Subforo a <?php echo $foro[0]['foro']?>
		</div>
		<div class="foro col-6">   
			<div class="tema">
				<form action="<?php echo Conexion::ruta(); ?>?action=createsubforo&foro=<?php echo $foro[0]['id_foro']; ?>" method="post">
					<label>Titulo del Subforo</label>
					<input class="form-control" type='text' name='titulo' required="required">
					<br/><br/>
					<label>Descripción del subforo</label>
					<input class="form-control" type='text' name='contenido' required="required">
					<input class="form-control" type="hidden" value="<?php echo $foro[0]["id_foro"] ?>" name="foroid">
					<br/>
					<button class="btn btn-primary" type="submit" name="guardar"  class="btn btn-default">Crear</button>
				</form>
			</div>
		</div>
	</div>
	<?php
}

function panelview($categorias, $objForos, $objSubForos) {
	?>
	<div class="caja">
		<div class="categorias">
			Panel de control administradores
		</div>
		<div class="foro">   
			<div class="tema">
				<form class="form" action="" autocomplete="off" method="post">
					<label>Categoria nueva</label>
					<input class="form-control" type='text' name='titulo' placeholder="Nombre de la categoría" required="required">
					<button class="btn btn-primary" type="submit" name="categorianueva">Crear Categoria</button>
				</form>
			</div>
		</div>
	</div>
	<?php
	foreach ($categorias as $cat) {
		$categoria = $cat["id_forocategoria"];
		?>
		<div class="caja">
			<div class="categorias">
				<a name="<?php echo $cat["categoria"]; ?>"></a><?php echo $cat["categoria"]; if($_SESSION['privileges']=='master') {?> |
					<a class="btn btn-link" href="<?php echo Conexion::ruta(); ?>?action=eliminarcategoria&cat=<?php echo $cat["id_forocategoria"]; ?>"> x Eliminar Categoria</a>
				<?php
				}
				?>
			</div>
			<div class="foro">   
				<div class="tema">
					<form class="form" action="" autocomplete="off" method="post">
						<label>Nuevo foro</label>
						<input class="form-control" type='text' name='titulo' placeholder="Nombre del foro" required="required">
						<label>Descripción</label>
						<input class="form-control" type='text' name='descripcion' placeholder="Descripción del foro" required="required">
						<input class="form-control" type="hidden" name="categoria" value="<?php echo $cat["id_forocategoria"]; ?>">                        
						<button class="btn btn-primary" type="submit" name="foronuevo">Crear Foro</button>
					</form>
				</div>
			</div>

			<?php
			$foros = $objForos->getForo($categoria);
			if(sizeof($foros)>0){
				foreach ($foros as $foro) {
					?>
					<div class="foro">
						<div class="foro_icono">
							<img src="img/note.png" alt="Icono foro">
						</div>
						<div class="foro_titulo">
							<a href="<?php echo Conexion::ruta(); ?>?foro=<?php echo $foro["id_foro"]; ?>"><?php echo $foro["foro"]; ?></a> <?php if($_SESSION['privileges']=='master') { ?>|
								<a class="btn btn-link" href="<?php echo Conexion::ruta(); ?>?action=eliminarforo&foro=<?php echo $foro["id_foro"]; ?>&cat=<?php echo $foro["id_forocategoria"]; ?>"> x Eliminar Foro</a>
							<?php
							}
							?>
							<ul>
								<?php
								$subforos = $objSubForos->getSubforo($foro["id_foro"]);
								if (sizeof($subforos) == 0) {
									echo "No existen registros aún";
								}else{
									foreach ($subforos as $sforo) {
										?>
										<li>
											<a href="<?php echo Conexion::ruta(); ?>?foro=<?php echo $foro["id_foro"]; ?>&sub=<?php echo $sforo["id_subforo"]; ?>"><?php echo $sforo["subforo"]; ?></a>
										</li>
										<?php
									}
								}
								?>
							</ul>
						</div>

						<div style="clear:both; height:1px;font-size:0px; line-height: 0px;"></div>
					</div>
					<?php
				}
			}
			?>
		</div>
		<?php
	}
}

function usuariosview($usuarios, $objTemas, $objComentarios) {
	?>
	<div class="caja">
		<div class="categorias">
			<div class="temas_titulo">Usuarios</div>
			<div class="temas_respuestas">Temas</div>
			<div class="temas_ultimo">Temas / Comentarios</div>
			<div style="clear:both; height:1px;font-size:0px; line-height: 0px;"></div>
		</div>
		<div class="foro">
			<?php
			foreach ($usuarios as $u) {
				?>
				<div class="foro_icono">
					<img src="img/note.png" alt="Icono foro">
				</div>
				<div class="foro_titulo">
					<a href="<?php echo Conexion::ruta(); ?>?userid=<?php echo $u["id"]; ?>"><?php if ($u["privileges"]=='master') { ?> <span style="color: #ff9900"><?php echo $u["nombre"]; ?> (<?php echo $u["nick"]; ?>)</span> <?php } else if ($u["privileges"]=='admin') { ?> <span style="color: red"><?php echo $u["nombre"]; ?> (<?php echo $u["nick"]; ?>)</span> <?php } else { echo $u["nombre"]; ?> (<?php echo $u["nick"]; ?>) <?php }?></a>
					<?php
					if ($_SESSION["privileges"] == "admin") { 
						if ($u["privileges"]!='admin' && $u["privileges"]!='master') {
							?>
								<a class="btn btn-link" href="<?php echo Conexion::ruta(); ?>?action=upgradeadmin&userid=<?php echo $u["id"]; ?>">Convertir en Admin</a>
							<?php
						}
					}
					else {
						
						if($u["id"]!= $_SESSION['id']) {
							?>
								<a class="btn btn-danger" href="<?php echo Conexion::ruta(); ?>?action=eliminaruser&userid=<?php echo $u["id"]; ?>">Eliminar usuario</a>
							<?php 
						}
						
						if ($u["privileges"]!='admin' && $u["privileges"]!='master' ) {
							?>
								<a class="btn btn-primary" href="<?php echo Conexion::ruta(); ?>?action=upgradeadmin&userid=<?php echo $u["id"]; ?>">Convertir en Admin</a>
							<?php
						} else if($u["privileges"]=='admin'){
							?>
								<a class="btn btn-primary" href="<?php echo Conexion::ruta(); ?>?action=downgradeadmin&userid=<?php echo $u["id"]; ?>">Revocar permisos de administrador</a>
							<?php
						}
					}
					?>
				</div>
				<div class="temas_mensajes">
					<a href="<?php echo Conexion::ruta(); ?>?action=vertemasusuario&userid=<?php echo $u["id"]; ?>">Ver temas creados por <?php echo $u["nick"]; ?></a>
				</div>
				<div class="ultimocomentario">
					<?php
					$temas = $objTemas->TotalTemasUsuarios($u["id"]);
					if (sizeof($temas) > 0) {
						echo "Temas: " . $temas . "<br/>";
					} else {
						echo 'Temas: 0';
					}

					$comentarios = $objComentarios->TotalComentariosUsuario($u["id"]);
					if (sizeof($temas) > 0) {
						echo "Comentarios: " . $comentarios . "<br/>";
					} else {
						echo 'Comentarios: 0';
					}
					?>
				</div>
				<div style="clear:both; height:1px;font-size:0px; line-height: 0px;"></div>
				<?php
			}
			?>
		</div>
	</div>
	<?php
}

function temasusuarioview($usuarios) {
	?>
	<div class="caja">
		<div class="categorias">
			<div class="temas_titulo">Temas</div>
			<div class="temas_respuestas"></div>
			<div class="temas_ultimo"></div>
			<div style="clear:both; height:1px;font-size:0px; line-height: 0px;"></div>
		</div>
		<div class="foro">
			<?php
			foreach ($usuarios as $u) {
				?>
				<div class="foro_icono">
					<img src="img/note.png" alt="Icono foro">
				</div>
				<div class="foro_titulo">
					<a href="<?php echo Conexion::ruta(); ?>?temaid=<?php echo $u["id_tema"]; ?>&foro=<?php echo $u["id_foro"]; ?>&sub=<?php echo $u["id_subforo"] ?>"><?php echo $u["titulo"]; ?></a>
				</div>
				<div class="temas_mensajes">

				</div>
				<div class="ultimocomentario">
				</div>
				<div style="clear:both; height:1px;font-size:0px; line-height: 0px;"></div>
				<?php
			}
			?>
		</div>
	</div>
	<?php
}

function upgradeview($user) {
	?>
	<div class="caja">
			<div style="background-color: red" class="categorias">Actualizar <span style="font-size: 16px"><?php echo $user[0]["nick"]?></span> a Administrador</div>
			<div class="foro">
				<img src="upload/<?php echo $user[0]["avatar"]; ?>" alt="Imagen subida usuario" width="70px" /><br/>
				Nombre de usuario: <span style="color:red; font-size: 15px;"><?php echo $user[0]["nick"]; ?></span> <br/>
				Nombre real: <span style="color:red; font-size: 15px;"><?php echo $user[0]["nombre"]; ?></span> <br/>
				Correo: <span style="color:red; font-size: 15px;"><?php echo $user[0]["correo"]; ?></span> <br/>
				
				<br>
			</div>
			<div class="tema">
				<form action="<?php echo Conexion::ruta(); ?>?action=upgradeadmin&userid=<?php echo $user[0]['id']; ?>" method="post">
					<button type="submit" style="pointer: cursor" name="guardar"  class="btn btn-default">Actualizar a administrador</button>
				</form>
			</div>
		</div>
	<?php
}

function downgradeview($user) {
	?>
	<div class="caja">
			<div style="background-color: red" class="categorias">Revocar privilegios de administrador a <span style="font-size: 16px"><?php echo $user[0]["nick"]?></span></div>
			<div class="foro">
				<img src="upload/<?php echo $user[0]["avatar"]; ?>" alt="Imagen subida usuario" width="70px" /><br/>
				Nombre de usuario: <span style="color:red; font-size: 15px;"><?php echo $user[0]["nick"]; ?></span> <br/>
				Nombre real: <span style="color:red; font-size: 15px;"><?php echo $user[0]["nombre"]; ?></span> <br/>
				Correo: <span style="color:red; font-size: 15px;"><?php echo $user[0]["correo"]; ?></span> <br/>
				
				<br>
			</div>
			<div class="tema">
				<form action="<?php echo Conexion::ruta(); ?>?action=downgradeadmin&userid=<?php echo $user[0]['id']; ?>" method="post">
					<button type="submit" style="pointer: cursor" name="guardar"  class="btn btn-default">Quitar privilegios</button>
				</form>
			</div>
		</div>
	<?php
}

function eliminaruser($user) {
	?>
	<div class="caja">
		<div style="background-color: red" class="categorias">Eliminar al usuario <span style="font-size: 16px"><?php echo $user[0]["nick"]?></span></div>
		<div class="foro">
			<img src="upload/<?php echo $user[0]["avatar"]; ?>" alt="Imagen subida usuario" width="70px" /><br/>
			Nombre de usuario: <span style="color:red; font-size: 15px;"><?php echo $user[0]["nick"]; ?></span> <br/>
			Nombre real: <span style="color:red; font-size: 15px;"><?php echo $user[0]["nombre"]; ?></span> <br/>
			Correo: <span style="color:red; font-size: 15px;"><?php echo $user[0]["correo"]; ?></span> <br/>
			
			<br>
		</div>
		<div class="tema">
			<h2>Esta acción NO ES REVERSIBLE</h2>
			<form action="<?php echo Conexion::ruta(); ?>?action=eliminaruser&userid=<?php echo $user[0]['id']; ?>" method="post">
				<button type="submit" style="pointer: cursor" name="guardar"  class="btn btn-default">ELIMINAR USUARIO</button>
			</form>
		</div>
	</div>
	<?php
}

function eliminaracc($user) {
	?>
	<h3><a href="<?php echo Conexion::ruta(); ?>?userid=<?php echo $user[0]["id"]; ?>" style="color: #0096A1">Volver a mi perfil</a></h3>
	<div class="caja">
		<div style="background-color: red" class="categorias"><?php echo $_SESSION['lang']['prof_delete']; ?>, <span style="font-size: 16px"><?php echo $user[0]["nick"]?></span></div>
		<div class="foro">
			<img src="upload/<?php echo $user[0]["avatar"]; ?>" alt="Imagen subida usuario" width="70px" /><br/>
			<?php echo $_SESSION['lang']['prof_username']; ?>: <span style="color:red; font-size: 15px;"><?php echo $user[0]["nick"]; ?></span> <br/>
			<?php echo $_SESSION['lang']['prof_real']; ?>: <span style="color:red; font-size: 15px;"><?php echo $user[0]["nombre"]; ?></span> <br/>
			Email: <span style="color:red; font-size: 15px;"><?php echo $user[0]["correo"]; ?></span> <br/>
			
			<br>
		</div>
		<div class="tema">
			<h2><?php echo $_SESSION['lang']['prof_waning']; ?></h2>
			<form action="<?php echo Conexion::ruta(); ?>?action=eliminarcuenta&userid=<?php echo $user[0]['id']; ?>" method="post">
				<button type="submit" style="pointer: cursor" name="guardar"  class="btn btn-danger"><?php echo $_SESSION['lang']['prof_submit']; ?></button>
			</form>
		</div>
	</div>
	<?php
}

function deletetemaview($tema) {
	?>
	<div class="caja">
		<div style="background-color: red" class="categorias"><?php echo $_SESSION['lang']['tema_index']; ?> <span style="font-size: 16px"><?php echo $tema[0]["titulo"]?></span></div>
		<div class="foro">
			<br/>
			<span style="font-size: 18px;"><?php echo $_SESSION['lang']['tema_info']; ?> '<a href="<?php echo Conexion::ruta(); ?>?temaid=<?php echo $tema[0]["id_tema"]; ?>&foro=<?php echo $tema[0]["id_foro"]; ?>&sub=<?php echo $tema[0]["id_subforo"]; ?>"><span style="color: red;"><?php echo $tema[0]['titulo']; ?></span></a>'</span><br/><br/>
			<span style="font-size: 15px; font-weight: bold;"><?php echo $_SESSION['lang']['foroview_description']; ?>:</span><br/>
			<span style="font-size: 15px;"><?php echo $tema[0]['contenido']; ?></span><br/><br>
		</div>
		<div class="tema">
			<h2><?php echo $_SESSION['lang']['tema_warning_1']; ?></h2>
			<h3><?php echo $_SESSION['lang']['tema_warning_2']; ?></h3>
			<form action="<?php echo Conexion::ruta(); ?>?action=deletetema&temaid=<?php echo $tema[0]['id_tema']; ?>&foro=<?php echo $tema[0]['id_foro']; ?>&sub=<?php echo $tema[0]['id_subforo'] ?>" method="post">
				<button type="submit" style="pointer: cursor" name="guardar"  class="btn btn-default"><?php echo $_SESSION['lang']['tema_delete_submit']; ?></button>
			</form>
		</div>
	</div>
	<?php
}

function deletesubforoview($sforo) {
	?>
	<div class="caja">
		<div style="background-color: red" class="categorias">Eliminar el Sub Foro <span style="font-size: 16px"><?php echo $sforo[0]["subforo"]?></span></div>
		<div class="foro">
			<br/>
			<span style="font-size: 18px;">El Subforo '<a href="<?php echo Conexion::ruta(); ?>?foro=<?php echo $sforo[0]["id_foro"]; ?>&sub=<?php echo $sforo[0]["id_subforo"]; ?>"><span style="color: red;"><?php echo $sforo[0]['subforo']; ?></span></a>'</span><br/><br/>
			<span style="font-size: 15px; font-weight: bold;">Descripción:</span><br/>
			<span style="font-size: 15px;"><?php echo $sforo[0]['descripcion']; ?></span><br/><br>
		</div>
		<div class="tema">
			<h2>Esta acción NO ES REVERSIBLE</h2>
			<h3>Todos los temas serán borrados con el subforo</h3>
			<h3>A su misma vez, todos los comentarios de los temas serán también borrados</h3>
			<form action="<?php echo Conexion::ruta(); ?>?action=deletesubforo&foro=<?php echo $sforo[0]['id_foro']; ?>&sub=<?php echo $sforo[0]['id_subforo'] ?>" method="post">
				<button type="submit" style="pointer: cursor" name="guardar"  class="btn btn-default">ELIMINAR SUBFORO</button>
			</form>
		</div>
	</div>
	<?php
}

function deleteforoview($foro) {
	?>
	<div class="caja">
		<div style="background-color: red" class="categorias">Eliminar el Foro <span style="font-size: 16px"><?php echo $foro[0]["foro"]?></span></div>
		<div class="foro">
			<br/>
			<span style="font-size: 18px;">El Foro '<a href="<?php echo Conexion::ruta(); ?>?foro=<?php echo $foro[0]["id_foro"]; ?>"><span style="color: red;"><?php echo $foro[0]['foro']; ?></span></a>'</span><br/><br/>
			<span style="font-size: 15px; font-weight: bold;">Descripción:</span><br/>
			<span style="font-size: 15px;"><?php echo $foro[0]['descripcion']; ?></span><br/><br>
		</div>
		<div class="tema">
			<h2>Esta acción NO ES REVERSIBLE</h2>
			<h3>Todos los subforos serán borrados con el foro</h3>
			<h3>Todos los temas dentro de cada subforo serán borrados</h3>
			<h3>A su misma vez, todos los comentarios de los temas de cada subforo serán también borrados</h3>
			<form action="<?php echo Conexion::ruta(); ?>?action=eliminarforo&foro=<?php echo $foro[0]['id_foro']; ?>&cat=<?php echo $foro[0]['id_forocategoria'] ?>" method="post">
				<button type="submit" style="pointer: cursor" name="guardar"  class="btn btn-default">ELIMINAR FORO</button>
			</form>
		</div>
	</div>
	<?php
}

function deletecategoriaview($categoria) {
	?>
	<div class="caja">
		<div style="background-color: red" class="categorias">Eliminar la Categoría <span style="font-size: 16px"><?php echo $categoria[0]["categoria"]?></span></div>
		<div class="foro">
			<br/>
			<span style="font-size: 18px;">Borrar categoría '<span style="color: red;"><?php echo $categoria[0]['categoria']; ?></span>'</span><br/><br/>
		</div>
		<div class="tema">
			<h2>Esta acción NO ES REVERSIBLE</h2>
			<h3>Todos los foros de la categoría <?php echo $categoria[0]["categoria"] ?> será borrados</h3>
			<h3>Todos los subforos de los foros serán borrados</h3>
			<h3>Todos los temas dentro de cada subforo serán borrados</h3>
			<h3>A su misma vez, todos los comentarios de los temas de cada subforo serán también borrados</h3>
			<form action="<?php echo Conexion::ruta(); ?>?action=eliminarcategoria&cat=<?php echo $categoria[0]['id_forocategoria']; ?>" method="post">
				<button type="submit" style="pointer: cursor" name="guardar"  class="btn btn-default">ELIMINAR CATEGORIA</button>
			</form>
		</div>
	</div>
	<?php
}

function emailview($correo) {
	?>
	<div class="caja">
		<div class="categorias"><?= $_SESSION['lang']['new_accept']; ?><span style="font-size: 16px"></span></div>
		<div class="foro">
			<br/>
			<span style="font-size: 18px;"><?= $_SESSION['lang']['new_send']; ?> <span style="text-decoration: underline"><?= $correo ?> </span><br/><br/>
		</div>
		<div class="tema">
			<h2><?= $_SESSION['lang']['new_confirm']; ?></h2>
			<h3><?= $_SESSION['lang']['new_mes']; ?></h3>
		</div>
	</div>
	<?php
}

function cuentaactivada() {
	?>
	<div class="caja">
		<div class="categorias"><?= $_SESSION['lang']['new_success']; ?><span style="font-size: 16px"></span></div>
		<div class="tema">
			<h2><?= $_SESSION['lang']['new_member']; ?></h2>
			<h3><?= $_SESSION['lang']['new_try']; ?></h3>
		</div>
	</div>
	<?php
}

function policyview(){
	?>
	
	<?php echo $_SESSION['lang']['policy'];
}

function licenciasview(){
	?>
	
	<?php echo $_SESSION['lang']['licencias'];
	?>
	<svg class="logosvg" width="56.278mm" height="117.64mm" version="1.1" viewBox="0 0 96.278 157.64" xmlns="http://www.w3.org/2000/svg">
 <g transform="translate(-72.067 -33.227)">
  <path d="m93.687 190.08c-3.8028-1.5923-6.8547-6.1893-8.403-12.657-1.2731-5.318-1.2788-20.205-0.0079-21.59 0.42361-0.46205 1.7777 0.37564 1.7777 1.0998 0 0.31856 0.15683 0.47351 0.34851 0.3443 0.19168-0.12921 0.34851-0.0538 0.34851 0.16763 0 0.22141-0.22376 0.40255-0.49724 0.40255-0.27347 0-0.72606 0.5003-1.0057 1.1118-0.4229 0.92463-0.4272 1.0778-0.02549 0.90962 0.26564-0.11116 0.48297-0.0312 0.48297 0.17797 0 0.20907-0.27005 0.49315-0.60011 0.63131-0.47284 0.19789-0.50191 0.31736-0.13706 0.56333 0.35622 0.24014 0.36549 0.37795 0.0401 0.59725-0.32717 0.22053-0.32095 0.35382 0.02759 0.58871 0.35063 0.23635 0.35849 0.42448 0.03549 0.84906-0.32922 0.43264-0.26532 0.75298 0.30908 1.5494 0.67693 0.93865 0.68272 1.006 0.08889 1.034-0.36607 0.0173-0.45061 0.11127-0.19955 0.22174 0.5419 0.23849 0.5795 0.92348 0.04359 0.79358-0.21564-0.0522-0.47122 0.1426-0.56797 0.43304-0.10862 0.32603-0.02371 0.42547 0.22191 0.25989 0.25288-0.17046 0.47567 0.15646 0.61153 0.89739 0.11754 0.64105 0.38231 1.1656 0.58836 1.1656 0.24299 0 0.22768 0.16029-0.04359 0.45615-0.63135 0.68863-0.53355 3.3206 0.13378 3.6 0.44442 0.186 0.46139 0.29364 0.0871 0.55242-0.38377 0.26533-0.38142 0.32242 0.01341 0.32721 0.4054 5e-3 0.4054 0.1039 0 0.64898-0.32612 0.43848-0.33952 0.55219-0.04211 0.35733 0.32676-0.21414 0.39632 0.0536 0.27732 1.0674-0.09971 0.84907-0.01323 1.3532 0.2318 1.3532 0.21485 0 0.29072 0.10897 0.1686 0.24218-0.12211 0.1332 0.10098 0.73699 0.49579 1.3417 0.3948 0.60474 0.58621 1.0742 0.42534 1.0432-0.87778-0.16906-0.7588 0.18472 0.53777 1.5989 0.78925 0.86086 1.435 1.792 1.435 2.0691 0 0.27716 0.27445 0.72744 0.60989 1.0006 0.33543 0.2732 0.65949 0.75329 0.72013 1.0669 0.15089 0.7804 1.1095 1.8361 1.1095 1.2218 0-0.25388 0.16608-0.46158 0.36906-0.46158 0.20299 0 0.27885 0.15924 0.16858 0.35385-0.11028 0.19463-0.05201 0.454 0.1296 0.57638 0.18156 0.1224 0.42861 0.0486 0.54901-0.16378 0.12039-0.21248 0.40567-0.38369 0.63396-0.3805 0.25049 3e-3 0.20779 0.15422-0.10768 0.3801-0.42824 0.30664-0.43861 0.43354-0.05741 0.70191 0.25597 0.18018 0.44024 0.47523 0.4095 0.6557-0.0307 0.18047 0.13452 0.39735 0.36725 0.48197 0.26093 0.0948 0.32102-0.0265 0.15674-0.31631-0.19356-0.34161-0.0639-0.40005 0.47425-0.21376 0.54016 0.18699 0.74066 0.095 0.74066-0.3394 0-0.70017 0.03509-0.70696 1.1847-0.23021 0.56439 0.23406 0.95616 0.23406 1.0888 0 0.11395-0.20106 0.36399-0.36559 0.55567-0.36559 0.19166 0 0.25156 0.17105 0.13312 0.38012-0.11847 0.20907-0.0689 0.38012 0.11015 0.38012s0.5911-0.55592 0.91567-1.2354c0.58086-1.216 0.58678-1.2184 0.37683-0.15285-0.15603 0.79189-0.0923 1.036 0.23753 0.90939 0.24796-0.0952 0.43112-0.44056 0.40703-0.76738-0.0253-0.3433 0.14837-0.51381 0.41124-0.40378 0.64843 0.27138 2.9434-0.99508 2.9434-1.6243v-0.71693c0-0.39866 1.462-1.7631 1.659-1.5482 0.11379 0.12412-0.095 0.46649-0.46412 0.76086-0.36906 0.29433-0.5615 0.65463-0.42765 0.80061 0.13386 0.146 0.71879-0.30229 1.2998-0.99619 0.76506-0.91363 0.93811-1.3437 0.62735-1.559-0.2801-0.19407-0.15682-0.29935 0.35499-0.30315 0.4623-3e-3 0.78413-0.23985 0.78413-0.576 0-0.31361 0.15682-0.57018 0.3485-0.57018 0.19167 0 0.3485-0.23829 0.3485-0.52952s0.2326-0.62686 0.51689-0.74584c0.29411-0.1231 0.42825-0.46828 0.31122-0.8009-0.11312-0.32153-0.0228-0.58458 0.2007-0.58458 0.22349 0 0.31641-0.15875 0.20648-0.35276-0.10994-0.19402 0.11604-0.46212 0.50218-0.5958 0.38615-0.13364 0.70207-0.4796 0.70207-0.76871 0-0.28913 0.27444-0.7021 0.60988-0.91774 0.37685-0.24224 0.47672-0.50363 0.26137-0.68408-0.45294-0.37958-0.64326-1.3685-0.20672-1.0742 0.18331 0.12357 0.55413-0.11921 0.82403-0.53951 0.2699-0.42029 0.60919-0.63697 0.75397-0.48149 0.1448 0.15546 0.22361 0.026 0.17517-0.28753-0.12445-0.80537 0.38264-1.9372 0.75535-1.6859 0.57312 0.38635 0.32058-0.3138-0.29788-0.82587-0.49737-0.4118-0.51283-0.5072-0.0839-0.51706 0.28932-6e-3 0.73217-0.3721 0.98411-0.81211 0.25193-0.44001 0.28966-0.68648 0.0839-0.54776-0.20582 0.13876-0.37423 0.091-0.37423-0.10586 0-0.19701 0.33197-0.45289 0.7377-0.56865 0.61234-0.17464 0.71352-0.43632 0.59541-1.5399-0.11785-1.1011-4e-3 -1.3983 0.66385-1.7301 0.58941-0.29293 0.76653-0.63904 0.65875-1.2873-0.10153-0.61065 0.0861-1.0452 0.60234-1.3959 0.70608-0.47955 0.72042-0.46691 0.24608 0.21707-0.47834 0.68974-0.47146 0.69419 0.13691 0.0883 0.59417-0.59183 0.5991-0.68333 0.0681-1.2626-0.71145-0.77597-0.72656-0.99089-0.0498-0.70764 0.76909 0.32192 0.63606-0.49918-0.23475-1.449-0.53518-0.58373-0.69296-0.64274-0.53757-0.20106 0.12616 0.35859-0.0338 0.90195-0.37512 1.2742-0.3273 0.35699-0.55588 0.70406-0.50795 0.77124 0.28598 0.40104 0.01 1.2626-0.4048 1.2626-0.51393 0-0.55173 0.61509-0.0876 1.4254 0.16058 0.28037 0.1019 0.47515-0.14316 0.47515-0.60617 0-1.7686 1.5854-1.572 2.144 0.0925 0.26284-0.15825 0.59087-0.55714 0.72897-0.51226 0.17733-0.59846 0.33656-0.29352 0.54214 0.30704 0.20695 0.32034 0.36614 0.046 0.55105-0.21215 0.143-0.38571 0.59203-0.38571 0.99781 0 0.40579-0.11761 0.69504-0.26137 0.64278-0.14377-0.0522-0.29499 0.0393-0.33606 0.20362-0.0411 0.16428-0.31696 0.56294-0.61309 0.88593-0.29612 0.32297-0.46635 0.71441-0.37828 0.86984 0.0881 0.15541-0.18493 0.26994-0.60666 0.25444-0.44165-0.0163-0.78672 0.21364-0.81376 0.54203-0.10159 1.2345-0.16184 1.3054-0.52696 0.61993-0.21387-0.40149-0.24407-0.81477-0.0694-0.95027 0.16998-0.13191 0.4985-0.71024 0.73009-1.2852 0.23158-0.57492 0.58126-1.0453 0.77705-1.0453 0.19578 0 0.35597-0.32784 0.35597-0.72856 0-0.40071 0.11762-0.78558 0.26138-0.85526 0.60639-0.29395 3.5496-6.8786 5.7254-12.809 0.94842-2.5851 1.8503-4.9798 2.0041-5.3217 0.32782-0.72837 0.37965-0.89277 3.523-11.174 2.263-7.402 3.5471-12.186 4.7174-17.576 0.27236-1.2544 1.2426-5.4452 2.156-9.3129l1.6608-7.0322 1.5491 0.11081c0.85202 0.061 1.6171 0.18498 1.7002 0.27563 0.38152 0.41611-2.7323 14.676-6.141 28.123-0.37099 1.4635-1.0864 4.2858-1.5898 6.272-1.014 4.0006-4.5841 15.398-6.8398 21.836-3.5636 10.171-7.7387 17.797-12.717 23.227-3.4136 3.7237-6.0263 5.4908-9.1829 6.2112-2.5762 0.58788-3.7865 0.50378-5.9825-0.41574zm27.171-31.622c0-0.67277-0.94816-1.0902-1.2532-0.55174-0.12654 0.22331-0.0139 0.55532 0.25021 0.73782 0.6908 0.47723 1.003 0.41931 1.003-0.18608zm0.34849-1.5205c0-0.0821-0.23523-0.24785-0.52275-0.36818-0.28751-0.12034-0.52275-0.0531-0.52275 0.14939 0 0.2025 0.23524 0.36819 0.52275 0.36819 0.28752 0 0.52275-0.0672 0.52275-0.1494zm0.53573-1.9485c7e-3 -0.41463 0.13407-0.96749 0.28195-1.2286 0.30389-0.53633 0.0159-1.235-0.5103-1.235-0.19167 0-0.25158 0.17106-0.1332 0.38013s-0.0474 0.38012-0.36857 0.38012c-0.4123 0-0.5304 0.22338-0.4018 0.75985 0.10021 0.41792 0.0375 0.85739-0.13928 0.97657-0.49399 0.333 0.0298 0.98215 0.68077 0.84364 0.31757-0.0675 0.58323-0.46212 0.59036-0.87678zm0.91057-3.4138c0-0.19861-0.16866-0.42242-0.37464-0.49733-0.20605-0.0749-0.37463 0.14889-0.37463 0.49733 0 0.34846 0.16865 0.57225 0.37463 0.49733 0.20605-0.0749 0.37464-0.29872 0.37464-0.49733zm0.29623-1.5205c0.24201-0.31807 0.27976-0.57018 0.0852-0.57018-0.19167 0-0.54373 0.25658-0.78236 0.57018-0.24199 0.31806-0.27975 0.57018-0.0854 0.57018 0.19168 0 0.54373-0.25659 0.78235-0.57018zm0.58387-1.2004c-0.12614-0.13757-0.0547-0.47969 0.15877-0.76025 0.28747-0.3778 0.28135-0.51012-0.0236-0.51012-0.22646 0-0.31324-0.17384-0.19284-0.38632 0.12032-0.21247 0.36488-0.28792 0.54332-0.16763 0.17843 0.12028 0.34765-5e-3 0.37602-0.27889 0.0282-0.27366 0.0836-0.75416 0.1226-1.0678 0.0392-0.31358 0.0942-0.79408 0.12261-1.0678 0.0295-0.2851 0.23763-0.38081 0.48724-0.22414 0.23959 0.15038 0.31937 0.13346 0.17727-0.0377-0.14202-0.17108-0.0979-0.52191 0.0983-0.77962 0.19608-0.25769 0.39076-1.0001 0.4326-1.6497 0.0418-0.64965 0.23875-1.1815 0.43755-1.1819 0.1988-3.8e-4 0.38783-0.38233 0.42003-0.84868 0.0321-0.46636 0.26252-1.0223 0.51178-1.2354 0.48284-0.41279 0.74209-2.6029 0.27048-2.285-0.15349 0.10332-0.1969-0.15428-0.0965-0.57268 0.10038-0.41843 0.32091-0.76078 0.49025-0.76078 0.16936 0 0.30785-0.38957 0.30785-0.86572s0.26236-1.2743 0.58302-1.7736c0.32065-0.49931 0.39905-0.78387 0.17429-0.63232-0.55761 0.37588-0.53538-0.98895 0.0268-1.6497 0.28-0.32902 0.29062-0.42324 0.0296-0.26369-0.22324 0.13647-0.4702 0.0378-0.54883-0.2196-0.0787-0.25728-0.33886 0.38083-0.57831 1.418-0.23945 1.0372-0.59002 2.089-0.77903 2.3375-0.18903 0.24843-0.40729 1.149-0.48502 2.0013-0.0776 0.85232-0.31081 1.895-0.51792 2.3171s-0.29181 0.91704-0.1882 1.0999c0.10356 0.18283-0.0459 0.4305-0.33238 0.55039-0.28643 0.1199-0.52076 0.53693-0.52076 0.92676 0 0.38986-0.11555 0.83495-0.25693 0.98908-0.14131 0.15414-0.27186 0.48199-0.29012 0.72856-0.0873 1.181-0.61119 2.888-0.83904 2.7344-0.14061-0.0948-0.18169 0.25006-0.0912 0.76641 0.0905 0.51633 0.0272 0.93881-0.14078 0.93881-0.50728 0-1.1729 1.45-0.95278 2.0756 0.11326 0.32188 0.45049 0.58521 0.74943 0.58521 0.29897 0 0.44038-0.11254 0.31424-0.25011zm5.903-20.973c0.0217-0.45307-0.13514-0.82366-0.34851-0.82351-0.21343 1.5e-4 -0.41114 0.43618-0.43938 0.96896-0.0305 0.57845 0.10973 0.91021 0.34851 0.82352 0.2199-0.0798 0.41762-0.51588 0.43938-0.96897zm0.8317-2.3442c0-0.20908-0.166-0.38014-0.36907-0.38014-0.20299 0-0.27214 0.17106-0.15366 0.38014 0.11855 0.20905 0.28456 0.38011 0.36906 0.38011 0.0847 0 0.15366-0.17106 0.15366-0.38011zm0.28664-1.4255c0.0298-0.36587 0.0663-1.1387 0.0812-1.7174 0.0141-0.57871 0.16159-0.96137 0.32627-0.85036 0.1646 0.11104 0.4761-0.78397 0.69212-1.9888 0.21598-1.2048 0.55736-2.7037 0.7586-3.3309 0.20125-0.62719 0.41523-1.4825 0.47551-1.9006 0.0603-0.41814 0.13531-0.76025 0.16689-0.76025 0.0314 0 0.0889-0.47041 0.12772-1.0453 0.0386-0.57495-0.037-1.0453-0.16847-1.0453-0.30794 0-1.0622 2.3439-0.83432 2.5925 0.0949 0.10367-9e-3 0.42769-0.23171 0.72007-0.22248 0.29237-0.45845 1.0692-0.52441 1.7262-0.066 0.65705-0.29712 1.3141-0.51372 1.4601-0.21659 0.14599-0.30954 0.61689-0.20657 1.0464 0.10303 0.4295 0.0312 0.83759-0.15912 0.90686-0.19051 0.0694-0.34638 0.76168-0.34638 1.5387 0 0.77701-0.12454 1.4128-0.27677 1.4128-0.15225 0-0.25418 0.42752-0.22654 0.95003 0.0568 1.0719 0.77596 1.3107 0.85967 0.28535zm3.5469-13.567c0-0.0921-0.15683-0.27335-0.34849-0.40256-0.19167-0.12921-0.34851-0.0538-0.34851 0.16763 0 0.22139 0.15684 0.40255 0.34851 0.40255 0.19168 0 0.34849-0.0754 0.34849-0.16762zm-34.153 76.952c0-0.20907 0.15684-0.38013 0.3485-0.38013 0.19168 0 0.3485 0.17106 0.3485 0.38013s-0.15681 0.38012-0.3485 0.38012c-0.19167 0-0.3485-0.17105-0.3485-0.38012zm7.1667-5.053c0.13086-0.3749 0.32574-0.58584 0.43305-0.46881 0.10729 0.11703 2.1e-4 0.42375-0.23795 0.6816-0.34419 0.37263-0.38422 0.32896-0.1951-0.21279zm-8.038-2.1693c-0.11846-0.20907 0.02909-0.38011 0.32794-0.38011 0.29883 0 0.54333 0.17104 0.54333 0.38011s-0.14757 0.38013-0.32794 0.38013c-0.18037 0-0.42486-0.17106-0.54333-0.38013zm1.9168 0c0-0.20907 0.5881-0.3775 1.3069-0.3743 0.9721 3e-3 1.173 0.10022 0.78413 0.3743-0.68687 0.48416-2.091 0.48416-2.091 0zm-5.2687-2.6608c-0.27479-1.0004-0.62068-1.5205-1.0112-1.5205-0.44516 0-0.55189-0.23757-0.42697-0.95032 0.10424-0.59486 0.0069-0.9503-0.25986-0.9503-0.24896 0-0.33674-0.25492-0.21094-0.6125 0.16008-0.45499 0.06741-0.55051-0.36051-0.37143-0.48023 0.201-0.50334 0.14559-0.13894-0.33328 0.35636-0.46834 0.33631-0.61655-0.10857-0.80274-0.44663-0.18696-0.46956-0.36226-0.12637-0.9664 0.33919-0.59714 0.31942-0.80729-0.10352-1.1007-0.33311-0.23111-0.36788-0.36482-0.09579-0.36853 0.28394-3e-3 0.35974-0.3722 0.22634-1.0997-0.11033-0.60166-0.0211-1.4597 0.19821-1.9067 0.34395-0.70098 0.28885-0.8609-0.40058-1.1627-0.43967-0.19245-0.62492-0.36076-0.41169-0.37403 0.21324-0.0132 0.34467-0.45171 0.29207-0.97439-0.05261-0.52267 0.03759-0.95028 0.20052-0.95028 0.16288 0 0.27253-0.34211 0.24365-0.76025-0.0289-0.41812-0.19274-0.76022-0.36413-0.76022-0.1714 0-0.2231-0.25165-0.1149-0.55919 0.1082-0.30755-0.04811-0.82629-0.34747-1.1528-0.49326-0.53801-0.44129-0.57378 0.55524-0.38229 1.6894 0.32461 2.5218 1.0193 2.2819 1.9042-0.11336 0.41815-0.29984 2.5219-0.41438 4.6749-0.23406 4.3994 0.54493 9.7472 1.6785 11.523 0.59237 0.92801 0.56018 1.4776-0.0865 1.4776-0.15204 0-0.46437-0.68423-0.69409-1.5205zm9.1023 0.80536c0-0.18427 0.53533-0.78036 1.1896-1.3247 0.65428-0.54433 1.4384-1.2611 1.7425-1.5928 0.30411-0.3317 0.56286-0.46257 0.57502-0.29085 0.0122 0.17175 0.16393-0.0726 0.33726-0.54302 0.17964-0.48742 0.61509-0.85527 1.0125-0.85527 0.48808 0 0.63481 0.17764 0.48902 0.59202-0.11457 0.32562-0.42329 0.50204-0.68607 0.39205-0.26278-0.11-0.47778 0.0131-0.47778 0.27357 0 0.68784-2.0321 3.0082-2.4109 2.7529-0.17652-0.119-0.55764 0.0418-0.84692 0.35731-0.59375 0.6476-0.92426 0.73295-0.92426 0.23868zm-9.9323-0.42524c0.11846-0.20906 0.28454-0.38012 0.36907-0.38012 0.08461 0 0.15368 0.17106 0.15368 0.38012 0 0.20905-0.16608 0.38012-0.36907 0.38012-0.20299 0-0.27215-0.17107-0.15368-0.38012zm22.827-3.3387c0-0.16376 0.84399-2.3447 1.8755-4.8465 1.0316-2.5018 2.3608-6.0883 2.9538-7.9698 1.1021-3.4967 1.3909-4.3647 3.0878-9.2802l0.97287-2.8182 3.1349-0.84793c4.0237-1.0883 11.013-4.008 12.928-5.4008 0.21093-0.15338 1.0636-0.77161 1.8949-1.3739 2.5825-1.8711 6.3954-6.4688 7.601-9.1655 0.60812-1.3604 1.3001-2.4761 1.5378-2.4793 0.32845-3e-3 0.33263-0.0748 0.0176-0.29332-0.22803-0.15813-0.39984-0.85277-0.38185-1.5436 0.0268-1.0259 0.15066-1.2225 0.67597-1.0727 0.79579 0.22698 0.80426 0.10448 0.0496-0.71861-0.32649-0.3561-0.6154-1.1963-0.64206-1.8671-0.0266-0.6708-0.17342-1.4402-0.32619-1.7097-0.18559-0.32754-0.11714-0.43173 0.20644-0.31407 0.26626 0.0968 0.48821 0.3328 0.49319 0.52446 5e-3 0.19164 0.28551 0.79894 0.62341 1.3495 0.33789 0.55064 0.56905 1.2348 0.51369 1.5205-0.0554 0.28565 0.0954 0.4766 0.33497 0.42435 0.51083-0.11139 0.58711 0.51825 0.10232 0.84501-0.18329 0.12356-0.24445 0.47709-0.13584 0.78561 0.1085 0.30851-0.0587 0.98726-0.37175 1.5083-0.31302 0.52105-0.48707 0.94738-0.38683 0.94738 0.1002 0-0.14184 0.35353-0.53803 0.78566-0.57261 0.62455-0.63532 0.89739-0.30585 1.3304 0.33088 0.43485 0.30043 0.54474-0.15084 0.54474-0.36304 0-0.56543 0.32352-0.56543 0.90395 0 0.50114-0.33134 1.1439-0.74362 1.4425-0.70077 0.5075-0.70938 0.57589-0.14942 1.1867 0.56003 0.61084 0.55768 0.65078-0.0406 0.6932-0.34912 0.0248-0.74676 0.0268-0.88361 3e-3 -0.1369-0.0221-0.17589 0.17129-0.0864 0.43012 0.15683 0.45496-1.8253 2.0122-2.3752 1.866-0.14907-0.0396-0.36154 0.18512-0.47214 0.49944-0.11061 0.31435-0.33633 0.48034-0.50165 0.36889-0.1653-0.11139-0.50028 0.14613-0.74433 0.57238-0.24407 0.42624-0.64838 0.77497-0.8985 0.77497s-0.83467 0.41438-1.299 0.92082c-0.46434 0.50645-1.2021 1.0393-1.6396 1.184-0.43746 0.1448-1.1482 0.61552-1.5795 1.0461-0.43126 0.43054-0.78413 0.66307-0.78413 0.51672 0-0.14634-0.4705-7.5e-4 -1.0455 0.32363-0.57503 0.32435-1.0455 0.76386-1.0455 0.97672 0 0.21287-0.27445 0.33676-0.60989 0.27534-0.35793-0.0654-0.57026 0.0964-0.51398 0.3921 0.0658 0.34585-0.12543 0.42719-0.60989 0.25946-0.38816-0.13435-0.70576-0.0812-0.70576 0.11828 0 0.34391-1.0311 0.65272-3.2661 0.97822-0.91039 0.1326-1.5939 0.7509-1.6076 1.4544-4e-3 0.15022 0.21405 0.18133 0.48216 0.069 0.26814-0.11219 0.57714-0.046 0.68668 0.14742 0.24201 0.42712-2.2791 0.31684-2.9582-0.12939-0.40473-0.26594-0.40413-0.2126 4e-3 0.33566 0.42038 0.56508 0.41348 0.62195-0.0519 0.42717-0.29523-0.12356-0.6419-0.0391-0.77039 0.18757-0.12843 0.22672-0.40244 0.29839-0.60882 0.15926-0.24977-0.16837-0.30106 0.0695-0.15331 0.71123 0.17518 0.76146 0.0961 0.95319-0.37642 0.91196-0.67434-0.0587-0.84008 0.82436-0.3011 1.6044 0.25638 0.37103 0.20131 0.64023-0.19587 0.95701-0.90524 0.72197-2.0322 3.0126-2.0336 4.1334-5.8e-4 0.67516-0.18644 1.0453-0.52406 1.0453-0.28752 0-0.52275 0.2426-0.52275 0.5391s-0.0988 0.81987-0.21952 1.163c-0.15207 0.43202 9e-3 0.68907 0.52274 0.83566 0.40826 0.11643 0.74228 0.35746 0.74228 0.53559 0 0.1781-0.26097 0.21461-0.57992 0.0812-0.42379-0.17739-0.50224-0.10552-0.29134 0.26658 0.21091 0.37219 0.13249 0.44397-0.29133 0.2666-0.62241-0.26053-0.80999 0.29368-0.23142 0.68371 0.19167 0.12921 0.34851 0.40598 0.34851 0.61505 0 0.20906-0.13902 0.28636-0.30901 0.1718-0.16989-0.11461-0.51102 0.057-0.75788 0.3816-0.39237 0.51564-0.32981 0.55731 0.497 0.33096 0.68595-0.18779 0.91817-0.12279 0.84501 0.23645-0.061 0.30043 0.28771 0.53453 0.88645 0.59481 1.3184 0.13273 2.1818 0.89122 1.5558 1.3668-0.29082 0.22095-0.14131 0.25159 0.41913 0.0858 1.008-0.29815 1.7586-0.93248 1.1033-0.93248-0.27509 0-0.37335-0.37682-0.27262-1.0453 0.0866-0.57492 0.18316-1.2164 0.21449-1.4254 0.0312-0.20906 0.27238 0.13306 0.53568 0.76026 0.27968 0.66615 0.48529 0.87521 0.49448 0.50272 9e-3 -0.35069 0.44093-1.0024 0.96067-1.4484 0.77744-0.66701 0.85468-0.87302 0.43564-1.1621-0.69776-0.48138-0.10109-0.4566 0.73334 0.0305 0.52257 0.30505 0.67408 0.26944 0.67408-0.15839 0-0.30354 0.17784-0.61653 0.39519-0.69555 0.25864-0.094 0.19751-0.35928-0.17693-0.76769-0.31465-0.3432-0.42747-0.7215-0.25069-0.84066 0.17677-0.11916 0.41322-2e-3 0.52544 0.26085 0.16283 0.38129 0.24497 0.38178 0.40731 2e-3 0.31082-0.72651 0.84599-0.56523 0.6307 0.19005-0.16654 0.58446-0.1399 0.58036 0.21988-0.0339 0.22523-0.38448 0.33814-1.1063 0.25092-1.604-0.0872-0.4977-0.0353-0.82179 0.11555-0.72017 0.62144 0.41891 0.5798-0.49154-0.045-0.98267-0.82991-0.65243-0.89162-1.1911-0.0984-0.85911 0.42109 0.17624 0.50178 0.10494 0.29465-0.26073-0.19547-0.34498-0.15119-0.41302 0.14078-0.21619 0.23437 0.15797 0.32771 0.56928 0.20745 0.914-0.16442 0.47143-0.11926 0.51912 0.18278 0.19241 0.29947-0.324 0.3016-0.63783 9e-3 -1.2354-0.37788-0.77014-0.24213-0.9878 0.50273-0.80603 1.8413 0.44936 3.3334 0.38297 3.5233-0.15679 0.11503-0.32676 0.34941-0.49945 0.52101-0.38379 0.17165 0.11566 0.31199 0.0291 0.31199-0.19225 0-0.22141 0.16795-0.40256 0.3734-0.40256 0.64422 0 1.4291-1.107 1.1434-1.6126-0.14854-0.26294 0.14537-0.18171 0.65323 0.1805 0.88561 0.63165 0.93204 0.62879 1.1353-0.0699 0.13143-0.45151 0.4563-0.67707 0.85474-0.59337 0.48016 0.10091 0.7047-0.16991 0.88766-1.0706 0.13479-0.66304 0.32113-0.9938 0.41424-0.735 0.0932 0.25878-0.079 1.0135-0.38259 1.6772-0.68877 1.5059-0.4965 1.7783 0.46263 0.65536 0.40322-0.47205 0.94617-0.89237 1.2065-0.93407 0.77475-0.12401 1.964-1.4176 1.964-2.1363 0-0.39606 0.35507-0.76571 0.87126-0.90704 0.57606-0.1577 0.88057-0.5143 0.89878-1.0526 0.0159-0.44775 0.099-0.6251 0.1864-0.39414 0.22631 0.598 1.7275 0.20043 2.4271-0.64282 0.48313-0.58228 0.51111-0.81906 0.15243-1.2904-0.37337-0.49055-0.30594-0.57719 0.44932-0.57719 0.54507 0 1.1681-0.3875 1.6114-1.0022 0.39752-0.55123 1.0754-1.0216 1.5064-1.0454 0.60032-0.0331 0.7873-0.27785 0.79928-1.0466 0.0106-0.66959-0.13443-0.94063-0.4356-0.81458-0.24877 0.10413-0.45131-0.0735-0.45131-0.39544 0-0.47599 0.2057-0.51996 1.1096-0.23723 1.2973 0.40583 1.6028 0.22631 0.98846-0.58102-0.24249-0.31865-0.30404-0.58198-0.13672-0.58518 0.16724-3e-3 0.0688-0.17163-0.21872-0.37431-0.44674-0.3149-0.43407-0.36933 0.0872-0.37428 0.33543-3e-3 0.60988 0.19372 0.60988 0.43763s0.10073 0.33359 0.22391 0.19925c0.12313-0.13433 0.0256-0.50494-0.21692-0.82359-0.3595-0.47248-0.35021-0.57936 0.0505-0.57936 0.2702 0 0.51679-0.36949 0.54796-0.82108 0.0312-0.45159 0.23818-0.94338 0.45997-1.0929 0.24347-0.16414 0.30463-0.61074 0.15436-1.1271-0.15965-0.54853-0.12049-0.76876 0.10903-0.61401 0.19686 0.13269 0.68881-0.21751 1.0932-0.77826 0.56843-0.78819 0.63407-1.0896 0.2893-1.3282-0.30761-0.21293-0.31943-0.3105-0.0381-0.31451 0.59247-9e-3 0.95571-2.2096 0.46997-2.848-0.29765-0.39117-0.3025-0.73615-0.0187-1.3148 0.28447-0.57979 0.28104-0.78454-0.0123-0.78454-0.22766 0-0.30714-0.28474-0.18566-0.66521 0.17707-0.55453 0.12525-0.54243-0.31121 0.0727-0.28798 0.40582-0.53708 0.66242-0.55356 0.57017-0.13266-0.74273-0.16371-2.5963-0.0415-2.4628 0.17501 0.19093 1.1168-0.75459 1.1168-1.1212 0-0.13181-0.19603-0.10597-0.43564 0.0571-0.67066 0.45698-1.3069 0.4832-1.3069 0.0539 0-0.21291 0.23524-0.28869 0.52276-0.16834 0.28752 0.12034 0.52275 0.0531 0.52275-0.14939 0-0.37546-0.45898-0.50629-1.394-0.39739-0.44111 0.0514-0.44605 3e-3 -0.0316-0.2999 0.27012-0.19844 0.68997-0.27758 0.93297-0.17588 0.30227 0.12651 0.38134-0.067 0.2504-0.61337-0.15066-0.62859-0.29345-0.70589-0.67158-0.3636-0.36182 0.32754-0.4802 0.32399-0.4802-0.0145 0-0.24699-0.17253-0.33284-0.38326-0.19074-0.26937 0.18159-0.26573 0.0188 0.0123-0.54773 0.21756-0.44338 0.4777-0.80615 0.57809-0.80615s0.0856 0.17107-0.0328 0.38013c-0.11837 0.20907-0.0494 0.38012 0.15366 0.38012 0.54659 0 0.44793-1.1312-0.11943-1.3686-0.26861-0.11243-0.56353-0.51775-0.65533-0.90069-0.19328-0.80617-1.6443-1.8145-1.6443-1.1427 0 0.22876-0.15524 0.31126-0.34501 0.18334-0.21717-0.14638-0.18489-0.42086 0.0872-0.74062 0.26933-0.31658 0.51421-0.36534 0.64998-0.12938 0.14025 0.24376 0.30287 0.22851 0.4566-0.0429 0.1376-0.24282-0.11908-0.56986-0.60583-0.77168-0.46452-0.19261-0.93387-0.72267-1.043-1.1779-0.11008-0.45878-0.36419-0.71591-0.57038-0.57693-0.20458 0.13792-0.37198-3e-3 -0.37198-0.31471 0-0.82437-0.98222-1.7627-1.5823-1.5116-0.38072 0.15936-0.45418 0.0386-0.27919-0.45862 0.16636-0.47256 0.11096-0.58966-0.18429-0.39059-0.25479 0.17177-0.69998-0.10149-1.1248-0.69059-0.3867-0.53618-0.81168-0.94011-0.9444-0.89764-0.13266 0.0425-0.65228-0.22252-1.1546-0.5889-0.50225-0.36638-1.4037-0.70376-2.0032-0.74975-0.59949-0.0461-1.0903-0.24039-1.0907-0.43203-3.5e-4 -0.19163-0.10549-0.23403-0.23378-0.0941-0.12826 0.13982-0.51602-0.025-0.86181-0.36636-0.41932-0.41391-0.96317-0.54762-1.633-0.40151-0.64238 0.14014-1.294-2e-3 -1.808-0.39486-0.49077-0.37494-1.579-0.62959-2.7951-0.65411-1.8501-0.0372-1.9915 0.0212-1.9915 0.82459 0 0.81593 0.26643 1.0214 1.1733 0.90472 0.21403-0.0274 0.60609 0.24162 0.87126 0.5981 0.41179 0.5536 0.41071 0.60124-7e-3 0.32641-0.33949-0.22315-0.41005-0.18162-0.23034 0.13556 0.19047 0.33615 0.38194 0.34612 0.72272 0.0378 0.34343-0.31087 0.53863-0.28898 0.75312 0.0847 0.43661 0.76042 2.1374 1.4875 2.3991 1.0256 0.28911-0.5102 1.0683 0.1976 1.3052 1.1856 0.23183 0.96696-0.27584 0.96129-0.89959-0.0104-0.26766-0.41681-0.57494-0.66153-0.68285-0.54384-0.10779 0.11768-0.4859 0.0283-0.83998-0.19878-0.3541-0.22703-1.8984-0.72348-3.4319-1.1032-2.0255-0.50162-2.7552-0.83775-2.6678-1.2291 0.0661-0.29623 0.18107-0.88073 0.25548-1.2989 0.51683-2.9033 0.45072-2.8095 1.8246-2.5901 10.558 1.6864 18.308 6.4078 22.709 13.835 2.3242 3.9223 2.9119 6.0456 2.9368 10.612 0.0187 3.4401-0.0993 4.3066-0.85587 6.2752-1.3556 3.5275-3.3346 6.5078-6.9496 10.466-4.4241 4.8438-8.4479 7.6484-15.556 10.843-1.7001 0.76402-3.2814 1.5572-3.514 1.7626-0.2596 0.22922-0.46151 1.6929-0.52276 3.7894l-0.0999 3.4159-2.9623 1.3308c-1.6293 0.73192-5.914 2.6856-9.5217 4.3415-3.6077 1.6559-6.6266 3.0107-6.7087 3.0107-0.0821 0-0.14931-0.13399-0.14931-0.29776zm7.9422-5.5542c-0.24714-0.29164-0.58372-0.4413-0.74794-0.3326-0.16425 0.10874-0.0857 0.34474 0.17429 0.52448 0.73541 0.50824 1.0717 0.39578 0.57371-0.19188zm1.4674-13.534c0-0.20905-0.0692-0.38009-0.15366-0.38009-0.0847 0-0.2506 0.17104-0.36906 0.38009-0.11855 0.20908-0.0494 0.38014 0.15366 0.38014 0.20298 0 0.36906-0.17106 0.36906-0.38014zm34.153-19.386c0-0.20908-0.166-0.38013-0.36907-0.38013-0.203 0-0.27214 0.17105-0.15366 0.38013 0.11837 0.20906 0.28454 0.3801 0.36906 0.3801 0.0847 0 0.15366-0.17104 0.15366-0.3801zm-51.35 36.664c0.10616-0.30175 0.33342-0.45401 0.505-0.33835 0.43219 0.29135 0.39241 0.43058-0.19302 0.6756-0.33686 0.141-0.44073 0.0287-0.31198-0.33725zm-10.665-5.9324c-0.68415-1.2271-2.1056-6.4424-2.1152-7.7607-0.0079-1.1479-0.33984-1.4416-3.1312-2.7737-9.4489-4.5095-15.443-10.678-20.211-20.8-1.4456-3.069-1.7451-4.0492-1.7451-5.713 0-1.9359 0.09881-2.1437 2.7374-5.7562 1.5056-2.0613 3.7159-4.8887 4.9119-6.2832l2.1744-2.5353-0.37349-3.5244c-0.20542-1.9384-0.5609-5.1772-0.78994-7.1973-0.3729-3.2887-0.35496-3.7752 0.17153-4.6516 1.2701-2.1143 4.6989-3.2029 11.17-3.5463l4.1446-0.21994-0.2318-3.8378c-0.23949-3.965-0.54093-5.7256-2.0889-12.2-0.49986-2.0907-0.91024-4.2021-0.91198-4.6921-0.0041-1.1503 4.7802-10.486 7.1403-13.934 2.6478-3.8675 2.8056-4.2714 2.0334-5.2022-0.50289-0.60611-0.67486-1.6188-0.81763-4.8149-0.13034-2.9177-0.36038-4.41-0.82427-5.3468-1.233-2.4899-0.1406-6.1406 2.7757-9.2766 2.2736-2.4449 4.1164-3.3323 7.3805-3.5543 2.3421-0.15931 2.9016-0.06712 4.2577 0.70149 0.85872 0.48669 2.2106 1.7622 3.0043 2.8344 1.2422 1.6782 1.475 2.2865 1.6728 4.3714 0.26528 2.7952-0.20047 7.2781-1.0415 10.024-0.70251 2.294-2.6466 4.6311-4.1199 4.9531-2.0184 0.44099-2.2968 0.6099-2.2968 1.3933 0 0.44306 0.9951 1.934 2.2904 3.4317 4.8988 5.6641 6.8586 9.33 8.6822 16.24 1.8251 6.9162 2.4394 11.277 3.4903 24.776l0.2257 2.8996 1.2812-0.3247c3.1204-0.79082 3.7018-0.37485 3.1461 2.2509l-0.41646 1.9678h-1.4503c-1.8116 0-2.0234-0.22644-1.3148-1.406 0.40508-0.67432 0.79254-0.89101 1.3759-0.76937 0.55211 0.11508 0.81198-0.0104 0.81198-0.38883 0-0.33455-0.20495-0.47236-0.51158-0.34402-0.28138 0.11777-0.60429 0.0504-0.71759-0.14939-0.11326-0.19994-0.6811-0.36352-1.2618-0.36352h-1.0558l0.25322 9.2977c0.28282 10.385 0.27103 10.465-2.0114 13.765-2.5638 3.7069-9.4296 8.6791-13.863 10.039-0.86255 0.26467-1.7443 0.62514-1.9594 0.80105-0.21512 0.17592-0.50089 2.0083-0.63502 4.072-0.18955 2.916-0.12181 4.2006 0.30401 5.7645 0.99049 3.6379 0.53147 7.0935-1.5964 12.018-1.471 3.404-4.6382 6.9622-6.197 6.9622-0.83627 0-1.2286-0.26908-1.7465-1.198zm3.2636-2.5081c0.28175-0.57494 1.0941-1.7251 1.8051-2.5558 2.0959-2.4487 3.0613-5.1924 3.013-8.5627-0.12842-8.9468-0.74682-23.415-1.1123-26.023-0.90902-6.4867-3.3997-12.883-6.8543-17.604-1.0299-1.4072-1.8734-2.6868-1.8744-2.8436-0.0051-0.79965 1.1448-0.0864 2.4313 1.5079 5.6946 7.0563 8.5794 14.526 8.9726 23.232l0.19458 4.3084 1.257-0.25416c3.5706-0.72197 9.5082-4.2335 12.398-7.3324 2.6563-2.8482 3.134-4.1196 2.6494-7.0522-0.21274-1.2874-0.61562-7.9-0.89529-14.695-0.55169-13.404-0.85374-16.803-2.1109-23.757-1.5908-8.7994-3.3218-12.636-9.5193-21.097-0.84224-1.1499-1.5853-2.1578-1.6513-2.2399-0.066-0.08207-0.36275 0.0706-0.65953 0.33926-0.859 0.77758-0.9214 0.25601-0.17184-1.4361 0.77357-1.7464 0.86411-2.3651 0.3461-2.3651-0.78403 0-0.25328-0.74772 1.3069-1.8412 2.5272-1.7711 4.5382-4.065 4.9639-5.6621 0.20957-0.78629 0.47465-3.325 0.58906-5.6415 0.20184-4.0868 0.18329-4.2378-0.625-5.0837-1.2543-1.3128-3.362-2.203-5.8863-2.486-2.0595-0.23095-2.4394-0.155-4.1821 0.83622-2.221 1.2633-3.981 3.7708-4.3588 6.2101-0.22648 1.4621 0.0879 2.6374 0.42775 1.5994 0.0855-0.26133 0.27777-0.47515 0.42712-0.47515 0.14934 0-0.0292 1.3257-0.39696 2.9459-0.73349 3.2323-0.66939 7.6795 0.12576 8.7245 0.3504 0.46051 1.0066 0.54585 3.1543 0.41024 1.4915-0.09417 2.7119-0.03567 2.7119 0.13001 0 0.51827-3.2249 2.3898-4.148 2.4073-0.68029 0.01289-0.95003 0.28571-1.1918 1.2055-0.17192 0.65387-1.354 2.5586-2.6268 4.2326-1.2728 1.6741-3.3118 4.9759-4.5311 7.3375-2.5842 5.0051-2.57 4.6949-0.56111 12.221 1.2656 4.7416 1.8765 8.5402 1.896 11.79 0.01006 1.6491 0.09029 1.8173 0.96914 2.0267 4.6902 1.1174 7.0024 1.9253 9.8452 3.4398 2.8664 1.527 3.7552 2.2553 6.6216 5.4259 2.1042 2.3275 3.731 4.5265 4.4639 6.034 0.63418 1.3046 1.0649 2.372 0.95722 2.372s-1.826-1.8388-3.8185-4.0863c-4.3281-4.8821-7.4328-7.0699-12.755-8.9883-3.1116-1.1216-4.4939-1.3868-9.2354-1.772-6.2892-0.51084-11.047-0.26498-12.308 0.63597-0.77833 0.55624-0.82369 0.77173-0.65821 3.1277 0.25281 3.5994 2.102 13.638 3.337 18.115 1.6867 6.115 5.4442 15.91 8.4107 21.926 3.0085 6.1005 3.6726 8.1405 5.2204 16.035 0.56834 2.899 1.2134 5.5076 1.4335 5.7968 0.64349 0.84568 1.6506 0.60826 2.2032-0.51939zm-6.6177-12.335c-0.58697-1.8146-1.204-3.0288-4.4387-8.7346-4.5204-7.9737-7.5717-15.744-8.6686-22.074-0.24451-1.4112-0.62296-2.5658-0.84098-2.5658-0.21804 0-2.1336 1.9559-4.2567 4.3464-3.9905 4.4929-4.6297 5.7313-4.1143 7.9708 0.30288 1.3162 5.3759 9.5527 7.3488 11.931 2.7277 3.2886 8.6424 7.7587 13.17 9.9533 2.2438 1.0875 2.3968 1.0172 1.8002-0.8271zm31.041 15.661c-0.11855-0.20907-0.0494-0.38013 0.15366-0.38013 0.203 0 0.36908 0.17106 0.36908 0.38013 0 0.20906-0.0692 0.3801-0.15366 0.3801-0.0847 0-0.25063-0.17104-0.36908-0.3801zm0.1743-2.6833c0-0.22142 0.15683-0.29686 0.34851-0.16762 0.19167 0.1292 0.34851 0.31035 0.34851 0.40255s-0.15684 0.16763-0.34851 0.16763c-0.19168 0-0.34851-0.18115-0.34851-0.40256zm-1.1812-0.51507c0.17737-0.50781 0.1309-0.64455-0.15366-0.45274-0.22424 0.15119-0.40773 0.0938-0.40773-0.12768 0-0.52562 0.59018-0.51851 0.89004 0.0104 0.12878 0.2273 0.0504 0.61216-0.1743 0.85527-0.31164 0.33722-0.34823 0.26951-0.15437-0.28555zm3.1352-0.0637c-0.28745-0.81706-0.26995-0.9192 0.15754-0.9192 0.20298 0 0.27214 0.17105 0.15366 0.38013-0.11838 0.20905-0.0492 0.3801 0.15366 0.3801 0.20298 0 0.36906 0.17106 0.36906 0.38012 0 0.60134-0.60064 0.44206-0.83397-0.22115zm-42.381-0.91919c0-0.20907 0.16608-0.38011 0.36907-0.38011 0.203 0 0.27215 0.17104 0.15369 0.38011-0.11846 0.20907-0.28455 0.38013-0.36907 0.38013-0.08461 0-0.15369-0.17106-0.15369-0.38013zm43.351-0.22113c0.11643-0.33071 0.21154-0.6829 0.21154-0.78268 0-0.0998 0.14995-0.0802 0.33328 0.0433 0.40459 0.27274 0.0797 1.3407-0.40785 1.3407-0.1917 0-0.25332-0.27057-0.1369-0.60126zm1.8666-2.3593c0.10144-0.28838 0.28209-0.38167 0.4014-0.20734 0.11926 0.17432 0.35045 0.43607 0.51365 0.58166 0.16319 0.14559-0.0176 0.2389-0.4014 0.20735-0.439-0.0361-0.62964-0.25196-0.51365-0.58167zm0.61022-0.84068c-0.11837-0.20906-0.0106-0.38273 0.24083-0.38595 0.33526-3e-3 0.3176-0.11265-0.0667-0.40906-0.40864-0.31522-0.4153-0.3717-0.0303-0.25865 0.27076 0.0796 0.53133 0.43465 0.57905 0.78918 0.0946 0.70229-0.37702 0.87482-0.72286 0.26448zm-1.6612-2.3279c0.23641-0.25978 0.51762-0.37656 0.62492-0.25955 0.10726 0.11704-0.0861 0.32959-0.42982 0.47235-0.49668 0.20627-0.53673 0.16261-0.1951-0.2128zm1.7701-1.733c0.25158-0.10977 0.55216-0.0963 0.66796 0.03 0.1159 0.12631-0.09 0.21614-0.45741 0.19964-0.40597-0.0182-0.48857-0.10828-0.21055-0.22964zm2.8534-0.12044c0.28754-0.20268 0.67959-0.36848 0.87126-0.36848 0.19169 0 0.11326 0.1658-0.1743 0.36848-0.28752 0.20267-0.67958 0.36847-0.87126 0.36847-0.19167 0-0.11326-0.1658 0.1743-0.36847zm-1.5459-0.87167c0.1309-0.37487 0.32575-0.58584 0.43305-0.46881 0.10726 0.11704 2.3e-4 0.42375-0.23795 0.6816-0.34418 0.37262-0.38423 0.32898-0.1951-0.21279zm-0.19665-4.45c0-0.20907 0.15684-0.38013 0.34849-0.38013 0.19168 0 0.34851 0.17106 0.34851 0.38013 0 0.20906-0.15683 0.38012-0.34851 0.38012-0.19167 0-0.34849-0.17106-0.34849-0.38012zm-6.0428-3.3222c-0.20411-0.36023 1.4088-7.3685 1.7846-7.754 0.13778-0.14132 1.5835-0.76163 3.2127-1.3785 4.3793-1.658 5.3567-2.1193 5.8264-2.7501 0.37062-0.49777 0.42594-0.48418 0.43563 0.1069 5e-3 0.37244-0.26337 0.79097-0.59879 0.9301-0.33544 0.13912-0.90572 0.66077-1.2673 1.1592-0.40406 0.55705-0.90002 0.83704-1.2871 0.72664-0.3492-0.0996-0.89549 0.14072-1.2263 0.5394-0.3281 0.39546-0.9682 0.71901-1.4224 0.71901-0.56026 0-0.93241 0.30563-1.1571 0.9503-0.1822 0.52266-0.49747 0.95029-0.70065 0.95029-0.25721 0-0.25982 0.22329-9e-3 0.73525 0.51815 1.056 0.4446 1.4357-0.11608 0.59933-0.45976-0.68582-0.49199-0.68056-0.8981 0.14709-0.23166 0.47216-0.32894 1.1207-0.21618 1.4412 0.1519 0.43172 0.0487 0.51736-0.39816 0.33035-0.33177-0.13888-0.49282-0.13207-0.35786 0.0151 0.13496 0.14718 2e-3 0.46167-0.29543 0.69887-0.43228 0.34479-0.22147 0.4313 1.0509 0.4313 1.3669 0 1.5924-0.10932 1.597-0.77383 4e-3 -0.54782 0.0886-0.63075 0.29029-0.28393 0.20282 0.34869 0.52769 0.38921 1.1273 0.14057 0.4633-0.19213 0.99918-0.38691 1.1909-0.43287 0.19167-0.0461 0.30929-0.2375 0.26137-0.42565-0.12984-0.50991 0.6957-0.39107 1.4149 0.20366 0.76485 0.63252 0.62963 0.73427-2.0248 1.5232-2.8021 0.83284-3.1897 0.94293-4.0356 1.1461-0.39866 0.0958-1.0128 0.27377-1.3647 0.39559-0.35194 0.12183-0.71944 0.0811-0.81672-0.0905zm9.0609-3.3082c-0.14625-0.41564 0.17042-0.6802 1.1628-0.97167 0.75005-0.22031 1.6092-0.66824 1.9092-0.99542 0.29998-0.32719 0.81673-0.63832 1.1483-0.6914 0.33159-0.0531 0.60641-0.33678 0.61071-0.63046 4e-3 -0.29368 0.27876-0.48368 0.60989-0.42224 0.35017 0.065 0.60207-0.12886 0.60207-0.46323 0-0.35487 0.20009-0.49117 0.52275-0.35612 0.36275 0.15183 0.52276-0.0265 0.52276-0.58211 0-0.4405 0.166-0.80091 0.36907-0.80091 0.20299 0 0.27214 0.17106 0.15366 0.38012-0.24693 0.43577-0.10108 0.47151 0.64649 0.15861 0.292-0.12222 0.44093-0.47256 0.33224-0.78153-0.20125-0.572 0.96438-2.0379 1.6205-2.0379 0.19968 0 0.36308-0.18113 0.36308-0.40255 0-0.22141 0.19603-0.2741 0.43562-0.11709 0.25344 0.16607 0.21701-0.0132-0.0872-0.42887-0.47138-0.6441-0.46565-0.69098 0.0582-0.47707 0.34071 0.1391 0.65771 0.0194 0.76638-0.2896 0.12472-0.35436-9e-3 -0.46906-0.40678-0.35038-0.32568 0.097-0.18619-0.04 0.30996-0.30446 0.61924-0.3301 0.88303-0.75405 0.84129-1.3521-0.0335-0.47922 0.18794-1.032 0.49192-1.2284 0.48872-0.3158 0.49219-0.40613 0.03-0.78009-0.4466-0.36132-0.43554-0.39243 0.076-0.21362 0.83252 0.29106 1.1439-0.43481 0.51775-1.2069-0.44037-0.54297-0.52191-1.3385-0.2897-2.8269 0.0245-0.15681 0.27973-0.28509 0.56723-0.28509 0.29042 0 0.52277-0.33788 0.52277-0.76025 0-0.41813-0.17359-0.76024-0.3858-0.76024-0.21216 0-0.29744-0.2511-0.18945-0.558 0.10796-0.30691 0.0667-0.64546-0.0921-0.75234-0.28463-0.19185-0.86385-2.4131-0.77344-2.966 0.0258-0.15679-0.19016-0.28509-0.47953-0.28509-0.28941 0-0.79473-0.34211-1.123-0.76024-0.32824-0.41814-0.87558-0.76024-1.2163-0.76024-0.55795 0-0.78085-0.4205-0.65868-1.2425 0.024-0.16069-0.34962-0.4875-0.82998-0.72622-0.4804-0.23874-0.87343-0.57767-0.87343-0.75318 0-0.1755-0.23523-0.31909-0.52276-0.31909-0.28752 0-0.52277-0.17106-0.52277-0.38014 0-0.20907-0.3828-0.38011-0.85067-0.38011-0.46791 0-0.94763-0.17106-1.0661-0.38011-0.34498-0.60881-0.87032-0.43899-0.88186 0.28509-0.0106 0.63352-0.0275 0.63352-0.36583 0-0.19537-0.36587-0.58267-0.6652-0.86066-0.6652-0.278 0-0.50545-0.19102-0.50545-0.42447 0-0.24789-0.31337-0.33508-0.75334-0.20958-0.92123 0.26276-2.0347-0.33367-2.0347-1.0899 0-1.264 4.3083-0.33901 8.0068 1.719 2.3634 1.3151 4.9969 4.2759 6.3067 7.0904 1.0801 2.3211 1.1713 2.7911 1.1611 5.9843-9e-3 2.7114-0.17377 3.8572-0.75845 5.2661-1.8027 4.3437-5.9568 8.8787-10.239 11.178-3.0203 1.6216-3.6546 1.8018-3.8988 1.1077zm18.763-0.972c-0.5682-0.2663-0.58812-0.33162-0.10762-0.35339 0.32413-0.0147 0.68626 0.14433 0.8047 0.35339 0.24769 0.4371 0.23557 0.4371-0.697 0zm-12.895-5.3217c-0.11855-0.20906-0.0494-0.38012 0.15366-0.38012 0.203 0 0.36908 0.17106 0.36908 0.38012s-0.069 0.38011-0.15366 0.38011c-0.0847 0-0.2506-0.17105-0.36906-0.38011zm15.792-1.4c0.25158-0.10977 0.55218-0.0963 0.66797 0.0301 0.11573 0.12631-0.09 0.21614-0.4574 0.19964-0.40601-0.0182-0.48859-0.10828-0.21057-0.22967zm-15.617-5.5839c0-0.078 0.317-0.92339 0.70446-1.8787 0.38744-0.95537 0.79501-2.4738 0.90572-3.3744 0.23551-1.9157 0.7091-2.6547 1.1747-1.8329 0.21236 0.37482 0.13248 0.77984-0.24277 1.2322-0.34097 0.41096-0.40208 0.67391-0.15666 0.67391 0.22137 0 0.40251 0.25657 0.40251 0.57015 0 0.31363-0.19603 0.57031-0.43564 0.57047-0.23959 1.5e-4 -0.45788 0.42153-0.48509 0.93638-0.0273 0.51484-0.30163 1.2112-0.60986 1.5474-0.30823 0.33618-0.56044 0.85559-0.56044 1.1543 0 0.29866-0.15683 0.54303-0.34849 0.54303-0.19169 0-0.34851-0.0637-0.34851-0.14175zm18.031-0.39047c-0.57712-0.47776-0.57832-0.53941-0.0203-1.0332 0.43618-0.386 0.52164-0.39484 0.32236-0.0334-0.14907 0.27047-0.0815 0.74088 0.14995 1.0453 0.51928 0.68248 0.35585 0.69016-0.45217 0.0213zm-16.289-7.8529c0-0.2214 0.15683-0.29683 0.34851-0.16761 0.19166 0.12921 0.34849 0.31034 0.34849 0.40254s-0.15683 0.16763-0.34849 0.16763c-0.19169 0-0.34851-0.18116-0.34851-0.40256zm7.4928-2.2583c0.11855-0.20906 0.28456-0.38011 0.36908-0.38011 0.0847 0 0.15366 0.17105 0.15366 0.38011 0 0.20907-0.16601 0.38012-0.36908 0.38012-0.20299 0-0.27216-0.17105-0.15366-0.38012zm-0.52275-1.733c0-0.32595 0.1593-0.48516 0.35418-0.35384 0.1948 0.13131 0.26397 0.39796 0.15366 0.5926-0.29874 0.52724-0.50786 0.42893-0.50786-0.23876zm-12.198-3.5887c-0.31409-0.2214-0.3571-0.3708-0.10761-0.37431 0.22828-3e-3 0.51197 0.16523 0.63045 0.37431 0.2674 0.47192 0.14678 0.47192-0.52277 0zm8.3641-0.40255c0-0.22142 0.15683-0.29685 0.34851-0.16764 0.19167 0.12922 0.34849 0.31036 0.34849 0.40256s-0.15683 0.16763-0.34849 0.16763c-0.1917 0-0.34851-0.18114-0.34851-0.40255zm-10.869-0.61738c0.25159-0.10977 0.55218-0.0963 0.668 0.0301 0.11572 0.12632-0.09 0.21617-0.45743 0.19966-0.40599-0.0182-0.48857-0.10828-0.21057-0.22967zm-8.5203-1.0682c-0.12067-0.3431-0.0418-0.81759 0.17535-1.0544 0.62051-0.67682 0.46246-1.4189-0.30225-1.4189-0.38335 0-0.697-0.17106-0.697-0.38013 0-0.59043 2.4339-0.45824 2.6457 0.1437 0.10144 0.2881 0.0473 1.1004-0.12014 1.805-0.32926 1.3859-1.3428 1.9248-1.7017 0.90474zm-0.30118-1.7131c0.11838-0.20908 0.28454-0.38013 0.36908-0.38013 0.0847 0 0.15366 0.17105 0.15366 0.38013 0 0.20906-0.16601 0.38012-0.36906 0.38012-0.203 0-0.27216-0.17106-0.15366-0.38012z" fill="#00e" stroke-width=".36397"/>
  <text x="127.25198" y="60.468071" fill="#f10000" font-family="sans-serif" font-size="10.583px" letter-spacing="0px" stroke-width=".26458" word-spacing="0px" style="line-height:1.25" xml:space="preserve"><tspan x="127.25198" y="60.468071">FVP</tspan><tspan x="127.25198" y="73.697235">JOSE </tspan><tspan x="127.25198" y="86.926407">PLANES </tspan></text>
 </g>
</svg><?php
}

function contactoview(){
	?>
	
	<?php echo $_SESSION['lang']['contacto'];
}

function emailenviado() {
	?>
	<div class="caja">
		<div class="categorias"><?= $_SESSION['lang']['mail_password_sent']; ?><span style="font-size: 16px"></span></div>
		<div class="tema">
			<h2><?= $_SESSION['lang']['mail_password_spam']; ?></h2>
		</div>
	</div>
	<?php
}

function errormailview() {
	?>
	<div class="caja">
		<div class="tema">
			<h2><?= $_SESSION['lang']['mail_error']; ?></h2>
		</div>
	</div>
	<?php
}

function passwordresetview($mensaje = null) {
	if($mensaje != null) {
		?>
			<h2><?= $mensaje; ?></h2>
		<?php
	}
	?>
	<div class="modal-dialog text-center">
	 <div class="col-sm-8 main-section">
	  <div class="modal-content">
	   <div class="col-12 user-img">
		<img src="img/loginimage.png" alt="Imagen logo">
	   </div>
	   <form class="col-12" method="post" autocomplete="off" action="<?= Conexion::ruta(); ?>?action=recoverpassword&signature=<?= $_GET['signature']; ?>&timestamp=<?= $_GET['timestamp']; ?>">
		<div class="form-group password-label">
		 <input type="password" class="form-control" name="password" placeholder="<?php echo $_SESSION['lang']['login_password_label'] ?>" required>
		</div>
		<div class="form-group">
		 <input type="password" class="form-control" name="password-repeat" placeholder="<?php echo $_SESSION['lang']['login_password_label'] ?>" required>
		</div>
		<button type="submit" name="enviar" class="btn-login"><i class="fas fa-sync-alt"></i><?php echo $_SESSION['lang']['password_update'] ?></button>
	   </form>
	   </div>
	  </div>
	 </div>
	</div>
	<?php
}
?>