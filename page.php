<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<div id="container">
    <header>
        <h2 class="post-title"><?php $this->title() ?></h2>
    </header>
    <div class="content" itemprop="articleBody">
        <?php $this->content(); ?>
    </div>
   <?php $this->need('footer.php'); ?>
</div>

