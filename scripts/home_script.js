document.addEventListener("DOMContentLoaded", (event) => {
    let viewPostButton = document.querySelector('.preview-heading__button');
    let posts = document.querySelector(".featured-content");

    function scrollToPost()
    {
        posts.scrollIntoView({
            block: "start",
            behavior: "smooth",
        })
    }

    function initEventsListener()
    {
        viewPostButton.addEventListener("click", scrollToPost);
    }


    initEventsListener();
})