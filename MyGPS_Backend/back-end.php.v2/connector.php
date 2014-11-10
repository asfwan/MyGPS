<?php

if(!isset($path_to_essentials)) $path_to_essentials = "";

include($path_to_essentials."private.php");
if(isset($config_path)) include($config_path."config.php");

if(!isset($username)) $username = "sigtech";
mysql_connect("localhost","$username","$pass");
mysql_select_db($db_name);

?>