<?php

require_once 'php/db_connect/db.php';

if (isset($admin_information['login'],$admin_information['password'])) {
	
	require 'blocks/on.php';

}

else if (empty($admin_information['login']) || empty($admin_information['password'])) {
	
	require 'blocks/off.php';
	
}

else {
	
	require 'blocks/off.php';
	
}


?>