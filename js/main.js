$(function () {
  $('.content a').attr('target', '_blank')

  // 代码高亮
  $("pre,pre code").addClass("prettyprint");
  prettyPrint();

  // 图片灯箱事件
  $('.content img').addClass('smallimg')
  $('.content img').wrap('<div class="imgbox"></div>')
  var obj = new zoom('mask', 'bigimg', 'smallimg');
  obj.init();

  //绑定页面滚动事件
  $('.top').on('click', function () {
    $("html, body").animate({ scrollTop: 0 }, { duration: 500, easing: "swing" });
    return false;
  });
  $(window).bind('scroll', function () {
    var len = $(this).scrollTop();
    if (len >= 100) {
      $('.top').fadeIn('1000');
    } else {
      $('.top').fadeOut('1000');
    }
  });

  // 底部随机诗词
  $.ajax({
    url: 'https://api.emoao.com/api/yy?type=sc',
    type: 'get',
    success: function (data) {
      $('#hitokoto').html(data.hitokoto);
      $('#hitokoto_from').html(data.hitokoto_from);
    },
    error: function (data) {
      console.log('error', data);
    }
  })

})
