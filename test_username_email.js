const ununiqUsername = document.getElementById('name_uniq_error');
const ununiqEmail = document.getElementById('email_uniq_error');
const usernameValue = document.getElementById('name_user').value;
const emailValue = document.getElementById('email').value;
const usernameInput = document.getElementById('name_user');
const useremailInput = document.getElementById('email');
let usernameTimer;
let emailTimer;

async function checkUsername(username) {
    clearTimeout(usernameTimer);
    usernameTimer = setTimeout(async () => {
        const form = new FormData();
        form.append('name_user', username);
        try {
            let response = await fetch('check_username.php', {
                method: 'POST',
                body: form
            });
            let result = await response.text();
            console.log('Проверка имени пользователя:', result);
            if (!result) {
                ununiqUsername.classList.remove('hidden');
                nameInput.classList.add("border-red-500");
                registerButton.disabled = true;
                setDisabledBtn(registerButton);
            } else {
                ununiqUsername.classList.add('hidden');
                nameInput.classList.remove("border-red-500");
                registerButton.disabled = false;
            }
        } catch (err) {
            console.log('Ошибка при проверке имени пользователя:', err);
        }
    }, 500);
}

async function checkEmail(email) {
    clearTimeout(emailTimer);
    emailTimer = setTimeout(async () => {
        const form = new FormData();
        form.append('email', email);
        try {
            let response = await fetch('check_email.php', {
                method: 'POST',
                body: form
            });
            let result = await response.text();
            console.log('Проверка email:', result);
            if (!result) {
                ununiqEmail.classList.remove('hidden');
                emailInput.classList.add("border-red-500");
                registerButton.disabled = true;
                setDisabledBtn(registerButton);
            } else {
                ununiqEmail.classList.add('hidden');
                emailInput.classList.remove("border-red-500");
                registerButton.disabled = false;
            }
        } catch (err) {
            console.log('Ошибка при проверке email:', err);
        }
    }, 500);
}

usernameInput.addEventListener("input", () => {
    const usernameValue = usernameInput.value;
    checkUsername(usernameValue);
});

useremailInput.addEventListener("input", () => {
    const emailValue = useremailInput.value;
    checkEmail(emailValue);
});