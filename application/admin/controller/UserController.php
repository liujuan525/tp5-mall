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
	protected $user;

	/**
	 * 构造函数
	 */
	public function __construct()
	{
		// $this -> user = Db::table('mall_user_info');
	}

	/**
	 * 添加用户 -> lj [2018/04/18]
	 */
	public function addUser()
	{
		// 获取角色信息
		$role = Db::table('mall_role_info')
					-> where('roleAttribution', 3) // 后台
					-> select();
		//$view -> assign('role', $role);
		return view('add_user', ['role'=> $role]);
	}

	/**
	 * 添加后台用户 -> lj [2018/04/18]
	 */
	public function insertUser()
	{
		$data = $this -> getParameter(['userName', 'password', 'repassword', 'gender', 'mobile', 'email', 'roleId', 'description']);
		$data['userAttribution'] = 3; // 后台用户
		// 校验数据
		$result = $this -> validate($data, 'User.add');
		if ($result !== true) {
			return json(['status' => 10010, 'msg' => $result]);
		}
		// 删除校验密码
		unset($data['repassword']);
		// 密码加密
		$data['password'] = $this -> encryptString($data['password']);
		// 校验手机号格式
		$this -> isMobile($data['mobile']);
		// 查询用户信息
		$userInfo = Db::table('mall_user_info')
						-> where('userName', $data['userName'])
						-> whereOr('mobile', $data['mobile'])
						-> where('userAttribution', 3)
						-> find();
		if ($userInfo) {
			return json(['status' => 10011, 'msg' => '用户名或者手机号已存在!', 'data' => $data['userName']]);
		}
		// 添加用户信息
		$data = $this -> addTime($data);
		$id = Db::table('mall_user_info') -> insertGetId($data);
		if ($id) {
			return json(['status' => 1, 'msg' => '添加用户成功!', 'data' => $id]);
		} else {
			return json(['status' => 10012, 'msg' => '添加用户失败!']);
		}
	}

	/**
	 * 获取用户列表 -> lj [2018/04/18]
	 */
	public function userList()
	{
		// 获取用户信息
		$userInfo = Db::table('mall_user_info')
					-> where('userAttribution', 3)
					-> select();
		$count = count($userInfo); // 用户总数
		// 获取角色描述
		foreach ($userInfo as $key=>&$user) {
			$info = Db::table('mall_role_info')
						-> where('id', $user['roleId'])
						-> find();
			$user['roleId'] = $info['description'];
		}
		return view('user_list', ['userInfo' => $userInfo, 'count' => $count]);
	}

	/**
	 * 更改用户状态为禁用 -> lj [2018/04/18]
	 */
	public function stopUsing()
	{
		$data = $this -> getParameter(['id']);
		$info = Db::table('mall_user_info')
					-> where('id', $data['id'])
					-> find();
		if (!$info) {
			return json(['status' => 10013, 'msg' => '用户信息不存在无法修改!', 'data' => $data]);
		}
		$data['userStatus'] = 3; // 禁用
		// 更新记录时间
		$data = $this -> updateTime($data);
		$updateResult = Db::table('mall_user_info') -> update($data);
		if ($updateResult) {
			return $this -> success('更新成功!', '/userList');
		} else {
			return $this -> error('更新失败!', '/userList');
		}
	}

	/**
	 * 更改用户状态为启用 -> lj [2018/04/18]
	 */
	public function startUsing()
	{
		$data = $this -> getParameter(['id']);
		$info = Db::table('mall_user_info')
					-> where('id', $data['id'])
					-> find();
		if (!$info) {
			return json(['status' => 10013, 'msg' => '用户信息不存在无法修改!', 'data' => $data]);
		}
		$data['userStatus'] = 1; // 启用
		// 更新记录时间
		$data = $this -> updateTime($data);
		$updateResult = Db::table('mall_user_info') -> update($data);
		if ($updateResult) {
			return $this -> success('更新成功!', '/userList');
		} else {
			return $this -> error('更新失败!', '/userList');
		}
	}




}