<?php

function authBySession(?int $userId): bool
{
    return !is_null($userId);
}


session_start();
if (authBySession($_SESSION["user_id"]))
{
    $userName = $_SESSION["user_name"];
}
else
{
    echo "You need to login";
    header("HTTP/1.1 401 Not Found");
    die();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Oxygen&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="static/styles/admin_style.css">
    <title>Admin</title>
</head>

<body>
    <header class="section-header">
        <div class="section-header__content">
            <a href="/home">
                <img class="section-header__logo" src="/static/images/logo/admin_logo.svg" alt="Escape.admin">
            </a>
            
            <div class="section-header-menu">
                <a class="section-header__user-icon-link" href="">
                    <div class="section-header__user-icon avatar" style="background-color: <?= $_SESSION['color']?>">
                        <span><?= mb_strtoupper($userName[0]) ?></span>
                    </div>
                </a>
                <a class="section-header__exit-icon-link" href="/api/logout">
                    <img class="section-header__exit-icon" src="static/images/icons/log_out.svg" alt="Exit">
                </a>
            </div>
        </div>
    </header>

    <div class="heading">
        <div class="heading__name">
            <h1 class="heading__title">New Post</h1>
            <h2 class="heading__subtitle">Fill out the form bellow and publish your article</h2>
        </div>
        <button class="heading__publish-button" form="main-form" id="publish-button" type="button">Publish</button>
    </div>
    
    
    <div class="main-info info-area">
        <h3 class="main-info__title">Main Information</h3>
        <div class="main-info__main-information">
            <form class="main-info-enter" id="main-form">
                <div class="main-info-enter-title-input input-block">
                    <label class="main-info-enter-title-input__label input-label" for="title">Title</label>
                    <input class="main-info-enter-title-input__input-field input-field"
                           type="text" id="title" maxlength="255" name="title" required>
                </div>
                
                <div class="main-info-enter-description-input input-block">
                    <label class="main-info-enter-description-input__label input-label"
                           for="description">Short description</label>
                    <input class="main-info-enter-description-input__input-field input-field"
                           type="text" id="description" maxlength="255" name="description" required>
                </div>
                
                <div class="main-info-enter-author-input input-block">
                    <label class="main-info-enter-author-input__label input-label" for="author">Author name</label>
                    <input class="main-info-enter-author-input__input-field input-field"
                           type="text" id="author" maxlength="255" name="author" required>
                </div>
                
                <div class="main-info-enter-author-img-input input-block">
                    <span class="main-info-enter-author-img-input__label-name input-label">Author Photo</span>
                    <label class="main-info-enter-author-img-input__label label-image" for="author-img">
                        <img class="main-info-enter-author-img-input__label-img avatar"
                             src="/static/images/icons/default_avatar_icon.svg" alt="Upload image">
                        <span class="main-info-enter-author-img-input__label-sign">Upload</span>
                    </label>
                    <input class="main-info-enter-author-img-input__input-field input-hidden"
                           type="file" id="author-img" accept="image/*" name="author_img" required>
                </div>
                
                <div class="main-info-enter-date-input input-block">
                    <label class="main-info-enter-date-input__label input-label" for="date">Publish date</label>
                    <input class="main-info-enter-date-input__input-field input-field"
                           type="date" id="date" name="date" required>
                </div>
                
                <div class="main-info-enter-hero-img-input input-block">
                    <span class="main-info-enter-hero-img-input__label-name input-label">Hero image</span>
                    <label class="main-info-enter-hero-img-input__label label-image" for="hero-img">
                        <img class="main-info-enter-hero-img-input__label-img hero-image"
                             src="/static/images/icons/hero_image_default_icon.svg" alt="Upload image">
                    </label>
                    <input class="main-info-enter-hero-img-input__input-field input-hidden"
                           type="file" id="hero-img" accept="image/*" name="hero_img" required>
                    <span class="main-info-enter-hero-img-input__size-pointer size-pointer input-label">
                        Size up to 10mb. Format: png, jpeg, gif.
                    </span>
                </div>
                
                <div class="main-info-enter-hero-preview-img-input input-block">
                    <span class="main-info-enter-hero-preview-img-input__label-name input-label">Hero image</span>
                    <label class="main-info-enter-hero-preview-img-input__label label-image" for="hero-img-preview">
                        <img class="main-info-enter-hero-preview-img-input__label-img hero-image"
                             src="/static/images/icons/hero_image_preview_default_icon.svg" alt="Upload image">
                    </label>
                    <input class="main-info-enter-hero-preview-img-input__input-field input-hidden"
                           type="file" id="hero-img-preview" name="hero_img_preview" accept="image/*" required>
                    <span class="main-info-enter-hero-preview-img-input__size-pointer size-pointer input-label">
                        Size up to 5mb. Format: png, jpeg, gif.
                    </span>
                </div>
            </form>
            
            <div class="main-info-preview">
                <span class="main-info-preview__article-label input-label">Article preview</span>
                <div class="main-info-preview-article-preview">
                    <!-- Передавать данные из полей ввода -->
                    <div class="main-info-preview-article-preview__heading">
                        <span class="main-info-preview-article-preview__title" id="article-title">New post</span>
                        <span class="main-info-preview-article-preview__subtitle" id="article-subtitle">
                            Please, enter any description
                        </span>
                    </div>
                    <img class="main-info-preview-article-preview__image"
                         src="/static/images/icons/article_preview_default_img.svg"
                         alt="Article preview" id="article-preview-img">
                </div>
                
                <div class="main-info-preview__post-card-preview">
                    <span class="main-info-preview__post-card-label input-label">Post card preview</span>
                    <div class="main-info-preview-post-card-preview">
                        <div class="main-info-preview-post-card-preview__card">
                            <img class="main-info-preview-post-card-preview__image"
                                 src="/static/images/icons/post_card_preview_default_img.svg"
                                 alt="Post card preview" id="post-card-img">
                            <div class="main-info-preview-post-card-preview__heading">
                                <span class="main-info-preview-post-card-preview__title" id="post-card-title">
                                    New Post
                                </span>
                                <span class="main-info-preview-post-card-preview__subtitle" id="post-card-subtitle">
                                    Please, enter any description
                                </span>
                            </div>
                            <div class="main-info-preview-post-card-preview__info">
                                <img class="main-info-preview-post-card-preview__author-img avatar"
                                     src="/static/images/avatars/default.png" alt="Author" id="author-avatar">
                                <span class="main-info-preview-post-card-preview__author-name"
                                      id="post-card-author-name">Enter author name
                                </span>
                                <span class="main-info-preview-post-card-preview__date"
                                      id="post-card-date">4/19/2023
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="content-block info-area">
        <h3 class="content-block__title">Content</h3>
        <label class="content-block__label input-label" for="post-content">Post content (plain text)</label>
        <textarea class="content-block__input-field" id="post-content"
                  placeholder="Type anything you want ..." name="post_content"></textarea>
    </div>
    <script src="scripts/admin_script.js" type="application/javascript"></script>
</body>
</html>