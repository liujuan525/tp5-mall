<?php 
/**
 * 后台模块配置文件
 * lj [2018/04/16]
 */
return [
	// 视图输出字符串内容替换
    'view_replace_str'       => [
    	'__HUI__' => '/static/h-ui',
    	'__HUIADMIN__' => '/static/h-ui.admin',
    	'__LIB__' => '/static/lib',
    	'__ADMIN__' => '/static/admin',
    ],

    // URL参数方式 0 按名称成对解析 1 按顺序解析
    'url_param_type'         => 0,
    // 控制器类后缀
    'controller_suffix'      => true,
    // 自动搜索控制器
    'controller_auto_search' => true,


];