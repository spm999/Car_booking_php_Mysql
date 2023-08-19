CREATE TABLE `agency` (
  `agencyid` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `agencyname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
);

--
-- Dumping data for table `agency`
--

INSERT INTO `agency` (`agencyid`, `name`, `email`, `agencyname`, `password`) VALUES
(1, 'hgjghj', 'hgfhhgfhjgh@trttr', 'trytry', 'yrtytryr'),
(2, 'spmhot', 'mshari7185@gmail.com', 'spmhot', 'spmhot'),
(3, 'qwe', 'qwe@qwe', 'qwe', 'qwe'),
(4, 'asd', 'asd@asd', 'asd', 'asd'),
(15, '15', '15', '15', '15');

-- --------------------------------------------------------

--
-- Table structure for table `bookedcar`
--

CREATE TABLE `bookedcar` (
  `userid` varchar(255) DEFAULT NULL,
  `agencyid` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `carId` varchar(255) NOT NULL,
  `num_days` varchar(255) NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `vehiclemodel` varchar(255) DEFAULT NULL,
  `vehicleno` varchar(255) DEFAULT NULL,
  `seatingcapacity` int(255) DEFAULT NULL,
  `rentperday` int(255) DEFAULT NULL
); 

--
-- Dumping data for table `bookedcar`
--

INSERT INTO `bookedcar` (`userid`, `agencyid`, `username`, `name`, `carId`, `num_days`, `start_date`, `vehiclemodel`, `vehicleno`, `seatingcapacity`, `rentperday`) VALUES
('6', 3, 'as', 'as', '42', '1', '2023-08-02', 'as2', '222', 2222, 22222),
('2', 4, 'surya', 'surya', '44', '1', '2023-08-09', '324', '4234', 423423, 43242),
('1', 15, 'spm999', 'spm999', '47', '1', '2023-08-29', '888', '888', 888, 888);

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `agencyid` int(255) NOT NULL,
  `carId` int(255) NOT NULL,
  `vehiclemodel` varchar(255) NOT NULL,
  `vehicleno` int(255) NOT NULL,
  `seatingcapacity` int(255) NOT NULL,
  `rentperday` int(255) NOT NULL
); 

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`agencyid`, `carId`, `vehiclemodel`, `vehicleno`, `seatingcapacity`, `rentperday`) VALUES
(3, 42, 'as2', 222, 2222, 22222),
(15, 47, '888', 888, 888, 888);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
); 

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `name`, `email`, `username`, `password`) VALUES
(1, 'spm999', 'msurya9701@gmail.com', 'spm999', 'spm999'),
(2, 'surya', 'mbrrkn@gmail.com', 'surya', 'surya'),
(3, 'saurabh', 'msurya9701@gmail.com', 'saurabh', '123456'),
(4, 'qw', 'qw@qw', 'qw', 'qw'),
(5, '12', '12@12', '12', '12'),
(6, 'as', 'as@as', 'as', 'as');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agency`
--
ALTER TABLE `agency`
  ADD PRIMARY KEY (`agencyid`),
  ADD UNIQUE KEY `agencyname` (`agencyname`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `bookedcar`
--
ALTER TABLE `bookedcar`
  ADD PRIMARY KEY (`carId`),
  ADD UNIQUE KEY `carId` (`carId`),
  ADD UNIQUE KEY `vehicleno` (`vehicleno`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`carId`),
  ADD UNIQUE KEY `vehicleno` (`vehicleno`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agency`
--
ALTER TABLE `agency`
  MODIFY `agencyid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `carId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;