<?

$templates = EmailMasterTemplate::find_all();

$accounts = EmailAccount::find_all();

if (is_postback())
{
  $ea = EmailAccount::find_by_id(p('account_id'));
  send_email($ea, q('to'), q('subject'), q('body'), null, array(), array(), q('bypass'));
  flash('Email sent.');
}