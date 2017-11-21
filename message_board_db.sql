-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: 2017-11-21 06:29:54
-- 服务器版本： 5.6.35
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `message_board_db`
--

-- --------------------------------------------------------

--
-- 表的结构 `addlike`
--
-- 创建时间： 2017-11-20 15:47:25
--

CREATE TABLE `addlike` (
  `userId` int(11) NOT NULL,
  `messageId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `addlike`
--

INSERT INTO `addlike` (`userId`, `messageId`) VALUES
(3, 3);

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--
-- 创建时间： 2017-11-15 15:46:15
--

CREATE TABLE `comment` (
  `commentId` int(11) NOT NULL,
  `messageId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `createAt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `comment`
--

INSERT INTO `comment` (`commentId`, `messageId`, `userId`, `content`, `createAt`) VALUES
(1, 3, 3, 'hello world ! fix test', 0),
(2, 3, 3, '123 fix test', 1510822395),
(4, 3, 3, 'test1', 1510908993),
(5, 6, 2, '123', 1511185262);

-- --------------------------------------------------------

--
-- 表的结构 `message`
--
-- 创建时间： 2017-11-20 15:53:20
--

CREATE TABLE `message` (
  `messageId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `content` varchar(250) NOT NULL,
  `likeup` int(20) NOT NULL,
  `creatAt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `message`
--

INSERT INTO `message` (`messageId`, `userId`, `content`, `likeup`, `creatAt`) VALUES
(1, 5, '123456s1', 0, 1510454068),
(3, 5, '123123', 1, 1510461841),
(4, 2, '123', 0, 1510463150),
(5, 2, '234', 0, 1510463917);

-- --------------------------------------------------------

--
-- 表的结构 `users`
--
-- 创建时间： 2017-11-13 04:17:17
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `pagrows` int(11) NOT NULL DEFAULT '15',
  `imgsrc` varchar(50) NOT NULL DEFAULT 'fe87b916c7060cdec3dfffac534981c2.png',
  `deny` int(1) NOT NULL DEFAULT '0',
  `createdAt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`userId`, `name`, `password`, `pagrows`, `imgsrc`, `deny`, `createdAt`) VALUES
(2, 'tourist', '7215ee9c7d9dc229d2921a40e899ec5f', 15, 'fe87b916c7060cdec3dfffac534981c2.png', 0, 0),
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 15, 'fe87b916c7060cdec3dfffac534981c2.png', 0, 0),
(5, 'test1', 'e10adc3949ba59abbe56e057f20f883e', 15, 'fe87b916c7060cdec3dfffac534981c2.png', 0, 1510319039),
(6, 'test2', 'e10adc3949ba59abbe56e057f20f883e', 15, 'fe87b916c7060cdec3dfffac534981c2.png', 1, 1510548340),
(7, 'test3', 'e10adc3949ba59abbe56e057f20f883e', 15, 'fe87b916c7060cdec3dfffac534981c2.png', 1, 1510822660);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentId`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`messageId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `comment`
--
ALTER TABLE `comment`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `message`
--
ALTER TABLE `message`
  MODIFY `messageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
