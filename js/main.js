$(function(){
      // 代码高亮
    $("pre,pre code").addClass("prettyprint");
    prettyPrint();
  
    $('.content img').addClass('smallimg')
    $('.content img').wrap('<div class="imgbox"></div>')
    var obj = new zoom('mask', 'bigimg', 'smallimg');
    obj.init();
    
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
    
    
    var yiyan = '';
    $.ajax({
        url: 'https://api.emoao.com/api/scyy',
        type: 'get',
        dataType: 'json',
        withCredentials: true,
        async: false,
        success: function (data) {
            $.each(data, function (i, item) {
                list = item.hitokoto + "------" + item.hitokoto_from 
                yiyan += list;
            }),
            $("#yiyan").html(yiyan);
            // console.log('数据请求成功')
        },
      
        error: function () {
            console.log('数据请求失败')
        }
    })
    
})

