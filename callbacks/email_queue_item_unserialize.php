<?

$m = $email_queue_item;

$m->to = __unserialize($m->to);
$m->ccs = __unserialize($m->ccs);
$m->attachments = __unserialize($m->attachments);
