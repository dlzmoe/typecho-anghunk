<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
    <footer class="footer">
	   <div>
        © 2020 -2022 · 
        <a href="https://beian.miit.gov.cn/" target="_blank">
          <span><?php $this->options->footerbeian(); ?></span>
        </a>
        · 网站运行: <span id="days">0</span> 天
      </div>
    </footer>
    <script src="<?php $this->options->themeUrl('/js/jquery3.6.0.js'); ?>"></script>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('/zoom/zoom.css'); ?>">
    <img src="" alt="" class="bigimg">
    <div class="mask"></div>
    <script src="<?php $this->options->themeUrl('/zoom/zoom.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('/js/main.js'); ?>"></script>
</body>
</html>
