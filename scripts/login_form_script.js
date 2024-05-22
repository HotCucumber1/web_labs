document.addEventListener("DOMContentLoaded", (event) => {
    let passwordInputField = document.querySelector(".login-form-password-input__field")
    let passwordButton = document.querySelector(".login-form-password-input__show-button");
    let passwordButtonState = "show";

    function changePasswordButton(event)
    {
        if (passwordButtonState === "show")
        {
            passwordInputField.setAttribute("type", "text");
            passwordButton.src = "static/images/icons/eye_off.png";
            passwordButtonState = "hide";
        }
        else if (passwordButtonState === "hide")
        {
            passwordInputField.setAttribute("type", "password");
            passwordButton.src = "static/images/icons/eye.png";
            passwordButtonState = "show";
        }
    }

    function initEventsListener()
    {
        passwordButton.addEventListener("click", changePasswordButton)
    }


    initEventsListener();
})