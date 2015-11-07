<?php

require_once '../db_connect/db.php';

$registration_errors = array(

					1 => 'Форма была пуста'
					
					);

if(isset($admin_information['password'], $admin_information['email'],$_POST['chat_text'])) {
	
$chat_text = mysql_real_escape_string(trim($_POST['chat_text']));
$id = $admin_information['id'];

$query = "INSERT INTO admin_chat (admin_id, text)
VALUES ('$id','$chat_text')";
$result = mysql_query($query) or die(mysql_error());

$chat_text = htmlspecialchars($comment_text);

print json_encode(array(

			'name' => $admin_information['login']
					
		));
	
}

?>