-- phpMyAdmin SQL Dump
-- version 5.2.3-dev+20250902.5a96d520e7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 23, 2025 at 02:27 PM
-- Server version: 11.8.3-MariaDB-log
-- PHP Version: 8.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL, -- foreign
  `total_amount` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL, -- foreign
  `product_id` int(11) NOT NULL, -- foreign
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL, -- foreign
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL, -- foreign
  `file_path` varchar(255) NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('admin','customer') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);


--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD FOREIGN KEY (category_id) REFERENCES categories(id);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD FOREIGN KEY (user_id) REFERENCES users(id);

-- ALTER TABLE `orders`
--
-- Indexes for table `order_items`
--
-- order_items order id product id

ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `order_items`
  ADD FOREIGN KEY (order_id) REFERENCES orders(id),
  ADD FOREIGN KEY (product_id) REFERENCES products(id);

-- ALTER TABLE `products`

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD FOREIGN KEY (product_id) REFERENCES products(id);

-- ALTER TABLE `product_images`

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


INSERT INTO `categories` (`id`, `name`, `description`, `created_at`) VALUES ('1', 'Adventure', 'Exciting Adventure books that take you on a trip to the unknown.', current_timestamp());

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`) VALUES ('2', 'Novel', 'Long, fictional narrative work, typically written in prose and published as a book.', current_timestamp());

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`) VALUES ('3', 'Horror', 'Genre of art and media that aims to disturb, frighten, or scare an audience by eliciting feelings of fear, dread, or intense aversion.', current_timestamp());

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`) VALUES ('4', 'Autobiography', "An account of someone's life written by that person", current_timestamp());

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`) VALUES ('5', 'Fiction', 'Creative, imaginary work, such as novels, short stories, or films, that is not based on facts.', current_timestamp());

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `stock_quantity`, `created_at`, `updated_at`) VALUES ('1', '1', 'Harry Potter', 'Harry Potter is a series of seven fantasy novels written by British author J. K. Rowling.', '21.99', '65', current_timestamp(), '2025-11-12 19:34:32');

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `stock_quantity`, `created_at`, `updated_at`) VALUES ('2', '2', 'Frankenstein', 'Frankenstein tells the story of Victor Frankenstein, a young scientist who creates a sapient creature in an unorthodox scientific experiment that involved putting it together with different body parts.', '18.99', '22', current_timestamp(), '2025-11-12 19:35:32');

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `stock_quantity`, `created_at`, `updated_at`) VALUES ('3', '3', 'Don Quixote', 'Spanish novel by Miguel de Cervantes. Originally published in two parts in 1605 and 1615, the novel is considered a founding work of Western literature and the first modern novel.', '24.99', '42', current_timestamp(), '2025-11-12 19:36:32');

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `stock_quantity`, `created_at`, `updated_at`) VALUES ('4', '2', 'Alice in Wonderland', 'Alice\'s Adventures in Wonderland is an 1865 English children\'s novel by Lewis Carroll, a mathematics don at the University of Oxford.', '24.99', '50', current_timestamp(), '2025-11-12 21:38:04');
