<?php
//INICIALIZACIÓN DEL ENTORNO
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function dump($var){
    echo '<pre>'.print_r($var,1).'</pre>';
}

function getMensajeMarkup () {
    $texto = '';
    $output = '';
    $nombreUsuarioEliminado = '';
    $encontrado = false;
    $archivoLeer = fopen("users.csv", 'r');
    $keys = fgetcsv($archivoLeer);

    $texto .= 'id,nombre,apellidos,email,rol,fecha de alta'."\n";
    while($values = fgetcsv($archivoLeer)) {
        // dump($values);
        $user = array_combine($keys, $values);
        if ($user['id'] != $_GET['id']) {
            $id = $user['id'];
            if($encontrado) {
                $id--;
            }
            $texto .= $id.",".$user['nombre'].",".$user['apellidos'].",".$user['email'].",".$user['rol'].",".$user['fecha de alta']."\n";
        }else{
            $encontrado = true;
            $nombreUsuarioEliminado .= $user['nombre'] ." ". $user['apellidos'];
        }
    }
    // dump($texto);
    $archivoEscribir = fopen("users.csv", 'w');
    fwrite($archivoEscribir, $texto);
    $output .= '<h3>El usuario '.$nombreUsuarioEliminado.' ha sido eliminado con éxito</h3>';
    return $output;
}

function getBotonMarkup () {
    $output = '';

    $output .= '<form action="user_index.php" method="post">';
    $output .= '<input type="submit" value="Volver">';
    $output .= '</form>';

    return $output;
}


$mensaje = getMensajeMarkup ();
$botonIndex = getBotonMarkup();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar usuario</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <style>
        body {
            background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e);
            color: #fff;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 1rem;
        }
    </style>
</head>
<body>
    <div class="mensaje">
        <?php
            echo $mensaje;
            echo $botonIndex;
        ?>
    </div>
</body>
</html>