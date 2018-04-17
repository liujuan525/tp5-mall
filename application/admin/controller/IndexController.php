<?php 
/**
 * 后台首页控制器 -> lj [2018/04/16]
 */
namespace app\admin\controller;

use app\admin\controller\PublicController;

class IndexController extends PublicController
{
	/**
	 * 后台首页 -> lj [2018/04/16]
	 */
	public function index()
	{
		return $this -> fetch();
	}

	/**
	 * 用户注册
	 */
	public function register()
	{
		return $this -> fetch();
	}

	/**
	 * 用户登录
	 */
	public function login()
	{
		return $this -> fetch();
	}

	/**
	 * 后台欢迎页面 -> lj [2018/04/17]
	 */
	public function welcome()
	{
		return $this -> fetch();
	}


}