<?

function send_email($ea, $to, $from_name, $subject, $body, $html_body=null, $ccs=array(), $attachments=array(), $send_mode=null)
{
  global $run_mode, $email_notifier_settings;
  $mi = EmailQueueItem::create( array(
    'attributes'=>array(
      'email_account_id'=>$ea->id,
      'to'=>$to,
      'from_name'=>$from_name,
      'subject'=>$subject,
      'body'=>$body,
      'html_body'=>$html_body,
      'ccs'=>$ccs,
      'attachments'=>$attachments,
      'send_mode'=>$send_mode
    )
  ));
  if($run_mode != RUN_MODE_PRODUCTION || $email_notifier_settings['send_mode']=='immediate')
  {
    send_queued_email();
  }
}

function send_email_lowlevel($mi)
{
  global $run_mode, $mail, $emails, $debug_email;
  $m = new PHPMailer();
  
  $ea = $mi->email_account;
  switch($ea->mode)
  {
    case 'server':
      $m->IsMail();
      break;
    case 'smtp':
      $m->IsSMTP();
      $m->SMTPAuth   = true;
      $m->Port       = $ea->port;
      $m->Host       = $ea->host;
      $m->Username   = $ea->username;
      $m->Password   = $ea->password;
      break;
  }

  $m->Encoding="base64";
  $m->From       = $ea->from_address;
  $m->FromName = $mi->from_name;
  
  $prefix="";
  
  if (!is_array($mi->to)) $mi->to=array($mi->to);
  if($run_mode == RUN_MODE_DEVELOPMENT && $debug_email)
  {
    $addrs = join($mi->to, ',');
    $prefix="DEVELOPMENT MODE (to {$addrs}) - ";
    $m->AddAddress($debug_email);
  } else {
    foreach($mi->to as $addr)
    {
      $m->AddAddress($addr);
    }
  }
  $m->Subject    = "{$prefix}{$mi->subject}";


  if ($mi->html_body)
  {
    $m->AltBody    = $mi->body;
    $m->MsgHTML($mi->html_body);
  } else {
    $m->Body    = $mi->body;
  }
  
  foreach($mi->attachments as $data)
  {
    if(is_object($data))
    {
      $m->AddAttachment($data->fpath, $data->original_file_name, 'base64', $data->mime_type);
    } else {
      $m->AddAttachment($data);             // attachment
    }
  }
  
  foreach($mi->ccs as $cc)
  {
    $m->AddBcc(trim($cc));
  }

  $emails[] = $m;
  
  event('before_email_item_send', array('m'=>$m, 'mi'=>$mi));
  if ($run_mode != RUN_MODE_TEST)
  {
    $m->Send();
  }
  return $m;
}

function send_queued_email()
{
  $items = EmailQueueItem::find_all( array(
    'conditions'=>array('delivered_at is null')
  ));
  
  foreach($items as $i)
  {
    $m = send_email_lowlevel($i);
    if ($m->ErrorInfo)
    {
      $i->history = $m->ErrorInfo . ' @ ' . click_date_format(time(), true) . "\n" . $i->history;
    } else {
      $i->delivered_at = time();
    }
    $i->save();
  }
}
