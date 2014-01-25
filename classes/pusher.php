<?php

	class PusherInstance {
	
		private static $instance = null;
		private static $app_id  = '';
		private static $secret  = '';
		private static $api_key = '';
	
		private function __construct() { }
		private function __clone() { }
	
		public static function get_pusher() {
			if (self::$instance !== null) return self::$instance;
			self::$instance = new Pusher(
				self::$api_key, 
				self::$secret, 
				self::$app_id
			);
			return self::$instance;
		}
	}

	class Pusher {

		private $settings = array ();
	
		public function __construct( $auth_key, $secret, $app_id, $debug = false) {
			// Check compatibility, disable for speed improvement
			$this->check_compatibility();

			// Setup defaults
			$this->settings['server']	= "http://api.pusherapp.com";
			$this->settings['port']		= "80";
			$this->settings['auth_key']	= $auth_key;
			$this->settings['secret']	= $secret;
			$this->settings['app_id']	= $app_id;
			$this->settings['url']		= '/apps/' . $this->settings['app_id'];
			$this->settings['debug']	= $debug;
			$this->settings['timeout']	= "30";
		}

		/**
		* Check if the current PHP setup is sufficient to run this class
		*/
		private function check_compatibility() {
			// Check for dependent PHP extensions (JSON, cURL)
			if(!extension_loaded('curl') || ! extension_loaded('json')) {
				die('There is missing dependant extensions - please ensure both cURL and JSON modules are installed');
			}
			
			if(!in_array('sha256', hash_algos())) {
				die('SHA256 appears to be unsupported - make sure you have support for it, or upgrade your version of PHP.');
			}
		}

		/**
		* Trigger an event by providing event name and payload. 
		* Optionally provide a socket ID to exclude a client (most likely the sender).
		* 
		* @param string $event
		* @param mixed $payload
		* @param int $socket_id [optional]
		* @param string $channel [optional]
		* @param bool $debug [optional]
		* @return bool|string
		*/
		public function trigger($channel, $event, $payload, $socket_id = null, $debug = false, $already_encoded = false) {

			# Check if we can initialize a cURL connection
			$ch = curl_init();
			if($ch === false) {
				die('Could not initialise cURL!');
			}

			# Add channel to URL..
			$s_url = $this->settings['url'] . '/channels/' . $channel . '/events';

			# Build the request
			$signature = "POST\n" . $s_url . "\n";
			$payload_encoded = $already_encoded ? $payload : json_encode( $payload );
			$query = "auth_key=" . $this->settings['auth_key'] . "&auth_timestamp=" . time() . "&auth_version=1.0&body_md5=" . md5( $payload_encoded ) . "&name=" . $event;

			# Socket ID set?
			if($socket_id !== null) {
				$query .= "&socket_id=" . $socket_id;
			}

			# Create the signed signature...
			$auth_signature = hash_hmac( 'sha256', $signature . $query, $this->settings['secret'], false );
			$signed_query = $query . "&auth_signature=" . $auth_signature;
			$full_url = $this->settings['server'] . ':' . $this->settings['port'] . $s_url . '?' . $signed_query;

			# Set cURL opts and execute request
			curl_setopt( $ch, CURLOPT_URL, $full_url );
			curl_setopt( $ch, CURLOPT_HTTPHEADER, array ( "Content-Type: application/json" ) );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt( $ch, CURLOPT_POST, 1 );
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload_encoded );
			curl_setopt( $ch, CURLOPT_TIMEOUT, $this->settings['timeout'] );

			$response = curl_exec($ch);

			curl_close($ch);

			if ($response == "202 ACCEPTED\n" && $debug == false) {
				return true;
			} elseif($debug == true || $this->settings['debug'] == true) {
				return $response;
			} else {
				return false;
			}

		}
	}
?>