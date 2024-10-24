<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
    <link href="./public/style.css" rel="stylesheet" />
</head>

<body>

    <?php include('./navbar.php'); ?>

    <div class="container text-center mt-4">
        <div class="row g-3">
            <div class="col-12 col-lg-10">
                <?php
                include('functions/functions.php');
                $posts_file = '../posts.txt';
                // Se verifica si existe la base de datos
                if (file_exists($posts_file)) {
                    // Se lee la base de datos con la función LeerArchivo()
                    $posts = LeerArchivo($posts_file);
                    // Se recorre posición de $posts
                    foreach ($posts as $post) {
                        list($id, $title, $categoria, $autor, $description, $image) = explode("|", $post);
                        $new_description = substr($description, 0, 320);
                        echo "<div class='border p-4 rounded mb-4 shadow-sm post-card'>";
                        echo "<a href='public/views/post.php?post_id=$id' class='text-decoration-none text-black'>";
                        echo "<img src=$image class='rounded mb-3 img-fluid' alt='Post Image'>";
                        echo "<p class='fs-4 fw-bold post-title'>$title</p>";
                        echo "<p>$categoria</p>";
                        echo "<p class='text-justify post-content'>$new_description.....</p>";
                        echo "<p class=''>Autor: $autor</p>";
                        echo "</a>";
                        echo "</div>";
                    }
                }
                ?>
            </div>

            <div class="col-12 col-lg-2 sidebar-creadores">
                <div class='border p-4 rounded'>
                    <h5 class='fw-bold'>Post Recientes</h5>
                    <ul class='list-unstyled'>
                        <?php
                        $posts_file = '../posts.txt';
                        // Se lee la base de datos
                        $posts = LeerArchivo($posts_file);
                        // Se recorre cada posición de $posts
                        foreach ($posts as $post) {
                            list($id, $title) = explode("|", $post);
                            echo "<li><a href='public/views/post.php?post_id=$id' class='text-decoration-none text-dark'>$title</a></li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include('./footer.php'); ?>

</html>