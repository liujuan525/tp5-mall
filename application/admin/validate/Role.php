<?php 
/**
 * 角色信息校验 -> lj [2018/04/16]
 */
namespace app\admin\validate;

use think\Validate;

class Role extends Validate
{
	// 验证规则
	protected $rule = [
		'name' => 'require|min:2',
		'description' => 'require',
		'roleAttribution' => 'require|in:1,2,3'
	];

	// 提示信息
	protected $message = [
		'name.require' => '角色名称必须',
		'name.min' => '角色名称最小2个字节',
		'description.require' => '角色描述不能为空',
		'roleAttribution.require' => '角色归属必须',
		'roleAttribution.in' => '角色归属必须在数组内',
	];

	// 验证场景
	protected $scene = [
		'add' => ['name', 'description', 'roleAttribution'],
		'update' => ['name', 'description', 'roleAttribution'],
	];

}