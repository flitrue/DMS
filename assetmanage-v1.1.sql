-- MySQL dump 10.13  Distrib 5.6.35, for Linux (x86_64)
--
-- Host: localhost    Database: assetmanage
-- ------------------------------------------------------
-- Server version	5.6.35

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `am_album`
--

DROP TABLE IF EXISTS `am_album`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_album` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `mes` varchar(255) DEFAULT NULL,
  `createtime` date DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `viewnum` int(11) DEFAULT '0' COMMENT '访问数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_album`
--

LOCK TABLES `am_album` WRITE;
/*!40000 ALTER TABLE `am_album` DISABLE KEYS */;
/*!40000 ALTER TABLE `am_album` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am_albumview`
--

DROP TABLE IF EXISTS `am_albumview`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_albumview` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT '0',
  `time` datetime DEFAULT NULL,
  `aid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_albumview`
--

LOCK TABLES `am_albumview` WRITE;
/*!40000 ALTER TABLE `am_albumview` DISABLE KEYS */;
/*!40000 ALTER TABLE `am_albumview` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am_category`
--

DROP TABLE IF EXISTS `am_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT '设备类别',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_category`
--

LOCK TABLES `am_category` WRITE;
/*!40000 ALTER TABLE `am_category` DISABLE KEYS */;
INSERT INTO `am_category` VALUES (1,'苹果一体机'),(2,'台式一体机'),(3,'苹果笔记本'),(4,'笔记本'),(5,'打印机'),(6,'台式机'),(7,'工具'),(8,'其他');
/*!40000 ALTER TABLE `am_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am_depart`
--

DROP TABLE IF EXISTS `am_depart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_depart` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL COMMENT '编号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_depart`
--

LOCK TABLES `am_depart` WRITE;
/*!40000 ALTER TABLE `am_depart` DISABLE KEYS */;
INSERT INTO `am_depart` VALUES (1,'技术部','A'),(2,'行政部','B'),(3,'管理部','C'),(4,'财务部','D');
/*!40000 ALTER TABLE `am_depart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am_device`
--

DROP TABLE IF EXISTS `am_device`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_device` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT '设备名称',
  `brand` varchar(50) DEFAULT NULL COMMENT '设备品牌',
  `version` varchar(50) DEFAULT NULL COMMENT '设备型号',
  `code` varchar(50) DEFAULT NULL COMMENT '序列号',
  `tag` varchar(255) DEFAULT NULL COMMENT '设备标签',
  `photo1` varchar(255) DEFAULT NULL,
  `photo2` varchar(255) DEFAULT NULL,
  `photo3` varchar(255) DEFAULT NULL,
  `price` decimal(6,2) DEFAULT '0.00',
  `depart` varchar(50) DEFAULT NULL COMMENT '设备所在部门',
  `group` varchar(50) DEFAULT NULL COMMENT '设备所在组',
  `keyinfo` varchar(200) DEFAULT NULL COMMENT '关键信息',
  `buytime` date DEFAULT NULL COMMENT '设备购买时间',
  `remarks` varchar(255) DEFAULT NULL COMMENT '设备备注',
  `usetime` date DEFAULT NULL COMMENT '领用日期',
  `buyer` varchar(50) DEFAULT NULL COMMENT '购买人',
  `category` int(11) DEFAULT '1',
  `buyway` varchar(100) DEFAULT NULL COMMENT '设备购买途径',
  `invoice1` varchar(255) DEFAULT NULL COMMENT '发票照片路径',
  `invoice2` varchar(255) DEFAULT NULL COMMENT '发票照片路径',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_device`
--

LOCK TABLES `am_device` WRITE;
/*!40000 ALTER TABLE `am_device` DISABLE KEYS */;
INSERT INTO `am_device` VALUES (81,'戴尔(DELL)Inspiron 24-3459(w12C)','戴尔(DELL)','Inspiron 24-3459(w12C)','09DVMPA002','戴尔,DELL,灵越','584a08e95ff17.jpg','584a08e960741.jpg','584a08e960ef6.jpg',5199.00,'1','2','i5 8G内存 500G硬盘 4核CPU','2016-12-08','','0000-00-00','admin(812863096@qq.com)',2,'京东商城',NULL,NULL),(82,'戴尔(DELL)Inspiron 24-3459(w12C)','戴尔(DELL)Inspiron 24-3459(w12C)','Inspiron 24-3459(w12C)','09DVMPA00','戴尔,DELL,灵越','584a0bcae115e.jpg','584a0bcae152d.jpg','584a0d82d9c52.jpg',5199.00,'1','8','i5 8G内存 500G硬盘 4核CPU','2016-12-08','','0000-00-00','admin(812863096@qq.com)',2,'','584a0bcae1c8d.jpg',NULL),(83,'公牛插板GN-B2080(3-3)','公牛插板GN-B2080(3-3)','GN-B2080(3-3)','6922646108879','公牛,插板','584a25db7044e.jpg','584a25db70bf1.jpg','584a25db71399.jpg',112.00,'1','2','线长3m 最大功率250W 插口8个','2016-12-08','领取两个插板，实习组桌子下使用','2016-12-08','admin(812863096@qq.com)',8,'京东商城','584a25db71eff.jpg',NULL),(84,'公牛插板GN-B2080(3-3)','公牛插板','GN-B2080(3-3)','6922646108879-1','公牛,插板','584a3d0806e8e.jpg','584a3d0808027.jpg','584a3d0808731.jpg',112.00,'1','4','线长3m 最大功率250W 插口8个','2016-12-08','数量两个，库房存放，以备后用','0000-00-00','admin(812863096@qq.com)',8,'京东商城','584a3d0808cb6.jpg',NULL);
/*!40000 ALTER TABLE `am_device` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am_document`
--

DROP TABLE IF EXISTS `am_document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_document` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT '文档名',
  `oldname` varchar(100) DEFAULT NULL COMMENT '文档上传前的名字',
  `uploadtime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL COMMENT '文档大小',
  `source` varchar(100) DEFAULT NULL COMMENT '文档来源',
  `remarks` varchar(200) DEFAULT NULL COMMENT '备注',
  `uid` int(11) DEFAULT NULL COMMENT '上传人',
  `tag` varchar(100) DEFAULT NULL COMMENT '文档类别',
  `category` varchar(50) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL COMMENT '文档存放地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_document`
--

LOCK TABLES `am_document` WRITE;
/*!40000 ALTER TABLE `am_document` DISABLE KEYS */;
/*!40000 ALTER TABLE `am_document` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am_documentcategory`
--

DROP TABLE IF EXISTS `am_documentcategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_documentcategory` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_documentcategory`
--

LOCK TABLES `am_documentcategory` WRITE;
/*!40000 ALTER TABLE `am_documentcategory` DISABLE KEYS */;
INSERT INTO `am_documentcategory` VALUES (1,'技术文档'),(2,'使用手册'),(3,'专利文档');
/*!40000 ALTER TABLE `am_documentcategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am_domain`
--

DROP TABLE IF EXISTS `am_domain`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_domain` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_domain`
--

LOCK TABLES `am_domain` WRITE;
/*!40000 ALTER TABLE `am_domain` DISABLE KEYS */;
INSERT INTO `am_domain` VALUES (1,'wordemotion.com'),(2,'wordemotion.cn'),(3,'stockemotion.com'),(4,'stockemotion.cn'),(5,'wordemotion.net'),(6,'stockemotion.net');
/*!40000 ALTER TABLE `am_domain` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am_group`
--

DROP TABLE IF EXISTS `am_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `depart_id` int(11) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_group`
--

LOCK TABLES `am_group` WRITE;
/*!40000 ALTER TABLE `am_group` DISABLE KEYS */;
INSERT INTO `am_group` VALUES (1,'数据组',1,'A'),(2,'实习组',1,'B'),(3,'行政组',2,'C'),(4,'管理组',3,'D'),(5,'PHP组',1,'E'),(6,'IOS组',1,'F'),(7,'Android组',1,'G'),(8,'测试组',1,'H');
/*!40000 ALTER TABLE `am_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am_lateviewuser`
--

DROP TABLE IF EXISTS `am_lateviewuser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_lateviewuser` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `brower` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_lateviewuser`
--

LOCK TABLES `am_lateviewuser` WRITE;
/*!40000 ALTER TABLE `am_lateviewuser` DISABLE KEYS */;
INSERT INTO `am_lateviewuser` VALUES (17,35,'2017-01-02 18:01:31','121.69.56.190','Chrome');
/*!40000 ALTER TABLE `am_lateviewuser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am_log`
--

DROP TABLE IF EXISTS `am_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `time` datetime DEFAULT NULL COMMENT '日志时间',
  `info` varchar(255) DEFAULT NULL,
  `transferor` varchar(50) DEFAULT NULL COMMENT '转让人',
  `transferee` varchar(50) DEFAULT NULL COMMENT '受让人',
  `operator` varchar(50) DEFAULT NULL COMMENT '操作人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_log`
--

LOCK TABLES `am_log` WRITE;
/*!40000 ALTER TABLE `am_log` DISABLE KEYS */;
INSERT INTO `am_log` VALUES (1,'2016-09-15 15:49:08','添加员工王平平',NULL,NULL,'admin');
/*!40000 ALTER TABLE `am_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am_loginbg`
--

DROP TABLE IF EXISTS `am_loginbg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_loginbg` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_loginbg`
--

LOCK TABLES `am_loginbg` WRITE;
/*!40000 ALTER TABLE `am_loginbg` DISABLE KEYS */;
INSERT INTO `am_loginbg` VALUES (1,'5869f8ec4b03a.png'),(2,'tg-bird1fbc69.png');
/*!40000 ALTER TABLE `am_loginbg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am_patent`
--

DROP TABLE IF EXISTS `am_patent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_patent` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT '产权名字',
  `remarks` varchar(1000) CHARACTER SET utf8 DEFAULT NULL COMMENT '产权内容描述',
  `category` int(11) DEFAULT NULL COMMENT '专利的类型',
  `url` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '专利文件地址',
  `tag` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `operator` int(11) DEFAULT NULL COMMENT '操作人id',
  `size` varchar(50) CHARACTER SET utf8 DEFAULT NULL COMMENT '文件大小',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_patent`
--

LOCK TABLES `am_patent` WRITE;
/*!40000 ALTER TABLE `am_patent` DISABLE KEYS */;
/*!40000 ALTER TABLE `am_patent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am_patentcategory`
--

DROP TABLE IF EXISTS `am_patentcategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_patentcategory` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_patentcategory`
--

LOCK TABLES `am_patentcategory` WRITE;
/*!40000 ALTER TABLE `am_patentcategory` DISABLE KEYS */;
INSERT INTO `am_patentcategory` VALUES (1,'发明专利'),(2,'外观专利'),(3,'实用新型专利');
/*!40000 ALTER TABLE `am_patentcategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am_patentstatus`
--

DROP TABLE IF EXISTS `am_patentstatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_patentstatus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(11) DEFAULT NULL COMMENT '专利申请状态',
  `starttime` datetime DEFAULT NULL COMMENT '那种状态下的开始时间',
  `endtime` datetime DEFAULT NULL COMMENT '那种状态下的结束时间',
  `pid` int(11) DEFAULT NULL COMMENT '专利的id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_patentstatus`
--

LOCK TABLES `am_patentstatus` WRITE;
/*!40000 ALTER TABLE `am_patentstatus` DISABLE KEYS */;
INSERT INTO `am_patentstatus` VALUES (75,1,'2016-11-24 14:28:44','2016-11-21 14:28:49',24),(76,2,'2016-11-21 14:28:49','2016-11-21 14:28:53',24),(77,3,'2016-11-21 14:28:53','2016-11-21 14:29:30',24),(78,4,'2016-11-21 14:29:31','2016-11-21 14:29:35',24),(79,5,'2016-11-21 14:29:35','2016-11-21 14:29:43',24),(82,1,'2016-11-17 00:00:00',NULL,25),(83,1,'2017-01-04 00:00:00',NULL,26),(84,1,'2015-12-17 00:00:00','2017-01-02 10:35:50',27),(85,2,'2017-01-02 10:35:50',NULL,27);
/*!40000 ALTER TABLE `am_patentstatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `am_patentview`
--

DROP TABLE IF EXISTS `am_patentview`;
/*!50001 DROP VIEW IF EXISTS `am_patentview`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `am_patentview` AS SELECT 
 1 AS `id`,
 1 AS `starttime`,
 1 AS `cid`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `am_photo`
--

DROP TABLE IF EXISTS `am_photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_photo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `createtime` date DEFAULT NULL,
  `bigphoto` varchar(255) DEFAULT NULL,
  `smallphoto` varchar(255) DEFAULT NULL,
  `aid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_photo`
--

LOCK TABLES `am_photo` WRITE;
/*!40000 ALTER TABLE `am_photo` DISABLE KEYS */;
/*!40000 ALTER TABLE `am_photo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am_slide`
--

DROP TABLE IF EXISTS `am_slide`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_slide` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url1` varchar(200) DEFAULT NULL,
  `url2` varchar(200) DEFAULT NULL,
  `url3` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_slide`
--

LOCK TABLES `am_slide` WRITE;
/*!40000 ALTER TABLE `am_slide` DISABLE KEYS */;
INSERT INTO `am_slide` VALUES (1,'5869f8d7e9384.png','5869f8d7e98aa.png','5869f8d7ea33d.png');
/*!40000 ALTER TABLE `am_slide` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am_transaction`
--

DROP TABLE IF EXISTS `am_transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_transaction` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL COMMENT '员工ID',
  `did` int(11) DEFAULT NULL COMMENT '设备id',
  `status` varchar(50) DEFAULT '未分配' COMMENT '设备状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_transaction`
--

LOCK TABLES `am_transaction` WRITE;
/*!40000 ALTER TABLE `am_transaction` DISABLE KEYS */;
INSERT INTO `am_transaction` VALUES (40,NULL,81,'未分配'),(41,NULL,82,'未分配'),(42,0,83,'未分配'),(43,NULL,84,'未分配');
/*!40000 ALTER TABLE `am_transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am_user`
--

DROP TABLE IF EXISTS `am_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '员工ID',
  `sex` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL COMMENT '员工姓名',
  `password` varchar(255) DEFAULT NULL,
  `power` int(11) DEFAULT '0' COMMENT '权限',
  `status` varchar(50) DEFAULT '审核中' COMMENT '员工状态',
  `brith` date DEFAULT '0000-00-00' COMMENT '生日',
  `review` int(11) DEFAULT '0' COMMENT '审核状态',
  `time` date DEFAULT NULL COMMENT '入职时间',
  `phone` varchar(11) DEFAULT NULL,
  `weixin` varchar(50) DEFAULT NULL,
  `qq` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `comment` varchar(100) DEFAULT NULL COMMENT '个人简介',
  `group` varchar(50) DEFAULT NULL COMMENT '小组',
  `depart` varchar(50) DEFAULT NULL COMMENT '部门',
  `avatar` varchar(255) DEFAULT NULL COMMENT '员工头像',
  `idcard` varchar(50) DEFAULT NULL COMMENT '身份证号',
  `code` varchar(50) DEFAULT NULL COMMENT '员工编号',
  `big_avatar` varchar(255) DEFAULT NULL COMMENT '用户小头像',
  `leavetime` date DEFAULT NULL COMMENT '离职时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_user`
--

LOCK TABLES `am_user` WRITE;
/*!40000 ALTER TABLE `am_user` DISABLE KEYS */;
INSERT INTO `am_user` VALUES (1,'男','admin',NULL,1,'在职','1992-06-11',1,'2016-10-01','15735926271','w34638660','812863096','812863096@qq.com','爱拼才会赢','实习组','技术部','','','AD00','',NULL),(27,'女','付珊',NULL,0,'在职','2016-11-10',1,'2016-10-08','18735926523','','','fushan@wordemotion.com',NULL,'测试组','技术部','/Public/assets/avatars/croppedImg_1116585210.jpeg','140225199205110554','AH06','/Public/Uploads/big_avatars/一卡通 001.jpg',NULL),(35,'男','王平平','60f6369dbad99e06660f0a18b361f9ff',1,'在职','1992-05-14',1,'2016-11-14','15735926279','','812863096','wangpingping@wordemotion.com','','行政组','行政部','/Public/assets/avatars/583007bdbe76c.jpg','140155222222222',NULL,'/Public/Uploads/big_avatars/583007bdbe76c.jpg',NULL),(36,'男','吴威','f9fdc4a5bb1b9a23ca0f9417c517ed3b',0,'在职','1992-05-13',1,'2016-11-09','13166550910','fd','872287425','wuwei@wordemotion.com',NULL,'PHP组','技术部',NULL,'640302199405101715',NULL,NULL,NULL),(58,'男','黄超','21972878276deeb5a1b5131e4eed9d59',0,'审核中','1982-10-11',0,'2015-03-02','13811423600','','7683308','huangchao@wordemotion.com',NULL,'测试组','技术部',NULL,'42102319821011121X',NULL,NULL,NULL);
/*!40000 ALTER TABLE `am_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `am_patentview`
--

/*!50001 DROP VIEW IF EXISTS `am_patentview`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `am_patentview` AS select `a`.`id` AS `id`,`b`.`starttime` AS `starttime`,`a`.`category` AS `cid` from (`am_patent` `a` left join `am_patentstatus` `b` on((`a`.`id` = `b`.`pid`))) where (`b`.`status` = 1) group by `a`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-01-07 11:17:03
