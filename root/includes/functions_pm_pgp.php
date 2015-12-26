<?php
/** 
*
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit; 
}
$user->add_lang('mods/pm_pgp');
/*
// remove a user's thanks
function delete_pgp_key($user_id)
{
	global $db, $user, $phpbb_root_path, $phpEx, $forum_id, $config, $auth;
	// confirm
	
	if (confirm_box(true, 'REMOVE_PGP_KEY', $hidden = ''))
	{
		if (!defined('PGP_KEYS_TABLE'))
		{
			define('PGP_KEYS_TABLE', $table_prefix . 'pgp_keys');
		}
		$sql = "DELETE FROM " . PGP_KEYS_TABLE . "
				WHERE user_id = " . (int) $user->data['user_id'];
			$db->sql_query($sql);
			$result = $db->sql_affectedrows($sql);
			if ($result != 0)
			{
				$sql = "UPDATE " .$table_prefix . "users" . " 
						SET user_has_pgp_key = 0 
						WHERE user_id = " . (int) $user->data['user_id'];
					$db->sql_query($sql);
					$result = $db->sql_affectedrows($sql);
			}
	}
	else
	{
		confirm_box(false, 'REMOVE_PGP_KEY', $hidden = '');
	}
	return;
}
*/
// get user's key fingerprint
function get_pgp_fingerprint($user_id)
{
	global $db, $user;
	if (!defined('PGP_KEYS_TABLE'))
	{
		define('PGP_KEYS_TABLE', $table_prefix . 'pgp_keys');
	}
	if (user_has_pgp_key($user_id))
	{
		$sql = "SELECT fingerprint FROM " . PGP_KEYS_TABLE .  " WHERE user_id = " . $user_id;
		$db->sql_query($sql);
		$fingerprint = $db->sql_fetchfield('fingerprint');
//		$fingerprint = chunk_split(strtoupper(substr($fingerprint, -8)), 2, ' '); // the last 8 digits of the fingerprint in uppercase with spaces
	}
	else $fingerprint = NULL;
	return $fingerprint;
}

function user_has_pgp_key($user_id)
{
	global $db;
	$sql = "SELECT user_has_pgp_key FROM ". USERS_TABLE . " 
			WHERE user_id = " . $user_id;
	$db->sql_query($sql);
	$result = $db->sql_fetchfield('user_has_pgp_key');
	return $result;
}

function get_pgp_public_key($user_id)
{
	global $db, $user;
	if (!defined('PGP_KEYS_TABLE'))
	{
		define('PGP_KEYS_TABLE', $table_prefix . 'pgp_keys');
	}
	if (user_has_pgp_key($user_id))
	{
		$sql = "SELECT pgp_key FROM " . PGP_KEYS_TABLE .  " WHERE user_id = " . $user_id;
		$db->sql_query($sql);
		$public_key = $db->sql_fetchfield('pgp_key');
	}
	else $public_key = NULL;
	return $public_key;
}

function download_pgp_public_key($user_id)
{
	if (user_has_pgp_key($user_id))
	{
		$pgp_public_key = get_pgp_public_key($user_id);
		$pgp_fingerprint = get_pgp_fingerprint($user_id);
		header('Content-Disposition: attachment; filename="' . strtoupper(substr($pgp_fingerprint, -8)) . '.key"');
		header('Content-Type: text/plain');
		header('Content-Length: ' . strlen($pgp_public_key));
		header('Connection: close');
		echo $pgp_public_key;
	}
}

function put_pgp_key($data)
//$user_id, $fingerprint, $public_key)
{
	global $db, $user;

	//confirm_box?

	if ($data['user_id'] != $user->data['user_id']) //wrong user
	{
		return false;
	}

	if (!defined('PGP_KEYS_TABLE'))
	{
		define('PGP_KEYS_TABLE', $table_prefix . 'pgp_keys');
	}

	//check if user has a key already uploaded
	if (user_has_pgp_key($data['user_id'])) //if yes, then update
	{
		$sql_ary = array(
			'fingerprint'		=> $data['fingerprint'],
			'pgp_key'		=> $data['pgp_key'],
			);
		$sql = "UPDATE " . PGP_KEYS_TABLE . " SET " . $db->sql_build_array('UPDATE', $sql_ary) .
			" WHERE user_id = " . $data['user_id'];
		$db->sql_query($sql);
		$result = $db->sql_affectedrows($sql); //should be one
		if ($result == 1) return true;
		else return false; //something went wrong
	}
	else //if no, then insert new
	{
		$sql_ary = array(
			'user_id'	=> $data['user_id'],
			'fingerprint'	=> $data['fingerprint'],
			'pgp_key'	=> $data['pgp_key'],
			);
		$sql = "INSERT into " . PGP_KEYS_TABLE . " " . $db->sql_build_array('INSERT', $sql_ary);
		$db->sql_query($sql);
		$result = $db->sql_affectedrows($sql); //should be one
		if ($result == 1)
		{
			$sql = "UPDATE " . USERS_TABLE . "  
			SET user_has_pgp_key = 1 
			WHERE user_id = " . $data['user_id'];
			$db->sql_query($sql);
			return true;
		}
		else return false; //something went wrong
	}
}

function delete_pgp_key($user_id)
{
	global $db, $user;

	if ($user_id != $user->data['user_id']) //wrong user
	{
		return false;
	}

	if (!defined('PGP_KEYS_TABLE'))
	{
		define('PGP_KEYS_TABLE', $table_prefix . 'pgp_keys');
	}
	
	$sql = "DELETE FROM " . PGP_KEYS_TABLE . " 
		WHERE user_id = " . $user_id;
	$db->sql_query($sql);
	$result = $db->sql_affectedrows($sql);
	if ($result != 0)
	{
		$sql = "UPDATE " . USERS_TABLE . " 
			SET user_has_pgp_key = 0 
			WHERE user_id = " . $user_id;
		$db->sql_query($sql);
		$result = $db->sql_affectedrows($sql);
	}
	return true;
}

?>
