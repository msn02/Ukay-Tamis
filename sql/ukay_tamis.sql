-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2024 at 07:54 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ukay_tamis`
--

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` varchar(10) NOT NULL,
  `style_id` varchar(10) DEFAULT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `item_description` varchar(255) DEFAULT NULL,
  `style` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `size` enum('XS','S','M','L','XL','XXL') DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `item_img_url` varchar(45) DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `order_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `style_id`, `item_name`, `item_description`, `style`, `price`, `size`, `color`, `item_img_url`, `transaction_id`, `order_number`) VALUES
('item-00015', 'style-0001', 'Vintage Floral Blouse', 'Featuring delicate flower patterns and a classic silhouette, this blouse is perfect for adding a touch of nostalgia to your wardrobe.', 'Cottagecore', 229.00, 'XS', 'Brown', 'dress.jpg', NULL, 'ORD-20240516-0000342'),
('item-00016', 'style-0001', 'Chunky Knit Sweater', 'Stay cozy and stylish in this chunky knit sweater. Made from soft and warm yarn, this sweater features a relaxed fit and a timeless cable knit design', 'Cottagecore', 339.00, 'M', 'Green', 'dress.jpg', NULL, 'ORD-20240516-0000348'),
('item-00017', 'style-0002', 'Leopard Sunglasses', 'Featuring a timeless lace-up design and a durable rubber sole, these sneakers are perfect for everyday wear. ', 'Coquette', 79.00, 'L', 'Multicolor', 'dress.jpg', NULL, 'ORD-20240516-0000354');

--
-- Triggers `item`
--
DELIMITER $$
CREATE TRIGGER `generate_item_id` BEFORE INSERT ON `item` FOR EACH ROW BEGIN
    DECLARE next_id INT;
    DECLARE new_item_id VARCHAR(10);
    
    -- Get the next sequence value
    INSERT INTO sequence VALUES (NULL);
    SET next_id = LAST_INSERT_ID();
    
    -- Generate the alphanumeric ID
    SET new_item_id = CONCAT('item-', LPAD(next_id, 5, '0'));
    
    -- Set the new item_id value
    SET NEW.item_id = new_item_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_order_number_item` BEFORE UPDATE ON `item` FOR EACH ROW BEGIN
    DECLARE order_number_val VARCHAR(20);
    
    -- Get the order_number corresponding to the updated transaction_id
    IF NEW.transaction_id IS NOT NULL THEN
        SELECT order_number INTO order_number_val
        FROM `transaction`
        WHERE transaction_id = NEW.transaction_id;
        
        -- Update the order_number column in the item table
        SET NEW.order_number = order_number_val;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `item_id` varchar(10) DEFAULT NULL,
  `item_name` varchar(45) DEFAULT NULL,
  `item_price` int(11) DEFAULT NULL,
  `style_box_id` varchar(10) DEFAULT NULL,
  `style_box_name` varchar(45) DEFAULT NULL,
  `style_box_price` int(11) DEFAULT NULL,
  `style_box_quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`id`, `transaction_id`, `item_id`, `item_name`, `item_price`, `style_box_id`, `style_box_name`, `style_box_price`, `style_box_quantity`) VALUES
(1, 47, 'item-00015', 'Vintage Floral Blouse', 229, NULL, NULL, NULL, NULL),
(2, 49, 'item-00015', 'Vintage Floral Blouse', 229, NULL, NULL, NULL, NULL),
(4, 49, 'item-00015', 'Vintage Floral Blouse', 229, NULL, NULL, NULL, NULL),
(10, 49, NULL, NULL, NULL, 'box-000019', 'Cottagecore', 229, 0),
(11, 50, NULL, NULL, NULL, 'box-000019', 'Cottagecore', 229, 1),
(12, 51, NULL, NULL, NULL, 'box-000020', 'Coquette', 229, 3),
(13, 51, NULL, NULL, NULL, 'box-000021', 'Gothic Lolita', 229, 3),
(14, 52, NULL, NULL, NULL, 'box-000073', 'Mystery', 229, 3),
(15, 53, NULL, NULL, NULL, 'box-000019', 'Cottagecore', 229, 2),
(16, 53, NULL, NULL, NULL, 'box-000073', 'Mystery', 229, 1),
(17, 55, NULL, NULL, NULL, 'box-000020', 'Coquette', 229, 2),
(20, 58, NULL, NULL, NULL, 'box-000019', 'Cottagecore', 229, 1),
(21, 59, NULL, NULL, NULL, 'box-000073', 'Mystery', 229, 3),
(22, 60, NULL, NULL, NULL, 'box-000021', 'Gothic Lolita', 229, 1),
(23, 61, NULL, NULL, NULL, 'box-000019', 'Cottagecore', 229, 3),
(27, 78, NULL, NULL, NULL, 'box-000073', 'Mystery', 229, 1),
(28, 82, 'item-00015', 'Vintage Floral Blouse', 229, NULL, NULL, NULL, NULL),
(29, 83, NULL, NULL, NULL, 'box-000073', 'Mystery', 229, 1),
(30, 84, NULL, NULL, NULL, 'box-000019', 'Cottagecore', 229, 1),
(31, 88, NULL, NULL, NULL, 'box-000073', 'Mystery', 229, 1),
(32, 88, 'item-00016', 'Chunky Knit Sweater', 339, NULL, NULL, NULL, NULL),
(33, 93, NULL, NULL, NULL, 'box-000019', 'Cottagecore', 229, 3),
(34, 93, 'item-00015', 'Vintage Floral Blouse', 229, NULL, NULL, NULL, NULL),
(35, 100, 'item-00016', 'Chunky Knit Sweater', 339, NULL, NULL, NULL, NULL),
(36, 102, NULL, NULL, NULL, 'box-000019', 'Cottagecore', 229, 1),
(37, 104, NULL, NULL, NULL, 'box-000019', 'Cottagecore', 229, 3),
(38, 105, NULL, NULL, NULL, 'box-000019', 'Cottagecore', 229, 1),
(39, 117, 'item-00017', 'Leopard Sunglasses', 79, NULL, NULL, NULL, NULL),
(40, 118, NULL, NULL, NULL, 'box-000019', 'Cottagecore', 229, 1),
(41, 119, NULL, NULL, NULL, 'box-000073', 'Mystery', 229, 3),
(42, 149, NULL, NULL, NULL, 'box-000019', NULL, 229, NULL),
(43, 150, NULL, NULL, NULL, 'box-000019', NULL, 229, NULL),
(44, 151, NULL, NULL, NULL, 'box-000019', NULL, 229, NULL),
(45, 152, NULL, NULL, NULL, 'box-000021', 'Gothic Lolita', 229, 1),
(46, 153, NULL, NULL, NULL, 'box-000021', 'Gothic Lolita', 229, 1),
(47, 154, NULL, NULL, NULL, 'box-000021', 'Gothic Lolita', 229, 1),
(48, 155, 'item-00015', 'Vintage Floral Blouse', 229, NULL, NULL, NULL, NULL),
(49, 156, NULL, NULL, NULL, 'box-000019', 'Cottagecore', 229, 1),
(50, 157, NULL, NULL, NULL, 'box-000021', 'Gothic Lolita', 229, 1),
(51, 158, NULL, NULL, NULL, 'box-000021', 'Gothic Lolita', 229, 1),
(52, 159, NULL, NULL, NULL, 'box-000021', 'Gothic Lolita', 229, 1),
(53, 160, NULL, NULL, NULL, 'box-000021', 'Gothic Lolita', 229, 1),
(54, 161, NULL, NULL, NULL, 'box-000020', 'Coquette', 229, 1),
(55, 162, NULL, NULL, NULL, 'box-000019', 'Cottagecore', 229, 1),
(56, 163, NULL, NULL, NULL, 'box-000021', 'Gothic Lolita', 229, 1),
(57, 164, NULL, NULL, NULL, 'box-000021', 'Gothic Lolita', 229, 1),
(58, 165, NULL, NULL, NULL, 'box-000019', 'Cottagecore', 229, 1),
(59, 166, 'item-00016', 'Chunky Knit Sweater', 339, NULL, NULL, NULL, NULL),
(60, 167, NULL, NULL, NULL, 'box-000020', 'Coquette', 229, 1),
(61, 168, NULL, NULL, NULL, 'box-000019', 'Cottagecore', 229, 1),
(62, 169, NULL, NULL, NULL, 'box-000021', 'Gothic Lolita', 229, 1),
(63, 170, NULL, NULL, NULL, 'box-000021', 'Gothic Lolita', 229, 1),
(64, 171, NULL, NULL, NULL, 'box-000019', 'Cottagecore', 229, 1),
(65, 172, 'item-00017', 'Leopard Sunglasses', 79, NULL, NULL, NULL, NULL),
(66, 173, NULL, NULL, NULL, 'box-000019', 'Cottagecore', 229, 1),
(67, 174, NULL, NULL, NULL, 'box-000020', 'Coquette', 229, 1),
(68, 175, NULL, NULL, NULL, 'box-000021', 'Gothic Lolita', 229, 1),
(69, 176, NULL, NULL, NULL, 'box-000021', 'Gothic Lolita', 229, 1),
(70, 177, NULL, NULL, NULL, 'box-000019', 'Cottagecore', 229, 1),
(71, 178, NULL, NULL, NULL, 'box-000019', 'Cottagecore', 229, 1),
(72, 179, 'item-00015', 'Vintage Floral Blouse', 229, NULL, NULL, NULL, NULL),
(73, 179, NULL, NULL, NULL, 'box-000019', 'Cottagecore', 229, 1),
(74, 179, NULL, NULL, NULL, 'box-000021', 'Gothic Lolita', 229, 1),
(75, 185, 'item-00016', 'Chunky Knit Sweater', 339, NULL, NULL, NULL, NULL),
(76, 186, NULL, NULL, NULL, 'box-000019', 'Cottagecore', 229, 1),
(77, 187, NULL, NULL, NULL, 'box-000021', 'Gothic Lolita', 229, 1),
(78, 188, NULL, NULL, NULL, 'box-000019', 'Cottagecore', 229, 1),
(79, 188, NULL, NULL, NULL, 'box-000020', 'Coquette', 229, 1),
(80, 189, NULL, NULL, NULL, 'box-000019', 'Cottagecore', 229, 1),
(81, 189, NULL, NULL, NULL, 'box-000020', 'Coquette', 229, 1),
(82, 190, NULL, NULL, NULL, 'box-000019', 'Cottagecore', 229, 1),
(83, 190, NULL, NULL, NULL, 'box-000021', 'Gothic Lolita', 229, 1),
(84, 190, NULL, NULL, NULL, 'box-000020', 'Coquette', 229, 1),
(85, 191, 'item-00017', 'Leopard Sunglasses', 79, NULL, NULL, NULL, NULL),
(86, 192, NULL, NULL, NULL, 'box-000021', 'Gothic Lolita', 229, 1),
(87, 193, NULL, NULL, NULL, 'box-000020', 'Coquette', 229, 1),
(88, 194, NULL, NULL, NULL, 'box-000019', 'Cottagecore', 229, 1),
(89, 195, NULL, NULL, NULL, 'box-000021', 'Gothic Lolita', 229, 1),
(90, 196, NULL, NULL, NULL, 'box-000021', 'Gothic Lolita', 229, 1),
(91, 197, NULL, NULL, NULL, 'box-000023', 'Y2K', 229, 1),
(92, 198, NULL, NULL, NULL, 'box-000020', 'Coquette', 229, 1),
(93, 205, NULL, NULL, NULL, 'box-000019', 'Cottagecore', 229, 1),
(94, 208, NULL, NULL, NULL, 'box-000021', 'Gothic Lolita', 229, 1),
(95, 209, NULL, NULL, NULL, 'box-000024', 'Dark Academia', 229, 1),
(96, 210, NULL, NULL, NULL, 'box-000020', 'Coquette', 229, 1),
(97, 211, NULL, NULL, NULL, 'box-000019', 'Cottagecore', 229, 2),
(98, 211, NULL, NULL, NULL, 'box-000073', 'Mystery', 229, 1),
(99, 212, NULL, NULL, NULL, 'box-000021', 'Gothic Lolita', 229, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `review` mediumtext DEFAULT NULL,
  `img_review` varchar(45) DEFAULT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `item_id` varchar(10) DEFAULT NULL,
  `style_box_id` varchar(10) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `style_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `rating`, `title`, `review`, `img_review`, `user_id`, `item_id`, `style_box_id`, `timestamp`, `style_id`) VALUES
(1, 5, '123123123', '1231231231', 'calc.png', 'user-00330', NULL, NULL, NULL, NULL),
(2, 5, '123123', '1231312312', 'database_schema.png', 'user-00330', NULL, NULL, NULL, NULL),
(3, 5, 'asdasdas', 'asdfasdfasdfa', 'Screenshot 2022-02-16 205007.png', 'user-00330', NULL, NULL, NULL, NULL),
(4, 5, '213123', '312312312', 'Screenshot 2022-04-15 133258.png', 'user-00330', NULL, NULL, NULL, NULL),
(5, 5, '213123', '312312312', 'Screenshot 2022-04-15 133258.png', 'user-00330', NULL, 'box-000019', NULL, NULL),
(6, 5, 'zxcvb', 'asdfghv', 'Screenshot 2022-02-16 205007.png', 'user-00330', NULL, 'box-000019', '2024-05-15 22:23:34', NULL),
(7, 5, 'zxcvb', 'asdfghv', 'Screenshot 2022-02-16 205007.png', 'user-00330', NULL, 'box-000019', '2024-05-15 22:29:19', NULL),
(8, 5, 'zxcvb', 'asdfghv', 'Screenshot 2022-02-16 205007.png', 'user-00330', NULL, 'box-000019', '2024-05-15 22:29:21', NULL),
(9, 5, 'zxcvb', 'asdfghv', 'Screenshot 2022-02-16 205007.png', 'user-00330', NULL, 'box-000019', '2024-05-15 22:29:22', NULL),
(10, 5, 'zxcvb', 'asdfghv', 'Screenshot 2022-02-16 205007.png', 'user-00330', NULL, 'box-000019', '2024-05-15 22:29:22', NULL),
(11, 5, 'zxcvb', 'asdfghv', 'Screenshot 2022-02-16 205007.png', 'user-00330', NULL, 'box-000019', '2024-05-15 22:29:23', NULL),
(12, 5, 'zxcvb', 'asdfghv', 'Screenshot 2022-02-16 205007.png', 'user-00330', NULL, 'box-000019', '2024-05-15 22:29:36', NULL),
(16, 1, '123123', 'asdfasdfasdfa', 'omori.png', 'user-00330', NULL, 'box-000019', '2024-05-15 22:52:14', 'style-0001'),
(17, 5, '123123', 'safasdfadfa', 'Screenshot 2022-02-16 205007.png', 'user-00330', NULL, 'box-000019', '2024-05-15 23:09:11', 'style-0001'),
(18, 5, 'Omgggg', 'literally so amazing, so worth it', 'kai.png', 'user-00330', NULL, 'box-000021', '2024-05-15 23:12:50', 'style-0003'),
(19, 5, 'Omgggg', 'literally so amazing, so worth it', 'kai.png', 'user-00330', NULL, 'box-000021', '2024-05-15 23:12:57', 'style-0003'),
(20, 5, 'Omgggg', 'literally so amazing, so worth it', 'kai.png', 'user-00330', NULL, 'box-000021', '2024-05-15 23:12:57', 'style-0003'),
(21, 5, 'Omgggg', '12312312', 'Screenshot 2022-12-15 230841.png', 'user-00330', NULL, 'box-000020', '2024-05-15 23:20:42', 'style-0002'),
(22, 3, 'Omgggg', 'asdfghnbvcx', 'Screenshot 2022-08-10 110034.png', 'user-00330', NULL, 'box-000020', '2024-05-15 23:48:50', 'style-0002'),
(23, 3, 'Holy Crappp', 'Nothing to say, so amwazed', 'Screenshot 2022-02-16 205007.png', 'user-00330', NULL, 'box-000073', '2024-05-16 05:39:33', 'style-0068'),
(24, 5, 'Omgggg', 'asdasdasda', 'Image 4.png', 'user-00330', NULL, 'box-000021', '2024-05-16 05:40:38', 'style-0003');

--
-- Triggers `reviews`
--
DELIMITER $$
CREATE TRIGGER `generate_timestamp_and_update_style_id` BEFORE INSERT ON `reviews` FOR EACH ROW BEGIN


    -- Declare variable to store the fetched style_id
    DECLARE v_style_id VARCHAR(10);

    -- Fetch the corresponding style_id based on the inserted style_box_id
    SELECT style_id INTO v_style_id
    FROM style_box
    WHERE style_box_id = NEW.style_box_id;

    -- Update the style_id column in the inserted row with the fetched style_id
    SET NEW.style_id = v_style_id;
    
        -- Set the timestamp
    SET NEW.timestamp = NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `security_questions`
--

CREATE TABLE `security_questions` (
  `question_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `security_questions`
--

INSERT INTO `security_questions` (`question_id`, `question`) VALUES
(1, 'What is your mother\'s maiden name?'),
(2, 'What is the name of your first pet?'),
(3, 'In which city were you born?'),
(4, 'What is the name of your favorite teacher?'),
(5, 'What is your favorite movie?'),
(6, 'What is your favorite food?'),
(7, 'What is the model of your first car?'),
(8, 'What is the name of your favorite book?'),
(9, 'What is the name of your childhood best friend?'),
(10, 'What is the brand of your first cellphone?');

-- --------------------------------------------------------

--
-- Table structure for table `sequence`
--

CREATE TABLE `sequence` (
  `sequence_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sequence`
--

INSERT INTO `sequence` (`sequence_id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(15),
(16),
(17),
(19),
(20),
(21),
(22),
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30),
(31),
(32),
(33),
(34),
(35),
(36),
(37),
(38),
(39),
(40),
(41),
(42),
(43),
(44),
(47),
(48),
(49),
(50),
(51),
(54),
(55),
(56),
(57),
(58),
(59),
(60),
(61),
(62),
(63),
(64),
(65),
(66),
(67),
(68),
(69),
(70),
(71),
(72),
(73),
(74),
(75),
(76),
(77),
(78),
(79),
(80),
(81),
(82),
(83),
(84),
(85),
(86),
(87),
(88),
(89),
(90),
(91),
(92),
(93),
(94),
(95),
(96),
(97),
(98),
(99),
(100),
(101),
(102),
(103),
(104),
(105),
(106),
(107),
(108),
(109),
(110),
(111),
(112),
(113),
(114),
(115),
(116),
(117),
(118),
(119),
(120),
(121),
(122),
(123),
(124),
(125),
(126),
(127),
(128),
(129),
(130),
(131),
(132),
(133),
(134),
(135),
(136),
(137),
(138),
(139),
(140),
(141),
(142),
(143),
(144),
(145),
(146),
(147),
(148),
(149),
(150),
(151),
(152),
(153),
(154),
(155),
(156),
(157),
(158),
(159),
(160),
(161),
(162),
(163),
(164),
(165),
(166),
(169),
(170),
(171),
(172),
(173),
(174),
(175),
(176),
(177),
(178),
(179),
(180),
(186),
(187),
(188),
(189),
(190),
(191),
(192),
(193),
(194),
(195),
(196),
(197),
(198),
(199),
(200),
(201),
(202),
(203),
(204),
(205),
(206),
(207),
(212),
(213),
(214),
(215),
(216),
(217),
(218),
(219),
(220),
(221),
(222),
(223),
(224),
(225),
(226),
(227),
(228),
(229),
(230),
(231),
(232),
(233),
(234),
(235),
(236),
(237),
(238),
(239),
(240),
(241),
(242),
(243),
(244),
(245),
(246),
(247),
(248),
(249),
(250),
(251),
(252),
(253),
(254),
(255),
(256),
(257),
(258),
(259),
(260),
(261),
(262),
(263),
(264),
(265),
(266),
(267),
(268),
(269),
(270),
(271),
(272),
(273),
(274),
(275),
(276),
(277),
(278),
(279),
(280),
(281),
(282),
(283),
(284),
(285),
(286),
(287),
(288),
(289),
(290),
(291),
(292),
(293),
(294),
(295),
(296),
(297),
(298),
(299),
(300),
(301),
(302),
(303),
(304),
(305),
(306),
(307),
(308),
(309),
(310),
(311),
(312),
(313),
(314),
(315),
(316),
(317),
(318),
(319),
(320),
(321),
(322),
(323),
(324),
(325),
(326),
(327),
(328),
(329),
(330),
(331),
(332),
(333),
(334),
(335),
(336),
(337),
(338),
(339),
(340),
(341),
(342),
(343),
(344),
(345),
(346),
(347),
(348),
(349),
(350),
(351),
(352),
(353),
(354),
(355),
(356),
(357),
(358),
(359),
(360),
(361),
(362),
(363),
(364),
(365),
(366),
(367),
(368),
(369),
(370),
(371),
(373),
(374),
(375),
(376),
(377),
(378),
(379),
(380),
(381),
(382),
(383),
(384),
(385);

-- --------------------------------------------------------

--
-- Table structure for table `style`
--

CREATE TABLE `style` (
  `style_id` varchar(10) NOT NULL,
  `style` varchar(50) DEFAULT NULL,
  `style_description` text DEFAULT NULL,
  `style_img_url` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `style`
--

INSERT INTO `style` (`style_id`, `style`, `style_description`, `style_img_url`) VALUES
('style-0001', 'Cottagecore', 'Embrace countryside charm with floral prints and rustic details.', 'cottagecore.jpg'),
('style-0002', 'Coquette', 'Channel elegance and femininity with lace and delicate fabrics.', 'coquette.jpg'),
('style-0003', 'Gothic Lolita', ' Explore dark whimsy with Victorian-inspired dresses.', 'gothic_lolita.jpg'),
('style-0004', 'Streetwear', 'Make a statement with bold graphics and urban designs.', 'streetwear.jpg'),
('style-0005', 'Y2K', 'Relive early 2000s nostalgia with shimmering metallic accents and playful, retro styles.', 'dress.jpg'),
('style-0006', 'Dark Academia', 'Dive into scholarly elegance with tweed and vintage pieces.', 'dress.jpg'),
('style-0007', 'Old Money', 'Elevate your look with timeless sophistication and classic silhouettes.', 'dress.jpg'),
('style-0008', 'Alt', 'Express your individuality with edgy punk and grunge influences.', 'dress.jpg'),
('style-0009', 'Indie', 'Embrace bohemian vibes with eclectic prints and laid-back styles.', 'dress.jpg'),
('style-0010', 'Star Girl', 'Reach for the stars with celestial prints and dreamy designs.', 'dress.jpg'),
('style-0068', 'Mystery', 'Random box for every occasion. Each surprise item is like reaching for the stars! ', 'mystery_box_logo2.png');

--
-- Triggers `style`
--
DELIMITER $$
CREATE TRIGGER `generate_style_id` BEFORE INSERT ON `style` FOR EACH ROW BEGIN
    DECLARE next_id INT;
    DECLARE new_style_id VARCHAR(10);
    
    -- Get the next sequence value
    INSERT INTO sequence VALUES (NULL);
    SET next_id = LAST_INSERT_ID();
    
    -- Generate the alphanumeric ID
    SET new_style_id = CONCAT('style-', LPAD(next_id, 4, '0'));
    
    -- Set the new item_id value
    SET NEW.style_id = new_style_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `style_box`
--

CREATE TABLE `style_box` (
  `style_box_id` varchar(10) NOT NULL,
  `style_id` varchar(10) DEFAULT NULL,
  `style_box_description` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT 229.00,
  `reviews` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `style_box`
--

INSERT INTO `style_box` (`style_box_id`, `style_id`, `style_box_description`, `price`, `reviews`) VALUES
('box-000019', 'style-0001', 'Embrace the charm of countryside living with Cottagecore fashion. Floral prints, flowing dresses, and rustic details create a whimsical and nostalgic look inspired by nature and traditional craftsmanship.', 229.00, NULL),
('box-000020', 'style-0002', 'Channel elegance and femininity with Coquette fashion. Lace, bows, and delicate fabrics evoke a romantic and playful aesthetic, perfect for those who embrace their flirtatious side.', 229.00, NULL),
('box-000021', 'style-0003', 'Explore the darker side of kawaii with Gothic Lolita fashion. Victorian-inspired dresses and doll-like accessories create a striking and elegant look that\'s both gothic and cute.', 229.00, NULL),
('box-000022', 'style-0004', 'Make a statement with Streetwear fashion. Bold graphics, casual silhouettes, and urban-inspired designs reflect the energy and creativity of city life, perfect for those who love to stand out.', 229.00, NULL),
('box-000023', 'style-0005', 'Embrace nostalgia with Y2K fashion. Low-rise jeans, metallic accents, and futuristic designs capture the spirit of the early 2000s, offering a playful and eclectic style for the modern era.', 229.00, NULL),
('box-000024', 'style-0006', 'Dive into the world of academia with Dark Academia fashion. Tweed blazers, turtleneck sweaters, and vintage-inspired pieces create a moody and scholarly look that\'s both intellectual and stylish.', 229.00, NULL),
('box-000025', 'style-0007', 'Elevate your wardrobe with Old Money fashion. Tailored suits, classic accessories, and timeless silhouettes exude elegance and sophistication, perfect for those with a taste for luxury.', 229.00, NULL),
('box-000026', 'style-0008', 'Express your individuality with Alt fashion. Punk, goth, and grunge influences combine for a non-conformist style that\'s bold, edgy, and unapologetically unique.', 229.00, NULL),
('box-000027', 'style-0009', 'Embrace bohemian vibes with Indie fashion. Vintage finds, eclectic prints, and handmade accessories create a laid-back and carefree look that\'s effortlessly cool.', 229.00, NULL),
('box-000028', 'style-0010', 'Reach for the stars with Star Girl fashion. Celestial prints, metallic accents, and futuristic designs capture the magic of the cosmos, offering a dreamy and ethereal style for stargazers and dreamers alike.', 229.00, NULL),
('box-000073', 'style-0068', 'Random box for mystery stuffs', 229.00, 'Nice box, got good items out of it.');

--
-- Triggers `style_box`
--
DELIMITER $$
CREATE TRIGGER `generate_style_box_id` BEFORE INSERT ON `style_box` FOR EACH ROW BEGIN
    DECLARE next_id INT;
    DECLARE new_style_box_id VARCHAR(10);
    
    -- Get the next sequence value
    INSERT INTO sequence VALUES (NULL);
    SET next_id = LAST_INSERT_ID();
    
    -- Generate the alphanumeric ID
    SET new_style_box_id = CONCAT('box-', LPAD(next_id, 6, '0'));
    
    -- Set the new item_id value
    SET NEW.style_box_id = new_style_box_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `style_box_details`
-- (See below for the actual view)
--
CREATE TABLE `style_box_details` (
`style_id` varchar(10)
,`style_box_id` varchar(10)
,`style` varchar(50)
,`style_description` text
,`style_box_description` varchar(255)
,`price` decimal(10,2)
,`style_img_url` varchar(50)
,`reviews` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `style_box_transaction`
--

CREATE TABLE `style_box_transaction` (
  `style_box_id` varchar(10) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `order_number` varchar(20) DEFAULT NULL,
  `style_box_quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `style_box_transaction`
--

INSERT INTO `style_box_transaction` (`style_box_id`, `transaction_id`, `order_number`, `style_box_quantity`) VALUES
('box-000019', 0, 'ORD-20240512-0000191', 1),
('box-000019', 61, 'ORD-20240512-0000194', 3),
('box-000019', 73, 'ORD-20240513-0000215', 1),
('box-000019', 74, 'ORD-20240513-0000222', 1),
('box-000019', 77, 'ORD-20240513-0000225', 1),
('box-000019', 84, 'ORD-20240513-0000232', 1),
('box-000019', 93, 'ORD-20240513-0000241', 3),
('box-000019', 102, 'ORD-20240513-0000250', 1),
('box-000019', 104, 'ORD-20240513-0000252', 3),
('box-000019', 105, 'ORD-20240513-0000253', 1),
('box-000019', 118, 'ORD-20240513-0000268', 1),
('box-000019', 149, 'ORD-20240514-0000299', NULL),
('box-000019', 150, 'ORD-20240514-0000300', NULL),
('box-000019', 151, 'ORD-20240514-0000301', NULL),
('box-000019', 156, 'ORD-20240514-0000306', 1),
('box-000019', 162, 'ORD-20240514-0000312', 1),
('box-000019', 165, 'ORD-20240514-0000315', 1),
('box-000019', 168, 'ORD-20240514-0000318', 1),
('box-000019', 171, 'ORD-20240514-0000321', 1),
('box-000019', 173, 'ORD-20240514-0000323', 1),
('box-000019', 177, 'ORD-20240514-0000327', 1),
('box-000019', 178, 'ORD-20240516-0000341', 1),
('box-000019', 179, 'ORD-20240516-0000342', 1),
('box-000019', 186, 'ORD-20240516-0000349', 1),
('box-000019', 188, 'ORD-20240516-0000351', 1),
('box-000019', 189, 'ORD-20240516-0000352', 1),
('box-000019', 190, 'ORD-20240516-0000353', 1),
('box-000019', 194, 'ORD-20240516-0000357', 1),
('box-000019', 205, 'ORD-20240516-0000369', 1),
('box-000019', 211, 'ORD-20240516-0000382', 2),
('box-000020', 161, 'ORD-20240514-0000311', 1),
('box-000020', 167, 'ORD-20240514-0000317', 1),
('box-000020', 174, 'ORD-20240514-0000324', 1),
('box-000020', 188, 'ORD-20240516-0000351', 1),
('box-000020', 189, 'ORD-20240516-0000352', 1),
('box-000020', 190, 'ORD-20240516-0000353', 1),
('box-000020', 193, 'ORD-20240516-0000356', 1),
('box-000020', 198, 'ORD-20240516-0000361', 1),
('box-000020', 210, 'ORD-20240516-0000381', 1),
('box-000021', 60, 'ORD-20240512-0000193', 1),
('box-000021', 152, 'ORD-20240514-0000302', 1),
('box-000021', 153, 'ORD-20240514-0000303', 1),
('box-000021', 154, 'ORD-20240514-0000304', 1),
('box-000021', 157, 'ORD-20240514-0000307', 1),
('box-000021', 158, 'ORD-20240514-0000308', 1),
('box-000021', 159, 'ORD-20240514-0000309', 1),
('box-000021', 160, 'ORD-20240514-0000310', 1),
('box-000021', 163, 'ORD-20240514-0000313', 1),
('box-000021', 164, 'ORD-20240514-0000314', 1),
('box-000021', 169, 'ORD-20240514-0000319', 1),
('box-000021', 170, 'ORD-20240514-0000320', 1),
('box-000021', 175, 'ORD-20240514-0000325', 1),
('box-000021', 176, 'ORD-20240514-0000326', 1),
('box-000021', 179, 'ORD-20240516-0000342', 1),
('box-000021', 187, 'ORD-20240516-0000350', 1),
('box-000021', 190, 'ORD-20240516-0000353', 1),
('box-000021', 192, 'ORD-20240516-0000355', 1),
('box-000021', 195, 'ORD-20240516-0000358', 1),
('box-000021', 196, 'ORD-20240516-0000359', 1),
('box-000021', 208, 'ORD-20240516-0000379', 1),
('box-000021', 212, 'ORD-20240516-0000385', 1),
('box-000023', 197, 'ORD-20240516-0000360', 1),
('box-000024', 209, 'ORD-20240516-0000380', 1),
('box-000073', 0, 'ORD-20240512-0000192', 3),
('box-000073', 3, 'ORD-20240511-0000084', 2),
('box-000073', 17, NULL, 1),
('box-000073', 30, 'ORD-20240511-0000138', 1),
('box-000073', 66, NULL, 1),
('box-000073', 68, NULL, 3),
('box-000073', 70, 'ORD-20240512-0000203', 1),
('box-000073', 76, 'ORD-20240513-0000224', 1),
('box-000073', 78, 'ORD-20240513-0000226', 1),
('box-000073', 83, 'ORD-20240513-0000231', 1),
('box-000073', 88, 'ORD-20240513-0000236', 1),
('box-000073', 119, 'ORD-20240513-0000269', 3),
('box-000073', 211, 'ORD-20240516-0000382', 1);

--
-- Triggers `style_box_transaction`
--
DELIMITER $$
CREATE TRIGGER `set_order_number` BEFORE INSERT ON `style_box_transaction` FOR EACH ROW BEGIN
    DECLARE order_number_val VARCHAR(20);
    
    -- Get the order_number corresponding to the inserted transaction_id
    SELECT order_number INTO order_number_val
    FROM `transaction`
    WHERE transaction_id = NEW.transaction_id;
    
    -- Set the order_number column in style_box_transaction
    SET NEW.order_number = order_number_val;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `sub_id` int(11) NOT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `plan_id` varchar(10) DEFAULT NULL,
  `sub_start_date` date DEFAULT NULL,
  `sub_end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`sub_id`, `user_id`, `plan_id`, `sub_start_date`, `sub_end_date`) VALUES
(1, 'user-00330', 'plan-00030', NULL, NULL),
(2, 'user-00330', NULL, NULL, NULL),
(3, 'user-00330', NULL, NULL, NULL),
(4, 'user-00330', NULL, NULL, NULL),
(5, 'user-00330', NULL, NULL, NULL),
(6, 'user-00330', 'plan-00038', NULL, NULL),
(7, 'user-00375', 'plan-00030', NULL, NULL),
(9, 'user-00375', 'plan-00038', '2024-05-16', NULL);

--
-- Triggers `subscription`
--
DELIMITER $$
CREATE TRIGGER `set_subscription_dates` BEFORE INSERT ON `subscription` FOR EACH ROW BEGIN
   
        -- Set sub_start_date to now
        SET NEW.sub_start_date = NOW();

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plan`
--

CREATE TABLE `subscription_plan` (
  `plan_id` varchar(10) NOT NULL,
  `plan_tier` enum('Starter Pack','Fashionista Bundle','Wardrobe Refresh') DEFAULT NULL,
  `plan_duration` varchar(20) DEFAULT NULL,
  `plan_tier_description` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `monthly_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscription_plan`
--

INSERT INTO `subscription_plan` (`plan_id`, `plan_tier`, `plan_duration`, `plan_tier_description`, `price`, `monthly_price`) VALUES
('plan-00029', 'Starter Pack', '1 Month', 'Receive 2 curated tops and 1 curated bottom per month.', 249.00, 249.00),
('plan-00030', 'Starter Pack', '3 Months', 'Receive 2 curated tops and 1 curated bottom per month.', 699.00, 216.33),
('plan-00031', 'Starter Pack', '6 Months', 'Receive 2 curated tops and 1 curated bottom per month.', 1299.00, 199.83),
('plan-00032', 'Starter Pack', '12 Months', 'Receive 2 curated tops and 1 curated bottom per month.', NULL, NULL),
('plan-00033', 'Fashionista Bundle', '1 Month', 'Unlock 3 curated tops and 2 curated bottoms per month.', 349.00, 349.00),
('plan-00034', 'Fashionista Bundle', '3 Months', 'Unlock 3 curated tops and 2 curated bottoms per month.', 949.00, 316.33),
('plan-00035', 'Fashionista Bundle', '6 Months', 'Unlock 3 curated tops and 2 curated bottoms per month.', 1699.00, 283.17),
('plan-00036', 'Fashionista Bundle', '12 Months', 'Unlock 3 curated tops and 2 curated bottoms per month.', NULL, NULL),
('plan-00037', 'Wardrobe Refresh', '1 Month', 'Enjoy a generous selection of 4 curated tops and 3 curated bottoms per month.', 449.00, 449.00),
('plan-00038', 'Wardrobe Refresh', '3 Months', 'Enjoy a generous selection of 4 curated tops and 3 curated bottoms per month.', 1199.00, 383.00),
('plan-00039', 'Wardrobe Refresh', '6 Months', 'Enjoy a generous selection of 4 curated tops and 3 curated bottoms per month.', 2199.00, 366.50),
('plan-00040', 'Wardrobe Refresh', '12 Months', 'Enjoy a generous selection of 4 curated tops and 3 curated bottoms per month.', NULL, NULL);

--
-- Triggers `subscription_plan`
--
DELIMITER $$
CREATE TRIGGER `generate_plan_id` BEFORE INSERT ON `subscription_plan` FOR EACH ROW BEGIN
    DECLARE next_id INT;
    DECLARE new_plan_id VARCHAR(10);
    
    -- Get the next sequence value
    INSERT INTO sequence VALUES (NULL);
    SET next_id = LAST_INSERT_ID();
    
    -- Generate the alphanumeric ID
    SET new_plan_id = CONCAT('plan-', LPAD(next_id, 5, '0'));
    
    -- Set the new item_id value
    SET NEW.plan_id = new_plan_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `order_number` varchar(20) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `shipping_fee` decimal(10,2) DEFAULT 100.00,
  `total_items` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `payment_method` enum('Cash on Delivery','GCash') DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `status` varchar(45) DEFAULT 'Processing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `order_number`, `timestamp`, `user_id`, `shipping_fee`, `total_items`, `total_price`, `payment_method`, `delivery_date`, `status`) VALUES
(1, 'ORD-20240511-0000080', '2024-05-11 11:41:38', 'user-00049', 100.00, 3, 1703.00, NULL, NULL, NULL),
(2, 'ORD-20240511-0000082', '2024-05-11 11:41:38', 'user-00049', 100.00, 3, 1703.00, NULL, NULL, NULL),
(3, 'ORD-20240511-0000084', '2024-05-11 11:41:38', 'user-00049', 100.00, 3, 1703.00, NULL, NULL, NULL),
(4, 'ORD-20240511-0000086', '2024-05-11 11:41:38', 'user-00049', 100.00, 3, 1703.00, NULL, NULL, NULL),
(5, 'ORD-20240511-0000088', '2024-05-11 11:43:32', 'user-00049', 100.00, 0, 100.00, 'Cash on Delivery', NULL, NULL),
(6, 'ORD-20240511-0000090', '2024-05-11 11:50:07', 'user-00049', 100.00, 1, 329.00, 'Cash on Delivery', NULL, NULL),
(7, 'ORD-20240511-0000092', '2024-05-11 11:50:07', 'user-00049', 100.00, 1, 329.00, 'Cash on Delivery', NULL, NULL),
(8, 'ORD-20240511-0000094', '2024-05-11 11:54:24', 'user-00049', 100.00, 1, 329.00, NULL, NULL, NULL),
(9, 'ORD-20240511-0000096', '2024-05-11 11:54:24', 'user-00049', 100.00, 1, 329.00, NULL, NULL, NULL),
(10, 'ORD-20240511-0000098', '2024-05-11 11:55:12', 'user-00049', 100.00, 1, 329.00, NULL, NULL, NULL),
(11, 'ORD-20240511-0000100', '2024-05-11 11:55:12', 'user-00049', 100.00, 1, 329.00, NULL, NULL, NULL),
(12, 'ORD-20240511-0000102', '2024-05-11 11:57:40', 'user-00049', 100.00, 1, 329.00, NULL, NULL, NULL),
(13, 'ORD-20240511-0000104', '2024-05-11 11:57:40', 'user-00049', 100.00, 1, 329.00, NULL, NULL, NULL),
(14, 'ORD-20240511-0000106', '2024-05-11 12:00:54', 'user-00049', 100.00, 1, 329.00, 'GCash', NULL, NULL),
(15, 'ORD-20240511-0000108', '2024-05-11 12:00:54', 'user-00049', 100.00, 1, 329.00, 'GCash', NULL, NULL),
(16, 'ORD-20240511-0000110', '2024-05-11 12:01:41', 'user-00049', 100.00, 1, 329.00, 'Cash on Delivery', NULL, NULL),
(17, 'ORD-20240511-0000112', '2024-05-11 12:01:41', 'user-00049', 100.00, 1, 329.00, 'Cash on Delivery', NULL, NULL),
(18, 'ORD-20240511-0000114', '2024-05-11 12:04:50', 'user-00049', 100.00, 1, 329.00, 'Cash on Delivery', NULL, NULL),
(19, 'ORD-20240511-0000116', '2024-05-11 12:08:07', 'user-00049', 100.00, 1, 329.00, 'Cash on Delivery', NULL, NULL),
(20, 'ORD-20240511-0000118', '2024-05-11 12:08:07', 'user-00049', 100.00, 1, 329.00, 'Cash on Delivery', NULL, NULL),
(21, 'ORD-20240511-0000120', '2024-05-11 12:08:07', 'user-00049', 100.00, 1, 329.00, 'Cash on Delivery', NULL, NULL),
(22, 'ORD-20240511-0000122', '2024-05-11 12:09:26', 'user-00049', 100.00, 1, 329.00, 'GCash', NULL, NULL),
(23, 'ORD-20240511-0000124', '2024-05-11 12:09:26', 'user-00049', 100.00, 1, 329.00, 'GCash', NULL, NULL),
(24, 'ORD-20240511-0000126', '2024-05-11 12:23:06', 'user-00049', 100.00, 1, 329.00, 'GCash', NULL, NULL),
(25, 'ORD-20240511-0000128', '2024-05-11 12:23:06', 'user-00049', 100.00, 1, 329.00, 'GCash', NULL, NULL),
(26, 'ORD-20240511-0000130', '2024-05-11 12:24:38', 'user-00049', 100.00, 1, 329.00, NULL, NULL, NULL),
(27, 'ORD-20240511-0000132', '2024-05-11 12:24:38', 'user-00049', 100.00, 1, 329.00, NULL, NULL, NULL),
(28, 'ORD-20240511-0000134', '2024-05-11 12:25:53', 'user-00049', 100.00, 1, 329.00, NULL, NULL, NULL),
(29, 'ORD-20240511-0000136', '2024-05-11 12:25:53', 'user-00049', 100.00, 1, 329.00, NULL, NULL, NULL),
(30, 'ORD-20240511-0000138', '2024-05-11 12:26:42', 'user-00049', 100.00, 1, 329.00, NULL, NULL, NULL),
(31, 'ORD-20240511-0000140', '2024-05-11 12:26:42', 'user-00049', 100.00, 1, 329.00, NULL, NULL, NULL),
(32, 'ORD-20240511-0000142', '2024-05-11 12:27:39', 'user-00049', 100.00, 3, 787.00, 'GCash', NULL, NULL),
(33, 'ORD-20240511-0000144', '2024-05-11 12:27:39', 'user-00049', 100.00, 3, 787.00, 'GCash', NULL, NULL),
(34, 'ORD-20240511-0000146', '2024-05-11 12:28:50', 'user-00049', 100.00, 2, 558.00, 'Cash on Delivery', NULL, NULL),
(35, 'ORD-20240511-0000148', '2024-05-11 12:31:00', 'user-00049', 100.00, 1, 329.00, 'GCash', NULL, NULL),
(36, 'ORD-20240511-0000150', '2024-05-11 12:45:35', 'user-00049', 100.00, 2, 558.00, 'Cash on Delivery', NULL, NULL),
(37, 'ORD-20240511-0000152', '2024-05-11 12:47:01', 'user-00049', 100.00, 3, 787.00, 'GCash', NULL, NULL),
(38, 'ORD-20240511-0000154', '2024-05-11 12:49:32', 'user-00049', 100.00, 1, 329.00, 'GCash', NULL, NULL),
(39, 'ORD-20240511-0000156', '2024-05-11 12:52:39', 'user-00049', 100.00, 1, 329.00, 'Cash on Delivery', NULL, NULL),
(40, 'ORD-20240511-0000158', '2024-05-11 12:53:43', 'user-00049', 100.00, 1, 329.00, NULL, NULL, NULL),
(41, 'ORD-20240511-0000160', '2024-05-11 12:58:26', 'user-00049', 100.00, 1, 329.00, NULL, NULL, NULL),
(42, 'ORD-20240511-0000162', '2024-05-11 12:58:26', 'user-00049', 100.00, 1, 329.00, NULL, NULL, NULL),
(43, 'ORD-20240511-0000164', '2024-05-11 14:51:49', 'user-00049', 100.00, 1, 329.00, 'Cash on Delivery', NULL, NULL),
(44, 'ORD-20240511-0000166', '2024-05-11 14:53:51', 'user-00049', 100.00, 2, 558.00, 'GCash', NULL, NULL),
(47, 'ORD-20240511-0000170', '2024-05-11 15:50:55', 'user-00049', 100.00, 1, 229.00, 'GCash', NULL, NULL),
(48, 'ORD-20240511-0000172', '2024-05-11 15:51:58', 'user-00049', 100.00, 2, 558.00, 'Cash on Delivery', NULL, NULL),
(49, 'ORD-20240511-0000174', '2024-05-11 15:53:32', 'user-00049', 100.00, 1, 329.00, 'Cash on Delivery', NULL, NULL),
(50, 'ORD-20240512-0000176', '2024-05-11 16:05:32', 'user-00049', 100.00, 1, 329.00, 'GCash', NULL, NULL),
(51, 'ORD-20240512-0000178', '2024-05-11 16:06:16', 'user-00049', 100.00, 6, 2161.00, 'Cash on Delivery', NULL, NULL),
(52, 'ORD-20240512-0000180', '2024-05-11 16:07:29', 'user-00049', 100.00, 3, 787.00, 'Cash on Delivery', NULL, NULL),
(53, 'ORD-20240512-0000186', NULL, 'user-00049', 100.00, 3, 1245.00, 'GCash', NULL, NULL),
(54, 'ORD-20240512-0000187', NULL, 'user-00049', 100.00, 0, 100.00, 'GCash', NULL, NULL),
(55, 'ORD-20240512-0000188', NULL, 'user-00049', 100.00, 2, 558.00, 'Cash on Delivery', NULL, NULL),
(56, 'ORD-20240512-0000189', NULL, 'user-00049', 100.00, 3, 787.00, 'GCash', NULL, NULL),
(57, 'ORD-20240512-0000190', NULL, 'user-00049', 100.00, 1, 329.00, 'GCash', NULL, NULL),
(58, 'ORD-20240512-0000191', NULL, 'user-00049', 100.00, 1, 329.00, 'GCash', NULL, NULL),
(59, 'ORD-20240512-0000192', NULL, 'user-00049', 100.00, 3, 787.00, 'GCash', NULL, NULL),
(60, 'ORD-20240512-0000193', NULL, 'user-00049', 100.00, 1, 329.00, 'Cash on Delivery', NULL, NULL),
(61, 'ORD-20240512-0000194', NULL, 'user-00049', 100.00, 3, 787.00, 'Cash on Delivery', NULL, NULL),
(62, 'ORD-20240512-0000195', NULL, 'user-00049', 100.00, 1, 329.00, 'Cash on Delivery', NULL, NULL),
(63, 'ORD-20240512-0000196', '2024-05-11 17:00:55', 'user-00049', 100.00, 1, 329.00, 'Cash on Delivery', NULL, NULL),
(64, 'ORD-20240512-0000197', '2024-05-11 18:12:04', 'user-00049', 100.00, 1, 329.00, 'Cash on Delivery', NULL, NULL),
(65, 'ORD-20240512-0000198', '2024-05-11 18:12:28', 'user-00049', 100.00, 1, 329.00, 'Cash on Delivery', NULL, NULL),
(66, 'ORD-20240512-0000199', '2024-05-11 18:18:58', 'user-00049', 100.00, 1, 329.00, NULL, NULL, NULL),
(67, 'ORD-20240512-0000200', '2024-05-11 18:23:48', 'user-00049', 100.00, 3, 787.00, 'Cash on Delivery', NULL, NULL),
(68, 'ORD-20240512-0000201', '2024-05-11 18:24:01', 'user-00049', 100.00, 3, 787.00, 'Cash on Delivery', NULL, NULL),
(69, 'ORD-20240512-0000202', '2024-05-11 18:52:13', 'user-00049', 100.00, 1, 329.00, NULL, NULL, NULL),
(70, 'ORD-20240512-0000203', '2024-05-11 18:53:29', 'user-00049', 100.00, 2, 897.00, 'Cash on Delivery', NULL, NULL),
(71, 'ORD-20240513-0000213', '2024-05-12 17:55:48', 'user-00049', 100.00, 1, 329.00, 'Cash on Delivery', NULL, NULL),
(72, 'ORD-20240513-0000214', '2024-05-12 17:55:48', 'user-00049', 100.00, 1, 329.00, 'Cash on Delivery', NULL, NULL),
(73, 'ORD-20240513-0000215', '2024-05-12 17:56:36', 'user-00049', 100.00, 1, 329.00, 'Cash on Delivery', NULL, NULL),
(74, 'ORD-20240513-0000222', '2024-05-12 19:21:47', 'user-00049', 100.00, 2, 787.00, 'Cash on Delivery', NULL, NULL),
(75, 'ORD-20240513-0000223', '2024-05-12 19:21:47', 'user-00049', 100.00, 2, 787.00, 'Cash on Delivery', NULL, NULL),
(76, 'ORD-20240513-0000224', '2024-05-12 19:24:36', 'user-00049', 100.00, 1, 329.00, 'Cash on Delivery', '0000-00-00', NULL),
(77, 'ORD-20240513-0000225', '2024-05-12 19:25:13', 'user-00049', 100.00, 1, 329.00, 'GCash', '0000-00-00', NULL),
(78, 'ORD-20240513-0000226', '2024-05-12 19:34:47', 'user-00049', 100.00, 1, 329.00, 'Cash on Delivery', '0000-00-00', NULL),
(79, 'ORD-20240513-0000227', '2024-05-12 19:42:56', 'user-00049', 100.00, 1, 329.00, 'Cash on Delivery', '2024-05-20', NULL),
(80, 'ORD-20240513-0000228', '2024-05-12 19:55:37', 'user-00049', 100.00, 1, 329.00, 'Cash on Delivery', '2024-05-20', NULL),
(81, 'ORD-20240513-0000229', '2024-05-12 19:56:33', 'user-00049', 100.00, 1, 329.00, 'GCash', '2024-05-20', 'Pending'),
(82, 'ORD-20240513-0000230', '2024-05-12 19:57:22', 'user-00049', 100.00, 1, 329.00, 'GCash', '2024-05-20', 'Pending'),
(83, 'ORD-20240513-0000231', '2024-05-12 19:57:51', 'user-00049', 100.00, 1, 329.00, 'GCash', '2024-05-20', 'Pending'),
(84, 'ORD-20240513-0000232', '2024-05-12 20:07:38', 'user-00049', 100.00, 1, 329.00, 'Cash on Delivery', '2024-05-20', NULL),
(85, 'ORD-20240513-0000233', '2024-05-12 20:27:56', 'user-00049', 100.00, 0, 100.00, NULL, '2024-05-20', NULL),
(86, 'ORD-20240513-0000234', '2024-05-12 20:34:16', 'user-00049', 100.00, 0, 100.00, 'Cash on Delivery', '2024-05-20', NULL),
(87, 'ORD-20240513-0000235', '2024-05-12 20:37:40', 'user-00049', 100.00, 0, 100.00, 'Cash on Delivery', '2024-05-20', NULL),
(88, 'ORD-20240513-0000236', '2024-05-12 20:57:40', 'user-00049', 100.00, 2, 897.00, 'Cash on Delivery', '2024-05-20', NULL),
(89, 'ORD-20240513-0000237', '2024-05-12 21:01:34', 'user-00049', 100.00, 0, 100.00, 'GCash', '2024-05-20', NULL),
(90, 'ORD-20240513-0000238', '2024-05-12 21:02:49', 'user-00049', 100.00, 0, 100.00, 'GCash', '2024-05-20', NULL),
(91, 'ORD-20240513-0000239', '2024-05-12 21:05:17', 'user-00049', 100.00, 1, 100.00, 'Cash on Delivery', '2024-05-20', NULL),
(92, 'ORD-20240513-0000240', '2024-05-12 21:05:58', 'user-00049', 100.00, 1, 100.00, NULL, '2024-05-20', NULL),
(93, 'ORD-20240513-0000241', '2024-05-12 21:07:07', 'user-00049', 100.00, 4, 1703.00, 'Cash on Delivery', '2024-05-20', NULL),
(94, 'ORD-20240513-0000242', '2024-05-12 21:08:09', 'user-00049', 100.00, 1, 100.00, 'Cash on Delivery', '2024-05-20', NULL),
(95, 'ORD-20240513-0000243', '2024-05-12 21:10:14', 'user-00049', 100.00, 1, 100.00, 'Cash on Delivery', '2024-05-20', NULL),
(96, 'ORD-20240513-0000244', '2024-05-12 21:11:30', 'user-00049', 100.00, 1, 100.00, 'Cash on Delivery', '2024-05-20', NULL),
(97, 'ORD-20240513-0000245', '2024-05-12 21:16:30', 'user-00049', 100.00, 1, 100.00, 'GCash', '2024-05-20', NULL),
(98, 'ORD-20240513-0000246', '2024-05-12 21:16:42', 'user-00049', 100.00, 1, 100.00, 'GCash', '2024-05-20', NULL),
(99, 'ORD-20240513-0000247', '2024-05-12 21:18:18', 'user-00049', 100.00, 1, 100.00, 'GCash', '2024-05-20', NULL),
(100, 'ORD-20240513-0000248', '2024-05-12 21:19:40', 'user-00049', 100.00, 1, 439.00, 'GCash', '2024-05-20', NULL),
(101, 'ORD-20240513-0000249', '2024-05-12 21:19:58', 'user-00049', 100.00, 1, 100.00, 'GCash', '2024-05-20', NULL),
(102, 'ORD-20240513-0000250', '2024-05-12 21:21:01', 'user-00049', 100.00, 1, 329.00, NULL, '2024-05-20', NULL),
(103, 'ORD-20240513-0000251', '2024-05-12 21:21:15', 'user-00049', 100.00, 1, 100.00, 'GCash', '2024-05-20', NULL),
(104, 'ORD-20240513-0000252', '2024-05-12 21:25:28', 'user-00049', 100.00, 3, 787.00, 'GCash', '2024-05-20', NULL),
(105, 'ORD-20240513-0000253', '2024-05-12 21:28:25', 'user-00049', 100.00, 1, 329.00, 'GCash', '2024-05-20', NULL),
(106, 'ORD-20240513-0000254', '2024-05-12 21:29:24', 'user-00049', 100.00, 1, 100.00, 'GCash', '2024-05-20', NULL),
(107, 'ORD-20240513-0000255', '2024-05-12 21:33:54', 'user-00049', 100.00, 1, 100.00, 'Cash on Delivery', '2024-05-20', NULL),
(108, 'ORD-20240513-0000256', '2024-05-12 21:34:54', 'user-00049', 100.00, 1, 100.00, 'Cash on Delivery', '2024-05-20', NULL),
(109, 'ORD-20240513-0000257', '2024-05-12 21:40:49', 'user-00049', 100.00, 1, 100.00, 'Cash on Delivery', '2024-05-20', NULL),
(110, 'ORD-20240513-0000258', '2024-05-12 21:42:28', 'user-00049', 100.00, 1, 100.00, 'GCash', '2024-05-20', NULL),
(111, 'ORD-20240513-0000259', '2024-05-12 21:45:23', 'user-00049', 100.00, 1, 100.00, 'Cash on Delivery', '2024-05-20', NULL),
(112, 'ORD-20240513-0000260', '2024-05-12 21:55:00', 'user-00049', 100.00, 1, 100.00, 'Cash on Delivery', '2024-05-20', NULL),
(113, 'ORD-20240513-0000263', '2024-05-13 14:09:30', 'user-00049', 100.00, 1, 179.00, 'Cash on Delivery', '2024-05-20', NULL),
(114, 'ORD-20240513-0000264', '2024-05-13 14:09:30', 'user-00049', 100.00, 1, 179.00, 'Cash on Delivery', '2024-05-20', NULL),
(115, 'ORD-20240513-0000265', '2024-05-13 14:17:02', 'user-00049', 100.00, 1, 179.00, 'Cash on Delivery', '2024-05-20', NULL),
(116, 'ORD-20240513-0000266', '2024-05-13 14:17:02', 'user-00049', 100.00, 1, 179.00, 'Cash on Delivery', '2024-05-20', NULL),
(117, 'ORD-20240513-0000267', '2024-05-13 14:17:56', 'user-00049', 100.00, 1, 179.00, 'GCash', '2024-05-20', NULL),
(118, 'ORD-20240513-0000268', '2024-05-13 14:18:14', 'user-00049', 100.00, 1, 329.00, 'Cash on Delivery', '2024-05-20', NULL),
(119, 'ORD-20240513-0000269', '2024-05-13 14:18:28', 'user-00049', 100.00, 3, 787.00, 'GCash', '2024-05-20', NULL),
(120, 'ORD-20240513-0000270', '2024-05-13 14:18:56', 'user-00049', 100.00, 1, 100.00, 'GCash', '2024-05-20', NULL),
(121, 'ORD-20240513-0000271', '2024-05-13 14:20:51', 'user-00049', 100.00, 1, 100.00, 'Cash on Delivery', '2024-05-20', NULL),
(122, 'ORD-20240513-0000272', '2024-05-13 14:22:34', 'user-00049', 100.00, 1, 100.00, 'Cash on Delivery', '2024-05-20', NULL),
(123, 'ORD-20240513-0000273', '2024-05-13 14:22:50', 'user-00049', 100.00, 1, 100.00, 'Cash on Delivery', '2024-05-20', NULL),
(124, 'ORD-20240513-0000274', '2024-05-13 14:22:56', 'user-00049', 100.00, 1, 100.00, NULL, '2024-05-20', NULL),
(125, 'ORD-20240513-0000275', '2024-05-13 14:24:11', 'user-00049', 100.00, 1, 100.00, NULL, '2024-05-20', NULL),
(126, 'ORD-20240513-0000276', '2024-05-13 14:24:45', 'user-00049', 100.00, 1, 100.00, NULL, '2024-05-20', NULL),
(127, 'ORD-20240513-0000277', '2024-05-13 14:36:11', 'user-00049', 100.00, 1, 100.00, NULL, '2024-05-20', NULL),
(128, 'ORD-20240513-0000278', '2024-05-13 14:37:18', 'user-00049', 100.00, 1, 100.00, NULL, '2024-05-20', NULL),
(129, 'ORD-20240513-0000279', '2024-05-13 14:37:28', 'user-00049', 100.00, 1, 100.00, 'GCash', '2024-05-20', NULL),
(130, 'ORD-20240513-0000280', '2024-05-13 14:46:54', 'user-00049', 100.00, 1, 100.00, NULL, '2024-05-20', NULL),
(131, 'ORD-20240513-0000281', '2024-05-13 14:47:20', 'user-00049', 100.00, 1, 100.00, 'Cash on Delivery', '2024-05-20', NULL),
(132, 'ORD-20240513-0000282', '2024-05-13 14:47:48', 'user-00049', 100.00, 1, 100.00, 'GCash', '2024-05-20', NULL),
(133, 'ORD-20240513-0000283', '2024-05-13 14:49:20', 'user-00049', 100.00, 1, 100.00, 'Cash on Delivery', '2024-05-20', NULL),
(134, 'ORD-20240513-0000284', '2024-05-13 14:51:49', 'user-00049', 100.00, 1, 100.00, 'GCash', '2024-05-20', NULL),
(135, 'ORD-20240513-0000285', '2024-05-13 14:52:02', 'user-00049', 100.00, 1, 100.00, 'GCash', '2024-05-20', NULL),
(136, 'ORD-20240513-0000286', '2024-05-13 14:52:21', 'user-00049', 100.00, 1, 100.00, 'Cash on Delivery', '2024-05-20', NULL),
(137, 'ORD-20240513-0000287', '2024-05-13 14:53:50', 'user-00049', 100.00, 1, 100.00, 'GCash', '2024-05-20', NULL),
(138, 'ORD-20240513-0000288', '2024-05-13 14:59:42', 'user-00049', 100.00, 1, 100.00, 'Cash on Delivery', '2024-05-20', NULL),
(139, 'ORD-20240513-0000289', '2024-05-13 15:04:21', 'user-00049', 100.00, 1, 100.00, 'Cash on Delivery', '2024-05-20', NULL),
(140, 'ORD-20240513-0000290', '2024-05-13 15:06:31', 'user-00049', 100.00, 0, 100.00, 'Cash on Delivery', '2024-05-20', NULL),
(141, 'ORD-20240513-0000291', '2024-05-13 15:09:07', 'user-00049', 100.00, 1, 100.00, 'GCash', '2024-05-20', NULL),
(142, 'ORD-20240513-0000292', '2024-05-13 15:10:57', 'user-00049', 100.00, 1, 100.00, 'Cash on Delivery', '2024-05-20', NULL),
(143, 'ORD-20240514-0000293', '2024-05-13 18:53:31', 'user-00049', 100.00, 1, 100.00, 'Cash on Delivery', '2024-05-21', NULL),
(144, 'ORD-20240514-0000294', '2024-05-13 18:56:00', 'user-00049', 100.00, 0, 100.00, 'Cash on Delivery', '2024-05-21', NULL),
(145, 'ORD-20240514-0000295', '2024-05-13 18:58:56', 'user-00049', 100.00, 0, 100.00, 'Cash on Delivery', '2024-05-21', NULL),
(146, 'ORD-20240514-0000296', '2024-05-13 18:59:29', 'user-00049', 100.00, 0, 100.00, 'Cash on Delivery', '2024-05-21', NULL),
(147, 'ORD-20240514-0000297', '2024-05-13 19:01:39', 'user-00049', 100.00, 0, 100.00, 'GCash', '2024-05-21', NULL),
(148, 'ORD-20240514-0000298', '2024-05-13 19:02:02', 'user-00049', 100.00, 0, 100.00, 'Cash on Delivery', '2024-05-21', NULL),
(149, 'ORD-20240514-0000299', '2024-05-13 19:08:04', 'user-00049', 100.00, 0, 329.00, 'Cash on Delivery', '2024-05-21', NULL),
(150, 'ORD-20240514-0000300', '2024-05-13 19:11:14', 'user-00049', 100.00, 0, 329.00, NULL, '2024-05-21', NULL),
(151, 'ORD-20240514-0000301', '2024-05-13 19:12:26', 'user-00049', 100.00, 0, 329.00, NULL, '2024-05-21', NULL),
(152, 'ORD-20240514-0000302', '2024-05-13 19:14:44', 'user-00049', 100.00, 0, 329.00, NULL, '2024-05-21', NULL),
(153, 'ORD-20240514-0000303', '2024-05-13 19:14:51', 'user-00049', 100.00, 0, 329.00, NULL, '2024-05-21', NULL),
(154, 'ORD-20240514-0000304', '2024-05-13 19:16:14', 'user-00049', 100.00, 0, 329.00, 'Cash on Delivery', '2024-05-21', NULL),
(155, 'ORD-20240514-0000305', '2024-05-13 19:17:05', 'user-00049', 100.00, 0, 329.00, 'GCash', '2024-05-21', NULL),
(156, 'ORD-20240514-0000306', '2024-05-13 19:30:01', 'user-00049', 100.00, 0, 329.00, 'GCash', '2024-05-21', NULL),
(157, 'ORD-20240514-0000307', '2024-05-13 19:30:19', 'user-00049', 100.00, 0, 329.00, 'Cash on Delivery', '2024-05-21', NULL),
(158, 'ORD-20240514-0000308', '2024-05-13 19:30:42', 'user-00049', 100.00, 0, 329.00, NULL, '2024-05-21', NULL),
(159, 'ORD-20240514-0000309', '2024-05-13 19:32:57', 'user-00049', 100.00, 0, 329.00, 'Cash on Delivery', '2024-05-21', NULL),
(160, 'ORD-20240514-0000310', '2024-05-13 19:35:07', 'user-00049', 100.00, 0, 329.00, 'Cash on Delivery', '2024-05-21', NULL),
(161, 'ORD-20240514-0000311', '2024-05-13 19:35:12', 'user-00049', 100.00, 0, 329.00, 'GCash', '2024-05-21', NULL),
(162, 'ORD-20240514-0000312', '2024-05-13 19:35:41', 'user-00049', 100.00, 0, 329.00, 'Cash on Delivery', '2024-05-21', NULL),
(163, 'ORD-20240514-0000313', '2024-05-13 19:35:49', 'user-00049', 100.00, 0, 329.00, 'Cash on Delivery', '2024-05-21', NULL),
(164, 'ORD-20240514-0000314', '2024-05-13 19:36:18', 'user-00049', 100.00, 0, 329.00, 'Cash on Delivery', '2024-05-21', NULL),
(165, 'ORD-20240514-0000315', '2024-05-13 19:36:25', 'user-00049', 100.00, 0, 329.00, 'GCash', '2024-05-21', NULL),
(166, 'ORD-20240514-0000316', '2024-05-13 19:56:03', 'user-00049', 100.00, 0, 439.00, 'Cash on Delivery', '2024-05-21', NULL),
(167, 'ORD-20240514-0000317', '2024-05-13 20:07:14', 'user-00049', 100.00, 0, 329.00, 'Cash on Delivery', '2024-05-21', NULL),
(168, 'ORD-20240514-0000318', '2024-05-13 20:08:23', 'user-00049', 100.00, 0, 329.00, 'GCash', '2024-05-21', NULL),
(169, 'ORD-20240514-0000319', '2024-05-13 20:10:39', 'user-00049', 100.00, 0, 329.00, 'GCash', '2024-05-21', NULL),
(170, 'ORD-20240514-0000320', '2024-05-13 20:11:07', 'user-00049', 100.00, 0, 329.00, 'Cash on Delivery', '2024-05-21', NULL),
(171, 'ORD-20240514-0000321', '2024-05-13 20:16:02', 'user-00049', 100.00, 1, 329.00, 'GCash', '2024-05-21', NULL),
(172, 'ORD-20240514-0000322', '2024-05-13 20:22:19', 'user-00049', 100.00, 1, 179.00, 'Cash on Delivery', '2024-05-21', NULL),
(173, 'ORD-20240514-0000323', '2024-05-13 20:22:35', 'user-00049', 100.00, 1, 329.00, 'Cash on Delivery', '2024-05-21', NULL),
(174, 'ORD-20240514-0000324', '2024-05-13 20:25:41', 'user-00049', 100.00, 1, 329.00, 'GCash', '2024-05-21', NULL),
(175, 'ORD-20240514-0000325', '2024-05-13 20:25:51', 'user-00049', 100.00, 1, 329.00, 'GCash', '2024-05-21', NULL),
(176, 'ORD-20240514-0000326', '2024-05-13 20:26:10', 'user-00049', 100.00, 1, 329.00, NULL, '2024-05-21', NULL),
(177, 'ORD-20240514-0000327', '2024-05-13 21:13:06', 'user-00049', 100.00, 1, 329.00, 'Cash on Delivery', '2024-05-21', NULL),
(178, 'ORD-20240516-0000341', '2024-05-15 18:03:15', 'user-00330', 100.00, 1, 329.00, 'Cash on Delivery', '2024-05-23', NULL),
(179, 'ORD-20240516-0000342', '2024-05-15 20:08:30', 'user-00330', 100.00, 3, 1703.00, 'Cash on Delivery', '2024-05-23', NULL),
(180, 'ORD-20240516-0000343', '2024-05-15 20:12:56', 'user-00330', 100.00, 3, 1703.00, 'GCash', '2024-05-23', NULL),
(181, 'ORD-20240516-0000344', '2024-05-15 20:13:44', 'user-00330', 100.00, 3, 1703.00, 'GCash', '2024-05-23', NULL),
(182, 'ORD-20240516-0000345', '2024-05-15 20:15:32', 'user-00330', 100.00, 3, 1703.00, 'GCash', '2024-05-23', NULL),
(183, 'ORD-20240516-0000346', '2024-05-15 20:15:37', 'user-00330', 100.00, 3, 1703.00, 'GCash', '2024-05-23', NULL),
(184, 'ORD-20240516-0000347', '2024-05-15 20:15:59', 'user-00330', 100.00, 3, 1703.00, 'Cash on Delivery', '2024-05-23', NULL),
(185, 'ORD-20240516-0000348', '2024-05-15 20:17:09', 'user-00330', 100.00, 1, 439.00, 'Cash on Delivery', '2024-05-23', NULL),
(186, 'ORD-20240516-0000349', '2024-05-15 20:17:44', 'user-00330', 100.00, 1, 329.00, 'Cash on Delivery', '2024-05-23', NULL),
(187, 'ORD-20240516-0000350', '2024-05-15 20:17:55', 'user-00330', 100.00, 1, 329.00, 'Cash on Delivery', '2024-05-23', NULL),
(188, 'ORD-20240516-0000351', '2024-05-15 20:18:17', 'user-00330', 100.00, 2, 787.00, 'Cash on Delivery', '2024-05-23', NULL),
(189, 'ORD-20240516-0000352', '2024-05-15 20:18:40', 'user-00330', 100.00, 2, 787.00, 'Cash on Delivery', '2024-05-23', NULL),
(190, 'ORD-20240516-0000353', '2024-05-15 20:23:06', 'user-00330', 100.00, 3, 1703.00, 'Cash on Delivery', '2024-05-23', NULL),
(191, 'ORD-20240516-0000354', '2024-05-15 20:32:17', 'user-00330', 100.00, 1, 179.00, 'GCash', '2024-05-23', NULL),
(192, 'ORD-20240516-0000355', '2024-05-15 20:34:39', 'user-00330', 100.00, 1, 329.00, 'GCash', '2024-05-23', NULL),
(193, 'ORD-20240516-0000356', '2024-05-15 20:35:20', 'user-00330', 100.00, 1, 329.00, 'Cash on Delivery', '2024-05-23', NULL),
(194, 'ORD-20240516-0000357', '2024-05-15 20:49:42', 'user-00330', 100.00, 1, 329.00, 'GCash', '2024-05-23', 'Processing'),
(195, 'ORD-20240516-0000358', '2024-05-15 23:09:00', 'user-00330', 100.00, 1, 329.00, 'Cash on Delivery', '2024-05-23', 'Processing'),
(196, 'ORD-20240516-0000359', '2024-05-15 23:12:07', 'user-00330', 100.00, 1, 329.00, 'Cash on Delivery', '2024-05-23', 'Processing'),
(197, 'ORD-20240516-0000360', '2024-05-15 23:19:58', 'user-00330', 100.00, 1, 329.00, 'Cash on Delivery', '2024-05-23', 'Processing'),
(198, 'ORD-20240516-0000361', '2024-05-15 23:20:15', 'user-00330', 100.00, 1, 329.00, 'Cash on Delivery', '2024-05-23', 'Processing'),
(199, 'ORD-20240516-0000363', '2024-05-16 00:52:39', 'user-00330', 100.00, NULL, NULL, NULL, '2024-05-23', 'Processing'),
(200, 'ORD-20240516-0000364', '2024-05-16 00:52:39', 'user-00330', 100.00, NULL, NULL, NULL, '2024-05-23', 'Processing'),
(201, 'ORD-20240516-0000365', '2024-05-16 00:52:47', 'user-00330', 100.00, NULL, NULL, NULL, '2024-05-23', 'Processing'),
(202, 'ORD-20240516-0000366', '2024-05-16 00:52:47', 'user-00330', 100.00, NULL, NULL, NULL, '2024-05-23', 'Processing'),
(203, 'ORD-20240516-0000367', '2024-05-16 00:59:46', 'user-00330', 100.00, NULL, NULL, NULL, '2024-05-23', 'Processing'),
(204, 'ORD-20240516-0000368', '2024-05-16 00:59:46', 'user-00330', 100.00, NULL, NULL, NULL, '2024-05-23', 'Processing'),
(205, 'ORD-20240516-0000369', '2024-05-16 01:09:01', 'user-00330', 100.00, 1, 329.00, 'Cash on Delivery', '2024-05-23', 'Processing'),
(206, 'ORD-20240516-0000370', '2024-05-16 01:11:52', 'user-00330', 100.00, NULL, 329.00, NULL, '2024-05-23', 'Processing'),
(207, 'ORD-20240516-0000371', '2024-05-16 01:11:52', 'user-00330', 100.00, NULL, 329.00, NULL, '2024-05-23', 'Processing'),
(208, 'ORD-20240516-0000379', '2024-05-16 05:34:31', 'user-00330', 100.00, 1, 329.00, 'Cash on Delivery', '2024-05-23', 'Processing'),
(209, 'ORD-20240516-0000380', '2024-05-16 05:35:28', 'user-00330', 100.00, 1, 329.00, 'Cash on Delivery', '2024-05-23', 'Processing'),
(210, 'ORD-20240516-0000381', '2024-05-16 05:36:02', 'user-00330', 100.00, 1, 329.00, 'Cash on Delivery', '2024-05-23', 'Processing'),
(211, 'ORD-20240516-0000382', '2024-05-16 05:36:34', 'user-00330', 100.00, 3, 1245.00, 'GCash', '2024-05-23', 'Processing'),
(212, 'ORD-20240516-0000385', '2024-05-16 05:40:25', 'user-00330', 100.00, 1, 329.00, 'GCash', '2024-05-23', 'Processing');

--
-- Triggers `transaction`
--
DELIMITER $$
CREATE TRIGGER `generate_order_number_and_delivery_date` BEFORE INSERT ON `transaction` FOR EACH ROW BEGIN
    DECLARE next_id INT;
    DECLARE new_order_number VARCHAR(20);
    
    -- Get the next sequence value
    INSERT INTO sequence VALUES (NULL);
    SET next_id = LAST_INSERT_ID();
    
    -- Generate the alphanumeric ID
    SET new_order_number = CONCAT('ORD-', DATE_FORMAT(NOW(), '%Y%m%d'), '-', LPAD(next_id, 7, '0'));
    
    -- Set the new order_number value
    SET NEW.order_number = new_order_number;
    
    -- Set the delivery_date 7 days after the transaction_date
    SET NEW.delivery_date = DATE_ADD(NOW(), INTERVAL 7 DAY);
    
    -- Set the timestamp
    SET NEW.timestamp = NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `registration_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `first_name`, `last_name`, `phone_number`, `address`, `registration_date`) VALUES
('tran-00041', 'dee', 'danielamarzan.cantillo@bicol-u.edu.ph', '25d55ad283aa400af464c76d713c07ad', 'Daniela', 'Cantillo', '09483340088', 'Zone 8 Labnig, Malinao, Albay', '2024-05-08 02:06:18'),
('tran-00043', 'yes102', 'jessai@live.nl', 'e807f1fcf82d132f9bb018ca6738a19f', 'Jessai', 'Schonewille', '09483340088', 'BS Rollepaal, Dedemsvaart, Netherlands', '2024-05-08 02:06:18'),
('user-00047', 'daniela', 'danielait@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Dee', 'Cantillo', '09483340088', 'Daraga, Albay', '2024-05-08 02:08:53'),
('user-00049', 'MInzy', 'minzy19@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Minzy', 'Mendez', '09135902471', 'Zone 4 Bantayan, Tabaco City, Albay', '2024-05-08 02:59:40'),
('user-00330', 'Doe', 'dee@outlook.com', '9a900403ac313ba27a1bc81f0932652b8020dac92c234d98fa0b06bf0040ecfd', 'Douglas', 'Levi', '09468381717', 'asda, asdasd, asdas, asdasd', '2024-05-14 14:56:39'),
('user-00375', 'Minnie', 'deedasdasd@outlook.com', '9a900403ac313ba27a1bc81f0932652b8020dac92c234d98fa0b06bf0040ecfd', 'Douglas', 'Levi', '09468381717', 'Sagpon, Daraga, Albay', '2024-05-16 10:27:42');

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `generate_user_id` BEFORE INSERT ON `user` FOR EACH ROW BEGIN
    DECLARE next_id INT;
    DECLARE new_user_id VARCHAR(10);
    
    -- Get the next sequence value
    INSERT INTO sequence VALUES (NULL);
    SET next_id = LAST_INSERT_ID();
    
    -- Generate the alphanumeric ID
    SET new_user_id = CONCAT('user-', LPAD(next_id, 5, '0'));
    
    -- Set the new item_id value
    SET NEW.user_id = new_user_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `user_AFTER_INSERT` AFTER INSERT ON `user` FOR EACH ROW BEGIN
	INSERT INTO user_logs (user_id, timestamp, action)
    VALUES (NEW.user_id, NOW(), 'signup');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `log_id` varchar(10) NOT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `action` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`log_id`, `user_id`, `timestamp`, `action`) VALUES
('tran-00042', 'tran-00041', '2024-05-07 18:06:18', 'signup'),
('tran-00044', 'tran-00043', '2024-05-07 18:06:18', 'signup'),
('tran-00048', 'user-00047', '2024-05-07 18:08:53', 'signup'),
('tran-00050', 'user-00049', '2024-05-07 18:59:40', 'signup'),
('tran-00051', NULL, '2024-05-07 19:02:09', 'logout'),
('tran-00054', 'user-00049', '2024-05-07 19:05:03', 'logout'),
('tran-00055', 'user-00049', '2024-05-07 19:06:09', 'login'),
('tran-00056', 'user-00049', '2024-05-07 19:06:11', 'logout'),
('tran-00057', 'user-00049', '2024-05-07 19:09:36', 'login'),
('tran-00058', 'user-00049', '2024-05-07 19:38:41', 'logout'),
('tran-00059', 'user-00049', '2024-05-07 19:40:59', 'login'),
('tran-00060', 'user-00049', '2024-05-07 19:46:08', 'logout'),
('tran-00061', 'user-00049', '2024-05-07 19:50:40', 'login'),
('tran-00062', 'user-00049', '2024-05-07 19:50:42', 'logout'),
('tran-00063', 'user-00049', '2024-05-07 19:52:44', 'login'),
('tran-00064', 'user-00049', '2024-05-07 20:28:45', 'logout'),
('tran-00065', 'user-00049', '2024-05-08 12:27:35', 'login'),
('tran-00066', 'user-00049', '2024-05-08 20:49:10', 'login'),
('tran-00067', 'user-00049', '2024-05-09 16:33:38', 'login'),
('tran-00069', 'user-00049', '2024-05-10 23:41:50', 'login'),
('tran-00072', 'user-00049', '2024-05-11 07:40:44', 'login'),
('tran-00074', 'user-00049', '2024-05-11 08:05:55', 'login'),
('tran-00075', 'user-00049', '2024-05-11 08:10:42', 'logout'),
('tran-00076', 'user-00049', '2024-05-11 08:10:49', 'login'),
('tran-00077', 'user-00049', '2024-05-11 10:01:31', 'logout'),
('tran-00078', 'user-00049', '2024-05-11 10:01:41', 'login'),
('tran-00204', 'user-00049', '2024-05-11 18:59:29', 'logout'),
('tran-00205', 'user-00049', '2024-05-12 06:03:25', 'login'),
('tran-00206', 'user-00049', '2024-05-12 06:03:32', 'logout'),
('tran-00207', 'user-00049', '2024-05-12 06:06:01', 'login'),
('tran-00216', 'user-00049', '2024-05-12 18:13:15', 'logout'),
('tran-00217', 'user-00049', '2024-05-12 18:13:23', 'login'),
('tran-00218', 'user-00049', '2024-05-12 18:19:07', 'logout'),
('tran-00219', 'user-00049', '2024-05-12 18:19:31', 'login'),
('tran-00220', 'user-00049', '2024-05-12 18:24:35', 'logout'),
('tran-00221', 'user-00049', '2024-05-12 18:37:49', 'login'),
('tran-00261', 'user-00049', '2024-05-12 22:10:26', 'logout'),
('tran-00262', 'user-00049', '2024-05-13 13:38:57', 'login'),
('tran-00328', 'user-00049', '2024-05-14 06:55:34', 'login'),
('tran-00329', 'user-00049', '2024-05-14 06:55:40', 'logout'),
('tran-00331', 'user-00330', '2024-05-14 06:56:39', 'signup'),
('tran-00332', NULL, '2024-05-14 06:57:11', 'logout'),
('tran-00333', 'user-00330', '2024-05-14 06:57:22', 'login'),
('tran-00334', 'user-00330', '2024-05-14 07:06:34', 'logout'),
('tran-00335', 'user-00330', '2024-05-14 07:06:41', 'login'),
('tran-00336', 'user-00330', '2024-05-14 11:24:22', 'login'),
('tran-00338', 'user-00330', '2024-05-15 12:39:58', 'login'),
('tran-00339', 'user-00330', '2024-05-15 18:02:44', 'logout'),
('tran-00340', 'user-00330', '2024-05-15 18:03:09', 'login'),
('tran-00362', 'user-00330', '2024-05-16 00:26:29', 'login'),
('tran-00373', 'user-00330', '2024-05-16 02:10:38', 'login'),
('tran-00374', 'user-00330', '2024-05-16 02:26:58', 'logout'),
('tran-00376', 'user-00375', '2024-05-16 02:27:42', 'signup'),
('tran-00377', 'user-00375', '2024-05-16 02:28:57', 'logout'),
('tran-00378', 'user-00330', '2024-05-16 03:25:34', 'login'),
('tran-00383', 'user-00330', '2024-05-16 05:39:50', 'logout'),
('tran-00384', 'user-00330', '2024-05-16 05:39:56', 'login');

--
-- Triggers `user_logs`
--
DELIMITER $$
CREATE TRIGGER `generate_log_id` BEFORE INSERT ON `user_logs` FOR EACH ROW BEGIN
    DECLARE next_id INT;
    DECLARE new_log_id VARCHAR(10);
    
    -- Get the next sequence value
    INSERT INTO sequence VALUES (NULL);
    SET next_id = LAST_INSERT_ID();
    
    -- Generate the alphanumeric ID
    SET new_log_id = CONCAT('tran-', LPAD(next_id, 5, '0'));
    
    -- Set the new item_id value
    SET NEW.log_id = new_log_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_preference`
--

CREATE TABLE `user_preference` (
  `user_preference_id` varchar(10) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `height` int(11) DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `bust_size` varchar(10) DEFAULT NULL,
  `hip_size` varchar(10) DEFAULT NULL,
  `shoe_size` varchar(5) DEFAULT NULL,
  `clothing_size` enum('XS','S','M','L','XL','XXL') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_preference`
--

INSERT INTO `user_preference` (`user_preference_id`, `user_id`, `height`, `weight`, `bust_size`, `hip_size`, `shoe_size`, `clothing_size`) VALUES
('pref-00212', 'user-00049', 233, 90.00, '23', '42', '18', 'XXL'),
('pref-00337', 'user-00330', 180, 52.00, '56', '30', '40', 'S');

--
-- Triggers `user_preference`
--
DELIMITER $$
CREATE TRIGGER `generate_user_preference_id` BEFORE INSERT ON `user_preference` FOR EACH ROW BEGIN
    DECLARE next_id INT;
    DECLARE new_user_preference_id VARCHAR(10);
    
    -- Get the next sequence value
    INSERT INTO sequence VALUES (NULL);
    SET next_id = LAST_INSERT_ID();
    
    -- Generate the alphanumeric ID
    SET new_user_preference_id = CONCAT('pref-', LPAD(next_id, 5, '0'));
    
    -- Set the new item_id value
    SET NEW.user_preference_id = new_user_preference_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_security_questions`
--

CREATE TABLE `user_security_questions` (
  `user_question_id` int(11) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_security_questions`
--

INSERT INTO `user_security_questions` (`user_question_id`, `user_id`, `question_id`, `answer`) VALUES
(1, 'user-00330', 1, 'Bembo');

-- --------------------------------------------------------

--
-- Structure for view `style_box_details`
--
DROP TABLE IF EXISTS `style_box_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `style_box_details`  AS SELECT `s`.`style_id` AS `style_id`, `sb`.`style_box_id` AS `style_box_id`, `s`.`style` AS `style`, `s`.`style_description` AS `style_description`, `sb`.`style_box_description` AS `style_box_description`, `sb`.`price` AS `price`, `s`.`style_img_url` AS `style_img_url`, `sb`.`reviews` AS `reviews` FROM (`style` `s` join `style_box` `sb` on(`s`.`style_id` = `sb`.`style_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `style_id` (`style_id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `style` (`style`),
  ADD KEY `item_ibfk_3_idx` (`order_number`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_product_item` (`item_id`),
  ADD KEY `fk_order_product_style_box` (`style_box_id`),
  ADD KEY `fk_order_product_transaction` (`transaction_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `fk_reviews_user_id` (`user_id`),
  ADD KEY `fk_reviews_item_id` (`item_id`),
  ADD KEY `fk_reviews_style_box_id` (`style_box_id`),
  ADD KEY `fk_reviews_style_id` (`style_id`);

--
-- Indexes for table `security_questions`
--
ALTER TABLE `security_questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `sequence`
--
ALTER TABLE `sequence`
  ADD PRIMARY KEY (`sequence_id`);

--
-- Indexes for table `style`
--
ALTER TABLE `style`
  ADD PRIMARY KEY (`style_id`),
  ADD UNIQUE KEY `style_UNIQUE` (`style`);

--
-- Indexes for table `style_box`
--
ALTER TABLE `style_box`
  ADD PRIMARY KEY (`style_box_id`),
  ADD KEY `style_id` (`style_id`);

--
-- Indexes for table `style_box_transaction`
--
ALTER TABLE `style_box_transaction`
  ADD PRIMARY KEY (`style_box_id`,`transaction_id`),
  ADD KEY `style_box_transaction_ibfk_2_idx` (`transaction_id`),
  ADD KEY `style_box_transaction_ibfk_2_idx1` (`order_number`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `plan_id` (`plan_id`);

--
-- Indexes for table `subscription_plan`
--
ALTER TABLE `subscription_plan`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD UNIQUE KEY `order_number_UNIQUE` (`order_number`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_preference`
--
ALTER TABLE `user_preference`
  ADD PRIMARY KEY (`user_preference_id`),
  ADD KEY `user_preference_ibfk_1` (`user_id`);

--
-- Indexes for table `user_security_questions`
--
ALTER TABLE `user_security_questions`
  ADD PRIMARY KEY (`user_question_id`),
  ADD UNIQUE KEY `user_question_unique` (`user_id`,`question_id`),
  ADD KEY `fk_question_id` (`question_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `security_questions`
--
ALTER TABLE `security_questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sequence`
--
ALTER TABLE `sequence`
  MODIFY `sequence_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=386;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `user_security_questions`
--
ALTER TABLE `user_security_questions`
  MODIFY `user_question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`style_id`) REFERENCES `style` (`style_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`style`) REFERENCES `style` (`style`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `item_ibfk_3` FOREIGN KEY (`order_number`) REFERENCES `transaction` (`order_number`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `fk_order_product_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_order_product_style_box` FOREIGN KEY (`style_box_id`) REFERENCES `style_box` (`style_box_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_order_product_transaction` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_reviews_item_id` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`),
  ADD CONSTRAINT `fk_reviews_style` FOREIGN KEY (`style_id`) REFERENCES `style` (`style_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reviews_style_box_id` FOREIGN KEY (`style_box_id`) REFERENCES `style_box` (`style_box_id`),
  ADD CONSTRAINT `fk_reviews_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `style_box`
--
ALTER TABLE `style_box`
  ADD CONSTRAINT `style_box_ibfk_1` FOREIGN KEY (`style_id`) REFERENCES `style` (`style_id`);

--
-- Constraints for table `style_box_transaction`
--
ALTER TABLE `style_box_transaction`
  ADD CONSTRAINT `style_box_transaction_ibfk_1` FOREIGN KEY (`style_box_id`) REFERENCES `style_box` (`style_box_id`),
  ADD CONSTRAINT `style_box_transaction_ibfk_2` FOREIGN KEY (`order_number`) REFERENCES `transaction` (`order_number`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `subscription`
--
ALTER TABLE `subscription`
  ADD CONSTRAINT `subscription_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `subscription_ibfk_2` FOREIGN KEY (`plan_id`) REFERENCES `subscription_plan` (`plan_id`);

--
-- Constraints for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD CONSTRAINT `user_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `user_preference`
--
ALTER TABLE `user_preference`
  ADD CONSTRAINT `user_preference_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_security_questions`
--
ALTER TABLE `user_security_questions`
  ADD CONSTRAINT `fk_question_id` FOREIGN KEY (`question_id`) REFERENCES `security_questions` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
