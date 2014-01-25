<?php
echo file_get_contents("http://www.futhead.com/14/players/search/quick/?term=".str_replace(" ","+",$_GET['term']));
die();
?>