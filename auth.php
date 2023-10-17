<?php
$nameEmailField = $_POST["name_email_user"];
$password = $_POST["password"];

if (filter_var($nameEmailField, FILTER_VALIDATE_EMAIL)) {
    $query = "SELECT * FROM users WHERE email=?";
} else {
    $query = "SELECT * FROM users WHERE name_user=?";
}

require 'app_configuration.php';
require 'error-func.php';
$stmt = mysqli_prepare($connect, $query);
mysqli_stmt_bind_param($stmt, 's', $nameEmailField);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    if (password_verify($password, $row["password"])) {
        $token = bin2hex(random_bytes(15));
        $token_query = "UPDATE users SET token='{$token}' WHERE
            id_user='{$row["id_user"]}'";
        $res = mysqli_query($connect, $token_query) or handle_error('Ошибка выдачи токена', mysqli_error($connect));
        if (isset($_POST['remember_me']) && $_POST['remember_me'] == 'on') {
            setcookie('id_user', $row["id_user"], time() + 60 * 24 * 3600);
            setcookie('token', $token, time() + 60 * 24 * 3600);
        } else {
            setcookie('id_user', $row["id_user"], time() + 3600);
            setcookie('token', $token, time() + 3600);
        }
        session_start();
        $_SESSION['id'] = $row["id_user"];
        header("Location: show_user.php");
        exit;
    } else {
        $loginError = "Неверный пароль.";
        header("Location: auth_page.php?error=" . urlencode($loginError));
        exit;
    }
} else {
    $loginError = "Пользователь с таким email/username не существует.";
    header("Location: auth_page.php?error=" . urlencode($loginError));
    exit;
}

mysqli_stmt_close($stmt);
mysqli_close($connect);
?>