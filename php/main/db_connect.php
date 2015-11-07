<?php
require 'SafeMySQL.php';
$session_start = session_start();
$email = filter_input(INPUT_COOKIE, 'email', FILTER_VALIDATE_EMAIL);
$RememberMe = filter_input(INPUT_COOKIE, 'RememberMe');
$RememberMeFilter = (strlen($RememberMe) === 32) ? true : false;
if($RememberMeFilter && $email) {
    $o = new SafeMySQL;
    $user_id = $o->getOne("SELECT user_id FROM users WHERE password=?s AND email=?s LIMIT 1",$RememberMe,$email);
    if(!$user_id) {
        setcookie('RememberMe', '', time()-3600,'/');
        setcookie('email', '', time()-3600,'/');
        unset($user_id,$RememberMeFilter,$RememberMe,$email);
    }
}
else {
    setcookie('RememberMe', '', time()-3600,'/');
    setcookie('email', '', time()-3600,'/');
    unset($user_id,$RememberMeFilter,$RememberMe,$email);
}