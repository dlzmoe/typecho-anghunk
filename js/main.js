$(function () {
  $('.content a').attr('target', '_blank')

  // 代码高亮
  $("pre,pre code").addClass("prettyprint");
  prettyPrint();

  // 图片灯箱事件
  $('.content img').addClass('slb ')
  $('.slb').simplebox({ fadeSpeed: 400 });

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
  for (var i = 0; i < codeblocks.length; i++) {
    currentCode = codeblocks[i]
    currentCode.style = "position: relative;"
    var copy = document.createElement("div")
    copy.style = "position:absolute;right:2px;top:2px;background-color: white;padding:0px 12px;border-radius: 4px;cursor: pointer;box-shadow: 0 2px 4px rgba(0,0,0,0.05), 0 2px 4px rgba(0,0,0,0.05);"
    copy.innerHTML = "复制"
    currentCode.appendChild(copy)
  }
  for (var i = 0; i < codeblocks.length; i++) {
    !function (i) {
      codeblocks[i].onmouseover = function () {
        codeblocks[i].childNodes[1].style.visibility = "visible"
      }
      function copyArticle (event) {
        const range = document.createRange();
        range.selectNode(codeblocks[i].childNodes[0]);
        const selection = window.getSelection();
        if (selection.rangeCount > 0) selection.removeAllRanges();
        selection.addRange(range);
        document.execCommand('copy');
        codeblocks[i].childNodes[1].innerHTML = "复制成功"
        setTimeout(function () {
          codeblocks[i].childNodes[1].innerHTML = "复制"
        }, 1000);
        if (selection.rangeCount > 0) selection.removeAllRanges(); 0
      }
      codeblocks[i].childNodes[1].addEventListener('click', copyArticle, false);
    }(i);
    !function (i) {
    }(i);
  }
  $('.bq-list .OwO-bar-item:nth-child(1)').addClass('active')
  $('.OwO-emoji ul:nth-child(1)').addClass('active-txt')
  $(".bq-list .OwO-bar-item").each(function (index) {
    $(this).click(function () {
      $(".OwO-bar-item.active").removeClass("active");
      $(this).addClass("active");
      $(".OwO-emoji ul.active-txt").removeClass("active-txt");
      $(".OwO-emoji ul").eq(index).addClass("active-txt");
    });
  })


  jQuery.fn.extend({
    insertAtCaret: function (myValue) {
      return this.each(function (i) {
        if (document.selection) {
          //For browsers like Internet Explorer
          this.focus();
          var sel = document.selection.createRange();
          sel.text = myValue;
          this.focus();
        }
        else if (this.selectionStart || this.selectionStart == '0') {
          //For browsers like Firefox and Webkit based
          var startPos = this.selectionStart;
          var endPos = this.selectionEnd;
          var scrollTop = this.scrollTop;
          this.value = this.value.substring(0, startPos) + myValue + this.value.substring(endPos, this.value.length);
          this.focus();
          this.selectionStart = startPos + myValue.length;
          this.selectionEnd = startPos + myValue.length;
          this.scrollTop = scrollTop;
        } else {
          this.value += myValue;
          this.focus();
        }
      });
    }
  });

  $(".bq-list ul li").each(function (index) {
    $(this).click(function () {
      var txt = $(".bq-list ul li").eq(index).attr("data-title")
      $("#textarea").insertAtCaret(txt)
    });
  })
  


})


