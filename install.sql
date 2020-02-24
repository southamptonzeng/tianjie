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
INSERT INTO `__PREFIX__tianjie_shopcategory`(`id`, `name`, `flag`, `image`, `keywords`, `description`, `createtime`, `updatetime`,`weigh`,`status`) VALUES
(1, '特色店铺', 'index', '', '', '', 1553606219, 1565316234, 0, 'normal');
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
INSERT INTO `__PREFIX__tianjie_shop`(`id`, `category_id`, `shopname`, `image`, `description`, `address`, `score`, `comments`, createtime, `updatetime`, `weigh`,`status`) VALUES
(1, 1, '我是第一个店铺', '', '我是第一个店铺', 'AAAAA', 4.9, 0, 1553606219, 1565316234, 0, 'normal');
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
INSERT INTO `__PREFIX__tianjie_shopcomment`(`id`, `shop_id`, `username`, `avatar`, `content`, `likes`, `createtime`, `updatetime`,`status`) VALUES
(1, 1, 'zengzh', '', '我是评论', 0, 1553606219, 1565316234, 'normal');
COMMIT;