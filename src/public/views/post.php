<?php include('../../header.php');
include('../../functions/functions.php'); 

session_start(); 

if (isset($_POST['submit_comentario'])) {

    $post_id = $_POST['post_id'];
    $comentario_texto = htmlspecialchars($_POST['comentario']);
    $usuario = isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : 'Anonimo'; //puede ser anonimo el comentario :P

    AgregarComentario($post_id, $usuario, $comentario_texto);

    echo "<div class='alert alert-success mt-4'>Comentario agregado correctamente.</div>";

    header("Location: ".$_SERVER['REQUEST_URI']);
    exit;
}
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
                <li class="nav-item">
                    <a class="nav-link" href="./subir.php">Upload Post</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<body>
    <div class="container mt-4">

        <a href="../../index.php" class="btn custom-btn" role="button">Volver</a>


        <div class="row my-2">
            <div class="col-12">
                <?php
                $file_path = '../../../posts.txt';
                if (file_exists($file_path)) {
                    $posts = file($file_path, FILE_IGNORE_NEW_LINES);
                    if (isset($_GET['post_id'])) {
                        $post_id = $_GET['post_id'];
                        $found = false;
                        foreach ($posts as $post) {
                            $post_data = explode('|', $post);
                            if ($post_data[0] == $post_id) {
                                $found = true;
                                $title = $post_data[1];
                                $autor = $post_data[2];
                                $content = $post_data[3];
                                $image_url = $post_data[4];
                                ?>

                                    <div class='border p-2 text-center rounded shadow-sm post-card'>
                                        <h1 class="fw-bolder fs-1 text-center my-2"><?php echo htmlspecialchars($title); ?></h1>
                                    </div>
                                    <div class='border p-2 my-2 rounded shadow-sm post-card'>
                                        <img src="<?php echo htmlspecialchars($image_url); ?>" alt="Imagen del post"
                                            class="img-fluid rounded mx-auto d-block" width="800">
                                    </div>
                                    <div class='border p-2 rounded shadow-sm post-card'>
                                        <p class="text-justify fs-6"><?php echo nl2br(htmlspecialchars($content)); ?></p>
                                    </div>
                                    <div class='border p-2 rounded shadow-sm post-card'>
                                        
                                    <?php
                                        $comentarios_file = '../../../comentarios.txt';
                                        echo "<h1 class='fw-bolder fs-2 my-4'> Comentarios </h1>";
                                            if (file_exists($comentarios_file)) {
                                                $comentarios = file($comentarios_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                                                foreach ($comentarios as $comentario) {
                                                    list( $comentario_id_tema, $comentario_id_usuario, $comentario_username, $comentario_texto, $fecha, $id_comentario) = explode("|", $comentario);
                                                    $hay_post=false;
                                                    if ($comentario_id_tema == $post_id) {
                                                        echo "<div class='border border-5 p-2 rounded shadow-sm post-card bg-fondo'>";
                                                        echo "<p class='text-start fs-5 fw-bold'>" . $comentario_username . "</p>"; 
                                                        echo "<p class='text-start fs-6'>" . $comentario_texto . "</p>";
                                                        echo "</div>";
                                                        $hay_post=true;
                                                    }
                                                }
                                            }
                                            if(!$hay_post) {
                                                echo "<p>No hay comentarios disponibles.</p>";
                                            }

                                    ?>    
                                    <div class='border my-2 p-2 rounded shadow-sm post-card'>
                                        <p class='text-start fs-5 fw-bold'>Agregar un comentario</p>
                                        <form action="" method="post">
                                            <div class="form-group">
                                                <label for="comentario">Comentario</label>
                                                <textarea class="form-control" id="comentario" name="comentario" rows="3" required></textarea>
                                            </div>
                                        <button type="submit" class="btn custom-btn mt-2">Agregar Comentario</button>
                                        <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post_id); ?>">
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