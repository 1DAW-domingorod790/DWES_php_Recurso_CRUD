<?php
//INICIALIZACIÓN DEL ENTORNO
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function customError($errno, $errstr) {
    echo "<b>Error:</b> [$errno] $errstr<br>";
    echo "Ending Script";
    die();
}

set_error_handler("customError");

function dump($var){
    echo '<pre>'.print_r($var,1).'</pre>';
}

//función lógica de presentación

function getFormularioMarkup() {
    $output = '';
    $output .= '<form action="'.procesarFormulario().'" method="post" enctype="multipart/form-data">';

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
                <input type="file" name="foto">
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
        $archivoIDleer = fopen('id.csv', 'r');
        $id = fgetcsv($archivoIDleer);
        $idAescribir = ($id[0]+1);
        // dump($id);
        $data = array (
            'id' => $idAescribir,
            'nombre' => $_POST['nombre'],
            'apellidos' => $_POST['apellidos'],
            'email' => $_POST['email'],
            'rol' => $_POST['rol'],
            'fecha de alta' => date("Y-m-d H:i:s"),
            'foto' => $_FILES['foto']['name']
        );

        if (filesize('users.csv') === 0){
            fputcsv($archivoEscribir, array_keys($data));
        }

        fputcsv($archivoEscribir, array_values($data));

        fclose($archivoEscribir);
        fclose($archivoIDleer);
        $archivoIDescribir = fopen("id.csv", 'w');
        fwrite($archivoIDescribir, $idAescribir);
        fclose($archivoIDescribir);

        $directorioImg = 'img/';
        $rutaFinal = $directorioImg . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], $rutaFinal);

        header("HTTP/1.1 308 Permanent Redirect");
        header('Location: ./user_index.php');
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