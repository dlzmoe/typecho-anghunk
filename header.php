<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="<?php $this->options->themeUrl('/favicon.ico'); ?>" />
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('/css/pre.css'); ?>">
    <!--artalk 可删除-->
        <link href="https://cdn.jsdelivr.net/npm/artalk@2.2.2/dist/Artalk.css" rel="stylesheet">
        <link href="https://cdn.imhan.cn/list/artalk_anghunk.css" rel="stylesheet" />
        <script src="https://cdn.imhan.cn/list/artalk.min.js"></script>
        <!--<script src="https://cdn.jsdelivr.net/npm/artalk@2.1.8/dist/Artalk.js"></script>-->
    <!--artalk 可删除-->
    <?php $this->header(); ?>
</head>
<body>
  <div class="home">
    <header class="header">
      <div class="site-header">
          <a id="go-back-home" href="<?php $this->options->siteUrl(); ?>"><?php $this->options->headertitle(); ?></a>
          <nav id="nav-menu">
            <ul class="topNav-items">
                <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                <?php while($pages->next()): ?>
                    <li class="menu-item<?php if($this->is('page', $pages->slug)): ?> current-menu-item<?php endif; ?>"><a href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a></li>
                <?php endwhile; ?>
                <li class="menu-item"><a class="search-form-input">Search</a></li>
            </ul>
          </nav>
          <div class="autoMenu" id="autoMenu" data-autoMenu></div>
      </div>
    </header>
   