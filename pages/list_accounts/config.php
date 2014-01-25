<?php
	$db->connect();
	
	if(isset($uri[1])) {
		if(is_numeric($uri[1])) {
			$results = $db->query("SELECT * FROM `proxies` WHERE `proxy_id` = '$uri[1]'");
			if($results['rows'] > 0) {
				$results = $db->query("SELECT * FROM `accounts` WHERE `proxy_id` = '$uri[1]'");
				if($results['rows'] > 0) {
					$result = $db->query("SELECT * FROM `accounts` WHERE `proxy_id` = '$uri[1]'");
					$arrayAccounts = array();
					foreach($result['results'] as $accounts) {
						$arrayAccounts[] = $accounts;
					}
				} else {
					$rec_count = 0;
				}
			}
		}
	} else {
		$rec_count = 0;
	}
	
	$db->disconnect();
?>