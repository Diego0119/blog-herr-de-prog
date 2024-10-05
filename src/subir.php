<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Post</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Subir un Nuevo Post</h1>

        <form action="subir.php" method="POST">
            <div class="form-group">
                <label for="titulo">Título del Post</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción del Post</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="imagen_url">URL de la Imagen</label>
                <input type="text" class="form-control" id="imagen_url" name="imagen_url"
                    placeholder="https://placehold.co/600x400" required>
            </div>

            <button type="submit" class="btn btn-primary">Subir Post</button>
        </form>

        <?php

        include('functions.php');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];
            $imagen_url = $_POST['imagen_url'];

            SubirArchivo($titulo, $descripcion, $imagen_url);

            echo "<div class='alert alert-success mt-4'>El post ha sido subido correctamente.</div>";
        }
        ?>
    </div>
</body>

</html>