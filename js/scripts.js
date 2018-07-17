
$(document).ready(function(){
	
	$('#buscador-resultados').hide();
	
	//cambiando la clase de las etiquetas <a>
	
	$('a').each(function(i,e){
		
		$e = $(e);
		
		if($e.hasClass('btn btn-link'))
		{
			$e.removeClass('btn btn-link');
			$e.addClass('btn btn-danger btn-sm');
		}	
		
	});
	
	$('.nuevotema a').each(function(i,e){
		
		$e = $(e);
		$e.addClass('btn btn-primary btn-sm');
		
		
	});
	
	/*$('input[type=submit],button[type=submit]').each(function(i,e){
		
		$e = $(e);
		$e.addClass('btn btn-success btn-sm');
		
		
	});*/
	
	
	//cambiando el ancho de las imagenes de los comentatios
	
	$(".tema img").each(function(i,e){
		
		$e = $(e);
		
		$e.attr("style","max-width:500px");
		
	});
	
	//quitar menasjes de error del editor
	
	setTimeout(function(){$('.mce-notification-inner').each(function(i,e){
		$e = $(e);
		$e.parent().remove();
		
	});},3000);
	
	$('#close-overlay').click(function() {
		$('#overlay').hide();
	});
	
	$('#forgotpassoword').click(function() {
		$('#overlay').css('display', 'flex');
	});
	
	//validacion formulario registro
	
	$("#formulario_nombre,#formulario_nombre_usuario").keyup(function(i,e){
		
		var $e = $(this);
		
		var input = $e.val();
		
		if(input.length >= 2 && input.length <= 15 )
		{
			
			$e.parent().children('.verify').each(function(){
				
				$(this).attr('style','position:absolute;right:20px;color:lightgreen;display:inline-block');
				
			});
		}
		else
		{
			$e.parent().children('.verify').each(function(){
				
				$(this).attr('style','display:none');
				
			});
		}	
	});
	
	//validacion formulario registro
	
	$("#formulario_password").keyup(function(i,e){
		
		var $e = $(this);
		
		var input = $e.val();
		
		if(input.length >= 5)
		{
			
			$e.parent().children('.verify').each(function(){
				
				$(this).attr('style','position:absolute;right:20px;color:lightgreen;display:inline-block');
				
			});
		}
		else
		{
			$e.parent().children('.verify').each(function(){
				
				$(this).attr('style','display:none');
				
			});
		}	
	});
		
	$("#formulario_correo").keyup(function(i,e){
		
		var $e = $(this);
		
		var input = $e.val();
		
		var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	
		if(re.test(String(input).toLowerCase()))
		{
			
			$e.parent().children('.verify').each(function(){
				
				$(this).attr('style','position:absolute;right:20px;color:lightgreen;display:inline-block');
				
			});
		}
		else
		{
			$e.parent().children('.verify').each(function(){
				
				$(this).attr('style','display:none');
				
			});
		}	
	});


	//validacion comentarios
	setTimeout(function(){
		
		var maxLen = 2500;
		var tituloLen = 100;
		
		$(".tema form").each(function(){
		
		var $e = $(this);
		
		$e.submit(function(evt){
			
			var txt =$("textarea").val();
			var titulo = $(".tema input[name='titulo']").val();
			
			titulo = titulo.trim();
			txt = txt.replace(/<[^>]*>/g, '').trim();
			
			if(txt.length > maxLen)
			{
				evt.preventDefault();
				$('#comentario_error').remove();
				$(".foro .tema").last().prepend("<div id='comentario_error' class='alert alert-danger'>El comentario no puede superar los <strong>"+maxLen+"</strong> caracteres. Caracteres escritos: <strong>"+txt.length+"</strong></div>");
				
			}
			if(titulo.length > tituloLen)
			{
				evt.preventDefault();
				$('#titulo_error').remove();
				$(".foro .tema").last().prepend("<div id='titulo_error' class='alert alert-danger'>El titulo no puede superar los <strong>"+tituloLen+"</strong> caracteres. Caracteres escritos: <strong>"+titulo.length+"</strong></div>");
			}		
		});
		
	});	
	
	},100)
	
	//validar perfil usuario
	
	$("#editar_perfil_formulario").submit(function(evt){
		
		var maxLen = 50;
		var $e = $(this);
		var valid = true;
		
		var caracteristicas = [];
		var count = 0;

		$("#editar_perfil_formulario input").each(function(){
			
			$input = $(this);
			
			if($input.val().length > maxLen)
			{
				$input.css({'background-color':'red'})
				caracteristicas[count]= $input.attr('name');
				valid = false;
				count++;
			}
			
		});
		
		var error_string = caracteristicas.join(', ');
		
		if(!valid)
		{
			$("#campo_error").remove();
			$("#editar_perfil_formulario").prepend("<div id='campo_error' class='alert alert-danger'>Caracteres máximos por campo: <strong>"+maxLen+"</strong>. Campos erróneos: <strong>"+error_string+"</strong></div>");
			evt.preventDefault();
		}		
		
	});
	
	//Buscador Google jQuery
	var pal = "";
	var reps = null;
	$('#buscador').keyup(function(evento) {
		
		if (evento.which == 16)
			return false;
		
		if (evento.which == 38 && $('#buscador-resultados').children().children().length >=1) {
			if (!$(".sugerMarcada").length && $('#buscador').hasClass('actual')) {
				$('#buscador').removeClass('actual');
				$("#buscador-resultados>ul>li:last").addClass("sugerMarcada");
				$('#buscador').val($('#buscador-resultados .sugerMarcada').find('#tema_buscador_titulo').text());
			} else if ( !$("#buscador-resultados>ul>li:first").hasClass("sugerMarcada") ) {
				$(".sugerMarcada").removeClass("sugerMarcada").prev().addClass('sugerMarcada');
				$('#buscador').val($('#buscador-resultados .sugerMarcada').find('#tema_buscador_titulo').text());
			} else {
				$('.sugerMarcada').removeClass('sugerMarcada');
				$('#buscador').addClass('actual');
				$('#buscador').val(pal);
			}
		}
		else if (evento.which == 40 && $('#buscador-resultados').children().children().length >=1) {
			if (!$(".sugerMarcada").length && $('#buscador').hasClass('actual')) {
				$('#buscador').removeClass('actual');
				$("#buscador-resultados>ul>li:first").addClass("sugerMarcada");
				$('#buscador').val($('#buscador-resultados .sugerMarcada').find('#tema_buscador_titulo').text());
			}
			else if ( !$("#buscador-resultados>ul>li:last").hasClass("sugerMarcada") ) {
				$(".sugerMarcada").removeClass("sugerMarcada")
								  .next()
								  .addClass("sugerMarcada");
				$('#buscador').val($('#buscador-resultados .sugerMarcada').find('#tema_buscador_titulo').text());
			}
			else {
				$('.sugerMarcada').removeClass('sugerMarcada');
				$('#buscador').addClass('actual');
				$('#buscador').val(pal);
			}
		}
		else if(evento.which == 37) {
			$('.sugerMarcada').removeClass('sugerMarcada');
			$('#buscador').addClass('actual');
		}
		else if(evento.which == 39) {
			$('.sugerMarcada').removeClass('sugerMarcada');
			$('#buscador').addClass('actual');
		}
		else if (evento.which == 13) {
			if(!$('#buscador').hasClass('actual')) {
				$('.sugerMarcada').removeClass('sugerMarcada');
				$('#buscador-resultados').empty().hide();
				$('#buscador').addClass('actual');
			}
			else
				return false;
		}
		
		else {
			if ($('#buscador').val()==''){
				$("#buscador-resultados").empty();
				$("#buscador-resultados").hide();
			}
			else {
				$('.sugerMarcada').removeClass('sugerMarcada');
				$('#buscador').addClass('actual');
				
				$("#buscador-resultados ul").empty();
				$("#buscador-resultados").show();
				var ptr = $(this).val();
				pal = ptr;
				$.ajax({
					url: 'php/buscador.php',
					type: 'GET',
					data: {patron: ptr},
					dataType: 'json',
					success: function(json) {
						if(json.length==0)
							return false;
						
						$ultemas = $('<ul></ul>');
						$('#buscador-resultados').append($ultemas);
						if(json.length<5)
							reps = json.length;
						else
							reps = 5;
						
						var temaid = null;
						var foroid = null;
						var subforoid = null;
						
						for(i=0; i<reps; i++) { //Maximo 5 temas
							temaid = json[i].id_tema;
							foroid = json[i].id_foro;
							subforoid = json[i].id_subforo;
							
							url = "http://www.nicolasmeseguer.com/ForoVirtualPlanes/index.php?temaid="+temaid+"&foro="+foroid+"&sub="+subforoid;

							var $li = $('<li><a href="http://www.nicolasmeseguer.com/ForoVirtualPlanes/index.php?temaid='+temaid+'&foro='+foroid+'&sub='+subforoid+'"><span id="tema_buscador_titulo">'+json[i].titulo+'</span></a></li>');
							$li.hover(function(){
								$(this).css('background-color','lightgrey');
							},function() {
								$(this).css('background-color','');
							});
							$ultemas.append($li);
						}
					},
					error: function() {
					}
				});
			}
		}
		
	});
	
});