-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 30, 2022 at 02:31 PM
-- Server version: 8.0.13-4
-- PHP Version: 7.2.24-0ubuntu0.18.04.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `BPJtFyyJyY`
--

-- --------------------------------------------------------

--
-- Table structure for table `final_submit`
--

CREATE TABLE `final_submit` (
  `sno` int(5) NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `type` text COLLATE utf8_unicode_ci NOT NULL,
  `heading` text COLLATE utf8_unicode_ci NOT NULL,
  `submission` text COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_recruitment`
--

CREATE TABLE `staff_recruitment` (
  `sno` int(255) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `discord_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `help` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `experience` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submission`
--

CREATE TABLE `submission` (
  `id` int(5) NOT NULL,
  `submission` text NOT NULL,
  `type` varchar(30) NOT NULL,
  `dc_id` bigint(20) NOT NULL,
  `dc_tag` varchar(40) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message_id` bigint(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verification`
--

CREATE TABLE `verification` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `section` varchar(1) NOT NULL,
  `roll_number` int(3) NOT NULL,
  `dc_id` varchar(25) NOT NULL,
  `dc_tag` varchar(50) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `verification`
--

INSERT INTO `verification` (`id`, `name`, `section`, `roll_number`, `dc_id`, `dc_tag`) VALUES
(1, 'Jivesh Kalra', 'B', 14, '551603967885312001', 'BOOYAH SQUADIANS#6080'),
(2, 'Jivesh Alt', 'B', 14, '873604364462346330', 'Itz Booyah#2368'),
(3, 'Anubhav', 'A', 1, '944944402449711114', 'System#4104'),
(4, 'khyati', 'C', 6, '797370387049742388', 'ThatBrownGarll#6885'),
(5, 'Nimeesha Kaur', 'B', 20, '917734437381374032', 'thenimxb_txh#8333'),
(6, 'Kanishka Singhal', 'F', 12, '936316383371857950', 'susti ke pachas saayen#1204'),
(7, 'saksham chauhan', 'B', 25, '938457528004665435', 'SAKSHAM#1450'),
(8, 'udayan dureja', 'B', 13, '733931383101325363', 'Udayan+_+#3339'),
(9, 'Vardan', 'H', 14, '877038200370118677', 'Vɪɾυ™#2246'),
(10, 'nishant', 'H', 28, '792058780082634792', 'clown#2528'),
(11, 'Anvi Chhabra', 'B', 40, '954061106513575997', 'dawnbreaksthrough07#5027'),
(12, 'Riddhima', 'G', 15, '950987533628624917', 'rids⁷#4988'),
(13, 'Dhruv', 'B', 1, '749853217504100413', 'Dhruv#5552'),
(14, 'Kanishka', 'G', 17, '960547105628389477', 'Kanishka#8469'),
(15, 'Vishishta Sharma', 'F', 15, '962636266476806194', 'wish.rma#7198'),
(16, 'diwanshi taneja', 'B', 25, '883246140340990012', 'diwanshi_tanejaaa#2711'),
(17, 'Shreyas Sood', 'C', 15, '904680923558187040', 'ςҺՐ૯עคς#2610'),
(18, 'Pearl', 'C', 31, '937625356649775146', 'Pearl#4027'),
(19, 'Ashmit Chauhan', 'H', 10, '772706216278360074', 'Ashmit_Chauhan#0579'),
(20, 'Prachi', 'C', 13, '963465097609621544', 'Prachi#5107'),
(21, 'Shagun', 'A', 1, '942793920394432562', 'maniac`-`#6197'),
(22, 'Abhro Ghosh', 'C', 25, '921009495835021374', 'MERCURYBANE#7754'),
(23, 'Navjot Malik', 'H', 13, '924892274108805172', 'Navjot#5658'),
(24, 'Ritisha Dutta', 'E', 6, '786958467914530827', 'TheDarkKnight#2351'),
(25, 'DishiAggarwal', 'A', 26, '898213552169549845', 'Dishi#1925'),
(26, 'vihaan', 'C', 2, '900956928128217109', 'HeartUponMySleeve#6761'),
(27, 'Vaibhav kumar', 'E', 10, '910162928290902016', 'vaibhav the robo master#4092'),
(28, 'Arav', 'A', 14, '954388416227840000', 'rAnDoM.Exe#7562');

-- --------------------------------------------------------

--
-- Table structure for table `verification_temp`
--

CREATE TABLE `verification_temp` (
  `id` int(10) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `section` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `roll_number` int(3) NOT NULL,
  `dc_id` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dc_tag` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `website_comments`
--

CREATE TABLE `website_comments` (
  `sno` int(11) NOT NULL,
  `post_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `is_edited` int(10) NOT NULL DEFAULT '0',
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `website_contact`
--

CREATE TABLE `website_contact` (
  `id` int(11) NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `website_posts`
--

CREATE TABLE `website_posts` (
  `sno` int(255) NOT NULL,
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `heading` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `image_link` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `views` int(255) NOT NULL DEFAULT '0',
  `admin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `website_submit`
--

CREATE TABLE `website_submit` (
  `sno` int(5) NOT NULL,
  `email` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `heading` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `submission` text COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `website_users`
--

CREATE TABLE `website_users` (
  `sno` int(255) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `discord_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `insta_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `verification_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_verified` int(2) NOT NULL DEFAULT '0',
  `reset_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_token_expire` date DEFAULT NULL,
  `referral_code` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `referral_points` int(200) NOT NULL DEFAULT '0',
  `referred_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'none'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `final_submit`
--
ALTER TABLE `final_submit`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `staff_recruitment`
--
ALTER TABLE `staff_recruitment`
  ADD PRIMARY KEY (`sno`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `discord_id` (`discord_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `submission`
--
ALTER TABLE `submission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verification`
--
ALTER TABLE `verification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verification_temp`
--
ALTER TABLE `verification_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `website_comments`
--
ALTER TABLE `website_comments`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `website_contact`
--
ALTER TABLE `website_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `website_posts`
--
ALTER TABLE `website_posts`
  ADD PRIMARY KEY (`sno`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `website_submit`
--
ALTER TABLE `website_submit`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `website_users`
--
ALTER TABLE `website_users`
  ADD PRIMARY KEY (`sno`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `discord_id` (`discord_id`,`insta_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `final_submit`
--
ALTER TABLE `final_submit`
  MODIFY `sno` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_recruitment`
--
ALTER TABLE `staff_recruitment`
  MODIFY `sno` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `submission`
--
ALTER TABLE `submission`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verification`
--
ALTER TABLE `verification`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `verification_temp`
--
ALTER TABLE `verification_temp`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `website_comments`
--
ALTER TABLE `website_comments`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `website_contact`
--
ALTER TABLE `website_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `website_posts`
--
ALTER TABLE `website_posts`
  MODIFY `sno` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `website_submit`
--
ALTER TABLE `website_submit`
  MODIFY `sno` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `website_users`
--
ALTER TABLE `website_users`
  MODIFY `sno` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
