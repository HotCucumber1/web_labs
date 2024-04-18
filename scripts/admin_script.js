let publish_button = document.getElementById('publish-button');

function getData()
{
    const title = document.getElementById('title');
    const description = document.getElementById('description');
    const author = document.getElementById('author');
    const authorImg = document.getElementById('author-img');
    const date = document.getElementById('date');
    const heroImg = document.getElementById('hero-img');
    const heroImgPreview = document.getElementById('hero-img-preview');

    // чекать на null
    const data = {
        'title': title.value,
        'description': description.value,
        'author': author.value,
        'author_img': authorImg.value,
        'date': date.value,
        'hero_img': heroImg.value,
        'hero_img_preview': heroImgPreview.value,
    }

    const replacer = null;
    const space = 4;
    return JSON.stringify(data, replacer, space);
}

function pushData(event)
{
    let data = getData();
    console.log(data);
    // event.preventDefault();  // чтобы не перезагружалась страница
}

function initEventsListeners()
{
    publish_button.addEventListener('click', pushData)
}


initEventsListeners();
