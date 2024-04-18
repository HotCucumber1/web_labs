let publish_button = document.getElementById('publish-button');


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

function checkImg(image) {
    let base64;
    if (image.files[0]) {
        convertToBase64(image.files[0]).then(img => {
            console.log(img);
        })
    }
    else {
        base64 = "";
    }
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


    const data = {
        'title': title.value,
        'description': description.value,
        'author': author.value,
        'author_img': checkImg(authorImg),
        'date': date.value,
        'hero_img': checkImg(heroImg),
        'hero_img_preview': checkImg(heroImgPreview),
        'post_content': content.value,
    }

    return data;
    /*const replacer = null;
    const space = 4;
    return JSON.stringify(data, replacer, space);*/
}

function isChecked(data) {
    for (let key in data) {
        if (data[key] === '') {
            return false;
        }
    }
    return true;
}

function pushData(event)
{
    let data = getData();
    let status;
    if (isChecked(data)) {
        status = 0;
        console.log(data);
    }
    else {
        status = 1;
    }
    createMessage(status);
}

function displayImage(inputElement, imageElement) {
    const file = inputElement.files[0];
    const inputLabel = document.querySelector(`label[for="${inputElement.id}"]`);
    const imageURL = URL.createObjectURL(file);

    imageElement.src = imageURL;
    inputLabel.firstElementChild.src = imageURL;
}

function displayText(inputElement, textElements) {
    for (let i = 0; i<textElements.length; i++) {
        textElements[i].textContent = inputElement.value;
    }
}

function deleteLastMessage() {
    if (document.querySelector('.success-message')) {
        document.body.removeChild(document.querySelector('.success-message'));
    }
    if (document.querySelector('.error-message')) {
        document.body.removeChild(document.querySelector('.error-message'));
    }
}

function createMessage(status) {
    deleteLastMessage();

    const heading = document.querySelector('.heading');
    const div = document.createElement('div');
    const img = document.createElement('img');
    const span = document.createElement('span');
    if (status === 0) {
        div.className = 'success-message message';

        img.className = "success-message__icon icon"
        img.src = "/static/images/icons/check-circle.svg";
        img.alt = "Ok";

        span.className = "success-message__status status";
        span.innerText = 'Publish Complete!';
    } else {
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

function deleteLastErrorHelp() {
    if (document.querySelector('.error-help')) {
        document.querySelector('.error-help').remove();
    }
}

// разобраться
function createErrorHelp(last) {
    deleteLastErrorHelp();

    const span = document.createElement('span');
    span.className = 'error-help';
    span.innerText = `${last.id} is required`;

    last.after(span);
}

function initEventsListeners()
{
    publish_button.addEventListener('click', pushData)
}


initEventsListeners();