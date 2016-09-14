-- ============================
-- Schema publishforce
-- user: publishforce
-- password: publishforce

-- http://localhost/~markmckee/phpMyAdmin/

-- tables:
-- pf_user [user_id, user_email, fname, lname, user_company, user_mobile, user_type, creation_date]
-- pf_files [file_id, title, file_name, provider, search_tags, upload_user, upload_date]
-- pf_company [company_id]
-- pf_rpa [rpa_id, rpa_name]
-- pf_budget


-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2016 at 07:36 AM
-- Server version: 5.7.9
-- PHP Version: 5.5.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `publishforce`
--

-- --------------------------------------------------------

--
-- Table structure for table `pf_user`
--

/*CREATE TABLE `pf_user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(80) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `user_company` varchar(100) NOT NULL,
  `user_mobile` varchar(50) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `creation_date` datetime NOT NULL,
  `active_flag` bit(1) NOT NULL,
  PRIMARY KEY (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
*/

DROP TABLE `pf_user`;

CREATE TABLE `pf_user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(80) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `user_company` varchar(100) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `user_mobile` varchar(50) NOT NULL,
  `publisher_user` bit(1) NOT NULL,
  `consumer_user` bit(1) NOT NULL,
  `publisher_and_consumer_user` bit(1) NOT NULL,
  `creation_date` datetime NOT NULL,
  `active_flag` bit(1) NOT NULL,
  PRIMARY KEY (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- Implementation notes:
-- User types: publisher, consumer, public viewer, paying member, consumer/publisher dual role

-- TEST VALUES

INSERT INTO `pf_user`(`user_name`, `user_email`, `fname`, `lname`, `user_company`, `job_title`, `user_mobile`, `publisher_user`, `consumer_user`, `publisher_and_consumer_user`, `creation_date`, `active_flag`) 
  VALUES ('mmckee','mark.mckee@publishforce.com','Mark','McKee','PublishForce Ltd','Sys admin','07801 105014',1,0,0,NOW(),1);
INSERT INTO `pf_user`(`user_name`, `user_email`, `fname`, `lname`, `user_company`, `job_title`, `user_mobile`, `publisher_user`, `consumer_user`, `publisher_and_consumer_user`, `creation_date`, `active_flag`) 
  VALUES ('fsmith','fred.smith@ubs.com','Fred','Smith','UBS AG','Portfolio Manager','07977 098033',1,0,0,NOW(), 1);
INSERT INTO `pf_user`(`user_name`, `user_email`, `fname`, `lname`, `user_company`, `job_title`, `user_mobile`, `publisher_user`, `consumer_user`, `publisher_and_consumer_user`, `creation_date`, `active_flag`) 
  VALUES ('asimpson','Angela.Simpson@hungerfords.com','Angela','Simpson','Hungerford Research','Analyst','07968 111022',1,0,0,NOW(), 1);
INSERT INTO `pf_user`(`user_name`, `user_email`, `fname`, `lname`, `user_company`, `job_title`, `user_mobile`, `publisher_user`, `consumer_user`, `publisher_and_consumer_user`, `creation_date`, `active_flag`) 
  VALUES ('fsimon','Fred.Simon@publishforce.com','Fred','Simon','Paris Research','Analyst','07968 111022',1,0,0,NOW(), 1);

DROP TABLE login;

CREATE TABLE login(
id int(10) NOT NULL AUTO_INCREMENT,
username varchar(255) NOT NULL,
password varchar(255) NOT NULL,
is_temp_psswd bit(1) NOT NULL,
PRIMARY KEY (id)
);

INSERT INTO `login`(`username`, `password`, `is_temp_psswd`) VALUES ('mmckee','PublishForce', 0);
INSERT INTO `login`(`username`, `password`, `is_temp_psswd`) VALUES ('fsimon','PublishForce', 1);

--  UPLOADS TABLE
DROP TABLE `pf_research_files`;

CREATE TABLE `pf_research_files` (
  `file_id` int NOT NULL AUTO_INCREMENT,
  `file_name` varchar(100) NOT NULL,
  `file_title` varchar(100) NOT NULL,
  `file_type` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `industry_type` varchar(50) NOT NULL,
  `file_abstract` varchar(255) NOT NULL,
  `search_tags` varchar(255) NOT NULL,
  `user_company` varchar(100) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (file_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `pf_research_files`(`user_id`, `file_name`, `file_type`, `file_title`, `industry_type`, `file_abstract`, `search_tags`, `user_company`, `creation_date`) 
VALUES ('mmckee','brazil_comm.pdf','pdf','Brazil Commodities 2016','commodities','Some abstract information here...','Brazil raw materials, commodities, Latin America','ABC Research Ltd',NOW());
INSERT INTO `pf_research_files`(`user_id`, `file_name`, `file_type`, `file_title`, `industry_type`, `file_abstract`, `search_tags`, `user_company`, `creation_date`) 
VALUES ('mmckee','uploads/car_email_img.jpg','pdf','Machinery in Ukraine','Agriculture','Some abstract information here...','farming, ukraine, manufacturing, xyz','Farm Research Ltd',NOW());

--
-- Table structure for table `pf_user_registration`
-- fname, lname, user_company, job_title, user_email, user_mobile, publisher_user, 
-- consumer_user, publisher_and_consumer_user

DROP TABLE `pf_user_registration`;

CREATE TABLE `pf_user_registration` (
  `user_reg_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(80) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `user_company` varchar(100) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `user_mobile` varchar(50) NOT NULL,
  `publisher_user` bit(1) NOT NULL,
  `consumer_user` bit(1) NOT NULL,
  `publisher_and_consumer_user` bit(1) NOT NULL,
  `active_flag` bit(1) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (user_reg_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pf_user_registration`(`user_email`, `fname`, `lname`, `user_company`, `job_title`, `user_mobile`, `publisher_user`, `consumer_user`, `publisher_and_consumer_user`, `active_flag`, `creation_date`) 
  VALUES ('mary.giles@grl.com','Mary','Giles','Global Research Ltd', 'Research Analyst','07001 111999', 1, 0, 0, 0, NOW());
INSERT INTO `pf_user_registration`(`user_email`, `fname`, `lname`, `user_company`, `job_title`, `user_mobile`, `publisher_user`, `consumer_user`, `publisher_and_consumer_user`, `active_flag`, `creation_date`) 
  VALUES ('bill@smithresearch.com','Bill','Smith','Smith Research Ltd', 'Research Director','07000 111777', 1, 0, 0, 0, NOW());

-- RESEARCH INBOX
DROP TABLE `pf_research_inbox`;

CREATE TABLE `pf_research_inbox` (
  `user_id` int(10) NOT NULL,
  `file_id` int NOT NULL,
  `read_flag` bit(1) NOT NULL,
  CONSTRAINT pf_research_inbox_primary 
UNIQUE (user_id, file_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pf_research_inbox`(`user_id`, `file_id`, `read_flag`) VALUES (1, 1, 0);
INSERT INTO `pf_research_inbox`(`user_id`, `file_id`, `read_flag`) VALUES (1, 2, 0);

-- query for my inbox
select b.file_name as fn, b.file_title as ft, b.industry_type as it, b.user_company as uc, b.creation_date as cd from pf_research_inbox a, pf_research_files b where a.user_id = 1
and a.file_id = b.file_id

-- main user session query:

select a.user_name as user_name, a.user_id from pf_user a, login b where a.user_name='$user_check' and a.user_name = b.username and a.active_flag=1 and b.is_temp_psswd = 0;

-- purchase history table
-- RESEARCH INBOX
DROP TABLE `pf_purchase_history`;

CREATE TABLE `pf_purchase_history` (
  `user_id` int(10) NOT NULL,
  `file_id` int NOT NULL,
  `purchased_date` datetime NOT NULL,
  CONSTRAINT pf_research_inbox_primary 
UNIQUE (user_id, file_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pf_purchase_history`(`user_id`, `file_id`, `purchased_date`) VALUES (2, 1, NOW());




