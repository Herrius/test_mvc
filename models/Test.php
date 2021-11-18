<?php
require_once 'ModeloBase.php';

class Test extends ModeloBase {

	public function __construct() {
		parent::__construct();
	}
	public function guardarRespuesta($datos){
		$db=new ModeloBase();
		try{
			$insertar=$db->insertar('tblrespuestas',$datos);
			if($insertar==true){
				$_SESSION['mensaje'] = 'Pregunta guardada';
			}
		} catch (PDOException $e) {
			$_SESSION['mensaje'] = $e->getMessage();
		}
	}
	public function guardarResultados($datos){
		$db=new ModeloBase();
		try{
			$insertar=$db->insertar('tblresultados',$datos);
			if($insertar==true){
				$_SESSION['mensaje'] = 'Resultados guardados';
			}
		} catch (PDOException $e) {
			$_SESSION['mensaje'] = $e->getMessage();
		}
	}
	public function crearResultados($data_test){
		$db=new ModeloBase();
		try{
			$insertar=$db->insertar('tblprueba',$data_test);
			if($insertar==true){
				$_SESSION['mensaje'] = 'Se guardo de forma exitosa';
			}
		} catch (PDOException $e) {
			$_SESSION['mensaje'] = $e->getMessage();
		}
	}
	public function comprobarExistencia($codigo){
		$db=new ModeloBase();
		$query="SELECT COUNT(`codigo_estudiante`) as codigo FROM tblprueba WHERE `codigo_estudiante`='$codigo'";
		$resultado=$db->obtenerTodos($query);
		return $resultado;
	}
	public function actualizarRespuesta($respuesta,$codigo,$variable){
		$db=new ModeloBase();
		$query="UPDATE tblprueba SET `respuesta`='$respuesta' WHERE codigo_estudiante='$codigo' AND pregunta='$variable'";
		$resultado=$db->obtenerTodos($query);
		return $resultado;

	}
	public function obtenerPregunta($ubicacion,$cantidad_reg){
		$db=new ModeloBase();
		$query="SELECT idpregunta,enunciado,opcion1,opcion2 FROM tblpreguntas ORDER BY idpregunta LIMIT $ubicacion,$cantidad_reg";
		$resultado=$db->obtenerTodos($query);
		return $resultado;

	}
	public function calcularPorcentaje($codigo,$estilo){
		$db=new ModeloBase();
		$query = "SELECT COUNT(A.id) as numero from tblprueba A INNER JOIN tblpreguntas P on A.pregunta=P.idpregunta WHERE P.tipo_pregunta='$estilo' and A.respuesta='2' and A.codigo_estudiante= '$codigo'";
		$resultado=$db->consultarRegistro($query);
		return $resultado;
	}
	public function obtenerPagina(){
		$db=new ModeloBase();
		$query="SELECT COUNT(*) FROM tblpreguntas";
		$resultado=$db->obtenerTodos($query);
		return $resultado;
	}
	public function consultarResultado($codigo){
		$db=new ModeloBase();
		$query="CALL SP_MOSTRAR_RESULTADO('$codigo')";
		$resultado=$db->obtenerTodos($query);
		return $resultado;
	}
	//blog
	public function obtenerCategorias() {
		$db = new ModeloBase();
		$query = "SELECT * FROM categorias ORDER BY categoria";
		$resultado = $db->obtenerTodos($query);
		return $resultado;
	}

	public function guardarPublicacion($datos) {
		$db = new ModeloBase();
		try {
			$insertar = $db->insertar('articulos', $datos);
			if ($insertar == true) {
				$_SESSION['mensaje'] = 'Artículo publicado';
			}
		} catch (PDOException $e) {
			$_SESSION['mensaje'] = $e->getMessage();
		}
	}

	public function mostrarArticulos($tipo, $limite) {
		$db = new ModeloBase();
		$query = "SELECT articulos.*, usuarios.apodo, categorias.categoria FROM articulos
							LEFT JOIN usuarios ON usuarios.id = articulos.publicado_por
							LEFT JOIN categorias ON categorias.id = articulos.id_categoria";
		if ($tipo == 'r') {
			$query.=" WHERE tipo = 'r' ";
		} else if ($tipo == 'p'){
			$query.=" WHERE tipo = 'p' ";
		}

		$query .= " ORDER BY fecha_creacion LIMIT ".$limite;

		$resultado = $db->obtenerTodos($query);
		return $resultado;
	}

	public function buscarArticulos($cadena, $limite) {
		$db = new ModeloBase();
		$query = "SELECT articulos.*, usuarios.apodo, categorias.categoria FROM articulos
							LEFT JOIN usuarios ON usuarios.id = articulos.publicado_por
							LEFT JOIN categorias ON categorias.id = articulos.id_categoria
							WHERE titulo LIKE '%".$cadena."%'";

		$resultado = $this->obtenerTodos($query);
		return $resultado;
	}

	public function obtenerArticulo($slug) {
		$db = new ModeloBase();
		$query = "SELECT articulos.*, usuarios.apodo, categorias.categoria FROM articulos
							LEFT JOIN usuarios ON usuarios.id = articulos.publicado_por
							LEFT JOIN categorias ON categorias.id = articulos.id_categoria
							WHERE slug = '".$slug."'";
		$resultado = $db->obtenerTodos($query);
		return $resultado;
	}

	public function obtenerIdArticulo($slug) {
		$db = new ModeloBase();
		$query = "SELECT id FROM articulos WHERE slug = '".$slug."'";
		$resultado = $db->obtenerTodos($query);
		return $resultado;
	}

	public function guardarComentario($datos) {
		$db = new ModeloBase();
		try {
			$insertar = $db->insertar('comentarios', $datos);
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function obtenerComentarios($id_articulo) {
		$db = new ModeloBase();
		$query = "SELECT * FROM comentarios
				  LEFT JOIN usuarios ON usuarios.id = comentarios.id_usuario
				  WHERE id_articulo = '".$id_articulo."'";
		$resultado = $db->obtenerTodos($query);
		return $resultado;
	}

}
