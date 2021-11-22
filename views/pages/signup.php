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
            'password' => md5($_POST['password']),
            'id_rol' => 0,
            'nombres' => $_POST['name'],
            'apellidos' => $_POST['lastname'],
            'curso' => $_POST['curso'],
            'codigo' => '',
        );
        $objeto->guardarUsuario($datos);
    } else {

        header('Location: index.php?page=signup');
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styles_test.css">
    <title>Registrarme a Yachayqay Test</title>
</head>

<body>
    <div class="body">
        <div class="contenedor">
            <header class="img">
                <img src="assets/img/UC-Horizontal-White 1.png">
            </header>


            <h1 class="fw-bold"> YACHAYQAY</h1>


            <h2 class="h3">Registrarme</h2>
            <span>o <a href="index.php?page=login">Iniciar Sesion</a></span>
            <?php
            if (isset($_SESSION['mensaje'])) {
                $mensaje=$_SESSION['mensaje'];
                echo '<script>
                alert("'.$mensaje.'");
                window.location.reload();
                </script>';
                echo "<div class='alert alert-primary' role='alert'>" . $_SESSION['mensaje'] . "</div>";
                
            }
            ?>

            <form action="index.php?page=signup" method="POST" name="registroForm" id="registroForm">
                <input type="hidden" name="csrf" id="csrf" value="<?php echo $csrf ?>">
                <input type="text" name="lastname" id="lastname" placeholder="Apellido" class="form-control" maxlength="27" required>
                <input type="text" name="name" id="name" placeholder="Nombre" class="form-control" maxlength="27" required>
                <select id="curso" name="curso" class="form-select" required>
                    <option selected hidden disabled>Escoga un curso</option>
                    <option value="BIOTECNOLOGÍA">BIOTECNOLOGÍA</option>
                </select>
                <input type="email" name="email" id="email" placeholder="Registre su Email" class="form-control" maxlength="27" required>
                <input name="password" type="password" id="password" class="form-control" placeholder="Ingrese su contraseña" required>
                <input type="submit" name="registrar" value="Registrarme">
            </form>


            </form>

        </div>
    </div>
    </div>
</body>

</html>