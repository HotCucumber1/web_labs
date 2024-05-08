const SPACE_NUM = 4;

let publishButton = document.getElementById('publish-button');

let title = document.getElementById('title');
let description = document.getElementById('description');
let author = document.getElementById('author');
let authorImg = document.getElementById('author-img');
let date = document.getElementById('date');
let heroImg = document.getElementById('hero-img');
let heroImgPreview = document.getElementById('hero-img-preview');
let content = document.getElementById('post-content');

let inputFields = [
    title,
    description,
    author,
    date,
]


async function convertToBase64(image)
{
    return await new Promise((resolve, reject) =>
    {
        const reader= new FileReader();
        reader.onload = () =>
        {
            resolve(reader.result);
        }
        reader.readAsDataURL(image);
    });
}


async function getBase64Image(image)
{
    if (image.files[0])
        return await convertToBase64(image.files[0]);
}


async function getData()
{
    const title = document.getElementById('title');
    const description = document.getElementById('description');
    const author = document.getElementById('author');
    const authorImg = document.getElementById('author-img');
    const date = document.getElementById('date');
    const heroImg = document.getElementById('hero-img');
    const heroImgPreview = document.getElementById('hero-img-preview');
    const content = document.getElementById('post-content');


    return {
        title: title.value.trim(),
        description: description.value.trim(),
        author: author.value.trim(),
        author_img: await getBase64Image(authorImg),
        date: date.value.trim(),
        hero_img: await getBase64Image(heroImg),
        hero_img_preview: await getBase64Image(heroImgPreview),
        post_content: content.value.trim(),
    }
}


function isChecked(data)
{
    for (let key in data)
    {
        if (data[key] === '')
        {
            return false;
        }
    }
    return true;
}


async function pushData(event)
{
    const url = "/api.php";
    let data = await getData();
    let status;

    if (isChecked(data))
    {
        status = 0;
        console.log(JSON.stringify(data, null, SPACE_NUM));

        let response = await fetch(url, {
            method: "POST",
            body: JSON.stringify(data),
            headers: {
                "Content-Type": "application/json;charset=utf-8"
            }
        })
    }
    else
    {
        status = 1;
    }
    createMessage(status);
}


function displayImage(inputElement, imageElement)
{
    let file = inputElement.files[0];
    let inputLabel = document.querySelector(`label[for="${inputElement.id}"]`);
    let imageURL = URL.createObjectURL(file);
    let fileExtension = file.name.split('.').at(-1);

    if (fileExtension === "png" || fileExtension === "jpeg" || fileExtension === "jpg" || fileExtension === "gif")
    {
        imageElement.src = imageURL;
        inputLabel.firstElementChild.src = imageURL;
    }
}


function displayText(inputElement, textElements)
{
    for (let i = 0; i < textElements.length; i++)
    {
        if (inputElement.value !== "")
            if (inputElement.value.length > 27)
                textElements[i].textContent = inputElement.value.slice(0, 27) + "...";
        else
            textElements[i].textContent = inputElement.value;
    }
}


function deleteLastMessage()
{
    if (document.querySelector('.message'))
        document.body.removeChild(document.querySelector('.message'));
}


function createMessage(status)
{
    deleteLastMessage();

    const heading = document.querySelector('.heading');
    const div = document.createElement('div');
    const img = document.createElement('img');
    const span = document.createElement('span');

    if (status === 0)
    {
        div.className = 'success-message message';

        img.className = "success-message__icon icon"
        img.src = "/static/images/icons/check-circle.svg";
        img.alt = "Ok";

        span.className = "success-message__status status";
        span.innerText = 'Publish Complete!';
    }
    else
    {
        div.className = 'error-message message';

        img.className = "error-message__icon icon"
        img.src = "/static/images/icons/alert-circle.svg";
        img.alt = "Error";

        span.className = "error-message__status status";
        span.innerText = 'Whoops! Some fields need your attention :o';
    }

    div.appendChild(img);
    div.appendChild(span);
    heading.after(div);
}


function deleteLastErrorHelp()
{
    while (document.querySelector('.error-help'))
    {
        document.querySelector('.error-help').remove();
    }
}


function changeStyles(element)
{
    if (element.value === "")
        element.className = "input-field";
    else
        element.className = "input-field_active";
}


function createErrorHelp()
{
    deleteLastErrorHelp();

    if (title.value === "")
    {
        let spanTitle = document.createElement('span');
        spanTitle.className = 'error-help';
        spanTitle.innerText = 'Title is required';
        title.className = 'input-field-error_active';
        title.after(spanTitle);
    }
    if (description.value === "")
    {
        let spanDescription = document.createElement('span');
        spanDescription.className = 'error-help';
        spanDescription.innerText = 'Description is required';
        description.className = 'input-field-error_active';
        description.after(spanDescription);
    }
    if (author.value === "")
    {
        let spanAuthor = document.createElement('span');
        spanAuthor.className = 'error-help';
        spanAuthor.innerText = 'Author name is required';
        author.className = 'input-field-error_active';
        author.after(spanAuthor);
    }
    if (date.value === "")
    {
        let spanDate = document.createElement('span');
        spanDate.className = 'error-help';
        spanDate.innerText = 'Date is required';
        date.className = 'input-field-error_active';
        date.after(spanDate);
    }
    if (content.value === "")
    {
        let spanContent = document.createElement('span');
        spanContent.className = 'error-help';
        spanContent.innerText = 'Content is required';
        content.className = 'content-block__input-field_active';
        content.after(spanContent);
    }
    else
    {
        content.className = 'content-block__input-field';
    }
}


function initEventsListeners()
{
    publishButton.addEventListener('click', pushData);
    publishButton.addEventListener('click', createErrorHelp);
    for (let element of inputFields)
        element.addEventListener('input', function (event){ changeStyles(element) });

    title.addEventListener('input', function (event) {
        displayText(title, [document.getElementById('post-card-title'),
                                         document.getElementById('article-title')])
    });
    description.addEventListener('input', function (event) {
        displayText(description, [document.getElementById('post-card-subtitle'),
                                             document.getElementById('article-subtitle')])
    });
    author.addEventListener('input', function (event) {
        displayText(author, [document.getElementById('post-card-author-name')])
    });
    authorImg.addEventListener('input', function (event) {
        displayImage(authorImg, document.getElementById('author-avatar'))
    });
    date.addEventListener('input', function (event) {
        displayText(date, [document.getElementById('post-card-date')])
    });
    heroImg.addEventListener('input', function (event) {
        displayImage(heroImg, document.getElementById('article-preview-img'))
    });
    heroImgPreview.addEventListener('input', function (event) {
        displayImage(heroImgPreview, document.getElementById('post-card-img'))
    });
}


initEventsListeners();