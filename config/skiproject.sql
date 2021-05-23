

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skiproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
    `company_name` varchar(50) COLLATE utf8mb4_danish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_danish_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_name`) VALUES
('skicomp');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
                            `employee_id` int(50) NOT NULL,
                            `company_name` varchar(50) COLLATE utf8mb4_danish_ci NOT NULL,
                            `name` varchar(50) COLLATE utf8mb4_danish_ci NOT NULL,
                            `department` varchar(50) COLLATE utf8mb4_danish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_danish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `franchise`
--

CREATE TABLE `franchise` (
                             `customer_id` int(50) NOT NULL,
                             `start_date` date NOT NULL,
                             `end_date` date NOT NULL,
                             `name` varchar(50) COLLATE utf8mb4_danish_ci NOT NULL,
                             `address` varchar(50) COLLATE utf8mb4_danish_ci NOT NULL,
                             `neg_price` double NOT NULL,
                             `info` text COLLATE utf8mb4_danish_ci NOT NULL,
                             `transporter_name` varchar(50) COLLATE utf8mb4_danish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_danish_ci;

--
-- Dumping data for table `franchise`
--

INSERT INTO `franchise` (`customer_id`, `start_date`, `end_date`, `name`, `address`, `neg_price`, `info`, `transporter_name`) VALUES
(1, '2021-05-22', '2021-05-31', 'name1', 'address1', 1.1, '', 'transporter1');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
                           `model` varchar(50) COLLATE utf8mb4_danish_ci NOT NULL,
                           `ski_type` varchar(50) COLLATE utf8mb4_danish_ci NOT NULL,
                           `company_name` varchar(50) COLLATE utf8mb4_danish_ci NOT NULL,
                           `temp` varchar(50) COLLATE utf8mb4_danish_ci NOT NULL,
                           `grip` varchar(50) COLLATE utf8mb4_danish_ci NOT NULL,
                           `size` int(50) NOT NULL,
                           `weight` int(50) NOT NULL,
                           `description` text COLLATE utf8mb4_danish_ci NOT NULL,
                           `historical` tinyint(1) NOT NULL,
                           `photo_url` varchar(50) COLLATE utf8mb4_danish_ci NOT NULL,
                           `msrp` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_danish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`model`, `ski_type`, `company_name`, `temp`, `grip`, `size`, `weight`, `description`, `historical`, `photo_url`, `msrp`) VALUES
('active', 'skate', 'skicomp', 'cold', 'wax', 20, 60, 'description', 0, 'url', 5.5),
('Active', 'skate', 'skicomp', 'cold', 'wax', 142, 30, 'test test', 0, '', 0),
('activeplus', 'skate', 'skicomp', 'cold', 'wax', 20, 60, 'description', 0, 'url', 65.5);

-- --------------------------------------------------------

--
-- Table structure for table `production_plan`
--

CREATE TABLE `production_plan` (
                                   `prod_plan_id` int(50) NOT NULL,
                                   `start_date` date NOT NULL,
                                   `end_date` date NOT NULL,
                                   `company_name` varchar(50) COLLATE utf8mb4_danish_ci NOT NULL,
                                   `ski_quantity` int(50) NOT NULL,
                                   `ski_type_quantity` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_danish_ci;

--
-- Dumping data for table `production_plan`
--

INSERT INTO `production_plan` (`prod_plan_id`, `start_date`, `end_date`, `company_name`, `ski_quantity`, `ski_type_quantity`) VALUES
(1, '2021-05-22', '2021-05-31', 'skicomp', 49, 49);

-- --------------------------------------------------------

--
-- Table structure for table `product_in_order`
--

CREATE TABLE `product_in_order` (
                                    `order_id` int(50) NOT NULL,
                                    `model` varchar(50) COLLATE utf8mb4_danish_ci NOT NULL,
                                    `ski_type` varchar(50) COLLATE utf8mb4_danish_ci NOT NULL,
                                    `size` int(50) NOT NULL,
                                    `weight` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_danish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipment`
--

CREATE TABLE `shipment` (
                            `shipment_id` int(50) NOT NULL,
                            `place_name` varchar(50) COLLATE utf8mb4_danish_ci NOT NULL,
                            `address` varchar(50) COLLATE utf8mb4_danish_ci NOT NULL,
                            `pickup_date` date NOT NULL,
                            `transporting_company` varchar(50) COLLATE utf8mb4_danish_ci NOT NULL,
                            `driver_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_danish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ski_order`
--

CREATE TABLE `ski_order` (
                             `order_id` int(50) NOT NULL,
                             `store_id` int(50) NOT NULL,
                             `franchise_id` int(50) NOT NULL,
                             `team_skier_id` int(50) NOT NULL,
                             `type` varchar(50) COLLATE utf8mb4_danish_ci NOT NULL,
                             `quantity` int(50) NOT NULL,
                             `order_state` varchar(50) COLLATE utf8mb4_danish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_danish_ci;

--
-- Dumping data for table `ski_order`
--

INSERT INTO `ski_order` (`order_id`, `store_id`, `franchise_id`, `team_skier_id`, `type`, `quantity`, `order_state`) VALUES
(1, 1, 1, 1, 'long', 50, 'open');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
                         `customer_id` int(50) NOT NULL,
                         `start_date` date NOT NULL,
                         `end_date` date NOT NULL,
                         `name` varchar(50) COLLATE utf8mb4_danish_ci NOT NULL,
                         `address` varchar(50) COLLATE utf8mb4_danish_ci NOT NULL,
                         `neg_price` double NOT NULL,
                         `transporter_name` varchar(50) COLLATE utf8mb4_danish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_danish_ci;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`customer_id`, `start_date`, `end_date`, `name`, `address`, `neg_price`, `transporter_name`) VALUES
(1, '2021-05-22', '2021-05-31', 'name1', 'address1', 1.1, 'transporter1');

-- --------------------------------------------------------

--
-- Table structure for table `team_skiers`
--

CREATE TABLE `team_skiers` (
                               `customer_id` int(50) NOT NULL,
                               `start_date` date NOT NULL,
                               `end_date` date NOT NULL,
                               `name` varchar(50) COLLATE utf8mb4_danish_ci NOT NULL,
                               `dob` date NOT NULL,
                               `club` varchar(50) COLLATE utf8mb4_danish_ci NOT NULL,
                               `ski_num` int(50) NOT NULL,
                               `transporter_name` varchar(50) COLLATE utf8mb4_danish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_danish_ci;

--
-- Dumping data for table `team_skiers`
--

INSERT INTO `team_skiers` (`customer_id`, `start_date`, `end_date`, `name`, `dob`, `club`, `ski_num`, `transporter_name`) VALUES
(1, '2021-05-22', '2021-05-31', 'team1', '1999-07-19', 'club1', 50, 'transporter1');

-- --------------------------------------------------------

--
-- Table structure for table `transporter`
--

CREATE TABLE `transporter` (
    `name` varchar(50) COLLATE utf8mb4_danish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_danish_ci;

--
-- Dumping data for table `transporter`
--

INSERT INTO `transporter` (`name`) VALUES
('transporter1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
    ADD PRIMARY KEY (`company_name`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
    ADD PRIMARY KEY (`employee_id`),
  ADD KEY `employee_fk` (`company_name`);

--
-- Indexes for table `franchise`
--
ALTER TABLE `franchise`
    ADD PRIMARY KEY (`customer_id`),
  ADD KEY `franchise_fk` (`transporter_name`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
    ADD PRIMARY KEY (`model`,`ski_type`,`size`,`weight`) USING BTREE,
  ADD KEY `product_fk` (`company_name`);

--
-- Indexes for table `production_plan`
--
ALTER TABLE `production_plan`
    ADD PRIMARY KEY (`prod_plan_id`),
  ADD KEY `production_plan_fk` (`company_name`);

--
-- Indexes for table `product_in_order`
--
ALTER TABLE `product_in_order`
    ADD PRIMARY KEY (`order_id`,`model`,`ski_type`,`size`,`weight`),
  ADD KEY `product_in_order_fk2` (`model`,`ski_type`,`size`,`weight`);

--
-- Indexes for table `shipment`
--
ALTER TABLE `shipment`
    ADD PRIMARY KEY (`shipment_id`),
  ADD KEY `shipment_fk` (`transporting_company`);

--
-- Indexes for table `ski_order`
--
ALTER TABLE `ski_order`
    ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_fk1` (`store_id`),
  ADD KEY `order_fk2` (`franchise_id`),
  ADD KEY `order_fk3` (`team_skier_id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
    ADD PRIMARY KEY (`customer_id`),
  ADD KEY `store_fk` (`transporter_name`);

--
-- Indexes for table `team_skiers`
--
ALTER TABLE `team_skiers`
    ADD PRIMARY KEY (`customer_id`),
  ADD KEY `team_skiers_fk` (`transporter_name`);

--
-- Indexes for table `transporter`
--
ALTER TABLE `transporter`
    ADD PRIMARY KEY (`name`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
    ADD CONSTRAINT `employee_fk` FOREIGN KEY (`company_name`) REFERENCES `company` (`company_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `franchise`
--
ALTER TABLE `franchise`
    ADD CONSTRAINT `franchise_fk` FOREIGN KEY (`transporter_name`) REFERENCES `transporter` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
    ADD CONSTRAINT `product_fk` FOREIGN KEY (`company_name`) REFERENCES `company` (`company_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `production_plan`
--
ALTER TABLE `production_plan`
    ADD CONSTRAINT `production_plan_fk` FOREIGN KEY (`company_name`) REFERENCES `company` (`company_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_in_order`
--
ALTER TABLE `product_in_order`
    ADD CONSTRAINT `product_in_order_fk1` FOREIGN KEY (`order_id`) REFERENCES `ski_order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_in_order_fk2` FOREIGN KEY (`model`,`ski_type`,`size`,`weight`) REFERENCES `product` (`model`, `ski_type`, `size`, `weight`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shipment`
--
ALTER TABLE `shipment`
    ADD CONSTRAINT `shipment_fk` FOREIGN KEY (`transporting_company`) REFERENCES `transporter` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ski_order`
--
ALTER TABLE `ski_order`
    ADD CONSTRAINT `order_fk1` FOREIGN KEY (`store_id`) REFERENCES `store` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_fk2` FOREIGN KEY (`franchise_id`) REFERENCES `franchise` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_fk3` FOREIGN KEY (`team_skier_id`) REFERENCES `team_skiers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `store`
--
ALTER TABLE `store`
    ADD CONSTRAINT `store_fk` FOREIGN KEY (`transporter_name`) REFERENCES `transporter` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `team_skiers`
--
ALTER TABLE `team_skiers`
    ADD CONSTRAINT `team_skiers_fk` FOREIGN KEY (`transporter_name`) REFERENCES `transporter` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
