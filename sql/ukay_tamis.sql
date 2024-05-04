-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2024 at 12:42 PM
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
  `item_id` int(11) NOT NULL,
  `style_id` int(11) DEFAULT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `item_description` varchar(255) DEFAULT NULL,
  `size` enum('XS','S','M','L','XL','XXL') DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `item_img_url` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `style_id`, `item_name`, `item_description`, `size`, `color`, `price`, `transaction_id`, `item_img_url`) VALUES
(1, 1, 'Vintage Floral Blouse', 'Featuring delicate flower patterns and a classic silhouette, this blouse is perfect for adding a touch of nostalgia to your wardrobe. ', 'XS', 'Brown', 399.00, NULL, 'dress.jpg'),
(2, 1, 'Chunky Knit Sweater', ' Stay cozy and stylish in this chunky knit sweater. Made from soft and warm yarn, this sweater features a relaxed fit and a timeless cable knit design', 'L', 'Green', 599.00, NULL, 'dress.jpg'),
(3, 7, 'Faux Leather Crossbody Bag', 'Add a touch of sophistication to any outfit with this faux leather crossbody bag. ', NULL, 'Black', 229.00, NULL, 'dress.jpg'),
(4, 5, 'Tiger Print Shades', 'Featuring a timeless lace-up design and a durable rubber sole, these sneakers are perfect for everyday wear. ', NULL, 'Multicolor', 149.00, NULL, 'dress.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `style`
--

CREATE TABLE `style` (
  `style_id` int(11) NOT NULL,
  `style` varchar(50) DEFAULT NULL,
  `style_description` varchar(255) DEFAULT NULL,
  `style_img_url` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `style`
--

INSERT INTO `style` (`style_id`, `style`, `style_description`, `style_img_url`) VALUES
(1, 'Cottagecore', 'Embrace countryside charm with floral prints and rustic details.', 'cottagecore.jpg'),
(2, 'Coquette', 'Channel elegance and femininity with lace and delicate fabrics.', 'coquette.jpg'),
(3, 'Gothic Lolita', ' Explore dark whimsy with Victorian-inspired dresses.', 'gothic_lolita.jpg'),
(4, 'Streetwear', 'Make a statement with bold graphics and urban designs.', 'streetwear.jpg'),
(5, 'Y2K', 'Relive early 2000s nostalgia with shimmering metallic accents and playful, retro styles.', NULL),
(6, 'Dark Academia', 'Dive into scholarly elegance with tweed and vintage pieces.', NULL),
(7, 'Old Money', 'Elevate your look with timeless sophistication and classic silhouettes.', NULL),
(8, 'Alt', 'Express your individuality with edgy punk and grunge influences.', NULL),
(9, 'Indie', 'Embrace bohemian vibes with eclectic prints and laid-back styles.', NULL),
(10, 'Star Girl', 'Reach for the stars with celestial prints and dreamy designs.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `style_box`
--

CREATE TABLE `style_box` (
  `style_box_id` int(11) NOT NULL,
  `style_id` int(11) DEFAULT NULL,
  `style_box_description` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT 229.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `style_box`
--

INSERT INTO `style_box` (`style_box_id`, `style_id`, `style_box_description`, `price`) VALUES
(1, 1, 'Embrace the charm of countryside living with Cottagecore fashion. Floral prints, flowing dresses, and rustic details create a whimsical and nostalgic look inspired by nature and traditional craftsmanship.', 229.00),
(2, 2, 'Channel elegance and femininity with Coquette fashion. Lace, bows, and delicate fabrics evoke a romantic and playful aesthetic, perfect for those who embrace their flirtatious side.', 229.00),
(3, 3, 'Explore the darker side of kawaii with Gothic Lolita fashion. Victorian-inspired dresses and doll-like accessories create a striking and elegant look that\'s both gothic and cute.', 229.00),
(4, 4, 'Make a statement with Streetwear fashion. Bold graphics, casual silhouettes, and urban-inspired designs reflect the energy and creativity of city life, perfect for those who love to stand out.', 229.00),
(5, 5, 'Embrace nostalgia with Y2K fashion. Low-rise jeans, metallic accents, and futuristic designs capture the spirit of the early 2000s, offering a playful and eclectic style for the modern era.', 229.00),
(6, 6, 'Dive into the world of academia with Dark Academia fashion. Tweed blazers, turtleneck sweaters, and vintage-inspired pieces create a moody and scholarly look that\'s both intellectual and stylish.', 229.00),
(7, 7, 'Elevate your wardrobe with Old Money fashion. Tailored suits, classic accessories, and timeless silhouettes exude elegance and sophistication, perfect for those with a taste for luxury.', 229.00),
(8, 8, 'Express your individuality with Alt fashion. Punk, goth, and grunge influences combine for a non-conformist style that\'s bold, edgy, and unapologetically unique.', 229.00),
(9, 9, 'Embrace bohemian vibes with Indie fashion. Vintage finds, eclectic prints, and handmade accessories create a laid-back and carefree look that\'s effortlessly cool.', 229.00),
(10, 10, 'Reach for the stars with Star Girl fashion. Celestial prints, metallic accents, and futuristic designs capture the magic of the cosmos, offering a dreamy and ethereal style for stargazers and dreamers alike.', 229.00);

-- --------------------------------------------------------

--
-- Stand-in structure for view `style_box_details`
-- (See below for the actual view)
--
CREATE TABLE `style_box_details` (
`style_id` int(11)
,`style_box_id` int(11)
,`style` varchar(50)
,`style_description` varchar(255)
,`style_box_description` varchar(255)
,`price` decimal(10,2)
,`style_img_url` varchar(45)
);

-- --------------------------------------------------------

--
-- Table structure for table `style_box_transaction`
--

CREATE TABLE `style_box_transaction` (
  `style_box_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `sub_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `sub_start_date` date DEFAULT NULL,
  `sub_end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plan`
--

CREATE TABLE `subscription_plan` (
  `plan_id` int(11) NOT NULL,
  `plan_tier` enum('Starter Pack','Fashionista Bundle','Wardrobe Refresh') DEFAULT NULL,
  `plan_duration` enum('1 Month','3 Months','6 Months','12 Months') DEFAULT NULL,
  `plan_tier_description` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `monthly_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscription_plan`
--

INSERT INTO `subscription_plan` (`plan_id`, `plan_tier`, `plan_duration`, `plan_tier_description`, `price`, `monthly_price`) VALUES
(1, 'Starter Pack', '1 Month', 'Receive 2 curated tops and 1 curated bottom per month.', 249.00, 249.00),
(2, 'Starter Pack', '3 Months', 'Receive 2 curated tops and 1 curated bottom per month.', 699.00, 216.33),
(3, 'Starter Pack', '6 Months', 'Receive 2 curated tops and 1 curated bottom per month.', 1299.00, 199.83),
(4, 'Starter Pack', '12 Months', 'Receive 2 curated tops and 1 curated bottom per month.', NULL, NULL),
(5, 'Fashionista Bundle', '1 Month', 'Unlock 3 curated tops and 2 curated bottoms per month.', 349.00, 349.00),
(6, 'Fashionista Bundle', '3 Months', 'Unlock 3 curated tops and 2 curated bottoms per month.', 949.00, 316.33),
(7, 'Fashionista Bundle', '6 Months', 'Unlock 3 curated tops and 2 curated bottoms per month.', 1699.00, 283.17),
(8, 'Fashionista Bundle', '12 Months', 'Unlock 3 curated tops and 2 curated bottoms per month.', NULL, NULL),
(9, 'Wardrobe Refresh', '1 Month', 'Enjoy a generous selection of 4 curated tops and 3 curated bottoms per month.', 449.00, 449.00),
(10, 'Wardrobe Refresh', '3 Months', 'Enjoy a generous selection of 4 curated tops and 3 curated bottoms per month.', 1199.00, 383.00),
(11, 'Wardrobe Refresh', '6 Months', 'Enjoy a generous selection of 4 curated tops and 3 curated bottoms per month.', 2199.00, 366.50),
(12, 'Wardrobe Refresh', '12 Months', 'Enjoy a generous selection of 4 curated tops and 3 curated bottoms per month.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `shipping_fee` decimal(10,2) DEFAULT 100.00,
  `total_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_preference`
--

CREATE TABLE `user_preference` (
  `user_preference_id` varchar(45) NOT NULL,
  `user_id` int(11) NOT NULL,
  `height` decimal(5,2) DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `bust_size` varchar(10) DEFAULT NULL,
  `hip_size` varchar(10) DEFAULT NULL,
  `shoe_size` varchar(5) DEFAULT NULL,
  `clothing_size` enum('XS','S','M','L','XL','XXL') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure for view `style_box_details`
--
DROP TABLE IF EXISTS `style_box_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `style_box_details`  AS SELECT `s`.`style_id` AS `style_id`, `sb`.`style_box_id` AS `style_box_id`, `s`.`style` AS `style`, `s`.`style_description` AS `style_description`, `sb`.`style_box_description` AS `style_box_description`, `sb`.`price` AS `price`, `s`.`style_img_url` AS `style_img_url` FROM (`style` `s` join `style_box` `sb` on(`s`.`style_id` = `sb`.`style_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `style_id` (`style_id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `style`
--
ALTER TABLE `style`
  ADD PRIMARY KEY (`style_id`);

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
  ADD KEY `transaction_id` (`transaction_id`);

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
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_preference`
--
ALTER TABLE `user_preference`
  ADD PRIMARY KEY (`user_preference_id`),
  ADD KEY `user_preference_ibfk_1` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `style`
--
ALTER TABLE `style`
  MODIFY `style_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `style_box`
--
ALTER TABLE `style_box`
  MODIFY `style_box_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription_plan`
--
ALTER TABLE `subscription_plan`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`style_id`) REFERENCES `style` (`style_id`),
  ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`);

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
  ADD CONSTRAINT `style_box_transaction_ibfk_2` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`);

--
-- Constraints for table `subscription`
--
ALTER TABLE `subscription`
  ADD CONSTRAINT `subscription_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `subscription_ibfk_2` FOREIGN KEY (`plan_id`) REFERENCES `subscription_plan` (`plan_id`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `user_preference`
--
ALTER TABLE `user_preference`
  ADD CONSTRAINT `user_preference_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
