<html lang="ru">

<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Данные пользователя</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        main {
            width: min-content;
        }

        @media (max-width: 640px) {
            main {
                width: max-content;
            }
        }
    </style>
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex justify-center items-center px-4">
        <main
            class="bg-red-700 text-white p-8 rounded-xl shadow-md flex min-w-max text-center flex-col items-center justify-center">
            <?php
            if (isset($_GET['error_message'])) {
                $error_message = preg_replace("/\\\\/", '', $_GET['error_message']);
            } else {
                $error_message = "Вы здесь оказались из-за сбоя в программе.";
            }
            if (isset($_GET['system_error_message'])) {
                $system_error_message = preg_replace("/\\\\/", '', $_GET['system_error_message']);
            } else {
                $system_error_message = "Сообщения о системных ошибках отсутствуют";
            }
            echo ("<strong class='mb-4 text-lg border-b-2 border-white pb-4'>" . $error_message . "</strong>");
            echo ("<p>Было получено сообщение системного характера:</p>
       <b>{$system_error_message}</b>");
            ?>
        </main>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="animation.js"></script>
</body>

</html>