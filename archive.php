<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<div class="main">
    <?php $this->need('component/nav.php'); ?>
	<div class="main-content">
		<?php if ($this->have()) : ?>
			<div class="place"><?php $this->archiveTitle(array(
														'category'  =>  _t('分类<span> %s </span>下的文章'),
														'search'    =>  _t('包含关键字<span> %s </span>的文章'),
														'date'      =>  _t('在<span> %s </span>发布的文章'),
														'tag'       =>  _t('标签<span> %s </span>下的文章'),
														'author'    =>  _t('<span>%s </span>发布的文章')
													), '', ''); ?></div>
			<?php while ($this->next()) : ?>
				<section class="post-list">
					<a href="<?php $this->permalink() ?>">
						<div class="block-title">
							<?php $this->title() ?>
						</div>
						<div class="posttime">
							<span>发布于<?php $this->date('Y年m月d日'); ?></span>
							<span class="post-tags"><?php $this->category(',', false); ?></span>
							<!--<span class="post-tags">view: <?php get_post_view($this) ?></span>-->
							<span class="post-tags"><?php $this->commentsNum(_t('无评论'), _t('1评论'), _t('%d评论')); ?></span>
						</div>
					</a>
				</section>
			<?php endwhile; ?>
		<?php else : ?>
			<div class="page404">
				<div>404 - 页面没找到</div>
				<p>你想查看的页面已被转移或删除了</p>
			</div>
		<?php endif; ?>
		<nav class="blog-nav">
			<?php $this->pageLink('<span>上一页</span>'); ?>
			<?php $this->pageLink('<span>下一页</span>', 'next'); ?>

		</nav>
	</div>
	<div class="container">
		<?php $this->need('footer.php'); ?>
	</div>
</div>
</div>

</body>

</html>