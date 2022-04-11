$(function(){
    
    
    
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
    
})

