<?php
	
	class Database {
		
		private static $db_info = null;
		private static $hostname = null;
		private static $username = null;
		private static $password = null;
		private static $database = null;
		
		
		/*
		* $_instance - instance of this class
		*/
		private static $_instance;
		
		/*
		* $databaseLink - holds the current connection
		*/
		private static $databaseLink = null;
		
		/*
		* $lastError - the latest error from the last mysql query
		*/
		private static $lastError = null;
		
		/*
		* $where - array of all ready where items
		*/
		private static $where = array();
		
		/*
		* $sql_query - holds the last query which was ran
		*/
		private static $sql_query = '';
		
		/*
		* $query_type - UPDATE/INSERT/SELECT type on which query is being ran
		*/
		private static $query_type = '';
		
		/*
		* $query_data - an array of data to be performed on the current query
		*/
		private static $query_data = '';
		
		public function __construct() {
			self::$db_info = explode(" # ",Config::$db_settings);
			if(count(self::$db_info) == 4) {
				self::$hostname = self::$db_info[0];
				self::$username = self::$db_info[1];
				self::$password = self::$db_info[2];
				self::$database = self::$db_info[3];
			} else {
				die("Invalid parameters set for database connection");
			}
		}
		
		public static function instance() {
			if(!( self::$_instance instanceof self))
				self::$_instance = new self();

			return self::$_instance;
		}
		
		// $persistant (boolean) - Use persistant connection?
        	public function connect($persistant = false){
                	self::disconnect();
                	
                	if($persistant){
                        	self::$databaseLink = mysql_pconnect(self::$hostname, self::$username, self::$password);
                	}else{
                        	self::$databaseLink = mysql_connect(self::$hostname, self::$username, self::$password);
                	}
                
                	if(!self::$databaseLink){
                   		self::$lastError = 'Could not connect to server: ' . mysql_error(self::$databaseLink);
                        	return false;
                	}
                
                	if(!$this->UseDB()){
                      		 self::$lastError = 'Could not connect to database: ' . mysql_error(self::$databaseLink);
                        	 return false;
                	}
                	return true;
        	}
        	
        	public static function query($query) {
        		if(!self::$databaseLink) {
        			return false;
        		}
        		$perform = mysql_query($query, self::$databaseLink);
        		$results = array();
        		if($perform) {
        			while($row = mysql_fetch_assoc($perform)) {
        				$results[] = $row;
        			}	
        			self::_reset_cache();
        			return array("results" => $results, "rows" => mysql_affected_rows());
        		} else {
        			return false;
        		}
        	}
        	
        	public function get($table = '', $num_rows = false, $fields = array('*')) {
			if(!is_array($fields))
				$fields = array($fields);

			self::$sql_query = 'SELECT ' . implode( ', ', $fields ) . ' FROM ' . $table;
			self::_append_where_clause();
			$run_query = $this->query(self::$sql_query);
			self::_reset_cache();
			return $run_query['results'];
		}
		
		public function insert( $table = '', $data = array() ) {
			self::_set_query_type( 'INSERT' );
			self::$sql_query = 'INSERT INTO ' . $table;
			self::$query_data = $data;
			self::_build_insert_clause();
			$run_query = mysql_query(self::$sql_query, self::$databaseLink);
			if($run_query) {
				self::_reset_cache();
				return ( 0 < mysql_affected_rows()) ? mysql_insert_id() : false;
			} else {
				return false;
			}
		}
		
		public static function update( $table = '', $data = array() ) {
			self::_set_query_type( 'UPDATE' );
			self::$sql_query = 'UPDATE ' . $table . ' SET ';
			self::$query_data = $data;
			self::_build_update_clause();
			self::_append_where_clause();
			$run_query = mysql_query(self::$sql_query, self::$databaseLink);
			if($run_query) {
				self::_reset_cache();
				return ( 0 < mysql_affected_rows()) ? mysql_affected_rows() : true;
			} else {
				return false;
			}
		}
		
		public function num_rows( $table = '', $num_rows = false, $fields = array( '*' ) ) {
			if(!self::$databaseLink) {
        			return false;
        		}
			self::_set_query_type('GET');
			self::$sql_query = 'SELECT ' . implode( ', ', $fields ) . ' FROM ' . $table;
			self::_append_where_clause();
			$run_query = $this->query(self::$sql_query);
			self::_reset_cache();
			return $run_query['rows'];
		}
		
		private static function _append_where_clause() {
			if( empty( self::$where ) )
				return '';

			$clauses = array();
			foreach( self::$where as $field => $value ) {
				$clauses[] = "`".$field . "` = '".mysql_real_escape_string($value)."'";
			}
			self::$sql_query .= ' WHERE ' . implode( ' AND ', $clauses );
		}
		
		private static function _build_insert_clause() {
			if( 'INSERT' !== self::$query_type || empty( self::$query_data ) )
				return;

			$keys = array_keys( self::$query_data );
			$sql = array(); 
			foreach(self::$query_data as $row) {
    				$sql[] = '"'.mysql_real_escape_string($row).'"';
			}
			$clause = '(' . implode( ', ', $keys ) . ' ) VALUES ('.implode(',', $sql).')';
			self::$sql_query .= $clause;
		}
		
		private static function _build_update_clause() {
			if( 'UPDATE' !== self::$query_type || empty( self::$query_data ) )
				return;

			$keys = array_keys(self::$query_data);
			$sql = array(); 
			foreach(self::$query_data as $row => $value) {
    				$sql[] = "`".$row . "` = '".mysql_real_escape_string($value)."'";
			}
			$clause = implode( ', ', $sql );
			self::$sql_query .= $clause;
		}
        	
        	private static function _set_query_type( $type = '' ) {
			self::$query_type = $type;
		}
        	
        	public function disconnect() {
        		if(self::$databaseLink){
                        	@mysql_close(self::$databaseLink);
                	}
        	}
        	
        	public static function where($field = '', $value = '') {
			self::$where[$field] = $value;
		}
        	
        	private static function _reset_cache() {
			self::$sql_query = '';
			self::$query_type = '';
			self::$where = array();
			self::$query_data = array();
		}
        	
        	private static function UseDB() {
        		if(!mysql_select_db(self::$database, self::$databaseLink)){
                        	self::$lastError = 'Cannot select database: ' . mysql_error(self::$databaseLink);
                        	return false;
                	}else{
                        	return true;
                	}
        	}	
		
	}
	
?>