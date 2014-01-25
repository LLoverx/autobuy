<?php
	$db->connect();
	
	//start pagination
	$rec_count = $db->num_rows("transactions");
	$results = $db->query("
	SELECT 
		* 
	FROM 
		transactions t 
	INNER JOIN 
		my_players p 
	ON 
		t.player_id = p.myplayer_id 
	INNER JOIN 
		accounts a 
	ON 
		a.id = p.account_id 
	ORDER BY 
		p.myplayer_id DESC 
	LIMIT 50");
	$arrayTransactions = array();
	foreach($results['results'] as $transaction) {
		$arrayTransactions[] = $transaction;
	}
	//end pagination
	$db->disconnect();
?>