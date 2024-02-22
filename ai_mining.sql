-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2024 at 06:43 AM
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
-- Database: `ai_mining`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CategoryID`, `CategoryName`) VALUES
(1, 'Electronics'),
(2, 'Clothing'),
(3, 'Home & Kitchen'),
(4, 'Books'),
(5, 'Sports & Outdoors'),
(6, 'Beauty & Personal Care'),
(7, 'Toys & Games'),
(8, 'Automotive'),
(9, 'Health & Household'),
(10, 'Tools & Home Improvement');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gender` enum('M','F') DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `email`, `gender`, `country`) VALUES
(1, 'John', 'Doe', 'johndoe@gmail.com', 'M', 'USA'),
(2, 'Jane', 'Doe', 'janedoe@gmail.com', 'F', 'USA'),
(3, 'Mike', 'Smith', 'mikesmith@gmail.com', 'M', 'Canada'),
(4, 'Emily', 'Brown', 'emilybrown@gmail.com', 'F', 'Canada'),
(5, 'Tom', 'Johnson', 'tomjohnson@gmail.com', 'M', 'UK'),
(6, 'Lucy', 'Williams', 'lucywilliams@gmail.com', 'F', 'UK'),
(7, 'Robert', 'Garcia', 'robertgarcia@gmail.com', 'M', 'Mexico'),
(8, 'Maria', 'Rodriguez', 'mariarodriguez@gmail.com', 'F', 'Mexico'),
(9, 'Hiro', 'Tanaka', 'hirotanaka@gmail.com', 'M', 'Japan'),
(10, 'Yui', 'Nakamura', 'yui@gmail.com', 'F', 'Japan'),
(11, 'Miguel', 'Sanchez', 'miguelsanchez@gmail.com', 'M', 'Mexico'),
(12, 'Isabella', 'Romero', 'isabellaromero@gmail.com', 'F', 'Mexico'),
(13, 'Hans', 'Muller', 'hansmuller@gmail.com', 'M', 'Germany'),
(14, 'Katja', 'Fischer', 'katjafischer@gmail.com', 'F', 'Germany'),
(15, 'Giovanni', 'Rossi', 'giovannirossi@gmail.com', 'M', 'Italy'),
(16, 'Sofia', 'Conti', 'sofiaconti@gmail.com', 'F', 'Italy');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `status` enum('placed','shipped','delivered') DEFAULT NULL,
  `shipping_country` varchar(50) DEFAULT NULL,
  `shipping_speed` enum('standard','express') DEFAULT NULL,
  `discount` decimal(5,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `order_date`, `status`, `shipping_country`, `shipping_speed`, `discount`, `total`) VALUES
(1, 1, '2022-01-01 10:00:00', 'delivered', 'USA', 'standard', 0.00, 79.97),
(2, 2, '2022-01-02 14:00:00', 'shipped', 'USA', 'express', 0.05, 149.97),
(3, 3, '2022-01-03 11:00:00', 'delivered', 'Canada', 'standard', 0.00, 119.98),
(4, 4, '2022-01-04 16:00:00', 'delivered', 'USA', 'express', 0.10, 239.96),
(5, 5, '2022-01-05 12:00:00', 'shipped', 'Mexico', 'standard', 0.00, 109.96),
(6, 6, '2022-01-06 15:00:00', 'delivered', 'USA', 'express', 0.00, 99.97),
(7, 7, '2022-01-07 18:00:00', 'shipped', 'Canada', 'express', 0.05, 249.97),
(8, 8, '2022-01-08 13:00:00', 'delivered', 'Mexico', 'standard', 0.00, 119.98),
(9, 9, '2022-01-09 17:00:00', 'delivered', 'USA', 'standard', 0.00, 74.97),
(10, 10, '2022-01-10 20:00:00', 'shipped', 'Canada', 'express', 0.10, 229.95),
(11, 1, '2022-01-11 10:00:00', 'delivered', 'USA', 'standard', 0.05, 139.97),
(12, 2, '2022-01-12 14:00:00', 'shipped', 'USA', 'express', 0.00, 309.94),
(13, 3, '2022-01-13 11:00:00', 'delivered', 'Mexico', 'standard', 0.00, 79.98),
(14, 4, '2022-01-14 16:00:00', 'delivered', 'Canada', 'express', 0.00, 99.97),
(15, 5, '2022-01-15 12:00:00', 'shipped', 'USA', 'standard', 0.10, 239.96),
(16, 6, '2022-01-16 15:00:00', 'delivered', 'Mexico', 'standard', 0.00, 139.97);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 1, 39.99),
(1, 2, 2, 19.99),
(2, 3, 3, 29.99),
(2, 4, 1, 99.99),
(3, 5, 2, 49.99),
(4, 6, 1, 89.99),
(4, 7, 1, 109.99),
(4, 8, 2, 29.99),
(5, 9, 3, 24.99),
(5, 10, 1, 79.99),
(6, 1, 2, 39.99),
(6, 2, 1, 19.99),
(6, 3, 1, 29.99),
(7, 4, 1, 99.99),
(7, 5, 1, 49.99),
(7, 6, 1, 89.99),
(8, 7, 1, 109.99),
(8, 8, 1, 29.99),
(9, 9, 2, 24.99),
(9, 10, 1, 79.99),
(10, 1, 1, 39.99),
(10, 2, 1, 19.99),
(10, 3, 2, 29.99),
(10, 4, 1, 99.99),
(11, 5, 1, 49.99),
(11, 6, 1, 89.99),
(12, 7, 1, 109.99),
(12, 8, 2, 29.99),
(12, 9, 1, 24.99),
(13, 10, 1, 79.99),
(14, 1, 1, 39.99),
(14, 2, 2, 19.99),
(14, 3, 1, 29.99),
(15, 4, 1, 99.99),
(15, 5, 2, 49.99),
(15, 6, 1, 89.99),
(16, 7, 1, 109.99),
(16, 8, 1, 29.99),
(16, 9, 1, 24.99);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Description` text DEFAULT NULL,
  `Price` decimal(10,2) NOT NULL,
  `StockQuantity` int(11) NOT NULL DEFAULT 0,
  `CategoryID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `ProductName`, `Description`, `Price`, `StockQuantity`, `CategoryID`) VALUES
(1, 'Smartphone', 'High-end smartphone with advanced features', 699.99, 100, 1),
(2, 'Laptop', 'Thin and lightweight laptop with powerful performance', 999.99, 50, 1),
(3, 'T-Shirt', 'Comfortable cotton t-shirt for everyday wear', 19.99, 200, 2),
(4, 'Jeans', 'Classic denim jeans for casual occasions', 39.99, 150, 2),
(5, 'Coffee Maker', 'Automatic coffee maker for brewing delicious coffee at home', 49.99, 80, 3),
(6, 'Wireless Earbuds', 'True wireless earbuds with Bluetooth connectivity', 79.99, 150, 1),
(7, 'Smart Watch', 'Fitness tracker smartwatch with heart rate monitor', 129.99, 100, 1),
(8, 'LED TV', '55-inch 4K Ultra HD LED TV with HDR', 799.99, 30, 1),
(9, 'Gaming Console', 'Next-generation gaming console with powerful graphics', 499.99, 50, 1),
(10, 'Digital Camera', 'Mirrorless digital camera with 24.2 MP sensor', 699.99, 80, 1),
(11, 'Running Shoes', 'Lightweight running shoes with breathable mesh', 59.99, 200, 5),
(12, 'Yoga Mat', 'Eco-friendly yoga mat with non-slip surface', 29.99, 100, 5),
(13, 'Basketball', 'Official size basketball for indoor and outdoor use', 19.99, 50, 5),
(14, 'Camping Tent', '4-person dome camping tent with rainfly', 99.99, 20, 5),
(15, 'Gym Bag', 'Durable gym bag with multiple compartments', 39.99, 80, 5),
(16, 'Face Cream', 'Moisturizing face cream with SPF 30 protection', 24.99, 150, 6),
(17, 'Shampoo', 'Sulfate-free shampoo for shiny and healthy hair', 12.99, 200, 6),
(18, 'Lipstick', 'Long-lasting matte lipstick in various shades', 9.99, 100, 6),
(19, 'Eyeshadow Palette', 'Palette of 12 highly pigmented eyeshadows', 29.99, 80, 6),
(20, 'Board Game', 'Classic board game for family game nights', 24.99, 50, 7),
(21, 'Puzzle', '1000-piece jigsaw puzzle for hours of entertainment', 14.99, 30, 7),
(22, 'Action Figure', 'Collectible action figure with articulated joints', 19.99, 40, 7),
(23, 'Remote Control Car', 'High-speed remote control car with rechargeable battery', 49.99, 20, 7),
(24, 'Car Cleaning Kit', 'Complete kit for washing and detailing your car', 34.99, 60, 8),
(25, 'Car Seat Covers', 'Universal fit car seat covers with breathable fabric', 29.99, 100, 8),
(26, 'Jump Starter', 'Portable jump starter for starting dead car batteries', 69.99, 30, 8),
(27, 'Motor Oil', 'Synthetic motor oil for improved engine performance', 24.99, 80, 8),
(28, 'Vitamin C Supplement', 'High-potency vitamin C supplement for immune support', 14.99, 150, 9),
(29, 'Protein Powder', 'Whey protein powder for muscle recovery and growth', 29.99, 200, 9),
(30, 'Multivitamin Tablets', 'Daily multivitamin tablets for overall health', 9.99, 100, 9),
(31, 'First Aid Kit', 'Compact first aid kit for emergencies at home or on the go', 19.99, 50, 9),
(32, 'Power Drill', 'Cordless power drill with lithium-ion battery', 79.99, 40, 10),
(33, 'Tool Set', 'Complete set of essential hand tools for DIY projects', 99.99, 30, 10),
(34, 'Circular Saw', 'High-performance circular saw with laser guide', 129.99, 20, 10),
(35, 'Pressure Washer', 'Electric pressure washer for cleaning decks, driveways, and more', 149.99, 20, 10),
(36, 'Desk Lamp', 'Adjustable LED desk lamp with USB charging port', 39.99, 60, 3),
(37, 'Coffee Table', 'Modern coffee table with storage compartment', 149.99, 30, 3),
(38, 'Dining Chair', 'Set of 2 upholstered dining chairs with sturdy metal legs', 89.99, 40, 3),
(39, 'Bedside Table', 'Compact bedside table with drawer and shelf', 49.99, 50, 3),
(40, 'Frying Pan', 'Non-stick frying pan with heat-resistant handle', 19.99, 100, 4),
(41, 'Knife Set', 'Stainless steel knife set with wooden block', 29.99, 80, 4),
(42, 'Blender', 'High-speed blender for making smoothies and shakes', 49.99, 60, 4),
(43, 'Microwave Oven', 'Countertop microwave oven with 1000 watts of power', 99.99, 40, 4),
(44, 'Bath Towel Set', 'Luxurious bath towel set with plush cotton material', 39.99, 50, 3),
(45, 'Comforter Set', 'Soft and cozy comforter set with reversible design', 79.99, 30, 3),
(46, 'Throw Pillow', 'Decorative throw pillow with removable cover', 14.99, 80, 3),
(47, 'Cookware Set', '10-piece non-stick cookware set with glass lids', 89.99, 20, 4),
(48, 'Dish Rack', 'Compact dish drying rack with utensil holder', 24.99, 60, 4),
(49, 'Toaster', '2-slice toaster with adjustable browning settings', 29.99, 40, 4),
(50, 'Coffee Maker', 'Programmable coffee maker with auto-brew function', 59.99, 30, 4),
(51, 'Umbrella', 'Compact travel umbrella with windproof design', 19.99, 100, 5),
(52, 'Tent', 'Lightweight backpacking tent for outdoor adventures', 129.99, 20, 5),
(53, 'Hiking Boots', 'Waterproof hiking boots with rugged sole', 89.99, 50, 5),
(54, 'Backpack', 'Durable backpack with padded laptop compartment', 49.99, 80, 5),
(55, 'Sleeping Bag', 'Warm and cozy sleeping bag for camping trips', 59.99, 30, 5);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `review_text` varchar(500) DEFAULT NULL,
  `review_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `customer_id`, `product_id`, `rating`, `review_text`, `review_date`) VALUES
(1, 1, 1, 4, 'I really enjoyed this product', '2022-01-05 10:00:00'),
(2, 2, 2, 3, 'This product was good but could be better', '2022-01-06 12:00:00'),
(3, 3, 3, 5, 'Amazing product, exceeded my expectations', '2022-01-07 14:00:00'),
(4, 4, 4, 2, 'Disappointing product, would not recommend', '2022-01-08 16:00:00'),
(5, 5, 5, 4, 'Good product, worth the price', '2022-01-09 18:00:00'),
(6, 1, 2, 5, 'This product is a game-changer!', '2022-01-10 10:00:00'),
(7, 2, 3, 4, 'Highly recommend this product', '2022-01-11 12:00:00'),
(8, 3, 4, 3, 'Product was okay, not amazing but not terrible', '2022-01-12 14:00:00'),
(9, 4, 5, 4, 'Great product, would buy again', '2022-01-13 16:00:00'),
(10, 5, 1, 2, 'Not happy with this product at all', '2022-01-14 18:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
