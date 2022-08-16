<?php

/**
 * 分类
 *
 * @package custom
 */

$this->need('header.php'); ?>
<div class="main">
    <?php $this->need('component/nav.php'); ?>
    <div class="container">
        <div class="main-content">
            <div class="cate">
                <h1 class="post-title"><?php $this->title() ?></h1>
                <div class="post-content">
                    <ul class="cate">
                        <?php $this->widget('Widget_Metas_Category_List')
                            ->parse('<li><a href="{permalink}"><span>{name}</span> <span>({count})</span> </a> </li>'); ?>
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