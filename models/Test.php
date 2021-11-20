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
			$insertar=$db->insertar('tblrespuestas',$data_test);
			if($insertar==true){
				$_SESSION['mensaje'] = 'Se guardo de forma exitosa';
			}
		} catch (PDOException $e) {
			$_SESSION['mensaje'] = $e->getMessage();
		}
	}
	public function comprobarExistencia($codigo){
		$db=new ModeloBase();
		$query="SELECT COUNT(`codigo_estudiante`) as codigo FROM tblrespuestas WHERE `codigo_estudiante`='$codigo'";
		$resultado=$db->obtenerTodos($query);
		return $resultado;
	}
	public function actualizarRespuesta($respuesta,$codigo,$variable){
		$db=new ModeloBase();
		$query="UPDATE tblrespuestas SET `respuesta`='$respuesta' WHERE codigo_estudiante='$codigo' AND pregunta='$variable'";
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
		$query = "SELECT COUNT(A.id) as numero from tblrespuestas A INNER JOIN tblpreguntas P on A.pregunta=P.idpregunta WHERE P.tipo_pregunta='$estilo' and A.respuesta='2' and A.codigo_estudiante= '$codigo'";
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
	public function consultarCurso($codigo){
		$db=new ModeloBase();
		$query="SELECT curso FROM users WHERE email='$codigo';";
		$resultado=$db->obtenerTodos($query);
		return $resultado;
	}
}