
-- tp5商城相关数据库/表

-- 创建数据库
CREATE DATABASE `tp5_mall`;
-- 使用数据库
USE `tp5_mall`;
			-- 创建数据表
-- 用户表 -> lj [2018/04/18]
CREATE TABLE `mall_user_info` (
	`id` int(11) unsigned NOT NULL AUTO_INCREMENT,

	`userName` varchar(64) NOT NULL DEFAULT '' COMMENT '用户名',
	`password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
	`gender` tinyint(1) NOT NULL DEFAULT 1 COMMENT '性别:1-男,2-女',
	`mobile` varchar(32) NOT NULL DEFAULT '' COMMENT '手机号码',
	`email` varchar(64) NOT NULL DEFAULT '' COMMENT '邮箱地址',
	`roleId` int(11) NOT NULL DEFAULT 0 COMMENT 'mall_user_role表id',
	`description` varchar(128) NOT NULL DEFAULT '' COMMENT '描述',
	`userStatus` tinyint(1) NOT NULL DEFAULT 1 COMMENT '用户状态:1-审核成功,2-审核中,3-审核失败',
	`headPortrait` varchar(255) NOT NULL DEFAULT '' COMMENT '用户头像',
	`address` varchar(255) NOT NULL DEFAULT '' COMMENT '地址',
	`attachment` varchar(255) NOT NULL DEFAULT '' COMMENT '附件',
	`userAttribution` tinyint(1) NOT NULL DEFAULT 1 COMMENT '用户归属:1-用户,2-商家,3-后台',

	`isDel` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否删除:1-未删除,2-已删除',
	`addTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '记录添加时间',
	`updateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '记录更新时间',
	PRIMARY KEY(`id`),
	-- UNIQUE KEY `unique_name`(`userName`,`isDel`),
	KEY `userName`(`userName`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

-- 角色信息表 -> lj [2018/04/16]
CREATE TABLE `mall_role_info` (
	`id` int(11) unsigned NOT NULL AUTO_INCREMENT,

	`name` varchar(64) NOT NULL DEFAULT '' COMMENT '角色名',
	`roleAttribution` tinyint(1) NOT NULL DEFAULT 1 COMMENT '角色归属:1-用户,2-商家,3-后台',
	`description` varchar(64) NOT NULL DEFAULT '' COMMENT '角色描述',

	`isDel` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否删除:1-未删除,2-已删除',
	`addTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '记录添加时间',
	`updateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '记录更新时间',
	PRIMARY KEY(`id`),
	-- UNIQUE KEY `unique_key`(`roleAttribution`,`name`),
	KEY `roleAttribution`(`roleAttribution`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色信息表';


















