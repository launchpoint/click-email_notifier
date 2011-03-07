<?

require_once("PHPMailer_v5.1/class.phpmailer.php");
require_once("PHPMailer_v5.1/class.smtp.php");

if(!isset($email_notifier_settings)) $email_notifier_settings = array(
  'send_mode'=>'immediate'
);
add_global('emails', array());
