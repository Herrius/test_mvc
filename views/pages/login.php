<?php

require_once 'controllers/UsuarioController.php';

$usuario = new UsuarioController();
$usuario->login();

if (isset($_POST['acceso'])) {
    $datos = array(
        'email'    => $_POST['email'],
        'password' => md5($_POST['password'])
    );
    $respuesta = $usuario->accesoUsuario($datos);
}
?>


<!DOCTYPE HTML>
<html>

<head>
  <meta utfset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 
  <link rel="stylesheet" href="assets/css/styles_test.css">
  <title>Inicio Sesión Yachayqay Test</title>
</head>

<body>
  <div class="body">
    <div class="contenedor">
      <header class="img">
        <img src="assets/img/UC-Horizontal-White 1.png">
      </header>



      <form action="index.php?page=login" method="POST" name="loginForm" id="loginForm" class="conti">

        <h1 class="fw-bold"> YACHAYQAY</h1>

        <h2 class="h3">Iniciar Sesion</h2>
        <span>o <a href="index.php?page=index&view=signup">Resgistrate</a></span>

          <input name="email" type="email" id="email" class="form-control" placeholder="Ingrese su Email" maxlength="27">
          <input name="password" type="password" id="password" class="form-control" placeholder="Ingrese su contraseña">
          <input type="submit" id="acceso" name="acceso" value="Iniciar">

      </form>

    </div>
  </div>
</body>

</html>