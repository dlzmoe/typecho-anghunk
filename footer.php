<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<footer class="footer">
    <div class="container">
        <div>
            <p>网站运行: <span id="days">0</span> 天</p>
            <em>·</em>
            <p>访客总人数：<?php echo theAllViews();?></p>
            <em>·</em>
            <p>加载速度: <?php echo timer_stop();?></p>
        </div>
        <div>
            <p>© 2020 -2022  <a href="https://beian.miit.gov.cn/" target="_blank"><span><?php $this->options->footerbeian(); ?></span></a></p>
            <em>·</em>
            <p><a href="/feed" target="_blank">Rss订阅</a> </p>
        </div>

    </div>
    <div id="yiyan">
        <span id="hitokoto"></span> ------<span id="hitokoto_from"></span>
    </div>
    <div class="top">
        <i></i>
        <i></i>
    </div>
    <div class="pjax-loading"></div>

</footer>
<div>
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
    <script src="<?php $this->options->themeUrl('/js/pre.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('/js/main.js'); ?>"></script>
    <script src="https://cdn.imhan.cn/list/pjax.min.js"></script>
    <script>
        var pjax = new Pjax({
          selectors: [
            'title',
            'body',
          ],
          cacheBust: false
        })
        function pjax_reload(){
            var comment = document.getElementById("comments");
        }
        
        document.addEventListener('pjax:send', function (){
            document.querySelector(".pjax-loading").classList.add("active");
        });
        document.addEventListener('pjax:complete', function (){
            document.querySelector(".pjax-loading").classList.remove("active");
            pjax_reload(); 
        });
    </script>
    <?php $this->footer(); ?>
</div>

