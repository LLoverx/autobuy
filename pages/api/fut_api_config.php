<?php
	$url = 'http://curtiscrewe.co.uk/grabPlayers.php';
	$fields = array(
		'name' => urlencode($_GET['term']),
		'domain' => urlencode($_SERVER['SERVER_NAME']),
		'server_ip' => urlencode($_SERVER['SERVER_ADDR'])
	);

	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	rtrim($fields_string, '&');

	$ch = curl_init();

	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

	$result = curl_exec($ch);
	curl_close($ch);
	
	echo $result;
	die();
?>