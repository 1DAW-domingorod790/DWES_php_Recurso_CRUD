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

    $output .= '<label for="chk" aria-hidden="true">Sign up</label>
                <input type="text" name="nombre" placeholder="Nombre" required>
                <input type="text"  name="apellidos" placeholder="Apellidos" required>
                <input type="email" name="email" placeholder="Email" required>
                <select name="rol" required>
                    <option value="" disabled selected>Selecciona un rol</option>
                    <option value="usuario">Usuario</option>
                    <option value="administrador">Administrador</option>
                    <option value="moderador">Moderador</option>
                </select>
                <input type="password" name="contrasena" placeholder="Contraseña" required>
                <input type="submit" value="Crear Usuario">';
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
    <link rel="stylesheet" href="user_create_styles.css">
</head>
<body>
    <div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">
            <div class="signup">
                <?php
                    echo $formularioMarkup;
                ?>
            </div>
    </div>
</body>
</html>