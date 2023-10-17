function clearForm() {
    document.getElementById("registration-form").reset();
}

const passwordInput = document.getElementById("password");
const confirmPasswordInput = document.getElementById("password_confirmation");
const passwordConfError = document.getElementById("password-conf-error");
const passwordError = document.getElementById("password-error");
const registerButton = document.getElementById("register-button");
const nameInput = document.getElementById("name_user");
const emailInput = document.getElementById("email");
const nameError = document.getElementById("name_error");
const emailError = document.getElementById("email_error");
const telInput = document.getElementById("tel-inp");
const telError = document.getElementById("tel_error");
const loadBtn = document.getElementById("load_btn");

function getCondition() {
    if (nameInput && emailInput && passwordInput && confirmPasswordInput) {
        return !nameInput.classList.contains("border-red-500") &&
            !emailInput.classList.contains("border-red-500") &&
            !passwordInput.classList.contains("border-red-500") &&
            !confirmPasswordInput.classList.contains("border-red-500")
    } else if (telInput) {
        return !telInput.classList.contains("border-red-500")
    } else {
        return true;
    }
}


function validateField(inputElement, errorElement, pattern, submitBtn) {
    inputElement.addEventListener("input", () => {
        const inputValue = inputElement.value;
        const isValid = pattern.test(inputValue);

        if (!isValid) {
            errorElement.classList.remove("hidden");
            inputElement.classList.remove("focus:border-blue-400");
            inputElement.classList.add("border-red-500");
        } else {
            errorElement.classList.add("hidden");
            inputElement.classList.add("focus:border-blue-400");
            inputElement.classList.remove("border-red-500");
        }

        if (
            getCondition()
        ) {
            submitBtn.disabled = false;
        } else {
            submitBtn.disabled = true;
        }

        setDisabledBtn(submitBtn);
    });
}

function setDisabledBtn(btn) {
    if (btn.disabled) {
        btn.classList.add("bg-blue-300");
        btn.classList.remove("hover:bg-blue-600");
    } else {
        btn.classList.remove("bg-blue-300");
        btn.classList.add("hover:bg-blue-600");
    }
}
if (nameInput)
    validateField(nameInput, nameError, /^[a-zA-Z0-9]+$/, registerButton);
if (emailInput)
    validateField(emailInput, emailError, /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/, registerButton);
if (passwordInput)
    validateField(passwordInput, passwordError, /^(?=.*[a-z])(?=.*[A-Z]).{6,}$/, registerButton);
if (telInput)
    validateField(telInput, telError, /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/, loadBtn);

if (passwordInput)
    passwordInput.addEventListener("input", () => {
        const passwordValue = passwordInput.value;
        const isValidPassword = /^(?=.*[a-z])(?=.*[A-Z]).{6,}$/.test(passwordValue);

        if (!isValidPassword) {
            passwordError.classList.remove("hidden");
            passwordInput.classList.remove("focus:border-blue-400");
            passwordInput.classList.add("border-red-500");
        } else {
            passwordError.classList.add("hidden");
            passwordInput.classList.add("focus:border-blue-400");
            passwordInput.classList.remove("border-red-500");
        }
    })

function checkConfirm() {
    const passwordValue = passwordInput.value;

    const confirmPasswordValue = confirmPasswordInput.value;
    if (confirmPasswordValue !== passwordValue) {
        passwordConfError.classList.remove("hidden");
        confirmPasswordInput.classList.remove("focus:border-blue-400");
        passwordInput.classList.remove("focus:border-blue-400");
        confirmPasswordInput.classList.add("border-red-500");
        passwordInput.classList.add("border-red-500");
    } else {
        passwordConfError.classList.add("hidden");
        confirmPasswordInput.classList.add("focus:border-blue-400");
        passwordInput.classList.add("focus:border-blue-400");
        confirmPasswordInput.classList.remove("border-red-500");
        passwordInput.classList.remove("border-red-500");
    }

    if (
        !nameInput.classList.contains("border-red-500") &&
        !emailInput.classList.contains("border-red-500") &&
        !passwordInput.classList.contains("border-red-500") &&
        !confirmPasswordInput.classList.contains("border-red-500")
    ) {
        registerButton.disabled = false;
    } else {
        registerButton.disabled = true;
    }

    setDisabledBtn(registerButton);
}

function validatePassword() {
    if (passwordInput.value !== confirmPasswordInput.value) {
        passwordConfError.classList.remove("hidden");
        confirmPasswordInput.classList.remove("focus:border-blue-400");
        passwordInput.classList.remove("focus:border-blue-400");
        confirmPasswordInput.classList.add("border-red-500");
        passwordInput.classList.add("border-red-500");
    } else {
        passwordConfError.classList.add("hidden");
        confirmPasswordInput.classList.add("focus:border-blue-400");
        passwordInput.classList.add("focus:border-blue-400");
        confirmPasswordInput.classList.remove("border-red-500");
        passwordInput.classList.remove("border-red-500");
    }

    if (
        !nameInput.classList.contains("border-red-500") &&
        !emailInput.classList.contains("border-red-500") &&
        !passwordInput.classList.contains("border-red-500") &&
        !confirmPasswordInput.classList.contains("border-red-500")
    ) {
        registerButton.disabled = false;
    } else {
        registerButton.disabled = true;
    }

    setDisabledBtn(registerButton);
}
if (confirmPasswordInput)
    confirmPasswordInput.addEventListener("input", checkConfirm);
if (passwordInput)
    passwordInput.addEventListener("input", checkConfirm);