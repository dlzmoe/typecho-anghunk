$(function(){
      // 代码高亮
  $("pre,pre code").addClass("prettyprint");
  prettyPrint();
  
    $('.content img').addClass('smallimg')
    $('.content img').wrap('<div class="imgbox"></div>')
    $('.atk-content img').addClass('smallimg')
    $('.atk-content img').wrap('<div class="imgbox"></div>')
    var obj = new zoom('mask', 'bigimg', 'smallimg');
    obj.init();
    
    $("#autoMenu").autoMenu({
        levelOne : 'h2', //一级标题
        levelTwo : 'h3',  //二级标题（暂不支持更多级）
        offTop : 100 //滚动切换导航时离顶部的距离
    });
    
    $('.top').on('click',function () {
            $("html, body").animate({scrollTop: 0 }, {duration: 500,easing: "swing"});
            return false;
    });
    //绑定页面滚动事件
    $(window).bind('scroll',function(){
        var len=$(this).scrollTop();
        if(len>=100){
            //显示回到顶部按钮
            $('.top').fadeIn('1000');
        }else{
            //影藏回到顶部按钮
            $('.top').fadeOut('1000');
        }
    });
    
    $('.atk-main-editor>.atk-bottom>.atk-plug-btn-wrap').append('<span class="atk-plug-btn to-imgurl">上传图片</span>')
    $('.to-imgurl').click(function(){
        window.open("https://www.imgurl.org/", '_blank');
    })
    
})

