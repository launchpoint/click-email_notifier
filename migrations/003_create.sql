CREATE TABLE IF NOT EXISTS `email_queue_items` (
  `id` int(11) NOT NULL auto_increment,
  `email_account_id` int(11) NOT NULL,
  `to` longtext NOT NULL,
  `subject` varchar(500) NOT NULL,
  `body` longtext NOT NULL,
  `html_body` longtext,
  `ccs` longtext NOT NULL,
  `attachments` longtext NOT NULL,
  `send_mode` int(11) default NULL,
  `history` longtext,
  `delivered_at` datetime default NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `delivered_at` (`delivered_at`),
  KEY `email_account_id` (`email_account_id`,`subject`,`send_mode`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11431 ;