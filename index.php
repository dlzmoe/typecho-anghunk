<?php
/**
 * Anghunk 是一款基于 Typecho 博客程序的主题，主打写作阅读体验，没有太过多余的色彩，简单而不失细节，已经进入 2.0 版本，作者博客 <a href="https://imhan.cn" target="_blank">https://imhan.cn</a>
 * @package Anghunk 
 * @author 子舒
 * @version 2.0
 * @link https://zburu.com
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
<div class="main">
<div class="container">
    <main class="main-content">
        <div class="banner">
            <img src="<?php $this->options->bannerbg(); ?>">
            <p><?php $this->options->bannertext(); ?></p>
            
        </div>
        <div class="more">我已经写了 <?php echo allpostnum(1); ?> 篇文章，更多文章请访问 <a href="<?php $this->options->indexposts(); ?>">全部文章</a> ，分类有
            <?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
            <?php while ($category->next()): ?>
            <span<?php if ($this->is('post')): ?><?php if ($this->category == $category->slug): ?> class="current"<?php endif; ?>
            <?php else: ?>
            <?php if ($this->is('category', $category->slug)): ?> class="current"<?php endif; ?><?php endif; ?>>
                <a href="<?php $category->permalink(); ?>" title="<?php $category->name(); ?>"><?php $category->name(); ?></a>
            </span>
            <?php endwhile; ?> 。
        </div>
    
        <section class="post-list">
            <?php while($this->next()): ?>
                <?php if($this->category != "cateslug"): ?>
                    <article>
                        <div class="block-title">
                            <a href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
                            <div class="posttime"><?php $this->date('Y/m/d'); ?></div>
                        </div>
                        <div class="block-content"><?php $this->excerpt(80, '...'); ?></div>
                        <div class="block-time">
                            <span class="post-tags"><?php $this->tags('', true, ''); ?></span> / 
                            <span>阅读: <?php get_post_view($this) ?>  /  <?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?></span>
                            
                        </div>
                    </article>
                <?php endif; ?>
            <?php endwhile; ?>
        </section>
       <nav class="blog-nav">
        <?php $this->pageLink('<span>上一页</span>'); ?>
        <?php $this->pageLink('<span>下一页</span>','next'); ?>
       </nav>
    	
    </main>
    <?php $this->need('footer.php'); ?>
</div>
</div>
</body>
</html>
