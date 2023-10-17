<?php

setcookie('id_user', '', time() - 2 * 3600 * 24 * 182);
setcookie('token', '', time() - 2 * 3600 * 24 * 182);

session_start();
session_destroy();

header('Location: index.php');
exit;
?>