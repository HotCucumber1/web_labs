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
            popUp.style.display = "block";
            popUpShown = true;
        }
        else
        {
            popUp.style.display = "none";
            popUpShown = false;
        }
    }

    function closePopUp(event)
    {
        if (!popUp.contains(event.target) && !popupButton.contains(event.target))
        {
            popUp.style.display = 'none';
            popUpShown = false;
        }
    }

    function initEventsListener()
    {
        viewPostButton.addEventListener("click", scrollToPost);
        popupButton.addEventListener("click", openPopUp);
        document.addEventListener("click", closePopUp);
    }


    initEventsListener();
})