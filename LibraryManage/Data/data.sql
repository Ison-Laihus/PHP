--
--  build tables
--  table sum: 6
--

-- 创建用户信息表
CREATE TABLE IF NOT EXISTS `lm_users` (
   `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
   `name` varchar(100) NOT NULL,
   `pwd` varchar(100) NOT NULL,
   `credit` int(8) NOT NULL,
   `isBorrow` int(8) NOT NULL,
   `bookNum` int(8),
   PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 创建管理员信息表
CREATE TABLE IF NOT EXISTS `lm_admins` (
   `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
   `name` varchar(100) NOT NULL,
   `pwd` varchar(100) NOT NULL,
   `authority` int(8) NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 创建书籍类别表
CREATE TABLE IF NOT EXISTS `lm_cate` (
   `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
   `category` varchar(100) NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 创建书籍信息表
CREATE TABLE IF NOT EXISTS `lm_books` (
   `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
   `bookName` varchar(100) NOT NULL,
   `author` varchar(100) NOT NULL,
   `publisher` varchar(300) NOT NULL,
   `category` varchar(100) NOT NULL,
   `publishTime` varchar(100) NOT NULL,
   `img` varchar(100),
   `sum` int(20),
   `surplus` int(20),
   `isShow` int(1) NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 创建借贷书籍信息表
CREATE TABLE IF NOT EXISTS `lm_borrow` (
   `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
   `user` varchar(100) NOT NULL,
   `bookName` varchar(100) NOT NULL,
   `bookNum` int(8) NOT NULL,
   `borrowDate` varchar(20) NOT NULL,
   `returnDate` varchar(20) NOT NULL,
   `type` int(1) NOT NULL,
   `isRecord` int(1) NOT NULL, -- 标志若为按时还书，是否已经记录在用户的信息上
   PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- type:
-- 0:borrowed
-- 1:return in time
-- 2:return in one day              cut down 5 scores
-- 3:return in one week             cut down 10 scores
-- 4:return in one month            cut down 50 scores
-- 5:return after one month         cut down all scores

-- 创建预约信息表
CREATE TABLE IF NOT EXISTS `lm_order` (
   `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
   `user` varchar(100) NOT NULL,
   `bookName` varchar(100) NOT NULL,
   `bookNum` int(8) NOT NULL,
   `borrowDate` varchar(20) NOT NULL,
   `maintainTime` int(8) NOT NULL,
   `type` int(1) NOT NULL,  -- 当type=1：预约；type=0：被驳回；type=2：未按时借书
   `isRecord` int(1) NOT NULL, -- 标志若为按时借书，是否已经记录在用户的信息上
   PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- type:
-- 2: cut down 5 scores

--
--  insert data
--  data sum: 27
--

-- 向书籍类别表中添加5条信息
INSERT INTO `lm_cate` (`id`, `category`) VALUES
(1, '文学'),
(2, '计算机'),
(3, '机器'),
(4, '健康'),
(5, '娱乐');

-- 向书籍信息中添加20条信息
INSERT INTO `lm_books` (`id`, `bookName`, `author`, `publisher`, `category`, `publishTime`, `img`, `sum`, `surplus`, `isShow`) VALUES
(1, '哈利波特', 'lyk', '艾森出版社', '文学', '2017-01-01', 'a.png', 1000, 1000, 1),
(2, '星际穿越', 'lyk', '艾森出版社', '文学', '2017-01-01', 'b.png', 1000, 1000, 0),
(3, '爱迪生到发明', 'lyk', '艾森出版社', '文学', '2017-01-01', 'c.png', 1000, 1000, 1),
(4, '莎士比亚诗集', 'lyk', '艾森出版社', '文学', '2017-01-01', 'd.png', 1000, 1000, 0),
(5, '佛门盛典', 'lyk', '艾森出版社', '文学', '2017-01-01', 'e.png', 1000, 1000, 1),
(6, '100道菜肴', 'lyk', '艾森出版社', '文学', '2017-01-01', 'f.png', 1000, 1000, 0),
(7, '太空一号', 'lyk', '艾森出版社', '文学', '2017-01-01', 'g.png', 1000, 1000, 1),
(8, '毕加索的灵感', 'lyk', '艾森出版社', '文学', '2017-01-01', 'h.png', 1000, 1000, 0),
(9, '索命医生', 'lyk', '艾森出版社', '文学', '2017-01-01', 'i.png', 1000, 1000, 1),
(10, '孤魂乡村', 'lyk', '艾森出版社', '文学', '2017-01-01', 'j.png', 1000, 1000, 0),
(11, '美女，喝一杯么', 'lyk', '艾森出版社', '文学', '2017-01-01', 'k.png', 1000, 1000, 1),
(12, '克己复礼', 'lyk', '艾森出版社', '文学', '2017-01-01', 'l.png', 1000, 1000, 0),
(13, '孔孟春秋', 'lyk', '艾森出版社', '文学', '2017-01-01', 'm.png', 1000, 1000, 1),
(14, '三国别志', 'lyk', '艾森出版社', '文学', '2017-01-01', 'n.png', 1000, 1000, 0),
(15, '秦文汉武', 'lyk', '艾森出版社', '文学', '2017-01-01', 'o.png', 1000, 1000, 1),
(16, '马克波罗东游记', 'lyk', '艾森出版社', '文学', '2017-01-01', 'p.png', 1000, 1000, 0),
(17, '彼得圣堡建成记', 'lyk', '艾森出版社', '文学', '2017-01-01', 'q.png', 1000, 1000, 1),
(18, '东宫自传', 'lyk', '艾森出版社', '文学', '2017-01-01', 'r.png', 1000, 1000, 0),
(19, '紫禁城', 'lyk', '艾森出版社', '文学', '2017-01-01', 's.png', 1000, 1000, 1),
(20, '哈坤铁路', 'lyk', '艾森出版社', '文学', '2017-01-01', 't.png', 1000, 1000, 0);

-- 添加一个管理员
INSERT INTO `lm_admins` (`id`, `name`, `pwd`, `authority`) VALUES
(1, 'lyk', 'e10adc3949ba59abbe56e057f20f883e', 1);

-- 添加一个用户
INSERT INTO `lm_users` (`id`, `name`, `pwd`, `credit`, `isBorrow`, `bookNum`) VALUES
(1, 'lyk', 'e10adc3949ba59abbe56e057f20f883e', 100, 0, 0);

-- 添加借书记录
INSERT INTO `lm_borrow` (`id`, `user`, `bookName`, `bookNum`, `borrowDate`, `returnDate`, `type`, `isRecord`) VALUES
(1, 'lyk', '哈利波特', 1, '2017-01-22', '2017-02-22', 0, 0),
(2, 'lyk', '星际穿越', 1, '2017-01-23', '2017-02-23', 0, 0),
(3, 'lyk', '爱迪生到发明', 1, '2017-01-24', '2017-02-24', 0, 0),
(4, 'lyk', '莎士比亚诗集', 1, '2017-01-25', '2017-02-25', 0, 0),
(5, 'lyk', '佛门盛典', 1, '2017-01-26', '2017-02-26', 0, 0);

-- 添加过期的预约，检验功能
INSERT INTO `lm_order` (`id`, `user`, `bookName`, `bookNum`, `borrowDate`, `maintainTime`, `type`, `isRecord`) VALUES
(1, 'lyk', '哈利波特', 1, '2017-01-23', 1, 0, 0);