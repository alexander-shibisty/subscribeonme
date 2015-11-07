<?php
mysql_set_charset( 'utf8' );
session_start();
//Подключаемся к БД
$db_connect = mysql_connect ("localhost","root","");
mysql_select_db ("site", $db_connect);

$db_error = array(

		1 => 'Не правильные данные.'
		
		);

if (isset($_SESSION['admin_login'], $_SESSION['admin_password'])) {
	
	$session_login = mysql_real_escape_string(trim($_SESSION['admin_login']));
	$session_password = mysql_real_escape_string(trim($_SESSION['admin_password']));
	
	$query_session = mysql_query("SELECT id, login, first_name, last_name, email, country, city, address, passport_number, access_level, password FROM admin WHERE login='$session_login' AND password='$session_password'");
	$result_session = mysql_fetch_array($query_session);
	
	if ($result_session > 0) {
		
			$admin_information = array(
					
					'id' => $result_session['id'],
					'login' => $session_login,
					'password' => $session_password,
					'first_name' => $result_session['first_name'],
					'last_name' => $result_session['last_name'],
					'email' => $result_session['email'],
					'country' => $result_session['country'],
					'city' => $result_session['city'],
					'address' => $result_session['address'],
					'passport_number' => $result_session['passport_number'],
					'access_level' => $result_session['access_level']
					
					);
		
	}
		
	else {
	
			$_SESSION['admin_error'] = $db_error['1'];
	
	}
}