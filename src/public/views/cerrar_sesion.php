<!-- Esto nos ayuda a cerrar la sesión de un usuario -->
<?php

session_start();
session_unset();
session_destroy();
header('Location: ../../index.php');



