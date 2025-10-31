<?php
// INICIALIZACIÓN DEL ENTORNO
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function dump($var){
    echo '<pre>'.print_r($var,1).'</pre>';
}

// PRESENTACIÓN
function getUsuariosMarkup() { 
    $output = '';
    $archivo = fopen('users.csv','r');
    $keys = fgetcsv($archivo);

    while (($fila = fgetcsv($archivo)) !== false) {
        $data = array_combine($keys, $fila);

        $output .= '<div class="user-card">';
            $output .= '<div class="user-info">';
                $output .= '<h2>'.$data['nombre'].' '.$data['apellidos'].'</h2>';
                $output .= '<p><strong>Email:</strong> '.$data['email'].'</p>';
                $output .= '<p><strong>Rol:</strong> '.ucfirst($data['rol']).'</p>';
                $output .= '<p><strong>Fecha de alta:</strong> '.$data['fecha de alta'].'</p>';
            $output .= '</div>';

            $output .= '<div class="user-actions">';
                $output .= '<form action="user_info.php?id='.$data['id'].'" method="post">';
                    $output .= '<input type="submit" value="Ver info" class="btn info">';
                $output .= '</form>';
                $output .= '<form action="user_edit.php?id='.$data['id'].'" method="post">';
                    $output .= '<input type="submit" value="Editar" class="btn edit">';
                $output .= '</form>';
                $output .= '<form action="user_delete.php?id='.$data['id'].'" method="post">';
                    $output .= '<input type="submit" value="Eliminar" class="btn delete">';
                $output .= '</form>';
            $output .= '</div>';
        $output .= '</div>';
    }

    fclose($archivo);
    return $output;
}

function getBotonCrearUsuario() {
    return '<button><a href="user_create.php" style="color: black; text-decoration: none">Crear nuevo usuario</a></button>';
}

$usuariosMarkup = getUsuariosMarkup();
$botonCrearUsuario = getBotonCrearUsuario();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <style>
        /* ==== Estilo general ==== */
        body {
            background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e);
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            color: #fff;
            margin: 0;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2rem;
            color: #fff;
        }

        /* ==== Contenedor ==== */
        .container-usuarios {
            max-width: 1000px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            justify-content: center;
            place-items: center;
        }

        /* ==== Tarjeta de usuario ==== */
        .user-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(8px);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .user-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.4);
        }

        /* ==== Info ==== */
        .user-info h2 {
            margin: 0 0 0.5rem 0;
            font-size: 1.4rem;
            color: #fff;
        }

        .user-info p {
            margin: 0.25rem 0;
            font-size: 0.95rem;
            color: #e0e0e0;
        }

        .user-info strong {
            color: #fff;
        }

        /* ==== Acciones ==== */
        .user-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
            gap: 0.5rem;
        }

        .user-actions form {
            flex: 1;
        }

        .btn {
            width: 100%;
            padding: 0.5rem;
            border: none;
            border-radius: 6px;
            color: #fff;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 600;
            transition: background-color 0.25s ease;
            background-color: #2575fc;
        }

        .btn:hover {
            background-color: #1e5ed6;
        }

        @media (max-width: 600px) {
            .user-actions {
                flex-direction: column;
            }
        }

        .crear-usuario{
            color: black;
        }
    </style>
</head>
<body>
    <h1>Usuarios creados</h1>
    <div class="container-usuarios">
        <?php echo $usuariosMarkup; ?>
    </div>
    <br><br>
    <?php echo $botonCrearUsuario ?>
</body>
</html>
