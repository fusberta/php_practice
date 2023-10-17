<html lang="ru">

<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Обновление профиля</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        main {
            width: 400px;
        }

        @media (max-width: 640px) {
            main {
                width: max-content;
            }
        }
    </style>
    <link rel="stylesheet" href="file_upload.css">
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-gray-100">
    <?php
    require 'check_cookie.php';
    $num = check_cookie();
    if (!$num) {
        header("Location: index.php");
    }
    $select_query = "SELECT * FROM users WHERE id_user=" . $num;
    require 'app_configuration.php';
    $result = mysqli_query($connect, $select_query);
    if ($result) {
        $row = mysqli_fetch_array($result);
        $username = $row['name_user'];
        $email = $row['email'];
        $user_pic = $row['user_pic'];
        $adress = $row['adress'];
        $phone = $row['phone'];
    }
    ?>
    <div class="min-h-screen flex justify-center items-center px-4">
        <main class="bg-white p-8 rounded-lg shadow-md">
            <div class="flex flex-col justify-center">
                <form action="update_user.php" method="post" enctype="multipart/form-data"
                    class="space-y-4">
                    <div class="mb-4 max-sm:mb-2">
                        <div class="flex flex-col items-center">
                            <h2 class="text-2xl font-semibold text-center mb-6">Настройка профиля</h2>
                            <label for="fileInput" class="custom-file-upload mb-2">
                                <img src="<?php if ($user_pic != null) {
                                    echo $user_pic;
                                } else {
                                    echo 'user.png';
                                } ?>" alt="Upload Image" class="preview">
                                <input type="file" id="fileInput" name="photo" accept="image/*">
                            </label>
                        </div>
                        <label for="tel" class="text-sm block text-gray-600 leading-8">Телефон</label>
                        <input type="tel" id="tel-inp" name="tel"
                            pattern="^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-400"
                            required>
                        <p id="tel_error" class="text-red-500 break-words text-sm break-words mt-2 hidden">
                            Введите номер телефона в формате +7 XXX XXX XX XX
                        </p>
                        <label for="address" class="text-sm block text-gray-600 leading-8">Адрес</label>
                        <textarea id="address-textarea" rows="3" maxlength="255" name="address"
                            class="w-full px-3 py-2 text-gray-700 bg-white border mb-2 rounded-lg focus:outline-none focus:border-blue-400"></textarea>
                    </div>
                    <div class="flex justify-between">
                        <a id="skip_btn" href="show_user.php"
                            class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg cursor-pointer">
                            Пропустить
                        </a>
                        <input type="submit" value="Загрузить" id="load_btn"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-lg cursor-pointer">
                    </div>
                </form>
            </div>
        </main>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="animation.js"></script>
    <script src="profile-image.js"></script>
    <script src="validation.js"></script>
</body>

</html>