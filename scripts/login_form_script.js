document.addEventListener("DOMContentLoaded", (event) => {
    const EMAIL_REGULAR_EXPRESSION = /[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0_-]/;

    let form = document.querySelector(".login-form");
    let email = document.querySelector(".login-form-email-input__field");
    let password = document.querySelector(".login-form-password-input__field");

    let emailInputError = document.querySelector(".login-form-email-input__error");
    let passwordInputError = document.querySelector(".login-form-password-input__error");

    let errorMessage = document.querySelector(".login-form-error-message");
    let errorMessageText = document.querySelector(".login-form-error-message__message");

    let passwordButton = document.querySelector(".login-form-password-input__show-button");
    let passwordButtonState = "show";

    let submitButton = document.querySelector(".login-form__submit-button");

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
        let emailError = false;
        let passwordError = false;
        if (email.value === "")
        {
            emailInputError.innerText = "Email is required.";
            emailInputError.style.display = "block";
            email.style.borderColor = "#E86961";
            emailError = true;
        }
        if (password.value === "")
        {
            passwordInputError.innerText = "Password is required.";
            passwordInputError.style.display = "block";
            password.style.borderColor = "#E86961";
            passwordError = true;
        }
        else if (password.value.length < 6)
        {
            passwordError = true;
        }
        else
        {
            passwordInputError.style.display = "none";
            password.style.borderColor = "#2E2E2E";
            passwordError = false;
        }
        if (email.value !== "" && !isEmailValid(email.value))
        {
            emailInputError.innerText = "Incorrect email format. Correct format is ****@**.***";
            emailInputError.style.display = "block";
            email.style.borderColor = "#E86961";
            emailError = true;
        }
        else if (email.value === "")
        {
            emailInputError.innerText = "Email is required.";
            emailInputError.style.display = "block";
            email.style.borderColor = "#E86961";
            emailError = true;
        }
        else
        {
            errorMessage.style.display = "none";
            emailInputError.style.display = "none";
            email.style.borderColor = "#2E2E2E";
        }
        if (emailError || passwordError)
        {
            errorMessage.style.display = "flex";
            errorMessageText.innerText = "Email or password is incorrect.";
            return false;
        }
        return true;
    }

    function showNotFoundMessage()
    {
        errorMessage.style.display = "flex";
        errorMessageText.innerText = "Email or password is incorrect.";
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
            const url = "/api/login";
            let data = getData();

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

    }

    function initEventsListener()
    {
        passwordButton.addEventListener("click", changePasswordButton);
        form.addEventListener("submit", pushData);
    }


    initEventsListener();
})