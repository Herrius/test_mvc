<?php

require_once 'models/Docente.php';

class DocenteController {

	public function docente() {
		session_start();
		if ($_SESSION['id_rol'] != 1) {
			header('Location: index.php?page=index');
      die();
		} else {
    	require_once('./views/admin/aula.php');
		}
	}
	public function alumno() {
		session_start();
		if ($_SESSION['id_rol'] != 1) {
			header('Location: index.php?page=index');
      die();
		} else {
    	require_once('./views/admin/alumno.php');
		}
	}
	public function resultadoAlumno(){
		session_start();
		if ($_SESSION['id_rol'] != 1) {
			header('Location: index.php?page=index');
      die();
		} else {
    	require_once('./views/admin/resultadoA.php');
		}
	}
	public function resultadoGrupal(){
		session_start();
		if ($_SESSION['id_rol'] != 1) {
			header('Location: index.php?page=index');
      die();
		} else {
    	require_once('./views/admin/resultadoG.php');
		}
	}
	
	public function identidad($codigo){
		$resultado=new Docente();
		return	$resultado->identidad($codigo);
	}
	public function test($codigo){
		$resultado=new Docente();
		return	$resultado->test($codigo);
	}


}