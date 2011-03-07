
CREATE TABLE IF NOT EXISTS `email_accounts` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `from_address` varchar(50) NOT NULL,
  `from_name` varchar(50) NOT NULL,
  `cc` longtext NOT NULL,
  `host` varchar(200) NOT NULL,
  `port` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mode` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `name` (`name`,`from_address`,`from_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `email_master_templates` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `body_html` longtext NOT NULL,
  `body_text` longtext NOT NULL,
  `email_account_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` int(11) NOT NULL auto_increment,
  `subject` varchar(200) NOT NULL,
  `body_text` longtext NOT NULL,
  `body_html` longtext NOT NULL,
  `email_master_template_id` int(11) NOT NULL,
  `notification_template_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `email_master_template_id` (`email_master_template_id`,`notification_template_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;



