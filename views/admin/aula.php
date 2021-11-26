<?php
    $docente=$_GET['docente'];
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Yachayqay Test</title>
        <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.min.css">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/style_procesar.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script type="text/javascript" src="assets/js/busqueda.js"></script>
    </head>
    
    <body> 
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
                <a class="mdl-navigation__link" href="index.php?page=docente">Resultados grupales</a>
                <a class="mdl-navigation__link" href="index.php?page=alumno">Resultados individuales</a>
            
            </nav>
        </div>
        <main class="mdl-layout__content">
            <div class="page-content mdl-grid--stretch">
                <h1 class="title display-4 ">RESULTADOS GENERALES POR AULAS</h1>   
            </div>
            <div class="mdl-grid--stretch ">
                    <form class="text-center">
                        <div class="mdl-textfield mdl-js-textfield ">
                            <input class="mdl-textfield__input text-15" type="text" id="caja_busqueda">
                            <label class="mdl-textfield__label text-15" for="sample1">Buscar...</label>
                        </div>
                    </form>
                    <section id="busquedasalon">
                    </section>
                </div>
        </main>
        
        <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>

    </body>  
</html>
<script>
    var estilos=[];
    var nestudiantes =[];
    $.getJSON("views/admin/function/procesar.php",
    function(data){
        data.forEach(element=>{
            estilos.push(element["estilo"])
        });
        data.forEach(element=>{
            nestudiantes.push(element["nstudiantes"])
        });
        }
    );
   
</script>