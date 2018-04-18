<?php
/**
 * 后台公共控制器
 * lj [2018/04/13]
 */
namespace app\admin\controller;

use think\Controller;

class PublicController extends Controller
{
	/**
	 * 构造函数 -> lj [2018/04/13]
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
     * 获取参数
     */
    public function getParameter($param)
    {
        $data = [];
        foreach($param as $key => $value){
            $getValue = input("$value");
            if(!empty($getValue)) {
                $data["$value"] = $getValue;
            }
        }
        return $data;
    }

    /**
     * 添加数据时更新时间 -> lj [2018/4/16]
     */
    public function addTime($data=[])
    {
        // 当前时间
        $time = date('Y-m-d H:i:s', time());
        $data['addTime'] = $data['updateTime'] = $time;
        return $data;
    }

    /**
     * 修改数据时更新时间 -> lj [2018/04/17]
     */
    public function updateTime($data=[])
    {
        // 当前时间
        $time = date('Y-m-d H:i:s', time());
        $data['updateTime'] = $time;
        return $data;
    }

    /**
     * 校验手机号码 -> lj [2018/04/18]
     */
    public function isMobile($mobile)
    {
        $result = preg_match('/^(13[0-9]|15[012356789]|17[01678]|18[0-9]|14[57])[0-9]{8}$/', $mobile);
        if (!$result) {
            return json(['status' => 10015, 'msg' => '手机号格式错误']);
        }
    }

    /**
     * 字符串加密 -> lj [2018/04/18]
     */
    public function encryptString($string)
    {
        $salt = '6BSSDFB65257FCAB4E2975CD96B230F7FSDFC4B53D97C10B6';
        return strtoupper(md5(sha1(md5($string.$salt)).$string));
    }

    /**
     * [unique 获取唯一值(大写)]
     */
    public static function unique()
    {
        $key = mt_rand(1,99999).uniqid('juanblog',true).time();
        return strtoupper(md5(md5($key)));
    }





}