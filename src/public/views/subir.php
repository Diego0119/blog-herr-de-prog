<?php include('../../header.php');
session_start();
?>

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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<body>

    <div class="container mt-5">
        <h1 class="text-center">Subir un Nuevo Post</h1>

        <form method="POST" action="subir.php" enctype="multipart/form-data" class="mt-4">
            <div class="form-group">
                <label for="titulo">Título del Post</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>

            <div class="form-group mt-4">
                <label for="categoria">Selecciona una categoría</label>
                <select id="categoria" name="categoria" class="form-select" required>
                    <option value="Noticia">Noticia</option>
                    <option value="Lanzamiento">Lanzamiento</option>
                    <option value="Dato curioso">Dato curioso</option>
                    <option value="Tutorial">Tutorial</option>
                </select>
            </div>

            <div class="form-group mt-4">
                <label for="descripcion">Descripción del Post</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
            </div>

            <div class="form-group mt-4">
                <label for="imagen_url">URL de la Imagen</label>
                <input type="file" class="form-control" id="imagen_url" name="imagen_url" required>
            </div>

            <button type="submit" name="submit" id="submit" class="btn btn-primary mt-4">Subir Post</button>
        </form>

        <?php
        include('../../functions/functions.php');

        // Verifica que haya una sesión activa
        if (!isset($_SESSION['nickname'])) {
            echo "<div class='alert alert-danger mt-4'>Se debe iniciar sesión para subir un post</div>";
        } else if (isset($_POST['submit'])) {
            // Se guarda lo que se envió en el formulario
            $titulo = $_POST['titulo'];
            $categoria = $_POST['categoria'];
            $descripcion = $_POST['descripcion'];
            $imagen_url = $_FILES['imagen_url']['name'];

            // Se llama a la función subir archivo
            SubirArchivo($titulo, $_SESSION['nickname'], $categoria, $descripcion, $_FILES['imagen_url']);
        
            echo "<div class='alert alert-success mt-4'>El post ha sido subido correctamente.</div>";
        }
        ?>
    </div>
</body>

<?php include('../../footer.php'); ?>