## Typecho-theme-Anghunk

![](./libs/css/theme-logo.png)

>Anghunk 是一款基于 Typecho 博客程序的主题，主打写作阅读体验，没有太过多余的色彩，简单而不失细节，已经进入 2.0 版本。

演示网址: [https://zburu.com](https://zburu.com)

仓库地址: [https://github.com/zburu/Anghunk](https://github.com/zburu/Anghunk)

常见报错可以查看 [Issues](https://github.com/zburu/Anghunk/issues)，我列出了一些部署过程中的问题和解决办法，并且如果你有问题也可以在 [Issues](https://github.com/zburu/Anghunk/issues) 提出，这里我会第一时间看到解决。

## 💡 如何使用

### 1.下载文件

下载仓库在本地，上传到 `/usr/themes/`，并把主题文件夹改名为 `Anghunk`，否则可能会出现一些未知的问题。

在后台管理设置外观中进行基本配置。

建议在后台 `设置 > 阅读` 中，将 `每页文章数目` 设置为20，以获得最佳阅读体验。

### 2.搜索功能

搜索功能默认，可下载 [ExSearch](https://github.com/AlanDecode/Typecho-Plugin-ExSearch) 插件使用，然后在后台>外观中，开启搜索。

>如果后台操作中报错，说明该插件在 typecho1.2 中不兼容，修改方案：将 `/plugins/ExSearch/Plugin.php` 的 `第276行` 注释掉，然后添加一行代码。

```php
// $widget = new $className(Typecho_Request::getInstance(), Typecho_Widget_Helper_Empty::getInstance());
$widget = $className::alloc();
```

### 3. ip归属地显示

内置ip归属地显示功能，可选择开启或者关闭。

## 🎓 图片展示

图片更新不及时，请进入[演示网址](https://zburu.com)，查看最新的主题。

## 👑 Contributors 

<a href="https://github.com/zburu" target="_blank"><img style="width:40px;border-radius:50%;" src="https://avatars.githubusercontent.com/u/65840178?v=4"></a>
<a href="https://www.emoao.com/" target="_blank"><img style="width:40px;border-radius:50%;" src="https://q2.qlogo.cn/g?b=qq&nk=2502393029&s=100"></a>

## ❄️ LICENSE

[LICENSE](./LICENSE)

[Author: 子舒](https://zburu.com)

特别感谢: [梦繁星](https://www.emoao.com/)

## 📝 Star History

[![Star History Chart](https://api.star-history.com/svg?repos=zburu/Anghunk&type=Date)](https://star-history.com/#zburu/Anghunk&Date)