<?php include('../../header.php'); ?>

<nav class="navbar navbar-expand-lg bg-custom">
    <div class="container-fluid">
        <a class="navbar-brand" href="../../index.php">Games blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="../../index.php">Home</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<body>

    <div class="container mt-5">
        <h1>Subir un Nuevo Post</h1>

        <form method="POST">
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

        include('../../functions/functions.php');

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
<?php include('../../footer.php'); ?>

</html>