<?

function is_valid_email($obj, $field)
{
  return is_rfc3696_valid_email_address($obj->$field);
}