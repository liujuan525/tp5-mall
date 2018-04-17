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






}