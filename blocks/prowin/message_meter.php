<?php
require '../../php/main/db_connect.php';
$dialog = filter_input(INPUT_GET, 'dialog',FILTER_VALIDATE_INT);
if($user_id){
    //Кол-во новых сообщений
    $o = new SafeMySQL();
    if($dialog) {
        $mm = $o->getOne('SELECT COUNT(meter) FROM users_dialogs WHERE meter=other_id AND pioneer_id=?i AND d_id <>?i OR meter=pioneer_id AND other_id=?i AND d_id <>?i', $user_id,$dialog, $user_id, $dialog);
        $query_dialog = $o->query('UPDATE users_dialogs SET meter=0 WHERE d_id=?i AND meter<>?i LIMIT 1',$dialog,$user_id);
    }
    else {
        $mm = $o->getOne('SELECT COUNT(meter) FROM users_dialogs WHERE meter=other_id AND pioneer_id=?i OR meter=pioneer_id AND other_id=?i', $user_id, $user_id);
    }
    
    if($mm) {
        print($mm);   
    }
}