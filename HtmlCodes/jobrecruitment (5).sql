-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2025 at 12:33 AM
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
-- Database: `jobrecruitment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(5) NOT NULL,
  `FullName` varchar(75) NOT NULL,
  `PhoneNumber` int(25) NOT NULL,
  `Email` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `FullName`, `PhoneNumber`, `Email`) VALUES
(1, 'anthur', 0, 'anthur@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `ApplicationID` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `JobID` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `JobSeekerID` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ResumeFilePath` varchar(100) NOT NULL,
  `DateApplied` date NOT NULL,
  `Status` varchar(10) NOT NULL,
  `CoverLetter` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`ApplicationID`, `JobID`, `JobSeekerID`, `ResumeFilePath`, `DateApplied`, `Status`, `CoverLetter`) VALUES
('A0001', 'JB7431', 'J1003', '', '2024-07-25', 'Processed', ''),
('A0002', 'JB3003', 'J1001', '', '2024-08-14', 'Cancelled', ''),
('A0003', 'JB5050', 'J1004', '', '2024-08-30', 'Pending', '');

-- --------------------------------------------------------

--
-- Table structure for table `employer`
--

CREATE TABLE `employer` (
  `EmployerID` int(10) NOT NULL,
  `CompanyName` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Description` varchar(600) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `StartDate` date NOT NULL,
  `Address` varchar(80) NOT NULL,
  `ContactNumber` int(25) NOT NULL,
  `Email` varchar(25) NOT NULL,
  `Website` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employer`
--

INSERT INTO `employer` (`EmployerID`, `CompanyName`, `Description`, `StartDate`, `Address`, `ContactNumber`, `Email`, `Website`) VALUES
(2, 'EcoEssentials', 'EcoEssentials is a forward-thinking consumer goods manufacturer dedicated to producing high-quality and sustainable products. We focus on innovation and eco-friendliness to meet the evolving needs of consumers. Our product range is designed to enhance everyday life while minimizing environmental impact.  ', '2024-10-12', '', 0, '', ''),
(3, 'TechCorp', 'TechCorp is a leading technology firm that specializes in cutting-edge software development and comprehensive IT services. We are committed to delivering innovative solutions that drive efficiency and enhance digital experiences. Our team of experts is dedicated to pushing the boundaries of technology and providing tailored solutions to meet the diverse needs of our clients across various industries.\r\n', '2024-10-12', '', 0, '', ''),
(4, 'DesignWorks Ltd', 'DesignWorks is a dynamic design studio specializing in graphic design, branding, and multimedia projects. We collaborate with clients to create visually compelling content that communicates their brand’s message effectively. Our team combines creativity with strategic thinking to deliver designs that make a lasting impression and drive business success.', '2024-10-12', '', 0, '', ''),
(5, 'MarketEdge Ltd', 'MarketEdge Ltd is an industry-leading marketing agency known for its creative and data-driven approach to marketing. We offer a full suite of services including digital marketing, brand strategy, and market research. Our goal is to help businesses grow by crafting impactful marketing strategies that resonate with their target audiences and drive measurable results.', '2024-10-12', '', 0, '', ''),
(6, 'CapitalWise', 'CapitalWise is a trusted financial services firm offering expert investment advice, comprehensive financial planning, and strategic financial management. We are committed to helping individuals and businesses achieve their financial goals through personalized strategies and in-depth market analysis. Our team of financial professionals is dedicated to delivering exceptional service and insightful guidance.', '2024-10-12', '', 0, '', ''),
(7, 'MCB Mauritius', 'The Mauritius Commercial Bank (MCB) is one of the oldest and largest banking institutions in Mauritius, established in 1838. It offers a wide range of financial services including personal banking, corporate banking, and investment solutions. MCB plays a key role in the region’s financial ecosystem and has a presence in several countries.', '1838-08-01', 'Sir William Newton Street, Port-Louis', 2025000, 'contact@mcb.mu', 'www.mcb.mu'),
(8, 'Spoon Consulting', 'Spoon Consulting is a Mauritian IT company specializing in cloud computing, software development, and business solutions. They are a trusted Salesforce partner and have worked with international clients across various sectors. The company is known for innovation, agility, and delivering high-quality digital solutions.', '2005-04-15', 'Vivéa Business Park, Moka', 4333600, 'info@spoonconsulting.com', 'www.spoonconsulting.com'),
(9, 'SD Worx Mauritius', 'SD Worx is a European leader in HR and payroll solutions, and its Mauritius office supports global operations. The company provides services such as HR consulting, payroll outsourcing, and cloud-based HR tools. It emphasizes efficiency, compliance, and people-driven technology.', '2010-06-01', '1st Floor, The Gardens, Ébène', 4600700, 'support.mu@sdworx.com', 'www.sdworx.com'),
(10, 'EY Mauritius', 'Ernst & Young (EY) is a global professional services firm with a strong presence in Mauritius. It offers services in assurance, tax, consulting, and strategy. EY Mauritius supports local and international clients with high-quality business insights and a focus on building a better working world.', '1981-01-01', 'Rue du Savoir, Cybercity, Ébène', 4034800, 'ey.mauritius@mu.ey.com', 'www.ey.com/en_mu'),
(11, 'Mauritius Telecom', 'Mauritius Telecom is the national telecommunications provider, offering services in fixed-line, mobile, broadband internet, and IPTV. The company plays a central role in the digital transformation of the island. It’s also known for initiatives in smart cities and digital innovation.', '1988-01-01', 'MT Tower, 18 Edith Cavell, Port Louis', 8900, 'contact@telecom.mu', 'www.telecom.mu'),
(12, 'Tesltra', 'Telstra Group Limited is an Australian telecommunications company that builds and operates telecommunications networks and markets related products and services. It is a member of the S&amp;P/ASX 20 stock index, and is Australias largest telecommunications company by market share.[3]\r\n\r\nTelstra has a long history in Australia, originating together with Australia Post as the Postmaster-Generals Department upon federation in 1901. Telstra had transitioned from a state-owned enterprise to a fully privatised company by 2006.[4]', '2024-01-02', 'Port Louis', 1234567789, 'telstra@gmail.com', 'www.telstra.com'),
(13, 'KPMG Mauritius', 'KPMG Mauritius is part of the global KPMG network, offering audit, tax, and advisory services to businesses and institutions. Known for its focus on ethics and innovation, KPMG helps clients navigate financial regulations, compliance, and business strategy.', '1985-01-01', 'KPMG Centre, 31 Cybercity, Ébène', 4069999, 'info@kpmg.mu', 'home.kpmg/mu'),
(14, 'Vistra Mauritius', 'Vistra is a global corporate service provider, offering solutions in trust, fund administration, and business support. The Mauritius office handles regional and international clients, providing financial and corporate structuring services. Vistra emphasizes client confidentiality and regulatory compliance.', '2006-10-01', '1st Floor, Nexteracom Tower III, Ébène', 4048000, 'mauritius@vistra.com', 'www.vistra.com'),
(15, 'Aberdeen Services', 'Aberdeen Services is part of a global asset management group, offering back-office, financial, and investment support services. Located in Ébène, the Mauritius office helps streamline global business processes. It is known for its expertise in fund administration and investment analytics.', '2015-09-01', 'Tower A, 3rd Floor, 1 Cybercity, Ébène', 4054700, 'info@aberdeen.mu', 'www.aberdeenstandard.com'),
(16, 'Dayforce Mauritius', 'Dayforce, part of Ceridian, provides cloud-based human capital management (HCM) software. The Mauritius team supports development and customer service for global clients. Their platform integrates payroll, HR, and talent management, helping organizations improve workforce productivity.', '2020-02-01', 'Ground Floor, Tower C, 1 Cybercity, Ébène', 4602500, 'support@dayforce.mu', 'www.dayforce.com'),
(17, 'PwC Mauritius', 'PricewaterhouseCoopers (PwC) Mauritius provides professional services in audit, tax, and business advisory. It supports a wide range of industries, combining global knowledge with local expertise. PwC is known for driving trust and delivering value to clients.', '1981-01-01', '18 CyberCity, Ébène', 4045000, 'info@pwc.mu', 'www.pwc.com/mu'),
(18, 'Deloitte Mauritius', 'Deloitte Mauritius offers integrated services in audit, consulting, financial advisory, and risk management. As part of a global network, Deloitte delivers high-quality insights and solutions to public and private sector clients across Mauritius and Africa.', '1981-01-01', '7th Floor, Standard Chartered Tower, Ébène', 2037777, 'deloitte@deloitte.mu', 'www2.deloitte.com/mu'),
(19, 'Eclosia Group', 'Eclosia is one of Mauritius’s leading conglomerates, with interests in food production, logistics, retail, and education. Known for its strong Mauritian roots, Eclosia promotes local entrepreneurship and sustainable practices across its businesses.', '1966-05-01', 'Gentilly, Moka', 4049800, 'contact@eclosia.com', 'www.eclosia.com'),
(20, 'GPO Ltd', 'GPO Ltd (Global Process Outsourcing) is a Mauritian BPO company offering business support in finance, HR, and customer services. It focuses on delivering process efficiency and digital transformation for local and international clients.', '2013-07-01', 'Level 7, NeXTeracom Tower 1, Ébène', 4666000, 'contact@gpo.mu', 'www.gpo.mu');

-- --------------------------------------------------------

--
-- Table structure for table `interview`
--

CREATE TABLE `interview` (
  `InterviewID` varchar(10) NOT NULL,
  `ApplicationID` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `EmpID` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ScheduleDate` date NOT NULL,
  `IStatus` varchar(10) NOT NULL,
  `EmployerID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interview`
--

INSERT INTO `interview` (`InterviewID`, `ApplicationID`, `EmpID`, `ScheduleDate`, `IStatus`, `EmployerID`) VALUES
('I100', 'A0002', 'E456', '2024-09-07', 'Cancelled', NULL),
('I231', 'A0003', 'E256', '2024-09-30', 'Postponed', NULL),
('I840', 'A0001', 'E1234', '2024-08-15', 'Scheduled', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `JobID` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `EmpID` int(10) NOT NULL,
  `Title` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Description` varchar(600) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Location` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Salary` double NOT NULL,
  `DatePosted` date NOT NULL,
  `JobType` varchar(30) NOT NULL,
  `JobCategory` varchar(100) NOT NULL,
  `YearsOfExperience` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`JobID`, `EmpID`, `Title`, `Description`, `Location`, `Salary`, `DatePosted`, `JobType`, `JobCategory`, `YearsOfExperience`) VALUES
('J102', 2, 'Sustainability Analyst', 'Assist in sustainability assessments and policy development. Conduct environmental impact studies and reports.', 'Mauritius', 32000, '2025-04-10', 'Part-time', 'Product Management', 2),
('JB021', 5, 'Digital Marketing Ex', 'Plan, execute and optimize online marketing campaigns for various brands. Should have good knowledge of SEO and social media ads.', '6th Floor, One Cathedral Square Building, Port Louis', 37000, '2025-04-15', 'Full-time', 'Marketing & Communications', 2),
('JB022', 13, 'Tax Associate', 'Assist with tax preparation, filing, and consulting services for local and international clients.', 'Ebène Esplanade, 33 Cybercity, Ebène', 45000, '2025-04-12', 'Full-time', 'Finance & Accounting', 1),
('JB023', 20, 'Warehouse Supervisor', 'Manage daily operations in the warehouse, ensure timely dispatch and receipt of goods, and maintain inventory records.', 'Royal Road, Cassis, Port Louis', 28000, '2025-04-17', 'Full-time', 'Operations', 3),
('JB024', 4, 'UI/UX Designer', 'Design intuitive and engaging user interfaces for web and mobile platforms. Collaborate with developers and clients to create seamless user experiences.', 'Rue Labourdonnais, Port Louis', 39000, '2025-04-14', 'Part-time', 'Design & Arts', 2),
('JB025', 9, 'HR Coordinator', 'Handle recruitment, employee onboarding, and HR documentation. Support HR department in daily administrative tasks.', '1st Floor, The Gardens, Ébène', 32000, '2025-04-13', 'Full-time', 'Human Resources', 1),
('JB026', 6, 'Investment Analyst', 'Conduct financial research and data analysis to support investment decisions. Prepare reports and evaluate market trends.', '2nd Floor, HSBC Centre, 18 Cybercity, Ebène', 56000, '2025-04-11', 'Full-time', 'Finance & Accounting  ', 2),
('JB105', 3, 'Software Developer', 'Develop and maintain applications, write clean code, and troubleshoot bugs across various modules.', 'TechCorp, Mauritius', 50000, '2025-04-11', 'Part-time', 'IT & Software Development', 3),
('JB106', 9, 'HR Assistant', 'Support recruitment, payroll processing, and employee record management. Ensure timely communication with staff.', '1st Floor, The Gardens, Ébène', 26000, '2025-04-14', 'Part-time', 'Human Resources', 1),
('JB1267', 9, 'Graphic Designer', 'Create visually appealing designs for marketing materials, websites, and social media. Collaborate with content and marketing teams to deliver cohesive brand visuals. Proficiency in Adobe Suite required.', '1st Floor, The Gardens, Ébène', 30000, '2025-04-10', 'Part-time', 'Design & Arts', 2),
('JB2109', 8, 'Business Analyst', 'Identify business needs and gather requirements. Communicate effectively between stakeholders and technical teams.', 'Vivéa Business Park, Moka', 27000, '2025-04-16', 'Part-time', 'IT & Software Development', 2),
('JB3003', 5, 'Marketing Specialist', 'The Marketing Specialist will develop and implement marketing strategies to increase brand awareness and drive customer engagement. Responsibilities include conducting market research, creating content for digital and traditional media, managing social media accounts, and analyzing campaign performance. The ideal candidate will have excellent communication skills, a creative mindset, and experience with marketing tools and techniques to effectively reach target audiences.\r\n', 'Mauritius', 20000, '2023-12-11', 'Full-Time', 'Marketing & Communications', 3),
('JB3344', 7, 'Financial Analyst', 'As a Financial Analyst, you will analyze financial data to support budgeting, forecasting, and investment decisions. Key responsibilities include preparing financial reports, evaluating financial performance, and identifying trends and opportunities for improvement. You will work closely with management to provide insights and recommendations based on your analysis. Strong analytical skills, attention to detail, and proficiency in financial modeling and reporting tools are required for this role.', 'Sir William Newton Street, Port-Louis', 30000, '2024-05-12', 'Full-Time', 'Finance & Accounting', 6),
('JB492', 9, 'Product Manager', 'As a Product Manager, you will oversee the development and lifecycle of products from conception to launch. You will collaborate with engineering, design, and marketing teams to define product features, manage timelines, and ensure alignment with business goals. Your role will involve gathering and analyzing market and user data, prioritizing product requirements, and driving the execution of product roadmaps. Strong leadership and project management skills are essential.', '1st Floor, The Gardens, Ébène', 33000, '2024-07-10', 'Part-Time', 'Product Management', 4),
('JB5050', 4, 'Graphic Designer', 'The Graphic Designer will create visually compelling graphics for various media including digital platforms, print materials, and advertising campaigns. Responsibilities include designing layouts, selecting color schemes, and developing visual concepts that align with brand identity. The role requires proficiency in design software, a keen eye for detail, and the ability to work collaboratively with marketing and design teams to deliver high-quality visual content. \r\n', 'Mauritius', 45000, '2024-08-20', 'Full-Time', 'Design & Arts', 3),
('JB7431', 8, 'Software Engineer', 'As a Software Engineer, you will be responsible for developing, testing, and maintaining software applications. You will work closely with cross-functional teams to design innovative solutions and improve existing systems. This role requires strong problem-solving skills, proficiency in programming languages, and the ability to adapt to new technologies. You will also contribute to code reviews and ensure high-quality software delivery.\r\n', 'Vivéa Business Park, Moka', 55000, '2024-08-01', 'Full-Time', 'IT & Software Development', 4),
('JB9110', 7, 'Banking Officer', 'Provide customer service in banking operations. Support account management, queries, and transaction reviews.', 'MCB, Rose Hill, Mauritius', 34000, '2025-04-10', 'Full-time', 'Finance & Accounting', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jobseeker`
--

CREATE TABLE `jobseeker` (
  `JobSeekerID` int(10) NOT NULL,
  `FullName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `DateOfBirth` date NOT NULL,
  `PhoneNumber` int(15) NOT NULL,
  `Gender` char(1) NOT NULL,
  `Address` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Profile` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Email` varchar(15) NOT NULL,
  `UserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobseeker`
--

INSERT INTO `jobseeker` (`JobSeekerID`, `FullName`, `DateOfBirth`, `PhoneNumber`, `Gender`, `Address`, `Profile`, `Email`, `UserID`) VALUES
(1, 'James Doe', '2024-10-13', 0, '', 'Dahlia Ave Moka', 'Marketing Specialist\r\n\r\nCreative and data-driven Marketing Specialist with 4 years of experience in developing and executing marketing strategies for both B2B and B2C sectors. My background includes proficiency in Google Analytics, SEO, social media management and a proven track record of increasing brand visibility and engagement. I am skilled at crafting compelling content, analyzing market trends, and optimizing campaigns to achieve measurable results.\r\n', '0', 8),
(2, 'Gerald Taylor', '2024-10-13', 0, '', '123 King Street Sydney', 'HR Manager \r\n\r\nExperienced Human Resources Manager with over 2 years in talent acquisition, employee relations, and organizational development. My career includes building and leading HR teams, implementing effective recruitment strategies, and enhancing employee engagement programs.\r\nI am adept at navigating complex HR issues and fostering a positive work environment. My goal is to partner with organizations to attract top talent, support employee growth, and align HR practices with strategic b', '0', 4),
(3, 'Sara Roberts', '2024-10-13', 0, '', '742 Evergreen Ave Germany', 'Software Developer\r\n\r\nI am a Software Developer with a strong background in Java, Python, Flutter, Bootstrap and C. I have successfully developed and maintained applications for diverse industries. My expertise includes full-stack development, UI/UX design, API integration, and I thrive in dynamic, collaborative environments.  \r\n', '0', 5),
(4, 'Maria Martinez', '2024-10-13', 0, '', 'John Kennedy Street Vacoas', 'Graphic Designer\r\n\r\nHighly creative Graphic Designer with 5 years of experience in visual communication and brand identity. My portfolio includes successful projects in logo design, marketing materials, digital media showcasing a keen eye for detail and a strong understanding of design principles.\r\nI excel in using design tools like Adobe Creative Suite, Sketch to create visually engaging and effective solutions. I am passionate about translating ideas into compelling visuals.', '0', 7),
(12, 'mohisha', '0000-00-00', 0, '', '', '', 'seewoomohisha01', 12),
(13, 'Ayushee', '0000-00-00', 0, '', '', '', 'ayushee@gmail.c', 13);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Contact` varchar(100) NOT NULL,
  `Password` varchar(1000) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Role` varchar(50) NOT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `UserName`, `Contact`, `Password`, `Email`, `Role`, `Status`) VALUES
(1, 'Emma Wilson', '+230 550 152 29', 'lego300', 'e.wilson@gmail.com', 'jobseeker', 'Active'),
(2, 'TechCorp', '+212 582 8512', 'zigzag00', 'techcorp@gmail.com', 'employer', 'Active'),
(3, 'EcoEssentials', '+230 5678 9000', 'essentials', 'e.essentials@yahoo.com', 'employer', 'Active'),
(4, 'Gerald Taylor', '+61 870 449 123', 'smthg', 'gerald19@gmail.com', 'jobseeker', 'Pending'),
(5, 'Sara Roberts', '+33 1429 5768', 'england00', 'sroberts@outlook.com', 'employer', 'Pending'),
(6, 'MarketEdge Ltd', '+415 456 2345', 'derma00', 'marketedge@yahoo.com', 'employer', 'Active'),
(7, 'Maria Martinez', '+230 5867 5700', 'password12', 'maria5874@outlook.com', 'jobseeker', 'Banned'),
(8, 'James Doe', '+230 57783461', 'control01', 'jdoe@gmail.com', 'jobseeker', 'Pending'),
(9, 'Amanda Jones', '+33 1 23 456', 'message99', 'a.jones@yahoo.com', 'jobseeker', 'Hired'),
(10, 'CapitalWise', '+416 657 8900', 'notcapital', 'capitalwise@gmail.com', 'employer', 'Active'),
(11, 'DesignWorks', '+230 5678 4500', 'flower00', 'designworks@outlook.com', 'employer', 'Active'),
(12, 'mohisha', '', '$2y$10$xxh3VSBiRHaHwqOJR1mube2pf1I6bEMohqVLuCRa5vSq6ybzs/hPy', 'seewoomohisha0108@gmail.c', 'jobseeker', 'Active'),
(13, 'Ayushee', '+230 56915722', '$2y$10$hpUbouegLEputCWi6QmXgO6dIxscKJ9spZDxgLhIc/aa.lkpBB8FK', 'ayushee@gmail.com', 'admin', 'Active'),
(14, 'wendy', '', '$2y$10$F2bEKmk5R2zwnLrGhLxbhurJ06VfymZYaY9MqsJMbSS1i2DckowKG', 'wendy@gmail.com', 'jobseeker', 'Cancelled'),
(15, 'anthur', '', '$2y$10$gvyoHMtHhnojm1sVK7ihDON8MXUfcuYFZhMTpWgD65L6qFL8UFmAK', 'anthur@gmail.com', 'admin', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`ApplicationID`),
  ADD KEY `FK_AP_JobID` (`JobID`);

--
-- Indexes for table `employer`
--
ALTER TABLE `employer`
  ADD PRIMARY KEY (`EmployerID`);

--
-- Indexes for table `interview`
--
ALTER TABLE `interview`
  ADD KEY `FK_INT_AppID` (`ApplicationID`),
  ADD KEY `FK_INT_EmpID` (`EmpID`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`JobID`);

--
-- Indexes for table `jobseeker`
--
ALTER TABLE `jobseeker`
  ADD PRIMARY KEY (`JobSeekerID`),
  ADD KEY `fk_user_userid` (`UserID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employer`
--
ALTER TABLE `employer`
  MODIFY `EmployerID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `jobseeker`
--
ALTER TABLE `jobseeker`
  MODIFY `JobSeekerID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `FK_AP_JobID` FOREIGN KEY (`JobID`) REFERENCES `jobs` (`JobID`);

--
-- Constraints for table `interview`
--
ALTER TABLE `interview`
  ADD CONSTRAINT `FK_INT_AppID` FOREIGN KEY (`ApplicationID`) REFERENCES `application` (`ApplicationID`);

--
-- Constraints for table `jobseeker`
--
ALTER TABLE `jobseeker`
  ADD CONSTRAINT `fk_user_userid` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
