<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<div class="main">
    <?php $this->need('component/nav.php'); ?>
    <main class="container">
        <div class="main-content">
            <div class="post-meta">
                <h1 class="post-title"><?php $this->title() ?></h1>
                <div class="post-time">
                    <time> 发布于<?php $this->date('Y 年 m 月 d 日'); ?></time>
                </div>
            </div>
            
            <div class="content">
                <?php
                  $pattern = '/\<img.*?src\=\"(.*?)\"[^>]*>/i';
                  $replacement = '<img loading="lazy" class="slb" src="$1" alt="'.$this->title.'" title="'.$this->title.'">';
                  $content = preg_replace($pattern, $replacement, $this->content);
                  echo $content;
                ?>
                <span class="post-tag">标签: <?php $this->tags(' ', true, ''); ?></span>
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