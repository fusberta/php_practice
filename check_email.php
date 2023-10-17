<?php
$email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);

require_once 'app_configuration.php';

$query = "SELECT * FROM users WHERE email = ?";
$stmt = mysqli_prepare($connect, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $email);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $result = false;
    } else {
        $result = true;
    }

    mysqli_stmt_close($stmt);
} else {
    $result = false;
}

echo $result;
?>
