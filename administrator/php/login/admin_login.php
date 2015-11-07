<?php

header ('Location: http://subscribeonme.ru/administrator/index.php');

require_once '../db_connect/db.php';

$array_error = array(

		1 => 'Случилась страшная ошибка'
		
		);

if (isset($_POST['admin_login'], $_POST['admin_password'])) {
	
	$admin_login = mysql_real_escape_string(trim($_POST['admin_login']));
	$admin_password = md5(mysql_real_escape_string(trim($_POST['admin_password'])));
	
	$query_admin = mysql_query("SELECT login, password FROM admin WHERE login='$admin_login' AND password='$admin_password'");
	$result_admin = mysql_fetch_array($query_admin);
	
		if ($result_admin > 0) {
		
		$_SESSION['admin_login'] = $result_admin['login'];
		$_SESSION['admin_password'] = $result_admin['password'];
		unset($_SESSION['admin_error']);
		
		}
	
}

else {
	
		$_SESSION['admin_error'] = $array_error['1'];
	
}

?>