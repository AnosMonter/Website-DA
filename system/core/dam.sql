-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2024 at 05:29 PM
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
-- Database: `dam`
--
CREATE Database IF NOT EXISTS `dam` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dam`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `Name`, `Image`) VALUES
(9, 'Ghế Sofa', 'CategoriesGhế Sofa.webp'),
(10, 'Tủ Kệ Ti Vi', 'CategoriesTủ Kệ Ti Vi.jpg'),
(11, 'Tủ Giày', 'CategoriesTủ Giày.jpg'),
(12, 'Bàn Ăn', 'CategoriesBàn Ăn.jpg'),
(13, 'Tủ Bếp', 'CategoriesTủ Bếp.jpg'),
(14, 'Ghế Ăn', 'CategoriesGhế Ăn.jpg'),
(15, 'Giường', 'CategoriesGiường.jpg'),
(16, 'Tủ Đầu Giường', 'CategoriesTu Đầu Giường.jpg'),
(17, 'Tủ Áo', 'CategoriesTủ Áo.jpg'),
(18, 'Bàn Phòng Khách', 'CategoriesBàn Phòng Khách.jpg'),
(19, 'Bàn Làm Việc', 'CategoriesBàn Làm Việc.jpg'),
(20, 'Tủ Sách', 'CategoriesTủ Sách.webp');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `ID` int(11) NOT NULL,
  `ID_Product` int(11) NOT NULL,
  `ID_User` int(11) NOT NULL,
  `Comments` text DEFAULT NULL,
  `Dates` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`ID`, `ID_Product`, `ID_User`, `Comments`, `Dates`) VALUES
(4, 22, 1, 'hello', '2024-08-09'),
(5, 22, 1, 'Đây là Sản phẩm của shop Horizon', '2024-08-09'),
(6, 19, 1, 'Ghế Ok đấy\r\n', '2024-08-09'),
(7, 24, 1, 'Sản Phẩm Chất Lượng Cao', '2024-08-09');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `ID` int(11) NOT NULL,
  `ID_Product` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Order_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Address` text DEFAULT NULL,
  `Create_Date` date NOT NULL,
  `Payment_Method` varchar(255) NOT NULL,
  `Total` int(11) NOT NULL,
  `Buy_Date` date NOT NULL,
  `Status_Order` varchar(255) NOT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Price` int(11) NOT NULL,
  `Image` text NOT NULL,
  `Sale` int(11) NOT NULL,
  `Description` text NOT NULL,
  `Detail` text NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Status` tinyint(4) NOT NULL,
  `Import_Date` date DEFAULT NULL,
  `Production_Date` date DEFAULT NULL,
  `Expiration_Date` date DEFAULT NULL,
  `View` int(11) NOT NULL,
  `Cat_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `Name`, `Price`, `Image`, `Sale`, `Description`, `Detail`, `Quantity`, `Status`, `Import_Date`, `Production_Date`, `Expiration_Date`, `View`, `Cat_ID`) VALUES
(19, 'Sofa 2 chỗ', 15900000, 'ProductsSofa 2 chỗ.jpg', 15, '', '', 100, 1, '2024-08-05', '0000-00-00', '0000-00-00', 14, 9),
(20, 'Tủ tivi Bridge Gỗ 1m8 - Màu nâu', 59000000, 'ProductsTủ tivi Bridge Gỗ 1m8 - Màu nâu.jpg', 15, '- Collection: Bridge.\r\n- Kích thước: D1800 - R450 - C450 mm.\r\n- Vật liệu: Gỗ sồi đặc tự nhiên nhập khẩu từ Mỹ.', '', 10, 1, '2024-08-05', '0000-00-00', '0000-00-00', 9, 10),
(21, 'Bàn nước Opal mặt đá tròn', 14370000, 'ProductsBàn nước Opal mặt đá tròn.jpg', 15, '- Collection: Opal.\r\n- Kích thước: Ø900 - C310 mm.\r\n- Vật liệu: Mặt đá- Chân inox.', '', 100, 1, '2024-08-05', '0000-00-00', '0000-00-00', 27, 18),
(22, ' Bàn nước Dura', 14900001, 'Products Bàn nước Dura.jpg', 12, '- Vật liệu: Gỗ Oak - kính.\r\n- Kích thước: D1100 - R620 - C370 mm.', '', 100, 4, '2024-08-05', '0000-00-00', '0000-00-00', 29, 18),
(23, 'Tủ giày Chio sơn trắng', 11570000, 'ProductsTủ giày Chio sơn trắng.jpg', 12, '', '', 100, 1, '2024-08-05', '0000-00-00', '0000-00-00', 1, 11),
(24, 'Kệ Gỗ – Kệ Sách', 2490000, 'ProductsKệ Gỗ – Kệ Sách.webp', 20, '- Kích thước: Dài 80cm x Rộng 30cm x Cao 160cm.\r\n\r\n- Chất liệu: Gỗ công nghiệp MFC/ MDF chuẩn CARB-P2(*).\r\n\r\n(*) Tiêu chuẩn California Air Resources Board xuất khẩu Mỹ, đảm bảo gỗ không độc hại, an toàn cho sức khỏe', '', 100, 1, '2024-08-08', '0000-00-00', '0000-00-00', 3, 20),
(25, 'Giường Ngủ Gỗ Tràm', 8990000, 'ProductsGiường Ngủ Gỗ Tràm.webp', 28, '- Kích thước phủ bì: Dài 212cm x Rộng 136/156/176/196cm x Cao đến đầu giường 92cm\r\n\r\nChất liệu:\r\n\r\n- Thân giường: Gỗ tràm tự nhiên, Veneer gỗ tràm tự nhiên\r\n\r\n- Chân giường: Gỗ cao su tự nhiên\r\n\r\n- Tấm phản: Gỗ plywood chuẩn CARB-P2 (*)\r\n\r\n(*) Tiêu chuẩn California Air Resources Board xuất khẩu Mỹ, đảm bảo gỗ không độc hại, an toàn cho sức khỏe', '', 10, 1, '2024-08-08', '0000-00-00', '0000-00-00', 5, 15),
(26, 'Giường Ngủ Gỗ', 8990000, 'ProductsGiường Ngủ Gỗ.webp', 28, 'Kích thước phủ bì: Dài 212cm x Rộng 136/156/176/196cm x Cao đến đầu giường 92cm\r\n\r\nChất liệu:\r\n\r\n- Thân giường: Gỗ tràm tự nhiên, Veneer gỗ sồi tự nhiên\r\n\r\n- Chân giường: Gỗ cao su tự nhiên\r\n\r\n- Thanh vạt/ Tấm phản: Gỗ plywood chuẩn CARB-P2 (*)\r\n\r\n(*) Tiêu chuẩn California Air Resources Board xuất khẩu Mỹ, đảm bảo gỗ không độc hại, an toàn cho sức khỏe', '', 10, 1, '2024-08-08', '0000-00-00', '0000-00-00', 51, 15),
(27, 'Bộ Bàn Ăn Gỗ Cao Su Tự Nhiên', 9570000, 'ProductsBộ Bàn Ăn Gỗ Cao Su Tự Nhiên.webp', 32, 'Kích thước: \r\n- Bàn Ăn: Dài 160cm x Rộng 80cm x Cao 65cm\r\n- Ghế Đơn: Dài 50cm x Rộng 56cm x Cao 70cm\r\n- Ghế Băng Dài/Băng Tựa: Dài 110cm x Rộng 41cm/52,4cm x Cao 38cm/70cm\r\n- Chất liệu: Gỗ cao su tự nhiên', '', 100, 1, '2024-08-14', '0000-00-00', '0000-00-00', 0, 12),
(28, 'Hệ tủ bếp', 19816667, 'ProductsHệ tủ bếp.webp', 40, '- Cánh tủ: gỗ MFC phủ Melamine, dày 18mm, chuẩn CARB P2 (*)\r\n- Thân tủ: gỗ MFC phủ foil, dày 18mm, chuẩn CARB P2 (*)\r\n- Thân tủ chậu rửa: Picomat chống nước, dày 18mm.\r\n(*) Tiêu chuẩn California Air Resources Board xuất khẩu Mỹ, đảm bảo gỗ không độc hại, an toàn cho sức khỏe.', '', 100, 1, '2024-08-14', '0000-00-00', '0000-00-00', 6, 13),
(29, 'Ghế Ăn Gỗ Cao Su Tự Nhiên', 2190000, 'ProductsGhế Ăn Gỗ Cao Su Tự Nhiên.jpg', 32, 'Chất liệu: \r\n- Gỗ cao su tự nhiên\r\n- Vải bọc polyester chống nhăn, kháng bụi bẩn, nấm mốc.\r\nKích thước:\r\n- Cao thông thường: Dài 50cm x Rộng 56cm x Cao đến đệm ngồi/lưng tựa 42cm/80cm', '', 100, 1, '2024-08-14', '0000-00-00', '0000-00-00', 1, 14),
(30, 'Bàn Làm Việc Gỗ Màu Nâu', 3290000, 'ProductsBàn Làm Việc Gỗ Màu Nâu.jpg', 33, '- Kích thước bàn: Dài 120cm x Rộng 60cm x Cao 74cm\r\n- Kích thước hộc kéo: Dài 23cm x Rộng 40cm x Cao 7cm\r\nChất liệu:\r\n- Mặt bàn: Gỗ công nghiệp PB chuẩn CARB-P2 (*), Veneer gỗ tràm tự nhiên\r\n- Chân bàn: Gỗ cao su tự nhiên\r\n- Cụm hộc tủ: Gỗ công nghiệp PB chuẩn CARB-P2 (*), phần mặt hộc tủ được dán veneer gỗ tràm tự nhiên', '', 100, 1, '2024-08-14', '0000-00-00', '0000-00-00', 0, 19),
(31, 'Tủ Đầu Giuờng', 2990000, 'ProductsTủ Đầu Giuờng.jpg', 33, '', '', 100, 1, '2024-08-14', '0000-00-00', '0000-00-00', 1, 16),
(32, 'Tủ Quần Áo Gỗ 2 Cánh', 7490000, 'ProductsTủ Quần Áo Gỗ 2 Cánh.webp', 20, 'Kích thước: Dài 100cm x Rộng 60cm x Cao 2m1\r\nChất liệu:\r\nTủ quần áo VIENNA Tay Nắm:\r\n- Cánh tủ + Thân tủ: Gỗ công nghiệp MFC phủ Melamin chuẩn CARB-P2 (*)\r\n- Lưng tủ: Gỗ công nghiệp MDF phủ Melamin chuẩn CARB-P2 (*)\r\n- Thanh treo: Hợp kim nhôm, chống gỉ sét', '', 100, 1, '2024-08-14', '0000-00-00', '0000-00-00', 28, 17);

-- --------------------------------------------------------

--
-- Table structure for table `productsreview`
--

CREATE TABLE `productsreview` (
  `ID` int(11) NOT NULL,
  `ID_Product` int(11) NOT NULL,
  `ID_User` int(11) NOT NULL,
  `Rating` int(11) NOT NULL,
  `Review` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Passwords` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Image` text NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Role` int(11) NOT NULL,
  `Status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Username`, `Passwords`, `Name`, `Image`, `Phone`, `Email`, `Role`, `Status`) VALUES
(1, 'KhanhDuy', '8e29f59825c03785e4525c59e02ce4d8e09f81b3', 'Khánh Duy', 'Users1.jpg', '0123456789', 'duyle210425@gmail.com', 0, 0),
(2, 'KhanhDuy21', '8e29f59825c03785e4525c59e02ce4d8e09f81b3', 'Khánh Duy Lê Nguyễn', 'Users2.webp', '0123456787', 'duyle210420@gmail.com', 1, 0),
(4, 'Banana', '8e29f59825c03785e4525c59e02ce4d8e09f81b3', 'Chuối Không Báo', 'Users4.webp', '0123456788', 'duyle21042@gmail.com', 2, 0),
(5, 'tuann', '7c222fb2927d828af22f592134e8932480637c0d', 'Tuấn', 'Users5.webp', '0378233612', 'thanhtuan30032005@gmail.com', 2, 0),
(6, 'KhanhDuy2', '8e29f59825c03785e4525c59e02ce4d8e09f81b3', 'Khánh Duy Lê ', '', '123456785', 'duyle2104200@gmail.com', 2, 1),
(7, 'KhanhDuy56', '1a9a471a526656157d4573d26fef2eb819ab7dfe', 'Duy Khánh', 'Users7.webp', '987654321', 'Khanhduy@gmail.com', 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Product` (`ID_Product`),
  ADD KEY `ID_User` (`ID_User`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Product` (`ID_Product`),
  ADD KEY `Order_ID` (`Order_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Cat_id` (`Cat_ID`);

--
-- Indexes for table `productsreview`
--
ALTER TABLE `productsreview`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Product` (`ID_Product`),
  ADD KEY `ID_User` (`ID_User`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `productsreview`
--
ALTER TABLE `productsreview`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`ID_Product`) REFERENCES `products` (`ID`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`ID_User`) REFERENCES `users` (`ID`);

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`ID_Product`) REFERENCES `products` (`ID`),
  ADD CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`Order_ID`) REFERENCES `orders` (`ID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `Cat` FOREIGN KEY (`Cat_ID`) REFERENCES `categories` (`ID`),
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`Cat_id`) REFERENCES `categories` (`ID`);

--
-- Constraints for table `productsreview`
--
ALTER TABLE `productsreview`
  ADD CONSTRAINT `productsreview_ibfk_1` FOREIGN KEY (`ID_Product`) REFERENCES `products` (`ID`),
  ADD CONSTRAINT `productsreview_ibfk_2` FOREIGN KEY (`ID_User`) REFERENCES `users` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
