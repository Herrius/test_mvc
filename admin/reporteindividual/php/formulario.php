<?php
include "conexion.php";

$user_id=null;
$sql1= "select * from tblresultados where idresultado = ".$_GET["idresultado"];
$query = $con->query($sql1);
$person = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $person=$r;
  break;
}

  }
?>

<?php if($person!=null):?>
  
  <form role="form" id="actualizar" >
  <h2>Estudiante: <?php echo $person->codestudiante; ?></h2>
  
  <u><h3>Forma de procesar la informacion</h3></u>
  <h4>Estilo Activo: <?php echo 100-$person->nivelactref; ?>%</h4>
  <div class="progress">
  <div class="progress-bar" role="progressbar" style="width: <?php echo 100-$person->nivelactref; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo 100-$person->nivelactref; ?>%</div>
  </div>
  <p>El estudiante prefiere trabajar en equipo, demandando actividades que requieran la experimentación activa y mostrando entusiasmo ante tareas nuevas ya que pueden experimentar, manipular, discutir, aplicar, ensayar y, así mismo, explicar la información a otros compañeros.</p>
  <h4>Estilo Reflexivo: <?php echo $person->nivelactref; ?>%</h4>
  <div class="progress">
  <div class="progress-bar" role="progressbar" style="width: <?php echo $person->nivelactref; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $person->nivelactref; ?>%</div>
</div>
  <p>El estudiante se centra en trabajar individualmente y, por lo tanto, le suele incomodar el trabajo grupal, ya que su actividad está basada en pensar, meditar, deducir, comparar y clasificar la información recibida.</p>
  
  <u><h3>Forma de percibir la informacion</h3></u>
  <h4>Estilo Sensitivo: <?php echo 100-$person->nivelsenint; ?>%</h4>
  <div class="progress">
  <div class="progress-bar" role="progressbar" style="width: <?php echo 100-$person->nivelsenint; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo 100-$person->nivelsenint; ?>%</div>
</div>
  <p>El estudiante preferentemente percibe la información externa o sensitiva a través de algunos sentidos, en especial a través de la vista mediante la observación, o del oído en la escucha, combinando los sentidos anteriormente referenciados con la identificación, lectura y relato. Por eso, los alumnos más sensitivos se sienten cómodos aprendiendo hechos y procedimientos, pues son memorísticos y prácticos.</p>
  <h4>Estilo Intuitivo: <?php echo $person->nivelsenint; ?>%</h4>
  <div class="progress">
  <div class="progress-bar" role="progressbar" style="width: <?php echo $person->nivelsenint; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $person->nivelsenint; ?>%</div>
</div>
  <p>El estudiante prefiere la teoría, las ideas y los conceptos abstractos y les gusta reflexionar para descubrir posibilidades y relaciones. Estos estudiantes se caracterizan porque les agrada aprender hechos, facilitándoles solucionar problemas por métodos bien establecidos y tienden a ser pacientes con los detalles de los trabajos, destaca su capacidad de memorizar hechos y hacer el trabajo de campo, pero les incomodan las complicaciones y sorpresas. </p>
  
  <u><h3>Canal sensorial preferido para percibir la informacion</h3></u>
  <h4>Estilo Visual: <?php echo 100-$person->nivelvisver; ?>%</h4>
  <div class="progress">
  <div class="progress-bar" role="progressbar" style="width: <?php echo 100-$person->nivelvisver; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo 100-$person->nivelvisver; ?>%</div>
</div>
  <p> Es de gran ayuda para el estudiante registrar la información con el uso de los contornos, textos y apuntes realizados en la pizarra y codificando con rotuladores y bolígrafos de diferentes colores para leer y resumir, así que para estos alumnos es importante tener una buena visión del aula, incluyendo el lenguaje corporal del docente.</p>
  <h4>Estilo Verbal: <?php echo $person->nivelvisver; ?>%</h4>
  <div class="progress">
  <div class="progress-bar" role="progressbar" style="width: <?php echo $person->nivelvisver; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $person->nivelvisver; ?>%</div>
</div>
  <p> El estudiante recuerda mejor la información que lee o la que escucha y, por tanto, es importante para ellos el uso de la expresión oral y escrita, así como el empleo de fórmulas y diversos símbolos.</p>
  
  <u><h3>Forma de procesar el aprendizaje</h3></u>
  <h4>Estilo Secuencial: <?php echo 100-$person->nivelsecglo; ?>%</h4>
  <div class="progress">
  <div class="progress-bar" role="progressbar" style="width: <?php echo 100-$person->nivelsecglo; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo 100-$person->nivelsecglo; ?>%</div>
</div>
  <p>El estudiante refleja el progreso en el aumento de la comprensión de la información en pasos lineales. Se puede verificar que pueden no entender el material, pero que finalmente logran hacer algo conectando lógicamente sus partes. En este tipo de alumnos, es importante la labor docente de trabajar la comprensión y se debe enseñar a tratar de solucionar un problema siguiendo caminos a través de pequeños pasos lógicos.</p>
  <h4>Estilo Global: <?php echo $person->nivelsecglo; ?>%</h4>
  <div class="progress">
  <div class="progress-bar" role="progressbar" style="width: <?php echo $person->nivelsecglo; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $person->nivelsecglo; ?>%</div>
</div>
  <p>El estudiante refleja el progreso de su aprendizaje en que son capaces de resolver problemas complejos rápidamente y con posterioridad captar el panorama general, pero a su vez, presentan gran dificultad para explicar cómo lo lograron. La labor docente en estos casos es vital y compleja, porque deben enseñar a razonar a los alumnos los problemas y explicar cómo lograron resolverlos ya que fueron resueltos rápidamente casi al azar.</p>
</form>
<?php else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<?php endif;?>