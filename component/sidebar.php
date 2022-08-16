<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<div class="weight weight-search">
  <?php $options = Typecho_Widget::widget('Widget_Options');
  if ($options->search == '0') {
    echo ('<a class="search-form-input" href="#">Search</a>');
  } ?>
</div>

<ul class="weight weight-announcement">
  <p class="title">旅行者: </p>
  <div><?php $this->options->headerannouncement(); ?></div>
</ul>

<div class="autoMenu" id="autoMenu" data-autoMenu></div>

<ul class="weight weight-comment">
  <p class="title">最新评论: </p>
  <?php $this->widget('Widget_Comments_Recent', 'ignoreAuthor=true')->to($comments); ?>
  <?php while ($comments->next()) : ?>
    <li><a href="<?php $comments->permalink(); ?>"><?php $comments->author(false); ?>: <?php $comments->excerpt(50, '...'); ?></a></li>
  <?php endwhile; ?>
</ul>

<ul class="weight weight-hot">
  <p class="title">热门文章: </p>
  
</ul>