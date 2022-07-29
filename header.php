<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE html>
<html class="zh_CN">
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
    <link rel="stylesheet" href="<?php $this->options->themeUrl('/libs/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('/css/ui.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('/libs/css/simplebox.min.css'); ?>">
    <?php $this->header(); ?>
    <script><?php $this->options->baidutongji(); ?></script>
</head>
<body>
    <header class="header">
      <div class="site-header">
          <a id="logo" href="<?php $this->options->siteUrl(); ?>">
             <?php $this->options->headertitle(); ?>
          </a>
          
           <nav id="nav-menu">
            <ul class="topNav-items">
                <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                <?php while($pages->next()): ?>
                    <li class="menu-item<?php if($this->is('page', $pages->slug)): ?> current-menu-item<?php endif; ?>"><a href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a></li>
                <?php endwhile; ?>
                <?php $options = Typecho_Widget::widget('Widget_Options');
                    if ($options->search == '0') {
                      echo ('<li class="menu-item"><a class="search-form-input" href="#">Search</a></li>');
                    } ?>
            </ul>
          </nav>
          
          
          <div class="dropdown m-menu-nav">
              <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">menu</a>
              
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                <?php while($pages->next()): ?>
                    <a class="dropdown-item" href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a>
                <?php endwhile; ?>
                <?php $options = Typecho_Widget::widget('Widget_Options');
                    if ($options->search == '0') {
                      echo ('<a class="search-form-input dropdown-item" href="#">Search</a>');
                    } ?>
            </ul>
            
             
            </div>
      </div>
    </header>
  <div class="home">

   