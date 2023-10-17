<?php
$username = filter_var(
    $_POST['name_user'],
    FILTER_VALIDATE_REGEXP,
    array('options' => array('regexp' => '/^[a-zA-Z0-9]+$/'))
);

require_once 'app_configuration.php';

$query = "SELECT * FROM users WHERE name_user = ?";
$stmt = mysqli_prepare($connect, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $username);

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