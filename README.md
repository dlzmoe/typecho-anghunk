# Typecho-Anghunk

Anghunk 是一款基于 Typecho 博客程序的主题，主打写作阅读体验，没有太过多余的色彩，简单而不失细节。

<!-- PROJECT LOGO -->
<br />

<p align="center">
  <a href="https://github.com/zburu/Anghunk/">
    <img src="https://oss.zburu.com/i/2022/10/19/634f4d9781a19.png" alt="Logo" width="300px">
  </a>
  <p align="center">
    一个优雅的 Typecho 主题模板。
    <br />
    <a href="https://github.com/zburu/Anghunk"><strong>探索本项目的文档 »</strong></a>
    <br />
    <br />
    <a href="typecho.zburu.com">查看Demo</a>
    ·
    <a href="https://github.com/zburu/Anghunk/issues">报告Bug</a>
    ·
    <a href="https://github.com/zburu/Anghunk/issues">提出新特性</a>
  </p>

</p>


本文档面向主题使用者和开发者。
 
## 目录

- [上手指南](#上手指南)
  - [开发前的配置要求](#开发前的配置要求)
  - [安装步骤](#安装步骤)
- [文件目录说明](#文件目录说明)
- [如何使用](#如何使用)
- [如何参与开源项目](#如何参与开源项目)
- [作者](#作者)
- [版权说明](#版权说明)

### 上手指南

常见报错可以查看 [Issues](https://github.com/zburu/Anghunk/issues)，我列出了一些部署过程中的问题和解决办法，并且如果你有问题也可以在 [Issues](https://github.com/zburu/Anghunk/issues) 提出，这里我会第一时间看到解决。


###### 开发前的配置要求

1. 服务器 php7.2 以上；
2. Typecho 1.1 最新可用版本，兼容1.1以下版本；

###### **安装步骤**

1. 下载仓库在本地，上传到 `/usr/themes/` 目录下，并把主题文件夹改名为 `Anghunk`，否则可能会出现一些未知的问题。

2. 在后台管理设置外观中进行基本配置。


### 文件目录说明
eg:

```shell
Anghunk 
├── component # 组件 
│  ├── ...
├── libs # 不常用的依赖文件
│  ├── # ...
├── css # 常用css
├── css # 常用js
├── README.md # 使用文档
├── # ...
```

### 如何使用？

###### 1.搜索功能

搜索功能默认，可下载 [ExSearch](https://github.com/AlanDecode/Typecho-Plugin-ExSearch) 插件使用，然后在后台>外观中，开启搜索。

>如果后台操作中报错，说明该插件在 typecho1.2 中不兼容，修改方案：将 `/plugins/ExSearch/Plugin.php` 的 `第276行` 注释掉，然后添加一行代码。

```php
// $widget = new $className(Typecho_Request::getInstance(), Typecho_Widget_Helper_Empty::getInstance());
$widget = $className::alloc();
```

###### 2. ip归属地显示

内置ip归属地显示功能，可选择开启或者关闭。

###### 3. 网站访客统计

内置网站访客统计功能，可选择开启或者关闭。

###### 4. 推荐使用插件

![1660873144108.png](https://oss.zburu.com/i/2022/08/19/62fee9b933083.png)


### 如何参与开源项目

贡献使开源社区成为一个学习、激励和创造的绝佳场所。你所作的任何贡献都是**非常感谢**的。

`fork` 后开发提交 pr。无功能上的 bug 即可合并，欢迎提交！


###### Star

[![Star History Chart](https://api.star-history.com/svg?repos=zburu/Anghunk&type=Date)](https://star-history.com/#zburu/Anghunk&Date)

### 作者

<a href="https://github.com/zburu" target="_blank"><img style="width:40px;border-radius:50%;" src="https://avatars.githubusercontent.com/u/65840178?v=4"></a>

 *您也可以在贡献者名单中参看所有参与该项目的开发者，无排名，按时间顺序。*
 
 <a href="https://www.emoao.com/" target="_blank"><img style="width:40px;border-radius:50%;" src="https://q2.qlogo.cn/g?b=qq&nk=2502393029&s=100"></a>

### 版权说明

该项目签署了MIT 授权许可，详情请参阅 [LICENSE.txt](https://github.com/zburu/Anghunk/blob/master/LICENSE.txt)


