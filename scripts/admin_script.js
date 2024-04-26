let publish_button = document.getElementById('publish-button');

let title = document.getElementById('title');
let description = document.getElementById('description');
let author = document.getElementById('author');
let authorImg = document.getElementById('author-img');
let date = document.getElementById('date');
let heroImg = document.getElementById('hero-img');
let heroImgPreview = document.getElementById('hero-img-preview');

let input_fields = [
    title,
    description,
    author,
    date,
]


const SPACE_NUM = 4;

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
        'title': title.value.trim(),
        'description': description.value.trim(),
        'author': author.value.trim(),
        'author_img': await getBase64Image(authorImg),
        'date': date.value.trim(),
        'hero_img': await getBase64Image(heroImg),
        'hero_img_preview': await getBase64Image(heroImgPreview),
        'post_content': content.value.trim(),
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

    imageElement.src = imageURL;
    inputLabel.firstElementChild.src = imageURL;
}

function displayText(inputElement, textElements)
{
    for (let i = 0; i < textElements.length; i++)
    {
        if (inputElement.value !== "")
            textElements[i].textContent = inputElement.value;
    }
}

function deleteLastMessage()
{
    if (document.querySelector('.message'))
    {
        document.body.removeChild(document.querySelector('.message'));
    }
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
    if (document.querySelector('.error-help'))
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

// разобраться
function createErrorHelp(last)
{
    deleteLastErrorHelp();

    let span = document.createElement('span');
    span.className = 'error-help';
    span.innerText = `${last.id} is required`;

    last.after(span);
}

function initEventsListeners()
{
    publish_button.addEventListener('click', pushData);
    for (let element of input_fields)
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