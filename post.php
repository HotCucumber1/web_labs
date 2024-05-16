<?php
require_once './data/db/db_connection.php';
require './data/db/db_interaction.php';


function getId(): ?string
{
    if (in_array('id', array_keys($_GET)) and is_numeric($_GET['id']))
    {
         return htmlentities($_GET['id']);
    }
    else
    {
        die("Неверный ID поста");
        // header("Location: https://localhost:443/home");
    }
}


$connection = createDBConnection();
$postId = getId();
$dbPost = getPostFromDB($connection, $postId);
if ($dbPost->num_rows > 0) {
    $post = $dbPost->fetch_assoc();
}
else
{
    die("Неверный ID поста");
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
            <a href="/home"><img class="section-header__logo" src="/static/images/logo/header_logo.svg" alt="Escape."></a>

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
        <div class="section-footer-nav-panel">
            <img class="section-footer-nav-panel__logo" src="/static/images/logo/footer_logo.svg" alt="Escape.">

            <nav class="section-footer-nav-panel__links">
                <a class="section-footer-nav-panel__link" href="/home">HOME</a>
                <a class="section-footer-nav-panel__link">CATEGORIES</a>
                <a class="section-footer-nav-panel__link">ABOUT</a>
                <a class="section-footer-nav-panel__link">CONTACT</a>
            </nav>
        </div>
    </footer>
</body>
</html>
