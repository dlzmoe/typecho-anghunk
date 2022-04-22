## Typecho-theme-Anghunk

![](./css/theme-logo.png)

Anghunk一款基于Typecho博客程序的主题，简单整洁是主色调。

演示网址: [https://imhan.cn](https://imhan.cn)

仓库地址: [https://github.com/anghunk/Typecho-theme-Anghunk](https://github.com/anghunk/Typecho-theme-Anghunk)

~~评论使用artalk，你也可以选择在 `comments.php` 文件中替换成typecho原生评论。~~ 为了维护方便，重新使用typecho原生评论。

> ~~[如何部署 artalk ?](https://artalk.js.org/)~~

>常见报错可以查看 [Issues](https://github.com/anghunk/Typecho-theme-Anghunk/issues)，我列出了一些部署过程中的问题和解决办法，并且如果你有问题也可以在[Issues](https://github.com/anghunk/Typecho-theme-Anghunk/issues)提出，这里我会第一时间看到解决。


## 如何使用

### 1.下载文件

下载仓库在本地，上传到 `/usr/themes/`，并把主题文件夹改名为 `Anghunk`，否则可能会出现一些未知的问题。

基本配置项目在后台管理设置。

### 2.搜索功能

关于搜索功能，建议搭配 `ExSearch` 插件使用，如果你打算添加搜索功能，请在 `/themes/Anghunk/header.php` 文件中 `第32行`的注释取消即可。

>如果后台操作中报错，说明该插件在 typecho1.2 中不兼容，修改方案：将 `/plugins/ExSearch/Plugin.php` 的 `第276行` 注释掉，然后添加一行代码。

```php
// $widget = new $className(Typecho_Request::getInstance(), Typecho_Widget_Helper_Empty::getInstance());
$widget = $className::alloc();
```

### 3.pjax

主题新增了pjax技术，放置在`footer.php`底部，如果与后续新增的脚本冲突，参照写法，重新调用脚本。

```js
var pjax = new Pjax({
  selectors: [
    "title",
    'body'
  ],
  cacheBust: false
})

// 重新执行artalk引入的脚本。
function pjax_reload(){
    var comment = document.getElementById("comments");
}
document.addEventListener('pjax:send', function (){ // pjax 开始时
    document.querySelector(".pjax-loading").classList.add("active"); // loading动画开始
});
document.addEventListener('pjax:complete', function (){ // pjax 结束时
    document.querySelector(".pjax-loading").classList.remove("active"); // loading动画结束
    pjax_reload(); // 脚本执行
});
```

## 图片展示

图片更新不及时，请进入上面的[演示网址](https://imhan.cn)，查看最新的主题。

## LICENSE

[LICENSE](./LICENSE)

[作者: Anghunk](https://imhan.cn)
