<?php
/**
*
* pm_pgp[English]
*
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
   exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'PM_PGP'					=> 'PGP for private messages',
	'INSTALL_PM_PGP'			=> 'Install the "PGP for private messages" plugin?',
	'INSTALL_PM_PGP_CONFIRM'	=> 'Confirm installation of "PGP for private messages"',
	'UPDATE_PM_PGP'				=> 'Update the "PGP for private messages" plugin?',
	'UPDATE_PM_PGP_CONFIRM'		=> 'Confirm changes to "PGP for private messages"',
	'UNINSTALL_PM_PGP'			=> 'Uninstall the "PGP for private messages" plugin?',
	'UNINSTALL_PM_PGP_CONFIRM'	=> 'Confirm removal of "PGP for private messages"',
	'PGP_KEY'					=> 'Public PGP key',
	'REMOVE_PGP_KEY'			=> 'Remove your public PGP key from database?',
	'PGP_KEY_NOT_UPLOADED'		=> 'PGP key not uploaded',
// Install block
	'PM_PGP_INSTALLED'			=> 'Plugin "PGP for private messages" was installed',
	'PM_PGP_INSTALLED_EXPLAIN'	=> '<strong>CAUTION!<br />You are strongly advised to only run this installation after following the instruction on code changes to the files (or perform the installation using AutoMod)! <br />It is also strongly recommended to select Yes to Display Full Results (below)!</strong>',
	'PM_PGP_RETURN_UPDATE'		=> 'Updating values in the _pgp_keys table',
	'PM_PGP_RETURN_REMOVE'		=> 'Checking module removal',
	'PM_PGP_RETURN_CACHE'		=> 'Checking cache refrech',
	'UCP_PROFILE_PGP_KEY'		=> 'Manage your PGP key',
	'PROFILE_PGP_NOTICE'	=> 'Please note that ... [info about PGP keys to be added later]',
	'PUBLIC_PGP_KEY'		=> 'Your public PGP key',
	'PUBLIC_PGP_KEY_FILE'		=> 'Your public PGP key file',
	'PGP_FINGERPRINT'		=> 'Key fingerprint',
	'PGP_KEY_DELETED'			=> 'Your public PGP key was deleted from forum database.',
	'BAD_PGP_KEY'				=> 'Upload aborted. Could not compute the fingerprint of your PGP key. Bad key?',
	'PGP_KEY_UPLOADED'			=> 'Your public PGP key was uploaded to forum database.',
	'KEY_USER'					=> 'Key user',
	'KEY_TYPE'					=> 'Key type',
	'PGP_ENCRYPT'					=> 'Encrypt',
	'PGP_BROWSER_NOT_SUPPORTED'	=> 'Unfortunately, your browser does not support reading files',
	'PRIVATE_PGP_KEY'		=> 'Private PGP key',
	'PRIVATE_PGP_KEY_FILE'		=> 'Private PGP key file',
	'PGP_KEY_USER_ID'		=> 'Key user ID',
	'PGP_PASSPHRASE'		=> 'Passphrase',
	'PGP_DECRYPTION_NOTICE'	=> 'This message was encrypted with PGP key {1}. To decrypt it, provide your private key (file or text) and type the passphrase. Decryption is done in your browser.',
	'PGP_DECRYPT_TAKE_TIME'		=> 'This may take some time.',
	'PGP_DECRYPT_OK'		=> 'Decryption complete!',
	'PGP_DECRYPT_FAIL'		=> 'Decryption failed.',
	'PGP_NOT_KEY'			=> 'This file is not a PGP key.',
	'PGP_MATCH'			=> 'Match!!!',
	'PGP_DECRYPT'			=> 'Decrypt',
	'PGP_PUBLIC_KEY_LOOKUP'		=> 'Requesting public PGP key...',
	'PGP_ENCRYPT_OK'		=> 'Encryption complete!',
	'PGP_ENCRYPT_FAIL'		=> 'Encryption failed.',
	'PGP_USER_NOT_SELECTED'		=> 'Can not encrypt: no recipients with PGP key selected.',
	'PGP_ALREADY_ENCRYPTED'		=> 'Your message is already encrypted.',
	'PGP_ENCRYPTION_NOTICE'		=> 'To encrypt the message, click on the recipient\'s nickname below (only one recipient can be chosen).',
	'PGP_NO_SUBKEYS'			=> 'No subkeys found. Users might experience problems sending you encrypted messages. It is not recommended to upload such a key.',
	'KEY_SIZE'					=> 'Key size (bites)',
));
?>
