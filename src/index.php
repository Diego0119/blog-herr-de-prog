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
            <div class="col-10">
                <?php
                include('./functions/funcionts.php');
                $posts_file = '../posts.txt';
                if (file_exists($posts_file)) {
                    $posts = file($posts_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                    foreach ($posts as $post) {
                        list($title, $description, $image) = explode("|", $post);
                        echo "<div class='border p-4 rounded mb-4 shadow-sm post-card'>";
                        echo "<img src=$image class='rounded mb-3 img-fluid' alt='Post Image'>";
                        echo "<p class='fs-4 fw-bold post-title'>$title</p>";
                        echo "  <p class='text-justify post-content'>$description</p>";
                        echo "</div>";
                    }
                }
                ?>
            </div>

            <div class="col-2 sidebar-creadores">
                <div class="border  p-4 rounded">
                    <h5 class="fw-bold">Post Recientes</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-dark">Post 1</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Post 2</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Post 3</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
<footer class="bg-custom text-light mt-4">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-6">
                <p class="fw-bold">Contacto</p>
                <p>
                    Email: <a href="mailto:info@example.com" class="text-light">info@example.com</a><br>
                    Teléfono: <a href="tel:+123456789" class="text-light">+123 456 789</a>
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                <h5 class="fw-bold">Síguenos</h5>
                <a href="#" class="text-light me-3"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-light me-3"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-light me-3"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-light"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
        <hr class="my-3">
        <p class="text-center mb-0">© 2024 Felipe Carcamo y Diego Sanhueza. Todos los derechos reservados.</p>
    </div>
</footer>

</html>