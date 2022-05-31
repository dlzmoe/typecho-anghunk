<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
    <main class="container">
        <div class="main-content">
            <div class="breadcrumb">
               <a href="<?php $this->options->siteUrl(); ?>" title="<?php $this->options->title(); ?>">首页</a> &gt; <?php $this->category(); ?> 
            </div>
            <header>
                <h1 class="post-title"><?php $this->title() ?></h1>
                <div class="post-time">
                    <time><?php $this->date('Y年m月d日'); ?></time> / 
                    <span>阅读: <?php get_post_view($this) ?></span> / 
                    <span class="post-tags"><?php $this->tags('', true, ''); ?></span> / 
                    <span><?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?></span>
                </div>
                
            </header>
            <div class="content"> 
                <?php $this->content(); ?>
            </div>
            <div class="prevornext">
                <p><?php $this->theNext(); ?></p>
                <p><?php $this->thePrev(); ?></p>
            </div>
            <?php $this->need('comments.php'); ?>
        </div>
        <?php $this->need('footer.php'); ?>
    </main>
</div>
</body>
</html>
