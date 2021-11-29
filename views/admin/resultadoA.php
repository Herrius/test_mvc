<?php
    require_once 'controllers/DocenteController.php';
    $docente = new DocenteController();
    $codigoEstudiante = intval($_GET['estudiante']);
    $result=$docente->identidad($codigoEstudiante);
   
    $test=$docente->test($_GET['estudiante']);

    foreach($test as $r){
        $activo=$r['nivelactref'];
        $reflexivo=abs($r['nivelactref'] - 100);
        $sensorial=$r['nivelsenint'];
        $intuitivo=abs($r['nivelsenint'] - 100);
        $visual=$r['nivelvisver'];
        $verbal=abs($r['nivelvisver'] - 100);
        $global=$r['nivelsecglo'];
        $secuencial=abs($r['nivelsecglo'] - 100);
    };
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado individual</title>
    <link href="./assets/circliful-master/dist/main.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.min.css">
    <!-- carrusel -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@2.4.21/dist/js/splide.min.js"></script>

    <link rel="stylesheet" href="assets/css/stylesEA.css">
</head>

<body>
<?php

?>
    <!-- Always shows a header, even in smaller screens. -->
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header class="mdl-layout__header">
            <div class="mdl-layout__header-row">
                <!-- Title -->
                <span class="mdl-layout-title yachay">Yachayqay</span>
                <!-- Add spacer, to align navigation to the right -->

                <!-- Navigation. We hide it in small screens. -->

            </div>
        </header>
        <!-- menu -->
        <div class="mdl-layout__drawer">
            <span class="mdl-layout-title">Yachaqay</span>
            <nav class="mdl-navigation">
            <a class="mdl-navigation__link" href="index.php?page=alumno">Resultados individuales</a>
                <a class="mdl-navigation__link" href="index.php?page=docente">Resultados grupales</a>
            </nav>
        </div>
        <main class="mdl-layout__content">
            
            <div class="page-content mdl-grid">
                <div class="mdl-cell mdl-cell--6-col">
                    <div class="mdl-grid profile">
                        <div class="mdl-cell mdl-cell--4-col profile-image">
                            <img src="https://thispersondoesnotexist.com/image" alt="">
                        </div>
                        <div class="mdl-cell mdl-cell--8-col">
                            <?php 
                                foreach($result as $r){
                                }
                            ?>
                            <p class="student-title"><?php print($r['apellidos']+' '+$r['nombres']) ?></p>
                            <ul>
                                <li>Ciclo 10</li>
                                <li>Sede: Huancayo</li>
                                <li>Codigo: <?php print(substr($r['codestudiante'],0,8)) ?></li>
                                <li>Correo: <?php print($r['codestudiante']) ?></li>
                            </ul>
                            
                        </div>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--6-col profile">
                    <div class="student-title width-100"><?php print($r['curso'])?></div>
                    <div class="notes width-100">
                        <span>
                            <p class="note-title">C1</p>
                            <p class="note-note">19</p>
                        </span>
                        <span>
                            <p class="note-title">Parcial</p>
                            <p class="note-note">19</p>
                        </span>
                        <span>
                            <p class="note-title">C2</p>
                            <p class="note-note">19</p>
                        </span>
                        <span>
                            <p class="note-title">Final</p>
                            <p class="note-note">19</p>
                        </span>
                    </div>
                </div>
                <div class="splide mdl-cell--12-col" id="carrusel">
                    <div class="splide__track">
                        <ul class="splide__list">
                        
                            
                            <li class="splide__slide">
                                <div class="demo-charts mdl-color--white mdl-shadow--2dp">
                                    <div class="student-score">
                                        Activo
                                    </div>
                                    <p>Aprenden trabajando con otros</p>


                                    <div id="activo" data-percent="<?php print($activo) ?>" data-text="Activo">
                                    </div>
                                </div>
                            </li>
                            <li class="splide__slide">
                                <div class="demo-charts mdl-color--white mdl-shadow--2dp">
                                    <div class="student-score">
                                        <span>Reflexivo</span>
                                    </div>
                                    <p>Aprenden estando solo</p>


                                    <div id="reflexivo" data-percent="<?php print($reflexivo) ?>" data-text="Relexivo">
                                    </div>
                                </div>
                            </li>

                            <li class="splide__slide">
                                <div class="demo-charts mdl-color--white mdl-shadow--2dp ">
                                    <div class="student-score">
                                        <span>Sensorial</span>
                                    </div>
                                    <p>Aprenden observando y analizando</p>


                                    <div id="sensorial" data-percent="<?php print($sensorial); ?>" data-text="Sensorial">
                                    </div>
                                </div>
                            </li>
                            <li class="splide__slide">
                                <div class="demo-charts mdl-color--white mdl-shadow--2dp ">
                                    <div class="student-score">
                                        <span>Intuitivo</span>
                                    </div>
                                    <p>Aprenden mejor deduciendo</p>


                                    <div id="intuitivo" data-percent="<?php print($intuitivo); ?>" data-text="intuitivo">
                                    </div>
                                </div>
                            </li>
                            <li class="splide__slide">
                                <div class="demo-charts mdl-color--white mdl-shadow--2dp ">
                                    <div class="student-score">
                                        <span>Visual</span>
                                    </div>
                                    <p>Aprenden mediante diagramas y demostraciones</p>


                                    <div id="visual" data-percent="<?php print($visual); ?>" data-text="Visual">
                                    </div>
                                </div>
                            </li>
                            <li class="splide__slide">
                                <div class="demo-charts mdl-color--white mdl-shadow--2dp ">
                                    <div class="student-score">
                                        <span>Verbal</span>

                                    </div>
                                    <p>Aprenden mejor escuchando, hablando y discutiendo</p>


                                    <div id="verbal" data-percent="<?php print($verbal); ?>" data-text="Verbal">
                                    </div>
                                </div>
                            </li>
                            <li class="splide__slide">
                                <div class="demo-charts mdl-color--white mdl-shadow--2dp ">
                                    <div class="student-score">
                                        <span>Global</span>
                                    </div>
                                    <p>Aprende todo de manera superficial para luego especializarse</p>


                                    <div id="global" data-percent="<?php print($global); ?>" data-text="Global">
                                    </div>
                                </div>
                            </li>
                            <li class="splide__slide">
                                <div class="demo-charts mdl-color--white mdl-shadow--2dp ">
                                    <div class="student-score">
                                        <span>Secuencial</span>
                                    </div>
                                    <p>Aprenden cuando la informacion se presenta de forma progresiva</p>


                                    <div id="secuencial" data-percent="<?php print($secuencial); ?>" data-text="Secuencial">
                                    </div>
                                </div>
                            </li>
                          
       
                        </ul>
                    </div>
                </div>
                <div class="mdl-grid profile-score">


                </div>

            </div>




        </main>
    </div>
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <script src="assets/circliful-master/dist/circliful.js"></script>
    <script src="assets/js/resultados.js"></script>
</body>

</html>