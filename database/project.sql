-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2023 at 04:56 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `sno` int(11) NOT NULL,
  `id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`sno`, `id`, `username`, `password`) VALUES
(1, 'A001', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `batsman`
--

CREATE TABLE `batsman` (
  `sno` int(11) NOT NULL,
  `match_id` varchar(255) NOT NULL,
  `player_id` varchar(255) NOT NULL,
  `runs` smallint(6) NOT NULL,
  `balls` smallint(6) NOT NULL,
  `1` smallint(6) NOT NULL,
  `2` smallint(6) NOT NULL,
  `3` smallint(6) NOT NULL,
  `4` smallint(6) NOT NULL,
  `6` smallint(6) NOT NULL,
  `strike_rate` decimal(5,2) NOT NULL,
  `wicket_taken` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bowler`
--

CREATE TABLE `bowler` (
  `sno` int(11) NOT NULL,
  `match_id` varchar(255) NOT NULL,
  `player_id` varchar(255) NOT NULL,
  `overs` decimal(4,1) NOT NULL,
  `maiden` smallint(6) NOT NULL,
  `extras` smallint(6) NOT NULL,
  `runs` smallint(6) NOT NULL,
  `total` smallint(6) NOT NULL,
  `wicket` smallint(6) NOT NULL,
  `economy_rate` decimal(5,2) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `live`
--

CREATE TABLE `live` (
  `sno` int(11) NOT NULL,
  `match_id` varchar(255) NOT NULL,
  `team_id` varchar(255) NOT NULL,
  `innings` tinyint(4) NOT NULL,
  `overs` decimal(4,1) NOT NULL,
  `striker` varchar(255) NOT NULL,
  `extras` smallint(6) NOT NULL,
  `total` smallint(6) NOT NULL,
  `wicket` tinyint(4) NOT NULL,
  `run_rate` decimal(5,2) NOT NULL,
  `req_run_rate` decimal(5,2) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `sno` int(11) NOT NULL,
  `news_id` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `image` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`sno`, `news_id`, `heading`, `content`, `image`, `time`) VALUES
(1, 'NE001', 'Suresh Raina Shares Rare MS Dhoni Moment', 'Mahendra Singh Dhoni, especially after donning the captain’s hat, seldom showed his emotions. His calm, composed and calculated countenance had earned him the title of ‘Captain Cool’. However, he is human after all and emotions do come out some time or the other howsoever hard you try to hide them. Dhoni’s former Chennai Super Kings (CSK) teammate Suresh Raina shared one such incident when the ace wicketkeeper-batsman and leader of men could not keep his happiness in check.', 'NE001.jpg', '2023-03-29 15:31:09'),
(2, 'NE002', 'Virat Kohli reveals his \'GOAT\' in cricket', 'Ace India and Royal Challengers Bangalore (RCB) batter Virat Kohli on Wednesday revealed the names of two persons who he considers as the \'Greatest Of All Time\' in the game of cricket.\r\n\r\nDescribing why he considered them as \'GOAT\', Kohli said that the two changed the dynamics of the cricket completely with their game.\r\n\r\nIn a video posted by RCB, Kohli said: \"I have always taken two names, Sachin Tendulkar and Sir Viv Richards are the GOATs of Cricket. Sachin is my hero. These two have revolutionised batting in their generation and completely changed the dynamic of cricket. That is why I feel they are the two greatest.\"', 'NE002.jpg', '2023-03-29 15:36:42'),
(3, 'NE003', ' West Indies Beat South Africa by 7 Runs to Clinch Series 2-1', 'South Africa won the toss and decided to bowl in the series-deciding third Twenty20 international against the West Indies at the Wanderers Stadium in Johannesburg on Tuesday. South African captain Aiden Markram said there were similarities between the Wanderers and SuperSport Park in Centurion, where South Africa achieved a world record run chase of 259 runs to level the series at 1-1 on Sunday.', 'NE003.jpg', '2023-03-29 15:44:40'),
(4, 'NE004', 'Cricket-Stokes likely to start IPL as specialist batter, says Hussey', 'England captain Ben Stokes is set to start his Indian Premier League (IPL) campaign with the Chennai Super Kings as a specialist batter after having an injection in his troublesome left knee, the team\'s batting coach Mike Hussey said.With the Ashes series against Australia less than three months away the all-rounder had a cortisone injection, which can help relieve pain and inflammation, before the start of the IPL season.\r\n\r\nThe knee issue has long bothered Stokes, 31, and it had him grimacing in pain throughout the drawn two-test series with New Zealand. He bowled only two overs in England\'s one-run defeat in the second test.\r\n\r\n\"My understanding is he\'s ready to go as a batsman from the start. The bowling might be wait and see,\" former Australia batter Hussey told cricket news website Cricinfo on Tuesday.', 'NE004.jpg', '2023-03-29 15:47:56'),
(5, 'NE005', 'Cricket-Mumbai Indians win inaugural WPL title after Sciver-Brunt fifty', 'Mumbai Indians were crowned champions at the inaugural Women\'s Premier League (WPL) after Nat Sciver-Brunt\'s unbeaten 60 secured their seven-wicket victory against Delhi Capitals in the final at the Wankhede Stadium on Sunday.\r\n\r\n', 'NE005.jpg', '2023-03-29 15:53:04');

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE `player` (
  `sno` int(11) NOT NULL,
  `team_id` varchar(255) NOT NULL,
  `player_id` varchar(255) NOT NULL,
  `player_name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `status` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`sno`, `team_id`, `player_id`, `player_name`, `role`, `status`) VALUES
(1, 'TE002', 'P001', 'Rohit Sharma', 'Batsman (C)', 0),
(2, 'TE001', 'P002', 'MS Dhoni', 'Bat & Wkt (C)', 0),
(3, 'TE001', 'P003', 'Deepak Chahar', 'Bowler', 0),
(4, 'TE002', 'P004', 'Jasprit Bumrah', 'Bowler', 0),
(5, 'TE002', 'P005', 'Ishan Kishan', 'Bat & Wkt', 0),
(6, 'TE005', 'P006', 'Rohit Sharma', 'Batsman (C)', 0),
(7, 'TE005', 'P007', 'Virat Kohli', 'Batsman', 0),
(8, 'TE005', 'P008', 'Jasprit Bumrah', 'Bowler', 0),
(9, 'TE007', 'P009', 'Pat Cummins', 'Bowler (C)', 0),
(10, 'TE007', 'P010', 'Steve Smith', 'Batsman', 0),
(11, 'TE007', 'P011', 'David Warner', 'Batsman', 0);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `sno` int(11) NOT NULL,
  `match_id` varchar(255) NOT NULL,
  `tournament` varchar(255) NOT NULL,
  `team1` varchar(255) NOT NULL,
  `team2` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `date&time` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`sno`, `match_id`, `tournament`, `team1`, `team2`, `location`, `date&time`, `status`) VALUES
(1, 'M001', 'T001', 'TE001', 'TE002', 'Chennai', '2023-04-28 19:30:00', 0),
(2, 'M002', 'T002', 'TE003', 'TE004', 'Chennai', '2023-05-01 10:00:00', 0),
(3, 'M003', 'T003', 'TE005', 'TE007', 'Kolkata', '2023-06-15 15:30:00', 0),
(4, 'M004', 'T003', 'TE008', 'TE007', 'Mumbai', '2023-07-04 10:30:00', 0),
(5, 'M005', 'T002', 'TE003', 'TE009', 'Chennai', '2023-05-17 07:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `sno` int(11) NOT NULL,
  `tournament_id` varchar(255) NOT NULL,
  `team_id` varchar(255) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `short_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`sno`, `tournament_id`, `team_id`, `team_name`, `short_name`, `status`) VALUES
(1, 'T001', 'TE001', 'Chennai Super Kings', 'CSK', 0),
(2, 'T001', 'TE002', 'Mumbai Indians', 'MI', 0),
(3, 'T002', 'TE003', 'Tamilnadu', 'TN', 0),
(4, 'T002', 'TE004', 'Kerala', 'KL', 0),
(5, 'T003', 'TE005', 'India', 'IND', 0),
(6, 'T002', 'TE006', 'Maharastra', 'MH', 0),
(7, 'T003', 'TE007', 'Australia', 'AUS', 0),
(8, 'T003', 'TE008', 'England', 'ENG', 0),
(9, 'T002', 'TE009', 'Karnataka', 'KAR', 0),
(10, 'T001', 'TE010', 'Kolkata Knight Riders', 'KKR', 0);

-- --------------------------------------------------------

--
-- Table structure for table `toss`
--

CREATE TABLE `toss` (
  `sno` int(11) NOT NULL,
  `match_id` varchar(255) NOT NULL,
  `team1` varchar(255) NOT NULL,
  `team2` varchar(255) NOT NULL,
  `toss_won` varchar(255) NOT NULL,
  `choose` varchar(255) NOT NULL,
  `overs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tournament`
--

CREATE TABLE `tournament` (
  `sno` int(11) NOT NULL,
  `tournament_id` varchar(255) NOT NULL,
  `tournament_name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tournament`
--

INSERT INTO `tournament` (`sno`, `tournament_id`, `tournament_name`, `start_date`, `status`) VALUES
(1, 'T001', 'Indian Premiere League', '2023-04-28', 0),
(2, 'T002', 'Ranchi Trophy', '2023-05-10', 0),
(3, 'T003', 'ICC T20 Mens World Cup ', '2023-06-15', 0),
(4, 'T004', 'ICC T20 Womens World Cup', '2023-06-15', 0),
(8, 'T005', 'Womens Premiere League', '2023-04-07', 0),
(9, 'T006', 'Indian Premiere Leagu', '2023-03-31', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD UNIQUE KEY `sno` (`sno`) USING BTREE;

--
-- Indexes for table `batsman`
--
ALTER TABLE `batsman`
  ADD UNIQUE KEY `sno` (`sno`);

--
-- Indexes for table `bowler`
--
ALTER TABLE `bowler`
  ADD UNIQUE KEY `sno` (`sno`);

--
-- Indexes for table `live`
--
ALTER TABLE `live`
  ADD UNIQUE KEY `sno` (`sno`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD UNIQUE KEY `sno` (`sno`);

--
-- Indexes for table `player`
--
ALTER TABLE `player`
  ADD UNIQUE KEY `sno` (`sno`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD UNIQUE KEY `sno` (`sno`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD UNIQUE KEY `sno` (`sno`);

--
-- Indexes for table `toss`
--
ALTER TABLE `toss`
  ADD UNIQUE KEY `sno` (`sno`);

--
-- Indexes for table `tournament`
--
ALTER TABLE `tournament`
  ADD UNIQUE KEY `sno` (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `batsman`
--
ALTER TABLE `batsman`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bowler`
--
ALTER TABLE `bowler`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `live`
--
ALTER TABLE `live`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `player`
--
ALTER TABLE `player`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `toss`
--
ALTER TABLE `toss`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tournament`
--
ALTER TABLE `tournament`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
