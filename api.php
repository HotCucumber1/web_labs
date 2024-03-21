<?php

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
    echo "Данные успешно сохранены";
    fclose($myFile);
}


function saveImage(string $image): void {
    $imageArray = explode(';base64,', $image);
    $imageExtension = str_replace('data:image/', '',  $imageArray[0]);
    $imageDecode = base64_decode($imageArray[1]);
    saveFile("./static_content/images/nature.$imageExtension", $imageDecode);
}


$method = $_SERVER['REQUEST_METHOD'];
echo $method . "<br>";

$jsonData = file_get_contents("php://input");
$arrayData = json_decode($jsonData, associative: true);
saveImage($arrayData['image']);
