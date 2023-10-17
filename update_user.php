<?php

require 'update_image.php';

$tel_value = $_POST["tel"];
$address_value = $_POST["address"];

$query = "UPDATE users SET phone='{$tel_value}', adress='{$address_value}' WHERE id_user={$num}";

mysqli_query($connect, $query) or handle_error('Не удалось обновить данные пользователя', mysqli_error($connect));

mysqli_close($connect);
header("Location: show_user.php");

?>