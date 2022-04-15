## Typecho-theme-Anghunk

![](./css/theme-logo.png)

Anghunk一款基于Typecho博客程序的主题，简单整洁是主色调。

演示网址: [https://imhan.cn](https://imhan.cn)

仓库地址: [https://github.com/anghunk/Typecho-theme-Anghunk](https://github.com/anghunk/Typecho-theme-Anghunk)

评论使用artalk，你也可以选择在 `comments.php` 文件中替换成typecho原生评论。

> [如何部署 artalk ?](https://artalk.js.org/) 


## 如何使用

### 1

下载仓库在本地，上传到 `/usr/themes/`，并把主题文件夹改名为 `Anghunk`，否则可能会出现一些未知的问题。

基本配置项目在后台管理设置。

如果在部署主题过程出现bug，请提[Issues](https://github.com/anghunk/Typecho-theme-Anghunk/issues)，我会在最快时间内解决。

### 2

关于搜索功能，建议搭配 `ExSearch` 插件使用，后台启用后，将 `/themes/Anghunk/header.php` 文件中 `第31行`的注释取消即可。

>如果后台操作中报错，说明该插件在 typecho1.2 中不兼容，修改方案：将 `/plugins/ExSearch/Plugin.php` 的 `第276行` 注释掉，然后添加一行代码。

```php
// $widget = new $className(Typecho_Request::getInstance(), Typecho_Widget_Helper_Empty::getInstance());
$widget = $className::alloc();
```

## 图片展示

图片更新不及时，请进入上面的[演示网址](https://imhan.cn)，查看最新的主题。

## LICENSE

[LICENSE](./LICENSE)

[作者: Anghunk](https://imhan.cn)
