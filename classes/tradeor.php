<?

	use Guzzle\Http\Client;
	use Guzzle\Plugin\Cookie\CookiePlugin;
	use Guzzle\Plugin\Cookie\CookieJar\FileCookieJar;
	
	class Trade {
		
		private $nuc;
		private $sess;
		private $phish;
		private $console;
	
		//initialise the class
		public function __construct($console, $nuc, $sess, $phish, $cookieFile = false) {
			$this->nuc 	= $nuc;
			$this->sess 	= $sess;
			$this->phish 	= $phish;
			$this->console  = strtolower($console);	
			
			if($cookieFile) {
				$this->_cookieFile = $cookieFile;	
			}	
		}
		
		public function Bid($tradeid,$bid) {
			$client = new Client(null);
			if($this->_cookieFile) {
				$cookiePlugin = new CookiePlugin(new FileCookieJar($this->_cookieFile));
        			$client->addSubscriber($cookiePlugin);
			}
        		$client->setUserAgent("Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.62 Safari/537.36");
			switch($this->console) {
				case "360":
					$url = "https://utas.fut.ea.com/ut/game/fifa14/trade/".$tradeid."/bid";
				break;
				case "ps3":
					$url = "https://utas.s2.fut.ea.com/ut/game/fifa14/trade/".$tradeid."/bid";
				break;
			}			
			$data_array = array('bid' => $bid);
        		$data_string = json_encode($data_array);
        		$request = $client->post($url, array(), $data_string);
 			$request->addHeader('Origin', 'http://www.easports.com');
			$request->setHeader('Referer', 'http://www.easports.com/iframe/fut/bundles/futweb/web/flash/FifaUltimateTeam.swf');
			$request->addHeader('X-HTTP-Method-Override', 'PUT');
			$request->addHeader('X-UT-Embed-Error', 'true');
			$request->addHeader('X-UT-PHISHING-TOKEN', $this->phish);				
			$request->addHeader('X-UT-SID', $this->sess);
			$request->setHeader('Content-Type', 'application/json');
			$request->addHeader('Content-Length', strlen($data_string));				
			$response = $request->send();
			$json = $response->json();
			return $json;
			
		}
		
		
		
		public function quicksell($id) {
			$client = new Client(null);
			if($this->_cookieFile) {
				$cookiePlugin = new CookiePlugin(new FileCookieJar($this->_cookieFile));
        			$client->addSubscriber($cookiePlugin);
			}
        		$client->setUserAgent("Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.62 Safari/537.36");
			switch($this->console) {
				case "360":
					$url = "https://utas.fut.ea.com/ut/game/fifa14/item/".$id;
				break;
				case "xbox360":
					$url = "https://utas.fut.ea.com/ut/game/fifa14/item/".$id;
				break;
				case "ps3":
					$url = "https://utas.s2.fut.ea.com/ut/game/fifa14/item/".$id;
				break;
			}			
        		$request = $client->post($url);
 			$request->addHeader('Origin', 'http://www.easports.com');
			$request->setHeader('Referer', 'http://www.easports.com/iframe/fut/bundles/futweb/web/flash/FifaUltimateTeam.swf');
			$request->addHeader('X-HTTP-Method-Override', 'DELETE');
			$request->addHeader('X-UT-Embed-Error', 'true');
			$request->addHeader('X-UT-PHISHING-TOKEN', $this->phish);				
			$request->addHeader('X-UT-SID', $this->sess);
			$request->setHeader('Content-Type', 'application/json');				
			$response = $request->send();
			$json = $response->json();

			return $json;
		}
		
		
		public function remove_expired($id) {
			$client = new Client(null);
			if($this->_cookieFile) {
				$cookiePlugin = new CookiePlugin(new FileCookieJar($this->_cookieFile));
        			$client->addSubscriber($cookiePlugin);
			}
        		$client->setUserAgent("Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.62 Safari/537.36");
			switch($this->console) {
				case "360":
					$url = "https://utas.fut.ea.com/ut/game/fifa14/watchlist?tradeId=".$id;
				break;
				case "xbox360":
					$url = "https://utas.fut.ea.com/ut/game/fifa14/item/".$id;
				break;
				case "ps3":
					$url = "https://utas.s2.fut.ea.com/ut/game/fifa14/watchlist?tradeId=".$id;
				break;
			}			
        		$request = $client->post($url);
 			$request->addHeader('Origin', 'http://www.easports.com');
			$request->setHeader('Referer', 'http://www.easports.com/iframe/fut/bundles/futweb/web/flash/FifaUltimateTeam.swf');
			$request->addHeader('X-HTTP-Method-Override', 'DELETE');
			$request->addHeader('X-UT-Embed-Error', 'true');
			$request->addHeader('X-UT-PHISHING-TOKEN', $this->phish);				
			$request->addHeader('X-UT-SID', $this->sess);
			$request->setHeader('Content-Type', 'application/json');				
			$response = $request->send();
			$json = $response->json();
			
			
			return $json;
		}
		
		public function sendClubTrade($resourceId, $pile = "trade") {
			$client = new Client(null);
			if($this->cookie) {
				$cookiePlugin = new CookiePlugin(new FileCookieJar($this->_cookieFile));
        			$client->addSubscriber($cookiePlugin);
			}
        		$client->setUserAgent("Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.62 Safari/537.36");
			switch($this->console) {
				case "ps3":
					$url = "https://utas.s2.fut.ea.com/ut/game/fifa14/item/resource";
				break;
				case "360":
					$url = "https://utas.fut.ea.com/ut/game/fifa14/item/resource";
				break;
				case "xbox360":
					$url = "https://utas.fut.ea.com/ut/game/fifa14/item/resource";
				break;
			}
			$data_array = array("itemData" => array(array("id" => $resourceId, "pile" => $pile)));
        		$data_string = json_encode($data_array);
        		$request = $client->post($url, array(), $data_string);
 			$request->addHeader('Origin', 'http://www.easports.com');
			$request->setHeader('Referer', 'http://www.easports.com/iframe/fut/bundles/futweb/web/flash/FifaUltimateTeam.swf');
			$request->addHeader('X-HTTP-Method-Override', 'PUT');
			$request->addHeader('X-UT-Embed-Error', 'true');
			$request->addHeader('X-UT-PHISHING-TOKEN', $this->phish);				
			$request->addHeader('X-UT-SID', $this->sess);
			$request->setHeader('Content-Type', 'application/json');
			$request->addHeader('Content-Length', strlen($data_string));				
			$response = $request->send();
			$json = $response->json();
			return $json;
		}
		
		public function sell($id,$bin,$startingBid,$duration) {
			$client = new Client(null);
			if($this->_cookieFile) {
				$cookiePlugin = new CookiePlugin(new FileCookieJar($this->_cookieFile));
        			$client->addSubscriber($cookiePlugin);
			}
        		$client->setUserAgent("Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.62 Safari/537.36");
			switch($this->console) {
				case "360":
					$url = "https://utas.fut.ea.com/ut/game/fifa14/auctionhouse";
				break;
				case "ps3":
					$url = "https://utas.s2.fut.ea.com/ut/game/fifa14/auctionhouse";
				break;
			}			
			$selldata = array("itemData" => array( "id" => $id), "buyNowPrice" => $bin, "startingBid" => $startingBid, "duration" => $duration);	
        		$data_string = json_encode($selldata);
        		$request = $client->post($url, array(), $data_string);
 			$request->addHeader('Origin', 'http://www.easports.com');
			$request->setHeader('Referer', 'http://www.easports.com/iframe/fut/bundles/futweb/web/flash/FifaUltimateTeam.swf');
			$request->addHeader('X-HTTP-Method-Override', 'POST');
			$request->addHeader('X-UT-Embed-Error', 'true');
			$request->addHeader('X-UT-PHISHING-TOKEN', $this->phish);				
			$request->addHeader('X-UT-SID', $this->sess);
			$request->setHeader('Content-Type', 'application/json');
			$request->addHeader('Content-Length', strlen($data_string));				
			$response = $request->send();
			$json = $response->json();
			return $json;
		}
		
		public function removeSold($id) {
			$client = new Client(null);
			if($this->_cookieFile) {
				$cookiePlugin = new CookiePlugin(new FileCookieJar($this->_cookieFile));
        			$client->addSubscriber($cookiePlugin);
			}
        		$client->setUserAgent("Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.62 Safari/537.36");
			switch($this->console) {
				case "360":
					$url = "https://utas.fut.ea.com/ut/game/fifa14/trade/".$id;
				break;
				case "xbox360":
					$url = "https://utas.fut.ea.com/ut/game/fifa14/trade/".$id;
				break;
				case "ps3":
					$url = "https://utas.s2.fut.ea.com/ut/game/fifa14/trade/".$id;
				break;
			}			
        		$request = $client->post($url);
 			$request->addHeader('Origin', 'http://www.easports.com');
			$request->setHeader('Referer', 'http://www.easports.com/iframe/fut/bundles/futweb/web/flash/FifaUltimateTeam.swf');
			$request->addHeader('X-HTTP-Method-Override', 'DELETE');
			$request->addHeader('X-UT-Embed-Error', 'true');
			$request->addHeader('X-UT-PHISHING-TOKEN', $this->phish);				
			$request->addHeader('X-UT-SID', $this->sess);
			$request->setHeader('Content-Type', 'application/json');				
			$response = $request->send();
			$json = $response->json();
			return $json;
		}
		
		public function trade($id) {
			$client = new Client(null);
			if($this->_cookieFile) {
				$cookiePlugin = new CookiePlugin(new FileCookieJar($this->_cookieFile));
        			$client->addSubscriber($cookiePlugin);
			}
        		$client->setUserAgent("Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.62 Safari/537.36");
			switch($this->console) {
				case "360":
					$url = "https://utas.fut.ea.com/ut/game/fifa14/trade?tradeIds=". $id;
				break;
				case "ps3":
					$url = "https://utas.s2.fut.ea.com/ut/game/fifa14/trade?tradeIds=". $id;
				break;
			}			
        		$request = $client->post($url);
 			$request->addHeader('Origin', 'http://www.easports.com');
			$request->setHeader('Referer', 'http://www.easports.com/iframe/fut/bundles/futweb/web/flash/FifaUltimateTeam.swf');
			$request->addHeader('X-HTTP-Method-Override', 'GET');
			$request->addHeader('X-UT-Embed-Error', 'true');
			$request->addHeader('X-UT-PHISHING-TOKEN', $this->phish);				
			$request->addHeader('X-UT-SID', $this->sess);
			$request->setHeader('Content-Type', 'application/json');				
			$response = $request->send();
			$json = $response->json();
			return $json;
		}
		
		public function setTradePile($cardid) {
			$client = new Client(null);
			if($this->_cookieFile) {
				$cookiePlugin = new CookiePlugin(new FileCookieJar($this->_cookieFile));
        			$client->addSubscriber($cookiePlugin);
			}
        		$client->setUserAgent("Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.62 Safari/537.36");
			switch($this->console) {
				case "360":
					$url = "https://utas.fut.ea.com/ut/game/fifa14/item";
				break;
				case "ps3":
					$url = "https://utas.s2.fut.ea.com/ut/game/fifa14/item";
				break;
			}			
			$data_array = array("itemData" => array(array("id" => $cardid, "pile" => "trade")));
        		$data_string = json_encode($data_array);
        		$request = $client->post($url, array(), $data_string);
 			$request->addHeader('Origin', 'http://www.easports.com');
			$request->setHeader('Referer', 'http://www.easports.com/iframe/fut/bundles/futweb/web/flash/FifaUltimateTeam.swf');
			$request->addHeader('X-HTTP-Method-Override', 'PUT');
			$request->addHeader('X-UT-Embed-Error', 'true');
			$request->addHeader('X-UT-PHISHING-TOKEN', $this->phish);				
			$request->addHeader('X-UT-SID', $this->sess);
			$request->setHeader('Content-Type', 'application/json');
			$request->addHeader('Content-Length', strlen($data_string));				
			$response = $request->send();
			$json = $response->json();
			return $json;
		}
		
		public function getItemslist() {
			$client = new Client(null);
			if($this->_cookieFile) {
				$cookiePlugin = new CookiePlugin(new FileCookieJar($this->_cookieFile));
        			$client->addSubscriber($cookiePlugin);
			}
        		$client->setUserAgent("Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.62 Safari/537.36");
			switch($this->console) {
				case "ps3":
					$request = $client->post("https://utas.s2.fut.ea.com/ut/game/fifa14/purchased/items");
				break;
				case "360":
					$request = $client->post("https://utas.fut.ea.com/ut/game/fifa14/purchased/items");
				break;
			}
 			$request->addHeader('Origin', 'http://www.easports.com');
			$request->setHeader('Referer', 'http://www.easports.com/iframe/fut/bundles/futweb/web/flash/FifaUltimateTeam.swf');
			$request->addHeader('X-HTTP-Method-Override', 'GET');
			$request->addHeader('X-UT-Embed-Error', 'true');
			$request->addHeader('X-UT-PHISHING-TOKEN', $this->phish);				
			$request->addHeader('X-UT-SID', $this->sess);	
			$response = $request->send();
			$json = $response->json();
			return $json;
		}
		
		public function getTradePile() {
			$client = new Client(null);
			if($this->_cookieFile) {
				$cookiePlugin = new CookiePlugin(new FileCookieJar($this->_cookieFile));
        			$client->addSubscriber($cookiePlugin);
			}
        		$client->setUserAgent("Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.62 Safari/537.36");
			switch($this->console) {
				case "ps3":
					$request = $client->post("https://utas.s2.fut.ea.com/ut/game/fifa14/tradepile");
				break;
				case "360":
					$request = $client->post("https://utas.fut.ea.com/ut/game/fifa14/tradepile");
				break;
			}
 			$request->addHeader('Origin', 'http://www.easports.com');
			$request->setHeader('Referer', 'http://www.easports.com/iframe/fut/bundles/futweb/web/flash/FifaUltimateTeam.swf');
			$request->addHeader('X-HTTP-Method-Override', 'GET');
			$request->addHeader('X-UT-Embed-Error', 'true');
			$request->addHeader('X-UT-PHISHING-TOKEN', $this->phish);				
			$request->addHeader('X-UT-SID', $this->sess);	
			$response = $request->send();
			$json = $response->json();
			return $json;
		}
		
		
		public function getWatchList() {
			$client = new Client(null);
			if($this->_cookieFile) {
				$cookiePlugin = new CookiePlugin(new FileCookieJar($this->_cookieFile));
        			$client->addSubscriber($cookiePlugin);
			}
        		$client->setUserAgent("Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.62 Safari/537.36");
			switch($this->console) {
				case "ps3":
					$request = $client->post("https://utas.s2.fut.ea.com/ut/game/fifa14/watchlist");
				break;
				case "360":
					$request = $client->post("https://utas.fut.ea.com/ut/game/fifa14/watchlist");
				break;
			}
 			$request->addHeader('Origin', 'http://www.easports.com');
			$request->setHeader('Referer', 'http://www.easports.com/iframe/fut/bundles/futweb/web/flash/FifaUltimateTeam.swf');
			$request->addHeader('X-HTTP-Method-Override', 'GET');
			$request->addHeader('X-UT-Embed-Error', 'true');
			$request->addHeader('X-UT-PHISHING-TOKEN', $this->phish);				
			$request->addHeader('X-UT-SID', $this->sess);	
			$response = $request->send();
			$json = $response->json();
			return $json;
		}
		
		public function sortItemlist(){
			global $db;
			$trade = $this->getItemslist();
			if(array_key_exists("code",$trade)) {
				return false;
			}
			foreach($trade['itemData'] as $itemList){
				$this->setTradePile($itemList['id']);
			}
			$getTradePile = $this->getWatchList();
			foreach($getTradePile['auctionInfo'] as $singleTradePile){
				
				if($singleTradePile['tradeState'] == null or $singleTradePile['tradeState'] == "expired"){
					//sell
					$id = $singleTradePile['itemData']['id'];
					
					$db->connect();
					//$db->where("player_style", $singleTradePile['itemData']['playStyle']);
					$db->where("player_pos", $singleTradePile['itemData']['preferredPosition']);
					$db->where("player_id", $singleTradePile['itemData']['assetId']);
					$db->where("player_rating", $singleTradePile['itemData']['rating']);
					$db_erg = $db->get("my_players");
					
					$db->disconnect();
					if(count($db_erg) > 0) {
						foreach($db_erg as $row) {
							//$this->sell($id, $row['sell_bin'], $row['sell_bid'], 3600);
							/*$this->quicksell($singleTradePile['tradeId']);
							
							$insertest = array(
								"content" => 'called quicksell'
							);
							$db->connect();
							$db->insert("test", $insertest);
							$db->disconnect();*/
							
						}
					} 

				} elseif($singleTradePile['tradeState'] == "closed"){
					
					if($singleTradePile['bidState'] == 'highest'){
						// quick sell
						
						$quicksell = $this->quicksell($singleTradePile['itemData']['id']);
													
						$insertest = array(
							"content" => 'called quicksell'
						);
						$db->connect();
						$db->insert("test", $insertest);
						$db->disconnect();
						
						
						// get player info
						$db->connect();
						$db->where('player_id',$singleTradePile['itemData']['assetId']);
						$get_playerinfo = $db->get("my_players");
						$db->disconnect();
						
						if($get_playerinfo){
							$rating = $get_playerinfo[0]['player_rating'];
							
							// calculate price
							$profit = $this->calculatePrice($rating);
							$sell_price = $profit+600;
							
						}else{
							$profit = 0;
							$sell_price = 0;
							$rating = 0;
						}
						
						$insertarray = array(
							"player_id" => $singleTradePile['itemData']['assetId'],
							"card_id" => $singleTradePile['itemData']['id'],
							"buy_bin" => 600,
							"sell_bin" => $sell_price,
							"profit" => $profit,
							"sold_time" => date("Y-m-d H:i:s"),
							"status" => 1,
							"rating" => $rating,
							"test" => $singleTradePile['itemData']['assetId']
						);
						$db->connect();
						$db->insert("transactions", $insertarray);
						$db->disconnect();
						
					}else{
					
						//remove sold
						$this->removeSold($singleTradePile['tradeId']);
						
						$insertest = array(
							"content" => 'called removesold'
						);
						$db->connect();
						$db->insert("test", $insertest);
						$db->disconnect();
						
					}
					
								
				}
				
				$this->remove_expired($singleTradePile['tradeId']);
				
			}
			unset($id, $resourceId, $price, $timestamp, $db_erg);
		}
		
		public function getFund($tradepile){
			global $db;
			$fund = 0;
			if(count($tradepile['auctionInfo']) > 0) {
				foreach($tradepile['auctionInfo'] as $auctionInfo){
					$db->connect();
					//$db->where("player_style", $auctionInfo['itemData']['playStyle']);
					$db->where("player_pos", $auctionInfo['itemData']['preferredPosition']);
					$db->where("player_id", $auctionInfo['itemData']['assetId']);
					$db->where("player_rating", $auctionInfo['itemData']['rating']);
					$db_erg = $db->get("my_players");
					$db->disconnect();
					if(count($db_erg) > 0) {
						$fund = $fund + ($db_erg[0]['sell_bin']*0.95);
					}
				}
			}
			return $fund;
		}
		
		public function playerCount($assetId, $rating, $playStyle){
			$result = $this->getTradePile();
			foreach($result['auctionInfo'] as $playerInfo){
				$card_assetId = $playerInfo['itemData']['assetId'];
				$card_rating = $playerInfo['itemData']['rating'];
				$card_playstyle = $playerInfo['itemData']['playStyle'];
			
				if($player[$card_assetId][$card_rating][$card_playstyle]){
					$player[$card_assetId][$card_rating][$card_playstyle] = $player[$card_assetId][$card_rating][$card_playstyle]+1;
				} else {
					$player[$card_assetId][$card_rating][$card_playstyle]=1;
				}	
			}
			return $player;
		}
		
		public function updateEarnings() {
			global $db;
			$tradepile = $this->getTradePile();
			$tradepile_count = count($tradepile['auctionInfo']);
			$tradepile_value = $this->getFund($tradepile);
			$db->connect();
			$update_array = array(
				"tradepile_cards" => $tradepile_count,
				"tradepile_value" => $tradepile_value
			);
			$db->where("nucleusId", $this->nuc);
			$db->update("accounts", $update_array);
			$db->disconnect();
		}
		
		public function calculatePrice($rating){
			
			if($rating == 76){
				return 8;
			}elseif($rating == 77){
				return 16;
			}elseif($rating == 78){
				return 24;
			}elseif($rating == 79){
				return 32;
			}elseif($rating == 80){
				return 40;
			}elseif($rating == 81){
				return 48;
			}elseif($rating == 82){
				return 56;
			}elseif($rating == 83){
				return 64;
			}else{
				return 600;
			}
						
		}
		
	}

?>