<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset='utf-8'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Компьютер Про | Регистрация</title>
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
      <div class="flex justify-between items-center">
        <h2 class="text-xl mb-2 font-semibold max-sm:text-lg max-sm:mb-2">Регистрация</h2>
        <a href="auth_page.php" class="text-sm text-blue-500 font-semibold hover:text-blue-700">Авторизация</a>
      </div>
      <form action="create_user.php" method="POST" enctype="multipart/form-data" id="registration-form">
        <div class="mb-4 mt-4 max-sm:mb-2">
          <label for="name_user" class="text-sm block text-gray-600 leading-8">Имя</label>
          <input type="text" id="name_user" name="name_user"
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-400" required>
          <p id="name_error" class="text-red-500 break-words text-sm mt-2 hidden">Имя должно содержать только латинские
            буквы и цифры</p>
          <p id="name_uniq_error" class="text-red-500 break-words text-sm mt-2 hidden">Имя пользователя уже используется
          </p>
        </div>
        <div class="mb-4 max-sm:mb-2">
          <label for="email" class="text-sm block text-gray-600 leading-8">Email</label>
          <input type="email" id="email" name="email"
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-400" required>
          <p id="email_error" class="text-red-500 break-words text-sm mt-2 hidden">Неверный формат email</p>
          <p id="email_uniq_error" class="text-red-500 break-words text-sm mt-2 hidden">Данный email уже используется
          </p>
        </div>
        <div class="mb-4 max-sm:mb-2">
          <label for="password" class="text-sm block text-gray-600 leading-8">Пароль</label>
          <input type="password" id="password" name="password"
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-400" required>
          <p id="password-error" class="text-red-500 break-words text-sm mt-2 hidden">Пароль должен содержать минимум 6
            символов, включая хотя бы одну заглавную и одну строчную латинскую букву</p>
        </div>
        <div class="mb-6 max-sm:mb-4">
          <label for="password_confirmation" class="text-sm block text-gray-600 leading-8">Подтверждение пароля</label>
          <input type="password" id="password_confirmation" name="password_confirmation"
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-400" required>
          <p id="password-conf-error" class="text-red-500 break-words text-sm mt-2 hidden">Пароли не совпадают</p>
        </div>
        <div class="mb-4 flex justify-between">
          <button type="submit" id="register-button"
            class="bg-blue-500 text-white py-2 px-4 rounded-lg max-sm:text-sm hover:bg-blue-600">Зарегистрироваться</button>
          <button type="button" class="bg-gray-300 max-sm:text-sm text-gray-600 py-2 px-4 rounded-lg ml-2"
            onclick="clearForm()">Очистить</button>
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
  <div class="cookie-div fixed bottom-6 inset-x-1/4 bg-gray-900 py-4 px-6 text-white flex opacity-90 items-center justify-between rounded-xl max-sm:inset-x-4 hidden">
    <p class="text-sm text-center mr-10">Этот сайт использует файлы cookie для улучшения вашего пользовательского опыта.</p>
    <button id="accept-cookie" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-800">Принять</button>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <script src="animation.js"></script>
  <script src="cookie_accept.js"></script>
  <script src="validation.js"></script>
  <script src="test_username_email.js"></script>
</body>

</html>