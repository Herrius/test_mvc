<?php

require_once 'models/Test.php';

class TestController {

	public function test() {
		require_once('./views/pages/test.php');
	}
	public function resultado(){
		require_once('./views/pages/resultado.php');
	}
	public function estilo(){
		$url=$_GET["estilo"];
		require_once('./views/pages/resultados/'.$url.'.php');
	}
	
	public function guardarTest($datos){
		session_start();
		$pregunta=new Test();
		return $pregunta->guardarRespuesta($datos);
	}
	public function obtenerPagina($ubicacion,$cantidad_reg){
		$pregunta=new Test();
		return $pregunta->obtenerPregunta($ubicacion,$cantidad_reg);
	}
	public function calcularPagina(){
		$resultado=new Test();
		return $resultado->obtenerPagina();
	}

	public function actualizarRespuesta($respuesta,$codigo,$variable){
		$resultado=new Test();
		return $resultado->actualizarRespuesta($respuesta,$codigo,$variable);
	}

	public function calcularPorcentaje($codigo,$estilo){
		$resultado=new Test();
		return $resultado->calcularPorcentaje($codigo,$estilo);
	}
	public function guardarResultados($datos){
		$guardar=new Test();
		return $guardar->guardarResultados($datos);
	}
	public function comprobarExistencia($codigo){
		$resultado=new Test();
		return $resultado->comprobarExistencia($codigo);
	}
	public function crearResultados($data_test){
		$resultado=new Test();
		return $resultado->crearResultados($data_test);
	}
	public function consultarResultado($codigo){
		$resultado=new Test();
		return $resultado->consultarResultado($codigo);
	}



}