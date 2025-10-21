<?php
// INICIALIZACIÓN DEL ENTORNO
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function dump($var){
    echo '<pre>'.print_r($var,1).'</pre>';
}

// Función lógica de presentación
function getUserMarkup() {
    $id = $_GET['id'] ?? null;
    if (!$id) {
        return '<p style="color:red;">No se ha proporcionado un ID de usuario.</p>';
    }

    $userData = getUserData($id);
    if (!$userData) {
        return '<p style="color:red;">Usuario no encontrado.</p>';
    }

    $output  = '<div class="user-card">';
    $output .= '<h1>'.$userData['nombre'].' '.$userData['apellidos'].'</h1>';
    $output .= '<ul class="user-info">';
    $output .= '<li><strong>ID de Usuario:</strong> '.$userData['id'].'</li>';
    $output .= '<li><strong>Correo electrónico:</strong> '.$userData['email'].'</li>';
    $output .= '<li><strong>Rol:</strong> '.$userData['rol'].'</li>';
    $output .= '<li><strong>Fecha de alta:</strong> '.$userData['fecha de alta'].'</li>';
    $output .= '</ul>';
    $output .= '<a href="user_index.php" class="back-button">Volver</a>';
    $output .= '</div>';

    return $output;
}

// Lógica de negocio
function getUserData($id){
    $archivo = fopen('users.csv','r');
    $keys = fgetcsv($archivo);
    while ($fila = fgetcsv($archivo)) {
        $data = array_combine($keys, $fila);
        if ($data['id'] == $id) {
            return $data;
        }
    }
    return null;
}

$userMarkup = getUserMarkup();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <style>
        body {
            background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e);
            color: #fff;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 1rem;
        }

        .user-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 2rem;
            max-width: 400px;
            width: 100%;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            text-align: center;
        }

        .user-card h1 {
            margin-bottom: 1rem;
            font-size: 1.8rem;
            color: #fff;
        }

        .user-info {
            list-style: none;
            padding: 0;
            margin: 1rem 0;
            text-align: left;
        }

        .user-info li {
            background: rgba(255,255,255,0.1);
            padding: 0.6rem 1rem;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            display: flex;
            justify-content: space-between;
            font-size: 0.95rem;
        }

        .user-info strong {
            color: #f0f0f0;
        }

        .back-button {
            display: inline-block;
            margin-top: 1rem;
            background-color: #2575fc;
            color: #fff;
            padding: 0.6rem 1.2rem;
            border-radius: 6px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #1e5ed6;
        }
    </style>
</head>
<body>
    <?php echo $userMarkup; ?>
</body>
</html>
