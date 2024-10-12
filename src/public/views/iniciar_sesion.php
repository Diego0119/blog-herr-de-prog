<?php
session_start();

if (isset($_POST['submit'])) {
    $entered_nickname = $_POST['nickname'];
    $entered_password = $_POST['password'];

    // aca debo recorrer todo el txt viendo si existe el usuario
    //1|Diego Sanhueza|username|123456
    $encontrado = false;
    $usuarios = file('../../../usuarios.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($usuarios as $usuario) {
        list($id, $name, $nickname, $password) = explode("|", $usuario);
        if ($nickname == $entered_nickname && $password == $entered_password) {
            $encontrado = true;
            $_SESSION['nickname'] = $nickname;
            $_SESSION['password'] = $password;
            header('Location: ../../index.php');
            exit();
        } else {
            $error = "Credenciales incorrectas. Intenta de nuevo.";
        }
        exit();

    }
}
?>

<?php include('../../header.php') ?>
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
    <div class="container mt-5">
        <h2 class="text-center">Iniciar Sesión</h2>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form method="POST">
                    <div>
                        <label for="nickname">Nickname</label>
                        <input type="text" name="nickname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <?php if (isset($error)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php } ?>
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>