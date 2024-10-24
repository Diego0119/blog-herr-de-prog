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

    <div class="container mt-5">
        <div class="row g-4">
            <!-- Sección del post -->
            <div class="col-12 col-lg-8">
                <?php
                include('functions/functions.php');
                $posts_file = '../posts.txt';
                // Se verifica si existe la base de datos
                if (file_exists($posts_file)) {
                    // Se lee la base de datos con la función LeerArchivo()
                    $posts = LeerArchivo($posts_file);
                    // Se recorre cada posición de $posts
                    foreach ($posts as $post) {
                        list($id, $title, $categoria, $autor, $description, $image) = explode("|", $post);
                        $new_description = substr($description, 0, 320);
                        echo "<div class='card mb-4 shadow-sm'>";
                        echo "<a href='public/views/post.php?post_id=$id' class='text-decoration-none text-dark'>";
                        echo "<img src='$image' class='card-img-top img-fluid rounded' alt='Post Image'>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title fw-bold'>$title</h5>";
                        echo "<p class='card-text'><small class='text-muted'> Categoria: $categoria | Autor: $autor</small></p>";
                        echo "<p class='card-text'>$new_description...</p>";
                        echo "</div>";
                        echo "</a>";
                        echo "</div>";
                    }
                }
                ?>
            </div>

            <!-- Sección de los posts recientes -->
            <div class="col-12 col-lg-4">
                <div class='border p-4 rounded shadow-sm'>
                    <h5 class='fw-bold'>Post Recientes</h5>
                    <ul class='list-unstyled'>
                        <?php
                        $posts_file = '../posts.txt';
                        // Se lee la base de datos
                        $posts = LeerArchivo($posts_file);
                        // Se recorre cada posición de $posts
                        foreach ($posts as $post) {
                            list($id, $title) = explode("|", $post);
                            echo "<li class='mb-2'><a href='public/views/post.php?post_id=$id' class='text-decoration-none text-dark'>$title</a></li>";
                        }
                        ?>
                    </ul>
                </div>
                <!-- Esto no funciona, es solo para añadir mas informacion -->
                <div class='border p-4 rounded shadow-sm mt-4'>
                    <h5 class='fw-bold'>Dólar (USD) a Peso Chileno (CLP) al día: <?php echo date('d/m/Y'); ?></h5>

                    <p> 1 Dólar estadounidense = 947.08 Pesos Chilenos</p>
                    <p>Para corroborar la informacion dirigirse aquí: <a href="https://www.dolaronline.cl/"
                            target="blank">USD a
                            CLP</a></p>
                </div>
                <div class='border p-4 rounded shadow-sm mt-4'>
                    <h5 class='fw-bold'>Clima en la ciudad de Punta Arenas</h5>
                    <p>7 ºC, ventoso y nublado.</p>
                    <p>Muy frio, no habiamos visto un frio tanto este año como este año tanto frio.</p>
                    <a href="https://www.meteored.cl/tiempo-en_Punta+Arenas-America+Sur-Chile-Magallanes+y+de+la+Antartica+Chilena-SCCI-1-18570.html"
                        target="blank">Clima</a>
                </div>

            </div>

        </div>
    </div>

    <?php include('./footer.php'); ?>
</body>

</html>