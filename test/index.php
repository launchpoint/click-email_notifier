<?

require_once("../../../kernel/bootstrap.php");

dprint($params);

if(is_postback())
{
  $ea = EmailAccount::new_model_instance( array(
    'attributes'=>array(
      'from_address'=>'noreply@painlessprogramming.com',
      'from_name'=>'Testing',
      'mode'=>'smtp',
      'port'=>25,
      'host'=>'mail.authsmtp.com',
      'username'=>'ac35613',
      'password'=>'xket4ddkf'
    )
  ));
  $ea->save();
  send_email($ea, q('to'), q('subject'), q('body'));
}

?>

<html>
<body>
<form method='post'>
To
<br/>
<input type="text" name="to" value="<?=h(q('to'))?>"/>
<br/>
Subject
<br/>
<input type="text" name="subject" value="<?=h(q('subject'))?>"/>
<br/>
Body
<br/>
<textarea name="body" style="width:600px;height:250px"><?=h(q('body'))?></textarea>
<br/>
<input type=submit name="send" value="Send"/> 
</form>