<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
    <div id="container">
        <header>
            <h1 class="post-title"><?php $this->title() ?></h1>
            <div class="post-time">
                <time><?php $this->date('Y年m月d日'); ?></time> / 
                <span>阅读: <a id="ArtalkPV"></a></span> / 
                <span class="post-tags"><?php $this->tags('', true, ''); ?></span>
            </div>
            
        </header>
    <div class="content"> 
        <?php $this->content(); ?>
    </div>
    <?php $this->need('comments.php'); ?>
    <?php $this->need('footer.php'); ?>
    </div>
</div>
</body>
</html>
