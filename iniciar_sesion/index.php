<?php
    session_start();

    require 'database.php';

    if (isset($_SESSION['user_id'])) {
      $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
      $records->bindParam(':id', $_SESSION['user_id']);
      $records->execute();
      $results = $records->fetch(PDO::FETCH_ASSOC);

      $user = null;

      if (count($results) > 0) {
        $user = $results;
      }
    }
?>


<!DOCTYPE HTML>    
    <html>    
    <head>    
    <meta utfset="utf-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <link rel="stylesheet" href="assets/css/preguntas.css">
    <title>Inicio Yachayqay Test</title>
    
    </head>    
    <body >
    <div class="body">
        <div class="contenedor">
            <header class="img">
                <img src="assets/css/UC-Horizontal-White 1.png">
            </header> 
            <form class="conti" method="post" >
          
            <h1> YACHAYQAY TEST </h1>         
            <?php if(!empty($user)): ?>
              <br> Bienvenido. <?= $user['email']; ?>
              <br>Inicio satisfactoriamente
              <a href="logout.php">
                Salir
              </a>
            <?php else: ?>
              <h2>Porfavor</h2>
              <FONT SIZE=5><b><a href="signup.php" style="text-decoration: none;">Registrarme </a></b>    y 
              <FONT SIZE=5><b><a  href="login.php" style="text-decoration: none;" >Iniciar Sesión  </a> </b>  <br><br>

            <?php endif; ?>  
            </form>          
            </div>
        </div>    
</body>

</html>












