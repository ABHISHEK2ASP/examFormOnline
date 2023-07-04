<?php
session_start();
unset($_SESSION["id"]);
unset($_SESSION["authemail"]);
session_destroy();
header("Location: ../index.php");
?>