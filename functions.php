<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

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

/** 获取评论者地址 */
function convertips($ip) {
	$ip1num = 0;
	$ip2num = 0;
	$ipAddr1 ="";
	$ipAddr2 ="";
	$dat_path = dirname(__FILE__).'/libs/qqwry.dat';
	if(!preg_match("/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/", $ip)) {
		return 'IPV6无法获取归宿地';
	}
	if(!$fd = @fopen($dat_path, 'rb')) {
		return 'IP 数据库路径不正确';
	}
	$ip = explode('.', $ip);
	$ipNum = $ip[0] * 16777216 + $ip[1] * 65536 + $ip[2] * 256 + $ip[3];
	$DataBegin = fread($fd, 4);
	$DataEnd = fread($fd, 4);
	$ipbegin = implode('', unpack('L', $DataBegin));
	if($ipbegin < 0) $ipbegin += pow(2, 32);
	$ipend = implode('', unpack('L', $DataEnd));
	if($ipend < 0) $ipend += pow(2, 32);
	$ipAllNum = ($ipend - $ipbegin) / 7 + 1;
	$BeginNum = 0;
	$EndNum = $ipAllNum;
	while($ip1num>$ipNum || $ip2num<$ipNum) {
		$Middle= intval(($EndNum + $BeginNum) / 2);
		fseek($fd, $ipbegin + 7 * $Middle);
		$ipData1 = fread($fd, 4);
		if(strlen($ipData1) < 4) {
			fclose($fd);
			return 'System Error';
		}
		$ip1num = implode('', unpack('L', $ipData1));
		if($ip1num < 0) $ip1num += pow(2, 32);
		if($ip1num > $ipNum) {
			$EndNum = $Middle;
			continue;
		}
		$DataSeek = fread($fd, 3);
		if(strlen($DataSeek) < 3) {
			fclose($fd);
			return 'System Error';
		}
		$DataSeek = implode('', unpack('L', $DataSeek.chr(0)));
		fseek($fd, $DataSeek);
		$ipData2 = fread($fd, 4);
		if(strlen($ipData2) < 4) {
			fclose($fd);
			return 'System Error';
		}
		$ip2num = implode('', unpack('L', $ipData2));
		if($ip2num < 0) $ip2num += pow(2, 32);
		if($ip2num < $ipNum) {
			if($Middle == $BeginNum) {
				fclose($fd);
				return 'Unknown';
			}
			$BeginNum = $Middle;
		}
	}
	$ipFlag = fread($fd, 1);
	if($ipFlag == chr(1)) {
		$ipSeek = fread($fd, 3);
		if(strlen($ipSeek) < 3) {
			fclose($fd);
			return 'System Error';
		}
		$ipSeek = implode('', unpack('L', $ipSeek.chr(0)));
		fseek($fd, $ipSeek);
		$ipFlag = fread($fd, 1);
	}
	if($ipFlag == chr(2)) {
		$AddrSeek = fread($fd, 3);
		if(strlen($AddrSeek) < 3) {
			fclose($fd);
			return 'System Error';
		}
		$ipFlag = fread($fd, 1);
		if($ipFlag == chr(2)) {
			$AddrSeek2 = fread($fd, 3);
			if(strlen($AddrSeek2) < 3) {
				fclose($fd);
				return 'System Error';
			}
			$AddrSeek2 = implode('', unpack('L', $AddrSeek2.chr(0)));
			fseek($fd, $AddrSeek2);
		} else {
			fseek($fd, -1, SEEK_CUR);
		}
		while(($char = fread($fd, 1)) != chr(0))  
		    $ipAddr2 .= $char;
		$AddrSeek = implode('', unpack('L', $AddrSeek.chr(0)));
		fseek($fd, $AddrSeek);
		while(($char = fread($fd, 1)) != chr(0))  
		    $ipAddr1 .= $char;

	} else {
		fseek($fd, -1, SEEK_CUR);
		while(($char = fread($fd, 1)) != chr(0))  
		    $ipAddr1 .= $char;
		$ipFlag = fread($fd, 1);
		if($ipFlag == chr(2)) {
			$AddrSeek2 = fread($fd, 3);
			if(strlen($AddrSeek2) < 3) {
				fclose($fd);
				return 'System Error';
			}
			$AddrSeek2 = implode('', unpack('L', $AddrSeek2.chr(0)));
			fseek($fd, $AddrSeek2);
		} else {
			fseek($fd, -1, SEEK_CUR);
		}
		while(($char = fread($fd, 1)) != chr(0)) {
			$ipAddr2 .= $char;
		}
	}
	fclose($fd);
	if(preg_match('/http/i', $ipAddr2)) {
		$ipAddr2 = '';
	}
	$ipaddr = "$ipAddr1";
	$ipaddr = preg_replace('/CZ88.NET/is', '', $ipaddr);
	$ipaddr = preg_replace('/^s*/is', '', $ipaddr);
	$ipaddr = preg_replace('/s*$/is', '', $ipaddr);
	if(preg_match('/http/i', $ipaddr) || $ipaddr == '') {
		$ipaddr = '可能来自火星';
	}
	$ipaddr = iconv('gbk', 'utf-8//IGNORE', $ipaddr);

	return $ipaddr;
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
* 后台管理配置
*/
function themeConfig($form){
  $headertitle = new Typecho_Widget_Helper_Form_Element_Text('headertitle', NULL, 'Anghunk', _t('网站左侧标题'), _t(''));
  $form->addInput($headertitle);

  $bannerbg = new Typecho_Widget_Helper_Form_Element_Text('bannerbg', NULL, 'https://imhan.cn/usr/themes/Anghunk/css/theme-logo.png', _t('首页大图'), _t('在这里填入一个图片URL地址, 以在网站首页顶部显示一个背景图片，建议高度为宽度的1/2，达到一个合适的效果。'));
  $form->addInput($bannerbg);

  $bannertext = new Typecho_Widget_Helper_Form_Element_Textarea('bannertext', NULL, '七碗受至味，一壶得真趣，空持百千偈，不如吃茶去。 ---赵朴初', _t('首页描述的文字'), _t('在这里填入一段话，将会显示在首页大图的下方。'));
  $form->addInput($bannertext);

  $indexposts = new Typecho_Widget_Helper_Form_Element_Text('indexposts', NULL, NULL, _t('首页<全部文章>链接'), _t('填入你的归档页面链接，如： /posts'));
  $form->addInput($indexposts);

  $footerbeian = new Typecho_Widget_Helper_Form_Element_Text('footerbeian', NULL, NULL, _t('备案号'), _t('如果你的网站备案，请在这里填写备案号，否则请空着它。如：浙ICP备2022002453号-1'));
  $form->addInput($footerbeian);
  
  $baidutongji = new Typecho_Widget_Helper_Form_Element_Textarea('baidutongji', NULL, NULL, _t('百度统计代码'), _t('引入百度统计代码作为网站的pv统计方法。（不用加 script 标签）'));
  $form->addInput($baidutongji);

  $footerbuild = new Typecho_Widget_Helper_Form_Element_Text('footerbuild', NULL, '2020-06-14', _t('网站建立时间'), _t('格式如 2020-06-14'));
  $form->addInput($footerbuild);
  
}
