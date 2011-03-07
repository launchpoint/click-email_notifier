<?

map('content', 'admin/notifications/email', 'view', 'view_email_notifier_settings');
map('content', 'admin/notifications/email/master_templates/:id/edit', 'edit_master_template', 'edit_email_master_template');
map('content', 'admin/notifications/email/accounts/:id/edit', 'edit_email_account', 'edit_email_account');
