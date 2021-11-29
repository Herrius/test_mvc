<?php
require_once 'ModeloBase.php';

class Docente extends ModeloBase {
	
	public function identidad($codigo){
		$db=new ModeloBase();
		$query="SELECT * FROM user where codestudiante='$codigo'";
		$resultado=$db->obtenerTodos($query);
		return $resultado;
	}
	public function test($codigo){
		$db=new ModeloBase();
		$query="SELECT * FROM tblresultados where codestudiante='$codigo' ORDER by idresultado DESC  LIMIT 1 ";
		$resultado=$db->obtenerTodos($query);
		return $resultado;
	}
	public function contar($curso){
		$db=new ModeloBase();
		$query="SELECT curso,COUNT(DISTINCT codestudiante) AS ESTUDIANTES FROM tblresultados GROUP BY curso HAVING curso='$curso'";
		$resultado=$db->obtenerTodos($query);
		return $resultado;
	}
	public function contarestilo($estilo,$curso){
		$db=new ModeloBase();
		$query="SELECT COUNT($estilo) AS ESTILO,AVG($estilo) AS PROMEDIO FROM tblresultados WHERE codestudiante IN(SELECT DISTINCT codestudiante FROM tblresultados WHERE curso='$curso') AND $estilo>50";
		$resultado=$db->obtenerTodos($query);
		return $resultado;
	}
}
