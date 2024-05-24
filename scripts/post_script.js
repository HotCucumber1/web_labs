document.addEventListener("DOMContentLoaded", (event) => {
    let popupButton = document.querySelector(".section-header__hamburger-menu");
    let popUp = document.querySelector(".section-header__popup");
    let isPopUpShown = false;

    function openPopUp(event)
    {
        console.log(1);
        if (!isPopUpShown)
        {
            popUp.style.display = "block";
            isPopUpShown = true;
        }
        else
        {
            popUp.style.display = "none";
            isPopUpShown = false;
        }
    }

    function closePopUp(event)
    {
        if (!popUp.contains(event.target) && !popupButton.contains(event.target))
        {
            popUp.style.display = 'none';
            isPopUpShown = false;
        }
    }

    function initEventsListener()
    {
        popupButton.addEventListener("click", openPopUp);
        document.addEventListener("click", closePopUp);
    }


    initEventsListener();
})