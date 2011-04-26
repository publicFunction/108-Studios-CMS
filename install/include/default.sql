
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

DROP TABLE IF EXISTS `adminactivation`;
CREATE TABLE IF NOT EXISTS `adminactivation` (
  `activation_ID` int(10) NOT NULL AUTO_INCREMENT,
  `admin_ID` int(10) NOT NULL,
  `activationCode` varchar(50) NOT NULL,
  `activationStatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`activation_ID`),
  KEY `admin_ID` (`admin_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

INSERT INTO `adminactivation` (`activation_ID`, `admin_ID`, `activationCode`, `activationStatus`) VALUES
(1, 1, 'icabohefosira5a0o5id', 1);

DROP TABLE IF EXISTS `adminlogin`;
CREATE TABLE IF NOT EXISTS `adminlogin` (
  `adminID` int(11) NOT NULL AUTO_INCREMENT,
  `adminName` varchar(20) NOT NULL,
  `adminPass` varchar(30) NOT NULL,
  `adminFullname` varchar(50) NOT NULL,
  `adminStatus` varchar(10) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminRight` varchar(1) NOT NULL,
  PRIMARY KEY (`adminID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

INSERT INTO `adminlogin` (`adminID`, `adminName`, `adminPass`, `adminFullname`, `adminStatus`, `adminEmail`, `adminRight`) VALUES
(1, 'admin', 'YnViYmxlZmlzaA==', 'Super User', '1', 'you@yourdomain.com', '1');

DROP TABLE IF EXISTS `adminmenu`;
CREATE TABLE IF NOT EXISTS `adminmenu` (
  `adminmenuID` int(11) NOT NULL AUTO_INCREMENT,
  `adminmenuName` varchar(255) NOT NULL,
  `adminmenuLink` varchar(255) NOT NULL,
  `adminMenuTitle` varchar(255) NOT NULL,
  `adminLinkPop` varchar(2) NOT NULL,
  `adminmenuImage` varchar(255) NOT NULL,
  `adminmenuAlt` varchar(255) NOT NULL,
  `adminmenuOrder` int(11) NOT NULL,
  PRIMARY KEY (`adminmenuID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

INSERT INTO `adminmenu` (`adminmenuID`, `adminmenuName`, `adminmenuLink`, `adminMenuTitle`, `adminLinkPop`, `adminmenuImage`, `adminmenuAlt`, `adminmenuOrder`) VALUES
(1, 'Pages', '?do=pages', 'Create, Ammend or Remove Pages', '0', 'icons/full_page.png', 'Create, Ammend or Remove Pages', 1),
(2, 'Registry', '?do=registry', 'Edit the Site Registry', '0', 'icons/reg.png', 'Site Registry', 999),
(3, 'Newsfeed Items', '?do=news', 'Create, Amend and delete News Items', '0', 'icons/news.png', 'Create, Amend and delete News Items', 3),
(4, 'Polariods', '?do=cta', 'Create, Amend and delete Calls to Action', '0', 'icons/attachment.png', 'Create, Amend and delete Calls to Action', 2),
(5, 'File/Image Manager', 'include/ajaxfilemanager/ajaxfilemanager.php', 'File/Image Manager', '1', 'icons/folder_full.png', 'File/Image Manager', 6);

DROP TABLE IF EXISTS `adminrights`;
CREATE TABLE IF NOT EXISTS `adminrights` (
  `rights_ID` int(10) NOT NULL AUTO_INCREMENT,
  `rightsValue` int(2) NOT NULL,
  `rightsName` varchar(150) NOT NULL,
  PRIMARY KEY (`rights_ID`),
  KEY `rightsValue` (`rightsValue`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

INSERT INTO `adminrights` (`rights_ID`, `rightsValue`, `rightsName`) VALUES
(1, 1, 'Super Admin'),
(2, 2, 'General Admin');

DROP TABLE IF EXISTS `calls_to_action`;
CREATE TABLE IF NOT EXISTS `calls_to_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `image` varchar(220) NOT NULL,
  `text` varchar(200) NOT NULL,
  `link` varchar(200) NOT NULL,
  `featured` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `contactID` int(3) NOT NULL AUTO_INCREMENT,
  `contactName` varchar(200) NOT NULL,
  `contactEmail` varchar(250) NOT NULL,
  `contactNumber` varchar(100) NOT NULL,
  `contactReason` text NOT NULL,
  `contactCompleted` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`contactID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `footermenu`;
CREATE TABLE IF NOT EXISTS `footermenu` (
  `menuID` int(11) NOT NULL AUTO_INCREMENT,
  `menuOrder` int(5) NOT NULL,
  `menuName` varchar(255) NOT NULL,
  `menuLink` varchar(255) NOT NULL,
  `menuTitle` varchar(255) NOT NULL,
  `menuImage` varchar(220) NOT NULL,
  `linkPop` varchar(2) NOT NULL,
  `menuAlt` varchar(255) NOT NULL,
  PRIMARY KEY (`menuID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `news_items`;
CREATE TABLE IF NOT EXISTS `news_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(220) NOT NULL,
  `image` varchar(220) NOT NULL,
  `text` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `pagecontent`;
CREATE TABLE IF NOT EXISTS `pagecontent` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `pageID` int(5) NOT NULL,
  `pageContent` text NOT NULL,
  `pageVersion` varchar(10) NOT NULL,
  `pageComment` varchar(200) NOT NULL,
  `mainImg` varchar(250) NOT NULL,
  `pageHeader` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

INSERT INTO `pagecontent` (`id`, `pageID`, `pageContent`, `pageVersion`, `pageComment`, `mainImg`, `pageHeader`) VALUES
(1, 1, '<p><span style="color: #ffff00;"><strong>Lorem ipsum</strong></span> dolor sit amet, consectetur adipiscing elit. Pellentesque  ipsum dui, condimentum eu pretium et, pretium at lorem. Proin nec  rhoncus tellus. Sed leo massa, porta feugiat volutpat nec, commodo sit  amet ligula. In rhoncus felis dictum nisl convallis vitae placerat augue  sodales.</p>\r\n<p>Vestibulum eget leo diam, sed suscipit elit. Integer a arcu massa.  Praesent pellentesque sem ac dui pellentesque convallis. Ut volutpat  nibh sit amet neque malesuada a tempor felis ultricies. Nulla aliquet,  orci nec tempor fringilla, nunc nulla adipiscing velit, eu vestibulum mi  lectus et leo. Vivamus sit amet tortor orci, quis hendrerit sem.</p>', '1', 'Home Page', 'site_background.jpg', '');

DROP TABLE IF EXISTS `pageinfo`;
CREATE TABLE IF NOT EXISTS `pageinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pageName` varchar(255) NOT NULL,
  `pageTitle` varchar(60) NOT NULL,
  `pageKey` varchar(200) NOT NULL,
  `pageDesc` varchar(300) NOT NULL,
  `pageURL` varchar(255) NOT NULL,
  `pageType` varchar(255) NOT NULL,
  `pageTemplate` varchar(20) NOT NULL,
  `pageHC` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

INSERT INTO `pageinfo` (`id`, `pageName`, `pageTitle`, `pageKey`, `pageDesc`, `pageURL`, `pageType`, `pageTemplate`, `pageHC`) VALUES
(1, 'index', 'Your Title', '', '', './', 'Home Page', 'default.php', 0);

DROP TABLE IF EXISTS `pagetemplates`;
CREATE TABLE IF NOT EXISTS `pagetemplates` (
  `templateID` int(11) NOT NULL AUTO_INCREMENT,
  `templateName` varchar(150) NOT NULL,
  `templateComment` varchar(255) NOT NULL,
  PRIMARY KEY (`templateID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `register`;
CREATE TABLE IF NOT EXISTS `register` (
  `reg_ID` int(5) NOT NULL AUTO_INCREMENT,
  `reg_param` varchar(250) NOT NULL,
  `reg_value` text NOT NULL,
  `reg_group` varchar(100) NOT NULL,
  `reg_comment` text NOT NULL,
  PRIMARY KEY (`reg_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

INSERT INTO `register` (`reg_ID`, `reg_param`, `reg_value`, `reg_group`, `reg_comment`) VALUES
(1, 'DEFAULT_TITLE', 'Default Title', 'Default', 'Sites default title'),
(2, 'DEFAULT_ADMIN_TITLE', 'Default Title Content Management System - Administration', 'Default', 'Administration Site default title'),
(3, 'DOC_ROOT', '', 'System', 'Application default install directory'),
(4, 'ADMIN_DIR', 'admin/', 'System', 'default admin directory'),
(5, 'CLASS_DIR', 'class/', 'System', 'Default Class Directory'),
(6, 'TEMPLATE_DIR', 'template/', 'System', 'Default template directory'),
(7, 'ADMIN_HOMEPAGE_CONTENT', 'Welcome the Default Title CMS Administration.  Please use the menu above to navigate the site', 'Default', ''),
(8, 'DB_SERVER', '', 'Database', 'These settings are only used as reference by other setions of the site.  To fill these in please duplicate the info contained in the config.php file under DB Connection.'),
(9, 'DB_USER', '', 'Database', 'These settings are only used as reference by other setions of the site.  To fill these in please duplicate the info contained in the config.php file under DB Connection.'),
(10, 'DB_PASS', '', 'Database', 'These settings are only used as reference by other setions of the site.  To fill these in please duplicate the info contained in the config.php file under DB Connection.'),
(11, 'DB_DATABASE', '', 'Database', 'These settings are only used as reference by other setions of the site.  To fill these in please duplicate the info contained in the config.php file under DB Connection.'),
(12, 'FB_KEY', '', 'External', 'Facebook API Key'),
(13, 'FB_SECRET', '', 'External', 'Facebook API Secret'),
(14, 'GOOGLE_MAPS_API_KEY', '', 'External', ''),
(30, 'TWITTER_PAGE', '', 'Social Media', 'Twitter page url'),
(22, 'SITE_URL', '', 'System', 'Site base URL'),
(29, 'FACEBOOK_PAGE', '', 'Social Media', 'URl to your facebook page'),
(23, 'GOOGLE_SEARCH_API_KEY', '', 'External', ''),
(24, 'FB_APP_ID', '', 'External', 'Facebook Application ID'),
(31, 'LINKEDIN_PAGE', '', 'Social Media', 'Linkedin Profile page'),
(32, 'INCLUDE_DIR', 'include/', 'System', 'Default Include Dir for stuff'),
(27, 'SMS_PASS', '', 'External', 'Authorisation of the SMS message service'),
(28, 'SMS_USER', '', 'External', 'Authorisation for the SMS message service'),
(33, 'UPLOAD_DIR', 'include/uploads/', 'System', 'Upload Directory'),
(34, 'IMAGES_DIR', 'images/', 'System', 'Default Internal Images Dir.  NOT THE SITE imgs folder'),
(35, 'SITE_LOGO', '', 'System', 'Site Logo');

DROP TABLE IF EXISTS `sitemenu`;
CREATE TABLE IF NOT EXISTS `sitemenu` (
  `sitemenuID` int(11) NOT NULL AUTO_INCREMENT,
  `sitemenuOrder` int(5) NOT NULL,
  `sitemenuName` varchar(255) NOT NULL,
  `sitemenuLink` varchar(255) NOT NULL,
  `siteMenuTitle` varchar(255) NOT NULL,
  `siteLinkPop` varchar(2) NOT NULL,
  `sitemenuImage` varchar(255) DEFAULT NULL,
  `sitemenuAlt` varchar(255) NOT NULL,
  `sitemenuLoc` int(5) NOT NULL,
  PRIMARY KEY (`sitemenuID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

INSERT INTO `sitemenu` (`sitemenuID`, `sitemenuOrder`, `sitemenuName`, `sitemenuLink`, `siteMenuTitle`, `siteLinkPop`, `sitemenuImage`, `sitemenuAlt`, `sitemenuLoc`) VALUES
(1, 1, 'Home', './', '', '0', '', 'Home', 0);
