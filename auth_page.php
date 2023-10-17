<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Компьютер Про | Авторизация</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <header class="header">
        <a href="#" class="logo-link"><img src="./img/computer.png" alt="logo"></a>
        <div class="header-right">
            <h2 class="header-label">Компьютер Про</h2>
            <p class="header-desc">Выбери компьютер прямо сейчас и мы привезем его завтра.</p>
        </div>
        <a href="#" class="profile-link"><img src="./img/profile-user.png" class="profile-img" alt="logo"></a>
    </header>
    <main class="flex justify-center items-center pb-10">
        <div class="bg-white p-8 rounded-lg shadow-xl w-96 max-sm:p-4 max-sm:w-80">
            <h2 class="text-xl font-semibold mb-4 max-sm:text-lg max-sm:mb-2">Авторизация</h2>
            <form action="auth.php" method="POST" enctype="multipart/form-data" id="auth-form">
                <div class="mb-4 max-sm:mb-2">
                    <label for="name_email_user" class="text-sm block text-gray-600 leading-8">Имя пользователя или
                        почта</label>
                    <input type="text" id="name_email_user" name="name_email_user"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-400" required>
                </div>
                <div class="mb-4 max-sm:mb-2">
                    <label for="password" class="text-sm block text-gray-600 leading-8">Пароль</label>
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-400" required>
                </div>
                <?php
                if (isset($_GET['error'])) {
                    $loginError = $_GET["error"];
                    echo "<p class='text-white border-red-600 border break-words text-sm mt-4 text-center px-4 py-2 bg-red-400 rounded-lg'>$loginError</p>";
                }
                ?>
                <label class="inline-flex items-center mt-2">
                    <input type="checkbox" name="remember_me" id="remember_me" class="text-indigo-600 h-4 w-4">
                    <span class="ml-2 text-sm text-gray-700">Запомнить меня</span>
                </label>
                <div class="mt-6 flex justify-between items-center">
                    <a href="index.php" class="text-sm text-blue-500 font-semibold hover:text-blue-700">Перейти к
                        регистрации</a>
                    <button type="submit" id="register-button"
                        class="bg-blue-500 text-white py-2 px-6 rounded-lg max-sm:text-sm hover:bg-blue-600">Войти</button>
                </div>
            </form>
        </div>
    </main>
    <footer class="footer">
        <h2 class="footer-label">Компьютер Про</h2>
        <img src="img/computer.png" alt="logo">
        <div class="footer-menu">
            <h4 class="menu-label">
                Компьютерная компания
            </h4>
            <div class="menu-items">
                <a href="#">О нас</a>
                <a href="#">Отзывы</a>
                <a href="#">Гарантии</a>
                <a href="#">Контакты</a>
            </div>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="animation.js"></script>
</body>

</html>