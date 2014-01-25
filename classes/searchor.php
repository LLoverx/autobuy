<?

	use Guzzle\Http\Client;
	use Guzzle\Plugin\Cookie\CookiePlugin;
	use Guzzle\Plugin\Cookie\CookieJar\ArrayCookieJar;
 
	class Searchor {
  
  		private $nuc;
		private $sess;
		private $phish;
		private $console;
		private $_cookieFile;
	
		//initialise the class
		public function __construct($console, $nuc, $sess, $phish, $cookie = false) {
			$this->nuc 	= $nuc;
			$this->sess 	= $sess;
			$this->phish 	= $phish;
			$this->console  = strtolower($console);
			if($cookie) {
				$this->_cookieFile = $cookie;
			}
						
		}
		
		public function getCredits() {
			$client = new Client(null);
			if($this->cookie) {
				$cookiePlugin = new CookiePlugin(new FileCookieJar($this->_cookieFile));
        			$client->addSubscriber($cookiePlugin);
			}
        		$client->setUserAgent("Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.62 Safari/537.36");
			switch($this->console) {
				case "ps3":
					$request = $client->post("https://utas.s2.fut.ea.com/ut/game/fifa14/user/credits");
				break;
				case "360":
					$request = $client->post("https://utas.fut.ea.com/ut/game/fifa14/user/credits");
				break;
				case "xbox360":
					$request = $client->post("https://utas.fut.ea.com/ut/game/fifa14/user/credits");
				break;
			}
 			$request->addHeader('Connection', 'keep-alive');
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
		
		public function clubSearch($start, $type, $level, $count) {
			$client = new Client(null);
			if($this->cookie) {
				$cookiePlugin = new CookiePlugin(new FileCookieJar($this->_cookieFile));
        			$client->addSubscriber($cookiePlugin);
			}
        		$client->setUserAgent("Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.62 Safari/537.36");
			switch($this->console) {
				case "ps3":
					$request = $client->post("https://utas.s2.fut.ea.com/ut/game/fifa14/club?start=".$start."&type=".$type."&count=".$count);
				break;
				case "360":
					$request = $client->post("https://utas.fut.ea.com/ut/game/fifa14/club?start=".$start."&type=".$type."&count=".$count);
				break;
				case "xbox360":
					$request = $client->post("https://utas.fut.ea.com/ut/game/fifa14/club?start=".$start."&type=".$type."&count=".$count);
				break;
			}
			$request->addHeader('Connection', 'keep-alive');
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
		
		public function clubContracts() {
			$client = new Client(null);
			if($this->cookie) {
				$cookiePlugin = new CookiePlugin(new FileCookieJar($this->_cookieFile));
        			$client->addSubscriber($cookiePlugin);
			}
        		$client->setUserAgent("Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.62 Safari/537.36");
			switch($this->console) {
				case "ps3":
					$request = $client->post("https://utas.s2.fut.ea.com/ut/game/fifa14/club/consumables/contracts");
				break;
				case "360":
					$request = $client->post("https://utas.fut.ea.com/ut/game/fifa14/club/consumables/contracts");
				break;
				case "xbox360":
					$request = $client->post("https://utas.fut.ea.com/ut/game/fifa14/club/consumables/contracts");
				break;
			}
			$request->addHeader('Connection', 'keep-alive');
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
		
		public function clubIds($count = 600, $type = 102) {
			$client = new Client(null);
			if($this->cookie) {
				$cookiePlugin = new CookiePlugin(new FileCookieJar($this->_cookieFile));
        			$client->addSubscriber($cookiePlugin);
			}
        		$client->setUserAgent("Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.62 Safari/537.36");
			switch($this->console) {
				case "ps3":
					$request = $client->post("https://utas.s2.fut.ea.com/ut/game/fifa14/clubItemIds?count=".$count."&type1=".$type);
				break;
				case "360":
					$request = $client->post("https://utas.fut.ea.com/ut/game/fifa14/clubItemIds?count=".$count."&type1=".$type);
				break;
				case "xbox360":
					$request = $client->post("https://utas.fut.ea.com/ut/game/fifa14/clubItemIds?count=".$count."&type1=".$type);
				break;
			}
			$request->addHeader('Connection', 'keep-alive');
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
		
		public function defplayersearch($maxbin, $minbin, $minbid, $maxbid, $playerid, $pos, $start = 0, $results = 16) {
			$client = new Client(null);
			if($this->cookie) {
				$cookiePlugin = new CookiePlugin(new FileCookieJar($this->_cookieFile));
        			$client->addSubscriber($cookiePlugin);
			}
        		$client->setUserAgent("Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.62 Safari/537.36");
        		switch($this->console) {
				case "ps3":
					$url = "https://utas.s2.fut.ea.com/ut/game/fifa14/transfermarket?";
				break;
				case "360":
					$url = "https://utas.fut.ea.com/ut/game/fifa14/transfermarket?";
				break;
			}
			$searchstring = "";
			if ($pos != "" && $pos != "any"){
                        	if ($pos == "defense" || $pos == "midfield" || $pos == "attacker"){
                                	$searchstring .= "&zone=$pos";
                        	}else{
                                	$searchstring .= "&pos=$pos";
                        	}
                	}
                	if ($playerid > 0) {
                		$searchstring .= "&maskedDefId=".$playerid;
                	}
                	if ($minbid > 0){
                        	$searchstring .= "&micr=$minbid";
                	}
                	if ($maxbid > 0){
                        	$searchstring .= "&macr=$maxbid";
                	}
                	if ($minbin > 0){
                        	$searchstring .= "&minb=$minbin";
                	}
                	if ($maxbin > 0){
                        	$searchstring .= "&maxb=$maxbin";
                	}
                	if ($playStyle > 0) {
                		$searchstring .= "&playStyle=$playStyle";
                	}
                	$search = $url . "type=player&start=$start&num=$results".$searchstring;
                	$request = $client->post($search);
			$request->addHeader('Connection', 'keep-alive');
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
		
		public function playerSearch($maxbid, $minbid, $results = 16, $playStyle = 250, $pos, $team, $league, $nation, $start, $level, $minbin, $maxbin, $playerid) {
			$client = new Client(null);
			if($this->cookie) {
				$cookiePlugin = new CookiePlugin(new FileCookieJar($this->_cookieFile));
        			$client->addSubscriber($cookiePlugin);
			}
        		$client->setUserAgent("Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.62 Safari/537.36");
        		switch($this->console) {
				case "ps3":
					$url = "https://utas.s2.fut.ea.com/ut/game/fifa14/transfermarket?";
				break;
				case "360":
					$url = "https://utas.fut.ea.com/ut/game/fifa14/transfermarket?";
				break;
			}
			$searchstring = "";
			if ($level != "" && $level != "any"){
                        	$searchstring .= "&lev=$level";
               		}
               		if ($pos != "" && $pos != "any"){
                        	if ($pos == "defense" || $pos == "midfield" || $pos == "attacker"){
                                	$searchstring .= "&zone=$pos";
                        	}else{
                                	$searchstring .= "&pos=$pos";
                        	}
                	}
                	if ($playerid > 0) {
                		$searchstring .= "&maskedDefId=".$playerid;
                	}
                	if ($nation > 0){
                        	$searchstring .= "&nat=$nation";
                	}
                	if ($league > 0){
                        	$searchstring .= "&leag=$league";
                	}
                	if ($team > 0){
                        	$searchstring .= "&team=$team";
                	}
                	if ($minbid > 0){
                        	$searchstring .= "&micr=$minbid";
                	}
                	if ($maxbid > 0){
                        	$searchstring .= "&macr=$maxbid";
                	}
                	if ($minbin > 0){
                        	$searchstring .= "&minb=$minbin";
                	}
                	if ($maxbin > 0){
                        	$searchstring .= "&maxb=$maxbin";
                	}
                	if ($playStyle > 0) {
                		$searchstring .= "&playStyle=$playStyle";
                	}
                	$search = $url . "type=player&start=$start&num=$results".$searchstring;
			$request = $client->post($search);
			$request->addHeader('Connection', 'keep-alive');
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
		
		public function clean_playerSearch($data) {
			$client = new Client(null);
			if($this->cookie) {
				$cookiePlugin = new CookiePlugin(new FileCookieJar($this->_cookieFile));
        			$client->addSubscriber($cookiePlugin);
			}
        		$client->setUserAgent("Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.62 Safari/537.36");
        		switch($this->console) {
				case "ps3":
					$url = "https://utas.s2.fut.ea.com/ut/game/fifa14/transfermarket?";
				break;
				case "360":
					$url = "https://utas.fut.ea.com/ut/game/fifa14/transfermarket?";
				break;
			}
			$searchstring = "";
			if ($data['level'] != "" && $data['level'] != "any"){
                        	$searchstring .= "&lev=".$data['level'];
               		}
               		if ($data['pos'] != "" && $data['pos'] != "any"){
                        	if ($data['pos'] == "defense" || $data['pos'] == "midfield" || $data['pos'] == "attacker"){
                                	$searchstring .= "&zone=".$data['pos'];
                        	}else{
                                	$searchstring .= "&pos=".$data['pos'];
                        	}
                	}
                	if ($data['nation'] > 0){
                        	$searchstring .= "&nat=".$data['nation'];
                	}
                	if ($data['league'] > 0){
                        	$searchstring .= "&leag=".$data['league'];
                	}
                	if ($data['team'] > 0){
                        	$searchstring .= "&team=".$data['team'];
                	}
                	if ($data['minbid'] > 0){
                        	$searchstring .= "&micr=".$data['minbid'];
                	}
                	if ($data['maxbid'] > 0){
                        	$searchstring .= "&macr=".$data['maxbid'];
                	}
                	if ($data['minbin'] > 0){
                        	$searchstring .= "&minb=".$data['minbin'];
                	}
                	if ($data['maxbin'] > 0){
                        	$searchstring .= "&maxb=".$data['maxbin'];
                	}
                	if ($data['playStyle'] > 0) {
                		$searchstring .= "&playStyle=".$data['playStyle'];
                	}
                	if ($data['start']) {
                		$start = $data['start'];
                	} else {
                		$start = 0;
                	}
                	if ($data['results']) {
                		$results = $data['results'];
                	} else {
                		$results = 16;
                	}
                	$search = $url . "type=player&start=$start&num=$results".$searchstring;
			$request = $client->post($search);
			$request->addHeader('Connection', 'keep-alive');
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
		
		public function Consumables($macr,$micr,$num = 15,$cat,$start,$lev,$minb,$maxb) {
			$client = new Client(null);
			if($this->cookie) {
				$cookiePlugin = new CookiePlugin(new FileCookieJar($this->_cookieFile));
        			$client->addSubscriber($cookiePlugin);
			}
        		$client->setUserAgent("Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.62 Safari/537.36");
			$url = "https://utas.fut.ea.com/ut/game/fifa14/transfermarket?";
			$searchstring = "";
			if ($lev != "" && $lev != "any"){
				$searchstring .= "&lev=$lev";
			}
			if ($cat != "" && $cat != "any"){
				$searchstring .= "&cat=$cat";
			}
			if ($micr > 0){
				$searchstring .= "&micr=$micr";//min bid
			}
			if ($macr > 0){
				$searchstring .= "&macr=$macr";//max bid
			}
			if ($minb > 0){
				$searchstring .= "&minb=$minb";
			}
			if ($maxb > 0){
				$searchstring .= "&maxb=$maxb";
			}
			$search = $url . "type=development&blank=10&start=$start&num=$num" . $searchstring;
			$request = $client->post($search);
			$request->addHeader('Connection', 'keep-alive');
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
			
		public function Chemistry($macr,$micr,$num,$cat,$start,$lev,$minb,$maxb,$style) {
			$client = new Client(null);
			if($this->cookie) {
				$cookiePlugin = new CookiePlugin(new FileCookieJar($this->_cookieFile));
        			$client->addSubscriber($cookiePlugin);
			}
        		$client->setUserAgent("Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.62 Safari/537.36");	
			$url = "https://utas.fut.ea.com/ut/game/fifa14/transfermarket?";
			$searchstring = "";
			if ($lev != "" && $lev != "any"){
				$searchstring .= "&lev=$lev";
			}
			if ($cat != "" && $cat != "any"){
				$searchstring .= "&cat=$cat";
			}
			if ($micr > 0){
				$searchstring .= "&micr=$micr";//min bid
			}
			if ($macr > 0){
				$searchstring .= "&macr=$macr";//max bid
			}
			if ($minb > 0){
				$searchstring .= "&minb=$minb";
			}
			if ($maxb > 0){
				$searchstring .= "&maxb=$maxb";
			}
			$search = $url . "type=training&playStyle=$style&start=$start&num=$num" . $searchstring;
			$request = $client->post($search);
			$request->addHeader('Connection', 'keep-alive');
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
		
		public function prices($data) {
			global $db;
			$changeresult = 0;
			$change = 0;
			$pricearray = array();
			$playstyle = $data['playStyle'];
			$position = $data['position'];
			$team = $data['team'];
			$nationality = $data['nationality'];
			$level = $data['level'];
			$rating = $data['rating'];
			$start = 0;
			do{
				$search = $this->playerSearch(0,0,16,$playstyle,$position,$team,0,$nationality,$start,$level,$minBIN,$maxBIN);
				$count = count($search['auctionInfo']);
				if($count > 0) {
					foreach($search['auctionInfo'] as $auctionInfo){
						if($auctionInfo['itemData']['rating'] == $rating) {
							if($auctionInfo['buyNowPrice'] != 0) {
								$pricearray[] = $auctionInfo['buyNowPrice'];
							}
						}
					}
				}
				$this->getCredits();
				$start = $start + 15;
			} while($count > 0);
			sort($pricearray);
			if($pricearray[0]>10000 AND $pricearray[0]<50000){
				$sell_bid = $pricearray[0] - 250;
			} elseif($pricearray[0]>50000 AND $pricearray[0]<100000){
				$sell_bid = $pricearray[0] - 500;
			} else{
				$sell_bid = $pricearray[0] - 100;
			}
			$buy_bin = $pricearray[0] - 1000;
			if($pricearray[0]>=10000){
				$buy_bin = $buy_bin-1000;
				if($pricearray[0]>=20000){
					$buy_bin = $buy_bin-1000;
					if($pricearray[0]>=30000){
						$buy_bin = $buy_bin-1000;
					}
					if($pricearray[0]>=40000){
						$buy_bin = $buy_bin-1000;
					}
					if($pricearray[0]>=50000){
						$buy_bin = $buy_bin-750;
					}
					if($pricearray[0]>=60000){
						$buy_bin = $buy_bin-500;
					}
					if($pricearray[0]>=70000){
						$buy_bin = $buy_bin-500;
					}
				}	
			}
			if(count($pricearray)>5){
				if($sell_bid > 0){
					return array(
						"status" => "200",
						"sell_bin" => $pricearray[0], 
						"sell_bid" => $sell_bid, 
						"buy_bin" => $buy_bin
					);
				} else { return array("status" => "401"); }
			} else { return array("status" => "401"); }
		}
							
	}
	
?>