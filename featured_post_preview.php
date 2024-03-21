<a class="featured-content-block link" title="<?= $post['title']?>" href="/post?id=<?= $post['id'] ?>"
   style="background-image: url('<?= $post["preview"]?>');
                background-size: cover;">
    <?php if ($post['type'] != ''): ?>
        <p class="featured-content__type"><?= $post['type'] ?></p>
    <?php endif ?>
    <div class="featured-content__block-heading">
        <h4 class="featured-content__block-title"><?= $post['title'] ?></h4>
        <p class="featured-content__block-subtitle"><?= $post['subtitle'] ?></p>
    </div>
    <div class="featured-content__block-info">
        <img class="author-img" src="<?= $post['author_icon']?>" alt="<?= $post['author'] ?>" >
        <span class="featured-content__author-name"><?= $post['author'] ?></span>
        <span class="featured-content__block-date"><?= date('F d, Y', $post['date'])?></span>
    </div>
</a>
