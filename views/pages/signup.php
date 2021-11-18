<?php

  require('core/request.php');

  session_start();
  if (empty($_SESSION['key'])) {
      $_SESSION['key'] = bin2hex(random_bytes(32));
      #bin2hex = Devuelve una cadena ascii que contiene la representación hexadecimal de un string que va en su parámetro
      #random_bytes(32) = Genera bytes aleatorios seguros. es el tamaño de la cadena
  }

  #Crear CSRF token
  $csrf = hash_hmac('sha256', 'registro.php', $_SESSION['key']);

  if (isset($_POST['registrar'])) {
      if (hash_equals($csrf, $_POST['csrf'])) {
          #hash_equals = compara las cadenas, cifradas empleando el mismo tiempos
          $datos = array(
              'email'    => $_POST['email'],
              'password' => md5($_POST['password']), #Agregar después md5
              'id_rol' => 0, #Agregar después md5
          );
          $objeto->guardarUsuario($datos);
      } else {
          header('Location: error.php');
          die();
      }
  }
?>

<!DOCTYPE HTML>    
    <html>    
    <head>    
    <meta utfset="utf-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <link rel="stylesheet" href="assets/css/styles_test.css">
    <title>Registrarme a Yachayqay Test</title>
    </head>    
    <body >
    <div class="body">
        <div class="contenedor">
            <header class="img">
                <img src="assets/img/UC-Horizontal-White 1.png">
            </header>


            <h1 style="color: #560e99";>  YACHAYQAY TEST </h1>


            <h2>Registrarme</h2>
            <span>o <a href="index.php?page=login">Iniciar Sesion</a></span>
            <?php
                        if (isset($_SESSION['mensaje'])) {
                            echo "<div class='alert alert-primary' role='alert'>".$_SESSION['mensaje']."</div>";
                        }
                    ?>
            <form action="index.php?page=signup" method="POST"  name="registroForm" id="registroForm">
              <input type="hidden" name="csrf" id="csrf" value="<?php echo $csrf ?>">
              <input type="email" name="email" id="email"  placeholder="Registre su Email"  class="form-control" maxlength="27" required>
              <input name="password" type="password" id="password" class="form-control" placeholder="Ingrese su contraseña" required>
              <input type="submit" name="registrar" value="Registrarme">
            </form>

   
            </form>
          
            </div>
        </div>
    </div>
</body>

</html>












