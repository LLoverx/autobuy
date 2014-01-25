<?php
	/*
	* @filename : ajax_functions.php
	* @description : holds all the AJAX functions
	* @requirements : must call die() at end of function
	*/
	
	/*
	* admin login via AJAX Request
	*/
		function ajax_login($data) {
			global $db;
			session_start();
			$db->connect();
			$db->where("email", $data['email']);
			$db->where("password", md5($data['password']));
			if($db->num_rows("admin") > 0) {
				$db->where("email",$data['email']);
				$info = $db->get("admin");
				$_SESSION['id'] = $info[0]['id'];
				$_SESSION['email'] = $info[0]['email'];
				echo "1";
			} else { echo "2"; } 
			$db->disconnect();
			die();
		}
		
	/*
	* add ea account using AJAX Request
	*/
		function ajax_submitAccount($data) {
			global $db, $hashor;
			$cookie = Config::$root_path."cookies/".base64_encode(urldecode($data['email'])).".txt";
			$loginDetails = array(
    				"username" => urldecode($data['email']),
    				"password" => urldecode($data['password']),
    				"hash" => $hashor->eaEncode(urldecode($data['secret'])),
    				"platform" => urldecode($data['console']),
			);
			
			$con = new Connector($loginDetails, $cookie);
			$connection = @$con->connect();
			if(is_array($connection)) {
				if($connection['nucleusId'] !== "") {
					$db->connect();
					$insert_array = array(
						"email" => $data['email'],
						"password" => $data['password'],
						"secret" => $data['secret'],
						"platform" => $data['console'],
						"phishingToken" => $connection['phishingToken'],
						"sessionId" => $connection['sessionId'],
						"personaName" => $connection['userAccounts']['userAccountInfo']['personas'][0]['personaName'],
						"nucleusId" => $connection['nucleusId'],
						"coins" => "0",
						"date_added" => date("Y-m-d H:i:s"),
						"status" => "1"
					);
					if($db->insert("accounts", $insert_array)) {
						echo "1";
					} else {
						echo "3";
					}
					$db->disconnect();
				} else { echo "2"; } 
			} else { echo "2"; }
			die();
		}	
		
	/*
	* update a users credits via AJAX Request
	*/	
		function ajax_getCredits($data) {
			global $db, $hashor;
			$db->connect();
			$db->where("id", $data['account_id']);
			$account = $db->get("accounts");
			$db->disconnect();
			if(count($account) > 0) {
				$cookie = Config::$root_path."cookies/".base64_encode(urldecode($account[0]['email'])).".txt";
				$search = new Searchor($account[0]['platform'], $account[0]['nucleusId'], $account[0]['sessionId'], $account[0]['phishingToken'], $cookie);
				$credits = $search->getCredits();
				if($credits['code'] == 401) {
					echo "3";
				} else {
					if(array_key_exists("currencies",$credits)) {
						if(is_int($credits['currencies'][1]['finalFunds'])) {
							$db->connect();
							$update_array = array(
								"coins" => $credits['credits'],
								"last_update" => date("Y-m-d H:i:s")
							);
							$db->where("id", $account[0]['id']);
							if($db->update("accounts", $update_array)) {
								echo "1";
							} else {
								echo "2";
							}
							$db->disconnect();
						} else { echo "2"; }
					} else { echo "2"; }
				}
			}
			die();
		}
		
	/*
	* update a users EA session
	*/
		function ajax_resetSession($data) {
			global $db, $hashor;
			$db->connect();
			$db->where("id", $data['account_id']);
			$account = $db->get("accounts");
			$db->disconnect();
			if(count($account) > 0) {
				$cookie = Config::$root_path."cookies/".base64_encode(urldecode($account[0]['email'])).".txt";
				file_put_contents($cookie, "");
				$loginDetails = array(
    					"username" => urldecode($account[0]['email']),
    					"password" => urldecode($account[0]['password']),
    					"hash" => $hashor->eaEncode(urldecode($account[0]['secret'])),
    					"platform" => $account[0]['email']
				);
				$con = new Connector($loginDetails, $cookie);
				$connection = @$con->connect();
				if(is_array($connection)) {
					if($connection['nucleusId'] !== "") {
						$db->connect();
						$update_array = array(
							"phishingToken" => $connection['phishingToken'],
							"sessionId" => $connection['sessionId'],
							"personaName" => $connection['userAccounts']['userAccountInfo']['personas'][0]['personaName'],
							"nucleusId" => $connection['nucleusId'],
							"last_update" => date("Y-m-d H:i:s")
						);	
						$db->where("id", $data['account_id']);
						if($db->update("accounts", $update_array)) {
							echo "1";
						} else {
							echo "3";
						}
						$db->disconnect();
					} else { echo "2"; }
				} else { echo "2"; }
			} else { echo "4"; }
			die();
		}
		
	/*
	* add player via AJAX Request
	*/
	
		function ajax_submitPlayer($data) {
			global $db;
			$vars = array();
			parse_str($data['info'], $vars);
			$vars['player_added'] = date("Y-m-d H:i:s");
			if($vars['sell_bin']>10000 AND $vars['sell_bin']<50000){
				$vars['sell_bid'] = $vars['sell_bin'] - 250;
			} elseif($vars['sell_bin']>50000 AND $vars['sell_bin']<100000){
				$vars['sell_bid'] = $vars['sell_bin'] - 500;
			} else{
				$vars['sell_bid'] = $vars['sell_bin'] - 100;
			}
			$db->connect();
			if($db->insert("my_players", $vars)) {
				echo "1";
			} else {
				echo "3";
			}
			$db->disconnect();
			die();
		}
	
	/*
	* find auctions for a player
	*/
		function ajax_getPlayer($data) {
			global $db, $functions;
			
			//details
			$db->connect();
			$db->where("price_update_account", "1");
			$db->where("platform", $data['console']);
			$result = $db->get("accounts");
			$db->disconnect();
			
			if(count($result) == 0) {
				echo "
				<tr>
					<td colspan='7'>No account with `price_update_account` value 1</td>
				</tr>
				";
				die();
			}
			
			$row = $result[0];
			define("PLATFORM", $row['platform']);
			
			//we call the eaEncode function from the EAHashor file
			$cookie = Config::$root_path."cookies/".base64_encode(urldecode($row['email'])).".txt";
			$search = new Searchor($row['platform'], $row['nucleusId'], $row['sessionId'], $row['phishingToken'], $cookie);
			$credits = $search->getCredits();
			switch($credits['code']) {
				case 401:
					echo "
        				<tr>
        					<td colspan='7'>Session expired on search account</td>
        				</tr>	
        				";
					die();
				break;
			}
			$level = $data['level'];
			$id = $data['id'];
			$rating = $data['rating'];
			$nation = $data['nation'];
			$club = $data['club'];
			$position = $data['position'];
			$start = 0;
			$auctions = array();
			do{
				$searchAuctions = $search->playerSearch(0,0,16,0,$position,$club,0,$nation,$start,$level,0,0);
				$count = count($searchAuctions['auctionInfo']);
				if($count > 0) {
					$auctions[] = array_merge($auctions, $searchAuctions['auctionInfo']);
				}
				$start = $start + 16;
			} while($count > 0);
        		if(!empty($auctions[0])) {
        			usort($auctions[0], function($a, $b) { return $a['buyNowPrice'] > $b['buyNowPrice'] ? 1 : -1; });
        			foreach($auctions[0] as $row) {
        				if($rating == $row['itemData']['rating']) {
        					if($id == $row['itemData']['assetId']) {
        						if($row['buyNowPrice'] > 0) {
        							echo "
        							<tr id=".$row['tradeId'].">
        								<td>".strtoupper(PLATFORM)."</td>
        								<td>".$functions->playStyle($row['itemData']['playStyle'])."</td>
        								<td>".$row['itemData']['preferredPosition']."</td>
        								<td>".number_format($row['startingBid'])."</td>
        								<td>".number_format($row['currentBid'])."</td>
        								<td>".$functions->secondsToWords($row['expires'])."</td>
        								<td>".number_format($row['buyNowPrice'])."</td>
        		      	       	       	     		</tr>";
        		      	       	 		}
        		      	       	 	}
        		      	       	 }
				}
        		} else {
        			echo "
        			<tr>
        				<td colspan='7'>No auctions found</td>
        			</tr>	
        			";
        		}
			die();
		}
		
	/*
	* update player settings
	*/
		
		function ajax_updatePlayer($data) {
			global $db;
			$vars = array();
			parse_str($data['data'], $vars);
			$db->connect();
			$db->where("myplayer_id", $vars['myplayer_id']);
			if($db->update("my_players", $vars)) {
				echo "1";
			} else {
				echo "2";
			}
			$db->disconnect();
			die();
		}
?>