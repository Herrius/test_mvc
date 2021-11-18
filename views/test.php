<?php error_reporting(0); ?>
    <?php

    $connect =mysqli_connect('localhost','root','','test');


    //Inilizamos paginación ///

    //Obtenemos 'Numero' paginación via 'GET'.
    if (isset($_GET['idpregunta'])) { 
        $pagina  = $_GET['idpregunta'];     
    } else { //Por defecto inicamos la página en 1, es decir, registro numero 1.
        $pagina=1;
    }

    $codigo= $_GET['codigo'];
    $estudiante= mysqli_query($connect,"SELECT COUNT(`codigo_estudiante`) as codigo FROM tblprueba WHERE `codigo_estudiante`='$codigo'");
    $resultado=mysqli_fetch_array($estudiante);
    $codigo_validador=$resultado['codigo'];
    if($codigo_validador<44){
        $insertar=mysqli_query($connect,"INSERT INTO `tblprueba`( `codigo_estudiante`, `pregunta`, `respuesta`) 
        VALUES ('$codigo','1',''),
        ('$codigo','2',''),
        ('$codigo','3',''),
        ('$codigo','4',''),
        ('$codigo','5',''),
        ('$codigo','6',''),
        ('$codigo','7',''),
        ('$codigo','8',''),
        ('$codigo','9',''),
        ('$codigo','10',''),
        ('$codigo','11',''),
        ('$codigo','12',''),
        ('$codigo','13',''),
        ('$codigo','14',''),
        ('$codigo','15',''),
        ('$codigo','16',''),
        ('$codigo','17',''),
        ('$codigo','18',''),
        ('$codigo','19',''),
        ('$codigo','20',''),
        ('$codigo','21',''),
        ('$codigo','22',''),
        ('$codigo','23',''),
        ('$codigo','24',''),
        ('$codigo','25',''),
        ('$codigo','26',''),
        ('$codigo','27',''),
        ('$codigo','28',''),
        ('$codigo','29',''),
        ('$codigo','30',''),
        ('$codigo','31',''),
        ('$codigo','32',''),
        ('$codigo','33',''),
        ('$codigo','34',''),
        ('$codigo','35',''),
        ('$codigo','36',''),
        ('$codigo','37',''),
        ('$codigo','38',''),
        ('$codigo','39',''),
        ('$codigo','40',''),
        ('$codigo','41',''),
        ('$codigo','42',''),
        ('$codigo','43',''),
        ('$codigo','44','');");
    }
    else{
 
    }
   
    //Cantidad de registro a mostrar en paginación.
    $cantidad_reg=1;    
    //Localizacion SQL.
    $ubicacion = ($pagina-1) * $cantidad_reg;

    //Sentencia SQL, mostramos consejo.
    $preguntas= mysqli_query($connect,"SELECT idpregunta,enunciado,opcion1,opcion2 FROM tblpreguntas ORDER BY idpregunta LIMIT $ubicacion,$cantidad_reg");
    $registro= mysqli_fetch_array($preguntas);

    //Obtenemos datos a mostrar para la páginación.   
    $idpregunta = $registro['idpregunta'];   
    $enunciado = $registro['enunciado'];
    $opcion1 = $registro['opcion1'];
    $opcion2 = $registro['opcion2'];
    // los declaro para que el form lo pueda capturar
    $prev = $pagina - 1;
    $next = $pagina + 1;

?>
    <!DOCTYPE HTML>    
    <html>    
    <head>    
    <meta utfset="utf-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <link rel="stylesheet" href="estilos/preguntas.css">
    <title>Yachayqay Test</title>

   
    <script>
        function desactivar(){
            if(!A.checked && !B.checked){
                alert('MARQUE UNA OPCIÓN PARA CONTINUAR');
                respuestaA.disabled=true;
            }              
        }
        function activar(){
            if(A.checked || B.checked){
                respuestaA.disabled=false;
            }
        }        
    
    </script>     
    </head>    
    <body >
    <div class="body">
        <div class="container">
            <header class="img">
                <img src="imagenes/UC-Horizontal-White 1.png">
            </header>
            <!-- para capturar los datos se necesita de un form con method post -->
            <form class="conti" method="post" 
            action="<?php if($next<=45){print 'fetch.php?idpregunta='.$next.'&codigo='. $codigo;}else{print 'retroalimentacion/menu_Resultados.php?codigo='.$codigo;}?>" >
            <h3 style="color:grey" >Pregunta&nbsp;<?php echo  utf8_encode($idpregunta);?> de 44&nbsp;&nbsp;</h3>
            <h1> Yachayqay Test </h1>
            
            <!--  Mostramos datos para paginación -->

            <h2><?php if($next<=45)echo $enunciado;else echo "Gracias";?></h2>

            <div class="radio-toolbar">
                <input type=radio id="A" name="question" value='1' onclick='return activar();'/>
                <label for="A"><?php if($next<=45)echo $opcion1;else echo "Gracias";?></label>

                <input type=radio id="B" name="question" value='2' onclick='return activar();'/>
                <label for="B"><?php if($next<=45)echo $opcion2;else echo "Gracias";?></label> 
                
            </div>

            <div class="contenedor-siguiente">
                <?php //Creamos botoneras anterior / siguiente

                    //SQL
                    $preguntas= mysqli_query($connect,"SELECT * FROM tblpreguntas");     
                    //Total registros existentes en Base de Datos.
                    $total_filas = mysqli_num_rows($preguntas);
                    //Cantidad a mostrar en paginación.
                    $cantidad_reg=1;
                    //Calculamos total paginas. 
                    $total_pagina = ceil($total_filas / $cantidad_reg); 

                    //Calculamos botones anterior / siguiente
                   

                    //Boton 'Anterior'
                    if ($prev > 0) { 
                        echo "<a class='siguiente' href='fetch.php?idpregunta=$prev&codigo=$codigo'>Anterior</a>"; 
                    }

                    //Opcional, visualizar el total de paginas, es decir, podrias crear algo similar a  < 1 2 3 4 > .       
                    // for ($i=1; $i<=$total_pagina; $i++) { 
                    //  echo "<a href='fetch.php?pagina=$i'>$i</a>"; 
                    //}

                    //Boton 'Siguiente'
                    if ($pagina <= $total_pagina ) {
                        echo "<button class='siguiente' type='submit' name='grabar' id='respuestaA' onclick='return desactivar();'>Siguiente</button>"; 
                    }  
                    //Pagina final donde se ejecuta el proceso de guardar los resultados
                    if($pagina==45){
                        echo "<button class='siguiente' type='submit' name='grabar' id='respuestaA'>Finalizar</button>";
                        //filtrado de datos segun el tipo de estilos de aprendizaje
                        $tabla=mysqli_query($connect,"SELECT COUNT(A.id) as numero from tblprueba A INNER JOIN tblpreguntas P on A.pregunta=P.idpregunta WHERE P.tipo_pregunta='Act-Ref' and A.respuesta='2' and A.codigo_estudiante= '$codigo'");
                        $tabla2=mysqli_query($connect,"SELECT COUNT(A.id) as numero1 from tblprueba A INNER JOIN tblpreguntas P on A.pregunta=P.idpregunta WHERE P.tipo_pregunta='Sec-Glo' and A.respuesta='2' and A.codigo_estudiante= '$codigo'");
                        $tabla3=mysqli_query($connect,"SELECT COUNT(A.id) as numero2 from tblprueba A INNER JOIN tblpreguntas P on A.pregunta=P.idpregunta WHERE P.tipo_pregunta='Sen-Int' and A.respuesta='2' and A.codigo_estudiante= '$codigo'");
                        $tabla4=mysqli_query($connect,"SELECT COUNT(A.id) as numero3 from tblprueba A INNER JOIN tblpreguntas P on A.pregunta=P.idpregunta WHERE P.tipo_pregunta='Vis-Ver' and A.respuesta='2' and A.codigo_estudiante= '$codigo'");
                        //capturar el valor numero del conteo
                        $interprete= mysqli_fetch_array($tabla);
                        $interprete2= mysqli_fetch_array($tabla2);
                        $interprete3= mysqli_fetch_array($tabla3);
                        $interprete4= mysqli_fetch_array($tabla4);
                        //calcullo en porcentajes
                        $reflexivo=intval(($interprete['numero']/11)*100);
                        $global=intval(($interprete2['numero1']/11)*100);
                        $intuitivo=intval(($interprete3['numero2']/11)*100);
                        $verbal=intval(($interprete4['numero3']/11)*100);
                        //envio a la base de datos
                        $respuestas="INSERT INTO tblresultados(`codestudiante`,`nivelactref`,`nivelsenint`,`nivelvisver`,`nivelsecglo`) VALUES('$codigo','$reflexivo','$intuitivo','$verbal','$global')";
                        mysqli_query($connect,$respuestas);
                    }
                    if($idpregunta=4){
                        echo "<a href='retroalimentacion/menu_Resultados.php?codigo=$codigo'>Salter</a>";
                    }
                ?>
            </form>
            <!-- es la consulta que se debe llevar a store procedure -->
            <?php
                
                if(isset($_POST['question'])){
                    $respuesta=intval($_POST['question']);
                    $variable=$pagina-1;
                    $sql="UPDATE tblprueba SET `respuesta`='$respuesta' WHERE codigo_estudiante='$codigo' AND pregunta='$variable'";
                    mysqli_query($connect, $sql);
                     }
            ?>
            </div>
        </div>
    </div>
</body>

</html>