<?php
/**
*
* pm_pgp[Russian]
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
	'PM_PGP'					=> 'PGP для личных сообщений',
	'INSTALL_PM_PGP'			=> 'Установить дополнение "PGP для личных сообщений"?',
	'INSTALL_PM_PGP_CONFIRM'	=> 'Подтверди установку "PGP для личных сообщений"',
	'UPDATE_PM_PGP'				=> 'Обновить дополнение "PGP для личных сообщений"?',
	'UPDATE_PM_PGP_CONFIRM'		=> 'Подтверди внесение изменений в "PGP для личных сообщений"',
	'UNINSTALL_PM_PGP'			=> 'Удалить дополнение "PGP для личных сообщений"?',
	'UNINSTALL_PM_PGP_CONFIRM'	=> 'Подтверди удаление "PGP для личных сообщений"',
	'PGP_KEY'					=> 'Открытый ключ PGP',
	'REMOVE_PGP_KEY'			=> 'Удалить открытый ключ PGP из базы данных?',
	'PGP_KEY_NOT_UPLOADED'		=> 'Ключ PGP не загружен',
// Install block
	'PM_PGP_INSTALLED'			=> 'Плагин "PGP для личных сообщений" был установлен',
	'PM_PGP_INSTALLED_EXPLAIN'	=> '<strong>ВНИМАНИЕ!<br />Рекомендуется запускать данную установку только после выполнения инструкции по внесению изменений в код файлов конференции (или выполнения установки с помощью AutoMod)!<br />Также настоятельно рекомендуется включить опцию Отображать все результаты (ниже)!</strong>',
	'PM_PGP_RETURN_UPDATE'		=> 'Обновление данных в таблице _pgp_keys table',
	'PM_PGP_RETURN_REMOVE'		=> 'Проверка удаления модуля',
	'PM_PGP_RETURN_CACHE'		=> 'Проверка обновления кеша',
	'UCM_PROFILE_PGP_KEY'		=> 'Управление ключом PGP',
	'PROFILE_PGP_NOTICE'		=> 'Обратите внимание, что ...[информация о ключах PGP будет добавлена позже]',
	'PUBLIC_PGP_KEY'			=> 'Твой открытый ключ PGP',
	'PUBLIC_PGP_KEY_FILE'			=> 'Файл с твоим открытым ключём PGP',
	'PGP_FINGERPRINT'			=> 'Отпечаток ключа',
	'PGP_KEY_DELETED'			=> 'Твой открытый ключ PGP был удалён из базы данных форума.',
	'BAD_PGP_KEY'				=> 'Загрузка прервана. Невозможно расчитать отпечаток твоего ключа PGP. Неверный ключ?',
	'PGP_KEY_UPLOADED'			=> 'Твой открытый ключ PGP был загружен в базу данных форума.',
	'KEY_USER'					=> 'Пользователь ключа',
	'KEY_TYPE'					=> 'Тип ключа',
	'PGP_ENCRYPT'					=> 'Зашифровать',
	'PGP_BROSER_NOT_SUPPORTED'	=> 'К сожалению, твой браузер не поддерживает чтение файлов',
	'PRIVATE_PGP_KEY'		=> 'Закрытый ключ PGP',
	'PGP_KEY_USER_ID'		=> 'ID пользователя ключа',
	'PGP_PASSPHRASE'		=> 'Парольная фраза',
	'PGP_DECRYPTION_NOTICE'	=> 'Это сообщение было зашифровано ключом PGP {1}. Чтобы расшифровать его, загрузи закрытый ключ и введи парольную фразу.',
	'PGP_DECRYPT_TAKE_TIME'		=> 'Это займёт некоторое время.',
	'PGP_DECRYPT_OK'		=> 'Расшифровка завершена!',
	'PGP_DECRYPT_FAIL'		=> 'Не удалось расшифровать.',
	'PGP_NOT_KEY'			=> 'Файл не является ключом PGP',
	'PGP_MATCH'			=> 'Совпадает!!!',
	'PGP_DECRYPT'			=> 'Расшифровать',
	'PGP_PUBLIC_KEY_LOOKUP'		=> 'Запрашиваю публичный ключ пользователя...',
	'PGP_ENCRYPT_OK'		=> 'Шифрование завершено!',
	'PGP_ENCRYPT_FAIL'		=> 'Не удалось зашифровать.',
	'PGP_USER_NOT_SELECTED'		=> 'Невозможно зашифровать: не выбран получатель с ключом PGP.',
	'PGP_ALREADY_ENCRYPTED'		=> 'Твоё сообщение уже зашифровано',
	'PGP_ENCRYPTION_NOTICE'		=> 'Чтобы зашифровать сообщение, кликни по нику адресата ниже (можно выбрать лишь одного адресата).',
	'PGP_NO_SUBKEYS'			=> 'Не найдены подключи. У пользователей могут возникнуть проблемы при отправке тебе зашифрованных сообщений. Не рекомендуется загружать такой ключ.',
	'KEY_SIZE'					=> 'Размер ключа (битов)',
));
?>
