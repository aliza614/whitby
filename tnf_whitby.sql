-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 10, 2019 at 09:44 AM
-- Server version: 10.3.18-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tnf_whitby`
--

-- --------------------------------------------------------

--
-- Table structure for table `circumstances`
--

CREATE TABLE `circumstances` (
  `circumstanceID` int(11) NOT NULL,
  `deceasedID` int(11) NOT NULL,
  `expected` enum('Yes','No','Unknown') NOT NULL,
  `hospiceName` varchar(100) NOT NULL,
  `hospiceContact` varchar(100) NOT NULL,
  `hospicePhone` varchar(20) NOT NULL,
  `hospiceEmail` varchar(20) NOT NULL,
  `hospiceNotes` varchar(200) NOT NULL,
  `placeOfDeath` varchar(100) NOT NULL,
  `streetOfDeath` varchar(20) NOT NULL,
  `cityOfDeath` varchar(20) NOT NULL,
  `stateOfDeath` varchar(20) NOT NULL,
  `zipOfDeath` int(10) NOT NULL,
  `countyOfDeath` varchar(20) NOT NULL,
  `accessNotes` varchar(100) NOT NULL,
  `signingPhysician` varchar(100) NOT NULL,
  `bodyLocation` varchar(100) NOT NULL,
  `valid` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `circumstances`
--

INSERT INTO `circumstances` (`circumstanceID`, `deceasedID`, `expected`, `hospiceName`, `hospiceContact`, `hospicePhone`, `hospiceEmail`, `hospiceNotes`, `placeOfDeath`, `streetOfDeath`, `cityOfDeath`, `stateOfDeath`, `zipOfDeath`, `countyOfDeath`, `accessNotes`, `signingPhysician`, `bodyLocation`, `valid`) VALUES
(9, 14, 'Unknown', 'False', '', '', '', '', '', '234 yahoo dr','polar city', 'Colorado', 89442, 'larimer', '', '', 'new jersey', 1),
(10, 62, 'Unknown', 'False', '', '', '', '', '', '234 yahoo dr','polar city', 'Colorado', 89442, 'larimer', '', '', 'new jersey', 1),
(11, 63, 'Unknown', 'False', '', '', '', '', '', '234 yahoo dr','polar city', 'Colorado', 89442, 'larimer', '', '', 'new jersey', 1),
(12, 64, 'Unknown', 'False', '', '', '', '', '', '234 yahoo dr','polar city', 'Colorado', 89442, 'larimer', '', '', 'new jersey', 1),
(13, 61, 'Unknown', 'False', '', '', '', '', '', '234 yahoo dr','polar city', 'Colorado', 89442, 'larimer', '', '', 'new jersey', 1),
(14, 65, 'Unknown', 'False', '', '', '', '', '', '234 yahoo dr','polar city', 'Colorado', 89442, 'larimer', '', '', 'new jersey', 1),
(15, 71, 'Unknown', 'False', '', '', '', '', '', '234 yahoo dr','polar city', 'Colorado', 89442, 'larimer', '', '', 'new jersey', 1),
(16, 88, 'Unknown', 'False', '', '', '', '', '', '234 yahoo dr','polar city', 'Colorado', 89442, 'larimer', '', '', 'new jersey', 1),
(17, 89, 'Unknown', 'False', '', '', '', '', '', '234 yahoo dr','polar city', 'Colorado', 89442, 'larimer', '', '', 'new jersey', 1),
(18, 91, 'Unknown', 'False', '', '', '', '', '', '234 yahoo dr','polar city', 'Colorado', 89442, 'larimer', '', '', 'new jersey', 1);

-- --------------------------------------------------------

--
-- Table structure for table `circumstancesNotes`
--

CREATE TABLE `circumstancesNotes` (
  `circumstancesNoteID` int(11) NOT NULL,
  `note` varchar(2000) NOT NULL,
  `updateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `valid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `circumstancesNotes`
--

INSERT INTO `circumstancesNotes` (`circumstancesNoteID`, `note`, `updateTime`, `valid`) VALUES
(1, 'Rachel is in a state of high anxiety and grief about mother’s death – thought she was overmedicated and died because of that. I think she should take this to the hospital Ethics Committee. I have not commented on this except to say “I hear you.”', '2019-10-13 21:42:26', 1),
(2, 'circum murkum', '2019-10-14 02:18:18', 1),
(3, 'wwe34', '2019-10-14 02:20:51', 1),
(4, 'wwe34', '2019-10-14 03:06:15', 0),
(5, 'wwe34', '2019-10-14 03:06:06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `deceased`
--

CREATE TABLE `deceased` (
  `deceasedID` int(11) NOT NULL,
  `firstName` varchar(40) NOT NULL,
  `middleName` varchar(40) NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `sex` enum('Unknown','Male','Female') NOT NULL,
  `weight` int(11) NOT NULL,
  `birthday` date NOT NULL,
  `deathday` date NOT NULL,
  `SSN` varchar(20) NOT NULL,
  `entryTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `valid` tinyint(1) NOT NULL,
  `status` enum('Unknown','Deceased','Pending','PreNeed') NOT NULL,
  `progress` enum('start','in progress','complete') NOT NULL,
  `staffID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deceased`
--

INSERT INTO `deceased` (`deceasedID`, `firstName`, `middleName`, `lastName`, `sex`, `weight`, `birthday`, `deathday`, `SSN`, `entryTime`, `valid`, `status`, `progress`, `staffID`) VALUES
(91, 'Marg', 'Ruth', 'Root', 'Female', 0, '1933-06-28', '2019-09-14', '', '2019-09-21 20:48:17', 1, 'Deceased', 'in progress', 4),
(88, 'Doug', 'Stanley', 'Yiekel', 'Male', 170, '1950-02-14', '2019-09-15', '146-40-0208', '2019-09-17 14:18:36', 1, 'Deceased', 'in progress', 1),
(90, 'Donald', 'Edwin', 'Soupy', 'Male', 236, '1939-10-18', '2019-09-18', '540-42-4146', '2019-09-18 17:49:24', 1, 'Deceased', 'in progress', 0),
(92, 'middle', 'of', 'night', 'Unknown', 0, '0000-00-00', '0000-00-00', '', '2019-09-30 04:18:46', 0, 'Unknown', 'start', 0),
(93, '', '', 'nigh', 'Unknown', 0, '0000-00-00', '2019-09-30', '', '2019-09-30 04:19:10', 0, 'Unknown', 'start', 0),
(94, '', '', 'night', 'Unknown', 0, '0000-00-00', '2019-09-30', '', '2019-09-30 05:25:29', 0, 'Unknown', 'start', 0),
(95, '', 'of', '', 'Unknown', 0, '0000-00-00', '2019-09-30', '', '2019-09-30 05:52:50', 0, 'Unknown', 'start', 0),
(96, '', '', 'adfsdf', 'Unknown', 0, '0000-00-00', '2019-10-15', '', '2019-10-15 15:30:56', 1, 'Unknown', 'start', 0),
(97, '', '', '5we7', 'Unknown', 0, '0000-00-00', '2019-10-15', '', '2019-10-15 15:35:53', 1, 'Unknown', 'start', 0),
(98, '', '', '5we7', 'Unknown', 0, '0000-00-00', '2019-10-15', '', '2019-10-15 15:38:25', 1, 'Unknown', 'start', 0),
(99, '', '', 'hhh', 'Unknown', 0, '0000-00-00', '2019-10-15', '', '2019-10-15 15:38:39', 1, 'Unknown', 'start', 7),
(100, '', '', 'hhh', 'Unknown', 0, '0000-00-00', '2019-10-15', '', '2019-10-15 15:41:19', 1, 'Unknown', 'start', 7),
(101, 'tttttt', '', '', 'Unknown', 0, '0000-00-00', '2019-11-10', '', '2019-11-10 15:07:45', 1, 'Unknown', 'start', 0);

-- --------------------------------------------------------

--
-- Table structure for table `deceasedNotes`
--

CREATE TABLE `deceasedNotes` (
  `deceasedNoteID` int(11) NOT NULL,
  `note` varchar(2000) NOT NULL,
  `updateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `valid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deceasedNotes`
--

INSERT INTO `deceasedNotes` (`deceasedNoteID`, `note`, `updateTime`, `valid`) VALUES
(1, 'TEST NOTE FOR SURE', '2019-10-14 03:06:22', 0),
(2, 'ANOTHER TEST NOTE oh wow', '2019-10-13 21:25:26', 1),
(3, 'fdfgdg', '2019-10-05 19:41:14', 1),
(4, 'eega', '2019-10-05 19:42:34', 1),
(5, 'stgt', '2019-10-05 19:43:58', 1),
(6, 'q54yyw', '2019-10-05 19:44:31', 1),
(7, 'asfdasrt', '2019-10-13 20:49:19', 0),
(8, 'asfdasrt', '2019-10-13 20:50:39', 0),
(9, 'Buried on Friday Oct 11 in Coal Creek Cemetery', '2019-10-13 17:57:20', 1),
(10, 'How about now?', '2019-10-13 23:34:27', 1),
(11, 'now again?', '2019-10-13 23:37:09', 1),
(12, 'powpowpow', '2019-10-13 23:38:34', 0);

-- --------------------------------------------------------

--
-- Table structure for table `deceasedXcircumstancesNotes`
--

CREATE TABLE `deceasedXcircumstancesNotes` (
  `deceasedXdeceasedNoteID` int(11) NOT NULL,
  `circumstancesNoteID` int(11) NOT NULL,
  `deceasedID` int(11) NOT NULL,
  `valid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deceasedXcircumstancesNotes`
--

INSERT INTO `deceasedXcircumstancesNotes` (`deceasedXdeceasedNoteID`, `circumstancesNoteID`, `deceasedID`, `valid`) VALUES
(1, 1, 91, 1),
(2, 4, 91, 0),
(3, 5, 91, 0);

-- --------------------------------------------------------

--
-- Table structure for table `deceasedXdeceasedNotes`
--

CREATE TABLE `deceasedXdeceasedNotes` (
  `deceasedXdeceasedNoteID` int(11) NOT NULL,
  `deceasedNoteID` int(11) NOT NULL,
  `deceasedID` int(11) NOT NULL,
  `valid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deceasedXdeceasedNotes`
--

INSERT INTO `deceasedXdeceasedNotes` (`deceasedXdeceasedNoteID`, `deceasedNoteID`, `deceasedID`, `valid`) VALUES
(1, 1, 91, 0),
(2, 2, 91, 0),
(3, 1, 91, 0),
(4, 2, 91, 1),
(5, 5, 91, 0),
(6, 6, 91, 0),
(7, 6, 91, 0),
(8, 7, 91, 0),
(9, 8, 91, 0),
(10, 9, 91, 1),
(11, 12, 91, 0);

-- --------------------------------------------------------

--
-- Table structure for table `deceasedXPOC`
--

CREATE TABLE `deceasedXPOC` (
  `decXPOCID` int(11) NOT NULL,
  `deceasedID` int(11) NOT NULL,
  `POCID` int(11) NOT NULL,
  `valid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deceasedXPOC`
--

INSERT INTO `deceasedXPOC` (`decXPOCID`, `deceasedID`, `POCID`, `valid`) VALUES
(30, 91, 47, 1),
(26, 88, 43, 1),
(27, 88, 44, 1),
(28, 90, 45, 1),
(29, 90, 46, 1),
(31, 91, 50, 1),
(32, 91, 51, 0),
(33, 91, 52, 1),
(34, 91, 53, 1),
(35, 91, 54, 1),
(36, 91, 55, 1);

-- --------------------------------------------------------

--
-- Table structure for table `deceasedXproceduresNotes`
--

CREATE TABLE `deceasedXproceduresNotes` (
  `deceasedXprocedureNoteID` int(11) NOT NULL,
  `proceduresNoteID` int(11) NOT NULL,
  `deceasedID` int(11) NOT NULL,
  `valid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deceasedXproceduresNotes`
--

INSERT INTO `deceasedXproceduresNotes` (`deceasedXprocedureNoteID`, `proceduresNoteID`, `deceasedID`, `valid`) VALUES
(1, 2, 91, 1);

-- --------------------------------------------------------

--
-- Table structure for table `EDR`
--

CREATE TABLE `EDR` (
  `EDRID` int(11) NOT NULL,
  `entryTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `firstName` varchar(50) NOT NULL,
  `middleName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `valid` int(11) NOT NULL,
  `birthDate` date NOT NULL,
  `deathDate` date NOT NULL,
  `sex` enum('FEMALE','MALE','UNKNOWN') NOT NULL,
  `placeOfBirth` varchar(200) NOT NULL,
  `military` enum('NO','UNKNOWN','YES') NOT NULL,
  `SSN` varchar(20) NOT NULL,
  `typeOfPlace` enum('UNKNOWN','DECEDENT''S HOME','HOSPICE FACILITY','HOSPITAL-DEAD ON ARRIVAL','HOSPITAL-EMERGENCY ROOM/OUTPATIENT','HOSPITAL-INPATIENT','NURSING HOME-LONG TERM CARE FACILITY','OTHER') NOT NULL,
  `typeOfPlaceOther` varchar(100) NOT NULL,
  `placeName` varchar(100) NOT NULL,
  `addressOfDeath` varchar(100) NOT NULL,
  `cityOfDeath` varchar(100) NOT NULL,
  `stateOfDeath` varchar(100) NOT NULL DEFAULT 'CO',
  `zipOfDeath` varchar(100) NOT NULL,
  `countyOfDeath` varchar(100) NOT NULL,
  `cityLimits` enum('YES','NO','UNKNOWN') NOT NULL,
  `homeless` enum('FALSE','TRUE') NOT NULL DEFAULT 'FALSE',
  `address` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip` varchar(100) NOT NULL,
  `maritalStatus` enum('CIVIL UNION','DIVORCED (AND NOT REMARRIED)','MARRIED','MARRIED BUT SEPARATED','NEVER MARRIED','UNKNOWN','WIDOWED (AND NOT REMARRIED)') NOT NULL,
  `spouseFirstName` varchar(100) NOT NULL,
  `spouseMiddleName` varchar(100) NOT NULL,
  `spouseLastName` varchar(100) NOT NULL,
  `sameSexParents` enum('NO','YES','UNKNOWN') NOT NULL DEFAULT 'NO',
  `role` enum('coparent-coparent','coparent-father','father-father','mother-coparent','mother-mother') NOT NULL,
  `fathersFirstName` varchar(100) NOT NULL,
  `fathersMiddleName` varchar(100) NOT NULL,
  `fathersLastName` varchar(100) NOT NULL,
  `mothersFirstName` varchar(100) NOT NULL,
  `mothersMiddleName` varchar(100) NOT NULL,
  `mothersLastName` varchar(100) NOT NULL,
  `education` varchar(100) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `industry` varchar(100) NOT NULL,
  `hispanic` varchar(100) NOT NULL,
  `hispanicOther` varchar(100) NOT NULL,
  `race` varchar(100) NOT NULL,
  `raceOther` varchar(100) NOT NULL,
  `informantFirstName` varchar(100) NOT NULL,
  `informantLastName` varchar(100) NOT NULL,
  `informantRelationship` enum('spouse','child','grandparent','parent','partner','sibling','other') NOT NULL,
  `informantRelationshipOther` varchar(100) NOT NULL,
  `informantPhone` varchar(100) NOT NULL,
  `informantEmail` varchar(100) NOT NULL,
  `informantConsent` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `EDR`
--

INSERT INTO `EDR` (`EDRID`, `entryTime`, `firstName`, `middleName`, `lastName`, `valid`, `birthDate`, `deathDate`, `sex`, `placeOfBirth`, `military`, `SSN`, `typeOfPlace`, `typeOfPlaceOther`, `placeName`, `addressOfDeath`, `cityOfDeath`, `stateOfDeath`, `zipOfDeath`, `countyOfDeath`, `cityLimits`, `homeless`, `address`, `city`, `state`, `zip`, `maritalStatus`, `spouseFirstName`, `spouseMiddleName`, `spouseLastName`, `sameSexParents`, `role`, `fathersFirstName`, `fathersMiddleName`, `fathersLastName`, `mothersFirstName`, `mothersMiddleName`, `mothersLastName`, `education`, `occupation`, `industry`, `hispanic`, `hispanicOther`, `race`, `raceOther`, `informantFirstName`, `informantLastName`, `informantRelationship`, `informantRelationshipOther`, `informantPhone`, `informantEmail`, `informantConsent`) VALUES
(1, '2019-11-03 17:51:07', 'qrwe', '', '43', 1, '0000-00-00', '0000-00-00', 'FEMALE', '', 'NO', '', 'UNKNOWN', '', '', '', '', 'CO', '', '', 'YES', 'FALSE', '', '', '', '', 'CIVIL UNION', '', '', '', 'NO', 'coparent-coparent', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'spouse', '', '', '', 0),
(2, '2019-11-03 18:20:00', 'rea', 'are', 'rea', 1, '0000-00-00', '0000-00-00', 'FEMALE', '', 'NO', '', 'UNKNOWN', '', '', '', '', 'CO', '', '', 'YES', 'FALSE', '', '', '', '', 'CIVIL UNION', '', '', '', 'NO', 'coparent-coparent', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'spouse', '', '', '', 0),
(3, '2019-11-03 18:43:05', 'adg', 'aet', '53', 1, '0000-00-00', '0000-00-00', 'FEMALE', '', 'NO', '', 'UNKNOWN', '', '', '', '', 'CO', '', '', 'YES', 'FALSE', '', '', '', '', 'CIVIL UNION', '', '', '', 'NO', 'coparent-coparent', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'spouse', '', '', '', 0),
(4, '2019-11-03 22:49:29', 'toger', 'none', 'bodget', 1, '2000-11-11', '0000-00-00', 'MALE', 'Brazil', 'UNKNOWN', '12434', 'UNKNOWN', '', '', '', '', 'CO', '', '', 'YES', 'FALSE', '', '', '', '', 'CIVIL UNION', '', '', '', 'NO', 'coparent-coparent', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'spouse', '', '', '', 0),
(5, '2019-11-03 22:56:03', 'yuu', 'qa`u', '6ujqa', 1, '1998-09-15', '2019-11-03', 'FEMALE', 'y5t5', 'NO', 'wwr', 'UNKNOWN', '', '', '', '', 'CO', '', '', 'YES', 'FALSE', '', '', '', '', 'CIVIL UNION', '', '', '', 'NO', 'coparent-coparent', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'spouse', '', '', '', 0),
(6, '2019-11-03 23:57:22', 'ff', 'fff', 'ffff', 1, '1970-07-16', '2019-11-03', 'FEMALE', 'weewf', 'UNKNOWN', 't53qt', 'DECEDENT\'S HOME', '5 3t', '', 'wt', '5y45y4', 'CO', '666666', '544q', 'YES', 'FALSE', '', '', '', '', 'CIVIL UNION', '', '', '', 'NO', 'coparent-coparent', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'spouse', '', '', '', 0),
(7, '2019-11-04 05:26:21', 'tyyy', 'qa45ey', 'y55y', 1, '2019-11-22', '2019-11-03', 'FEMALE', '4e5y', 'NO', '3553', 'NURSING HOME-LONG TERM CARE FACILITY', '', 'sdfg5r', '5y5', 'vbrfte', 'CO', '5y5y5', '5y5y5y', 'YES', 'FALSE', '5y5y', 'dfghh', 'CO', 'y4y54e', '', 'qaty', '54ey5y', 'way', 'NO', 'coparent-coparent', 'qathth', 'mm', 'mtem', 'ae', 'hth', 'tht', '', '', '', '', '', '', '', '', '', 'spouse', '', '', '', 0),
(8, '2019-11-05 13:31:41', 'q354t', 'y54', 'q64y', 1, '2019-11-28', '2019-11-05', 'FEMALE', 'q46y', 'NO', '45y4y', 'DECEDENT\'S HOME', 'qyy4', '', 'qy4yy', 'yhk,', 'CO', 'f,,yu', '9797', 'YES', 'FALSE', '', '', 'CO', '', 'CIVIL UNION', '', '', '', 'NO', 'coparent-coparent', 'uuu', 'uu65', 'u5w', '5uu6', 'u65u', '5uuuu', '8TH GRADE OR LESS', 'we', '75u', 'No Not Spanish/Hispanic/Latino', '', 'White', '', 'kkk', 'e6', 'spouse', '', '53553555', '7we6uu@rtt.vrr', 0),
(9, '2019-11-05 13:34:28', 'tqth', 'q4et6', 'qe4y', 1, '2019-11-22', '2019-11-05', 'FEMALE', '35uyq', 'NO', '5yyy', 'DECEDENT\'S HOME', '', '', '46u', 'qu6u', 'CO', '6u4', 'u66u4', 'YES', 'FALSE', '', '', 'CO', '', 'CIVIL UNION', '', '', '', 'NO', 'coparent-coparent', 'rlirili', 'rilil', 'rilil', 'u57i', 'l;rtil', 'rll', '8TH GRADE OR LESS', 'i7yro', '7or8o8', 'No Not Spanish/Hispanic/Latino', '', 'White', '', 'ril', '7yir', 'spouse', '', 'li35t35t', 'rilirl@ggg.gh', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pointOfContact`
--

CREATE TABLE `pointOfContact` (
  `POCID` int(11) NOT NULL,
  `POCFirstName` varchar(100) NOT NULL,
  `POCLastName` varchar(100) NOT NULL,
  `POCemail` varchar(100) NOT NULL,
  `POCphone` varchar(20) NOT NULL,
  `POCNextOfKin` enum('yes','no','maybe') NOT NULL,
  `POCrelation` varchar(20) NOT NULL,
  `firstContact` int(11) NOT NULL,
  `valid` int(11) NOT NULL,
  `POCnotes` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pointOfContact`
--

INSERT INTO `pointOfContact` (`POCID`, `POCFirstName`, `POCLastName`, `POCemail`, `POCphone`, `POCNextOfKin`, `POCrelation`, `firstContact`, `valid`, `POCnotes`) VALUES
(47, 'Rachel Anne', 'Landau', '', '719-775-6467', 'yes', 'daughter', 0, 1, 'Daughter has a Jewish but also very eclectic belief system and is planning to move to Boulder – waiting for housing (I believe, subsidized).'),
(43, 'Heidi', '', '', '', 'yes', 'spouse', 0, 1, 'Married for 2.5 years, together for 4 years. They met at The Psychic Institute.'),
(44, 'Carrie', '', '', '3033047520', 'no', 'friend', 0, 1, 'Friend of widow'),
(45, 'Hap', '', '', '303 286 9929', 'yes', 'ex wife', 0, 1, ''),
(46, 'Harmoni', '', '', '303-332-1143', 'yes', 'daughter', 0, 1, 'estranged with POA'),
(48, 'howdy', 'howdy', '', '', 'no', '', 0, 1, ''),
(49, 'howdy', 'howdy', '', '', 'no', '', 0, 1, ''),
(50, 'other', 'brother', '', '', 'yes', '', 0, 0, 'fake news'),
(51, 'other', 'brother', '', '', 'yes', '', 0, 1, 'fake news'),
(52, '', '', '', '', 'yes', '', 0, 0, ''),
(53, '', '', '', '', 'yes', '', 0, 0, 'al;sdfkj  arsgrr afggyyhyq\r\n\r\nasdfdl'),
(54, '', '', '', '', 'yes', '', 0, 0, 'al;sdfkj  arsgrr afggyyhyq\r\n\r\nasdfdl'),
(55, '', '', '', '', 'yes', '', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `procedures`
--

CREATE TABLE `procedures` (
  `procedureID` int(11) NOT NULL,
  `deceasedID` int(11) NOT NULL,
  `EDRStatus` enum('Waiting for Bio Form','Not started yet','Started - waiting for additional info','Designated - waiting for Certification','Released','Needs correction','There are issues') NOT NULL,
  `EDRUpdateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `finalDisposition` enum('Cremation','Burial','Alkaline Hydrolosis','Other','Unknown','Leave the State') NOT NULL,
  `deathCertificates` int(11) NOT NULL,
  `deathCertificateStatus` enum('Unknown','Ready at Vital Records','Ready for Pickup at The Center','Ready to Deliver to Client','Needs Correction','Delivered','Not Pinned Yet','Complete') NOT NULL,
  `cremains` enum('In Storage','Cremated - ready for pickup','Cremains at The Center','Cremains Delivered','Unknown') NOT NULL,
  `dispositionStatus` enum('Unknown','Cremated','Buried','In process','Other','Dissolved') NOT NULL,
  `permit` enum('Need Permit and Auth for Disposition','Need Permit Have Auth','Have Permit Need Auth','Have Both Permit and Auth','Unknown','There are issues') NOT NULL,
  `valid` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `procedures`
--

INSERT INTO `procedures` (`procedureID`, `deceasedID`, `EDRStatus`, `EDRUpdateTime`, `finalDisposition`, `deathCertificates`, `deathCertificateStatus`, `cremains`, `dispositionStatus`, `permit`, `valid`) VALUES
(2, 14, 'Waiting for Bio Form', '2019-09-01 16:15:50', 'Unknown', 5, 'Ready at Vital Records', 'In Storage', 'Unknown', 'Need Permit and Auth for Disposition', 1),
(3, 65, 'Waiting for Bio Form', '2019-09-01 16:14:06', 'Other', 4, 'Needs Correction', 'Cremated - ready for pickup', 'Unknown', 'Need Permit and Auth for Disposition', 1),
(4, 61, 'Waiting for Bio Form', '2019-09-01 16:19:57', 'Cremation', 12, 'Not Pinned Yet', 'In Storage', 'Unknown', 'Need Permit and Auth for Disposition', 1),
(5, 71, 'Waiting for Bio Form', '2019-09-01 17:26:09', 'Cremation', 2, 'Ready for Pickup at The Center', 'In Storage', 'Unknown', 'Need Permit Have Auth', 1),
(6, 88, 'Released', '2019-11-10 14:53:39', 'Alkaline Hydrolosis', 10, 'Delivered', '', 'In process', 'Need Permit and Auth for Disposition', 1),
(7, 90, 'Designated - waiting for Certification', '2019-09-21 14:33:38', 'Cremation', 0, 'Unknown', '', 'Unknown', 'Need Permit and Auth for Disposition', 1),
(8, 91, '', '2019-10-14 04:19:34', 'Burial', 0, 'Needs Correction', '', 'Unknown', 'Need Permit and Auth for Disposition', 1);

-- --------------------------------------------------------

--
-- Table structure for table `proceduresNotes`
--

CREATE TABLE `proceduresNotes` (
  `proceduresNoteID` int(11) NOT NULL,
  `note` varchar(2000) NOT NULL,
  `updateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `valid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proceduresNotes`
--

INSERT INTO `proceduresNotes` (`proceduresNoteID`, `note`, `updateTime`, `valid`) VALUES
(1, 'Rachel is meeting with Bob Sweeney of Foothills Garden on Saturday. I do not know the time. Perhaps she could come by with paperwork – but I know we have the vigil for Doug and do not want to run over', '2019-10-14 03:27:20', 1),
(2, 'Wackanda', '2019-10-14 03:29:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffID` int(11) NOT NULL,
  `staffName` varchar(100) NOT NULL,
  `staffEmail` varchar(200) NOT NULL,
  `staffNotes` varchar(2000) NOT NULL,
  `jobTitle` varchar(50) NOT NULL,
  `photo` varchar(20) NOT NULL,
  `valid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffID`, `staffName`, `staffEmail`, `staffNotes`, `jobTitle`, `photo`, `valid`) VALUES
(1, 'Dan', 'dan@thenaturalfuneral.com', '', 'Director of Finance & Tech', 'dan.jpg', 1),
(2, 'Ehdi', 'edrea@thenaturalfuneral.com', '', 'Holistic Funeral Director', 'ehdi.jpg', 1),
(3, 'Karen', 'karen@thenaturalfuneral.com', '', 'Director of Customer Care', 'karen.jpg', 1),
(4, 'Seth', 'Seth@thenaturalfuneral.com', '', 'Director of Solutions', 'seth.jpg', 1),
(7, 'Carolyn', 'carolyn@thenaturalfuneral.com', '', 'Celebrant', 'carolyn.jpg', 1),
(8, 'Vicki', 'vicki@thenaturalfuneral.com', '', 'Angel', 'vicki.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `circumstances`
--
ALTER TABLE `circumstances`
  ADD PRIMARY KEY (`circumstanceID`),
  ADD UNIQUE KEY `deceasedID` (`deceasedID`);

--
-- Indexes for table `circumstancesNotes`
--
ALTER TABLE `circumstancesNotes`
  ADD PRIMARY KEY (`circumstancesNoteID`);

--
-- Indexes for table `deceased`
--
ALTER TABLE `deceased`
  ADD PRIMARY KEY (`deceasedID`);

--
-- Indexes for table `deceasedNotes`
--
ALTER TABLE `deceasedNotes`
  ADD PRIMARY KEY (`deceasedNoteID`);

--
-- Indexes for table `deceasedXcircumstancesNotes`
--
ALTER TABLE `deceasedXcircumstancesNotes`
  ADD PRIMARY KEY (`deceasedXdeceasedNoteID`);

--
-- Indexes for table `deceasedXdeceasedNotes`
--
ALTER TABLE `deceasedXdeceasedNotes`
  ADD PRIMARY KEY (`deceasedXdeceasedNoteID`);

--
-- Indexes for table `deceasedXPOC`
--
ALTER TABLE `deceasedXPOC`
  ADD PRIMARY KEY (`decXPOCID`);

--
-- Indexes for table `deceasedXproceduresNotes`
--
ALTER TABLE `deceasedXproceduresNotes`
  ADD PRIMARY KEY (`deceasedXprocedureNoteID`);

--
-- Indexes for table `EDR`
--
ALTER TABLE `EDR`
  ADD PRIMARY KEY (`EDRID`);

--
-- Indexes for table `pointOfContact`
--
ALTER TABLE `pointOfContact`
  ADD PRIMARY KEY (`POCID`);

--
-- Indexes for table `procedures`
--
ALTER TABLE `procedures`
  ADD PRIMARY KEY (`procedureID`),
  ADD UNIQUE KEY `deceasedID` (`deceasedID`);

--
-- Indexes for table `proceduresNotes`
--
ALTER TABLE `proceduresNotes`
  ADD PRIMARY KEY (`proceduresNoteID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffID`),
  ADD UNIQUE KEY `staffName` (`staffName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `circumstances`
--
ALTER TABLE `circumstances`
  MODIFY `circumstanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `circumstancesNotes`
--
ALTER TABLE `circumstancesNotes`
  MODIFY `circumstancesNoteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `deceased`
--
ALTER TABLE `deceased`
  MODIFY `deceasedID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `deceasedNotes`
--
ALTER TABLE `deceasedNotes`
  MODIFY `deceasedNoteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `deceasedXcircumstancesNotes`
--
ALTER TABLE `deceasedXcircumstancesNotes`
  MODIFY `deceasedXdeceasedNoteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `deceasedXdeceasedNotes`
--
ALTER TABLE `deceasedXdeceasedNotes`
  MODIFY `deceasedXdeceasedNoteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `deceasedXPOC`
--
ALTER TABLE `deceasedXPOC`
  MODIFY `decXPOCID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `deceasedXproceduresNotes`
--
ALTER TABLE `deceasedXproceduresNotes`
  MODIFY `deceasedXprocedureNoteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `EDR`
--
ALTER TABLE `EDR`
  MODIFY `EDRID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pointOfContact`
--
ALTER TABLE `pointOfContact`
  MODIFY `POCID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `procedures`
--
ALTER TABLE `procedures`
  MODIFY `procedureID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `proceduresNotes`
--
ALTER TABLE `proceduresNotes`
  MODIFY `proceduresNoteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
