<?php
//INICIALIZACIÓN DEL ENTORNO
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function dump($var){
    echo '<pre>'.print_r($var,1).'</pre>';
}

//Función lógica de presentación
function getUsuariosMarkup() {
    $output = '';
    $archivo = fopen('users.csv','r');
    $keys = fgetcsv($archivo);

    while (($fila = fgetcsv($archivo)) !== false) {
        $data = array_combine($keys, $fila);
        dump($data);
        $output .= '<div class="usuario">';
            $output .= '<h1>'.$data['nombre'].'</h1>';
            $output .= '<div class="datos-usuario">';
                $output .= '<p>Email: '.$data['email'].'</p>';
                $output .= '<p>Rol: '.$data['rol'].'</p>';
                $output .= '<p>Alta: '.$data['fecha de alta'].'</p>';
            $output .= '</div>';

        $output .= '</div>';
    }

    
    return $output;
}

//LÓGICA DE NEGOCIO
function leerArchivo($nombreArchivo) {
    $archivo = fopen($nombreArchivo,'r');
    $data = [];
    while ($datosFila = fgetcsv($archivo)) {
        $data = array(
            $data[] = $datosFila
        );
    }
    return $data;
}   


$usuariosMarkup = getUsuariosMarkup();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users info</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>
<body>
    <h1>USUARIOS CREADOS</h1>
    <div class="container-usuarios">
        <?php
            echo $usuariosMarkup;
        ?>
    </div>
</body>
</html>