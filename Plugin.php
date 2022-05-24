<?php

namespace TypechoPlugin\IPhome;

use Typecho\Plugin\PluginInterface;
use Typecho\Widget\Helper\Form;
use Typecho\Widget\Helper\Form\Element\Text;
use Typecho\Widget\Helper\Form\Element\Checkbox;
use Typecho\Widget\Helper\Form\Element\Radio;
use Typecho\Widget\Helper\Layout;
use Widget\Options;
use Widget\Base\Comments;

if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}
require_once("libs/ipdata.class.php");

/**
 * 获取评论人IP归属地信息
 * 
 * @package IPhome
 * @author 梦繁星
 * @version 1.0.0
 * @link
 */
class Plugin implements PluginInterface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     */
    public static function activate() {
    	return _t('插件安装成功,请在需要显示IP归属地信息的位置插入嵌入点代码!!!');
    }

    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     */
    public static function deactivate() {
    	return _t('插件禁用成功!');
    }

    /**
     * 获取插件配置面板
     * @param Form $form 配置面板
     */
    public static function config(Form $form) {
    	//选择查询方式
    	$ipInterface = new Radio('ipInterface', array('0' => _t('纯真本地库'), '1' => _t('高德API'),'2' => _t('腾讯API'),), '0', _t('查询方式'), _t('默认启用纯真数据库查询，选择其他API接口需要在下方输入对应token！'));
    	$form->addInput($ipInterface);
    	//接口token
    	$token = new Text('token', null, '', _t('接口token'),_t('请填写对应接口token！</br>纯真本地库无需填写token！</br>请前往对应接口开发者平台注册，获取应用token！</br>高德API获取地址：<a href="https://lbs.amap.com/">https://lbs.amap.com/</a></br>腾讯API获取地址：<a href="https://lbs.qq.com/">https://lbs.qq.com/</a></br></br><strong style="color:red;">注：纯真本地库和高德不支持IPv6</strong></br>请在需要显示IP归属地信息的位置插入下方嵌入点代码:</br><code style="padding: 2px 4px; font-size: 90%; color: #c7254e; background-color: #f9f2f4; border-radius: 4px;">&lt;?php IPhome_Plugin::get_IPhome($comments->ip); ?&gt;</code>'));
    	$form->addInput($token);
    }

    /**
     * 个人用户的配置面板
     *
     * @param Form $form
     */
    public static function personalConfig(Form $form) {
    }

    /**
     * 获取位置信息
     * @access public
     * @param $ip => $comments->ip
     * @return 返回对应IP的位置信息
     */		
    public static function get_loc($ip,$key,$type) {
    	switch ($type) {
    		case '1':
    		//高德接口
    		$url = "http://restapi.amap.com/v3/ip?key=" . $key . "&ip=" . $ip;
    		break;
    		case '2':
    		//腾讯接口
    		$url = "https://apis.map.qq.com/ws/location/v1/ip?key=".$key."&ip=".$ip;
    		break;
    		default:
    		break;
    	}
    	try {
    		$UserAgent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; .NET CLR 3.5.21022; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
    		$curl = curl_init();
    		curl_setopt($curl, CURLOPT_URL, $url);
    		curl_setopt($curl, CURLOPT_HEADER, 0);
    		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    		curl_setopt($curl, CURLOPT_ENCODING, '');
    		curl_setopt($curl, CURLOPT_USERAGENT, $UserAgent);
    		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    		$data = curl_exec($curl);
    		$data = json_decode($data, true);
    		if($type=='1' & !empty($data['province'])) {
    			$province =isset($data['province']) ? $data['province'] : "未知";
    			//省
    			$city = isset($data['city']) ? $data['city'] : "未知";
    			//市
    			$country='中国';
    		} else if($type=='2'& !empty($data['result']['ad_info']['province'])) {
    			$province = isset($data['result']['ad_info']['province']) ? $data['result']['ad_info']['province'] : "未知";
    			//省
    			$city = isset($data['result']['ad_info']['city']) ? $data['result']['ad_info']['city'] : "未知";
    			//市
    			$country='中国';
    		} else {
    			$province='未知';
    			$city='未知';
    			$country='未知';
    		}
    	}
    	catch (Exception $e) {
    		$msg = 'token错误，无法获取IP信息!';
    		return $msg;
    	}
    	$array = array(
    	            "country" => $country,
    	            "province" => $province,
    	            "city"  => $city
    	        );
    	return $array;
    }
	
	/**
     * 嵌入点,输出信息
     * @access public
     * @param  $ip => $comments->ip
     * @return void
     */	
    public static function get_IPhome($ip) {
    	$options = Options::alloc();
    	if (!isset($options->plugins['activated']['IPhome'])) {
    		echo('IPhome插件未激活');
    	} else {
    		$IPhome = $options->plugin('IPhome');
    		$key=$IPhome->token;
    		$type=$IPhome->ipInterface;
    		//显示IP位置信息
    		if ($type=='1' || $type=='2') {
    		    if(!empty($key)){
        		    $ip_info = self::get_loc($ip,$key,$type);
        			$code_ip = self::get_format($type,$ip_info);
        			echo $code_ip;  
    		    }else{
    		        echo('token未填写'); 
    		    }
    		} else {
    		    $ip_info=convertips($ip);
                $code_ip = self::get_format($type,$ip_info);
    			echo $code_ip;
    		}
    	}
    }
	
	 /**
     * 控制输出格式
     */	
    public static function get_format($type,$ip_info) {
    	if ($type=='1' || $type=='2') {
    		if($ip_info['province']==$ip_info['city']) {
    			$code = '<span>' . $ip_info['country'] . '&nbsp;' . $ip_info['province']. '</span>';
    		} else {
    			$code = '<span>' . $ip_info['country'] . '&nbsp;' . $ip_info['province'] . '&nbsp;' . $ip_info['city'] . '</span>';
    		}
    		return $code;
    	} else {
    		$code = '<span>' . $ip_info .'</span>';
    		return $code;
    	}
    }
}
