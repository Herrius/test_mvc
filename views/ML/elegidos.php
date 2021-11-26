<?php
require_once 'controllers/TestController.php';
$test = new TestController();


if (isset($_GET['idpregunta'])) {
    $pagina  = $_GET['idpregunta'];
} else { //Por defecto inicamos la página en 1, es decir, registro numero 1.
    $pagina = 0;
}
$codigo = $_GET['codigo'];

//verficiar que exista en la BD
$cantidad = $test->comprobarExistenciaML($codigo);
foreach ($cantidad as $r) {
    $codigo_validador = $r['codigo'];
}
$ubicacion=[1,2,8,14,15,16,17,20,22,24,26,27,30,31,33,35,36,37,39,41];

if ($codigo_validador < 19) {
    $pregunta=0;
    while ($pregunta <= 19) {
        $data_test = array(
            'codigo_estudiante' => $codigo,
            'pregunta' => $ubicacion[$pregunta],
            'respuesta' => 0,
        );
        var_dump($ubicacion[$pregunta]);
        $pregunta++;
        
        $test->crearResultadosML($data_test);
 
    }
}
//Cantidad de registro a mostrar en paginación.
$cantidad_reg = 1;
//Localizacion SQL.

$posicion = $_GET['idpregunta'];
if($posicion<20){
$preguntas = $test->obtenerPagina($ubicacion[$posicion]-1,$cantidad_reg);
}
//Obtenemos datos a mostrar para la páginación.   
if (!empty($preguntas)) {
    foreach ($preguntas as $r) {
        $idpregunta = $r['idpregunta'];
        $enunciado = $r['enunciado'];
        $opcion1 = $r['opcion1'];
        $opcion2 = $r['opcion2'];
    }
}

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
    <link rel="stylesheet" href="assets/css/styles_prueba.css">
    <title>Yachayqay Test</title>


    <script>
        function desactivar() {
            if (!A.checked && !B.checked) {
                alert('MARQUE UNA OPCIÓN PARA CONTINUAR');
                respuestaA.disabled = true;
            }
        }

        function activar() {
            if (A.checked || B.checked) {
                respuestaA.disabled = false;
            }
        }
    </script>
</head>

<body>
    <div class="body">
        <div class="container">
            <header class="img">
                <img src="assets/img/UC-Horizontal-White 1.png">
            </header>
            <!-- para capturar los datos se necesita de un form con method post -->
            <form class="conti" method="post" action="<?php if ($next <= 20) {
                                                            print 'index.php?page=test&codigo=' . $codigo . '&idpregunta=' . $next.'&view=elegidos';
                                                        } else {
                                                            print 'index.php?page=test&view=resultadoml&codigo=' . $codigo;
                                                        } ?>">
                <h3 style="color:grey"><?php if ($next <= 20) {
                                            echo ('Pregunta ' . utf8_encode($idpregunta) . ' de 44');
                                        } else echo 'Test finalizado' ?></h3>
                <h1> Yachayqay Test </h1>

                <!--  Mostramos datos para paginación -->

                <h2><?php if ($posicion === 20) echo $enunciado;
                    else echo "Muchas gracias por completar el test de Estilos de aprendizaje"; ?></h2>

                <div class="radio-toolbar">
                    <input type=radio id="A" name="question" value='1' onclick='return activar();' />
                    <label for="A" style="<?php if ($next >= 21) print("display: none;") ?>"><?php echo $opcion1; ?></label>

                    <input type=radio id="B" name="question" value='2' onclick='return activar();' />
                    <label for="B" style="<?php if ($next >= 21) echo "display: none;" ?>"" class=" hidden"><?php echo $opcion2;?></label>

                </div>

                <div class="contenedor-siguiente">
                    <?php //Creamos botoneras anterior / siguiente

                    //SQL
                    $total = $test->calcularPagina();
                    //Total registros existentes en Base de Datos.
                    foreach ($total as $row) {
                        $total_filas = $row['COUNT(*)'];
                    }
                    //Cantidad a mostrar en paginación.
                    $cantidad_reg = 1;
                    //Calculamos total paginas. 
                    $total_pagina = ceil($total_filas / $cantidad_reg);

                    //Calculamos botones anterior / siguiente

    
                    //Boton 'Anterior'
                    if ($prev >= 0) {
                        echo ("<a class='siguiente' href='index.php?page=test&codigo=$codigo&idpregunta=$prev&view=elegidos'>Anterior</a>");
                    }

                    //Opcional, visualizar el total de paginas, es decir, podrias crear algo similar a  < 1 2 3 4 > .       
                    // for ($i=1; $i<=$total_pagina; $i++) { 
                    //  echo "<a href='fetch.php?pagina=$i'>$i</a>"; 
                    //}

                    //Boton 'Siguiente'
                    if ($pagina <= 19) {
                        echo "<button class='siguiente' type='submit' name='grabar' id='respuestaA' onclick='return desactivar();'>Siguiente</button>";
                    }
                    //Pagina final donde se ejecuta el proceso de guardar los resultados
                    if ($pagina > 19) {
                        echo "<button class='siguiente' type='submit' name='grabar' id='respuestaA'>Finalizar</button>";
                        //ml
                        $activo=[1,17,33,37,41];
                        $activo=$test->capturarRespuestas($activo);
                        $temp=[];
                        foreach($activo as $r){
                            array_push($temp,$r['respuesta']);
                        }
                        $activo = file_get_contents('https://estilos-ml.herokuapp.com/activot?pregunta1='.$temp[0].'&pregunta17='.$temp[1].'&pregunta33='.$temp[2].'&pregunta37='.$temp[3].'&pregunta41='.$temp[4]);
                        
                        $global=[8,16,20,24,36];
                        $global=$test->capturarRespuestas($global);
                        $temp=[];
                        foreach($global as $r){
                            array_push($temp,$r['respuesta']);
                        }
                        $global = file_get_contents('https://estilos-ml.herokuapp.com/globalt?pregunta8='.$temp[0].'&pregunta16='.$temp[1].'&pregunta20='.$temp[2].'&pregunta24='.$temp[3].'&pregunta36='.$temp[4]);
                        
                        $sensorial=[2,14,22,26,30];
                        $sensorial=$test->capturarRespuestas($sensorial);
                        $temp=[];
                        foreach($sensorial as $r){
                            array_push($temp,$r['respuesta']);
                        }
                        
                        $sensorial = file_get_contents('https://estilos-ml.herokuapp.com/sensitivot?pregunta2='.$temp[0].'&pregunta14='.$temp[1].'&pregunta22='.$temp[2].'&pregunta26='.$temp[3].'&pregunta30='.$temp[4]);
                        
                        $verbal=[15,27,31,35,39];
                        $verbal=$test->capturarRespuestas($verbal);
                        $temp=[];
                        foreach($verbal as $r){
                            array_push($temp,$r['respuesta']);
                        }
                        $verbal = file_get_contents('https://estilos-ml.herokuapp.com/verbalt?pregunta15='.$temp[0].'&pregunta27='.$temp[1].'&pregunta31='.$temp[2].'&pregunta35='.$temp[3].'&pregunta39='.$temp[4]);
                        
                       

                        //envio a la base de datos
                        $datos = array(
                            'codestudiante'    => $codigo,
                            'nivelactref' => abs($activo-100), 
                            'nivelsenint' => abs($sensorial-100), 
                            'nivelvisver' => $verbal, 
                            'nivelsecglo' => $global, 
                            'curso' => '', 
                        );
                        $test->guardarResultados_ml($datos);
                    }

                    ?>
            </form>
            <!-- es la consulta que se debe llevar a store procedure -->
            <?php

            if (isset($_POST['question']) && $posicion<20) {
                $respuesta = intval($_POST['question']);
                $variable = $idpregunta-1;
                $test->actualizarRespuestaML($respuesta, $codigo, $variable);
            }
            ?>
        </div>
    </div>
    </div>
</body>

</html>