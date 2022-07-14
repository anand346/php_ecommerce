-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2022 at 05:37 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminPass` varchar(255) NOT NULL,
  `level` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `adminName`, `adminUser`, `adminEmail`, `adminPass`, `level`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', '202cb962ac59075b964b07152d234b70', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brandId` int(11) NOT NULL,
  `brandName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandId`, `brandName`) VALUES
(1, 'Samsung'),
(2, 'Acer'),
(3, 'Iphone'),
(4, 'Dell'),
(5, 'HP'),
(7, 'Canon');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cartId` int(11) NOT NULL,
  `sId` varchar(255) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catId` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`catId`, `catName`) VALUES
(1, 'Phone'),
(2, 'Laptop'),
(3, 'Grocery'),
(4, 'Desktop'),
(5, 'Accessories'),
(6, 'Software'),
(7, 'Footware'),
(8, 'clothing'),
(9, 'kids,toys'),
(11, 'jewellery'),
(12, 'Sports and Fitness'),
(14, 'beauty,healthcare');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `zip` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `name`, `address`, `city`, `country`, `zip`, `phone`, `email`, `password`) VALUES
(2, 'abhishek', 'siddhart enclave', 'bhopal', 'india', '462022', '9039495825', 'abhishekraj8685@gmail.com', '7fc6021e40e0367b9f2d36833698a4bd'),
(3, 'anand', 'siddhart enclave', 'bhopal', 'india', '462022', '9340824255', 'rajanand9039@gmail.com', 'fc5e038d38a57032085441e7fe7010b0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `cusId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `cusId`, `productId`, `productName`, `quantity`, `price`, `image`) VALUES
(1, 3, 11, 'mouse', 1, 300.00, 'upload/9c5e05dda2.png'),
(2, 3, 14, 'Macbook pro', 1, 100000.00, 'upload/72cafe3af0.png'),
(3, 3, 11, 'mouse', 1, 300.00, 'upload/9c5e05dda2.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `catId` int(11) NOT NULL,
  `brandId` int(11) NOT NULL,
  `body` text NOT NULL,
  `price` float NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `catId`, `brandId`, `body`, `price`, `image`, `type`) VALUES
(1, 'Samsung Edge 7', 1, 1, '<p>Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;Samsung Edge 7&nbsp;</p>', 40000, 'upload/4117ad66b7.png', 0),
(3, 'Iphone', 1, 3, '<p>Iphone golden&nbsp;Iphone golden&nbsp;Iphone golden&nbsp;Iphone golden&nbsp;Iphone golden&nbsp;Iphone golden&nbsp;Iphone golden&nbsp;Iphone golden&nbsp;Iphone golden&nbsp;Iphone golden&nbsp;Iphone golden&nbsp;Iphone golden&nbsp;Iphone golden&nbsp;Iphone golden&nbsp;Iphone golden&nbsp;Iphone golden&nbsp;Iphone golden&nbsp;Iphone golden&nbsp;Iphone golden&nbsp;Iphone golden&nbsp;Iphone golden&nbsp;Iphone golden&nbsp;Iphone golden&nbsp;Iphone golden&nbsp;Iphone golden&nbsp;Iphone golden&nbsp;Iphone golden&nbsp;Iphone golden&nbsp;Iphone golden&nbsp;Iphone golden&nbsp;Iphone golden&nbsp;Iphone golden&nbsp;</p>', 50000, 'upload/0737356f2c.png', 0),
(4, 'Samsung M21 battery', 1, 1, '<p>Samsung M21 battery&nbsp;Samsung M21 battery&nbsp;Samsung M21 battery&nbsp;Samsung M21 battery&nbsp;Samsung M21 battery&nbsp;Samsung M21 battery&nbsp;Samsung M21 battery&nbsp;Samsung M21 battery&nbsp;Samsung M21 battery&nbsp;Samsung M21 battery&nbsp;Samsung M21 battery&nbsp;Samsung M21 battery&nbsp;Samsung M21 battery&nbsp;Samsung M21 battery&nbsp;Samsung M21 battery&nbsp;Samsung M21 battery&nbsp;Samsung M21 battery&nbsp;Samsung M21 battery&nbsp;Samsung M21 battery&nbsp;Samsung M21 battery&nbsp;Samsung M21 battery&nbsp;Samsung M21 battery&nbsp;Samsung M21 battery&nbsp;Samsung M21 battery&nbsp;</p>', 40000, 'upload/6931bd1758.png', 1),
(5, 'football ', 12, 4, '<p>football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;football&nbsp;</p>', 1000, 'upload/bb97fcf493.png', 1),
(6, 'comb ', 3, 2, '<p>comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;comb&nbsp;</p>', 40, 'upload/d195221691.png', 1),
(7, 'kid cycle', 9, 4, '<p>kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;kid cycle&nbsp;</p>', 1000, 'upload/f57cf025c2.png', 1),
(8, 'Iron ', 5, 1, '<p>metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;metallic iron&nbsp;</p>', 1000, 'upload/936b7e54f1.png', 1),
(9, 'Samsung Printer', 5, 1, '<p>Samsung Printer&nbsp;Samsung Printer&nbsp;Samsung Printer&nbsp;Samsung Printer&nbsp;Samsung Printer&nbsp;Samsung Printer&nbsp;Samsung Printer&nbsp;Samsung Printer&nbsp;Samsung Printer&nbsp;Samsung Printer&nbsp;Samsung Printer&nbsp;Samsung Printer&nbsp;Samsung Printer&nbsp;Samsung Printer&nbsp;Samsung Printer&nbsp;Samsung Printer&nbsp;Samsung Printer&nbsp;Samsung Printer&nbsp;Samsung Printer&nbsp;Samsung Printer&nbsp;Samsung Printer&nbsp;Samsung Printer&nbsp;Samsung Printer&nbsp;Samsung Printer&nbsp;Samsung Printer&nbsp;Samsung Printer&nbsp;Samsung Printer&nbsp;Samsung Printer&nbsp;Samsung Printer&nbsp;Samsung Printer&nbsp;Samsung Printer&nbsp;Samsung Printer&nbsp;</p>', 2000, 'upload/c578714342.png', 0),
(10, 'Keyboard', 5, 4, '<p>dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;dell keyboard&nbsp;</p>', 400, 'upload/c4de99e93d.png', 1),
(11, 'mouse', 5, 1, '<p>samsung mouse&nbsp;samsung mouse&nbsp;samsung mouse&nbsp;samsung mouse&nbsp;samsung mouse&nbsp;samsung mouse&nbsp;samsung mouse&nbsp;samsung mouse&nbsp;samsung mouse&nbsp;samsung mouse&nbsp;samsung mouse&nbsp;samsung mouse&nbsp;samsung mouse&nbsp;samsung mouse&nbsp;samsung mouse&nbsp;samsung mouse&nbsp;samsung mouse&nbsp;samsung mouse&nbsp;samsung mouse&nbsp;samsung mouse&nbsp;samsung mouse&nbsp;samsung mouse&nbsp;samsung mouse&nbsp;samsung mouse&nbsp;samsung mouse&nbsp;samsung mouse&nbsp;samsung mouse&nbsp;samsung mouse&nbsp;samsung mouse&nbsp;</p>', 300, 'upload/9c5e05dda2.png', 1),
(12, 'Fridge', 5, 5, '<p>HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;HP fridge&nbsp;</p>', 8000, 'upload/d9103b412a.png', 0),
(13, 'Acer ideapad', 2, 2, '<p>Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;Acer ideapad&nbsp;</p>', 45000, 'upload/244cd8735d.png', 0),
(14, 'Macbook pro', 4, 3, '<p>Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;Macbook pro&nbsp;</p>', 100000, 'upload/72cafe3af0.png', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brandId`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
