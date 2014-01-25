<?php

	class Config {
		
		/*
		* Global settings
		*/
		public static $debug = "no";
		public static $log_file = "/home/curtu26/projects/fut/files/log.my";
		public static $root_path = "/Applications/MAMP/htdocs/autobuy/";
		public static $site_url = "http://autobuy.dev/";
		
		/*
		* Database connection settings
		*/
		public static $db = "mysql";
		public static $db_settings = "localhost # root # root # autobuy";
		
		/*
		* Interval between each price update on players
		*/
		public static $check_interval = 50;
				
	}
	
?>