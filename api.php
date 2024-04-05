<?php
require_once './data/db/db_connection.php';
require './data/db/db_interaction.php';


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
    echo "Данные успешно сохранены" . "<br>";
}


function saveImage(string $image, string $fileName): void {
    $imageArray = explode(';base64,', $image);
    $imageExtension = str_replace('data:image/', '',  $imageArray[0]);
    $imageDecode = base64_decode($imageArray[1]);
    saveFile("./static_content/images/main_page_images/preview/{$fileName}.$imageExtension", $imageDecode);
}


function isCorrect(array $data): bool
{
    if (is_string($data['title']) and strlen($data['title']) <= MAX_STR_LEN and
        is_string($data['subtitle']) and strlen($data['subtitle']) <= MAX_STR_LEN and
        is_string($data['author']) and strlen($data['author']) <= MAX_STR_LEN and
        is_string($data['author_url']) and strlen($data['author_url']) <= MAX_STR_LEN and
        is_string($data['publish_date']) and
        is_string($data['image_url']) and
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
        if ($key != 'content')
        {
            $data[$key] = htmlentities($value);
        }
    }
    return $data;
}


$connection = createDBConnection();
$method = $_SERVER['REQUEST_METHOD'];
echo $method . "<br>";

if ($method === 'POST')
{
    $jsonData = file_get_contents("php://input");
    $arrayData = json_decode($jsonData, associative: true);

    if (isCorrect($arrayData))
    {
        $arrayData = protectedData($arrayData);
        $fileName = mb_strtolower(str_replace(' ', '_', rtrim($arrayData['title'], '.')));
        saveImage($arrayData['image_url'], $fileName);

        $arrayData['image_url'] = "./static/images/main_page_images/preview/{$fileName}.jpg";
        pushPost($connection, $arrayData);
    }
    else
    {
        echo "Неверные данные";
    }
}
else
{
    echo "Отправьте POST-запрос" . "<br>";
}

closeDBConnection($connection);