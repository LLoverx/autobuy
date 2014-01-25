<?php
	$db->connect();
	
	//start pagination
	$rec_count = $db->num_rows("my_players");
	$results = $db->query("SELECT * FROM my_players p JOIN accounts a ON p.account_id = a.id ORDER BY player_added DESC");
	$arrayPlayers = array();
	foreach($results['results'] as $players) {
		$arrayPlayers[] = $players;
	}
	//end pagination
	$db->disconnect();
?>