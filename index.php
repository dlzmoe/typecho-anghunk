<?php

/**
 * Anghunk 是一款基于 Typecho 博客程序的主题，主打写作阅读体验，没有太过多余的色彩，简单而不失细节，已经进入 3.0 版本，作者博客 <a href="https://zburu.com" target="_blank">https://zburu.com</a>
 * @package Anghunk
 * @author 子舒
 * @version 4.0
 * @link https://zburu.com
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
<div class="main">
	<?php $this->need('component/nav.php'); ?>
	<main class="main-content">
		<section class="post-list">
			<?php while ($this->next()) : ?>
				<?php if ($this->category != "cateslug") : ?>
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

				<?php endif; ?>
			<?php endwhile; ?>
		</section>
		<nav class="blog-nav">
			<?php $this->pageLink('<span>上一页</span>'); ?>
			<?php $this->pageLink('<span>下一页</span>', 'next'); ?>
		</nav>

	</main>
	<div class="container">
		<?php $this->need('footer.php'); ?>
	</div>
</div>
</body>

</html>