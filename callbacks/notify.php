<?
global $debug_email;

if ($template->is_enabled_for($to, 'email') && (!isset($template->data['types']) || in_array('email', $template->data['types'])))
{
  $t = get_email_template_for($template);
  $s = $template->apply_vars($t->subject);
  $bt = preg_replace("/\[content\]/", $t->body_text, $t->email_master_template->body_text);
  $bh = preg_replace("/\[content\]/", $t->body_html, $t->email_master_template->body_html);
  $bt = $template->apply_vars($bt);
  $bh = $template->apply_vars($bh,true);

  $ea =  $t->email_master_template->email_account;
  $ea->from_name = $template->apply_vars($ea->from_name);
  $ccs = trim($ea->cc);
  if (strlen($ccs)>0)
  {
    $ccs = split(",",$ccs);
  } else {
    $ccs=array();
  }
  
  $att = array();
  if(isset($template->data['attachments'])) $att = $template->data['attachments'];
  
  send_email($ea, $to->email, $ea->from_name, $s, $bt, $bh, $ccs, $att);
}
