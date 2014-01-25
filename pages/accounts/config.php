<?php
	$db->connect();
	
	//start pagination
	$rec_count = $db->num_rows("accounts");
	$results = $db->query("SELECT * FROM accounts ORDER BY date_added DESC");
	$arrayAccounts = array();
	foreach($results['results'] as $accounts) {
		$arrayAccounts[] = $accounts;
	}
	//end pagination
	$db->disconnect();
?>