<?php
/**
 * 测试控制器
 */

namespace app\index\controller;

use think\Controller;
use think\Request;

class Test extends Controller
{
    /**
     * 显示资源列表
     */
    public function index()
    {
        \Map::getLngLat('北京昌平');
    }

    /**
     * 图片验证码测试
     */
    public function captcha()
    {
        // 如果是post提交则校验信息
        if (request() -> isPost()) {
            // 获取post提交的数据
            $data = input('post.');
            $result = captcha_check($data['captcha']);
            if ($result) {
                $this -> success('验证成功');
            } else {
                $this -> error('验证码错误');
            }
        } else {
            // 否则展示页面
            return $this -> fetch();
        }
    }

    /**
     * 处理多选框相关问题
     */
    public function checkbox()
    {
        return $this -> fetch();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
