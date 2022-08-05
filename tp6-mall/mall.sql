/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 8.0.12 : Database - mall
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`mall` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */;

USE `mall`;

/*Table structure for table `mall_admin_user` */

DROP TABLE IF EXISTS `mall_admin_user`;

CREATE TABLE `mall_admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '后端用户主键ID',
  `username` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户名',
  `password` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户密码',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态码 1:正常，0:待审核，99:删除',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `last_login_ip` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '最后登录IP',
  `operate_user` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '操作人',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `mall_admin_user` */

insert  into `mall_admin_user`(`id`,`username`,`password`,`status`,`create_time`,`update_time`,`last_login_time`,`last_login_ip`,`operate_user`) values 
(1,'admin','123456',1,0,1658031514,1658031514,'127.0.0.1','管理员');

/*Table structure for table `mall_category` */

DROP TABLE IF EXISTS `mall_category`;

CREATE TABLE `mall_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '分类名称',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父类ID',
  `icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '图标',
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '路径 1,2,5',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `operate_user` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '操作人',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `listorder` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `pid` (`pid`) USING BTREE,
  KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `mall_category` */

insert  into `mall_category`(`id`,`name`,`pid`,`icon`,`path`,`create_time`,`update_time`,`operate_user`,`status`,`listorder`) values 
(98,'手机',0,'','0,98',1657466228,1657466228,'admin',1,0),
(99,'电脑',0,'','0,99',1657548013,1657548013,'admin',1,0),
(100,'苹果电脑',99,'','0,99,100',1657548033,1657548033,'admin',1,0),
(101,'联想电脑',99,'','0,99,101',1657548061,1657548061,'admin',1,0),
(102,'苹果手机',98,'','0,98,102',1657548080,1657548080,'admin',1,0),
(103,'华为手机',98,'','0,98,103',1657548101,1657548101,'admin',1,0),
(104,'华为电脑',99,'','0,99,104',1657550786,1657550786,'admin',1,0),
(105,'衣服',0,'','0,105',1657553561,1657553561,'admin',1,0),
(106,'裤子',0,'','0,106',1657553570,1657554821,'admin',1,2),
(107,'家电',0,'','0,107',1657553610,1657553610,'admin',1,0),
(108,'奢侈品',0,'','0,108',1657553628,1657554812,'admin',1,1),
(109,'matebook',104,'','0,99,104,109',1657638768,1657638768,'admin',1,0),
(110,'notebook',104,'','0,99,104,110',1657638817,1657638817,'admin',1,0),
(111,'小新',101,'','0,99,101,111',1657638854,1657638854,'admin',1,0),
(112,'mac',100,'','0,99,100,112',1657638882,1657638882,'admin',1,0),
(113,'mate系列',103,'','0,98,103,113',1658031588,1658031588,'admin',1,0);

/*Table structure for table `mall_demo` */

DROP TABLE IF EXISTS `mall_demo`;

CREATE TABLE `mall_demo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `title` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '标题',
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '内容',
  `category_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '分类id',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态0:不正常,1:正常',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `udx_title` (`title`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `mall_demo` */

/*Table structure for table `mall_goods` */

DROP TABLE IF EXISTS `mall_goods`;

CREATE TABLE `mall_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '商品标题',
  `category_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品分类',
  `category_path_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '栏目ID path',
  `promotion_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '商品促销语',
  `goods_unit` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '商品单位',
  `keywords` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '关键词',
  `sub_title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '副标题',
  `stock` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '库存',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '现价',
  `cost_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '原价',
  `sku_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品默认的sku_id',
  `is_show_stock` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否显示库存',
  `production_time` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '生产日期',
  `goods_specs_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '商品规则 1统一，2多规格',
  `big_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '大图',
  `recommend_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '商品推荐图',
  `carousel_image` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '详情页轮播图',
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品详情',
  `is_index_recommend` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否首页推荐大图商品',
  `goods_specs_data` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '所有规则属性存放json',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `operate_user` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `listorder` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序字段',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `title` (`title`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `mall_goods` */

insert  into `mall_goods`(`id`,`title`,`category_id`,`category_path_id`,`promotion_title`,`goods_unit`,`keywords`,`sub_title`,`stock`,`price`,`cost_price`,`sku_id`,`is_show_stock`,`production_time`,`goods_specs_type`,`big_image`,`recommend_image`,`carousel_image`,`description`,`is_index_recommend`,`goods_specs_data`,`create_time`,`update_time`,`operate_user`,`status`,`listorder`) values 
(90,'测试',110,'99,104,110','测试','台','测试','测试',4384,0.00,0.00,130,1,'2022-07-16',2,'/upload/image/20220716\\dd8d7b3563ec0668a7249f7064f3bc1c.jpg','/upload/image/20220716\\a30fc17376331ee5056fb53a5d27f81c.jpg','/upload/image/20220716\\255564d3db6f8697b3fc88485e03858f.jpg,/upload/image/20220716\\bf50d3270611e200fc8ec43f4aaeaad7.jpg','测试哈哈哈<img src=\"/upload/image/20220716\\293f92afe7572ff40087818bfd4041cf.jpg\" alt=\"undefined\">',1,'',1657961522,1657961523,'',1,0),
(91,'mate50手机',113,'98,103,113','mate50手机','台','mate50手机','mate50手机',370,0.00,0.00,139,1,'2022-07-17',2,'/upload/image/20220717\\03e354efaf2d23f67916c76311599372.jpg','/upload/image/20220717\\ef1bf8a992bbfc4a2d39ab5994b6ddc2.jpg','/upload/image/20220717\\196f3a1235d4f7a9309e699de47c2d97.jpg,/upload/image/20220717\\4c033d27520171dbbad2a990d43a39c2.jpg','测试手机<img src=\"/upload/image/20220717\\33df5b129445ff0ab53b2309566b2503.jpg\" alt=\"undefined\">',1,'',1658031750,1658031751,'',1,0);

/*Table structure for table `mall_goods_sku` */

DROP TABLE IF EXISTS `mall_goods_sku`;

CREATE TABLE `mall_goods_sku` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品Id',
  `specs_value_ids` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '每行规则属性ID 按逗号连接',
  `price` decimal(10,2) unsigned NOT NULL COMMENT '现价',
  `cost_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '原价',
  `stock` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '库存',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `goods_id` (`goods_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `mall_goods_sku` */

insert  into `mall_goods_sku`(`id`,`goods_id`,`specs_value_ids`,`price`,`cost_price`,`stock`,`status`,`create_time`,`update_time`) values 
(130,90,'27,34',0.00,0.00,22,1,1657961523,1657961523),
(131,90,'27,35',0.00,0.00,33,1,1657961523,1657961523),
(132,90,'27,36',0.00,0.00,444,1,1657961523,1657961523),
(133,90,'28,34',0.00,0.00,555,1,1657961523,1657961523),
(134,90,'28,35',0.00,0.00,666,1,1657961523,1657961523),
(135,90,'28,36',0.00,0.00,666,1,1657961523,1657961523),
(136,90,'29,34',0.00,0.00,666,1,1657961523,1657961523),
(137,90,'29,35',0.00,0.00,666,1,1657961523,1657961523),
(138,90,'29,36',0.00,0.00,666,1,1657961523,1657961523),
(139,91,'27,34',0.00,0.00,333,1,1658031751,1658031751),
(140,91,'27,35',0.00,0.00,2,1,1658031751,1658031751),
(141,91,'27,36',0.00,0.00,2,1,1658031751,1658031751),
(142,91,'28,34',0.00,0.00,3,1,1658031751,1658031751),
(143,91,'28,35',0.00,0.00,4,1,1658031751,1658031751),
(144,91,'28,36',0.00,0.00,5,1,1658031751,1658031751),
(145,91,'29,34',0.00,0.00,6,1,1658031751,1658031751),
(146,91,'29,35',0.00,0.00,7,1,1658031751,1658031751),
(147,91,'29,36',0.00,0.00,8,1,1658031751,1658031751);

/*Table structure for table `mall_order` */

DROP TABLE IF EXISTS `mall_order`;

CREATE TABLE `mall_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `order_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '订单号',
  `total_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `pay_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '支付方式',
  `logistics` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '物流名称，比如中通 申通 等信息',
  `logistics_order` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '物流订单号',
  `message` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '购买者留言信息',
  `address_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '邮寄地址',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单修改时间',
  `pay_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '支付时间',
  `consignment_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发货时间',
  `end_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '交易完成时间',
  `close_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '交易关闭时间',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1待支付;2已付款; 3已发货; 4已收货; 5已完成; 6退款退货  7已取消\n',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `user_id` (`user_id`,`order_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `mall_order` */

/*Table structure for table `mall_order_goods` */

DROP TABLE IF EXISTS `mall_order_goods`;

CREATE TABLE `mall_order_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_german2_ci NOT NULL DEFAULT '' COMMENT '订单ID',
  `sku` varchar(100) CHARACTER SET utf8 COLLATE utf8_german2_ci NOT NULL DEFAULT '' COMMENT 'sku文案',
  `sku_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品skuID',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品ID',
  `num` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '数量',
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '商品单价',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '商品标题',
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '商品图片',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `mall_order_goods` */

/*Table structure for table `mall_specs_value` */

DROP TABLE IF EXISTS `mall_specs_value`;

CREATE TABLE `mall_specs_value` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `specs_id` int(10) unsigned NOT NULL COMMENT '规格ID',
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '规格属性名',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `operate_user` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `specs_id` (`specs_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `mall_specs_value` */

insert  into `mall_specs_value`(`id`,`specs_id`,`name`,`create_time`,`update_time`,`operate_user`,`status`) values 
(27,1,'白色',1657901898,1657901898,'',1),
(28,1,'黑色',1657901908,1657901908,'',1),
(29,1,'黄色',1657901915,1657901915,'',1),
(30,2,'L',1657901922,1657901922,'',1),
(31,2,'S',1657901932,1657901932,'',1),
(32,2,'XL',1657901943,1657901943,'',1),
(33,2,'XXL',1657901949,1657901949,'',1),
(34,3,'64G',1657901965,1657901965,'',1),
(35,3,'128G',1657901974,1657901974,'',1),
(36,3,'256G',1657901982,1657901982,'',1);

/*Table structure for table `mall_user` */

DROP TABLE IF EXISTS `mall_user`;

CREATE TABLE `mall_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `username` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `phone_number` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '手机号',
  `password` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '密码',
  `ltype` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '登录方式 默认：0手机号码登录 1用户名密码登录',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '会话保存天数',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '性别',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `operate_user` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `username` (`username`) USING BTREE,
  KEY `phone_number` (`phone_number`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `mall_user` */

insert  into `mall_user`(`id`,`username`,`phone_number`,`password`,`ltype`,`type`,`sex`,`create_time`,`update_time`,`status`,`operate_user`) values 
(4,'测试','15200000000','123456',1,0,0,0,1658244801,1,'测试'),
(5,'troku15222222222','15222222222','123456',0,2,0,1658332701,1658332701,1,'');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
