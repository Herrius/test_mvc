<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styles.css">
    <?php
    	if ($_GET['page'] == 'blog' ||  $_GET['page'] == 'articulo' || $_GET['page'] == 'buscar') {
    		echo "<link rel='stylesheet' href='assets/css/nav.css'>";
    		echo "<link rel='stylesheet' href='assets/css/blog.css'>";
    	}

        if ($_GET['page'] == 'dashboard' || $_GET['page'] == 'publicar' ) {
            echo "<link rel='stylesheet' href='assets/css/dashboard.css'>";
        }
    ?>
    <title>CMS</title>
</head>
<body>