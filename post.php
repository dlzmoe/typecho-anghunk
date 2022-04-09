<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<div id="container">
    <header>
        <h2 class="post-title"><?php $this->title() ?></h2>
        <div class="post-time">
            <time><?php $this->date('F j, Y'); ?></time> / 
            <span>阅读: <?php get_post_view($this) ?></span>
        </div>
        
    </header>
    <div class="content">
        <?php $this->content(); ?>
    </div>
    <p itemprop="keywords" class="post-tags">Tag: <?php $this->tags('', true, ''); ?></p>
   
    <?php $this->need('comments.php'); ?>
    <?php $this->need('footer.php'); ?>
</div>

