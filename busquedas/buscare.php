<?php
	include 'consultas/consultas.php';
	$conn=mysqli_connect('localhost','root','','test');

    $query = "CALL SP_BUSQUEDA_ESTUDIANTES";

	$salida="";

	if (isset($_POST['consulta'])) {
    	$q = $conn->real_escape_string($_POST['consulta']);
    	$query = busquedaestudiante($q);
    }


    $resultado = $conn->query($query);

    if ($resultado->num_rows>0) {
    	$salida.="<table border=1 class='tabla_datos'>
    			<thead>
    				<tr id='titulo'>
    					<td>Codigo</td>
    					<td>Nombre Completo</td>
    					<td>Reporte</td>
    				</tr>

    			</thead>
    			

    	<tbody>";

    	while ($fila = $resultado->fetch_assoc()) {
    		$salida.="<tr>
    					<td>".$fila['codestudiante']."</td>
    					<td>".$fila['nombreest']."</td>
    					<td><imput type='button' value='Seleccionar' name='accion'></imput></td>
    				</tr>";

    	}
    	$salida.="</tbody></table>";
    }else{
    	$salida.="No se encuentran registros";
    }


    echo $salida;

    $conn->close();



?>