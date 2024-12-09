<?php
session_unset();
session_destroy();
header("Location: http://localhost:3000/controllers/inicioSesion.php");
exit();
?>
