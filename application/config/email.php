<?php defined('BASEPATH') OR exit('No direct script access allowed.');

$config['useragent']        = 'PHPMailer'; 	// Mail engine switcher: 'CodeIgniter' or 'PHPMailer'
$config['protocol']         = 'mail';       // 'mail', 'sendmail', or 'smtp'
$config['mailpath']         = '/usr/sbin/sendmail';

// SMTP Email Settings Area

$config['smtp_host']        = 'mail.citisell.com'; // SMTP HOST Address E.g. - winnebago.websitewelcome.com
$config['smtp_user']        = 'citisell@citisell.com';		// SMTP Host Username
$config['smtp_pass']        = 'Kusum@123';		  // SMTP Host Password
$config['smtp_port']        = 465;		  // SMTP Host Port Number

$config['smtp_crypto']    = "";       // SMTP Encryption. Can be null, tls or ssl.
$config['wordwrap']       = TRUE;     // TRUE/FALSE  Turns word-wrap on/off
$config['wrapchars']      = "76";     // Number of characters to wrap at.
$config['mailtype']       = "html";   // text/html  Defines email formatting
$config['charset']        = "utf-8";  // Default char set: iso-8859-1 or us-ascii
$config['multipart']      = "mixed";  // "mixed" (in the body) or "related" (separate)
$config['alt_message']    = '';       // Alternative message for HTML emails
$config['validate']       = FALSE;    // TRUE/FALSE.  Enables email validation
$config['priority']       = "3";      // Default priority (1 - 5)
$config['newline']        = "\n";     // Default newline. "\r\n" or "\n" (Use "\r\n" to comply with RFC 822)
$config['crlf']           = "\n";     // The RFC 2045 compliant CRLF for quoted-printable is "\r\n".  Apparently some servers,
                                     // even on the receiving end think they need to muck with CRLFs, so using "\n", while
                                     // distasteful, is the only thing that seems to work for all environments.
$config['send_multipart'] = TRUE;     // TRUE/FALSE - Yahoo does not like multipart alternative, so this is an override.  Set to FALSE for Yahoo.
$config['bcc_batch_mode'] = FALSE;    // TRUE/FALSE  Turns on/off Bcc batch feature
$config['bcc_batch_size'] = 200;      // If bcc_batch_mode = TRUE, sets max number of Bccs in each batch
$config['_safe_mode']     = FALSE;
$config['_subject']       = "";
$config['_body']          = "";
$config['_finalbody']     = "";
$config['_alt_boundary']  = "";
$config['_atc_boundary']  = "";
$config['_header_str']    = "";
$config['_smtp_connect']  = "";
$config['_encoding']      = "8bit";
$config['_IP']            = FALSE;
$config['_smtp_auth']     = TRUE;
$config['_replyto_flag']  = FALSE;
$config['_debug_msg']     = array();
$config['_recipients']    = array();
$config['_cc_array']      = array();
$config['_bcc_array']     = array();
$config['_headers']       = array();
$config['_attach_name']   = array();
$config['_attach_disp']   = array();
$config['_protocols']     = array('mail', 'sendmail', 'smtp');
$config['_base_charsets'] = array('us-ascii', 'iso-2022-');   // 7-bit charsets (excluding language suffix)
$config['_bit_depths']    = array('7bit', '8bit');
$config['_priorities']    = array('1 (Highest)', '2 (High)', '3 (Normal)', '4 (Low)', '5 (Lowest)');
