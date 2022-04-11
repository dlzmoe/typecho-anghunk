<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

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
* 后台管理配置
*/
function themeConfig($form)
{
    $headertitle = new Typecho_Widget_Helper_Form_Element_Text('headertitle', NULL, 'Anghunk', _t('网站左侧标题'), _t(''));
    $form->addInput($headertitle);
    
    $bannerbg = new Typecho_Widget_Helper_Form_Element_Text('bannerbg', NULL, 'https://imhan.cn/usr/themes/Anghunk/screenshot.png', _t('首页大图'), _t('在这里填入一个图片URL地址, 以在网站首页顶部显示一个背景图片，建议高度为宽度的1/2，达到一个合适的效果。'));
    $form->addInput($bannerbg);

    $bannertext = new Typecho_Widget_Helper_Form_Element_Textarea('bannertext', NULL, '七碗受至味，一壶得真趣，空持百千偈，不如吃茶去。 ---赵朴初', _t('首页描述的文字'), _t('在这里填入一段话，将会显示在首页'));
    $form->addInput($bannertext);
    
    $footerbeian = new Typecho_Widget_Helper_Form_Element_Text('footerbeian', NULL, NULL, _t('备案号'), _t('如果你的网站备案，请在这里填写备案号，否则请空着它。'));
    $form->addInput($footerbeian);
    
    $footerbuild = new Typecho_Widget_Helper_Form_Element_Text('footerbuild', NULL, '2020-06-14', _t('网站建立时间'), _t('格式如 2020-06-14'));
    $form->addInput($footerbuild);
}
