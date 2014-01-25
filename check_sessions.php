<?php
	ini_set('max_execution_time', 0);

	require "files/core.php";
	
	//details
	$db->connect();
	$db->where('status',1);
	$result = $db->get("accounts");
	$db->disconnect();
	$checks = 0;
	
	do {
	
		foreach($result as $row) {
			$cookie = ROOT."/cookies/".base64_encode(urldecode($row['email'])).".txt";
			if(!file_exists($cookie)) {
				file_put_contents($cookie, "");
			}
			$cookie = Config::$root_path."cookies/".base64_encode(urldecode($row['email'])).".txt";
			$search = new Searchor($row['platform'], $row['nucleusId'], $row['sessionId'], $row['phishingToken'], $cookie);
			$credits = $search->getCredits();
			switch($credits['code']) {
				case 401:
					$cookie = Config::$root_path."cookies/".base64_encode(urldecode($row['email'])).".txt";
					file_put_contents($cookie, "");
					$loginDetails = array(
    						"username" => urldecode($row['email']),
    						"password" => urldecode($row['password']),
    						"hash" => $hashor->eaEncode(urldecode($row['secret'])),
    						"platform" => urldecode($row['platform']),
					);
					$con = new Connector($loginDetails, $cookie);
					$connection = $con->connect();
					if(is_array($connection)) {
						if($connection['nucleusId'] != "") {
							$update_array = array(
								"phishingToken" => $connection['phishingToken'],
								"sessionId" => $connection['sessionId'],
								"personaName" => $connection['userAccounts']['userAccountInfo']['personas'][0]['personaName'],
								"nucleusId" => $connection['nucleusId'],
								"last_update" => date("Y-m-d H:i:s")
							);	
							$db->connect();
							$db->where("id", $row['id']);
							$db->update("accounts", $update_array);
							$db->disconnect();
							die();
						}
					}
					echo "Session expired for : ".$row['personaName']." - ".date("Y-m-d H:i:s")."<br/><hr>";
				break;
				default:
					$update_array = array(
						"coins" => $credits['credits'],
						"last_update" => date("Y-m-d H:i:s")
					);
					$db->connect();
					$db->where("id", $row['id']);
					$db->update("accounts", $update_array);
					$db->disconnect();
					echo "Checked : ".$row['personaName']." - ".date("Y-m-d H:i:s")."<br/><hr>";
				break;
			}
			flush();
			sleep(rand(1,2));
			$checks++;
		}
	
	} while($checks < 25);
?>