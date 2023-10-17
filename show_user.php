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

            table {
                display: flex;
                flex-direction: column;
                border: 0;
            }

            thead {
                display: none;
            }

            tbody {
                display: flex;
                flex-direction: column;
            }

            td {
                display: block;
                text-align: right;
            }

            table td:before {
                content: attr(data-label);
                float: left;
                margin-right: 10px;
                font-weight: bold;
            }
        }
    </style>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="file_upload.css">
</head>

<body class="bg-gray-100">
    <?php
    require 'check_cookie.php';
    $num = check_cookie();
    if (!$num) {
        header("Location: index.php");
    }
    session_start();
    if (!isset($_SESSION['id'])) {
        header('Location: auth_page.php');
        exit;
    }
    require 'app_configuration.php';
    $select_query = "SELECT * FROM users WHERE id_user=" . $num;
    $result = mysqli_query($connect, $select_query);
    if ($result) {
        $row = mysqli_fetch_array($result);
        $username = $row['name_user'];
        $email = $row['email'];
        $user_pic = $row['user_pic'];
        $adress = $row['adress'];
        $phone = $row['phone'];
        $check = $row['check_email'];
    }
    ?>
    <div class="min-h-screen flex justify-center items-center px-4">
        <main class="bg-white p-8 rounded-lg shadow-md">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-medium mb-2">Профиль</h2>
                <a href="profile_info.php" class="flex items-center justify-center">
                    <img src="img/edit.png" alt="Редактировать профиль" class="w-6">
                </a>
            </div>
            <div class="flex flex-col justify-center">
                <div class="flex justify-between items-center my-6">
                    <form action="update_image.php?user_id=<?php echo $num; ?>" id="upload-form" method="POST"
                        enctype="multipart/form-data">
                        <label for="fileInput" class="custom-file-upload">
                            <img src="<?php if ($user_pic != null) {
                                echo $user_pic;
                            } else {
                                echo 'user.png';
                            } ?>" alt="Upload Image" class="w-16 preview">
                            <input type="file" id="fileInput" name="photo" accept="image/*">
                        </label>
                    </form>
                    <form method="post" action="logout.php">
                        <button type="submit"
                            class="bg-red-600 hover:bg-red-700 px-4 py-2 text-white rounded-lg flex items-center justify-center">
                            Выйти
                        </button>
                    </form>
                </div>
                <table class="w-full text-sm text-center mt-4 mx-auto border-collapse">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">Имя</th>
                            <th class="border px-4 py-2">Email</th>
                            <th class="border px-4 py-2">Телефон</th>
                            <th class="border px-4 py-2">Адрес</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="break-words max-w-xs max-sm:max-w-none">
                            <td data-label="Имя" class="border px-4 py-2">
                                <?php echo $username; ?>
                            </td>
                            <td data-label="Email" class="border px-4 py-2">
                                <?php echo $email; ?>
                            </td>
                            <td data-label="Телефон" class="border px-4 py-2">
                                <?php
                                if ($phone == null) {
                                    echo "Нет данных";
                                } else {
                                    echo $phone;
                                }
                                ?>
                            </td>
                            <td data-label="Адрес" class="border px-4 py-2">
                                <?php
                                if ($adress == null) {
                                    echo "Нет данных";
                                } else {
                                    echo $adress;
                                }
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php
                if ($check != 1) {
                    echo "<p class='text-sm text-red-700 text-center mt-6'>Адрес электронной почты не подтвержден, зайдите на почту. Аккаунт будет удален 
                в течении 30 дней, в случае отсутствия подтверждения!</p>";
                } ?>
            </div>
        </main>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="animation.js"></script>
    <script src="profile-image.js"></script>
</body>

</html>