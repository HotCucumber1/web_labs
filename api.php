<?php
require_once './data/db/db_connection.php';
require './data/db/db_interaction.php';


// посмотреть, что приходит
function saveFile(string $file, string $data): void {
    $myFile = fopen($file, 'w');
    if (!$myFile) {
        echo "Ошибка открытия файл";
        return;
    }
    $result = fwrite($myFile, $data);
    if (!$result) {
        echo "Ошибка записи в файл";
        return;
    }
    fclose($myFile);
}


function isCorrect(array $data): bool
{
    if (is_string($data['title']) and strlen($data['title']) <= MAX_STR_LEN and
        is_string($data['description']) and strlen($data['description']) <= MAX_STR_LEN and
        is_string($data['author']) and strlen($data['author']) <= MAX_STR_LEN and
        is_string($data['author_img']) and
        is_string($data['date']) and
        is_string($data['hero_img']) and
        is_string($data['hero_img_preview']) and
        is_int($data['featured']) and
        is_string($data['type']) and strlen($data['type']) <= TYPE_LEN)
    {
        return true;
    }
    return false;
}


function protectedData(array $data): array
{
    foreach ($data as $key => $value)
    {
        if ($key != 'post_content')
        {
            $data[$key] = htmlentities($value);
        }
    }
    return $data;
}

function setDefaultItems($data): array
{
    if (!$data['featured'])
        $data['featured'] = 0;
    if (!$data['type'])
        $data['type'] = '';
    return $data;
}

function saveImage(string $image, string $fileName, string $dir): string
{
    $imageArray = explode(';base64,', $image);
    $imageExtension = str_replace('data:image/', '',  $imageArray[0]);
    $imageDecode = base64_decode($imageArray[1]);
    saveFile("./static_content/images/{$dir}/{$fileName}.{$imageExtension}", $imageDecode);
    return $imageExtension;
}

function setSavedImagesData($data): array
{
    $authorFileName = mb_strtolower(str_replace(' ', '_', rtrim($data['author'], '.')));
    $mainImageFileName = mb_strtolower(str_replace(' ', '_', rtrim($data['title'], '.')));
    $previewFileName = mb_strtolower(str_replace(' ', '_', rtrim($data['title'], '.'))) . "_preview";

    $authorExt = saveImage($data['author_img'], $authorFileName, 'avatars');
    $mainImgExt = saveImage($data['hero_img'], $mainImageFileName, 'main_image');
    $previewExt = saveImage($data['hero_img_preview'], $previewFileName, 'preview');

    $data['author_img'] = "/static/images/avatars/{$authorFileName}.{$authorExt}";
    $data['hero_img'] = "/static/images/main_image/{$mainImageFileName}.{$mainImgExt}";
    $data['hero_img_preview'] = "/static/images/preview/{$previewFileName}.{$previewExt}";

    return $data;
}


try {
    $method = $_SERVER['REQUEST_METHOD'];
    $jsonData = file_get_contents("php://input");

    if ($method === 'POST')
    {
        $connection = createDBConnection();

        $jsonData = file_get_contents("php://input");
        $arrayData = json_decode($jsonData, associative: true);

        $arrayData = protectedData($arrayData);
        $arrayData = setDefaultItems($arrayData);
        $arrayData = setSavedImagesData($arrayData);


        if (isCorrect($arrayData))
        {
            pushPost($connection, $arrayData);
        }
        else
        {
            echo "Неверные данные";
            print_r($arrayData);
        }
        closeDBConnection($connection);
    }
    else
        echo "Отправьте POST-запрос" . "<br>";
}
catch (Exception $e) {
    echo $e->getMessage();
}

