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
	// IndexController
	'register' => 'admin/Index/register', // 用户注册
	'login' => 'admin/Index/login', // 用户登录
	'welcome' => 'admin/Index/welcome', // 欢迎页面
	// RoleController
	'addRole' => 'admin/Role/addRole', // 添加用户角色
	'saveRole' => 'admin/Role/saveRole', // 保存用户角色信息
	'manageRole' => 'admin/Role/queryRole', // 获取用户角色信息
	'updateRole' => 'admin/Role/updateRole', // 更新用户角色信息
	'saveUpdate' => 'admin/Role/saveUpdate', // 更新用户角色信息
	'deleteRole' => 'admin/Role/deleteRole', // 删除用户角色信息
	'batchDelete' => 'admin/Role/batchDelete', // 批量删除角色信息
	// UserController
	'addUser' => 'admin/User/addUser', // 添加用户
	'insertUser' => 'admin/User/insertUser', // 添加用户
	'userList' => 'admin/User/userList', // 用户列表
	'stopUsing' => 'admin/User/stopUsing', // 更改用户状态为禁用
	'startUsing' => 'admin/User/startUsing', // 更改用户状态为启用
	'deleteUser' => 'admin/User/deleteUser', // 删除用户
	'updateUser' => 'admin/User/updateUser', // 更新用户信息
	'saveUser' => 'admin/User/saveUser', // 更新用户信息
	'batchDeleteUser' => 'admin/User/batchDeleteUser', // 批量删除用户





];


























