<?php include('../../header.php');
include('../../functions/functions.php');

session_start();

// Verificar si se envió el formulario
if (isset($_POST['submit_comentario'])) {
    $post_id = $_POST['post_id'];
    $nickname = $_POST['nickname'];
    $user_id = $_POST['user_id'];
    $comentario_texto = htmlspecialchars($_POST['comentario']);

    AgregarComentario($post_id, $nickname, $user_id, $comentario_texto);

    echo "<div class='alert alert-success mt-4'>Comentario agregado correctamente.</div>";

    header("Location: post.php?post_id=" . $post_id);
    exit;
}
?>

<nav class="navbar navbar-expand-lg bg-custom">
    <div class="container-fluid">
        <a class="navbar-brand" href="../../index.php">Games Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="../../index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./subir.php">Upload Post</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<body class="bg-light">
    <div class="container mt-4">
        <a href="../../index.php" class="btn btn-primary mb-3">Volver</a>

        <div class="row my-2">
            <div class="col-12">
                <?php
                $file_path = '../../../posts.txt';
                // Verificar si el archivo existe  
                if (file_exists($file_path)) {
                    $posts = file($file_path, FILE_IGNORE_NEW_LINES);
                    if ($_GET['post_id'] > 0) {
                        $post_id = $_GET['post_id'];
                        $found = false;
                        // Recorrer los posts para renderizar la vista detallada
                        foreach ($posts as $post) {
                            $post_data = explode('|', $post);
                            if ($post_data[0] == $post_id) {
                                $found = true;
                                $title = $post_data[1];
                                $categoria = $post_data[2];
                                $autor = $post_data[3];
                                $descripcion = $post_data[4];
                                $image_url = $post_data[5];
                                ?>

                                <!-- Sección del post -->
                                <div class='border p-4 text-center rounded shadow-sm post-card bg-white'>
                                    <h1 class="fw-bolder fs-1 my-2"><?php echo htmlspecialchars($title); ?></h1>
                                </div>

                                <div class='border p-4 my-3 rounded shadow-sm post-card bg-white'>
                                    <img src="<?php echo '../uploads/' . htmlspecialchars($image_url); ?>" alt="Imagen del post"
                                        class="img-fluid rounded mx-auto d-block" width="800">
                                </div>

                                <div class='border p-4 rounded shadow-sm post-card bg-white'>
                                    <p class="text-justify fs-6"><?php echo nl2br(htmlspecialchars($descripcion)); ?></p>
                                </div>

                                <div class='border p-4 rounded shadow-sm post-card bg-white'>
                                    <h2 class='fw-bolder fs-4 my-4'>Comentarios</h2>

                                    <?php
                                    $comentarios_file = '../../../comentarios.txt';
                                    $hay_post = false;

                                    if (file_exists($comentarios_file)) {
                                        $comentarios = file($comentarios_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                                        foreach ($comentarios as $comentario) {
                                            list($comentario_id, $comentario_id_usuario, $comentario_username, $comentario_texto, $comentario_post_id) = explode("|", $comentario);
                                            if ($comentario_post_id == $post_id) {
                                                echo "<div class='border p-3 my-2 rounded shadow-sm bg-light'>";
                                                echo "<p class='fw-bold mb-1'>$comentario_username</p>";
                                                echo "<p class='mb-0'>$comentario_texto</p>";
                                                echo "</div>";
                                                $hay_post = true;
                                            }
                                        }
                                    }

                                    if (!$hay_post) {
                                        echo "<p>No hay comentarios disponibles.</p>";
                                    }
                                    ?>

                                    <!-- Formulario para agregar un comentario -->
                                    <div class='border mt-4 p-3 rounded shadow-sm bg-light'>
                                        <h3 class='fs-5 mb-3'>Agregar un comentario</h3>
                                        <form action="post.php" method="post">
                                            <div class="form-group mb-3">
                                                <label for="comentario">Comentario</label>
                                                <textarea class="form-control" id="comentario" name="comentario" rows="3"
                                                    required></textarea>
                                            </div>
                                            <button type="submit" name="submit_comentario" id="submit_comentario"
                                                class="btn btn-primary">Agregar Comentario</button>
                                            <input type="hidden" name="post_id" value="<?php echo ($post_id); ?>">
                                            <input type="hidden" name="nickname" value="<?php echo ($_SESSION['nickname']); ?>">
                                            <input type="hidden" name="user_id" value="<?php echo ($_SESSION['user_id']); ?>">

                                            <?php
                                            if (!isset($_SESSION['user_id'])) {
                                                echo "<div class='alert alert-danger mt-3'>Se debe iniciar sesión para comentar un post</div>";
                                            }
                                            ?>
                                        </form>
                                    </div>
                                </div>

                                <?php
                                break;
                            }
                        }

                        if (!$found) {
                            echo "<p class='text-danger'>El post no existe.</p>";
                        }
                    } else {
                        echo "<p class='text-warning'>No se ha proporcionado un ID de post.</p>";
                    }
                } else {
                    echo "<p class='text-danger'>El archivo de posts no existe.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</body>

<?php include('../../footer.php'); ?>