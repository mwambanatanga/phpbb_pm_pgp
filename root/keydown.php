<?php
/**
*
*
*/

/**
* @ignore
*/
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_pm_pgp.' . $phpEx);

// Start session management
$user->session_begin();

if ($user->data['user_id'] == ANONYMOUS)
{
	trigger_error('NOT_AUTHORISED');
}

$user_id = request_var('u', ANONYMOUS);
download_pgp_public_key($user_id);
?>
