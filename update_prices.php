<?php
	ini_set('max_execution_time', 0);

	require "files/core.php";
	require "files/core_functions.php";
	
	//details
	$db->connect();
	$db->where("price_update_account", "1");
	$result = $db->get("accounts");
	$db->disconnect();
	$row = $result[0];
	
	$cookie = Config::$root_path."cookies/".base64_encode(urldecode($row['email'])).".txt";
	$search = new Searchor($row['platform'], $row['nucleusId'], $row['sessionId'], $row['phishingToken'], $cookie);
	
	$credits = $search->getCredits();
	
	switch($credits['code']) {
		case 401:
			die("Session Expired");
		break;
	}
	
	$db->connect();
	$run_query = $db->query("
	SELECT
		*
	FROM
		`my_players`
	WHERE
		`price_update` = '1'
	AND
		`last_price_update` < DATE_SUB(NOW(), INTERVAL ".Config::$check_interval." MINUTE)
	AND
		`player_status` = '1'
	LIMIT
		10
	");
	
	$db->disconnect();
	
	if($run_query['rows'] == 0) {
		die("no players need to be updated");
	}	
	
	foreach($run_query['results'] as $row) {
		$data = array(
			"resourceId" => "0",
			"start" => "0",
			"end" => "16",
			"level" => $row['player_level'],
			"playStyle" => $row['player_style'],
			"position" => $row['player_pos'],
			"nationality" => $row['player_nationid'],
			"rating" => $row['player_rating'],
			"league" => "0",
			"team" => $row['player_clubid'],
			"minBid" => "0",
			"maxBid" => "0",
			"minBIN" => "0",
			"maxBIN" => $row['sell_bin']
		);
		$sell_bin = $search->prices($data);
		if($sell_bin['status'] == "200") {
			$db->connect();
			$update_array = array(
				"max_bin" => $sell_bin['buy_bin'],
				"sell_bid" => $sell_bin['sell_bid'],
				"sell_bin" => $sell_bin['sell_bin'],
				"last_price_update" => date("Y-m-d H:i:s")
			);
			$db->where("myplayer_id", $row['myplayer_id']);
			$db->update("my_players", $update_array);
			$db->disconnect();
		}
   	}
?>