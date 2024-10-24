<?php
session_start();

// Se verifica si se ha presionado el boton de iniciar sesión
if (isset($_POST['submit'])) {
    // Se guarda en variables lo que se ha colocado en el formulario
    $entered_nickname = $_POST['nickname'];
    $entered_password = $_POST['password'];
    $error_detected = false;
    // Se busca la base de datos de los usuarios
    $usuarios = file('../../../usuarios.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Se recorren los usuario
    foreach ($usuarios as $usuario) {
        list($id, $name, $nickname, $password) = explode("|", $usuario);

        // Se realizan validaciones para evitar que se creen nicknames duplicados o que las credenciales sean incorrectas
        if ($nickname == $entered_nickname && $password == $entered_password) {
            $error_detected = true;
            $_SESSION['nickname'] = $nickname;
            $_SESSION['password'] = $password;
            $_SESSION['user_id'] = uniqid();
            header('Location: ../../index.php');
            exit();
        }
    }

    // Se crea un mensaje de error en el caso de que la contraseña o el nickname estan incorrectos
    if (!$error_detected) {
        $error = "Credenciales incorrectas. Intenta de nuevo.";
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Iniciar Sesión</h2>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form method="POST" action="./iniciar_sesion.php">
                    <div>
                        <label for="nickname">Nickname</label>
                        <input type="text" name="nickname" class="form-control" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <?php if (isset($error)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php } ?>
                    <button type="submit" name="submit" class="btn btn-primary btn-block mt-2">Iniciar sesión</button>
                    <p class="text-gray mt-2">¿No tienes cuenta? Registrate <a href="./registrarse.php">aca</a></p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>