-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2024 at 08:24 PM
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
-- Database: `librarydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `publishing_year` int(11) DEFAULT NULL,
  `total_copies` int(11) DEFAULT 1,
  `loaned_copies` int(11) DEFAULT 0,
  `available_copies` int(11) GENERATED ALWAYS AS (`total_copies` - `loaned_copies`) STORED,
  `sid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author`, `publishing_year`, `total_copies`, `loaned_copies`, `sid`) VALUES
(1, 'Engineering Mechanics: Dynamics', 'J.L. Meriam', 2015, 10, 2, 101),
(2, 'Fundamentals of Thermodynamics', 'Richard E. Sonntag', 2018, 5, 1, 102),
(3, 'Control Systems Engineering', 'Nise', 2019, 7, 3, 103),
(4, 'Introduction to Electrical Engineering', 'M. H. Rashid', 2016, 8, 0, 104),
(5, 'Engineering Fluid Mechanics', 'Clayton T. Crowe', 2020, 6, 2, 105),
(6, 'Computer Networking: A Top-Down Approach', 'James Kurose', 2021, 10, 2, 106),
(7, 'Introduction to Robotics: Mechanics and Control', 'John J. Craig', 2019, 7, 3, 107),
(8, 'Fundamentals of Electric Circuits', 'Alexander & Sadiku', 2020, 9, 4, 108),
(9, 'Design of Concrete Structures', 'Arthur H. Nilson', 2016, 8, 1, 109),
(10, 'Introduction to Chemical Engineering', 'Warren McCabe', 2018, 6, 0, 110),
(11, 'Software Engineering', 'Ian Sommerville', 2020, 12, 3, 111),
(12, 'Engineering Economy', 'Leland Blank', 2017, 5, 2, 112),
(13, 'Digital Signal Processing', 'John G. Proakis', 2021, 10, 5, 113),
(14, 'Engineering Mechanics: Statics', 'J.L. Meriam', 2018, 11, 2, 114),
(15, 'Microelectronic Circuits', 'Adel S. Sedra', 2019, 4, 0, 115),
(16, 'Engineering Mechanics: Dynamics', 'J.L. Meriam', 2015, 10, 2, 1),
(17, 'Fundamentals of Thermodynamics', 'Richard E. Sonntag', 2018, 5, 1, 2),
(18, 'Control Systems Engineering', 'Nise', 2019, 7, 3, 3),
(19, 'Introduction to Electrical Engineering', 'M. H. Rashid', 2016, 8, 0, 4),
(20, 'Engineering Fluid Mechanics', 'Clayton T. Crowe', 2020, 6, 2, 5),
(21, 'Introduction to Computer Engineering', 'M. Morris Mano', 2017, 12, 4, 6),
(22, 'Mechanical Engineering Design', 'Joseph Shigley', 2014, 4, 1, 7),
(23, 'Engineering Statistics', 'D. C. Montgomery', 2019, 3, 1, 8),
(24, 'Materials Science and Engineering', 'William D. Callister', 2015, 9, 0, 9),
(25, 'Digital Logic Design', 'M. Morris Mano', 2018, 5, 1, 10),
(26, 'Computer Networking: A Top-Down Approach', 'James Kurose', 2021, 10, 2, 11),
(27, 'Introduction to Robotics: Mechanics and Control', 'John J. Craig', 2019, 7, 3, 12),
(28, 'Fundamentals of Electric Circuits', 'Alexander & Sadiku', 2020, 9, 4, 13),
(29, 'Design of Concrete Structures', 'Arthur H. Nilson', 2016, 8, 1, 14),
(30, 'Introduction to Chemical Engineering', 'Warren McCabe', 2018, 6, 0, 15),
(31, 'Software Engineering', 'Ian Sommerville', 2020, 12, 3, 16),
(32, 'Engineering Economy', 'Leland Blank', 2017, 5, 2, 17),
(33, 'Digital Signal Processing', 'John G. Proakis', 2021, 10, 5, 18),
(34, 'Engineering Mechanics: Statics', 'J.L. Meriam', 2018, 11, 2, 19),
(35, 'Microelectronic Circuits', 'Adel S. Sedra', 2019, 4, 0, 20),
(36, 'Introduction to Environmental Engineering', 'G. J. P. R. Rao', 2020, 7, 3, 21),
(37, 'Algorithms for Optimization', 'Zhongjie Shen', 2018, 6, 1, 22),
(38, 'Digital Communication', 'John G. Proakis', 2019, 8, 2, 23),
(39, 'Engineering Mechanics: Dynamics', 'J. L. Meriam', 2021, 12, 4, 24),
(40, 'Theory of Structures', 'H. P. Gupta', 2016, 5, 0, 25),
(41, 'Introduction to Fluid Mechanics', 'Robert W. Fox', 2021, 10, 2, 26),
(42, 'Engineering Ethics: Concepts and Cases in Engineering', 'Charles E. Harris', 2018, 9, 1, 27),
(43, 'Computer-Aided Design of Microelectronic Circuits', 'D. A. Neamen', 2019, 4, 0, 28),
(44, 'Introduction to Geotechnical Engineering', 'B. M. Das', 2020, 6, 3, 29),
(45, 'Civil Engineering Materials', 'J. F. Young', 2017, 7, 2, 30),
(46, 'Structural Analysis', 'R. C. Hibbeler', 2018, 5, 1, 31),
(47, 'Introduction to Systems Engineering', 'H. T. Papalambros', 2019, 8, 0, 32),
(48, 'Engineering Mechanics: Statics', 'J.L. Meriam', 2021, 12, 3, 33),
(49, 'Mechanical Vibrations', 'S. S. Rao', 2020, 11, 4, 34),
(50, 'Computer Vision: Algorithms and Applications', 'Richard Szeliski', 2021, 10, 5, 35),
(51, 'Advanced Engineering Mathematics', 'Erwin Kreyszig', 2021, 10, 5, 36),
(52, 'Introduction to Wireless Communications', 'Mischa Schwartz', 2019, 7, 2, 37),
(53, 'Principles of Engineering Economic Analysis', 'Charles S. Tapiero', 2018, 8, 1, 38),
(54, 'Engineering Design', 'G. K. L. T. L. Asaka', 2017, 5, 0, 39),
(55, 'Introduction to Electrical Engineering', 'G. R. Slemon', 2020, 6, 2, 40),
(56, 'Embedded Systems: Real-Time Interfacing to ARM Cortex-M3', 'Jonathan Valvano', 2018, 9, 3, 41),
(57, 'Advanced Mechanics of Materials', 'B. B. M. R. M. B. A. J. P. J. A. R. C. H. K. F. P. L. H. A. K. B. A. K. L. K. B. B.', 2019, 4, 1, 42),
(58, 'Fundamentals of Semiconductor Manufacturing and Process Control', 'S. T. Wu', 2021, 8, 2, 43),
(59, 'Finite Element Method: Theory and Applications with ANSYS', 'G. R. Liu', 2020, 10, 3, 44),
(60, 'Robotics: Control, Sensing, Vision, and Intelligence', 'R. B. R. C. H. M. J. H. P. A. R. C.', 2019, 7, 2, 45),
(61, 'Design of Fluid Thermal Systems', 'G. P. K. S. B. A. B. K. C. J. S. S.', 2021, 9, 0, 46),
(62, 'Hydrology and Water Resources Engineering', 'R. K. D. D. S. J. R.', 2018, 6, 1, 47),
(63, 'Optics', 'Eugene Hecht', 2019, 4, 2, 48),
(64, 'Signals and Systems', 'Alan V. Oppenheim', 2020, 10, 5, 49),
(65, 'Project Management: A Systems Approach to Planning, Scheduling, and Controlling', 'Harold Kerzner', 2021, 12, 3, 50);

-- --------------------------------------------------------

--
-- Table structure for table `borrowed_books`
--

CREATE TABLE `borrowed_books` (
  `transaction_id` int(11) NOT NULL,
  `borrower_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `book_title` varchar(255) DEFAULT NULL,
  `number_of_books` int(11) DEFAULT 1,
  `borrow_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `borrower`
--

CREATE TABLE `borrower` (
  `id` int(11) NOT NULL,
  `borrower_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_of_books_borrowed` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `borrowers`
--

CREATE TABLE `borrowers` (
  `id` int(11) NOT NULL,
  `borrower_name` varchar(255) NOT NULL,
  `borrower_email` varchar(255) NOT NULL,
  `pass` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowers`
--

INSERT INTO `borrowers` (`id`, `borrower_name`, `borrower_email`, `pass`) VALUES
(1, 'John Doe', 'john.doe@example.com', NULL),
(2, 'krishna', 'kgandhewar@gmail.com', '12345'),
(13, 'John Doe', 'john.doe@exple.com', 'password123'),
(14, 'Jane Smith', 'jane.smith@example.com', 'securepass456'),
(15, 'Alice Johnson', 'alice.johnson@exmple.com', 'mypassword789'),
(16, 'Bob Brown', 'bob.brown@example.com', 'qwerty123'),
(17, 'Charlie Davis', 'charlie.davis@emple.com', 'password!234'),
(18, 'Diana Prince', 'diana.prince@examle.com', 'letmein456'),
(19, 'Ethan Hunt', 'ethan.hunt@example.com', 'topsecret789'),
(20, 'Fiona Gallagher', 'fiona.gallagher@example.com', 'password1234'),
(21, 'George Clooney', 'george.clooney@example.com', 'hollywood456'),
(22, 'Hannah Montana', 'hannah.montana@example.com', 'bestofbothworlds');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int(11) NOT NULL,
  `borrower_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `borrow_date` date NOT NULL,
  `return_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `borrower_id`, `book_id`, `borrow_date`, `return_date`) VALUES
(1, 1, 1, '2024-01-15', NULL),
(2, 2, 2, '2024-02-10', '2024-02-20'),
(3, 2, 32, '2024-10-25', NULL),
(4, 2, 32, '2024-10-25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`id`, `email`, `password`) VALUES
(1, 'krishna@gmailcom', '12345'),
(2, 'manager2@example.com', '123456'),
(3, 'manager3@example.com', '$2y$10$WqgKgj8H3DS3Xiw9XqGtDu1VS1OwSbU9fr0Fr08ToVBo4GIz4T8Pe'),
(4, 'kgandhewar9040@gmail.com', '$2y$10$1RFmwpPIoaCxW4IWX96whuUCyl3txLpilbquPxuc4GS4VlaUGWfIq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD UNIQUE KEY `unique_sid` (`sid`);

--
-- Indexes for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `borrower_id` (`borrower_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `borrower`
--
ALTER TABLE `borrower`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `borrowers`
--
ALTER TABLE `borrowers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `borrower_email` (`borrower_email`),
  ADD UNIQUE KEY `pass` (`pass`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `borrower_id` (`borrower_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `borrower`
--
ALTER TABLE `borrower`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `borrowers`
--
ALTER TABLE `borrowers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  ADD CONSTRAINT `borrowed_books_ibfk_1` FOREIGN KEY (`borrower_id`) REFERENCES `borrower` (`id`),
  ADD CONSTRAINT `borrowed_books_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_ibfk_1` FOREIGN KEY (`borrower_id`) REFERENCES `borrowers` (`id`),
  ADD CONSTRAINT `loans_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
