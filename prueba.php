
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        function dump($var){
            echo '<pre>'.print_r($var,1).'</pre>';
        }

        
        
        function prueba () {
            return '<form action="prueba.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="nombre">
                    <input type="file" name="foto">
                    <input type="submit" value="Crear Usuario">';
        }

        echo prueba();

        $directorio = 'img/';
        if(!empty($_POST)){
            $rutaFinal = $directorio . "id1";
            dump($rutaFinal);
            move_uploaded_file($_FILES['foto']['tmp_name'], $rutaFinal);
        }
        

        dump($_POST);
        dump($_FILES);
        
        
        
    
    
    ?>
</body>
</html>