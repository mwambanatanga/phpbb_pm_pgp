<?php
/**
*
* @author Mwamba Natanga <mwambanatanga@gmail.com>
* @version $Id: install_pm_pgp_mod.php 135 2012-10-10 10:02:51 $
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
define('UMIL_AUTO', true);
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
$user->session_begin();
$auth->acl($user->data);
$user->setup();

if (!file_exists($phpbb_root_path . 'umil/umil_auto.' . $phpEx))
{
	trigger_error('Please download the latest UMIL (Unified MOD Install Library) from: <a href="http://www.phpbb.com/mods/umil/">phpBB.com/mods/umil</a>', E_USER_ERROR);
}

// The name of the mod to be displayed during installation.
$mod_name = 'PM_PGP';

/*
* The name of the config variable which will hold the currently installed version
* You do not need to set this yourself, UMIL will handle setting and updating the version itself.
*/
$version_config_name = 'PM_PGP_VERSION';

/*
* The language file which will be included when installing
* Language entries that should exist in the language file for UMIL (replace $mod_name with the mod's name you set to $mod_name above)
* $mod_name
* 'INSTALL_' . $mod_name
* 'INSTALL_' . $mod_name . '_CONFIRM'
* 'UPDATE_' . $mod_name
* 'UPDATE_' . $mod_name . '_CONFIRM'
* 'UNINSTALL_' . $mod_name
* 'UNINSTALL_' . $mod_name . '_CONFIRM'
*/
$language_file = 'mods/pm_pgp';

/*
* Options to display to the user (this is purely optional, if you do not need the options you do not have to set up this variable at all)
* Uses the acp_board style of outputting information, with some extras (such as the 'default' and 'select_user' options)

$options = array(
	'test_username'	=> array('lang' => 'TEST_USERNAME', 'type' => 'text:40:255', 'explain' => true, 'default' => $user->data['username'], 'select_user' => true),
	'test_boolean'	=> array('lang' => 'TEST_BOOLEAN', 'type' => 'radio:yes_no', 'default' => true),
);
*/
/*
* Optionally we may specify our own logo image to show in the upper corner instead of the default logo.
* $phpbb_root_path will get prepended to the path specified
* Image height should be 50px to prevent cut-off or stretching.
*/
$logo_img = '';

/*
* The array of versions and actions within each.
* You do not need to order it a specific way (it will be sorted automatically), however, you must enter every version, even if no actions are done for it.
*
* You must use correct version numbering.  Unless you know exactly what you can use, only use X.X.X (replacing X with an integer).
* The version numbering must otherwise be compatible with the version_compare function - http://php.net/manual/en/function.version-compare.php
*/
$versions = array(
	// Version 1.0.0
	'1.0.0'	=> array(
		'custom'	=> 'uninstall_pm_pgp',

	// Now to add a table (this uses the layout from develop/create_schema_files.php and from phpbb_db_tools)
		'table_add' => array(
			array(
				$table_prefix . 'pgp_keys',
				array(
					'COLUMNS'		=> array(
						'user_id'		=> array('INT:0', 0),
						'pgp_key'		=> array('TEXT', ''),
						'fingerprint'	=> array('CHAR:40', ''),
						'key_user'		=> array('CHAR:255', ''),
						'key_type'		=> array('CHAR:10', ''),
					),
					'PRIMARY_KEY'	=> 'user_id',
				),
			),
		),

	// Lets add a new column to the phpbb_users table 
		'table_column_add' => array(
			array($table_prefix . 'users', 'user_has_pgp_key', array('BOOL', 0)),
		),
		'module_add' => array(
			array('ucp', 'UCP_PROFILE',
				array( // Mode title
					'module_basename'    => 'profile', //info file name minus ucp_
					'modes'                => array('pgp_key'), // Mode set in info file
				),
			),
		),
		'cache_purge' => array(
			array('template', 0),
		),
	),
);

// Include the UMIF Auto file and everything else will be handled automatically.
include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);

/*
*
* @param string $action The action (install|update|uninstall) will be sent through this.
* @param string $version The version this is being run for will be sent through this.
*/
function update_pm_pgp_table($action, $version)
{
	global $db, $table_prefix, $umil;
	if ($action != 'uninstall')
	{
		if (!defined('PGP_KEYS_TABLE'))
		{
			define('PGP_KEYS_TABLE', $table_prefix . 'pgp_keys');
		}	
		$sql = 'UPDATE '. PGP_KEYS_TABLE .'
			SET forum_id = (SELECT forum_id 
			FROM '. POSTS_TABLE .'
			WHERE post_id = '. PGP_KEYS_TABLE .'.post_id)';
		$result = $db->sql_query($sql);
		$db->sql_freeresult($result);
		
		$sql = 'UPDATE '. PGP_KEYS_TABLE .'
			SET topic_id = (SELECT topic_id
			FROM '. POSTS_TABLE .'
			WHERE post_id = '. PGP_KEYS_TABLE .'.post_id)';
		$result = $db->sql_query($sql);
		$db->sql_freeresult($result);
	}
	/**
	* Return a string
	* 	The string will be shown as the action performed (command).  It will show any SQL errors as a failure, otherwise success
	*/
	return 'PM_PGP_RETURN_UPDATE';

	/**
	* Return an array
	* 	With the keys command and result to specify the command and the result
	*	Returning a result (other than SUCCESS) assumes a failure
	*/
	/* return array(
		'command'	=> 'EXAMPLE_CUSTOM_FUNCTION',
		'result'	=> 'FAIL',
	);*/

	/**
	* Return an array
	* 	With the keys command and result (same as above) with an array for the command.
	*	With an array for the command it will use sprintf the first item in the array with the following items.
	*	Returning a result (other than SUCCESS) assumes a failure
	*/
	/* return array(
		'command'	=> array(
			'EXAMPLE_CUSTOM_FUNCTION',
			$username,
			$number,
			$etc,
		),
		'result'	=> 'FAIL',
	);*/
}

function update_module($action, $version)
{	
	global $umil;
	if ($action == 'update')
	{
		$umil-> module_remove('acp', 'ACP_MESSAGES', 'ACP_THANKS');	
	}	
	return 'PM_PGP_RETURN_REMOVE';	
}

function uninstall_pm_pgp($action, $version)
{	
	global $umil;
	if ($action == 'uninstall')
	{
		$umil-> cache_purge();	
	}	
	return 'PM_PGP_RETURN_CACHE';	
}

?>
