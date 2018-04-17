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
	 * 添加用户角色 -> lj [2018/04/16]
	 */
	public function addRole()
	{
		return $this -> fetch();
	}

	/**
	 * 保存用户角色信息 -> lj [2018/04/16]
	 */
	public function saveRole(Request $request)
	{
		$data = $this -> getParameter(['name', 'description', 'roleAttribution']);
		// 验证数据
		$result = $this -> validate($data, 'Role.add');
		// 验证不通过，返回错误信息
		if (true !== $result) {
			return json(['status' => 10010,'msg' => $result]);
		}
		// 查询数据是否存在
		$result = $this -> findRole($data);
		// 添加记录时间
		$data = $this -> addTime($data);
		// 添加角色信息
		$result = $this -> insertRole($data);
		return json($result);
	}

	/**
	 * 查询角色信息 -> lj [2018/04/16]
	 */
	private function findRole($data)
	{
		$query = Db::table('mall_user_role')
					-> where('name', $data['name'])
					-> where('roleAttribution', $data['roleAttribution'])
					-> where('isDel', 1)
					-> find();
		if ($query) {
			return ['status' => 10011,'msg' => '角色信息已存在!','data' => $query];
		}
	}

	/**
	 * 添加角色信息 -> lj [2018/04/16]
	 */
	private function insertRole($data)
	{
		Db::table('mall_user_role') -> insert($data);
		$id = Db::table('mall_user_role') -> getLastInsID();
		if ($id) {
			return ['status' => 1,'msg' => '成功','data' => $id];
		} else {
			return ['status' => 10012,'msg' => '添加角色失败!','data' => $data];
		}
	}

	/**
	 * 查询角色信息 -> lj [2018/04/17]
	 */
	public function queryRole()
	{
		$info = Db::table('mall_user_role')
					-> where('isDel', 1)
					-> select();
		$count = count($info);
		$this -> assign('count', $count);
		$this -> assign('info', $info);
		return $this -> fetch();
	}

	/**
	 * 编辑角色信息 -> lj [2018/04/17]
	 */
	// public function updateRole()
	public function updateRole($id)
	{
		$role = Db::table('mall_user_role')
					-> where('id', $id)
					-> find();
		if (!$role) {
			return json(['status' => 10013, 'msg' => $id, 'info' => $id]);
			// return json(['status' => 10013, 'msg' => '角色信息不存在无法修改!', 'info' => $id]);
		}
		// 分配角色信息
		$this -> assign('role', $role);
		return $this -> fetch();
	}

	public function saveUpdate()
	{
		$data = $this -> getParameter(['id', 'name', 'description', 'roleAttribution']);
		// 验证数据
		$result = $this -> validate($data, 'Role.update');
		// 验证不通过，返回错误信息
		if (true !== $result) {
			return json(['status' => 10014,'msg' => $result]);
		}
		// 更新记录时间
		$data = $this -> updateTime($data);
		// 更新角色信息
		$updateResult = Db::table('mall_user_role')
							-> update([$data]);
		if ($updateResult) {
			return ['status' => 1,'msg' => '更新成功','data' => $data['id']];
		} else {
			return ['status' => 10015,'msg' => '更新角色失败!','data' => $data];
		}
		return json($result);
	}


















}