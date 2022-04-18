<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
    <main id="container">
        <div class="main-content">
            <header>
                <h1 class="post-title"><?php $this->title() ?></h1>
                <div class="post-time">
                    <time><?php $this->date('Y年m月d日'); ?></time> / 
                    <span>阅读: <?php get_post_view($this) ?></span> / 
                    <span class="post-tags"><?php $this->tags('', true, ''); ?></span>
                </div>
                
            </header>
            <div class="content"> 
                <?php $this->content(); ?>
            </div>
            <?php $this->need('comments.php'); ?>
        </div>
        <?php $this->need('footer.php'); ?>
    </main>
</div>
</body>
</html>
