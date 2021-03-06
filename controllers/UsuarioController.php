<?php

require_once 'models/usuario.php';

class UsuarioController {

	public function inicio(){
		require_once('./views/pages/index.php');
	}
	public function alumno(){
		require_once('./views/pages/alumno.html');
	}
	public function instrucciones(){
		require_once('./views/pages/instrucciones.html');
	}
	public function login() {
		session_start();
    session_destroy();
    // require_once('./views/includes/cabecera.php');
    require_once('./views/pages/login.php');
    // require_once('./views/includes/pie.php');
	}


	public function signup() {

    require_once('./views/pages/signup.php');
	}

	public function guardarUsuario($datos) {
		$errores = '';
		if (!isset($datos['email'])) {
			$errores .= '<p>Falta el correo</p>';
		} else {
			$errores = '';
		}
		//obtiene el codigo antes del email
		$datos['codigo']=substr($datos['email'],0,8);
		$usuario = new Usuario();
		$usuario->guardarUsuario($datos);
		session_destroy();

	}

	public function accesoUsuario($datos) {
		session_start();
		$usuario = new Usuario();
		$respuesta = $usuario->accesoUsuario($datos['email'], $datos['password']);

		if ($respuesta != false) {
			foreach ($respuesta as $r) {
				var_dump($r);
				$_SESSION['id_usuario'] = $r['id'];
				$_SESSION['id_rol'] = $r['id_rol'];
				
			}
		
			if ($_SESSION['id_rol'] == 1) {
				header('Location: index.php?page=docente');
        die();
			} 
		if($_SESSION['id_rol'] == 2){
				header('Location: index.php?page=test&codigo='.$datos["email"].'&idpregunta=0&view=elegidos');
        die();
			}
			else {
				header('Location: index.php?page=test&codigo='.$datos["email"].'&idpregunta=1');
        die();
			}

		}
		echo "<script>
		alert('Usuario y/o contraseña');
		</script>";
		header('index.php?page=login');

	}


}