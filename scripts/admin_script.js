let publish_button = document.getElementById('publish-button');

let title = document.getElementById('title');
let description = document.getElementById('description');
let author = document.getElementById('author');
let date = document.getElementById('date');

let input_fields = [
    document.getElementById('title'),
    document.getElementById('description'),
    document.getElementById('author'),
    document.getElementById('date'),
]


const SPACE_NUM = 4;

function convertToBase64(image)
{
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onload = () => {
            resolve(reader.result);
        }
        reader.readAsDataURL(image);
    });
}

function checkImg(image)
{
    let base64 = "";
    if (image.files[0])
    {
        base64 = convertToBase64(image.files[0]).then((img) => img);
    }
    return base64;
}

function getData()
{
    const title = document.getElementById('title');
    const description = document.getElementById('description');
    const author = document.getElementById('author');
    const authorImg = document.getElementById('author-img');
    const date = document.getElementById('date');
    const heroImg = document.getElementById('hero-img');
    const heroImgPreview = document.getElementById('hero-img-preview');
    const content = document.getElementById('post-content');

    console.log(checkImg(authorImg));

    return {
        'title': title.value,
        'description': description.value,
        'author': author.value,
        'author_img': checkImg(authorImg),
        'date': date.value,
        'hero_img': checkImg(heroImg),
        'hero_img_preview': checkImg(heroImgPreview),
        'post_content': content.value,
    };
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

function pushData(event)
{
    let data = getData();
    let status;
    if (isChecked(data))
    {
        status = 0;
        console.log(JSON.stringify(data, null, SPACE_NUM));
    }
    else
    {
        status = 1;
    }
    createMessage(status);
}

function displayImage(inputElement, imageElement)
{
    const file = inputElement.files[0];
    const inputLabel = document.querySelector(`label[for="${inputElement.id}"]`);
    const imageURL = URL.createObjectURL(file);

    imageElement.src = imageURL;
    inputLabel.firstElementChild.src = imageURL;
}

function displayText(inputElement, textElements)
{
    for (let i = 0; i<textElements.length; i++)
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
        element.className = "input-field_active"
}

// разобраться
function createErrorHelp(last)
{
    deleteLastErrorHelp();

    const span = document.createElement('span');
    span.className = 'error-help';
    span.innerText = `${last.id} is required`;

    last.after(span);
}

function initEventsListeners()
{
    publish_button.addEventListener('click', pushData);
    for (let element of input_fields)
    {
        element.addEventListener('input', function (event){ changeStyles(element) });
    }
}


initEventsListeners();