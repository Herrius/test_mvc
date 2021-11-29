<?php
//consulta mvc
 require_once 'controllers/DocenteController.php';
 $docente = new DocenteController();

  // consulta directa
  $conn=mysqli_connect ('localhost','root','','test');
  $nrc=$_GET['nrc'];
  $query="SELECT * FROM tblconsultasalon where nrc='$nrc'";
  $result=mysqli_query($conn,$query);
  $result=mysqli_fetch_array($result);

 $estudiante=$docente->contar($result['Nombreasignatura']);
 $reflexivo=$docente->contarEstilo('nivelactref',$result['Nombreasignatura']);
 $intuitivo=$docente->contarEstilo('nivelsenint',$result['Nombreasignatura']);
 $verbal=$docente->contarEstilo('nivelvisver',$result['Nombreasignatura']);
 $global=$docente->contarEstilo('nivelsecglo',$result['Nombreasignatura']);

 foreach($reflexivo as $r){
    $cantidadr=$r['ESTILO'];
    $promedior=$r['PROMEDIO'];
 }
 foreach($intuitivo as $r){
    $cantidadi=$r['ESTILO'];
    $promedioi=$r['PROMEDIO'];
 }
 foreach($verbal as $r){
    $cantidadv=$r['ESTILO'];
    $promediov=$r['PROMEDIO'];
 }
 foreach($global as $r){
    $cantidadg=$r['ESTILO'];
    $promediog=$r['PROMEDIO'];
 }

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado Grupal</title>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.min.css">

    <!-- carrusel -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@2.4.21/dist/js/splide.min.js"></script>

    <link rel="stylesheet" href="assets/css/stylesEA.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
    <!-- Always shows a header, even in smaller screens. -->
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header class="mdl-layout__header">
            <div class="mdl-layout__header-row">
                <!-- Title -->
                <span class="mdl-layout-title yachay ">Yachayqay</span>
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
                <div class="mdl-cell mdl-cell--12-col">
                    <div class="mdl-grid profile mdl-color--white mdl-shadow--2dp">
                        <!-- <div class="mdl-cell mdl-cell--4-col profile-image">
                            <img src="https://images.unsplash.com/photo-1544717305-2782549b5136?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=687&q=80" alt="">
                        </div> -->
                        <div class="mdl-cell mdl-cell--12-col">
                           <p class="student-title display-4">Estilos de aprendizaje del salón: <?php print(utf8_encode($result['Nombreasignatura'])." ".$result['NRC'])?></p>
                           <p class="display-2">Numero de estudiantes: <?php foreach($estudiante as $r){
                                    print($r['ESTUDIANTES']);
                               }?></p>
                        </div>
                        <div id="columnchart_values" style="width: 1300px; height: 300px;"></div>
                    </div>
                </div>
                <!-- <div class="mdl-cell mdl-cell--6-col profile">
                    <div class="student-title width-100">Fundamento de programación</div>
                    <div class="notes width-100">
                        <span><p class="note-title">C1</p><p class="note-note">19</p></span>
                        <span><p class="note-title">Parcial</p><p class="note-note">19</p></span>
                        <span><p class="note-title">C2</p><p class="note-note">19</p></span>
                        <span><p class="note-title">Final</p><p class="note-note">19</p></span>
                    </div>
                </div> -->
                <div class="splide mdl-cell--12-col" id="carrusel">
                    <div class="splide__track">
                        <ul class="splide__list">
                          <li class="splide__slide">
                                <div class="demo-charts mdl-color--white mdl-shadow--2dp">
                                    <div class="student-score">
                                        <span>Activo</span>
                                        <span><?php print(number_format(100-$promedior,2,',',' '));?></span>
                                    </div>
                                        <p>Aprenden trabajando con otros</p>
                
                                
                                    <svg fill="currentColor" width="200px" height="200px" viewBox="0 0 1 1" class="demo-chart note-score">
                                        <use xlink:href="#piechart" mask="url(#piemask)" />
                                        <text x="0.5" y="0.5" font-family="Roboto" font-size="0.2" fill="#000" text-anchor="middle" dy="0"><?php print(number_format(100-$promedior,2,',',' '));?>%</text>
                                        <text x="0.5" y="0.5" font-family="Roboto" font-size="0.08" fill="#000" text-anchor="middle" dy="0.15">ESTUDIANTES</text>
                                    </svg>
                                </div>
                         </li>   
                            <li class="splide__slide">
                                <div class="demo-charts mdl-color--white mdl-shadow--2dp">
                                    <div class="student-score">
                                        <span>Reflexivo</span>
                                        <span><?php print(number_format($promedior,2,',',' '));?></span>
                                    </div>
                                        <p>Aprenden trabajando con otros</p>
                
                                
                                    <svg fill="currentColor" width="200px" height="200px" viewBox="0 0 1 1" class="demo-chart note-score">
                                        <use xlink:href="#piechart" mask="url(#piemask)" />
                                        <text x="0.5" y="0.5" font-family="Roboto" font-size="0.2" fill="#000" text-anchor="middle" dy="0"><?php print(number_format($promedior,2,',',' '));?>%</text>
                                        <text x="0.5" y="0.5" font-family="Roboto" font-size="0.08" fill="#000" text-anchor="middle" dy="0.15">ESTUDIANTES</text>
                                    </svg>
                                </div>
                            </li>   
                            <li class="splide__slide">
                                <div class="demo-charts mdl-color--white mdl-shadow--2dp">
                                    <div class="student-score">
                                        <span>Sensorial</span>
                                        <span><?php print(number_format(100-$promedioi,2,',',' '));?>%</span>
                                    </div>
                                        <p>Aprenden trabajando con otros</p>
                
                                
                                    <svg fill="currentColor" width="200px" height="200px" viewBox="0 0 1 1" class="demo-chart note-score">
                                        <use xlink:href="#piechart" mask="url(#piemask)" />
                                        <text x="0.5" y="0.5" font-family="Roboto" font-size="0.2" fill="#000" text-anchor="middle" dy="0"><?php print(number_format(100-$promedioi,2,',',' '));?>%</text>
                                        <text x="0.5" y="0.5" font-family="Roboto" font-size="0.08" fill="#000" text-anchor="middle" dy="0.15">ESTUDIANTES</text>
                                    </svg>
                                </div>
                            </li>   
                            <li class="splide__slide">
                                <div class="demo-charts mdl-color--white mdl-shadow--2dp">
                                    <div class="student-score">
                                        <span>Intuitivo</span>
                                        <span><?php print(number_format($promedioi,2,',',' '));?></span>
                                    </div>
                                        <p>Aprenden trabajando con otros</p>
                  
                                   
                                    <svg fill="currentColor" width="200px" height="200px" viewBox="0 0 1 1" class="demo-chart note-score">
                                        <use xlink:href="#piechart" mask="url(#piemask)" />
                                        <text x="0.5" y="0.5" font-family="Roboto" font-size="0.2" fill="#000" text-anchor="middle" dy="0"><?php print(number_format($promedioi,2,',',' '));?>%</text>
                                        <text x="0.5" y="0.5" font-family="Roboto" font-size="0.08" fill="#000" text-anchor="middle" dy="0.15">ESTUDIANTES</text>
                                    </svg>
                                </div>
                            </li>   
                            <li class="splide__slide">
                                <div class="demo-charts mdl-color--white mdl-shadow--2dp">
                                    <div class="student-score">
                                        <span>Activo</span>
                                        <span>12.5%</span>
                                    </div>
                                        <p>Aprenden trabajando con otros</p>
                  
                                   
                                    <svg fill="currentColor" width="200px" height="200px" viewBox="0 0 1 1" class="demo-chart note-score">
                                        <use xlink:href="#piechart" mask="url(#piemask)" />
                                        <text x="0.5" y="0.5" font-family="Roboto" font-size="0.2" fill="#000" text-anchor="middle" dy="0">82%</text>
                                        <text x="0.5" y="0.5" font-family="Roboto" font-size="0.08" fill="#000" text-anchor="middle" dy="0.15">ESTUDIANTES</text>
                                    </svg>
                                </div>
                            </li>   
                            <li class="splide__slide">
                                <div class="demo-charts mdl-color--white mdl-shadow--2dp">
                                    <div class="student-score">
                                        <span>Activo</span>
                                        <span>12.5%</span>
                                    </div>
                                        <p>Aprenden trabajando con otros</p>
                  
                                   
                                    <svg fill="currentColor" width="200px" height="200px" viewBox="0 0 1 1" class="demo-chart note-score">
                                        <use xlink:href="#piechart" mask="url(#piemask)" />
                                        <text x="0.5" y="0.5" font-family="Roboto" font-size="0.2" fill="#000" text-anchor="middle" dy="0">82%</text>
                                        <text x="0.5" y="0.5" font-family="Roboto" font-size="0.08" fill="#000" text-anchor="middle" dy="0.15">ESTUDIANTES</text>
                                    </svg>
                                </div>
                            </li>   
                            <li class="splide__slide">
                                <div class="demo-charts mdl-color--white mdl-shadow--2dp">
                                    <div class="student-score">
                                        <span>Activo</span>
                                        <span>12.5%</span>
                                    </div>
                                        <p>Aprenden trabajando con otros</p>
                  
                                   
                                    <svg fill="currentColor" width="200px" height="200px" viewBox="0 0 1 1" class="demo-chart note-score">
                                        <use xlink:href="#piechart" mask="url(#piemask)" />
                                        <text x="0.5" y="0.5" font-family="Roboto" font-size="0.2" fill="#000" text-anchor="middle" dy="0">82%</text>
                                        <text x="0.5" y="0.5" font-family="Roboto" font-size="0.08" fill="#000" text-anchor="middle" dy="0.15">ESTUDIANTES</text>
                                    </svg>
                                </div>
                            </li>   
                            <li class="splide__slide">
                                <div class="demo-charts mdl-color--white mdl-shadow--2dp">
                                    <div class="student-score">
                                        <span>Activo</span>
                                        <span>12.5%</span>
                                    </div>
                                        <p>Aprenden trabajando con otros</p>
                  
                                   
                                    <svg fill="currentColor" width="200px" height="200px" viewBox="0 0 1 1" class="demo-chart note-score">
                                        <use xlink:href="#piechart" mask="url(#piemask)" />
                                        <text x="0.5" y="0.5" font-family="Roboto" font-size="0.2" fill="#000" text-anchor="middle" dy="0">82%</text>
                                        <text x="0.5" y="0.5" font-family="Roboto" font-size="0.08" fill="#000" text-anchor="middle" dy="0.15">ESTUDIANTES</text>
                                    </svg>
                                </div>
                            </li>   
                    
                </div>
                
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" style="position: fixed; left: -1000px; height: -1000px;">
                <defs>
                  <mask id="piemask" maskContentUnits="objectBoundingBox">
                    <circle cx=0.5 cy=0.5 r=0.49 fill="white" />
                    <circle cx=0.5 cy=0.5 r=0.40 fill="black" />
                  </mask>
                  <g id="piechart">
                    <circle cx=0.5 cy=0.5 r=0.5 />
                    <path d="M 0.5 0.5 0.5 0 A 0.5 0.5 0 0 1 0.95 0.28 z" stroke="none" fill="rgba(255, 255, 255, 0.75)" />
                  </g>
                </defs>
              </svg>
        </main>
    </div>
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
</body>

</html>

<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Numero de estudiantes", { role: "style" } ],
        ["Activo", <?php print(abs($r['ESTUDIANTES']-$cantidadr));?>, "#d8cbfd"],
        ["Reflexivo", <?php print($cantidadr);?>, "#d8cbfd"],
        ["Sensorial", <?php print(abs($r['ESTUDIANTES']-$cantidadi));?>, "#d8cbfd"],
        ["Intuitivo", <?php print($cantidadi);?>, "#d8cbfd"],
        ["Visual", <?php print(abs($r['ESTUDIANTES']-$cantidadv));?>, "#d8cbfd"],
        ["Verbal", <?php print($cantidadv);?>, "#d8cbfd"],
        ["Secuencial", <?php print(abs($r['ESTUDIANTES']-$cantidadg));?>, "#d8cbfd"],
        ["Global", <?php print($cantidadg);?>, "#d8cbfd"]
  
        
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        
        bar: {groupWidth: "50%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  
    document.addEventListener( 'DOMContentLoaded', function () {
    new Splide( '#carrusel',{
        type   : 'no-loop',
        perPage: 4,
        perMove: 4,
        pagination:false,
    } ).mount();
    } );

  </script>