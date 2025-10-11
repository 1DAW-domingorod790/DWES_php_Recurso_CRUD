<?php
//INICIALIZACIÓN DEL ENTORNO
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function dump($var){
    echo '<pre>'.print_r($var,1).'</pre>';
}

//función lógica de presentación

function getFormularioMarkup() {
    $output = '';
    $output .= '<form action="'.procesarFormulario().'" method="post">';
    $output .= 'Nombre: <input type="text" name="nombre" required>';
    $output .= '<br>';
    $output .= 'Apellidos: <input type="text" name="apellidos" required>';
    $output .= '<br>';
    $output .= 'Correo electrónico: <input type="email" name="email" required>';
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
    $output .= '<input type="submit" value="Crear usuario">';
    $output .= '</form>';

    return $output;
}

//LÓGICA DE NEGOCIO
function procesarFormulario () {
    if (!empty($_POST)){
        $archivoLeer = fopen('users.csv', 'r');
        $archivoEscribir = fopen('users.csv', 'a');
        $id = 1;
        if (empty(fgetcsv($archivoLeer))) {
            fwrite($archivoEscribir, "id,nombre,apellidos,email,rol,fecha de alta\n");
        } else {
            while (fgetcsv($archivoLeer)) {
            $id++;
        }
        }
        $data = array (
            'id' => $id,
            'nombre' => $_POST['nombre'],
            'apellidos' => $_POST['apellidos'],
            'email' => $_POST['email'],
            'rol' => $_POST['rol'],
            'fecha de alta' => date("Y-m-d H:i:s")
        );
        fputcsv($archivoEscribir, array_values($data));
        fclose($archivoEscribir);
    }
}


//LÓGICA DE PRESENTACIÓN
$formularioMarkup = getFormularioMarkup();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create user</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>
<body>
    <h1>CREAR USUARIO</h1>
    <div class="container-formulario">
        <?php
            echo $formularioMarkup;
        ?>
    </div>
</body>
</html>