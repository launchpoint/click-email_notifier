<?

$account = EmailAccount::find_by_id($params['id']);

$fields = array(
  'from'=>array(
    'from_name'=>array('display'=>'required', 'type'=>'text'),
    'from_address'=>array('display'=>'required', 'type'=>'text'),
    'cc'=>array('display'=>'required', 'type'=>'textarea')
  ),
  'send_mode'=>array(
    'mode'=>array('display'=>'required', 'type'=>'select', 'item_array'=>array('server', 'smtp')),
    'host'=>array('display'=>'optional', 'type'=>'text'),
    'port'=>array('display'=>'optional', 'type'=>'text'),
    'username'=>array('display'=>'optional', 'type'=>'text'),
    'password'=>array('display'=>'optional', 'type'=>'text'),
  )
);

if (is_postback())
{
  $account->update_attributes($params['email_account']);
  if ($account->is_valid)
  {
    flash_next("Account information saved.");
    redirect_to(view_email_notifier_settings_url());
  }
}