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

DROP TABLE IF EXISTS `pf_user`;

CREATE TABLE `pf_user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(80) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `user_company` varchar(100) NOT NULL,
  `firm_id` int(10) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `user_mobile` varchar(50) NOT NULL,
  `publisher_user` bit(1) NOT NULL,
  `consumer_user` bit(1) NOT NULL,
  `publisher_and_consumer_user` bit(1) NOT NULL,
  `creation_date` datetime NOT NULL,
  `sys_admin_flag` bit(1) NOT NULL,
  `active_flag` bit(1) NOT NULL,
  PRIMARY KEY (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER table `pf_user` add `firm_id` int(10) NOT NULL AFTER `user_company`;

-- Implementation notes:
-- User types: publisher, consumer, public viewer, paying member, consumer/publisher dual role

-- TEST VALUES
-- NEW FIRM_ID FIELD!!!!
-- **********************
INSERT INTO `pf_user`(`user_name`, `user_email`, `fname`, `lname`, `user_company`, `job_title`, `user_mobile`, `publisher_user`, `consumer_user`, `publisher_and_consumer_user`, `creation_date`, `sys_admin_flag`, `active_flag`) 
  VALUES ('mmckee','mark.mckee@publishforce.com','Mark','McKee','PublishForce Ltd','Sys admin','07801 105014',1,0,0,NOW(),1,1);
INSERT INTO `pf_user`(`user_name`, `user_email`, `fname`, `lname`, `user_company`, `job_title`, `user_mobile`, `publisher_user`, `consumer_user`, `publisher_and_consumer_user`, `creation_date`, `sys_admin_flag`, `active_flag`) 
  VALUES ('fsmith','fred.smith@ubs.com','Fred','Smith','UBS AG','Portfolio Manager','07977 098033',1,0,0,NOW(),0, 1);
INSERT INTO `pf_user`(`user_name`, `user_email`, `fname`, `lname`, `user_company`, `job_title`, `user_mobile`, `publisher_user`, `consumer_user`, `publisher_and_consumer_user`, `creation_date`, `sys_admin_flag`, `active_flag`) 
  VALUES ('asimpson','Angela.Simpson@hungerfords.com','Angela','Simpson','Hungerford Research','Analyst','07968 111022',1,0,0,NOW(),0, 1);
INSERT INTO `pf_user`(`user_name`, `user_email`, `fname`, `lname`, `user_company`, `job_title`, `user_mobile`, `publisher_user`, `consumer_user`, `publisher_and_consumer_user`, `creation_date`, `sys_admin_flag`, `active_flag`) 
  VALUES ('fsimon','Fred.Simon@publishforce.com','Fred','Simon','Paris Research','Analyst','07968 111022',1,0,0,NOW(),0, 1);

DROP TABLE IF EXISTS login;

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
DROP TABLE IF EXISTS `pf_research_files`;

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
  `face_value` decimal(15,2) NOT NULL,
  `sell_ccy` varchar(3) NOT NULL,
  `published_flag` BIT(1) NOT NULL,
  `published_date` datetime DEFAULT NULL,
  `creation_date` datetime NOT NULL,
  `file_author` varchar(255) NOT NULL, 
  `file_author_email` varchar(255) NOT NULL, 
  `file_frequency` varchar(255) DEFAULT NULL,
  PRIMARY KEY (file_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- NEW FIELDS for `file-author`, `file-author-email`, `file-frequency`


-- ALTER TABLE `pf_research_files` ADD `published_flag` BIT(1) NOT NULL AFTER `sell_ccy`;

ALTER TABLE `pf_research_files` ADD `file_author` varchar(255) NOT NULL AFTER `creation_date`;
ALTER TABLE `pf_research_files` ADD `file_author_email` varchar(255) NOT NULL AFTER `file_author`; 
ALTER TABLE `pf_research_files` ADD `file_frequency` varchar(255) DEFAULT NULL AFTER `file_author_email`;


INSERT INTO `pf_research_files`(`user_id`, `file_name`, `file_type`, `file_title`, `industry_type`, `file_abstract`, `search_tags`, `user_company`, `face_value`, `sell_ccy`, `published_flag`, `creation_date`, `file_author`, `file_author_email`, `file_frequency`) 
VALUES ('mmckee','uploads/brazil_comm.pdf','pdf','Brazil Commodities 2016','commodities','Some abstract information here...','Brazil raw materials, commodities, Latin America','ABC Research Ltd',5000.00, 'GBP', 0, NOW(), 'John Smith', 'jmith@example.com', 'yearly');
INSERT INTO `pf_research_files`(`user_id`, `file_name`, `file_type`, `file_title`, `industry_type`, `file_abstract`, `search_tags`, `user_company`, `face_value`, `sell_ccy`, `published_flag`, `creation_date`) 
VALUES ('mmckee','uploads/ukraine_machinery.pdf','pdf','Machinery in Ukraine','Agriculture','Some abstract information here...','farming, ukraine, manufacturing, xyz','Farm Research Ltd',10000.00, 'GBP', 0, NOW());
INSERT INTO `pf_research_files`(`user_id`, `file_name`, `file_type`, `file_title`, `industry_type`, `file_abstract`, `search_tags`, `user_company`, `face_value`, `sell_ccy`, `published_flag`, `creation_date`) 
VALUES ('mmckee','uploads/craft_beer.pdf','pdf','London craft ale','Beverages','The beer brewing industry is changing and we think now is the time to invest...','brewing, upstart industry, beer','Value Add Ltd',12000.00, 'GBP', 0, NOW());





--
-- Table structure for table `pf_user_registration`
-- fname, lname, user_company, job_title, user_email, user_mobile, publisher_user, 
-- consumer_user, publisher_and_consumer_user

DROP TABLE IF EXISTS `pf_user_registration`;

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
DROP TABLE IF EXISTS `pf_research_inbox`;

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
DROP TABLE IF EXISTS `pf_purchase_history`;

CREATE TABLE `pf_purchase_history` (
  `user_id` int(10) NOT NULL,
  `file_id` int NOT NULL,
  `purchased_date` datetime NOT NULL,
  `purchased_fee` decimal(15,2) NOT NULL,
  `purchased_ccy` varchar(3) NOT NULL,
  CONSTRAINT pf_purchase_history_primary 
UNIQUE (user_id, file_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `pf_purchase_history` ADD `rpa_id` int(10) NOT NULL AFTER `purchased_ccy`;


INSERT INTO `pf_purchase_history`(`user_id`, `file_id`, `purchased_date`, `purchased_fee`, `purchased_ccy`) VALUES (2, 1, NOW(), 1000.00, 'GBP');
INSERT INTO `pf_purchase_history`(`user_id`, `file_id`, `purchased_date`, `purchased_fee`, `purchased_ccy`) VALUES (1, 1, NOW(), 1000.00, 'GBP');

-- RESEARCH SELECTED BUT NOT PURCHASED
DROP TABLE IF EXISTS `pf_research_bookmarks`;

CREATE TABLE `pf_research_bookmarks` (
  `user_id` int(10) NOT NULL,
  `file_id` int NOT NULL,
  `bookmarks_date` datetime NOT NULL,
  CONSTRAINT pf_research_bookmarks_primary 
UNIQUE (user_id, file_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pf_research_bookmarks`(`user_id`, `file_id`, `bookmarks_date`) VALUES (1, 1, NOW());

-- FIRM DETAILS
DROP TABLE IF EXISTS `pf_firm_details`;

CREATE TABLE `pf_firm_details` (
  `firm_id` int(10) NOT NULL AUTO_INCREMENT,
  `firm_name` varchar(100) NOT NULL,
  `active_flag` bit(1) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (firm_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pf_firm_details`(`firm_name`, `active_flag`, `creation_date`) VALUES ('ABC Research Ltd', 1, NOW());
INSERT INTO `pf_firm_details`(`firm_name`, `active_flag`, `creation_date`) VALUES ('Danske Bank', 1, NOW());
INSERT INTO `pf_firm_details`(`firm_name`, `active_flag`, `creation_date`) VALUES ('FMR Advisory', 1, NOW());
INSERT INTO `pf_firm_details`(`firm_name`, `active_flag`, `creation_date`) VALUES ('London Research Ltd', 1, NOW());

-- FUND DETAILS
DROP TABLE IF EXISTS `pf_funds`;

CREATE TABLE `pf_funds` (
`Issuer_name` varchar(100) NOT NULL,
`Country_of_Incorporation` varchar(100) NOT NULL,
`ISIN` varchar(100) NOT NULL,
`CFI_Code` varchar(100) NOT NULL,
`Security_Type` varchar(100) NOT NULL,
`Security_Description` varchar(100) NOT NULL,
`Country_of_Register` varchar(100) NOT NULL,
`Security_Form` varchar(100) NOT NULL,
`Security_Status` varchar(100) NOT NULL,
  PRIMARY KEY (ISIN)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*
DISPLAY FIELDS
Issuer_name
Country_of_Incorporation
ISIN
CFI_Code
Security_Type
Security_Description
Country_of_Register
Security_Form
Security_Status

*/


INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('JUPITER SPLIT TRUST','Great Britain - GB','GB00B02WQB60','ESVUFR','Par Value','CAP GBP0.05(ASS JUPITER 2ND SPT PKG UTS)','Great Britain - GB','Registered','Tradeable');

INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('JUPITER SPLIT TRUST','Great Britain - GB','GB00B02WQG16','ESVUFR','Par Value','CAP GBP0.05(ASSD SCHEME CASH)','Great Britain - GB','Registered','Inactive');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('JUPITER SPLIT TRUST','Great Britain - GB','GB00B02WQX80','ESVUFR','Par Value','INC GBP0.05(ASS JUP 2ND ENH INC PKG UT)','Great Britain - GB','Registered','Tradeable');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('BLACKROCK (CHANNEL ISLANDS) LTD','Jersey - JE','JE00B4RG7R45','EUOGMR','Funds/OEICs','HIGH PERFORMANCE OVER 5 YR IDX LKD GILT','Jersey - JE','Registered','Tradeable');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('BLACKROCK (CHANNEL ISLANDS) LTD','Jersey - JE','JE00B4VVKY30','EUOGMR','Funds/OEICs','HIGH PERFORMANCE OVER 15 YEAR GILT','Jersey - JE','Registered','Tradeable');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('BLACKROCK (CHANNEL ISLANDS) LTD','Jersey - JE','JE00B51WK762','EUOIMR','Funds/OEICs','DYNAMIC DIVERSIFIED GROWTH I INC','Jersey - JE','Registered','Tradeable');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('BLACKROCK (CHANNEL ISLANDS) LTD','Jersey - JE','JE00B54ZWL01','EUOGMR','Funds/OEICs','DYNAMIC DIVERSIFIED GROWTH I ACC','Jersey - JE','Registered','Tradeable');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('BLACKROCK ABSOLUTE RETURN STRATEGIE','Jersey - JE','JE00B2PXDB91','EUXXXR','NPV','RED PART SHS NPV GBP','Jersey - JE','Registered','Inactive');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('UBS AG','Switzerland - CH','GB0031402265','EUXXXR','Funds/OEICs','EUROPA SUBSTANZ PLUS INDEX','Great Britain - GB','Registered','Tradeable');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('UBS AG','Switzerland - CH','GB0031404428','EUXXXR','Funds/OEICs','US GROWTH 25 INDEX','Great Britain - GB','Registered','Tradeable');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('UBS AG','Switzerland - CH','GB0032236555','EUXXXR','Funds/OEICs','EUROPEAN FOCUS CONVERTIBLE INDEX','Great Britain - GB','Registered','Tradeable');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('UBS AG','Switzerland - CH','GB0032705989','EUXXXR','Funds/OEICs','MULTI STRATEGY INDEX BASKET','Not any country (I.e.Bearer) - ZZ','Bearer','Tradeable');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('UBS AG','Switzerland - CH','GB0032800814','EUXXXR','Funds/OEICs','EUROPA WACHSTUM PLUS INDEX','Not any country (I.e.Bearer) - ZZ','Bearer','Tradeable');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('UBS AG','Switzerland - CH','GB0034372853','MRIXXX','Miscellaneous','EMERGING MARKETS REFERENCE PORTFOLIO','Great Britain - GB','Registered','Tradeable');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('UBS AG','Switzerland - CH','GB0034372960','MRIXXX','Miscellaneous','WEALTH MANAGEMENT STRATEGIC 20 EQTY PORT','Great Britain - GB','Registered','Tradeable');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('INVESTEC ALL AFRICA FUND LTD','Guernsey, C.I. - GG','GG00B28CQP89','EUXXXR','NPV','ORD NPV','Great Britain - GB','Registered','Inactive');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('INVESTEC ASSET MANAGEMENT LTD','Great Britain - GB','GB00B82FK756','EUXIMR','Funds/OEICs','RETIREMENT ADV INVESTEC CAUTIOUS MANAG','Great Britain - GB','Registered','Tradeable');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('INVESTEC ASSET MANAGEMENT LTD','Great Britain - GB','GB00B8433781','EUXIMR','Funds/OEICs','RETIREMENT ADV INVESTEC MAP','Great Britain - GB','Registered','Tradeable');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('INVESTEC ASSET MGMT GUERNSEY LTD','Guernsey, C.I. - GG','GB0003945879','EUXXXR','Funds/OEICs','WORLDWIDE UMBRELLA FD LTD ASIAN SMCOS','Great Britain - GB','Registered','Inactive');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('INVESTEC FUND MANAGERS','Great Britain - GB','GB00BWH5XY60','EUOIMR','Funds/OEICs','EMERGING MKTS DYNAMIC EQT S GBP NET ACC','Great Britain - GB','Registered','Tradeable');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('INVESTEC FUND MANAGERS','Great Britain - GB','GB00BWH5XZ77','EUOIMR','Funds/OEICs','EMERGING MKTS DYNAMIC EQT A GBP NET ACC','Great Britain - GB','Registered','Tradeable');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('INVESTEC FUND MANAGERS','Great Britain - GB','GB00BWH5Y098','EUOGMR','Funds/OEICs','EMERGING MKTS DYNAMIC EQT I GBP NET ACC','Great Britain - GB','Registered','Tradeable');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('INVESTEC FUND MANAGERS','Great Britain - GB','GB00BWH5Y106','EUOIMR','Funds/OEICs','EMERGING MKTS DYNAMIC EQT S GBP NET ACC','Great Britain - GB','Registered','Tradeable');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('INVESTEC FUND MANAGERS','Great Britain - GB','GB00BWH5Y544','EUOGMR','Funds/OEICs','GLOBAL DIVIDEND A GBP NET ACC','Great Britain - GB','Registered','Tradeable');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('INVESTEC FUND MANAGERS','Great Britain - GB','GB00BWH5Y650','EUOIMR','Funds/OEICs','GLOBAL DIVIDEND A GBP NET INC 2','Great Britain - GB','Registered','Tradeable');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('INVESTEC FUND MANAGERS','Great Britain - GB','GB00BWH5Y767','EUOGMR','Funds/OEICs','GLOBAL DIVIDEND I GBP NET ACC','Great Britain - GB','Registered','Tradeable');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('INVESTEC FUND MANAGERS','Great Britain - GB','GB00BWH5Y874','EUOIMR','Funds/OEICs','GLOBAL DIVIDEND I GBP NET INC 2','Great Britain - GB','Registered','Tradeable');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('M&G EQUITY INVESTMENT TRUST','Great Britain - GB','GB0005510929','EPXXXR','Preference','Shares/Preferred Stock	ZERO DIV PRF 1P','Great Britain - GB','Registered','Inactive');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('M&G GLOBAL DIVIDEND FUND','Great Britain - GB','GB00B39R2S49','EUOGXR','Funds/OEICs','EUR A ACC','Great Britain - GB','Registered','Tradeable');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('M&G GLOBAL DIVIDEND FUND','Great Britain - GB','GB00B39R2T55','EUOGXR','Funds/OEICs','EUR C ACC','Great Britain - GB','Registered','Tradeable');

INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('M&G HIGH INCOME INVESTMENT TRUST','Great Britain - GB','GB0005532709','ESXXXR','Par Value','CAP SHS GBP0.01','Great Britain - GB','Registered','Tradeable');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('M&G HIGH INCOME INVESTMENT TRUST','Great Britain - GB','GB0005532816','ESXXXR','Par Value','INC SHS GBP0.01','Great Britain - GB','Registered','Tradeable');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('M&G HIGH INCOME INVESTMENT TRUST','Great Britain - GB','GB0005532923','EMXXXR','Units','INC & GW UTS(COMPR 1 INC & 1CAP SH)','Great Britain - GB','Registered','Tradeable');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('M&G HIGH INCOME INVESTMENT TRUST','Great Britain - GB','GB0005533004','EMXXXR','Units','PACK UTS(COMPR 1-0-DIV PF 1INC&1CAP SH)','Great Britain - GB','Registered','Tradeable');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('M&G HIGH INCOME INVESTMENT TRUST','Great Britain - GB','GB0005533228','EPXXXR','Preference Shares/Preferred Stock','ZERO DIV PRF SHS GBP0.01','Great Britain - GB','Registered','Tradeable');

INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('M&G INCOME INVESTMENT CO','Guernsey, C.I. - GG','GB0030826639','ESVUFR','Par Value','ORD GBP0.01','Great Britain - GB','Registered','Inactive');
INSERT INTO `pf_funds`(`Issuer_name`,`Country_of_Incorporation`,`ISIN`,`CFI_Code`,`Security_Type`,`Security_Description`,`Country_of_Register`,`Security_Form`,`Security_Status`)
VALUES ('M&G INCOME INVESTMENT CO','Guernsey, C.I. - GG','GB0030826746','EPRXXR','Preference Shares/Preferred Stock','ZERO DIV PRF SHS GBP0.01','Great Britain - GB','Registered','Inactive');

/*INSERT INTO `pf_funds`(`fund_name`,`firm_id`, `fund_amount`, `fund_ccy`, `active_flag`, `creation_date`) 
	VALUES ('ABC Fund 1', 1, 100000.00, 'GBP', 1, NOW());
INSERT INTO `pf_funds`(`fund_name`,`firm_id`, `fund_amount`, `fund_ccy`, `active_flag`, `creation_date`) 
	VALUES ('ABC Fund 2', 1, 150000.00, 'GBP', 1, NOW());
*/

-- RESEARCH PURCHASE ACCOUNT DETAILS
DROP TABLE IF EXISTS `pf_rpa_details`;

CREATE TABLE `pf_rpa_details` (
  `rpa_id` int(10) NOT NULL AUTO_INCREMENT,
  `rpa_name` varchar(100) NOT NULL,
  `firm_id` int(10) NOT NULL,
  `asset_owner_id` int(10) NOT NULL,
  `budget_ccy` varchar(3) NOT NULL,
  `budget_amount` decimal(15,2) NOT NULL,
  `start_date` date NULL,
  `end_date` date NULL,
  `active_flag` bit(1) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (rpa_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `pf_rpa_details` ADD `budget_id` int(10) NOT NULL AFTER `rpa_name`;

INSERT INTO `pf_rpa_details`(`rpa_name`, `firm_id`, `asset_owner_id`, `budget_ccy`, `budget_amount`, `start_date`, `end_date`, `active_flag`, `creation_date`) 
VALUES ('IBM RPA - ABC', 1, 1, 'GBP', 100000.00, '2016-10-01', '2017-10-01', 1, NOW());
INSERT INTO `pf_rpa_details`(`rpa_name`, `firm_id`, `asset_owner_id`, `budget_ccy`, `budget_amount`, `start_date`, `end_date`, `active_flag`, `creation_date`) 
VALUES ('TESCO RPA - ABC', 2, 1, 'GBP', 150000.00, '2016-10-01', '2017-10-01', 1, NOW());
INSERT INTO `pf_rpa_details`(`rpa_name`, `firm_id`, `asset_owner_id`, `budget_ccy`, `budget_amount`, `start_date`, `end_date`, `active_flag`, `creation_date`) 
VALUES ('BRIT GAS RPA - ABC', 1, 1, 'GBP', 150000.00, '', '', 1, NOW());

-- ASSET OWNER DETAILS
DROP TABLE IF EXISTS `pf_asset_owner_details`;

CREATE TABLE `pf_asset_owner_details` (
  `asset_owner_id` int(10) NOT NULL AUTO_INCREMENT,
  `asset_owner_name` varchar(100) NOT NULL,
  `active_flag` bit(1) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (asset_owner_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pf_asset_owner_details`(`asset_owner_name`, `active_flag`, `creation_date`)
VALUES ('IBM',  1, NOW());
INSERT INTO `pf_asset_owner_details`(`asset_owner_name`, `active_flag`, `creation_date`)
VALUES ('General Electric',  1, NOW());
INSERT INTO `pf_asset_owner_details`(`asset_owner_name`, `active_flag`, `creation_date`)
VALUES ('Rolls Royce',  1, NOW());

-- RESEARCH ALLOCATION HISTORY
DROP TABLE IF EXISTS `pf_allocation_history`;

CREATE TABLE `pf_allocation_history` (
  `firm_id` int(10) NOT NULL,
  `file_id` int(10) NOT NULL,
  `ISIN` varchar(100) NOT NULL,
  `allocation_amount` decimal(15,2) NOT NULL,
  `allocation_ccy` varchar(3) NOT NULL,
  `active_flag` bit(1) NOT NULL,
  `creation_date` datetime NOT NULL,
  CONSTRAINT pf_allocation_history_primary 
UNIQUE (firm_id, file_id, ISIN)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ALTER TABLE `pf_allocation_history` ADD `ISIN` varchar(100) NOT NULL AFTER `file_id`;
ALTER TABLE `pf_allocation_history` ADD `rpa_id` int(10) NOT NULL AFTER `ISIN`;

SELECT distinct a.ISIN, b.allocation_amount FROM `pf_funds_linked_to_rpa` a, `pf_allocation_history` b where a.rpa_id = 1 and a.ISIN = b.ISINISIN 
spent: ('GB00B39R2T55','GB00B82FK756','GB00B82FK756','GB00B82FK756') 

SELECT a.fund_limit_amount, a.ISIN, FORMAT(SUM(b.allocation_amount),2) total 
FROM `pf_funds_linked_to_rpa` a, `pf_allocation_history` b 
where a.rpa_id = 1 and a.rpa_id = b.rpa_id 
group by a.ISIN ORDER BY SUM(b.allocation_amount) DESC 

SELECT b.ISIN, FORMAT(SUM(b.allocation_amount),2) total, a.fund_limit_amount FROM pf_allocation_history b, pf_funds_linked_to_rpa a where b.rpa_id = 1 and b.ISIN = a.ISIN group by b.ISIN, a.fund_limit_amount ORDER BY SUM(b.allocation_amount) DESC 

GB00B39R2T55; limit = GBP 5000.00 ; spent: TBD
GB00B82FK756; limit = GBP 6000.00 ; spent: TBD 

5000.00 	GB00B39R2T55 	5,250.00
6000.00 	GB00B82FK756 	5,250.00

			
INSERT INTO `pf_allocation_history`(`firm_id`, `file_id`, `ISIN`, `allocation_amount`, `allocation_ccy`, `active_flag`, `creation_date`) 
VALUES (1, 1, 'TEST_ISIN', 11000.00, 'GBP', 1, NOW());

-- FUNDS LINKED TO A RESEARCH PAYMENT ACCOUNT
-- and audit of who did the linking
DROP TABLE IF EXISTS `pf_funds_linked_to_rpa`;

CREATE TABLE `pf_funds_linked_to_rpa` (
  `rpa_id` int(10) NOT NULL,
  `ISIN` varchar(100) NOT NULL,
  `user_id` int(10) NOT NULL,
  `active_flag` bit(1) NOT NULL,
  `creation_date` datetime NOT NULL,
  CONSTRAINT pf_funds_linked_to_rpa_primary 
UNIQUE (rpa_id, ISIN)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `pf_funds_linked_to_rpa`
ADD `fund_limit_amount` decimal(15,2) NOT NULL AFTER `user_id`,
ADD `fund_ccy` varchar(3) NOT NULL AFTER `fund_limit_amount`;

INSERT INTO `pf_funds_linked_to_rpa`(`rpa_id`, `ISIN`, `user_id`, `active_flag`, `creation_date`) 
VALUES (1, 'TEST_ISIN', 1, 1, NOW());
INSERT INTO `pf_funds_linked_to_rpa`(`rpa_id`, `ISIN`, `user_id`, `active_flag`, `creation_date`) 
VALUES (1, 'GB00BWH5Y544', 1, 1, NOW());
INSERT INTO `pf_funds_linked_to_rpa` (`rpa_id`, `ISIN`, `user_id`, `fund_limit_amount`, `fund_ccy`, `active_flag`, `creation_date`) 
VALUES (2, 'GB0031404428', 1, '25000', 'EUR', b'1', '2016-10-26 00:00:00');


-- RESEARCH PURCHASE ACCOUNT DETAILS
DROP TABLE IF EXISTS `pf_budget_AO`;

CREATE TABLE `pf_budget_AO` (
  `budget_id` int(10) NOT NULL AUTO_INCREMENT,
  `budget_name` varchar(100) NOT NULL,
  `firm_id` int(10) NOT NULL,
  `asset_owner_id` int(10) NOT NULL,
  `budget_ccy` varchar(3) NOT NULL,
  `budget_amount` decimal(15,2) NOT NULL,
  `start_date` date NULL,
  `end_date` date NULL,
  `active_flag` bit(1) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (budget_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pf_budget_AO`(`budget_name`, `firm_id`, `asset_owner_id`, `budget_ccy`, `budget_amount`, `start_date`, `end_date`, `active_flag`, `creation_date`) 
VALUES ('IBM Budget - ABC', 1, 1, 'GBP', 100000.00, '2016-10-01', '2017-10-01', 1, NOW());
INSERT INTO `pf_budget_AO`(`budget_name`, `firm_id`, `asset_owner_id`, `budget_ccy`, `budget_amount`, `start_date`, `end_date`, `active_flag`, `creation_date`) 
VALUES ('TESCO RPA - ABC', 1, 1, 'EUR', '450000.00', '2016-10-01', '2017-10-01', 1, NOW())

INSERT INTO `pf_budget_AO`(`budget_name`, `firm_id`, `asset_owner_id`, `budget_ccy`, `budget_amount`, `start_date`, `end_date`, `active_flag`, `creation_date`) 
VALUES ('BRIT GAS RPA - ABC', 1, 3, 'GBP', '550000.00', '2016-10-03', NULL, 1, NOW())
INSERT INTO `pf_budget_AO`(`budget_name`, `firm_id`, `asset_owner_id`, `budget_ccy`, `budget_amount`, `start_date`, `end_date`, `active_flag`, `creation_date`) 
VALUES ('ARGOS RPA - ABC', 1, 1, 'GBP', '750000.00', '2016-10-03', '2017-10-03', 1, NOW())
INSERT INTO `pf_budget_AO`(`budget_name`, `firm_id`, `asset_owner_id`, `budget_ccy`, `budget_amount`, `start_date`, `end_date`, `active_flag`, `creation_date`) 
VALUES ('GE RPA 02', 1, 2, 'GBP', '525000.00', NULL, '2017-10-03', 1, NOW())

-- show RPAs linked to a budget with an Asset Owner
select a.rpa_name, a.rpa_id from pf_rpa_details a, pf_budget_AO b where a.budget_id = b.budget_id and a.budget_id = 1

SELECT distinct a.ISIN FROM `pf_funds_linked_to_rpa` a, `pf_allocation_history` b
where a.rpa_id = 1 and a.ISIN = b.ISIN

-- COMMISSION SHARING AGREEMENT DETAILS: US72
DROP TABLE IF EXISTS `pf_csa_details`;

CREATE TABLE `pf_csa_details` (
  `csa_id` int(10) NOT NULL AUTO_INCREMENT,
  `csa_name` varchar(100) NOT NULL,
  `firm_id` int(10) NOT NULL,
  `asset_owner_id` int(10) NOT NULL,
  `budget_ccy` varchar(3) NOT NULL,
  `budget_amount` decimal(15,2) NOT NULL,
  `start_date` date NULL,
  `end_date` date NULL,
  `active_flag` bit(1) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (csa_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pf_csa_details`(`csa_name`, `firm_id`, `asset_owner_id`, `budget_ccy`, `budget_amount`, `start_date`, `end_date`, `active_flag`, `creation_date`) 
VALUES ('CSA - ABC', 1, 1, 'GBP', 100000.00, '2017-01-01', '2017-12-31', 1, NOW());


select a.file_title as file_title, b.bookmarks_date as bookmarks_date from pf_research_files a, pf_research_bookmarks b where a.file_id = b.file_id and b.user_id = 1


-- US31, 32, build a blotter and basic purchasing: select statement to show what user has bought
select a.file_name as file_name, b.purchased_date as purchased_date, b.purchased_fee as purchased_fee, b.purchased_ccy as purchased_ccy
from pf_research_files a, pf_purchase_history b
where a.file_id = b.file_id and b.user_id = 1

-- show my funds that I am allocating to for my purchase
select fd.firm_name, f.fund_name, f.fund_amount, f.fund_ccy from pf_firm_details fd, pf_funds f
where fd.firm_id = f.firm_id
and fd.firm_id = 1
