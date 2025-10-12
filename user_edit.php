<?php
//INICIALIZACIÓN DEL ENTORNO
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function dump($var){
    echo '<pre>'.print_r($var,1).'</pre>';
}

//Función lógica de presentación
function getFormularioMarkup() {
    $userData = getUserData($_GET['id']);
    $output = '';
    $output .= '<form action="'.procesarFormulario($_GET['id']).'" method="post">';
    $output .= 'Nombre: <input type="text" name="nombre" value="'.$userData['nombre'].'" required>';
    $output .= '<br>';
    $output .= 'Apellidos: <input type="text" name="apellidos" value="'.$userData['apellidos'].'"  required>';
    $output .= '<br>';
    $output .= 'Correo electrónico: <input type="email" name="email" value="'.$userData['email'].'"  required>';
    $output .= '<br>';
    $output .= '<div class="form-group">
                        Selecciona tu rol:
                        <select name="rol" class="form-control">
                            <option value="">Seleccione un rol</option>
                            <option value="administrador">Administrador</option>
                            <option value="usuario">Usuario</option>
                            <option value="moderador">Moderador</option>
                        </select>
                </div>';
    $output .= '<br>';
    $output .= 'Contraseña: <input type="password" name="contraseña" required>';
    $output .= '<br>';
    $output .= '<input type="submit" value="Confirmar cambios">';
    $output .= '</form>';
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

function procesarFormulario($id) {
    if(!empty($_POST)){
        $archivoLeer = fopen('users.csv', 'r');
        $texto = '';
        $keys = fgetcsv($archivoLeer);
        while($fila = fgetcsv($archivoLeer)){
            $data = array_combine($keys, $fila);
            if ($data['id'] == $id) {
                $texto .= $id.",".$_POST['nombre'].",".$_POST['apellidos'].",".$_POST['email'].",".$_POST['rol'].",".$data['fecha de alta']."\n";
            }else{
                $texto .= $data['id'].",".$data['nombre'].",".$data['apellidos'].",".$data['email'].",".$data['rol'].",".$data['fecha de alta']."\n";
            }
        }
        $archivoEscribir = fopen('users.csv', 'w');
        fwrite($archivoEscribir, 'id,nombre,apellidos,email,rol,fecha de alta'."\n");
        fwrite($archivoEscribir, $texto);
        
        fclose($archivoLeer);
        fclose($archivoEscribir);
    }
}


$userMarkup = getFormularioMarkup();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit user</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>
<body>
    <h1>EDITAR USUARIO</h1>
    <?php
        echo $userMarkup;
    ?>
</body>
</html>