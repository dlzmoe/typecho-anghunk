<div class="comments">
    <hr>
    <h6>评论</h6>
    <div id="artalk"></div>
    
</div>
<script>
    new Artalk({
        el: "#artalk",
        pageKey:   '<?php $this->permalink() ?>',
        pageTitle: '<?php $this->title() ?>',
        server: 'https://artalk.imhan.cn/api',
        site: "不如吃茶去",
        placeholder: '说点什么...（支持markdown语法）',
        noComment: '「此时无声胜有声」',
        sendBtn: '提交评论',
        maxNesting: 2,
        gravatar: {
          mirror: 'https://cravatar.cn/avatar/',
          default: 'mp',
        },
        pagination: {
          pageSize: 15,   // 每页评论数
          readMore: true, // 加载更多 or 分页条
          autoLoad: true, // 自动加载 (加载更多)
        },
        heightLimit: {
          content: 200, // 评论内容限高
          children: 300, // 子评论区域限高
        },
        versionCheck: true, // 前端版本检测
        emoticons: "https://i.xiamuyourenzhang.cn/biaoqingbao.json",
    });

</script>
