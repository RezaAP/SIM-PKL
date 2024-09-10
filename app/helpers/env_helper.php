<?php

function env($prefix,$default = null)
{
    if (!file_exists('.env')) {
		echo 'File .env not found';
		die;
	} else {
		$config = parse_ini_file('.env');
		$exists = isset($config[$prefix]) ? $config[$prefix] : $default;
		$value = empty($exists) ? $default : $exists;
		return $value;
	}
}