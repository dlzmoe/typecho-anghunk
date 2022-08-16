<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<div class="main">
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
							<div class="article-img">
								<?php $options = Typecho_Widget::widget('Widget_Options');
								if ($options->slt == '0') {
									if (($this->fields->imgurl)) {
										echo '<img src="' . $this->fields->imgurl . '">';
									} else {
										echo '';
									}
								} ?>
							</div>
							<?php $this->title() ?>
						</div>
						<div class="block-content"><?php $this->excerpt(80, '...'); ?></div>
						<div class="posttime">
							<span>发布于<?php $this->date(' Y年 m月 d日 '); ?></span>
							<span class="post-tags"><?php $this->category(',', false); ?></span>
							<!-- <span>view: <?php get_post_view($this) ?> · <?php $this->commentsNum(_t('无评论'), _t('评论: 1'), _t(' 评论: %d')); ?></span> -->
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