-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2023 at 10:49 PM
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
-- Database: `brainster_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `shortBiography` text NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `firstname`, `lastname`, `shortBiography`, `is_deleted`) VALUES
(1, 'J. R. R.', 'Tolkien', 'John Ronald Reuel Tolkien CBE FRSL was an English writer and philologist. He was the author of the high fantasy works The Hobbit and The Lord of the Rings.', 0),
(2, 'George', 'Orwell', 'Born in India, Blair was raised and educated in England from when he was one year old. After school he became an Imperial policeman in Burma, before returning to Suffolk, England, where he began his writing career as George Orwell—a name inspired by a favourite location, the River Orwell. 2222222222', 0),
(3, 'Markus', 'Zusak', 'Markus Zusak is an Australian writer. He is best known for The Book Thief and The Messenger, two novels which became international bestsellers. He won the Margaret A. Edwards Award in 2014', 0),
(4, 'Vladimir', 'Nabokov', 'Vladimir Vladimirovich Nabokov, also known by the pen name Vladimir Sirin, was an expatriate Russian and Russian-American novelist, poet, translator, and entomologist. Born in Imperial Russia in 1899, Nabokov wrote his first nine novels in Russian while living in Berlin, where he met his wife', 0),
(8, 'Sulemain', 'Aserai', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1),
(9, 'Marius', 'Sulla', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.', 0),
(10, 'Gaius', 'Marius', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 0),
(11, 'King', 'Lionheart', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 0),
(12, 'Colico', 'Jack', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris ', 0),
(13, 'Bilbo', 'Gammings', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 0),
(14, 'Mara', 'Franzis', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu.', 0),
(15, 'Natasha', 'Boyle', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1),
(16, 'Ken', 'Adams', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 0),
(17, 'Nora', 'Barrett', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate', 0),
(18, 'Markus', 'Antonius', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 0),
(19, 'Science', 'Tech', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 0),
(20, 'Chloe', 'Ellis', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ', 0),
(21, 'Susan', 'Dawson', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 0),
(22, 'Alfred', 'Chuchill', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 0),
(23, 'Regina', 'Phalange', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.\r\n', 0),
(24, 'aa', 'sa', 'sasasasasasasasasasasasasasasasasasasasasasasa', 1);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `imgUrl` varchar(255) NOT NULL,
  `pages` int(11) NOT NULL,
  `releaseYear` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `author_id`, `title`, `category_id`, `imgUrl`, `pages`, `releaseYear`) VALUES
(41, 22, 'The Ghost Town', 11, 'https://d1csarkz8obe9u.cloudfront.net/posterpreviews/white-and-yellow-colors-design-template-b77ce59ae87af2fe5bc34df66e953e62_screen.jpg?ts=1637010697', 156, 2020),
(42, 22, 'The Darkest Hour', 11, 'https://d1csarkz8obe9u.cloudfront.net/posterpreviews/thriller-fantasy-apocalyptic-novel-book-cover-design-template-0e3f9858cc45313f0aa04f4cf14de3e8_screen.jpg?ts=1637006925', 450, 2018),
(43, 1, 'The Long Night', 11, 'https://d1csarkz8obe9u.cloudfront.net/posterpreviews/the-long-night-thriller-horror-book-cover-design-template-85f78b47613ef0e79529486e27ba4191_screen.jpg?ts=1637013250', 556, 2011),
(44, 23, 'Deadly Woman', 13, 'https://d1csarkz8obe9u.cloudfront.net/posterpreviews/fiction-woman-movie-or-book-cover-template-design-6191e92b5dc92079998506489f366c48_screen.jpg?ts=1637014558', 980, 2022),
(45, 3, 'Zombieland', 13, 'https://d1csarkz8obe9u.cloudfront.net/posterpreviews/zombie-city-apocalypse-book-cover-design-template-79b6cb9963e902fb16f3d8244e9523b0_screen.jpg?ts=1637008920', 1254, 1988),
(46, 10, 'Skull Island', 15, 'https://d1csarkz8obe9u.cloudfront.net/posterpreviews/epic-adventure-book-cover-design-template-589f526422c88a32b350ef562e30498f_screen.jpg?ts=1637012563', 145, 2016),
(47, 9, 'Space', 15, 'https://d1csarkz8obe9u.cloudfront.net/posterpreviews/outer-space-book-cover-scifi-space-design-template-e8058d9a2ef5b6e78e1bdab935972c1e_screen.jpg?ts=1637006891', 987, 1997),
(49, 11, 'The Last Knight', 15, 'https://d1csarkz8obe9u.cloudfront.net/posterpreviews/last-night-book-cover-design-template-e8fc747966d271242546175ac758899a_screen.jpg?ts=1637017469', 1687, 2012),
(50, 9, 'Opposites', 15, 'https://d1csarkz8obe9u.cloudfront.net/posterpreviews/fire-and-water-book-cover-design-template-fb43657a3c3cf8f2dfdade00247d66c8_screen.jpg?ts=1637008787', 366, 1887),
(51, 15, 'Passion', 10, 'https://d1csarkz8obe9u.cloudfront.net/posterpreviews/romantic-book-cover-design-template-9312eed15512f4b6fe4ce807113586ba_screen.jpg?ts=1637007460', 156, 2020),
(52, 16, 'Header', 10, 'https://d1csarkz8obe9u.cloudfront.net/posterpreviews/night-stars-book-cover-template-lonely-design-e53f7013b4bcd1beea79bad63bdf837c_screen.jpg?ts=1636989170', 654, 2001),
(53, 9, 'Alliens', 14, 'https://d1csarkz8obe9u.cloudfront.net/posterpreviews/book-cover-scifi-space-design-template-ea24fbb6e9ade8b7ec2bf7404bde5ebd_screen.jpg?ts=1637007117', 632, 2003),
(54, 17, 'The King Of Drugs', 11, 'https://d1csarkz8obe9u.cloudfront.net/posterpreviews/action-thriller-book-cover-design-template-3675ae3e3ac7ee095fc793ab61b812cc_screen.jpg?ts=1637008457', 1026, 2016),
(55, 19, 'Science Future', 17, 'https://d1csarkz8obe9u.cloudfront.net/posterpreviews/blue-science-and-robotics-magazine-cover-flye-design-template-d496fd0bb044e83772838fd763213fdf_screen.jpg?ts=1637028758', 269, 2022),
(56, 19, 'Science And Technology', 17, 'https://d1csarkz8obe9u.cloudfront.net/posterpreviews/yellow-science-and-robots-magazine-cover-flye-design-template-394583479eb60ffae3a7301e460fe362_screen.jpg?ts=1637027980', 887, 2019),
(58, 19, 'Science Future 3', 17, 'https://d1csarkz8obe9u.cloudfront.net/posterpreviews/red-and-blue-science-magazine-cover-flyer-tem-design-template-0bcfbe6c42c28dcfbc39a7e74ed87a72_screen.jpg?ts=1637027956', 662, 2018),
(59, 20, 'The Mystery Woman', 14, 'https://d1csarkz8obe9u.cloudfront.net/posterpreviews/black-and-white-thriller-book-cover-novel-des-design-template-ba14450b9823edcf100da08e30c7ee8b_screen.jpg?ts=1637014844', 654, 2004),
(60, 12, 'Pirate Sails', 15, 'https://d1csarkz8obe9u.cloudfront.net/posterpreviews/pirate-sails-adventure-novel-design-template-705e7f2f14f40d9136d99c2b72716f6c_screen.jpg?ts=1637010510', 2560, 1997),
(61, 8, 'Business Next Level', 17, 'https://d1csarkz8obe9u.cloudfront.net/posterpreviews/business-e-book-related-book-cover-design-template-afe27d29deae33706529c43fd94f57e9_screen.jpg?ts=1637010812', 1485, 2002),
(62, 21, 'The Lord Of The Lost', 13, 'https://d1csarkz8obe9u.cloudfront.net/posterpreviews/dark-horror-book-cover-design-template-74f0b0cc1c4abb0a8d8adffc5c624357_screen.jpg?ts=1637008447', 356, 2006),
(63, 14, 'The Night', 13, 'https://d1csarkz8obe9u.cloudfront.net/posterpreviews/thriller-horror-book-cover-design-template-1696e010b7bd71cd79bfced90615390c_screen.jpg?ts=1637018568', 985, 1898),
(64, 2, 'Burmese Days', 15, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTSUNs-I2QK_ZZDHqMZ1v9a6Pv81jly7H-lPGd1xNc6A_irNZNa', 666, 1934),
(65, 13, 'ICE', 18, 'https://d1csarkz8obe9u.cloudfront.net/posterpreviews/ice-book-cover-%3A-fantasy-%2C-mythology-and-thri-design-template-2098c605c98350113f02178dfc096763_screen.jpg?ts=1636996208', 120, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categoryName`, `is_deleted`) VALUES
(10, 'Romanse', 0),
(11, 'Thriller', 0),
(12, 'Sci-Fi', 0),
(13, 'Horror', 0),
(14, 'Mystery', 0),
(15, 'Adventure', 0),
(16, 'Fantasy', 1),
(17, 'IT', 0),
(18, 'commedy', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_approved` tinyint(4) NOT NULL DEFAULT 0,
  `is_declined` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `user_id`, `book_id`, `dateCreated`, `is_approved`, `is_declined`) VALUES
(60, 'Love this book', 20, 50, '2023-09-02 16:44:52', 1, 0),
(61, 'TOP!', 20, 46, '2023-09-02 16:44:53', 1, 0),
(62, 'Amazing!', 25, 50, '2023-09-02 20:42:35', 1, 0),
(63, 'Good books', 25, 55, '2023-09-02 16:47:15', 0, 0),
(64, 'WooW!', 25, 47, '2023-09-02 16:47:31', 0, 0),
(65, 'Scarry but good!', 25, 63, '2023-09-02 19:17:54', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_notes`
--

CREATE TABLE `personal_notes` (
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_notes`
--

INSERT INTO `personal_notes` (`user_id`, `book_id`, `note`, `id`) VALUES
(20, 50, 'test proba => edit', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstName`, `lastName`, `is_admin`) VALUES
(20, 'Nachevski', '$2y$10$FWNIexFtLti8eN/i0n0CuueTsrulPB7YWWgU0xx6UesntLyfhaDQO', 'Vladimir', 'Nachevski', 1),
(25, 'testUser', '$2y$10$C7md4U5oU1QyGvtTX25zK.LdiXynAx.iVrPXwcuMbC4iOspKc7Ydy', 'testUser', 'testUser', 0),
(26, 'testUser2', '$2y$10$YnD0MVLEt91EoDStiB6QpeUjScsfOX5cs.YIdOsbQM6XNVByDXN2O', 'testUser2', 'testUser2', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `personal_notes`
--
ALTER TABLE `personal_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `personal_notes`
--
ALTER TABLE `personal_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`),
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_5` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_6` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `personal_notes`
--
ALTER TABLE `personal_notes`
  ADD CONSTRAINT `personal_notes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `personal_notes_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
