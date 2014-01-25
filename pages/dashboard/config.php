<?php
	$db->connect();
	
	//active players
	$grab_active_players = $db->query("SELECT * FROM `my_players` WHERE `player_status` = '1'");
	
	//active accounts
	$grab_active_accounts = $db->query("SELECT * FROM `accounts` WHERE `status` = '1'");
	
	//total buys
	$grab_total_buys = $db->query("SELECT * FROM `transactions`");
	
	//total sales
	$grab_total_sales = $db->query("SELECT * FROM `transactions` WHERE `sold_time` != '0000-00-00 00:00:00'");
	
	//last 50 added players
	$last_50_players = $db->query("SELECT * FROM my_players p JOIN accounts a ON p.account_id = a.id ORDER BY p.myplayer_id DESC LIMIT 50");
	
	$db->disconnect();
?>