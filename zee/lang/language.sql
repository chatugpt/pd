CREATE TABLE `language` (
  `id` int(11) NOT NULL auto_increment,
  `code` varchar(32) NOT NULL,
  `name` varchar(64) NOT NULL,
  `icon` varchar(128) default NULL,
  `created` timestamp NULL default NULL,
  `modified` timestamp NULL default NULL,
  `status` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `language`
-- 

INSERT INTO `language` VALUES (1, 'cn', '中文', NULL, '2011-01-11 17:24:19', '2011-01-11 17:24:08', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `language_content`
-- 

CREATE TABLE `language_content` (
  `id` int(11) NOT NULL auto_increment,
  `language_id` int(11) NOT NULL,
  `model_code` varchar(32) NOT NULL,
  `code` varchar(64) NOT NULL,
  `content` text NOT NULL,
  `type` varchar(32) NOT NULL,
  `created` timestamp NULL default NULL,
  `modified` timestamp NULL default NULL,
  `status` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;