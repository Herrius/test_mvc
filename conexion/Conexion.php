<?php
$servidor="mysql:dbname=test;host=127.0.0.1";
$usuario="test";
$password="test";

/*este parámetro permite si no hay error se conecte directamente a la base de datos*/
try{
    $pdo= new PDO($servidor,$usuario,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
    echo "conectado!!!..";


/*el catch no permitira entrar a la base de datos si hay algun error */    
}catch(PDOException $e){

    echo "conexión mala :(".$e->getMessage();

}

?>