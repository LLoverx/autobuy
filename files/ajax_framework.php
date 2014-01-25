<?php
	/** Load Bootstrap */
	require "core.php";
	require "ajax_functions.php";

	// Require an action parameter
	if(empty($_REQUEST['action']))
		die('0');

	@header('Content-Type: text/html; charset=UTF-8');
	@header('X-Robots-Tag: noindex' );
	@header('X-Content-Type-Options: nosniff');

	$allowed_actions = array('login', 'submitAccount', 'getCredits', 'resetSession', 'submitPlayer', 'getPlayer', 'updatePlayer');
	
	if(in_array($_REQUEST['action'], $allowed_actions)) {
		call_user_func('ajax_' . str_replace('-', '_', $_REQUEST['action']), $_REQUEST);
	} 
	
	// Default status
	die('0');