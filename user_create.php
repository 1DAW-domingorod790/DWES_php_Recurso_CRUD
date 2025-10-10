<?php
//INICIALIZACIÓN DEL ENTORNO
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function dump($var){
    global $miVariable;
    echo $miVariable;
    echo '<pre>'.print_r($var,1).'</pre>';
}

//función lógica de presentación

function getFormularioMarkup() {
    $output = '';
    $output .= '<form action="'.$_SERVER['PHP_SELF'].'" method="post">';
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
    $output .= 'Contraseña: <input type="pwd" name="contraseña" required>';
    $output .= '<br>';
    $output .= '<input type="submit" value="Crear usuario">';
    $output .= '</form>';

    procesarFormulario();

    return $output;
}

//LÓGICA DE NEGOCIO
function procesarFormulario () {
    if (!empty($_POST)){
        
    }else {
        dump("no hay post.");
    }
}


//LÓGICA DE PRESENTACIÓN
$formularioMarkup = getFormularioMarkup();
$post = leerPOST();

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
            echo $post;
        ?>
    </div>
</body>
</html>