<?php
	$uri = explode("/",substr($_SERVER['REQUEST_URI'],1));
	if((isset($uri[0])) && ($uri[0]!="")) {$page = $uri[0];} else {$page = "dashboard";}
	if(isset($_SESSION['id'])) {
		switch($page) {
			case "login":
				$page = "dashboard";
			break;
			case "register":
				$page = "dashboard";
			break;
			case "logout":
				unset($_SESSION['email']);
				unset($_SESSION['id']);
				header("Location: http://".$_SERVER['SERVER_NAME']."/login");
			break;
		}
	}
	
	if(!isset($_SESSION['id'])) {
		switch($page) {
			case "login":
				$page = "login";
			break;
			case "register":
				$page = "register";
			break;
			default:
				$page = "login";
			break;
		}
	}
?>