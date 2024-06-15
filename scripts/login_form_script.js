document.addEventListener("DOMContentLoaded", (event) => {
    const EMAIL_REGULAR_EXPRESSION = /[a-zA-Z0-9._-]+@[a-zA-Z._-]+\.[a-zA-Z_-]/;

    const form = document.querySelector(".login-form");
    const email = document.querySelector(".login-form-email-input__field");
    const password = document.querySelector(".login-form-password-input__field");
    const emailInputError = document.querySelector(".login-form-email-input__error");
    const passwordInputError = document.querySelector(".login-form-password-input__error");
    const errorMessage = document.querySelector(".login-form-error-message_hidden");
    const errorMessageText = document.querySelector(".login-form-error-message__message");
    const passwordButton = document.querySelector(".login-form-password-input__show-button");
    let passwordButtonState = "show";

    function changePasswordButton(event)
    {
        if (passwordButtonState === "show")
        {
            password.setAttribute("type", "text");
            passwordButton.src = "static/images/icons/eye_off.png";
            passwordButtonState = "hide";
        }
        else if (passwordButtonState === "hide")
        {
            password.setAttribute("type", "password");
            passwordButton.src = "static/images/icons/eye.png";
            passwordButtonState = "show";
        }
    }

    function isEmailValid(value)
    {
        return EMAIL_REGULAR_EXPRESSION.test(value);
    }


    function isDataChecked()
    {
        return !(email.value === "" || password.value === "" || password.value.length < 6 ||
            (email.value !== "" && !isEmailValid(email.value)));
    }

    function showNotFoundMessage()
    {
        errorMessage.className = "login-form-error-message_shown";
        errorMessageText.innerText = "Email or password is incorrect.";
    }

    function showErrorMessage()
    {
        // вынести в классы
        let emailError = false;
        let passwordError;
        if (email.value === "")
        {
            emailInputError.innerText = "Email is required.";
            emailInputError.className = "error-help_shown"; // style.display = "block";
            email.classList.add("input-field_error");
            emailError = true;
        }
        else if (email.value !== "" && !isEmailValid(email.value))
        {
            emailInputError.innerText = "Incorrect email format. Correct format is ****@**.***";
            emailInputError.className = "error-help_shown";
            email.classList.add("input-field_error");
            emailError = true;
        }
        else
        {
            emailInputError.innerText = "";
            emailInputError.className = "error-help_hidden";
            email.classList.remove("input-field_error");
            emailError = false;
        }
        if (password.value === "" || password.value.length < 6)
        {
            passwordInputError.innerText = "Password is required.";
            passwordInputError.className = "error-help_shown";
            password.classList.add("input-field_error");
            passwordError = true;
        }
        else
        {
            passwordInputError.innerText = "";
            passwordInputError.className = "error-help_shown";
            password.classList.remove("input-field_error");
            passwordError = false;
        }
        if (emailError || passwordError)
        {
            showNotFoundMessage();
        }
    }

    function closeErrorMessage()
    {
        errorMessage.className = "login-form-error-message_hidden";
        emailInputError.className = "error-help_hidden";
        passwordInputError.className = "error-help_hidden";
        email.className = "input-field";
        password.className = "input-field";
    }


    function getData()
    {
        return {
            email: email.value,
            password: password.value,
        }
    }


    async function pushData(event) {
        event.preventDefault();
        if (isDataChecked())
        {
            closeErrorMessage();
            const url = "/api/login";
            let data = getData();
            console.log(data);

            let response = await fetch(url, {
                method: "POST",
                body: JSON.stringify(data),
                headers: {
                    "Content-Type": "application/json;charset=utf-8"
                }
            })

            if (response.ok)
            {
                window.location.href = "https://localhost/admin";
            }
            else
            {
                showNotFoundMessage();
            }
        }
        else
        {
            showErrorMessage();
        }
    }

    function initEventsListener()
    {
        passwordButton.addEventListener("click", changePasswordButton);
        form.addEventListener("submit", pushData);
    }


    initEventsListener();
})