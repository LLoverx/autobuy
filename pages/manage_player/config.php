<?
	$db->connect();
	$db->where("myplayer_id", $uri[1]);
	$result = $db->get("my_players");
	$db->disconnect();
	
	if(count($result) == 0) {
		die("Invalid player ID");
	}
	
	$player_datails = $result[0];
?>