<?

$m = $email_queue_item;

$m->to = __serialize($m->to);
$m->ccs = __serialize($m->ccs);
$m->attachments = __serialize($m->attachments);
