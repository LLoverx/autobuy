<?php
	session_start();

	require $_SERVER['DOCUMENT_ROOT']."/files/core.php";
	require $_SERVER['DOCUMENT_ROOT']."/files/core_functions.php";
	
	$plugins = array('style' => false, 'jquery' => false);
	
	if(is_file(ROOT."/pages/$page/config.php"))     include(ROOT."/pages/$page/config.php");
	if(is_file(ROOT."/pages/$page/$page.css")) 	$plugins['style'] = "/pages/$page/$page.css";
	if(is_file(ROOT."/pages/$page/$page.js")) 	$plugins['jquery'] = "/pages/$page/$page.js";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
    		<meta charset="utf-8">
    		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    		<meta name="author" content="Curtis Crewe">

    		<title>FIFA Autobuyer Panel - <?=ucfirst(str_replace("_"," ",$page));?></title>

    		<!-- Bootstrap core CSS -->
    		<link href="/design/css/bootstrap.css" rel="stylesheet">

    		<!-- Add custom CSS here -->
    		<link href="/design/css/style.css" rel="stylesheet">
    		<link href="/design/css/font-awesome.min.css" rel="stylesheet">
    		<link href="/design/css/dataTables.bootstrap.css" rel="stylesheet">
    		<link href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet">
    		<?	
			if($plugins['style']) 	echo "<link rel=\"stylesheet\" media=\"screen\" href=\"{$plugins['style']}\" />";
			$userNav = array(
				"/dashboard" => 'Dashboard', 
				"/feed" => 'Transactions',
				"/search_players" => 'Search Auctions',
				"/accounts" => 'Accounts',
				"/add_accounts" => 'Add Accounts',
				"/players" => 'Players',
				"/add_players" => 'Add Players',
				"/logout" => 'Logout'
			);
			$nonAuthNav = array(
				"/login" => 'Login'
			);
		?>
		<script src="http://code.jquery.com/jquery.min.js"></script>
		<script src="http://js.pusher.com/1.12/pusher.min.js"></script>
    		<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
    		<script type="text/javascript" language="javascript" src="/design/js/dataTables.bootstrap.js"></script>
    		<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    		<script src="/design/js/bootstrap.js"></script>
    		<script src="/design/js/global.js"></script>
    		<?
    			if($plugins['jquery']) 	echo "<script type=\"text/javascript\" src=\"{$plugins['jquery']}\"></script>";
    		?>
    		<!-- Put this into a custom JavaScript file to make things more organized -->
    		<script>
    			$("#menu-toggle").click(function(e) {
        			e.preventDefault();
        			$("#wrapper").toggleClass("active");
    			});
    			window.AjaxURL = "<?=Config::$site_url;?>files/ajax_framework.php";
    		</script>
  	</head>

  	<body>
    		<div id="wrapper">
      
      			<!-- Sidebar -->
      			<div id="sidebar-wrapper">
        			<ul class="sidebar-nav">
          				<li class="sidebar-brand"><a href="#">FIFA Autobuyer Panel</a></li>
          				<?php
          					if(isset($_SESSION['id'])) {
          						foreach($userNav as $link => $title) {
          							if(ltrim($link,'/') == $page) {
          								$class = "class='active'";
          							} else {
          								$class = "";
          							}
          							echo "<li ".$class."><a href='".$link."'>".$title."</a></li>";
          						}
          					} else {
          						foreach($nonAuthNav as $link => $title) {
          							if(ltrim($link,'/') == $page) {
          								$class = "class='active'";
          							} else {
          								$class = "";
          							}
          							echo "<li ".$class."><a href='".$link."'>".$title."</a></li>";
          						}
          					}
          				?>
        			</ul>
      			</div>
          
      			<!-- Page content -->
      			<div id="page-content-wrapper">
        			<?php
        				if(isset($_SESSION['id'])) {
      						if(is_file(PAGES."/$page/$page.php")) {
      							if($page == "login") {
      								include(PAGES."/dashboard/dashboard.php");
      							} else {
      								include(PAGES."/$page/$page.php");
      							}
      						} else {
      							include(PAGES."/error_pages/404.php");
      						}
      					} else {
      						switch($page) {
      							case "login":
      								include(PAGES."/login/login.php");
      							break;
      							default:
      								include(PAGES."/error_pages/404.php");
      							break;
      						}
      					}
        			?>
      			</div>
    		</div>
  	</body>
</html>