-- MySQL dump 10.13  Distrib 5.6.20, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: mp
-- ------------------------------------------------------
-- Server version	5.6.20

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
-- Table structure for table `mp_admin_user`
--
set names utf8;
create database mp;
use mp;

DROP TABLE IF EXISTS `mp_admin_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mp_admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `nickname` varchar(20) NOT NULL COMMENT '昵称',
  `email` varchar(25) NOT NULL COMMENT 'Email',
  `role_id` int(11) DEFAULT NULL COMMENT '角色ID',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态(1:正常,0:停用)',
  `mobile` varchar(20) NOT NULL COMMENT '手机号',
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_login_ip` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='用户表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mp_admin_user`
--

LOCK TABLES `mp_admin_user` WRITE;
/*!40000 ALTER TABLE `mp_admin_user` DISABLE KEYS */;
INSERT INTO `mp_admin_user` VALUES (1,'admin','c3284d0f94606de1fd2af172aba15bf3','toryzen','admin@admin.com',1,1,'','2016-12-05 15:24:22','127.0.0.1'),(2,'auditor','1f32aa4c9a1d2ea010adcf2348166a04','auditor','',3,1,'','2016-12-05 10:17:26',NULL);
/*!40000 ALTER TABLE `mp_admin_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mp_auth`
--

DROP TABLE IF EXISTS `mp_auth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mp_auth` (
  `node_id` int(11) NOT NULL COMMENT '节点ID',
  `role_id` int(11) NOT NULL COMMENT '角色ID',
  UNIQUE KEY `nid_rid` (`node_id`,`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='角色与节点对应表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mp_auth`
--

LOCK TABLES `mp_auth` WRITE;
/*!40000 ALTER TABLE `mp_auth` DISABLE KEYS */;
INSERT INTO `mp_auth` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1);
/*!40000 ALTER TABLE `mp_auth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mp_menu`
--

DROP TABLE IF EXISTS `mp_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mp_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL COMMENT '导航名称',
  `node_id` int(11) DEFAULT NULL COMMENT '节点ID',
  `p_id` int(11) DEFAULT NULL COMMENT '导航父id',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` int(11) DEFAULT '1' COMMENT '状态(1:正常,0:停用)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='菜单表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mp_menu`
--

LOCK TABLES `mp_menu` WRITE;
/*!40000 ALTER TABLE `mp_menu` DISABLE KEYS */;
INSERT INTO `mp_menu` VALUES (1,'后台管理',NULL,NULL,9,1),(2,'节点管理',5,1,2,1),(3,'导航管理',1,1,1,1),(4,'人员管理',14,1,4,1),(5,'角色管理',9,1,3,1),(6,'一级菜单',0,NULL,0,1),(7,'二级节点',18,6,1,1),(8,'一级菜单2',NULL,NULL,2,1),(9,'二级菜单',NULL,8,1,1),(10,'三级节点',18,9,1,1);
/*!40000 ALTER TABLE `mp_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mp_node`
--

DROP TABLE IF EXISTS `mp_node`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mp_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dirc` varchar(20) NOT NULL COMMENT '目录',
  `cont` varchar(10) NOT NULL COMMENT '控制器',
  `func` varchar(10) NOT NULL COMMENT '方法',
  `memo` varchar(25) DEFAULT NULL COMMENT '备注',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态(1:正常,0:停用)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `d_c_f` (`dirc`,`cont`,`func`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='节点表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mp_node`
--

LOCK TABLES `mp_node` WRITE;
/*!40000 ALTER TABLE `mp_node` DISABLE KEYS */;
INSERT INTO `mp_node` VALUES (1,'manage','menu','index','导航管理',1),(2,'manage','menu','edit','导航修改',1),(3,'manage','menu','delete','导航删除',1),(4,'manage','menu','add','导航新增',1),(5,'manage','node','index','节点管理',1),(6,'manage','node','add','节点新增',1),(7,'manage','node','delete','节点删除',1),(8,'manage','node','edit','节点修改',1),(9,'manage','role','index','角色管理',1),(10,'manage','role','action','角色赋权',1),(11,'manage','role','delete','角色删除',1),(12,'manage','role','edit','角色修改',1),(13,'manage','role','add','角色新增',1),(14,'manage','member','index','人员管理',1),(15,'manage','member','edit','人员修改',1),(16,'manage','member','delete','人员删除',1),(17,'manage','member','add','人员新增',1),(18,'product','index','index','测试用节点',1);
/*!40000 ALTER TABLE `mp_node` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mp_role`
--

DROP TABLE IF EXISTS `mp_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mp_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(25) NOT NULL COMMENT '角色名',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态(1:正常,0停用)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `rolename` (`rolename`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='角色表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mp_role`
--

LOCK TABLES `mp_role` WRITE;
/*!40000 ALTER TABLE `mp_role` DISABLE KEYS */;
INSERT INTO `mp_role` VALUES (1,'管理员',1),(2,'总公司',0),(3,'分公司',1),(12,'test',0);
/*!40000 ALTER TABLE `mp_role` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-06 10:44:14
