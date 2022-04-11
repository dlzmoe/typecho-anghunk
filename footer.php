<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
    <footer class="footer">
	   <div class="container">
        <p>
            © 2020 -2022  <a href="https://beian.miit.gov.cn/" target="_blank">
              <span><?php $this->options->footerbeian(); ?></span>
            </a>
        </p>
        <em>·</em>
        <p>
            网站运行: <span id="days">0</span> 天
        </p>
        <em>·</em>
        <p>
            访客总人数：<?php echo theAllViews();?>
        </p>
      </div>
    </footer>
    <script>
        var s1 = '<?php $this->options->footerbuild(); ?>';
        s1 = new Date(s1.replace(/-/g, "/"));
        s2 = new Date();
        var days = s2.getTime() - s1.getTime();
        var number_of_days = parseInt(days / (1000 * 60 * 60 * 24));
        document.getElementById('days').innerHTML = number_of_days;
    </script>
    <script src="<?php $this->options->themeUrl('/js/jquery3.6.0.js'); ?>"></script>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('/css/zoom.css'); ?>">
    <img src="" alt="" class="bigimg">
    <div class="mask"></div>
    <script src="<?php $this->options->themeUrl('/js/zoom.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('/js/toc.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('/js/main.js'); ?>"></script>
</body>
</html>