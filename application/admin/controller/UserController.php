<?php 
/**
 * 用户相关控制器
 * lj [2018/04/13]
 */
namespace app\admin\controller;

use app\admin\controller\PublicController;
use think\Request;
use think\Validate;
use think\Db;

class UserController extends PublicController
{
	/**
	 * 添加用户 -> lj [2018/04/18]
	 */
	public function addUser()
	{
		// 获取角色信息
		$role = $this -> getRole();
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
		$map = array();
		if (input('time_start')) {
			$map['addTime'] = array('egt', input('time_start').' 00:00:00');
		}
		if (input('time_end')) {
			$map['addTime'] = array('elt', input('time_end').' 00:00:00');
		}
		if (input('username')) {
			$map['userName'] = array('eq', input('username'));
		}
		$map['isDel'] = 1; // 未删除
		$map['userAttribution'] = 3;// 后台用户

		// 获取用户信息
		$userInfo = Db::table('mall_user_info')
					-> where($map)
					-> paginate(2); // 每页1条数据
		// 获取角色描述
		foreach ($userInfo as $key=>&$user) {
			$info = Db::table('mall_role_info')
						-> where('id', $user['roleId'])
						-> find();
			$user['description'] = $info['description'];
		}
		$page = $userInfo -> render(); // 分页
		return view('user_list', ['userInfo' => $userInfo, 'page' => $page]);
	}

	/**
	 * 更改用户状态为禁用 -> lj [2018/04/18]
	 */
	public function stopUsing()
	{
		$data = $this -> getParameter(['id']);
		// 查询用户信息
		$this -> findUserById($data['id']);
		$data['userStatus'] = 3; // 禁用
		// 更新记录时间
		$data = $this -> updateTime($data);
		$this -> updateUserInfo($data);
	}

	/**
	 * 更改用户状态为启用 -> lj [2018/04/18]
	 */
	public function startUsing()
	{
		$data = $this -> getParameter(['id']);
		// 查询用户信息
		$this -> findUserById($data['id']);
		$data['userStatus'] = 1; // 启用
		// 更新记录时间
		$data = $this -> updateTime($data);
		$this -> updateUserInfo($data);
	}

	/**
	 * 删除用户 -> lj [2018/04/18]
	 */
	public function deleteUser()
	{
		$data = $this -> getParameter(['id']);
		// 校验数据
		$result = $this -> validate($data, 'User.delete');
		if ($result !== true) {
			return json(['status' => 10010, 'msg' => $result]);
		}
		// 查询用户信息
		$this -> findUserById($data['id']);
		$data['isDel'] = 2;
		// 更新记录时间
		$data = $this -> updateTime($data);
		$this -> updateUserInfo($data);
	}

	/**
	 * 根据id查询用户信息 -> lj [2018/04/18]
	 */
	private function findUserById($id)
	{
		$info = Db::table('mall_user_info')
					-> where('id', $id)
					-> find();
		if (!$info) {
			return json(['status' => 10013, 'msg' => '用户信息不存在!', 'data' => $id]);
		}
	}

	/**
	 * 更新用户信息 -> lj [2018/04/18]
	 */
	private function updateUserInfo($data)
	{
		$updateResult = Db::table('mall_user_info') -> update($data);
		if ($updateResult) {
			return $this -> success('更新成功!', '/userList');
		} else {
			return $this -> error('更新失败!', '/userList');
		}
	}

	/**
	 * 获取后台角色信息 -> lj [2018/04/18]
	 */
	private function getRole()
	{
		$role = Db::table('mall_role_info')
					-> where('roleAttribution', 3) // 后台
					-> select();
		return $role;
	}

	/**
	 * 更新用户信息 -> lj [2018/04/18]
	 */
	public function updateUser()
	{
		$data = $this -> getParameter(['id']);
		// 查询用户信息
		$this -> findUserById($data['id']);
		$user = Db::table('mall_user_info')
					-> where('id', $data['id'])
					-> find();
		// 获取角色信息
		$role = $this -> getRole();
		return view('update_user', ['role' => $role, 'user' => $user]);
	}

	/**
	 * 保存用户更新 -> lj [2018/04/18]
	 */
	public function saveUser()
	{
		$data = $this -> getParameter(['id', 'userName', 'gender', 'mobile', 'email', 'roleId', 'description']);
		// 校验信息
		$result = $this -> validate($data, 'User.update');
		if ($result !== true) {
			return json(['status' => 10014, 'msg' => $result]);
		}
		// 查询用户信息
		$this -> findUserById($data['id']);
		// 更新记录时间
		$data = $this -> updateTime($data);
		// 更新用户信息
		// $this -> updateUserInfo($data);
		$updateResult = Db::table('mall_user_info') -> update($data);
		if ($updateResult) {
			return ['status' => 1,'msg' => '更新成功','data' => $data['id']];
		} else {
			return ['status' => 10015,'msg' => '更新角色失败!','data' => $data];
		}
	}

	/**
	 * 批量删除用户 -> lj [2018/04/20]
	 */
	public function batchDeleteUser()
	{
		$data = $this -> getParameter(['id']);
		$data['id'] = explode(',', $data['id']);
		$data['isDel'] = 2; // 删除
		// 更新记录时间
		$data = $this -> updateTime($data);
		$result = Db::table('mall_user_info')
						-> where('id', 'in', $data['id'])
						-> update($data);

		return ['status' => 1,'msg' => '更新成功','data' => $data['id']];
		if ($result) {
			return ['status' => 1,'msg' => '删除成功','data' => $data['id']];
		} else {
			$this -> success('删除失败', '/userList');
		}
	}

	/**
	 * 筛选用户信息(根据日期或者用户名) -> lj [2018/04/20]
	 */
// 	public function queryUser()
// 	{
// 		$data = input('param.'); // 获取所有参数 -> 参数值可为空

// 		$map = array();
// 		if ($data['time_start']) {
// 			$map['addTime'] = array('egt', $data['time_start'].' 00:00:00');
// 		}
// 		if ($data['time_end']) {
// 			$map['addTime'] = array('elt', $data['time_end'].' 00:00:00');
// 		}
// 		if ($data['username']) {
// 			$map['userName'] = array('eq', $data['username']);
// 		}
// dump($map);die;
// 		// if ($data['username']) {
// 		// 	$userInfo = Db::table('mall_user_info')
// 		// 			-> where($map)
// 		// 			-> paginate(2);
// 		// 			// -> select();
// 		// } else {
// 			$userInfo = Db::table('mall_user_info')
// 					-> where($map)
// 					-> paginate(2);
// 					// -> select();
// 		// }
// 		$page = $userInfo -> render();
// 		// return view('user_list', ['userInfo' => $userInfo, 'page' => $page]);
// 		$this -> assign('userInfo', $userInfo);
// 		return ['status' => 1,'msg' => '查询成功','data' => $userInfo];
// 	}









}