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

	];




}