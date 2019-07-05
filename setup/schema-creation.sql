-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 05, 2019 at 08:43 PM
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
(4, '8e1272cdfc9883a8c795efc1dd13e22ee444c4d45957577221c3aed07c32f761', 4),
(5, 'ce590d5752f1ff1b76672e3e44b800380696ec665c3cd67471b15af8aa6e55ca', 5),
(6, '2e1ca2ec1d5a38e8f490d08bd361052aac11d20c2c438b0c6451a815cd5bf70e', 6);

-- --------------------------------------------------------

--
-- Table structure for table `capabilities`
--

CREATE TABLE `capabilities` (
      `capability_id` int(11) NOT NULL,
      `capability` varchar(255) NOT NULL
    
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `capabilities`
--

INSERT INTO `capabilities` (`capability_id`, `capability`) VALUES
(24, 'ADD_CAPABILITY'),
(31, 'ADD_ROLE'),
(6, 'ADD_SERVER'),
(1, 'ADD_USER'),
(28, 'ASSIGN_CAPABILITY_TO_ROLE'),
(35, 'ASSIGN_USER_TO_ROLE'),
(15, 'DELETE_ARCHIVED_CPU_READINGS_BY_SERVER_ID'),
(20, 'DELETE_ARCHIVED_SYSTEM_STATS_BY_SERVER_ID'),
(27, 'DELETE_CAPABILITY'),
(14, 'DELETE_CPU_READINGS_BY_SERVER_ID'),
(34, 'DELETE_ROLE'),
(10, 'DELETE_SERVER'),
(22, 'DELETE_SYSTEM_INFORMATION_ENTRIES_BY_SERVER_ID'),
(19, 'DELETE_SYSTEM_STATS_BY_SERVER_ID'),
(4, 'DELETE_USER'),
(13, 'GET_ARCHIVED_CPU_READINGS_BY_SERVER_ID'),
(18, 'GET_ARCHIVED_SYSTEM_STATS_BY_SERVER_ID'),
(25, 'GET_CAPABILITIES'),
(11, 'GET_CPU_READINGS'),
(12, 'GET_CPU_READINGS_BY_SERVER_ID'),
(32, 'GET_ROLES'),
(29, 'GET_ROLES_WITH_CAPABILITIES'),
(36, 'GET_ROLES_WITH_CAPABILITIES_BY_USER_ID'),
(7, 'GET_SERVERS'),
(8, 'GET_SERVER_BY_ID'),
(21, 'GET_SYSTEM_INFORMATION_ENTRIES'),
(16, 'GET_SYSTEM_STATS'),
(17, 'GET_SYSTEM_STATS_BY_SERVER_ID'),
(2, 'GET_USERS'),
(30, 'REMOVE_CAPABILITY_FROM_ROLE'),
(37, 'REMOVE_USER_FROM_ROLE'),
(26, 'UPDATE_CAPABILITY'),
(33, 'UPDATE_ROLE'),
(9, 'UPDATE_SERVER'),
(3, 'UPDATE_USER');

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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
      `role_id` int(11) NOT NULL,
      `role_title` varchar(255) NOT NULL,
      `role_description` varchar(255) NOT NULL
    
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_title`, `role_description`) VALUES
(1, 'AUTHORIZED_USER', 'LOREM IPSUM'),
(2, 'ADMINISTRATOR', 'LOREM IPSUM'),
(3, 'SUPERUSER', 'LOREM IPSUM');

-- --------------------------------------------------------

--
-- Table structure for table `roles_capabilities`
--

CREATE TABLE `roles_capabilities` (
      `roles_capabilities_id` int(11) NOT NULL,
      `role_id` int(11) NOT NULL,
      `capability_id` int(11) NOT NULL
    
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles_capabilities`
--

INSERT INTO `roles_capabilities` (`roles_capabilities_id`, `role_id`, `capability_id`) VALUES
(6, 3, 1),
(7, 3, 2),
(8, 3, 3),
(9, 3, 4),
(11, 3, 6),
(12, 3, 7),
(13, 3, 8),
(14, 3, 9),
(15, 3, 10),
(16, 3, 11),
(17, 3, 12),
(18, 3, 13),
(19, 3, 14),
(20, 3, 15),
(21, 3, 16),
(22, 3, 17),
(23, 3, 18),
(24, 3, 19),
(25, 3, 20),
(26, 3, 21),
(27, 3, 22),
(29, 3, 24),
(30, 3, 25),
(31, 3, 26),
(32, 3, 27),
(33, 3, 28),
(34, 3, 29),
(35, 3, 30),
(36, 3, 31),
(37, 3, 32),
(38, 3, 33),
(39, 3, 34),
(40, 3, 35),
(41, 3, 36),
(42, 3, 37);

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
(4, 'wfwefwe', 'this is a raspi'),
(5, 'wfwefwe', 'this is a raspi'),
(6, 'wfwefwe', 'this is a raspi');

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

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
      `user_roles_id` int(11) NOT NULL,
      `user_id` int(11) NOT NULL,
      `role_id` int(11) NOT NULL
    
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_roles_id`, `user_id`, `role_id`) VALUES
(5, 2, 3);

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
-- Indexes for table `capabilities`
--
ALTER TABLE `capabilities`
  ADD PRIMARY KEY (`capability_id`),
  ADD UNIQUE KEY `capability` (`capability`);

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
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `roles_capabilities`
--
ALTER TABLE `roles_capabilities`
  ADD PRIMARY KEY (`roles_capabilities_id`),
  ADD KEY `roles_id` (`role_id`),
  ADD KEY `capabilities_id` (`capability_id`);

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
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_roles_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `roles_id` (`role_id`);

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
  MODIFY `auth_key_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `capabilities`
--
ALTER TABLE `capabilities`
  MODIFY `capability_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `cpu_information`
--
ALTER TABLE `cpu_information`
  MODIFY `cpu_information_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cpu_readings`
--
ALTER TABLE `cpu_readings`
  MODIFY `cpu_reading_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hardware_information`
--
ALTER TABLE `hardware_information`
  MODIFY `hardware_information_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `operating_system_information`
--
ALTER TABLE `operating_system_information`
  MODIFY `operating_system_information_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles_capabilities`
--
ALTER TABLE `roles_capabilities`
  MODIFY `roles_capabilities_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `servers`
--
ALTER TABLE `servers`
  MODIFY `server_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `system_stats`
--
ALTER TABLE `system_stats`
  MODIFY `system_stat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `user_roles_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- Constraints for table `roles_capabilities`
--
ALTER TABLE `roles_capabilities`
  ADD CONSTRAINT `roles_capabilities_fk_capabilities_id` FOREIGN KEY (`capability_id`) REFERENCES `capabilities` (`capability_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `roles_capabilities_fk_roles_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE;

--
-- Constraints for table `system_stats`
--
ALTER TABLE `system_stats`
  ADD CONSTRAINT `system_stats_fk1` FOREIGN KEY (`server_id`) REFERENCES `servers` (`server_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_fk_roles_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`),
  ADD CONSTRAINT `user_roles_fk_user_od` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

