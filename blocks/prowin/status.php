<?php
require '../../php/main/db_connect.php';
$status = filter_input(INPUT_POST,'user_status');
if($user_id && $status) {
    switch($status){
        case 'offline':
        case 'online':
        case 'play':
        case 'sleep':
        case 'left':
        case 'rest':
        case 'busy':
            break;
        default:
            exit();
    }
    $x = $o->query("UPDATE users_online SET online=?s WHERE user_id=?i OR o_id=?i",$status,$user_id,$user_online);
        
    if($x) {
        print('success');
    }
    else {
        print('Просим прощения, что-то пошло не так.');    
    }

}
else {
    print('Мы не получили всех данных');
}