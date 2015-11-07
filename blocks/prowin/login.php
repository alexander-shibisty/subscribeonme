<?php
require_once '../../php/main/SafeMySQL.php';
$string_object = new SafeMySQL();
$email = filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL);
$password = md5(filter_input(INPUT_POST,'password'));
if(isset($email, $password)) {
        $login_query = $string_object->getOne("SELECT user_id FROM users WHERE email=?s AND password=?s LIMIT 1",$email,$password);
        if($login_query) {
            setcookie('RememberMe', $password, time()+3600*24*365,'/');
            setcookie('email', $email, time()+3600*24*365,'/');
            $string_object->query("UPDATE users_online SET online='online' WHERE user_id=?i", $login_query['user_id']);
            print('success');
        }
        else {
            print('Вы не зарегитрированы.');
        }
}
else {
    print('Вы не заполнили нужные формы.');
}