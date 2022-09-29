<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE html>
<html lang="zh">

<head>
	<meta charset="<?php $this->options->charset(); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<meta name="renderer" content="webkit">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="shortcut icon" href="<?php $this->options->favicon(); ?>" />
	<title><?php $this->archiveTitle(array(
						'category'  =>  _t('分类 %s 下的文章'),
						'search'    =>  _t('包含关键字 %s 的文章'),
						'tag'       =>  _t('标签 %s 下的文章'),
						'author'    =>  _t('%s 发布的文章')
					), '', ' - '); ?><?php $this->options->title(); ?></title>
	<link rel="stylesheet" href="<?php $this->options->themeUrl('/libs/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php $this->options->themeUrl('/libs/css/simplebox.min.css'); ?>">
	<link rel="stylesheet" href="<?php $this->options->themeUrl('/css/style.css'); ?>">
	<?php $this->header(); ?>
	<?php $this->options->baidutongji(); ?>
</head>

<body>
	<div class="home">
		<header class="header">
			<div class="sidebar">
				<div class="site-header">
					<a id="logo" href="<?php $this->options->siteUrl(); ?>">
						<img src="<?php $this->options->headerimg(); ?>" alt="author">
						<span><?php $this->options->headertitle(); ?></span>
					</a>
				</div>
				<?php $this->need('component/sidebar.php'); ?>
			</div>
		</header>