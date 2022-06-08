<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;


/*
* 评论回复时 @ 评论人
*/
function get_comment_at($coid)
{
    $db   = Typecho_Db::get();
    $prow = $db->fetchRow($db->select('parent,status')->from('table.comments')
        ->where('coid = ?', $coid));
    $mail = "";
    $parent = @$prow['parent'];
    if ($parent != "0") {
        $arow = $db->fetchRow($db->select('author,status,mail')->from('table.comments')
            ->where('coid = ?', $parent));
        @$author = @$arow['author'];
        $mail = @$arow['mail'];
        if(@$author && $arow['status'] == "approved"){
            if (@$prow['status'] == "waiting"){
                echo '<p class="commentReview">（评论审核中）)</p>';
            }
            echo '<a href="#comment-' . $parent . '">@' . $author . '</a>';
        }else{
            if (@$prow['status'] == "waiting"){
                echo '<p class="commentReview">（评论审核中）)</p>';
            }else{
                echo '';
            }
        }

    } else {
        if (@$prow['status'] == "waiting"){
            echo '<p class="commentReview">（评论审核中）)</p>';
        }else{
            echo '';
        }
    }
}

/*
* 网站加载速度
*/
function timer_start() {
    global $timestart;
    $mtime     = explode( ' ', microtime() );
    $timestart = $mtime[1] + $mtime[0];
    return true;
}
timer_start();
function timer_stop( $display = 0, $precision = 3 ) {
    global $timestart, $timeend;
    $mtime     = explode( ' ', microtime() );
    $timeend   = $mtime[1] + $mtime[0];
    $timetotal = number_format( $timeend - $timestart, $precision );
    $r         = $timetotal < 1 ? $timetotal * 1000 . " ms" : $timetotal . " s";
    if ( $display ) {
        echo $r;
    }
    return $r;
}

/*
* 获取表情
*/
function parseBiaoQing() {
	$emo = false;
	global $emo;
	if(!$emo) {
		$emo = json_decode(file_get_contents(dirname(__FILE__).'/OwO.json'), true);
	}
	for ($i = 0; $i < count($emo); $i++) {
		$aa=array_keys($emo);
		$type=$emo[$aa[$i]]['type'];
        $num=count($emo[$aa[$i]]['container']);
		$emoo=$emo[$aa[$i]]['container'];
		
		$emootwo=$emo[$aa[$i]]['name'];
		
		
		$ename=$emo[$aa[$i]];
		if ($type==='image') {
			$ul=$ul.'<ul class="OwO-'.$ename['name'].'">'.summ($num,$type,$ename,$emoo,$emootwo).'</ul>';
		} else {
			$ul=$ul.'<ul class="OwO-'.$type.'">'.summ($num,$type,$ename,$emoo,$emootwo).'</ul>';
		}
		$divv=$divv.'<div class="OwO-bar-item">'.$aa[$i].'</div>';
		
	}
	$divvv='<div class="OwO-bar">'.$divv.'</div>';
	$divemo='<div class="OwO-emoji">'.$ul.'</div>';
	return $divvv.$divemo;
}

/*
* 获取具体表情
*/
function summ ($num,$type,$ename,$emo,$emootwo) {
    $emoaa="::".$emo[$j]['icon'].":".$emo[$j]['text']."::";
	if ($type==='image') {
		for ($j = 0; $j < $num; $j++) {
		    $emoaa="::".$emootwo.":".$emo[$j]['icon']."::";
			$dd=$dd.'<li class="OwO-item" data-title="'.$emoaa.'" title="'.$emo[$j]['text'].'"><img src="'.$emopath.'/usr/themes/Anghunk/libs/emotion/'.$ename['name'].'/'.$emo[$j]['icon'].'.png"></li>';
		}
		return $dd;
	} else {
		for ($j = 0; $j < $num; $j++) {
		      $emoaa="::".$emootwo.":".$emo[$j]['icon']."::";
			$dd=$dd.'<li class="OwO-item" data-title="'.$emoaa.'" title="'.$emo[$j]['text'].'">'.$emo[$j]['icon'].'</li>';
		}
		return $dd;
	}
}

/*
* 解析表情
*/
function getparseBiaoQing($content) {
	$emopath=$_SERVER['REQUEST_SCHEME'].":". DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $_SERVER['HTTP_HOST'];
	$emo = false;
	global $emo;
	if(!$emo) {
		$emo = json_decode(file_get_contents(dirname(dirname(dirname(__FILE__))).'/themes/Anghunk/OwO.json'), true);
	}
	foreach ($emo as $v) {
		if($v['type'] == 'image') {
			foreach ($v['container'] as $vv) {
				$emoaa="::".$v['name'].":".$vv['icon']."::";
				$content = str_replace($emoaa, '  <img style="max-height:40px;vertical-align:middle;" src="'.$emopath.'/usr/themes/Anghunk/libs/emotion/'.$v['name'].'/'.$vv['icon'] .'.png"  alt="'.$vv['text'] .'">  ', $content);
			}
		}
	}
	return $content;
}

/*
* ip归属地
*/
require_once("libs/ipdata.class.php");
function getiphome($ip) {
    $ip_info=convertips($ip);
    return $ip_info;
}

/*
* 无插件阅读数
*/
function get_post_view($archive)
{
  $cid = $archive->cid;
  $db = Typecho_Db::get();
  $prefix = $db->getPrefix();
  if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
    $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
    echo 0;
    return;
  }
  $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
  if ($archive->is('single')) {
    $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
  }
  echo $row['views'];
}

function allpostnum($id)
{
  $db = Typecho_Db::get();
  $postnum = $db->fetchRow($db->select(array('COUNT(authorId)' => 'allpostnum'))->from('table.contents')->where('table.contents.authorId=?', $id)->where('table.contents.type=?', 'post'));
  $postnum = $postnum['allpostnum'];
  return $postnum;
}

/*
* 总访问量
*/
function theAllViews()
{
  $db = Typecho_Db::get();
  $row = $db->fetchAll('SELECT SUM(VIEWS) FROM `typecho_contents`');
  echo number_format($row[0]['SUM(VIEWS)']);
}

/*
* 下一篇
*/
function getNextPost($archive)
{
    $db = Typecho_Db::get();
    $post = $db->fetchRow($db->select()->from('table.contents')->where('table.contents.created > ? AND table.contents.created < ?', $archive->created, Helper::options()->time)
        ->where('table.contents.status = ?', 'publish')
        ->where('table.contents.type = ?', $archive->type)
        ->where("table.contents.password IS NULL OR table.contents.password = ''")
        ->order('table.contents.created', Typecho_Db::SORT_ASC)
        ->limit(1));

    return $post;
}

/*
* 上一篇
*/
function getPrevPost($archive)
{
    $db = Typecho_Db::get();
    $post = $db->fetchRow($db->select()->from('table.contents')->where('table.contents.created < ?', $archive->created)
        ->where('table.contents.status = ?', 'publish')
        ->where('table.contents.type = ?', $archive->type)
        ->where("table.contents.password IS NULL OR table.contents.password = ''")
        ->order('table.contents.created', Typecho_Db::SORT_DESC)
        ->limit(1));
    return $post;
}

/*
* 那年今日
*/
function _getHistoryToday($created)
{
    $date = date('m/d', $created);
    $time = time();
    $db = Typecho_Db::get();
    $prefix = $db->getPrefix();
    $sql = "SELECT * FROM `{$prefix}contents` WHERE DATE_FORMAT(FROM_UNIXTIME(created), '%m/%d') = '{$date}' and created <= {$time} and created != {$created} and type = 'post' and status = 'publish' and (password is NULL or password = '') LIMIT 5";
    $result = $db->query($sql);
    if ($result instanceof Traversable) {
        foreach ($result as $item) {
            $item = Typecho_Widget::widget('Widget_Abstract_Contents')->push($item);
            $title = htmlspecialchars($item['title']);
            $permalink = $item['permalink'];
            echo "<ul class='alert alert-info nnjr'>
            <p>那年今日</p>
                    <li class='item'> - <a class='link' href='{$permalink}' title='{$title}'>{$title}</a></li>
                    </ul>
                ";
        }
    }
}

/*
* 后台管理配置
*/
function themeConfig($form){
  $headerimg = new Typecho_Widget_Helper_Form_Element_Text('headerimg', NULL, '', _t('网站左侧头像'), _t(''));
  $form->addInput($headerimg);
  
  $headertitle = new Typecho_Widget_Helper_Form_Element_Text('headertitle', NULL, 'Anghunk', _t('网站左侧标题'), _t(''));
  $form->addInput($headertitle);

  $bannerbg = new Typecho_Widget_Helper_Form_Element_Text('bannerbg', NULL, 'https://zburu.com/usr/themes/Anghunk/libs/css/theme-logo.png', _t('首页大图'), _t('在这里填入一个图片URL地址, 以在网站首页顶部显示一个背景图片，建议高度为宽度的1/2，达到一个合适的效果。'));
  $form->addInput($bannerbg);

  $bannertext = new Typecho_Widget_Helper_Form_Element_Textarea('bannertext', NULL, '七碗受至味，一壶得真趣，空持百千偈，不如吃茶去。 ---赵朴初', _t('首页描述的文字'), _t('在这里填入一段话，将会显示在首页大图的下方。'));
  $form->addInput($bannertext);

  $indexposts = new Typecho_Widget_Helper_Form_Element_Text('indexposts', NULL, NULL, _t('首页<全部文章>链接'), _t('填入你的归档页面链接，如： /posts'));
  $form->addInput($indexposts);
  
  $search = new Typecho_Widget_Helper_Form_Element_Radio('search', array(0 => _t('开启'), 1 => _t('关闭')), 1, _t('开启搜索'), _t('默认关闭，请安装 <a href="https://github.com/AlanDecode/Typecho-Plugin-ExSearch" target="_blank">ExSearch</a> 插件后再开启该设置。'));
  $form->addInput($search);

  $footerbeian = new Typecho_Widget_Helper_Form_Element_Text('footerbeian', NULL, NULL, _t('备案号'), _t('如果你的网站备案，请在这里填写备案号，否则请空着它。如：浙ICP备2022002453号-1'));
  $form->addInput($footerbeian);
  
  $baidutongji = new Typecho_Widget_Helper_Form_Element_Textarea('baidutongji', NULL, NULL, _t('百度统计代码'), _t('引入百度统计代码作为网站的pv统计方法。（不用加 script 标签）'));
  $form->addInput($baidutongji);

  $footerbuild = new Typecho_Widget_Helper_Form_Element_Text('footerbuild', NULL, '2020-06-14', _t('网站建立时间'), _t('格式如 2020-06-14'));
  $form->addInput($footerbuild);
  
  $iphome = new Typecho_Widget_Helper_Form_Element_Radio('iphome', array(0 => _t('开启'), 1 => _t('关闭')), 1, _t('评论区IP归属地开关'));
  $form->addInput($iphome);
  

}

