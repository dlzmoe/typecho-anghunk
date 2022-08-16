<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="cap">
  <ul>
    <li><a href="/">最新发布</a></li>
    <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
    <?php while ($pages->next()) : ?>
      <li class="<?php if ($this->is('page', $pages->slug)) : ?> current<?php endif; ?>"><a href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a></li>
    <?php endwhile; ?>
    

  </ul>
</div>