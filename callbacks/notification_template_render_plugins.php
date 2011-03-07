<?

$title = "Email Template";

$email_template = get_email_template_for($template);
$master_templates = EmailMasterTemplate::find_all();

if (is_postback() && array_key_exists('email_template', $params))
{
  $email_template->notification_template_id = $template->id;
  $email_template->update_attributes($params['email_template']);
  $template->extract_variables($email_template, array('subject', 'body_text', 'body_html'));
  $template->extract_variables($email_template->email_master_template, array('body_text', 'body_html'));
  $template->extract_variables($email_template->email_master_template->email_account, array('from_name'));
  
  if ($email_template->is_valid)
  {
    flash('Email template saved.');
  }
}