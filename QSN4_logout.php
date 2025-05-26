<?php
session_start();
session_unset();
session_destroy();
setcookie('name', '', time() - 1);
setcookie('email', '', time() - 1);

header('location:QSN4_login.php');

?>