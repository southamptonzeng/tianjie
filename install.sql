--
-- 表的结构 `__PREFIX__tianjie_shopcategory`
--

CREATE TABLE IF NOT EXISTS `__PREFIX__tianjie_shopcategory` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '分类名称',
  `flag` set('hot','index','recommend') NOT NULL DEFAULT 'index' COMMENT '分类标志',
  `image` varchar(100) DEFAULT '' COMMENT '图片',
  `keywords` varchar(255) DEFAULT '' COMMENT '关键字',
  `description` varchar(255) DEFAULT '' COMMENT '描述',
  `createtime` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updatetime` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `weigh` int(10) NOT NULL DEFAULT '0' COMMENT '权重',
  `status` enum('normal','hidden') NOT NULL DEFAULT 'normal' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `weigh` (`weigh`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='店铺分类表';

BEGIN;
INSERT INTO `__PREFIX__tianjie_shopcategory` VALUES (1, '特色店铺', 'index', '', '', '', 1553606219, 1565316234, 0, 'normal');
INSERT INTO `__PREFIX__tianjie_shopcategory` VALUES (2, '网红店铺', 'index', '', '', '', 1582531695, 1582531695, 2, 'normal');
COMMIT;


--
-- 表的结构 `__PREFIX__tianjie_shop`
--

CREATE TABLE IF NOT EXISTS `__PREFIX__tianjie_shop` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '分类ID',
  `shopname` varchar(50) NOT NULL DEFAULT '' COMMENT '店铺名',
  `image` varchar(100) NOT NULL DEFAULT '' COMMENT '店铺照片',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '店铺描述',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '店铺地址',
  `score` double(2, 1) NOT NULL DEFAULT 0.0 COMMENT '店铺得分',
  `comments` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '店铺评论数',
  `createtime` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updatetime` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `weigh` int(10) NOT NULL DEFAULT '0' COMMENT '权重',
  `status` enum('normal','hidden') NOT NULL DEFAULT 'normal' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='店铺表';

BEGIN;
INSERT INTO `__PREFIX__tianjie_shop` VALUES (2, 1, '天街水城成都九宫格辣火锅', '/uploads/20200225/04dc6dfa51774a69384509d3dfde7310.png', '火锅超级辣', '天界水城81号', 0.0, 0, 1582591982, 1582591982, 2, 'normal');
INSERT INTO `__PREFIX__tianjie_shop` VALUES (3, 1, '天街水城成都九宫格辣火锅', '/uploads/20200225/e80943b464a29fd29e728637b3b5b002.png', '很好的一家', '郫县3号', 0.0, 0, 1582592035, 1582592035, 3, 'normal');
INSERT INTO `__PREFIX__tianjie_shop` VALUES (4, 1, '天街水城成都九宫格辣火锅', '/uploads/20200225/bfd2f6ea6775709d8762a45967370e1a.png', '很好的美食。一家', '清水河2号', 5.0, 0, 1582592074, 1582592074, 4, 'normal');
INSERT INTO `__PREFIX__tianjie_shop` VALUES (5, 1, '天街水城成都九宫格辣火锅', '/uploads/20200225/fcd239fec44fb6af9dd329138416c21a.png', '很好的美食。一家服装', '北京2号', 3.0, 0, 1582592110, 1582592110, 5, 'normal');
INSERT INTO `__PREFIX__tianjie_shop` VALUES (6, 2, '金拱门', '/uploads/20200225/04dc6dfa51774a69384509d3dfde7310.png', '很好的一家', '天界水城81号', 3.0, 0, 1582592165, 1582592165, 6, 'normal');
INSERT INTO `__PREFIX__tianjie_shop` VALUES (7, 2, '步行街', '/uploads/20200225/bfd2f6ea6775709d8762a45967370e1a.png', '很好的一家餐厅', '清水河2号', 4.0, 0, 1582592196, 1582592196, 7, 'normal');
INSERT INTO `__PREFIX__tianjie_shop` VALUES (8, 2, '金拱门', '/uploads/20200225/bfd2f6ea6775709d8762a45967370e1a.png', '很好的美食。一家服装', '天界水城81号', 8.0, 0, 1582592219, 1582592219, 8, 'normal');
INSERT INTO `__PREFIX__tianjie_shop` VALUES (9, 2, '步行街', '/uploads/20200225/fcd239fec44fb6af9dd329138416c21a.png', '很好的一家餐厅', '郫县3号', 4.0, 0, 1582592249, 1582592249, 9, 'normal');
COMMIT;

--
-- 表的结构 `__PREFIX__tianjie_shopcomment`
--

CREATE TABLE IF NOT EXISTS `__PREFIX__tianjie_shopcomment` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '店铺id',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `avatar` varchar(255) DEFAULT '' COMMENT '头像',
  `content` text NOT NULL COMMENT '评价内容',
  `likes` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '点赞',
  `product` double(2, 1) NOT NULL DEFAULT 0.0 COMMENT '点赞',
  `service` double(2, 1) NOT NULL DEFAULT 0.0 COMMENT '服务',
  `quality` double(2, 1) NOT NULL DEFAULT 0.0 COMMENT '质量',
  `averagesorce` double(2, 1) NOT NULL DEFAULT 0.0 COMMENT '平均得分',
  `createtime` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updatetime` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` enum('normal','hidden') NOT NULL DEFAULT 'normal' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `shop_id` (`shop_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='店铺评论表';

BEGIN;
INSERT INTO `__PREFIX__tianjie_shopcomment` VALUES (1, 1, 'zengzh', '', '我是评论', 0, 0.0, 0.0, 0.0, 0.0, 1553606219, 1565316234, 'normal');
INSERT INTO `__PREFIX__tianjie_shopcomment` VALUES (2, 2, 'zengzh', '', '真Tm好吃。', 0, 0.0, 0.0, 0.0, 0.0, 1582621429, 1582621429, 'normal');
COMMIT;