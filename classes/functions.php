<?php
	
	class Functions {
		
		public function newTime($datetime) {
			$date = new DateTime($datetime);
			//$date->modify("-5 hours");
			return $date->format('jS \of F Y h:i:s A');
		}
		
		public function secondsToWords($seconds){
    			$ret = "";

    			/*** get the days ***/
    			$days = intval(intval($seconds) / (3600*24));
    			if($days> 0){
        			$ret .= "$days days ";
    			}

    			/*** get the hours ***/
    			$hours = (intval($seconds) / 3600) % 24;
    			if($hours > 0){
        			$ret .= "$hours hours ";
    			}

    			/*** get the minutes ***/
    			$minutes = (intval($seconds) / 60) % 60;
    			if($minutes > 0){
        			$ret .= "$minutes minutes ";
    			}

    			/*** get the seconds ***/
    			$seconds = intval($seconds) % 60;
    			if ($seconds > 0) {
        			$ret .= "$seconds seconds";
    			}

    			return $ret;
		}
		
		public function playStyle($id) {
			switch($id) {
				case "250":
					return "Basic";
				break;
				case "251":
					return "Sniper";
				break;
				case "252":
					return "Finisher";
				break;
				case "253":
					return "Deadeye";
				break;
				case "254":
					return "Marksman";
				break;
				case "255":
					return "Hawk";
				break;
				case "256":
					return "Artist";
				break;
				case "257":
					return "Architect";
				break;
				case "258":
					return "Powerhouse";
				break;
				case "259":
					return "Maestro";
				break;
				case "260":
					return "Engine";
				break;
				case "261":
					return "Sentinel";
				break;
				case "262":
					return "Guardian";
				break;
				case "263":
					return "Gladiator";
				break;
				case "264":
					return "Backbone";
				break;
				case "265":
					return "Anchor";
				break;
				case "266":
					return "Hunter";
				break;
				case "267":
					return "Catalyst";
				break;
				case "268":
					return "Shadow";
				break;
				case "269":
					return "Wall";
				break;
				case "270":
					return "Sheild";
				break;
				case "271":
					return "Cat";
				break;
				case "272":
					return "Glove";
				break;
				case "273":
					return "GK Basic";
				break;
			}
		}
	
		
		public function addTrade($id,$playerID,$timestamp,$bin,$user) {
			global $db;
			$data['player_id'] = $playerID;
			$data['card_id'] = $id;
			$data['buy_bin'] = $bin;
			$data['sell_bin'] = '0';
			$data['listed_time'] = date("Y-m-d H:i:s");
			$db->connect();
			$primary_id = $db->insert("transactions", $data);
			$db->disconnect();
			if($primary_id > 0) {
				return $primary_id;
			} else {
				return false;
			}
		}
		
	}
	
?>