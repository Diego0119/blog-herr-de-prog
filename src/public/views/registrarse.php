<?php
session_start();

if (isset($_POST['submit'])) {
    $usuarios_file = '../../../usuarios.txt';

    $username_id = uniqid();
    $_SESSION['user_id'] = $username_id;
    $username = $_POST['username'];
    $nickname = $_POST['nickname'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    // echo $username . " " . $password . " " . $confirm_password;
    // die();

    if ($password !== $confirm_password) {
        $error = "Las contraseñas no coinciden.";
        header('Location: registrarse.php');
    }

    if (file_exists($usuarios_file)) {
        $usuarios = file($usuarios_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($usuarios as $usuario) {
            list($id, $stored_username, $stored_nickname, $stored_password) = explode("|", $usuario);
            if ($nickname === $stored_nickname) {
                $error = "El usuario ya está registrado.";
            }
        }
    }

    if (!isset($error)) {
        file_put_contents($usuarios_file, "$username_id|$username|$nickname|$password\n", FILE_APPEND);
        $_SESSION['username'] = $username;
        header('Location: ../../index.php');
        exit();
    }

}
?>

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
                    <a class="nav-link" href="./iniciar_sesion.php">Iniciar sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

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
                    <div class="form-group mb-3">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="confirm_password">Confirmar Contraseña</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                    </div>
                    <?php if (isset($error)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php } ?>
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Registrarse</button>
                </form>
            </div>
        </div>
    </div>
</body>
<script>

 // puedo hacer confirmar la contraseña dinamicamente
</script>

</html>