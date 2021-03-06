<?php

namespace app\admin\controller;

use app\admin\controller\PublicController;
use think\Request;

class TestController extends PublicController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        // \Map::getLngLat('北京昌平');
        
        \phpmailer\Email::send(1,1,1);
        return '发送邮件成功';
        return $this->fetch();
    }

    /**
     * 百度地图测试
     */
    public function test()
    {
        return \Map::staticimage('北京昌平');
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
