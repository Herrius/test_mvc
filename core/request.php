<?php

require_once 'config.php';
$page = $_GET['page'];

if (!empty($page)) {
  #http://curso-php.test/cms/index.php?page=buscar
  $data = array(
    #cambios de test
    'docente' => array('model' => 'Docente', 'view' => 'docente', 'controller' => 'DocenteController'),
    'alumno' => array('model' => 'Docente', 'view' => 'alumno', 'controller' => 'DocenteController'),
    'resultadoa' => array('model' => 'Docente', 'view' => 'resultadoAlumno', 'controller' => 'DocenteController'),
    'resultados' => array('model' => 'Docente', 'view' => 'resultadoGrupal', 'controller' => 'DocenteController'),
    'signup' => array('model' => 'Usuario', 'view' => 'signup', 'controller' => 'UsuarioController'),
    'login' => array('model' => 'Usuario', 'view' => 'login', 'controller' => 'UsuarioController'),
    'index'=> array('model'=>'Usuario','view'=> isset($_GET['view'])?$_GET['view']: 'inicio','controller'=>'UsuarioController'),
    'test'=> array('model'=>'Test','view'=>isset($_GET['view'])?$_GET['view']: 'test','controller'=>'TestController'),
  );

  foreach($data as $key => $components) {
    if ($page == $key) {
      $model = $components['model'];
      $view = $components['view'];
      $controller = $components['controller'];
      break;
    }
  }

  if (isset($model)) {
    require_once 'controllers/'.$controller.'.php';
    $objeto = new $controller();
    $objeto->$view();
  }
} else {
  header('Location: index.php?page=index');
}