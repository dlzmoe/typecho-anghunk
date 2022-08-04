<?php
/**
* 标签
*
* @package custom
*/

$this->need('header.php'); ?>
   <div class="main">
        <div class="container">
            <div class="main-content">
                <div class="tags">
            		<h1 class="post-title"><?php $this->title() ?></h1>
                    <div class="post-content">
                        <?php $this->widget('Widget_Metas_Tag_Cloud', 'sort=mid&ignoreZeroCount=1&desc=0&limit=99999')->to($tags); ?>
                        <?php if($tags->have()): ?>
                        <ul class="tags-list">
                        <?php while ($tags->next()): ?>
                            <li><a href="<?php $tags->permalink(); ?>"><?php $tags->name(); ?><sup> <?php $tags->count(); ?></sup></a></li>
                        <?php endwhile; ?>
                        <?php else: ?>
                            <li><?php _e('没有任何标签'); ?></li>
                        <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
             <?php $this->need('footer.php'); ?>
        </div>
    </div>
</body>
</html>

