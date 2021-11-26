<?php

require_once 'models/Test.php';

class TestController {

	public function test() {
		require_once('./views/pages/test.php');
		
	}
	public function elegidos(){
		session_start();
		if ($_SESSION['id_rol'] <= 1) {
			header('Location: index.php?page=test');
      	die();
		} else {
    		require_once('./views/ML/elegidos.php');
		}
	}
	public function resultado(){
		require_once('./views/pages/resultado.php');
	}
	public function resultadoml(){
		require_once('./views/ml/resultado.php');
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
	public function obtenerPagina($posicion,$cantidad_reg){
		$pregunta=new Test();
		
		return $pregunta->obtenerPregunta($posicion,$cantidad_reg);
	}
	public function calcularPagina(){
		$resultado=new Test();
		return $resultado->obtenerPagina();
	}

	public function actualizarRespuesta($respuesta,$codigo,$variable){
		$resultado=new Test();
		return $resultado->actualizarRespuesta($respuesta,$codigo,$variable);
	}
	public function actualizarRespuestaML($respuesta,$codigo,$variable){
		$resultado=new Test();
		return $resultado->actualizarRespuestaML($respuesta,$codigo,$variable);
	}

	public function calcularPorcentaje($codigo,$estilo){
		$resultado=new Test();
		return $resultado->calcularPorcentaje($codigo,$estilo);
	}
	public function guardarResultados($datos){
		$guardar=new Test();
		
		foreach($guardar->consultarCurso($datos['codestudiante']) as $r){
			$resultado=$r['curso'];
		}
		$datos['curso']=$resultado;
		return $guardar->guardarResultados($datos);
	}
	public function guardarResultados_ml($datos){
		$guardar=new Test();
		
		foreach($guardar->consultarCurso($datos['codestudiante']) as $r){
			$resultado=$r['curso'];
		}
		$datos['curso']=$resultado;
		return $guardar->guardarResultados_ml($datos);
	}
	public function comprobarExistencia($codigo){
		$resultado=new Test();
		return $resultado->comprobarExistencia($codigo);
	}
	public function comprobarExistenciaML($codigo){
		$resultado=new Test();
		return $resultado->comprobarExistenciaML($codigo);
	}
	public function crearResultados($data_test){
		$resultado=new Test();
		return $resultado->crearResultados($data_test);
	}
	public function crearResultadosML($data_test){
		$resultado=new Test();
		return $resultado->crearResultadosML($data_test);
	}
	public function consultarResultado_ml($codigo){
		$resultado=new Test();
		return $resultado->consultarResultado_ml($codigo);
	}
	public function capturarRespuestas($activo){
		$resultado=new Test();
		return $resultado->capturarRespuestas($activo);
	}


}