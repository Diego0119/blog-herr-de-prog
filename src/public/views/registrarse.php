<?php
session_start();

// Se verifica si se envio el formulario
if (isset($_POST['submit'])) {
    $usuarios_file = '../../../usuarios.txt';

    // Se guarda lo que se envia en variables
    $username = $_POST['username'];
    $username_id = uniqid();
    $nickname = $_POST['nickname'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $coinciden = true;
    $registrado = false;

    // Se verifica que el archivo de usuarios exista
    if (file_exists($usuarios_file)) {
        $usuarios = file($usuarios_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($usuarios as $usuario) {
            list($id, $stored_username, $stored_nickname, $stored_password) = explode("|", $usuario);
            if ($nickname === $stored_nickname) {
                $error = "El usuario ya está registrado.";
                $registrado = true;
                break;
            }
        }
        // Si las contraseñas no coinciden, salta un error
        if ($password != $confirm_password) {
            $coinciden = false;
            $error = "Las contraseñas no coinciden.";
        }
    }

    // Si esta todo bien se crea el usuario
    if (!$registrado && $coinciden) {
        $data = $username_id . "|" . $username . "|" . $nickname . "|" . $password . PHP_EOL;
        file_put_contents($usuarios_file, $data, FILE_APPEND);
        $_SESSION['username'] = $username;
        header('Location: ../../index.php');
        exit();
    }
}
?>

<?php include('../../header.php'); ?>

<nav class="navbar navbar-expand-lg bg-custom">
    <div class="container-fluid">
        <a class="navbar-brand" href="../../index.php" style="color: #ffffff;">Games Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="../../index.php" style="color: #ffffff;">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./iniciar_sesion.php" style="color: #ffffff;">Iniciar sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


<body>
    <div class="container mt-5">
        <h2 class="text-center">Registrarse</h2>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form method="POST">
                    <div class="form-group mb-3">
                        <label for="username">Usuario</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div>
                        <label for="nickname">Nickname</label>
                        <input type="text" name="nickname" class="form-control" required>
                    </div>
                    <div class="form-group mb-3 mt-2">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="confirm_password">Confirmar Contraseña</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Registrarse</button>
                    <?php if (isset($error)) { ?>
                        <div class="alert alert-danger mt-2" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>