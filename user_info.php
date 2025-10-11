<?php
//INICIALIZACIÓN DEL ENTORNO
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function dump($var){
    echo '<pre>'.print_r($var,1).'</pre>';
}

//Función lógica de presentación
function getUserMarkup() {
    $id = $_GET['id'];
    $userData = getUserData($id);
    $output = '';
    
    $output .= '<h1>'.$userData['nombre'].' '.$userData['apellidos'].'</h1>';
    $output .= '<br>';
    $output .= '<li><p>ID de Usuario: '.$userData['id'].'</p></li>';
    $output .= '<br>';
    $output .= '<li><p>Correo electrónico: '.$userData['email'].'</p></li>';
    $output .= '<br>';
    $output .= '<li><p>Rol: '.$userData['rol'].'</p></li>';
    $output .= '<br>';
    $output .= '<li><p>Fecha de alta: '.$userData['fecha de alta'].'</p></li>';
    return $output;
}


//LÓGICA DE NEGOCIO
function getUserData($id){
    $archivo = fopen('users.csv','r');
    $keys = fgetcsv($archivo);
    while ($fila = fgetcsv($archivo)) {
        $data = array_combine($keys, $fila);
        if ($data['id'] == $id) {
            return $data;
        }
    }
}

$userMarkup = getUserMarkup();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>
<body>
    <?php
        echo $userMarkup;
    ?>
</body>
</html>