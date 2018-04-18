<?php
/**
 * 用户信息校验 -> lj [2018/04/18]
 */
namespace app\admin\validate;

use think\Validate;

class User extends Validate
{
	// 验证规则
	protected $rule = [
		'id' => 'require|number',
		'userName' => 'require|min:3',
		'password' => 'require|min:6',
		'repassword' => 'require|confirm:password',
		'mobile' => 'require',
		'email' => 'require|email',
		'userAttribution' => 'require',
	];

	// 验证信息
	protected $message = [
		'id.require' => '用户id不能为空',
		'id.number' => '用户id必须为数字',
		'userName.require' => '用户名不能为空',
		'userName.min' => '用户名最少3个字节',
		'password.require' => '密码不能为空',
		'password.min' => '密码最少6个字节',
		'repassword.require' => '校验密码不能为空',
		'repassword.confirm' => '密码与校验密码不一致',
		'mobile.require' => '手机号不能为空',
		'email.require' => '邮箱不能为空',
		'email.email' => '邮箱格式错误',
		'userAttribution.require' => '用户归属不能为空',
	];

	// 验证场景
	protected $scene = [
		'add' => ['userName', 'password', 'repassword', 'mobile', 'email', 'userAttribution'],
	];



}