<?php
session_unset();
session_destroy();
header("Location: http://localhost:3000/vistas/inicioSesion.php");
exit();
?>
