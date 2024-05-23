-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2024 at 02:47 PM
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
-- Database: `parent_teacher_communication_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `Attachment_ID` int(11) NOT NULL,
  `Message_ID` int(11) DEFAULT NULL,
  `File_Name` varchar(255) DEFAULT NULL,
  `File_Type` varchar(50) DEFAULT NULL,
  `File_Path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`Attachment_ID`, `Message_ID`, `File_Name`, `File_Type`, `File_Path`) VALUES
(11, 10, 'document1.pdf', 'PDF', '/path/to/document1.pdf'),
(12, 7, 'image1.jpg', 'Image', '/path/to/image1.jpg'),
(13, 9, 'presentation.pptx', 'Presentation', '/path/to/presentation.pptx'),
(14, 8, 'homework.docx', 'Document', '/path/to/homework.docx'),
(15, 6, 'notes.txt', 'Text', '/path/to/notes.txt');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `Attendance_ID` int(11) NOT NULL,
  `Student_ID` int(11) DEFAULT NULL,
  `Teacher_ID` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`Attendance_ID`, `Student_ID`, `Teacher_ID`, `Date`, `Status`) VALUES
(1, 1, 5, '2024-05-15', 'Present'),
(2, 7, 2, '2024-05-15', 'Absent'),
(3, 8, 3, '2024-05-15', 'Present'),
(4, 4, 1, '2024-05-15', 'Present'),
(5, 6, 4, '2024-05-15', 'Absent');

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE `calendar` (
  `Event_ID` int(11) NOT NULL,
  `Event_Name` varchar(100) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Start_Date` date DEFAULT NULL,
  `End_Date` date DEFAULT NULL,
  `Parent_ID` int(11) DEFAULT NULL,
  `Teacher_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`Event_ID`, `Event_Name`, `Description`, `Start_Date`, `End_Date`, `Parent_ID`, `Teacher_ID`) VALUES
(1, 'Parent-Teacher Conference', 'Discuss student progress', '2024-05-25', '2024-05-25', 4, 1),
(2, 'Art Exhibition', 'Student artwork display', '2024-06-10', '0000-00-00', 2, 5),
(3, 'Open House', 'Meet the teachers and tour the school', '2024-06-15', '0000-00-00', 3, 1),
(4, 'Field Trip', 'Visit to the science museum', '2024-06-20', '2024-06-20', 3, 3),
(5, 'Exam Week', 'Final exams for all subjects', '2024-06-25', '2024-06-28', 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `Feedback_ID` int(11) NOT NULL,
  `Sender_ID` int(11) DEFAULT NULL,
  `Receiver_ID` int(11) DEFAULT NULL,
  `Feedback_Content` text DEFAULT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`Feedback_ID`, `Sender_ID`, `Receiver_ID`, `Feedback_Content`, `Timestamp`) VALUES
(1, 1, 4, 'Great job on the recent project!', '2024-05-16 08:53:16'),
(2, 8, 1, 'Your teaching methods are very effective.', '2024-05-16 08:53:16'),
(3, 7, 6, 'Thank you for your continuous support.', '2024-05-16 08:53:16'),
(4, 6, 8, 'Could you provide more challenging assignments?', '2024-05-16 08:53:16'),
(5, 4, 7, 'I appreciate your feedback on my work.', '2024-05-16 08:53:16');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `Meeting_ID` int(11) NOT NULL,
  `Parent_ID` int(11) DEFAULT NULL,
  `Teacher_ID` int(11) DEFAULT NULL,
  `Date_Time` datetime DEFAULT NULL,
  `Agenda` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`Meeting_ID`, `Parent_ID`, `Teacher_ID`, `Date_Time`, `Agenda`) VALUES
(1, 4, 5, '2024-05-20 10:00:00', 'Discuss student progress'),
(2, 2, 3, '2024-05-25 14:30:00', 'Review curriculum'),
(3, 3, 2, '2024-06-01 09:00:00', 'Parent-teacher conference'),
(4, 1, 4, '2024-06-05 11:00:00', 'Discuss upcoming assignments'),
(5, 5, 1, '2024-06-10 13:00:00', 'Art project presentation');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `Message_ID` int(11) NOT NULL,
  `Sender_ID` int(11) DEFAULT NULL,
  `Receiver_ID` int(11) DEFAULT NULL,
  `Message_Content` text DEFAULT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`Message_ID`, `Sender_ID`, `Receiver_ID`, `Message_Content`, `Timestamp`) VALUES
(6, 7, 8, 'Hello, how are you?', '2024-05-16 08:44:54'),
(7, 1, 6, 'Could you please help with the homework?', '2024-05-16 08:44:54'),
(8, 6, 4, 'I have a question about the upcoming exam.', '2024-05-16 08:44:54'),
(9, 8, 7, 'Thank you for the extra help yesterday.', '2024-05-16 08:44:54'),
(10, 4, 1, 'Could you provide feedback on my project?', '2024-05-16 08:44:54');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `Notification_ID` int(11) NOT NULL,
  `Parent_ID` int(11) DEFAULT NULL,
  `Teacher_ID` int(11) DEFAULT NULL,
  `Message` text DEFAULT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `Read_Status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`Notification_ID`, `Parent_ID`, `Teacher_ID`, `Message`, `Timestamp`, `Read_Status`) VALUES
(1, 1, 1, 'Reminder: Parent-Teacher conference on May 25th.', '2024-05-16 09:00:08', 0),
(2, 2, 2, 'Your child was absent today. Please check their attendance.', '2024-05-16 09:00:08', 0),
(3, 3, 3, 'Dont forget: Field trip next week!', '2024-05-16 09:00:08', 0),
(4, 4, 4, 'Feedback: Great progress in recent assignments.', '2024-05-16 09:00:08', 0),
(5, 5, 5, 'Reminder: Art exhibition on June 10th.', '2024-05-16 09:00:08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `Parent_ID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`Parent_ID`, `Name`, `Email`, `Phone`) VALUES
(1, 'Mary Johnson', 'mary@example.com', '1112223333'),
(2, 'David White', 'david@example.com', '4445556666'),
(3, 'Sarah Green', 'sarah@example.com', '7778889999'),
(4, 'James Black', 'james@example.com', '2223334444'),
(5, 'Jennifer Lee', 'jennifer@example.com', '8889990000');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `Teacher_ID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Subject` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`Teacher_ID`, `Name`, `Email`, `Phone`, `Subject`) VALUES
(1, 'Mr. Smith', 'smith@example.com', '1112223333', 'Mathematics'),
(2, 'Ms. Johnson', 'johnson@example.com', '4445556666', 'English'),
(3, 'Mrs. Davis', 'davis@example.com', '7778889999', 'Science'),
(4, 'Mr. Brown', 'brown@example.com', '2223334444', 'History'),
(5, 'Ms. Wilson', 'wilson@example.com', '8889990000', 'Art');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'MUTONI', 'PEACE', 'PEACE09', 'P@GMAIL.COM', '0788903506', '$2y$10$sIISURJfqQnNChRVsTWMXe.Z5rQOD9b7qlRn3lmcRXZsuCew71eo2', '2024-05-15 14:52:08', '2', 0),
(4, 'MUTONI', 'PEACE', 'PEACE', 'M@GMAIL.COM', '0788888888', '$2y$10$3VHNJDratBbDrL1IJwz1uO0or3.h5Q9XFxph7jOuKRV.d6AEPAdX6', '2024-05-15 14:54:22', '1', 0),
(6, 'byungura', 'vianney', 'vianex', 'vianney@gmail.com', '07832221114', '$2y$10$tJ8vJ6n4zHtoqlMWXu5h/OXysSRlUffv.kg3G/7V88sTcx5gSnLsa', '2024-05-16 08:34:15', '12345', 0),
(7, 'dusenge', 'samwel', 'sam', 'dusengesamwel@gmail.com', '0723765544', '$2y$10$yRt19uQpzo1X9S/2bgaIX./DdvUOkXVqVipk7dUKqQEp5NeAZkvCm', '2024-05-16 08:35:05', '12344', 0),
(8, 'Irahari', 'Cherise', 'irahr', 'iraharicher@gmail.com', '0784533222', '$2y$10$kUSscCWCHq2Qffaib6jxE.YQoUqUBVgySf0QXwPtO0Vx5HitfjM42', '2024-05-16 08:36:37', '55678', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`Attachment_ID`),
  ADD KEY `Message_ID` (`Message_ID`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`Attendance_ID`),
  ADD KEY `Student_ID` (`Student_ID`),
  ADD KEY `Teacher_ID` (`Teacher_ID`);

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`Event_ID`),
  ADD KEY `Parent_ID` (`Parent_ID`),
  ADD KEY `Teacher_ID` (`Teacher_ID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`Feedback_ID`),
  ADD KEY `Sender_ID` (`Sender_ID`),
  ADD KEY `Receiver_ID` (`Receiver_ID`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`Meeting_ID`),
  ADD KEY `Parent_ID` (`Parent_ID`),
  ADD KEY `Teacher_ID` (`Teacher_ID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`Message_ID`),
  ADD KEY `Sender_ID` (`Sender_ID`),
  ADD KEY `Receiver_ID` (`Receiver_ID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`Notification_ID`),
  ADD KEY `Parent_ID` (`Parent_ID`),
  ADD KEY `Teacher_ID` (`Teacher_ID`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`Parent_ID`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`Teacher_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `Attachment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `Attendance_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `Event_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `Feedback_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `Meeting_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `Message_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `Notification_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `Parent_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `Teacher_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `attachments_ibfk_1` FOREIGN KEY (`Message_ID`) REFERENCES `messages` (`Message_ID`);

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`Teacher_ID`) REFERENCES `teachers` (`Teacher_ID`);

--
-- Constraints for table `calendar`
--
ALTER TABLE `calendar`
  ADD CONSTRAINT `calendar_ibfk_1` FOREIGN KEY (`Parent_ID`) REFERENCES `parents` (`Parent_ID`),
  ADD CONSTRAINT `calendar_ibfk_2` FOREIGN KEY (`Teacher_ID`) REFERENCES `teachers` (`Teacher_ID`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`Sender_ID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`Receiver_ID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `meetings`
--
ALTER TABLE `meetings`
  ADD CONSTRAINT `meetings_ibfk_1` FOREIGN KEY (`Parent_ID`) REFERENCES `parents` (`Parent_ID`),
  ADD CONSTRAINT `meetings_ibfk_2` FOREIGN KEY (`Teacher_ID`) REFERENCES `teachers` (`Teacher_ID`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`Sender_ID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`Receiver_ID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`Parent_ID`) REFERENCES `parents` (`Parent_ID`),
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`Teacher_ID`) REFERENCES `teachers` (`Teacher_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
