<?php

	$timestamp = time();
	$date = date("d.m.Y",$timestamp);
	$time = date("H:i:s",$timestamp);
	echo "Script started at: ".$date," - ",$time;
	echo "<br>-------------------------------------------------<br><br>";
	
	ini_set('max_execution_time', 0);
	require "files/core.php";
	
	//Login
	$user = $_REQUEST['account'];
	$db->connect();
	$db->where("id", $user);
	$db->where('status',1);
	$user_info = $db->get("accounts");
	$db->disconnect();
	
	if(count($user_info) < 1) {
		die("No valid account");
	}
	
	$account = $user_info[0];
	
	$cookie = Config::$root_path."cookies/".base64_encode(urldecode($account['email'])).".txt";
	$search = new Searchor($account['platform'], $account['nucleusId'], $account['sessionId'], $account['phishingToken'], $cookie);
	
	$credits = $search->getCredits();
	switch($credits['code']) {
		case 401:
			die("Session expired");
		break;
	}
	
	if($account['phishingToken'] == "") {
		die("Login invalid for ".$user);
	} else {
		$cookie = Config::$root_path."cookies/".base64_encode($account['email']).".txt";
		$trade = new Trade($account['platform'], $account['nucleusId'], $account['sessionId'], $account['phishingToken'], $cookie);
	
		//relist/remove players for tradepile
		$trade->sortItemlist();
		
		//grab platers to search
		$db->connect();
		
		// get player limit
		$last_checked = $db->get("last_player_checked");
		
		if($last_checked[0]['player_id'] == 0){
			$limit_id = 0;
			$limit_id_next = 5;
		}else{
			$limit_id = $last_checked[0]['player_id'];
			$limit_id_next = $limit_id+5;
		}
		
		$offset = $limit_id+5;
						
		$result2 = $db->query("SELECT * FROM `my_players` WHERE `player_status` = '1' AND `account_id` = '".$user."' ORDER BY myplayer_id LIMIT $limit_id,5");
		
		
		// trade info
		$tradeinfo = $trade->getWatchList();
		
		/*echo '<pre>';
		print_r($tradeinfo);
		echo '</pre>';
		
		exit;
		*/
		/*echo '<pre>';
		print_r($result2['results']);
		echo '</pre>';
		exit;
		*/
		
		if(!$result2['results']){
			$update_array = array(
				"player_id" => 0
			);
			$db->update("last_player_checked", $update_array);
		}else{
			$update_array = array(
				"player_id" => $limit_id_next
			);
			$db->update("last_player_checked", $update_array);
		}
		
		$db->disconnect();
	}
	//Update earnings to database
	$trade->updateEarnings();
		
	if(count($result2['results']) < 1) {
		die("No players to purchase");
	}
	
	foreach($result2['results'] as $row2) {
		print_r($row2);
		//Check whether account has too many players to act
		$itemslist = $trade->getItemslist();
		if(count($itemslist) < $account['tradepile_limit']){
			//Account not full!
			//Select players from tradepile
			$playerCount = $trade->playerCount($row2['player_id'],$row2['player_rating'],$row2['player_style']);
			$count = $playerCount[$row2['player_id']][$row2['player_rating']][$row2['player_style']];
			
			if($count == null){
				$count = 0; 
			}
						
			if($count < 3 AND $row2['max_bin'] >= 500){
				
				$search = new Searchor($account['platform'], $account['nucleusId'], $account['sessionId'], $account['phishingToken'], $cookie);
				$start = 0;
				$counter = 0;
				
				do{
					$maxbiden = $row2['max_bin']-50;
					usleep(4500);
					$data_array = array(
						"start" => $start,
						"results" => "10",
						"level" => $row2['player_level'],
						"pos" => $row2['player_pos'],
						"nation" => $row2['player_nationid'],
						"team" => $row2['player_clubid'],
						"minbid" => 150,
						"maxbid" => $maxbiden
					);
					$playersearch = $search->clean_playerSearch($data_array);
					
					echo "Player search for ".$row2['player_name']."<br><hr>";
					//echo '<pre>';
					//print_r($playersearch);
					//echo '</pre>';
					//var_dump($playersearch);
					echo "<br/><br/><br/><hr>";
					flush();
					
					$counter++;
										
					if(!empty($playersearch['auctionInfo'])) {
						/*echo '<pre>';
						print_r($playersearch['auctionInfo']);
						echo '</pre>';
						*/
						foreach($playersearch['auctionInfo'] as $auctionInfo){
							//print_r($auctionInfo);
							if($auctionInfo['itemData']['assetId'] == $row2['player_id']){
								$playerCount = $trade->playerCount($row2['player_id'],$row2['player_rating'],$row2['player_style']);
								$count = $playerCount[$row2['player_id']][$row2['player_rating']][$row2['player_style']];
								echo $count;
								if($count < 3){
									if($auctionInfo['itemData']['rating'] == $row2['player_rating'] && $auctionInfo['expires'] < 80000) {
										$buy = $trade->trade($auctionInfo['tradeId']);
										$bin = $auctionInfo['buyNowPrice'];
										//echo 'bid';
										$bid = $trade->Bid($auctionInfo['tradeId'], $row2['max_bin']);										
										
										if($bid['code'] == 470){
											echo 'Script stopped: Not enough Money';
										} elseif($bid['auctionInfo'][0]['tradeState'] == "closed") {
											$id = $auctionInfo['itemData']['id'];
											$timestamp = date("Y-m-d H:i:s");
											$functions->addTrade($id,$row2['myplayer_id'],$timestamp,$bin,$user);
											$trade->sortItemlist();
											
											echo 'BID!!!!!!!';

										} else {
										//invalid purchase
										}
									}
								}
								else{
									echo "Too many players available";
								}
							}else{
								echo 'Not player id';
							}
						}
					}else{
						echo 'empty auction info';
					}
					$search->getCredits();
					$start = $start+10;
				}
				while($counter < 1);
				
			}else{
				echo 'mindre';
			}
		}else{
			echo 'Add to trade pile';
		}
	}
		
	$timestamp = time();
	$date = date("d.m.Y",$timestamp);
	$time = date("H:i:s",$timestamp);
	echo "<br><br>-------------------------------------------------<br>";
	echo "Script ended at: ".$date," - ",$time,"<br>";
?>