<?php
require_once '../../php/main/db_connect.php';
if($user_id) {
    $r = new SafeMySQL();
    date_default_timezone_set('Europe/London');
    $date = date('Y-m-d H:i:s');
    $r->query("UPDATE users_online SET online='offline' WHERE user_id=?i LIMIT 1",$user_id);
    $r->query("UPDATE users_online SET date=?s WHERE user_id=?i LIMIT 1",$date,$user_id);
    setcookie('RememberMe', $password, time()+3600*24*365,'/');
    setcookie('email', $email, time()+3600*24*365,'/');
    unset($_SESSION['password'],$_SESSION['email']);
    print('success');
}
else {
    print('error');
}