<!-- Este navbar nos ayuda a reutiliza codigo importandolo donde lo necesitemos -->
<nav class="navbar navbar-expand-lg bg-custom color">
    <div class="container-fluid">
        <a class="navbar-brand" href="./index.php" style="color: #ffffff;">Games Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="navbar-item">
                    <a class="nav-link" aria-current="page" href="./index.php" style="color: #ffffff;">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./public/views/subir.php" style="color: #ffffff;">Upload Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./public/views/iniciar_sesion.php" style="color: #ffffff;">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./public/views/cerrar_sesion.php" style="color: #ffffff;">Log out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>