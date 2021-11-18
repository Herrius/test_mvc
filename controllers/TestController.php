<?php

require_once 'models/Test.php';

class TestController {

	public function test() {
		require_once('./views/pages/test.php');
	}
	public function resultado(){
		require_once('./views/pages/resultados.php');
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

	//blog
	public function guardarPublicacion($datos) {

		$directorio = 'portadas/'; #Directorio donde guardamos las imagenes
		$portada = $datos['portada'];
		$archivo = $directorio.basename($portada['name']);

		date_default_timezone_set('UTC');
		$articulo = new Test();
		$datos['publicado_por'] = $_SESSION['id_usuario'];
		$datos['fecha_creacion'] = date('Y-m-d');
		$datos['hora_creacion'] = date('h:i:s');
		$datos['slug'] = $this->crearSlug($datos['titulo']); //Mi primer publicacion -> mi-primer-publicacion
		$datos['portada'] = $portada['name'];
		if (move_uploaded_file($portada['tmp_name'], $archivo)) {
			return $articulo->guardarPublicacion($datos);
		}
	}
	public function publicar() {
		session_start();
		if ($_SESSION['id_rol'] != 1) {
			header('Location: index.php?page=login');
      die();
		} else {
			require_once('./views/includes/cabecera.php');
    	require_once('./views/admin/publicar.php');
    	require_once('./views/includes/pie.php');
		}
	}

	public function obtenerCategorias() {
		$categorias = new Test();
		return $categorias->obtenerCategorias();
	}



	

	public function mostrarArticulos($tipo, $limite) {
		$articulos = new Test();
		return $articulos->mostrarArticulos($tipo, $limite);
	}

	public function leerArticulo() {
		require_once('./views/includes/cabecera.php');
    require_once('./views/paginas/leerArticulo.php');
    require_once('./views/includes/pie.php');
	}

	public function obtenerArticulo($slug) {
		$articulos = new Test();
		return $articulos->obtenerArticulo($slug);
	}

	public function publicarComentario($datos) {
		$articulo = new Test();
		//comentario, slug
		$datos['id_usuario'] = $_SESSION['id_usuario'];
		//comentario, slug, id_usuario
		$id_articulo = $this->obtenerIdArticulo($datos['slug']);
		$datos['id_articulo'] = $id_articulo;
		//comentario, slug, id_usuario,id_articulo
		unset($datos['slug']);
		//comentario, id_usuario,id_articulo

		return $articulo->guardarComentario($datos);

	}

	public function obtenerComentarios($slug) {
		$Test = new Test();
		$id_articulo = $this->obtenerIdArticulo($slug);
		return $Test->obtenerComentarios($id_articulo);
	}

	public function resultadoBusqueda() {
		require_once('./views/includes/cabecera.php');
    require_once('./views/paginas/resultadoBusqueda.php');
    require_once('./views/includes/pie.php');
	}

	public function buscarArticulos($cadena) {
		$articulos = new Test();
		return $articulos->buscarArticulos($cadena, 10);
	}

	private function obtenerIdArticulo($slug) {
		$Test = new Test();
		$id = $Test->obtenerIdArticulo($slug);
		foreach ($id as $r){
			return $r['id'];
		}
	}

	private function crearSlug($titulo) {
		$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $titulo);
   	return $slug;
	}


}