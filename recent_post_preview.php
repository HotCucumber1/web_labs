<a class="recent-content__block link" title="<?= $post['title']?>" href="/post?id=<?= $post['id'] ?>">
    <img class="recent-content__block-image" alt="<?= $post['title']?>"
         src="<?= $post['preview']?>">
    <div class="recent-content__block-heading">
        <h5 class="recent-content__block-title"><?= $post['title']?></h5>
        <p class="recent-content__block-subtitle"><?= $post['subtitle']?></p>
    </div>
    <hr class="recent-content__block-line">
    <div class="recent-content__block-info">
        <img class="resent-content__author-img" src="<?= $post['author_icon']?>" alt="<?= $post['author']?>">
        <span class="recent-content__author-name"><?= $post['author']?></span>
        <span class="recent-content__block-date"><?= date('n/d/Y', $post['date'])?></span>
    </div>
</a>