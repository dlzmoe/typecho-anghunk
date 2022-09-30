<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<div class="main">
    <?php $this->need('component/nav.php'); ?>
    <div class="container">
        <div class="main-content">
            <h1 class="post-title"><?php $this->title() ?></h1>
            <div class="content" itemprop="articleBody">
                <?php $this->content(); ?>
            </div>
        </div>
    </div>
    <?php $this->need('component/comments.php'); ?>
    <div class="container">
        <?php $this->need('component/footer.php'); ?>
    </div>
</div>
</div>
</body>

</html>