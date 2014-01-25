<?php
	set_time_limit(0);
	$_SERVER['DOCUMENT_ROOT'] = dirname(dirname(__FILE__));
	
	define("ROOT", $_SERVER['DOCUMENT_ROOT']);
	define("CLASSES", ROOT."/classes");
	define("DB", CLASSES."/database");
	define("FILES", ROOT."/files");
	define("PAGES", ROOT."/pages");
	
	require CLASSES."/config.php";
	switch(Config::$db) {
		case "mysql":
			require DB."/mysql.php";
		break;
		case "mysqli":
			require DB."/mysqli.php";
		break;
		case "pdo":
			require DB."/pdo.php";
		break;
		default:
			die("Invalid database type has been selected.");
		break;
	}
	require CLASSES."/Guzzle/guzzle.phar";
	require CLASSES."/connector.php";
	require CLASSES."/eahashor.php";
	require CLASSES."/searchor.php";
	require CLASSES."/tradeor.php";
	require CLASSES."/functions.php";
	require CLASSES."/pusher.php";
	require CLASSES."/multicurl.php";
	
	//initialise classes
	$db = new Database();
	$hashor = new EAHashor();
	$functions = new Functions();
?>