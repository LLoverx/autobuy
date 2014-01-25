<?php
	require_once "files/core.php";
	
	$timestamp = time();
	$date = date("d.m.Y",$timestamp);
	$time = date("H:i:s",$timestamp);
	
	echo "Script started at: ".$date," - ",$time,"";
	echo "<br>-------------------------------------------------<br><br>";
	
	$db->connect();
	$result_query = $db->query("SELECT * FROM `accounts` WHERE `status` = '1'");
	$db->disconnect();
	
	$urls = array();
	foreach($result_query['results'] as $row) {
		$urls[] = Config::$site_url."buy.php?account=".$row['id'];
	}
	$db->disconnect();
	
	print_r($urls);
	
	$pg = new ParallelGet($urls);
	
	$timestamp = time();
	$date = date("d.m.Y",$timestamp);
	$time = date("H:i:s",$timestamp);
	echo "<br>-------------------------------------------------<br>";
	echo "Script ended at: ".$date," - ",$time,"<br>";
?>