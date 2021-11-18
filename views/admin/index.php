<?php 
    include 'consultas/consulta.php';

    $conn=mysqli_connect ('localhost','root','','test');

    $salida="";
    $query="CALL SP_BUSQUEDA_SALON";

    if (isset($_POST['consulta'])) {
    	$q = $conn->real_escape_string($_POST['consulta']);
    	$query = busquedasalon($q);
    }
    $resultado= $conn->query($query);
    if($resultado->num_rows>0){
        while($fila=$resultado->fetch_assoc()){
            $salida.="<div class='container'>
            <br>
             <a href='reporteGrupal.php?nrc=".$fila['NRC']."'>
             <div class='card'>
                <img src='img/unnamed.jpg'>
                <h4>".$fila['NRC']."</h4>
                <p>".utf8_encode($fila['Nombreasignatura'])."</p>
                <button type='button' class='btn btn-dark'>Reporte</button>                  
             </div>
             </a>
             <br>
         </div><br>";
        }
    }else{
        $salida.="No se encuentran registros";
    }
    echo $salida;
    $conn->close();
?>