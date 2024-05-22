document.addEventListener("DOMContentLoaded", (event) => {
    let popupButton = document.querySelector(".section-header__hamburger-menu");
    let popUp = document.querySelector(".section-header__popup");
    let isPopUpShown = false;

    function openPopUp(event)
    {
        if (!isPopUpShown)
        {
            popUp.className = "section-header__popup popup_opened";
            isPopUpShown = true;
        }
        else
        {
            popUp.className = "section-header__popup popup_closed";
            isPopUpShown = false;
        }
    }

    function initEventsListener()
    {
        popupButton.addEventListener("click", openPopUp);
    }


    initEventsListener();
})