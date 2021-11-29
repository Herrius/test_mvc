<?php 
    include '../../../views/admin/consultas/consulta.php';

    $conn=mysqli_connect ('localhost','root','','test');

    $salida="";
    $query="SELECT * FROM users WHERE curso IN ('SISTEMAS OPERATIVOS','TALLER DE PROYEC DE ING I') AND id_rol <> 1";

    if (isset($_POST['consulta'])) {
    	$q = $conn->real_escape_string($_POST['consulta']);
    	$query = busquedaestudiante($q);
    }
    $resultado= $conn->query($query);
    if($resultado->num_rows>0){
        while($fila=$resultado->fetch_assoc()){
            $salida.="<div class='container'>
            <br>
             <a href='index.php?page=resultadoa&estudiante=".$fila['codigo']."'>
             <div class='card'>
                <img src='assets/img/salon.jpg'>
                <h4>".$fila['codigo']."</h4>
                <p>".$fila['nombres']." ".$fila['apellidos']."</p>
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