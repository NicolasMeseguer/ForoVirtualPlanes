<?php
//Características de la API, solo permite peticiones(requests) que se hagan en el mismo dia. Controlándolo con timestamp en cada petición.

require_once 'conexion.php';

class api extends Conexion {
	
	public $mysqli;
	public $timestamp;
	
	public function __construct() {
        $this->timestamp = time();
		$this->mysqli = parent::conectar();
    }
	
	public function index() {
		header('Content-Type: application/json');
		return json_encode(array(
			'status' => '1',
			'message' => 'OK',
			'data' => array(
				'env' => 'live',
				'info' => 'API is working'
			)
		));
	}
	
	public function error() {
		header('Content-Type: application/json');
		return json_encode(array(
			'status' => '0',
			'message' => 'error',
			'data' => array(
				'env' => 'live',
				'info' => 'Rute not found'
			)
		));
	}
	
	public function errorparams() {
		header('Content-Type: application/json');
		return json_encode(array(
			'status' => '0',
			'message' => 'error',
			'data' => array(
				'env' => 'live',
				'info' => 'Missing parameters'
			)
		));
	}
	
	public function checkuser($backendsignature, $signature, $ts, $userid) {
		header('Content-Type: application/json');
		
		if($backendsignature == null) {
			$status = 0;
			$message = 'error';
			$info = 'PartnerID is not correct';
		}
		else {
			if($backendsignature === $signature) {
				if(time() - 86400 > $ts ) {
					$status = 0;
					$message = 'error';
					$info = 'Invalid request time has expired';
				}
				else {
					//Connect DB check User
					$resultado = $this->mysqli->query("SELECT * FROM usuarios WHERE id = '$userid'");

					while ( $fila = $resultado->fetch_assoc() ) {
						$data[] = $fila;
					}
					if(empty($data) || !isset($data)) {
						$status = 1 ;
						$message = 'OK';
						$info = 'No users found';
					}
					else {
						//return special response
						return json_encode(array(
							'status' => '1',
							'message' => 'OK',
							'data' => array(
								'env' => 'live',
								'info' => 'User has been succesfully found',
								'user' => array(
									'id' => $data[0]['id'],
									'nick' => $data[0]['nick'],
									'name' => html_entity_decode($data[0]['nombre']),
									'email' => $data[0]['correo'],
									'privilegios' => $data[0]['privileges'],
									'activo' => $data[0]['activo']
								)
							)
						));
						die();
					}
				}
			} else {
				$status = 0;
				$message = 'error';
				$info = 'Signature mismatch';
			}
		}
		
		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'data' => array(
				'env' => 'live',
				'info' => $info
			)
		));
		
	}
	
	public function getcategorias($backendsignature, $signature, $ts) {
		header('Content-Type: application/json');
		
		if($backendsignature == null) {
			$status = 0;
			$message = 'error';
			$info = 'PartnerID is not correct';
		}
		else {
			if($backendsignature === $signature) {
				if(time() - 86400 > $ts ) {
					$status = 0;
					$message = 'error';
					$info = 'Invalid request time has expired';
				}
				else {
					//Connect DB check User
					$resultado = $this->mysqli->query("SELECT * FROM foro_categoria");

					while ( $fila = $resultado->fetch_assoc() ) {
						$data[] = $fila;
					}
					
					$number = $resultado->num_rows;
					
					if(empty($data) || !isset($data)) {
						$status = 1 ;
						$message = 'OK';
						$info = 'No cateogries were found';
					}
					else {
						//return special response
						return json_encode(array(
							'status' => '1',
							'message' => 'OK',
							'data' => array(
								'env' => 'live',
								'info' => $number.' categories were found',
								'categories' => $data
							)
						));
						die();
					}
				}
			} else {
				$status = 0;
				$message = 'error';
				$info = 'Signature mismatch';
			}
		}
		
		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'data' => array(
				'env' => 'live',
				'info' => $info
			)
		));
	}
	
	public function getforos($backendsignature, $signature, $ts) {
		header('Content-Type: application/json');
		
		if($backendsignature == null) {
			$status = 0;
			$message = 'error';
			$info = 'PartnerID is not correct';
		}
		else {
			if($backendsignature === $signature) {
				if(time() - 86400 > $ts ) {
					$status = 0;
					$message = 'error';
					$info = 'Invalid request time has expired';
				}
				else {
					//Connect DB check User
					$resultado = $this->mysqli->query("SELECT * FROM foro_foro");

					while ( $fila = $resultado->fetch_assoc() ) {
						$data[] = $fila;
					}
					
					$number = $resultado->num_rows;
					
					if(empty($data) || !isset($data)) {
						$status = 1 ;
						$message = 'OK';
						$info = 'No forums were found';
					}
					else {
						//return special response
						return json_encode(array(
							'status' => '1',
							'message' => 'OK',
							'data' => array(
								'env' => 'live',
								'info' => $number.' forums were found',
								'threads' => $data
							)
						));
						die();
					}
				}
			} else {
				$status = 0;
				$message = 'error';
				$info = 'Signature mismatch';
			}
		}
		
		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'data' => array(
				'env' => 'live',
				'info' => $info
			)
		));
	}
	
	public function getsubforos($backendsignature, $signature, $ts) {
		header('Content-Type: application/json');
		
		if($backendsignature == null) {
			$status = 0;
			$message = 'error';
			$info = 'PartnerID is not correct';
		}
		else {
			if($backendsignature === $signature) {
				if(time() - 86400 > $ts ) {
					$status = 0;
					$message = 'error';
					$info = 'Invalid request time has expired';
				}
				else {
					//Connect DB check User
					$resultado = $this->mysqli->query("SELECT * FROM foro_subforos");

					while ( $fila = $resultado->fetch_assoc() ) {
						$data[] = $fila;
					}
					
					$number = $resultado->num_rows;
					
					if(empty($data) || !isset($data)) {
						$status = 1 ;
						$message = 'OK';
						$info = 'No subthreads were found';
					}
					else {
						//return special response
						return json_encode(array(
							'status' => '1',
							'message' => 'OK',
							'data' => array(
								'env' => 'live',
								'info' => $number.' subthreads were found',
								'subthreads' => $data
							)
						));
						die();
					}
				}
			} else {
				$status = 0;
				$message = 'error';
				$info = 'Signature mismatch';
			}
		}
		
		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'data' => array(
				'env' => 'live',
				'info' => $info
			)
		));
	}
	
	public function topposters($backendsignature, $signature, $ts) {
		header('Content-Type: application/json');
		
		if($backendsignature == null) {
			$status = 0;
			$message = 'error';
			$info = 'PartnerID is not correct';
		}
		else {
			if($backendsignature === $signature) {
				if(time() - 86400 > $ts ) {
					$status = 0;
					$message = 'error';
					$info = 'Invalid request time has expired';
				}
				else {
					//Connect DB check User
					$resultado = $this->mysqli->query("SELECT u.id, u.nick, u.nombre, COUNT(f.id_tema) temas FROM usuarios u, foro_temas f WHERE f.id_usuario = u.id GROUP BY u.id ORDER BY temas DESC LIMIT 3");

					while ( $fila = $resultado->fetch_assoc() ) {
						$data[] = $fila;
					}
					
					if(empty($data) || !isset($data)) {
						$status = 1 ;
						$message = 'OK';
						$info = 'No posts/users were found';
					}
					else {
						//return special response
						return json_encode(array(
							'status' => '1',
							'message' => 'OK',
							'data' => array(
								'env' => 'live',
								'info' => 'Top 3 posters',
								'users' => $data
							)
						));
						die();
					}
				}
			} else {
				$status = 0;
				$message = 'error';
				$info = 'Signature mismatch';
			}
		}
		
		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'data' => array(
				'env' => 'live',
				'info' => $info
			)
		));
	}
	
	public function topcomments($backendsignature, $signature, $ts) {
		header('Content-Type: application/json');
		
		if($backendsignature == null) {
			$status = 0;
			$message = 'error';
			$info = 'PartnerID is not correct';
		}
		else {
			if($backendsignature === $signature) {
				if(time() - 86400 > $ts ) {
					$status = 0;
					$message = 'error';
					$info = 'Invalid request time has expired';
				}
				else {
					//Connect DB check User
					$resultado = $this->mysqli->query("SELECT u.id, u.nick, u.nombre, COUNT(c.id_comentario) comentarios FROM usuarios u, comentario_foro c WHERE c.id_usuario = u.id GROUP BY u.id ORDER BY comentarios DESC LIMIT 3");

					while ( $fila = $resultado->fetch_assoc() ) {
						$data[] = $fila;
					}
					
					if(empty($data) || !isset($data)) {
						$status = 1 ;
						$message = 'OK';
						$info = 'No comments/users were found';
					}
					else {
						//return special response
						return json_encode(array(
							'status' => '1',
							'message' => 'OK',
							'data' => array(
								'env' => 'live',
								'info' => 'Top 3 users who made the most comments',
								'users' => $data
							)
						));
						die();
					}
				}
			} else {
				$status = 0;
				$message = 'error';
				$info = 'Signature mismatch';
			}
		}
		
		return json_encode(array(
			'status' => $status,
			'message' => $message,
			'data' => array(
				'env' => 'live',
				'info' => $info
			)
		));
	}
}

?>