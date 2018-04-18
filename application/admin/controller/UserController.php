<?php 
/**
 * 用户相关控制器
 * lj [2018/04/13]
 */
namespace app\admin\controller;

use app\admin\controller\PublicController;
use think\Validate;
use think\Db;

class UserController extends PublicController
{
	/**
	 * 添加用户 -> lj [2018/04/18]
	 */
	public function addUser()
	{
		return $this -> fetch();
	}








}