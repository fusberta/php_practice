<?php

require 'app_configuration.php';
require 'error-func.php';

$username = filter_input(
    INPUT_POST,
    'name_user',
    FILTER_VALIDATE_REGEXP,
    array('options' => array('regexp' => '/^[a-zA-Z0-9]+$/'))
);

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

$password = $_POST['password'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$token = bin2hex(random_bytes(15));

session_start();

$users_query = "SELECT * FROM users WHERE name_user = ?";

$stmt = mysqli_prepare($connect, $users_query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        handle_error(
            'Имя пользователя уже используется, попробуйте обновить страницу и пройти регистрацию заново',
            mysqli_error($connect)
        );
    }

    mysqli_stmt_close($stmt);
} else {
    handle_error(
        'Ошибка при проверке уникальности данных',
        mysqli_error($connect)
    );
}

$email_query = "SELECT * FROM users WHERE email = ?";

$stmt = mysqli_prepare($connect, $email_query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        handle_error(
            'Email уже используется, попробуйте обновить страницу и пройти регистрацию заново',
            mysqli_error($connect)
        );
    }

    mysqli_stmt_close($stmt);
} else {
    handle_error(
        'Ошибка при проверке уникальности данных',
        mysqli_error($connect)
    );
}

$stmt = mysqli_prepare($connect, 'INSERT INTO users(name_user, email, password, token) VALUES((?), (?), (?), (?))') or handle_error(
    'Ошибка при регистрации нового пользователя',
    mysqli_error($connect)
);
mysqli_stmt_bind_param(
    $stmt,
    'ssss',
    $username,
    $email,
    $hashed_password,
    $token
);

$answ = mysqli_stmt_execute($stmt) or handle_error(
    'Ошибка при регистрации нового пользователя',
    mysqli_error($connect)
);
$num = strval(mysqli_insert_id($connect));

$_SESSION['id'] = $num;

$sql = "SELECT date_of_creation FROM users WHERE id_user = $num";

$res = mysqli_query($connect, $sql);

if ($res) {
    $row = mysqli_fetch_assoc($res);
    if ($row) {
        $registrationDate = $row['date_of_creation'];
    } else {
        $registrationDate = 'alert';
    }
    mysqli_free_result($res);
}


$subject = 'ProPC | Подтверждение регистрации';
$message = '<html>
<title>Подтверждение адреса электронной почты</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600&display=swap");

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Rubik", sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #f0f0f0;
            max-width: 600px;
            margin: 20px auto;
            padding: 25px 30px;
            border-radius: 25px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
        }

        p {
            font-size: 16px;
            color: #666;
            margin: 10px 0;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        h4 {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Подтверждение адреса электронной почты</h1>
        <p>Здравствуйте,</p>
        <p>Для завершения процесса регистрации на сайте <strong>"Компьютер Про"</strong> и подтверждения вашего адреса
            электронной почты,
            пожалуйста, нажмите на кнопку ниже.</p>
        <p>Если вы не регистрировались на сайте <strong>"Компьютер Про"</strong>, проигнорируйте это сообщение.</p>
        <h4>Спасибо за выбор нашего сервиса!</h4>
        <a href="https://pr-diveev.xn--80ahdri7a.site/confirm_email.php?email=' . $email . '&message=' . $registrationDate . '" class="btn">Подтвердить Email</a>
    </div>
</body>

</html>';
$headers = "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From: ProPC Administration <mihail.diweew@yandex.ru>\r\n";
$mail = mail($email, $subject, $message, $headers);


setcookie('id_user', $num);
setcookie("token", $token);

header("Location: profile_info.php");

mysqli_close($connect);

?>