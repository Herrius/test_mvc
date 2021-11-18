<?php 
    include '../../../views/admin/consultas/consulta.php';

    $conn=mysqli_connect ('localhost','root','','test');

    $salida="";
    $query="CALL SP_BUSQUEDA_ESTUDIANTES";

    if (isset($_POST['consulta'])) {
    	$q = $conn->real_escape_string($_POST['consulta']);
    	$query = busquedaestudiante($q);
    }
    $resultado= $conn->query($query);
    if($resultado->num_rows>0){
        while($fila=$resultado->fetch_assoc()){
            $salida.="<div class='container'>
            <br>
             <a href='index.php?page=resultadoa&estudiante=".$fila['codestudiante']."'>
             <div class='card'>
                <img src='assets/img/salon.jpg'>
                <h4>".$fila['codestudiante']."</h4>
                <p>".$fila['nombreest']."</p>
                <button type='button' class='btn btn-dark'data-toggle='modal' data-target='#modal1' width='50%'>Reporte</button>                  
             </div><br>
         </div><br>";
        }
    }else{
        $salida.="No se encuentran registros";
    }
    echo $salida;
    $conn->close();
?>