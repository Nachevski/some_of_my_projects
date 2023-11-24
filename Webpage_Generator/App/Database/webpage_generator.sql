-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2023 at 12:40 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS webpage_generator;
CREATE DATABASE webpage_generator;
USE webpage_generator;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webpage_generator`
--

-- --------------------------------------------------------

--
-- Table structure for table `generated_templates`
--

CREATE TABLE `generated_templates` (
  `id` int(11) NOT NULL,
  `company_name` varchar(35) NOT NULL,
  `cover_img` varchar(255) NOT NULL,
  `main_title` varchar(255) NOT NULL,
  `sub_title` varchar(255) NOT NULL,
  `about_info` text NOT NULL,
  `phone_number` varchar(35) NOT NULL,
  `location` varchar(255) NOT NULL,
  `type_of_goods_id` int(11) NOT NULL,
  `linkedin_url` varchar(255) NOT NULL,
  `facebook_url` varchar(255) NOT NULL,
  `twitter_url` varchar(255) NOT NULL,
  `google_plus_url` varchar(255) NOT NULL,
  `theme` varchar(15) NOT NULL,
  `date_created` datetime NOT NULL,
  `company_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `generated_templates`
--

INSERT INTO `generated_templates` (`id`, `company_name`, `cover_img`, `main_title`, `sub_title`, `about_info`, `phone_number`, `location`, `type_of_goods_id`, `linkedin_url`, `facebook_url`, `twitter_url`, `google_plus_url`, `theme`, `date_created`, `company_description`) VALUES
(1, 'Studio N', 'https://r4.wallpaperflare.com/wallpaper/974/125/268/living-room-interior-design-fireplaces-wallpaper-f1587a3be9531c42bbf2555776761253.jpg', 'Studio N Interiors', 'We design your dreams!', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '+38970826500', 'Tetovo', 1, 'https://mk.linkedin.com', 'https://facebook.com', 'https://twitter.com', 'https://google.com', 'theme-dark', '2023-06-18 12:08:20', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet?'),
(2, 'Nature', 'https://fastly.picsum.photos/id/11/2500/1667.jpg?hmac=xxjFJtAPgshYkysU_aqx2sZir-kIOjNR9vx0te7GycQ', 'Nature is not a place to visit, it is home.', 'Some old-fashioned things like fresh air and sunshine are hard to beat.', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. ', '+123456789', 'Everywhere', 2, 'https://mk.linkedin.com', 'https://facebook.com', 'https://twitter.com', 'https://google.com', 'default', '2023-06-18 12:26:19', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni?'),
(3, 'Photography', 'https://fastly.picsum.photos/id/250/4928/3264.jpg?hmac=4oIwzXlpK4KU3wySTnATICCa4H6xwbSGifrxv7GafWU', 'Photography Portfolio', 'SUBTITLE', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '65466654', 'New York', 1, 'https://mk.linkedin.com', 'https://facebook.com', 'https://twitter.com', 'https://google.com', 'theme-dark', '2023-06-18 12:37:17', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet?');

-- --------------------------------------------------------

--
-- Table structure for table `items_of_goods`
--

CREATE TABLE `items_of_goods` (
  `template_id` int(11) NOT NULL,
  `item_url` varchar(255) NOT NULL,
  `item_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items_of_goods`
--

INSERT INTO `items_of_goods` (`template_id`, `item_url`, `item_description`) VALUES
(1, 'https://c0.wallpaperflare.com/path/177/209/241/white-wooden-sideboard-beside-gray-padded-sofa-873742346f3622815598a089352a8c0b.jpg', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.'),
(1, 'https://r4.wallpaperflare.com/wallpaper/874/439/754/apartment-condo-design-home-wallpaper-5000e985a024cda7f956d09ac11eee26.jpg', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui.'),
(1, 'https://r4.wallpaperflare.com/wallpaper/25/819/688/living-room-beach-residences-wallpaper-8ffc92df6dd98598379d220444b3b0e0.jpg', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. '),
(1, 'https://r4.wallpaperflare.com/wallpaper/323/952/839/design-palm-trees-chairs-modern-wallpaper-8622835d7c15481c9f04ed5d0f2ee7e1.jpg', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. '),
(1, 'https://r4.wallpaperflare.com/wallpaper/179/847/608/design-style-room-sofa-wallpaper-f2f172a07d260e5bbad8f2d53058e962.jpg', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati. '),
(2, 'https://fastly.picsum.photos/id/62/2000/1333.jpg?hmac=PbFIn8k0AndjiUwpOJcfHz2h-wPCQi_vJRTJZPdr6kQ', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident. '),
(2, 'https://fastly.picsum.photos/id/89/4608/2592.jpg?hmac=G9E4z5RMJgMUjgTzeR4CFlORjvogsGtqFQozIRqugBk', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. '),
(2, 'https://fastly.picsum.photos/id/71/5000/3333.jpg?hmac=wBjyqoAke0uv6bTtbbIby9s-VTQ52gIkI-QVXWS3W0I', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint. '),
(3, 'https://fastly.picsum.photos/id/320/2689/1795.jpg?hmac=RbcHvJKkKfsAdlsQWzGT-F31XZcRP-O89MeKyDaeads', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.'),
(3, 'https://fastly.picsum.photos/id/325/4928/3264.jpg?hmac=D_X6AKqCcH8IpWElX5X3dxx11yn7yYO-vPhiKhzRbwI', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. '),
(3, 'https://fastly.picsum.photos/id/212/2000/1394.jpg?hmac=5mJ6tJgbGO0Wl1jBHXsiOQQYq-bRf47wLE9vmXjcEuU', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas. ');

-- --------------------------------------------------------

--
-- Table structure for table `type_of_goods`
--

CREATE TABLE `type_of_goods` (
  `id` int(11) NOT NULL,
  `type_of` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type_of_goods`
--

INSERT INTO `type_of_goods` (`id`, `type_of`) VALUES
(1, 'Services'),
(2, 'Products');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `generated_templates`
--
ALTER TABLE `generated_templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_of_goods_id` (`type_of_goods_id`);

--
-- Indexes for table `items_of_goods`
--
ALTER TABLE `items_of_goods`
  ADD KEY `template_id` (`template_id`);

--
-- Indexes for table `type_of_goods`
--
ALTER TABLE `type_of_goods`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `generated_templates`
--
ALTER TABLE `generated_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `type_of_goods`
--
ALTER TABLE `type_of_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `generated_templates`
--
ALTER TABLE `generated_templates`
  ADD CONSTRAINT `generated_templates_ibfk_1` FOREIGN KEY (`type_of_goods_id`) REFERENCES `type_of_goods` (`id`);

--
-- Constraints for table `items_of_goods`
--
ALTER TABLE `items_of_goods`
  ADD CONSTRAINT `items_of_goods_ibfk_1` FOREIGN KEY (`template_id`) REFERENCES `generated_templates` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
