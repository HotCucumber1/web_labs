<section class="recent-content__block block">
    <img class="recent-content__block-image" alt="<?= $post['title']?>"
         src="<?= $post['img_modifier']?>">
    <div class="recent-content__block-heading">
        <h5 class="recent-content__block-title"><?= $post['title']?></h5>
        <p class="recent-content__block-subtitle"><?= $post['subtitle']?></p>
    </div>
    <hr class="recent-content__block-line">
    <div class="recent-content__block-info">
        <img class="resent-content__author-img" src="<?= $post['author_icon']?>" alt="<?= $post['author']?>">
        <span class="recent-content__author-name"><?= $post['author']?></span>
        <span class="recent-content__block-date"><?= $post['date']?></span>
    </div>
</section>