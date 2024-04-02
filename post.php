<?php
if (in_array('id', array_keys($_GET))) {
    $postId = $_GET['id'];
} else {
    echo "Отсутствует ID поста";
    /*header("Location: https://localhost:443/home");*/
}

include 'DBconnection.php';

function getPostFromDB(mysqli $connect): mysqli_result {
    global $postId;
    $sql_query = "SELECT * FROM post WHERE id={$postId}";
    return $connect -> query($sql_query);
}


$connection = createDBConnection();
if (getPostFromDB($connection) -> num_rows > 0) {
    $post = getPostFromDB($connection) -> fetch_assoc();
}
else {
    echo "Неверный ID поста";
}
closeDBConnection($connection);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $post['title'] ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oxygen&display=swap" rel="stylesheet">

    <link href="/static/styles/post.css" rel="stylesheet">
</head>

<body>
    <header class="section-header">
        <div class="section-header__nav-panel">
            <a href="/home"><img class="section-header__logo" src="/static/images/header_logo.svg" alt="Escape."></a>

            <nav class="section-header__links">
                <a class="section-header__link" href="/home">HOME</a>
                <a class="section-header__link">CATEGORIES</a>
                <a class="section-header__link">ABOUT</a>
                <a class="section-header__link">CONTACT</a>
            </nav>
        </div>
    </header>

    <h1 class="title"><?= $post['title'] ?></h1>
    <h2 class="subtitle"><?= $post['subtitle'] ?></h2>

    <img class="image" src="<?= $post['image_url'] ?>" alt="<?= $post['title'] ?>">

    <p class="mainText">
        <?= $post['content'] ?>
    </p>

    <footer class="section-footer">
        <div class="section-footer__nav-panel">
            <img class="section-footer__logo" src="/static/images/footer_logo.svg" alt="Escape.">

            <nav class="section-footer__links">
                <a class="section-footer__link" href="/home">HOME</a>
                <a class="section-footer__link">CATEGORIES</a>
                <a class="section-footer__link">ABOUT</a>
                <a class="section-footer__link">CONTACT</a>
            </nav>
        </div>
    </footer>
</body>
</html>
