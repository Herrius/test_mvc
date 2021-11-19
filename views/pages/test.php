<?php
require_once 'controllers/TestController.php';
$test = new TestController();

if (isset($_GET['idpregunta'])) {
    $pagina  = $_GET['idpregunta'];
} else { //Por defecto inicamos la página en 1, es decir, registro numero 1.
    $pagina = 1;
}
$codigo = $_GET['codigo'];

//verficiar que exista en la BD
$cantidad = $test->comprobarExistencia($codigo);
foreach ($cantidad as $r) {
    $codigo_validador = $r['codigo'];
}
var_dump($codigo_validador);
if ($codigo_validador < 43) {
    $pregunta=0;
    while ($pregunta < 44) {
        $data_test = array(
            'codigo_estudiante' => $codigo,
            'pregunta' => $pregunta,
            'respuesta' => 0,
        );
        $pregunta++;
        
        $test->crearResultados($data_test);
 
    }
}
//Cantidad de registro a mostrar en paginación.
$cantidad_reg = 1;
//Localizacion SQL.
$ubicacion = ($pagina - 1) * $cantidad_reg;
$preguntas = $test->obtenerPagina($ubicacion, $cantidad_reg);
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
            <form class="conti" method="post" action="<?php if ($next <= 45) {
                                                            print 'index.php?page=test&codigo=' . $codigo . '&idpregunta=' . $next;
                                                        } else {
                                                            print 'index.php?page=test&view=resultado&codigo=' . $codigo;
                                                        } ?>">
                <h3 style="color:grey"><?php if ($next <= 45) {
                                            echo ('Pregunta ' . utf8_encode($idpregunta) . ' de 44');
                                        } else echo 'Test finalizado' ?></h3>
                <h1> Yachayqay Test </h1>

                <!--  Mostramos datos para paginación -->

                <h2><?php if ($next <= 45) echo $enunciado;
                    else echo "Muchas gracias por completar el test de Estilos de aprendizaje"; ?></h2>

                <div class="radio-toolbar">
                    <input type=radio id="A" name="question" value='1' onclick='return activar();' />
                    <label for="A" style="<?php if ($next >= 46) print("display: none;") ?>"><?php echo $opcion1; ?></label>

                    <input type=radio id="B" name="question" value='2' onclick='return activar();' />
                    <label for="B" style="<?php if ($next >= 46) echo "display: none;" ?>"" class=" hidden"><?php if ($next <= 45) echo $opcion2;
                                                                                                        else echo "Gracias"; ?></label>

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

                    echo $prev;
                    //Boton 'Anterior'
                    if ($prev > 0) {
                        echo ("<a class='siguiente' href='index.php?page=test&codigo=$codigo&idpregunta=$prev'>Anterior</a>");
                    }

                    //Opcional, visualizar el total de paginas, es decir, podrias crear algo similar a  < 1 2 3 4 > .       
                    // for ($i=1; $i<=$total_pagina; $i++) { 
                    //  echo "<a href='fetch.php?pagina=$i'>$i</a>"; 
                    //}

                    //Boton 'Siguiente'
                    if ($pagina <= $total_pagina) {
                        echo "<button class='siguiente' type='submit' name='grabar' id='respuestaA' onclick='return desactivar();'>Siguiente</button>";
                    }
                    //Pagina final donde se ejecuta el proceso de guardar los resultados
                    if ($pagina == 45) {
                        echo "<button class='siguiente' type='submit' name='grabar' id='respuestaA'>Finalizar</button>";
                        //filtrado de datos segun el tipo de estilos de aprendizaje
                        $resultado = $test->calcularPorcentaje($codigo, 'Act-Ref');
                        $resultado1 = $test->calcularPorcentaje($codigo, 'Sec-Glo');
                        $resultado2 = $test->calcularPorcentaje($codigo, 'Sen-Int');
                        $resultado3 = $test->calcularPorcentaje($codigo, 'Vis-Ver');

                        foreach ($resultado as $r) {
                            $reflexivo = (($r['numero'] / 11) * 100);
                        }
                        foreach ($resultado1 as $r) {
                            $global = (($r['numero'] / 11) * 100);
                        }
                        foreach ($resultado2 as $r) {
                            $intuitivo = (($r['numero'] / 11) * 100);
                        }
                        foreach ($resultado3 as $r) {
                            $verbal = (($r['numero'] / 11) * 100);
                        }

                        //envio a la base de datos
                        $datos = array(
                            'codestudiante'    => $codigo,
                            'nivelactref' => $reflexivo, 
                            'nivelsenint' => $intuitivo, 
                            'nivelvisver' => $verbal, 
                            'nivelsecglo' => $global, 
                        );
                        $test->guardarResultados($datos);
                    }

                    ?>
            </form>
            <!-- es la consulta que se debe llevar a store procedure -->
            <?php

            if (isset($_POST['question'])) {
                $respuesta = intval($_POST['question']);
                $variable = $pagina - 1;
                $test->actualizarRespuesta($respuesta, $codigo, $variable);
            }
            ?>
        </div>
    </div>
    </div>
</body>

</html>