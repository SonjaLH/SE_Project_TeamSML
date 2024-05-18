-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2024 at 04:09 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cardb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin`
(
    `user_id` int(11) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`)
VALUES (17);

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car`
(
    `car_id`        int(11)                                    NOT NULL,
    `owner_id`      int(11)        DEFAULT NULL,
    `make`          varchar(50)    DEFAULT NULL,
    `model`         varchar(50)    DEFAULT NULL,
    `year`          int(11)        DEFAULT NULL,
    `color`         varchar(50)    DEFAULT NULL,
    `mileage`       int(11)        DEFAULT NULL,
    `price_per_day` decimal(10, 2) DEFAULT NULL,
    `available`     tinyint(1)     DEFAULT NULL,
    `type`          enum ('sedan','suv','coupe','van','sport') NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`car_id`, `owner_id`, `make`, `model`, `year`, `color`, `mileage`, `price_per_day`, `available`,
                   `type`)
VALUES (1, NULL, 'Mercedes', 'c300', 2015, 'black', 19000, 49.00, 1, 'sedan'),
       (2, NULL, 'Mercedes', 'amg', 2020, 'yellow', 19663, 125.00, 1, 'sedan');

-- --------------------------------------------------------

--
-- Table structure for table `carimg`
--

CREATE TABLE `carimg`
(
    `image_id`  int(11) NOT NULL,
    `car_id`    int(11)      DEFAULT NULL,
    `image_url` varchar(255) DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carowner`
--

CREATE TABLE `carowner`
(
    `user_id`      int(11) NOT NULL,
    `phone_number` varchar(20)  DEFAULT NULL,
    `address`      varchar(255) DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carreview`
--

CREATE TABLE `carreview`
(
    `review_id`   int(11) NOT NULL,
    `car_id`      int(11) DEFAULT NULL,
    `customer_id` int(11) DEFAULT NULL,
    `rating`      int(11) DEFAULT NULL,
    `review_text` text    DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer`
(
    `user_id`      int(11) NOT NULL,
    `phone_number` varchar(20)  DEFAULT NULL,
    `address`      varchar(255) DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`user_id`, `phone_number`, `address`)
VALUES (6, '0355699199110', 'dr1'),
       (7, '0699199110', 'Dr'),
       (8, '0699199110', 'Dr'),
       (9, '0699199110', 'Dr'),
       (10, '0699199110', 'Dr'),
       (11, '0699199110', 'Dr'),
       (12, '0699199110', 'Dr'),
       (16, '0699199110', 'Dr');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment`
(
    `payment_id`     int(11) NOT NULL,
    `reservation_id` int(11)        DEFAULT NULL,
    `payment_date`   date           DEFAULT NULL,
    `amount`         decimal(10, 2) DEFAULT NULL,
    `payment_method` varchar(50)    DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation`
(
    `reservation_id` int(11) NOT NULL,
    `car_id`         int(11)        DEFAULT NULL,
    `customer_id`    int(11)        DEFAULT NULL,
    `start_date`     date           DEFAULT NULL,
    `end_date`       date           DEFAULT NULL,
    `total_cost`     decimal(10, 2) DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user`
(
    `user_id`    int(11)            NOT NULL,
    `username`   varchar(50)  DEFAULT NULL,
    `password`   varchar(100) DEFAULT NULL,
    `first_name` varchar(50)  DEFAULT NULL,
    `last_name`  varchar(50)  DEFAULT NULL,
    `email`      varchar(100) DEFAULT NULL,
    `user_type`  enum ('a','o','c') NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `first_name`, `last_name`, `email`, `user_type`)
VALUES (5, '12', '$2y$10$ZIqW4WPh.Q3ZCmPQ6u4Hd.ySUD57QPaX4h.WtElMT4Oy12ZayoXay', 'Thanas Ruci', '21',
        'stefanruci@hotmail.com', 'c'),
       (6, 'u1', '$2y$10$o/TtNGbo9eYq3ewa3lWHae5ypwm5BF2tHcRwV820advWdU/33XsHO', 'n1', 's1', 'ronaldoruci56@gmail.com',
        'c'),
       (7, 'c2', '$2y$10$qI3R8o89Wm.jCdDk.brRJubmJlXD/ga3rCf1ApUdF6c5U.TtVdJTO', 'c2', 'c23', 'c2@hotmail.com', 'c'),
       (8, 'c3', '$2y$10$yEyfX.qnfRUDHI3fe1dfpucbUpPuUf69JaDoE0Gcf5PW1J67Wl.XS', 'c3', 'c3', 'c3@hotmail.com', 'c'),
       (9, 'c4', '$2y$10$vKHNqDL6oIJ6PEiac/108eL6pjL59lBk5QGFEl9V0v35KcbgaeWJK', 'c4', 'c4', 'c4@hotmail.com', 'c'),
       (10, 'c5', '$2y$10$9/y1W/nTBikVwGmcOwMGFuGe4QS..WH4E9DaUYcUKtWYLHS9.HSra', 'c5', 'c5', 'c45@hotmail.com', 'c'),
       (11, 'x6', '$2y$10$7meGO5DtNLhDLdst1G9zFeN2z5iC2m95F7er7EqsoWUExOsnsUwNi', 'x6', 'x6', 'x6@hotmail.com', 'c'),
       (12, 'xczx', '$2y$10$fInABZ89.oCcKkMLLwnf9O5KMHCPx8G5/5Mc.4izGoQyzl2KfAPk2', 'xc', 'zxczx', 'xzcz@hotmail.com',
        'c'),
       (16, 'xczxdsf', '$2y$10$.tsHwxj1UC7nyy1IQOTWwuPnuoT9N9rnhIxmGq0HSHCae2Dh6Ii2S', 'xcdfsd', 'zxczx',
        'sa@hotmail.com', 'c'),
       (17, 'admin_username', '$2y$10$.tsHwxj1UC7nyy1IQOTWwuPnuoT9N9rnhIxmGq0HSHCae2Dh6Ii2S', 'AdminFirstName',
        'AdminLastName', 'admin@crs.com', 'a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
    ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `car`
--
ALTER TABLE `car`
    ADD PRIMARY KEY (`car_id`),
    ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `carimg`
--
ALTER TABLE `carimg`
    ADD PRIMARY KEY (`image_id`),
    ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `carowner`
--
ALTER TABLE `carowner`
    ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `carreview`
--
ALTER TABLE `carreview`
    ADD PRIMARY KEY (`review_id`),
    ADD KEY `car_id` (`car_id`),
    ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
    ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
    ADD PRIMARY KEY (`payment_id`),
    ADD KEY `reservation_id` (`reservation_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
    ADD PRIMARY KEY (`reservation_id`),
    ADD KEY `car_id` (`car_id`),
    ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
    ADD PRIMARY KEY (`user_id`),
    ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
    MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 3;

--
-- AUTO_INCREMENT for table `carimg`
--
ALTER TABLE `carimg`
    MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carreview`
--
ALTER TABLE `carreview`
    MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
    MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
    MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
    MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
    ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `car`
--
ALTER TABLE `car`
    ADD CONSTRAINT `car_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `carowner` (`user_id`);

--
-- Constraints for table `carimg`
--
ALTER TABLE `carimg`
    ADD CONSTRAINT `carimg_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `car` (`car_id`);

--
-- Constraints for table `carowner`
--
ALTER TABLE `carowner`
    ADD CONSTRAINT `carowner_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `carreview`
--
ALTER TABLE `carreview`
    ADD CONSTRAINT `carreview_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `car` (`car_id`),
    ADD CONSTRAINT `carreview_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`user_id`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
    ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
    ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`reservation_id`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
    ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `car` (`car_id`),
    ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
