<?php
require_once './data/db/db_connection.php';
require './data/db/db_interaction.php';


$connection = createDBConnection();
$posts = getPostsFromDB($connection);
closeDBConnection($connection);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Escape</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oxygen&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/static/styles/main_page_style.css">
</head>

<body>
<header class="section-header">
    <div class="section-header-nav-panel nav-panel">
        <a href="/home">
            <img class="section-header__logo" src="static/images/logo/footer_logo.svg" alt="Escape.">
        </a>
        <nav class="section-header__header-links links">
            <a class="section-header__link link" href="/home">HOME</a>
            <a class="section-header__link link">CATEGORIES</a>
            <a class="section-header__link link">ABOUT</a>
            <a class="section-header__link link">CONTACT</a>
        </nav>
        <div class="section-header__hamburger-menu">
            <hr class="section-header__hamburger-menu-line">
            <hr class="section-header__hamburger-menu-line">
            <hr class="section-header__hamburger-menu-line">
        </div>
    </div>
    <div class="preview">
        <div class="preview-heading">
            <h1 class="preview-heading__title">Let's do it together.</h1>
            <h2 class="preview-heading__subtitle">We travel the world in search of stories. Come along for the ride.</h2>
            <button type="button" class="preview-heading__button"
                    id="view-post-button" name="view_post_button">View Latest Posts
            </button>
        </div>
    </div>
</header>

<nav class="menu">
    <ul class="menu__list">
        <li class="menu__item"><a class="menu__link link">Nature</a></li>
        <li class="menu__item"><a class="menu__link link">Photography</a></li>
        <li class="menu__item"><a class="menu__link link">Relaxation</a></li>
        <li class="menu__item"><a class="menu__link link">Vacation</a></li>
        <li class="menu__item"><a class="menu__link link">Travel</a></li>
        <li class="menu__item"><a class="menu__link link">Adventure</a></li>
    </ul>
</nav>

<div class="featured-content">
    <h3 class="featured-content__title">Featured Posts</h3>
    <hr class="featured-content__line">
    <div class="featured-content__posts">
        <?php
        foreach ($posts as $post)
        {
            if ($post['featured'] == 1)
            {
                include './samples/featured_post_preview.php';
            }
        }
        ?>
    </div>
</div>

<div class="recent-content">
    <h3 class="recent-content__title">Most Recent</h3>
    <hr class="recent-content__line">

    <div class="recent-content__posts">
        <?php
        foreach ($posts as $post)
        {
            if ($post['featured'] == 0)
            {
                include './samples/recent_post_preview.php';
            }
        }
        ?>
    </div>
</div>

<footer class="section-footer">
    <form class="section-footer-feedback" id="feedback-form">
        <h3 class="section-footer-feedback__title">Stay in Touch</h3>
        <hr class="section-footer-feedback__line">
        <input class="section-footer__email-input" type="email" placeholder="Enter your email address">
        <button class="section-footer-feedback__submit-button" type="submit" form="feedback-form">Submit</button>
    </form>

    <div class="section-footer__nav-panel-background">
        <div class="section-footer-nav-panel nav-panel">
            <img class="section-footer-nav-panel__logo" src="static/images/logo/footer_logo.svg" alt="Escape.">
            <nav class="section-footer-nav-panel__links links">
                <a class="section-footer-nav-panel__link link" href="/home">HOME</a>
                <a class="section-footer-nav-panel__link link">CATEGORIES</a>
                <a class="section-footer-nav-panel__link link">ABOUT</a>
                <a class="section-footer-nav-panel__link link">CONTACT</a>
            </nav>
        </div>
    </div>

</footer>
</body>
<script src="./scripts/home_script.js" type="application/javascript"></script>
</html>