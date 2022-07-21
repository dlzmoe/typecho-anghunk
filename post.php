<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
    <div class="main">
        <main class="container">
            <div class="main-content">
                <div>
                    <h1 class="post-title"><?php $this->title() ?></h1>
                    <div class="post-time">
                        <time> 发布于<?php $this->date('Y 年 m 月 d 日'); ?></time> / 
                        <!--<span>阅读: <?php get_post_view($this) ?></span> / -->
                        <span class="post-tags"><?php $this->tags('', true, ''); ?></span> 
                        <!--<a href="#comments"><?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?></a>-->
                    </div>
                </div>
                <div class="autoMenu" id="autoMenu" data-autoMenu></div>
                <div class="content"> 
                    <?php $this->content(); ?>
                </div>
                <div class="prevornext">
                    <p><?php $this->theNext('%s', '已经是最新的文章啦'); ?></p>
                    <p><?php $this->thePrev('%s', '这是第一篇文章喔'); ?></p>
                </div>
                <?php _getHistoryToday($this->created) ?>
            </div>
        </main>
        <?php $this->need('comments.php'); ?>
        <div class="container">
            <?php $this->need('footer.php'); ?>
        </div>
    </div>
</div>
</body>
</html>
