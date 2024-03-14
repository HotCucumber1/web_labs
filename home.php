<?php
$featured_posts = [
    [
        'id' => 1,
        'title' => 'The Road Ahead',
        'subtitle' => 'The road ahead might be paved - it might not be.',
        'preview' => './static/images/main_page_images/preview/the_road_ahead_preview.jpg',
        'author' => 'Mat Vogels',
        'date' => 'September 25, 2015',
        'author_icon' => './static/images/main_page_images/authors/mat_vogels.png',
        'type' => '',
    ],
    [
        'id' => 2,
        'title' => 'From Top Down',
        'subtitle' => 'Once a year, go someplace you’ve never been before.',
        'preview' => './static/images/main_page_images/preview/from_top_down_preview.jpg',
        'author' => 'William Wong',
        'date' => 'September 25, 2015',
        'author_icon' => './static/images/main_page_images/authors/william_wong.png',
        'type' => 'ADVENTURE',
    ],
];

$recent_posts = [
    [
        'id' => 3,
        'title' => 'Still Standing Tall',
        'subtitle' => 'Life begins at the end of your comfort zone.',
        'preview' => './static/images/main_page_images/preview/still_standing_tall.jpg',
        'author' => 'William Wong',
        'date' => '9/25/2015',
        'author_icon' => './static/images/main_page_images/authors/william_wong.png',
    ],
    [
        'id' => 4,
        'title' => 'Sunny Side Up',
        'subtitle' => 'No place is ever as bad as they tell you it’s going to be.',
        'preview' => './static/images/main_page_images/preview/sunny_side_up.jpg',
        'author' => 'Mat Vogels',
        'date' => '9/25/2015',
        'author_icon' => './static/images/main_page_images/authors/mat_vogels.png',
    ],
    [
        'id' => 5,
        'title' => 'Water Falls',
        'subtitle' => 'We travel not to escape life, but for life not to escape us.',
        'preview' => './static/images/main_page_images/preview/water_falls.jpg',
        'author' => 'Mat Vogels',
        'date' => '9/25/2015',
        'author_icon' => './static/images/main_page_images/authors/mat_vogels.png',
    ],
    [
        'id' => 6,
        'title' => 'Through the Mist',
        'subtitle' => 'Travel makes you see what a tiny place you occupy in the world.',
        'preview' => './static/images/main_page_images/preview/through_the_mist.jpg',
        'author' => 'William Wong',
        'date' => '9/25/2015',
        'author_icon' => './static/images/main_page_images/authors/william_wong.png',
    ],
    [
        'id' => 7,
        'title' => 'Awaken Early',
        'subtitle' => 'Not all those who wander are lost.',
        'preview' => './static/images/main_page_images/preview/awaken_early.jpg',
        'author' => 'Mat Vogels',
        'date' => '9/25/2015',
        'author_icon' => './static/images/main_page_images/authors/mat_vogels.png',
    ],
    [
        'id' => 8,
        'title' => 'Try it Always',
        'subtitle' => 'The world is a book, and those who do not travel read only one page.',
        'preview' => './static/images/main_page_images/preview/try_it_always.jpg',
        'author' => 'Mat Vogels',
        'date' => '9/25/2015',
        'author_icon' => './static/images/main_page_images/authors/mat_vogels.png',
    ],
]
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Escape</title>

    <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oxygen&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="static/styles/main_page_style.css">
</head>

<body>
<header class="section-header">
    <div class="section-header__nav-panel nav-panel">
        <img class="section-header__logo" src="static/images/footer_logo.svg" alt="Escape.">
        <nav class="section-header__header-links links">
            <a class="section-header__link link">HOME</a>
            <a class="section-header__link link">CATEGORIES</a>
            <a class="section-header__link link">ABOUT</a>
            <a class="section-header__link link">CONTACT</a>
        </nav>
    </div>
    <div class="preview">
        <div class="preview-heading">
            <h1 class="preview__title">Let's do it together.</h1>
            <h2 class="preview__subtitle">We travel the world in search of stories. Come along for the ride.</h2>
            <button type="button" class="preview__button">View Latest Posts</button>
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
    <h3 class="content__title">Featured Posts</h3>
    <hr class="featured-content__line">
    <div class="featured-content__content">
        <?php
        foreach ($featured_posts as $post) {
            include 'featured_post_preview.php';
        }
        ?>
    </div>
</div>

<div class="recent-content">
    <h3 class="content__title">Most Recent</h3>
    <hr class="featured-content__line">

    <div class="recent-content__content">
        <?php
        foreach ($recent_posts as $post) {
            include 'recent_post_preview.php';
        }
        ?>
    </div>
</div>

<footer class="section-footer">
    <div class="section-footer__nav-panel nav-panel">
        <img class="section-footer__logo" src="static/images/footer_logo.svg" alt="Escape.">
        <nav class="section-footer__links links">
            <a class="section-footer__link link">HOME</a>
            <a class="section-footer__link link">CATEGORIES</a>
            <a class="section-footer__link link">ABOUT</a>
            <a class="section-footer__link link">CONTACT</a>
        </nav>
    </div>
</footer>
</body>
</html>