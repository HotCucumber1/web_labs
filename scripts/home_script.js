document.addEventListener("DOMContentLoaded", (event) => {
    let viewPostButton = document.querySelector('.preview-heading__button');
    let posts = document.querySelector(".featured-content");

    let popupButton = document.querySelector(".section-header__hamburger-menu");
    let popUp = document.querySelector(".section-header__popup");
    let popUpShown = false;

    function scrollToPost()
    {
        posts.scrollIntoView({
            block: "start",
            behavior: "smooth",
        })
    }

    function openPopUp(event)
    {
        if (!popUpShown)
        {
            popUp.className = "section-header__popup popup_opened";
            popUpShown = true;
        }
        else
        {
            popUp.className = "section-header__popup popup_closed";
            popUpShown = false;
        }
    }

    function initEventsListener()
    {
        viewPostButton.addEventListener("click", scrollToPost);
        popupButton.addEventListener("click", openPopUp);
    }


    initEventsListener();
})