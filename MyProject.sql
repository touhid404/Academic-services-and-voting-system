-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 27, 2025 at 06:18 AM
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
-- Database: `MyProject`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(20) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `username`, `fullname`, `password`, `profile_pic`) VALUES
(3, 'admin@gmail.com', 'admin', 'admin', '$2y$10$r5JSK44vr84gR5nYNeYPg.Uf/ekHpBQOhsiyMH6Z9YD/qGC57Oswm', 'pic.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(100) NOT NULL,
  `booking_id` varchar(255) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `route_id` varchar(255) NOT NULL,
  `booked_seat` varchar(100) NOT NULL,
  `booking_created` date NOT NULL DEFAULT current_timestamp(),
  `booking_time` time NOT NULL DEFAULT current_timestamp(),
  `session_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `booking_id`, `student_id`, `route_id`, `booked_seat`, `booking_created`, `booking_time`, `session_name`) VALUES
(246, 'JZ7TX', '0112230431', 'ROUTE 01', '3', '2025-01-27', '08:47:02', 'Special session'),
(247, 'P13TE', '0112230445', 'ROUTE 01', '46', '2025-01-27', '08:47:44', 'Special session'),
(248, 'T7MRQ', '0112230447', 'ROUTE 01', '26', '2025-01-27', '08:48:25', 'Special session');

-- --------------------------------------------------------

--
-- Table structure for table `booking_session`
--

CREATE TABLE `booking_session` (
  `id` int(11) NOT NULL,
  `session_name` varchar(100) NOT NULL,
  `starting_time` time NOT NULL,
  `ending_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_session`
--

INSERT INTO `booking_session` (`id`, `session_name`, `starting_time`, `ending_time`) VALUES
(40, 'MORNING', '21:00:00', '23:30:00'),
(42, 'EVENING', '15:00:00', '16:15:00'),
(44, 'Special session', '08:45:00', '13:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `bus_routine`
--

CREATE TABLE `bus_routine` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `notice` varchar(1000) NOT NULL DEFAULT 'Hello'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus_routine`
--

INSERT INTO `bus_routine` (`id`, `date`, `notice`) VALUES
(64, '2025-01-21', 'Regular day'),
(65, '2025-01-22', 'Regular day'),
(66, '2025-01-25', 'Regular day'),
(67, '2025-01-26', 'Regular day'),
(68, '2025-01-28', 'Regular day'),
(69, '2025-01-29', 'Regular day'),
(72, '2025-01-23', 'Regular day'),
(73, '2025-01-24', 'Regular day'),
(76, '2025-01-29', 'Regular day'),
(78, '2025-01-27', 'On the occasion of the project show of Department of EEE and CSE on January 27, 2025 (Monday), UIU will provide transportation service to all the participant students. In view of this, UIU transports will run on regular routes, which will start from the pickup points at usual time and leave UIU at 04:40 PM. Please note that no bus will be available at 02:20 PM to leave UIU.');

-- --------------------------------------------------------

--
-- Table structure for table `candidate_data`
--

CREATE TABLE `candidate_data` (
  `candidateId` varchar(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `titleOfVote` varchar(100) NOT NULL,
  `voteCount` int(11) DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0 for pending, 1 for reject , 2 for approve'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidate_data`
--

INSERT INTO `candidate_data` (`candidateId`, `name`, `titleOfVote`, `voteCount`, `status`) VALUES
('0112230431', 'Fariha Hriti', 'UIU App Forum President Election 2025', 2, 2),
('0112230435', 'Riyadh T', 'Jr. Executive of HR', 0, 2),
('0112230435', 'Riyadh T', 'UIU App Forum President Election 2025', 1, 2),
('0112230435', 'Riyadh T', 'Vice President', 0, 2),
('0112230445', 'Ifty', 'UIU App Forum President Election 2025', 1, 2),
('0112230445', 'Ifty', 'Vice President', 0, 2),
('0112230447', 'Toma', 'UIU App Forum President Election 2025', 0, 2),
('0112230447', 'Toma', 'Vice President', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `course_table`
--

CREATE TABLE `course_table` (
  `id` int(11) NOT NULL,
  `CourseCode` varchar(20) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `credits` int(11) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_table`
--

INSERT INTO `course_table` (`id`, `CourseCode`, `course_name`, `credits`) VALUES
(1, 'ENG 1011', 'English – I', 3),
(2, 'BDS 1201', 'History of the Emergence of Bangladesh', 3),
(3, 'CSE 1110', 'Introduction to Computer Systems', 3),
(4, 'CSE 2213', 'Discrete Mathematics', 3),
(5, 'ENG 1013', 'English – II', 3),
(6, 'CSE 1111', 'Structured Programming Language', 3),
(7, 'CSE 1112', 'Structured Programming Language Laboratory', 3),
(8, 'MATH 1151', 'Fundamental Calculus', 3),
(9, 'MATH 2183', 'Calculus and Linear Algebra', 3),
(10, 'CSE 1325', 'Digital Logic Design', 3),
(11, 'CSE 1326', 'Digital Logic Design Laboratory', 3),
(12, 'CSE 1115', 'Object Oriented Programming', 3),
(13, 'CSE 1116', 'Object Oriented Programming Laboratory', 3),
(14, 'MATH 2201', 'Coordinate Geometry and Vector Analysis', 3),
(15, 'PHY 2105', 'Physics', 3),
(16, 'PHY 2106', 'Physics Laboratory', 3),
(17, 'CSE 2118', 'Advanced Object Oriented Programming laboratory', 3),
(18, 'EEE 2113', 'Electrical Circuits', 3),
(19, 'MATH 2205', 'Probability and Statistics', 3),
(20, 'SOC 2101', 'Society, Environment and Engineering Ethics', 3),
(21, 'CSE 2215', 'Data Structure and Algorithms – I', 3),
(22, 'CSE 2216', 'Data Structure and Algorithms – I Laboratory', 3),
(23, 'CSE 2233', 'Theory of Computation', 3);

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL,
  `studentId` varchar(200) NOT NULL,
  `topic` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `ftime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `studentId`, `topic`, `description`, `ftime`) VALUES
(1, '0112230435', 'Previous qs', 'Very helpfull', '2025-01-26 19:19:56'),
(4, '0112230435', 'Vote', 'nice voting system', '2025-01-26 23:05:42'),
(5, '0112230435', 'Vote', 'nice voting system ', '2025-01-26 23:22:58'),
(6, '0112230431', 'dashboard ', 'nice dashboard design', '2025-01-27 10:33:19');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `FileName` varchar(500) NOT NULL,
  `FilePath` varchar(500) NOT NULL,
  `FolderName` varchar(255) NOT NULL,
  `Uptime` timestamp NOT NULL DEFAULT current_timestamp(),
  `UploaderId` varchar(20) NOT NULL,
  `Approve` varchar(20) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `FileName`, `FilePath`, `FolderName`, `Uptime`, `UploaderId`, `Approve`) VALUES
(112, 'Final_Exam_Question_241_CSE3811_B_MTR.pdf', 'uploads/ENG 1011/Mid-TermQuestions/Final_Exam_Question_241_CSE3811_B_MTR.pdf', 'ENG 1011/Mid-TermQuestions', '2025-01-26 14:34:42', '0112230435', 'yes'),
(114, 'CSE1111_Final_233.pdf', 'uploads/CSE 1111/FinalQuestions/CSE1111_Final_233.pdf', 'CSE 1111/FinalQuestions', '2025-01-27 03:15:26', '0112230435', 'yes'),
(115, 'CSE1111_Final_232.pdf', 'uploads/CSE 1111/FinalQuestions/CSE1111_Final_232.pdf', 'CSE 1111/FinalQuestions', '2025-01-27 03:16:17', '0112230435', 'yes'),
(116, 'CSE1111_Final_231.pdf', 'uploads/CSE 1111/FinalQuestions/CSE1111_Final_231.pdf', 'CSE 1111/FinalQuestions', '2025-01-27 03:16:35', '0112230435', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` varchar(20) NOT NULL,
  `outgoing_msg_id` varchar(20) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`, `time`) VALUES
(94, '112230435', '112230447', 'pKE=', '2025-01-26 22:53:16'),
(95, '112230435', '112230447', 'pK2mLNL1', '2025-01-26 22:53:18'),
(96, '112230447', '112230435', 'pKE=', '2025-01-26 22:53:36'),
(97, '112230447', '112230435', 'pKe9YNynG05RpXnW', '2025-01-26 22:53:43'),
(98, '112230435', '112230431', 'hIE=', '2025-01-26 23:20:26'),
(99, '112230431', '112230435', 'pK2zYA==', '2025-01-27 09:57:11'),
(100, '112230431', '112230435', 'pKe9YNynG05RpXk=', '2025-01-27 09:57:18');

-- --------------------------------------------------------

--
-- Table structure for table `midfinalroutine`
--

CREATE TABLE `midfinalroutine` (
  `id` int(11) NOT NULL,
  `Dept` varchar(255) NOT NULL,
  `CourseCode` varchar(1000) NOT NULL,
  `CourseTitle` varchar(1000) NOT NULL,
  `Section` varchar(50) NOT NULL,
  `Teacher` varchar(1000) NOT NULL,
  `ExamDate` varchar(1000) NOT NULL,
  `ExamTime` varchar(1000) NOT NULL,
  `Room` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `midfinalroutine`
--

INSERT INTO `midfinalroutine` (`id`, `Dept`, `CourseCode`, `CourseTitle`, `Section`, `Teacher`, `ExamDate`, `ExamTime`, `Room`) VALUES
(1761, 'BSCSE', 'CSE 4509/CSI 309', 'Operating System Concepts/Operating Systems', 'A', 'RaK', 'May 12, 2024', '09:00 AM - 11:00 AM', '323 (011171282-011201198)                                                                                                                                                                                                                       324 (011201252-011222063)'),
(1762, 'BSCSE', 'CSE 4509/CSI 309', 'Operating System Concepts/Operating Systems', 'B', 'GoS', 'May 12, 2024', '09:00 AM - 11:00 AM', '322 (011162003-011221489)'),
(1763, 'BSCSE', 'CSE 4509/CSI 309', 'Operating System Concepts/Operating Systems', 'C', 'GoS', 'May 12, 2024', '09:00 AM - 11:00 AM', '325 (011162018-011213149)'),
(1764, 'BSEEE', 'EEE 255/EEE 3303', 'Probability and Random Signal Analysis/Probability, Statistics and Random Variables', 'A', 'HAS', 'May 12, 2024', '09:00 AM - 11:00 AM', '328 (021163019-021211020)                                                                                                                                                                                                                       329 (021211024-0212310077)'),
(1765, 'BSCSE', 'ENG 1011', 'English I', 'AA', 'MrR', 'May 12, 2024', '09:00 AM - 11:00 AM', '330 (0112320080-0112410017)                                                                                                                                                                                                                       401 (0112410018-0112410529)'),
(1766, 'BSCSE', 'ENG 1011', 'English I', 'AB', 'SaFe', 'May 12, 2024', '09:00 AM - 11:00 AM', '404 (0112230741-0112410049)                                                                                                                                                                                                                       405 (0112410050-0112410532)'),
(1767, 'BSCSE', 'ENG 1011', 'English I', 'AC', 'MrR', 'May 12, 2024', '09:00 AM - 11:00 AM', '402 (0112410038-0112410077)                                                                                                                                                                                                                       403 (0112410101-0152410069)'),
(1768, 'BSCSE', 'ENG 1011', 'English I', 'AD', 'ASuS', 'May 12, 2024', '09:00 AM - 11:00 AM', '423 (0112310158-0112410095)                                                                                                                                                                                                                       425 (0112410096-0112410442)'),
(1769, 'BSCSE', 'ENG 1011', 'English I', 'AE', 'MZK', 'May 12, 2024', '09:00 AM - 11:00 AM', '410 (0112230626-0112410115)                                                                                                                                                                                                                       411 (0112410116-0112410528)'),
(1770, 'BSCSE', 'ENG 1011', 'English I', 'AF', 'MZK', 'May 12, 2024', '09:00 AM - 11:00 AM', '601 (0112230006-0112410145)                                                                                                                                                                                                                       602 (0112410146-0112410541)'),
(1771, 'BSCSE', 'ENG 1011', 'English I', 'AG', 'JTR', 'May 12, 2024', '09:00 AM - 11:00 AM', '604 (0112410151-0112410173)                                                                                                                                                                                                                       605 (0112410175-0112410530)'),
(1772, 'BSCSE', 'ENG 1011', 'English I', 'AH', 'SaHn', 'May 12, 2024', '09:00 AM - 11:00 AM', '408 (0112231061-0112410196)                                                                                                                                                                                                                       409 (0112410197-0112410548)'),
(1773, 'BSCSE', 'ENG 1011', 'English I', 'AI', 'JTR', 'May 12, 2024', '09:00 AM - 11:00 AM', '428 (0112230685-0112410412)                                                                                                                                                                                                                       429 (0112410413-0112410533)'),
(1774, 'BSCSE', 'ENG 1011', 'English I', 'AJ', 'MdTI', 'May 12, 2024', '09:00 AM - 11:00 AM', '406 (0112331107-0112410307)                                                                                                                                                                                                                       407 (0112410308-0112410443)'),
(1775, 'BSCSE', 'ENG 1011', 'English I', 'AK', 'SSh', 'May 12, 2024', '09:00 AM - 11:00 AM', '431 (0112330098-0112410229)                                                                                                                                                                                                                       432 (0112410230-0112410540)'),
(1776, 'BSCSE', 'ENG 1011', 'English I', 'AL', 'SaHn', 'May 12, 2024', '09:00 AM - 11:00 AM', '630 (0112230265-0112410543)'),
(1777, 'BSCSE', 'ENG 1011', 'English I', 'AN', 'SSh', 'May 12, 2024', '09:00 AM - 11:00 AM', '328 (0112330138-0112410399)                                                                                                                                                                                                                       329 (0112410400-0112410542)'),
(1778, 'BSDS', 'ENG 1011', 'English I', 'BA', 'AnAn', 'May 12, 2024', '09:00 AM - 11:00 AM', '804 (0112330245-0152410017)                                                                                                                                                                                                                       805 (0152410018-0152410071)'),
(1779, 'BSDS', 'ENG 1011', 'English I', 'BB', 'FBM', 'May 12, 2024', '09:00 AM - 11:00 AM', '806 (0112230854-0152410025)                                                                                                                                                                                                                       903 (0152410027-0152410070)'),
(1780, 'BSEEE', 'ENG 1011', 'English I', 'P', 'SaAr', 'May 12, 2024', '09:00 AM - 11:00 AM', '322 (0112410490-0212410011)                                                                                                                                                                                                                       323 (0212410012-0212410052)'),
(1781, 'BSEEE', 'ENG 1011', 'English I', 'Q', 'AnAn', 'May 12, 2024', '09:00 AM - 11:00 AM', '631 (011221029-0212410022)                                                                                                                                                                                                                       632 (0212410023-0212410049)'),
(1782, 'BSCSE', 'IPE 3401', 'Industrial and Operational Management', 'A', 'GKR', 'May 12, 2024', '09:00 AM - 11:00 AM', '601 (011201167-011221157)                                                                                                                                                                                                                       602 (011221352-0112310267)'),
(1783, 'BSCSE', 'IPE 3401', 'Industrial and Operational Management', 'B', 'GKR', 'May 12, 2024', '09:00 AM - 11:00 AM', '603 (011191079-011221199)                                                                                                                                                                                                                       604 (011221216-0112310394)'),
(1784, 'BSCSE', 'IPE 3401/IPE 401', 'Industrial and Operational Management/Industrial Management', 'C', 'GKR', 'May 12, 2024', '09:00 AM - 11:00 AM', '803 (011181210-011221131)                                                                                                                                                                                                                       804 (011221221-0112310497)'),
(1785, 'BSEEE', 'ECO 2101/ECO 213', 'Economics', 'C', 'SCT', 'May 12, 2024', '11:30 AM - 01:30 PM', '425 (021193005-0212230062)'),
(1786, 'BSEEE', 'ECO 2101/ECO 213/ECO 4101', 'Economics', 'D', 'MSS', 'May 12, 2024', '11:30 AM - 01:30 PM', '322 (011183095-021212012)                                                                                                                                                                                                                       323 (021212013-0212230083)'),
(1787, 'BSEEE', 'EEE 305/EEE 3205', 'Power System', 'A', 'SMLK', 'May 12, 2024', '11:30 AM - 01:30 PM', '405 (021152028-021201006)                                                                                                                                                                                                                       406 (021201028-0212320027)'),
(1788, 'BSCSE', 'ENG 1013', 'English II', 'AA', 'NB', 'May 12, 2024', '11:30 AM - 01:30 PM', '806 (0112330001-0112330662)                                                                                                                                                                                                                       903 (0112330670-0112331154)'),
(1789, 'BSCSE', 'ENG 1013', 'English II', 'AB', 'NB', 'May 12, 2024', '11:30 AM - 01:30 PM', '707 (0112230010-0112330372)                                                                                                                                                                                                                       708 (0112330383-0112331173)'),
(1790, 'BSCSE', 'ENG 1013', 'English II', 'AC', 'TaHsn', 'May 12, 2024', '11:30 AM - 01:30 PM', '403 (0112310430-0112330504)                                                                                                                                                                                                                       404 (0112330580-0112331164)'),
(1791, 'BSCSE', 'ENG 1013', 'English II', 'AD', 'MdTI', 'May 12, 2024', '11:30 AM - 01:30 PM', '324 (0112310073-0112330571)                                                                                                                                                                                                                       325 (0112330573-0112331163)'),
(1792, 'BSCSE', 'ENG 1013', 'English II', 'AE', 'MdTI', 'May 12, 2024', '11:30 AM - 01:30 PM', '631 (0112310200-0112330595)                                                                                                                                                                                                                       632 (0112330615-0112331168)'),
(1793, 'BSCSE', 'ENG 1013', 'English II', 'AF', 'SSh', 'May 12, 2024', '11:30 AM - 01:30 PM', '322 (011221302-0112330604)                                                                                                                                                                                                                       323 (0112330716-0112331152)'),
(1794, 'BSCSE', 'ENG 1013', 'English II', 'AG', 'SaFe', 'May 12, 2024', '11:30 AM - 01:30 PM', '408 (0112310360-0112330560)                                                                                                                                                                                                                       409 (0112330617-0112331108)'),
(1795, 'BSCSE', 'ENG 1013', 'English II', 'AH', 'MarHn', 'May 12, 2024', '11:30 AM - 01:30 PM', '402 (0112330079-0112331126)'),
(1796, 'BSCSE', 'ENG 1013', 'English II', 'AI', 'NB', 'May 12, 2024', '11:30 AM - 01:30 PM', '328 (0112310068-0112330725)                                                                                                                                                                                                                       329 (0112330727-0112331157)'),
(1797, 'BSCSE', 'ENG 1013', 'English II', 'AJ', 'JTR', 'May 12, 2024', '11:30 AM - 01:30 PM', '328 (011222175-0112330217)                                                                                                                                                                                                                       329 (0112330231-0112331109)'),
(1798, 'BSCSE', 'ENG 1013', 'English II', 'AK', 'SaFe', 'May 12, 2024', '11:30 AM - 01:30 PM', '324 (0112230896-0112330352)                                                                                                                                                                                                                       403 (0112330376-0112331137)'),
(1799, 'BSCSE', 'ENG 1013', 'English II', 'AL', 'SaFe', 'May 12, 2024', '11:30 AM - 01:30 PM', '804 (0112310391-0112330453)                                                                                                                                                                                                                       805 (0112330523-0112331092)'),
(1800, 'BSCSE', 'ENG 1013', 'English II', 'AM', 'TaHsn', 'May 12, 2024', '11:30 AM - 01:30 PM', '423 (0112320007-0112330686)                                                                                                                                                                                                                       425 (0112330690-0112331096)'),
(1801, 'BSCSE', 'ENG 1013', 'English II', 'AN', 'AnAn', 'May 12, 2024', '11:30 AM - 01:30 PM', '703 (0112330009-0112330385)                                                                                                                                                                                                                       706 (0112330404-0112331020)'),
(1802, 'BSCSE', 'ENG 1013', 'English II', 'AP', 'TaHsn', 'May 12, 2024', '11:30 AM - 01:30 PM', '428 (0112230036-0112330500)                                                                                                                                                                                                                       429 (0112330501-0112331158)'),
(1803, 'BSCSE', 'ENG 1013', 'English II', 'AQ', 'MdTI', 'May 12, 2024', '11:30 AM - 01:30 PM', '402 (0112330034-0112331104)'),
(1804, 'BSCSE', 'ENG 1013', 'English II', 'AR', 'AKMZa', 'May 12, 2024', '11:30 AM - 01:30 PM', '330 (0112230641-0112330596)                                                                                                                                                                                                                       401 (0112330691-0112331151)'),
(1805, 'BSCSE', 'ENG 1013', 'English II', 'AS', 'AnAn', 'May 12, 2024', '11:30 AM - 01:30 PM', '330 (0112230861-0112330472)                                                                                                                                                                                                                       401 (0112330492-0112331138)'),
(1806, 'BSCSE', 'ENG 1013', 'English II', 'AT', 'MdTI', 'May 12, 2024', '11:30 AM - 01:30 PM', '711 (011211045-0112330680)                                                                                                                                                                                                                       722 (0112330681-0152330156)'),
(1807, 'BSCSE', 'ENG 1013', 'English II', 'AU', 'NB', 'May 12, 2024', '11:30 AM - 01:30 PM', '431 (0112320127-0112330911)                                                                                                                                                                                                                       432 (0112330935-0112331161)'),
(1808, 'BSCSE', 'ENG 1013', 'English II', 'AV', 'AnAn', 'May 12, 2024', '11:30 AM - 01:30 PM', '404 (011221213-0112330547)                                                                                                                                                                                                                       405 (0112330550-0112331160)'),
(1809, 'BSCSE', 'ENG 1013', 'English II', 'AW', 'NB', 'May 12, 2024', '11:30 AM - 01:30 PM', '806 (0112310295-0112330601)                                                                                                                                                                                                                       903 (0112330613-0112331167)'),
(1810, 'BSCSE', 'ENG 1013', 'English II', 'AX', 'TaHsn', 'May 12, 2024', '11:30 AM - 01:30 PM', '406 (0112310291-0112330491)                                                                                                                                                                                                                       407 (0112330518-0112331153)'),
(1811, 'BSCSE', 'ENG 1013', 'English II', 'AY', 'ChMR', 'May 12, 2024', '11:30 AM - 01:30 PM', '410 (0112330059-0112330648)                                                                                                                                                                                                                       411 (0112330790-0112331145)'),
(1812, 'BSDS', 'ENG 1013', 'English II', 'BA', 'SaHn', 'May 12, 2024', '11:30 AM - 01:30 PM', '701 (0112330067-0152330035)                                                                                                                                                                                                                       702 (0152330039-0152330150)'),
(1813, 'BSDS', 'ENG 1013', 'English II', 'BB', 'SaHn', 'May 12, 2024', '11:30 AM - 01:30 PM', '605 (0112320053-0152330059)                                                                                                                                                                                                                       630 (0152330060-0152330154)'),
(1814, 'BSDS', 'ENG 1013', 'English II', 'BC', 'FBM', 'May 12, 2024', '11:30 AM - 01:30 PM', '601 (0112320067-0152330088)                                                                                                                                                                                                                       602 (0152330094-0152330152)'),
(1815, 'BSDS', 'ENG 1013', 'English II', 'BD', 'ZHT', 'May 12, 2024', '11:30 AM - 01:30 PM', '325 (011221468-0152330142)'),
(1816, 'BSEEE', 'ENG 1013', 'English II', 'P', 'SaAn', 'May 12, 2024', '11:30 AM - 01:30 PM', '804 (021222052-0212330159)'),
(1817, 'BSEEE', 'ENG 1013', 'English II', 'Q', 'SaAr', 'May 12, 2024', '11:30 AM - 01:30 PM', '723 (0212230032-0212330165)'),
(1818, 'BSEEE', 'ENG 1013', 'English II', 'S', 'SaAn', 'May 12, 2024', '11:30 AM - 01:30 PM', '603 (021213014-0212330080)                                                                                                                                                                                                                       604 (0212330081-0212330160)'),
(1819, 'BSEEE', 'ENG 1013/ENG 103', 'English II', 'T', 'SaAr', 'May 12, 2024', '11:30 AM - 01:30 PM', '803 (021181107-0212330163)'),
(1820, 'BSCSE', 'CSE 313/CSE 3313', 'Computer Architecture', 'B', 'SAhSh', 'May 12, 2024', '02:00 PM - 04:00 PM', '431 (011172150-011221052)                                                                                                                                                                                                                       432 (011221097-0112310418)'),
(1821, 'BSCSE', 'CSE 313/CSE 3313', 'Computer Architecture', 'C', 'MNTA', 'May 12, 2024', '02:00 PM - 04:00 PM', '805 (011153072-011221049)                                                                                                                                                                                                                       806 (011221126-0112310038)'),
(1822, 'BSCSE', 'CSE 313/CSE 3313', 'Computer Architecture', 'E', 'RaK', 'May 12, 2024', '02:00 PM - 04:00 PM', '425 (011162047-011212022)                                                                                                                                                                                                                       428 (011212051-021171007)'),
(1823, 'BSCSE', 'CSE 3313', 'Computer Architecture', 'A', 'SAhSh', 'May 12, 2024', '02:00 PM - 04:00 PM', '406 (011193036-011221226)                                                                                                                                                                                                                       407 (011221235-0112310574)'),
(1824, 'BSCSE', 'CSE 3313', 'Computer Architecture', 'D', 'UR', 'May 12, 2024', '02:00 PM - 04:00 PM', '423 (011212039-011221282)                                                                                                                                                                                                                       429 (011221310-0112310033)'),
(1825, 'BSCSE', 'CSE 4889/CSE 489', 'Machine Learning', 'A', 'DMF', 'May 12, 2024', '02:00 PM - 04:00 PM', '323 (011171318-011202080)                                                                                                                                                                                                                       324 (011202081-011221096)'),
(1826, 'BSCSE', 'CSE 4889/CSE 489', 'Machine Learning', 'B', 'DMF', 'May 12, 2024', '02:00 PM - 04:00 PM', '325 (011191014-011212108)'),
(1827, 'BSEEE', 'EEE 105/EEE 2101', 'Electronics I', 'A', 'RaBr', 'May 12, 2024', '02:00 PM - 04:00 PM', '408 (021201080-0212310034)                                                                                                                                                                                                                       409 (0212310035-0212330124)'),
(1828, 'BSEEE', 'EEE 105/EEE 2101', 'Electronics I', 'C', 'RaBr', 'May 12, 2024', '02:00 PM - 04:00 PM', '425 (021201015-0212230011)                                                                                                                                                                                                                       428 (0212230015-0212310053)'),
(1829, 'BSEEE', 'EEE 401/EEE 4109', 'Control System', 'A', 'MKMR', 'May 12, 2024', '02:00 PM - 04:00 PM', '803 (021131142-021211014)'),
(1830, 'BSEEE', 'MAT 2109/MATH 201', 'Coordinate Geometry and Vector Analysis', 'A', 'TN', 'May 12, 2024', '02:00 PM - 04:00 PM', '605 (021153011-021222021)                                                                                                                                                                                                                       630 (021222029-0212230127)'),
(1831, 'BSCSE', 'MATH 183/MATH 2183', 'Calculus and Linear Algebra/Linear Algebra, Ordinary & Partial Differential Equations', 'B', 'KAE', 'May 12, 2024', '02:00 PM - 04:00 PM', '804 (011182091-0112330820)'),
(1832, 'BSCSE', 'MATH 2107/MATH 2183', 'Calculus and Linear Algebra/Linear Algebra', 'A', 'LRS', 'May 12, 2024', '02:00 PM - 04:00 PM', '805 (011191092-0112230332)                                                                                                                                                                                                                       806 (0112230452-0152330115)'),
(1833, 'BSCSE', 'MATH 2183', 'Calculus and Linear Algebra', 'C', 'LRS', 'May 12, 2024', '02:00 PM - 04:00 PM', '431 (011201449-0112230787)                                                                                                                                                                                                                       432 (0112230882-0112330490)'),
(1834, 'BSCSE', 'MATH 2183', 'Calculus and Linear Algebra', 'D', 'SamAr', 'May 12, 2024', '02:00 PM - 04:00 PM', '323 (011193157-0112310030)                                                                                                                                                                                                                       324 (0112310160-0112330096)'),
(1835, 'BSCSE', 'MATH 2183', 'Calculus and Linear Algebra', 'E', 'SiMu', 'May 12, 2024', '02:00 PM - 04:00 PM', '601 (011201160-0112310544)                                                                                                                                                                                                                       602 (0112310566-0112320284)'),
(1836, 'BSCSE', 'MATH 2183', 'Calculus and Linear Algebra', 'F', 'SiMu', 'May 12, 2024', '02:00 PM - 04:00 PM', '410 (011191035-0112230282)                                                                                                                                                                                                                       411 (0112230328-0112320277)'),
(1837, 'BSCSE', 'MATH 2183', 'Calculus and Linear Algebra', 'H', 'LRS', 'May 12, 2024', '02:00 PM - 04:00 PM', '903 (011212095-0112230972)                                                                                                                                                                                                                       322 (0112310327-0112320238)'),
(1838, 'BSCSE', 'MATH 2183', 'Calculus and Linear Algebra', 'J', 'SamAr', 'May 12, 2024', '02:00 PM - 04:00 PM', '325 (011213077-0112310542)'),
(1839, 'BSCSE', 'SOC 101/SOC 2101', 'Society, Environment and Engineering Ethics/Society, Technology and Engineering Ethics', 'D', 'MTR', 'May 12, 2024', '02:00 PM - 04:00 PM', '701 (011163013-0112230276)                                                                                                                                                                                                                       702 (0112230281-0112310499)'),
(1840, 'BSCSE', 'SOC 101/SOC 2101', 'Society, Environment and Engineering Ethics/Society, Technology and Engineering Ethics', 'E', 'AbHn', 'May 12, 2024', '02:00 PM - 04:00 PM', '603 (011173023-0112230573)                                                                                                                                                                                                                       604 (0112230575-0112231070)'),
(1841, 'BSCSE', 'SOC 101/SOC 2101', 'Society, Environment and Engineering Ethics/Society, Technology and Engineering Ethics', 'L', 'RaR', 'May 12, 2024', '02:00 PM - 04:00 PM', '605 (011181112-0112230415)                                                                                                                                                                                                                       630 (0112230436-0112320251)'),
(1842, 'BSCSE', 'SOC 101/SOC 2101/SOC 2102', 'Society, Environment and Computing Ethics/Society, Environment and Engineering Ethics/Society, Technology and Engineering Ethics', 'A', 'TaHn', 'May 12, 2024', '02:00 PM - 04:00 PM', '601 (011211007-0112230428)                                                                                                                                                                                                                       602 (0112230432-0152410023)'),
(1843, 'BSCSE', 'SOC 2101', 'Society, Environment and Engineering Ethics', 'B', 'SaIs', 'May 12, 2024', '02:00 PM - 04:00 PM', '329 (011201391-0112230396)                                                                                                                                                                                                                       330 (0112230397-0112231014)'),
(1844, 'BSCSE', 'SOC 2101', 'Society, Environment and Engineering Ethics', 'C', 'NSS', 'May 12, 2024', '02:00 PM - 04:00 PM', '322 (011201023-0112230646)                                                                                                                                                                                                                       328 (0112230659-0112330877)'),
(1845, 'BSCSE', 'SOC 2101', 'Society, Environment and Engineering Ethics', 'F', 'MiBa', 'May 12, 2024', '02:00 PM - 04:00 PM', '403 (011202165-0112230647)                                                                                                                                                                                                                       404 (0112230656-0112310469)'),
(1846, 'BSCSE', 'SOC 2101', 'Society, Environment and Engineering Ethics', 'G', 'SA', 'May 12, 2024', '02:00 PM - 04:00 PM', '409 (011221293-0112230687)                                                                                                                                                                                                                       410 (0112230688-0112310567)'),
(1847, 'BSCSE', 'SOC 2101', 'Society, Environment and Engineering Ethics', 'H', 'MdShA', 'May 12, 2024', '02:00 PM - 04:00 PM', '401 (011201440-0112230374)                                                                                                                                                                                                                       402 (0112230472-0112330721)'),
(1848, 'BSCSE', 'SOC 2101', 'Society, Environment and Engineering Ethics', 'I', 'MdTH', 'May 12, 2024', '02:00 PM - 04:00 PM', '405 (011213183-0112230546)                                                                                                                                                                                                                       406 (0112230709-0112330738)'),
(1849, 'BSCSE', 'SOC 2101', 'Society, Environment and Engineering Ethics', 'J', 'MMAS', 'May 12, 2024', '02:00 PM - 04:00 PM', '411 (011202338-0112230354)                                                                                                                                                                                                                       423 (0112230418-0112331064)'),
(1850, 'BSCSE', 'SOC 2101', 'Society, Environment and Engineering Ethics', 'K', 'AbHn', 'May 12, 2024', '02:00 PM - 04:00 PM', '407 (011221559-0112230889)                                                                                                                                                                                                                       408 (0112230934-0112330772)'),
(1851, 'BSCSE', 'CSE 1110', 'Introduction to Computer Systems', 'C', 'NSS', 'May 13, 2024', '09:00 AM - 11:00 AM', 'Computer Lab 5 (0523) (011221177-0112410495)'),
(1852, 'BSCSE', 'CSE 1110', 'Introduction to Computer Systems', 'G', 'MBAd', 'May 13, 2024', '09:00 AM - 11:00 AM', 'Computer Lab 15 (0626) (0112310091-0112410456)'),
(1853, 'BSCSE', 'CSE 1110', 'Introduction to Computer Systems', 'H', 'CAG', 'May 13, 2024', '09:00 AM - 11:00 AM', 'Computer Lab 13 (0326) (011222269-0112410210)'),
(1854, 'BSCSE', 'CSE 1110', 'Introduction to Computer Systems', 'L', 'MdMH', 'May 13, 2024', '09:00 AM - 11:00 AM', 'Computer Lab 20 (0424) (0112231032-0112410504)'),
(1855, 'BSCSE', 'CSE 1110', 'Introduction to Computer Systems', 'M', 'MBAd', 'May 13, 2024', '09:00 AM - 11:00 AM', 'Computer Lab 14 (0426) (0112330138-0112410436)'),
(1856, 'BSCSE', 'CSE 1110', 'Introduction to Computer Systems', 'N', 'AAJr', 'May 13, 2024', '09:00 AM - 11:00 AM', 'Computer Lab 10 (0530) (0112310360-0112410510)'),
(1857, 'BSCSE', 'CSE 1110', 'Introduction to Computer Systems', 'O', 'MoI', 'May 13, 2024', '09:00 AM - 11:00 AM', 'Computer Lab 21 (0422) (0112320095-0112410534)'),
(1858, 'BSCSE', 'CSE 1110', 'Introduction to Computer Systems', 'U', 'AsTn', 'May 13, 2024', '09:00 AM - 11:00 AM', 'Computer Lab 11 (0531) (0112230265-0112410526)'),
(1859, 'BSCSE', 'CSE 1110', 'Introduction to Computer Systems', 'X', 'AsTn', 'May 13, 2024', '09:00 AM - 11:00 AM', 'Computer Lab 12 (0532) (0112310608-0112410545)'),
(1860, 'BSCSE', 'CSE 4521/CSE 4621/CSI 421', 'Computer Graphics', 'A', 'MHAK', 'May 13, 2024', '09:00 AM - 11:00 AM', '803 (011151218-011202313)'),
(1861, 'BSCSE', 'CSE 4611/CSI 411', 'Compiler/Compiler Design', 'A', 'NSS', 'May 13, 2024', '09:00 AM - 11:00 AM', '804 (011181116-011201073)                                                                                                                                                                                                                       805 (011201085-011222212)'),
(1862, 'BSCSE', 'CSE 4611/CSI 411', 'Compiler/Compiler Design', 'B', 'KAN', 'May 13, 2024', '09:00 AM - 11:00 AM', '806 (011182013-011201170)                                                                                                                                                                                                                       903 (011201171-011221549)'),
(1863, 'BSEEE', 'MAT 1103', 'Calculus II', 'A', 'TN', 'May 13, 2024', '09:00 AM - 11:00 AM', '903 (021221080-0212330058)                                                                                                                                                                                                                       322 (0212330059-0212330159)'),
(1864, 'BSEEE', 'MAT 1103', 'Calculus II', 'B', 'NPn', 'May 13, 2024', '09:00 AM - 11:00 AM', '330 (021213014-0212330164)'),
(1865, 'BSEEE', 'MAT 1103', 'Calculus II', 'E', 'TN', 'May 13, 2024', '09:00 AM - 11:00 AM', '805 (021211027-0212330085)                                                                                                                                                                                                                       806 (0212330088-0212330165)'),
(1866, 'BSEEE', 'SOC 3101', 'Society, Environment and Engineering Ethics', 'I', 'JJM', 'May 13, 2024', '09:00 AM - 11:00 AM', '803 (021192032-021212013)                                                                                                                                                                                                                       804 (021212021-0212230104)'),
(1867, 'BSCSE', 'CSE 1110', 'Introduction to Computer Systems', 'A', 'SiMa', 'May 13, 2024', '11:30 AM - 01:30 PM', 'Computer Lab 20 (0424) (0112231048-0112410478)'),
(1868, 'BSCSE', 'CSE 1110', 'Introduction to Computer Systems', 'B', 'SAhSh', 'May 13, 2024', '11:30 AM - 01:30 PM', 'Computer Lab 11 (0531) (0112310151-0112410537)'),
(1869, 'BSCSE', 'CSE 1110', 'Introduction to Computer Systems', 'D', 'SSSk', 'May 13, 2024', '11:30 AM - 01:30 PM', 'Computer Lab 21 (0422) (0112230188-0112410533)'),
(1870, 'BSCSE', 'CSE 1110', 'Introduction to Computer Systems', 'E', 'SAhSh', 'May 13, 2024', '11:30 AM - 01:30 PM', 'Computer Lab 12 (0532) (011222003-0112410392)'),
(1871, 'BSCSE', 'CSE 1110', 'Introduction to Computer Systems', 'F', 'SAhSh', 'May 13, 2024', '11:30 AM - 01:30 PM', 'Computer Lab 13 (0326) (0112230006-0112410539)'),
(1872, 'BSCSE', 'CSE 1110', 'Introduction to Computer Systems', 'J', 'TSh', 'May 13, 2024', '11:30 AM - 01:30 PM', 'Computer Lab 7 (0522) (0112330128-0112410508)'),
(1873, 'BSCSE', 'CSE 1110', 'Introduction to Computer Systems', 'K', 'ShKS', 'May 13, 2024', '11:30 AM - 01:30 PM', 'Computer Lab 15 (0626) (0112330302-0112410546)'),
(1874, 'BSCSE', 'CSE 1110', 'Introduction to Computer Systems', 'S', 'ShAn', 'May 13, 2024', '11:30 AM - 01:30 PM', 'Computer Lab 14 (0426) (0112310395-0112410496)'),
(1875, 'BSCSE', 'CSE 1110', 'Introduction to Computer Systems', 'Y', 'SYH', 'May 13, 2024', '11:30 AM - 01:30 PM', 'Computer Lab 5 (0523) (0112231075-0112410528)'),
(1876, 'BSCSE', 'CSE 1110', 'Introduction to Computer Systems', 'Z', 'RRK', 'May 13, 2024', '11:30 AM - 01:30 PM', 'Computer Lab 10 (0530) (011201472-0112410549)'),
(1877, 'BSCSE', 'CSE 425/CSE 4325', 'Microprocessor, Microcontroller and Interfacing/Microprocessors and Microcontrollers', 'A', 'SiMa', 'May 13, 2024', '11:30 AM - 01:30 PM', '322 (011163056-011202216)                                                                                                                                                                                                                       323 (011202254-011221113)'),
(1878, 'BSCSE', 'CSE 425/CSE 4325', 'Microprocessor, Microcontroller and Interfacing/Microprocessors and Microcontrollers', 'B', 'SiMa', 'May 13, 2024', '11:30 AM - 01:30 PM', '324 (011172150-011201420)                                                                                                                                                                                                                       325 (011201469-011213146)'),
(1879, 'BSCSE', 'CSE 425/CSE 4325', 'Microprocessor, Microcontroller and Interfacing/Microprocessors and Microcontrollers', 'D', 'MSTR', 'May 13, 2024', '11:30 AM - 01:30 PM', '803 (011173025-011203032)                                                                                                                                                                                                                       804 (011203048-011222315)'),
(1880, 'BSCSE', 'CSE 4325', 'Microprocessors and Microcontrollers', 'C', 'MSTR', 'May 13, 2024', '11:30 AM - 01:30 PM', '328 (011183048-011212086)                                                                                                                                                                                                                       329 (011212091-011221170)'),
(1881, 'BSEEE', 'EEE 207/EEE 2103', 'Electronics II', 'A', 'RaBr', 'May 13, 2024', '11:30 AM - 01:30 PM', '323 (021161098-0212310052)'),
(1882, 'BSEEE', 'EEE 207/EEE 2103', 'Electronics II', 'B', 'SdM', 'May 13, 2024', '11:30 AM - 01:30 PM', '324 (021173038-0212230056)                                                                                                                                                                                                                       325 (0212230071-0212310076)'),
(1883, 'BSEEE', 'EEE 207/EEE 2103', 'Electronics II', 'C', 'SdM', 'May 13, 2024', '11:30 AM - 01:30 PM', '903 (021193015-0212310033)'),
(1884, 'BSEEE', 'IPE 3401/IPE 401/IPE 4101', 'Industrial and Operational Management/Industrial Management/Industrial Production Engineering', 'D', 'GKR', 'May 13, 2024', '11:30 AM - 01:30 PM', '803 (011183104-0112230288)                                                                                                                                                                                                                       804 (0112230378-021212014)'),
(1885, 'BSCSE', 'ACT 111/ACT 2111', 'Financial and Managerial Accounting', 'A', 'MdAHn', 'May 13, 2024', '02:00 PM - 04:00 PM', '804 (011181018-011213035)                                                                                                                                                                                                                       805 (011221036-0112231040)'),
(1886, 'BSCSE', 'ACT 111/ACT 2111', 'Financial and Managerial Accounting', 'B', 'MdAHn', 'May 13, 2024', '02:00 PM - 04:00 PM', '806 (011181167-011221084)                                                                                                                                                                                                                       903 (011221115-0112410545)'),
(1887, 'BSCSE', 'CSE 4893', 'Introduction to Bioinformatics', 'A', 'RtAm', 'May 13, 2024', '02:00 PM - 04:00 PM', '804 (011191101-011221470)'),
(1888, 'BSEEE', 'EEE 203/EEE 2201', 'Energy Conversion I', 'A', 'HB', 'May 13, 2024', '02:00 PM - 04:00 PM', '803 (021131142-021222025)'),
(1889, 'BSCSE', 'MATH 2205', 'Probability and Statistics', 'B', 'MUn', 'May 13, 2024', '02:00 PM - 04:00 PM', '401 (011193029-011222062)                                                                                                                                                                                                                       402 (011222067-0112310303)'),
(1890, 'BSCSE', 'MATH 2205', 'Probability and Statistics', 'C', 'MUn', 'May 13, 2024', '02:00 PM - 04:00 PM', '328 (011201079-011222215)                                                                                                                                                                                                                       329 (011222254-0112310231)'),
(1891, 'BSCSE', 'MATH 2205', 'Probability and Statistics', 'D', 'AkAd', 'May 13, 2024', '02:00 PM - 04:00 PM', '324 (011191034-011222178)                                                                                                                                                                                                                       325 (011222263-0112310249)'),
(1892, 'BSCSE', 'MATH 2205', 'Probability and Statistics', 'E', 'AkAd', 'May 13, 2024', '02:00 PM - 04:00 PM', '322 (011191014-011221451)                                                                                                                                                                                                                       323 (011221455-0112310255)'),
(1893, 'BSCSE', 'MATH 2205/STAT 205', 'Probability and Statistics', 'A', 'AkAd', 'May 13, 2024', '02:00 PM - 04:00 PM', '403 (011172130-011221520)                                                                                                                                                                                                                       404 (011221521-0152330106)'),
(1894, 'BSCSE', 'MATH 2205/STAT 205', 'Probability and Statistics', 'F', 'MUn', 'May 13, 2024', '02:00 PM - 04:00 PM', '805 (011162003-011212166)                                                                                                                                                                                                                       806 (011213095-0112331150)'),
(1895, 'BSCSE', 'CSE 3811', 'Artificial Intelligence', 'A', 'RRK', 'May 14, 2024', '09:00 AM - 11:00 AM', '328 (011191014-011221245)                                                                                                                                                                                                                       329 (011221252-011222284)'),
(1896, 'BSCSE', 'CSE 3811', 'Artificial Intelligence', 'B', 'MTR', 'May 14, 2024', '09:00 AM - 11:00 AM', '406 (011192056-011213021)                                                                                                                                                                                                                       407 (011213069-011221483)'),
(1897, 'BSCSE', 'CSE 3811/CSI 341', 'Artificial Intelligence', 'C', 'SMTT', 'May 14, 2024', '09:00 AM - 11:00 AM', '330 (011151218-011202066)                                                                                                                                                                                                                       401 (011202169-0112310573)'),
(1898, 'BSCSE', 'CSE 3811/CSI 341', 'Artificial Intelligence', 'D', 'RRK', 'May 14, 2024', '09:00 AM - 11:00 AM', '402 (011181193-011213016)                                                                                                                                                                                                                       403 (011213030-011221376)'),
(1899, 'BSCSE', 'CSE 3811/CSI 341', 'Artificial Intelligence', 'E', 'ShKS', 'May 14, 2024', '09:00 AM - 11:00 AM', '404 (011181018-011213062)                                                                                                                                                                                                                       405 (011213063-011221469)'),
(1900, 'BSCSE', 'CSE 4451', 'Human Computer Interaction', 'A', 'ShKS', 'May 14, 2024', '09:00 AM - 11:00 AM', '803 (011191139-011201233)                                                                                                                                                                                                                       805 (011201289-011222212)'),
(1901, 'BSCSE', 'CSE 4451', 'Human Computer Interaction', 'B', 'ShKS', 'May 14, 2024', '09:00 AM - 11:00 AM', '806 (011183062-011201250)                                                                                                                                                                                                                       903 (011201259-011212148)'),
(1902, 'BSEEE', 'EEE 205/EEE 2203', 'Energy Conversion II', 'A', 'IA', 'May 14, 2024', '09:00 AM - 11:00 AM', '803 (021162038-021221002)                                                                                                                                                                                                                       804 (021221003-021222031)'),
(1903, 'BSEEE', 'MAT 1101/MATH 003', 'Calculus I/Elementary Calculus', 'A', 'AM', 'May 14, 2024', '09:00 AM - 11:00 AM', '322 (021191060-0212330141)                                                                                                                                                                                                                       323 (0212330166-0212410049)'),
(1904, 'BSEEE', 'MAT 1101/MATH 003', 'Calculus I/Elementary Calculus', 'B', 'AM', 'May 14, 2024', '09:00 AM - 11:00 AM', '806 (021183013-0212330114)                                                                                                                                                                                                                       903 (0212330123-0212410052)'),
(1905, 'BSCSE', 'CSE 2213', 'Discrete Mathematics', 'A', 'CAG', 'May 14, 2024', '11:30 AM - 01:30 PM', '409 (0112230738-0112410009)                                                                                                                                                                                                                       410 (0112410010-0112410536)'),
(1906, 'BSCSE', 'CSE 2213', 'Discrete Mathematics', 'C', 'ASKP', 'May 14, 2024', '11:30 AM - 01:30 PM', '603 (011221313-0112410062)                                                                                                                                                                                                                       604 (0112410064-0112410495)'),
(1907, 'BSCSE', 'CSE 2213', 'Discrete Mathematics', 'D', 'KBJ', 'May 14, 2024', '11:30 AM - 01:30 PM', '402 (011212025-0112410088)                                                                                                                                                                                                                       605 (0112410089-0152330153)'),
(1908, 'BSCSE', 'CSE 2213', 'Discrete Mathematics', 'E', 'MEHq', 'May 14, 2024', '11:30 AM - 01:30 PM', '403 (011222003-0112410111)                                                                                                                                                                                                                       404 (0112410112-0112410410)'),
(1909, 'BSCSE', 'CSE 2213', 'Discrete Mathematics', 'G', 'KBJ', 'May 14, 2024', '11:30 AM - 01:30 PM', '431 (011201297-0112410156)                                                                                                                                                                                                                       429 (0112410157-0112410542)'),
(1910, 'BSCSE', 'CSE 2213', 'Discrete Mathematics', 'H', 'ShAn', 'May 14, 2024', '11:30 AM - 01:30 PM', '407 (011221251-0112410194)                                                                                                                                                                                                                       408 (0112410195-0112410497)'),
(1911, 'BSCSE', 'CSE 2213', 'Discrete Mathematics', 'I', 'ASKP', 'May 14, 2024', '11:30 AM - 01:30 PM', '432 (011202075-0112410504)'),
(1912, 'BSCSE', 'CSE 2213', 'Discrete Mathematics', 'K', 'SEA', 'May 14, 2024', '11:30 AM - 01:30 PM', '411 (0112330282-0112410229)                                                                                                                                                                                                                       423 (0112410230-0112410548)'),
(1913, 'BSCSE', 'CSE 2213', 'Discrete Mathematics', 'M', 'ShSr', 'May 14, 2024', '11:30 AM - 01:30 PM', '601 (0112310430-0112410384)                                                                                                                                                                                                                       602 (0112410385-0112410513)'),
(1914, 'BSCSE', 'CSE 2213', 'Discrete Mathematics', 'T', 'HHR', 'May 14, 2024', '11:30 AM - 01:30 PM', '328 (011221355-0112410460)                                                                                                                                                                                                                       329 (0112410462-0112410523)');
INSERT INTO `midfinalroutine` (`id`, `Dept`, `CourseCode`, `CourseTitle`, `Section`, `Teacher`, `ExamDate`, `ExamTime`, `Room`) VALUES
(1915, 'BSCSE', 'CSE 2213', 'Discrete Mathematics', 'U', 'MEHq', 'May 14, 2024', '11:30 AM - 01:30 PM', '330 (011221378-0112331072)                                                                                                                                                                                                                       401 (0112331073-0152330074)'),
(1916, 'BSCSE', 'CSE 2213', 'Discrete Mathematics', 'V', 'SYH', 'May 14, 2024', '11:30 AM - 01:30 PM', '425 (011193026-0112410512)                                                                                                                                                                                                                       428 (0112410514-0152320002)'),
(1917, 'BSCSE', 'CSE 2213/CSI 219', 'Discrete Mathematics', 'B', 'FTU', 'May 14, 2024', '11:30 AM - 01:30 PM', '405 (011191001-0112410034)                                                                                                                                                                                                                       406 (0112410035-0112410429)'),
(1918, 'BSCSE', 'CSE 2213/CSI 219', 'Discrete Mathematics', 'F', 'ShAn', 'May 14, 2024', '11:30 AM - 01:30 PM', '322 (011222235-0112410143)                                                                                                                                                                                                                       323 (0112410144-0152330019)'),
(1919, 'BSCSE', 'CSE 2213/CSI 219', 'Discrete Mathematics', 'J', 'SuIm', 'May 14, 2024', '11:30 AM - 01:30 PM', '806 (011201472-0112410334)                                                                                                                                                                                                                       903 (0112410337-0112410545)'),
(1920, 'BSCSE', 'CSE 2213/CSI 219', 'Discrete Mathematics', 'L', 'ShSr', 'May 14, 2024', '11:30 AM - 01:30 PM', '324 (011181210-0112410279)                                                                                                                                                                                                                       325 (0112410323-0112410549)'),
(1921, 'BSCSE', 'CSE 469/PMG 4101', 'Project Management', 'A', 'SA', 'May 14, 2024', '11:30 AM - 01:30 PM', '322 (011181068-011201333)                                                                                                                                                                                                                       323 (011201348-011212086)'),
(1922, 'BSCSE', 'CSE 469/PMG 4101', 'Project Management', 'B', 'AAJr', 'May 14, 2024', '11:30 AM - 01:30 PM', '806 (011181167-011201049)                                                                                                                                                                                                                       903 (011201054-0152410044)'),
(1923, 'BSCSE', 'CSE 469/PMG 4101', 'Project Management', 'C', 'AAJr', 'May 14, 2024', '11:30 AM - 01:30 PM', '804 (011181039-011201251)                                                                                                                                                                                                                       805 (011201252-011203043)'),
(1924, 'BSEEE', 'EEE 3403/EEE 423', 'Microprocessor and Interfacing', 'A', 'SMLK', 'May 14, 2024', '11:30 AM - 01:30 PM', '803 (021152028-021201061)                                                                                                                                                                                                                       805 (021201069-021213032)'),
(1925, 'BSEEE', 'PHY 1103', 'Physics II', 'A', 'SaDa', 'May 14, 2024', '11:30 AM - 01:30 PM', '803 (021183008-0212310051)                                                                                                                                                                                                                       804 (0212310052-0212330008)'),
(1926, 'BSCSE', 'BIO 3105', 'Biology for Engineers', 'A', 'HAA', 'May 14, 2024', '02:00 PM - 04:00 PM', '804 (011191086-011221148)                                                                                                                                                                                                                       805 (011221149-0112330702)'),
(1927, 'BSCSE', 'BIO 3105', 'Biology for Engineers', 'B', 'HAA', 'May 14, 2024', '02:00 PM - 04:00 PM', '903 (011193006-011221396)                                                                                                                                                                                                                       322 (011221508-0112310511)'),
(1928, 'BSCSE', 'BIO 3105', 'Biology for Engineers', 'C', 'HAA', 'May 14, 2024', '02:00 PM - 04:00 PM', '806 (011192011-011221328)                                                                                                                                                                                                                       405 (011221447-0112310533)'),
(1929, 'BSCSE', 'BIO 3105/BIO 3107', 'Biology/Biology for Engineers', 'D', 'HAA', 'May 14, 2024', '02:00 PM - 04:00 PM', '403 (011191108-011221403)                                                                                                                                                                                                                       404 (011221428-0152330119)'),
(1930, 'BSCSE', 'CSE 1325', 'Digital Logic Design', 'B', 'MBAd', 'May 14, 2024', '02:00 PM - 04:00 PM', '409 (011213054-0112310512)                                                                                                                                                                                                                       410 (0112320028-0112410165)'),
(1931, 'BSCSE', 'CSE 1325', 'Digital Logic Design', 'C', 'SaIm', 'May 14, 2024', '02:00 PM - 04:00 PM', '330 (011193147-0112320121)                                                                                                                                                                                                                       411 (0112320122-0112410415)'),
(1932, 'BSCSE', 'CSE 1325', 'Digital Logic Design', 'F', 'SaIm', 'May 14, 2024', '02:00 PM - 04:00 PM', '407 (011193092-0112310154)                                                                                                                                                                                                                       408 (0112310379-0112331011)'),
(1933, 'BSCSE', 'CSE 1325', 'Digital Logic Design', 'H', 'SEA', 'May 14, 2024', '02:00 PM - 04:00 PM', '328 (011201019-0112320069)                                                                                                                                                                                                                       329 (0112320071-0112330660)'),
(1934, 'BSCSE', 'CSE 1325', 'Digital Logic Design', 'I', 'MBAd', 'May 14, 2024', '02:00 PM - 04:00 PM', '405 (011213203-0112310428)                                                                                                                                                                                                                       406 (0112310566-0112410457)'),
(1935, 'BSCSE', 'CSE 1325', 'Digital Logic Design', 'J', 'AsTn', 'May 14, 2024', '02:00 PM - 04:00 PM', '403 (011213006-0112320032)                                                                                                                                                                                                                       404 (0112320034-0112320245)'),
(1936, 'BSCSE', 'CSE 1325/CSE 225', 'Digital Logic Design', 'A', 'JHE', 'May 14, 2024', '02:00 PM - 04:00 PM', '322 (011181210-0112230918)                                                                                                                                                                                                                       323 (0112231066-0112331136)'),
(1937, 'BSCSE', 'CSE 1325/CSE 225', 'Digital Logic Design', 'E', 'RtAm', 'May 14, 2024', '02:00 PM - 04:00 PM', '324 (011182064-0112320052)                                                                                                                                                                                                                       325 (0112320063-0112410536)'),
(1938, 'BSCSE', 'CSE 1325/CSE 225', 'Digital Logic Design', 'G', 'RtAm', 'May 14, 2024', '02:00 PM - 04:00 PM', '401 (011212026-0112231068)                                                                                                                                                                                                                       402 (0112310155-0112330367)'),
(1939, 'BSCSE', 'CSE 429/CSE 4329', 'Digital System Design', 'A', 'IMK', 'May 14, 2024', '02:00 PM - 04:00 PM', '903 (011162087-011221489)'),
(1940, 'BSEEE', 'EEE 121/EEE 2401', 'Structured Programming Language', 'A', 'MKMR', 'May 14, 2024', '02:00 PM - 04:00 PM', '805 (021192041-0212230031)                                                                                                                                                                                                                       806 (0212230033-0212230127)'),
(1941, 'BSEEE', 'EEE 121/EEE 2401', 'Structured Programming Language', 'B', 'BKM', 'May 14, 2024', '02:00 PM - 04:00 PM', '804 (021201080-0212310021)'),
(1942, 'BSEEE', 'EEE 4213/EEE 473', 'Power Plant Engineering', 'A', 'MHC', 'May 14, 2024', '02:00 PM - 04:00 PM', '803 (021103040-021203003)'),
(1943, 'BSCSE', 'CSE 2233', 'Theory of Computation', 'A', 'AsTn', 'May 15, 2024', '09:00 AM - 11:00 AM', '805 (011201190-0112230077)                                                                                                                                                                                                                       806 (0112230079-0112410047)'),
(1944, 'BSCSE', 'CSE 2233', 'Theory of Computation', 'B', 'AAU', 'May 15, 2024', '09:00 AM - 11:00 AM', '401 (011183005-0112230230)                                                                                                                                                                                                                       402 (0112230256-0112320126)'),
(1945, 'BSCSE', 'CSE 2233', 'Theory of Computation', 'C', 'KAN', 'May 15, 2024', '09:00 AM - 11:00 AM', '329 (011193124-0112230237)                                                                                                                                                                                                                       330 (0112230246-0112310308)'),
(1946, 'BSCSE', 'CSE 2233', 'Theory of Computation', 'D', 'HHR', 'May 15, 2024', '09:00 AM - 11:00 AM', '323 (011201308-0112230303)                                                                                                                                                                                                                       324 (0112230352-0112231020)'),
(1947, 'BSCSE', 'CSE 2233', 'Theory of Computation', 'E', 'AsTn', 'May 15, 2024', '09:00 AM - 11:00 AM', '325 (011191271-011221335)                                                                                                                                                                                                                       328 (011221352-0112310120)'),
(1948, 'BSCSE', 'CSE 2233', 'Theory of Computation', 'G', 'NSS', 'May 15, 2024', '09:00 AM - 11:00 AM', '403 (011193142-0112230213)                                                                                                                                                                                                                       404 (0112230271-0112320245)'),
(1949, 'BSCSE', 'CSE 2233', 'Theory of Computation', 'H', 'MdMH', 'May 15, 2024', '09:00 AM - 11:00 AM', '903 (011193036-0112230206)                                                                                                                                                                                                                       322 (0112230288-0112310607)'),
(1950, 'BSCSE', 'CSE 2233', 'Theory of Computation', 'J', 'IAb', 'May 15, 2024', '09:00 AM - 11:00 AM', '405 (011202038-0112230425)                                                                                                                                                                                                                       406 (0112230431-0112310231)'),
(1951, 'BSCSE', 'CSE 2233', 'Theory of Computation', 'K', 'MdARa', 'May 15, 2024', '09:00 AM - 11:00 AM', '407 (011201117-0112230650)                                                                                                                                                                                                                       408 (0112230651-0112231075)'),
(1952, 'BSCSE', 'CSE 2233/CSI 233', 'Theory of Computation/Theory of Computing', 'F', 'AAU', 'May 15, 2024', '09:00 AM - 11:00 AM', '403 (011211133-0112230654)                                                                                                                                                                                                                       404 (0112230662-0112310481)'),
(1953, 'BSCSE', 'CSE 2233/CSI 233', 'Theory of Computation/Theory of Computing', 'L', 'TSh', 'May 15, 2024', '09:00 AM - 11:00 AM', '401 (011162109-0112230259)                                                                                                                                                                                                                       402 (0112230381-0112231049)'),
(1954, 'BSCSE', 'CSE 4165/CSE 465', 'Web Programming', 'A', 'NHn', 'May 15, 2024', '09:00 AM - 11:00 AM', 'Computer Lab 12 (0532) (011163056-011201435)                                                                                                                                                                                                                       Computer Lab 8 (0528) (011201466-0112410281)'),
(1955, 'BSCSE', 'CSE 4165/CSE 465', 'Web Programming', 'B', 'NHn', 'May 15, 2024', '09:00 AM - 11:00 AM', 'Computer Lab 10 (0530) (011181303-011201418)                                                                                                                                                                                                                       Computer Lab 11 (0531) (011201429-011213016)'),
(1956, 'BSCSE', 'CSE 4165/CSE 465', 'Web Programming', 'C', 'NHn', 'May 15, 2024', '09:00 AM - 11:00 AM', 'Computer Lab 6 (0524) (011172009-011201213)                                                                                                                                                                                                                       Computer Lab 7 (0522) (011201236-0112310604)'),
(1957, 'BSEEE', 'EEE 1003/EEE 103', 'Electrical Circuits II', 'A', 'HB', 'May 15, 2024', '09:00 AM - 11:00 AM', '806 (021161102-0212330155)'),
(1958, 'BSEEE', 'EEE 1003/EEE 103', 'Electrical Circuits II', 'C', 'MdZA', 'May 15, 2024', '09:00 AM - 11:00 AM', '804 (021183004-0212330065)                                                                                                                                                                                                                       805 (0212330084-0212330163)'),
(1959, 'BSEEE', 'EEE 1003/EEE 103', 'Electrical Circuits II', 'D', 'MAf', 'May 15, 2024', '09:00 AM - 11:00 AM', '903 (021221098-0212330045)                                                                                                                                                                                                                       322 (0212330047-0212330165)'),
(1960, 'BSEEE', 'EEE 303/EEE 3305', 'Engineering Electromagnetics', 'A', 'BKM', 'May 15, 2024', '09:00 AM - 11:00 AM', '803 (021162038-021221086)'),
(1961, 'BSEEE', 'CHE 2101/CHEM 101', 'Chemistry', 'A', 'MASq', 'May 15, 2024', '11:30 AM - 01:30 PM', '803 (021201100-0212230026)                                                                                                                                                                                                                       804 (0212230064-0212310065)'),
(1962, 'BSCSE', 'CSE 1111', 'Structured Programming Language', 'A', 'IMK', 'May 15, 2024', '11:30 AM - 01:30 PM', '324 (011221149-0112330423)                                                                                                                                                                                                                       325 (0112330561-0112331154)'),
(1963, 'BSCSE', 'CSE 1111', 'Structured Programming Language', 'AA', 'KM', 'May 15, 2024', '11:30 AM - 01:30 PM', '602 (011193092-0112330778)                                                                                                                                                                                                                       603 (0112330781-0112331149)'),
(1964, 'BSCSE', 'CSE 1111', 'Structured Programming Language', 'AB', 'MdTH', 'May 15, 2024', '11:30 AM - 01:30 PM', '630 (011221509-0112330457)                                                                                                                                                                                                                       631 (0112330458-0112331170)'),
(1965, 'BSCSE', 'CSE 1111', 'Structured Programming Language', 'B', 'MNH', 'May 15, 2024', '11:30 AM - 01:30 PM', '328 (011213093-0112330063)                                                                                                                                                                                                                       329 (0112330103-0112331173)'),
(1966, 'BSCSE', 'CSE 1111', 'Structured Programming Language', 'C', 'SAhSh', 'May 15, 2024', '11:30 AM - 01:30 PM', '224 (011221213-0112330519)                                                                                                                                                                                                                       225 (0112330566-0112331140)'),
(1967, 'BSCSE', 'CSE 1111', 'Structured Programming Language', 'D', 'SA', 'May 15, 2024', '11:30 AM - 01:30 PM', '322 (011201169-0112330413)                                                                                                                                                                                                                       323 (0112330425-0112331046)'),
(1968, 'BSCSE', 'CSE 1111', 'Structured Programming Language', 'F', 'SSSk', 'May 15, 2024', '11:30 AM - 01:30 PM', '330 (011213116-0112330494)                                                                                                                                                                                                                       401 (0112330501-0112331144)'),
(1969, 'BSCSE', 'CSE 1111', 'Structured Programming Language', 'G', 'SiMa', 'May 15, 2024', '11:30 AM - 01:30 PM', '206 (011213031-0112330146)                                                                                                                                                                                                                       207 (0112330183-0112331160)'),
(1970, 'BSCSE', 'CSE 1111', 'Structured Programming Language', 'H', 'FdAR', 'May 15, 2024', '11:30 AM - 01:30 PM', '222 (011212073-0112330327)                                                                                                                                                                                                                       223 (0112330338-0112331079)'),
(1971, 'BSCSE', 'CSE 1111', 'Structured Programming Language', 'I', 'NHn', 'May 15, 2024', '11:30 AM - 01:30 PM', '402 (011221343-0112330329)                                                                                                                                                                                                                       403 (0112330334-0112331091)'),
(1972, 'BSCSE', 'CSE 1111', 'Structured Programming Language', 'J', 'MMAS', 'May 15, 2024', '11:30 AM - 01:30 PM', '425 (0112230457-0112330062)                                                                                                                                                                                                                       428 (0112330065-0112331049)'),
(1973, 'BSCSE', 'CSE 1111', 'Structured Programming Language', 'K', 'ATR', 'May 15, 2024', '11:30 AM - 01:30 PM', '210 (011222252-0112330717)                                                                                                                                                                                                                       211 (0112330792-0112331171)'),
(1974, 'BSCSE', 'CSE 1111', 'Structured Programming Language', 'L', 'MoA', 'May 15, 2024', '11:30 AM - 01:30 PM', '432 (011222339-0112330418)                                                                                                                                                                                                                       601 (0112330448-0112331026)'),
(1975, 'BSCSE', 'CSE 1111', 'Structured Programming Language', 'M', 'ME', 'May 15, 2024', '11:30 AM - 01:30 PM', '632 (011221438-0112330445)                                                                                                                                                                                                                       701 (0112330446-0112331117)'),
(1976, 'BSCSE', 'CSE 1111', 'Structured Programming Language', 'N', 'NtJT', 'May 15, 2024', '11:30 AM - 01:30 PM', '409 (011221084-0112330325)                                                                                                                                                                                                                       410 (0112330346-0112331094)'),
(1977, 'BSCSE', 'CSE 1111', 'Structured Programming Language', 'O', 'NtJT', 'May 15, 2024', '11:30 AM - 01:30 PM', '706 (011192153-0112330478)                                                                                                                                                                                                                       707 (0112330592-0112331114)'),
(1978, 'BSCSE', 'CSE 1111', 'Structured Programming Language', 'P', 'NSS', 'May 15, 2024', '11:30 AM - 01:30 PM', '208 (0112230010-0112330608)                                                                                                                                                                                                                       209 (0112330633-0112331161)'),
(1979, 'BSCSE', 'CSE 1111', 'Structured Programming Language', 'Q', 'CAG', 'May 15, 2024', '11:30 AM - 01:30 PM', '204 (011221212-0112330707)                                                                                                                                                                                                                       205 (0112330729-0112331167)'),
(1980, 'BSCSE', 'CSE 1111', 'Structured Programming Language', 'R', 'ME', 'May 15, 2024', '11:30 AM - 01:30 PM', '429 (011211073-0112330143)                                                                                                                                                                                                                       431 (0112330150-0112331083)'),
(1981, 'BSCSE', 'CSE 1111', 'Structured Programming Language', 'S', 'MiBa', 'May 15, 2024', '11:30 AM - 01:30 PM', '804 (011221472-0112330444)                                                                                                                                                                                                                       803 (0112330463-0112331151)'),
(1982, 'BSCSE', 'CSE 1111', 'Structured Programming Language', 'T', 'KM', 'May 15, 2024', '11:30 AM - 01:30 PM', '604 (0112310110-0112330502)                                                                                                                                                                                                                       605 (0112330683-0112331166)'),
(1983, 'BSCSE', 'CSE 1111', 'Structured Programming Language', 'U', 'ME', 'May 15, 2024', '11:30 AM - 01:30 PM', '708 (011212026-0112330395)                                                                                                                                                                                                                       711 (0112330396-0112331103)'),
(1984, 'BSCSE', 'CSE 1111', 'Structured Programming Language', 'W', 'MTR', 'May 15, 2024', '11:30 AM - 01:30 PM', '702 (011202100-0112330414)                                                                                                                                                                                                                       703 (0112330422-0112331106)'),
(1985, 'BSCSE', 'CSE 1111', 'Structured Programming Language', 'X', 'HS', 'May 15, 2024', '11:30 AM - 01:30 PM', '722 (011202210-0112330198)                                                                                                                                                                                                                       723 (0112330200-0112331093)'),
(1986, 'BSCSE', 'CSE 1111', 'Structured Programming Language', 'Y', 'SSSk', 'May 15, 2024', '11:30 AM - 01:30 PM', '405 (011213188-0112320099)                                                                                                                                                                                                                       406 (0112320229-0112331168)'),
(1987, 'BSCSE', 'CSE 1111', 'Structured Programming Language', 'Z', 'RaR', 'May 15, 2024', '11:30 AM - 01:30 PM', '411 (011193012-0112330298)                                                                                                                                                                                                                       423 (0112330299-0112331155)'),
(1988, 'BSCSE', 'CSE 1111/CSI 121', 'Structured Programming Language', 'E', 'ATR', 'May 15, 2024', '11:30 AM - 01:30 PM', '805 (011181210-0112330353)                                                                                                                                                                                                                       806 (0112330438-0112331131)'),
(1989, 'BSCSE', 'CSE 1111/CSI 121', 'Structured Programming Language', 'V', 'MdTH', 'May 15, 2024', '11:30 AM - 01:30 PM', '407 (011201410-0112330035)                                                                                                                                                                                                                       408 (0112330079-0112331105)'),
(1990, 'BSCSE', 'CSE 4435', 'Software Architecture', 'A', 'MHAK', 'May 15, 2024', '11:30 AM - 01:30 PM', '425 (011183006-011201235)                                                                                                                                                                                                                       428 (011201236-011203023)'),
(1991, 'BSCSE', 'CSE 4435', 'Software Architecture', 'B', 'FTU', 'May 15, 2024', '11:30 AM - 01:30 PM', '429 (011183050-011201330)                                                                                                                                                                                                                       431 (011201344-011213005)'),
(1992, 'BSCSE', 'CSE 4435', 'Software Architecture', 'C', 'AAU', 'May 15, 2024', '11:30 AM - 01:30 PM', '432 (011183062-011212167)'),
(1993, 'BSDS', 'DS 1501', 'Programming for Data Science', 'BA', 'KBJ', 'May 15, 2024', '11:30 AM - 01:30 PM', '323 (0152230002-0152410010)                                                                                                                                                                                                                       324 (0152410011-0152410057)'),
(1994, 'BSDS', 'DS 1501', 'Programming for Data Science', 'BB', 'SMTT', 'May 15, 2024', '11:30 AM - 01:30 PM', '903 (015222004-0152410029)                                                                                                                                                                                                                       322 (0152410030-0152410063)'),
(1995, 'BSDS', 'DS 1501', 'Programming for Data Science', 'BC', 'MdTH', 'May 15, 2024', '11:30 AM - 01:30 PM', '325 (015221002-0152410071)'),
(1996, 'BSEEE', 'EEE 307/EEE 3207', 'Power Electronics', 'A', 'IA', 'May 15, 2024', '11:30 AM - 01:30 PM', '328 (021131142-021193026)                                                                                                                                                                                                                       329 (021201003-021211024)'),
(1997, 'BSCSE', 'CSE 323/CSE 3711', 'Computer Networks', 'C', 'MTR', 'May 15, 2024', '02:00 PM - 04:00 PM', '405 (011181255-011212092)                                                                                                                                                                                                                       406 (011212132-011221362)'),
(1998, 'BSCSE', 'CSE 323/CSE 3711/EEE 4413', 'Computer Networks', 'A', 'AKMMI', 'May 15, 2024', '02:00 PM - 04:00 PM', '407 (011192097-011221005)                                                                                                                                                                                                                       408 (011221010-021192040)'),
(1999, 'BSCSE', 'CSE 3711', 'Computer Networks', 'B', 'MdMH', 'May 15, 2024', '02:00 PM - 04:00 PM', '411 (011191099-011213084)                                                                                                                                                                                                                       423 (011213146-011222091)'),
(2000, 'BSCSE', 'CSE 3711', 'Computer Networks', 'D', 'MdMH', 'May 15, 2024', '02:00 PM - 04:00 PM', '409 (011191087-011213082)                                                                                                                                                                                                                       410 (011213088-011221426)'),
(2001, 'BSEEE', 'EEE 2105/EEE 223', 'Digital Electronics', 'A', 'IBC', 'May 15, 2024', '02:00 PM - 04:00 PM', '803 (021171016-021221035)                                                                                                                                                                                                                       804 (021221041-021222047)'),
(2002, 'BSCSE', 'CSE 3411/CSI 311', 'System Analysis and Design', 'A', 'SA', 'May 16, 2024', '09:00 AM - 11:00 AM', '805 (011172009-011211034)                                                                                                                                                                                                                       806 (011212032-011222315)'),
(2003, 'BSCSE', 'CSE 3411/CSI 311', 'System Analysis and Design', 'B', 'AbAd', 'May 16, 2024', '09:00 AM - 11:00 AM', '903 (011192101-011213005)                                                                                                                                                                                                                       322 (011213011-011222085)'),
(2004, 'BSCSE', 'CSE 3411/CSI 311', 'System Analysis and Design', 'C', 'SuIm', 'May 16, 2024', '09:00 AM - 11:00 AM', '804 (011172130-0112310573)'),
(2005, 'BSCSE', 'CSE 3521', 'Database Management Systems', 'B', 'FAH', 'May 16, 2024', '09:00 AM - 11:00 AM', '903 (011191059-011221217)                                                                                                                                                                                                                       322 (011221261-0112230922)'),
(2006, 'BSCSE', 'CSE 3521', 'Database Management Systems', 'D', 'ABF', 'May 16, 2024', '09:00 AM - 11:00 AM', '411 (011183016-011221126)                                                                                                                                                                                                                       325 (011221135-0112230653)'),
(2007, 'BSCSE', 'CSE 3521', 'Database Management Systems', 'E', 'KAN', 'May 16, 2024', '09:00 AM - 11:00 AM', '423 (011201011-011221214)                                                                                                                                                                                                                       804 (011221224-011222245)'),
(2008, 'BSCSE', 'CSE 3521/CSI 221', 'Database Management Systems', 'A', 'SaIs', 'May 16, 2024', '09:00 AM - 11:00 AM', '323 (011191246-011221140)                                                                                                                                                                                                                       324 (011221155-011222215)'),
(2009, 'BSCSE', 'CSE 3521/CSI 221', 'Database Management Systems', 'F', 'FAH', 'May 16, 2024', '09:00 AM - 11:00 AM', '805 (011181216-011221080)                                                                                                                                                                                                                       806 (011221152-0112310484)'),
(2010, 'BSEEE', 'EEE 1001/EEE 101', 'Electrical Circuits I', 'A', 'MRK', 'May 16, 2024', '09:00 AM - 11:00 AM', '409 (021211027-0212330136)                                                                                                                                                                                                                       410 (0212330141-0212410049)'),
(2011, 'BSEEE', 'EEE 1001/EEE 101', 'Electrical Circuits I', 'B', 'MRK', 'May 16, 2024', '09:00 AM - 11:00 AM', '407 (021183013-0212330110)                                                                                                                                                                                                                       408 (0212330114-0212410052)'),
(2012, 'BSEEE', 'EEE 301/EEE 3107', 'Electrical Properties of Materials', 'A', 'IBC', 'May 16, 2024', '09:00 AM - 11:00 AM', '405 (021161102-021221017)                                                                                                                                                                                                                       406 (021221023-0212320027)'),
(2013, 'BSEEE', 'EEE 4117/EEE 435', 'Analog Integrated Circuits', 'A', 'IBC', 'May 16, 2024', '09:00 AM - 11:00 AM', '803 (021153011-021211024)'),
(2014, 'BSCSE', 'EEE 4261', 'Green Computing', 'A', 'MNTA', 'May 16, 2024', '09:00 AM - 11:00 AM', '329 (011183008-011201231)                                                                                                                                                                                                                       330 (011201240-011211052)'),
(2015, 'BSCSE', 'EEE 4261', 'Green Computing', 'B', 'CAG', 'May 16, 2024', '09:00 AM - 11:00 AM', '403 (011183034-011201434)                                                                                                                                                                                                                       404 (011201437-011221435)'),
(2016, 'BSCSE', 'EEE 4261', 'Green Computing', 'C', 'IAb', 'May 16, 2024', '09:00 AM - 11:00 AM', '401 (011192089-011201219)                                                                                                                                                                                                                       402 (011201224-011213067)'),
(2017, 'BSCSE', 'EEE 4261', 'Green Computing', 'D', 'MdMIm', 'May 16, 2024', '09:00 AM - 11:00 AM', '325 (011183096-011202063)                                                                                                                                                                                                                       328 (011202099-0112410281)'),
(2018, 'BSCSE', 'MATH 201/MATH 2201', 'Coordinate Geometry and Vector Analysis', 'E', 'MdAn', 'May 16, 2024', '09:00 AM - 11:00 AM', '409 (011163072-0112230688)                                                                                                                                                                                                                       410 (0112230747-0112310578)'),
(2019, 'BSCSE', 'MATH 201/MATH 2201', 'Coordinate Geometry and Vector Analysis', 'I', 'SMYA', 'May 16, 2024', '09:00 AM - 11:00 AM', '405 (011153072-0112230397)                                                                                                                                                                                                                       406 (0112230398-0112320037)'),
(2020, 'BSCSE', 'MATH 201/MATH 2201', 'Coordinate Geometry and Vector Analysis', 'J', 'KAE', 'May 16, 2024', '09:00 AM - 11:00 AM', '403 (011162093-0112230532)                                                                                                                                                                                                                       404 (0112230533-0112310530)'),
(2021, 'BSCSE', 'MATH 201/MATH 2201', 'Coordinate Geometry and Vector Analysis', 'M', 'KAE', 'May 16, 2024', '09:00 AM - 11:00 AM', '411 (011162120-0112230420)                                                                                                                                                                                                                       423 (0112230564-0112310503)'),
(2022, 'BSCSE', 'MATH 201/MATH 2201', 'Coordinate Geometry and Vector Analysis', 'O', 'SiMu', 'May 16, 2024', '09:00 AM - 11:00 AM', '401 (011123071-0112230345)                                                                                                                                                                                                                       402 (0112230421-0112331150)'),
(2023, 'BSCSE', 'MATH 2201', 'Coordinate Geometry and Vector Analysis', 'A', 'MdAn', 'May 16, 2024', '09:00 AM - 11:00 AM', '328 (011212095-0112230708)                                                                                                                                                                                                                       329 (0112230758-0112320229)'),
(2024, 'BSCSE', 'MATH 2201', 'Coordinate Geometry and Vector Analysis', 'D', 'SMYA', 'May 16, 2024', '09:00 AM - 11:00 AM', '330 (011201440-0112310592)'),
(2025, 'BSCSE', 'MATH 2201', 'Coordinate Geometry and Vector Analysis', 'H', 'KAE', 'May 16, 2024', '09:00 AM - 11:00 AM', '407 (011213111-0112230248)                                                                                                                                                                                                                       408 (0112230260-0112310607)'),
(2026, 'BSCSE', 'MATH 2201', 'Coordinate Geometry and Vector Analysis', 'K', 'SMYA', 'May 16, 2024', '09:00 AM - 11:00 AM', '425 (011201055-0112230392)                                                                                                                                                                                                                       428 (0112230427-0112320001)'),
(2027, 'BSCSE', 'CSE 2217', 'Data Structure and Algorithms II', 'A', 'TaHn', 'May 16, 2024', '11:30 AM - 01:30 PM', '404 (011192032-011221457)                                                                                                                                                                                                                       405 (011221513-0112231018)'),
(2028, 'BSCSE', 'CSE 2217', 'Data Structure and Algorithms II', 'B', 'MdSR', 'May 16, 2024', '11:30 AM - 01:30 PM', '409 (011193038-011222070)                                                                                                                                                                                                                       410 (011222182-0112331150)'),
(2029, 'BSCSE', 'CSE 2217', 'Data Structure and Algorithms II', 'C', 'MdShA', 'May 16, 2024', '11:30 AM - 01:30 PM', '407 (011191099-011221567)                                                                                                                                                                                                                       408 (011222011-0112230466)'),
(2030, 'BSCSE', 'CSE 2217', 'Data Structure and Algorithms II', 'D', 'TaHn', 'May 16, 2024', '11:30 AM - 01:30 PM', '803 (011183095-011221495)                                                                                                                                                                                                                       805 (011221522-0112230972)'),
(2031, 'BSCSE', 'CSE 2217/CSI 227', 'Algorithms/Data Structure and Algorithms II', 'E', 'MdShA', 'May 16, 2024', '11:30 AM - 01:30 PM', '423 (011183014-011221476)                                                                                                                                                                                                                       425 (011221481-0112230947)'),
(2032, 'BSCSE', 'CSE 2217/CSI 227', 'Algorithms/Data Structure and Algorithms II', 'F', 'MdSR', 'May 16, 2024', '11:30 AM - 01:30 PM', '406 (011172007-0112230653)'),
(2033, 'BSEEE', 'EEE 309/EEE 3307', 'Communication Theory', 'A', 'BKM', 'May 16, 2024', '11:30 AM - 01:30 PM', '803 (021131142-021213032)'),
(2034, 'BSEEE', 'MAT 2105', 'Linear Algebra and Differential Equations', 'A', 'NPn', 'May 16, 2024', '11:30 AM - 01:30 PM', '804 (021183008-0212330008)'),
(2035, 'BSEEE', 'MAT 2105', 'Linear Algebra and Differential Equations', 'B', 'NPn', 'May 16, 2024', '11:30 AM - 01:30 PM', '805 (021183004-0212320009)'),
(2036, 'BSCSE', 'CSE 1115', 'Object Oriented Programming', 'A', 'MdRIm', 'May 16, 2024', '02:00 PM - 04:00 PM', '323 (011211019-0112230634)                                                                                                                                                                                                                       324 (0112230703-0112320276)'),
(2037, 'BSCSE', 'CSE 1115', 'Object Oriented Programming', 'B', 'MNK', 'May 16, 2024', '02:00 PM - 04:00 PM', '903 (011201271-0112310084)                                                                                                                                                                                                                       322 (0112310285-0112320293)'),
(2038, 'BSCSE', 'CSE 1115', 'Object Oriented Programming', 'C', 'UR', 'May 16, 2024', '02:00 PM - 04:00 PM', '325 (011191001-0112310350)                                                                                                                                                                                                                       328 (0112310363-0112320284)'),
(2039, 'BSCSE', 'CSE 1115', 'Object Oriented Programming', 'D', 'DMF', 'May 16, 2024', '02:00 PM - 04:00 PM', '409 (011213125-0112320253)'),
(2040, 'BSCSE', 'CSE 1115', 'Object Oriented Programming', 'E', 'MNK', 'May 16, 2024', '02:00 PM - 04:00 PM', '403 (011212081-0112310429)                                                                                                                                                                                                                       404 (0112310479-0112320287)'),
(2041, 'BSCSE', 'CSE 1115', 'Object Oriented Programming', 'F', 'DMF', 'May 16, 2024', '02:00 PM - 04:00 PM', '329 (011201031-0112320283)'),
(2042, 'BSCSE', 'CSE 1115', 'Object Oriented Programming', 'G', 'MdRIm', 'May 16, 2024', '02:00 PM - 04:00 PM', '401 (011213104-0112310095)                                                                                                                                                                                                                       402 (0112310098-0112320135)'),
(2043, 'BSCSE', 'CSE 1115', 'Object Oriented Programming', 'H', 'MNK', 'May 16, 2024', '02:00 PM - 04:00 PM', '405 (011193147-0112230980)                                                                                                                                                                                                                       406 (0112231054-0112320199)'),
(2044, 'BSCSE', 'CSE 1115', 'Object Oriented Programming', 'I', 'AAJr', 'May 16, 2024', '02:00 PM - 04:00 PM', '407 (011201388-0112310018)                                                                                                                                                                                                                       408 (0112310021-0112320239)'),
(2045, 'BSCSE', 'CSE 1115', 'Object Oriented Programming', 'M', 'MoI', 'May 16, 2024', '02:00 PM - 04:00 PM', '330 (011193029-0112320190)'),
(2046, 'BSCSE', 'CSE 1115/CSI 211', 'Object Oriented Programming/Object-Oriented Programming', 'N', 'SaIs', 'May 16, 2024', '02:00 PM - 04:00 PM', '410 (011172007-0112320151)'),
(2047, 'BSCSE', 'CSE 3421/CSI 321', 'Software Engineering', 'A', 'SSSk', 'May 16, 2024', '02:00 PM - 04:00 PM', '805 (011172150-011202080)                                                                                                                                                                                                                       806 (011202081-011213039)'),
(2048, 'BSCSE', 'CSE 3421/CSI 321', 'Software Engineering', 'B', 'FTU', 'May 16, 2024', '02:00 PM - 04:00 PM', '323 (011151218-011193126)                                                                                                                                                                                                                       324 (011193145-0112230773)'),
(2049, 'BSDS', 'DS 1115', 'Object Oriented Programming for Data Science', 'BA', 'SMTT', 'May 16, 2024', '02:00 PM - 04:00 PM', '322 (015222001-0152330153)'),
(2050, 'BSDS', 'DS 1115', 'Object Oriented Programming for Data Science', 'BB', 'SS', 'May 16, 2024', '02:00 PM - 04:00 PM', '804 (015221001-0152330048)                                                                                                                                                                                                                       805 (0152330049-0152330154)'),
(2051, 'BSDS', 'DS 1115', 'Object Oriented Programming for Data Science', 'BC', 'MdARa', 'May 16, 2024', '02:00 PM - 04:00 PM', '806 (0152310004-0152330090)                                                                                                                                                                                                                       903 (0152330093-0152330145)'),
(2052, 'BSEEE', 'EEE 4315/EEE 455', 'Digital Communication', 'A', 'RM', 'May 16, 2024', '02:00 PM - 04:00 PM', '803 (021191050-021203013)'),
(2053, 'BSCSE', 'BDS 1201', 'History of the Emergence of Bangladesh', 'AA', 'FaAM', 'May 18, 2024', '09:00 AM - 11:00 AM', '324 (0112230305-0112410021)                                                                                                                                                                                                                       325 (0112410022-0112410475)'),
(2054, 'BSCSE', 'BDS 1201', 'History of the Emergence of Bangladesh', 'AB', 'MD', 'May 18, 2024', '09:00 AM - 11:00 AM', '404 (0112230236-0112410043)                                                                                                                                                                                                                       405 (0112410045-0112410548)'),
(2055, 'BSCSE', 'BDS 1201', 'History of the Emergence of Bangladesh', 'AC', 'SaB', 'May 18, 2024', '09:00 AM - 11:00 AM', '322 (0112310571-0112410069)                                                                                                                                                                                                                       323 (0112410070-0112410495)'),
(2056, 'BSCSE', 'BDS 1201', 'History of the Emergence of Bangladesh', 'AD', 'NaSa', 'May 18, 2024', '09:00 AM - 11:00 AM', '601 (011211073-0112410090)                                                                                                                                                                                                                       602 (0112410091-0112410481)');
INSERT INTO `midfinalroutine` (`id`, `Dept`, `CourseCode`, `CourseTitle`, `Section`, `Teacher`, `ExamDate`, `ExamTime`, `Room`) VALUES
(2057, 'BSCSE', 'BDS 1201', 'History of the Emergence of Bangladesh', 'AE', 'MD', 'May 18, 2024', '09:00 AM - 11:00 AM', '408 (011211032-0112410120)                                                                                                                                                                                                                       409 (0112410121-0152410070)'),
(2058, 'BSCSE', 'BDS 1201', 'History of the Emergence of Bangladesh', 'AF', 'NaSa', 'May 18, 2024', '09:00 AM - 11:00 AM', '328 (0112230006-0112410409)                                                                                                                                                                                                                       329 (0112410410-0152410071)'),
(2059, 'BSCSE', 'BDS 1201', 'History of the Emergence of Bangladesh', 'AG', 'FaAM', 'May 18, 2024', '09:00 AM - 11:00 AM', '431 (0112410153-0112410175)                                                                                                                                                                                                                       432 (0112410329-0112410504)'),
(2060, 'BSCSE', 'BDS 1201', 'History of the Emergence of Bangladesh', 'AH', 'SaB', 'May 18, 2024', '09:00 AM - 11:00 AM', '330 (0112410117-0112410196)                                                                                                                                                                                                                       401 (0112410197-0152410063)'),
(2061, 'BSCSE', 'BDS 1201', 'History of the Emergence of Bangladesh', 'AI', 'MD', 'May 18, 2024', '09:00 AM - 11:00 AM', '406 (0112230854-0112410341)                                                                                                                                                                                                                       407 (0112410342-0112410543)'),
(2062, 'BSCSE', 'BDS 1201', 'History of the Emergence of Bangladesh', 'AJ', 'FaAM', 'May 18, 2024', '09:00 AM - 11:00 AM', '410 (011222068-0112410308)                                                                                                                                                                                                                       411 (0112410309-0152330113)'),
(2063, 'BSCSE', 'BDS 1201', 'History of the Emergence of Bangladesh', 'AK', 'KhSA', 'May 18, 2024', '09:00 AM - 11:00 AM', '402 (011221302-0112410246)                                                                                                                                                                                                                       403 (0112410248-0112410536)'),
(2064, 'BSCSE', 'BDS 1201', 'History of the Emergence of Bangladesh', 'AM', 'NaSa', 'May 18, 2024', '09:00 AM - 11:00 AM', '603 (0112330138-0112410429)                                                                                                                                                                                                                       604 (0112410444-0112410541)'),
(2065, 'BSDS', 'BDS 1201', 'History of the Emergence of Bangladesh', 'BA', 'NaSa', 'May 18, 2024', '09:00 AM - 11:00 AM', '423 (0112320080-0152410010)                                                                                                                                                                                                                       425 (0152410011-0152410068)'),
(2066, 'BSDS', 'BDS 1201', 'History of the Emergence of Bangladesh', 'BB', 'MD', 'May 18, 2024', '09:00 AM - 11:00 AM', '428 (0112410379-0152410027)                                                                                                                                                                                                                       429 (0152410028-0152410062)'),
(2067, 'BSEEE', 'BDS 1201', 'History of the Emergence of Bangladesh', 'P', 'TaIm', 'May 18, 2024', '09:00 AM - 11:00 AM', '804 (0112230340-0212410003)                                                                                                                                                                                                                       805 (0212410004-0212410052)'),
(2068, 'BSEEE', 'BDS 1201', 'History of the Emergence of Bangladesh', 'Q', 'TaIm', 'May 18, 2024', '09:00 AM - 11:00 AM', '806 (0112330179-0212410020)                                                                                                                                                                                                                       903 (0212410021-0212410049)'),
(2069, 'BSCSE', 'ECO 213/ECO 4101', 'Economics', 'B', 'AAsh', 'May 18, 2024', '09:00 AM - 11:00 AM', '803 (011181014-011221096)                                                                                                                                                                                                                       805 (011221104-0152320001)'),
(2070, 'BSCSE', 'ECO 4101', 'Economics', 'A', 'SCT', 'May 18, 2024', '09:00 AM - 11:00 AM', '328 (011191168-011213189)                                                                                                                                                                                                                       329 (011221024-0112310466)'),
(2071, 'BSEEE', 'EEE 311/EEE 3309', 'Digital Signal Processing', 'A', 'HAS', 'May 18, 2024', '09:00 AM - 11:00 AM', '803 (021163019-021201045)                                                                                                                                                                                                                       804 (021201057-0212320027)'),
(2072, 'BSEEE', 'ACT 111/ACT 3101', 'Financial and Managerial Accounting', 'D', 'MdAHn', 'May 18, 2024', '11:30 AM - 01:30 PM', '803 (021191014-021221006)                                                                                                                                                                                                                       804 (021221007-0212230076)'),
(2073, 'BSEEE', 'MAT 2107/MATH 187', 'Complex Variables, Fourier and Laplace Transforms/Fourier & Laplace Transformations & Complex Variable', 'A', 'AM', 'May 18, 2024', '11:30 AM - 01:30 PM', '405 (021161098-021222018)                                                                                                                                                                                                                       409 (021222037-0212310041)'),
(2074, 'BSEEE', 'MAT 2107/MATH 187', 'Complex Variables, Fourier and Laplace Transforms/Fourier & Laplace Transformations & Complex Variable', 'B', 'TN', 'May 18, 2024', '11:30 AM - 01:30 PM', '403 (021173038-0212230064)                                                                                                                                                                                                                       404 (0212230082-0212310076)'),
(2075, 'BSCSE', 'MATH 1151', 'Fundamental Calculus', 'A', 'MUn', 'May 18, 2024', '11:30 AM - 01:30 PM', '631 (011212006-0112330451)                                                                                                                                                                                                                       630 (0112330644-0112331098)'),
(2076, 'BSCSE', 'MATH 1151', 'Fundamental Calculus', 'AA', 'SMYA', 'May 18, 2024', '11:30 AM - 01:30 PM', '603 (0112230016-0112330369)                                                                                                                                                                                                                       604 (0112330403-0112331153)'),
(2077, 'BSCSE', 'MATH 1151', 'Fundamental Calculus', 'AB', 'NPn', 'May 18, 2024', '11:30 AM - 01:30 PM', '429 (011213050-0112331163)'),
(2078, 'BSCSE', 'MATH 1151', 'Fundamental Calculus', 'AC', 'MdAn', 'May 18, 2024', '11:30 AM - 01:30 PM', '403 (011193026-0112230776)                                                                                                                                                                                                                       404 (0112231066-0112410518)'),
(2079, 'BSCSE', 'MATH 1151', 'Fundamental Calculus', 'B', 'MMBK', 'May 18, 2024', '11:30 AM - 01:30 PM', '632 (0112230093-0112330251)                                                                                                                                                                                                                       701 (0112330377-0112410513)'),
(2080, 'BSDS', 'MATH 1151', 'Fundamental Calculus', 'BA', 'MUn', 'May 18, 2024', '11:30 AM - 01:30 PM', '601 (011221438-0152330039)                                                                                                                                                                                                                       602 (0152330040-0152330150)'),
(2081, 'BSDS', 'MATH 1151', 'Fundamental Calculus', 'BB', 'AkAd', 'May 18, 2024', '11:30 AM - 01:30 PM', '431 (0112230270-0152330058)                                                                                                                                                                                                                       432 (0152330059-0152330154)'),
(2082, 'BSDS', 'MATH 1151', 'Fundamental Calculus', 'BC', 'AkAd', 'May 18, 2024', '11:30 AM - 01:30 PM', '603 (0112330908-0152330094)                                                                                                                                                                                                                       604 (0152330099-0152410012)'),
(2083, 'BSDS', 'MATH 1151', 'Fundamental Calculus', 'BD', 'MUn', 'May 18, 2024', '11:30 AM - 01:30 PM', '605 (0112230443-0112330663)                                                                                                                                                                                                                       630 (0112330700-0152330143)'),
(2084, 'BSCSE', 'MATH 1151', 'Fundamental Calculus', 'C', 'JFK', 'May 18, 2024', '11:30 AM - 01:30 PM', '706 (011222304-0112330362)                                                                                                                                                                                                                       707 (0112330388-0112331103)'),
(2085, 'BSCSE', 'MATH 1151', 'Fundamental Calculus', 'D', 'JFK', 'May 18, 2024', '11:30 AM - 01:30 PM', '702 (011191109-0112330336)                                                                                                                                                                                                                       703 (0112330494-0112331160)'),
(2086, 'BSCSE', 'MATH 1151', 'Fundamental Calculus', 'E', 'MMBK', 'May 18, 2024', '11:30 AM - 01:30 PM', '211 (011212019-0112310528)                                                                                                                                                                                                                       222 (0112310577-0112331075)'),
(2087, 'BSCSE', 'MATH 1151', 'Fundamental Calculus', 'F', 'AkAd', 'May 18, 2024', '11:30 AM - 01:30 PM', '722 (011191086-0112330139)                                                                                                                                                                                                                       723 (0112330145-0112331157)'),
(2088, 'BSCSE', 'MATH 1151', 'Fundamental Calculus', 'G', 'MdAn', 'May 18, 2024', '11:30 AM - 01:30 PM', '708 (011222217-0112330398)                                                                                                                                                                                                                       711 (0112330400-0112331106)'),
(2089, 'BSCSE', 'MATH 1151', 'Fundamental Calculus', 'H', 'JFK', 'May 18, 2024', '11:30 AM - 01:30 PM', '401 (0112230508-0112330383)                                                                                                                                                                                                                       402 (0112330390-0112331130)'),
(2090, 'BSCSE', 'MATH 1151', 'Fundamental Calculus', 'I', 'MdAn', 'May 18, 2024', '11:30 AM - 01:30 PM', '325 (011213198-0112330607)                                                                                                                                                                                                                       328 (0112330626-0152410011)'),
(2091, 'BSCSE', 'MATH 1151', 'Fundamental Calculus', 'J', 'MdAIm', 'May 18, 2024', '11:30 AM - 01:30 PM', '805 (011221445-0112330148)                                                                                                                                                                                                                       806 (0112330167-0112330968)'),
(2092, 'BSCSE', 'MATH 1151', 'Fundamental Calculus', 'K', 'MJU', 'May 18, 2024', '11:30 AM - 01:30 PM', '329 (0112230218-0112330412)                                                                                                                                                                                                                       330 (0112330429-0112331173)'),
(2093, 'BSCSE', 'MATH 1151', 'Fundamental Calculus', 'L', 'JFK', 'May 18, 2024', '11:30 AM - 01:30 PM', '805 (011191001-0112330108)                                                                                                                                                                                                                       806 (0112330130-0112331148)'),
(2094, 'BSCSE', 'MATH 1151', 'Fundamental Calculus', 'M', 'MdAsn', 'May 18, 2024', '11:30 AM - 01:30 PM', '407 (011221258-0112330274)                                                                                                                                                                                                                       408 (0112330295-0112410253)'),
(2095, 'BSCSE', 'MATH 1151', 'Fundamental Calculus', 'N', 'MtrRn', 'May 18, 2024', '11:30 AM - 01:30 PM', '323 (011221190-0112330260)                                                                                                                                                                                                                       324 (0112330272-0112331126)'),
(2096, 'BSCSE', 'MATH 1151', 'Fundamental Calculus', 'O', 'MdAIm', 'May 18, 2024', '11:30 AM - 01:30 PM', '903 (011221597-0112330408)                                                                                                                                                                                                                       322 (0112330476-0112331158)'),
(2097, 'BSCSE', 'MATH 1151', 'Fundamental Calculus', 'P', 'SamAr', 'May 18, 2024', '11:30 AM - 01:30 PM', '223 (011202157-0112330281)                                                                                                                                                                                                                       224 (0112330348-0112331151)'),
(2098, 'BSCSE', 'MATH 1151', 'Fundamental Calculus', 'Q', 'MdAIm', 'May 18, 2024', '11:30 AM - 01:30 PM', '401 (011221488-0112330252)                                                                                                                                                                                                                       402 (0112330304-0112331097)'),
(2099, 'BSCSE', 'MATH 1151', 'Fundamental Calculus', 'R', 'SMYA', 'May 18, 2024', '11:30 AM - 01:30 PM', '803 (011212145-0112330486)                                                                                                                                                                                                                       804 (0112330489-0112331107)'),
(2100, 'BSCSE', 'MATH 1151', 'Fundamental Calculus', 'S', 'SiMu', 'May 18, 2024', '11:30 AM - 01:30 PM', '903 (011213117-0112330353)                                                                                                                                                                                                                       322 (0112330496-0112410295)'),
(2101, 'BSCSE', 'MATH 1151', 'Fundamental Calculus', 'T', 'MdAIm', 'May 18, 2024', '11:30 AM - 01:30 PM', '409 (0112230065-0112330686)                                                                                                                                                                                                                       410 (0112330690-0112331085)'),
(2102, 'BSCSE', 'MATH 1151', 'Fundamental Calculus', 'U', 'MtrRn', 'May 18, 2024', '11:30 AM - 01:30 PM', '405 (011221093-0112330510)                                                                                                                                                                                                                       406 (0112330512-0112331171)'),
(2103, 'BSCSE', 'MATH 1151', 'Fundamental Calculus', 'V', 'MdAsn', 'May 18, 2024', '11:30 AM - 01:30 PM', '225 (011212020-0112330147)                                                                                                                                                                                                                       228 (0112330178-0112331128)'),
(2104, 'BSCSE', 'MATH 1151', 'Fundamental Calculus', 'W', 'LRS', 'May 18, 2024', '11:30 AM - 01:30 PM', '425 (0112230061-0112330500)                                                                                                                                                                                                                       428 (0112330554-0112331125)'),
(2105, 'BSCSE', 'MATH 1151', 'Fundamental Calculus', 'X', 'MJU', 'May 18, 2024', '11:30 AM - 01:30 PM', '209 (011222357-0112330687)                                                                                                                                                                                                                       210 (0112330741-0112331138)'),
(2106, 'BSCSE', 'MATH 1151', 'Fundamental Calculus', 'Y', 'MtrRn', 'May 18, 2024', '11:30 AM - 01:30 PM', '411 (011213099-0112330768)                                                                                                                                                                                                                       423 (0112330770-0152330156)'),
(2107, 'BSCSE', 'MATH 1151', 'Fundamental Calculus', 'Z', 'MtrRn', 'May 18, 2024', '11:30 AM - 01:30 PM', '601 (0112230960-0112330763)                                                                                                                                                                                                                       602 (0112330766-0112410471)'),
(2108, 'BSCSE', 'CSE 123/EEE 2123', 'Electronics', 'A', 'TY', 'May 18, 2024', '02:00 PM - 04:00 PM', '601 (011162003-011213187)                                                                                                                                                                                                                       602 (011213195-0112230796)'),
(2109, 'BSCSE', 'CSE 315/CSE 3715', 'Data Communication', 'A', 'MHAK', 'May 18, 2024', '02:00 PM - 04:00 PM', '804 (011171282-0112230560)'),
(2110, 'BSCSE', 'CSE 4181/CSE 481', 'Mobile Application Development', 'A', 'MdARa', 'May 18, 2024', '02:00 PM - 04:00 PM', '805 (011123071-011212032)'),
(2111, 'BSCSE', 'CSE 4531', 'Computer Security', 'A', 'ShAn', 'May 18, 2024', '02:00 PM - 04:00 PM', '324 (011191068-011201209)                                                                                                                                                                                                                       325 (011201217-011222212)'),
(2112, 'BSCSE', 'CSE 4531', 'Computer Security', 'B', 'MMAS', 'May 18, 2024', '02:00 PM - 04:00 PM', '806 (011183017-011201239)                                                                                                                                                                                                                       903 (011201278-011221489)'),
(2113, 'BSCSE', 'CSE 4531', 'Computer Security', 'C', 'MNTA', 'May 18, 2024', '02:00 PM - 04:00 PM', '322 (011191110-011201328)                                                                                                                                                                                                                       323 (011201350-011213151)'),
(2114, 'BSEEE', 'EEE 211/EEE 2301', 'Signals and Linear System/Signals and Linear Systems', 'A', 'RM', 'May 18, 2024', '02:00 PM - 04:00 PM', '328 (021182023-021221050)                                                                                                                                                                                                                       329 (021221068-0212230062)'),
(2115, 'BSEEE', 'EEE 211/EEE 2301', 'Signals and Linear System/Signals and Linear Systems', 'B', 'RM', 'May 18, 2024', '02:00 PM - 04:00 PM', '330 (021171021-0212230061)'),
(2116, 'BSCSE', 'EEE 2113', 'Electrical Circuits', 'A', 'TY', 'May 18, 2024', '02:00 PM - 04:00 PM', '806 (011213009-0112230227)                                                                                                                                                                                                                       903 (0112230258-0112310550)'),
(2117, 'BSCSE', 'EEE 2113', 'Electrical Circuits', 'B', 'FaHa', 'May 18, 2024', '02:00 PM - 04:00 PM', '324 (011213077-0112310160)                                                                                                                                                                                                                       325 (0112310162-0112320059)'),
(2118, 'BSCSE', 'EEE 2113', 'Electrical Circuits', 'C', 'NtJT', 'May 18, 2024', '02:00 PM - 04:00 PM', '322 (011193122-0112230698)                                                                                                                                                                                                                       323 (0112230746-0112310220)'),
(2119, 'BSCSE', 'EEE 2113', 'Electrical Circuits', 'D', 'AbHn', 'May 18, 2024', '02:00 PM - 04:00 PM', '405 (011201313-0112231016)                                                                                                                                                                                                                       406 (0112231017-0112320246)'),
(2120, 'BSCSE', 'EEE 2113', 'Electrical Circuits', 'E', 'RBR', 'May 18, 2024', '02:00 PM - 04:00 PM', '407 (011183102-0112230745)                                                                                                                                                                                                                       408 (0112230788-0112310597)'),
(2121, 'BSCSE', 'EEE 2113', 'Electrical Circuits', 'F', 'JHE', 'May 18, 2024', '02:00 PM - 04:00 PM', '425 (011211053-0112230809)                                                                                                                                                                                                                       428 (0112230841-0112310606)'),
(2122, 'BSCSE', 'EEE 2113', 'Electrical Circuits', 'G', 'FaHa', 'May 18, 2024', '02:00 PM - 04:00 PM', '602 (011211032-0112230579)                                                                                                                                                                                                                       603 (0112230582-0112310262)'),
(2123, 'BSCSE', 'EEE 2113', 'Electrical Circuits', 'H', 'FaHa', 'May 18, 2024', '02:00 PM - 04:00 PM', '411 (011211049-0112230334)                                                                                                                                                                                                                       423 (0112230502-0112310594)'),
(2124, 'BSCSE', 'EEE 2113', 'Electrical Circuits', 'I', 'MSTR', 'May 18, 2024', '02:00 PM - 04:00 PM', '432 (011192050-0112230882)                                                                                                                                                                                                                       601 (0112230922-0112310575)'),
(2125, 'BSCSE', 'EEE 2113', 'Electrical Circuits', 'J', 'AbHn', 'May 18, 2024', '02:00 PM - 04:00 PM', '604 (011213051-0112230542)                                                                                                                                                                                                                       605 (0112230693-0112310466)'),
(2126, 'BSCSE', 'EEE 2113', 'Electrical Circuits', 'K', 'JHE', 'May 18, 2024', '02:00 PM - 04:00 PM', '429 (011202118-0112230677)                                                                                                                                                                                                                       431 (0112230912-0112320001)'),
(2127, 'BSCSE', 'EEE 2113', 'Electrical Circuits', 'L', 'AbAd', 'May 18, 2024', '02:00 PM - 04:00 PM', '409 (011202283-0112230762)                                                                                                                                                                                                                       410 (0112230785-0112331094)'),
(2128, 'BSCSE', 'EEE 2123', 'Electronics', 'B', 'TY', 'May 18, 2024', '02:00 PM - 04:00 PM', '431 (011191263-011221232)                                                                                                                                                                                                                       432 (011221252-0112231036)'),
(2129, 'BSCSE', 'EEE 2123', 'Electronics', 'C', 'RBR', 'May 18, 2024', '02:00 PM - 04:00 PM', '428 (011183005-011221126)                                                                                                                                                                                                                       429 (011221215-0112230638)'),
(2130, 'BSCSE', 'EEE 2123', 'Electronics', 'D', 'MdZA', 'May 18, 2024', '02:00 PM - 04:00 PM', '603 (011183016-011221192)                                                                                                                                                                                                                       604 (011221337-011222294)'),
(2131, 'BSCSE', 'EEE 2123', 'Electronics', 'F', 'RBR', 'May 18, 2024', '02:00 PM - 04:00 PM', '605 (011183077-0112230958)'),
(2132, 'BSEEE', 'PHY 101/PHY 1101', 'Physics I', 'B', 'GMB', 'May 18, 2024', '02:00 PM - 04:00 PM', '803 (021182018-0212330073)                                                                                                                                                                                                                       804 (0212330076-0212330164)'),
(2133, 'BSEEE', 'PHY 1101', 'Physics I', 'A', 'MAn', 'May 18, 2024', '02:00 PM - 04:00 PM', '328 (021191060-0212330097)                                                                                                                                                                                                                       329 (0212330098-0212330163)'),
(2134, 'BSEEE', 'PHY 1101', 'Physics I', 'C', 'GMB', 'May 18, 2024', '02:00 PM - 04:00 PM', '805 (0212320030-0212330158)'),
(2135, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'A', 'ME', 'May 19, 2024', '09:00 AM - 11:00 AM', 'Computer Lab 4 (0427) (0112320038-0112331133)'),
(2136, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'AA', 'KAN', 'May 19, 2024', '09:00 AM - 11:00 AM', 'Computer Lab 19 (0727) (0112230860-0112331149)'),
(2137, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'B', 'IMK', 'May 19, 2024', '09:00 AM - 11:00 AM', 'Computer Lab 7 (0522) (0112230461-0112331148)'),
(2138, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'C', 'MdTH', 'May 19, 2024', '09:00 AM - 11:00 AM', 'Computer Lab 20 (0424) (011221107-0112330945)'),
(2139, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'D', 'MHAK', 'May 19, 2024', '09:00 AM - 11:00 AM', 'Computer Lab 9 (0529) (0112230426-0112331154)'),
(2140, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'E', 'SaIs', 'May 19, 2024', '09:00 AM - 11:00 AM', 'Computer Lab 13 (0326) (0112230714-0112331166)'),
(2141, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'F', 'KBJ', 'May 19, 2024', '09:00 AM - 11:00 AM', 'Computer Lab 11 (0531) (011222286-0112331161)'),
(2142, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'G', 'AAU', 'May 19, 2024', '09:00 AM - 11:00 AM', 'Computer Lab 3 (0327) (0112310243-0112331108)'),
(2143, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'H', 'IAb', 'May 19, 2024', '09:00 AM - 11:00 AM', 'Computer Lab 10 (0530) (0112230547-0112331131)'),
(2144, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'I', 'RaR', 'May 19, 2024', '09:00 AM - 11:00 AM', 'Computer Lab 15 (0626) (011212019-0112331115)'),
(2145, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'M', 'HHS', 'May 19, 2024', '09:00 AM - 11:00 AM', 'Computer Lab 6 (0524) (011222101-0112330987)'),
(2146, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'S', 'MSTR', 'May 19, 2024', '09:00 AM - 11:00 AM', 'Computer Lab 14 (0426) (0112230959-0112331079)'),
(2147, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'T', 'RaR', 'May 19, 2024', '09:00 AM - 11:00 AM', 'Computer Lab 5 (0523) (0112230588-0112331164)'),
(2148, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'V', 'MoA', 'May 19, 2024', '09:00 AM - 11:00 AM', 'Computer Lab 8 (0528) (0112230093-0112331152)'),
(2149, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'Y', 'ATR', 'May 19, 2024', '09:00 AM - 11:00 AM', 'Computer Lab 12 (0532) (0112230288-0112331134)'),
(2150, 'BSCSE', 'CSE 4891/CSE 491', 'Data Mining', 'A', 'RtAm', 'May 19, 2024', '09:00 AM - 11:00 AM', '803 (011163015-011201369)                                                                                                                                                                                                                       804 (011201379-011221489)'),
(2151, 'BSCSE', 'PSY 101/PSY 2101', 'Psychology', 'A', 'MRM', 'May 19, 2024', '09:00 AM - 11:00 AM', '803 (011153072-0112230306)                                                                                                                                                                                                                       804 (0112230315-0152410063)'),
(2152, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'AB', 'MoA', 'May 19, 2024', '11:30 AM - 01:30 PM', 'Computer Lab 10 (0530) (0112310546-0112331145)'),
(2153, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'AC', 'ShAn', 'May 19, 2024', '11:30 AM - 01:30 PM', 'Computer Lab 7 (0522) (011213188-0112331153)'),
(2154, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'AD', 'TaS', 'May 19, 2024', '11:30 AM - 01:30 PM', 'Computer Lab 9 (0529) (0112330140-0112331170)'),
(2155, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'AE', 'FTU', 'May 19, 2024', '11:30 AM - 01:30 PM', 'Computer Lab 4 (0427) (011202100-0112331078)'),
(2156, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'AG', 'SYH', 'May 19, 2024', '11:30 AM - 01:30 PM', 'Computer Lab 11 (0531) (011193012-0112331171)'),
(2157, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'J', 'ATR', 'May 19, 2024', '11:30 AM - 01:30 PM', 'Computer Lab 22 (0926) (0112230981-0112331081)'),
(2158, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'K', 'MiBa', 'May 19, 2024', '11:30 AM - 01:30 PM', 'Computer Lab 14 (0426) (0112320159-0112331104)'),
(2159, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'L', 'GMMM', 'May 19, 2024', '11:30 AM - 01:30 PM', 'Computer Lab 5 (0523) (011201388-0112331163)'),
(2160, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'N', 'MdTH', 'May 19, 2024', '11:30 AM - 01:30 PM', 'Computer Lab 12 (0532) (011221378-0112331156)'),
(2161, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'O', 'FdAR', 'May 19, 2024', '11:30 AM - 01:30 PM', 'Computer Lab 13 (0326) (0112320007-0112331120)'),
(2162, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'P', 'MdShA', 'May 19, 2024', '11:30 AM - 01:30 PM', 'Computer Lab 15 (0626) (0112230010-0112331146)'),
(2163, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'R', 'NSS', 'May 19, 2024', '11:30 AM - 01:30 PM', 'Computer Lab 19 (0727) (011221440-0112331117)'),
(2164, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'U', 'RaR', 'May 19, 2024', '11:30 AM - 01:30 PM', 'Computer Lab 8 (0528) (011222043-0112331173)'),
(2165, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'W', 'HHS', 'May 19, 2024', '11:30 AM - 01:30 PM', 'Computer Lab 6 (0524) (0112310334-0112331144)'),
(2166, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'X', 'KAN', 'May 19, 2024', '11:30 AM - 01:30 PM', 'Computer Lab 2 (0227) (011213124-0112331126)'),
(2167, 'BSCSE', 'CSE 1112', 'Structured Programming Language Laboratory', 'Z', 'MSTR', 'May 19, 2024', '11:30 AM - 01:30 PM', 'Computer Lab 18 (0726) (011221212-0112331167)'),
(2168, 'BSCSE', 'CSE 2215', 'Data Structure and Algorithms I', 'A', 'IMK', 'May 19, 2024', '11:30 AM - 01:30 PM', '328 (011191147-0112231022)                                                                                                                                                                                                                       329 (0112231028-0112310537)'),
(2169, 'BSCSE', 'CSE 2215', 'Data Structure and Algorithms I', 'C', 'FdAR', 'May 19, 2024', '11:30 AM - 01:30 PM', '323 (011193036-0112230339)                                                                                                                                                                                                                       324 (0112230345-0112310567)'),
(2170, 'BSCSE', 'CSE 2215', 'Data Structure and Algorithms I', 'D', 'RRK', 'May 19, 2024', '11:30 AM - 01:30 PM', '408 (011201054-0112230445)                                                                                                                                                                                                                       409 (0112230565-0112310481)'),
(2171, 'BSCSE', 'CSE 2215', 'Data Structure and Algorithms I', 'E', 'FdAR', 'May 19, 2024', '11:30 AM - 01:30 PM', '330 (011192145-0112230406)                                                                                                                                                                                                                       401 (0112230418-0112310347)'),
(2172, 'BSCSE', 'CSE 2215', 'Data Structure and Algorithms I', 'G', 'ATR', 'May 19, 2024', '11:30 AM - 01:30 PM', '428 (011212031-0112230295)                                                                                                                                                                                                                       429 (0112230329-0112310446)'),
(2173, 'BSCSE', 'CSE 2215', 'Data Structure and Algorithms I', 'H', 'MiBa', 'May 19, 2024', '11:30 AM - 01:30 PM', '403 (011192056-0112310478)'),
(2174, 'BSCSE', 'CSE 2215', 'Data Structure and Algorithms I', 'I', 'SaIs', 'May 19, 2024', '11:30 AM - 01:30 PM', '423 (011191246-0112230401)                                                                                                                                                                                                                       425 (0112230417-0112310578)'),
(2175, 'BSCSE', 'CSE 2215', 'Data Structure and Algorithms I', 'J', 'MMAS', 'May 19, 2024', '11:30 AM - 01:30 PM', '325 (011221163-0112310051)'),
(2176, 'BSCSE', 'CSE 2215', 'Data Structure and Algorithms I', 'K', 'UR', 'May 19, 2024', '11:30 AM - 01:30 PM', '404 (011201115-0112230636)                                                                                                                                                                                                                       405 (0112230646-0112310472)'),
(2177, 'BSCSE', 'CSE 2215', 'Data Structure and Algorithms I', 'L', 'MdRIm', 'May 19, 2024', '11:30 AM - 01:30 PM', '406 (011191109-0112230233)                                                                                                                                                                                                                       407 (0112230246-0112310439)'),
(2178, 'BSCSE', 'CSE 2215', 'Data Structure and Algorithms I', 'M', 'RRK', 'May 19, 2024', '11:30 AM - 01:30 PM', '410 (011201091-0112230442)                                                                                                                                                                                                                       411 (0112230514-0112310530)'),
(2179, 'BSCSE', 'CSE 2215/CSI 217', 'Data Structure/Data Structure and Algorithms I', 'B', 'MdShA', 'May 19, 2024', '11:30 AM - 01:30 PM', '903 (011172150-0112230487)                                                                                                                                                                                                                       322 (0112230488-0112310120)'),
(2180, 'BSCSE', 'CSE 2215/CSI 217', 'Data Structure/Data Structure and Algorithms I', 'F', 'MiBa', 'May 19, 2024', '11:30 AM - 01:30 PM', '402 (011162018-0112310203)'),
(2181, 'BSCSE', 'CSE 4945', 'UI: Concepts and Design', 'A', 'IAb', 'May 19, 2024', '11:30 AM - 01:30 PM', '803 (011183050-011201222)                                                                                                                                                                                                                       804 (011201224-011222233)'),
(2182, 'BSDS', 'DS 1502', 'Programming for Data Science Laboratory', 'BA', 'KBJ', 'May 19, 2024', '11:30 AM - 01:30 PM', 'Computer Lab 20 (0424) (0152230002-0152410068)'),
(2183, 'BSDS', 'DS 1502', 'Programming for Data Science Laboratory', 'BB', 'KBJ', 'May 19, 2024', '11:30 AM - 01:30 PM', 'Computer Lab 21 (0422) (015222004-0152410062)'),
(2184, 'BSDS', 'DS 1502', 'Programming for Data Science Laboratory', 'BC', 'MdTH', 'May 19, 2024', '11:30 AM - 01:30 PM', 'Computer Lab 3 (0327) (015221001-0152410071)'),
(2185, 'BSCSE', 'CSE 4495', 'Software Testing and Quality Assurance', 'A', 'MoI', 'May 19, 2024', '02:00 PM - 04:00 PM', '407 (011192050-011201148)                                                                                                                                                                                                                       408 (011201171-011202301)'),
(2186, 'BSCSE', 'CSE 4495', 'Software Testing and Quality Assurance', 'B', 'MoI', 'May 19, 2024', '02:00 PM - 04:00 PM', '409 (011191047-011202249)'),
(2187, 'BSCSE', 'CSE 483/CSE 4883', 'Digital Image Processing', 'B', 'RaR', 'May 19, 2024', '02:00 PM - 04:00 PM', '410 (011162087-011222315)'),
(2188, 'BSCSE', 'CSE 4883', 'Digital Image Processing', 'A', 'RaR', 'May 19, 2024', '02:00 PM - 04:00 PM', '803 (011191096-011201339)                                                                                                                                                                                                                       804 (011201367-011221362)'),
(2189, 'BSCSE', 'PHY 105/PHY 2105', 'Physics', 'D', 'MAn', 'May 19, 2024', '02:00 PM - 04:00 PM', '404 (011163013-0112310181)                                                                                                                                                                                                                       405 (0112310183-0112330931)'),
(2190, 'BSCSE', 'PHY 105/PHY 2105', 'Physics', 'F', 'MASn', 'May 19, 2024', '02:00 PM - 04:00 PM', '903 (011182081-0112330194)'),
(2191, 'BSCSE', 'PHY 105/PHY 2105', 'Physics', 'K', 'FPB', 'May 19, 2024', '02:00 PM - 04:00 PM', '432 (011182141-0152330071)'),
(2192, 'BSCSE', 'PHY 2105', 'Physics', 'A', 'MASn', 'May 19, 2024', '02:00 PM - 04:00 PM', '411 (011202310-0112230489)                                                                                                                                                                                                                       423 (0112230516-0112330702)'),
(2193, 'BSCSE', 'PHY 2105', 'Physics', 'B', 'MAn', 'May 19, 2024', '02:00 PM - 04:00 PM', '805 (011211038-0112310102)                                                                                                                                                                                                                       806 (0112310108-0112410403)'),
(2194, 'BSCSE', 'PHY 2105', 'Physics', 'C', 'AyFz', 'May 19, 2024', '02:00 PM - 04:00 PM', '425 (011201320-0112230551)                                                                                                                                                                                                                       428 (0112230649-0112330726)'),
(2195, 'BSCSE', 'PHY 2105', 'Physics', 'E', 'MASn', 'May 19, 2024', '02:00 PM - 04:00 PM', '329 (011193012-0152410026)'),
(2196, 'BSCSE', 'PHY 2105', 'Physics', 'G', 'TFR', 'May 19, 2024', '02:00 PM - 04:00 PM', '324 (011213015-0112230360)                                                                                                                                                                                                                       325 (0112230527-0112331129)'),
(2197, 'BSCSE', 'PHY 2105', 'Physics', 'H', 'SaDa', 'May 19, 2024', '02:00 PM - 04:00 PM', '402 (011193039-0112230572)                                                                                                                                                                                                                       403 (0112230712-0152320002)'),
(2198, 'BSCSE', 'PHY 2105', 'Physics', 'I', 'MASn', 'May 19, 2024', '02:00 PM - 04:00 PM', '328 (011211019-0112310363)                                                                                                                                                                                                                       406 (0112310375-0112320269)'),
(2199, 'BSCSE', 'PHY 2105', 'Physics', 'J', 'ShAI', 'May 19, 2024', '02:00 PM - 04:00 PM', '429 (011191109-0112310223)                                                                                                                                                                                                                       431 (0112310226-0112320238)'),
(2200, 'BSCSE', 'PHY 2105', 'Physics', 'L', 'SaDa', 'May 19, 2024', '02:00 PM - 04:00 PM', '330 (011193026-0112230729)                                                                                                                                                                                                                       401 (0112310011-0112330945)'),
(2201, 'BSCSE', 'PHY 2105', 'Physics', 'M', 'FPB', 'May 19, 2024', '02:00 PM - 04:00 PM', '322 (011222340-0112310412)                                                                                                                                                                                                                       323 (0112310413-0152330008)');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` int(11) NOT NULL,
  `route_id` varchar(255) NOT NULL,
  `bus_no` varchar(155) NOT NULL,
  `route_Info` varchar(500) NOT NULL,
  `starting_time` varchar(255) NOT NULL,
  `depurture_time` varchar(255) NOT NULL,
  `route_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `route_id`, `bus_no`, `route_Info`, `starting_time`, `depurture_time`, `route_created`) VALUES
(7, 'ROUTE 01', 'BRTC', 'Dhanmondi Keari Plaza, Shankar Bus Stop, Mohammadpur BRTC Bus Stand, Manik Mia Avenue, Farmgate, Mohakhali Flyover, UIU Campus', '07.00 AM', '02.20 PM and 04.40 PM', '2025-01-20 00:14:05'),
(8, 'ROUTE 02', 'BRTC', 'Dhanmondi Keari Plaza, Zigatola Bus Stop, Refatullah Center, West Kalabagan, Panthapath, Farmgate, Mohakhali Flyover, UIU Campus', '07.00 AM', '02.20 PM and 04.40 PM', '2025-01-20 00:21:50'),
(9, 'ROUTE 03', 'BRTC', 'Technical, Mirpur-1, Mirpur-2, Mirpur-10, Mirpur-11, Mirpur-12, ECB Chattar (Kalshi), Badda Notun Bazar, UIU Campus', '07.00 AM', '04.40 PM', '2025-01-20 00:25:16');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `id` int(11) NOT NULL,
  `route_id` varchar(255) NOT NULL,
  `seat_number` varchar(255) DEFAULT NULL,
  `booked_by` varchar(20) NOT NULL,
  `booking_time` time NOT NULL DEFAULT current_timestamp(),
  `session_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`id`, `route_id`, `seat_number`, `booked_by`, `booking_time`, `session_name`) VALUES
(103, 'ROUTE 01', '3', '0112230431', '08:47:02', 'Special session'),
(104, 'ROUTE 01', '46', '0112230445', '08:47:44', 'Special session'),
(105, 'ROUTE 01', '26', '0112230447', '08:48:25', 'Special session');

-- --------------------------------------------------------

--
-- Table structure for table `student_course_trimester`
--

CREATE TABLE `student_course_trimester` (
  `id` int(11) NOT NULL,
  `CourseCode` varchar(20) NOT NULL,
  `studentId` varchar(20) NOT NULL,
  `Section` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_course_trimester`
--

INSERT INTO `student_course_trimester` (`id`, `CourseCode`, `studentId`, `Section`) VALUES
(16, 'ENG 1011', '0112230435', 'AN'),
(17, 'CSE 1110', '0112230435', 'L'),
(18, 'CSE 2213', '0112230435', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `student_data`
--

CREATE TABLE `student_data` (
  `studentId` varchar(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `dept` varchar(20) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'Active now'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_data`
--

INSERT INTO `student_data` (`studentId`, `name`, `email`, `dept`, `nickname`, `password`, `profile_pic`, `status`) VALUES
('0112230431', 'Fariha Hriti', 'hriti@gmail.com', 'CSE', 'hriti', '$2y$10$b1H1uRMGCn2ZVylttcC8EuyhhynOmt/vTz9to9aVU4ZfalksUExd2', 'penguin.png', 'Offline now'),
('0112230435', 'Riyadh T', 'riyadh@gmail.com', 'CSE', 'riyadh', '$2y$10$/BQ2Bq8qK1WF9.0IatfhIux5./tWWYvYXTpNno30dF6.GyOOdxKBG', 'my_p.jpg', 'Active now'),
('0112230445', 'Ifty', 'ifty@gemail.com', 'use', 'Ifty', '$2y$10$nXcJmRPXNZ9.ZW4OFUZqPe0a96F86dQxRkDadirD3x8PEcnOKWFKG', '4100_3_04.jpg', 'Offline now'),
('0112230447', 'Toma', 'toma@gemail.com', 'use', 'toma', '$2y$10$v4LjVaegAlvC4AThaMjFIOlgtrzLS5RBQPwISsoEJ9QmguoGJpTKe', 'cat.jpg', 'Offline now');

-- --------------------------------------------------------

--
-- Table structure for table `student_tasks`
--

CREATE TABLE `student_tasks` (
  `id` int(11) NOT NULL,
  `student_id` varchar(20) DEFAULT NULL,
  `task_type` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'incomplete',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_tasks`
--

INSERT INTO `student_tasks` (`id`, `student_id`, `task_type`, `description`, `status`, `created_at`) VALUES
(44, '0112230435', 'Task', 'Study for DBMS exam and practice coding problems.', 'complete', '2025-01-26 16:37:39'),
(46, '0112230435', 'Task', 'Solve previous AI final question', 'complete', '2025-01-26 16:40:12'),
(47, '0112230435', 'Homework', 'AI assignment chapter 7 ', 'incomplete', '2025-01-26 16:47:02'),
(49, '0112230435', 'Homework', 'DBMS Assignment submission last date 28 tarik', 'incomplete', '2025-01-27 02:30:28'),
(52, '0112230435', 'Task', 'DBMS ch7 example 4', 'incomplete', '2025-01-27 04:51:25');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `studentId` varchar(20) DEFAULT NULL,
  `candidateId` varchar(20) DEFAULT NULL,
  `titleOfVote` varchar(100) DEFAULT NULL,
  `voteTimestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `studentId`, `candidateId`, `titleOfVote`, `voteTimestamp`) VALUES
(12, '0112230445', '0112230431', 'UIU App Forum President Election 2025', '2025-01-27 00:59:25'),
(13, '0112230435', '0112230431', 'UIU App Forum President Election 2025', '2025-01-27 00:59:54'),
(14, '0112230431', '0112230435', 'UIU App Forum President Election 2025', '2025-01-27 01:00:16'),
(15, '0112230447', '0112230445', 'UIU App Forum President Election 2025', '2025-01-27 01:01:41');

-- --------------------------------------------------------

--
-- Table structure for table `vote_details`
--

CREATE TABLE `vote_details` (
  `id` int(11) NOT NULL,
  `titleOfVote` varchar(100) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `end_date` datetime NOT NULL,
  `deadline` datetime DEFAULT NULL,
  `image_path` varchar(1000) NOT NULL,
  `Approve` varchar(20) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vote_details`
--

INSERT INTO `vote_details` (`id`, `titleOfVote`, `description`, `end_date`, `deadline`, `image_path`, `Approve`) VALUES
(13, 'Executive of PR', 'The UIU Debate Club is dedicated to cultivating critical thinking, public speaking, and analytical skills among students. It regularly hosts debate competitions, workshops, and public forums, fostering a culture of intellectual engagement and informed discourse. The club represents UIU in inter-university and national debate tournaments.', '2025-01-28 00:54:00', '2025-01-28 00:54:00', 'debate.jpg', 'yes'),
(12, 'Jr. Executive of HR', 'The Electrical and Electronics Club is a hub for students passionate about technology and innovation. It offers hands-on projects, workshops, and competitions in areas like robotics, IoT, and circuit design, fostering creativity and practical skills in electronics.', '2025-01-27 12:51:00', '2025-01-27 01:51:00', 'electric.png', 'yes'),
(14, 'President', 'The UIU Photography Club inspires creativity through photography. It organizes workshops, photowalks, and exhibitions, providing a platform for students to enhance skills and showcase their talent in various photography genres.', '2025-01-28 21:29:00', '2025-01-27 21:30:00', 'photo.jpeg', 'yes'),
(10, 'UIU App Forum President Election 2025', 'The time has come to choose the leader who will guide our club to new heights! Cast your vote for the candidate you believe has the vision, leadership, and dedication to take the UIU App Forum forward. Your vote will shape the future of our community!', '2025-01-27 01:05:00', '2025-01-27 01:05:00', 'App Forum.jpg', 'yes'),
(11, 'Vice President', 'The Vice President of Operations oversees daily activities and ensures the organization runs efficiently. They develop strategies, improve processes, and work closely with teams to meet goals.', '2025-01-27 17:46:00', '2025-01-27 16:47:00', 'computer.jpg', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_route` (`route_id`),
  ADD KEY `fk_sss1` (`session_name`);

--
-- Indexes for table `booking_session`
--
ALTER TABLE `booking_session`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `session_name` (`session_name`);

--
-- Indexes for table `bus_routine`
--
ALTER TABLE `bus_routine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidate_data`
--
ALTER TABLE `candidate_data`
  ADD PRIMARY KEY (`candidateId`,`titleOfVote`),
  ADD KEY `titleOfVote` (`titleOfVote`);

--
-- Indexes for table `course_table`
--
ALTER TABLE `course_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `CourseCode` (`CourseCode`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkstdid` (`UploaderId`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `midfinalroutine`
--
ALTER TABLE `midfinalroutine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `un_route` (`route_id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_route1` (`route_id`),
  ADD KEY `fk_sessionName` (`session_name`);

--
-- Indexes for table `student_course_trimester`
--
ALTER TABLE `student_course_trimester`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk1_code` (`CourseCode`);

--
-- Indexes for table `student_data`
--
ALTER TABLE `student_data`
  ADD PRIMARY KEY (`studentId`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `student_tasks`
--
ALTER TABLE `student_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `studentId` (`studentId`,`candidateId`,`titleOfVote`),
  ADD KEY `participantId` (`candidateId`),
  ADD KEY `titleOfVote` (`titleOfVote`);

--
-- Indexes for table `vote_details`
--
ALTER TABLE `vote_details`
  ADD PRIMARY KEY (`titleOfVote`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;

--
-- AUTO_INCREMENT for table `booking_session`
--
ALTER TABLE `booking_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `bus_routine`
--
ALTER TABLE `bus_routine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `course_table`
--
ALTER TABLE `course_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `midfinalroutine`
--
ALTER TABLE `midfinalroutine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2202;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `student_course_trimester`
--
ALTER TABLE `student_course_trimester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `student_tasks`
--
ALTER TABLE `student_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `vote_details`
--
ALTER TABLE `vote_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `fk_route` FOREIGN KEY (`route_id`) REFERENCES `routes` (`route_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_sss1` FOREIGN KEY (`session_name`) REFERENCES `booking_session` (`session_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `candidate_data`
--
ALTER TABLE `candidate_data`
  ADD CONSTRAINT `candidate_data_ibfk_1` FOREIGN KEY (`titleOfVote`) REFERENCES `vote_details` (`titleOfVote`);

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `fkstdid` FOREIGN KEY (`UploaderId`) REFERENCES `student_data` (`studentId`);

--
-- Constraints for table `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `fk_route1` FOREIGN KEY (`route_id`) REFERENCES `routes` (`route_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_sessionName` FOREIGN KEY (`session_name`) REFERENCES `booking_session` (`session_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_course_trimester`
--
ALTER TABLE `student_course_trimester`
  ADD CONSTRAINT `fk1_code` FOREIGN KEY (`CourseCode`) REFERENCES `course_table` (`CourseCode`) ON DELETE CASCADE;

--
-- Constraints for table `student_tasks`
--
ALTER TABLE `student_tasks`
  ADD CONSTRAINT `student_tasks_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_data` (`studentId`) ON DELETE CASCADE;

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`studentId`) REFERENCES `student_data` (`studentId`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`candidateId`) REFERENCES `candidate_data` (`candidateId`),
  ADD CONSTRAINT `votes_ibfk_3` FOREIGN KEY (`titleOfVote`) REFERENCES `vote_details` (`titleOfVote`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
