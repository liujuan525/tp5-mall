<?php
/**
 * 角色相关控制器
 */
namespace app\admin\controller;

use app\admin\controller\PublicController;
use think\Request;
use think\Validate;
use think\Db;

class RoleController extends PublicController
{
	/**
	 * 添加用户角色 -> lj [2018/04/16]
	 */
	public function addRole()
	{
		return $this -> fetch();
	}

	/**
	 * 保存角色信息 -> lj [2018/04/16]
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
		$query = Db::table('mall_role_info')
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
		Db::table('mall_role_info') -> insert($data);
		$id = Db::table('mall_role_info') -> getLastInsID();
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
		$info = Db::table('mall_role_info')
					-> where('isDel', 1)
					-> select();
		$count = count($info);
		$this -> assign('count', $count);
		$this -> assign('info', $info);
		return $this -> fetch(); // $this->view->assign()
	}

	/**
	 * 删除角色信息 -> lj [2018/04/18]
	 */
	public function deleteRole()
	{
		$data = $this -> getParameter(['id']);
		// 验证数据
		$result = $this -> validate($data, 'Role.delete');
		// 验证不通过，返回错误信息
		if (true !== $result) {
			return json(['status' => 10016,'msg' => $result]);
		}
		// 更新记录时间
		$data = $this -> updateTime($data);
		$data['isDel'] = 2;
		$result = $this -> updateInfo($data);
		return $result;
	}

	/**
	 * 编辑角色信息 -> lj [2018/04/17]
	 */
	public function updateRole()
	{
		$data = $this -> getParameter(['id']);
		$role = Db::table('mall_role_info')
					-> where('id', $data['id'])
					-> find();
		if (!$role) {
			return json(['status' => 10013, 'msg' => '角色信息不存在无法修改!', 'data' => $data]);
		}
		// 分配角色信息
		$this -> assign('role', $role);
		return $this -> fetch();
	}

	/**
	 * 保存角色修改 -> lj [2018/04/17]
	 */
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
		$result = $this -> updateInfo($data);
		return json($result);
	}

	/**
	 * 更新信息 -> lj [2018/04/16]
	 */
	private function updateInfo($data)
	{
		$updateResult = Db::table('mall_role_info')
							-> update($data);
		if ($updateResult) {
			return ['status' => 1,'msg' => '更新成功','data' => $data['id']];
		} else {
			return ['status' => 10015,'msg' => '更新角色失败!','data' => $data];
		}
	}




}