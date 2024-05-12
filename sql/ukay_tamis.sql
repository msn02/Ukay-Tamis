  -- phpMyAdmin SQL Dump
  -- version 5.2.1
  -- https://www.phpmyadmin.net/
  --
  -- Host: 127.0.0.1
  -- Generation Time: May 11, 2024 at 12:38 PM
  -- Server version: 10.4.32-MariaDB
  -- PHP Version: 8.2.12

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
    `size` enum('XS','S','M','L','XL','XXL') DEFAULT NULL,
    `color` varchar(50) DEFAULT NULL,
    `price` decimal(10,2) DEFAULT NULL,
    `transaction_id` varchar(10) DEFAULT NULL,
    `item_img_url` varchar(45) DEFAULT NULL,
    `style` varchar(50) DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  --
  -- Dumping data for table `item`
  --

  INSERT INTO `item` (`item_id`, `style_id`, `item_name`, `item_description`, `size`, `color`, `price`, `transaction_id`, `item_img_url`, `style`) VALUES
  ('item-00015', 'style-0001', 'Vintage Floral Blouse', 'Featuring delicate flower patterns and a classic silhouette, this blouse is perfect for adding a touch of nostalgia to your wardrobe.', 'XS', 'Brown', 229.00, NULL, 'dress.jpg', NULL),
  ('item-00016', 'style-0001', 'Chunky Knit Sweater', 'Stay cozy and stylish in this chunky knit sweater. Made from soft and warm yarn, this sweater features a relaxed fit and a timeless cable knit design', 'M', 'Green', 339.00, NULL, 'dress.jpg', NULL),
  ('item-00017', 'style-0002', 'Leopard Sunglasses', 'Featuring a timeless lace-up design and a durable rubber sole, these sneakers are perfect for everyday wear. ', NULL, 'Multicolor', 79.00, NULL, 'dress.jpg', NULL);

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
  (10, 'What is the make of your first cellphone?');

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
  (78);

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
  ('style-0005', 'Y2K', 'Relive early 2000s nostalgia with shimmering metallic accents and playful, retro styles.', NULL),
  ('style-0006', 'Dark Academia', 'Dive into scholarly elegance with tweed and vintage pieces.', NULL),
  ('style-0007', 'Old Money', 'Elevate your look with timeless sophistication and classic silhouettes.', NULL),
  ('style-0008', 'Alt', 'Express your individuality with edgy punk and grunge influences.', NULL),
  ('style-0009', 'Indie', 'Embrace bohemian vibes with eclectic prints and laid-back styles.', NULL),
  ('style-0010', 'Star Girl', 'Reach for the stars with celestial prints and dreamy designs.', NULL);

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
    `price` decimal(10,2) DEFAULT 229.00
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  --
  -- Dumping data for table `style_box`
  --

  INSERT INTO `style_box` (`style_box_id`, `style_id`, `style_box_description`, `price`) VALUES
  ('box-000019', 'style-0001', 'Embrace the charm of countryside living with Cottagecore fashion. Floral prints, flowing dresses, and rustic details create a whimsical and nostalgic look inspired by nature and traditional craftsmanship.', 229.00),
  ('box-000020', 'style-0002', 'Channel elegance and femininity with Coquette fashion. Lace, bows, and delicate fabrics evoke a romantic and playful aesthetic, perfect for those who embrace their flirtatious side.', 229.00),
  ('box-000021', 'style-0003', 'Explore the darker side of kawaii with Gothic Lolita fashion. Victorian-inspired dresses and doll-like accessories create a striking and elegant look that\'s both gothic and cute.', 229.00),
  ('box-000022', 'style-0004', 'Make a statement with Streetwear fashion. Bold graphics, casual silhouettes, and urban-inspired designs reflect the energy and creativity of city life, perfect for those who love to stand out.', 229.00),
  ('box-000023', 'style-0005', 'Embrace nostalgia with Y2K fashion. Low-rise jeans, metallic accents, and futuristic designs capture the spirit of the early 2000s, offering a playful and eclectic style for the modern era.', 229.00),
  ('box-000024', 'style-0006', 'Dive into the world of academia with Dark Academia fashion. Tweed blazers, turtleneck sweaters, and vintage-inspired pieces create a moody and scholarly look that\'s both intellectual and stylish.', 229.00),
  ('box-000025', 'style-0007', 'Elevate your wardrobe with Old Money fashion. Tailored suits, classic accessories, and timeless silhouettes exude elegance and sophistication, perfect for those with a taste for luxury.', 229.00),
  ('box-000026', 'style-0008', 'Express your individuality with Alt fashion. Punk, goth, and grunge influences combine for a non-conformist style that\'s bold, edgy, and unapologetically unique.', 229.00),
  ('box-000027', 'style-0009', 'Embrace bohemian vibes with Indie fashion. Vintage finds, eclectic prints, and handmade accessories create a laid-back and carefree look that\'s effortlessly cool.', 229.00),
  ('box-000028', 'style-0010', 'Reach for the stars with Star Girl fashion. Celestial prints, metallic accents, and futuristic designs capture the magic of the cosmos, offering a dreamy and ethereal style for stargazers and dreamers alike.', 229.00);

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
  );

  -- --------------------------------------------------------

  --
  -- Table structure for table `style_box_transaction`
  --

  CREATE TABLE `style_box_transaction` (
    `style_box_id` varchar(10) NOT NULL,
    `transaction_id` varchar(10) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  -- --------------------------------------------------------

  --
  -- Table structure for table `subscription`
  --

  CREATE TABLE `subscription` (
    `sub_id` varchar(10) NOT NULL,
    `user_id` varchar(10) DEFAULT NULL,
    `plan_id` varchar(10) DEFAULT NULL,
    `sub_start_date` date DEFAULT NULL,
    `sub_end_date` date DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  --
  -- Triggers `subscription`
  --
  DELIMITER $$
  CREATE TRIGGER `generate_sub_id` BEFORE INSERT ON `subscription` FOR EACH ROW BEGIN
      DECLARE next_id INT;
      DECLARE new_sub_id VARCHAR(10);
      
      -- Get the next sequence value
      INSERT INTO sequence VALUES (NULL);
      SET next_id = LAST_INSERT_ID();
      
      -- Generate the alphanumeric ID
      SET new_sub_id = CONCAT('sub-', LPAD(next_id, 6, '0'));
      
      -- Set the new item_id value
      SET NEW.sub_id = new_sub_id;
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
    `plan_duration` enum('1 Month','3 Months','6 Months','12 Months') DEFAULT NULL,
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
    `transaction_id` varchar(10) NOT NULL,
    `user_id` varchar(10) DEFAULT NULL,
    `transaction_date` date DEFAULT NULL,
    `shipping_fee` decimal(10,2) DEFAULT 100.00,
    `total_price` decimal(10,2) DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  --
  -- Triggers `transaction`
  --
  DELIMITER $$
  CREATE TRIGGER `generate_transaction_id` BEFORE INSERT ON `transaction` FOR EACH ROW BEGIN
      DECLARE next_id INT;
      DECLARE new_transaction_id VARCHAR(10);
      
      -- Get the next sequence value
      INSERT INTO sequence VALUES (NULL);
      SET next_id = LAST_INSERT_ID();
      
      -- Generate the alphanumeric ID
      SET new_transaction_id = CONCAT('tran-', LPAD(next_id, 5, '0'));
      
      -- Set the new item_id value
      SET NEW.transaction_id = new_transaction_id;
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
  ('user-00064', 'Mark', 'gmeescober@gmail.com', 'ed52efced6f7f5438c91fe8293eed992', 'Mark', 'Last', '09295696163', 'Blk 4 Lot 2, Sagpon, Legazpi, Albay', '2024-05-11 14:22:01');

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
  ('tran-00065', 'user-00064', '2024-05-11 06:22:01', 'signup'),
  ('tran-00066', NULL, '2024-05-11 06:22:42', 'change address'),
  ('tran-00067', NULL, '2024-05-11 06:23:15', 'change address'),
  ('tran-00068', NULL, '2024-05-11 06:25:04', 'change address'),
  ('tran-00069', NULL, '2024-05-11 06:25:50', 'logout'),
  ('tran-00070', 'user-00064', '2024-05-11 06:25:57', 'login'),
  ('tran-00071', 'user-00064', '2024-05-11 06:26:07', 'change address'),
  ('tran-00072', 'user-00064', '2024-05-11 06:28:57', 'change address'),
  ('tran-00074', 'user-00064', '2024-05-11 06:38:20', 'change password'),
  ('tran-00075', 'user-00064', '2024-05-11 07:20:54', 'change password'),
  ('tran-00076', 'user-00064', '2024-05-11 07:21:26', 'change password'),
  ('tran-00077', 'user-00064', '2024-05-11 07:23:55', 'logout'),
  ('tran-00078', 'user-00064', '2024-05-11 07:25:03', 'login');

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
    `height` decimal(5,2) DEFAULT NULL,
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
  ('tran-00073', 'user-00064', 233.00, 90.00, '23', '42', '18', 'XXL');

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
      SET new_user_preference_id = CONCAT('tran-', LPAD(next_id, 5, '0'));
      
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
    ADD KEY `transaction_id` (`transaction_id`),
    ADD KEY `style` (`style`);

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
  -- AUTO_INCREMENT for table `security_questions`
  --
  ALTER TABLE `security_questions`
    MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

  --
  -- AUTO_INCREMENT for table `sequence`
  --
  ALTER TABLE `sequence`
    MODIFY `sequence_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

  --
  -- AUTO_INCREMENT for table `user_security_questions`
  --
  ALTER TABLE `user_security_questions`
    MODIFY `user_question_id` int(11) NOT NULL AUTO_INCREMENT;

  --
  -- Constraints for dumped tables
  --

  --
  -- Constraints for table `item`
  --
  ALTER TABLE `item`
    ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`style_id`) REFERENCES `style` (`style_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`style`) REFERENCES `style` (`style`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    ADD CONSTRAINT `item_ibfk_3` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  -- Constraints for table `user_logs`
  --
  ALTER TABLE `user_logs`
    ADD CONSTRAINT `user_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

  --
  -- Constraints for table `user_preference`
  --
  ALTER TABLE `user_preference`
    ADD CONSTRAINT `user_preference_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

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
