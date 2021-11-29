<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Resultados</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" &amp;gt;>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


</head>

<body>
    <?php
    $test = new TestController();

    $resultado = $_GET['codigo'];
    $consultarResultado = $test->consultarResultado($resultado);
    foreach ($consultarResultado as $row) {
        $codestudiante = $row['codestudiante'];
        // datos
        $nivelactref = $row['nivelactref'];
        $nivelsenint = $row['nivelsenint'];
        $nivelvisver = $row['nivelvisver'];
        $nivelsecglo = $row['nivelsecglo'];
    }


    $activoreflexivo = 100 - $nivelactref;

    $sensorialintuitivo = 100 - $nivelsenint;

    $visualverbal = 100 - $nivelvisver;

    $secuencialglobal = 100 - $nivelsecglo;


    ?>

    <div class="vh-100 row align-items-center  mx-0">
        <div class="row mx-0">
            <div class="vw-100">
                <p class="h1 text-center"><?php echo $codestudiante; ?></p><br>
            </div>
            <div class="col-12 row ">
                <div class="col-6 d-flex align-items-center">
                    <p class="fs-1 flex-grow-1 mb-0 text-right mr-2">Activo</p>
                    <a href="index.php?page=test&view=estilo&estilo=activo" class="flex-grow-1">
                        <div class="progress" style="height: 3rem;">
                            <div class="progress-bar text-dark" role="progressbar" style="width: <?php echo $activoreflexivo; ?>%;" aria-valuenow="<?php echo $activoreflexivo; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $activoreflexivo; ?>%</div>
                        </div>
                    </a>
                </div>

                <div class="col-6  d-flex align-items-center ">
                    <a href="index.php?page=test&view=estilo&estilo=reflexivo" class="flex-grow-1">
                        <div class="progress" style="height: 3rem;">
                            <div class="progress-bar text-dark" role="progressbar" style="width: <?php echo $nivelactref; ?>%;" aria-valuenow="<?php echo $nivelactref; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $nivelactref; ?>%</div>
                        </div>
                    </a>
                    <p class="fs-1 flex-grow-1 ml-2 mb-0 ">Reflexivo</p>
                </div>
            </div>

            <div class="col-12 row mt-2">
                <div class="col-6 d-flex align-items-center">
                    <p class="fs-1 flex-grow-1 mb-0 text-right mr-2">Sensorial</p>
                    <a href="index.php?page=test&view=estilo&estilo=sensorial" class="flex-grow-1">
                        <div class="progress" style="height: 3rem;">
                            <div class="progress-bar text-dark" role="progressbar" style="width: <?php echo $sensorialintuitivo; ?>%;" aria-valuenow="<?php echo $sensorialintuitivo; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $sensorialintuitivo; ?>%</div>
                        </div>
                    </a>

                </div>

                <div class="col-6 d-flex align-items-center">

                    <a href="index.php?page=test&view=estilo&estilo=intuitivo" class="flex-grow-1">
                        <div class="progress" style="height: 3rem;">
                            <div class="progress-bar text-dark" role="progressbar" style="width: <?php echo $nivelsenint; ?>%;" aria-valuenow="<?php echo $nivelsenint; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $nivelsenint; ?>%</div>
                        </div>
                    </a>
                    <p class="fs-1 flex-grow-1 mb-0 text-left ml-2">Intuitivo</p>
                </div>

            </div>
            <div class="col-12 row mt-2">
                <div class="col-6 d-flex align-items-center">
                    <p class="fs-1 flex-grow-1 mb-0 text-right mr-2">Visual</p>
                    <a href="index.php?page=test&view=estilo&estilo=visual" class="flex-grow-1">
                        <div class="progress" style="height: 3rem;">
                            <div class="progress-bar text-dark" role="progressbar" style="width: <?php echo $visualverbal; ?>%;" aria-valuenow="<?php echo $visualverbal; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $visualverbal; ?>%</div>
                        </div>
                    </a>

                </div>
                <div class="col-6 d-flex align-items-center">

                    <a href="index.php?page=test&view=estilo&estilo=verbal" class="flex-grow-1">
                        <div class="progress" style="height: 3rem;">
                            <div class="progress-bar text-dark" role="progressbar" style="width: <?php echo $nivelvisver; ?>%;" aria-valuenow="<?php echo $nivelvisver; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $nivelvisver; ?>%</div>
                        </div>
                    </a>
                    <p class="fs-1 flex-grow-1 mb-0 text-left ml-2">Verbal</p>
                </div>

            </div>
            <div class="col-12 row mt-2">
                <div class="col-6 d-flex align-items-center">
                    <p class="fs-1 flex-grow-1 mb-0 text-right mr-2">Secuencial</p>
                    <a href="index.php?page=test&view=estilo&estilo=secuencial" class="flex-grow-1">
                        <div class="progress" style="height: 3rem;">
                            <div class="progress-bar text-dark" role="progressbar" style="width: <?php echo $secuencialglobal; ?>%;" aria-valuenow="<?php echo $secuencialglobal; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $secuencialglobal; ?>%</div>
                        </div>
                    </a>

                </div>
                <div class="col-6 d-flex align-items-center">

                    <a href="index.php?page=test&view=estilo&estilo=global" class="flex-grow-1">
                        <div class="progress" style="height: 3rem;">
                            <div class="progress-bar text-dark" role="progressbar" style="width: <?php echo $nivelsecglo; ?>%;" aria-valuenow="<?php echo $nivelsecglo; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $nivelsecglo; ?>%</div>
                        </div>
                    </a>
                    <p class="fs-1 flex-grow-1 mb-0 text-left ml-2 ">Global</p>
                </div>

            </div>

        </div>

    </div>
    <!-- <div class="container">
                    <a href="exel.php?codigo=<?php echo $codestudiante ?>" class="btn_imprimir" type="button" value="" style="position: relative;display: block;height: 50px;width: 120px;border-radius: 50px;text-transform: uppercase;background-color: transparent;color: black;font-size: 18px;overflow: hidden;transition: all 500ms ease;border: 2px solid black;margin-bottom: 20px;z-index: 0;font-weight: 700;cursor: pointer;text-align: center;font-size: 0.7rem;padding: 0.5rem 1rem;text-decoration: none;float:left" >Descargar exel</a>
                    <a href="inf/Estilos_Aprendizaje.pdf" download="EstilosdeAprendizaje.pdf" class="btn_imprimir" type="button" value="" style="position: relative;display: block;height: 50px;width: 120px;border-radius: 50px;text-transform: uppercase;background-color: transparent;color: black;font-size: 18px;overflow: hidden;transition: all 500ms ease;border: 2px solid black;margin-bottom: 20px;z-index: 0;font-weight: 700;cursor: pointer;text-align: center;font-size: 0.7rem;padding: 0.5rem 1rem;text-decoration: none;float:right" >Descargar pdf</a>
                </div> -->

</body>

</html>

<?php


?>