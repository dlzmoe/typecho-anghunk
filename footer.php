<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<footer class="footer">
    <div>
        <p>网站运行: <span id="days">0</span> 天</p>
        <?php $options = Typecho_Widget::widget('Widget_Options');
            if ($options->fangke == '0') {
              echo ('<em>·</em><p>访客: ');
              echo (theAllViews());
              echo ('</p> ');
            } ?>
        
        <em>·</em>
        <p>加载速度: <?php echo timer_stop();?></p>
    </div>
    <div>
        <p>© 2020 - <?php echo date('Y'); ?>  <a href="https://beian.miit.gov.cn/" target="_blank"><span><?php $this->options->footerbeian(); ?></span></a></p>
        <em>·</em>
        <p><a href="/feed" target="_blank">Rss订阅</a> </p>
    </div>
    <div id="yiyan">
        <span id="hitokoto"></span> ------<span id="hitokoto_from"></span>
    </div>
    <div class="top">
        <i></i>
        <i></i>
    </div>
</footer>
<div>
    <script>
        var s0 = '<?php $this->options->footerbuild(); ?>';
  s1 = new Date(s0.replace(/-/g, "/"));
  s2 = new Date();
  var days = s2.getTime() - s1.getTime();
  var number_of_days = parseInt(days / (1000 * 60 * 60 * 24));
  document.getElementById('days').innerHTML = number_of_days;
    </script>
    <script src="<?php $this->options->themeUrl('/libs/js/jquery3.6.0.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('/libs/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('/libs/js/simplebox.min.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('/libs/js/toc.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('/js/main.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('/js/console.js'); ?>"></script>
    
    <?php $this->footer(); ?>
</div>

