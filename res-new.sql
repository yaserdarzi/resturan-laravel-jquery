-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2016 at 03:13 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `res`
--

-- --------------------------------------------------------

--
-- Table structure for table `z_access_group`
--

DROP TABLE IF EXISTS `z_access_group`;
CREATE TABLE IF NOT EXISTS `z_access_group` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` int(10) UNSIGNED DEFAULT NULL,
  `access_list` mediumtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_access_group`
--

INSERT INTO `z_access_group` (`id`, `admin_id`, `access_list`) VALUES
(1, 2, '|سفارشات||سفارشات ثبت شده||مصرف پرسنل||ثبت مصرف پرسنل||انبارداری||ثبت مواد||تنظیمات منو||اضافه کردن گروه||اضافه کردن غذا|'),
(2, 1, 'all'),
(3, 3, '|سفارشات||سفارشات ثبت شده||بارگذاری تصویر مشخصات محیط|'),
(4, 4, 'all'),
(7, 6, '|سفارشات||مدیریت منابع انسانی||ثبت مصرف پرسنل||مرخصی||تسهیلات||انبارداری||ثبت مواد||تعریف واحد||باشگاه مشتریان||ثبت کاربر جدید|'),
(11, 5, 'all');

-- --------------------------------------------------------

--
-- Table structure for table `z_account_transaction`
--

DROP TABLE IF EXISTS `z_account_transaction`;
CREATE TABLE IF NOT EXISTS `z_account_transaction` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `source_account` int(11) DEFAULT NULL,
  `dest_account` int(11) DEFAULT NULL,
  `cash` bigint(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `desc` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_account_transaction`
--

INSERT INTO `z_account_transaction` (`id`, `source_account`, `dest_account`, `cash`, `date`, `desc`) VALUES
(1, 1, 1, 50000, '2015-11-29', 'تستی'),
(2, 1, 1, 7500, '2015-11-29', 'جابجایی معمولی'),
(3, 1, 1, 10000, '2015-11-30', ''),
(4, 1, 4, 20000, '2016-03-12', ''),
(5, 1, 4, 200000, '2016-03-12', ''),
(7, 1, 1, 4444, '2016-08-01', 'ffff'),
(8, 1, 1, 33, '2016-08-01', 'sdfsdf'),
(9, 1, 1, 1111111, '2016-08-01', 'asdasdasd'),
(10, 4, 17, 109292, '2016-08-01', 'asd'),
(11, 12, 17, 345, '2016-08-02', 'gdfg'),
(12, 1, 1, 222, '2016-08-16', 'asdasd');

-- --------------------------------------------------------

--
-- Table structure for table `z_admins`
--

DROP TABLE IF EXISTS `z_admins`;
CREATE TABLE IF NOT EXISTS `z_admins` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `username` text,
  `password` text,
  `email` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_admins`
--

INSERT INTO `z_admins` (`id`, `name`, `tel`, `username`, `password`, `email`) VALUES
(1, 'حسین احمدی', '09369190591', 'hossein', 'ha8370872', 'h.ahmadicorp@gmail.com'),
(2, 'روزبه حدادپور', '093795545454', 'roozbeh', '2201010', 'roozbeh.haddad@gmail.com'),
(4, 'جاوید هادی', '0912345678', 'javid', '123456', 'jkdfs@fmkgmf.com'),
(5, 'ایمان حسینی', '0912345678', 'iman', '123456', 'jkdfs@fmkgmf.com'),
(6, 'سعید رضایی', '09123456789', 'saeid', '12131415', 's.rezaeicorp@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `z_area_pics`
--

DROP TABLE IF EXISTS `z_area_pics`;
CREATE TABLE IF NOT EXISTS `z_area_pics` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` text,
  `desc` text,
  `path` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_area_pics`
--

INSERT INTO `z_area_pics` (`id`, `title`, `desc`, `path`) VALUES
(1, 'طبقه اول', 'مخصوص جوانان', 'metbkk_bkg_nahm_restaurant.jpg'),
(2, 'طبقه دوم', 'مخصوص خانواده ها', 'restaurant-07.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `z_bank_account`
--

DROP TABLE IF EXISTS `z_bank_account`;
CREATE TABLE IF NOT EXISTS `z_bank_account` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` text,
  `account_number` bigint(20) DEFAULT NULL,
  `sheba_number` text,
  `card_number` bigint(20) DEFAULT NULL,
  `account_type` text,
  `check` tinyint(4) DEFAULT NULL,
  `cash` bigint(20) UNSIGNED DEFAULT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_bank_account`
--

INSERT INTO `z_bank_account` (`id`, `name`, `account_number`, `sheba_number`, `card_number`, `account_type`, `check`, `cash`, `status`) VALUES
(1, 'ملی', 102320206154, 'IR252321541155', 603799112523210, 'سپرده کوتاه مدت', NULL, 648445, 0),
(4, 'ملت', 60371723983841, 'IR930243y24892424987', 0, 'شپرده', 1, 0, 0),
(12, 'sdfsdf', 22, '345345', 345345, '345', NULL, 0, 0),
(17, 'سینا', 567567567567567, 'IR123456', 132, 'جاری', NULL, 0, 0),
(18, 'asdasd', 234, '234', 234234, '234234', NULL, 0, 1),
(19, 'sffsdf', 4534, '45345', 35345, '3454', NULL, 0, 1),
(20, 'zxczc', 0, 'ewrwer', 0, 'werwer', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `z_coupons`
--

DROP TABLE IF EXISTS `z_coupons`;
CREATE TABLE IF NOT EXISTS `z_coupons` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `expire` date DEFAULT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT NULL,
  `amount` bigint(20) UNSIGNED DEFAULT NULL,
  `max_per_user` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_coupons`
--

INSERT INTO `z_coupons` (`id`, `code`, `expire`, `type`, `amount`, `max_per_user`) VALUES
(1, '64432221', '2016-06-20', 1, 25, 1),
(2, '13276983', '2016-06-20', 2, 45000, 5),
(3, '22860229', '2016-06-20', 1, 15, 5),
(4, '89895660', '2016-06-20', 1, 20, 1),
(5, '93207333', '2016-06-20', 1, 50, 1),
(6, '26046170', '2016-08-02', 1, 22, 10),
(7, '80812299', '2016-08-21', 1, 22, 1);

-- --------------------------------------------------------

--
-- Table structure for table `z_coupons_on_after_buy`
--

DROP TABLE IF EXISTS `z_coupons_on_after_buy`;
CREATE TABLE IF NOT EXISTS `z_coupons_on_after_buy` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `expire` date DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `amount` bigint(20) UNSIGNED DEFAULT NULL,
  `from_fee` bigint(20) UNSIGNED DEFAULT NULL,
  `to_fee` bigint(20) UNSIGNED DEFAULT NULL,
  `type_type` tinyint(4) DEFAULT NULL,
  `max_per_user` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_coupons_on_after_buy`
--

INSERT INTO `z_coupons_on_after_buy` (`id`, `expire`, `type`, `amount`, `from_fee`, `to_fee`, `type_type`, `max_per_user`) VALUES
(2, '2016-06-16', 2, 15, 10000, 600000, 1, 0),
(5, '2016-07-07', 1, 90, 40000, 9000000, 1, 0),
(6, '2016-08-19', 1, 15, 100, 500, 1, 0),
(7, '2017-07-17', 1, 25, 200, 600, 2, 4),
(8, '2016-08-16', 1, 10, 100, 200, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `z_coupons_use`
--

DROP TABLE IF EXISTS `z_coupons_use`;
CREATE TABLE IF NOT EXISTS `z_coupons_use` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `code` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_coupons_use`
--

INSERT INTO `z_coupons_use` (`id`, `user_id`, `code`, `date`) VALUES
(1, 2045, 64432221, '2016-06-07'),
(2, 2045, 64432221, '2016-06-07'),
(3, 2045, 64432221, '2016-06-07'),
(4, 2045, 1, '2016-06-07');

-- --------------------------------------------------------

--
-- Table structure for table `z_field_types`
--

DROP TABLE IF EXISTS `z_field_types`;
CREATE TABLE IF NOT EXISTS `z_field_types` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_field_types`
--

INSERT INTO `z_field_types` (`id`, `name`, `title`) VALUES
(1, 'input', 'فیلد متنی'),
(2, 'textarea', 'فیلد متنی بزرگ(مناسب برای درج آدرس و توضیحات)'),
(3, 'select', 'منوی کشویی'),
(4, 'option', 'انتخابی'),
(5, 'date', 'تاریخ');

-- --------------------------------------------------------

--
-- Table structure for table `z_foods`
--

DROP TABLE IF EXISTS `z_foods`;
CREATE TABLE IF NOT EXISTS `z_foods` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) DEFAULT NULL,
  `title` text,
  `desc` text,
  `cook_time` text,
  `price` text,
  `image` text,
  `thumb` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_foods`
--

INSERT INTO `z_foods` (`id`, `cat_id`, `title`, `desc`, `cook_time`, `price`, `image`, `thumb`) VALUES
(1, 1, 'پیتزا تنوری', 'فلفل،سوسیس،کالباس،گوجه،فلفل دلمه ای،', '20', '20000', '1447222829_food-04 (1).jpg', '1447222829_food-04 (1).jpg'),
(3, 1, 'پیتزا پپرونی', 'فلفل،سوسیس،کالباس', '10', '15000', '1447222867_Good_Food_Display_-_NCI_Visuals_Online.jpg', '1447222867_Good_Food_Display_-_NCI_Visuals_Online.jpg'),
(4, 1, 'پیتزا مخلوط', 'سوسیس،کالباس،گوجه،زیتون', '12', '22000', '1447222867_healthfitnessrevolution-com.jpg', '1447222867_healthfitnessrevolution-com.jpg'),
(5, 1, 'پیتزا یونانی', 'سوسیس،کالباس،زیتون،ذرت', '15', '24000', '1447222867_Junk-food-2.jpg', '1447222867_Junk-food-2.jpg'),
(6, 2, 'همبرگر', 'گوشت،کاهو،کلم،', '8', '14000', '1447222950_Junk-food-2.jpg', '1447222950_Junk-food-2.jpg'),
(7, 2, 'فلافل', 'نخود،فلفل', '5', '7500', '1447222950_food-04 (1).jpg', '1447222950_food-04 (1).jpg'),
(12, 1, 'پیتزا سوپر', 'همه چیز ', '14', '38000', '1447326511_Foods_(cropped).jpg', '1447326511_Foods_(cropped).jpg'),
(13, 1, 'پیتزا ایتالیا', 'سوسیس،کالباس،گوجه،زیتون،ذرت،', '14', '34000', '1447326511_Food (1).jpg', '1447326511_Food (1).jpg'),
(14, 2, 'چیزبرگر', 'گوشت،کلم،کاهو،پنیر پیتزا،دارچین،فلفل', '8', '15000', '1448291114_delicious-food.jpg', '1448291114_delicious-food.jpg'),
(15, 2, 'پیتزا ساندویچ', 'سوسیس،کالباس،پنیر پیتزا،زیتون،گوجه فرنگی', '14', '12000', '1448291115_1447326511_Food (1).jpg', '1448291115_1447326511_Food (1).jpg'),
(26, 1, 'پیتزا مخصوص', 'هسدد سمتبنمسب تسثبنمسنمب ، نهسبنمدسنب ، نسدبنسبن', '20', '20000', '1448371374_food-fact1.jpg', '1448371374_food-fact1.jpg'),
(27, 4, 'اسپاگتی ویژه', 'اسپاگتی، سس کچاپ', '12', '18500', '1458109587_Chicken-Carrot-Spaghetti.jpg', '1458109587_Chicken-Carrot-Spaghetti.jpg'),
(28, 1, 'پیتزا هلندی', 'ی', '10', '34000', '1460627895_3320_img8.jpg', '1460627895_3320_img8.jpg'),
(59, 1, '1aasdasd', '2', '2', '2', '1470569741_download.jpg', '1470569741_download.jpg'),
(60, 3, '22', '22', '22', '22', '1470746358_download.jpg', '1470746358_download.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `z_food_cats`
--

DROP TABLE IF EXISTS `z_food_cats`;
CREATE TABLE IF NOT EXISTS `z_food_cats` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` text,
  `parent_id` int(11) DEFAULT NULL,
  `desc` text,
  `image` text,
  `thumb` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_food_cats`
--

INSERT INTO `z_food_cats` (`id`, `title`, `parent_id`, `desc`, `image`, `thumb`) VALUES
(1, 'پیتزا', 3, 'پیتزاهایی با کیفیت فوق العاده و طعمی بیاد ماندنی', '/uploads/cat_img/image-6.jpg', '/uploads/cat_thumb/download.jpg'),
(2, 'ساندویچ گرم', 2, 'با بهترین مواد اولیه', '/uploads/cat_img/download.jpg', '/uploads/cat_thumb/image-6.jpg'),
(3, 'ساندویچ سرد', 3, '', '/uploads/cat_img/image-6.jpg', '/uploads/cat_thumb/Wellcome_Image_Awa_3589699k.jpg'),
(4, 'اسپاگتی', 2, '   ', '/uploads/cat_img/image-6.jpg', '/uploads/cat_thumb/download.jpg'),
(5, 'نوشیدنی', 3, 'نوشابه، دوغ، آب معدنی و ...', NULL, NULL),
(6, 'سالاد', 2, '', NULL, NULL),
(7, 'پیش غذا', 2, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `z_food_material`
--

DROP TABLE IF EXISTS `z_food_material`;
CREATE TABLE IF NOT EXISTS `z_food_material` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `material_id` int(11) DEFAULT NULL,
  `food_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_food_material`
--

INSERT INTO `z_food_material` (`id`, `material_id`, `food_id`, `amount`) VALUES
(1, 1, 26, 1),
(2, 2, 26, 0.2),
(3, 3, 26, 0.3),
(4, 5, 1, 0.2),
(7, 6, 15, 0.34),
(8, 5, 3, 0.3),
(9, 6, 3, 0.3),
(10, 5, 4, 0.3),
(11, 5, 4, 0.3),
(12, 6, 6, 0.34),
(13, 6, 2, 0.1),
(14, 2, 7, 0.3),
(15, 3, 7, 0.4),
(16, 2, 12, 0.3),
(17, 3, 12, 0.1),
(18, 3, 13, 0.34),
(19, 2, 13, 0.3),
(20, 2, 14, 0.3),
(21, 3, 14, 0.4),
(22, 6, 27, 0.2),
(23, 5, 27, 0.3),
(62, 42, 59, 123),
(63, 41, 59, 1),
(64, 41, 60, 2);

-- --------------------------------------------------------

--
-- Table structure for table `z_food_orders`
--

DROP TABLE IF EXISTS `z_food_orders`;
CREATE TABLE IF NOT EXISTS `z_food_orders` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `food_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `foodcount` int(11) DEFAULT NULL,
  `factor_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_food_orders`
--

INSERT INTO `z_food_orders` (`id`, `food_id`, `order_id`, `foodcount`, `factor_id`) VALUES
(1, 3, 1, 2, 571232),
(2, 4, 1, 1, 571232),
(3, 6, 2, 3, 10924),
(4, 7, 2, 1, 10924),
(5, 5, 3, 2, 882783),
(6, 4, 4, 3, 173201),
(7, 6, 4, 1, 173201),
(8, 7, 5, 1, 741632),
(9, 4, 6, 1, 798705),
(10, 7, 7, 1, 866075),
(11, 1, 8, 2, 307258),
(12, 4, 9, 1, 529320),
(13, 3, 9, 1, 529320),
(14, 12, 10, 4, 442792),
(16, 12, 12, 6, 228221),
(17, 4, 13, 2, 252428),
(18, 3, 13, 1, 252428),
(19, 26, 14, 2, 203401),
(20, 12, 14, 1, 203401),
(21, 26, 15, 2, 467413),
(22, 26, 16, 3, 308983),
(23, 26, 17, 3, 907739),
(24, 26, 18, 3, 520883),
(25, 26, 19, 3, 215838),
(26, 12, 20, 2, 414285),
(27, 4, 21, 1, 890718),
(28, 3, 21, 1, 890718),
(29, 1, 21, 1, 890718),
(30, 3, 22, 2, 179207),
(31, 7, 22, 1, 179207),
(32, 15, 23, 2, NULL),
(33, 15, 24, 4, 974891),
(34, 6, 25, 2, 824054),
(35, 7, 25, 1, 824054),
(36, 12, 26, 10, 406957),
(37, 4, 27, 1, 677683),
(38, 13, 28, 2, 911227),
(39, 12, 29, 3, 623566),
(40, 13, 29, 1, 623566),
(41, 1, 30, 4, 8127),
(42, 1, 31, 1, 133337),
(43, 7, 32, 1, 353764),
(44, 4, 33, 1, 399564),
(45, 15, 33, 1, 399564),
(46, 1, 34, 10, 642249),
(47, 3, 34, 5, 642249),
(48, 1, 35, 20, 631689),
(49, 1, 36, 10, 387021),
(50, 5, 37, 2, 718389),
(51, 3, 38, 1, 281683),
(52, 1, 39, 1, 182357),
(53, 6, 40, 2, 58623),
(54, 7, 40, 1, 58623),
(55, 4, 41, 2, 134399),
(56, 3, 41, 1, 134399),
(57, 1, 41, 1, 134399),
(58, 12, 42, 2, 454641),
(59, 6, 43, 1, 185635),
(60, 7, 43, 1, 185635),
(61, 6, 44, 2, 952339),
(62, 4, 45, 1, 843069),
(63, 4, 46, 2, 486399),
(64, 3, 47, 1, 132968),
(65, 4, 47, 1, 132968),
(66, 6, 48, 1, 149708),
(67, 7, 48, 1, 149708),
(68, 5, 49, 1, 265334),
(69, 12, 49, 1, 265334),
(70, 6, 50, 1, 801695),
(71, 3, 51, 2, 656640),
(72, 12, 52, 1, 578035),
(73, 15, 53, 2, 895352),
(74, 27, 54, 2, 844399),
(75, 6, 54, 1, 844399),
(76, 13, 55, 2, 366530),
(77, 3, 56, 2, 465957),
(78, 4, 57, 1, 797578),
(79, 13, 58, 2, 236420),
(80, 13, 59, 2, 486161),
(81, 5, 60, 2, 39290),
(82, 12, 60, 1, 39290),
(83, 4, 61, 2, 655079),
(84, 3, 61, 1, 655079),
(85, 5, 62, 3, 957247),
(86, 4, 63, 2, 239558),
(87, 3, 63, 1, 239558),
(88, 4, 64, 1, 663630),
(89, 4, 65, 2, 694682),
(90, 5, 65, 1, 694682),
(91, 15, 65, 1, 694682),
(92, 4, 66, 3, 504203),
(93, 3, 66, 1, 504203),
(94, 1, 67, 4, 432451),
(95, 12, 68, 2, 711526),
(96, 13, 68, 1, 711526),
(97, 12, 69, 6, 631507),
(98, 12, 70, 5, 108590),
(99, 12, 71, 6, 929492),
(100, 1, 72, 2, 972973),
(101, 3, 73, 7, 593607),
(102, 1, 74, 4, 811397),
(103, 3, 75, 6, 494858),
(104, 3, 76, 6, 929128),
(105, 4, 77, 6, 804),
(106, 3, 78, 3, 916225),
(107, 4, 79, 3, 146465),
(108, 4, 80, 3, 526701),
(109, 1, 81, 1, 291965),
(110, 12, 82, 1, 909626),
(111, 4, 83, 1, 521510),
(112, 3, 84, 1, 232632),
(113, 59, 85, 1, 413988),
(114, 60, 86, 1, 514080),
(115, 60, 86, 1, 514080),
(138, 1, 88, 2, 1872023),
(139, 59, 88, 1, 1872023),
(140, 60, 88, 1, 1872023),
(141, 1, 89, 2, 235861),
(142, 3, 89, 1, 235861),
(143, 27, 89, 1, 235861),
(144, 59, 90, 1, 9132980),
(145, 1, 91, 1, 6157786),
(146, 1, 92, 1, 3891062),
(147, 59, 92, 1, 3891062),
(148, 7, 92, 1, 3891062),
(149, 59, 93, 3, 712692),
(150, 15, 93, 1, 712692),
(151, 27, 93, 1, 712692),
(152, 1, 94, 1, 5412500),
(153, 59, 94, 1, 5412500),
(154, 13, 95, 2, 7445102),
(155, 27, 95, 1, 7445102),
(156, 1, 96, 1, 8688591),
(157, 13, 96, 1, 8688591),
(158, 1, 97, 2, 201165),
(159, 59, 97, 1, 201165),
(160, 7, 97, 1, 201165),
(161, 1, 99, 3, 4675744),
(162, 1, 100, 2, 7432274),
(163, 3, 101, 2, 4895584),
(164, 1, 102, 1, 841257),
(165, 14, 103, 4, 9247866),
(166, 12, 104, 1, 5420112),
(167, 1, 105, 1, 246711);

-- --------------------------------------------------------

--
-- Table structure for table `z_google_map`
--

DROP TABLE IF EXISTS `z_google_map`;
CREATE TABLE IF NOT EXISTS `z_google_map` (
  `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lat` double DEFAULT NULL,
  `lang` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_google_map`
--

INSERT INTO `z_google_map` (`id`, `lat`, `lang`) VALUES
(1, 36.465671, 52.347099);

-- --------------------------------------------------------

--
-- Table structure for table `z_materials`
--

DROP TABLE IF EXISTS `z_materials`;
CREATE TABLE IF NOT EXISTS `z_materials` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` text,
  `amount` double DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `exp_date` date DEFAULT NULL,
  `unit_price` bigint(20) DEFAULT NULL,
  `price` bigint(20) DEFAULT NULL,
  `storage_id` int(11) DEFAULT NULL,
  `mat_ref` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_materials`
--

INSERT INTO `z_materials` (`id`, `name`, `amount`, `cat_id`, `unit_id`, `exp_date`, `unit_price`, `price`, `storage_id`, `mat_ref`) VALUES
(41, 'نوشابه', -4, 17, 16, '2016-08-23', 20, 10000, 1, 123),
(42, 'نوشابه', -23, 17, 16, '2016-08-23', 20, 2000, 2, 704570),
(43, 'نوشابه', 400, 17, 16, '2016-08-23', 20, 8000, 4, 718701),
(44, 'سبزی', 20, 16, 16, '2016-09-09', 50, 1000, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `z_material_cat`
--

DROP TABLE IF EXISTS `z_material_cat`;
CREATE TABLE IF NOT EXISTS `z_material_cat` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` text,
  `desc` text,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_material_cat`
--

INSERT INTO `z_material_cat` (`id`, `title`, `desc`, `status`) VALUES
(16, 'سبزیجات', 'xx', 0),
(17, 'نوشیدنی', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `z_material_unit`
--

DROP TABLE IF EXISTS `z_material_unit`;
CREATE TABLE IF NOT EXISTS `z_material_unit` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` text,
  `desc` text,
  `ratio` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_material_unit`
--

INSERT INTO `z_material_unit` (`id`, `title`, `desc`, `ratio`, `status`) VALUES
(16, 'عدد', '', NULL, 0),
(17, 'کیلوگرم', '', NULL, 0),
(18, 'گرم', '', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `z_material_use`
--

DROP TABLE IF EXISTS `z_material_use`;
CREATE TABLE IF NOT EXISTS `z_material_use` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mat_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_material_use`
--

INSERT INTO `z_material_use` (`id`, `mat_id`, `amount`, `date`) VALUES
(1, 1, 3, '2016-02-11'),
(2, 2, 0.6, '2016-02-11'),
(3, 3, 0.9, '2016-02-11'),
(4, 5, 0.2, '2016-02-12'),
(5, 5, 0.2, '2016-02-22'),
(6, 5, 0.2, '2016-03-01'),
(7, 5, 0.2, '2016-03-02'),
(8, 7, 0.6, '2016-03-11'),
(9, 6, 0.68, '2016-03-11'),
(10, 6, 0.4, '2016-03-16'),
(11, 5, 0.6, '2016-03-16'),
(12, 8, 0.2, '2016-03-16'),
(13, 6, 0.34, '2016-03-16'),
(14, 3, 0.68, '2016-04-03'),
(15, 2, 0.6, '2016-04-03'),
(16, 5, 0.6, '2016-04-12'),
(17, 6, 0.6, '2016-04-12'),
(18, 5, 0.3, '2016-04-16'),
(19, 5, 0.3, '2016-04-16'),
(20, 3, 0.68, '2016-04-16'),
(21, 2, 0.6, '2016-04-16'),
(22, 3, 0.68, '2016-04-16'),
(23, 2, 0.6, '2016-04-16'),
(24, 2, 0.3, '2016-04-16'),
(25, 3, 0.1, '2016-04-16'),
(26, 5, 0.6, '2016-04-17'),
(27, 5, 0.6, '2016-04-17'),
(28, 5, 0.3, '2016-04-17'),
(29, 6, 0.3, '2016-04-17'),
(30, 5, 0.6, '2016-04-20'),
(31, 5, 0.6, '2016-04-20'),
(32, 5, 0.3, '2016-04-20'),
(33, 6, 0.3, '2016-04-20'),
(34, 5, 0.3, '2016-04-24'),
(35, 5, 0.3, '2016-04-24'),
(36, 5, 0.6, '2016-05-17'),
(37, 5, 0.6, '2016-05-17'),
(38, 6, 0.34, '2016-05-17'),
(39, 5, 0.6, '2016-05-17'),
(40, 5, 0.6, '2016-05-17'),
(41, 5, 0.9, '2016-05-17'),
(42, 5, 0.9, '2016-05-17'),
(43, 5, 0.3, '2016-05-17'),
(44, 6, 0.3, '2016-05-17'),
(45, 5, 0.9, '2016-05-17'),
(46, 5, 0.9, '2016-05-17'),
(47, 5, 0.9, '2016-05-17'),
(48, 5, 0.9, '2016-05-17'),
(49, 5, 0.9, '2016-05-17'),
(50, 5, 0.9, '2016-05-17'),
(51, 5, 0.8, '2016-05-17'),
(52, 2, 0.6, '2016-05-17'),
(53, 3, 0.2, '2016-05-17'),
(54, 3, 0.34, '2016-05-17'),
(55, 2, 0.3, '2016-05-17'),
(56, 2, 1.8, '2016-05-17'),
(57, 3, 0.6, '2016-05-17'),
(58, 2, 1.8, '2016-05-17'),
(59, 3, 0.6, '2016-05-17'),
(60, 2, 1.5, '2016-05-17'),
(61, 3, 0.5, '2016-05-17'),
(62, 2, 1.5, '2016-05-17'),
(63, 3, 0.5, '2016-05-17'),
(64, 2, 1.8, '2016-05-17'),
(65, 3, 0.6, '2016-05-17'),
(66, 2, 1.8, '2016-05-17'),
(67, 3, 0.6, '2016-05-17'),
(68, 2, 1.8, '2016-05-17'),
(69, 3, 0.6, '2016-05-17'),
(70, 2, 1.8, '2016-05-17'),
(71, 3, 0.6, '2016-05-17'),
(72, 2, 1.8, '2016-05-17'),
(73, 3, 0.6, '2016-05-17'),
(74, 2, 1.8, '2016-05-17'),
(75, 3, 0.6, '2016-05-17'),
(76, 2, 1.8, '2016-05-17'),
(77, 3, 0.6, '2016-05-17'),
(78, 5, 0.4, '2016-05-17'),
(79, 5, 0.6, '2016-05-17'),
(80, 6, 0.6, '2016-05-17'),
(81, 5, 2.1, '2016-05-17'),
(82, 6, 2.1, '2016-05-17'),
(83, 5, 0.8, '2016-05-17'),
(84, 5, 0.3, '2016-05-17'),
(85, 6, 0.3, '2016-05-17'),
(86, 5, 1.8, '2016-05-18'),
(87, 6, 1.8, '2016-05-18'),
(88, 5, 1.8, '2016-05-18'),
(89, 6, 1.8, '2016-05-18'),
(90, 5, 1.8, '2016-05-18'),
(91, 6, 1.8, '2016-05-18'),
(92, 5, 1.8, '2016-05-18'),
(93, 5, 1.8, '2016-05-18'),
(94, 5, 1.8, '2016-05-18'),
(95, 5, 1.8, '2016-05-18'),
(96, 5, 1.8, '2016-05-18'),
(97, 5, 1.8, '2016-05-18'),
(98, 5, 1.8, '2016-05-18'),
(99, 5, 1.8, '2016-05-18'),
(100, 5, 1.8, '2016-05-18'),
(101, 5, 1.8, '2016-05-18'),
(102, 5, 0.9, '2016-06-07'),
(103, 6, 0.9, '2016-06-07'),
(104, 5, 0.9, '2016-06-07'),
(105, 5, 0.9, '2016-06-07'),
(106, 5, 0.9, '2016-06-07'),
(107, 5, 0.9, '2016-06-07'),
(108, 5, 0.9, '2016-06-07'),
(109, 5, 0.9, '2016-06-07'),
(110, 5, 0.9, '2016-06-07'),
(111, 5, 0.9, '2016-06-07');

-- --------------------------------------------------------

--
-- Table structure for table `z_note`
--

DROP TABLE IF EXISTS `z_note`;
CREATE TABLE IF NOT EXISTS `z_note` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` text,
  `content` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_note`
--

INSERT INTO `z_note` (`id`, `title`, `content`) VALUES
(1, 'نبسلاسبن', 'نیبدیبل بخردیب ریبخبلخیب لیبل');

-- --------------------------------------------------------

--
-- Table structure for table `z_orders`
--

DROP TABLE IF EXISTS `z_orders`;
CREATE TABLE IF NOT EXISTS `z_orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `refid` int(11) DEFAULT NULL,
  `queue` int(11) DEFAULT NULL,
  `total_fee` int(11) DEFAULT NULL,
  `order_type` int(11) DEFAULT NULL,
  `payment_type` int(11) DEFAULT NULL,
  `order_set` text,
  `note` text,
  `tax_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `status` text,
  `serve_level` int(11) DEFAULT NULL,
  `serve_time` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_orders`
--

INSERT INTO `z_orders` (`id`, `user_id`, `refid`, `queue`, `total_fee`, `order_type`, `payment_type`, `order_set`, `note`, `tax_id`, `date`, `time`, `status`, `serve_level`, `serve_time`) VALUES
(1, 2, 571232, 1, 52000, 0, 1, NULL, 'برشته باشه لطفاً', NULL, '2016-02-15', '11:31:00', '', 0, '32'),
(2, 2, 10924, 2, 49500, 0, 2, NULL, NULL, NULL, '2016-02-16', '12:03:00', '', 0, '29'),
(3, 2, 882783, 3, 48000, NULL, 2, NULL, NULL, NULL, '2016-02-14', '14:21:00', '1', NULL, NULL),
(4, 1, 173201, 4, 80000, NULL, 2, NULL, NULL, NULL, '2016-02-17', '14:22:00', NULL, NULL, NULL),
(5, 3, 741632, 5, 1000, NULL, 1, NULL, NULL, NULL, '2016-02-17', '14:23:00', NULL, NULL, NULL),
(6, 2, 798705, 6, 22000, 0, 2, NULL, NULL, NULL, '2016-02-16', '11:55:00', '', 0, '12'),
(7, 2, 866075, 7, 1000, 0, 2, NULL, NULL, NULL, '2016-02-16', '12:02:00', '', 0, '5'),
(8, 2, 307258, 8, 20000, 0, 1, NULL, NULL, NULL, '2016-02-19', '09:38:00', '', 0, '40'),
(9, 2, 529320, 9, 37000, 0, 1, NULL, NULL, NULL, '2016-02-18', '10:56:00', '', 0, '22'),
(10, 1, 442792, 10, 152000, NULL, 2, NULL, NULL, NULL, '2016-02-14', '15:18:00', NULL, NULL, NULL),
(12, 2, 228221, 12, 228000, 0, 2, NULL, NULL, NULL, '2016-02-17', '12:08:00', '', 0, '84'),
(13, 2, 252428, 13, 59000, 0, 2, NULL, NULL, NULL, '2016-02-15', '13:57:00', '', 0, '26'),
(14, 2, 203401, 14, 78000, 0, 2, NULL, NULL, NULL, '2016-02-15', '09:55:00', '', 0, '44'),
(15, 2, 467413, 15, 40000, 0, 2, NULL, NULL, NULL, '2016-02-11', '13:42:00', '', 0, '44'),
(16, 2, 308983, 16, 60000, 0, 2, NULL, NULL, NULL, '2016-02-11', '13:44:00', '', 0, '66'),
(17, 2, 907739, 17, 60000, 0, 2, NULL, NULL, NULL, '2016-02-11', '13:46:00', '', 0, '66'),
(18, 2, 520883, 18, 60000, 0, 2, NULL, NULL, NULL, '2016-02-11', '13:48:00', '', 0, '66'),
(19, 2, 215838, 19, 60000, 0, 2, NULL, NULL, NULL, '2016-02-11', '13:49:00', '', 0, '66'),
(20, 2, 414285, 20, 76000, 0, 2, NULL, NULL, NULL, '2016-02-12', '14:08:00', '', 0, '30'),
(21, 2, 890718, 21, 57000, 0, 2, NULL, '541', NULL, '2016-02-12', '14:50:00', '', 0, '22'),
(22, 2, 179207, 22, 37500, 0, 2, NULL, NULL, NULL, '2016-02-12', '14:53:00', '', 0, '22'),
(23, 2, NULL, 23, NULL, 0, 1, NULL, NULL, NULL, '2016-02-12', '16:22:00', '', 0, NULL),
(24, 2, 974891, 24, 48000, 0, 2, NULL, NULL, NULL, '2016-02-12', '16:27:00', '', 0, '61'),
(25, 2, 824054, 25, 35500, 0, 1, NULL, NULL, NULL, '2016-02-12', '16:29:00', '', 0, '17'),
(26, 2, 406957, 26, 1000, 0, 2, NULL, NULL, NULL, '2016-02-12', '16:32:00', '', 0, '154'),
(27, 2, 677683, 27, 22000, 3, 2, NULL, NULL, NULL, '2016-02-12', '16:48:00', '', 0, '13'),
(28, 2, 911227, 28, 68000, 2, 2, NULL, NULL, NULL, '2016-02-13', '09:00:00', '', 0, '30'),
(29, 9, 623566, 29, 25000, 3, 2, NULL, NULL, NULL, '2016-02-19', '17:41:00', '', 0, '46'),
(30, 2, 8127, 30, 80000, 1, NULL, NULL, NULL, NULL, '2016-02-21', '09:36:00', NULL, NULL, NULL),
(31, 2, 133337, 31, 20000, 3, 2, NULL, NULL, NULL, '2016-02-22', '17:43:00', '', 0, '22'),
(32, 2, 353764, 32, 7500, 2, 2, NULL, NULL, NULL, '2016-02-22', '17:43:00', '', 0, '5'),
(33, 2, 399564, 33, 34000, 1, 2, NULL, NULL, NULL, '2016-02-22', '17:44:00', '', 0, '15'),
(34, 2, 642249, 34, 275000, 2, NULL, NULL, NULL, NULL, '2016-02-25', '11:48:00', NULL, NULL, NULL),
(35, 1, 631689, 35, 400000, 3, NULL, NULL, NULL, NULL, '2016-02-25', '11:52:00', NULL, NULL, NULL),
(36, 2, 387021, 36, 200000, 3, NULL, NULL, NULL, NULL, '2016-02-25', '11:52:00', NULL, NULL, NULL),
(37, 2, 718389, 37, 48000, 1, NULL, NULL, NULL, NULL, '2016-02-28', '11:07:00', NULL, NULL, NULL),
(38, 2, 281683, 38, 15000, 2, NULL, NULL, NULL, NULL, '2016-03-01', '10:41:00', '', 0, '11'),
(39, 2, 182357, 39, 20000, 2, 1, 'آمل دریای آسمان جنگل', NULL, NULL, '2016-03-01', '11:02:00', '', 0, '22'),
(40, 2, 58623, 40, 35500, 3, 3, '12', NULL, NULL, '2016-03-01', '14:27:00', '', 0, '17'),
(41, 2, 134399, 41, 79000, 1, 2, '14:40', NULL, NULL, '2016-03-02', '09:53:00', '', 0, '26'),
(42, 2, 454641, 42, 76000, 2, 1, 'آمل', NULL, NULL, '2016-03-03', '21:40:00', '', 0, '30'),
(43, 2, 185635, 43, 21500, 3, 3, '12', NULL, NULL, '2016-03-03', '21:40:00', '', 0, '8'),
(44, 2, 952339, 44, 28000, 4, 3, '23', NULL, NULL, '2016-08-13', '22:07:00', '', 0, '17'),
(45, 2, 843069, 45, 22000, 3, 3, '14', NULL, NULL, '2016-03-04', '22:25:00', '', 0, '13'),
(46, 2, 486399, 46, 44000, 3, 3, '13', NULL, NULL, '2016-03-04', '00:01:00', '', 0, '26'),
(47, 2, 132968, 47, 37000, 1, 2, '12', NULL, NULL, '2016-03-04', '11:02:00', '', 0, '13'),
(48, 2, 149708, 48, 21500, 4, 3, '14', NULL, NULL, '2016-03-04', '11:03:00', '', 0, '8'),
(49, 2, 265334, 49, 62000, 2, 1, '45', NULL, NULL, '2016-03-04', '12:44:00', '', 0, '16'),
(50, 2, 801695, 50, 14000, 2, 1, '46', NULL, NULL, '2016-03-04', '12:44:00', '', 0, '8'),
(51, 2, 656640, 51, 30000, 1, 2, '', NULL, NULL, '2016-03-05', '12:10:00', '', 0, '22'),
(52, 2, 578035, 52, 38000, 1, 2, '16', NULL, NULL, '2016-03-06', '13:35:00', '', 0, '15'),
(53, 2, 895352, 53, 24000, 1, 2, '22', NULL, NULL, '2016-03-11', '11:07:00', '', 0, '30'),
(54, 2, 844399, 54, 51000, 2, 1, 'آمل', NULL, NULL, '2016-03-16', '11:22:00', '', 0, '26'),
(55, 2, 366530, 55, 68000, 1, 2, '12', NULL, NULL, '2016-04-03', '10:39:00', '', 0, '30'),
(56, 2, 465957, 56, 30000, 1, 2, '10', NULL, NULL, '2016-04-12', '11:38:00', '', 0, '22'),
(57, 2, 797578, 57, 19800, 1, 2, '12:24', NULL, NULL, '2016-08-10', '15:11:00', '', 0, '13'),
(58, 1, 236420, 58, 61200, 2, 1, 'آمل', NULL, NULL, '2016-04-16', '15:20:00', '', 0, '30'),
(59, 1, 486161, 59, 61200, 1, 2, '12', NULL, NULL, '2016-04-16', '15:22:00', '', 0, '30'),
(60, 2, 39290, 60, 77400, 3, 3, '4', NULL, NULL, '2016-04-16', '15:23:00', '', 0, '33'),
(61, 2, 655079, 61, 59000, 2, 1, 'فیاض بخش', NULL, NULL, '2016-04-17', '10:49:00', '', 0, '26'),
(62, 2, 957247, 62, 64800, 1, 2, '10', NULL, NULL, '2016-04-17', '11:06:00', '', 0, '49'),
(63, 1, 239558, 63, 53100, 2, 1, 'یمب', NULL, NULL, '2016-04-20', '16:23:00', '', 0, '26'),
(64, 2, 663630, 64, 22000, 1, 2, 'فلقث', NULL, NULL, '2016-04-24', '10:11:00', '', 0, '13'),
(65, 2, 694682, 65, 72000, 1, 2, '51', NULL, NULL, '2016-05-17', '20:57:00', '', 0, '26'),
(66, 2, 504203, 66, 72900, 2, 1, 'sdf', NULL, NULL, '2016-05-17', '21:10:00', '', 0, '39'),
(67, 2, 432451, 67, 72000, 2, 1, '20', NULL, NULL, '2016-05-17', '21:13:00', '', 0, '88'),
(68, 2, 711526, 68, 99000, 4, 3, '14', NULL, NULL, '2016-05-17', '21:14:00', '', 0, '30'),
(69, 2, 631507, 69, NULL, 2, 1, '54', NULL, NULL, '2016-05-17', '21:14:00', '', 0, '92'),
(70, 2, 108590, 70, 171000, 2, 1, 's', NULL, NULL, '2016-05-17', '21:16:00', '', 0, '77'),
(71, 2, 929492, 71, NULL, 3, 3, 'asd', NULL, NULL, '2016-05-17', '21:16:00', '', 0, '92'),
(72, 2, 972973, 72, 82800, 2, 1, '326', NULL, NULL, '2016-05-17', '22:06:00', '', 0, '44'),
(73, 2, 593607, 73, 94500, 2, 1, '62', NULL, NULL, '2016-05-17', '22:16:00', '', 0, '77'),
(74, 2, 811397, 74, 85500, 3, 3, '36362', NULL, NULL, '2016-05-17', '22:17:00', '', 0, '88'),
(75, 2, 494858, 75, 81000, 1, 2, 'sdsd', NULL, NULL, '2016-05-18', '19:52:00', '', 0, '66'),
(76, 2, 929128, 76, 81000, 2, 1, 'asasas', NULL, NULL, '2016-08-10', '19:53:00', '', 0, '66'),
(77, 2, 804, 77, 118800, 3, 3, 'qwqw', NULL, NULL, '2016-05-18', '19:54:00', '', 0, '79'),
(78, 2, 916225, 78, 29250, 1, 2, '211', NULL, NULL, '2016-06-07', '21:25:00', '', 0, '33'),
(79, 2, 146465, 79, 42900, 1, 2, '1212', NULL, NULL, '2016-06-07', '21:26:00', '', 0, '39'),
(80, 2, 526701, 80, 59400, 1, 2, 'xc', NULL, NULL, '2016-08-10', '21:43:00', '', 0, '39'),
(81, 16, 291965, 81, NULL, 4, 3, '', NULL, NULL, '2016-08-12', '13:15:00', '', 0, '22'),
(83, 26, 521510, 83, NULL, 4, 3, '', NULL, NULL, '2016-08-08', '15:51:00', '', 0, '13'),
(84, 16, 232632, 84, NULL, 1, 2, '', NULL, NULL, '2016-08-10', '10:09:00', '', 0, '13'),
(85, 16, 413988, 85, 100, 2, 1, '', NULL, NULL, '2016-08-13', '10:11:00', '', 0, '11'),
(86, 16, 514080, 86, 12000, 3, 3, '', NULL, NULL, '2016-08-13', '10:19:00', '', 0, '24'),
(88, 16, 1872023, 4, 40024, 1, NULL, '2', NULL, NULL, '2016-08-13', '15:07:00', NULL, NULL, NULL),
(89, 16, 235861, 5, 73500, NULL, NULL, '22', NULL, NULL, '2016-08-13', '15:11:00', NULL, NULL, NULL),
(90, 0, 9132980, 6, 2, NULL, NULL, '', NULL, NULL, '2016-08-13', '15:12:00', NULL, NULL, NULL),
(91, 0, 6157786, 7, 20000, NULL, NULL, '', NULL, NULL, '2016-08-13', '15:14:00', NULL, NULL, NULL),
(92, 16, 3891062, 8, 27502, NULL, NULL, '5', NULL, NULL, '2016-08-13', '15:21:00', NULL, NULL, NULL),
(93, 16, 712692, 9, 30506, NULL, NULL, '15', NULL, NULL, '2016-08-13', '16:07:00', NULL, NULL, NULL),
(94, 0, 5412500, 1, 20002, NULL, NULL, '', NULL, NULL, '2016-08-14', '09:28:00', '1', NULL, NULL),
(95, 16, 7445102, 2, 86500, NULL, NULL, '3', NULL, NULL, '2016-08-14', '09:39:00', '1', NULL, NULL),
(96, 0, 8688591, 3, 54000, NULL, NULL, '', NULL, NULL, '2016-08-14', '12:16:00', '2', NULL, NULL),
(97, 16, 201165, 4, 47502, NULL, NULL, '10', NULL, NULL, '2016-08-14', '13:07:00', '1', NULL, NULL),
(99, 0, 4675744, 1, 60000, NULL, NULL, '', NULL, NULL, '2016-08-14', '11:33:00', '1', NULL, NULL),
(100, 16, 7432274, 1, 40000, NULL, NULL, '3', NULL, NULL, '2016-08-18', '10:22:00', '1', NULL, NULL),
(101, 0, 4895584, 2, 30000, NULL, NULL, '', NULL, NULL, '2016-08-18', '12:20:00', '1', NULL, NULL),
(102, 16, 841257, 3, 20000, NULL, NULL, '3', NULL, NULL, '2016-08-18', '16:59:00', '1', NULL, NULL),
(103, 7, 9247866, 4, 60000, NULL, NULL, '222', NULL, NULL, '2016-08-18', '17:16:00', '1', NULL, NULL),
(104, 0, 5420112, 5, 38000, NULL, NULL, '', NULL, NULL, '2016-08-18', '17:18:00', '1', NULL, NULL),
(105, 0, 246711, 1, 20000, NULL, NULL, '', NULL, NULL, '2016-08-20', '10:36:00', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `z_order_payment_type`
--

DROP TABLE IF EXISTS `z_order_payment_type`;
CREATE TABLE IF NOT EXISTS `z_order_payment_type` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_type` int(11) DEFAULT NULL,
  `payment_type` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_order_payment_type`
--

INSERT INTO `z_order_payment_type` (`id`, `order_type`, `payment_type`) VALUES
(1, 1, 2),
(2, 2, 1),
(3, 3, 3),
(4, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `z_order_status`
--

DROP TABLE IF EXISTS `z_order_status`;
CREATE TABLE IF NOT EXISTS `z_order_status` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` text,
  `desc` text,
  `isdefault` bit(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_order_status`
--

INSERT INTO `z_order_status` (`id`, `title`, `desc`, `isdefault`) VALUES
(1, 'صندوق', NULL, b'1'),
(2, 'آشپزخانه', NULL, b'0'),
(3, 'درحال آماده سازی', NULL, b'0'),
(4, 'سرو', NULL, b'0'),
(5, 'ارسال به بیرون', NULL, b'0'),
(6, 'تحویل', NULL, b'0'),
(7, 'لغو شده', NULL, b'0'),
(8, 'مرجوع', NULL, b'0');

-- --------------------------------------------------------

--
-- Table structure for table `z_order_types`
--

DROP TABLE IF EXISTS `z_order_types`;
CREATE TABLE IF NOT EXISTS `z_order_types` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` text,
  `title` text,
  `desc` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_order_types`
--

INSERT INTO `z_order_types` (`id`, `name`, `title`, `desc`) VALUES
(1, 'پیش سفارش حضوری', 'تو راهم', NULL),
(2, 'بیرون بر با پیک', 'غذا رو با پیک برام بفرستید', NULL),
(3, 'حضوری', 'اکنون در رستوران هستم', NULL),
(4, 'بیرون بر حضوری', 'غذا رو میام می برم.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `z_payments`
--

DROP TABLE IF EXISTS `z_payments`;
CREATE TABLE IF NOT EXISTS `z_payments` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` text,
  `title` text,
  `desc` text,
  `online_port` tinyint(4) DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_payments`
--

INSERT INTO `z_payments` (`id`, `name`, `title`, `desc`, `online_port`, `enabled`) VALUES
(1, 'درگاه پارسیان', 'درگاه بانک پارسیان', NULL, 1, 1),
(2, 'درگاه پاسارگاد', 'درگاه بانک پاسارگاد', NULL, 1, 1),
(3, 'اعتبار', 'پرداخت از طریق اعتبار', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `z_phonebook`
--

DROP TABLE IF EXISTS `z_phonebook`;
CREATE TABLE IF NOT EXISTS `z_phonebook` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` text,
  `phone` text,
  `company` text,
  `mobile` text,
  `group` text,
  `address` text,
  `email` text,
  `website` text,
  `note` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `z_res_subset`
--

DROP TABLE IF EXISTS `z_res_subset`;
CREATE TABLE IF NOT EXISTS `z_res_subset` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` text,
  `desc` text,
  `en_name` text,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_res_subset`
--

INSERT INTO `z_res_subset` (`id`, `title`, `desc`, `en_name`, `status`) VALUES
(2, 'رستوران هندی', 'xx', NULL, 0),
(3, 'رستوران ایتالیایی', 'asdasd', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `z_salary`
--

DROP TABLE IF EXISTS `z_salary`;
CREATE TABLE IF NOT EXISTS `z_salary` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `cash` bigint(20) DEFAULT NULL,
  `time` time DEFAULT NULL,
  `date` date DEFAULT NULL,
  `trans_id` int(11) DEFAULT NULL,
  `vacation` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_salary`
--

INSERT INTO `z_salary` (`id`, `staff_id`, `account_id`, `cash`, `time`, `date`, `trans_id`, `vacation`) VALUES
(4, 2, 0, 1100000, '11:17:00', '2016-03-08', 0, 0),
(11, 5, 1, 2200000, '13:20:00', '2016-05-01', 231491, 0),
(12, 5, NULL, 2200000, '13:20:00', '2016-06-01', 0, 16),
(13, 5, 1, 2200000, '13:20:00', '2016-07-01', 6941895, 0),
(14, 2, NULL, 1100000, '14:03:00', '2016-04-01', 0, 104),
(15, 2, NULL, 1100000, '14:03:00', '2016-05-01', 0, 0),
(16, 2, NULL, 1100000, '14:03:00', '2016-06-01', 0, 0),
(17, 2, NULL, 1100000, '14:03:00', '2016-07-01', 0, 0),
(57, 1, 1, 2000000, '14:06:00', '2016-08-21', 7989883, 136),
(58, 7, 1, 100, '16:36:00', '2016-07-01', 5250247, 0);

-- --------------------------------------------------------

--
-- Table structure for table `z_serve_level`
--

DROP TABLE IF EXISTS `z_serve_level`;
CREATE TABLE IF NOT EXISTS `z_serve_level` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` text,
  `desc` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `z_service_settings`
--

DROP TABLE IF EXISTS `z_service_settings`;
CREATE TABLE IF NOT EXISTS `z_service_settings` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `service_failure` int(11) DEFAULT NULL,
  `service_status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_service_settings`
--

INSERT INTO `z_service_settings` (`id`, `start_time`, `end_time`, `service_failure`, `service_status`) VALUES
(1, '09:00:00', '00:00:00', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `z_site_info`
--

DROP TABLE IF EXISTS `z_site_info`;
CREATE TABLE IF NOT EXISTS `z_site_info` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `site_name` text,
  `site_title` text,
  `slogan` text,
  `desc` text,
  `tel` text,
  `email` text,
  `logo` text,
  `header` text,
  `area` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_site_info`
--

INSERT INTO `z_site_info` (`id`, `site_name`, `site_title`, `slogan`, `desc`, `tel`, `email`, `logo`, `header`, `area`) VALUES
(1, 'رستوران بوف آمل', 'رستوران بوف آمل', 'لذت خوردن غذایی سالم', 'تلاش ما ارائه بهترین و خوش طعم ترین غذاها برای شما مشتریان گرامی می باشد.', '01144276432', 'boof_amol@gmail.com', 'logo.png', 'home - Copy.jpg', 'specials_bg.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `z_social_sites`
--

DROP TABLE IF EXISTS `z_social_sites`;
CREATE TABLE IF NOT EXISTS `z_social_sites` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` text,
  `icon` varchar(50) NOT NULL,
  `url` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_social_sites`
--

INSERT INTO `z_social_sites` (`id`, `title`, `icon`, `url`) VALUES
(1, 'اینستاگرام', 'fa-facebook', 'http://www.instagram.com/boof_amol'),
(3, 'کانال تلگرام', 'fa-facebook', 'telegram.me/boof_amol');

-- --------------------------------------------------------

--
-- Table structure for table `z_staff`
--

DROP TABLE IF EXISTS `z_staff`;
CREATE TABLE IF NOT EXISTS `z_staff` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` text,
  `father_name` text,
  `birthday` text,
  `ssid` text,
  `national_code` int(11) DEFAULT NULL,
  `insurance_code` int(11) DEFAULT NULL,
  `last_worked` text,
  `position` text,
  `bg_date` text,
  `en_date` text,
  `salary` text,
  `work_hours` int(11) DEFAULT NULL,
  `max_vacation` int(11) DEFAULT NULL,
  `payday` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_staff`
--

INSERT INTO `z_staff` (`id`, `name`, `father_name`, `birthday`, `ssid`, `national_code`, `insurance_code`, `last_worked`, `position`, `bg_date`, `en_date`, `salary`, `work_hours`, `max_vacation`, `payday`) VALUES
(1, 'احمد احمدی', 'اسماعیل', '1332/01/01', '1022', 512243816, 35521610, 'خاوران', 'مدیر داخلی', '1394/08/25', '1395/08/25', '2000000', 180, 20, 26),
(2, 'رضا احمدی', 'سعید', '1364/05/15', '24512', 124232607, 35171426, 'شرکت برق', 'گارسون', '1394/08/26', '1396/08/26', '1100000', 180, 20, 1),
(5, 'سعید دلیر', 'مرتضی', '1371/05/05', '00130294044', 130294044, 35142773, 'صدا و سیما', 'مدیر روابط عمومی', '1395/01/31', '1396/01/31', '2200000', 180, 20, 1),
(7, 'test', 'test 5', '1395/05/18', '2055', 505, 123, 'test', 'test55', '1395/01/01', '1395/05/31', '100', 100, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `z_staff_evidence`
--

DROP TABLE IF EXISTS `z_staff_evidence`;
CREATE TABLE IF NOT EXISTS `z_staff_evidence` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) DEFAULT NULL,
  `location` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_staff_evidence`
--

INSERT INTO `z_staff_evidence` (`id`, `staff_id`, `location`) VALUES
(4, 5, '/uploads/staff/ac-milan-flag-wallpaper.jpg'),
(6, 5, '/uploads/staff/Milan-AC-HD-wallpapers-Black.jpg'),
(7, 5, '/uploads/staff/photo_2016-03-04_14-43-40.jpg'),
(9, 5, '/uploads/staff/3320_img8.jpg'),
(13, 7, '/uploads/staff/download.jpg'),
(14, 7, '/uploads/staff/image-6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `z_staff_loan`
--

DROP TABLE IF EXISTS `z_staff_loan`;
CREATE TABLE IF NOT EXISTS `z_staff_loan` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `amount` bigint(20) DEFAULT NULL,
  `loan_date` date DEFAULT NULL,
  `loan_time` time DEFAULT NULL,
  `payback_date` date DEFAULT NULL,
  `payed` tinyint(4) DEFAULT NULL,
  `payback_account` int(11) DEFAULT NULL,
  `payback_real_date` date DEFAULT NULL,
  `trans_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_staff_loan`
--

INSERT INTO `z_staff_loan` (`id`, `staff_id`, `account_id`, `amount`, `loan_date`, `loan_time`, `payback_date`, `payed`, `payback_account`, `payback_real_date`, `trans_id`) VALUES
(1, 1, 1, 300000, '2016-02-11', '12:00:00', '2016-02-29', 1, 1, '2016-02-29', 0),
(2, 1, 1, 100000, '2016-02-11', '12:00:00', '2016-02-14', 1, 1, '2016-03-01', 0),
(3, 1, 1, 200000, '2016-02-11', '14:00:00', '2016-03-10', 1, 1, '2016-02-12', 0),
(4, 2, 1, 200000, '2016-03-11', '12:00:00', '2016-03-22', 0, 1, '2016-03-26', 0),
(5, 1, 4, 10, '2016-03-12', NULL, '2016-05-11', 0, 1, NULL, 0),
(6, 2, 1, 777000, '2016-03-12', NULL, '2016-07-21', 1, 1, NULL, NULL),
(7, 3, 4, 200000, '2016-03-12', NULL, '2016-04-20', 0, NULL, NULL, NULL),
(9, 2, 4, 145000, '2016-03-14', '09:47:00', '2016-08-18', 1, NULL, NULL, 2666284),
(10, 2, 1, 200000, '2016-04-24', '11:09:00', '2016-05-20', 0, NULL, NULL, 350377),
(11, 2, 1, 333000, '2016-05-08', '11:10:00', '2016-05-20', 0, NULL, NULL, 620207),
(12, 2, 1, 10, '2016-08-18', '11:31:00', '2016-08-17', 1, NULL, NULL, 3178919),
(13, 1, 1, 100, '2016-08-07', '12:08:00', '2016-08-08', 0, NULL, NULL, 0),
(14, 1, 1, 123, '2016-08-08', '16:31:00', '2016-08-08', 1, NULL, NULL, 6612239),
(15, 1, 1, 100, '2016-08-18', '10:17:00', '2016-08-21', 0, NULL, NULL, 7655118),
(16, 7, 1, 500, '2016-08-09', '10:39:00', '2016-08-21', 1, NULL, NULL, 1128602),
(17, 7, 1, 1, '2016-08-08', '10:47:00', '2016-08-21', 1, NULL, NULL, 6268318);

-- --------------------------------------------------------

--
-- Table structure for table `z_staff_orders`
--

DROP TABLE IF EXISTS `z_staff_orders`;
CREATE TABLE IF NOT EXISTS `z_staff_orders` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `food_id` int(11) DEFAULT NULL,
  `food_name` text,
  `count` double DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `trans_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_staff_orders`
--

INSERT INTO `z_staff_orders` (`id`, `food_id`, `food_name`, `count`, `cost`, `type`, `date`, `time`, `trans_id`) VALUES
(1, 1, NULL, 2, 0, 1, '2015-12-03', NULL, NULL),
(8, 26, 'پیتزا مخصوص', 3, 6000, 1, '2016-03-10', '14:37:00', 261920),
(9, 0, 'چلو جوجه', 5, 38000, 3, '2016-03-10', '14:44:00', 69615),
(27, 0, 'کاهو', 0.2, 80, 2, '2016-03-10', '15:09:00', 775576),
(28, 0, 'کلم', 0.4, 240, 2, '2016-03-10', '15:09:00', 775576),
(29, 0, 'سوسیس', 0.5, 2500, 2, '2016-03-10', '15:09:00', 775576),
(30, 7, 'فلافل', 2, 2000, 1, '2016-04-14', '17:41:00', 391838),
(31, 0, 'قرمه', 2, 26000, 3, '2016-04-14', '17:41:00', 604720),
(32, 0, 'سوسیس', 0.2, 1000, 2, '2016-04-14', '17:41:00', 383575),
(33, 0, 'نوشابه', 1, 20, 2, '2016-08-07', '15:19:00', 712918),
(34, 59, '1aasdasd', 1, 40, 1, '2016-08-21', '11:25:00', 7706894),
(35, 60, '22', 1, 20, 1, '2016-08-24', '15:15:00', 2465872),
(36, 0, 'املت', 2, 25000, 3, '2016-08-20', '10:50:00', 8812485);

-- --------------------------------------------------------

--
-- Table structure for table `z_staff_order_type`
--

DROP TABLE IF EXISTS `z_staff_order_type`;
CREATE TABLE IF NOT EXISTS `z_staff_order_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_staff_order_type`
--

INSERT INTO `z_staff_order_type` (`id`, `title`) VALUES
(1, 'منوی رستوران'),
(2, 'موجودی انبار'),
(3, 'سفارش از بیرون');

-- --------------------------------------------------------

--
-- Table structure for table `z_storages`
--

DROP TABLE IF EXISTS `z_storages`;
CREATE TABLE IF NOT EXISTS `z_storages` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` text,
  `desc` text,
  `parent_id` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_storages`
--

INSERT INTO `z_storages` (`id`, `title`, `desc`, `parent_id`, `status`) VALUES
(1, 'انبار مرکزی', NULL, 0, 0),
(2, 'انبار موقت', NULL, 0, 0),
(3, 'sdfsdf', NULL, 0, 1),
(4, 'انبار کاهو', NULL, 2, 0),
(5, 'انبار 2', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `z_transactions`
--

DROP TABLE IF EXISTS `z_transactions`;
CREATE TABLE IF NOT EXISTS `z_transactions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `trans_id` bigint(20) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `cash` bigint(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `desc` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_transactions`
--

INSERT INTO `z_transactions` (`id`, `trans_id`, `account_id`, `type`, `cash`, `date`, `time`, `desc`) VALUES
(1, 2569315, 4, 2, 300000, '2016-08-18', '11:11:00', 'پرداخت قبض آذر - دی hstkn'),
(2, 884116, 4, 3, 60000, '2016-04-14', '19:39:00', 'فروش میز بدرد نخور'),
(3, 237564, 1, 4, 38000, '2016-08-01', '14:25:00', '38000'),
(4, 3300230, 1, 2, 56675, '2016-08-16', '14:50:00', 'asdasd'),
(5, 902398, 1, 5, 3545768, '2016-03-07', '10:33:00', ''),
(6, 7705211, 1, 2, 2000000, '2016-08-16', '14:50:00', 'asdasd'),
(7, 238245, 1, 2, 1100000, '2016-08-02', '16:20:00', 'asdasd'),
(8, 144624, 1, 2, 1100000, '2016-08-01', '13:09:00', 'ghjghj'),
(10, 261920, 1, 6, 6000, '2016-03-10', '14:37:00', NULL),
(11, 69615, 1, 6, 38000, '2016-03-10', '14:44:00', NULL),
(12, 558092, 1, 6, 1660, '2016-03-10', '15:00:00', NULL),
(13, 79303, 1, 6, 1660, '2016-03-10', '15:03:00', NULL),
(14, 613495, 1, 6, 1660, '2016-03-10', '15:03:00', NULL),
(15, 775576, 1, 6, 2820, '2016-03-10', '15:09:00', NULL),
(16, 895352, 1, 4, 24000, '2016-03-11', '11:07:00', NULL),
(17, 396815, NULL, 3, 100000, '2016-03-12', NULL, NULL),
(18, 130124, NULL, 3, 200000, '2016-03-12', NULL, NULL),
(19, 665145, NULL, 3, 60000, '2016-03-12', NULL, NULL),
(20, 979815, NULL, 3, 100000, '2016-03-12', NULL, NULL),
(21, 398987, NULL, 3, 777000, '2016-03-12', NULL, NULL),
(22, 664140, 4, 6, 130000, '2016-03-14', '09:43:00', NULL),
(24, 196157, 4, 6, 145000, '2016-03-14', '09:47:00', NULL),
(25, 450847, 1, 7, 24000, '2016-03-14', '16:58:00', NULL),
(26, 844399, 1, 8, 51000, '2016-03-16', '11:22:00', NULL),
(27, 366530, 1, 8, 68000, '2016-04-03', '10:39:00', NULL),
(28, 465957, 1, 8, 30000, '2016-04-12', '11:38:00', NULL),
(29, 391838, 2, 6, 2000, '2016-04-14', '17:41:00', NULL),
(30, 604720, 2, 6, 26000, '2016-04-14', '17:41:00', NULL),
(31, 383575, 3, 6, 1000, '2016-04-14', '17:41:00', NULL),
(32, 797578, 1, 8, 19800, '2016-04-16', '15:11:00', NULL),
(33, 236420, 1, 8, 61200, '2016-04-16', '15:20:00', NULL),
(34, 486161, 1, 8, 61200, '2016-04-16', '15:22:00', NULL),
(35, 39290, 1, 8, 77400, '2016-04-16', '15:23:00', NULL),
(36, 655079, 1, 8, 59000, '2016-04-17', '10:49:00', NULL),
(37, 957247, 1, 8, 64800, '2016-04-17', '11:06:00', NULL),
(38, 239558, 1, 8, 53100, '2016-04-20', '16:23:00', NULL),
(39, 663630, 1, 8, 22000, '2016-04-24', '10:11:00', NULL),
(40, 350377, 1, 6, 200000, '2016-04-24', '11:09:00', NULL),
(41, 620207, 1, 6, 333000, '2016-04-24', '11:10:00', NULL),
(42, 694682, 1, 8, 72000, '2016-05-17', '20:57:00', NULL),
(43, 504203, 1, 8, 72900, '2016-05-17', '21:10:00', NULL),
(44, 432451, 1, 8, 72000, '2016-05-17', '21:13:00', NULL),
(45, 711526, 1, 8, 99000, '2016-05-17', '21:14:00', NULL),
(46, 631507, 1, 8, NULL, '2016-05-17', '21:14:00', NULL),
(47, 108590, 1, 8, 171000, '2016-05-17', '21:16:00', NULL),
(48, 929492, 1, 8, NULL, '2016-05-17', '21:16:00', NULL),
(49, 972973, 1, 8, 82800, '2016-05-17', '22:06:00', NULL),
(50, 593607, 1, 8, 94500, '2016-05-17', '22:16:00', NULL),
(51, 811397, 1, 8, 85500, '2016-05-17', '22:17:00', NULL),
(52, 494858, 1, 8, 81000, '2016-05-18', '19:52:00', NULL),
(53, 929128, 1, 8, 81000, '2016-05-18', '19:53:00', NULL),
(54, 804, 1, 8, 118800, '2016-05-18', '19:54:00', NULL),
(55, 916225, 1, 8, 29250, '2016-06-07', '21:25:00', NULL),
(56, 146465, 1, 8, 42900, '2016-06-07', '21:26:00', NULL),
(57, 526701, 1, 8, 59400, '2016-06-07', '21:43:00', NULL),
(58, 800712, 4, 9, 456456, '2016-08-01', '13:09:00', 'dgfdg'),
(61, 339896, 4, 5, 54646, '2016-08-01', '14:33:00', 'bvnbvn'),
(63, 316989, NULL, 3, 200000, '2016-08-01', NULL, NULL),
(64, 668292, NULL, 3, 200000, '2016-08-01', NULL, NULL),
(65, 604192, 1, 1, 500, '2016-08-01', '15:48:00', 'aaaaaaaaaaaaa'),
(66, 217404, 1, 7, 144, '2016-08-02', '18:21:00', NULL),
(67, 149551, 1, 7, 28536, '2016-08-03', '09:30:00', NULL),
(68, 131595, 1, 7, 1089, '2016-08-03', '09:31:00', NULL),
(69, 412024, 1, 7, 1452, '2016-08-03', '09:31:00', NULL),
(70, 869798, 1, 7, 176, '2016-08-03', '09:32:00', NULL),
(71, 341148, 1, 7, 1200, '2016-08-03', '11:20:00', NULL),
(72, 761377, 1, 7, 100000, '2016-08-03', '11:23:00', NULL),
(73, 850131, 1, 7, 10000, '2016-08-03', '11:59:00', NULL),
(74, 291965, 1, 8, NULL, '2016-08-03', '13:15:00', NULL),
(75, 577620, 1, 7, 10000, '2016-08-03', '15:30:00', NULL),
(76, 276629, 1, 6, 1200, '2016-08-07', '11:31:00', NULL),
(77, 532806, NULL, 3, 1200, '2016-08-07', NULL, NULL),
(79, 712918, 3, 6, 20, '2016-08-07', '15:19:00', NULL),
(80, 938758, NULL, 3, 120, '2016-08-07', NULL, NULL),
(81, 6612239, 1, 6, 123, '2016-08-07', '16:31:00', NULL),
(84, 909626, 1, 8, NULL, '2016-08-07', '17:00:00', NULL),
(86, 6149421, NULL, 3, 100, '2016-08-08', NULL, NULL),
(87, 1128602, 1, 6, 500, '2016-08-08', '10:39:00', NULL),
(88, 5720406, 1, 3, 500, '2016-08-08', NULL, NULL),
(92, 7706894, 2, 6, 40, '2016-08-08', '11:25:00', NULL),
(95, 6268318, 1, 3, 1, '2016-08-08', NULL, NULL),
(96, 521510, 1, 8, NULL, '2016-08-08', '15:51:00', NULL),
(97, 1770554, NULL, 2, 2000000, '2016-08-08', NULL, NULL),
(98, 394268, NULL, 2, 2000000, '2016-08-08', NULL, NULL),
(101, 231491, 1, 2, 2200000, '2016-08-09', NULL, NULL),
(102, 5250247, 1, 2, 100, '2016-08-09', NULL, NULL),
(103, 232632, 1, 8, NULL, '2016-08-10', '10:09:00', NULL),
(104, 413988, 1, 8, NULL, '2016-08-10', '10:11:00', NULL),
(105, 514080, 1, 8, NULL, '2016-08-10', '10:19:00', NULL),
(106, 3891062, 1, 1, 27502, '2016-08-13', NULL, NULL),
(107, 712692, 1, 1, 30506, '2016-08-13', NULL, NULL),
(108, 2338380, 1, 3, 200000, '2016-08-16', '14:55:00', 'xzc'),
(109, 5412500, 1, 1, 20002, '2016-08-14', NULL, NULL),
(110, 634442, 1, 1, 86500, '2016-08-16', '14:50:00', 'asads'),
(111, 8688591, 1, 1, 54000, '2016-08-14', NULL, NULL),
(112, 201165, 1, 1, 47502, '2016-08-14', NULL, NULL),
(113, 4675744, 1, 1, 60000, '2016-08-15', NULL, NULL),
(114, 2465872, 2, 6, 20, '2016-08-16', '15:15:00', NULL),
(116, 7989883, 1, 2, 2000000, '2016-08-17', NULL, NULL),
(118, 2666284, 4, 3, 145000, '2016-08-17', NULL, NULL),
(121, 3178919, 1, 3, 10, '2016-08-17', NULL, NULL),
(124, 7432274, 1, 1, 40000, '2016-08-18', NULL, NULL),
(125, 4895584, 1, 1, 30000, '2016-08-18', NULL, NULL),
(126, 841257, 1, 1, 20000, '2016-08-18', NULL, NULL),
(127, 9247866, 1, 1, 60000, '2016-08-18', NULL, NULL),
(128, 5420112, 1, 1, 38000, '2016-08-18', NULL, NULL),
(129, 6941895, 1, 2, 2200000, '2016-08-18', NULL, NULL),
(130, 246711, 1, 1, 20000, '2016-08-20', NULL, NULL),
(131, 1743242, 1, 2, 150000, '2016-08-20', '10:47:00', 'asdasd'),
(132, 8812485, 1, 6, 25000, '2016-08-20', '10:50:00', NULL),
(133, 7434940, 1, 7, 1000, '2016-08-20', '11:05:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `z_trans_sub_type`
--

DROP TABLE IF EXISTS `z_trans_sub_type`;
CREATE TABLE IF NOT EXISTS `z_trans_sub_type` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `title` text,
  `desc` text,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_trans_sub_type`
--

INSERT INTO `z_trans_sub_type` (`id`, `parent_id`, `title`, `desc`, `status`) VALUES
(1, 1, 'قبض آب', 'asdasd', 0),
(2, 1, 'قبض تلفن', 'پرداختی های مربوط به قبض گاز', 0),
(3, 2, 'فروش لوازم جانبی', 'xxx', 0),
(4, 2, 'مناسبتها', '', 0),
(5, 2, 'سفارش عمده', '', 0),
(6, 3, 'اعطای وام', NULL, 0),
(7, 7, 'خرید مواد اولیه', NULL, 0),
(8, 4, 'سفارش غذا', NULL, 0),
(9, 1, 'سسسس', 'sss', 0),
(11, 1, ' xvxvx', ' nnnnnnnnn', 1),
(12, 1, 'fjfgh', 'dfsdf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `z_trans_type`
--

DROP TABLE IF EXISTS `z_trans_type`;
CREATE TABLE IF NOT EXISTS `z_trans_type` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` text,
  `desc` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_trans_type`
--

INSERT INTO `z_trans_type` (`id`, `title`, `desc`) VALUES
(1, 'هزینه', NULL),
(2, 'درآمد', NULL),
(3, 'وام', NULL),
(4, 'سفارشات', NULL),
(5, 'حقوق', NULL),
(6, 'مصرف پرسنل', NULL),
(7, 'خرید مواد اولیه', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `z_users`
--

DROP TABLE IF EXISTS `z_users`;
CREATE TABLE IF NOT EXISTS `z_users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` text,
  `phone` text,
  `cctt` text,
  `credit` int(11) DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  `address` text,
  `submit_date` date DEFAULT NULL,
  `last_visit` date DEFAULT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_users`
--

INSERT INTO `z_users` (`id`, `name`, `phone`, `cctt`, `credit`, `discount_id`, `address`, `submit_date`, `last_visit`, `status`) VALUES
(1, 'حسین احمدی', '09369190591', '2220', NULL, NULL, '', '2015-11-03', '2016-04-20', 1),
(2, 'حسن احمدی', '09198370872', '2045', NULL, NULL, 'تهران', '2015-11-11', '2016-06-07', 0),
(3, 'روزبه حدادپور', '09371002020', '2095', NULL, NULL, '', '2015-11-30', '2016-03-15', 0),
(4, 'پرویز مظلومی', '09125878147', '5076', NULL, NULL, NULL, '2015-11-22', '2015-11-22', 0),
(5, 'ایمان حسینی', '09373737252', '7547', NULL, NULL, NULL, '2015-11-22', '2015-11-22', 0),
(7, 'اصغر مرادی', '0911234567', '0275', NULL, NULL, NULL, '2015-12-15', '2015-12-15', 0),
(8, 'سمانه حسینی', '09213213231', '8881', NULL, NULL, NULL, '2015-12-15', '2015-12-15', 0),
(9, 'جاوید هادی', '0123456789', '6523', NULL, NULL, '', '2016-02-19', '2016-02-19', 0),
(10, 'غلامرضا رضایی', '09131213321', '3084', NULL, NULL, NULL, '2016-03-16', '2016-03-16', 0),
(11, 'سعید دلیر', '09102202020', '6034', NULL, NULL, NULL, '2016-04-13', '2016-04-13', 0),
(13, 'جوادقره محمدی', '09102202020', '5942', NULL, NULL, NULL, '2016-04-16', '2016-04-16', 0),
(16, 'yaser darzi', '09111160804', '5390', 1000000, NULL, NULL, '2016-08-03', '2016-08-10', 0),
(19, 'test', 'test', '9196', NULL, NULL, NULL, '2016-08-03', '2016-08-03', 1),
(20, 'test 2', '0213', '8363', NULL, NULL, NULL, '2016-08-03', '2016-08-03', 1),
(23, 'alii ame', '09376706730', '3326', NULL, NULL, NULL, '2016-08-03', '2016-08-03', 1),
(24, 'alii test', '234234', '6272', NULL, NULL, NULL, '2016-08-03', '2016-08-03', 0),
(25, 'ww sfsdfsdf', '09376706730', '0141', NULL, NULL, NULL, '2016-08-07', '2016-08-07', 0),
(26, 'asd asd', '234 132', '4086', NULL, NULL, NULL, '2016-08-08', '2016-08-08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `z_user_coupons`
--

DROP TABLE IF EXISTS `z_user_coupons`;
CREATE TABLE IF NOT EXISTS `z_user_coupons` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_group` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_user_coupons`
--

INSERT INTO `z_user_coupons` (`id`, `code`, `user_id`, `user_group`) VALUES
(1, '64432221', 2045, 0),
(2, '64432221', 2220, 0),
(3, '64432221', 6523, 0),
(4, '64432221', 2095, 0),
(5, '64432221', 5076, 0),
(6, '64432221', 7547, 0),
(7, '64432221', 275, 0),
(8, '64432221', 8881, 0),
(9, '64432221', 3084, 0),
(10, '64432221', 6034, 0),
(11, '64432221', 5942, 0);

-- --------------------------------------------------------

--
-- Table structure for table `z_user_fields`
--

DROP TABLE IF EXISTS `z_user_fields`;
CREATE TABLE IF NOT EXISTS `z_user_fields` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `field_type_id` tinyint(4) DEFAULT NULL,
  `en_name` text,
  `title` text,
  `default_value` text,
  `required` tinyint(4) DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_user_fields`
--

INSERT INTO `z_user_fields` (`id`, `field_type_id`, `en_name`, `title`, `default_value`, `required`, `enabled`) VALUES
(2, 1, 'sex', 'جنسیت', '|مرد||زن|', 0, 1),
(6, 4, 'country', 'ایرانی هستی؟', '', 0, 0),
(7, 1, 'child', 'اسم بچت؟', '', 0, 1),
(10, 1, 'papa_name', 'نام پدر 2', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `z_user_fields_map`
--

DROP TABLE IF EXISTS `z_user_fields_map`;
CREATE TABLE IF NOT EXISTS `z_user_fields_map` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_fields_id` int(11) DEFAULT NULL,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_user_fields_map`
--

INSERT INTO `z_user_fields_map` (`id`, `user_id`, `user_fields_id`, `value`) VALUES
(6, 8, 6, 'بله'),
(7, 3, 2, 'مرد'),
(10, 3, 7, 'غلام'),
(19, 25, 2, 'مرد'),
(20, 25, 7, 'ali'),
(21, 26, 2, 'مرد'),
(22, 26, 7, '234234');

-- --------------------------------------------------------

--
-- Table structure for table `z_vacation`
--

DROP TABLE IF EXISTS `z_vacation`;
CREATE TABLE IF NOT EXISTS `z_vacation` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `from_time` time DEFAULT NULL,
  `to_time` time DEFAULT NULL,
  `desc` text,
  `condition` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_vacation`
--

INSERT INTO `z_vacation` (`id`, `staff_id`, `from_date`, `to_date`, `from_time`, `to_time`, `desc`, `condition`) VALUES
(11, 2, '2016-04-18', '2016-05-01', '08:00:00', '23:30:00', '', 2),
(12, 1, '2016-04-01', '2016-04-06', '00:00:00', '23:30:00', '', 2),
(13, 1, '2016-07-29', '2016-08-01', '00:00:00', '00:00:00', '', 2),
(14, 1, '2016-08-02', '2016-08-05', '00:00:00', '00:00:00', '', 2),
(15, 2, '2016-08-06', '2016-08-14', '00:30:00', '02:00:00', 'aaaaaaaaaaaaa', 2),
(16, 1, '2016-08-01', '2016-08-07', '00:30:00', '02:30:00', 'شسی', 2),
(17, 1, '2016-08-09', '2016-08-14', '01:00:00', '03:00:00', 'شسی', 2),
(18, 7, '2016-08-08', '2016-08-12', '00:30:00', '02:30:00', 'aaaaaaaaaaaaa', 3),
(19, 7, '2016-07-23', '2016-08-08', '02:00:00', '02:00:00', 'vvvvvv', 2),
(20, 5, '2016-06-23', '2016-06-25', '00:30:00', '02:30:00', 'asdasd', 2),
(21, 5, '2016-08-18', '2016-08-18', '00:30:00', '03:00:00', 'dfgdfg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `z_vacation_condition`
--

DROP TABLE IF EXISTS `z_vacation_condition`;
CREATE TABLE IF NOT EXISTS `z_vacation_condition` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_vacation_condition`
--

INSERT INTO `z_vacation_condition` (`id`, `title`) VALUES
(1, 'ثبت شده'),
(2, 'تایید شده'),
(3, 'تایید نشده');

-- --------------------------------------------------------

--
-- Table structure for table `z_votes`
--

DROP TABLE IF EXISTS `z_votes`;
CREATE TABLE IF NOT EXISTS `z_votes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `q_id` int(11) DEFAULT NULL,
  `answer_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_votes`
--

INSERT INTO `z_votes` (`id`, `user_id`, `q_id`, `answer_id`, `date`, `time`) VALUES
(5, 2, 4, 9, '2016-03-15', '13:12:00'),
(6, 1, 4, 10, '2016-03-15', '13:28:00'),
(7, 3, 4, 9, '2016-03-15', '13:29:00'),
(8, 2, 5, 22, '2016-04-23', '11:49:00'),
(9, 23, 4, 9, '2016-08-03', '16:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `z_vote_answer`
--

DROP TABLE IF EXISTS `z_vote_answer`;
CREATE TABLE IF NOT EXISTS `z_vote_answer` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `q_id` int(11) DEFAULT NULL,
  `title` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_vote_answer`
--

INSERT INTO `z_vote_answer` (`id`, `q_id`, `title`) VALUES
(9, 4, 'قرمه سبزی'),
(10, 4, 'کشک و بادمجان'),
(11, 4, 'زرشک پلو'),
(20, 4, 'قیمه'),
(21, 5, 'قیمه'),
(22, 5, 'قرمه سبزی');

-- --------------------------------------------------------

--
-- Table structure for table `z_vote_question`
--

DROP TABLE IF EXISTS `z_vote_question`;
CREATE TABLE IF NOT EXISTS `z_vote_question` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` text,
  `enable` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_vote_question`
--

INSERT INTO `z_vote_question` (`id`, `title`, `enable`) VALUES
(4, 'غذای مورد علاقه؟', 1),
(5, 'غذای مورد علاقه شما چیست ?', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
