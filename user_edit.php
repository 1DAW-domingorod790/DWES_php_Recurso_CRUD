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
    $output .= '<label for="chk" aria-hidden="true">Edit info</label>
                <input type="text" name="nombre" value="'.$userData['nombre'].'" required>
                <input type="text"  name="apellidos" value="'.$userData['apellidos'].'" required>
                <input type="email" name="email" value="'.$userData['email'].'" required>
                <select name="rol" required>
                    <option value="" disabled selected>'.$userData['rol'].'</option>
                    <option value="usuario">Usuario</option>
                    <option value="administrador">Administrador</option>
                    <option value="moderador">Moderador</option>
                </select>
                <input type="password" placeholder="Contraseña" name="contrasena" required>
                <input type="submit" value="Confirmar cambios">';
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

        header("HTTP/1.1 308 Permanent Redirect");
        header('Location: ./user_index.php?row=0&col=0');
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
    <link rel="stylesheet" href="user_create_styles.css">
</head>
<body>
    <div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">
            <div class="signup">
                <?php
                    echo $userMarkup;
                ?>
            </div>
    </div>
</body>
</html>