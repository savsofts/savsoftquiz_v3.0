-- add column lang
ALTER TABLE `savsoft_users` ADD `lang` varchar(2) NOT NULL;

-- update existing user records
UPDATE `savsoft_users` SET `lang` ='en' WHERE `lang` = '';

-- Table structure for table `savsoft_language`
--

CREATE TABLE `savsoft_language` (
  `lang` varchar(2) NOT NULL,
  `language` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `savsoft_language`
--

INSERT INTO `savsoft_language` (`lang`, `language`) VALUES
('en', 'English'),
('de', 'German');

--
-- Indexes for table `savsoft_language`
--
ALTER TABLE `savsoft_language`
  ADD PRIMARY KEY (`lang`);