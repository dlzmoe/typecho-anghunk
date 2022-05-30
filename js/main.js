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

  var codeblocks = document.getElementsByTagName("pre")
  //循环每个pre代码块，并添加 复制代码
  for (var i = 0; i < codeblocks.length; i++) {
    //显示 复制代码 按钮
    currentCode = codeblocks[i]
    currentCode.style = "position: relative;"
    var copy = document.createElement("div")
    copy.style = "position:absolute;right:2px;top:2px;background-color: white;padding:0px 12px;border-radius: 4px;cursor: pointer;box-shadow: 0 2px 4px rgba(0,0,0,0.05), 0 2px 4px rgba(0,0,0,0.05);"
    copy.innerHTML = "复制"
    currentCode.appendChild(copy)
    //让所有 "复制"按钮 全部隐藏
    // copy.style.visibility = "hidden"
  }
  for (var i = 0; i < codeblocks.length; i++) {
    !function (i) {
      //鼠标移到代码块，就显示按钮
      codeblocks[i].onmouseover = function () {
        codeblocks[i].childNodes[1].style.visibility = "visible"
      }
      //执行 复制代码 功能
      function copyArticle (event) {
        const range = document.createRange();
        //范围是 code，不包括刚才创建的div
        range.selectNode(codeblocks[i].childNodes[0]);
        const selection = window.getSelection();
        if (selection.rangeCount > 0) selection.removeAllRanges();
        selection.addRange(range);
        document.execCommand('copy');
        codeblocks[i].childNodes[1].innerHTML = "复制成功"
        setTimeout(function () {
          codeblocks[i].childNodes[1].innerHTML = "复制"
        }, 1000);
        //清除选择区
        if (selection.rangeCount > 0) selection.removeAllRanges(); 0
      }
      codeblocks[i].childNodes[1].addEventListener('click', copyArticle, false);
    }(i);
    !function (i) {
      //鼠标从代码块移开 则不显示复制代码按钮
    //   codeblocks[i].onmouseout = function () {
    //     codeblocks[i].childNodes[1].style.visibility = "hidden"
    //   }
    }(i);
  }
})
