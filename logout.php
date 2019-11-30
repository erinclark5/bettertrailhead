<?php
session_start();
// unset($_SESSION["id"]);
// unset($_SESSION["exp"]);
// unset($_SESSION["first"]);
// unset($_SESSION["last"]);
// unset($_SESSION["alias"]);
session_unset();
header("Location:login.php");
?>
