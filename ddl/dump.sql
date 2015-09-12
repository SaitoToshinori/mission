-- MySQL dump 10.13  Distrib 5.6.25, for osx10.10 (x86_64)
--
-- Host: localhost    Database: mission
-- ------------------------------------------------------
-- Server version	5.6.25

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
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `text` text,
  `publication` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `isbn` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (15,'関西肉本','京阪神エルマガジン社','京阪神エルマガジン社','','2012年07月','802','9784874353882',NULL),(16,'纏う透き色の','羽住都','東京創元社','自然と一体化し幻想世界に遊ぶ絵師、羽住都１０年ぶりの画集。','2015年02月21日','3240','9784488014254',NULL),(17,'落羽松','神尾久美子','KADOKAWA','','2015年06月','2916','9784046529695','http://thumbnail.image.rakuten.co.jp/@0_mall/book/cabinet/9695/9784046529695.jpg?_ex=64x64'),(18,'魚','本村浩之','学研教育出版','魚のことが何でもわかる！１３００種以上掲載！！','2015年06月30日','2376','9784052040160','http://thumbnail.image.rakuten.co.jp/@0_mall/book/cabinet/0160/9784052040160.jpg?_ex=64x64'),(19,'証拠は天から地から','岡田尚','新日本出版社','','2015年07月','1836','9784406059183','http://thumbnail.image.rakuten.co.jp/@0_mall/book/cabinet/9183/9784406059183.jpg?_ex=64x64'),(20,'ハイレゾオーディオ道、はじめます！','学研パブリッシング','学研マーケティング','','2015年09月28日','540','9784056109382','http://thumbnail.image.rakuten.co.jp/@0_mall/book/cabinet/noimage_01.gif?_ex=64x64'),(21,'揖保乃糸そうめん献立帖','兵庫県手延素麺協同組合','ワニブックス','５分でできるお手軽メニューから「消化がよい」などお悩み別まで。簡単に作れて、一年を通して楽しめるとっておきのそうめん７１品。','2015年07月','1296','9784847093500','http://thumbnail.image.rakuten.co.jp/@0_mall/book/cabinet/3500/9784847093500.jpg?_ex=64x64'),(22,'心が変われば地球は変わる','木村秋則','扶桑社','','2015年09月25日','699','9784594073503','http://thumbnail.image.rakuten.co.jp/@0_mall/book/cabinet/noimage_01.gif?_ex=64x64'),(23,'求道者','佐々井秀嶺','サンガ','インド仏教一億人の指導者として、世界に名をとどろかせる日本人僧侶・佐々井秀嶺。カースト制度による根深い差別がある地で、最下層の不可触民たちを仏教徒に改宗させ、その人間を解放させ続けた四七年の歴史。権謀術数渦巻くインドの社会の深奥に分け入り、愛され、信頼され、そして裏切られ、それでも救済と求道の信念を曲げることはない。インド人を最も愛し、そして最も憎んだ男ー運命に召喚された男の偽らざる肉声。','2015年01月','799','9784865640069','http://thumbnail.image.rakuten.co.jp/@0_mall/book/cabinet/0069/9784865640069.jpg?_ex=64x64'),(24,'ゆず酒ロック！','ゆず','トーキングロック','音楽雑誌「トーキングロック！」で掲載してきた打ち上げインタビュー＝ツアーの打ち上げの席でお酒を飲みながら語った、その日のライブの感想と、レアな裏話に、お酒が進む中で飛び出す冗句と、真面目な音楽談義など。新たに敢行した北川悠仁と岩沢厚治のソロインタビュー（ソロ飲み会）と、オリジナル写真も収録。ゆずっこ必携の１冊です！','2015年08月','1620','9784903868127','http://thumbnail.image.rakuten.co.jp/@0_mall/book/cabinet/8127/9784903868127.jpg?_ex=64x64'),(25,'国際情報戦に勝つために','太田文雄','芙蓉書房出版','戦後７０周年の節目の年、周辺諸国からの悪意に満ちた情報発信戦に勝てない日本、「情報」に疎い日本の現状を豊富な事例で紹介し、情報力強化の具体策を提言。情報戦で完敗した近・現代史を見直し、そこから学べる教訓を示す。','2015年06月','1944','9784829506530','http://thumbnail.image.rakuten.co.jp/@0_mall/book/cabinet/6530/9784829506530.jpg?_ex=64x64');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favorites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `situation` varchar(255) DEFAULT NULL,
  `review` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `evaluation` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorites`
--

LOCK TABLES `favorites` WRITE;
/*!40000 ALTER TABLE `favorites` DISABLE KEYS */;
INSERT INTO `favorites` VALUES (7,'今読んでる','',1,18,'評価していない'),(8,'読みたい','会心の一冊',1,19,'かなり評価する'),(9,'読み終わった','微妙',1,20,'あまり評価していない'),(10,'今読んでる','腹減り',1,21,'評価する'),(11,'積読','地球になれた',1,22,'かなり評価する'),(12,'読み終わった','哲学',1,23,'評価する'),(13,'読み終わった','栄光の架橋',1,24,'評価する'),(14,'積読','情報は大事',1,25,'かなり評価する'),(15,'読みたい','コツコツ読みたい',1,25,'評価していない'),(16,'今読んでる','読む気失せた',1,25,'評価していない'),(20,'読みたい','評判良し',2,24,'かなり評価する'),(21,'読み終わった','お帰り',2,16,'評価する'),(22,'読み終わった','goh',2,25,'評価していない');
/*!40000 ALTER TABLE `favorites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'tennennsui','tennennsui@gmail.com','$2a$10$0PUVJSvt0Tc/RrcjqWg6.uNAFETpo/u9o0rfIyfJB5sxGMKH4ddea','2015-09-07 10:48:15','2015-09-07 10:48:15'),(2,'desk','desk@gmail.com','$2a$10$G2rGey6LKh3Q6qbjM95VzOwBHRuJLVYwBMPaTUAsFeH/Vw8gGaxc2','2015-09-10 17:02:02','2015-09-10 17:02:02');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-09-12 17:07:49
