<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

Route::get('index', 'admin/Index/index'); // 后台首页

return [
	/**
	 * admin后台模块相关路由
	 */
	'register' => 'admin/Index/register', // 用户注册
	'login' => 'admin/Index/login', // 用户登录
	'welcome' => 'admin/Index/welcome', // 欢迎页面

	'addRole' => 'admin/User/addRole', // 添加用户角色
	'saveRole' => 'admin/User/saveRole', // 保存用户角色信息
	'manageRole' => 'admin/User/queryRole', // 获取用户角色信息
	'updateRole/:id' => 'admin/User/updateRole', // 更新用户角色信息
	'saveUpdate' => 'admin/User/saveUpdate', // 更新用户角色信息
];


























