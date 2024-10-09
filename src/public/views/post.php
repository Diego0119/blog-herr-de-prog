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
                <li class="nav-item">
                    <a class="nav-link" href="./subir.php">Upload Post</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<body>
    <div class="container mt-4">
        <div class="row">
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
                                $content = $post_data[2];
                                $image_url = $post_data[3];
                                ?>

                                <div class="post-detail border rounded p-4 shadow-sm mb-4">
                                    <h1 class="fw-bold text-center"><?php echo htmlspecialchars($title); ?></h1>
                                    <img src="<?php echo htmlspecialchars($image_url); ?>" alt="Imagen del post"
                                        class="img-fluid rounded mx-auto d-block mb-3">
                                    <div class="content">
                                        <p class="text-justify"><?php echo nl2br(htmlspecialchars($content)); ?></p>
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