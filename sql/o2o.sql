
-- 生活服务分类表
CREATE TABLE `o2o_category` (
	`id` int(11) unsigned NOT NULL auto_increment,
	`name` varchar(64) NOT NULL DEFAULT '',
	`parentId` int(10) unsigned NOT NULL DEFAULT 0,
	`listOrder` int(8) unsigned NOT NULL DEFAULT 0,
	`status` tinyint(1) NOT NULL DEFAULT 0,
	`createTime` int(11) unsigned NOT NULL DEFAULT 0,
	`updateTime` int(11) unsigned NOT NULL DEFAULT 0,
	`isDel` tinyint(1) NOT NULL DEFAULT 0,
	PRIMARY KEY (`id`),
	KEY parent_id(`parentId`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 城市表
CREATE TABLE `o2o_city` (
	`id` int(11) unsigned NOT NULL auto_increment,
	`name` varchar(64) NOT NULL DEFAULT '',
	`uname` varchar(64) NOT NULL DEFAULT '' COMMENT '英文名',
	`parentId` int(10) unsigned NOT NULL DEFAULT 0,
	`listOrder` int(8) unsigned NOT NULL DEFAULT 0,
	`status` tinyint(1) NOT NULL DEFAULT 0,
	`createTime` int(11) unsigned NOT NULL DEFAULT 0,
	`updateTime` int(11) unsigned NOT NULL DEFAULT 0,
	`isDel` tinyint(1) NOT NULL DEFAULT 0,
	PRIMARY KEY (`id`),
	KEY parent_id(`parentId`),
	UNIQUE KEY uname(`uname`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 商圈表
CREATE TABLE `o2o_area` (
	`id` int(11) unsigned NOT NULL auto_increment,
	`name` varchar(64) NOT NULL DEFAULT '',
	`cityId` int(11) unsigned NOT NULL DEFAULT 0,
	`parentId` int(10) unsigned NOT NULL DEFAULT 0,
	`listOrder` int(8) unsigned NOT NULL DEFAULT 0,
	`status` tinyint(1) NOT NULL DEFAULT 0,
	`createTime` int(11) unsigned NOT NULL DEFAULT 0,
	`updateTime` int(11) unsigned NOT NULL DEFAULT 0,
	`isDel` tinyint(1) NOT NULL DEFAULT 0,
	PRIMARY KEY (`id`),
	KEY parentId(`parentId`),
	KEY cityId(`cityId`),
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 商户表
CREATE TABLE `o2o_bis` (
	`id` int(11) unsigned NOT NULL auto_increment,
	`name` varchar(64) NOT NULL DEFAULT '',
	`email` varchar(64) NOT NULL DEFAULT '',
	`logo` varchar(255) NOT NULL DEFAULT '',商标
	`licence_logo` varchar(64) NOT NULL DEFAULT '',营业执照
	`description` text NOT NULL, 描述
	`cityId` int(11) unsigned NOT NULL DEFAULT 0,
	`cityPath` varchar(50) NOT NULL DEFAULT '', 详细地址
	`bank_info` varchar(50) NOT NULL DEFAULT '', 银行账号
	`money` decimal(20,2) NOT NULL DEFAULT '0.00', 账户余额
	`bank_name` varchar(50) NOT NULL DEFAULT '', 开户行
	`bank_user` varchar(50) NOT NULL DEFAULT '', 开户人名称
	`faren` varchar(20) NOT NULL DEFAULT '', 法人
	`faren_tel` varchar(20) NOT NULL DEFAULT '', 法人手机号

	`listOrder` int(8) unsigned NOT NULL DEFAULT 0,
	`status` tinyint(1) NOT NULL DEFAULT 0,
	`createTime` int(11) unsigned NOT NULL DEFAULT 0,
	`updateTime` int(11) unsigned NOT NULL DEFAULT 0,
	`isDel` tinyint(1) NOT NULL DEFAULT 0,
	PRIMARY KEY (`id`),
	KEY name(`name`),
	KEY cityId(`cityId`),
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 商户账号表
CREATE TABLE `o2o_bis_account` (
	`id` int(11) unsigned NOT NULL auto_increment,
	`username` varchar(64) NOT NULL DEFAULT '', 用户名
	`password` char(32) NOT NULL DEFAULT '',密码
	`code` varchar(10) NOT NULL DEFAULT '',随机数-》密码加密使用
	`bis_id` int(11) unsigned NOT NULL DEFAULT 0,所属商家id
	`last_login_ip` varchar(20) NOT NULL DEFAULT '',最后一次登录的Ip
	`last_login_time` int(11) unsigned NOT NULL DEFAULT 0,最后一次登录时间
	`is_min` tinyint(1) unsigned NOT NULL DEFAULT 0,是否是管理员

	`listOrder` int(8) unsigned NOT NULL DEFAULT 0,
	`status` tinyint(1) NOT NULL DEFAULT 0,
	`createTime` int(11) unsigned NOT NULL DEFAULT 0,
	`updateTime` int(11) unsigned NOT NULL DEFAULT 0,
	`isDel` tinyint(1) NOT NULL DEFAULT 0,
	PRIMARY KEY (`id`),
	KEY username(`username`),
	KEY bis_id(`bis_id`),
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 商户门店表
CREATE TABLE `o2o_bis_account` (
	`id` int(11) unsigned NOT NULL auto_increment,
	`name` varchar(64) NOT NULL DEFAULT '', 
	`logo` varchar(255) NOT NULL DEFAULT '',logo
	`address` varchar(255) NOT NULL DEFAULT '',门店地址
	`tel` varchar(20) NOT NULL DEFAULT '',
	`contact` varchar(20) NOT NULL DEFAULT '', 联系电话
	`xpoint` varchar(20) NOT NULL DEFAULT '', x轴经度
	`ypoint` varchar(20) NOT NULL DEFAULT '', y轴经度
	`bis_id` int(11) unsigned NOT NULL DEFAULT 0,所属商家id
	`open_time` int(11) unsigned NOT NULL DEFAULT 0,营业时间
	`content` text NOT NULL, 简介
	`is_main` tinyint(1) unsigned NOT NULL DEFAULT 0,是否是管理员
	`api_address` varchar(255) NOT NULL DEFAULT '',相关地址
	`cityId` int(11) unsigned NOT NULL DEFAULT 0,
	`cityPath` varchar(50) NOT NULL DEFAULT '', 详细地址
	`categoryId` int(11) unsigned NOT NULL DEFAULT 0,
	`categoryPath` varchar(50) NOT NULL DEFAULT '',
	`bank_info` varchar(50) NOT NULL DEFAULT '', 银行账号

	`listOrder` int(8) unsigned NOT NULL DEFAULT 0,
	`status` tinyint(1) NOT NULL DEFAULT 0,
	`createTime` int(11) unsigned NOT NULL DEFAULT 0,
	`updateTime` int(11) unsigned NOT NULL DEFAULT 0,
	`isDel` tinyint(1) NOT NULL DEFAULT 0,
	PRIMARY KEY (`id`),
	KEY name(`name`),
	KEY cityId(`cityId`),
	KEY bis_id(`bis_id`),
	KEY categoryId(`categoryId`),
)ENGINE=InnoDB DEFAULT CHARSET=utf8;












