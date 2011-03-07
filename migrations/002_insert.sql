INSERT INTO `email_accounts` (`name`, `from_address`, `from_name`, `cc`, `host`, `port`, `username`, `password`, `mode`) VALUES
('Default Account', 'noreply@painlessprogramming.com', '#app_name#', '', 'mail.authsmtp.com', 25, 'ac35613', 'lsi1224', 'smtp');

INSERT INTO `email_master_templates` (`email_account_id`, `name`, `body_html`, `body_text`) VALUES
(last_insert_id(), 'Standard', '<p>Dear #username#,\r\n<p>[content]\r\n<p>Sincerely,\r\n<br/>The #app_name# Team\r\n<p>\r\n<hr/>\r\n<p>To stop receiving these messages, please visit <a href="#unsubscribe_url#" alt"Unsubscribe">#unsubscribe_url#</a>.', 'Dear #username#,\r\n\r\n[content]\r\n\r\nSincerely,\r\nThe #app_name# Team\r\n\r\n---------------\r\n\r\nTo stop receiving these messages, please visit #unsubscribe_url#.');
