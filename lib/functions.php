<?

function get_email_template_for($nt)
{
  $et = EmailTemplate::find_or_new_by( array(
    'conditions'=>array('notification_template_id = ?', $nt->id),
    'attributes'=>array(
      'subject'=>$nt->name,
      'body_text' => 'New message body',
      'body_html' => '<p>New message body',
      'notification_template_id'=>$nt->id,
      'email_master_template_id'=>1
      )
    )
  );
  return $et;
}