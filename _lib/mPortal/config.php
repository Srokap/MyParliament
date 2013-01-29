<?php
date_default_timezone_set( 'Europe/Warsaw' );
define( 'ROOT', 'C:\work\www\OchParliament' );
define( 'SITE_ADDRESS', 'http://localhost/OchParliament');
define( 'SITE_ROOT', '/OchParliament/' );	


define( 'MAILER_REG_SMTPAUTH', true );
define( 'MAILER_REG_HOST', '' );
define( 'MAILER_REG_PORT', 587 );
define( 'MAILER_REG_USERNAME', '' );
define( 'MAILER_REG_PASSWORD', '' );
define( 'MAILER_REG_FROM', '' );
define( 'MAILER_REG_FROM_TITLE', '' );
define( 'MAILER_REG_REPLY', '' );
define( 'MAILER_REG_REPLY_TITLE', '' );

define('DEFAULT_PAGE_TITLE', 'OchParliament');
define('DEFAULT_PAGE_LAYOUT', 'front');
define('ERROR_PAGE', '404');

define('REGULAR_SESSION_MAXLIFE', 86400); // 1 day
define('REMEMBER_ME_SESSION_MAXLIFE', 2592000); // 30 days
define('VERIFY_PASSWORD_FREQUENCY', 180); // 30 minutes

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_DATABASE', 'ochparliament_local');

define('DB_TABLE_components', 'm_components');
define('DB_TABLE_components_defaults', 'm_components_defaults');
define('DB_TABLE_drafts', 'm_drafts');
define('DB_TABLE_menu', 'm_menu');
define('DB_TABLE_menu_groups', 'm_menu_groups');
define('DB_TABLE_meta', 'm_meta');
define('DB_TABLE_pages', 'm_pages');
define('DB_TABLE_pages_access', 'm_pages_access');
define('DB_TABLE_pages_components', 'm_pages_components');
define('DB_TABLE_pages_libs', 'm_pages_libs');
define('DB_TABLE_services', 'm_services');
define('DB_TABLE_services_access', 'm_services_access');
define('DB_TABLE_sql_errors', 'm_sql_errors');
define('DB_TABLE_users', 'm_users');
define('DB_TABLE_users_groups', 'm_users_groups');
define('DB_TABLE_vars', 'm_vars');
define('DB_TABLE_files_stamps', 'm_files_stamps');


define('USERS_SALT', '4cx37Sv^ksI');

define('FB_APP_ID', '');
define('FB_APP_SECRET', '');


/* Domain name of the Solr server */
define('SOLR_SERVER_HOSTNAME', 'localhost');

/* Whether or not to run in secure mode */
define('SOLR_SECURE', false);

/* HTTP Port to connection */
define('SOLR_SERVER_PORT', ((SOLR_SECURE) ? 8443 : 8983));

/* HTTP Basic Authentication Username */
define('SOLR_SERVER_USERNAME', 'admin');

/* HTTP Basic Authentication password */
define('SOLR_SERVER_PASSWORD', 'changeit');

/* HTTP connection timeout */
/* This is maximum time in seconds allowed for the http data transfer operation. Default value is 30 seconds */
define('SOLR_SERVER_TIMEOUT', 10);

/* File name to a PEM-formatted private key + private certificate (concatenated in that order) */
define('SOLR_SSL_CERT', 'certs/combo.pem');

/* File name to a PEM-formatted private certificate only */
define('SOLR_SSL_CERT_ONLY', 'certs/solr.crt');

/* File name to a PEM-formatted private key */
define('SOLR_SSL_KEY', 'certs/solr.key');

/* Password for PEM-formatted private key file */
define('SOLR_SSL_KEYPASSWORD', 'StrongAndSecurePassword');

/* Name of file holding one or more CA certificates to verify peer with*/
define('SOLR_SSL_CAINFO', 'certs/cacert.crt');

/* Name of directory holding multiple CA certificates to verify peer with */
define('SOLR_SSL_CAPATH', 'certs/');
