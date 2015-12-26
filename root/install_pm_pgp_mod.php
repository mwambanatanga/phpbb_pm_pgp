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
                        'fingerprint'		=> array('CHAR:40', ''),
                    ),
                    'PRIMARY_KEY'	=> 'user_id',
                ),
			),
		),

	// Lets add a new column to the phpbb_users table 
		'table_column_add' => array(
			array($table_prefix . 'users', 'user_has_pgp_key', array('BOOL', 0)),
		),
/**
        'table_row_update' => array(
            array($table_prefix . 'users',
                array('user_id' => '55'),
                array('user_has_pgp_key' => '1'),
            ),
        ),

        'table_row_insert' => array(
            array($table_prefix . 'pgp_keys',
                array(
                    'user_id' => '55',
                    'pgp_key' => "-----BEGIN PGP PUBLIC KEY BLOCK-----
 
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
gU9U73K1
=9/hP
-----END PGP PUBLIC KEY BLOCK-----",
                    'fingerprint' => '4B131F4B8E28317E8D72F9788D5E7B843458725D',
                ),
            ),
        ),
**/
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
