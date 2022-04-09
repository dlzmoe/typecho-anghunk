$(function(){
    
    var s1 = '2020-06-14';
    s1 = new Date(s1.replace(/-/g, "/"));
    s2 = new Date();
    var days = s2.getTime() - s1.getTime();
    var number_of_days = parseInt(days / (1000 * 60 * 60 * 24));
    document.getElementById('days').innerHTML = number_of_days;
    
    $('.content img').addClass('smallimg')
    $('.content img').wrap('<div class="imgbox"></div>')
    $('.atk-content img').addClass('smallimg')
    $('.atk-content img').wrap('<div class="imgbox"></div>')
    var obj = new zoom('mask', 'bigimg', 'smallimg');
    obj.init();
})

