<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Подтверждение адреса электронной почты</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Rubik', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #fff;
            max-width: 600px;
            margin: 20px auto;
            padding: 25px 30px;
            border-radius: 25px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }


        p {
            margin: 20px 0;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        $mail = $_GET['email'];
        $message = $_GET['message'];
        require 'app_configuration.php';

        $stmt = mysqli_prepare($connect, 'SELECT id_user FROM users WHERE email = (?) AND date_of_creation = (?)');
        mysqli_stmt_bind_param($stmt, 'ss', $mail, $message);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        if ($id) {
            $stmt = mysqli_prepare($connect, 'UPDATE users SET check_email = 1 WHERE id_user = ?');
            mysqli_stmt_bind_param($stmt, 'd', $id);
            $var = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            if ($var) {
                exit("
                <div>
                    <h3>Поздравляем с успешной регистрацией!</h3>
                    <p>Электронный адрес успешно подтвержден!</p>
                    <a href='show_user.php'>Перейти на свою страницу</a>
                </div>
                <div>
                    <img src='img/correct.png'>
                </div>
                ");
            } else {
                exit("
                <div>
                    <p>Ошибка при обновлении статуса подтверждения адреса электронной почты.</p>
                    <a href='show_user.php'>Перейти на свою страницу</a>
                </div>
                <div>
                    <img src='img/cancel.png'>
                </div>
                ");

            }
        } else {
            exit("
            <div>
                <p>Ошибка при подтверждении почты.</p>
                <a href='show_user.php'>Перейти на свою страницу</a>
            </div>
            <div>
                <img src='img/cancel.png'>
            </div>
            ");
        }

        mysqli_close($connect);
        ?>

    </div>
</body>

</html>