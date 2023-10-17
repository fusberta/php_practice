<?php

require 'app_configuration.php';
require 'error-func.php';
require 'file_errors.php';

$image_fieldname = "photo";

($_FILES[$image_fieldname]['error'] == 0) or
    handle_error(
        "Сервер не может получить выбранное Вами изображение",
        $php_errors[$_FILES[$image_fieldname]['error']]
    );
@is_uploaded_file($_FILES[$image_fieldname]['tmp_name']) or
    handle_error("Укажите путь к файлу", "Неопределен путь" . $_FILES[$image_fieldname]
    ['tmp_name']);
$b = @getimagesize($_FILES[$image_fieldname]['tmp_name']) or
    handle_error("Вы выбрали файл, не являющийся изображением", $_FILES[$image_fieldname]
    ['tmp_name'] . "is not image");

require 'check_cookie.php';
$num = check_cookie();
if (!$num) {
    header("Location: index.php");
}

$upload_filename = 'profile/avatar_' . $num . '_' . $_FILES[$image_fieldname]['name'];

@move_uploaded_file($_FILES[$image_fieldname]['tmp_name'], $upload_filename) or
    handle_error("Ошибка перемещения файла", "Ошибка доступа: " . $upload_filename);

$query = "UPDATE users SET user_pic='{$upload_filename}' WHERE id_user={$num}";

mysqli_query($connect, $query) or handle_error('Не удалось обновить данные пользователя', mysqli_error($connect));

$currentURI = $_SERVER['REQUEST_URI'];

if ($currentURI != '/update_user.php?user_id=28') {
    header("Location: show_user.php?user_id={$num}");
}

?>