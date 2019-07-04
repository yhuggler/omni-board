-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 03, 2019 at 08:19 AM
-- Server version: 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `omni-board`
--

-- --------------------------------------------------------

--
-- Table structure for table `archived_cpu_readings`
--

CREATE TABLE `archived_cpu_readings` (
      `archived_cpu_reading_id` int(11) NOT NULL,
      `current_load` double NOT NULL,
      `current_clockspeed` double NOT NULL,
      `current_temp` double NOT NULL,
      `created_at` int(11) NOT NULL,
      `server_id_fk` int(10) NOT NULL
    
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `archived_system_stats`
--

CREATE TABLE `archived_system_stats` (
      `archived_system_stat_id` int(11) NOT NULL,
      `uptime` int(11) NOT NULL,
      `created_at` int(11) NOT NULL,
      `server_id` int(10) NOT NULL
    
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_keys`
--

CREATE TABLE `auth_keys` (
      `auth_key_id` int(11) NOT NULL,
      `auth_key` varchar(255) NOT NULL,
      `server_id` int(11) NOT NULL
    
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_keys`
--

INSERT INTO `auth_keys` (`auth_key_id`, `auth_key`, `server_id`) VALUES
(2, 'bfndnfghgfh', 2),
(3, '6a57a98f055d7c31a20bba287e3c92caf660276f89750373e6bf11892d06c654', 3),
(4, '8e1272cdfc9883a8c795efc1dd13e22ee444c4d45957577221c3aed07c32f761', 4);

-- --------------------------------------------------------

--
-- Table structure for table `cpu_information`
--

CREATE TABLE `cpu_information` (
      `cpu_information_id` int(11) NOT NULL,
      `server_id_fk` int(11) NOT NULL,
      `manufacturer` varchar(255) NOT NULL,
      `brand` varchar(255) NOT NULL,
      `speed_min` double NOT NULL,
      `speed_max` double NOT NULL,
      `cores` int(11) NOT NULL,
      `physical_cores` int(11) NOT NULL,
      `processors` int(11) NOT NULL,
      `socket` varchar(255) NOT NULL,
      `vendor` varchar(255) NOT NULL,
      `family` varchar(255) NOT NULL,
      `model` varchar(255) NOT NULL,
      `stepping` double NOT NULL,
      `revision` varchar(255) NOT NULL,
      `voltage` varchar(255) NOT NULL,
      `updated_at` int(11) NOT NULL
    
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cpu_readings`
--

CREATE TABLE `cpu_readings` (
      `cpu_reading_id` int(11) NOT NULL,
      `current_load` double NOT NULL,
      `current_clockspeed` double NOT NULL,
      `current_temp` double NOT NULL,
      `created_at` int(11) NOT NULL,
      `server_id_fk` int(10) NOT NULL
    
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hardware_information`
--

CREATE TABLE `hardware_information` (
      `hardware_information_id` int(11) NOT NULL,
      `server_id_fk` int(11) NOT NULL,
      `manufacturer` varchar(255) NOT NULL,
      `model` varchar(255) NOT NULL,
      `version` varchar(255) NOT NULL,
      `serial` varchar(255) NOT NULL,
      `uuid` varchar(255) NOT NULL,
      `sku` varchar(255) NOT NULL,
      `bios_vendor` varchar(255) NOT NULL,
      `bios_version` varchar(255) NOT NULL,
      `bios_release_date` varchar(255) NOT NULL,
      `bios_revision` varchar(64) NOT NULL,
      `updated_at` int(11) NOT NULL
    
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `operating_system_information`
--

CREATE TABLE `operating_system_information` (
      `operating_system_information_id` int(11) NOT NULL,
      `server_id_fk` int(11) NOT NULL,
      `platform` varchar(255) NOT NULL,
      `distro` varchar(255) NOT NULL,
      `os_release` varchar(255) NOT NULL,
      `codename` varchar(255) NOT NULL,
      `kernel` varchar(255) NOT NULL,
      `arch` varchar(255) NOT NULL,
      `hostname` varchar(255) NOT NULL,
      `codepage` varchar(255) NOT NULL,
      `logofile` varchar(255) NOT NULL,
      `serial` varchar(255) NOT NULL,
      `build` varchar(255) NOT NULL,
      `servicepack` varchar(255) NOT NULL,
      `updated_at` int(11) NOT NULL
    
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `servers`
--

CREATE TABLE `servers` (
      `server_id` int(11) NOT NULL,
      `friendly_name` varchar(255) NOT NULL,
      `description` varchar(255) NOT NULL
    
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `servers`
--

INSERT INTO `servers` (`server_id`, `friendly_name`, `description`) VALUES
(2, 'htr', 'htr'),
(3, '', ''),
(4, 'wfwefwe', 'this is a raspi');

-- --------------------------------------------------------

--
-- Table structure for table `system_stats`
--

CREATE TABLE `system_stats` (
      `system_stat_id` int(11) NOT NULL,
      `uptime` int(11) NOT NULL,
      `created_at` int(11) NOT NULL,
      `server_id` int(10) NOT NULL
    
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
      `id` int(11) NOT NULL,
      `username` varchar(255) NOT NULL,
      `password` varchar(255) NOT NULL,
      `role` int(11) NOT NULL DEFAULT '1'
    
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(2, 'admin', '$2y$10$8/w/.YscUCcb.XIOpd2PRuEaH3lIDr6no1BsQPXhX5fW29SepUvE.', 2),
(3, 'testadmin', '$2y$10$aTpcQczg2qYehx7DbjGXZu8r.eQBc3cC9REd/tLjOCPasy8Jhl0wS', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archived_cpu_readings`
--
ALTER TABLE `archived_cpu_readings`
  ADD PRIMARY KEY (`archived_cpu_reading_id`),
  ADD KEY `server_id_fk` (`server_id_fk`);

--
-- Indexes for table `archived_system_stats`
--
ALTER TABLE `archived_system_stats`
  ADD PRIMARY KEY (`archived_system_stat_id`),
  ADD KEY `server_id` (`server_id`);

--
-- Indexes for table `auth_keys`
--
ALTER TABLE `auth_keys`
  ADD PRIMARY KEY (`auth_key_id`),
  ADD UNIQUE KEY `auth_key` (`auth_key`),
  ADD KEY `server_id` (`server_id`);

--
-- Indexes for table `cpu_information`
--
ALTER TABLE `cpu_information`
  ADD PRIMARY KEY (`cpu_information_id`),
  ADD KEY `server_id_fk` (`server_id_fk`);

--
-- Indexes for table `cpu_readings`
--
ALTER TABLE `cpu_readings`
  ADD PRIMARY KEY (`cpu_reading_id`),
  ADD KEY `server_id_fk` (`server_id_fk`);

--
-- Indexes for table `hardware_information`
--
ALTER TABLE `hardware_information`
  ADD PRIMARY KEY (`hardware_information_id`),
  ADD KEY `server_id_fk` (`server_id_fk`);

--
-- Indexes for table `operating_system_information`
--
ALTER TABLE `operating_system_information`
  ADD PRIMARY KEY (`operating_system_information_id`),
  ADD KEY `server_id_fk` (`server_id_fk`);

--
-- Indexes for table `servers`
--
ALTER TABLE `servers`
  ADD PRIMARY KEY (`server_id`);

--
-- Indexes for table `system_stats`
--
ALTER TABLE `system_stats`
  ADD PRIMARY KEY (`system_stat_id`),
  ADD KEY `server_id` (`server_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archived_cpu_readings`
--
ALTER TABLE `archived_cpu_readings`
  MODIFY `archived_cpu_reading_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `archived_system_stats`
--
ALTER TABLE `archived_system_stats`
  MODIFY `archived_system_stat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_keys`
--
ALTER TABLE `auth_keys`
  MODIFY `auth_key_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cpu_information`
--
ALTER TABLE `cpu_information`
  MODIFY `cpu_information_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cpu_readings`
--
ALTER TABLE `cpu_readings`
  MODIFY `cpu_reading_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3291;

--
-- AUTO_INCREMENT for table `hardware_information`
--
ALTER TABLE `hardware_information`
  MODIFY `hardware_information_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `operating_system_information`
--
ALTER TABLE `operating_system_information`
  MODIFY `operating_system_information_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `servers`
--
ALTER TABLE `servers`
  MODIFY `server_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `system_stats`
--
ALTER TABLE `system_stats`
  MODIFY `system_stat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3291;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_keys`
--
ALTER TABLE `auth_keys`
  ADD CONSTRAINT `auth_keys_ibfk_1` FOREIGN KEY (`server_id`) REFERENCES `servers` (`server_id`) ON DELETE CASCADE;

--
-- Constraints for table `cpu_information`
--
ALTER TABLE `cpu_information`
  ADD CONSTRAINT `cpu_information_fk_server_id` FOREIGN KEY (`server_id_fk`) REFERENCES `servers` (`server_id`) ON DELETE CASCADE;

--
-- Constraints for table `cpu_readings`
--
ALTER TABLE `cpu_readings`
  ADD CONSTRAINT `server_id_fk` FOREIGN KEY (`server_id_fk`) REFERENCES `servers` (`server_id`) ON DELETE CASCADE;

--
-- Constraints for table `hardware_information`
--
ALTER TABLE `hardware_information`
  ADD CONSTRAINT `hardware_information_fk_server_id` FOREIGN KEY (`server_id_fk`) REFERENCES `servers` (`server_id`) ON DELETE CASCADE;

--
-- Constraints for table `operating_system_information`
--
ALTER TABLE `operating_system_information`
  ADD CONSTRAINT `os_info_fk_server_id` FOREIGN KEY (`server_id_fk`) REFERENCES `servers` (`server_id`) ON DELETE CASCADE;

--
-- Constraints for table `system_stats`
--
ALTER TABLE `system_stats`
  ADD CONSTRAINT `system_stats_fk1` FOREIGN KEY (`server_id`) REFERENCES `servers` (`server_id`) ON DELETE CASCADE;

