--
-- 表的结构 `__PREFIX__gonglue_contentcategory`
--

CREATE TABLE IF NOT EXISTS `__PREFIX__gonglue_contentcategory` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '父分类ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '分类名称',
  `nickname` varchar(50) DEFAULT '' COMMENT '分类昵称',
  `flag` set('hot','index','recommend') NOT NULL DEFAULT 'index' COMMENT '分类标志',
  `image` varchar(100) DEFAULT '' COMMENT '图片',
  `keywords` varchar(255) DEFAULT '' COMMENT '关键字',
  `description` varchar(255) DEFAULT '' COMMENT '描述',
  `createtime` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updatetime` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `weigh` int(10) NOT NULL DEFAULT '0' COMMENT '权重',
  `status` enum('normal','hidden') NOT NULL DEFAULT 'normal' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `weigh` (`weigh`,`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='内容分类表';

BEGIN;
INSERT INTO `__PREFIX__gonglue_contentcategory`(`id`, `pid`, `name`, `nickname`, `flag`, `image`, `keywords`, `description`, `createtime`, `updatetime`,`weigh`,`status`) VALUES
(1, 0, '分类一', '', 'index', '', '', '', 1553606219, 1565316234, 0, 'normal');
COMMIT;


--
-- 表的结构 `__PREFIX__gonglue_content`
--

CREATE TABLE IF NOT EXISTS `__PREFIX__gonglue_content` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '分类ID',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `image` varchar(100) DEFAULT '' COMMENT '大图',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `avatar` varchar(255) DEFAULT '' COMMENT '头像',
  `views` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '点击',
  `likes` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '点赞',
  `comments` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '评论数',
  `createtime` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updatetime` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `weigh` int(10) NOT NULL DEFAULT '0' COMMENT '权重',
  `status` enum('normal','hidden') NOT NULL DEFAULT 'normal' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='内容表';

BEGIN;
INSERT INTO `__PREFIX__gonglue_content`(`id`, `category_id`, `title`, `content`, `image`, `username`, `avatar`, `views`, `likes`, `comments`, createtime, `updatetime`, `weigh`,`status`) VALUES
(1, 1, '我是标题', '我是内容', '', 'zengzh', '', 1, 0, 1, 1553606219, 1565316234, 0, 'normal');
COMMIT;

--
-- 表的结构 `__PREFIX__gonglue_contentcomment`
--

CREATE TABLE IF NOT EXISTS `__PREFIX__gonglue_contentcomment` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `content_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '内容ID',
  `pid` int(10) NOT NULL DEFAULT '0' COMMENT '父ID',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `avatar` varchar(255) DEFAULT '' COMMENT '头像',
  `content` text NOT NULL COMMENT '内容',
  `likes` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '点赞',
  `comments` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '评论数',
  `createtime` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updatetime` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` enum('normal','hidden') NOT NULL DEFAULT 'normal' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `content_id` (`content_id`,`pid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='内容评论表';

BEGIN;
INSERT INTO `__PREFIX__gonglue_contentcomment`(`id`, `content_id`, `pid`, `username`, `avatar`, `content`, `likes`, `comments`, `createtime`, `updatetime`,`status`) VALUES
(1, 1, 0, 'zengzh', '', '我是评论', 0, 0,  1553606219, 1565316234, 'normal');
COMMIT;

--
-- 表的结构 `__PREFIX__gonglue_topic`
--
CREATE TABLE IF NOT EXISTS `__PREFIX__gonglue_topic` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `flag` set('hot','recommend') NOT NULL DEFAULT 'recommend' COMMENT '标志',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `image` varchar(100) DEFAULT '' COMMENT '大图',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `avatar` varchar(255) DEFAULT '' COMMENT '头像',
  `views` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '点击',
  `likes` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '点赞',
  `comments` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '评论数',
  `createtime` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updatetime` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `weigh` int(10) NOT NULL DEFAULT '0' COMMENT '权重',
  `status` enum('normal','hidden') NOT NULL DEFAULT 'normal' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='话题表';

BEGIN;
INSERT INTO `__PREFIX__gonglue_topic`(`id`, `flag`, `title`, `content`, `image`, `username`, `avatar`, `views`, `likes`, `comments`, createtime, `updatetime`, `weigh`,`status`) VALUES
(1, 'hot', '我是标题', '我是内容', '', 'zengzh', '', 1, 0, 1, 1553606219, 1565316234, 0, 'normal');
COMMIT;


--
-- 表的结构 `__PREFIX__gonglue_topiccomment`
--

CREATE TABLE IF NOT EXISTS `__PREFIX__gonglue_topiccomment` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `topic_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '话题ID',
  `pid` int(10) NOT NULL DEFAULT '0' COMMENT '父ID',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `avatar` varchar(255) DEFAULT '' COMMENT '头像',
  `content` text NOT NULL COMMENT '内容',
  `likes` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '点赞',
  `comments` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '评论数',
  `createtime` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updatetime` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` enum('normal','hidden') NOT NULL DEFAULT 'normal' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `topic_id` (`topic_id`,`pid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='话题评论表';

BEGIN;
INSERT INTO `__PREFIX__gonglue_topiccomment`(`id`, `topic_id`, `pid`, `username`, `avatar`, `content`, `likes`, `comments`, `createtime`, `updatetime`,`status`) VALUES
(1, 1, 0, 'zengzh', '', '我是评论', 0, 0, 1553606219, 1565316234, 'normal');
COMMIT;