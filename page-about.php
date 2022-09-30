<?php

/**
 * 关于
 *
 * @package custom
 */

$this->need('header.php'); ?>
<div class="main">
  <?php $this->need('component/nav.php'); ?>
  <div class="container">
    <div class="main-content">
      <div class="content" itemprop="articleBody">
        <?php $this->content(); ?>
      </div>
    </div>
  </div>
  <div class="container">
    <?php $this->need('component/footer.php'); ?>
  </div>
</div>
</body>

</html>