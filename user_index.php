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
        $output .= '<ol><h2>'.$data['nombre'].' '.$data['apellidos'].'</h2></ol>';
        $output .= '<div class="usuario">';
            $output .= '<div class="datos-usuario">';
                $output .= '<li><p><b>Email</b>: '.$data['email'].'</p></li>';
                $output .= '<li><p><b>Rol</b>: '.$data['rol'].'</p></li>';
                $output .= '<li><p><b>Fecha de alta: </b>: '.$data['fecha de alta'].'</p></li>';
            $output .= '</div>';
            $output .= '<div class="boton-info">';
                $output .= '<form action="user_info.php?id='.$data['id'].'" method="post">';
                    $output .= '<input type="submit" value="Ver info">';
                $output .= '</form>';
                $output .= '<form action="user_edit.php?id='.$data['id'].'" method="post">';
                    $output .= '<input type="submit" value="Editar">';
                $output .= '</form>';
                $output .= '<form action="user_delete.php?id='.$data['id'].'" method="post">';
                    $output .= '<input type="submit" value="Eliminar">';
                $output .= '</form>';
            $output .= '</div>';
        $output .= '</div>';
    }
    fclose($archivo);
    
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
    <style>
        .container-usuario {
            padding: 20px;
        }
        .usuario {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
        }
        .datos-usuario {
            padding: 20px;
            width: 100%;
        }
        .boton-info {
            width: 100%;
            place-items: center;
        }
        .boton-info input {
            width: 120px;
        }
    </style>

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