<?php
require_once 'ModeloBase.php';

class Docente extends ModeloBase {
	
	public function identidad($codigo){
		$db=new ModeloBase();
		$query="SELECT * FROM tblconsulta where codestudiante='$codigo'";
		$resultado=$db->obtenerTodos($query);
		return $resultado;
	}
	public function test($codigo){
		$db=new ModeloBase();
		$query="SELECT * FROM tblresultados where codestudiante='$codigo@continental.edu.pe' ORDER by idresultado DESC  LIMIT 1 ";
		$resultado=$db->obtenerTodos($query);
		return $resultado;
	}

}
