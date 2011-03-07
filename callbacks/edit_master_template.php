<?
$template = EmailMasterTemplate::find_by_id($params['id']);

if (is_postback())
{
  $template->update_attributes($params['email_master_template']);
  if($template->is_valid)
  {
    flash_next("Template saved.");
    redirect_to(view_email_notifier_settings_url());
  }
}