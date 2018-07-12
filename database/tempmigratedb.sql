set foreign_key_checks = 0;
SET @newschema = '.$newschema.';
SET @oldschema = '.$oldschema.';
//template
//insert into `@newschema`.TABLE (cols)
//SELECT cols FROM `@oldschema`.TABLE;
//SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'FusionInvoiceFOSS-dev' AND TABLE_NAME = 'clients';
//select table_name FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'FusionInvoice-dev'

//SELECT CONCAT("'", GROUP_CONCAT(column_name ORDER BY ordinal_position SEPARATOR "', '"), "'") AS columns
//FROM information_schema.columns
//WHERE table_schema = 'FusionInvoice-dev' AND table_name = 'activities'

//activities
DB::statement('insert into `'.$newschema.'`.activities (id, audit_type, activity, audit_id, info, created_at, updated_at)
SELECT id, audit_type, activity, audit_id, info, created_at, updated_at FROM `'.$oldschema.'`.activities;');
//addons
DB::statement('insert into `'.$newschema.'`.addons (id, created_at, updated_at, name, author_name, author_url, navigation_menu, system_menu, path, enabled, navigation_reports)
SELECT id, created_at, updated_at, name, author_name, author_url, navigation_menu, system_menu, path, enabled, navigation_reports FROM `'.$oldschema.'`.addons;');
//attachments
DB::statement('insert into `'.$newschema.'`.attachments (id, created_at, updated_at, user_id, attachable_id, attachable_type, filename, mimetype, size, url_key, client_visibility)
SELECT id, created_at, updated_at, user_id, attachable_id, attachable_type, filename, mimetype, size, url_key, client_visibility FROM `'.$oldschema.'`.attachments;');
//clients
DB::statement('insert into `'.$newschema.'`.clients (id, created_at,updated_at,name,address,city,state,zip,country,phone,fax,mobile,email,web,url_key,active,currency_code,unique_name,language)
SELECT id, created_at,updated_at,name,address,city,state,zip,country,phone,fax,mobile,email,web,url_key,active,currency_code,unique_name,language FROM `'.$oldschema.'`.clients;');
//clients_custom
DB::statement('insert into `'.$newschema.'`.clients_custom (client_id, created_at, updated_at)
SELECT client_id, created_at, updated_at FROM `'.$oldschema.'`.clients_custom;');
//company_profiles
DB::statement('insert into `'.$newschema.'`.company_profiles (id, created_at, updated_at, company, address, city, state, zip, country, phone, fax, mobile, web, logo, quote_template, invoice_template)
SELECT id, created_at, updated_at, company, address, city, state, zip, country, phone, fax, mobile, web, logo, quote_template, invoice_template FROM `'.$oldschema.'`.company_profiles;');
//company_profiles_custom
DB::statement('insert into `'.$newschema.'`.company_profiles_custom (company_profile_id, created_at, updated_at)
SELECT company_profile_id, created_at, updated_at FROM `'.$oldschema.'`.company_profiles_custom;');
//contacts
DB::statement('insert into `'.$newschema.'`.contacts (id, created_at, updated_at, client_id, name, email, default_to, default_cc, default_bcc)
SELECT id, created_at, updated_at, client_id, name, email, default_to, default_cc, default_bcc FROM `'.$oldschema.'`.contacts;');
//currencies
DB::statement('insert into `'.$newschema.'`.currencies (id, created_at, updated_at, code, name, symbol, placement, `decimal`, thousands)
SELECT id, created_at, updated_at, code, name, symbol, placement, `decimal`, thousands FROM `'.$oldschema.'`.currencies;');
//custom_fields
DB::statement('insert into `'.$newschema.'`.custom_fields (id, created_at, updated_at, tbl_name, column_name, field_label, field_type, field_meta)
SELECT id, created_at, updated_at, tbl_name, column_name, field_label, field_type, field_meta FROM `'.$oldschema.'`.custom_fields;');
//expense_categories
DB::statement('insert into `'.$newschema.'`.expense_categories (id, created_at, updated_at, name)
SELECT id, created_at, updated_at, name FROM `'.$oldschema.'`.expense_categories;');
//expense_vendors
DB::statement('insert into `'.$newschema.'`.expense_vendors (id, created_at, updated_at, name)
SELECT id, created_at, updated_at, name FROM `'.$oldschema.'`.expense_vendors;');
//expenses
DB::statement('insert into `'.$newschema.'`.expenses (id, created_at, updated_at, expense_date, user_id, category_id, client_id, vendor_id, invoice_id, description, amount, tax, company_profile_id)
SELECT id, created_at, updated_at, expense_date, user_id, category_id, client_id, vendor_id, invoice_id, description, amount, tax, company_profile_id FROM `'.$oldschema.'`.expenses;');
//expenses_custom
DB::statement('insert into `'.$newschema.'`.expenses_custom (expense_id, created_at, updated_at)
SELECT expense_id, created_at, updated_at FROM `'.$oldschema.'`.expenses_custom;');
//groups
DB::statement('insert into `'.$newschema.'`.groups (id, created_at, updated_at, name, next_id, left_pad, format, reset_number, last_id, last_year, last_month, last_week, last_number)
SELECT id, created_at, updated_at, name, next_id, left_pad, format, reset_number, last_id, last_year, last_month, last_week, last_number FROM `'.$oldschema.'`.groups;');
//invoice_amounts
DB::statement('insert into `'.$newschema.'`.invoice_amounts (id, created_at, updated_at, invoice_id, subtotal, discount, tax, total, paid, balance)
SELECT id, created_at, updated_at, invoice_id, subtotal, discount, tax, total, paid, balance FROM `'.$oldschema.'`.invoice_amounts;');
//invoice_item_amounts
DB::statement('insert into `'.$newschema.'`.invoice_item_amounts (id, created_at, updated_at, item_id, subtotal, tax_1, tax_2, tax, total)
SELECT id, created_at, updated_at, item_id, subtotal, tax_1, tax_2, tax, total FROM `'.$oldschema.'`.invoice_item_amounts;');
//invoice_items    - resource_table, resource_id,
DB::statement('insert into `'.$newschema.'`.invoice_items (id, created_at, updated_at, invoice_id, tax_rate_id, tax_rate_2_id,  name, description, quantity, display_order, price)
SELECT id, created_at, updated_at, invoice_id, tax_rate_id, tax_rate_2_id,  name, description, quantity, display_order, price FROM `'.$oldschema.'`.invoice_items;');
//invoice_tax_rates
//DB::statement('insert into `'.$newschema.'`.invoice_tax_rates (id, created_at, updated_at, invoice_id, tax_rate_id, include_item_tax, tax_total)
//SELECT id, created_at, updated_at, invoice_id, tax_rate_id, include_item_tax, tax_total FROM `'.$oldschema.'`.invoice_tax_rates;');
//invoice_transactions
DB::statement('insert into `'.$newschema.'`.invoice_transactions (id, created_at, updated_at, invoice_id, is_successful, transaction_reference)
SELECT id, created_at, updated_at, invoice_id, is_successful, transaction_reference FROM `'.$oldschema.'`.invoice_transactions;');
//invoices
DB::statement('insert into `'.$newschema.'`.invoices (id, created_at, updated_at, invoice_date, user_id, client_id, group_id, invoice_status_id, due_at, number, terms, footer, url_key, currency_code, exchange_rate, template, summary, viewed, discount, company_profile_id)
SELECT id, created_at, updated_at, invoice_date, user_id, client_id, group_id, invoice_status_id, due_at, number, terms, footer, url_key, currency_code, exchange_rate, template, summary, viewed, discount, company_profile_id FROM `'.$oldschema.'`.invoices;');
//invoices_custom
DB::statement('insert into `'.$newschema.'`.invoices_custom (invoice_id, created_at, updated_at)
SELECT invoice_id, created_at, updated_at FROM `'.$oldschema.'`.invoices_custom;');
//item_lookups  - category, resource_table, resource_id,
DB::statement('insert into `'.$newschema.'`.item_lookups (id, created_at, updated_at, name, description, price,  tax_rate_id, tax_rate_2_id)
SELECT id, created_at, updated_at, name, description, price, tax_rate_id, tax_rate_2_id FROM `'.$oldschema.'`.item_lookups;');
//mail_queue
DB::statement('insert into `'.$newschema.'`.mail_queue (id, created_at, updated_at, mailable_id, mailable_type, `from`, `to`, cc, bcc, subject, body, attach_pdf, sent, error)
SELECT id, created_at, updated_at, mailable_id, mailable_type, `from`, `to`, cc, bcc, subject, body, attach_pdf, sent, error FROM `'.$oldschema.'`.mail_queue;');
//merchant_clients
DB::statement('insert into `'.$newschema.'`.merchant_clients (id, created_at, updated_at, driver, client_id, merchant_key, merchant_value)
SELECT id, created_at, updated_at, driver, client_id, merchant_key, merchant_value FROM `'.$oldschema.'`.merchant_clients;');
//merchant_payments
DB::statement('insert into `'.$newschema.'`.merchant_payments (id, created_at, updated_at, driver, payment_id, merchant_key, merchant_value)
SELECT id, created_at, updated_at, driver, payment_id, merchant_key, merchant_value FROM `'.$oldschema.'`.merchant_payments;');
//migrations
//notes
DB::statement('insert into `'.$newschema.'`.notes (id, created_at, updated_at, user_id, notable_id, notable_type, note, private)
SELECT id, created_at, updated_at, user_id, notable_id, notable_type, note, private FROM `'.$oldschema.'`.notes;');
//payment_methods
DB::statement('insert into `'.$newschema.'`.payment_methods (id, created_at, updated_at, name)
SELECT id, created_at, updated_at, name FROM `'.$oldschema.'`.payment_methods;');
//payments
DB::statement('insert into `'.$newschema.'`.payments (id, created_at, updated_at, invoice_id, payment_method_id, paid_at, note, amount)
SELECT id, created_at, updated_at, invoice_id, payment_method_id, paid_at, note, amount FROM `'.$oldschema.'`.payments;');
//payments_custom
DB::statement('insert into `'.$newschema.'`.payments_custom (payment_id, created_at, updated_at)
SELECT payment_id, created_at, updated_at FROM `'.$oldschema.'`.payments_custom;');
//quote_amounts
DB::statement('insert into `'.$newschema.'`.quote_amounts (id, created_at, updated_at, quote_id, subtotal, discount, tax, total)
SELECT id, created_at, updated_at, quote_id, subtotal, discount, tax, total FROM `'.$oldschema.'`.quote_amounts;');
//quote_item_amounts
DB::statement('insert into `'.$newschema.'`.quote_item_amounts (id, created_at, updated_at, item_id, subtotal, tax_1, tax_2, tax, total)
SELECT id, created_at, updated_at, item_id, subtotal, tax_1, tax_2, tax, total FROM `'.$oldschema.'`.quote_item_amounts;');
//quote_items
DB::statement('insert into `'.$newschema.'`.quote_items (id, created_at, updated_at, quote_id, tax_rate_id, tax_rate_2_id, name, description, quantity, display_order, price)
SELECT id, created_at, updated_at, quote_id, tax_rate_id, tax_rate_2_id, name, description, quantity, display_order, price FROM `'.$oldschema.'`.quote_items;');
//quote_tax_rates
//DB::statement('insert into `'.$newschema.'`.quote_tax_rates (id, created_at, updated_at, quote_id, tax_rate_id, include_item_tax, tax_total)
//SELECT id, created_at, updated_at, quote_id, tax_rate_id, include_item_tax, tax_total FROM `'.$oldschema.'`.quote_tax_rates;');
//quotes
DB::statement('insert into `'.$newschema.'`.quotes (id, created_at, updated_at, quote_date, invoice_id, user_id, client_id, group_id, quote_status_id, expires_at, number, footer, url_key, currency_code, exchange_rate, terms, template, summary, viewed, discount, company_profile_id)
SELECT id, created_at, updated_at, quote_date, invoice_id, user_id, client_id, group_id, quote_status_id, expires_at, number, footer, url_key, currency_code, exchange_rate, terms, template, summary, viewed, discount, company_profile_id FROM `'.$oldschema.'`.quotes;');
//quotes_custom
DB::statement('insert into `'.$newschema.'`.quotes_custom (quote_id, created_at, updated_at)
SELECT quote_id, created_at, updated_at FROM `'.$oldschema.'`.quotes_custom;');
//recurring_invoice_amounts
DB::statement('insert into `'.$newschema.'`.recurring_invoice_amounts (id, created_at, updated_at, recurring_invoice_id, subtotal, discount, tax, total)
SELECT id, created_at, updated_at, recurring_invoice_id, subtotal, discount, tax, total FROM `'.$oldschema.'`.recurring_invoice_amounts;');
//recurring_invoice_item_amounts
DB::statement('insert into `'.$newschema.'`.recurring_invoice_item_amounts (id, created_at, updated_at, item_id, subtotal, tax_1, tax_2, tax, total)
SELECT id, created_at, updated_at, item_id, subtotal, tax_1, tax_2, tax, total FROM `'.$oldschema.'`.recurring_invoice_item_amounts;');
//recurring_invoice_items
DB::statement('insert into `'.$newschema.'`.recurring_invoice_items (id, created_at, updated_at, recurring_invoice_id, tax_rate_id, tax_rate_2_id, name, description, quantity, display_order, price)
SELECT id, created_at, updated_at, recurring_invoice_id, tax_rate_id, tax_rate_2_id, name, description, quantity, display_order, price FROM `'.$oldschema.'`.recurring_invoice_items;');
//recurring_invoices
DB::statement('insert into `'.$newschema.'`.recurring_invoices (id, created_at, updated_at, user_id, client_id, group_id, company_profile_id, terms, footer, currency_code, exchange_rate, template, summary, discount, recurring_frequency, recurring_period, next_date, stop_date)
SELECT id, created_at, updated_at, user_id, client_id, group_id, company_profile_id, terms, footer, currency_code, exchange_rate, template, summary, discount, recurring_frequency, recurring_period, next_date, stop_date FROM `'.$oldschema.'`.recurring_invoices;');
//recurring_invoices_custom
DB::statement('insert into `'.$newschema.'`.recurring_invoices_custom (recurring_invoice_id, created_at, updated_at)
SELECT recurring_invoice_id, created_at, updated_at FROM `'.$oldschema.'`.recurring_invoices_custom;');
//recurring_invoices_old-NOTUSED
//schedule
//schedule_categories
//schedule_occurrences
//schedule_reminders
//schedule_resources
//schedule_settings
//settings
DB::statement('insert into `'.$newschema.'`.settings (id, created_at, updated_at, setting_key, setting_value)
SELECT id, created_at, updated_at, setting_key, setting_value FROM `'.$oldschema.'`.settings;');
//tax_rates
DB::statement('insert into `'.$newschema.'`.tax_rates (id, created_at, updated_at, name, percent, is_compound, calculate_vat)
SELECT id, created_at, updated_at, name, percent, is_compound, calculate_vat FROM `'.$oldschema.'`.tax_rates;');
//time_tracking_projects
//time_tracking_tasks
//time_tracking_timers
//users
DB::statement('insert into `'.$newschema.'`.users (id, created_at, updated_at, email, password, name, remember_token, api_public_key, api_secret_key, client_id)
SELECT id, created_at, updated_at, email, password, name, remember_token, api_public_key, api_secret_key, client_id FROM `'.$oldschema.'`.users;');
//users_custom
DB::statement('insert into `'.$newschema.'`.users_custom (user_id, created_at, updated_at)
SELECT user_id, created_at, updated_at FROM `'.$oldschema.'`.users_custom;');
//workorder_amounts
//workorder_employees
//workorder_item_amounts
//workorder_items
//workorder_resources
//workorder_settings
//workorder_tax_rates
//workorders
//workorders_custom

set foreign_key_checks = 1;